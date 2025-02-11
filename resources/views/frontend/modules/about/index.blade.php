@extends('frontend.layouts.master-layout')

@section('title', 'About')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/about.css') }}">
@endsection

@section('content')

<!-- About Banner section start -->
<section class="about-banner pt-5">
    <div class="about-banner-overlay"></div>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6 about-banner-content py-5">
                <h1 class="display-4 fw-bold">We’re the right tech-solutions partner for all your digital innovation
                    & transformation needs.</h1>
                <p class="lead">Cloudspace Solutions startups alike to stay ahead in an
                    increasingly digital-driven market.</p>
                <a href="#" class="gradient-glow-button">Let’s Collaborate</a>
            </div>
        </div>
    </div>
</section>
<!-- About Banner section End -->

<!-- Vission section start -->
<section class="vision-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h3 class="vision-title">Our Vision</h3>
                <p class="vision-highlight">Digitally transforming and accelerating businesses</p>
            </div>
            <div class="col-md-8">
                <p class="vision-description">
                    Since its inception in 2001, OrangeMantra has been committed to helping businesses translate
                    ideas into reality using innovative tech solutions. We have consistently lived up to our name,
                    where the hue “Orange” stands for innovativeness and “Mantra” for the magic. Our
                    results-oriented solutions have earned multiple awards and won the hearts of brands like Ikea,
                    Hero, Nestle, Panasonic, AND, Tata, PVR, Decathlon, and Haldiram’s.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Vission section End -->

<!-- Custom  section Start -->
<section class="custom-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Our passionate and pragmatic approach has enabled our clients to digitally transform
                    their businesses with cutting-edge technology. Our journey since conception has followed our
                    vision to collaborate with companies worldwide, whilst helping them experience the strength of
                    technology in leading the evolution of the industrial landscape.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/frontend/media/pages/about/images/magazine.png') }}" alt="Workspace" class="img-fluid rounded">
            </div>
        </div>
    </div>
    <div class="speech-box">
        <p>
            Our passionate and pragmatic approach has enabled our clients to digitally transform their businesses
            with cutting-edge technology. Our journey since conception has followed our vision to collaborate with
            companies worldwide, whilst helping them experience the strength of technology in leading the evolution
            of the industrial landscape.
            <br><br>
            <span>&mdash; Deborshee Bannerjee, CEO, Cloudspace</span>
        </p>
    </div>
</section>
<!-- Custom section End -->


<!-- About card section Start -->
<section class="py-5 about-card-section">
    <div class="container">
        <div class="row g-4">
            <div class=" row d-flex justify-content-center align-items-center">
                <div class="col-md-12  text-center about-card-section-head">
                    <h3 class="text-center pb-3">Lorem ipsum dolor sit amet consectetur adipisicing.</h3>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam error
                        illum voluptatibus vel at, eligendi repellendus tenetur voluptatum iste non!</p>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-brands fa-wordpress"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Website Trends</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-solid fa-magnifying-glass-location"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Website Trends</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Traffic Analysis</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-brands fa-keycdn"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Optimizing Keywords</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-regular fa-chart-bar"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Page Optimizations</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Deep URL Analysis</h5>
                            <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium dormque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About card section End -->

<!-- Download Section Start-->
    @include('frontend.layouts.common-section.download-section')
<!-- Download Section End-->


@endsection
