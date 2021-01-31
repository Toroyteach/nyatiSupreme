<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Auth;

class SocialLoginDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->phonenumber != null && Auth::user()->country != null && Auth::user()->city != null && Auth::user()->address != null){

            return $next($request);
        }
        // Redirect the user to the loginpage
        return redirect('/account/settings')->with('message', 'You need to update your user details before going forward!');    
    }
}
