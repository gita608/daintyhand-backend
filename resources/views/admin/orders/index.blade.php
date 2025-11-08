@extends('admin.layout')

@section('title', 'Orders')
@section('page-title', 'Orders')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.tables')

@push('styles')
    <style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    </style>
@endpush

@section('content')
        <table>
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>₹{{ number_format($order->total, 2) }}</td>
                    <td>
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
                    </td>
                    <td>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-edit btn-sm">View</a>
                    </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px;">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    
        <div style="margin-top: 20px;">
            {{ $orders->links() }}
    </div>
@endsection
