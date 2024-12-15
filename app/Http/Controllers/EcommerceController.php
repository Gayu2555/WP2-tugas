<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EcommerceController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Eager loading relasi category
        $categories = Category::all();

        return view('ecommerce.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

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
}
