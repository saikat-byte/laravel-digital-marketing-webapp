@extends('admin.layouts.master')

@section('title', 'Post SEO Settings List')

@section('content')
<div class="page-inner">
    <h3 class="page-title">Post SEO Settings List</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($posts->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Post Title</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $index => $post)
                    @php
                        // if SEO record exists  $post->seoSetting will return the SEO record
                        $seo = $post->seoSetting;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $seo->meta_title ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($seo->meta_description ?? '', 50) }}</td>
                        <td>
                            @if($seo)
                                <a href="{{ route('post.seo.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            @else
                                <a href="{{ route('post.seo.edit', $post->id) }}" class="btn btn-success btn-sm">Create</a>
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
@endsection
