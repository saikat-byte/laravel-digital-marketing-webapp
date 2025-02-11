{{-- @extends('frontend.layouts.master-layout')
@section('meta_tags')
    <title>404 - Page Not Found | {{ config('app.name') }}</title>
<meta name="description" content="Oops! The page you are looking for does not exist.">
<meta name="robots" content="noindex, nofollow">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="404 - Page Not Found">
<meta property="og:description" content="Oops! The page you are looking for does not exist.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('assets/frontend/media/common/default-og-image.jpg') }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="404 - Page Not Found">
<meta name="twitter:description" content="Oops! The page you are looking for does not exist.">
<meta name="twitter:image" content="{{ asset('assets/frontend/media/common/default-twitter-image.jpg') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
<div class="container text-center">
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    <a href="{{ route('frontend.home', ['slug' => 'home']) }}" class="btn btn-primary">Go to Home</a>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Error</title>

<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css">
</head>
<body>
    <!-- Error 404 Template 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                            <span class="display-1 fw-bold">4</span>
                            <i class="bi bi-exclamation-circle-fill text-danger display-4"></i>
                            <span class="display-1 fw-bold bsb-flip-h">4</span>
                        </h2>
                        <h3 class="h2 mb-2">Oops! You're lost.</h3>
                        <p class="mb-5">The page you are looking for was not found.</p>
                        <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="{{ route('frontend.page.show', ['slug' => 'home']) }}" role="button">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
