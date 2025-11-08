@extends('admin.layout')

@section('title', 'User Details')
@section('page-title', 'User Details')

@include('admin.partials.buttons')
@include('admin.partials.cards')
@include('admin.partials.forms')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">← Back to Users</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>User Information</h2>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">Edit User</a>
        </div>
        
        <div class="info-row"><strong>ID:</strong> {{ $user->id }}</div>
        <div class="info-row"><strong>Name:</strong> {{ $user->name }}</div>
        <div class="info-row"><strong>Email:</strong> {{ $user->email }}</div>
        <div class="info-row"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</div>
        <div class="info-row"><strong>Registered:</strong> {{ $user->created_at->format('F d, Y H:i') }}</div>
        <div class="info-row"><strong>Last Updated:</strong> {{ $user->updated_at->format('F d, Y H:i') }}</div>
    </div>

    @if($user->orders_count > 0)
        <div class="card">
            <h2 style="margin-bottom: 20px;">User Orders ({{ $user->orders_count }})</h2>
            <div style="margin-bottom: 10px;">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All Orders</a>
            </div>
        </div>
    @endif
@endsection

