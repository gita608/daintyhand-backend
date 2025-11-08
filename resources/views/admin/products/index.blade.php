<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 1400px; margin: 30px auto; padding: 0 30px; }
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; text-decoration: none; display: inline-block; cursor: pointer; }
        .btn:hover { background: #5568d3; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.dashboard') }}">Admin Panel</a> - Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn">Add New Product</a>
    </div>
    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}" alt="{{ $product->title }}"></td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn" style="padding: 5px 10px; font-size: 12px;">View</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn" style="padding: 5px 10px; font-size: 12px; background: #28a745;">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align: center; padding: 30px;">No products found</tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>

