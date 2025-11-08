<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 1400px; margin: 30px auto; padding: 0 30px; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .unread { font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.dashboard') }}">Admin Panel</a> - Contact Messages</h1>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Read</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ $message->is_read ? '' : 'unread' }}">
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->is_read ? 'Yes' : 'No' }}</td>
                        <td>{{ $message->created_at->format('M d, Y') }}</td>
                        <td><a href="{{ route('admin.contact-messages.show', $message->id) }}" style="color: #667eea; text-decoration: none;">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align: center; padding: 30px;">No messages found</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $messages->links() }}
        </div>
    </div>
</body>
</html>

