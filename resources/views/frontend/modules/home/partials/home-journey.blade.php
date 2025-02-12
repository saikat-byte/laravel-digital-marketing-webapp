@if($section->status == 1)
<section class="journey-section">
    @php
    $config = $section->config;
    $images = $section->multi_image;
    @endphp
    <div class="container text-center">
        <!-- Section Heading -->
        <h2 class="section-title text-white mb-3">Begin Your Journey to Success Today</h2>
        <p class="section-subtitle mb-5">Here's the information you have been searching for</p>

        <!-- Cards -->
        <div class="row d-flex justify-content-center">
            @for($i = 1; $i <= 3; $i++)
            <div class="col-md-3 p-0">
                <div class="journey-card">
                    <div class="card-image">
                        <img src="{{ asset('storage/' . ($images[$i-1] ?? '')) }}" alt="{{ $config['heading'.$i] ?? 'Card '.$i }}">
                        <div class="overlay  pe-3">
                            <div class="journey-card-number text-end">{{ $config['number'.$i] ?? '' }}</div>
                            <h3 class="overlay-title text-end">{{ $config['heading'.$i] ?? 'Default Heading' }}</h3>
                            <p class="overlay-text text-end">{{ $config['subheading'.$i] ?? 'Default Subheading' }}</p>
                            <a href="{{ $config['button_link_'.$i] ?? '#' }}" class="gradient-glow-button journey-card-btn">{{ $config['button_text_'.$i] ?? 'Default Button' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    </div>
</section>
@endif
