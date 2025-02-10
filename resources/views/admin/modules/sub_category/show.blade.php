@extends('admin.layouts.master')


@section('name', 'Sub Category')

@section('title', 'Sub Category')

@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('sub-category.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('sub-category.index') }}">Sub Category</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Sub Category Details</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sub Category Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $sub_category->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $sub_category->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $sub_category->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $sub_category->category->title }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $sub_category->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $sub_category->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Created at</th>
                                    <td>{{ $sub_category->created_at->format('d-m-Y')}}</td>
                                </tr>

                                <tr>
                                    <th>Updated at</th>
                                    <td>{{ $sub_category->created_at != $sub_category->updated_at ? $sub_category->updated_at->format('d-m-Y') : "Not Updated" }}</td>
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
