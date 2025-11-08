<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $users = User::where('is_admin', false)->paginate($perPage);

        if ($request->expectsJson()) {
            return $this->successResponse($users);
        }

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('is_admin', false)
            ->withCount('orders')
            ->findOrFail($id);

        if (request()->expectsJson()) {
            return $this->successResponse($user);
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('is_admin', false)->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('is_admin', false)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        if ($request->expectsJson()) {
            return $this->successResponse($user, 'User updated successfully');
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::where('is_admin', false)->findOrFail($id);
        $user->delete();

        if (request()->expectsJson()) {
            return $this->successResponse(null, 'User deleted successfully');
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
