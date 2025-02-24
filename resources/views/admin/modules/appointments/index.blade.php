@extends('admin.layouts.master')

@section('name', 'Appointment')
@section('title', 'Appointment List')


@section('content')
<div class="page-inner">

    {{-- Breadcrumb Start --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.appointments.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.appointments.index') }}">@yield('name')</a>
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
                        <h4 class="card-title">Appointment List</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover post_table" id="appointmentsTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Appointment Date</th>
                                    <th>Start Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $index => $appointment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</td>
                                    <td>{{ ucfirst($appointment->status) }}</td>
                                    <td>
                                        <!-- Status Update Buttons -->
                                        <form action="{{ route('admin.appointments.updateStatus', $appointment->id) }}" method="POST" class="d-inline update-status-form">
                                            @csrf
                                            <select name="status" class="form-control form-control-sm status-select" data-id="{{ $appointment->id }}">
                                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                                <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Cancel</option>
                                                <option value="rescheduled" {{ $appointment->status == 'rescheduled' ? 'selected' : '' }}>Reschedule</option>
                                            </select>
                                        </form>

                                        <!-- Edit and Delete Actions (if needed) -->
                                        <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
        // Initialize DataTables with given selectors and options
        initializeDataTables({
            basicSelector: "#basic-datatables"
            , multiFilterSelector: "#multi-filter-select"
            , addRowSelector: "#add-row"
            , addRowButton: "#addRowButton"
            , modalSelector: "#addRowModal"
            , pageLength: 10
        });

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
                            Swal.fire('Deleted!', 'Your comment has been deleted.', 'success')
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

        // Initialize DataTable for appointments table (if exists)
        $('#appointmentsTable').DataTable();

        // Status update via AJAX when status select dropdown changes
        $('.status-select').on('change', function() {
            var select = $(this);
            var appointmentId = select.data('id');
            var newStatus = select.val();

            $.ajax({
                url: "{{ url('/admin/appointments') }}/" + appointmentId + "/update-status"
                , method: "POST"
                , data: {
                    status: newStatus
                    , _token: "{{ csrf_token() }}"
                }
                , success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error("Status update failed!");
                    }
                }
                , error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error("Something went wrong!");
                }
            });
        });

        // Delete confirmation for forms with the class 'delete-form'
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?'
                , text: "This action cannot be undone!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Include Sweet Alert partial for additional alert configuration if needed
    @include('admin.partials.sweet-alert')

</script>
@endpush
