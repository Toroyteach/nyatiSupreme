<?php

namespace App\Http\Controllers\Mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mpesa\API\C2B;
use App\Mpesa\API\C2BRegister;
use App\Mpesa\TokenGenerator;
use App\Models\MpesaC2B;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class C2BController extends Controller
{
    protected $result_desc = null;
    protected $result_code = 1;
    protected $order;

    public function confirmTrx(Request $request)
    {
        $env = config('mpesa1.mpesa.env');
        $confirmation_key = config("mpesa1.mpesa.c2b.{$env}.confirmation_key");
        $short_code = config("mpesa1.mpesa.c2b.{$env}.short_code");

        if ($request->confirmation_key != $confirmation_key) {
            $this->result_desc = 'Confirmation key mismatch';
        }

        if ($request->BusinessShortCode != $short_code) {
            $this->result_desc = 'Short code mismatch';
        }

        //If no error, Change to success
        if (!$this->result_desc) {
            $data = [
                'trans_time' => $request->TransTime,
                'trans_amount' => $request->TransAmount,
                'business_short_code' => $request->BusinessShortCode,
                'bill_ref_number' => $request->BillRefNumber,
                'invoice_number' => $request->InvoiceNumber,
                'org_account_balance' => $request->OrgAccountBalance,
                'third_party_trans_id' => $request->ThirdPartyTransID,
                'msisdn' => $request->MSISDN,
                'first_name' => $request->FirstName,
                'middle_name' => $request->MiddleName,
                'last_name' => $request->LastName,
                'trans_id' => $request->TransID,
                'transaction_type' => $request->TransactionType
            ];

            //find out how to insert data on relationship

            $transaction = $this->getOrder($request->BillRefNumber);
            $mpesac2b = MpesaC2B::create($data);
            
            $transaction->mpesac2b()->save($mpesac2b);

            $this->result_desc = 'Transaction saved successfully';
            $this->result_code = 0;

            $this->updateOrderPayment($request->BillRefNumber);
        }

        return response()->json([
            "ResultDesc" => $this->result_desc,
            "ResultCode" => $this->result_code
        ]);
    }

    public function validateTrx(Request $request)
    {
        //validate to either accept or reject the transaction to go through
        if (!$invoice = $this->getInvoice($request->get('BillRefNumber', 0))) {
            return $this->invalidInvoiceNumberResponse();
        }

        $transaction = $request->get('BillRefNumber');

        return $this->successfulResponse($transaction);
    }

    /**
     * @param Request $request
     * @return bool|string|void
     */
    public function simulate(Request $request)
    {
        try {
            $feedback = (new C2B())->setShortCode(config('mpesa1.mpesa.c2b.sandbox.short_code'))
                ->setAmount($request->amount)
                ->setBillRefNumber($request->bill_ref_number)
                ->setMsisdn($request->msisdn)
                ->simulate();

        } catch (\ErrorException $e) {
            return $e->getMessage();
        }
        return $feedback;
    }

    public function register() {

        try {
            $env = config('mpesa1.mpesa.env');
            $config = config("mpesa1.mpesa.c2b.{$env}");
            $token = (new TokenGenerator())->generateToken($env);

            $confirmation_url = route('api.mpesa.c2b.confirm', $config['confirmation_key']);
            //env('APP_URL')./api/v1/c2b/simulate/;
            //https://nyatisupreme.co.ke/api/v1/c2b/simulate
            $validation_url = route('api.mpesa.c2b.validate', $config['validation_key']);
            //env('APP_URL')./api/v1/c2b/simulate/;
            //https://nyatisupreme.co.ke/api/v1/c2b/simulate
            $short_code = $config['short_code'];

            $response = (new C2BRegister())->setShortCode($short_code)
                ->setValidationUrl($validation_url)
                ->setConfirmationUrl($confirmation_url)
                ->setToken($token)
                ->register($env);

        } catch (\ErrorException $e) {
            return $e->getMessage();
        }
        return $response;
    }

    public function getOrder($orderId)
    {
        return Order::where('order_number', 'like', '%'.$orderId)->first();
    }

    public function updateOrderPayment($orderId)
    {
        //update payment status to 1 with date to only update changes if created last 15min
        $from = date("Y/m/d H:i:s", strtotime("-15 minutes"));
        $to = date("Y/m/d H:i:s", strtotime("now"));
        return Order::where('order_number', 'like', '%'.$orderId)->whereBetween('created_at', [$from, $to])->update(['payment_status' => 1]);
    }

        /**
     * Send a successful transaction response
     *
     * @param Transaction $transaction
     *
     * @return Response
     */
    protected function successfulResponse($transaction)
    {
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'The service was accepted successfully',
            'ThirdPartyTransID' => $transaction
        ]);
    }

    /**
     * Send an invalid invoice number response
     *
     * @return Response
     */
    protected function invalidInvoiceNumberResponse()
    {
        return response()->json([
            'ResultCode' => 1,
            'ResultDesc' => 'The provided invoice number does not exist.',
            'ThirdPartyTransID' => 0
        ]);
    }

        /**
     * Get the invoice with the provided number.
     *
     * @param string $invoiceNumber
     *
     * @return Order
     */
    protected function getInvoice($invoiceNumber)
    {
        return Order::where('order_number', 'like', '%'.$id)->first();
    }

    protected function getFullOrderId($id)
    {
        //return the full order number to be queried.
        return Order::where('order_number', 'like', '%'.$id)->first();
    }
}
