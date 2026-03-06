<style>
    .container-fluid {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Header Styles */
    .page-header {
        margin-bottom: 5px;
    }

    .page-header h2 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 0;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 5px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-group label {
        font-weight: 500;
        color: #6c757d;
        margin-bottom: 0;
    }

    .filter-select,
    .filter-search {
        padding: 8px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        min-width: 200px;
    }

    .filter-search {
        min-width: 300px;
    }

    /* Table Section */
    .table-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 5px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #007bff;
    }

    .table thead th {
        background-color: #004a80;
        color: white;
        font-size: 0.75rem!important;
        padding: 0.25rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody td {
        font-size: 0.75rem!important;
        padding: 0.25rem!important;
    }

    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

<?php 
    $session = $this->getRequest()->getSession();
    $session_user_id = $session->read('Auth.user.id');
?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h5>RFQ Approval Dashboard</h5>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <!-- <div class="filter-group">
            <label>Filter by Authorization:</label>
            <select class="filter-select">
                <option>All Categories</option>
                <option>RM (Customer Controlled)</option>
                <option>SPN</option>
                <option>Raw Materials</option>
            </select>
        </div> -->
        <div class="filter-group">
            <i class="fas fa-search text-muted"></i>
            <input type="text" class="filter-search" placeholder="Search by RFQ No., Product, or Part...">
        </div>
        <div class="ml-auto">
            <span class="text-muted mr-2">Show:</span>
            <select class="filter-select" style="min-width: auto; width: 80px;">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span class="text-muted ml-2">entries</span>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section table-responsive">
        <table class="table table-bordered table-hover" id="rfq_for_approval_list_table">
            <thead>
                <tr>
                    <th>RFQ No.</th>
                    <th>Category</th>
                    <th>Material</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Approval Stage</th>
                    <th>Expected Delivery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- load via datatables -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="rfqCommentModal" tabindex="-1" aria-labelledby="rfqCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="rfqCommentModalLabel">
                    RFQ #260113001
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- body -->
            <div class="modal-body">
                <input type="hidden" name="" id="hidden_rfq_quote_revision_id" value="">
                <input type="hidden" name="" id="hidden_rfq_selected_quote_id" value="">
                <!-- compact top row: rfq, part, status, delivery, rate -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <div>
                        <span class="font-weight-bold mr-3" id="rfq_modal_item_no">260113001</span>
                        <span class="mr-3" id="rfq_modal_rfq_category">RM - NUTS</span>
                        <!-- <span class="badge badge-pill badge-warning text-dark px-3 py-1" style="background:#fff3cd;" id="rfq_modal_rfq_status">UNDER_APPROVAL</span> -->
                    </div>
                    <div class="mt-2 mt-sm-0">
                        <span class="text-secondary mr-2" id="rfq_modal_delivery_date">Delivery: 1/24/26</span>
                    </div>
                </div>

                <!-- data card: qty, selected rate, delivery, status (explicit) -->
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Material</small>
                                <span class="font-weight-medium" id="rfq_modal_material">150 EA</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Make</small>
                                <span class="font-weight-medium" id="rfq_modal_make">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Model</small>
                                <span class="font-weight-medium" id="rfq_modal_model">1/24/26</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Specifications</small>
                                <span class="font-weight-medium" id="rfq_modal_specification">UNDER_APPROVAL</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Qty</small>
                                <span class="font-weight-medium" id="rfq_modal_quantity">150 EA</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Rate</small>
                                <span class="font-weight-medium" id="rfq_modal_unit_price">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Sub Total</small>
                                <span class="font-weight-medium" id="rfq_modal_sub_total">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Discount</small>
                                <span class="font-weight-medium" id="rfq_modal_discount">100.00</span>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Freight</small>
                                <span class="font-weight-medium" id="rfq_modal_freight">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Tax</small>
                                <span class="font-weight-medium" id="rfq_modal_tax">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Instalaltion</small>
                                <span class="font-weight-medium" id="rfq_modal_installation">100.00</span>
                            </div>
                            <div class="col-md-3 col-6 mb-2 mb-md-0">
                                <small class="text-uppercase text-muted d-block">Total Amount</small>
                                <span class="font-weight-medium" id="rfq_modal_total_amount">1/24/26</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="text-secondary border-bottom pb-2 mb-3"><i class="fas fa-check-circle mr-2"></i>Approval flow</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Approver Name</th>
                                <th>Approver Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="rfq_modal_approver_table_body">
                            <tr>
                                <td>Approver 1</td>
                                <td>approver1@jbmgroup.com</td>
                                <td>
                                    <span class="badge badge-warning px-3 py-1">pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Approver 2</td>
                                <td>approver2@jbmgroup.com</td>
                                <td>
                                    <span class="badge badge-warning px-3 py-1">pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="comment-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white text-muted"><i class="fe fe-mail"></i></span>
                                </div>
                                <textarea class="form-control" id="rfq_modal_approver_remark" placeholder="Add Remarks Here"></textarea>
                            </div>
                        </div>

                        <!-- accept/reject buttons -->
                        <div class="col-md-12 d-flex align-items-center justify-content-end mt-2">
                            <span class="mr-3 font-weight-bold">Action :</span>
                            <button class="btn btn-outline-success btn-sm mr-2 px-4" id="accept_quote_btn">Accept</button>
                            <button class="btn btn-outline-danger btn-sm px-4" id="reject_quote_btn">Reject</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <!-- footer with optional meta -->
            <div class="modal-footer d-flex justify-content-between">
                <span class="text-secondary"></span>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let rfq_for_approval_list_url = "<?= $this->Url->build(['controller' => 'rfq', 'action' => 'rfq-for-approval-list']) ?>";
    let get_data_for_rfq_modal_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'get-data-for-rfq-modal']) ?>";
    let update_quote_status_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'update-quote-status']) ?>";
    let session_user_id = "<?= $session_user_id ?>";
</script>

<?= $this->Html->script("portal/rfq_for_approval_list.js?time=".time()) ?>