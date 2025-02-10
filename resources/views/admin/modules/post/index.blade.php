@extends('admin.layouts.master')

@section('name', 'Post')
@section('title', 'Post List')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('category.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('category.index') }}">@yield('name')</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">@yield('title')</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Post List</h4>
                        <a href="{{ route('post.create') }}" class="btn btn-info"> Add post </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover post_table">
                            <thead>
                                <tr>
                                    <th class="table-heading-text">Sl</th>
                                    <th class="table-heading-text">
                                        <p>Post title</p>
                                        <hr class="table-heading-hr">
                                        <p>Slug name</p>
                                    </th>
                                    <th class="table-heading-text">
                                        <p>Category name</p>
                                        <hr class="table-heading-hr">
                                        <p>Sub category name</p>
                                    </th>
                                    <th class="table-heading-text">
                                        <p>Status</p>
                                        <hr class="table-heading-hr">
                                        <p>Is approved</p>
                                    </th>
                                    <th class="table-heading-text">Photo</th>
                                    <th class="table-heading-text">Tags</th>
                                    <th class="table-heading-text">
                                        <p>Created at</p>
                                        <hr class="table-heading-hr">
                                        <p>Updated at</p>
                                        <hr class="table-heading-hr">
                                        <p>Created by</p>
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>
                                        <p>{{ $post->title }}</p>
                                        <hr class="table-heading-hr">
                                        <p>{{ $post?->slug}}</p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('category.show', $post->category_id) }}">{{ $post->category?->title }}</a></p>
                                        <hr class="table-heading-hr">

                                        <p><a href="{{ route('sub-category.show', $post->sub_category_id) }}">{{ $post->subCategory?->title}}</a></p>
                                    </td>

                                    <td>
                                        <p>{{ $post->status == 1 ? "Published" : "Not published" }}</p>
                                        <hr class="table-heading-hr">
                                        <p>{{ $post->is_approved == 1 ? "Approved" : "Not approved" }}</p>
                                    </td>
                                    <td>
                                        <img class="img-thumbnail post_image zoom-image" src="{{ asset('assets/image/postimage/thumbnail/'.pathinfo($post->post_image, PATHINFO_FILENAME).'_thumb'.'.'.pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->post_image }}">
                                    </td>
                                    <td>
                                        @php
                                        $classes = ['text-bg-primary', 'text-bg-secondary', 'text-bg-dark', 'text-bg-danger', 'text-bg-warning', 'text-bg-info', ' text-bg-success']
                                        @endphp

                                        @foreach ($post->tag as $tag)

                                        <a href="{{ route('tag.show', $tag->id) }}"> <span class="badge py-2  {{ $classes[random_int(0,6)] }} "> {{ $tag->title }}</span></a>

                                        @endforeach
                                    </td>
                                    <td>
                                        <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</p>
                                        <hr class="table-heading-hr">
                                        <p>{{ $post->created_at != $post->updated_at ? \Carbon\Carbon::parse($post->updated_at)->format('d-m-Y') : "Not updated" }}</p>
                                        <hr class="table-heading-hr">
                                        <p class="fw-bold badge text-bg-success">{{ $post->user?->name}}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('post.show', $post->id ) }}"> <button class="btn btn-info btn-sm mx-1"> <i class="icon-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('post.edit', $post->id ) }}"> <button class="btn btn-warning btn-sm mx-1"> <i class="icon-note"></i>
                                                </button> </a>

                                            <form action="{{ route('post.destroy', $post->id ) }}" method='POST' id="form_{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data_id="{{ $post->id }}" class="delete btn btn-danger btn-sm mx-1"> <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection

@push('custom_js')
<script>
    $(document).ready(function() {
        // Initialize DataTables with selectors
        initializeDataTables({
            basicSelector: "#basic-datatables"
            , multiFilterSelector: "#multi-filter-select"
            , addRowSelector: "#add-row"
            , addRowButton: "#addRowButton"
            , modalSelector: "#addRowModal"
            , pageLength: 10
        , });

        // Category Delete alert
        handleDeleteButton("#basic-datatables", "#row_");

        //Category edit/update Success alert
        @if(session('success'))
        showAlert('success', "{{ session('success') }}");
        @endif

        @if(session('error'))
        showAlert('error', "{{ session('error') }}");
        @endif

    });

    $(document).ready(function() {
        $('.zoom-image').hover(
            function() {
                $(this).css('transform', 'scale(2)'); // Zoom in on hover
            }
            , function() {
                $(this).css('transform', 'scale(1)'); // Zoom out when hover ends
            }
        );
    });

    // Delete post
    $(document).ready(function () {
        // Add click event for delete button
        $('.delete').on('click', function () {
            var postId = $(this).data('id'); // Get post ID from the data_id attribute
            var form = $('#form_' + postId); // Get the form corresponding to the post ID

            // Confirm before deleting
            if (confirm('Are you sure you want to delete this post?')) {
                form.submit(); // Submit the form if confirmed
            }
        });
    });

</script>
@endpush
