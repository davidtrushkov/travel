<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next)
    {
        // Handle Logic of Authenticated User Here.
        $username = $request->route()->parameters()["username"];
        if(Auth::check() && Auth::user()->username != $username) {
            return redirect('/');
        }

        return $next($request);
    }
}