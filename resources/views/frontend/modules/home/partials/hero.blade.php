@if(!empty($hero))
<section class="hero-section">
    <video autoplay loop muted>
        <source src="{{ asset('storage/' . ($hero['video'] ?? 'default-video.mp4')) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="row">
            <div class="col-md-4">
                <h1>{{ $hero['heading'] ?? 'Premium Agency' }}</h1>
                <h2>{{ $hero['subheading'] ?? 'We Grow Brand Online' }}</h2>
                <p>{{ $hero['description'] ?? 'We provide digital marketing, graphic design, web development, SEO, social media marketing, YouTube marketing, paid ads, reels & shorts.' }}</p>

                <div class="row pb-5">
                    <div class="col-md-6 pt-3">
                        <a href="{{ $hero['upwork_link'] ?? '#' }}">
                            <img src="{{ asset('assets/frontend/media/common/icon/upword.png') }}" alt="Upwork">
                        </a>
                    </div>
                    <div class="col-md-6 pt-3">
                        <a href="{{ $hero['google_review_link'] ?? '#' }}">
                            <img src="{{ asset('assets/frontend/media/common/icon/google_review.png') }}" alt="Google Review">
                        </a>
                    </div>
                </div>

                <div class="hero-buttons pt-5">
                    <a href="{{ $hero['button_1_link'] ?? '#' }}" class="gradient-glow-button text-uppercase">
                        {{ $hero['button_1_text'] ?? 'Our Service' }}
                    </a>
                    <a href="{{ $hero['button_2_link'] ?? '#' }}" class="gradient-glow-button text-uppercase">
                        {{ $hero['button_2_text'] ?? 'Get Free Quote' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
