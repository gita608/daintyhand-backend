@extends('admin.layout')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div class="form-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Edit User</h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">← Back to Users</a>
        </div>
        
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                @error('phone')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>New Password (Leave blank to keep current password)</label>
                <input type="password" name="password" placeholder="Enter new password (min 8 characters)">
                @error('password')
                    <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm new password">
            </div>
            
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection

