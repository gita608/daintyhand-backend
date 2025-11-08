<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f7fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; }
        .header a { color: white; text-decoration: none; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 30px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <h1><a href="{{ route('admin.categories.index') }}">← Back to Categories</a> - Edit Category</h1>
    </div>
    <div class="container">
        <div class="card">
            <h2 style="margin-bottom: 20px;">Edit Category</h2>
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" required>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" value="{{ $category->description ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="url" name="image" value="{{ $category->image ?? '' }}" placeholder="https://example.com/image.jpg">
                    @if($category->image)
                        <div style="margin-top: 10px;">
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" style="max-width: 200px; max-height: 200px; border-radius: 5px; margin-top: 10px;">
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn">Update Category</button>
            </form>
        </div>
    </div>
</body>
</html>

