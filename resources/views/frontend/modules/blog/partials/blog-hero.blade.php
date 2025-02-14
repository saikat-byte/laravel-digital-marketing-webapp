@if($section->status == 1)
<!-- Blog banner section start -->
<section class="blog-banner">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side Content -->
            <div class="col-lg-6">
                <h2>Our Blog</h2>
                <h1 class="text-white">Company News and Updates</h1>
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
@endif
