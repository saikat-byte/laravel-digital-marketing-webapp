<!-- Title -->
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', isset($sub_category) ? $sub_category->title : '') }}" placeholder="Enter Title" />
    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Slug -->
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', isset($sub_category) ? $sub_category->slug : '') }}" placeholder="Enter Slug" />
    @error('slug')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Select category -->
<div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
        <option value="">Select a Category</option>
        @foreach($categories as $id => $title)
        <option value="{{ $id }}" {{ old('category_id', isset($sub_category) ? $sub_category->category_id : '') == $id ? 'selected' : '' }}>
            {{ $title }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



<!-- Status -->
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
        <option value="1" {{ old('status', isset($sub_category) ? $sub_category->status : 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', isset($sub_category) ? $sub_category->status : 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
