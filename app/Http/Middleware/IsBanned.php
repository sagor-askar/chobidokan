<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_banned == 1) {
            auth()->logout();
            return redirect()->route('signin')->with('error', 'Your account is banned !.');
        }
        return $next($request);
    }
}
