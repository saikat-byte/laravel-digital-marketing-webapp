@extends('frontend.layouts.master-layout')

@section('title', 'Service')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/service.css') }}">
@endsection

@section('content')

@if($page->status == 1)
@foreach($sections as $index => $section)
{{-- Page-specific section include --}}
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])

    {{-- show order by Watermark section --}}
    @if($page->slug == 'service' && $index == 2 && $watermark)
    @includeIf('frontend.modules.common.partials.water-mark', ['section' => $watermark])
    @endif
    {{-- show order by FAq section --}}
    @if($page->slug == 'service' && $index == 2 && $faq)
    @includeIf('frontend.modules.common.partials.faq', ['section' => $faq])
    @endif

    {{-- show order by download section --}}
    @if($page->slug == 'service' && $index == 2 && $downloadSection)
    @includeIf('frontend.modules.common.partials.download-section', ['section' => $downloadSection])
    @endif

@endforeach
@else
@include('frontend.modules.maintanance.index')
@endif



@endsection
@push('custom_js')
<script>
    // card slider and accordion code and banner image change on hover
    $(document).ready(function() {
        // main image link collect
        let originalSrc = $("#bannerLeftImage").attr("src");

        // (card-slider এ Hover listener)
        $(".card-slider").on("mouseenter", ".service-card", function() {
            let hoveredImgSrc = $(this).find("img").attr("src");

            // step by step fading effect
            $("#bannerLeftImage").fadeOut(300, function() {
                // image source changes
                $(this).attr("src", hoveredImgSrc);
                // again fadein
                $(this).fadeIn(1000);
            });
        });

        $(".card-slider").on("mouseleave", ".service-card", function() {
            // return fade
            $("#bannerLeftImage").fadeOut(300, function() {
                $(this).attr("src", originalSrc);
                $(this).fadeIn(300);
            });
        });

        // ---- before slider code (Infinite Loop) ----
        const $slider = $(".card-slider");
        let $cards = $slider.find(".service-card");
        const cardWidth = $cards.outerWidth(true);

        // Clone cards for seamless loop
        $slider.append($cards.clone());
        $slider.append($cards.clone());
        $cards = $slider.find(".service-card"); //new card update

        let translateX = 0;
        const speed = 1; // scrolling speed

        function animateSlider() {
            translateX -= speed;
            if (Math.abs(translateX) >= $cards.length * cardWidth) {
                translateX = 0;
            }
            $slider.css("transform", `translateX(${translateX}px)`);
            requestAnimationFrame(animateSlider);
        }

        let animationFrame = requestAnimationFrame(animateSlider);

        // Pause animation on hover
        $slider.hover(
            function() {
                cancelAnimationFrame(animationFrame);
            }
            , function() {
                animationFrame = requestAnimationFrame(animateSlider);
            }
        );
    });

</script>
@endpush

@push('custom_js')
{{-- Frequently ask question (Accordion Code) --}}
<script src="{{ asset('assets/frontend/jquery/faq-ask.js') }}"></script>
{{-- video play button --}}
<script src="{{ asset('assets/frontend/jquery/video-play-btn.js') }}"></script>
@endpush
