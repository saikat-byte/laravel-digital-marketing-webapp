@extends('frontend.layouts.master-layout')

@section('title', 'Case studies')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/case-studies.css') }}">
@endsection

@section('content')

<!-- Banner section Start -->
<section class="banner-section d-flex align-items-center justify-content-center text-center">
    <div class="banner-overlay"></div>

    <div class="container text-center">
        <div class="banner-content text-center">
            <h1 class="text-white mb-3">CASE STUDIES</h1>
            <h2 class="mb-4">
                WE FOCUS ON DRIVING MEASURABLE RESULTS
            </h2>
        </div>

        <!-- Button -->
        <div class="button-row text-center">
            <div class=" text-center">
                <a href="#" class="gradient-glow-button">GET Free QUOTE</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner section End -->

<!-- Marketing section Start -->
<section class="container-fluid">
    <div class="row">
        <!-- Left 4 columns (Gradient + Logos) -->
        <div class="col-lg-4 gradient-col text-white text-end d-flex flex-column p-4">
            <div class="left-side">
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Logo 1" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="Logo 2" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Logo 1" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="Logo 2" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" class="logo-img">
                    <hr class="white-separator">
                </div>
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" class="logo-img">
                    <hr class="white-separator">
                </div>
            </div>
        </div>

        <!-- Right 8 columns (Heading, Text, Image, Buttons) -->
        <div class="col-lg-8 content-col p-4">
            <!-- Heading Triangle icon -->
            <div class="right-side">
                <div class="d-flex align-items-center mb-3">
                    <div class="triangle-icon me-2"></div>
                    <h2 class="mb-0" style="color: #144a9b;">
                        NEQUE PORRO QUISQUAM EST QUI DOLOREM IPSUM QUIA DOLOR SIT AMET
                    </h2>
                </div>

                <!-- Paragraph 1 -->
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged.
                </p>

                <!-- Image -->
                <div class="text-center my-3">
                    <img src="{{ asset('assets/frontend/media/pages/case_studies/images/digital_marketing.jpg') }}" alt="Digital Marketing" class="img-fluid content-image">
                </div>

                <!-- Paragraph 2 -->
                <p>
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                    passages,
                    and more recently with desktop publishing software like Aldus PageMaker including versions of
                    Lorem
                    Ipsum.
                </p>

                <!-- Buttons -->
                <div class="mt-4">
                    <button class="gradient-glow-button gradient-btn me-2">
                        START PROJECT
                    </button>
                    <button class="gradient-glow-button gradient-btn">
                        OUR SERVICE
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Marketing section End -->

<!-- Video ribbon section Start -->
<section class="video-ribbon-section position-relative">
    <!-- Container-fluid ribbon upto right screen -->
    <div class="container-fluid py-5 position-relative">
        <div class="row g-0 align-items-center">

            <!-- Video Column left side -->
            <div class="col-auto video-col">
                <div class="video-wrapper position-relative">
                    <video id="videoElement" class="w-100 rounded" src="{{ asset('assets/frontend/media/pages/case_studies/video/banner_video.mp4') }}" muted></video>
                    <div id="playButtonWrapper" class="play-button position-absolute top-50 start-50 translate-middle">
                        <button id="playButton" class="gradient-glow-button">
                            <i id="playIcon" class="fa fa-play"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Ribbon Column upto right screen -->
            <div class="col ribbon-col">
                <div class="ribbon d-flex align-items-center justify-content-start px-4">
                    <span class="text-white fw-bold fs-5">
                        SEE OUR WORK IN ACTION
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video ribbon section End -->

<!-- Watermark section Start -->
@include('frontend.layouts.common_section.water-mark-section')
<!-- Watermark Section End -->

<!-- Common contact form start -->
<section class="contact-section pb-5">
    <div class="container">
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

<!-- Download Section Start-->
@include('frontend.layouts.common_section.download-section')
<!-- Download Section End-->

@endsection

@push('custom_js')
{{-- added play button --}}
<script src="{{ asset('assets/frontend/jquery/video-play-btn.js') }}"></script>
@endpush
