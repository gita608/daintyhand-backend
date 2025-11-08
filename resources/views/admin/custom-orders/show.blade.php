@extends('admin.layout')

@section('title', 'Custom Order Details')
@section('page-title', 'Custom Order Details')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-primary">← Back to Custom Orders</a>
    </div>

        <div class="card">
        <h2 style="margin-bottom: 20px;">Customer Information</h2>
            <div class="info-row"><strong>Name:</strong> {{ $customOrder->name }}</div>
            <div class="info-row"><strong>Email:</strong> {{ $customOrder->email }}</div>
            <div class="info-row"><strong>Phone:</strong> {{ $customOrder->phone }}</div>
        </div>

        <div class="card">
        <h2 style="margin-bottom: 20px;">Order Details</h2>
        <div class="info-row"><strong>Product Type:</strong> {{ ucfirst(str_replace('-', ' ', $customOrder->product_type)) }}</div>
            <div class="info-row"><strong>Quantity:</strong> {{ $customOrder->quantity }}</div>
            <div class="info-row"><strong>Budget:</strong> {{ $customOrder->budget }}</div>
            @if($customOrder->event_date)
                <div class="info-row"><strong>Event Date:</strong> {{ $customOrder->event_date->format('M d, Y') }}</div>
            @endif
        <div class="info-row"><strong>Status:</strong> 
            @php
                $statusClass = match($customOrder->status) {
                    'pending' => 'badge-pending',
                    'in_progress' => 'badge-in_progress',
                    'completed' => 'badge-completed',
                    'cancelled' => 'badge-cancelled',
                    default => 'badge-pending'
                };
            @endphp
            <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $customOrder->status)) }}</span>
        </div>
            <div class="info-row"><strong>Date:</strong> {{ $customOrder->created_at->format('M d, Y H:i') }}</div>
        </div>

        <div class="card">
        <h2 style="margin-bottom: 20px;">Description</h2>
        <p style="white-space: pre-wrap; line-height: 1.6;">{{ $customOrder->description }}</p>
        </div>

        @if($customOrder->additional_notes)
            <div class="card">
            <h2 style="margin-bottom: 20px;">Additional Notes</h2>
            <p style="white-space: pre-wrap; line-height: 1.6;">{{ $customOrder->additional_notes }}</p>
            </div>
        @endif

        <div class="card">
        <h2 style="margin-bottom: 20px;">Update Status</h2>
            <form method="POST" action="{{ route('admin.custom-orders.updateStatus', $customOrder->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ $customOrder->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $customOrder->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $customOrder->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $customOrder->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
    </div>
@endsection
