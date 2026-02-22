var seller_select2_options = {
    placeholder: 'Select Supplier',
    multiple:true,
};

$(document).ready(function () {

    $('.seller-dropdown').select2(seller_select2_options);

    $(document).on("click", ".remove-product", function () {
        $(this).closest(".card").remove();
    });

    $(document).on("change", ".dropdown1", function () {
        var value = $(this).val();
        var id = $(this).data("id");
        console.log({id,value});
        getSupplierList(id, value);
    });

    $(document).on('change', '.custom-file-input' , function () {
        let data_id = $(this).data('id');
        let fileName = $(this).val().split('\\').pop();
        $(`#${data_id}-file-label`).html('<i class="fas fa-upload text-primary mr-2"></i>' + fileName);
    });

    $(document).on('click', '#save_as_draft_btn', function () {
        submitAddRfqForm("DRAFT");
    });

    $(document).on('click', '#published_rfq_btn', function () {
        submitAddRfqForm("PUBLISHED");
    });

});

function submitAddRfqForm(status) {
    $('#rfq_status').val(status);
    const form = document.getElementById('edit_rfq_form');

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    form.submit();
}

function getSupplierList(rowId, category) {
    // if select2 multiple, it may send an array → convert to CSV
    if (Array.isArray(category)) {
        category = category.join(",");
    }

    const dropdown = $("#" + rowId + "-seller");

    dropdown.empty(); // clear existing
    dropdown.append(`<option value="">Loading...</option>`);

    $.ajax({
        type: "GET",
        url: get_vendor_by_cateogry_url+"/"+category,
        dataType: "json",
        beforeSend : function() {
            $('.seller-dropdown').select2('destroy');
        },
        success: function (res) {
            dropdown.empty(); // clear loading text

            if (!res || res.length === 0) {
                dropdown.append(`<option value="">No suppliers found</option>`);
                return;
            }

            // <<--- Add loop here
            $.each(res, function (index, item) {
                dropdown.append(
                    '<option value="' +
                        item.id +
                        '">' +
                        item.name +
                        "</option>",
                );
            });

            // dropdown.trigger("change"); // refresh select2 if enabled
        },
        complete:function() {
            seller_select2_options.width = "100%";
            $('.seller-dropdown').select2(seller_select2_options);
        },
        error: function (xhr, status, error) {
            console.error("Supplier fetch error:", error);
            dropdown.empty();
            dropdown.append(
                `<option value="">Error loading suppliers</option>`,
            );
        },
    });
}
