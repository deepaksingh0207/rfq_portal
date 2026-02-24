var seller_select2_options = {
    placeholder: "Select Supplier",
    multiple: true,
    theme: "bootstrap4",
};

$(document).ready(function () {

    $(".seller-dropdown").select2(seller_select2_options);

    $(".dropdown1").each(function() {
        if ($(this).val()) {
            console.log("Category Selected Value is - " , $(this).val());
            var value = $(this).val();
            var id = $(this).data("id");
            let rfq_footer_id = $(this).data('rfq-footer-id');
            console.log({ id, value ,rfq_footer_id });
            getSupplierList(id, value , rfq_footer_id);
        }
    });

    $(".drgpicker").daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: "YYYY-MM-DD",
        },
    });

    $('.drgpicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('.drgpicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    let productCount = $(".custom-card-shadow").length;

    $(document).on("click", "#add_product_btn", function () {
        productCount++;

        let productHtml = `
        <div class="card shadow custom-card-shadow">
            <div class="card-header" id="heading1">
                <button type="button" class="btn btn-link w-100 text-start d-flex align-items-center justify-content-between collapsed"
                    data-toggle="collapse"
                    data-target="#collapse${productCount}"
                    aria-expanded="false"
                    aria-controls="collapse${productCount}">
                    <strong>Product Details #${productCount}</strong>
                    <div class="action-icons d-flex align-items-center">
                        <i class="fe fe-trash-2 text-danger mr-3 cursor-pointer remove-product"></i>
                        <i class="fe fe-chevron-down accordion-icon"></i>
                    </div>
                </button>
                
            </div>
            <div id="collapse${productCount}" class="collapse show" aria-labelledby="heading1" data-parent="#accordion1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold custom-label" for="${productCount}-category_id">Category<span class="text-danger">*</span></label>
                            <select name="items[${[productCount]}][category_id]" id="${productCount}-category_id" class="form-control input-field shadow-sm dropdown1" data-id="0" required>
                                <option>Select Category</option>
                                <?= $categories_option_html ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold mb-2 custom-label" for="${productCount}-material_code">
                                Material Code<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="items[${[productCount]}][material_code]" id="${productCount}-material_code" class="form-control input-field shadow-sm" placeholder="Enter Material Code Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold mb-2 custom-label" for="${productCount}-seller">
                                Supplier<span class="text-danger">*</span>
                            </label>

                            <select name="items[${[productCount]}][seller][]" id="${productCount}-seller" class="form-control input-field shadow-sm seller-dropdown" id="${productCount}-seller" required>

                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-model" class="font-weight-bold mb-2 custom-label">
                                Model<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="items[${[productCount]}][model]" id="${productCount}-model" class="form-control input-field shadow-sm" placeholder="Enter Model Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-part_name" class="font-weight-bold mb-2 custom-label">
                                Part Name<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="items[${[productCount]}][part_name]" id="${productCount}-part_name" class="form-control input-field shadow-sm" placeholder="Enter Part Name Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-make" class="font-weight-bold mb-2 custom-label">
                                Make<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="items[${[productCount]}][make]" id="${productCount}-make" class="form-control input-field shadow-sm" placeholder="Enter Make Here" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-qty" class="font-weight-bold mb-2 custom-label">
                                Quantity<span class="text-danger">*</span>
                            </label>
                            <input type="number" name="items[${[productCount]}][qty]" id="${productCount}-qty" class="form-control input-field shadow-sm" placeholder="Enter Quantity Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-uom_id" class="font-weight-bold mb-2 custom-label">
                                UOM<span class="text-danger">*</span>
                            </label>
                            <select name="items[${[productCount]}][uom_id]" id="${productCount}-uom_id" class="form-control  input-field shadow-sm" required>
                                <option selected disabled>Select UOM</option>
                                <?= $uom_option_html ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-delivery_date" class="font-weight-bold mb-2 custom-label">
                                Delivery Date<span class="text-danger">*</span>
                            </label>
                            <input type="date" name="items[${[productCount]}][delivery_date]" id="${productCount}-delivery_date" class="form-control input-field shadow-sm" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-specification" class="font-weight-bold mb-2 custom-label">
                                Specification<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="items[${[productCount]}][specification]" id="${productCount}-specification" class="form-control input-field shadow-sm" placeholder="Enter Specifications Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-files" class="font-weight-bold mb-2 custom-label">
                                Specification Attachment <small class="text-danger">(MAX 2 MB)</small>
                            </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="${productCount}-files" id="${productCount}-file-label">
                                        <i class="fas fa-upload text-primary mr-2"></i>
                                        Upload Files
                                    </label>
                                    <input type="file" name="items[${[productCount]}][files][]" id="${productCount}-files" accept="image/*" class="custom-file-input" data-id='0'>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-remarks" class="font-weight-bold mb-2 custom-label">
                                Remark<span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control input-field shadow-sm" name="items[${[productCount]}][remarks]" id="${productCount}-remarks" rows="1" placeholder="Enter Remarks Here"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

        $("#accordion1").append(productHtml);
        $(`#${productCount}-seller`).select2(seller_select2_options);
    });

    $(document).on("click", ".remove-product", function () {
        $(this).closest(".custom-card-shadow").remove();
    });

    $(document).on("change", ".dropdown1", function () {
        var value = $(this).val();
        var id = $(this).data("id");
        
        let rfq_footer_id = $(this).data('rfq-footer-id');
        console.log({ id, value ,rfq_footer_id });
        getSupplierList(id, value , rfq_footer_id);
    });

    $(document).on("change", ".custom-file-input", function () {
        let data_id = $(this).data("id");
        let fileName = $(this).val().split("\\").pop();
        $(`#${data_id}-file-label`).html(
            '<i class="fas fa-upload text-primary mr-2"></i>' + fileName,
        );
    });

    $(document).on("click", "#save_as_draft_btn", function () {
        submitAddRfqForm("DRAFT");
    });

    $(document).on("click", "#published_rfq_btn", function () {
        submitAddRfqForm("PUBLISHED");
    });
});

