@extends('admin.layout')

@section('title', 'Categories')
@section('page-title', 'Categories')

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
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 18px;
        }
        .page-header .btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h2 style="margin: 0;">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add New Category</a>
    </div>

    <!-- Desktop Table View -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            @else
                                <span style="color: #999;">No image</span>
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align: center; padding: 30px;">No categories found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($categories as $category)
            <div class="mobile-card">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">ID</span>
                    <span class="mobile-card-value">{{ $category->id }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Image</span>
                    <span class="mobile-card-value">
                        @if($category->image)
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                        @else
                            <span style="color: #999;">No image</span>
                        @endif
                    </span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Name</span>
                    <span class="mobile-card-value">{{ $category->name }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Slug</span>
                    <span class="mobile-card-value">{{ $category->slug }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Description</span>
                    <span class="mobile-card-value">{{ $category->description ?? 'N/A' }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline; flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?')" style="width: 100%;">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No categories found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $categories;
    @endphp
    @include('admin.partials.pagination')
@endsection
