@extends('admin.layouts.master')

@section('name', 'All Users')
@section('title', 'All Users List')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.users.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">All User List</h4>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-info"> Create user </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover post_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>User Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $sl++}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                        $imagePath = $user->image_path ? $user->image_path : 'assets/image/profile-picture/default.jpg';
                                        @endphp
                                        <img src="{{ asset($imagePath) }}" alt="{{ $user->name }}" width="50" class="rounded-circle">
                                    </td>
                                    <td>{{ ucfirst($user->user_type) }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-button">Delete</button>
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


        // Delete using AJAX with SweetAlert confirmation
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
                            Swal.fire('Deleted!', 'Usert has been deleted.', 'success')
                                .then(() => {
                                    location.reload(); // Reload page after deletion
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
