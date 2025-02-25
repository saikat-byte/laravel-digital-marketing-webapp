@extends('admin.layouts.master')

@section('name', 'SEO Settings List')
@section('title', 'SEO Settings')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('seo.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('seo.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">SEO Settings List</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($pages->count())
                        <table class="table table-bordered table-striped table-hover post_table" id="pageseo">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Page Name</th>
                                    <th>SEO Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $index => $page)
                                @php
                                // If SEO record exists $page->seoSetting will return the SEO record
                                $seo = \App\Models\PageSeoSetting::firstOrNew(['page_id' => $page->id]);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $page->name }}</td>
                                    <td>
                                        @if($seo->exists)
                                        <span class="badge bg-success">Exists</span>
                                        @else
                                        <span class="badge bg-warning">Not Created</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit link; Edit page will handle both create and update via firstOrNew() -->

                                            @if($seo->exists)
                                            <a href="{{ route('seo.edit', $page->id) }}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            @else
                                            <a href="{{ route('seo.edit', $page->id) }}" class="btn btn-success btn-sm text-white">Create</a>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No pages found.</p>
                        @endif
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
        // Initialize DataTables with given selectors and options
        initializeDataTables({
            basicSelector: "#basic-datatables"
            , multiFilterSelector: "#multi-filter-select"
            , addRowSelector: "#add-row"
            , addRowButton: "#addRowButton"
            , modalSelector: "#addRowModal"
            , pageLength: 10
        });

        // Initialize DataTable for appointments table (if exists)
        $('#pageseo').DataTable();
    });

    // Include Sweet Alert partial for additional alert configuration if needed
    @include('admin.partials.sweet-alert')

</script>
@endpush
