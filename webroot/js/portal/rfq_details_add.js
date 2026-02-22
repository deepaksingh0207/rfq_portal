var seller_select2_options = {
    placeholder: 'Select Supplier',
    multiple:true,
};

$(document).ready(function () {

    $('.seller-dropdown').select2(seller_select2_options);

    let productCount = $(".custom-card-shadow").length;

    $(document).on("click", "#add_product_btn", function () {
        productCount++;

        let productHtml = `
        <div class="card border-0 custom-card-shadow mb-4" id="card_${productCount}">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-2 border-bottom-0 shadow-sm">
                <span class="font-weight-bold">Product Details #${productCount}</span>
                <div class="col-md-10"></div>
                <div class="action-icons d-flex align-items-center">
                    <i class="far fa-trash-alt text-danger mr-3 cursor-pointer remove-product"></i>
                    <button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#product_details_${productCount}">
                        <i class="fas fa-chevron-down text-dark"></i>
                    </button>
                </div>
            </div>

            <div class="collapse show" id="product_details_${productCount}">
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold custom-label" for="${productCount}-product_id">Category<span class="text-danger">*</span></label>
                            <select name = "${productCount}[product_id]" id="${productCount}-product_id" class="form-control input-field shadow-sm dropdown1" data-id = "${productCount}" required>
                                <option>Select Category</option>
                                ${categories_option_html}
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold mb-2 custom-label" for="${productCount}-material_code">
                                Material Code<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="${productCount}[material_code]" id="${productCount}-material_code" class="form-control input-field shadow-sm" placeholder="Enter Material Code Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold mb-2 custom-label" for="${productCount}-seller">
                                Supplier<span class="text-danger">*</span>
                            </label>
                            
                            <select name="${productCount}[seller][]" id="${productCount}-seller" class="form-control input-field shadow-sm seller-dropdown" id="${productCount}-seller" required>
                                
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-model" class="font-weight-bold mb-2 custom-label">
                                Model<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="${productCount}[model]" id="${productCount}-model" class="form-control input-field shadow-sm" placeholder="Enter Model Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-part_name" class="font-weight-bold mb-2 custom-label">
                                Part Name<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="${productCount}[part_name]" id="${productCount}-part_name" class="form-control input-field shadow-sm" placeholder="Enter Part Name Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-make" class="font-weight-bold mb-2 custom-label">
                                Make<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="${productCount}[make]" id="${productCount}-make" class="form-control input-field shadow-sm" placeholder="Enter Make Here" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-qty" class="font-weight-bold mb-2 custom-label">
                                Quantity<span class="text-danger">*</span>
                            </label>
                            <input type="number" name="${productCount}[qty]" id="${productCount}-qty" class="form-control input-field shadow-sm" placeholder="Enter Quantity Here" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-uom_id" class="font-weight-bold mb-2 custom-label">
                                UOM<span class="text-danger">*</span>
                            </label>
                            <select name="${productCount}[uom_id]" id="${productCount}-uom_id" class="form-control  input-field shadow-sm" required>
                                <option selected disabled>Select UOM</option>
                                ${uom_option_html}
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-delivery_date" class="font-weight-bold mb-2 custom-label">
                                Delivery Date<span class="text-danger">*</span>
                            </label>
                            <input type="date" name="${productCount}[delivery_date]" id="${productCount}-delivery_date" class="form-control input-field shadow-sm" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="${productCount}-specification" class="font-weight-bold mb-2 custom-label">
                                Specification<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="${productCount}[specification]" id="${productCount}-specification" class="form-control input-field shadow-sm" placeholder="Enter Specifications Here">
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
                                <input type="file" name="${productCount}[files][]" id="${productCount}-files" class="custom-file-input" data-id = "${productCount}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="${productCount}-remarks" class="font-weight-bold mb-2 custom-label">
                                Remark<span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control input-field shadow-sm" name="${productCount}[remarks]" id="${productCount}-remarks" rows="1" placeholder="Enter Remarks Here"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

        $("#product_container").append(productHtml);
        $(`#${productCount}-seller`).select2(seller_select2_options);
    });

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
    const form = document.getElementById('add_rfq_form');

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
