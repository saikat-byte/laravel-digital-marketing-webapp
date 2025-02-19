<!-- Client Logo Section Start-->
@if($section->status == 1)
<section class="client-logo-section client-logo-section-contact-page">
    <div class="container">
        <div class="client-logo-slider">
            @if($section->multi_image && is_array($section->multi_image))
            @foreach($section->multi_image as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="{{ $section->heading }}">
            @endforeach
            @endif
        </div>
    </div>
</section>
@endif
<!-- Client Logo Section End-->



