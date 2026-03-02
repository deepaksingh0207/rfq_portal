$(document).ready(function () {
    // Initialize DataTable
    $("#responsesTable").DataTable({
        pageLength: 10,
        ordering: false,
        searching: true,
        lengthChange: false,
        info: true,
    });

    // Modal company name update
    $("#quotationModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var company = button.data("company");
        var modal = $(this);
        modal.find("#companyName").text(company);
    });

    $(document).on('change', "#quoteCheckboxSelectAll", function () {
        $(".quote-checkbox").prop('checked', $(this).prop('checked'));
    });

    $(document).on('click', '#compare_selected_quotes_btn' , function () {
        let rfq_quote_revisions_ids = [];
        $('.quote-checkbox').each(function (index, element) {
            // element == this
            rfq_quote_revisions_ids.push($(element).val());
        });

        console.log({rfq_quote_revisions_ids});
        // console.log(rfq_quote_revisions_ids.join(","));

        $('#rfq_quotes_revisions_ids').val(rfq_quote_revisions_ids.join(","));
        $('#showComparisonForm').submit();
    });
});
