<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', isset($post) ? $post->title : '') }}" placeholder="Enter Title" />
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Slug -->
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', isset($post) ? $post->slug : '') }}" placeholder="Enter Slug" />
                @error('slug')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Quotation -->
            <div class="form-group">
                <label for="quote">Quotation</label>
                <input type="text" class="form-control @error('quote') is-invalid @enderror" id="quote" name="quote" value="{{ old('quote', isset($post) ? $post->quote : '') }}" placeholder="Enter Quotation" />
                @error('quote')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="img-div">
                    <p class="text-muted">Image size: 1000 X 600</p>
                    @if (isset($post))
                    <img class="img-thumbnail" id="image-preview" src="{{ asset('assets/image/postimage/thumbnail/'.pathinfo($post->post_image, PATHINFO_FILENAME).'_thumb'.'.'.pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->post_image }}">
                    @else
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/social_media_marketing.jpg') }}" alt="" class="img-thumbnail" id="image-preview">
                    @endif
                </div>
                <input type="file" class="form-control @error('post_image') is-invalid @enderror" name="post_image" id="post_image">
                @error('post_image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter Description">{{ old('description', isset($post) ? $post->description : '') }}</textarea>
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
    </div>
</div>


{{-- Category and subcategory --}}
<div class="card">
    <div class="row">
        <div class="col-lg-6">
            <!-- Select category -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">Select a Category</option>
                    @foreach($categories as $id => $title)
                    <option value="{{ $id }}" {{ old('category_id', $post->category_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $title }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Select sub category -->
            <div class="form-group">
                <label for="sub_category_id">Sub Category</label>
                <select class="form-select @error('sub_category_id') is-invalid @enderror" id="sub_category_id" name="sub_category_id">
                    <option value="">Select a Sub Category</option>
                    @foreach($subCategories as $id => $title)
                    <option value="{{ $id }}" {{ old('sub_category_id', isset($post) ? $post->sub_category_id : '') == $id ? 'selected' : '' }}>
                        {{ $title }}
                    </option>
                    @endforeach
                </select>
                @error('sub_category_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>

{{-- Status and tags--}}
<div class="card">
    <div class="row">
        <div class="col-lg-6">
            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="1" {{ old('status', isset($post) ? $post->status : 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', isset($post) ? $post->status : 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tags">Tags</label>
                <div class="checkbox-group border">
                    <div class="row">
                        @foreach($tags as $tag)
                        <div class="col-lg-4">
                            <div class="form-check d-flex justify-content-start">
                                <input type="checkbox" id="tag_{{ $tag->id }}" name="tag_ids[]" value="{{ $tag->id }}" class="form-check-input @error('tags') is-invalid @enderror" {{ in_array($tag->id, old('tag_ids', isset($post) ? $post->tags->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                <label for="tag_{{ $tag->id }}" class="form-check-label">{{ $tag->title }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @error('tags')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


        </div>
    </div>
</div>


@push('custom_css')
<style>
    .ck.ck-editor__main>.ck-editor__editable {
        min-height: 250px;
    }

</style>
@endpush

@push('custom_js')
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            console.log('CKEditor initialized successfully');
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });


    // Subcategory select by category
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var categoryId = $(this).val();

            $('#sub_category_id').html('<option value="">Loading...</option>'); // loading....

            if (categoryId) {
                $.ajax({
                    url: '/admin/get-subcategories/' + categoryId
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        $('#sub_category_id').html('<option value="">Select a Sub Category</option>'); // Subcategory dropdown reset
                        $.each(data, function(index, subCategory) {
                            $('#sub_category_id').append('<option value="' + subCategory.id + '">' + subCategory.title + '</option>'); // JSON object property access
                        });
                    }
                    , error: function(xhr, status, error) {
                        $('#sub_category_id').html('<option value="">Error loading subcategories</option>');
                    }
                });
            } else {
                $('#sub_category_id').html('<option value="">Select a Sub Category</option>'); //  If not selected
            }
        });
    });


    // Image select and preview
    $(document).ready(function() {
        $('#post_image').on('change', function(event) {
            var file = event.target.files[0]; // file select
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result); // preview update
                }
                reader.readAsDataURL(file);
            }
        });
    });

</script>
@endpush
