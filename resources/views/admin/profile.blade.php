@extends('admin.layout')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@include('admin.partials.buttons')
@include('admin.partials.badges')
@include('admin.partials.cards')
@include('admin.partials.forms')

@push('styles')
<style>
    .profile-section {
        margin-bottom: 30px;
    }
    
    .profile-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .profile-section {
            margin-bottom: 20px;
        }
        .profile-section-title {
            font-size: 16px;
        }
        .profile-header h2 {
            font-size: 18px;
        }
    }
    
    @media (max-width: 480px) {
        .profile-section-title {
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Profile Information Section -->
    <div class="card">
        <div class="profile-section">
            <h2 class="profile-section-title">Profile Information</h2>
            
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="form-row">
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
                </div>
                
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                    @error('phone')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="card">
        <div class="profile-section">
            <h2 class="profile-section-title">Change Password</h2>
            
            <form method="POST" action="{{ route('admin.profile.password') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                    @error('current_password')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" required minlength="8">
                        @error('password')
                            <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" required minlength="8">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>

    <!-- Account Information Section -->
    <div class="card">
        <div class="profile-section">
            <h2 class="profile-section-title">Account Information</h2>
            
            <div class="info-row">
                <strong>User ID:</strong> {{ $user->id }}
            </div>
            <div class="info-row">
                <strong>Account Type:</strong> 
                <span class="badge badge-admin">Administrator</span>
            </div>
            <div class="info-row">
                <strong>Member Since:</strong> {{ $user->created_at->format('F d, Y') }}
            </div>
            <div class="info-row">
                <strong>Last Updated:</strong> {{ $user->updated_at->format('F d, Y H:i') }}
            </div>
        </div>
    </div>
@endsection

