<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Message - Admin</title>
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
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.contact-messages.index') }}">← Back to Messages</a> - Message #{{ $message->id }}</h1>
    </div>
    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h2>Contact Information</h2>
            <div class="info-row"><strong>Name:</strong> {{ $message->name }}</div>
            <div class="info-row"><strong>Email:</strong> {{ $message->email }}</div>
            <div class="info-row"><strong>Subject:</strong> {{ $message->subject }}</div>
            <div class="info-row"><strong>Date:</strong> {{ $message->created_at->format('M d, Y H:i') }}</div>
            <div class="info-row"><strong>Read:</strong> {{ $message->is_read ? 'Yes' : 'No' }}</div>
        </div>

        <div class="card">
            <h2>Message</h2>
            <p style="white-space: pre-wrap;">{{ $message->message }}</p>
        </div>

        @if(!$message->is_read)
            <div class="card">
                <form method="POST" action="{{ route('admin.contact-messages.markAsRead', $message->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn">Mark as Read</button>
                </form>
            </div>
        @endif
    </div>
</body>
</html>

