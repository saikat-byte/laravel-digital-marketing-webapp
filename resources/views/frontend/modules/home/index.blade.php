@extends('frontend.layouts.master-layout')
@section('title', 'Home')
{{-- @section('title', $seo->meta_title ?? $page->title)

@section('meta')
<meta name="description" content="{{ $seo->meta_description ?? '' }}">
<meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">
<meta property="og:title" content="{{ $seo->og_title ?? '' }}">
<meta property="og:description" content="{{ $seo->og_description ?? '' }}">
<meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
<meta name="twitter:title" content="{{ $seo->twitter_title ?? '' }}">
<meta name="twitter:description" content="{{ $seo->twitter_description ?? '' }}">
<meta name="twitter:image" content="{{ asset('storage/' . $seo->twitter_image) }}">
<link rel="canonical" href="{{ $seo->canonical_url ?? url()->current() }}">
@endsection --}}

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/index.css') }}">
@endsection

@section('content')


@if($page->status == 1)

@foreach($sections as $index => $section)
    @includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])
    @if($page->slug == 'home' && $index == 5 && $downloadSection)
    {{-- download-section placed after 5 section --}}
    @includeIf('frontend.modules.common.partials.download-section', ['section' => $downloadSection])
    @endif
@endforeach
@else
    @include('frontend.modules.maintanance.index')
@endif



@endsection

@push('custom_js')
<script>
    // Card queue scroll

    $(document).ready(function() {
        const $cardQueueSection = $("#cardQueueSection");
        const $cardContainer = $("#cardContainer");
        const $cards = $cardContainer.find(".card-item");

        let currentIndex = 3; // middle card

        function arrangeCards() {
            $cards.each(function(i, card) {
                let offset = i - currentIndex;
                let scale = 1 - Math.abs(offset) * 0.1;
                let translateX = offset * 100;
                let zIndex = -Math.abs(offset);

                // CSS property set by jquery
                $(card).css({
                    transform: `translateX(${translateX}px) scale(${scale})`
                    , zIndex: zIndex
                });
            });
        }
        arrangeCards();

        // scroll (wheel) event
        $cardQueueSection.on("wheel", function(e) {
            // jQuery scroll actual e.originalEvent.deltaY (We have to use it)
            let deltaY = e.originalEvent.deltaY;

            // scroll up
            if (deltaY < 0) {
                if (currentIndex > 0) {
                    e.preventDefault();
                    currentIndex--;
                    arrangeCards();
                }
            }
            // scroll down
            else {
                if (currentIndex < $cards.length - 1) {
                    e.preventDefault();
                    currentIndex++;
                    arrangeCards();
                }
            }
        });
    });

</script>
@endpush

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/stats-number.js') }}"></script>
@endpush
