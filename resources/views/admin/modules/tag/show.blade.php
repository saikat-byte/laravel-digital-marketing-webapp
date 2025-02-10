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
                <a href="{{ route('tag.index') }}">Tag</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tag Details</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tag Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $tag->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $tag->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $tag->slug }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $tag->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $tag->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Created at</th>
                                    <td>{{ $tag->created_at->format('d-m-Y')}}</td>
                                </tr>

                                <tr>
                                    <th>Updated at</th>
                                    <td>{{ $tag->created_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString() : "Not Updated" }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
