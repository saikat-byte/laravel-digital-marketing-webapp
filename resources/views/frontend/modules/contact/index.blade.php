@extends('frontend.layouts.master-layout')

@section('title', 'Contact')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/contact.css') }}">
@endsection

@section('content')
     <!-- Contact Hero Banner Section Start -->
     <section class="contact-banner container-fluid p-0">
        <div class="row g-0">
            <div class="col-12 position-relative">
                <video class="banner-video" autoplay loop muted playsinline <!-- iOS Safari তে ইনলাইন প্লে -->
                    poster="assets/images/video-poster.jpg"
                    >
                    <source src="{{ asset('assets/frontend/media/pages/contact/video/contact_map_video.mp4') }}" type="video/mp4" />
                    <!-- Fallback text -->
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </section>
    <!-- Contact Hero Banner Section End -->

    <!-- Common contact form start -->
    <section class="contact-section pb-5 pt-5">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Left Column (Form) -->
                <div class="col-lg-4 mb-5 mb-lg-0 left-col d-flex flex-column justify-content-center">
                    <!-- Form Wrapper with Gradient Border -->
                    <div class="form-wrapper p-4">
                        <h5 class="mb-4 text-uppercase">Contact us today!</h5>
                        <h2 class="mb-4 text-uppercase">GET IN TOUCH!</h2>
                        <!-- Contact Form -->
                        <form class="text-center pt-3 pb-3">
                            <div class="mb-4">
                                <input type="text" class="form-control custom-input" placeholder="Name">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control custom-input" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control custom-input" placeholder="+91 Phone Number">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control custom-input" placeholder="Service">
                            </div>
                            <button type="submit" class="gradient-glow-button w-100 mt-2">
                                START YOUR PROJECT
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column (Heading, Sub-heading & Text + Three Part) -->
                <div class="col-lg-6 right-col d-flex flex-column justify-content-center p-4">
                    <!-- Paragraph -->
                    <p class="">
                        Boosting your online presence with digitalmarketing, creating stunning visuals with graphic
                        design,
                        developing a website, growing your YouTube channel, social media marketing, Reels & Shorts
                        creation...
                        we've got you covered!
                    </p>
                    <!-- Heading & Sub Heading -->
                    <h2 class="fw-bold">DIGITIZING YOUR BUSINESS GROWTH!</h2>
                    <!-- Three Part Section with Divider Lines -->
                    <div class="three-part row">
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
                    <div class="row contact-page-form-right mt-1 pb-2">
                        <div class="col-lg-6 d-flex justify-content-start align-items-center mt-1">
                            <div class="contact-page-form-right-icon">
                                <img src="{{ asset('assets/frontend/media/common/icon/google-maps.png') }}" alt="location icon">
                            </div>
                            <div class="text-start location-mail-text-parent d-flex justify-content-start flex-column">
                                <p class="location-mail-text-heading">OUR LOCATION</p>
                                <p class="fw-bold location-mail-text">KOLKATA, INDIA</p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-start align-items-center mt-1">
                            <div class="contact-page-form-right-icon pe-2">
                                <img src="{{ asset('assets/frontend/media/common/icon/email.png') }}" alt="email icon">
                            </div>
                            <div class="text-start location-mail-text-parent d-flex justify-content-start flex-column">
                                <p class="location-mail-text-heading">EMAIL ADDRESS</p>
                                <p class="fw-bold location-mail-text">info@gocloudspace.com</p>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0"
                                        scrolling="no" marginheight="0" marginwidth="0"
                                        src="https://maps.google.com/maps?width=800&amp;height=200&amp;hl=en&amp;q=130, Feeder Rd, Verner Lane, Belghoria, Kolkata, West Bengal 700056&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                                        href="https://sprunkiphasez.com/">Sprunki Phase</a></div>
                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        width: 100%;
                                        height: 200px;
                                    }

                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        width: 100%;
                                        height: 200px;
                                    }

                                    .gmap_iframe {
                                        height: 200px !important;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-2">
                        <button class="gradient-glow-button btn w-100 w-sm-auto">GET DIRECTION</button>
                        <button class="gradient-glow-button btn w-100 w-sm-auto">VIEW SERVICES</button>
                    </div>
    </section>
    <!-- Common contact form End -->

    <!-- Watermark section Start -->
    @include('frontend.layouts.common-section.water-mark-section')
    <!-- Watermark Section End -->

    <!-- Collaborate Section Start -->
    <section class="collaborate-section position-relative">
        <!-- Overlay & Background Image Wrapper -->
        <div class="bg-image-wrapper">
            <img src="{{ asset('assets/frontend/media/pages/contact/images/contact-banner.jpg') }}" alt="Collaborate Background" class="bg-image">
            <div class="gradient-overlay"></div>
        </div>
        <div class="container position-relative h-100">
            <div class="row h-100">
                <div
                    class="col-12 collaborate-section-content d-flex flex-column align-items-start justify-content-end">
                    <h2 class="collab-heading text-white mb-3">
                        WE ARE ALWAYS <br />
                        READY TO COLLABORATE <br />
                        WITH YOU!
                    </h2>
                    <button class="gradient-glow-button">
                        GET FREE QUOTE
                    </button>

                </div>
            </div>
        </div>
    </section>
    <!-- Collaborate Section End -->

    <!-- Client Logo Section Start-->
    <section class="client-logo-section client-logo-section-contact-page bg-white mb-4">
        <div class="container">
            <div class="client-logo-slider">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/harmony_travel_logo.jpg') }}" alt="Harmony Travel Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/ncpl_logo.png') }}" alt="NCPL Logo">
                <img src="{{ asset('assets/frontend/media/common/logo/client_logo/nuvo_logo.jpg') }}" alt="Nuvo Logo">
            </div>
        </div>
    </section>
    <!-- Client Logo Section End-->
@endsection
