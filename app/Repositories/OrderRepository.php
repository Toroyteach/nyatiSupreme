<?php

namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use App\Models\User;
use App\Models\UserAddress;

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

        dd(Cart::getContent());

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
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  null,
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $params['address'], //decide here about which address delivery to use
                'city'              =>  $params['city'],
                'country'           =>  $params['county'],
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  $params['phone_number'],
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
                'item_count'        =>  Cart::getTotalQuantity(),
                'payment_status'    =>  0,
                'payment_method'    =>  null,
                'first_name'        =>  $params['first_name'],
                'last_name'         =>  $params['last_name'],
                'address'           =>  $shippingAddress[0]->address, //decide here about which address delivery to use
                'city'              =>  $shippingAddress[0]->city,
                'country'           =>  $shippingAddress[0]->county,
                'post_code'         =>  $params['post_code'],
                'phone_number'      =>  $params['phone_number'],
                'notes'             =>  $params['notes']
            ]);

        }


        if ($order) {

            $items = Cart::getContent();


            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('name', $item->name)->first();

                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
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

    public function getDiscount()
    {

    }

    public function findOrderById($orderNumber)
    {
        return Order::where('id', $orderNumber)->first();
    }
}