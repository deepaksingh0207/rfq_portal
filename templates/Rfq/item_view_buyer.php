<style>
    .main-container {
        max-width: 1400px;
        margin: 5px auto;
        padding: 0 5px;
    }

    /* RFQ Header Card */
    .rfq-header-card {
        background: #004a80;
        border-radius: 15px;
        padding: 10px 15px;
        color: white;
        margin-bottom: 10px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .rfq-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .rfq-badge i {
        margin-right: 8px;
    }

    /* Item Summary Card */
    .item-summary-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e9ecef;
    }

    .item-attribute {
        display: inline-block;
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 30px;
        margin: 5px;
        border: 1px solid #e9ecef;
        font-size: 0.9rem;
    }

    .item-attribute i {
        color: #667eea;
        margin-right: 8px;
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Table Styles */
    .table-container {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        border-top: none;
        background: #004a80;
        color: #fff;
        font-weight: 400;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 5px 10px;
    }

    .table tbody td {
        padding: 5px 10px;
        vertical-align: middle;
        color: #212529;
        font-weight: 400;
        font-size: 0.7rem;
    }

    .company-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 5px 12px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
    }

    .price-highlight {
        font-weight: 700;
        color: #28a745;
        font-size: 1.1rem;
    }

    .btn-view {
        background: #004a80;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.7rem;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-compare {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 10px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-compare:hover {
        background: #667eea;
        color: white;
    }

    /* Comparison Row */
    .compare-section {
        background: #fff3e0;
        border-radius: 15px;
        padding: 5px 10px;
        margin-bottom: 10px;
        border-left: 4px solid #ff9800;
    }

    .best-price {
        background: #d4edda;
        border-radius: 20px;
        padding: 3px 10px;
        color: #28a745;
        font-weight: 600;
        font-size: 0.8rem;
        margin-left: 10px;
    }

    .badge-lowest {
        background: #28a745;
        color: white;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-left: 10px;
    }

    .divider {
        border-top: 2px dashed #e9ecef;
        margin: 5px 0;
    }
