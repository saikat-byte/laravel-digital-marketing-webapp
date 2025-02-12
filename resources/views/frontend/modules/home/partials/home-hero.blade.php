@if($section->status == 1)
<section id="section-{{ $section->id }}" class="hero-section">
    @if($section->video)
    <video autoplay loop muted>
        <source src="{{ asset('storage/' . $section->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    @endif
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="row">
            <div class="col-md-4">
                <h1>{{ $section->heading }}</h1>
                <h2>{{ $section->sub_heading }}</h2>
                <p>{{ $section->paragraph }}</p>
                <div class="row pb-5">

                    @if($section->multi_image && is_array($section->multi_image))
                    @foreach($section->multi_image as $image)
                    <div class="col-md-6 pt-3">
                        <a href=""><img src="{{ asset('storage/' . $image) }}" alt="{{ $section->heading }}" style="max-width: 200px; margin: 5px;"></a>
                    </div>
                    @endforeach
                    @else
                    <p>No multi images found.</p>
                    @endif
                </div>
                <div class="hero-buttons pt-5">
                    <a href="{{ $section->button_1_link }}" target="_blank" class="gradient-glow-button text-uppercase">{{ $section->button_1_text }}</a>
                    <a href="{{ $section->button_2_link }}" target="_blank" class="gradient-glow-button text-uppercase">{{ $section->button_2_text }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
