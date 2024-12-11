<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomAuthMiddleware
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
        // Periksa apakah sesi 'user' ada dan nilainya adalah 'SuperAdmin'
        if (!$request->session()->has('user') || $request->session()->get('user') !== 'SuperAdmin') {
            // Catat log jika pengguna tidak berwenang
            Log::warning('Unauthorized access attempt.', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            // Redirect ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors([
                'auth' => 'Unauthorized! Silakan login terlebih dahulu.',
            ]);
        }

        // Izinkan melanjutkan ke rute berikutnya
        return $next($request);
    }
}
