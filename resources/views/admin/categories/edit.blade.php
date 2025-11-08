@extends('admin.layout')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div class="form-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Edit Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">← Back to Categories</a>
    </div>
        
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
            <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
    </div>
@endsection
