@extends('admin.layout')

@section('title', 'Product Details')
@section('page-title', 'Product Details')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@push('styles')
    <style>
    .product-main-image {
        max-width: 300px;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .product-images-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .product-images-grid img {
        max-width: 200px;
        width: 100%;
        border-radius: 8px;
    }
    @media (max-width: 768px) {
        .product-main-image {
            max-width: 100%;
        }
        .product-images-grid img {
            max-width: 150px;
        }
    }
    @media (max-width: 480px) {
        .product-images-grid img {
            max-width: 100%;
        }
    }
    </style>
@endpush

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">← Back to Products</a>
    </div>

        <div class="card">
        <div class="card-header">
            <h2>Product Information</h2>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">Edit Product</a>
        </div>
        
            @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="product-main-image">
            @endif
        
            <div class="info-row"><strong>ID:</strong> {{ $product->id }}</div>
            <div class="info-row"><strong>Title:</strong> {{ $product->title }}</div>
            <div class="info-row"><strong>Description:</strong> {{ $product->description }}</div>
            <div class="info-row"><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</div>
            <div class="info-row"><strong>Category:</strong> {{ $product->category }}</div>
            <div class="info-row"><strong>Rating:</strong> {{ $product->rating }}/5</div>
            <div class="info-row"><strong>Reviews:</strong> {{ $product->reviews_count }}</div>
            <div class="info-row"><strong>In Stock:</strong> {{ $product->in_stock ? 'Yes' : 'No' }}</div>
        </div>

        @if($product->images->count() > 0)
            <div class="card">
                <h2 style="margin-bottom: 20px;">Product Images</h2>
                <div class="product-images-grid">
                @foreach($product->images as $image)
                        <img src="{{ $image->image_url }}" alt="Product Image">
                @endforeach
                </div>
            </div>
        @endif

        @if($product->features->count() > 0)
            <div class="card">
            <h2 style="margin-bottom: 20px;">Features</h2>
            <ul style="list-style: none; padding: 0;">
                    @foreach($product->features as $feature)
                    <li style="padding: 8px 0; border-bottom: 1px solid #f3f4f6;">• {{ $feature->feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($product->specifications->count() > 0)
            <div class="card">
                <h2 style="margin-bottom: 20px;">Specifications</h2>
                <!-- Desktop Table View -->
                <div class="table-wrapper">
                <table style="width: 100%;">
                    @foreach($product->specifications as $spec)
                        <tr>
                                <td style="padding: 8px 0;"><strong>{{ $spec->key }}:</strong></td>
                                <td style="padding: 8px 0;">{{ $spec->value }}</td>
                        </tr>
                    @endforeach
                </table>
                </div>
                
                <!-- Mobile Card View -->
                <div class="table-mobile-card">
                    @foreach($product->specifications as $spec)
                        <div class="mobile-card-row">
                            <span class="mobile-card-label">{{ $spec->key }}</span>
                            <span class="mobile-card-value">{{ $spec->value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
@endsection
