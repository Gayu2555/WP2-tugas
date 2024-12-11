<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login'); // Arahkan ke halaman login jika belum login
        }

        return $next($request);
    }
}
