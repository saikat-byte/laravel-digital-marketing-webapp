@extends('frontend.layouts.master-layout')

@section('title', 'Single Blog')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/single-blog.css') }}">
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
