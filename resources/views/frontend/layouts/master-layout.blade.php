<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ optional($seo)->meta_title ?? (isset($post) ? $post->title : $page->name) }}
    </title>
    <meta name="description" content="{{ optional($seo)->meta_description ?? Str::limit(strip_tags(isset($post) ? ($post->excerpt ?? $post->content) : ($page->description ?? '')), 150) }}">
    <meta name="keywords" content="{{ optional($seo)->meta_keywords ?? '' }}">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ optional($seo)->og_title ?? (isset($post) ? $post->title : $page->name) }}">
    <meta property="og:description" content="{{ optional($seo)->og_description ?? Str::limit(strip_tags(isset($post) ? ($post->excerpt ?? $post->content) : ($page->description ?? '')), 150) }}">
    @if(isset($seo->og_image) && $seo->og_image)
    <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @elseif(isset($post) && $post->featured_image)
    <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @elseif(isset($page) && $page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
    <link rel="canonical" href="{{ optional($seo)->canonical_url ?? url()->current() }}">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="{{ optional($seo)->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ optional($seo)->twitter_title ?? (isset($post) ? $post->title : $page->name) }}">
    <meta name="twitter:description" content="{{ optional($seo)->twitter_description ?? Str::limit(strip_tags(isset($post) ? ($post->excerpt ?? $post->content) : ($page->description ?? '')), 150) }}">
    @if(isset($seo->twitter_image) && $seo->twitter_image)
    <meta name="twitter:image" content="{{ asset('storage/' . $seo->twitter_image) }}">
    @elseif(isset($post) && $post->featured_image)
    <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @elseif(isset($page) && $page->image)
    <meta name="twitter:image" content="{{ asset('storage/' . $page->image) }}">
    @endif

    <!-- Structured Data -->
    @if(optional($seo)->structured_data)
    <script type="application/ld+json">
        {
            !!is_array($seo - > structured_data) ? json_encode($seo - > structured_data, JSON_PRETTY_PRINT) : $seo - > structured_data!!
        }

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
