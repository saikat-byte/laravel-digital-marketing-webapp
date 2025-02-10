@extends('frontend.layouts.master-layout')

@section('title', 'Service')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/service.css') }}">
@endsection

@section('content')

<!-- Service Banner Start-->
<section class="service-banner">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Column with Image -->
            <div class="col-lg-6 banner-left p-0">
                <img src="{{ asset('assets/frontend/media/pages/service/images/left_side_banner.jpg') }}" alt="Left Banner Image" class="img-fluid h-100 w-100" id="bannerLeftImage">
            </div>
            <!-- Right Column with Gradient Background -->
            <div class="col-lg-6 banner-right d-flex flex-column justify-content-start align-items-start">
                <div class="content-wrapper">
                    <h1 class="fw-bold">Digital Marketing</h1>
                    <h3 class="mb-3 fs-4">Service</h3>
                    <p class="mb-4">
                        Our digital marketing services encompass SEO, PPC, social media management, content
                        creation,
                        email marketing, and web development. We create tailored strategies to enhance your online
                        visibility, engage your target audience, and drive measurable growth.
                    </p>
                    <a href="#" class="gradient-glow-button text-uppercase">Get Service</a>
                </div>
            </div>
        </div>

        <!-- Cards Slider -->
        <div class="card-slider-wrapper">
            <div class="card-slider">
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/social_media.jpg') }}" alt="Web Development">
                    <a href="#" class="card-title text-uppercase">Web Development</a>
                </div>
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/social_media_marketing.jpg') }}" alt="Social Media Marketing">
                    <a href="#" class="card-title text-uppercase">Social Media Marketing</a>
                </div>
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/web_development.jpg') }}" alt="Digital Marketing">
                    <a href="#" class="card-title text-uppercase">Digital Marketing</a>
                </div>
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/youtube.jpg') }}" alt="Graphic Design">
                    <a href="#" class="card-title text-uppercase">Graphic Design</a>
                </div>
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/social_media.jpg') }}" alt="YouTube Marketing">
                    <a href="#" class="card-title text-uppercase">YouTube Marketing</a>
                </div>
                <div class="service-card">
                    <img src="{{ asset('assets/frontend/media/pages/service/images/cards/web_development.jpg') }}" alt="Social Media Marketing">
                    <a href="#" class="card-title text-uppercase">Social Media Marketing</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Banner End-->

<!-- Why Choose Us Start-->
<section class="why-choose-us py-5">
    <div class="container">
        <!-- Heading -->
        <div class="text-center mb-5">
            <h4 class="text-primary fw-bold">WHY CHOOSE US <br>YOUR TRUSTED DIGITAL MARKETING AGENCY </h4>
        </div>

        <!-- Video Section -->
        <div class="video-wrapper text-center mb-5">
            <div class="video-container position-relative">
                <video id="videoElement" class="w-100 rounded" src="{{ asset('assets/frontend/media/pages/service/video/banner_video.mp4') }}" muted></video>
                <div id="playButtonWrapper" class="play-button position-absolute top-50 start-50 translate-middle">
                    <button id="playButton" class="gradient-glow-button">
                        <i id="playIcon" class="fa fa-play"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us End-->

