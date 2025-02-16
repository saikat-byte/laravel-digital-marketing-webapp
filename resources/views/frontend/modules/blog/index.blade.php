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
                <h1 class="text-white">Company News and Updates</h1>
                <p>
                    Every week we share our expertise on effective strategies and techniques
                    to help you reach customers and prospects across the entire web.
                </p>
                <div class="badge-images">
                    <div class="card px-2 py-2 my-3">
                        <form action="{{ route('frontend.blog.search') }}" method="GET">
                            <input type="text" name="search" class="form-control mb-1" placeholder="Search" value="{{ request('search') }}">
                            <button type="submit" class="gradient-glow-button w-100">Search</button>
                        </form>
                    </div>
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
            @forelse($posts as $post)
            <div class="col-lg-6">
                <div class="card blog-card">
                    @if($post->post_image)
                    <img src="{{ asset('assets/image/postimage/thumbnail/' . pathinfo($post->post_image, PATHINFO_FILENAME) . '_thumb.' . pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->title }}">
                    @else
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/social_media_marketing.jpg') }}" alt="Blog Image">
                    @endif
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>{{ $post->category->title ?? 'Uncategorized' }}</span> |
                            <span>{{ $post->comments ? $post->comments->count() : '0' }} Comments</span> |
                            <span>{{ $post->created_at->format('d M, Y') }}</span>
                        </p>
                        <h5 class="blog-title">{{ $post->title }}</h5>
                        <p class="blog-text">
                            {{Str::limit(strip_tags($post->description), 30) }}
                        </p>
                        <a href="{{ route('frontend.blog.show', $post->slug) }}" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p>No posts available.</p>
            </div>
            @endforelse
        </div>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</section>
<!-- Blog card section End -->

@endsection

@push('custom_js')
{{-- <script src="{{ asset('assets/frontend/jquery/blog.js') }}"></script> --}}
@endpush
