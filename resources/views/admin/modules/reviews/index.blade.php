@extends('admin.layouts.master')

@section('name', 'Reviews list')
@section('title', 'Reviews Management')

@section('content')
<div class="page-inner">
    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('reviews.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('reviews.index') }}">@yield('name')</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">@yield('title')</a>
            </li>
        </ul>
    </div>
    {{-- Breadcrumb End --}}

    {{-- Page Content Start --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Reviews List</h4>
                        <a href="{{ route('reviews.create') }}" class="btn btn-info"> Add review </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover post_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client Image</th>
                                    <th>Client Name</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>
                                        <img src="{{ asset($review->client_image ?? 'assets/image/reviews/default.jpg') }}" alt="{{ $review->client_name }}" style="max-width: 80px;">
                                    </td>
                                    <td>{{ $review->client_name }}</td>
                                    <td>{{ Str::limit($review->client_comment, 50) }}</td>
                                    <td>{{ $review->rating }} / 5</td>
                                    <td>
                                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-button"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
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
    // Delete Button using jquery
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

        // delete using ajax
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?'
                , text: "This action cannot be undone!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
                , cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action')
                        , method: 'POST'
                        , data: form.serialize()
                        , success: function(response) {
                            Swal.fire('Deleted!', 'Your comment has been deleted.', 'success')
                                .then(() => {
                                    // Optionally reload page or remove comment from DOM
                                    location.reload();
                                });
                        }
                        , error: function(xhr) {
                            Swal.fire('Error!', 'There was an error deleting the comment.', 'error');
                        }
                    });
                }
            });
        });


    });


    @include('admin.partials.sweet-alert')

</script>
@endpush
