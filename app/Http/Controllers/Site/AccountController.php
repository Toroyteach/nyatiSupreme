<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Auth;
use DB;

class AccountController extends Controller
{
    use uploadAble;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function getOrders()
    {
        $userid = auth()->user()->id;
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->with('items')->paginate(3);
        //$orders = Order::where('user_id', auth()->user()->id)->with('items')->get();

        return view('frontend.pages.account.orders', compact('orders'));
    }

    public function getWishlist()
    {
        $wishlists = auth()->user()->wishlist();

        return view('frontend.pages.account.wishlist', compact('wishlists'));
    }

    public function getDashboardDetails()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(4)->get();
        $completeOrders = Order::where('user_id', auth()->user()->id)->where('status', 'completed')->count();
        $pendingOrders = Order::where('user_id', auth()->user()->id)->where('status', '!=', 'completed')->count();
        $orderscount = auth()->user()->orders()->count();
        $wishlistcount = auth()->user()->wishlist()->count();
        $user = auth()->user();
        //dd($orders);

        return view('frontend.pages.account.profile', compact('orderscount', 'wishlistcount', 'orders', 'user', 'completeOrders', 'pendingOrders'));
    }

    public function getAddress()
    {
        $addresss = UserAddress::where('user_id', auth()->user()->id)->get();

        return view('frontend.pages.account.address', compact('addresss'));
    }

    public function getUserDetails()
    {
        $userDetails = auth()->user();

        return view('frontend.pages.account.settings', compact('userDetails'));
    }

    public function updateUserDetails(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'address' => 'required|max:55',
            'city' => 'required|max:55',
            'country' => 'required|max:55',
            'phonenumber' => ['required', 'digits:10']
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $input = $request->all();

        if ($request->has('profile_image')) {

            $this->validate($request, [
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('last_name')).'_'.time();
            // Define folder path
            $folder = 'uploads/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public_uploads', $name);
            // Set user profile image path in database to filePath
            //$user->profile_image = $filePath;
            $request->profile_image = $filePath;
            //dd($filePath);
            $input['profile_image'] = $filePath;
            //dd($input);
        }

        $user->fill($input)->save();
        //get filestoreage properties
        return redirect()->back()->with('success', 'Your user data was updated successfully!');
    }

    public function storeAddress(Request $request)
    {
        $this->validate($request, [
            'county' => 'required|max:50',
            'city' => 'required|max:50',
            'town' => 'required|max:50',
            'location' => 'required|max:50'
        ]);

        //dd($request->all());

        $user = UserAddress::create([
            'fullname' => auth()->user()->getFullNameAttribute(),
            'address' => auth()->user()->address,
            'city' => $request['city'],
            'phonenumber' => auth()->user()->phonenumber,
            'user_id' => auth()->user()->id,
            'town' => $request['town'],
            'location' => $request['location'],
            'county' => $request['county'],
        ]);

        if(!$user)
        {
            //return view('frontend.pages.account.address')->with('success', 'Your address was added successfully!');
            dd('error');
        }

        return redirect()->back()->with('success', 'Your address was added successfully!');
    }

    public function editAddress($id)
    {
        $address = UserAddress::find($id);
        //dd($address->fullname);
        
        return view('frontend.pages.account.address.edit', compact('address'));
    }

    public function updateAddress(Request $request, $id)
    {
        $this->validate($request, [
            'county' => 'required|max:50',
            'city' => 'required|max:50',
            'town' => 'required|max:50',
            'location' => 'required|max:50'
        ]);

        $address = UserAddress::find($id)->update($request->all());

        return redirect('/account/address')->with('success', 'Address updated successfully!');
    }

    public function deleteAddress($id)
    {

        //dd($id);
        UserAddress::find($id)->delete();
        return redirect()->back()->with('success', 'Your address was deleted successfully!');
    }

    public function makeAddressDefault($id)
    {
        //dd($id);
        $activeAddresss = UserAddress::where('default_address', 1)->where('user_id', auth()->user()->id)->first();

        if($activeAddresss != null){
            
            //dd($activeAddresss->toArray());

            $setAddressData0 = array([
                'default_address' => 0
            ]);
            $activeAddresss->update(['default_address' => 0]);
        }

        $setAddressData1 = array([
            'default_address' => 1
        ]);

        $changed = UserAddress::whereId($id)->update(['default_address' => 1]);

        //dd($changed);
        return redirect()->back()->with('success', 'New Shipping Address set successfully!');
    }

    public function clearAddressDefault()
    {
        $activeAddresss = UserAddress::where('default_address', 1)->where('user_id', auth()->user()->id)->first();
        if($activeAddresss != null)
        {
            $activeAddresss->update(['default_address' => 0]);
            return redirect()->back()->with('success', 'Shipping Address removed successfully!');
        }
        
        return redirect()->back();

    }

    public function regenerateToken()
    {
        //dd('here');
        \UserVerification::generate(Auth::user());
        \UserVerification::send(Auth::user(), 'Account Verification Link');

        return redirect()->back();

    }

    public function deleteUserAccount($id)
    {
        //DB::delete('delete from users where id = ?',[$id]);
        $res = User::where('id',$id)->delete();
        //dd('deleted account');
        return redirect('/home')->with('success', 'Your user Details was removed successfully');

    }
}
