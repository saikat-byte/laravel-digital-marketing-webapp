@extends('admin.layouts.master')

@section('title', 'View Review')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Review Details</h3>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>Client Name:</strong> {{ $review->client_name }}
            </div>
            <div class="mb-3">
                <strong>Comment:</strong> {{ $review->client_comment }}
            </div>
            <div class="mb-3">
                <strong>Rating:</strong> {{ $review->rating }} / 5
            </div>
            <div class="mb-3">
                <strong>Image:</strong><br>
                <img src="{{ asset($review->client_image ?? 'assets/image/reviews/default.jpg') }}" alt="Client Image" style="max-width: 150px;">
            </div>
            <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
