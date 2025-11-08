@extends('admin.layout')

@section('title', 'Custom Orders')
@section('page-title', 'Custom Orders')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.tables')

@section('content')
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Product Type</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                    <td>{{ ucfirst(str_replace('-', ' ', $order->product_type)) }}</td>
                        <td>{{ $order->budget }}</td>
                    <td>
                        @php
                            $statusClass = match($order->status) {
                                'pending' => 'badge-pending',
                                'in_progress' => 'badge-in_progress',
                                'completed' => 'badge-completed',
                                'cancelled' => 'badge-cancelled',
                                default => 'badge-pending'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                    </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.custom-orders.show', $order->id) }}" class="btn btn-edit btn-sm">View</a>
                    </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 30px;">No custom orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    
        <div style="margin-top: 20px;">
            {{ $customOrders->links() }}
    </div>
@endsection
