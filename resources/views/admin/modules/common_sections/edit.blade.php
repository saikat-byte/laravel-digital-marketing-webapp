@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Edit Section: {{ $section->name }}</h3>
        <a href="{{ route('common.section.index') }}" class="btn btn-secondary">Back to Common Sections</a>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Section Content</h4>
                </div>
                <div class="card-body">
                    <form id="updateSectionForm" action="{{ route('common.section.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Section Basic Information --}}
                        <div class="form-group">
                            <label>Section Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $section->name) }}">
                            @error('name')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Section Type --}}
                        <div class="form-group">
                            <label>Section Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                @foreach($sectionTypes as $type)
                                <option value="{{ $type->code }}" {{ old('type', $section->type) == $type->code ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('type')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Heading, Sub-heading & Paragraph --}}
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" value="{{ old('heading', $section->heading) }}">
                            @error('heading')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sub-heading</label>
                            <input type="text" class="form-control @error('sub_heading') is-invalid @enderror" name="sub_heading" value="{{ old('sub_heading', $section->sub_heading) }}">
                            @error('sub_heading')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Paragraph</label>
                            <textarea class="form-control @error('paragraph') is-invalid @enderror" name="paragraph" rows="4">{{ old('paragraph', $section->paragraph) }}</textarea>
                            @error('paragraph')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Image Upload --}}
                        <div class="form-group">
                            <label>Update Image</label>
                            <input type="file" id="singleImageUpload" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                            <div id="singleImagePreview" class="mt-2">
                                @if($section->image)
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('storage/' . $section->image) }}" class="img-thumbnail" style="max-width:200px;">
                                    <button type="button" id="removeExistingImage" class="btn btn-danger btn-sm position-absolute" style="top: 0; right: 0;">X</button>
                                </div>
                                @endif
                            </div>
                            <input type="hidden" id="remove_image" name="remove_image" value="0">
                            @error('image')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Multi-Image Upload --}}
                        <div class="form-group">
                            <label>Update Multiple Images</label>
                            <input type="file" class="form-control" name="multi_image[]" multiple accept="image/*">
                            <div class="d-flex flex-wrap mt-2" id="multi-image-preview">
                                @if($section->multi_image && is_array($section->multi_image))
                                @foreach($section->multi_image as $image)
                                <div class="position-relative m-1 multi-image-item">
                                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" alt="{{ $section->heading }}" style="max-width: 100px; margin: 5px;">
                                    <button type="button" class="btn btn-danger btn-sm remove-multi-image" data-image="{{ $image }}" style="position: absolute; top: 0; right: 0;">X</button>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- Hidden container to store paths of removed images -->
                            <div id="removed-multi-images-container"></div>
                        </div>

                        {{-- Video Upload --}}
                        <div class="form-group">
                            <label>Update Video</label>
                            <input type="file" class="form-control @error('video') is-invalid @enderror" name="video" accept="video/*">
                            <div id="video-container" class="mt-2">
                                @if($section->video)
                                <div class="position-relative d-inline-block">
                                    <video controls style="max-width:300px;">
                                        <source src="{{ asset('storage/' . $section->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <button type="button" id="removeExistingVideo" class="btn btn-danger btn-sm position-absolute" style="top:5px; right:5px; padding:2px 5px; font-size:12px; border-radius:50%; z-index:9999;">X</button>
                                </div>
                                @endif
                            </div>
                            <input type="hidden" id="remove_video" name="remove_video" value="0">
                            @error('video')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- PDF Upload --}}
                        <div class="form-group">
                            <label>Update PDF</label>
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" name="pdf" accept=".pdf">
                            @error('pdf')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                            @if($section->pdf)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $section->pdf) }}" target="_blank" class="btn btn-info">View PDF</a>
                            </div>
                            @endif
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <label>Button 1 Text</label>
                            <input type="text" class="form-control @error('button_1_text') is-invalid @enderror" name="button_1_text" value="{{ old('button_1_text', $section->button_1_text) }}">
                            @error('button_1_text')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Button 1 Link</label>
                            <input type="url" class="form-control @error('button_1_link') is-invalid @enderror" name="button_1_link" value="{{ old('button_1_link', $section->button_1_link) }}">
                            @error('button_1_link')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Button 2 Text</label>
                            <input type="text" class="form-control @error('button_2_text') is-invalid @enderror" name="button_2_text" value="{{ old('button_2_text', $section->button_2_text) }}">
                            @error('button_2_text')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Button 2 Link</label>
                            <input type="url" class="form-control @error('button_2_link') is-invalid @enderror" name="button_2_link" value="{{ old('button_2_link', $section->button_2_link) }}">
                            @error('button_2_link')
                            <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- ✅ Custom Fields --}}
                        <div class="form-group">
                            <label>Custom Fields</label>
                            <div id="custom-fields-container">
                                @php
                                // $customFields = json_decode($section->config, true) ?? [];
                                $customFields =$section->config;
                                $config = $section->config ?: ['fields' => []];
                                @endphp
                                @foreach($customFields as $index => $fieldValue)
                                <div class="d-flex mb-2 field-group">
                                    <input type="text" class="form-control" name="custom_fields[{{ $index }}][name]" value="{{ $index }}" placeholder="Field Name">
                                    <select name="custom_fields[{{ $index }}][type]" class="form-control ml-2">
                                        @foreach($customFieldType as $type)
                                        <option value="{{ $type->code }}" {{ (isset($fieldValue['type']) && $fieldValue['type'] == $type->code) ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control ml-2" name="custom_fields[{{ $index }}][value]" value="{{ $fieldValue }}" placeholder="Field Value">
                                    <button type="button" class="btn btn-danger btn-sm remove-field ml-2">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-more-fields" class="btn btn-sm btn-success">+ Add More Field</button>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Section</button>
                    </form>
                </div>
                <!-- Hidden container for custom field type options -->
                <div id="customFieldOptions" style="display: none;">
                    @foreach($customFieldType as $type)
                    <option value="{{ $type->code }}">{{ $type->name }}</option>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="{{ asset('assets/admin/js/sections.js') }}"></script>
@endpush
