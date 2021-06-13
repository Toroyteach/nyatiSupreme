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

        $grandTotal = Cart::getSubTotal() + (float)config('settings.shipping_fee');

        if($shippingAddress->isEmpty())
        {
            //No shipping address is set
            $order = Order::create([
                'order_number'      => strtoupper(uniqid('ORD-', true)),
                'user_id'           => auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  $grandTotal,
                'shipping_fee'      =>  config('settings.shipping_fee'),
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  $params['payment_method'],
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $params['address'], //decide here about which address delivery to use
                'city'              =>  $params['city'],
                'country'           =>  $params['country'],
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  '254'.substr($params['mpesaPhonenumber'], 1),
                'notes'             =>  $params['notes']
            ]);

        } else {

            //shipping address set
            $order = Order::create([
                'order_number'      =>  strtoupper(uniqid('ORD-', true)),
                'user_id'           => auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  $grandTotal,
                'shipping_fee'      =>  config('settings.shipping_fee'),
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  $params['payment_method'],
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $shippingAddress[0]->address, //decide here about which address delivery to use
                'city'              =>  $shippingAddress[0]->city,
                'country'           =>  $shippingAddress[0]->county,
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  '254'.substr($params['mpesaPhonenumber'], 1),
                'notes'             =>  $params['notes']
            ]);

        }



        if ($order) {

            $items = Cart::getContent();


            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                if($item->attributes->size == null){

                    Product::where('id', $item->attributes->productId)->decrement('quantity', $item->quantity);

                }
                
                $product = Product::where('id', $item->attributes->productId)->first();

                //dd($product);
                $productAttribute = ProductAttribute::where('product_id', $item->attributes->productId)->where('value', $item->attributes->size)->decrement('quantity', $item->quantity);

                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum(),
                    'attribute'     =>  ($item->attributes->size == null ? 'None' : $item->attributes->size),
                    'description'   =>  ($item->attributes->description == null ? 'None' : $item->attributes->description)  
                ]);

                $order->items()->save($orderItem);
            }

        }
        return $order;
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

    public function findOrderById($orderNumber)
    {
        return Order::where('id', $orderNumber)->first();
    }
}