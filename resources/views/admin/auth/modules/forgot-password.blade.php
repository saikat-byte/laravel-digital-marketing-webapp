@extends('admin.auth.layouts.master')


@section('title', 'Forgot password')

@section('content')
<div class="wrapper" style="min-height: 200px;">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="logo">
        <img src="{{ asset('assets/admin/img/cloudspace/cloudspace.jpg') }}" alt="cloudspace logo">
    </div>
    <div class="text-center mt-4 name">
        {{-- Cloudspace solutions --}}
    </div>
    <form action="{{ route('password.email') }}" method="POST" class="p-3 mt-3">
        @csrf
        @if ($errors->has('email'))
        <small class="text-danger">{{ $errors->first('email') }}</small>
        @endif
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        </div>
        <button class="btn mt-3">Password Reset Link</button>
    </form>

    <div class="text-center fs-6">
        <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Sign up</a>
    </div>
</div>
@endsection
