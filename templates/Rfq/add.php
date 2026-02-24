<?php
$uom_option_html = '';
$categories_option_html = '';

foreach ($uoms as $key => $uom) {
    $uom_option_html .= '<option value = "' . $key . '">' . $uom . '</option>';
}

foreach ($categories as $key => $category_name) {
    $categories_option_html .= "<option value = '$key'>$category_name</option>";
}
?>
<style>
    .btn-sm {
        padding: .25rem .7rem !important;
        font-size: .875rem !important;
        line-height: 1.5 !important;
        border-radius: .2rem !important;
        border: solid !important;
        border-width: thin !important;
    }

    .btn-outline-primary {
        color: #606060 !important;
        border-color: #004985 !important;
        background-color: #fff !important;
    }

    .btn-outline-primary:hover {
        color: #f1f1f1 !important;
        border-color: #004985 !important;
        background-color: #14499f !important;
    }

    label {
        font-size: 14px;
        color: #333;
    }

    .text-danger {
        font-size: 16px;
    }

    .input-field {
        height: 40px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1.05rem;
        color: #495057;
        padding-left: 15px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .shadow-sm {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08) !important;
    }

    .custom-label {
        font-size: 1.0rem !important;
    }

    .text-primary {
        color: #004985 !important;
    }

    hr {
        border: solid;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        /* border: 0; */
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .select2-container--default .select2-selection--multiple {
        height: 50px !important;
        overflow-y: hidden;
        display: flex;
        align-items: center;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06) !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto;
        padding: 0 10px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        height: 30px;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .select2-selection__rendered::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="container-fluid bg-white p-2 shadow-sm rounded">
    <div class="row align-items-center">
        <div class="col-md-5">
            <h5 class="text-primary font-weight-bold mb-0">Create RFQ</h5>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" class="form-control drgpicker" id="quotation_deadline" placeholder="Select Quotation Deadline">
                <div class="input-group-append">
                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-sm btn-outline-primary px-4 mr-2" id="add_product_btn">Add Product</button>
            <button class="btn btn-sm btn-outline-primary px-4 mr-2" id="save_as_draft_btn">Save as Draft</button>
            <button class="btn btn-sm btn-outline-primary px-4" id="published_rfq_btn">Publish RFQ</button>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12 mb-0">
            <form action="<?= $this->Url->build(['controller' => 'rfq', 'action' => 'add']) ?>" method="post" enctype="multipart/form-data" id="add_rfq_form">
                <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
                <input type="hidden" name="rfq_status" id="rfq_status">
                <input type="hidden" name="quotation_deadline" id="hidden_quotation_deadline">
                <div class="accordion w-100" id="accordion1">
                    <div class="card shadow custom-card-shadow">
                        <div class="card-header" id="heading1">
                            <button type="button" class="btn btn-link w-100 text-start d-flex align-items-center justify-content-between collapsed"
                                data-toggle="collapse"
                                data-target="#collapse1"
                                aria-expanded="false"
                                aria-controls="collapse1">
                                <strong>Product Details #1</strong>
                                <div class="action-icons d-flex align-items-center">
                                    <i class="fe fe-trash-2 text-danger mr-3 cursor-pointer d-none"></i>
                                    <i class="fe fe-chevron-down accordion-icon"></i>
                                </div>
                            </button>

                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="font-weight-bold custom-label" for="0-category_id">Category<span class="text-danger">*</span></label>
                                        <select name="items[0][category_id]" id="0-category_id" class="form-control input-field shadow-sm dropdown1" data-id="0" required>
                                            <option>Select Category</option>
                                            <?= $categories_option_html ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="font-weight-bold mb-2 custom-label" for="0-material_code">
                                            Material Code<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="items[0][material_code]" id="0-material_code" class="form-control input-field shadow-sm" placeholder="Enter Material Code Here" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="font-weight-bold mb-2 custom-label" for="0-seller">
                                            Supplier<span class="text-danger">*</span>
                                        </label>

                                        <select name="items[0][seller][]" id="0-seller" class="form-control input-field shadow-sm seller-dropdown" id="0-seller" required>

                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="0-model" class="font-weight-bold mb-2 custom-label">
                                            Model<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="items[0][model]" id="0-model" class="form-control input-field shadow-sm" placeholder="Enter Model Here" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-part_name" class="font-weight-bold mb-2 custom-label">
                                            Part Name<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="items[0][part_name]" id="0-part_name" class="form-control input-field shadow-sm" placeholder="Enter Part Name Here" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-make" class="font-weight-bold mb-2 custom-label">
                                            Make<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="items[0][make]" id="0-make" class="form-control input-field shadow-sm" placeholder="Enter Make Here" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="0-qty" class="font-weight-bold mb-2 custom-label">
                                            Quantity<span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="items[0][qty]" id="0-qty" class="form-control input-field shadow-sm" placeholder="Enter Quantity Here" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-uom_id" class="font-weight-bold mb-2 custom-label">
                                            UOM<span class="text-danger">*</span>
                                        </label>
                                        <select name="items[0][uom_id]" id="0-uom_id" class="form-control  input-field shadow-sm" required>
                                            <option selected disabled>Select UOM</option>
                                            <?= $uom_option_html ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-delivery_date" class="font-weight-bold mb-2 custom-label">
                                            Delivery Date<span class="text-danger">*</span>
                                        </label>
                                        <input type="date" name="items[0][delivery_date]" id="0-delivery_date" class="form-control input-field shadow-sm" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="0-specification" class="font-weight-bold mb-2 custom-label">
                                            Specification<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="items[0][specification]" id="0-specification" class="form-control input-field shadow-sm" placeholder="Enter Specifications Here" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-files" class="font-weight-bold mb-2 custom-label">
                                            Specification Attachment <small class="text-danger">(MAX 2 MB)</small>
                                        </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="0-files" id="0-file-label">
                                                    <i class="fas fa-upload text-primary mr-2"></i>
                                                    Upload Files
                                                </label>
                                                <input type="file" name="items[0][files][]" id="0-files" accept="image/*" class="custom-file-input" data-id='0'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="0-remarks" class="font-weight-bold mb-2 custom-label">
                                            Remark<span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control input-field shadow-sm" name="items[0][remarks]" id="0-remarks" rows="1" placeholder="Enter Remarks Here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    let uom_option_html = '<?= $uom_option_html ?>';
    let categories_option_html = "<?= $categories_option_html ?>";
    let get_vendor_by_cateogry_url = "<?= $this->Url->build(['controller' => 'rfq', 'action' => 'getVendorByCategory']); ?>"
</script>
<?= $this->Html->script("portal/rfq_details_add.js") ?>