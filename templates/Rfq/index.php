<?php
    $session = $this->getRequest()->getSession();
    $session_user_group = strtolower($session->read('Auth.user.group'));
?>

<style>
    .modal-dialog {
        max-width: 960px;
        margin: auto;
    }

    .modal-content {
        width: 100% !important;
    }

    .custom-modal-header {
        background-color: #004E88;
        color: white;
    }

    .custom-close-btn {
        color: white;
    }

    #chatContent {
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .chat-left {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 4px;
    }

    .chat-right {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 4px;
    }

    .chat-bubble {
        max-width: 70%;
        padding: 10px;
        border-radius: 18px;
        word-wrap: break-word;
        position: relative;
    }

    .chat-bubble.bg-primary {
        background-color: #007bff;
        color: white;
    }

    .chat-bubble.bg-light {
        background-color: #e9ecef;
        color: #000;
    }

    .chat-time {
        font-size: 0.75rem;
        text-align: right;
        margin-top: 4px;
        opacity: 0.7;
    }

    .chat-date-label {
        text-align: center;
        font-weight: bold;
        color: #666;
        margin: 15px 0 10px;
    }

    .table thead th {
        background-color: #004a80;
        color: white;
        border: none;
        white-space: nowrap;
        vertical-align: middle;
        font-size: 0.75rem!important;
        padding: 0.25rem!important;

    }

    .table tbody td {
        font-size: 0.75rem!important;
        padding: 0.25rem!important;
    }

    .search-bar {
        border-radius: 20px;
        background-color: #f1f3f4;
        border: none;
    }

    .btn-add-rfq {
        background-color: #004a80;
        color: white;
        font-weight: bold;
        border-radius: 8px;
    }

    .action-icons i {
        color: #6c757d;
        cursor: pointer;
        margin: 0 5px;
    }

    .action-icons i:hover {
        color: #004a80;
    }

    /* Status Colors */
    .status-draft {
        color: #28a745;
        font-weight: 500;
    }

    .status-approval {
        color: #fd7e14;
        font-weight: 500;
    }

    .status-closed {
        color: #6c757d;
        font-weight: 500;
    }

    .status-expired {
        color: #dc3545;
        font-weight: 500;
    }

    .status-published {
        color: #28a745;
        font-weight: 500;
    }

    .status-rejected {
        color: #dc3545;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="row mb-3 align-items-end">
        <div class="col-md-4">
            <label class="font-weight-bold">Search</label>
            <div class="input-group">
                <input type="text" class="form-control search-bar bg-white" placeholder="Search by RFQ NO, Material Code, Vendor" id="customSearchInput">
            </div>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold">Status</label>
            <select class="form-control custom-select" id="statusFilter">
                <option selected>All</option>
                <?php if(strtolower($session_user_group) == 'admin'): ?>
                <option value="DRAFT">DRAFT</option>
                <?php endif; ?>
                <option value="UNDER_APPROVAL">UNDER_APPROVAL</option>
                <option value="PUBLISHED">PUBLISHED</option>
                <option value="REJECTED">REJECTED</option>
                <option value="EXPIRED">EXPIRED</option>
                <option value="CLOSED">CLOSED</option>
            </select>
        </div>
        <?php if(in_array(strtolower($session_user_group) , ['admin' , 'buyer'])): ?>
        <div class="col-md-6 text-right">
            <a class="btn btn-add-rfq px-4 py-2" href="<?= $this->Url->build(['controller' => 'rfq', 'action' => 'add']) ?>">ADD RFQ</a>
        </div>
        <?php endif ?>
    </div>

    <div class="table-responsive shadow-sm bg-white">
        <table class="table table-bordered table-hover mb-0" id="rfq_list_table">
            <thead>
                <tr>
                    <th>RFQ NO.</th>
                    <th>RFQ Type</th>
                    <th>Status</th>
                    <th>Quotation Deadline</th>
                    <th>Created By</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="compareIndexModal" aria-labelledby="compareModalLabel" aria-hidden="true" style="padding-right: 400px!important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 960px!important;">
            <div class="modal-header">
                <h5 class="modal-title" id="compareModalLabel">Price Comparison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-content-wrapper">
                    <div class="main-table-container">
                        <div class="table-responsive">
                            <table class="comp_table table-responsive" style="width:100%; overflow-x:auto;"
                                border="1">
                                <thead id="modalHeader"
                                    style="background-color: #fff !important;color:black!important">
                                </thead>
                                <tbody id="modalTableBody">
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <textarea style="display:none" id="remark" name="myTextarea" rows="2" cols="163" placeholder="Add Remark"></textarea>
                        <br>
                        <input type="text" id="approval_name" name="approval_name" rows="2" placeholder="Enter Approval Name" style="display:none" value="<?= h($user->first_name . ' ' . $user->last_name); ?>" />
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" id="resumitQuote">Resubmit quot</button>
                            <button type="button" class="btn btn-secondary" id="submitForApproval" data-dismiss="modal">Submit for Approval</button>
                        </div>
                    </div>
                    <div class="vendor-details-wrapper">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="continueButton" class="continue_btn btn btn-secondary" disabled>Continue</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title">Chat</h5>
                <button type="button" class="close custom-close-btn" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="chatContent"></div>
            </div>
            <div class="input-group p-3">
                <input type="text" id="chatMessage" class="form-control" placeholder="Type your message...">
                <button id="sendChatBtn" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    let get_rfq_list_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'index']) ?>";
    let edit_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'edit']) ?>";
    let view_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'view']) ?>";
    let copy_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'copy']) ?>";
    let session_user_group = "<?= $session_user_group ?>";
</script>

<?= $this->Html->script('portal/rfq_index.js?time='.time()) ?>