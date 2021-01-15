<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use DB;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Charts\SampleChart; //old chart
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Mydnic\Kustomer\Feedback;
use Illuminate\Support\Facades\Storage;
use App\Events\LowCount;

class AdminController extends Controller
{

    public function showdashboard()
    {
        // $products = Product::all();
        // //$productArrayData = [];
        // $productArrayData = array();

        // foreach ($products as $product)
        //  {
        //     $productArrayData[$product['id']] = $product->only('quantity');
        //  }

        //  $dotArrayData = Arr::dot($productArrayData);
        //  dd($dotArrayData);

        //  $filtered = Arr::where($dotArrayData, function ($value, $key) {
        //     return $value<50;
        // });

        // $filtered = array_keys($filtered);

        // $lowProductArray = $this->getProductName($filtered);
        // dd($lowProductArray);

        // Product::select(*)->whereNotIn('book_price', [100,200])->get();
        // DB::table(..)->select(..)->whereNotIn('book_price', [100,200])->get();
        // SELECT p.id FROM products p where p.id NOT IN( SELECT a.product_id FROM product_attributes a)
        $lowProductArrayData = array();


        $productsWithoutAttributes = DB::table("products")
        ->select('id', 'name', 'quantity')
        ->whereNotIn('id',function($query) {

            $query->select('product_id')->from('product_attributes');
         
         })->whereRaw('low_quantity_count > quantity')->get();

        dd($productsWithoutAttributes->toArray());
         
        $productswithAttributes = DB::table("product_attributes")
            ->select('product_id','value','name','product_attributes.quantity')
            ->join('products', 'product_attributes.product_id', '=', 'products.id')
            ->whereRaw('product_attributes.low_attribute_quantity_count > product_attributes.quantity')
            ->get();
         
         
        //  $productswithAttributes = ProductAttribute::select('product_id','value','name')
        //  ->join('products', 'product_attributes.product_id', '=', 'products.id')
        //  ->where('product_attributes.low_attribute_quantity_count', '>', 'product_attributes.quantity')
        //  ->get();

         //dd($productswithAttributes->toArray());

         //dd($productsWithoutAttributes);

         //$lowProductArrayData = Arr::only($productsWithoutAttributes->toArray(), 'id');

         array_push($lowProductArrayData, [$productswithAttributes->toArray(), $productsWithoutAttributes->toArray()]);

         //dd($lowProductArrayData);
         //$collapsed = Arr::flatten($lowProductArrayData);
         dd($lowProductArrayData);
         //event(new LowCount($lowProductArrayData));
         //dd('sent');


        $chartjs = $this->getGraphData('DailySalesLineGraph');
        $chartjs2 = $this->getGraphData('TopSellerBarGraph');

        $userCount = User::count();
        $pendingOrders = Order::where('status','pending')->count();
        $completedOrders = Order::where('status','completed')->count();

        $topOrders = Order::orderBy('id', 'desc')->take(3)->get();
        $topCustomers = $this->getTopCustomers();


        return view('admin.dashboard.index', compact('userCount', 'pendingOrders', 'completedOrders', 'chartjs', 'chartjs2', 'topOrders', 'topCustomers'));
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function viewCustomers(Request $request){
        $customer = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.customers.index',compact('customer'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function showCustomers($id){
        $customers = User::findOrFail($id);
        return view('admin.customers.show',compact('customers'));
    }

    public function getFeedback()
    {
        //list all feedback
        $feedbacks = Feedback::all();
        $pageTitle = 'Customer Feedback';

      return view('admin.feedback.index', compact('pageTitle', 'feedbacks'));  
    } 

    public function showFeedback(Feedback $feedback)
    {
        //show specific feedback
        $feedback->screenshot = (isset($feedback->user_info['screenshot']) and !is_null($feedback->user_info['screenshot']))
            ? Storage::url($feedback->user_info['screenshot'])
            : null;
            $pageTitle = 'Customer Feedback';
            //dd($feedback);

        return view('admin.feedback.show', compact('pageTitle', 'feedback'));
    }

    public function markAsReviewed(Feedback $feedback)
    {
        //mark as reviewd
        $feedback->reviewed = true;
        $feedback->save();

        return redirect()->back()->with('Feedback Updated successfully' ,'message',false, false);
    }

    public function getGraphData($nameModel)
    {

        //dd($sales->pluck('total'));

            switch ($nameModel) {
            case "DailySalesLineGraph":

                $dataArrayDailySales = $this->getDatabaseDailySales();
                //$dataArrayDailySales = array(65, 59, 65, 59, 80, 81, 56);
                $labelArrayDailySales = $this->getWeekdays();

                $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labelArrayDailySales)
                ->datasets([
                    [
                        "label" => "Daily sales of week",
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $dataArrayDailySales,
                    ],
                ])
                ->options([]);

                return $chartjs;
                break;
            case "TopSellerBarGraph":

                $sales = DB::table('order_items')
                ->select('product_id', DB::raw('count(*) as total'))
                ->groupBy('product_id')
                ->get(6);
                
        
                $labelArrayTopSellers = $this->getDatabaseTopSellerName($sales->pluck('product_id')->toArray());
                $dataArrayTopSellers = $sales->pluck('total');
                $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labelArrayTopSellers)
                ->datasets([
                    [
                        "label" => "High Selling products",
                        'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                        'data' => $dataArrayTopSellers
                    ],
                ])
                ->options([]);
                return $chartjs;
                break;
            default:
                echo "No Graph type Selected";
            }
    }

    public function getTopCustomers()
    {
        //$user = array();

        // $sales = DB::table('orders') //use sales of each
        // ->select('user_id', DB::raw('SUM(grand_total) as revenue'))
        // ->where('created_at', '=', '2021-01-05')
        // ->groupBy('user_id')
        // ->get();

        // $testData = Order::whereDate('created_at', '2021-01-05')
        //        ->sum('grand_total');

        $topCustomersList =  DB::table('orders')
                 ->select('users.id', 'users.first_name', DB::raw('sum(grand_total) as revenue'))
                 //->join('users', 'users.id', '=', 'orders.user_id')
                 ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                 ->groupBy('users.id','users.first_name')
                 ->get(3);

        //$results = DB::select( DB::raw("SELECT user_id, SUM(grand_total) AS Revenue FROM orders WHERE created_at= '2021-01-05' GROUP BY user_id") );
        //dd($topCustomersList);

        //dd($sales->pluck('userOrders', 'user_id')->toArray());

        return $topCustomersList;
        //dd($user);
    }

    public function getDatabaseTopSellerName($nameArray)
    {
            $names = array();

            for ($x = 0; $x < count($nameArray); $x++) {
                $names[$x] = DB::table('products')->where('id', $nameArray[$x])->value('name');
                //array_push($names, DB::table('products')->where('id', $nameArray[$x])->value('name'));
              }
              return $names;
    }

    public function getDatabaseDailySales()
    {
        $timestamp = strtotime('-5 days');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%F', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        $names = array();

        $date = Carbon::now()->toDateString();
        //dd($days);

        for ($x = 0; $x < count($days); $x++) {
            $names[] = OrderItem::whereDate('created_at', $days[$x])->sum('price');
          }

          return $names;
    }

    public function getWeekdays()
    {
        $timestamp = strtotime('-5 days');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        return $days;
    }

    public function getProductName($arrayData)
    {
        $productNameArray = array();

        for ($i = 0; $i < count($arrayData); ++$i) {

            array_push($productNameArray, DB::table('products')->where('id', trim($arrayData[$i], '.quantity'))->value('name'));
        }

        return $productNameArray;
    }

    public function compareProductCount()
    {
        
    }

    public function showNotification()
    {
        $notifications = Auth::user()->unreadNotifications;
        
        return view('admin.dashboard.notification', compact('notifications'));
    }

    public function markNotification(Request $request)
    {

        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })->markAsRead();

        return response()->noContent();
    }

    public function getOrdersData(){
        // get records from database
     
        $arr = Order::orderBy('id', 'desc')->take(3)->get();
        echo json_encode($arr);
        exit;
      }

    public function vueTable(Request $request)
    {
        $orders = Order::get();
        return response()->json($orders);
         
    }
}