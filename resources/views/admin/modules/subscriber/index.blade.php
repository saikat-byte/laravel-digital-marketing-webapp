@extends('admin.layouts.master')

@section('name', 'Subscriber')
@section('title', 'Subscriber list')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.subscribers.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.subscribers.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">Subscriber List</h4>
                        <a href="{{ route('admin.subscribers.index') }}" class="btn btn-info"> Subscriber List </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover post_table">
                            <thead>
                                <tr>
                                    <th class="table-heading-text">ID</th>
                                    <th class="table-heading-text">Name</th>
                                    <th class="table-heading-text">Email</th>
                                    <th class="table-heading-text">Subscribed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                               @foreach($subscribers as $subscriber)
                               <tr>
                                   <td>{{ $sl++ }}</td>
                                   <td>{{ $subscriber->name ?? 'N/A' }}</td>
                                   <td>{{ $subscriber->email }}</td>
                                   <td>{{ $subscriber->created_at->format('d M, Y H:i') }}</td>
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


    });

    @if(session('success'))
    showAlert('success', "{{ session('success') }}");
    @endif

    @if(session('error'))
    showAlert('error', "{{ session('error') }}");
    @endif

</script>
@endpush
