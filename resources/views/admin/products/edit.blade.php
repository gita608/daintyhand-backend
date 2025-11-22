@extends('admin.layout')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@push('styles')
    <style>
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .image-preview-container {
        margin-top: 10px;
    }
    
    .image-preview-container img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
    }
    
    @media (max-width: 768px) {
        .form-header {
            margin-bottom: 16px;
        }
        
        .form-header h2 {
            font-size: 18px;
        }
        
        .form-header .btn {
            font-size: 14px;
            padding: 10px 16px;
            min-height: 44px;
        }
        
        .image-preview-container {
            margin-top: 12px;
        }
        
        .image-preview-container img {
            width: 100%;
            max-width: 300px;
        }
    }
    
    @media (max-width: 480px) {
        .form-header {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
            margin-bottom: 14px;
        }
        
        .form-header h2 {
            font-size: 16px;
        }
        
        .form-header .btn {
            width: 100%;
            padding: 12px;
        }
        
        .image-preview-container img {
            max-width: 100%;
        }
    }
    </style>
@endpush

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2 style="margin: 0;">Edit Product</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">← Back to Products</a>
    </div>
        
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
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
                    <label>Product Image</label>
                    @if($product->image)
                        <div class="image-preview-container" style="margin-bottom: 12px;">
                            <img src="{{ $product->image }}" alt="Current Image">
                        </div>
                    @endif
                    <input type="file" name="image_file" accept="image/*" onchange="previewImage(this, 'product-preview')">
                    <small style="display: block; margin-top: 8px; color: #6b7280; font-size: 12px;">Upload a new image file (JPG, PNG, GIF, WebP - Max 2MB)</small>
                    <div id="product-preview" class="image-preview-container" style="display: none;">
                        <img id="product-preview-img" src="" alt="Preview">
                    </div>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                        <label style="font-size: 12px; color: #6b7280;">OR Enter Image URL</label>
                        <input type="text" name="image" value="{{ $product->image }}" placeholder="https://example.com/image.jpg" style="margin-top: 5px;">
                    </div>
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
            <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
    </div>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const previewImg = document.getElementById(previewId + '-img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
