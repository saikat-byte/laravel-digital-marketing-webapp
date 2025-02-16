<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-3/assets/css/registration-3.css">
</head>
<body>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-3">
                                <a href="{{ route('frontend.page.show', ['slug' => 'home']) }}">
                                    <img src="{{ asset('assets/frontend/media/common/logo/logo.jpg') }}" alt="BootstrapBrain Logo" width="175" height="57">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">
                                Enter your details to register
                            </h2>
                            <form action="{{ route('user.register.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-2 overflow-hidden">

                                    <div class="col-12">
                                        <div class="form-control mb-3">
                                            <img id="profilePreview" src="{{ asset('assets/image/profile-picture/profile-picture.jpg') }}" alt="Profile Picture" width="100" height="100" class="mb-3">
                                            <input type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" id="image_path" placeholder="Enter your full name" value="{{ old('name') }}">
                                            <label for="image_path" class="form-label">Profile picture</label>
                                            @error('image_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="name@example.com" value="{{ old('name') }}">
                                            <label for="name" class="form-label">Name</label>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                            <label for="email" class="form-label">Email</label>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                            <label for="password" class="form-label">Password</label>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="iAgree" id="iAgree">
                                            <label class="form-check-label text-secondary" for="iAgree">
                                                I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" type="submit">Sign up</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">
                                            Already have an account?
                                            <a href="{{ route('user.login') }}" class="link-primary text-decoration-none">Sign in</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- jquery --}}
    <script src="{{ asset('assets/admin/js/core/jquery-3.7.1.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Success alert --}}
    <script src="{{ asset('assets/admin/js/sweetalert/success_alert.js') }}"></script>
    {{-- Delete alert --}}
    <script src="{{ asset('assets/admin/js/sweetalert/delete_alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#image_path').on('change', function(e) {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#profilePreview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });



        // Create successfully
        @if(session('success'))
        Swal.fire({
            icon: 'success'
            , title: 'Success!'
            , text: "{{ session('success') }}"
            , timer: 3000
            , showConfirmButton: false
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error'
            , title: 'Error!'
            , text: "{{ session('error') }}"
            , timer: 3000
            , showConfirmButton: false
        });
        @endif

    </script>
</body>
</html>
