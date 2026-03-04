$(document).ready(function () {
    $(document).on('change', '.quotes-checkbox' , function () {
        $('.quotes-checkbox').not(this).prop('checked' , false);
    });

    $(document).on('click', '#send_for_approval_btn' , function () {
        let rfq_quote_revision_id = $('.quotes-checkbox:checked').val();
        console.log({rfq_quote_revision_id});

        if(rfq_quote_revision_id == "" || rfq_quote_revision_id == undefined || rfq_quote_revision_id == null) {
            toastr.error("Please Select Quote For Submitting to Approval");
            return;
        }

        $.ajax({
            type: "POST",
            url: send_quote_for_approval_url,
            data: {rfq_quote_revision_id : rfq_quote_revision_id},
            dataType: "json",
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if(response.status) {
                    toastr.success(response.message);
                    $('.quotes-checkbox').attr('disabled' , true);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    });
});