<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $thisMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();

        // Optimize queries using single queries where possible
        $paidOrdersQuery = Order::where('payment_status', 'paid');
        
        // Get all counts in parallel using DB queries
        $stats = [
            // Basic Stats
            'total_products' => Product::count(),
            'total_users' => User::where('is_admin', false)->count(),
            'total_orders' => Order::count(),
            'total_revenue' => $paidOrdersQuery->sum('total'),
            
            // Today's Stats
            'today_orders' => Order::whereDate('created_at', $today)->count(),
            'today_revenue' => Order::whereDate('created_at', $today)->where('payment_status', 'paid')->sum('total'),
            
            // Monthly Stats
            'month_orders' => Order::where('created_at', '>=', $thisMonth)->count(),
            'month_revenue' => Order::where('created_at', '>=', $thisMonth)->where('payment_status', 'paid')->sum('total'),
            'last_month_revenue' => Order::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->where('payment_status', 'paid')->sum('total'),
            
            // Order Status Stats (optimized with single query)
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            
            // Payment Stats
            'paid_orders' => $paidOrdersQuery->count(),
            'pending_payments' => Order::where('payment_status', 'pending')->count(),
            
            // Custom Orders
            'total_custom_orders' => CustomOrder::count(),
            'pending_custom_orders' => CustomOrder::where('status', 'pending')->count(),
            'in_progress_custom_orders' => CustomOrder::where('status', 'in_progress')->count(),
            
            // Messages
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            
            // Categories
            'total_categories' => \App\Models\Category::count(),
            
            // Recent Data (with eager loading to prevent N+1)
            'recent_orders' => Order::with('user:id,name')->orderBy('created_at', 'desc')->limit(10)->get(),
            'recent_custom_orders' => CustomOrder::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_messages' => ContactMessage::orderBy('created_at', 'desc')->limit(5)->get(),
            
            // Top Products (optimized with eager loading)
            'top_products' => OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
                ->groupBy('product_id')
                ->orderBy('total_sold', 'desc')
                ->limit(5)
                ->with(['product:id,title,image'])
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
