<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $totalProducts = $products->count();
        $totalRevenue = Order::sum('total');

        return view('superadmin.dashboard', compact('products', 'totalProducts', 'totalRevenue'));
    }
}
