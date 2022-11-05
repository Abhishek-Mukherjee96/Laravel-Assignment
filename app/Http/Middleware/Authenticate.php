<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::check() && Auth::user()->u_type == 'seller') {
            return route('seller-dashboard');
        }
        elseif(Auth::check() && Auth::user()->u_type == 'buyer'){
            return route('buyer-dashboard');
        }
        else{
            return route('login_form');
        }
    }
}
