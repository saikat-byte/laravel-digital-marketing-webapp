@if($section->status == 1)

<section id="section-{{ $section->id }}" class="service-banner">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Column with Image -->
            <div class="col-lg-6 banner-left p-0">
                <img src="{{ asset('storage/' . $section->image) }}" alt="Left Banner Image" class="img-fluid h-100 w-100" id="bannerLeftImage">
            </div>
            <!-- Right Column with Gradient Background -->
            <div class="col-lg-6 banner-right d-flex flex-column justify-content-start align-items-start">
                <div class="content-wrapper">
                    <h1 class="fw-bold">{{ $section->heading }}</h1>
                    <h3 class="mb-3 fs-4">{{ $section->sub_heading }}</h3>
                    <p class="mb-4">{{ $section->paragraph }}</p>
                    <a href="#" class="gradient-glow-button text-uppercase">{{ $section->button_1_text }}</a>
                </div>
            </div>
        </div>

        <!-- Cards Slider -->
        <div class="card-slider-wrapper">
            @php
            $config = $section->config;
            $images = $section->multi_image;
            @endphp

            <div class="card-slider">
                @foreach($images as $index => $image)
                @php
                // index start from 0
                $linkKey = 'card_links_' . ($index + 1);
                $link = $section->config[$linkKey] ?? '#';
                @endphp
                <div class="service-card">
                    <img src="{{ asset('storage/' . $image) }}" alt="Service Image">
                    <a href="{{ $link }}" target="_blank" class="card-title text-uppercase">{{ $linkKey }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endif
