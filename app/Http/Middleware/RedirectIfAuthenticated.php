<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      if (session('login') !== null) {
        switch (session('login')->role_id) {
          case 1:
            return redirect('/admin/home');
            break;
          case 2:
            return redirect('/coach');
            break;
        }
      }

      return $next($request);
    }
}
