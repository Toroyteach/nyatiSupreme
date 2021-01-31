<?php

namespace App\Http\Controllers\Site;

use Cart;
use Pesapal;
use App\Models\PesapalTransaction;
use App\Models\Order;
use Illuminate\Http\Request;
//use App\Services\PayPalService;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Notifications\NewOrder;
use App\Models\User;
// use App\Models\Admin;
use App\Events\OrderPlaced;
//use App\Notifications\newOrderNotification;
use Auth;
//use Carbon\Carbon;
//use Notification;

class CheckoutController extends Controller
{
    protected $payPal;

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        //dd('payment not set');
        $this->middleware(['auth','verified','emptyCart']);
        //$this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('frontend.pages.checkout');
    }

    public function placeOrder(Request $request)
    {   
        $this->validate(request(), [
            'mpesaPhonenumber' => 
                array(
                    'required',
                    'regex:/(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-2]{1})[0-9]{6}\z/',
                    'digits:10'
                )
        ]);

        //dd('submited');

        //dd($request->all());
        //return response()->json(['success'=>'Ajax request submitted successfully']);
        // Before storing the order we should implement the
        // request validation which I leave it to you
        $testdata = array(
            "first_name" => "Anthony",
            "last_name" => "Toroitich",
            "address" => "123-123",
            "city" => "rongai",
            "country" => "kenya",
            "post_code" => "020-1094",
            "phone_number" => "0710516288",
            "notes" => "i want this delivery",
            "email" => "email@email.com",
            "payment_method" => "mpesa"
          );
          
        //$order = $this->orderRepository->storeOrderDetails($request->all());
        $order = $this->orderRepository->storeOrderDetails($request->all());

        // You can add more control here to handle if the order is not stored properly
        if ($order) {
            //replace with mpesa service processing
            //$this->payPal->processPayment($order);
            $eventdata = collect($order)->only('order_number', 'grand_total', 'first_name', 'address', 'city', 'post_code');
            $eventdata->all();
            $user = array('email' => Auth::user()->email);
            $eventdata = $eventdata->union($user);
            //$eventdata->all();
            //dd($testdata);
            
            //event with order placed
            event(new OrderPlaced($eventdata));// move to success mpesa payment api

            Cart::clear();

            if($order->payment_method == 'credit'){

                $payments = new PesapalTransaction;
                $payments->order()->associate($order->id);
                $payments->businessid = Auth::user()->id; //Business ID
                $payments->transactionid = Pesapal::random_reference();
                $payments->status = 'Lost'; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
                $payments->amount = 10;
                $payments->save();

                //dd($payments.''.$order);

                //make a model to create pesapal transaction
                $details = array(
                    'amount' => $order->grand_total,
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

                $iframe=Pesapal::makePayment($details);

                return view('frontend.pages.pendingpaycredit', compact('order','iframe'));
            }

            return view('frontend.pages.pendingpay', compact('order'))->with('success','Your Order '.$eventdata['order_number'].' was placed successfully');
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
        return response()->json(['success'=>'request submitted successfully']);
    }
    
    public function requestUpdatePendingPay(Request $request)
    {

        //check if order number payment status has changed to successfull
        return response()->json(['success'=>'Payment is Processed', 'status' => 1]);
        //return response()->json(['failure'=>'Payment is Not Processed', 'status' => 0]);
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
