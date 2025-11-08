@extends('admin.layout')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.cards')
@include('admin.partials.forms')
@include('admin.partials.tables')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">← Back to Orders</a>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Order Information</h2>
        <div class="info-row"><strong>Order Number:</strong> {{ $order->order_number }}</div>
        <div class="info-row"><strong>Customer:</strong> {{ $order->user->name }} ({{ $order->user->email }})</div>
        <div class="info-row"><strong>Status:</strong> 
            @php
                $statusClass = match($order->status) {
                    'pending' => 'badge-pending',
                    'processing' => 'badge-processing',
                    'completed' => 'badge-completed',
                    'cancelled' => 'badge-cancelled',
                    default => 'badge-pending'
                };
            @endphp
            <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="info-row"><strong>Payment Status:</strong> 
            <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                {{ ucfirst($order->payment_status) }}
            </span>
        </div>
        <div class="info-row"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</div>
        <div class="info-row"><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</div>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Order Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px; text-align: right;">
            <p><strong>Subtotal:</strong> ₹{{ number_format($order->subtotal, 2) }}</p>
            <p><strong>Tax:</strong> ₹{{ number_format($order->tax, 2) }}</p>
            <p><strong>Shipping:</strong> ₹{{ number_format($order->shipping, 2) }}</p>
            <p style="font-size: 20px;"><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Shipping Address</h2>
        <div class="info-row"><strong>Name:</strong> {{ $order->shipping_name }}</div>
        <div class="info-row"><strong>Address:</strong> {{ $order->shipping_address }}</div>
        <div class="info-row"><strong>City/State/Pincode:</strong> {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}</div>
        <div class="info-row"><strong>Phone:</strong> {{ $order->shipping_phone }}</div>
        @if($order->notes)
            <div class="info-row" style="margin-top: 10px;"><strong>Notes:</strong> {{ $order->notes }}</div>
        @endif
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">Update Order Status</h2>
        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label>Payment Status</label>
                <select name="payment_status">
                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
@endsection