function submitAddRfqForm(status) {
    let quotation_deadline = $('#quotation_deadline').val();
    if(quotation_deadline == "" || quotation_deadline == null || quotation_deadline == undefined) {
        toastr.error("Please Select Quotation Deadline");
        return;
    }

    $('#hidden_quotation_deadline').val(quotation_deadline);

    $("#rfq_status").val(status);
    const form = document.getElementById("add_rfq_form");

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    form.submit();
}

function getSupplierList(rowId, category , rfq_footer_id) {
    // if select2 multiple, it may send an array → convert to CSV
    if (Array.isArray(category)) {
        category = category.join(",");
    }

    const dropdown = $("#" + rowId + "-seller");

    dropdown.empty(); // clear existing
    dropdown.append(`<option value="">Loading...</option>`);

    $.ajax({
        type: "GET",
        url: get_vendor_by_cateogry_url + "/" + category + "/" + rfq_footer_id,
        dataType: "json",
        beforeSend: function () {
            $(".seller-dropdown").select2("destroy");
        },
        success: function (res) {
            dropdown.empty(); // clear loading text

            if (!res.data || res.data.length === 0) {
                dropdown.append(`<option value="">No suppliers found</option>`);
                return;
            }

            // <<--- Add loop here
            $.each(res.data, function (index, item) {
                console.log({item});
                let selected = '';
                if(res.selected_vendor_user_ids.includes(item.id)) {
                    selected = 'selected';
                }
                dropdown.append(
                    '<option value="' + item.id + '" '+selected+'>' + item.name + "</option>",
                );
            });

            // dropdown.trigger("change"); // refresh select2 if enabled
        },
        complete: function () {
            seller_select2_options.width = "100%";
            $(".seller-dropdown").select2(seller_select2_options);
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
