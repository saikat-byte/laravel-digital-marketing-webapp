function initializeDataTables(options) {
    const defaultOptions = {
        pageLength: 10, // Default page length
    };

    // Merge custom options with default options
    const config = { ...defaultOptions, ...options };

    // Initialize basic DataTable
    if (config.basicSelector) {
        $(config.basicSelector).DataTable(config.basicOptions || {});
    }

    // Initialize multi-filter DataTable
    if (config.multiFilterSelector) {
        $(config.multiFilterSelector).DataTable({
            pageLength: config.pageLength,
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $('<select class="form-select"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column.data()
                            .unique()
                            .sort()
                            .each(function (d) {
                                select.append('<option value="' + d + '">' + d + "</option>");
                            });
                    });
            },
        });
    }

    // Initialize add-row DataTable
    if (config.addRowSelector) {
        var action = '<td><div class="form-button-action">' +
            '<button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task"><i class="fa fa-edit"></i></button>' +
            '<button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>' +
            "</div></td>";

        const addRowTable = $(config.addRowSelector).DataTable({ pageLength: config.pageLength });

        $(config.addRowButton).click(function () {
            addRowTable.row.add([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action,
            ]).draw(false);

            $(config.modalSelector).modal("hide");
        });
    }
}
