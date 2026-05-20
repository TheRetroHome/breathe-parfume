<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'total_products'  => Product::count(),
            'total_users'     => User::where('is_admin', false)->count(),
            'total_revenue'   => Order::whereIn('status', ['confirmed', 'shipped', 'delivered'])->sum('total'),
            'pending_reviews' => Review::where('is_approved', false)->count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(10)
            ->get();

        $topProducts = Product::orderByDesc('orders_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}
