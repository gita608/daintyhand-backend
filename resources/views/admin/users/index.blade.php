@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'Users')

@include('admin.partials.buttons')
@include('admin.partials.tables')

@section('content')
    <!-- Desktop Table View -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-edit btn-sm">View</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="table-mobile-card">
        @forelse($users as $user)
            <div class="mobile-card">
                <div class="mobile-card-row">
                    <span class="mobile-card-label">ID</span>
                    <span class="mobile-card-value">{{ $user->id }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Name</span>
                    <span class="mobile-card-value">{{ $user->name }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Email</span>
                    <span class="mobile-card-value">{{ $user->email }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Phone</span>
                    <span class="mobile-card-value">{{ $user->phone ?? 'N/A' }}</span>
                </div>
                <div class="mobile-card-row">
                    <span class="mobile-card-label">Registered</span>
                    <span class="mobile-card-value">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="mobile-card-actions">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-edit btn-sm">View</a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline; flex: 1;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-sm" style="width: 100%;">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="mobile-card" style="text-align: center; padding: 30px;">
                No users found
            </div>
        @endforelse
    </div>
    
    @php
        $paginator = $users;
    @endphp
    @include('admin.partials.pagination')
@endsection
