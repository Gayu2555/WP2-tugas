<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Contoh data statis, Anda bisa menggantinya dengan data dari database
        $data = [
            'clientsAdded' => 197,
            'contractsSigned' => 745,
            'invoicesSent' => 512,
            'receivedAmount' => 45070.00,
            'dueAmount' => 32400.00,
            'deviceUsage' => [
                'mobile' => 10,
                'tablet' => 20,
                'desktop' => 70,
            ],
        ];

        return view('dashboard', compact('data'));
    }
}
