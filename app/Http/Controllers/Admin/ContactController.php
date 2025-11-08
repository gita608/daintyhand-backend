<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->has('is_read')) {
            $query->where('is_read', $request->is_read);
        }

        $perPage = $request->get('per_page', 15);
        $messages = $query->orderBy('created_at', 'desc')->paginate($perPage);

        if ($request->expectsJson()) {
            return $this->successResponse($messages);
        }

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contact-messages.show', compact('message'));
    }

    public function markAsRead(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        if ($request->expectsJson()) {
            return $this->successResponse($message, 'Message marked as read');
        }

        return redirect()->route('admin.contact-messages.show', $id)->with('success', 'Message marked as read');
    }
}
