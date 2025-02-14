@if($section->status == 1)
<!-- Banner section Start -->
<section class="banner-section d-flex align-items-center justify-content-center text-center" style="background-image: url('{{ asset('storage/' . $section->image) }}')">
    <div class="banner-overlay"></div>

    <div class="container text-center">
        <div class="banner-content text-center">
            <h1 class="text-white mb-3">{{ $section->heading }}</h1>
            <h2 class="mb-4">
                {{ $section->sub_heading }}
            </h2>
        </div>

        <!-- Button -->
        <div class="button-row text-center">
            <div class=" text-center">
                <a href="{{ $section->button_1_link  ?? '#' }}" class="gradient-glow-button text-uppercase">{{ $section->button_1_text }}</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner section End -->
@endif
