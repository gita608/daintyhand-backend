<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $users = User::paginate($perPage);

        if ($request->expectsJson()) {
            return $this->successResponse($users);
        }

        return view('admin.users.index', compact('users'));
    }
}
