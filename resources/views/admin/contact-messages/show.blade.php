@extends('admin.layout')

@section('title', 'Contact Message')
@section('page-title', 'Contact Message')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-primary">← Back to Messages</a>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Contact Information</h2>
        <div class="info-row"><strong>Name:</strong> {{ $message->name }}</div>
        <div class="info-row"><strong>Email:</strong> {{ $message->email }}</div>
        <div class="info-row"><strong>Subject:</strong> {{ $message->subject }}</div>
        <div class="info-row"><strong>Date:</strong> {{ $message->created_at->format('M d, Y H:i') }}</div>
        <div class="info-row"><strong>Read:</strong> {{ $message->is_read ? 'Yes' : 'No' }}</div>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Message</h2>
        <p style="white-space: pre-wrap; line-height: 1.6;">{{ $message->message }}</p>
    </div>

    @if(!$message->is_read)
        <div class="card">
            <form method="POST" action="{{ route('admin.contact-messages.markAsRead', $message->id) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Mark as Read</button>
            </form>
        </div>
    @endif
@endsection
