<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyPassword
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs('verysecretpage') && !auth()->validate(['email' => auth()->user()->email, 'password' => $request->input('password')])) {
            return redirect('confirm-password');
        }

        return $next($request);
    }
}
