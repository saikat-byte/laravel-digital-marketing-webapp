@extends('frontend.layouts.master-layout')

@section('title', 'Contact')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/contact.css') }}">
@endsection

@section('content')



@if($page->status == 1)
@foreach($sections as $index => $section)
{{-- Page-specific section include --}}
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])

{{-- show order by watermark section --}}
@if($page->slug == 'contact' && $index == 1 && $watermark)
@includeIf('frontend.modules.common.partials.water-mark', ['section' => $watermark])
@endif


@endforeach
@else
@include('frontend.modules.maintanance.index')
@endif

@endsection

@push('custom_js')
<script>
    $(document).ready(function() {
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
    @include('frontend.partials.sweet-alert')

</script>
@endpush
