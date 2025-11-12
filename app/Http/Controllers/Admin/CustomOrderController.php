<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = CustomOrder::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('product_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = $request->get('per_page', 15);
        $customOrders = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        if ($request->expectsJson()) {
            return $this->successResponse($customOrders);
        }

        return view('admin.custom-orders.index', compact('customOrders'));
    }

    public function show($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        return view('admin.custom-orders.show', compact('customOrder'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,in_progress,completed,cancelled'],
        ]);

        $customOrder = CustomOrder::findOrFail($id);
        $customOrder->update(['status' => $request->status]);

        if ($request->expectsJson()) {
            return $this->successResponse($customOrder, 'Custom order status updated successfully');
        }

        return redirect()->route('admin.custom-orders.show', $id)->with('success', 'Custom order status updated successfully');
    }
}
