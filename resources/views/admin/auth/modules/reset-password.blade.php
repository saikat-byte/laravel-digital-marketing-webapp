@extends('admin.auth.layouts.master')


@section('title', 'Reset password')

@section('content')

<div class="wrapper">
    <div class="logo">
        <img src="{{ asset('assets/admin/img/cloudspace/cloudspace.jpg') }}" alt="cloudspace logo">
    </div>
    <div class="text-center mt-4 name">
        {{-- Cloudspace solutions --}}
    </div>
    <form action="{{ route('password.store') }}" method="POST" class="p-3 mt-3">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" class=" @error('name') is-invalid @enderror" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        </div>

        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password"  class=" @error('password_confirmation') is-invalid @enderror" name="password" id="pwd" placeholder="New Password">
        </div>

        @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password">
        </div>
        <button class="btn mt-3">Reset password</button>
    </form>

    <div class="text-center fs-6">
        <a href="{{ route('register') }}">Signup?</a> or <a href="{{ route('login') }}">Login</a>
    </div>
</div>

@endsection
