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

        return $this->successResponse($customOrders);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,in_progress,completed,cancelled'],
        ]);

        $customOrder = CustomOrder::findOrFail($id);
        $customOrder->update(['status' => $request->status]);

        return $this->successResponse($customOrder, 'Custom order status updated successfully');
    }
}
