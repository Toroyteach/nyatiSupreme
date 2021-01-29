<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use SmoDav\Mpesa\Laravel\Facades\Simulate;
use App\Http\Controllers\Controller;

class MpesaTestController extends Controller
{
    /**
     * Simulate a C2B Request using a fake invoice number.
     *
     * @return \Illuminate\Http\Response
     */
    public function fakeInvoice()
    {
        $response = Simulate::request(2000)
            ->from(254768624270)
            ->usingReference('fakeInvoice')
            ->setCommand(CUSTOMER_PAYBILL_ONLINE)
            ->push();

        return response()->json([
            'response' => $response,
            'next' => 'Please check your site endpoints and validate that ONLY the validate endpoint will be called'
        ]);
    }

    /**
     * Simulate a C2B Request using a real invoice number.
     *
     * @return \Illuminate\Http\Response
     */
    public function realInvoice()
    {
        $order = Order::first();

        if (!$order) {
            return response()->json([
                'error' => 'Please run php artisan db:seed to fake some invoices.'
            ]);
        }

        $response = Simulate::request($order->amount)
            ->from($order->order_number)
            ->usingReference($order->order_number)
            ->setCommand(CUSTOMER_PAYBILL_ONLINE)
            ->push();

        return response()->json([
            'response' => $response,
            'next' => 'Please check your ngrok endpoints and validate that BOTH the validate and confirm endpoint will be called. Also check the Transactions table.'
        ]);
    }
}
