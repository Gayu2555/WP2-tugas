<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Autentikasi sederhana
        if ($request->username === 'SuperAdmin' && $request->password === 'SuperAdmin251005') {
            $request->session()->put('user', 'SuperAdmin');
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Username atau Password salah.']);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', 'Logout berhasil!');
    }

    // Cek status sesi (untuk AJAX auto-refresh)
    public function checkSession(Request $request)
    {
        return response()->json([
            'isLoggedIn' => $request->session()->has('user'),
        ]);
    }
}
