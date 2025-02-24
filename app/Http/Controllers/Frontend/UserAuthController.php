<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoUploadController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
            // 'iAgree'     => 'accepted', // যদি প্রয়োজন হয়
        ]);

        try {
            // Prepare user data excluding non-database fields
            $userData = $request->except(['image_path', 'password_confirmation']);
            $userData['password'] = Hash::make($request->input('password'));

            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $name = Str::slug($request->input('name')) . '-' . time();
                $height = 300;
                $width = 300;
                $folder = 'assets/image/profile-picture/';
                $uploadedImageName = PhotoUploadController::imageUpload($name, $height, $width, $folder, $file);
                $userData['image_path'] = $folder . $uploadedImageName;
            }

            User::create($userData);

            // Determine redirect URL
            if ($request->filled('redirect_url')) {
                $redirectUrl = $request->input('redirect_url');
            } elseif ($request->filled('post_slug')) {
                $redirectUrl = route('frontend.blog.show', ['slug' => $request->input('post_slug')]);
            } else {
                $redirectUrl = route('frontend.blog.index');
            }

            return redirect($redirectUrl)
                ->with('success', 'Registration successful! Please login to continue.');
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

    // login storepublic function loginStore(Request $request): RedirectResponse
    public function loginStore(Request $request): RedirectResponse
    {
        // Validate credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Clear any previously set intended URL
            $request->session()->forget('url.intended');

            // Get redirect URL from the form; fallback to a default route if not provided
            $redirectUrl = $request->input('redirect_url', route('frontend.blog.index'));

            return redirect($redirectUrl)
                ->with('success', 'You are now logged in to comment!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }









}
