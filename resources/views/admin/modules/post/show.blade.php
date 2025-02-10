@extends('admin.layouts.master')


@section('name', 'Post Details')

@section('title', 'Post Details')

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
                <a href="{{ route('category.index') }}">Post</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Post Details</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Post Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $post->id }}</td>
                                </tr>
                                <tr>
                                    <th>Post title</th>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug name</th>
                                    <td>{{ $post->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Is Approved</th>
                                    <td>{{ $post->is_approved == 1 ? "Approved" : "Not Approved" }}</td>
                                </tr>
                                <tr>

                                    <th>Description</th>
                                    <td>{!! $post->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $post->status == 1 ? "Published" : "Not published" }}</td>
                                </tr>
                                <tr>
                                    <th>Admin comment</th>
                                    <td>{{ $post->admin_comment }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <img class="img-thumbnail post_image zoom-image" src="{{ asset('assets/image/postimage/thumbnail/'.pathinfo($post->post_image, PATHINFO_FILENAME).'_thumb'.'.'.pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->post_image }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tags</th>
                                    <td>
                                        @php
                                        $classes = ['text-bg-primary', 'text-bg-secondary', 'text-bg-dark', 'text-bg-danger', 'text-bg-warning', 'text-bg-info', ' text-bg-success']
                                        @endphp

                                        @foreach ($post->tag as $tag)

                                        <a href="{{ route('tag.show', $tag->id) }}"> <span class="badge py-2  {{ $classes[random_int(0,6)] }} "> {{ $tag->title }}</span></a>

                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deleted at</th>
                                    <td>{{ $post->deleted_at != null ? \Carbon\Carbon::parse($post->deleted_at)->format('d-m-Y')
                                        : "Not deleted" }}</td>
                                </tr>
                                <tr>
                                    <th>Created at</th>
                                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated at</th>
                                    <td>{{ $post->updated_at != $post->created_at ?
                                        Carbon\Carbon::parse($post->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                                </tr>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Id</th>
                                            <td>{{ $post->category->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $post->category->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $post->category->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $post->category->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $post->category->status == 1 ? "Published" : "Not published" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created at</th>
                                            <td>{{ \Carbon\Carbon::parse($post->category->created_at)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated at</th>
                                            <td>{{ $post->category->updated_at != $post->category->created_at ?
                                                Carbon\Carbon::parse($post->category->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Subcategory details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Id</th>
                                            <td>{{ $post->subcategory->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $post->subcategory->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $post->subcategory->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $post->subcategory->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $post->subcategory->status == 1 ? "Published" : "Not published" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created at</th>
                                            <td>{{ \Carbon\Carbon::parse($post->subcategory->created_at)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated at</th>
                                            <td>{{ $post->subcategory->updated_at != $post->subcategory->created_at ?
                                                Carbon\Carbon::parse($post->subcategory->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Id</th>
                                            <td>{{ $post->user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $post->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $post->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created at</th>
                                            <td>{{ \Carbon\Carbon::parse($post->user->created_at)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated at</th>
                                            <td>{{ $post->user->updated_at != $post->user->created_at ?
                                                Carbon\Carbon::parse($post->user->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        </div>
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
        $('.zoom-image').hover(
            function() {
                $(this).css('transform', 'scale(2)'); // Zoom in on hover
            }
            , function() {
                $(this).css('transform', 'scale(1)'); // Zoom out when hover ends
            }
        );
    });

</script>
@endpush
