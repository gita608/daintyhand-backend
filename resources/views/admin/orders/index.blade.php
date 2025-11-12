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
        flex-wrap: wrap;
        gap: 10px;
    }
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 18px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Desktop Table View -->
    <div class="table-wrapper">
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
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($orders as $order)
            <div class="mobile-card">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Order #</span>
                    <span class="mobile-card-value">{{ $order->order_number }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Customer</span>
                    <span class="mobile-card-value">{{ $order->user->name }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Total</span>
                    <span class="mobile-card-value">₹{{ number_format($order->total, 2) }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Status</span>
                    <span class="mobile-card-value">
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
                    </span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Payment</span>
                    <span class="mobile-card-value">
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Date</span>
                    <span class="mobile-card-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-edit btn-sm" style="flex: 1;">View</a>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No orders found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $orders;
    @endphp
    @include('admin.partials.pagination')
@endsection
