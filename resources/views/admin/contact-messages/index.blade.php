@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@include('admin.partials.buttons')
@include('admin.partials.tables')

@push('styles')
    <style>
    .unread {
        font-weight: 600;
    }
    </style>
@endpush

@section('content')
    <!-- Desktop Table View -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Read</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ $message->is_read ? '' : 'unread' }}">
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->is_read ? 'Yes' : 'No' }}</td>
                        <td>{{ $message->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-edit btn-sm">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">No messages found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($messages as $message)
            <div class="mobile-card {{ $message->is_read ? '' : 'unread' }}">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">ID</span>
                    <span class="mobile-card-value">{{ $message->id }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Name</span>
                    <span class="mobile-card-value">{{ $message->name }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Email</span>
                    <span class="mobile-card-value">{{ $message->email }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Subject</span>
                    <span class="mobile-card-value">{{ $message->subject }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Read</span>
                    <span class="mobile-card-value">{{ $message->is_read ? 'Yes' : 'No' }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Date</span>
                    <span class="mobile-card-value">{{ $message->created_at->format('M d, Y') }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-edit btn-sm" style="flex: 1;">View</a>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No messages found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $messages;
    @endphp
    @include('admin.partials.pagination')
@endsection
