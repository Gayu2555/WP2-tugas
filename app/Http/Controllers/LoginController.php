<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('ecommerce.register'); // Pastikan file view register ada di folder ini
    }

    // Fungsi untuk login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login.view')
                ->withErrors($validator)
                ->withInput();
        }

        // Proses autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Login berhasil
            return redirect()->intended('/dashboard');  // Atur ke halaman yang sesuai
        }

        // Jika login gagal
        return redirect()->route('login.view')
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.view');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
        ]);

        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'alamat' => $validatedData['alamat'],
            'provinsi' => $validatedData['provinsi'],
            'kabupaten' => $validatedData['kabupaten'],
            'kecamatan' => $validatedData['kecamatan'],
            'desa' => $validatedData['desa'],
        ]);

        if (!$user) {
            return back()->with('error', 'Terjadi kesalahan saat membuat pengguna.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang di halaman utama.');
    }
}
