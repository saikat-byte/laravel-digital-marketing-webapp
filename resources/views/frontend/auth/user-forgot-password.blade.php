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
                                    <img src="{{ asset('assets/frontend/media/common/logo/logo.jpg') }}" alt="Logo" width="175" height="57">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">
                                Enter your email to reset your password
                            </h2>
                            <form action="{{ route('user.password.email') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                    <label for="email" class="form-label">Email</label>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-grid my-3">
                                    <button class="btn btn-primary btn-lg" type="submit">Send Reset Link</button>
                                </div>
                                <div class="text-center">
                                    <p class="m-0 text-secondary">
                                        Remember your password? <a href="{{ route('user.login') }}" class="link-primary text-decoration-none">Login</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
