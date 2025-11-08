<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Admin</title>
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
        img { max-width: 300px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.products.index') }}">← Back to Products</a> - {{ $product->title }}</h1>
    </div>
    <div class="container">
        <div class="card">
            <h2>Product Information</h2>
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->title }}" style="margin-bottom: 20px;">
            @endif
            <div class="info-row"><strong>ID:</strong> {{ $product->id }}</div>
            <div class="info-row"><strong>Title:</strong> {{ $product->title }}</div>
            <div class="info-row"><strong>Description:</strong> {{ $product->description }}</div>
            <div class="info-row"><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</div>
            <div class="info-row"><strong>Category:</strong> {{ $product->category }}</div>
            <div class="info-row"><strong>Rating:</strong> {{ $product->rating }}/5</div>
            <div class="info-row"><strong>Reviews:</strong> {{ $product->reviews_count }}</div>
            <div class="info-row"><strong>In Stock:</strong> {{ $product->in_stock ? 'Yes' : 'No' }}</div>
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn">Edit Product</a>
            </div>
        </div>

        @if($product->images->count() > 0)
            <div class="card">
                <h2>Product Images</h2>
                @foreach($product->images as $image)
                    <img src="{{ $image->image_url }}" alt="Product Image" style="max-width: 200px; margin: 10px;">
                @endforeach
            </div>
        @endif

        @if($product->features->count() > 0)
            <div class="card">
                <h2>Features</h2>
                <ul>
                    @foreach($product->features as $feature)
                        <li>{{ $feature->feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($product->specifications->count() > 0)
            <div class="card">
                <h2>Specifications</h2>
                <table style="width: 100%;">
                    @foreach($product->specifications as $spec)
                        <tr>
                            <td><strong>{{ $spec->key }}:</strong></td>
                            <td>{{ $spec->value }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>
</body>
</html>

