<!-- Title -->
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
           value="{{ old('title', isset($category) ? $category->title : '') }}" placeholder="Enter Title" />
    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Slug -->
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
           value="{{ old('slug', isset($category) ? $category->slug : '') }}" placeholder="Enter Slug" />
    @error('slug')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Description -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
              rows="4" placeholder="Enter Description">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
    @error('description')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Status -->
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
        <option value="1" {{ old('status', isset($category) ? $category->status : 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', isset($category) ? $category->status : 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
