<?php

namespace App\Http\Controllers\Mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MpesaSTKPushSimulateRequest;
use App\Mpesa\API\STKPush;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class STKPushController extends Controller
{
    private $result_desc = 'An error occurred';
    private $result_code = 1;
    private $http_code = 400;

    public function simulate(Request $request)
    {
        $env = config('mpesa1.mpesa.env', 'sandbox');

        if ($config = config("mpesa1.mpesa.stk_push.{$env}")) {

            $stk_push_simulator = (new STKPush())
                ->setShortCode(config('mpesa1.mpesa.c2b.sandbox.short_code'))
                ->setPassKey($config['pass_key'])
                ->setAmount($request->amount)
                ->setSenderPhone($request->sender_phone)
                ->setPayerPhone($request->payer_phone)
                ->setAccountReference($request->account_reference)
                ->setReceivingShortcode(config('mpesa1.mpesa.c2b.sandbox.short_code'))
                ->setCallbackUrl(route('api.mpesa.stk-push.confirm', $config['confirmation_key']))
                ->setRemarks('Pay your bill')
                ->simulate($env);

            if (! $stk_push_simulator->failed()) {

                $this->http_code = 200;

            }

            $this->result_desc = $stk_push_simulator->getResponse(); //result from safaricom after a succesfully reguest creation

        } elseif (!$config) {

            $this->result_desc = 'STK Push request failed: Missing important parameters';

        }

        return response()->json([
            'message' => $this->result_desc
        ], $this->http_code);
        //after a succesful simulation the response is status 200 and message  
    }

    public function confirm(Request $request)
    {
        $env = config('mpesa1.mpesa.env', 'sandbox');
        $confirmation_key = config("mpesa1.mpesa.stk_push.{$env}.confirmation_key");

        if ($request->confirmation_key == $confirmation_key) {

            $stk_push_confirm = (new STKPush())->confirm($request);

            if ($stk_push_confirm->failed()) {

                Log::error($stk_push_confirm->getResponse());

            } else {
                $this->result_code = 0;
                $this->result_desc = 'Success';
            }

        } else {

            $this->result_desc = 'STK Push confirmation failed: Confirmation key mismatch';
            Log::error($this->result_desc);

        }

        return response()->json([
            'ResultCode' => $this->result_code,
            'ResultDesc' => $this->result_desc,
        ]);
    }

    public function testData(int $amount){
        // $mpesa = \App\Models\STKPush::where('merchant_request_id', '123456789')->where('checkout_request_id', '987654321')->first();
        // dd($mpesa);
        // $update = $mpesa->order()->updateExistingPivot('140', ['payment_status' => 1], true);

        // $mpesa = DB::statement("UPDATE orders set payment_status = 1 where id = ( select order_id from `mpesa_stk_push` where merchant_request_id = '123456789' ) ");

        // if(!$mpesa){
        //     dd('data not updated');
        // } else {
        //     dd('updated');
        // }
        // dd(strtoupper(uniqid('ORD-', true)));
        // dd(substr(strtoupper(uniqid('ORD-', true)), -8));
        
        // $from = date("Y/m/d H:i:s", strtotime("-15 minutes"));
        // $to = date("Y/m/d H:i:s", strtotime("now"));
        // //dd($from.' to '.$to);
        // $id = 81581511;
        // dd(Order::where('order_number', 'like', '%'.$id)->whereBetween('created_at', [$from, $to])->first());
        if($amount > 150000){
            dd(false);
        } else {
            dd(true);
        }
    }
}
