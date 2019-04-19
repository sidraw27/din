<?php

namespace App\Http\Middleware;

use Closure;

class Intended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Session::put('url.intended', \URL::current());
        \Session::save();

        return $next($request);
    }
}
