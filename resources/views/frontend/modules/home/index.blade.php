{{-- // resources/views/frontend/modules/index.blade.php --}}
@extends('frontend.layouts.master-layout')

@section('title', $page->seo->meta_title ?? 'Home')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/index.css') }}">
@endsection

@section('content')


@foreach($sections as $sectionKey => $sectionData)
@includeIf("frontend.modules.home.partials.{$sectionKey}", [$sectionKey => $sectionData])
@endforeach

@endsection
@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/stats-number.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.client-logo-slider').slick({
            slidesToShow: 4
            , slidesToScroll: 1
            , autoplay: true
            , autoplaySpeed: 1000
            , arrows: false
            , dots: false
            , responsive: [{
                    breakpoint: 1024
                    , settings: {
                        slidesToShow: 3
                    }
                }
                , {
                    breakpoint: 768
                    , settings: {
                        slidesToShow: 2
                    }
                }
                , {
                    breakpoint: 480
                    , settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

</script>

@endpush
