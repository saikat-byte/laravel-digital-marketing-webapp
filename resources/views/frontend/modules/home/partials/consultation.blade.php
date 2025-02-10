{{-- frontend/modules/home/partials/consultant.blade.php --}}
@php
    $consultantSection = $page->sections->where('code', 'consultant')->first();
    if ($consultantSection) {
        $button_text = $consultantSection->settings->where('key', 'button_text')->first()?->value;
        $button_link = $consultantSection->settings->where('key', 'button_link')->first()?->value;
    }
@endphp

<section class="consultant-section d-flex align-items-center">
    <div class="container text-light">
        <div class="row align-items-center">
            <div class="row button-row text-center">
                <div class="col-lg-12 text-center">
                    <a href="{{ $button_link ?? '#' }}"
                       class="gradient-glow-button">
                        {{ $button_text ?? 'SCHEDULE A FREE CONSULTATION' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
