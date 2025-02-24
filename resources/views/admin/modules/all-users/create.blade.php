@extends('admin.layouts.master')

@section('name', 'User Create')
@section('title', 'Create New User')

@section('content')
<div class="page-inner">
    {{-- Breadcrumb Start --}}
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Create New User</h3>
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
                <a href="{{ route('admin.users.index') }}">Users</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Create New User</a>
            </li>
        </ul>
    </div>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter user's name" value="{{ old('name') }}" required>
                </div>

                <!-- Email Field -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter user's email" value="{{ old('email') }}" required>
                </div>

                <!-- User Type Field -->
                <div class="form-group mb-3">
                    <label for="user_type" class="form-label">User Type</label>
                    <select name="user_type" id="user_type" class="form-select" required>
                        <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="moderator" {{ old('user_type') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                    </select>
                </div>

                <!-- Password Field -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required>
                </div>

                <!-- Profile Image Field -->
                <div class="mb-3">
                    <label for="image_path" class="form-label">Profile Image (Optional)</label>
                    <div class="mb-2">
                        <img id="imagePreview" src="{{ isset($user) && $user->image_path ? asset($user->image_path) : '' }}"
                             alt="Profile Image" class="avatar-img rounded-circle"
                             style="max-width: 150px; display: {{ isset($user) && $user->image_path ? 'block' : 'none' }};">
                    </div>
                    <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script>
    @push('custom_js')
<script>
    $(document).ready(function () {
        // Profile Image Preview
        $('#image_path').change(function (event) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        // যদি Edit Page-এ Default Image থেকে নতুন Image Select করা হয়
        if (!$('#imagePreview').attr('src')) {
            $('#imagePreview').hide();
        }
    });
</script>
@endpush

</script>
@endpush
