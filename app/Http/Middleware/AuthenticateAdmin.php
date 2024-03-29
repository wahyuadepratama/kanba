<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
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
       if (session('login') !== null) {
         if (session('login')->role_id == 1) {
           return $next($request);
         }else{
           return redirect('/admin-login');
         }
       }
     }
}
