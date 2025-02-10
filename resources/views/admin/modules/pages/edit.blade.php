@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Edit Page - {{ $page->name }}</h3>
        <a href="{{ route('page.index') }}" class="btn btn-secondary">Back to Pages</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Page Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('page.update', $page->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Page Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $page->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Page Title (SEO)</label>
                            <input type="text" class="form-control" name="title" value="{{ $page->title }}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description">{{ $page->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Page</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Management --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Sections</h4>
                </div>
                <div class="card-body">
                    <form id="sectionForm" action="{{ route('page.sections.store', $page->id) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page->id }}">

                        {{-- ✅ Section Name --}}
                        <div class="form-group">
                            <label>Section Name <span class="text-danger">*</span></label>
                            <input type="text" id="sectionName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            <span class="text-danger error-message">@error('name'){{ $message }}@enderror</span>
                        </div>

                        {{-- ✅ Section Slug --}}
                        <div class="form-group">
                            <label>Section Slug (Auto Generate) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="sectionSlug" readonly>
                        </div>


                        {{-- ✅ Section Type --}}
                        <div class="form-group">
                            <label>Section Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select Section Type</option>
                                @foreach($sectionTypes as $type)
                                <option value="{{ $type->code }}" {{ old('type') == $type->code ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger error-message">@error('type'){{ $message }}@enderror</span>
                        </div>

                        {{-- ✅ Heading, Sub-heading & Paragraph --}}
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" value="{{ old('heading') }}">
                            <span class="text-danger error-message">@error('heading'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Sub-heading</label>
                            <input type="text" class="form-control @error('sub_heading') is-invalid @enderror" name="sub_heading" value="{{ old('sub_heading') }}">
                            <span class="text-danger error-message">@error('sub_heading'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Paragraph</label>
                            <textarea class="form-control @error('paragraph') is-invalid @enderror" name="paragraph" rows="4">{{ old('paragraph') }}</textarea>
                            <span class="text-danger error-message">@error('paragraph'){{ $message }}@enderror</span>
                        </div>


                        {{-- ✅ Image Upload (With Preview) --}}
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" class="form-control" name="image" id="singleImageUpload" accept="image/*">
                            <div id="singleImagePreview"></div> <!-- Image preview -->
                        </div>

                        {{-- ✅ Multi-Image Upload --}}
                        <div class="form-group">
                            <label>Upload Multiple Images</label>
                            <input type="file" class="form-control" name="multi_image[]" multiple accept="image/*">
                            <div id="multi-image-preview" class="d-flex flex-wrap mt-2"></div>
                        </div>

                        {{-- ✅ Video Upload --}}
                        <div class="form-group">
                            <label>Upload Video</label>
                            <input type="file" class="form-control" name="video" accept="video/*">
                            <div id="video-container"></div>
                            <!--video preview -->
                        </div>

                        {{-- ✅ Buttons --}}
                        <div class="form-group">
                            <label>Button 1 Text</label>
                            <input type="text" class="form-control @error('button_1_text') is-invalid @enderror" name="button_1_text" value="{{ old('button_1_text') }}">
                            <span class="text-danger error-message">@error('button_1_text'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Button 1 Link</label>
                            <input type="url" class="form-control @error('button_1_link') is-invalid @enderror" name="button_1_link" value="{{ old('button_1_link') }}">
                            <span class="text-danger error-message">@error('button_1_link'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Button 2 Text</label>
                            <input type="text" class="form-control @error('button_2_text') is-invalid @enderror" name="button_2_text" value="{{ old('button_2_text') }}">
                            <span class="text-danger error-message">@error('button_2_text'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Button 2 Link</label>
                            <input type="url" class="form-control @error('button_2_link') is-invalid @enderror" name="button_2_link" value="{{ old('button_2_link') }}">
                            <span class="text-danger error-message">@error('button_2_link'){{ $message }}@enderror</span>
                        </div>

                        {{-- ✅ PDF Upload --}}
                        <div class="form-group">
                            <label>Upload PDF</label>
                            <input type="file" class="form-control" name="pdf" accept=".pdf">
                        </div>

                        {{-- Custom Fields --}}
                        <div class="form-group">
                            <label>Custom Fields</label>
                            <div id="custom-fields-container">
                                <div class="d-flex mb-2">
                                    <input type="text" class="form-control" name="custom_fields[0][name]" placeholder="Field Name">
                                    <select name="custom_fields[0][type]" class="form-control ml-2">
                                        @foreach($customFieldType as $type)
                                        <option value="{{ $type->code }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- Hidden select to store custom field options -->
                                    <select id="customFieldOptions" style="display: none;">
                                        @foreach($customFieldType as $type)
                                        <option value="{{ $type->code }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control ml-2" name="custom_fields[0][value]" placeholder="Field Value">
                                    <button type="button" class="btn btn-danger btn-sm remove-field ml-2">Remove</button>
                                </div>
                            </div>
                            <button type="button" id="add-more-fields" class="btn btn-sm btn-success">+ Add More Field</button>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Existing Sections List --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Existing Sections</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Section Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sectionsContainer">
                            @foreach($page->sections()->whereNull('deleted_at')->get() as $index => $section)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ ucfirst($section->type) }}</td>
                                <td>
                                    <a href="{{ route('page.sections.edit', $section->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('page.sections.soft-delete', $section->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Soft Delete</button>
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-danger">Trashed Sections</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Section Name</th>
                                <th>Deleted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($page->sections()->onlyTrashed()->get() as $index => $section)
                            <tr class="table-danger">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('page.sections.restore', ['id' => $section->id]) }}" class="btn btn-warning btn-sm">Restore</a>
                                    <form action="{{ route('page.sections.force-delete', ['id' => $section->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this section?')">Delete Permanently</button>
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
@endpush
