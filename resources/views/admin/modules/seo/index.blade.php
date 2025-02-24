@extends('admin.layouts.master')

@section('title', 'SEO Settings List')

@section('content')
<div class="page-inner">
    <h3 class="page-title">SEO Settings List</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pages->count())
        <table class="table table-bordered">
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
                        // যদি SEO record না থাকে, তাহলে firstOrNew() call করে একটি new instance নিন
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
                            <a href="{{ route('seo.edit', $page->id) }}" class="btn btn-primary btn-sm">
                                @if($seo->exists)
                                    Edit
                                @else
                                    Create
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
@endsection
