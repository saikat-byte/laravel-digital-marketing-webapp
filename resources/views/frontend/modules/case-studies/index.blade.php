@extends('frontend.layouts.master-layout')

@section('title', 'Case studies')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/case-studies.css') }}">
@endsection

@section('content')


@if($page->status == 1)
@foreach($sections as $index => $section)
{{-- Page-specific section include --}}
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])

{{-- show order by watermark section --}}
@if($page->slug == 'case-studies' && $index == 2 && $watermark)
@includeIf('frontend.modules.common.partials.water-mark', ['section' => $watermark])
@endif

{{-- show order by common section --}}
@if($page->slug == 'case-studies' && $index == 3 && $downloadSection)
@includeIf('frontend.modules.common.partials.download-section', ['section' => $downloadSection])
@endif
@endforeach
@else
@include('frontend.modules.maintanance.index')
@endif

@endsection

@push('custom_js')

@if (session('success'))
<script>

@include('frontend.partials.sweet-alert')
</script>
@endif

@endpush
