<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Events\OrderStatusChangedEvent;
use App\Models\User;
use PDF;

class OrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->listOrders();
        $this->setPageTitle('Orders', 'List of all orders');
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        $this->setPageTitle('Order Details', $orderNumber);
        return view('admin.orders.show', compact('order'));
    }

    public function notificationShow($orderId)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        $this->setPageTitle('Order Details', $orderNumber);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        $this->setPageTitle('Order Details', $orderNumber);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'status'      =>  'required|in:completed,pending,processing,declined',
        ]);
    
        $params = $request->except('_token');
        
        $order = $this->orderRepository->updateOrderStatus($params);
            
        if (!$order) {
            return $this->responseRedirectBack('Error occurred while updating status of order.', 'error', true, true);
        }
        if($request['status'] == 'completed') {
            $eventdata = collect($order)->only('order_number', 'status', 'first_name');
            $user_id = $this->orderRepository->findUserByOrderId($request->id);
            //dd($user_id);
            //$user_email = User::find($user_id)->email;
            $user_email = User::select('email')->where('id', $user_id)->first();
            $user = array('email' => $user_email->email);
            //dd($user);
            $eventdata = $eventdata->union($user);
            $eventdata->all();
            //dd($eventdata);
    
    
            event(new OrderStatusChangedEvent($eventdata));
        }

        return response()->json(['success'=>'Order is successfully updated!']);
    }

    public function getOrderPdf($orderId)
    {
        // retreive all records from db
        $order = $this->orderRepository->findOrderById($orderId);
        //dd($order->items);

      // share data to view
      view()->share('order',$order);
      $pdf = PDF::loadView('admin.orders.pdf_view', compact('order'));
      $pdfName = $order->order_number.'_'.$order->created_at.'.pdf';
      //dd($pdfName);

      // download PDF file with download method
      return $pdf->stream($pdfName);
    }

}