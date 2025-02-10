@extends('admin.layouts.master')


@section('name', 'Category')

@section('title', 'Category List')

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
                <a href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Category Details</a>
            </li>
        </ul>
    </div>

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
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $category->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $category->slug }}</td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td>{{ $category->description }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $category->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Created at</th>
                                    <td>{{ $category->created_at->format('d-m-Y')}}</td>
                                </tr>

                                <tr>
                                    <th>Updated at</th>
                                    <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDayDateTimeString() : "Not Updated" }}</td>
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
