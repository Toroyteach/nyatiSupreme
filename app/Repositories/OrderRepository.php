<?php

namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use App\Models\User;
use App\Models\UserAddress;
use SmoDav\Mpesa\Laravel\Facades\STK;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {
        $shippingAddress = UserAddress::where('user_id', auth()->user()->id)->where('default_address', 1)->get();

        //dd(Cart::getContent());

        //$updateDB = $this->updateDd();

        if($shippingAddress->isEmpty())
        {
            // dd($shippingAddress);
            //No shipping address is set
            //dd('no address is set');
            $order = Order::create([
                'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                'user_id'           => auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  Cart::getSubTotal(),
                'shipping_fee'      =>  0,
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  $params['payment_method'],
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $params['address'], //decide here about which address delivery to use
                'city'              =>  $params['city'],
                'country'           =>  $params['country'],
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  auth()->user()->phonenumber,
                'notes'             =>  $params['notes']
            ]);

        } else {

            //shipping address set
            //dd($shippingAddress[0]->id);
            $order = Order::create([
                'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                'user_id'           => auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  Cart::getSubTotal(),
                'shipping_fee'      =>  0,
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  $params['payment_method'],
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $shippingAddress[0]->address, //decide here about which address delivery to use
                'city'              =>  $shippingAddress[0]->city,
                'country'           =>  $shippingAddress[0]->county,
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  auth()->user()->phonenumber,
                'notes'             =>  $params['notes']
            ]);

        }


        if ($order) {

            $items = Cart::getContent();
            //dd($items);


            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                if($item->attributes->size == null){

                    Product::where('id', $item->attributes->productId)->decrement('quantity', $item->quantity);

                }

                $product = Product::where('id', $item->attributes->productId)->first();
                //dd($item->quantity);
                $productAttribute = ProductAttribute::where('product_id', $item->attributes->productId)->where('value', $item->attributes->size)->decrement('quantity', $item->quantity);

                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum(),
                    'attribute'     =>  $item->attributes->size
                ]);

                $order->items()->save($orderItem);
            }

            if($order->payment_method == 'mpesa'){
                //dd('mpesa');
                $response = STK::push($order->grand_total, $order->phone_number, 'Some Reference', 'Test Payment');
            }

        }
            //dd('finished');
        return $order;
    }

    public function updateDb()
    {

    }

    public function listOrders(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }

    public function updateOrderStatus(array $params)
    {
        $order = $this->findOrderByNumber($params['id']);
        //dd($order);
        //continue to update the record

        $collection = collect($params)->except('_token', 'id');
        //dd($collection);

        $order->update($collection->all());

        return $order;
    }

    public function findUserByOrderId($id)
    {
        $order = $this->findOrderByNumber($id);
        $userid = $order->only('user_id');
        return $userid; 
    }

    public function getDiscount()
    {

    }

    public function findOrderById($orderNumber)
    {
        return Order::where('id', $orderNumber)->first();
    }
}