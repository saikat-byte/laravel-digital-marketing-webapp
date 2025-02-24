@extends('admin.layouts.master')

@section('name', 'User Profile Edit')
@section('title', 'User Profile')

@section('content')
<div class="page-inner">
    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.users.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}">@yield('name')</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">@yield('title')</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank if not changing)</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <!-- User Type Field -->
                        <div class="mb-3">
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-select" id="user_type" name="user_type">
                                <option value="user" {{ old('user_type', $user->user_type) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('user_type', $user->user_type) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="moderator" {{ old('user_type', $user->user_type) == 'moderator' ? 'selected' : '' }}>Moderator</option>
                            </select>
                            @error('user_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Profile Image Field with Preview -->
                        <div class="mb-3">
                            <div class="mb-2">
                                <img id="imagePreview" src="{{ asset($user->image_path) }}" alt="Profile Image" class="avatar-img rounded-circle" style="max-width: 150px;">
                            </div>
                            <input type="file" class="form-control" id="image" name="image_path" accept="image/*">
                            @error('image_path')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Profile details</h4>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info">Back to Users</a>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email}}</td>
                                </tr>
                                <tr>
                                    <th>Profile photo</th>
                                    <td>
                                        @php
                                        $imagePath = $user->image_path ? $user->image_path : 'assets/image/profile-picture/default.jpg';
                                        @endphp
                                        <img src="{{ asset($imagePath) }}" alt="{{ $user->name }}" width="50" class="rounded-circle">
                                    </td>
                                </tr>
                                <tr>

                                    <th>User type</th>
                                    <td>{{ $user->user_type }}</td>
                                </tr>

                            <tbody>
                        </table>
                    </div>
                </div>







            </div>
        </div>



    </div>
</div>
@endsection

@push('custom_js')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    @include('admin.partials.sweet-alert')

</script>
@endpush
