@if($section->status == 1)
<!-- About Banner section start -->
<section class="about-banner pt-5">
    <div class="about-banner-overlay"></div>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6 about-banner-content py-5">
                <h1 class="display-4 fw-bold">{{ $section->heading }}</h1>
                <p class="lead">{{ $section->sub_heading }}</p>
                <a href="{{ $section->button_1_text ?? '#' }}" class="gradient-glow-button text-uppercase">{{ $section->button_1_text }}</a>
            </div>
        </div>
    </div>
</section>
<!-- About Banner section End -->
@endif
