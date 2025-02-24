<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo->meta_title ?? $page->name }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ $seo->og_title ?? '' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? '' }}">
    <meta property="og:image" content="{{ isset($seo->og_image) ? asset('storage/' . $seo->og_image) : '' }}">
    <link rel="canonical" href="{{ $seo->canonical_url ?? url()->current() }}">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="{{ $seo->twitter_card ?? '' }}">
    <meta name="twitter:title" content="{{ $seo->twitter_title ?? '' }}">
    <meta name="twitter:description" content="{{ $seo->twitter_description ?? '' }}">
    <meta name="twitter:image" content="{{ isset($seo->twitter_image) ? asset('storage/' . $seo->twitter_image) : '' }}">

    <!-- Structured Data -->
    @if(isset($seo->structured_data) && $seo->structured_data)
        <script type="application/ld+json">
            {!! is_array($seo->structured_data) ? json_encode($seo->structured_data) : $seo->structured_data !!}
        </script>
    @endif

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    @include('frontend.includes.head-links')
    @yield('custom_css')
</head>

<body>

    <!-- Header -->
    @include('frontend.modules.common.partials.header')

    @yield('content')

    <!-- Footer -->
    @include('frontend.modules.common.partials.footer')


    @include('frontend.includes.footer-common-scripts')

    @stack('custom_js')
</body>

</html>
