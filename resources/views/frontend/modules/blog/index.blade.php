@extends('frontend.layouts.master-layout')

@section('title', 'Blog')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/blog.css') }}">
@endsection

@section('content')


@if($page->status == 1)
    @foreach($sections as $index => $section)
    {{-- Page-specific section include --}}
    @includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])
    @endforeach
@else
    @include('frontend.modules.maintanance.index')
@endif

@endsection

@push('custom_js')
<script src="{{ asset('assets/frontend/jquery/blog.js') }}"></script>
@endpush
