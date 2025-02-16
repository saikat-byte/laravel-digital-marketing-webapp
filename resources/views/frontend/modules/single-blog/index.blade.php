@extends('frontend.layouts.master-layout')

@section('title', $post->title)

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/single-blog.css') }}">
@endsection

@section('content')

<!-- Single Blog Page Banner Section Start -->
<section class="single-blog-banner" style="background-image: url('{{ asset($bannerImage) }}');">
    <div class="container">
        <div class="single-blog-banner-content text-center text-white">
            <h1>{{ $post->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.blog.index') }}">Blog</a></li>
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
            <!-- Main Blog Content Start -->
            <div class="col-lg-8">
                <div class="card">
                    <!-- Blog Header (Optional: You can also show a smaller image here if needed) -->
                    <div class="blog-header">
                        @if($post->post_image)
                        <img src="{{ asset('assets/image/postimage/original/' . $post->post_image) }}" alt="{{ $post->title }}">
                        @else
                        <img src="{{ asset('assets/frontend/media/pages/blog/images/default_blog.jpg') }}" alt="Blog Header Image">
                        @endif
                    </div>
                    <div class="blog-content px-2 py-2">
                        <!-- Metadata -->
                        <div class="blog-meta py-1 px-1">
                            <span class="px-1 py-2">
                                <i class="bi bi-pencil"></i> {{ $post->category->title ?? 'Uncategorized' }}
                            </span>
                            <span class="px-1 py-2">
                                <i class="bi bi-chat"></i> {{ $post->comments ? $post->comments->count() : '0' }} Comments
                            </span>
                            <span class="px-1 py-2">
                                <i class="bi bi-calendar"></i> {{ $post->created_at->format('d M, Y') }}
                            </span>
                        </div>

                        <!-- Blog Title -->
                        <h1 class="blog-title">{{ $post->title }}</h1>

                        <!-- Blog Content -->
                        <div class="blog-content">
                            @if( $post->description)
                            <p>{{ Str::limit(strip_tags($post->description), 20) }}</p>
                            @endif
                            @if($post->quote)
                            <blockquote>{{ $post->quote }}</blockquote>
                            @endif
                            @if( $post->description)
                            <p>{{ strip_tags($post->description)}}</p>
                            @endif
                        </div>

                        <!-- Tags and Share Links -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="tags">
                                    @if($post->tags && $post->tags->count())
                                    @foreach ($post->tags as $tag)
                                    <a href="{{ route('frontend.blog.search', ['tag' => $tag->slug]) }}">
                                        <span>{{ $tag->title }}</span>
                                    </a>
                                    @endforeach
                                    @else
                                    <span>No tags</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="share-links mt-2">
                                    {{-- <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank">Facebook</a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank">Twitter</a> --}}
                                    <a href="#" target="_blank">Facebook</a>
                                    <a href="#" target="_blank">Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Navigation (Previous/Next Post) -->
                <div class="card my-3">
                    <div class="pagination-links mt-4 d-flex justify-content-between px-2 py-2 my-3">
                        @if($previousPost = $post->previous()) {{-- Assuming helper method --}}
                        <a href="{{ route('frontend.blog.show', $previousPost->slug) }}">← Previous Post</a>
                        @else
                        <span class="text-muted">No previous post</span>
                        @endif
                        @if($nextPost = $post->next()) {{-- Assuming helper method --}}
                        <a href="{{ route('frontend.blog.show', $nextPost->slug) }}">Next Post →</a>
                        @else
                        <span class="text-muted">No next post</span>
                        @endif
                    </div>
                </div>


                <!-- Write Comment Section -->
                <div class="write-comment mt-4 card px-2 py-2">
                    <h4>Write a Comment</h4>
                    <!-- যদি total_comments attribute ব্যবহার না করেন, তাহলে নিচের কোড ব্যবহার করুন: -->
                    <h6 class="px-2">{{ $post->comments->count() }} Comments</h6>

                    <!-- Display existing comments -->
                    @foreach($post->comments as $comment)
                    @php
                    // Calculate parent comment user image path
                    $parentImage = trim($comment->user->image_path);
                    if(empty($parentImage)) {
                    $parentImage = 'assets/image/profile-picture/profile-picture.jpg';
                    }
                    @endphp
                    <div class="comment-box my-2">
                        <img src="{{ asset($parentImage) }}" alt="User" class="rounded-circle" width="50">

                        <div class="ms-2">
                            <h5>{{ $comment->user->name }}</h5>
                            <p class="text-muted small">
                                {{ $comment->user->country ?? 'Unknown' }} | Posted {{ $comment->created_at->format('d M, Y') }}
                            </p>
                            <p>{{ $comment->content }}</p>
                            <button class="btn btn-sm btn-link reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>
                        </div>
                    </div>

                    <!-- Nested Replies -->
                    @if($comment->replies && $comment->replies->count())
                    <div class="nested-comments ms-5">
                        @foreach($comment->replies as $reply)
                        @php
                        // Calculate reply's user image path separately
                        $replyImage = trim($reply->user->image_path);
                        if(empty($replyImage)) {
                        $replyImage = 'assets/image/profile-picture/profile-picture.jpg';
                        }
                        @endphp
                        <div class="comment-box my-2">
                            <img src="{{ asset($replyImage) }}" alt="User" class="rounded-circle" width="50">
                            <div class="ms-2">
                                <h5>{{ $reply->user->name }}</h5>
                                <p class="text-muted small">
                                    {{ $reply->user->country ?? 'Unknown' }} | Posted {{ $reply->created_at->format('d M, Y') }}
                                </p>
                                <p>{{ $reply->content }}</p>
                                <button class="btn btn-sm btn-link reply-btn" data-comment-id="{{ $reply->id }}">Reply</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Hidden Reply Form for Each Comment -->
                    <div class="reply-form mt-2 ms-5" id="reply-form-{{ $comment->id }}" style="display:none;">
                        @if(Auth::check())
                        <form action="{{ route('comment.store', $post->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                            <textarea name="content" class="form-control mb-2" placeholder="Write your reply here..." required></textarea>
                            <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                        </form>
                        @else
                        <p>Please <a href="{{ route('user.login') }}">login</a> to reply.</p>
                        @endif
                    </div>
                    @endforeach

                    <!-- Write Comment Form -->
                    <div class="write-comment-form mt-4">
                        @if(Auth::check())
                        <form action="{{ route('comment.store', $post->id) }}" method="POST">
                            @csrf
                            <input type="text" class="form-control mb-3" placeholder="Name" value="{{ Auth::user()->name }}" readonly>
                            <input type="email" class="form-control mb-3" placeholder="Email" value="{{ Auth::user()->email }}" readonly>
                            <textarea name="content" class="form-control mb-3" placeholder="Comment" required></textarea>
                            <button type="submit" class="gradient-glow-button">Submit Comment</button>
                        </form>
                        @else
                        <p>Please <a href="{{ route('user.login') }}">login</a> or <a href="{{ route('user.register') }}">register</a> to comment.</p>
                        @endif
                    </div>
                </div>


            </div>
            <!-- End Main Blog Content -->

            <!-- Sidebar Start -->
            <div class="col-lg-4 single-blog-right-side">
                <!-- Search Widget -->
                <div class="card px-2 py-2 my-3">
                    <form action="{{ route('frontend.singleblog.search') }}" method="GET">
                        <input type="text" name="search" class="form-control mb-1" placeholder="Search" value="{{ request('search') }}">
                        <button type="submit" class="gradient-glow-button w-100">Search</button>
                    </form>
                </div>


                <!-- Categories Widget -->
                <div class="card px-2 py-2 mb-3">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        @foreach($categories as $category)
                        <li>
                            <!-- Parent category link with collapse toggle -->
                            <a href="{{ route('frontend.blog.search', ['category' => $category->slug]) }}" data-bs-toggle="collapse" data-bs-target="#subCategory{{ $category->id }}" aria-expanded="false" aria-controls="subCategory{{ $category->id }}">
                                {{ $category->title }}
                                @if($category->subcategories->count())
                                <i class="bi bi-caret-down-fill"></i>
                                @endif
                            </a>

                            <!-- Subcategories list; collapsible -->
                            @if($category->subcategories->count())
                            <ul class="list-unstyled collapse" id="subCategory{{ $category->id }}">
                                @foreach($category->subcategories as $subCategory)
                                <li class="ms-3">
                                    <a href="{{ route('frontend.blog.search', ['category' => $category->slug, 'subcategory' => $subCategory->slug]) }}">
                                        {{ $subCategory->title }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>


                <!-- Latest Posts Widget -->
                <div class="card latest-posts py-2 mb-3">
                    <h5 class="text-center">Latest Posts</h5>
                    <ul>
                        @foreach($latestPosts as $latest)
                        <li class="latest-post-list">
                            @if($latest->post_image)
                            <img src="{{ asset('assets/image/postimage/thumbnail/' . pathinfo($latest->post_image, PATHINFO_FILENAME) . '_thumb.' . pathinfo($latest->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $latest->title }}">
                            @else
                            <img src="{{ asset('assets/frontend/media/pages/blog/images/default_blog.jpg') }}" alt="{{ $latest->title }}">
                            @endif
                            <div>
                                <a href="{{ route('frontend.blog.show', $latest->slug) }}">{{ $latest->title }}</a>
                                <p class="text-muted">{{ $latest->created_at->format('d M, Y') }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tags Widget -->
                <div class="card px-2 py-2">
                    <h5>Tags</h5>
                    <div class="tags">
                        @foreach($tags as $tag)
                        <a href="{{ route('frontend.blog.search', ['tag' => $tag->slug]) }}"><span>{{ $tag->title }}</span></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>
<!-- Single blog section end -->

@endsection

@push('custom_js')
<script>
    $(document).ready(function() {
        $('.reply-btn').on('click', function() {
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).toggle();
        });
    });

</script>

@endpush
