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

Route::view('/', 'site.pages.homepage');
Route::get('/category/{slug}', 'Site\CategoryController@show')->name('category.show');
Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');

Route::post('/product/add/cart', 'Site\ProductController@addToCart')->name('product.add.cart');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');
    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/dashboard', 'Site\AccountController@getDashboardDetails')->name('account.dashboard');

    Route::get('account/address', 'Site\AccountController@getAddress')->name('account.address');
    Route::view('account/address/create', 'frontend.pages.account.address.create')->name('account.address.create');
    Route::post('account/address/store', 'Site\AccountController@storeAddress')->name('account.address.store');
    Route::get('account/address/edit/{id}', 'Site\AccountController@editAddress')->name('account.address.edit');
    Route::post('account/address/update/{id}', 'Site\AccountController@updateAddress')->name('account.address.update');
    Route::get('account/address/delete/{id}', 'Site\AccountController@deleteAddress')->name('account.address.delete');
    Route::get('account/address/default/{id}', 'Site\AccountController@makeAddressDefault')->name('account.address.default');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');
    Route::get('account/wishlist', 'Site\AccountController@getWishlist')->name('account.wishlist');
    Route::get('account/settings', 'Site\AccountController@getUserDetails')->name('account.settings');

    Route::post('account/user/update', 'Site\AccountController@updateUserDetails')->name('account.users.update');

    Route::get('change-password', 'Site\ChangePasswordController@index')->name('update.password');
    Route::post('change-password', 'Site\ChangePasswordController@store')->name('change.password');
});

Auth::routes(['verify' => true]);
require 'admin.php';

Route::get('/home', 'HomeController@index')->name('home');

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

