<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('admin.modules.admin-profile.edit', compact('user'));
    }

    // Update admin information by id
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'user_type'  => 'required|in:user,admin',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // password is optional; if provided, it must be confirmed and at least 8 characters.
            'password'   => 'nullable|string|min:8|confirmed'
        ]);

        $user->name      = $validated['name'];
        $user->email     = $validated['email'];
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
}
