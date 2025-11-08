@extends('admin.layout')

@section('title', 'Categories')
@section('page-title', 'Categories')

@include('admin.partials.buttons')
@include('admin.partials.tables')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add New Category</a>
    </div>

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
@endsection
