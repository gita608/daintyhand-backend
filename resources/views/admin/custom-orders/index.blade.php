<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Orders - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 1400px; margin: 30px auto; padding: 0 30px; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-in_progress { background: #cfe2ff; color: #084298; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.dashboard') }}">Admin Panel</a> - Custom Orders</h1>
    </div>
    <div class="container">
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
                        <td>{{ ucfirst($order->product_type) }}</td>
                        <td>{{ $order->budget }}</td>
                        <td><span class="badge badge-{{ str_replace('_', '-', $order->status) }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span></td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td><a href="{{ route('admin.custom-orders.show', $order->id) }}" style="color: #667eea; text-decoration: none;">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align: center; padding: 30px;">No custom orders found</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $customOrders->links() }}
        </div>
    </div>
</body>
</html>

