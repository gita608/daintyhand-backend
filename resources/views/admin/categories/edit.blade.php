@extends('admin.layout')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

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
    .category-image-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        width: 100%;
        height: auto;
        border: 2px solid #e5e7eb;
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
        
        .category-image-preview {
            max-width: 100%;
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
            <h2 style="margin: 0;">Edit Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">← Back to Categories</a>
    </div>
        
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
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
                    <label>Category Image</label>
                    @if($category->image)
                        <div class="image-preview-container" style="margin-bottom: 12px;">
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="category-image-preview">
                        </div>
                    @endif
                    <input type="file" name="image_file" accept="image/*" onchange="previewImage(this, 'category-preview')">
                    <small style="display: block; margin-top: 8px; color: #6b7280; font-size: 12px;">Upload a new image file (JPG, PNG, GIF, WebP - Max 2MB)</small>
                    <div id="category-preview" class="image-preview-container" style="margin-top: 12px; display: none;">
                        <img id="category-preview-img" src="" alt="Preview">
                    </div>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                        <label style="font-size: 12px; color: #6b7280;">OR Enter Image URL</label>
                        <input type="url" name="image" value="{{ $category->image ?? '' }}" placeholder="https://example.com/image.jpg" style="margin-top: 5px;">
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
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
