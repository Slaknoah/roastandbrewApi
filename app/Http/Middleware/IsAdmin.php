<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * Any user with authorization other than admin
         * will receive a 403 authorization error.
         */
        if ( Auth::user()->permission != 'admin' ) {
            abort( 403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
