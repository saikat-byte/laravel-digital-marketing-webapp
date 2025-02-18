<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta_title', config('app.name'))</title>

    <meta name="description" content="@yield('meta_description', 'Default website description.')">
    <meta name="keywords" content="@yield('meta_keywords', 'default, keywords')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'Default website description.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/frontend/media/common/default-og-image.jpg'))">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', 'Default website description.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/frontend/media/common/default-twitter-image.jpg'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- <!-- JSON-LD Structured Data -->
    {!! $page->seo->getStructuredDataHtml() !!}
    @section('title', $page->seo->meta_title ?? 'Home')    <title>@yield('title')</title> --}}
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
