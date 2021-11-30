<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\MpesaTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SmoDav\Mpesa\Laravel\Facades\Registrar;
use App\Http\Controllers\Controller;


class MpesaController extends Controller
{
    /**
     * Random Hash to be used to validate if the request is from M-Pesa.
     *
     * @var string
     */
    protected $hash = 'jvmJpbrZ6nfAyb8UToGVLdhychBYcYTH';

    /**
     * Register your C2B endpoints.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $confirmation = 'https://nyatisupreme.co.ke/api/mpesa/confirm';
        $validation = 'https://nyatisupreme.co.ke/api/mpesa/validate';

        $response = Registrar::register(600000)
            ->onConfirmation($confirmation)
            ->onValidation($validation)
            ->submit();

        return response()->json($response);
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
        return Order::where('order_number', $invoiceNumber)->first();
    }

    /**
     * Validate the incoming transaction.
     *
     * @return Response
     */
    public function validateTransaction(Request $request)
    {
        if (!$invoice = $this->getInvoice($request->get('BillRefNumber', 0))) {
            return $this->invalidInvoiceNumberResponse();
        }

        $transaction = $this->createTransaction($request, $invoice);

        return $this->successfulResponse($transaction);
    }

    /**
     * Update the transaction details and mark it as complete
     *
     * @param Request $request
     *
     * @return Response
     */
    public function confirmTransaction(Request $request)
    {
        if ($transaction = MpesaTransaction::find($request->get('ThirdPartyTransID'))) {
            $transaction->update(['status' => MpesaTransaction::STATUS_COMPLETE]);

            return $this->successfulResponse($transaction);
        }

        if (!$invoice = $this->getInvoice($request->get('BillRefNumber', 0))) {
            return $this->invalidInvoiceNumberResponse();
        }

        $transaction = $this->createTransaction($request, $invoice, MpesaTransaction::STATUS_COMPLETE);

        return $this->successfulResponse($transaction);
    }

    /**
     * Create a new mpesa transaction
     *
     * @param Request $request
     * @param Invoice $invoice
     * @param int     $status
     *
     * @return Transaction
     */
    protected function createTransaction(Request $request, Order $order, $status = MpesaTransaction::STATUS_PENDING)
    {
        return MpesaTransaction::create([
            'invoice_id' => $order->id,
            'transaction_number' => $request->get('TransID'),
            'transaction_time' => Carbon::parse($request->get('TransTime', null)),
            'amount' => $request->get('TransAmount'),
            'short_code' => $request->get('BusinessShortCode'),
            'bill_reference' => $request->get('BillRefNumber'),
            'mobile_number' => $request->get('MSISDN'),
            'payer_first_name' => $request->get('FirstName'),
            'payer_middle_name' => $request->get('MiddleName'),
            'payer_last_name' => $request->get('LastName'),
            'status' => $status,
        ]);
    }

    /**
     * Send a successful transaction response
     *
     * @param Transaction $transaction
     *
     * @return Response
     */
    protected function successfulResponse(MpesaTransaction $transaction)
    {
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'The service was accepted successfully',
            'ThirdPartyTransID' => $transaction->id
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
}