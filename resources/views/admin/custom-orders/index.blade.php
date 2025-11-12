@extends('admin.layout')

@section('title', 'Custom Orders')
@section('page-title', 'Custom Orders')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.tables')

@section('content')
    @php
        $filterFields = [
            [
                'type' => 'search',
                'name' => 'search',
                'label' => 'Search',
                'placeholder' => 'Search by name, email, product type, or description...'
            ],
            [
                'type' => 'select',
                'name' => 'status',
                'label' => 'Status',
                'options' => [
                    'all' => 'All Statuses',
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled'
                ]
            ],
            [
                'type' => 'date',
                'name' => 'date_from',
                'label' => 'From Date'
            ],
            [
                'type' => 'date',
                'name' => 'date_to',
                'label' => 'To Date'
            ]
        ];
    @endphp
    @include('admin.partials.filters')

    <!-- Desktop Table View -->
    <div class="table-wrapper">
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
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($customOrders as $order)
            <div class="mobile-card">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">ID</span>
                    <span class="mobile-card-value">{{ $order->id }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Name</span>
                    <span class="mobile-card-value">{{ $order->name }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Email</span>
                    <span class="mobile-card-value">{{ $order->email }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Product Type</span>
                    <span class="mobile-card-value">{{ ucfirst(str_replace('-', ' ', $order->product_type)) }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Budget</span>
                    <span class="mobile-card-value">{{ $order->budget }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Status</span>
                    <span class="mobile-card-value">
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
                    </span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Date</span>
                    <span class="mobile-card-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.custom-orders.show', $order->id) }}" class="btn btn-edit btn-sm" style="flex: 1;">View</a>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No custom orders found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $customOrders;
    @endphp
    @include('admin.partials.pagination')
@endsection
