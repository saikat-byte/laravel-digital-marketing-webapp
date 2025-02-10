@extends('admin.layouts.master')

@section('name', 'Post')
@section('title', 'Edit Post')

@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('post.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('post.index') }}">@yield('name')</a>
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
        <div class="col-md-12 col-lg-12 card pb-3">
            @include('admin.modules.message')

            <div class="card-header d-flex justify-content-between">
                <div>
                    <h2 class="ps-2">Edit Post</h2>

                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.modules.post.form')
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success ms-3">Update Post</button>
                </form>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('post.index') }}" class="mt-3"><button class="btn btn-info btn-sm">Back</button></a>
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

    // subcategory select by category
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var categoryId = $(this).val();

            $('#sub_category_id').html('<option value="">Loading...</option>'); // loading....

            if (categoryId) {
                $.ajax({
                    url: '/admin/get-subcategories/' + categoryId
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        $('#sub_category_id').html('<option value="">Select a Sub Category</option>'); // Subcategory dropdown reset
                        $.each(data, function(index, subCategory) {
                            $('#sub_category_id').append('<option value="' + subCategory.id + '">' + subCategory.title + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_category_id').html('<option value="">Select a Sub Category</option>'); // Subcategory dropdown reset
            }
        });
    });

</script>
@endpush
