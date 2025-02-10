<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ $page->seo->meta_title }}</title> --}}
    {{-- <meta name="description" content="{{ $page->seo->meta_description }}">
    <meta name="keywords" content="{{ $page->seo->meta_keywords }}"> --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    @include('admin.includes.head-links')
    @stack('custom_css')

</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            {{-- Header start --}}
            @include('admin.layouts.header')
            {{-- Header End --}}

            <div class="container">
                @yield('content')
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>
    {{-- scripts link --}}

    @include('admin.includes.scripts')

    @stack('custom_js')
</body>
</html>
