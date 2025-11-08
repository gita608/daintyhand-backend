<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_custom_orders' => CustomOrder::where('status', 'pending')->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'recent_orders' => Order::with('user')->orderBy('created_at', 'desc')->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
