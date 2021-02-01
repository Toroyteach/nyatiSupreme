<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class IsVerified
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
        if(! is_null($request->user()) && ! $request->user()->verified) {
            //Session::flush();
            return redirect()->route('auth.verify.account');

            //dd('here');
            //throw new UserNotVerifiedException;
        }

        return $next($request);
    }
}
