<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total');

        return view('admin.dashboard', compact('orders', 'totalOrders', 'totalRevenue'));
    }

    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders', compact('orders'));
    }
}
