<?php

namespace App\Mpesa\API;

use App\Mpesa\TokenGenerator;
use App\Mpesa\Validator;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Cart;
use App\Events\OrderPlaced;

class STKPush extends Validator
{
    protected $default_endpoints = [
        'live' => 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
        'sandbox' => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
    ];

    private $pass_key;
    private $short_code;
    private $amount;
    private $sender_phone;
    private $payer_phone;
    private $receiving_shortcode;
    private $callback_url;
    private $account_reference;
    private $transaction_type = 'CustomerPayBillOnline';
    private $remarks;

    private $failed = false;
    private $response = 'An an unknown error occurred';

    public function simulate(string $env)
    {

        try {

            $this->validateEndpoints($env);
            $token = (new TokenGenerator())->generateToken($env);

        } catch (\Exception $e) { 
            $this->failed = true;
            $this->response = $e->getMessage();
        }

        $timestamp = '20' . date("ymdhis");

        $password = base64_encode($this->short_code . $this->pass_key . $timestamp);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->endpoint);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));


        $curl_post_data = array(
            'BusinessShortCode' => $this->short_code,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => $this->transaction_type,
            'Amount' => $this->amount,
            'PartyA' => $this->sender_phone,
            'PartyB' => $this->receiving_shortcode,
            'PhoneNumber' => $this->payer_phone,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => $this->account_reference,
            'TransactionDesc' => $this->remarks
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $response = json_decode(curl_exec($curl));

        if ($response->ResponseCode == '0') {

            $orderId = $this->getOrder($this->account_reference);
            
            if(!$orderId){
                $this->failed = true;
            }

            $mpesa = \App\Models\STKPush::create([
                        'order_id' =>  $orderId->id,
                        'merchant_request_id' => $response->MerchantRequestID,
                        'checkout_request_id' => $response->CheckoutRequestID
                    ]);

            $orderId->mpesastk()->save($mpesa);

        } else {

            $this->failed = true;

        }

        $this->response = $response;

        return $this;
    }

    public function confirm(Request $request)
    {
        $payload = json_decode($request->getContent());

        if (property_exists($payload, 'Body') && $payload->Body->stkCallback->ResultCode == '0') {

            $merchant_request_id = $payload->Body->stkCallback->MerchantRequestID;
            $checkout_request_id = $payload->Body->stkCallback->CheckoutRequestID;

            $stk_push_model = \App\Models\STKPush::where('merchant_request_id', $merchant_request_id)
                ->where('checkout_request_id', $checkout_request_id)
                ->firstOrFail();
                
                //$data = array();
                
                $data = [
                    'result_desc' => $payload->Body->stkCallback->ResultDesc,
                    'result_code' => $payload->Body->stkCallback->ResultCode,
                    'merchant_request_id' => $merchant_request_id,
                    'checkout_request_id' => $checkout_request_id,
                ];
            
            //\Log::info($data);
            
            foreach($payload->Body->stkCallback->CallbackMetadata->Item as $row){
                
                if($row->Name == 'Amount'){
                    $data['amount'] = $row->Value;
                }
                
                if($row->Name == 'MpesaReceiptNumber'){
                    $data['mpesa_receipt_number'] = $row->Value;
                }
                
                if($row->Name== 'TransactionDate'){
                    $data['transaction_date'] = $row->Value;
                }
                
                if($row->Name == 'PhoneNumber'){
                    $data['phone_number'] = $row->Value;
                }
                
                
            }
            
            //\Log::info($data);
            
            if($stk_push_model) {

                $stk_push_model->update($data);
                $this->updateOrderPayment($merchant_request_id, $checkout_request_id);
                Cart::clear();
                $this->sendEmails($this->returnOrder($stk_push_model->order_id)); //get the correct order details
                //send emails to clients and adminstrators of the business to act on the order

            } 

        } else {
            $this->failed = true;
        }

        return $this;
    }

    public function setPassKey(string $pass_key)
    {
        $this->pass_key = $pass_key;

        return $this;
    }

    public function setShortCode(string $short_code)
    {
        $this->short_code = $short_code;

        return $this;
    }

    public function setAmount(int $amount)
    {
        if($amount > 150000){
            //think of something here
            return false;

        } else {

            $this->amount = $amount;

            return $this;
        }
    }

    public function setSenderPhone(string $phone)
    {
        $this->sender_phone = $phone;

        return $this;
    }

    public function setPayerPhone(string $phone)
    {
        $this->payer_phone = $phone;

        return $this;
    }

    public function setReceivingShortcode(string $receiving_shortcode)
    {
        $this->receiving_shortcode = $receiving_shortcode;

        return $this;
    }

    public function setCallbackUrl(string $callback_url)
    {
        $this->callback_url = $callback_url;

        return $this;
    }

    public function setAccountReference(string $account_reference)
    {
        $this->account_reference = $account_reference;

        return $this;
    }

    public function setRemarks(string $remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function failed()
    {
        return $this->failed;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function sendEmails($order){
        $eventdata = collect($order)->only('order_number', 'grand_total', 'shipping_fee', 'item_count', 'first_name', 'address', 'city', 'post_code');
        $eventdata->all();
        $user = array('email' => $order->user->email);
        $eventdata = $eventdata->union($user);
        event(new OrderPlaced($eventdata));// move to success mpesa payment api
    }

    public function getOrder($orderId)
    {

        return Order::where('order_number', 'like', '%'.$orderId)->firstOrFail();
    }

    public function returnOrder($orderId)
    {
        return Order::findOrFail($orderId);
    }

    public function updateOrderPayment($merchId, $reqId)
    {
        // check order table and update payment status to 1.
        $mpesa = DB::statement("UPDATE orders set payment_status = 1 where id = ( select order_id from mpesa_stk_push where merchant_request_id = '$merchId' and  checkout_request_id = '$reqId') ");

        if(!$mpesa){
            Log::error('failed to update details of the parent order record');
            return false;
        }
        return true;
    }
}