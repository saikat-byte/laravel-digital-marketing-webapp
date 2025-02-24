@extends('admin.layouts.master')

@section('title', 'Edit Review')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Edit Review</h3>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name', $review->client_name) }}" required>
            @error('client_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_comment" class="form-label">Client Comment</label>
            <textarea name="client_comment" id="client_comment" class="form-control" required>{{ old('client_comment', $review->client_comment) }}</textarea>
            @error('client_comment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" class="form-control" value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
            @error('rating')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_image" class="form-label">Client Image</label>
            <div class="mb-2">
                <img id="imagePreview" src="{{ asset($review->client_image ?? 'assets/image/reviews/default.jpg') }}" alt="Client Image" style="max-width: 150px;">
            </div>
            <input type="file" name="client_image" id="client_image" class="form-control" accept="image/*">
            @error('client_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
</div>
@endsection

@section('custom-js')
@include('admin.partials.sweet-alert')
<script>
    document.getElementById('client_image').addEventListener('change', function() {
        if(this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
