@extends('frontend.layouts.master-layout')
@section('title', 'Home')
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
    $(document).ready(function() {

        // Card review section
        const $cardQueueSection = $("#cardQueueSection");
        const $cardContainer = $("#cardContainer");
        const $cards = $cardContainer.find(".card-item");


        let currentIndex = 0;
        const totalCards = $cards.length;

        //(X direction)
        const xOffset = 120;
        const scaleFactor = 0.05;

        // card arrange
        function arrangeCards() {
            $cards.each(function(i, card) {
                let offset = (i - currentIndex + totalCards) % totalCards;

                if (offset > totalCards / 2) {
                    offset = offset - totalCards;
                }

                let scale = 1 - Math.abs(offset) * scaleFactor;
                let translateX = offset * xOffset;
                let zIndex = 100 - Math.abs(offset);

                // Style apply
                $(card).css({
                    transform: `translateX(${translateX}px) scale(${scale})`
                    , zIndex: zIndex
                });
            });
        }

        // card arrange
        arrangeCards();

        // Scroll event:
        $cardQueueSection.on("wheel", function(e) {
            e.preventDefault();
            let deltaY = e.originalEvent.deltaY;

            // scroll up => previous card
            if (deltaY < 0) {
                currentIndex = (currentIndex - 1 + totalCards) % totalCards;
            }
            // scroll down => next card
            else {
                currentIndex = (currentIndex + 1) % totalCards;
            }

            arrangeCards();
        });

        /*============== Subscribe form subscription form ==============*/

        $('#subscribe-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action')
                , method: form.attr('method')
                , data: form.serialize()
                , success: function(response) {
                    $('#subscribe-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    form.trigger("reset");
                }
                , error: function(xhr) {
                    var errorMsg = 'Something went wrong.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#subscribe-message').html('<div class="alert alert-danger">' + errorMsg + '</div>');
                }
            });
        });

        /*============== client logo carousel ==============*/

        $('.client-logo-slider').slick({
            infinite: true
            , slidesToShow: 5, // Dekhano logo er poriman (apnar design onujayi adjust korun)
            slidesToScroll: 1
            , autoplay: true
            , autoplaySpeed: 0, // 0 mane continuously scroll
            speed: 3000, // Animation er duration (milliseconds)
            cssEase: 'linear', // Linear easing for continuous scroll
            arrows: false, // Navigation arrow chalie din
            dots: false
            , pauseOnHover: false
            , variableWidth: true // Jodi logo size onujayi vary kore
        });

    });

</script>
@endpush

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/stats-number.js') }}"></script>
@include('frontend.partials.sweet-alert')
@endpush
