<style>
    .rfq-container {
        max-width: 1400px;
        margin: 2px auto;
        padding: 0 10px;
    }

    .rfq-header {
        background: #004a80;
        color: white;
        padding: 2px 15px;
        border-radius: 15px 15px 0 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rfq-content {
        background: white;
        border-radius: 0 0 15px 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 5px;
    }

    .item-details-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .item-details-card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
    }

    .spec-badge {
        background: #e9ecef;
        color: #495057;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-right: 5px;
        margin-bottom: 5px;
        display: inline-block;
    }

    .quotation-form {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e9ecef;
    }

    .price-input-group {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .total-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        border-radius: 10px;
        padding: 15px;
        margin: 0px 0;
    }

    .form-control:focus,
    .custom-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 12px 30px;
        font-weight: 600;
        margin-right: 10px;
    }

    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #dee2e6;
    }

    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 1rem;
        color: #212529;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .divider {
        border-top: 2px dashed #e9ecef;
        margin: 20px 0;
    }

    /* Chat UI Styles */
    .chat-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        height: 650px;
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef;
    }

    .chat-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 10px;
        margin-bottom: 15px;
    }

    .message {
        display: flex;
        margin-bottom: 20px;
    }

    .message.sent {
        justify-content: flex-end;
    }

    .message.received {
        justify-content: flex-start;
    }

    .message-content {
        max-width: 80%;
    }

    .message.sent .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 18px 18px 4px 18px;
    }

    .message.received .message-content {
        background: #f1f3f5;
        color: #212529;
        border-radius: 18px 18px 18px 4px;
    }

    .message-bubble {
        padding: 12px 16px;
        word-wrap: break-word;
    }

    .message-meta {
        font-size: 0.75rem;
        margin-top: 4px;
        color: #6c757d;
    }

    .message.sent .message-meta {
        text-align: right;
    }

    .message.received .message-meta {
        text-align: left;
    }

    .chat-input-container {
        background: #f8f9fa;
        border-radius: 30px;
        padding: 5px 5px 5px 20px;
        border: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    }

    .chat-input {
        border: none;
        background: transparent;
        flex-grow: 1;
        padding: 10px 0;
        outline: none;
    }

    .chat-input:focus {
        outline: none;
    }

    .btn-send {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .attachment-icon {
        color: #6c757d;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .attachment-icon:hover {
        color: #667eea;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .buyer-avatar {
        background: #6c757d;
    }

    .system-avatar {
        background: #28a745;
    }

    .message.received .user-avatar {
        margin-right: 10px;
    }

    .message.sent .user-avatar {
        margin-left: 10px;
        order: 2;
    }

    .timestamp {
        font-size: 0.7rem;
        color: #adb5bd;
        margin-top: 4px;
    }

    .chat-divider {
        text-align: center;
        margin: 15px 0;
        position: relative;
    }

    .chat-divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e9ecef;
    }

    .chat-divider span {
        background: white;
        padding: 0 15px;
        color: #6c757d;
        font-size: 0.8rem;
        position: relative;
        z-index: 1;
    }
