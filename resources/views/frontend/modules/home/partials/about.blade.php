{{-- frontend/modules/home/partials/about.blade.php --}}
@php
    $aboutSection = $page->sections->where('code', 'about')->first();
    if ($aboutSection) {
        $title = $aboutSection->settings->where('key', 'title')->first()?->value;
        $button_text = $aboutSection->settings->where('key', 'button_text')->first()?->value;
        $button_link = $aboutSection->settings->where('key', 'button_link')->first()?->value;
    }
@endphp

<section class="about-section">
    <div class="container about-content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-white">{{ $title ?? 'ABOUT CLOUDSPACE SOLUTIONS' }}</h1>
            </div>
        </div>
        <div class="row button-row text-center">
            <div class="col-lg-12 text-center">
                <a href="{{ $button_link ?? '#' }}"
                   class="gradient-glow-button btn-service">
                    {{ $button_text ?? 'OUR SERVICE' }}
                </a>
            </div>
        </div>
    </div>
</section>
