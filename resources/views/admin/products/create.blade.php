@extends('admin.layout')

@section('title', 'Create Product')
@section('page-title', 'Create Product')

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
            <h2 style="margin: 0;">Create New Product</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">← Back to Products</a>
    </div>
        
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image_file" accept="image/*" onchange="previewImage(this, 'product-preview')">
                    <small style="display: block; margin-top: 8px; color: #6b7280; font-size: 12px;">Upload an image file (JPG, PNG, GIF, WebP - Max 2MB)</small>
                    <div id="product-preview" class="image-preview-container" style="display: none;">
                        <img id="product-preview-img" src="" alt="Preview">
                    </div>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                        <label style="font-size: 12px; color: #6b7280;">OR Enter Image URL</label>
                        <input type="text" name="image" placeholder="https://example.com/image.jpg" style="margin-top: 5px;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="Invitations">Invitations</option>
                        <option value="Wall Art">Wall Art</option>
                        <option value="Paper Crafts">Paper Crafts</option>
                        <option value="Albums">Albums</option>
                        <option value="Cards">Cards</option>
                        <option value="Decorations">Decorations</option>
                        <option value="Journals">Journals</option>
                        <option value="Gift Wrap">Gift Wrap</option>
                        <option value="Frames">Frames</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rating</label>
                    <input type="number" name="rating" min="0" max="5" value="0">
                </div>
                <div class="form-group">
                    <label>Reviews Count</label>
                    <input type="number" name="reviews_count" min="0" value="0">
                </div>
                <div class="form-group">
                    <label>In Stock</label>
                    <select name="in_stock">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Create Product</button>
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
