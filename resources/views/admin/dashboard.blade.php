@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
    @push('styles')
    <style>
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--bg-surface);
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Icon Colors */
        .icon-primary { background: var(--primary-light); color: var(--primary); }
        .icon-success { background: #ecfdf5; color: var(--success); }
        .icon-warning { background: #fffbeb; color: var(--warning); }
        .icon-danger { background: #fef2f2; color: var(--danger); }
        .icon-purple { background: #f3e8ff; color: #9333ea; }
        .icon-orange { background: #ffedd5; color: #ea580c; }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
            letter-spacing: -0.02em;
        }

        .stat-trend {
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
        }

        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .dashboard-card {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-main);
        }

        .card-action {
            color: var(--primary);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
        }

        .card-action:hover {
            text-decoration: underline;
        }

        /* Modern Table */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table th {
            text-align: left;
            padding: 12px 24px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .modern-table td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            color: var(--text-main);
        }

        .modern-table tr:last-child td {
            border-bottom: none;
        }

        .modern-table tr:hover td {
            background: #f8fafc;
        }

        /* Dark Mode Overrides */
        .dark .modern-table th {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-muted);
        }

        .dark .modern-table tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending { background: #fff7ed; color: #c2410c; }
        .status-processing { background: #eff6ff; color: #1d4ed8; }
        .status-completed { background: #ecfdf5; color: #047857; }
        .status-cancelled { background: #fef2f2; color: #b91c1c; }
        .status-paid { background: #f0fdf4; color: #15803d; }
        .status-unpaid { background: #fefce8; color: #a16207; }

        /* List Items */
        .list-item {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
            background: #f1f5f9;
        }

        .item-content {
            flex: 1;
        }

        .item-title {
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .item-subtitle {
            font-size: 13px;
            color: var(--text-muted);
        }

        .item-value {
            font-weight: 600;
            color: var(--text-main);
        }

        /* Empty State */
        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-icon {
            font-size: 32px;
            margin-bottom: 12px;
            opacity: 0.5;
        }
    </style>
    @endpush

    <!-- Statistics Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Revenue</span>
                <div class="stat-icon-wrapper icon-primary">💰</div>
            </div>
            <div>
                <div class="stat-value">₹{{ number_format($stats['total_revenue'], 0) }}</div>
                <div class="stat-trend">
                    <span class="trend-up">↑</span>
                    <span>This Month: ₹{{ number_format($stats['month_revenue'], 0) }}</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Orders</span>
                <div class="stat-icon-wrapper icon-success">📦</div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
                <div class="stat-trend">
                    <span>Today: {{ $stats['today_orders'] }} orders</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Products</span>
                <div class="stat-icon-wrapper icon-purple">🛍️</div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($stats['total_products']) }}</div>
                <div class="stat-trend">
                    <span>{{ $stats['total_categories'] }} categories</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Users</span>
                <div class="stat-icon-wrapper icon-orange">👥</div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($stats['total_users']) }}</div>
                <div class="stat-trend">
                    <span>Active customers</span>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Pending Orders</span>
                <div class="stat-icon-wrapper icon-warning">⏳</div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($stats['pending_orders']) }}</div>
                <div class="stat-trend icon-warning" style="background: none; color: var(--warning);">
                    <span>Processing: {{ $stats['processing_orders'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Recent Orders -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="card-action">View All →</a>
            </div>
            
            @if($stats['recent_orders']->count() > 0)
                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_orders'] as $order)
                                <tr onclick="window.location='{{ route('admin.orders.show', $order->id) }}'" style="cursor: pointer;">
                                    <td style="font-family: monospace; font-weight: 600;">{{ $order->order_number }}</td>
                                    <td>
                                        <div style="font-weight: 500;">{{ $order->user->name ?? 'Guest' }}</div>
                                        <div style="font-size: 12px; color: var(--text-muted);">{{ $order->user->email ?? '' }}</div>
                                    </td>
                                    <td style="font-weight: 600;">₹{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($order->status) {
                                                'pending' => 'status-pending',
                                                'processing' => 'status-processing',
                                                'completed' => 'status-completed',
                                                'cancelled' => 'status-cancelled',
                                                default => 'status-pending'
                                            };
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td style="color: var(--text-muted);">{{ $order->created_at->format('M d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <p>No orders found</p>
                </div>
            @endif
        </div>

        <!-- Sidebar Column -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Top Products -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Top Products</h3>
                </div>
                @if($stats['top_products']->count() > 0)
                    <div>
                        @foreach($stats['top_products'] as $item)
                            <div class="list-item">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->title }}" class="item-image">
                                @else
                                    <div class="item-image" style="display: flex; align-items: center; justify-content: center;">📦</div>
                                @endif
                                <div class="item-content">
                                    <div class="item-title">{{ Str::limit($item->product->title ?? 'Unknown Product', 20) }}</div>
                                    <div class="item-subtitle">{{ $item->total_sold }} sold</div>
                                </div>
                                <div class="item-value">#{{ $loop->iteration }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <p>No sales data yet</p>
                    </div>
                @endif
            </div>

            <!-- Recent Messages -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Messages</h3>
                    <a href="{{ route('admin.contact-messages.index') }}" class="card-action">View All →</a>
                </div>
                @if($stats['recent_messages']->count() > 0)
                    <div>
                        @foreach($stats['recent_messages'] as $message)
                            <div class="list-item">
                                <div class="stat-icon-wrapper icon-primary" style="width: 40px; height: 40px; font-size: 16px;">💬</div>
                                <div class="item-content">
                                    <div class="item-title">{{ $message->name }}</div>
                                    <div class="item-subtitle">{{ Str::limit($message->subject, 25) }}</div>
                                </div>
                                <div style="font-size: 11px; color: var(--text-muted);">{{ $message->created_at->diffForHumans(null, true, true) }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <p>No messages</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
