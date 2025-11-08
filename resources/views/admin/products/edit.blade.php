<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 30px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.products.index') }}">← Back to Products</a> - Edit Product</h1>
    </div>
    <div class="container">
        <div class="card">
            <h2 style="margin-bottom: 20px;">Edit Product</h2>
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $product->title }}" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required>{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>
                </div>
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" name="image" value="{{ $product->image }}">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="Invitations" {{ $product->category === 'Invitations' ? 'selected' : '' }}>Invitations</option>
                        <option value="Wall Art" {{ $product->category === 'Wall Art' ? 'selected' : '' }}>Wall Art</option>
                        <option value="Paper Crafts" {{ $product->category === 'Paper Crafts' ? 'selected' : '' }}>Paper Crafts</option>
                        <option value="Albums" {{ $product->category === 'Albums' ? 'selected' : '' }}>Albums</option>
                        <option value="Cards" {{ $product->category === 'Cards' ? 'selected' : '' }}>Cards</option>
                        <option value="Decorations" {{ $product->category === 'Decorations' ? 'selected' : '' }}>Decorations</option>
                        <option value="Journals" {{ $product->category === 'Journals' ? 'selected' : '' }}>Journals</option>
                        <option value="Gift Wrap" {{ $product->category === 'Gift Wrap' ? 'selected' : '' }}>Gift Wrap</option>
                        <option value="Frames" {{ $product->category === 'Frames' ? 'selected' : '' }}>Frames</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rating</label>
                    <input type="number" name="rating" min="0" max="5" value="{{ $product->rating }}">
                </div>
                <div class="form-group">
                    <label>Reviews Count</label>
                    <input type="number" name="reviews_count" min="0" value="{{ $product->reviews_count }}">
                </div>
                <div class="form-group">
                    <label>In Stock</label>
                    <select name="in_stock">
                        <option value="1" {{ $product->in_stock ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$product->in_stock ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <button type="submit" class="btn">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>

