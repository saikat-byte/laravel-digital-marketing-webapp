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
            <h1>Blog Single</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News details</li>
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
                        <img src="{{ asset('assets/frontend/media/pages/blog/images/social_media_marketing.jpg') }}" alt="Blog Header Image">
                    </div>
                    <div class="blog-content px-2 py-2">
                        <!-- Metadata -->
                        <div class="blog-meta py-1 px-1">
                            <span class="px-1 py-2"><i class="bi bi-pencil"></i> Creativity</span>
                            <span class="px-1 py-2"><i class="bi bi-chat"></i> 5 Comments</span>
                            <span class="px-1 py-2"><i class="bi bi-calendar"></i> 28th January</span>
                        </div>

                        <!-- Blog Title -->
                        <h1 class="blog-title">Improve design with typography?</h1>

                        <!-- Blog Content -->
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                            <blockquote>A brand for a company is like a reputation for a person...</blockquote>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab deleniti tempore sunt nemo impedit earum adipisci optio unde, quibusdam maiores eligendi hic explicabo temporibus illo voluptate quaerat, non officia rem cum expedita culpa, accusantium illum voluptas? Voluptate id laudantium sint nisi ullam corrupti. Quia amet eligendi iusto, labore fugit consectetur.</p>
                        </div>

                        <!-- Tags and Share Links -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="tags">
                                    <span>Advance</span>
                                    <span>Landscape</span>
                                    <span>Travel</span>
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
                        <li class="latest-post-list">
                            <img src="{{ asset('assets/frontend/media/pages/blog/images/social_media_marketing.jpg') }}" alt="Post Image">
                            <div>
                                <a href="#">Thoughtful living in Los Angeles</a>
                                <p class="text-muted">03 Mar 2018</p>
                            </div>
                        </li>
                        <li class="latest-post-list">
                            <img src="{{ asset('assets/frontend/media/pages/blog/images/web_development.jpg') }}" alt="Post Image">
                            <div>
                                <a href="#">Thoughtful living in Los Angeles</a>
                                <p class="text-muted">03 Mar 2018</p>
                            </div>
                        </li>
                        <li class="latest-post-list">
                            <img src="{{ asset('assets/frontend/media/pages/blog/images/youtube.jpg') }}" alt="Post Image">
                            <div>
                                <a href="#">Thoughtful living in Los Angeles</a>
                                <p class="text-muted">03 Mar 2018</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Tags -->
                <div class="card px-2 py-2">
                    <h5>Tags</h5>
                    <div class="tags">
                        <span>Web</span>
                        <span>Agency</span>
                        <span>Creative</span>
                        <span>Design</span>
                    </div>
                </div>
            </div>
            <!-- Sidebar End-->

        </div>
    </div>
</section>
<!-- Single blog section start -->
@endsection
