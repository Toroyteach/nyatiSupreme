<?php

namespace App\Repositories;

use App\Contracts\MpesaContract;
use App\Mpesa\API\C2B;
use App\Mpesa\API\STKPush;
use Auth;
use App\Models\PesapalTransaction;
use Pesapal;

//this repository is mostly used to initiate payments from the system. other transactions are handled the respective controllers

class MpesaRepository implements MpesaContract
{

    private $result_desc = 'An error occurred';
    private $result_code = 1;
    private $http_code = 400;

        /**
     * @param Request $request
     * @return bool|string|void
     */
    public function c2bsimulate($params)
    {
        try {
            $feedback = (new C2B())->setShortCode($params->short_code)
                ->setAmount($params->amount)
                ->setBillRefNumber($params->bill_ref_number)
                ->setMsisdn($params->msisdn)
                ->simulate();

        } catch (\ErrorException $e) {
            return $e->getMessage();
        }
        return $feedback;
    }

    public function stksimulate($params)
    {
        $env = config('mpesa1.mpesa.env', 'sandbox');

        if ($config = config("mpesa1.mpesa.stk_push.{$env}")) {

            $stk_push_simulator = (new STKPush())
                ->setShortCode($config['short_code'])
                ->setPassKey($config['pass_key'])
                ->setAmount($params->amount)
                ->setSenderPhone($params->sender_phone)
                ->setPayerPhone($params->payer_phone)
                ->setAccountReference($params->account_reference)
                ->setReceivingShortcode($config['short_code'])
                ->setCallbackUrl(route('api.mpesa.stk-push.confirm', $config['confirmation_key']))
                ->setRemarks('Payment for Goods NyatiSupreme Construction')
                ->simulate($env);

            if (! $stk_push_simulator->failed()) {

                $this->http_code = 200;

            }

            $this->result_desc = $stk_push_simulator->getResponse();

        } elseif (!$config) {
            $this->result_desc = 'STK Push request failed: Missing important parameters';
        }

        return response()->json([
            'message' => $this->result_desc
        ], $this->http_code);

    }

    //add pesapal payment methods and contracts
    public function pesapalcreate($params){

        $payments = new PesapalTransaction;
        $payments->order()->associate($params->id);
        $payments->businessid = Auth::user()->id; //Business ID
        $payments->transactionid = Pesapal::random_reference();
        $payments->status = 'Lost'; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
        $payments->amount = 10;
        $payments->save();

        //dd($payments.''.$order);

        //make a model to create pesapal transaction
        $details = array(
            'amount' => $params->grand_total,
            'description' => 'Test Transaction',
            'type' => 'MERCHANT',
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name,
            'email' => Auth::user()->email,
            'phonenumber' => Auth::user()->phonenumber,
            'reference' => $payments->transactionid,
            //'height'=>'400px',
            //'currency' => 'USD'
        );

        return Pesapal::makePayment($details);
    }
}