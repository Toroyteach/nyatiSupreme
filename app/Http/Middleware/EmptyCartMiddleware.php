<?php

namespace App\Http\Middleware;

use Closure;
use Cart;

class EmptyCartMiddleware
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

        if(!Cart::isEmpty()){

            return $next($request);
        }
        // Redirect the user to the loginpage
        return redirect('/cart');

        //return $next($request);
    }
}
