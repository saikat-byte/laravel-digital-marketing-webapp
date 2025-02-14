@extends('frontend.layouts.master-layout')

@section('title', 'Contact')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/contact.css') }}">
@endsection

@section('content')



@if($page->status == 1)
@foreach($sections as $index => $section)
{{-- Page-specific section include --}}
@includeIf("frontend.modules.{$page->slug}.partials.{$section->slug}", ['section' => $section])

{{-- show order by watermark section --}}
@if($page->slug == 'contact' && $index == 1 && $watermark)
@includeIf('frontend.modules.common.partials.water-mark', ['section' => $watermark])
@endif


@endforeach
@else
@include('frontend.modules.maintanance.index')
@endif





@endsection
