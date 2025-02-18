@extends('frontend.layouts.master-layout')

@section('title', 'Book Appointment')


@section('custom_css')
<!-- Flatpickr CSS for enhanced date/time pickers -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Custom CSS (if any) -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/appointment.css') }}">
@endsection

@section('content')
@if($page->status == 1)

@foreach($sections as $index => $section)
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])
@endforeach
@else
@include('frontend.modules.maintanance.index')
@endif

@endsection

@push('custom_js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // Initialize Flatpickr for enhanced UI (optional)
    flatpickr("#appointment_date", {
        altInput: true
        , altFormat: "F j, Y"
        , dateFormat: "Y-m-d"
        , minDate: "today" // Prevent past dates
    });
    flatpickr("#appointment_time", {
        enableTime: true
        , noCalendar: true
        , dateFormat: "H:i"
        , time_24hr: true
    });

    @include('admin.partials.sweet-alert')

</script>
@endpush