<!-- Common contact form start -->
<section class="contact-section">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <!-- Left Column (Form) -->
            <div class="col-lg-4 mb-5 mb-lg-0 left-col d-flex flex-column justify-content-center">
                <div class="text-top mb-4">
                    <h3 class="text-uppercase text-center">READY TO ELEVATE YOUR BRAND? <br>CONTACT US TODAY </h3>
                </div>

                <!-- Form Wrapper with Gradient Border -->
                <div class="form-wrapper p-4">
                    <h5 class="mb-3 text-uppercase">TAKE FIRST STEP TOWARD!</h5>
                    <!-- Contact Form -->
                    <form class="text-center">
                        <div class="mb-3">
                            <input type="text" class="form-control custom-input" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control custom-input" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control custom-input" placeholder="+91 Phone Number">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control custom-input" placeholder="Service">
                        </div>
                        <button type="submit" class="gradient-glow-button w-100 mt-2">
                            START YOUR PROJECT
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column (Heading, Sub-heading & Text + Three Part) -->
            <div class="col-lg-6 right-col d-flex flex-column justify-content-center">
                <!-- Heading & Sub Heading -->
                <h2 class="fw-bold mb-3">DIGITIZING YOUR BUSINESS GROWTH!</h2>
                <h5 class="mb-3">Ready to take your business to the next level?</h5>

                <!-- Paragraph -->
                <p class="">
                    Boosting your online presence with digitalmarketing, creating stunning visuals with graphic
                    design,
                    developing a website, growing your YouTube channel, social media marketing, Reels & Shorts
                    creation...
                    we've got you covered!
                </p>

                <!-- Three Part Section with Divider Lines -->
                <div class="three-part row mt-4">
                    <!-- Part 1 -->
                    <div class="col-3 text-start">
                        <div class="part-title text-uppercase">EXPERT</div>
                        <div class="part-subtitle fw-bold">TEAM MEMBERS</div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <div class="divider"></div>
                    </div>
                    <!-- Part 2 -->
                    <div class="col-3 text-start">
                        <div class="part-title text-uppercase">RESULTS-DRIVEN</div>
                        <div class="part-subtitle fw-bold">APPROACH</div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <div class="divider"></div>
                    </div>
                    <!-- Part 3 -->
                    <div class="col-3 text-start">
                        <div class="part-title text-uppercase">STREAMLINED</div>
                        <div class="part-subtitle fw-bold">EXECUTION</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Common contact form End -->

<!-- Watermark section Start -->
@include('frontend.layouts.common_section.water-mark-section')
<!-- Watermark Section End -->

<!-- FAQ Section Start-->
@include('frontend.layouts.common_section.faq-section')
<!-- FAQ Section Start-->

<!-- Download Section Start-->
@include('frontend.layouts.common_section.download-section')
<!-- Download Section End-->
@endsection

@push('custom_js')
<script>
    // card slider and accordion code and banner image change on hover
    $(document).ready(function() {
        // main image link collect
        let originalSrc = $("#bannerLeftImage").attr("src");

        // (card-slider এ Hover listener)
        $(".card-slider").on("mouseenter", ".service-card", function() {
            let hoveredImgSrc = $(this).find("img").attr("src");

            // step by step fading effect
            $("#bannerLeftImage").fadeOut(300, function() {
                // image source changes
                $(this).attr("src", hoveredImgSrc);
                // again fadein
                $(this).fadeIn(1000);
            });
        });

        $(".card-slider").on("mouseleave", ".service-card", function() {
            // return fade
            $("#bannerLeftImage").fadeOut(300, function() {
                $(this).attr("src", originalSrc);
                $(this).fadeIn(300);
            });
        });

        // ---- before slider code (Infinite Loop) ----
        const $slider = $(".card-slider");
        let $cards = $slider.find(".service-card");
        const cardWidth = $cards.outerWidth(true);

        // Clone cards for seamless loop
        $slider.append($cards.clone());
        $slider.append($cards.clone());
        $cards = $slider.find(".service-card"); //new card update

        let translateX = 0;
        const speed = 1; // scrolling speed

        function animateSlider() {
            translateX -= speed;
            if (Math.abs(translateX) >= $cards.length * cardWidth) {
                translateX = 0;
            }
            $slider.css("transform", `translateX(${translateX}px)`);
            requestAnimationFrame(animateSlider);
        }

        let animationFrame = requestAnimationFrame(animateSlider);

        // Pause animation on hover
        $slider.hover(
            function() {
                cancelAnimationFrame(animationFrame);
            }
            , function() {
                animationFrame = requestAnimationFrame(animateSlider);
            }
        );
    });

</script>
@endpush

@push('custom_js')
    {{-- Frequently ask question (Accordion Code) --}}
    <script src="{{ asset('assets/frontend/jquery/faq-ask.js') }}"></script>
    {{-- video play button --}}
    <script src="{{ asset('assets/frontend/jquery/video-play-btn.js') }}"></script>
@endpush
