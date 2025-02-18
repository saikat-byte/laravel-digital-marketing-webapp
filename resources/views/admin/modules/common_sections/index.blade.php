@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Common Sections</h3>
        <a href="{{ route('common.section.create') }}" class="btn btn-primary">Add New Section</a>
    </div>

    {{-- Existing Sections List --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Existing Sections</h4>
                </div>
                <div class="card-body">
                    <table id="exixting-sections-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Section Name</th>
                                <th>Section Slug</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sectionsContainer">
                            @foreach($commonSections as $index => $section)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->slug }}</td>
                                <td>{{ ucfirst($section->type) }}</td>
                                <td>
                                    <!-- Toggle Button for Section Status -->
                                    <button class="btn btn-sm toggle-section-status" data-id="{{ $section->id }}">
                                        <i class="fas fa-toggle-{{ $section->status ? 'on' : 'off' }} fa-2x {{ $section->status ? 'text-success' : 'text-danger' }}"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('common.section.edit', $section->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('common.section.soft-delete', $section->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Soft Delete</button>
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

    {{-- Trashed Sections --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-danger">Trashed Sections</h4>
                </div>
                <div class="card-body">
                    <table id="trashed-sections-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Section Name</th>
                                <th>Deleted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trashedSections as $index => $section)
                            <tr class="table-danger">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('common.section.restore', $section->id) }}" class="btn btn-warning btn-sm">Restore</a>
                                    <form action="{{ route('common.section.force-delete', $section->id) }}" method="POST" class="d-inline delete-btn">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
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
@endsection


@push('custom_css')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .handle {
        cursor: grab;
    }

</style>
@endpush

@push('custom_js')
<script src="{{ asset('assets/admin/js/sections.js') }}"></script>
<script src="{{ asset('assets/admin/js/sweetalert/delete_alert.js') }}"></script>

<script>
    // Existing section table pagination
    $(document).ready(function() {
        $('#exixting-sections-table').DataTable({
            "pageLength": 10
            , "language": {
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'>"
                    , "next": "<i class='fas fa-angle-right'>"
                }
            }
        });

        // Trashed section table pagination
        $('#trashed-sections-table').DataTable({
            "pageLength": 10
            , "language": {
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'>"
                    , "next": "<i class='fas fa-angle-right'>"
                }
            }
        });

        // Page section active inactive toggle

        // Instead of Inline event handler, event delegation
        $(document).on("click", ".toggle-section-status", function(e) {
            e.preventDefault();

            var btn = $(this);
            var sectionId = btn.data("id");

            $.ajax({
                url: "/admin/common-sections/" + sectionId + "/toggle-status", // toggle-status
                type: "POST"
                , data: {
                    _token: "{{ csrf_token() }}"
                }
                , success: function(response) {
                    if (response.success) {
                        var icon = btn.find("i");
                        if (response.status) {
                            icon.removeClass("fa-toggle-off text-danger").addClass("fa-toggle-on text-success");
                        } else {
                            icon.removeClass("fa-toggle-on text-success").addClass("fa-toggle-off text-danger");
                        }
                        toastr.success("Section status updated successfully!");
                    } else {
                        Swal.fire({
                            icon: "error"
                            , title: "Error!"
                            , text: response.message
                        });
                    }
                }
                , error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: "error"
                        , title: "Something Went Wrong!"
                        , text: xhr.statusText
                    });
                }
            });
        });

        // Delete form submission event handler
        $(".delete-form").on("submit", function(e) {
            e.preventDefault();
            var form = this;

            // SweetAlert confirmation modal
            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // user confirm
                    form.submit();
                }
            });
        });

    });

    @include('admin.partials.sweet-alert')


</script>
@endpush
