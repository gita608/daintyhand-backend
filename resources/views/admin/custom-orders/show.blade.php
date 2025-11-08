<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Order Details - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 30px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card h2 { margin-bottom: 20px; color: #333; }
        .info-row { margin-bottom: 15px; }
        .info-row strong { display: inline-block; width: 150px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.custom-orders.index') }}">← Back to Custom Orders</a> - Order #{{ $customOrder->id }}</h1>
    </div>
    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h2>Customer Information</h2>
            <div class="info-row"><strong>Name:</strong> {{ $customOrder->name }}</div>
            <div class="info-row"><strong>Email:</strong> {{ $customOrder->email }}</div>
            <div class="info-row"><strong>Phone:</strong> {{ $customOrder->phone }}</div>
        </div>

        <div class="card">
            <h2>Order Details</h2>
            <div class="info-row"><strong>Product Type:</strong> {{ ucfirst($customOrder->product_type) }}</div>
            <div class="info-row"><strong>Quantity:</strong> {{ $customOrder->quantity }}</div>
            <div class="info-row"><strong>Budget:</strong> {{ $customOrder->budget }}</div>
            @if($customOrder->event_date)
                <div class="info-row"><strong>Event Date:</strong> {{ $customOrder->event_date->format('M d, Y') }}</div>
            @endif
            <div class="info-row"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $customOrder->status)) }}</div>
            <div class="info-row"><strong>Date:</strong> {{ $customOrder->created_at->format('M d, Y H:i') }}</div>
        </div>

        <div class="card">
            <h2>Description</h2>
            <p>{{ $customOrder->description }}</p>
        </div>

        @if($customOrder->additional_notes)
            <div class="card">
                <h2>Additional Notes</h2>
                <p>{{ $customOrder->additional_notes }}</p>
            </div>
        @endif

        <div class="card">
            <h2>Update Status</h2>
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
                <button type="submit" class="btn">Update Status</button>
            </form>
        </div>
    </div>
</body>
</html>

