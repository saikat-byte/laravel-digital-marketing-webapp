@extends('admin.layouts.master')

@section('title', 'Add New Review')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Add New Review</h3>
    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name') }}">
            @error('client_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_comment" class="form-label">Client Comment</label>
            <textarea name="client_comment" id="client_comment" class="form-control">{{ old('client_comment') }}</textarea>
            @error('client_comment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" class="form-control" value="{{ old('rating') }}" min="1" max="5">
            @error('rating')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_image" class="form-label">Client Image</label>
            <input type="file" name="client_image" id="client_image" class="form-control" accept="image/*">
            @error('client_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Review</button>
    </form>
</div>
@endsection


@push('custom-js')
    <script>
        @include('admin.partials.sweet-alert')
    </script>
@endpush
