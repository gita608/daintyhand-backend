<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use App\Traits\ApiResponse;

class ContactController extends Controller
{
    use ApiResponse;

    public function store(StoreContactRequest $request)
    {
        $contactMessage = ContactMessage::create($request->validated());

        return $this->successResponse([
            'id' => $contactMessage->id,
            'name' => $contactMessage->name,
            'email' => $contactMessage->email,
            'created_at' => $contactMessage->created_at,
        ], 'Message sent successfully', 201);
    }
}
