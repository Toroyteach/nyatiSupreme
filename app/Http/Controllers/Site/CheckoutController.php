<?php

namespace App\Http\Controllers\Site;

use Cart;
use Pesapal;
use App\Models\PesapalTransaction;
use App\Models\Order;
use Illuminate\Http\Request;
//use App\Services\PayPalService;
use App\Contracts\OrderContract;
use App\Contracts\MpesaContract;
use App\Http\Controllers\Controller;
use App\Notifications\NewOrder;
use App\Models\User;
// use App\Models\Admin;
use App\Events\OrderPlaced;
//use App\Notifications\newOrderNotification;
use Auth;
//use Carbon\Carbon;
//use Notification;
use App\Http\Requests\PlaceOrderRequest;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $payPal;

    protected $orderRepository;

    protected $mpesaRepository;

    public function __construct(OrderContract $orderRepository, MpesaContract $mpesaRepository)
    {
        //dd('payment not set');
        $this->middleware(['auth','isVerified','emptyCart', 'emptysocialdetails'] , ['except' => [
            'paymentsuccess', 'paymentconfirmation'
        ]]);
        //$this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
        $this->mpesaRepository = $mpesaRepository;
        
    }

    public function getCheckout()
    {
        $total = Cart::getTotal();
        return view('frontend.pages.checkout', compact('total'));
    }

    public function placeOrder(PlaceOrderRequest $request)
    {   
        
        if($request->payment_method == 'mpesa'){
            $this->validate(request(), [
                'mpesaPhonenumber' => 
                    array(
                        'required',
                        'regex:/(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-2]{1})[0-9]{6}\z/',
                        'digits:10'
                    )
            ]);
            
        }

        $order = $this->orderRepository->storeOrderDetails($request->validated());

        // You can add more control here to handle if the order is not stored properly
        if ($order) {
            //replace with mpesa service processing
            //$this->payPal->processPayment($order);
            $eventdata = collect($order)->only('order_number', 'grand_total', 'shipping_fee', 'item_count', 'first_name', 'address', 'city', 'post_code');
            $eventdata->all();
            $user = array('email' => Auth::user()->email);
            $eventdata = $eventdata->union($user);
            //$eventdata->all();
            //dd($testdata);
            
            //event with order placed
            event(new OrderPlaced($eventdata));// move to success mpesa payment api

            //Cart::clear();
            //clearing the cart clears the cache hence the _token is cleared this brings up error..

            //skip here before going live
            if($order->payment_method == 'credit'){

                //call function to initiate credit card pay
                 $iframe = $this->mpesaRepository->pesapalcreate($order);

                return view('frontend.pages.pendingpaycredit', compact('order','iframe'));

            } elseif ($order->payment_method =='mpesa'){

                $data = [
                    'short_code' => config('mpesa1.mpesa.c2b.live.short_code'),
                    'amount' => $order->grand_total,
                    'bill_ref_number' => substr($order->order_number, -7),
                    'msisdn' => $order->order_phonenumber
                ];

                //call c2t to mpesa
                //$response = $this->mpesaRepository->c2bsimulate($data);

                // if($response){

                    return view('frontend.pages.pendingpay', compact('order'))->with('success','Your Order '.$eventdata['order_number'].' was placed successfully');

                // }

            } else {
                //errorr on payment method
                Log::error('failed to initiate pay. No payment method set');
            }
        }

        return redirect()->back()->with('error','Order not placed!!');
    }

    public function complete(Request $request)
    {

        //not in use
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        //$status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        // $fromUser = "eddyonline.com";
        // $toUser = User::find($order->customer_id);
        // $toUser->notify(new NewOrder($fromUser));
        //dd('end check');
        $user = Auth::user()->pluck('email');
        $eventdata = $order->merge($user);

        event(new OrderPlacedEvent($eventdata));

        $userSchema = Admin::all();
  
        $orderData = [
            'name' => 'New Order',
            'body' => 'This is a new placed order ',
            'order_id' => $order->order_number
        ];

        $when = Carbon::now()->addSecond(10);
        Notification::send($userSchema, (new newOrderNotification($orderData))->delay($when));
        //\Notification::send($users, (new DealPublished($deal))->delay($when));    

        Cart::clear();
        return view('frontend.pages.success', compact('order'));
    }

    public function requestPaymentAgain(Request $request)
    {
        //ajax request to perform stk push to the user.
        $resubmitOrder = Order::where('order_number', 'like', '%'.$request->input('BilRefNo'))->first();

        if(!$resubmitOrder){

            return response()->json(['message' => 'This Request is already paid for', 'status' => false]);

        }

        $data = [
            'sender_phone' => $resubmitOrder->phone_number,
            'amount' => $resubmitOrder->grand_total,
            'payer_phone' => $resubmitOrder->phone_number,
            'account_reference' => substr($request->input('BilRefNo'), -7)
        ];


        if($resubmitOrder->payment_status == 0){

            $response = $this->mpesaRepository->stksimulate($data);

            if(!$response){

                return response()->json(['success'=>'request has failed', 'status' => false]);

            }

            return response()->json(['success'=>'request submitted successfully', 'status' => true]);
        }

        return response()->json(['message' => 'This Request is not completed', 'status' => false]);

    }
    
    public function requestUpdatePendingPay(Request $request)
    {

        //check if order number payment status has changed to successfull
        // return response()->json(['success'=>'Payment is Processed', 'status' => 1]); $_GET['BilRefNo']

        $oderstatus = Order::where('order_number', 'like', '%'.$request->input('BilRefNo'))->first();
        // dd($oderstatus->status);

        if($oderstatus->payment_status != 1){
            return response()->json(['failure'=>'Payment still Pending', 'status' => false]);
        } else {

            
            return response()->json(['success'=>'Payment is Processed', 'status' => true]);
        }

    }

    //pesapal payment methods
    public function paymentsuccess(Request $request)//just tells u payment has gone thru..but not confirmed
    {
        $trackingid = $request->input('tracking_id');
        $ref = $request->input('merchant_reference');
        
        $payments = PesapalTransaction::where('transactionid',$ref)->first();
        $payments->trackingid = $trackingid;
        $payments->status = 'pending';
        $payments->save();

        $order = Order::find($payments->order_id);
        $order->payment_status = 'pending';
        $order->save();
        //go back home
        return view('frontend.pages.success', compact('order'));
    }
    //This method just tells u that there is a change in pesapal for your transaction..
    //u need to now query status..retrieve the change...CANCELLED? CONFIRMED?
    public function paymentconfirmation(Request $request)
    {
        $trackingid = $request->input('pesapal_transaction_tracking_id');
        $merchant_reference = $request->input('pesapal_merchant_reference');
        $pesapal_notification_type= $request->input('pesapal_notification_type');

        //use the above to retrieve payment status now..
        $this->checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type);
    }
    //Confirm status of transaction and update the DB
    public function checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type){
        $status = Pesapal::getMerchantStatus($merchant_reference);
        $payments = PesapalTransaction::where('trackingid',$trackingid)->first();
        $payments->status = $status;
        $payments->payment_method = "PESAPAL";//use the actual method though...
        $payments->save();

        $order = Order::find($payments->order_id);
        $order->payment_status = 'Completed';
        $order->save();
        return "success";
    }
}