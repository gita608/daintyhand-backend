<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomOrderRequest;
use App\Models\CustomOrder;
use App\Traits\ApiResponse;

class CustomOrderController extends Controller
{
    use ApiResponse;

    public function store(StoreCustomOrderRequest $request)
    {
        $customOrder = CustomOrder::create($request->validated());

        return $this->successResponse([
            'id' => $customOrder->id,
            'name' => $customOrder->name,
            'email' => $customOrder->email,
            'status' => $customOrder->status,
            'created_at' => $customOrder->created_at,
        ], 'Custom order submitted successfully', 201);
    }
}
