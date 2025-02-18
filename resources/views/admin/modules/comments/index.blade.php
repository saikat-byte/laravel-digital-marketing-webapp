@extends('admin.layouts.master')

@section('name', 'Comment')
@section('title', 'Comment List')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.comments.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.comments.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">Comment List</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover post_table">
                            <thead>
                                <tr>
                                    <th class="table-heading-text">ID</th>
                                    <th class="table-heading-text">Author</th>
                                    <th class="table-heading-text">Comment</th>
                                    <th class="table-heading-text">Rating</th>
                                    <th class="table-heading-text">Post</th>
                                    <th class="table-heading-text">Status</th>
                                    <th class="table-heading-text">Created At</th>
                                    <th class="table-heading-text">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->user->name ?? 'Unknown' }}</td>
                                    <td>{{ Str::limit($comment->content, 50) }}</td>
                                    <td>
                                        @if($comment->rating)
                                        @for ($i = 1; $i <= $comment->rating; $i++)
                                            <i class="fas fa-star" style="color: #ffc107;"></i>
                                            @endfor
                                            ({{ $comment->rating }})
                                            @else
                                            <span class="text-muted">No Rating</span>
                                            @endif
                                    </td>

                                    <td>{{ $comment->post->title ?? '' }}</td>
                                    <td>
                                        @if($comment->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                        @else
                                        <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>

                                    <td>{{ $comment->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @if($comment->status == 0)
                                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success approve-button"><i class="fas fa-thumbs-up"></i></button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-button"><i class="icon-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $comments->links() }}
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

        // Approve comment

        $('.approve-button').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Approve Comment?'
                , text: "Do you want to approve this comment?"
                , icon: 'question'
                , showCancelButton: true
                , confirmButtonColor: '#28a745', // green color for approval
                cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, approve it!'
                , cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });


    });

    @include('admin.partials.sweet-alert')


</script>
@endpush
