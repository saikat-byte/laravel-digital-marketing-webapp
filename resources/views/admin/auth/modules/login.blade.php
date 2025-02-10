@extends('admin.auth.layouts.master')


@section('title', 'Login')

@section('content')

<div class="wrapper">
    <div class="logo">
        <img src="{{ asset('assets/admin/img/cloudspace/cloudspace.jpg') }}" alt="cloudspace logo">
    </div>
    <div class="text-center mt-4 name">
        {{-- Cloudspace solutions --}}
    </div>
    <form action="{{ route('login') }}" method="POST" class="p-3 mt-3">
        @csrf
        @if ($errors->has('email'))
        <small class="text-danger">{{ $errors->first('email') }}</small>
        @endif
        @if ($errors->has('password'))
        <small class="text-danger">{{ $errors->first('password') }}</small>
        @endif
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="pwd" placeholder="Password">

        </div>
        <button class="btn mt-3">Login</button>

        <!-- General error message (optional) -->
        @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
        @endif
    </form>

    @include('admin.auth.layouts.signup-forgot-link')
</div>

@endsection
