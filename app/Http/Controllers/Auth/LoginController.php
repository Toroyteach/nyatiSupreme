<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    //use Socialite;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function github()
    {
            //sends users request to github auth
            return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        $user = Socialite::driver('github')->user();
        //dd($user);
        
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'first_name' => $user->name,
            'last_name' => $user->nickname,
            'password' => Hash::make(Str::random(24)),
            'email' => $user->email,
            'profile_image' => $user->avatar
        ]);

        Auth::login($user, true);

        return redirect('/home');

    }

    public function facebook()
    {
            //sends users request to facebook auth
            return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
        
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'first_name' => $user->name,
            'last_name' => $user->nickname,
            'password' => Hash::make(Str::random(24)),
            'email' => $user->email,
            'profile_image' => $user->avatar
        ]);

        Auth::login($user, true);

        return redirect('/home');

    }

    public function google()
    {
            //sends users request to google auth
            return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
        
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'first_name' => $user->name,
            'last_name' => $user->nickname,
            'password' => Hash::make(Str::random(24)),
            'email' => $user->email,
            'profile_image' => $user->avatar
        ]);

        Auth::login($user, true);

        return redirect('/home');

    }
}
