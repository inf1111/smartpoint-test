<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

/**
 * Creates session vars for storing data received from users through Registry API
 */
class CreateSessionVars
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
        if (! session()->has('registry'))
        {
            session()->put('registry', []);
        }

        if (! session()->has('inversion'))
        {
            session()->put('inversion', false);
        }

        return $next($request);
    }
}
