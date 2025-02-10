@extends('frontend.layouts.master-layout')

@section('title', 'Blog')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/blog.css') }}">
@endsection

@section('content')

<!-- Blog banner section start -->
<section class="blog-banner">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side Content -->
            <div class="col-lg-6">
                <h2>Our Blog</h2>
                <h1 class="text-white text-capitalize">Company News And Updates</h1>
                <p>
                    Every week we share out expertise on effective strategies and technics
                    to help you reach customers and prospects across the entire web.
                </p>
                <div class="badge-images ">
                    <img src="{{ asset('assets/frontend/media/common/icon/upword.png') }}" alt="Upwork">
                    <img src="{{ asset('assets/frontend/media/common/icon/google_review.png') }}" alt="Google Rating">
                </div>
            </div>
            <!-- Right Side Illustration -->
            <div class="col-lg-6 illustration text-center">
                <div class="image-wrapper">
                    <img id="hover-image" class="fade-image" src="{{ asset('assets/frontend/media/pages/blog/images/social_media.jpg') }}" alt="Illustration">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog banner section End -->


<!-- Blog card section Start -->
<section class="blog-posts py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Card 1 -->

            @foreach ($posts as $post)
            <div class="col-lg-6">
                <div class="card blog-card">
                    <img src="{{ asset('assets/image/postimage/original/'. $post->post_image) }}" alt="{{ asset('assets/image/postimage/original'. $post->post_image) }}">
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>{{ $post->category->title }}</span> | <span>5 Comments</span> | <span>{{ $post->created_at->format('d-M-Y') }}</span>
                        </p>
                        <h5 class="blog-title">{{ $post->title }}</h5>
                        <p class="blog-text">
                            {{ Str::words(strip_tags($post->description), 10, '...') }}
                        </p>
                        <a href="{{ route('frontend.single.blog', $post->id) }}" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                {{ $posts->links() }}
            </ul>
        </nav>
    </div>
</section>
<!-- Blog card section End -->

@endsection

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/blog.js') }}"></script>
@endpush
