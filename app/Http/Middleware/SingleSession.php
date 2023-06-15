<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SingleSession
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

        // single session
        if (auth()->check()) {
            if (auth()->user()->session_id != session()->getId()) {
                auth()->logout();
                return redirect('/login')->withErrors(['error' => 'Akun anda sedang digunakan di perangkat lain']);
            }
            return $next($request);
        }

        return $next($request);


    }
}
