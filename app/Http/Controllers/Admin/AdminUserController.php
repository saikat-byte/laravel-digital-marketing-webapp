<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        // user pagination
        $users = User::paginate(20);
        return view('admin.modules.all-users.index', compact('users'));
    }

    // User create form
    public function create()
    {
        return view('admin.modules.all-users.create');
    }

     // Store the newly created user in storage
     public function store(Request $request)
     {
         $validated = $request->validate([
             'name'       => 'required|string|max:255',
             'email'      => 'required|email|max:255|unique:users,email',
             'user_type'  => 'required|in:user,moderator,admin',
             'password'   => 'required|string|min:8|confirmed',
             'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         $user = new User();
         $user->name      = $validated['name'];
         $user->email     = $validated['email'];
         $user->user_type = $validated['user_type'];
         $user->password  = Hash::make($validated['password']);

         // Image upload (if provided)
         if ($request->hasFile('image_path')) {
             $image = $request->file('image_path');
             $filename = time() . '_' . $image->getClientOriginalName();
             $image->move(public_path('assets/image/profile-picture/'), $filename);
             $user->image_path = 'assets/image/profile-picture/' . $filename;
         }

         $user->save();

         return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'user_type' => 'required|in:user,moderator,admin',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // password is optional; if provided, it must be confirmed and at least 8 characters.
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->user_type = $validated['user_type'];

        // Update password only if filled
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image_path')) {
            // Delete the old image if exists
            if ($user->image_path && file_exists(public_path($user->image_path))) {
                unlink(public_path($user->image_path));
            }
            $image = $request->file('image_path');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/image/profile-picture/'), $filename);
            $user->image_path = 'assets/image/profile-picture/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}
