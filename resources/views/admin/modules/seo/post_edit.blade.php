@extends('admin.layouts.master')

@section('title', 'Edit Post SEO Settings')

@section('content')
<div class="page-inner">
    <h3>Edit SEO Settings for Post: {{ $post->title }}</h3>

    <form action="{{ route('post.seo.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Meta Title -->
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $seo->meta_title) }}">
            @error('meta_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Meta Description -->
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $seo->meta_description) }}</textarea>
            @error('meta_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Meta Keywords -->
        <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" rows="2">{{ old('meta_keywords', $seo->meta_keywords) }}</textarea>
            @error('meta_keywords')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        <!-- Open Graph Settings -->
        <h4>Open Graph Settings</h4>
        <div class="form-group">
            <label for="og_title">OG Title</label>
            <input type="text" class="form-control @error('og_title') is-invalid @enderror" id="og_title" name="og_title" value="{{ old('og_title', $seo->og_title) }}">
            @error('og_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="og_description">OG Description</label>
            <textarea class="form-control @error('og_description') is-invalid @enderror" id="og_description" name="og_description" rows="3">{{ old('og_description', $seo->og_description) }}</textarea>
            @error('og_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="og_image">OG Image</label>
            @if($seo->og_image)
            <div>
                <img src="{{ asset('storage/' . $seo->og_image) }}" alt="OG Image" style="max-width: 200px;">
            </div>
            @endif
            <input type="file" class="form-control @error('og_image') is-invalid @enderror" id="og_image" name="og_image">
            @error('og_image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        <!-- Twitter Settings -->
        <h4>Twitter Settings</h4>
        <div class="form-group">
            <label for="twitter_card">Twitter Card Type</label>
            <input type="text" class="form-control @error('twitter_card') is-invalid @enderror" id="twitter_card" name="twitter_card" value="{{ old('twitter_card', $seo->twitter_card) }}">
            @error('twitter_card')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="twitter_title">Twitter Title</label>
            <input type="text" class="form-control @error('twitter_title') is-invalid @enderror" id="twitter_title" name="twitter_title" value="{{ old('twitter_title', $seo->twitter_title) }}">
            @error('twitter_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="twitter_description">Twitter Description</label>
            <textarea class="form-control @error('twitter_description') is-invalid @enderror" id="twitter_description" name="twitter_description" rows="3">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
            @error('twitter_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="twitter_image">Twitter Image</label>
            @if($seo->twitter_image)
            <div>
                <img src="{{ asset('storage/' . $seo->twitter_image) }}" alt="Twitter Image" style="max-width: 200px;">
            </div>
            @endif
            <input type="file" class="form-control @error('twitter_image') is-invalid @enderror" id="twitter_image" name="twitter_image">
            @error('twitter_image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        <!-- Canonical URL -->
        <div class="form-group">
            <label for="canonical_url">Canonical URL</label>
            <input type="text" class="form-control @error('canonical_url') is-invalid @enderror" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $seo->canonical_url) }}">
            @error('canonical_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Structured Data (JSON-LD) -->
        <div class="form-group">
            <label for="structured_data">Structured Data (JSON-LD)</label>
            <textarea class="form-control @error('structured_data') is-invalid @enderror" id="structured_data" name="structured_data" rows="4" style="resize: vertical; min-height: 150px;" placeholder='Enter valid JSON'>{{ old('structured_data', is_array($seo->structured_data) ? json_encode($seo->structured_data, JSON_PRETTY_PRINT) : $seo->structured_data) }}</textarea>
            @error('structured_data')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">
                Example JSON-LD:
                <pre style="background: #f8f9fa; padding: 10px; border-radius: 5px;">
        {
          "@context": "https://schema.org",
          "@type": "BlogPosting",
          "headline": "Your Post Title Here",
          "description": "A short description of your blog post goes here.",
          "image": "https://example.com/path-to-your-featured-image.jpg",
          "author": {
            "@type": "Person",
            "name": "Author Name"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Website Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://example.com/path-to-your-logo.jpg"
            }
          },
          "datePublished": "2023-01-01T08:00:00+08:00",
          "dateModified": "2023-01-01T09:00:00+08:00",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://example.com/your-blog-post-url"
          }
        }
                </pre>
            </small>
        </div>



        <button type="submit" class="btn btn-primary mt-3">Update SEO Settings</button>
    </form>
</div>
@endsection

@push('custom_js')
<script>
    @include('admin.partials.sweet-alert')

</script>
@endpush
