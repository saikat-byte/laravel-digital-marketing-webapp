@extends('frontend.layouts.master-layout')

@section('title', 'Single Blog')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/single-blog.css') }}">
@endsection


@section('content')
<!-- Single Blog Page Banner Section Start -->
<section class="single-blog-banner">
    <div class="container">
        <div class="single-blog-banner-content">
            <h1>{{ $post->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- Category name in breadcrumb -->
                    <li class="breadcrumb-item">
                        <a href="#">{{ $post->category->title }}</a>
                    </li>

                    <!-- Subcategory name in breadcrumb -->
                    @if ($post->subcategory)
                        <li class="breadcrumb-item">
                            <a href="#">{{ $post->subcategory->title }}</a>
                        </li>
                    @endif

                    <!-- Current page -->
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Single Blog Page Banner Section End -->


<!-- Single blog section start -->
<section class="single-blog">
    <div class="container my-5">
        <div class="row">
            <!-- Main Blog Content Start-->
            <div class="col-lg-8 ">
                <div class="card">
                    <!-- Blog Header -->
                    <div class="blog-header">
                        <img src="{{ asset('assets/image/postimage/original/' . $post->post_image) }}" alt="{{ $post->post_image }}">
                    </div>
                    <div class="blog-content px-2 py-2">
                        <!-- Metadata -->
                        <div class="blog-meta py-1 px-1">
                            <span class="px-1 py-2"><i class="bi bi-pencil"></i> {{ $post->category->title }}</span>
                            <span class="px-1 py-2"><i class="bi bi-chat"></i> 5 Comments</span>
                            <span class="px-1 py-2"><i class="bi bi-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                        </div>

                        <!-- Blog Title -->
                        <h1 class="blog-title">{{ $post->title }}</h1>

                        <!-- Blog Content -->
                        <div class="blog-content">
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p> --}}
                            <blockquote>{{ $post->quote }}</blockquote>
                            <p> {{ strip_tags($post->description) }}</p>
                        </div>

                        <!-- Tags and Share Links -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="tags">
                                    @foreach($post->tag as $tag)
                                    <span>{{ $tag->title }}</span>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="share-links mt-2">
                                    <a href="#">Facebook</a>
                                    <a href="#">Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination Links -->
                <div class="card my-3">
                    <div class="pagination-links mt-4 d-flex justify-content-between px-2 py-2 my-3">
                        <a href="#">← Previous Post</a>
                        <a href="#">Next Post →</a>
                    </div>
                </div>


                <!-- Comments Section -->
                <div class="comment-section card px-2 py-2">
                    <h6 class="px-2">2 Comments</h6>
                    <div class="comment-box">
                        <img src="{{ asset('assets/frontend/media/common/images/profile/user_1.jpg') }}" alt="User">
                        <div>
                            <h5>John Doe</h5>
                            <div class="d-flex justify-content-between ">
                                <p class="text-muted comment-text-country">United Kingdom | Posted October 7, 2018 </p>
                            </div>
                            <p>Some consultants are employed indirectly by the client...</p>
                        </div>
                        <div class="reply-box">
                            <p class="reply-text"><a href="" class="gradient-glow-button ">Reply</a></p>
                        </div>
                    </div>
                    <div class="comment-box">
                        <img src="{{ asset('assets/frontend/media/common/images/profile/user_1.jpg') }}" alt="User">
                        <div>
                            <h5>John Doe</h5>
                            <div class="d-flex justify-content-between ">
                                <p class="text-muted comment-text-country">United Kingdom | Posted October 7, 2018 </p>
                            </div>
                            <p>Some consultants are employed indirectly by the client...</p>
                        </div>
                        <div class="reply-box">
                            <p class="reply-text"><a href="" class="gradient-glow-button ">Reply</a></p>
                        </div>
                    </div>
                </div>

                <!-- Write Comment -->
                <div class="write-comment mt-4 card  px-2 py-2">
                    <h4>Write a Comment</h4>
                    <form>
                        <input type="text" class="mb-3" placeholder="Name">
                        <input type="email" class="mb-3" placeholder="Email">
                        <textarea placeholder="Comment" class="mb-3"></textarea>
                        <button type="submit" class="gradient-glow-button">Submit Message</button>
                    </form>
                </div>
            </div>
            <!-- Main Blog Content End-->

            <!-- Sidebar Start-->
            <div class="col-lg-4 single-blog-right-side">
                <!-- Search -->
                <div class="card px-2 py-2 my-3">
                    <form>
                        <input type="text" class="form-control mb-1" placeholder="Search">
                        <button class="gradient-glow-button w-100">Search</button>
                    </form>
                </div>

                <!-- Author Widget -->
                <div class="card text-center px-2 py-2 mb-3">
                    <img src="{{ asset('assets/frontend/media/common/images/profile/user_1.jpg') }}" alt="Author">
                    <h5 class="mt-3">Arther Conal</h5>
                    <p class="text-muted">Digital Marketer</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                </div>

                <!-- Latest Posts -->
                <div class="card latest-posts py-2 mb-3">
                    <h5 class="text-center">Latest Posts</h5>
                    <ul>
                        @foreach ($posts as $post)
                        @php
                        // Extract the filename and extension from the post_image
                        $filename = pathinfo($post->post_image, PATHINFO_FILENAME); // demo_1
                        $extension = pathinfo($post->post_image, PATHINFO_EXTENSION); // webp

                        // Construct the thumbnail image path
                        $thumbnailImage = $filename . '_thumb.' . $extension; // demo_1_thumbnail.webp
                        @endphp
                        <li class="latest-post-list">
                            <img src="{{ asset('assets/image/postimage/thumbnail/' . $thumbnailImage) }}" alt="Post Image">
                            <div>
                                <a href="{{ route('frontend.single.blog', $post->id) }}">{{ $post->title }}</a>
                                <p class="text-muted">{{ $post->created_at->format('d M Y') }}</p>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Category -->
                <div class="card px-2 py-2">
                    <h5 class="text-center">Category</h5>
                    <div class="category-list">
                        <div class="list-group">
                            @foreach($categories as $index => $category)
                                @php
                                    $bgColor = $loop->iteration % 2 == 0 ? 'bg-primary text-white' : 'bg-success text-white';
                                @endphp
                                <!-- Category Title with Alternate Background Colors -->
                                <a href="#category{{ $category->id }}" class="list-group-item list-group-item-action {{ $bgColor }}" data-bs-toggle="collapse" aria-expanded="false">
                                    {{ $category->title }}
                                </a>
                                <!-- Subcategories -->
                                <div class="collapse" id="category{{ $category->id }}">
                                    @if($category->subcategories->count() > 0)
                                        <ul class="list-group">
                                            @foreach($category->subcategories as $subcategory)
                                                <li class="list-group-item bg-light text-dark"><a href="#">{{ $subcategory->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Tags -->
                <div class="card px-2 py-2">
                    <h5 class="text-center">Tags cloud</h5>
                    <div class="tags">
                        @foreach($tags as $tag)
                        <a href="#"> <span>{{ $tag->title }}</span></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Sidebar End-->

        </div>
    </div>
</section>
<!-- Single blog section start -->
@endsection

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var collapseTriggers = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapseTriggers.forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var target = document.querySelector(trigger.getAttribute('href'));
                if (target.classList.contains('show')) {
                    target.classList.remove('show');
                } else {
                    target.classList.add('show');
                }
            });
        });
    });

</script>
@endsection
