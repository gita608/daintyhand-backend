<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DaintyHand</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f7fa;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header h1 {
            font-size: 24px;
        }
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .header-actions span {
            font-size: 14px;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-logout {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card .value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }
        .nav-menu {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .nav-menu h2 {
            margin-bottom: 15px;
            color: #333;
        }
        .nav-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }
        .nav-link {
            padding: 12px 20px;
            background: #f8f9fa;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            display: block;
        }
        .nav-link:hover {
            background: #667eea;
            color: white;
        }
        .recent-orders {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .recent-orders h2 {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #666;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }
        .badge-paid {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DaintyHand Admin Dashboard</h1>
        <div class="header-actions">
            <span>Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Products</h3>
                <div class="value">{{ number_format($stats['total_products']) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="value">{{ number_format($stats['total_users']) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <div class="value">{{ number_format($stats['total_orders']) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <div class="value">₹{{ number_format($stats['total_revenue'], 2) }}</div>
            </div>
            <div class="stat-card">
                <h3>Pending Orders</h3>
                <div class="value">{{ number_format($stats['pending_orders']) }}</div>
            </div>
            <div class="stat-card">
                <h3>Custom Orders</h3>
                <div class="value">{{ number_format($stats['pending_custom_orders']) }}</div>
            </div>
            <div class="stat-card">
                <h3>Unread Messages</h3>
                <div class="value">{{ number_format($stats['unread_messages']) }}</div>
            </div>
        </div>

        <div class="nav-menu">
            <h2>Quick Navigation</h2>
            <div class="nav-links">
                <a href="{{ route('admin.products.index') }}" class="nav-link">Manage Products</a>
                <a href="{{ route('admin.orders.index') }}" class="nav-link">View Orders</a>
                <a href="{{ route('admin.custom-orders.index') }}" class="nav-link">Custom Orders</a>
                <a href="{{ route('admin.contact-messages.index') }}" class="nav-link">Contact Messages</a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link">Categories</a>
                <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
            </div>
        </div>

        <div class="recent-orders">
            <h2>Recent Orders</h2>
            @if($stats['recent_orders']->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Order Number</th>
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
                                <td>{{ $order->user->name }}</td>
                                <td>₹{{ number_format($order->total, 2) }}</td>
                                <td><span class="badge badge-pending">{{ ucfirst($order->status) }}</span></td>
                                <td><span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-pending' }}">{{ ucfirst($order->payment_status) }}</span></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders yet.</p>
            @endif
        </div>
    </div>
</body>
</html>