</style>
<div class="main-container">
    <!-- RFQ Header Card -->
    <!-- <div class="rfq-header-card d-flex justify-content-between align-items-center">
        <div>
            <div class="d-flex align-items-center mb-2">
                <span class="rfq-badge mr-3"><i class="fas fa-hashtag"></i>RFQ #260114007</span>
                <span class="rfq-badge"><i class="far fa-clock"></i>Closes: 5 Mar 2026</span>
            </div>
            <h3 class="mb-1">PUMP WATER GASKET</h3>
            <p class="mb-0 opacity-75"><i class="fas fa-user mr-2"></i>Buyer: swapnali | Category: SPM</p>
        </div>
        <div class="text-right">
            <div class="rfq-badge mb-2"><i class="fas fa-box"></i>12 Units</div>
            <div class="rfq-badge"><i class="fas fa-calendar"></i>Required: 5 Mar 2026</div>
        </div>
    </div> -->

    <!-- Item Details Summary -->
    <div class="item-summary-card">
        <h6 class="mb-1">RFQ - <?= $rfq_header_data->rfq_number ?> Item <?= !empty($single_rfq_footer_data->item_no) ? "#".$single_rfq_footer_data->item_no : "" ?> Specifications</h6>
        <div>
            <div class="row">
                <div class="col-3">
                    <div class="info-label">Material Code</div>
                    <div class="info-value"><?= ltrim($single_rfq_footer_data->material_code, 0) ?></div>
                </div>
                <div class="col-3">
                    <div class="info-label">Make/Model</div>
                    <div class="info-value"><?= $single_rfq_footer_data->make ?>/ <?= $single_rfq_footer_data->model ?></div>
                </div>
                <div class="col-3">
                    <div class="info-label">Part Name</div>
                    <div class="info-value"><?= $single_rfq_footer_data->part_name ?></div>
                </div>
                <div class="col-3">
                    <div class="info-label">Specification</div>
                    <div class="info-value"><?= $single_rfq_footer_data->specification ?></div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="row">
                <div class="col-3">
                    <div class="info-label">Quantity</div>
                    <div class="info-value"><?= $single_rfq_footer_data->quantity ?></div>
                </div>
                <div class="col-3">
                    <div class="info-label">UOM</div>
                    <div class="info-value"><?= $single_rfq_footer_data->uom ?></div>
                </div>
                <div class="col-3">
                    <div class="info-label">Required Delivery</div>
                    <div class="info-value"><?= date("d M, Y",strtotime($single_rfq_footer_data->delivery_date)) ?></div>
                </div>
                <div class="col-3">
                    <div class="info-lab">Quoatation Deadline</div>
                    <div class="info-value"><?= date("d M, Y",strtotime($rfq_header_data->quotation_deadline)) ?></div>
                </div>
            </div>
        </div>
        <div class="mt-1 p-3 bg-light rounded">
            <i class="fas fa-info-circle text-info mr-2"></i>
            <strong>Buyer Remark:</strong> <?= $single_rfq_footer_data->remark; ?>
        </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="row mb-1">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-value">3</div>
                <div class="stat-label">Total Responses</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-value">₹97.00</div>
                <div class="stat-label">Lowest Price</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-value">2 Mar</div>
                <div class="stat-label">Earliest Delivery</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-value">₹50.00</div>
                <div class="stat-label">Highest Discount</div>
            </div>
        </div>
    </div> -->

    <!-- Compare Section -->
    <div class="compare-section d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-balance-scale text-warning mr-2"></i>
            <strong>Compare Quotes</strong>
            <span class="ml-2 text-muted">Select quotes from below to compare</span>
        </div>
        <button class="btn btn-compare btn-sm">
            <i class="fas fa-chart-bar mr-2"></i>Compare Selected
        </button>
    </div>

    <!-- Main Table -->
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h5 class="mb-0"><i class="fas fa-list mr-2 text-primary"></i>Quotations Received</h5>
        </div>

        <table class="table table-hover" id="responsesTable">
            <thead>
                <tr>
                    <th width="40">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Id</th>
                    <th>Vendor</th>
                    <th>Qty</th>
                    <th>Rate (₹)</th>
                    <th>Amount (₹)</th>
                    <th>Delivery</th>
                    <th>Response Date</th>
                    <th>Discount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rfq_quote_revisions_data as $rqrd) : ?>
                    <tr>
                        <td><input type="checkbox" class="quote-checkbox"></td>
                        <td><span class="font-weight-bold"><?= $rqrd->id ?></span></td>
                        <td>
                            <span class="company-badge">
                                <?= $rqrd->vendor_name ?>
                            </span>
                        </td>
                        <td><?= $single_rfq_footer_data->quantity ?></td>
                        <td class="price-highlight">₹<?= $rqrd->rate ?></td>
                        <td>₹ <?= $rqrd->total_amount ?></td>
                        <td><span><?= date("d M, Y" , strtotime($rqrd->delivery_date)) ?></span></td>
                        <td><?= date("d M, Y H:i a" , strtotime($rqrd->response_date)) ?></td>
                        <td><span><?= $rqrd->discount ?></span></td>
                        <td>
                            <a class="btn btn-view btn-sm" href="<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'view-quotation-details' , $single_rfq_footer_data->id , $rqrd->vendor_user_id , $rqrd->id]) ?>">
                                VIEW
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Quotation Detail Modal -->
<div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title" id="quotationModalLabel">
                    <i class="fas fa-file-invoice mr-2"></i>Quotation Details - <span id="companyName">FTSolutions</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <!-- Vendor Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <small class="text-muted">Vendor Details</small>
                            <h6 class="mb-0"><i class="fas fa-building mr-2 text-primary"></i>FTSolutions Pvt Ltd</h6>
                            <p class="mb-0 text-muted small"><i class="fas fa-map-marker-alt mr-2"></i>Mumbai, Maharashtra</p>
                            <p class="mb-0 text-muted small"><i class="fas fa-star text-warning mr-2"></i>4.5 (120 reviews)</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <small class="text-muted">Quote Summary</small>
                            <h6 class="mb-0"><i class="fas fa-hashtag mr-2 text-primary"></i>Quote #: FT-2026-001</h6>
                            <p class="mb-0 text-muted small"><i class="far fa-calendar mr-2"></i>Submitted: 26 Feb 2026, 10:30 AM</p>
                        </div>
                    </div>
                </div>

                <!-- Quotation Details Table -->
                <h6 class="mb-3"><i class="fas fa-chart-line text-primary mr-2"></i>Quotation Breakdown</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Quantity</th>
                                <th>Rate (₹)</th>
                                <th>Total Amount (₹)</th>
                                <th>Delivery Date</th>
                                <th>Discount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>12.00</strong></td>
                                <td class="text-success font-weight-bold">₹97.00</td>
                                <td class="font-weight-bold">₹1,164.00</td>
                                <td><span class="badge badge-warning">2026-03-06</span></td>
                                <td class="text-danger font-weight-bold">₹50.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Additional Charges -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <h6 class="mb-2"><i class="fas fa-plus-circle text-success mr-2"></i>Additional Charges</h6>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Installation:</span>
                                <span class="font-weight-bold">₹500.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Freight:</span>
                                <span class="font-weight-bold">Paid by Vendor</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Tax (GST 18%):</span>
                                <span class="font-weight-bold">₹209.52</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <h6 class="mb-2"><i class="fas fa-shield-alt text-info mr-2"></i>Terms</h6>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Warranty:</span>
                                <span class="font-weight-bold">12 Months</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Payment Terms:</span>
                                <span class="font-weight-bold">Net 30</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section - Chat Style -->
                <div class="mt-4">
                    <h6 class="mb-3"><i class="fas fa-comments text-primary mr-2"></i>Comments</h6>

                    <!-- Comments Container -->
                    <div class="bg-light rounded p-3" style="max-height: 250px; overflow-y: auto;">
                        <!-- System Message -->
                        <div class="text-center mb-3">
                            <span class="badge badge-light p-2">Quote submitted on 26 Feb 2026</span>
                        </div>

                        <!-- Vendor Comment -->
                        <div class="d-flex mb-3">
                            <div class="mr-2">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="bg-white rounded p-3" style="max-width: 80%;">
                                <strong>FTSolutions <small class="text-muted ml-2">Vendor</small></strong>
                                <p class="mb-1 mt-1">We can offer bulk discount if order quantity increases. Also, we provide free installation for orders above ₹10,000.</p>
                                <small class="text-muted"><i class="far fa-clock mr-1"></i>26 Feb 2026, 10:35 AM</small>
                            </div>
                        </div>

                        <!-- Buyer Comment (Rashi Sawant) -->
                        <div class="d-flex mb-3 justify-content-end">
                            <div class="bg-primary text-white rounded p-3" style="max-width: 80%;">
                                <strong>Rashi Sawant <small class="text-white-50 ml-2">Buyer</small></strong>
                                <p class="mb-1 mt-1">Can you match the delivery date of 3rd March? We have urgent requirement.</p>
                                <small class="text-white-50"><i class="far fa-clock mr-1"></i>26 Feb 2026, 11:20 AM</small>
                            </div>
                            <div class="ml-2">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Vendor Reply -->
                        <div class="d-flex mb-3">
                            <div class="mr-2">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="bg-white rounded p-3" style="max-width: 80%;">
                                <strong>FTSolutions <small class="text-muted ml-2">Vendor</small></strong>
                                <p class="mb-1 mt-1">We can expedite delivery to 3rd March at no extra cost.</p>
                                <small class="text-muted"><i class="far fa-clock mr-1"></i>26 Feb 2026, 11:45 AM</small>
                            </div>
                        </div>
                    </div>

                    <!-- Add Comment Input -->
                    <div class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Type your comment here..." style="border-radius: 30px 0 0 30px;">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" style="border-radius: 0 30px 30px 0; padding-left: 25px; padding-right: 25px;">
                                    <i class="fas fa-paper-plane mr-2"></i>Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light px-4" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>CLOSE
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let get_rfq_quotes_data_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'get-rfq-quotes-data']) ?>";
</script>

<?= $this->Html->script('portal/rfq_item_view_buyer.js') ?>