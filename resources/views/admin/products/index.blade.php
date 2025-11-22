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
        flex-wrap: wrap;
        gap: 10px;
    }
    img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }
    @media (max-width: 768px) {
        .page-header {
            margin-bottom: 15px;
        }
        .page-header h2 {
            font-size: 18px;
        }
        .page-header .btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
    
    @media (max-width: 480px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        .page-header h2 {
            font-size: 16px;
        }
        .page-header .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h2 style="margin: 0;">All Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    @php
        $filterFields = [
            [
                'type' => 'search',
                'name' => 'search',
                'label' => 'Search',
                'placeholder' => 'Search by title, description, or category...'
            ],
            [
                'type' => 'select',
                'name' => 'category',
                'label' => 'Category',
                'options' => array_merge(['all' => 'All Categories'], $categories->mapWithKeys(fn($cat) => [$cat => $cat])->toArray())
            ],
            [
                'type' => 'select',
                'name' => 'stock_status',
                'label' => 'Stock Status',
                'options' => [
                    'all' => 'All',
                    'in_stock' => 'In Stock',
                    'out_of_stock' => 'Out of Stock'
                ]
            ]
        ];
    @endphp
    @include('admin.partials.filters')

    <!-- Desktop Table View -->
    <div class="table-wrapper">
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
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($products as $product)
            <div class="mobile-card">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">ID</span>
                    <span class="mobile-card-value">{{ $product->id }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Image</span>
                    <span class="mobile-card-value">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}" alt="{{ $product->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    </span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Title</span>
                    <span class="mobile-card-value">{{ $product->title }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Category</span>
                    <span class="mobile-card-value">{{ $product->category }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Price</span>
                    <span class="mobile-card-value">₹{{ number_format($product->price, 2) }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Stock</span>
                    <span class="mobile-card-value">{{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-edit btn-sm">View</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No products found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $products;
    @endphp
    @include('admin.partials.pagination')
@endsection
