@extends('admin.layouts.master')

@section('name', 'Tag')
@section('title', 'Create Tag')

@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('tag.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('tag.index') }}">@yield('name')</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">@yield('title')</a>
            </li>
        </ul>
    </div>
    {{-- Breadcrumb End --}}

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6 card pb-3">

            <div class="card-header d-flex justify-content-between">
                <div>
                    <h2 class="ps-2">Create Tag</h2>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf

                    @include('admin.modules.tag.form')

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success ms-3">Create Tag</button>
                </form>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tag.index') }}" class="mt-3"><button class="btn btn-info btn-sm">Back</button></a>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@push('custom_js')
<script>
    $(document).ready(function() {
        $('#title').on('input', function() {
            let title = $(this).val(); // Get the value of the title field
            let slug = title
                .toLowerCase() // Convert to lowercase
                .replace(/ /g, '-') // Replace spaces with hyphens
                .replace(/[^\w-]+/g, ''); // Remove special characters
            $('#slug').val(slug); // Set the slug field value
        });
    });



    // Create successfully
    @if(session('success'))
    Swal.fire({
        icon: 'success'
        , title: 'Success!'
        , text: "{{ session('success') }}"
        , timer: 3000
        , showConfirmButton: false
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error'
        , title: 'Error!'
        , text: "{{ session('error') }}"
        , timer: 3000
        , showConfirmButton: false
    });
    @endif

</script>
@endpush
