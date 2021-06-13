<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/testmail', function()
// {
// 	$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
// 	$beautymail->send('emails.lowcountmail', [], function($message)
// 	{
// 		$message
// 			->from('bar@example.com')
// 			->to('foo@example.com', 'John Smith')
// 			->subject('Welcome!');
// 	});

// });

Route::get('/testmpesa', 'Mpesa\STKPushController@testData');

Route::group(['middleware' => ['web']], function () {

Route::get('/', 'HomeController@index')->middleware('web');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/privacypolicy', 'HomeController@privacy')->name('privacypolicy');
Route::post('/contact/store', 'HomeController@storeFeedback')->name('contact.store');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/product/information', 'HomeController@getInformation')->name('product.information');
Route::post('/product/show', 'HomeController@search')->name('product.search');
Route::get('/item/{slug}', 'HomeController@itemShow')->name('item.show');
Route::get('/unavailableitems', 'HomeController@unavailableItems')->name('unavailableitems');
//Route::get('/category/{slug}', 'Site\CategoryController@show')->name('category.show');
Route::get('/category', 'Site\CategoryController@show')->name('category.show');
Route::get('/category/{slug}', 'Site\CategoryController@showProduct')->name('category.show.product');
Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');

Route::get('autocomplete', 'HomeController@autocomplete')->name('autocomplete');

Route::post('/product/add/cart', 'Site\ProductController@addToCart')->name('product.add.cart');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');

});

Route::group(['prefix' => 'requestproducts'], function () {
    Route::get('/', 'Admin\RequestProductController@index')->name('admin.requestproducts.index');
    Route::post('/store', 'Admin\RequestProductController@store')->name('admin.requestproducts.store');
    Route::get('/{item}/show', 'Admin\RequestProductController@show')->name('admin.requestproducts.show');
 });

Route::group(['middleware' => ['auth', 'web', 'isVerified']], function () {
    Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index')->middleware(['emptyCart', 'emptysocialdetails']);
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');
    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/dashboard', 'Site\AccountController@getDashboardDetails')->name('account.dashboard');

    Route::get('account/address', 'Site\AccountController@getAddress')->name('account.address')->middleware(['emptysocialdetails']);
    Route::view('account/address/create', 'frontend.pages.account.address.create')->name('account.address.create');
    Route::post('account/address/store', 'Site\AccountController@storeAddress')->name('account.address.store');
    Route::get('account/address/edit/{id}', 'Site\AccountController@editAddress')->name('account.address.edit');
    Route::post('account/address/update/{id}', 'Site\AccountController@updateAddress')->name('account.address.update');
    Route::get('account/address/delete/{id}', 'Site\AccountController@deleteAddress')->name('account.address.delete');
    Route::get('account/address/default/{id}', 'Site\AccountController@makeAddressDefault')->name('account.address.default');
    Route::get('account/address/clear', 'Site\AccountController@clearAddressDefault')->name('account.address.clear');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');
    Route::get('account/wishlist', 'Site\AccountController@getWishlist')->name('account.wishlist');
    Route::get('account/settings', 'Site\AccountController@getUserDetails')->name('account.settings');

    Route::post('account/user/update', 'Site\AccountController@updateUserDetails')->name('account.users.update');
    Route::get('account/user/delete/{id}', 'Site\AccountController@deleteUserAccount')->name('account.users.delete');

    Route::get('change-password', 'Site\ChangePasswordController@index')->name('update.password');
    Route::post('change-password', 'Site\ChangePasswordController@store')->name('change.password');

    //ajax request
    Route::post('/requestMpesa', 'Site\CheckoutController@requestPaymentAgain');
    Route::post('/requestOrderPaymentConfirmation', 'Site\CheckoutController@requestUpdatePendingPay');

    // Route::group(['prefix' => 'payment'], function () {
    //     Route::get('/donepayment', ['as' => 'paymentsuccess', 'uses'=>'Site\CheckoutController@paymentsuccess']);
    //     Route::get('/paymentconfirmation', ['as' => 'paymentsuccess', 'Site\CheckoutController@paymentconfirmation']);
    // });
});

Route::get('donepayment', ['as' => 'paymentsuccess', 'uses'=>'Site\CheckoutController@paymentsuccess']);

// Route::group(['prefix' => 'payment'], function () {
//     //PESAPAL
//     Route::post('/pesapal', 'CheckoutController@payment')->name('pesapal.deposit');
//     Route::get('/donepayment', ['as' => 'paymentsuccess', 'uses'=>'Site/CheckoutController@paymentsuccess']);
//     Route::get('/paymentconfirmation', ['as' => 'paymentsuccess', 'Site/CheckoutController@paymentconfirmation']);
// });

Auth::routes(['verify' => true]);
require 'admin.php';

Route::get('/home', 'HomeController@index')->middleware('web')->name('home');

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::view('/account/verify','auth.verifyaccount')->name('auth.verify.account');
Route::get('account/verify/email','Site\AccountController@regenerateToken')->name('auth.verify.email');


Route::get('/forgot-password', function () { return view('auth.passwords.email');})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) { return view('auth.passwords.reset', ['token' => $token]); })->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
                
})->middleware('guest')->name('password.update');

//log in with social media routes

Route::get('/sign-in/github', 'Auth\LoginController@github')->name('login.request.github');
Route::get('/sign-in/github/redirect', 'Auth\LoginController@githubRedirect');

Route::get('/sign-in/facebook', 'Auth\LoginController@facebook')->name('login.request.facebook');
Route::get('/sign-in/facebook/redirect', 'Auth\LoginController@facebookRedirect');

Route::get('/sign-in/google', 'Auth\LoginController@google')->name('login.request.google');
Route::get('/sign-in/google/redirect', 'Auth\LoginController@googleRedirect');