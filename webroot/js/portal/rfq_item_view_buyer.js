$(document).ready(function () {
    // Initialize DataTable
    $("#responsesTable").DataTable({
        pageLength: 10,
        ordering: true,
        searching: true,
        lengthChange: false,
        info: true,
        columnDefs: [
            { orderable: false, targets: 0 },
            { orderable: false, targets: 10 },
        ],
    });

    // Select All checkbox functionality
    $("#selectAll").click(function () {
        $(".quote-checkbox").prop("checked", this.checked);
    });

    $(".quote-checkbox").click(function () {
        if (
            $(".quote-checkbox:checked").length == $(".quote-checkbox").length
        ) {
            $("#selectAll").prop("checked", true);
        } else {
            $("#selectAll").prop("checked", false);
        }
    });

    // Modal company name update
    $("#quotationModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var company = button.data("company");
        var modal = $(this);
        modal.find("#companyName").text(company);
    });
});
