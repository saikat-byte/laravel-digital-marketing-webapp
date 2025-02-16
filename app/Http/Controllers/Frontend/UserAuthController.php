<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoUploadController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class UserAuthController extends Controller
{
    /**
     * Display the registration form.
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.user-registration');
    }

    /**
     * Handle a registration request for the application.
     */
    // Registration process
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'iAgree'     => 'accepted',
        ]);

        try {
            // Prepare user data except image and other non-database fields
            $userData = $request->except(['image_path', 'password_confirmation']);
            $userData['password'] = Hash::make($request->input('password'));

            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');

                // Create a unique name using slug of name and current timestamp
                $name = Str::slug($request->input('name')) . '-' . time();

                // Set desired dimensions (উদাহরণ: 300x300)
                $height = 300;
                $width = 300;

                // Define folder relative to public folder
                $folder = 'assets/image/profile-picture/';

                // Call PhotoUploadController::imageUpload() method
                $uploadedImageName = PhotoUploadController::imageUpload($name, $height, $width, $folder, $file);

                // **Ensure that the key matches your DB column name, here we use 'image_path'**
                $userData['image_path'] = $folder . $uploadedImageName;
            }

            User::create($userData);

            return redirect()->route('user.login')
                ->with('success', 'Registration successful! Please login.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error during registration: ' . $e->getMessage());
        }
    }


    // show login form

    public function showLoginForm()
    {

        return view('frontend.auth.user-login');
    }

    // login store
    public function loginStore(Request $request)
    {
        // Validate login data
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Get redirect_url from the form; if not provided, use post_slug to build single blog URL,
            // Otherwise fallback to blog index page.
            if ($request->filled('redirect_url')) {
                $redirectUrl = $request->input('redirect_url');
            } elseif ($request->filled('post_slug')) {
                $redirectUrl = route('frontend.blog.show', ['slug' => $request->input('post_slug')]);
            } else {
                $redirectUrl = route('frontend.blog.index');
            }

            return redirect()->intended($redirectUrl)->with('success', 'You are now logged in to comment!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }








}
