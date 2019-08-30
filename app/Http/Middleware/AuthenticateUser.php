<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateUser
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
         if (session('login')->role_id == 2) {
           return $next($request);
         }else{
           return redirect('/login/user');
         }
       }
     }
}
