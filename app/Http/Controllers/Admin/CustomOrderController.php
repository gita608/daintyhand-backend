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

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $perPage = $request->get('per_page', 15);
        $customOrders = $query->orderBy('created_at', 'desc')->paginate($perPage);

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
