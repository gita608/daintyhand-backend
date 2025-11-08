@extends('admin.layout')

@section('title', 'Products')
@section('page-title', 'Products')

@include('admin.partials.buttons')
@include('admin.partials.tables')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h2 style="margin: 0;">All Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}" alt="{{ $product->title }}"></td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category }}</td>
                    <td>₹{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-edit btn-sm">View</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px;">No products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
