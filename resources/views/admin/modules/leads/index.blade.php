@extends('admin.layouts.master')

@section('name', 'Leads')
@section('title', 'Leads List')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.leads') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.leads') }}">@yield('name')</a>
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
                        <h4 class="card-title">Leads List</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>CRM Lead ID</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>CRM Lead ID</th>
                                    <th>Created At</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                               @foreach($leads as $lead)
                               <tr>
                                   <td>{{ $sl++ }}</td>
                                   <td>{{ $lead->name }}</td>
                                   <td>{{ $lead->email }}</td>
                                   <td>{{ $lead->phone }}</td>
                                   <td>{{ $lead->crm_lead_id }}</td>
                                   <td>{{ $lead->created_at }}</td>
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


        @if(session('success'))
        showAlert('success', "{{ session('success') }}");
        @endif

        @if(session('error'))
        showAlert('error', "{{ session('error') }}");
        @endif

    });

</script>
@endpush