</style>
<div class="rfq-container">
    <!-- Header Section -->
    <div class="rfq-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="text-white mb-1"><i class="fas fa-file-invoice mr-2"></i>RFQ #<?= $rfq_header_data->rfq_number ?></h5>
            <p class="mb-0 opacity-75">Category: <?= $category_data->name ?> | Status: <span class="badge badge-warning"><?= $rfq_header_data->status ?></span></p>
        </div>
        <div class="text-right">
            <h5 class="text-white mb-1"><i class="fas fa-user mr-2"></i>Buyer: <?= $created_by_user_data->name ?></h5>
            <p class="mb-0"><i class="far fa-clock mr-2"></i>Quotation Deadline: <?= date("d M, Y", strtotime($rfq_header_data->quotation_deadline)) ?></p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="rfq-content">
        <div class="row">
            <!-- Left Column - Item Details -->
            <div class="col-lg-6 mb-lg-0">
                <div class="item-details-card">
                    <h4 class="mb-1 text-primary">
                        <i class="fas fa-box mr-2"></i>Item Details
                    </h4>

                    <!-- Material Info -->
                    <div class="row">
                        <div class="col-6">
                            <div class="info-label">Material Code</div>
                            <div class="info-value"><?= ltrim($single_rfq_footer_data->material_code, 0) ?></div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Make/Model</div>
                            <div class="info-value"><?= $single_rfq_footer_data->make ?>/ <?= $single_rfq_footer_data->model ?></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="info-label">Part Name</div>
                            <div class="info-value"><?= $single_rfq_footer_data->part_name ?></div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Specification</div>
                            <div class="info-value"><?= $single_rfq_footer_data->specification ?></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="info-label">Quantity</div>
                            <div class="info-value"><?= $single_rfq_footer_data->quantity ?></div>
                        </div>
                        <div class="col-4">
                            <div class="info-label">UOM</div>
                            <div class="info-value"><?= $single_rfq_footer_data->uom ?></div>
                        </div>
                        <div class="col-4">
                            <div class="info-label">Required Delivery</div>
                            <div class="info-value">25/02/26</div>
                        </div>
                    </div>

                    <!-- Buyer Remark -->
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Buyer Remark:</strong> <?= $single_rfq_footer_data->remark ?>
                    </div>

                    <div class="divider"></div>

                    <!-- Comments History - Chat UI -->
                    <div class="chat-container">
                        <div class="chat-header d-flex align-items-center">
                            <i class="fas fa-comments text-primary mr-2 fa-lg"></i>
                            <h5 class="mb-0">Comments History</h5>
                            <span class="badge badge-primary ml-2">5</span>
                        </div>

                        <div class="chat-messages">
                            <!-- System Message -->
                            <div class="chat-divider">
                                <span><i class="far fa-clock mr-1"></i>TODAY</span>
                            </div>

                            <!-- Received Message (Buyer) -->
                            <div class="message received">
                                <div class="user-avatar buyer-avatar">B</div>
                                <div class="message-content">
                                    <div class="message-bubble">
                                        <strong>swapnali (Buyer)</strong>
                                        <p class="mb-1 mt-1">Please ensure the material is ISI certified. We need the delivery by 25th Feb without fail.</p>
                                        <div class="message-meta">
                                            <i class="far fa-clock mr-1"></i>10:30 AM
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sent Message (Vendor) -->
                            <div class="message sent">
                                <div class="message-content">
                                    <div class="message-bubble">
                                        <strong>You (Vendor)</strong>
                                        <p class="mb-1 mt-1">Yes, we can provide ISI certified products. Delivery by 25th Feb is confirmed.</p>
                                        <div class="message-meta">
                                            <i class="far fa-clock mr-1"></i>10:35 AM
                                            <i class="fas fa-check-double ml-1 text-success" title="Read"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-avatar">V</div>
                            </div>

                            <!-- Received Message with Attachment -->
                            <div class="message received">
                                <div class="user-avatar buyer-avatar">B</div>
                                <div class="message-content">
                                    <div class="message-bubble">
                                        <strong>swapnali (Buyer)</strong>
                                        <p class="mb-1 mt-1">Here's the technical specification document for reference:</p>
                                        <div class="bg-white bg-opacity-25 rounded p-2 mt-2">
                                            <i class="fas fa-file-pdf text-danger mr-2"></i>
                                            <small>Technical_Specs_Pump_Gasket.pdf</small>
                                            <i class="fas fa-download ml-2 float-right"></i>
                                        </div>
                                        <div class="message-meta">
                                            <i class="far fa-clock mr-1"></i>11:00 AM
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- System Message - Yesterday -->
                            <div class="chat-divider mt-3">
                                <span><i class="far fa-calendar mr-1"></i>YESTERDAY</span>
                            </div>

                            <!-- Received Message -->
                            <div class="message received">
                                <div class="user-avatar buyer-avatar">B</div>
                                <div class="message-content">
                                    <div class="message-bubble">
                                        <strong>swapnali (Buyer)</strong>
                                        <p class="mb-1 mt-1">What's the minimum order quantity for this item?</p>
                                        <div class="message-meta">
                                            <i class="far fa-clock mr-1"></i>3:15 PM
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sent Message -->
                            <div class="message sent">
                                <div class="message-content">
                                    <div class="message-bubble">
                                        <strong>You (Vendor)</strong>
                                        <p class="mb-1 mt-1">MOQ is 5 pieces, but we can offer bulk discount for orders above 20 pieces.</p>
                                        <div class="message-meta">
                                            <i class="far fa-clock mr-1"></i>4:30 PM
                                            <i class="fas fa-check-double ml-1 text-success" title="Read"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-avatar">V</div>
                            </div>
                        </div>

                        <!-- Chat Input Area -->
                        <div class="chat-input-container">
                            <i class="fas fa-paperclip attachment-icon mr-2"></i>
                            <input type="text" class="chat-input" placeholder="Type your message here...">
                            <button class="btn btn-send ml-2">
                                <i class="fas fa-paper-plane mr-1"></i>Send
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column - Quotation Form -->
            <div class="col-lg-6">
                <div class="quotation-form">
                    <h4 class="mb-1 text-success">
                        <i class="fas fa-file-signature mr-2"></i>Your Quotation
                    </h4>

                    <!-- Quantity and Rate -->
                    <div class="price-input-group">
                        <div class="row">
                            <div class="col-md-6 mb-md-0">
                                <label class="font-weight-600">
                                    <i class="fas fa-sort-amount-up mr-1"></i>Quantity *
                                </label>
                                <input type="number" class="form-control" value="5" min="1" step="1" readonly>
                                <small class="text-muted">Required quantity: 5 each</small>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-600">
                                    <i class="fas fa-rupee-sign mr-1"></i>Unit Price (₹) *
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₹</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter price" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="total-section d-flex justify-content-between align-items-center">
                                    <span class="font-weight-600">Line Total:</span>
                                    <span class="h5 mb-0 font-weight-bold text-primary">₹ 0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Date -->
                    <div class="form-group">
                        <label class="font-weight-600">
                            <i class="fas fa-truck mr-1"></i>Proposed Delivery Date *
                        </label>
                        <input type="date" class="form-control" value="<?= date("Y-m-d", strtotime($single_rfq_footer_data->delivery_date)) ?>">
                    </div>

                    <!-- Additional Charges Card -->
                    <div class="card mb-3 border">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 font-weight-600">
                                <i class="fas fa-plus-circle mr-1"></i>Additional Charges
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Discount (₹)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="0.00" step="0.01" id="discount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Installation Charges (₹)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="0.00" step="0.01" id="installation_charges">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Freight Type</label>
                                    <select class="custom-select">
                                        <option value="">Select Freight</option>
                                        <option value="paid">Paid by Vendor</option>
                                        <option value="tobepaid">To be Paid by Buyer</option>
                                        <option value="included">Included in Price</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Tax Type</label>
                                    <select class="custom-select" id="tax_type">
                                        <option value="">Select Tax</option>
                                        <option value="18">GST 18%</option>
                                        <option value="28">GST 28%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warranty -->
                    <div class="form-group">
                        <label class="font-weight-600">
                            <i class="fas fa-shield-alt mr-1"></i>Warranty
                        </label>
                        <input type="text" class="form-control" placeholder="e.g., 12 Months" value="">
                    </div>

                    <!-- Remark -->
                    <div class="form-group">
                        <label class="font-weight-600">
                            <i class="fas fa-comment mr-1"></i>Remark
                        </label>
                        <textarea class="form-control" rows="2" placeholder="Add your remark here..."></textarea>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">Sub Total</small>
                                <h6 class="mb-0 font-weight-bold">₹ 0.00</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">Total Amount</small>
                                <h6 class="mb-0 font-weight-bold text-success" id="total_amount_h_tag">₹ 0.00</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-cancel">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-save text-white">
                            <i class="fas fa-save mr-1"></i>Save Quotation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script('portal/rfq_item_view.js') ?>