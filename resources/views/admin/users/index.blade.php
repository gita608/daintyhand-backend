@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'Users')

@include('admin.partials.buttons')
@include('admin.partials.tables')

@section('content')
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
    
        <div style="margin-top: 20px;">
            {{ $users->links() }}
    </div>
@endsection
