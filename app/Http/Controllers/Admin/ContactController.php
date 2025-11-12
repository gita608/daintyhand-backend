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

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Read status filter
        if ($request->filled('is_read') && $request->is_read !== 'all') {
            $query->where('is_read', $request->is_read === 'read');
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = $request->get('per_page', 15);
        $messages = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

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
