@if($section->status == 1)
<section class="consultant-section d-flex align-items-center" style="background-image: url('{{ asset('storage/' . $section->image) }}')">
    <div class="container text-light">
        <div class="row align-items-center">
            <div class="row button-row text-center">
                <div class="col-lg-12 text-center">
                    <a href="#" class="gradient-glow-button text-uppercase">
                        {{ $section->button_1_text ?? 'SCHEDULE A FREE CONSULTATION' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
