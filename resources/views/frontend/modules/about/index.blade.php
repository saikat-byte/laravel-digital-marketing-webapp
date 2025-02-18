@extends('frontend.layouts.master-layout')

@section('title', 'About')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/about.css') }}">
@endsection

@section('content')



@if($page->status == 1)
@foreach($sections as $index => $section)
{{-- Page-specific section include --}}
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])

{{-- show order by watermark section --}}
@if($page->slug == 'about' && $index == 3 && $watermark)
@includeIf('frontend.modules.common.partials.water-mark', ['section' => $watermark])
@endif
{{-- show order by common section --}}
@if($page->slug == 'about' && $index == 3 && $downloadSection)
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


         // Subscribe form subscription form
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
    });

</script>
@endpush

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/stats-number.js') }}"></script>
@endpush
