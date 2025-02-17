<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // user pagination
        $users = User::paginate(20);
        return view('admin.modules.all-users.index', compact('users'));
    }

    // User edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.modules.all-users.edit', compact('user'));
    }

    // Update user information
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation (email unique rule excluding the current user)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'user_type' => 'required|in:admin,user',
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

}
