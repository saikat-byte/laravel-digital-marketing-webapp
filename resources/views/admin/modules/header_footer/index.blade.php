@extends('admin.layouts.master')

@section('name', 'Header & Footer manage')
@section('title', 'Header & Footer manage')


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
                        <h4 class="card-title">Header & Footer manage</h4>
                        <a href="{{ route('post.create') }}" class="btn btn-info"> Add post </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="container">

                        <form action="{{ route('header_footer.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Header Settings -->
                            <h3>Header Settings</h3>
                            <div class="form-group">
                                <label>Header Logo</label>
                                @if(isset($header) && $header->logo)
                                <img src="{{ asset('storage/' . $header->logo) }}" alt="Header Logo" style="max-height: 50px;" id="headerLogoPreview">
                                <input type="hidden" name="header[current_logo]" value="{{ $header->logo }}">
                                @endif
                                <input type="file" name="header[logo]" class="form-control" onchange="previewImage(event, 'headerLogoPreview')">
                                @error('header[current_logo]')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Navbar Links (JSON format)</label>
                                <textarea name="header[nav_links]" class="form-control" rows="10">{{ isset($header) && $header->nav_links ? json_encode($header->nav_links, JSON_PRETTY_PRINT) : '' }}</textarea>
                                <small class="form-text text-muted">
                                    Example: [{"name": "Home", "url": "{{ route('frontend.page.show', ['slug' => 'home']) }}"}, {"name": "Service", "url": "{{ route('frontend.page.show', ['slug' => 'service']) }}"}]
                                </small>
                                @error('header[nav_links]')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Button Text</label>
                                <input type="text" name="header[button_text]" class="form-control" value="{{ optional($header)->button_text ?? '' }}">
                                @error('header[button_text]')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Button Link</label>
                                <input type="text" name="header[button_link]" class="form-control" value="{{ optional($header)->button_link ?? '' }}">
                                @error('header[button_link]')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="header[status]" class="form-control">
                                    <option value="1" {{ (optional($header)->status ?? 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (isset($header->status) && !$header->status) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <hr>

                            <!-- Footer Settings -->
                            <h3>Footer Settings</h3>
                            <div class="form-group">
                                <label>Footer Logo</label>
                                @if(isset($footer) && $footer->logo)
                                <img src="{{ asset('storage/' . $footer->logo) }}" alt="Footer Logo" style="max-height: 50px;" id="footerLogoPreview">
                                <input type="hidden" name="footer[current_logo]" value="{{ $footer->logo }}">
                                @endif
                                <input type="file" name="footer[logo]" class="form-control" onchange="previewImage(event, 'footerLogoPreview')">
                            </div>
                            <div class="form-group">
                                <label>Footer Header Text</label>
                                <input type="text" name="footer[header_text]" class="form-control" value="{{ optional($footer)->header_text ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Footer Paragraph</label>
                                <textarea name="footer[paragraph]" class="form-control" rows="3">{{ optional($footer)->paragraph ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Footer Sections (JSON format)</label>
                                <textarea name="footer[sections]" class="form-control" rows="10">{{ isset($footer) && $footer->sections ? json_encode($footer->sections, JSON_PRETTY_PRINT) : '' }}</textarea>
                                <small class="form-text text-muted">
                                    Example structure:
                                    <pre>
                    {
                      "section1": {
                          "heading": "LOREM IPSUM",
                          "links": [
                             {"text": "Lorem Ipsum", "url": "#"},
                             {"text": "Lorem Ipsum", "url": "#"},
                             {"text": "Lorem Ipsum", "url": "#"},
                             {"text": "Lorem Ipsum", "url": "#"},
                             {"text": "Lorem Ipsum", "url": "#"}
                          ]
                      },
                      "section2": { "heading": "LOREM IPSUM", "links": [ ... ] },
                      "section3": { "heading": "LOREM IPSUM", "links": [ ... ] },
                      "section4": { "heading": "LOREM IPSUM", "links": [ ... ] }
                    }
                                    </pre>
                                </small>
                            </div>
                            <div class="form-group">
                                <label>Social Icons (JSON format)</label>
                                <textarea name="footer[social_icons]" class="form-control" rows="10">{{ isset($footer) && $footer->social_icons ? json_encode($footer->social_icons, JSON_PRETTY_PRINT) : '' }}</textarea>
                                <small class="form-text text-muted">
                                    Example: [{"icon": "fab fa-facebook", "url": "#"}, {"icon": "fab fa-instagram", "url": "#"}, {"icon": "fab fa-linkedin", "url": "#"}]
                                </small>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="footer[status]" class="form-control">
                                    <option value="1" {{ (optional($footer)->status ?? 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (isset($footer->status) && !$footer->status) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
<!-- JavaScript for image preview -->
<script>
    function previewImage(event, previewId) {
        var output = document.getElementById(previewId);
        if (event.target.files && event.target.files[0]) {
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // free memory
            }
        }
    }


@include('admin.partials.sweet-alert')

</script>

@endpush
