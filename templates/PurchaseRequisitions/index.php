<style>
    #purchase_requisitions_table thead th {
        font-size: 0.75rem;
        padding: 0.25rem;
        background-color: #004a80;
        color: white;
        border: none;
        white-space: nowrap;
        vertical-align: middle;
    }

    #purchase_requisitions_table tbody td {
        font-size: 0.75rem;
        padding: 0.25rem !important;
    }
</style>
<div class="container-fluid mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Purchase Requisition Items</h4>
        <button class="btn btn-primary" id="createRfqBtn" disabled>
            Create RFQ from Selected Items
        </button>
    </div>

    <!-- PR Items Table -->
    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="purchase_requisitions_table">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:40px;">
                                <input type="checkbox" id="selectAll" style="cursor:pointer">
                            </th>
                            <th>PR No</th>
                            <th>PR Type</th>
                            <th>Item No</th>
                            <th>Material Code</th>
                            <th>Material Description</th>
                            <th class="text-right">Quantity</th>
                            <th>UOM</th>
                            <th>Plant</th>
                            <th>requested_by</th>
                            <th>created_by</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Load via Datatables -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Confirm RFQ Creation Modal -->
<div class="modal" tabindex="-1" id="confirm_rfq_creation_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">RFQ Creation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id = 'modal_body_p_tag_1'></p>
                <p>Are you sure you want to proceed with RFQ Creation ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirm_rfq_yes_btn">Yes, Continue</button>
            </div>
        </div>
    </div>
</div>

<script>
    let get_pr_list_url = "<?= $this->Url->build(['controller' => 'purchase-requisitions', 'action' => 'index']) ?>";
    let create_rfq_from_pr_url = "<?= $this->Url->build(['controller' => 'purchase-requisitions' , 'action' => 'create-rfq-from-pr']) ?>";
</script>

<?= $this->Html->script('portal/purchase_requisitions_index.js?time='.time()) ?>