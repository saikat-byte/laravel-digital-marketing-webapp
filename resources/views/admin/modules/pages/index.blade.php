@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Pages</h3>
        <a href="{{ route('page.create') }}" class="btn btn-primary">Add New Page</a>
    </div>

    {{-- Dashboard Summary --}}
    <div class="row mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Pages</p>
                                <h4 class="card-title">{{ $totalPages }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-success card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Pages</p>
                                <h4 class="card-title">{{ $activePages }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-warning card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-th-large"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Sections</p>
                                <h4 class="card-title">{{ $totalSections }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-danger card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Sections</p>
                                <h4 class="card-title">{{ $activeSections }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Pages Table --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Active Pages</h4>
                </div>
                <div class="card-body">
                    <table id="active-pages-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sort</th>
                                <th>SL</th>
                                <th>Page Name</th>
                                <th>Page Slug</th>
                                <th>Order</th>
                                <th>Sections</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-pages">
                            @foreach($pages->whereNull('deleted_at') as $index => $page)
                            <tr data-id="{{ $page->id }}">
                                <td>
                                    <!-- Drag handle icon -->
                                    <i class="fas fa-arrows-alt handle" style="cursor: move;"></i>
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->order }}</td>
                                <td>{{ $page->sections_count }}</td>
                                <td>
                                    <button class="btn btn-sm toggle-status" data-id="{{ $page->id }}">
                                        <i class="fas fa-toggle-{{ $page->status ? 'on' : 'off' }} fa-2x {{ $page->status ? 'text-success' : 'text-danger' }}"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('page.soft-delete', $page->id) }}" method="POST" class="delete-form" style="display:inline;">
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

    {{-- Trashed Pages Table --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-danger">Trashed Pages</h4>
                </div>
                <div class="card-body">
                    <table id="deleted-pages-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Page Name</th>
                                <th>Deleted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages->whereNotNull('deleted_at') as $index => $page)
                            <tr class="table-danger">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('page.restore', $page->id) }}" class="btn btn-warning btn-sm">Restore</a>
                                    <form action="{{ route('page.force-delete', $page->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this page?')">Delete Permanently
                                        </button>
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


@push('custom_js')
<script>
    // active pages
    $(document).ready(function() {
        $('#active-pages-table').DataTable({
            "pageLength": 10
            , "language": {
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'>"
                    , "next": "<i class='fas fa-angle-right'>"
                }
            }
        });

        // Delete page table
        $('#deleted-pages-table').DataTable({
            "pageLength": 5
            , "language": {
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'>"
                    , "next": "<i class='fas fa-angle-right'>"
                }
            }
        });

        // Page active/inactive Toggle status button click event
        $(document).on("click", ".toggle-status", function(e) {
            e.preventDefault(); // Prevent default button behavior

            var btn = $(this);
            var pageId = btn.data("id");

            $.ajax({
                url: "/admin/page/" + pageId + "/toggle-status", // URL must match your route
                type: "POST"
                , data: {
                    _token: "{{ csrf_token() }}" // CSRF token for security
                }
                , success: function(response) {
                    if (response.success) {
                        // Update the icon in the button based on new status
                        var icon = btn.find("i");
                        if (response.status) {
                            icon.removeClass("fa-toggle-off text-danger").addClass("fa-toggle-on text-success");
                        } else {
                            icon.removeClass("fa-toggle-on text-success").addClass("fa-toggle-off text-danger");
                        }
                        // Optionally, you can show a success message via toastr or Swal
                        toastr.success(response.message);
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


        // Page Drag & Drop order change
        $("#sortable-pages").sortable({
        update: function(event, ui) {
            // নতুন order array তৈরি করুন, যেখানে প্রতিটি <tr> এর data-id attribute ব্যবহার করা হয়েছে
            var order = [];
            $("#sortable-pages tr").each(function(index) {
                order.push($(this).attr("data-id"));
                // Update the serial number column (assuming first td is drag handle, second td is SL)
                $(this).find("td:eq(1)").text(index + 1);
                // যদি আপনার অন্য কোনো order column থাকে (যেমন, 5th td) তাহলে সেটিও আপডেট করুন
                // $(this).find("td.order-column").text(index); // উদাহরণস্বরূপ
            });
            console.log("New order array:", order);
            $.ajax({
                url: "{{ route('pages.updateOrder') }}",
                method: "POST",
                data: {
                    order: order,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message);
                    // এখানে পেজ reload না করেই, UI update হবে কারণ আমরা DOM-এ serial numbers আপডেট করেছি।
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error("Failed to update order!");
                }
            });
        }
    });





    });


    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
    toastr.error("{{ session('error') }}");
    @endif

</script>
@endpush
