<link rel="icon" href="{{ asset('assets/admin/img/cloudspace/cloudspace_favicon.png') }}" type="image/x-icon" />
  {{-- toaster --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
{{-- Jquery UI CSS using for drag and drop --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<!-- Fonts and icons -->
<script src="{{ asset('assets/admin/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        }
        , custom: {
            families: [
                "Font Awesome 5 Solid"
                , "Font Awesome 5 Regular"
                , "Font Awesome 5 Brands"
                , "simple-line-icons"
            , ]
            , urls: ["{{ asset('assets/admin/css/fonts.min.css') }}"]
        , }
        , active: function() {
            sessionStorage.fonts = true;
        }
    , });

</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/post.css') }}" />


<style>
    /* Dark theme for toastr */
    .dark-toast {
        background-color: #333 !important;
    }
    .toast-success {
        background-color: #28a745 !important;
    }
    .toast-error {
        background-color: #dc3545 !important;
    }
    .toast-info {
        background-color: #17a2b8 !important;
    }
    .toast-warning {
        background-color: #ffc107 !important;
        color: #333 !important;
    }
</style>
