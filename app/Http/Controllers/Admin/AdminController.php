<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Charts\SampleChart;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        //dd('dieded');
        // Role::Create(['name'=>'Admin']);
        // Role::Create(['name'=>'SubAdmin']);
        

        // $permissions = [
        //     'role-create',
        //     'user-list',
        //     'user-create',
        //     'user-edit',
        //     'product-list',
        //     'product-create',
        //     'product-edit',
        //     ];
    
            // foreach ($permissions as $permission) {
            //     Permission::create(['name' => $permission]);
            // }


        //auth()->user()->givePermissionTo('role-list');
        //auth()->user()->assignRole('Admin');
        //return auth()->user()->permissions;

        // $permission = Permission::findById(10);
        // $role = Role::findById(3);
        // $role->givePermissionTo($permission);

        //$permission = Permission::findById(10);
        //     $role = Role::findById(4);

        // foreach ($permissions as $permission) {
        //     $role->givePermissionTo($permission);
        //          }

        $data = Admin::orderBy('id','DESC')->paginate(5);
        return view('admin.usersrole.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function viewCustomers(Request $request){
        $customer = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.customers.index',compact('customer'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function showCustomers($id){
        $customers = User::findOrFail($id);
        return view('admin.customers.show',compact('customers'));
    }

    //private $productArrayData = array();
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

        $chart = new SampleChart;

        $userCount = User::count();
        $pendingOrders = Order::where('status','pending')->count();
        $completedOrders = Order::where('status','completed')->count();

        $data = array(
            "chart" => array(
                "labels" => ["First", "Second", "Third"]
            ),
            "datasets" => array(
                array("name" => "Sample 1", "values" => array(10, 3, 7)),
                array("name" => "Sample 2", "values" => array(1, 6, 2)),
            )
        );

        // $groups = DB::table('users')
        // ->select('age', DB::raw('count(*) as total'))
        // ->groupBy('age')
        // ->pluck('total', 'age')->all();
        // // Generate random colours for the groups
        // for ($i=0; $i<=count($groups); $i++) {
        //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        // }
        // // Prepare the data for returning with the view
        // $chart = new Chart;
        // $chart->labels = (array_keys($groups));
        // $chart->dataset = (array_values($groups));
        // $chart->colours = $colours;
        return view('admin.dashboard.index', compact('userCount', 'pendingOrders', 'completedOrders', 'data'));
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
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.usersrole.create',compact('roles'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('admin.usersrole.index')->with('success','User created successfully');
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $user = Admin::find($id);
        return view('admin.usersrole.show',compact('user'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.usersrole.edit',compact('user','roles','userRole'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
        $input = array_except($input,array('password'));
        }
        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('admin.usersrole.index')->with('success','User updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.usersrole.index')
        ->with('success','User deleted successfully');
    }

    public function vueTable(Request $request)
    {
        $orders = Order::get();
        return response()->json($orders);
         
    }
}