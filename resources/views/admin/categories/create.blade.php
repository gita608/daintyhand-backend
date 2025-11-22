@extends('admin.layout')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

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
    @media (max-width: 768px) {
        .form-header h2 {
            font-size: 18px;
        }
        .form-header .btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>
@endpush

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2 style="margin: 0;">Add New Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">← Back to Categories</a>
        </div>
        
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" required>
                @error('slug')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" value="{{ old('description') }}">
                @error('description')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Category Image</label>
                <input type="file" name="image_file" accept="image/*" onchange="previewImage(this, 'category-preview')">
                <small style="display: block; margin-top: 8px; color: #6b7280; font-size: 12px;">Upload an image file (JPG, PNG, GIF, WebP - Max 2MB)</small>
                <div id="category-preview" class="image-preview-container" style="margin-top: 12px; display: none;">
                    <img id="category-preview-img" src="" alt="Preview">
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                    <label style="font-size: 12px; color: #6b7280;">OR Enter Image URL</label>
                    <input type="url" name="image" value="{{ old('image') }}" placeholder="https://example.com/image.jpg" style="margin-top: 5px;">
                </div>
                @error('image')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
                @error('image_file')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
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

