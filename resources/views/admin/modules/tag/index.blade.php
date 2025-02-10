@extends('admin.layouts.master')

@section('name', 'Tag')
@section('title', 'Tag List')


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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- @include('admin.modules.message') --}}
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Tag List</h4>
                        <a href="{{ route('tag.create') }}" class="btn btn-info"> Add tag </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($tags as $tag)
                                <tr id="row_{{ $tag->id }}">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $tag->title }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>
                                        <span class="badge {{ $tag->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $tag->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $tag->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        {{ $tag->created_at != $tag->updated_at ? $tag->updated_at->format('d-m-Y') : "Not Updated" }}
                                    </td>
                                    <td>
                                        <a href="{{ route('tag.show', $tag->id) }}" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                                            <i class="icon-note"></i>
                                        </a>
                                        <form action="{{ route('tag.destroy', $tag->id) }}" method="POST" class="delete-form" id="form_{{ $tag->id }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $tag->id }}">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
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

        // tag Delete alert
        handleDeleteButton("#basic-datatables", "#row_");

        //tag edit/update Success alert
        @if(session('success'))
        showAlert('success', "{{ session('success') }}");
        @endif

        @if(session('error'))
        showAlert('error', "{{ session('error') }}");
        @endif

    });


</script>
@endpush
