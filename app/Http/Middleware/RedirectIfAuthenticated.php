<?php

namespace Fagfolk\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
    	switch ($guard) {
			case 'company':
				if (Auth::guard($guard)->check()) {
					return redirect()->route('company.dashboard');
				}
				break;
				
			default:
				if (Auth::guard($guard)->check()) {
					return redirect()->route('user.dashboard');
				}
				break;
      }
        return $next($request);
    }
}
