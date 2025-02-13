$(document).ready(function () {

    // ----- Slug Auto-Generation for Section Name -----
    $("#sectionName").on("keyup", function () {
        var name = $(this).val();
        var slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        $("#sectionSlug").val(slug);
    });

    // ----- Single Image Preview with Remove Button -----
    $("#singleImageUpload").on("change", function (event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#singleImagePreview").html(`
                    <div class="position-relative d-inline-block">
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width:200px;">
                        <button type="button" id="removeNewImage" class="btn btn-danger btn-sm position-absolute" style="top: 0; right: 0;">X</button>
                    </div>
                `);
                $("#remove_image").val("0");
            }
            reader.readAsDataURL(file);
        }
    });
    $(document).on("click", "#removeNewImage", function () {
        $("#singleImageUpload").val("");
        $("#singleImagePreview").empty();
    });
    // For update form: remove existing image
    $(document).on("click", "#removeExistingImage", function () {
        $("#remove_image").val("1");
        $("#singleImagePreview").empty();
    });

    // ----- Multi-Image Preview with Remove Option -----
    let selectedImages = []; // To track new selected files
    $('input[name="multi_image[]"]').on("change", function (event) {
        let previewContainer = $("#multi-image-preview");
        // previewContainer.empty();
        selectedImages = [];
        $.each(event.target.files, function (index, file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let imgContainer = $('<div>').addClass('position-relative d-inline-block m-1 multi-image-item');
                let img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css({ width: "100px" });
                let removeBtn = $('<button>')
                    .text('X')
                    .addClass('btn btn-danger btn-sm position-absolute')
                    .css({ top: "5px", right: "5px", padding: "2px 5px", fontSize: "12px", borderRadius: "50%" })
                    .attr('data-index', index);
                removeBtn.on('click', function () {
                    let removeIndex = $(this).data('index');
                    selectedImages.splice(removeIndex, 1);
                    imgContainer.remove();
                    updateMultiFileInput();
                });
                imgContainer.append(img).append(removeBtn);
                previewContainer.append(imgContainer);
                selectedImages.push(file);
            }
            reader.readAsDataURL(file);
        });
        function updateMultiFileInput() {
            let newFileList = new DataTransfer();
            selectedImages.forEach(file => {
                newFileList.items.add(file);
            });
            $('input[name="multi_image[]"]')[0].files = newFileList.files;
        }
    });

    // Remove existing multi image preview (for already stored images)
    $(document).on("click", ".remove-multi-image", function () {
        var imagePath = $(this).data("image");
        $(this).closest(".multi-image-item").remove();
        $("#removed-multi-images-container").append(
            '<input type="hidden" name="removed_multi_images[]" value="' + imagePath + '">'
        );
    });

    // ----- Video Preview with Remove Button -----
    $('input[name="video"]').on("change", function (event) {
        let file = event.target.files[0];
        if (file) {
            let videoUrl = URL.createObjectURL(file);
            $("#video-container").html(`
                <div class="position-relative d-inline-block mt-2">
                    <video controls style="max-width: 300px;">
                        <source src="${videoUrl}" type="${file.type}">
                        Your browser does not support the video tag.
                    </video>
                    <button type="button" id="remove-video" class="btn btn-danger btn-sm position-absolute"
                        style="top:5px; right:5px; padding:2px 5px; font-size:12px; border-radius:50%; z-index:9999;">X</button>
                </div>
            `);
            // Reset the hidden remove_video field to "0" (i.e. no removal)
            $("#remove_video").val("0");
        }
    });

    // Remove newly selected video preview
    $(document).on("click", "#remove-video", function () {
        $('input[name="video"]').val("");
        $("#video-container").empty();
    });

    // For update form: Remove existing video preview
    $(document).on("click", "#removeExistingVideo", function () {
        // Set hidden input to "1" so backend knows to remove the existing video
        $("#remove_video").val("1");
        $("#video-container").empty();
    });

    // ----- Add More Custom Fields Dynamically -----
    let fieldIndex = 1;
    $("#add-more-fields").on("click", function () {
        let optionsHtml = $("#customFieldOptions").html();
        let newFieldHtml = `
            <div class="d-flex mb-2">
                <input type="text" class="form-control" name="custom_fields[${fieldIndex}][name]" placeholder="Enter Field Name">
                <select name="custom_fields[${fieldIndex}][type]" class="form-control ml-2">
                    ${optionsHtml}
                </select>
                <input type="text" class="form-control ml-2" name="custom_fields[${fieldIndex}][value]" placeholder="Field Value">
                <button type="button" class="btn btn-danger btn-sm remove-field ml-2">Remove</button>
            </div>
        `;
        $("#custom-fields-container").append(newFieldHtml);
        fieldIndex++;
    });
    $(document).on("click", ".remove-field", function () {
        $(this).closest(".d-flex").remove();
    });

    // ----- Form Submission via AJAX -----
    $("#updateSectionForm, #sectionForm").on("submit", function (e) {
        e.preventDefault();

        // Do not append any extra fields here!
        let formData = new FormData(this);

        // For update form, ensure _method is set to PUT if not already present
        if (!formData.has('_method') && $(this).attr('id') === 'updateSectionForm') {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: $(this).attr("action"),
            method: "POST", // _method hidden input will indicate PUT for update
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(".text-danger").text("");
                $(".is-invalid").removeClass("is-invalid");
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: response.message
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "";
                    $.each(errors, function (key, messages) {
                        errorMessage += messages[0] + "\n";
                    });
                    Swal.fire({
                        icon: "error",
                        title: "Validation Error!",
                        text: errorMessage
                    });
                } else {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Something Went Wrong!",
                        text: xhr.statusText
                    });
                }
            }
        });
    });


});
