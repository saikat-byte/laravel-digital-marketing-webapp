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
        /*============== Card review section  ==============*/
        const $cardQueueSection = $("#cardQueueSection");
        const $cardContainer = $("#cardContainer");
        const $cards = $cardContainer.find(".card-item");

        let currentIndex = 0;
        const totalCards = $cards.length;

        // (X direction)
        const xOffset = 120;
        const scaleFactor = 0.05;

        // Swipe threshold (in pixels)
        const touchThreshold = 50;
        let touchStartX = null;

        // Function to arrange cards based on currentIndex
        function arrangeCards() {
            $cards.each(function(i, card) {
                let offset = (i - currentIndex + totalCards) % totalCards;
                if (offset > totalCards / 2) {
                    offset = offset - totalCards;
                }
                let scale = 1 - Math.abs(offset) * scaleFactor;
                let translateX = offset * xOffset;
                let zIndex = 100 - Math.abs(offset);

                $(card).css({
                    transform: `translateX(${translateX}px) scale(${scale})`
                    , zIndex: zIndex
                });
            });
        }

        // Initial card arrangement
        arrangeCards();

        // Desktop: Wheel event on cardQueueSection remains same
        $cardQueueSection.on("wheel", function(e) {
            if (!$(e.target).closest("#cardContainer").length) {
                return;
            }
            e.preventDefault();
            let deltaY = e.originalEvent.deltaY;
            if (deltaY < 0) {
                currentIndex = (currentIndex - 1 + totalCards) % totalCards;
            } else {
                currentIndex = (currentIndex + 1) % totalCards;
            }
            arrangeCards();
        });

        // Mobile: Attach touch events only on .card-item elements for horizontal swipe
        $cardContainer.on("touchstart", ".card-item", function(e) {
            touchStartX = e.originalEvent.touches[0].clientX;
        });

        $cardContainer.on("touchmove", ".card-item", function(e) {
            // Prevent default scrolling only when touching a card
            e.preventDefault();
        });

        $cardContainer.on("touchend", ".card-item", function(e) {
            if (touchStartX === null) return;
            let touchEndX = e.originalEvent.changedTouches[0].clientX;
            let deltaX = touchStartX - touchEndX;

            // Check if swipe distance exceeds threshold
            if (Math.abs(deltaX) > touchThreshold) {
                if (deltaX > 0) {
                    // Swipe left => Next card
                    currentIndex = (currentIndex + 1) % totalCards;
                } else {
                    // Swipe right => Previous card
                    currentIndex = (currentIndex - 1 + totalCards) % totalCards;
                }
                arrangeCards();
            }
            touchStartX = null;
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



        /*============== Stats section ==============*/
        // Flag to track if stats have been animated in the current viewport cycle
        let statsAnimated = false;

        // Function to animate numbers in the stats section with a plus symbol
        function animateStats() {
            $(".stat-card h3").each(function() {
                var $this = $(this);
                // Extract numeric value (e.g., "100+" becomes 100)
                var finalValue = parseInt($this.text());
                // Animate from 0 to finalValue
                $({
                    countNum: 0
                }).animate({
                    countNum: finalValue
                }, {
                    duration: 2000
                    , easing: 'swing'
                    , step: function() {
                        // Update the text with the current number and append the plus symbol
                        $this.text(Math.ceil(this.countNum) + "+");
                    }
                    , complete: function() {
                        // Ensure the final text is set properly with the plus symbol
                        $this.text(finalValue + "+");
                    }
                });
            });
        }

        // Scroll event handler to trigger animation when stats section comes into view
        $(window).on("scroll", function() {
            var $statsSection = $(".stats-section");
            var statsSectionTop = $statsSection.offset().top;
            var windowBottom = $(window).scrollTop() + $(window).height();

            // If stats section is in view
            if (windowBottom > statsSectionTop) {
                // Trigger animation only if not already animated in this cycle
                if (!statsAnimated) {
                    animateStats();
                    statsAnimated = true;
                }
            } else {
                // Reset flag if section is out of view, so next time user scrolls back in, animation re-triggers
                statsAnimated = false;
            }
        });
    });

</script>
@endpush

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/stats-number.js') }}"></script>
@include('frontend.partials.sweet-alert')
@endpush
