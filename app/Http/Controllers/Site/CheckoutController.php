<?php

namespace App\Http\Controllers\Site;

use Cart;
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
        $this->middleware(['auth','verified']);
        //$this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('frontend.pages.checkout');
    }

    public function placeOrder(Request $request)
    {
        //dd($request->all());
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
            $eventdata = collect($order)->only('order_number', 'grand_total', 'first_name');
            $eventdata->all();
            $user = array('email' => Auth::user()->email);
            $eventdata = $eventdata->union($user);
            //$eventdata->all();
            //dd($testdata);
    
            event(new OrderPlaced($eventdata));
            //dd('died here');
    
            // $userSchema = Admin::all();
      
            // $orderData = [
            //     'name' => 'New Order',
            //     'body' => 'This is a new placed order ',
            //     'order_id' => $order->order_number,
            //     'first_name' => $order->order_first_name,
            //     'email' => $user
            // ];
    
            // $when = Carbon::now()->addSecond(10);
            // Notification::send($userSchema, (new newOrderNotification($orderData))->delay($when));
            //dd('died here last');
            return view('frontend.pages.success', compact('order'))->with('success','Your Order '.$eventdata['order_number'].' was placed successfully');
        }

        return redirect()->back()->with('error','Order not placed!!');
    }

    public function complete(Request $request)
    {

        //make and mpesa request and confirm the transaction also notify customers of success order change
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
}
