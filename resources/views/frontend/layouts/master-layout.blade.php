<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo->meta_title ?? $post->title }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? Str::limit(strip_tags($post->excerpt ?? $post->content), 150) }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ $seo->og_title ?? $post->title }}">
    <meta property="og:description" content="{{ $seo->og_description ?? Str::limit(strip_tags($post->excerpt ?? $post->content), 150) }}">
    @if(isset($seo->og_image) && $seo->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @elseif($post->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @endif
    <link rel="canonical" href="{{ $seo->canonical_url ?? url()->current() }}">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seo->twitter_title ?? $post->title }}">
    <meta name="twitter:description" content="{{ $seo->twitter_description ?? Str::limit(strip_tags($post->excerpt ?? $post->content), 150) }}">
    @if(isset($seo->twitter_image) && $seo->twitter_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seo->twitter_image) }}">
    @elseif($post->featured_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @endif

    <!-- Structured Data -->
    @if(isset($seo->structured_data) && $seo->structured_data)
        <script type="application/ld+json">
            {!! is_array($seo->structured_data) ? json_encode($seo->structured_data, JSON_PRETTY_PRINT) : $seo->structured_data !!}
        </script>
    @endif


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
