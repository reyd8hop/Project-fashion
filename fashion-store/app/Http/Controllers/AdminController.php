<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'products' => Product::count(),
                'orders' => Order::count(),
                'customers' => User::where('role', 'user')->count(),
                'revenue' => Order::sum('total_price'),
            ],
            'recentOrders' => Order::with('user')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
