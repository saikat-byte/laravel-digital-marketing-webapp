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
    $(document).ready(function() {

        // Card review section
        const $cardQueueSection = $("#cardQueueSection");
        const $cardContainer = $("#cardContainer");
        const $cards = $cardContainer.find(".card-item");

        // কোন কার্ড এখন সামনে থাকবে (মধ্যখানে)
        let currentIndex = 0;
        const totalCards = $cards.length;

        // কতদূর কার্ডগুলো সরবে (X direction), আর স্কেল কতটা কমবে ইত্যাদি কাস্টমাইজ করুন
        const xOffset = 120; // প্রতিটি কার্ড কত px করে বাঁ/ডানে যাবে
        const scaleFactor = 0.05; // প্রতিটি স্টেপে স্কেল কতটা কমবে

        // কার্ডগুলো arrange করার ফাংশন
        function arrangeCards() {
            $cards.each(function(i, card) {
                // offset = এই কার্ড আর currentIndex এর মধ্যে ব্যবধান
                // কিন্তু যাতে লুপ করে প্রথম কার্ড আবার সামনে আসে, সে জন্য mod ব্যবহার করা
                // (i - currentIndex + totalCards) % totalCards => 0 থেকে totalCards-1 এর মধ্যে ঘুরবে
                let offset = (i - currentIndex + totalCards) % totalCards;

                // ধরুন ৭ টা কার্ড থাকলে offset হবে 0..6
                // মাঝে ৩ টা করে দেখাতে চাইলে offset > 3 হলে আমরা সেটাকে নেগেটিভ করে দিই (যাতে বাঁ দিকেও দেখা যায়)
                if (offset > totalCards / 2) {
                    offset = offset - totalCards;
                    // এখন offset রেঞ্জ হবে -3..3 (যদি totalCards = 7)
                }

                // স্কেল ও translate বের করা
                let scale = 1 - Math.abs(offset) * scaleFactor;
                let translateX = offset * xOffset;
                // zIndex ঠিক করে দিই, offset যত কম (0 এর কাছাকাছি), তত সামনে
                let zIndex = 100 - Math.abs(offset);

                // Style apply
                $(card).css({
                    transform: `translateX(${translateX}px) scale(${scale})`
                    , zIndex: zIndex
                });
            });
        }

        // শুরুতেই কার্ডগুলো arrange করে নেব
        arrangeCards();

        // Scroll event: স্ক্রল আপ/ডাউন করলে currentIndex বাড়াব বা কমাব
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
