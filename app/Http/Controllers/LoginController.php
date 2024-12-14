<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Fungsi untuk registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
        ]);

        return redirect()->route('eccomerce.register.view')->with('success', 'Registration successful');
    }


    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi data input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Periksa kredensial login
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan status login ke session
            session(['logged_in' => true, 'user_name' => $user->name]);
            return redirect()->back()->with('success', 'Login successful');
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }

    // Fungsi untuk logout
    public function logout()
    {
        session()->forget(['logged_in', 'user_name']);
        return redirect()->back()->with('success', 'Logged out successfully');
    }
}
