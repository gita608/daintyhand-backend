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
    
        <div style="margin-top: 20px;">
            {{ $messages->links() }}
    </div>
@endsection
