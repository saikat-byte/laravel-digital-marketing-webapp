<!-- Title -->
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
           value="{{ old('title', isset($tag) ? $tag->title : '') }}" placeholder="Enter Title" />
    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Slug -->
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
           value="{{ old('slug', isset($tag) ? $tag->slug : '') }}" placeholder="Enter Slug" />
    @error('slug')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<!-- Status -->
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
        <option value="1" {{ old('status', isset($tag) ? $tag->status : 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', isset($tag) ? $tag->status : 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
