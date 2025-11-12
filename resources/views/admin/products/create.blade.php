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
            <h2 style="margin: 0;">Create New Product</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">← Back to Products</a>
        </div>
        
            <form method="POST" action="{{ route('admin.products.store') }}">
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
                    <label>Image URL</label>
                    <input type="text" name="image">
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
@endsection
