@extends('admin.layout')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div class="form-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Edit Product</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">← Back to Products</a>
    </div>
        
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
            <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
    </div>
@endsection
