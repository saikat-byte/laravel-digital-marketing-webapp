@extends('admin.layouts.master')

@section('name', 'Post SEO Setting List')
@section('title', 'Post seo setting')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('post.seo.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('post.seo.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">Post SEO Setting List</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($posts->count())
                        <table class="table table-bordered table-striped table-hover post_table" id="postseolist">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Post Title</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Post SEO Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $index => $post)
                                @php
                                // if SEO record exists $post->seoSetting will return the SEO record
                                $seo = $post->seoSetting;
                                $seo = \App\Models\PostSeoSetting::firstOrNew(['post_id' => $post->id]);

                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $seo->meta_title ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($seo->meta_description ?? '', 50) }}</td>
                                    <td>
                                        @if($seo->exists)
                                        <span class="badge bg-success">Exists</span>
                                        @else
                                        <span class="badge bg-warning">Not Created</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($seo->exists)
                                        <a href="{{ route('post.seo.edit', $post->id) }}" class="btn btn-primary btn-sm text-white">Edit</a>
                                        @else
                                        <a href="{{ route('post.seo.edit', $post->id) }}" class="btn btn-success btn-sm text-white">Create</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No posts found.</p>
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
        $('#postseolist').DataTable();
    });

    // Include Sweet Alert partial for additional alert configuration if needed
    @include('admin.partials.sweet-alert')

</script>
@endpush
