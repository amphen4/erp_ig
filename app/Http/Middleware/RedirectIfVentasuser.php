<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfVentasuser
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'ventasuser')
	{
	    if (Auth::guard($guard)->check()) {
	        return redirect('ventasuser/home');
	    }

	    return $next($request);
	}
}