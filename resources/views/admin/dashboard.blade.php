@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        border-left: 4px solid;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }
    .stat-card.primary { border-left-color: #667eea; }
    .stat-card.success { border-left-color: #10b981; }
    .stat-card.warning { border-left-color: #f59e0b; }
    .stat-card.danger { border-left-color: #ef4444; }
    .stat-card.info { border-left-color: #3b82f6; }
    .stat-card.purple { border-left-color: #8b5cf6; }
    .stat-card.orange { border-left-color: #f97316; }
    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .stat-card h3 {
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-icon {
        font-size: 24px;
        opacity: 0.2;
    }
    .stat-card .value {
        font-size: 32px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 5px;
    }
    .stat-card .change {
        font-size: 12px;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .stat-card .change.positive { color: #10b981; }
    .stat-card .change.negative { color: #ef4444; }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    @media (max-width: 1200px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Cards */
    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    .card-header h2 {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
    }
    .card-header a {
        color: #667eea;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }
    .card-header a:hover {
        text-decoration: underline;
    }
    
    /* Tables */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #f3f4f6;
    }
    th {
        background: #f9fafb;
        font-weight: 600;
        color: #6b7280;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    tbody tr {
        transition: background 0.2s;
    }
    tbody tr:hover {
        background: #f9fafb;
    }
    tbody tr:last-child td {
        border-bottom: none;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }
    .badge-processing {
        background: #dbeafe;
        color: #1e40af;
    }
    .badge-completed {
        background: #d1fae5;
        color: #065f46;
    }
    .badge-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
    .badge-paid {
        background: #d1fae5;
        color: #065f46;
    }
    .badge-unpaid {
        background: #fef3c7;
        color: #92400e;
    }
    .badge-unread {
        background: #dbeafe;
        color: #1e40af;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #9ca3af;
    }
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 10px;
        opacity: 0.5;
    }
    
    /* Product List */
    .product-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .product-item:last-child {
        border-bottom: none;
    }
    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }
    .product-info {
        flex: 1;
    }
    .product-name {
        font-weight: 500;
        color: #111827;
        margin-bottom: 4px;
    }
    .product-sold {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Message Item */
    .message-item {
        padding: 15px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .message-item:last-child {
        border-bottom: none;
    }
    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    .message-name {
        font-weight: 600;
        color: #111827;
    }
    .message-email {
        font-size: 12px;
        color: #6b7280;
    }
    .message-subject {
        font-weight: 500;
        color: #374151;
        margin-bottom: 4px;
    }
    .message-date {
        font-size: 12px;
        color: #9ca3af;
    }
    
    a {
        color: #667eea;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
    <!-- Statistics Grid -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-card-header">
                <h3>Total Revenue</h3>
                <span class="stat-icon">💰</span>
            </div>
            <div class="value">₹{{ number_format($stats['total_revenue'], 0) }}</div>
            <div class="change">
                <span>This Month: ₹{{ number_format($stats['month_revenue'], 0) }}</span>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-card-header">
                <h3>Total Orders</h3>
                <span class="stat-icon">📦</span>
            </div>
            <div class="value">{{ number_format($stats['total_orders']) }}</div>
            <div class="change">
                <span>Today: {{ $stats['today_orders'] }} orders</span>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-card-header">
                <h3>Total Products</h3>
                <span class="stat-icon">🛍️</span>
            </div>
            <div class="value">{{ number_format($stats['total_products']) }}</div>
            <div class="change">
                <span>{{ $stats['total_categories'] }} categories</span>
            </div>
        </div>
        
        <div class="stat-card purple">
            <div class="stat-card-header">
                <h3>Total Users</h3>
                <span class="stat-icon">👥</span>
            </div>
            <div class="value">{{ number_format($stats['total_users']) }}</div>
            <div class="change">
                <span>Registered users</span>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-card-header">
                <h3>Pending Orders</h3>
                <span class="stat-icon">⏳</span>
            </div>
            <div class="value">{{ number_format($stats['pending_orders']) }}</div>
            <div class="change">
                <span>Processing: {{ $stats['processing_orders'] }}</span>
            </div>
        </div>
        
        <div class="stat-card orange">
            <div class="stat-card-header">
                <h3>Custom Orders</h3>
                <span class="stat-icon">🎨</span>
            </div>
            <div class="value">{{ number_format($stats['total_custom_orders']) }}</div>
            <div class="change">
                <span>Pending: {{ $stats['pending_custom_orders'] }}</span>
            </div>
        </div>
        
        <div class="stat-card danger">
            <div class="stat-card-header">
                <h3>Unread Messages</h3>
                <span class="stat-icon">💬</span>
            </div>
            <div class="value">{{ number_format($stats['unread_messages']) }}</div>
            <div class="change">
                <span>Total: {{ $stats['total_messages'] }} messages</span>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-card-header">
                <h3>Today's Revenue</h3>
                <span class="stat-icon">📈</span>
            </div>
            <div class="value">₹{{ number_format($stats['today_revenue'], 0) }}</div>
            <div class="change">
                <span>This Month: ₹{{ number_format($stats['month_revenue'], 0) }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header">
                <h2>📦 Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}">View All →</a>
            </div>
            @if($stats['recent_orders']->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_orders'] as $order)
                            <tr>
                                <td><a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
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
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <p>No orders yet</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Order Status Summary -->
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">
                    <h2>📊 Order Status</h2>
                </div>
                <div style="padding: 10px 0;">
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span>Pending</span>
                        <strong>{{ $stats['pending_orders'] }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span>Processing</span>
                        <strong>{{ $stats['processing_orders'] }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span>Completed</span>
                        <strong>{{ $stats['completed_orders'] }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span>Cancelled</span>
                        <strong>{{ $stats['cancelled_orders'] }}</strong>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">
                    <h2>⭐ Top Products</h2>
                </div>
                @if($stats['top_products']->count() > 0)
                    <div>
                        @foreach($stats['top_products'] as $item)
                            <div class="product-item">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->title }}" class="product-image">
                                @else
                                    <div class="product-image" style="background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af;">📦</div>
                                @endif
                                <div class="product-info">
                                    <div class="product-name">{{ $item->product->title ?? 'N/A' }}</div>
                                    <div class="product-sold">{{ $item->total_sold }} sold</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📦</div>
                        <p>No sales data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bottom Grid -->
    <div class="content-grid">
        <!-- Recent Custom Orders -->
        <div class="card">
            <div class="card-header">
                <h2>🎨 Recent Custom Orders</h2>
                <a href="{{ route('admin.custom-orders.index') }}">View All →</a>
            </div>
            @if($stats['recent_custom_orders']->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Product Type</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_custom_orders'] as $customOrder)
                            <tr>
                                <td><a href="{{ route('admin.custom-orders.show', $customOrder->id) }}">{{ $customOrder->name }}</a></td>
                                <td>{{ ucfirst(str_replace('-', ' ', $customOrder->product_type)) }}</td>
                                <td>
                                    @php
                                        $customStatusClass = match($customOrder->status) {
                                            'pending' => 'badge-pending',
                                            'in_progress' => 'badge-processing',
                                            'completed' => 'badge-completed',
                                            'cancelled' => 'badge-cancelled',
                                            default => 'badge-pending'
                                        };
                                    @endphp
                                    <span class="badge {{ $customStatusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $customOrder->status)) }}
                                    </span>
                                </td>
                                <td>{{ $customOrder->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🎨</div>
                    <p>No custom orders yet</p>
                </div>
            @endif
        </div>

        <!-- Recent Messages -->
        <div class="card">
            <div class="card-header">
                <h2>💬 Recent Messages</h2>
                <a href="{{ route('admin.contact-messages.index') }}">View All →</a>
            </div>
            @if($stats['recent_messages']->count() > 0)
                <div>
                    @foreach($stats['recent_messages'] as $message)
                        <div class="message-item">
                            <div class="message-header">
                                <div>
                                    <div class="message-name">{{ $message->name }}</div>
                                    <div class="message-email">{{ $message->email }}</div>
                                </div>
                                @if(!$message->is_read)
                                    <span class="badge badge-unread">New</span>
                                @endif
                            </div>
                            <div class="message-subject">{{ $message->subject }}</div>
                            <div class="message-date">{{ $message->created_at->format('M d, Y H:i') }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">💬</div>
                    <p>No messages yet</p>
                </div>
            @endif
        </div>
    </div>
@endsection
