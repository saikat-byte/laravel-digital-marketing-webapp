function handleDeleteButton(tableSelector, rowSelectorPrefix) {
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault();

        let id = $(this).data("id"); // Get the data-id
        let form = $(`#form_${id}`); // Get the form by ID
        let action = form.attr("action"); // Get form action URL

        Swal.fire({
            title: "Are you sure you want to delete?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX Request
                $.ajax({
                    url: action,
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success");

                        // Remove the row from the DataTable
                        if ($.fn.DataTable.isDataTable(tableSelector)) {
                            let table = $(tableSelector).DataTable();
                            table.row($(`${rowSelectorPrefix}${id}`)).remove().draw(false);
                        } else {
                            // If not a DataTable, remove the row manually
                            $(`${rowSelectorPrefix}${id}`).fadeOut(500, function () {
                                $(this).remove();
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "Failed to delete the item.", "error");
                    },
                });
            }
        });
    });
}
