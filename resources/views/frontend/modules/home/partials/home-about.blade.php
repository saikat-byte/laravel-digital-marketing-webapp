@if($section->status == 1)
<section class="about-section">
    <div class="container about-content">
        <!-- Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-white">{{ $section->heading }}</h1>
            </div>
        </div>
        <!-- Button -->
        <div class="row button-row text-center">
            <div class="col-lg-12 text-center">
                <a href="#" class="gradient-glow-button btn-service">{{ $section->button_1_text }}</a>
            </div>
        </div>
    </div>
</section>
@endif
