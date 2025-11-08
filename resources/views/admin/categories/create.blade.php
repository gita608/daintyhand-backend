@extends('admin.layout')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div class="form-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Add New Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">← Back to Categories</a>
        </div>
        
        <form method="POST" action="{{ route('admin.categories.store') }}">
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
                <label>Image URL</label>
                <input type="url" name="image" value="{{ old('image') }}" placeholder="https://example.com/image.jpg">
                @error('image')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
@endsection

