@extends('admin.layouts.master')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Create New Page</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator"><i class="fas fa-angle-right"></i></li>
            <li class="nav-item"><a href="{{ route('page.index') }}">Pages</a></li>
            <li class="separator"><i class="fas fa-angle-right"></i></li>
            <li class="nav-item"><a href="#">Create</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            {{-- Page Create Form --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Page Information</h4>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                </div>
                <div class="card-body">
                    <form action="{{ route('page.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Page Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="pageName" value="{{ old('name') }}">
                            <small class="form-text text-muted">Example: Home, About, Services</small>
                        </div>

                        <div class="form-group">
                            <label>Slug (Auto Generate)</label>
                            <input type="text" class="form-control" name="slug" id="pageSlug" readonly>
                        </div>

                        <div class="form-group">
                            <label>Page Title (SEO Friendly)</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Page Order</label>
                            <input type="number" class="form-control" name="order" value="0">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Page</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Instructions</h4>
                </div>
                <div class="card-body">
                    <p><b>Page Name:</b> This is the page name displayed in the menu.</p>
                    <p><b>Slug:</b> This will be auto-generated and cannot be changed.</p>
                    <p><b>Page Title:</b> This is used for SEO optimization.</p>
                    <p><b>Status:</b> If set to Inactive, the page will not be visible.</p>
                    <p><b>Page Order:</b> Helps arrange the pages in the menu.</p>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection

@push('custom_js')
<script>
    // slug auto generate if page name is given
    document.getElementById("pageName").addEventListener("keyup", function() {
        let name = this.value;
        let slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        document.getElementById("pageSlug").value = slug;
    });

    @include('admin.partials.sweet-alert')

</script>
@endpush
