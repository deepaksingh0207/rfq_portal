<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    body {
        background-color: #f8f9fa;
        padding: 20px;
    }
    
    .container-fluid {
        max-width: 1600px;
        margin: 0 auto;
    }
    
    /* Header Styles */
    .page-header {
        margin-bottom: 24px;
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
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
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
    
    .filter-select, .filter-search {
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 20px;
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
    
    /* Main Table Styles */
    .rfq-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    
    .rfq-table thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px;
        border: none;
        white-space: nowrap;
    }
    
    .rfq-table tbody tr.parent-row {
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    
    .rfq-table tbody tr.parent-row:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform: translateY(-1px);
    }
    
    .rfq-table tbody tr.parent-row.expanded {
        background-color: #f8f9fa;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .rfq-table tbody tr.parent-row.action-required {
        border-left: 4px solid #ffc107;
    }
    
    .rfq-table td {
        padding: 16px 12px;
        vertical-align: middle;
        border: none;
        font-size: 14px;
    }
    
    /* Expand/collapse icon */
    .expand-icon {
        color: #007bff;
        font-size: 16px;
        transition: transform 0.2s;
    }
    
    .expanded .expand-icon {
        transform: rotate(90deg);
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-badge.rejected {
        background-color: #fee;
        color: #dc3545;
    }
    
    .status-badge.under-approval {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-badge.approved {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    
    .status-dot.rejected {
        background-color: #dc3545;
    }
    
    .status-dot.under-approval {
        background-color: #ffc107;
    }
    
    .status-dot.approved {
        background-color: #28a745;
    }
    
    /* Approval Stage Indicator */
    .approval-stage {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background-color: #e9ecef;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        color: #495057;
    }
    
    .stage-active {
        background-color: #007bff;
        color: white;
    }
    
    .action-badge {
        background-color: #ffc107;
        color: #000;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 12px;
        margin-left: 8px;
        white-space: nowrap;
    }
    
    /* Review Button */
    .btn-review {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-review:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,123,255,0.2);
    }
    
    .btn-review:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    /* Expanded Detail Row */
    .detail-row {
        background-color: #f8f9fa;
    }
    
    .detail-row td {
        padding: 0;
        border: none;
    }
    
    .detail-content {
        padding: 24px;
        background: white;
        border-radius: 12px;
        margin: 0 8px 16px 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
        background-color: #f8f9fa;
        padding: 16px;
        border-radius: 12px;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .info-label {
        font-size: 11px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    
    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .info-value small {
        font-size: 12px;
        color: #6c757d;
        font-weight: normal;
    }
    
    /* Approval Stepper */
    .approval-stepper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 24px 0;
        position: relative;
        padding: 0 20px;
    }
    
    .stepper-item {
        flex: 1;
        text-align: center;
        position: relative;
    }
    
    .stepper-item::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }
    
    .stepper-item:last-child::before {
        display: none;
    }
    
    .stepper-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        position: relative;
        z-index: 2;
        font-weight: 600;
        color: #6c757d;
    }
    
    .stepper-item.completed .stepper-icon {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    
    .stepper-item.active .stepper-icon {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.2);
    }
    
    .stepper-item.rejected .stepper-icon {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    
    .stepper-label {
        font-weight: 600;
        font-size: 13px;
        color: #2c3e50;
    }
    
    .stepper-status {
        font-size: 11px;
        color: #6c757d;
    }
    
    /* Comments Section */
    .comments-section {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin: 20px 0;
    }
    
    .comments-title {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 16px;
    }
    
    .comment-item {
        background: white;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .comment-author {
        font-weight: 600;
        color: #2c3e50;
        font-size: 13px;
    }
    
    .comment-level {
        background-color: #e9ecef;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        color: #495057;
    }
    
    .comment-text {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 4px;
    }
    
    .comment-time {
        font-size: 10px;
        color: #adb5bd;
    }
    
    /* Comment Input */
    .comment-input-group {
        margin-top: 16px;
    }
    
    .comment-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 13px;
        resize: vertical;
    }
    
    .comment-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.1);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #e9ecef;
    }
    
    .btn-approve {
        background-color: #28a745;
        color: white;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-approve:hover {
        background-color: #218838;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(40,167,69,0.2);
    }
    
    .btn-reject {
        background-color: #dc3545;
        color: white;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-reject:hover {
        background-color: #c82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220,53,69,0.2);
    }
    
    .btn-approve:disabled, .btn-reject:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    /* Pagination */
    .pagination-info {
        color: #6c757d;
        font-size: 14px;
    }
    
    .pagination {
        gap: 8px;
    }
    
    .page-item .page-link {
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        color: #6c757d;
        font-weight: 500;
    }
    
    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
    }
    
    /* Testing Data Note */
    .testing-note {
        margin-top: 16px;
        padding: 12px;
        background-color: #e9ecef;
        border-radius: 8px;
        font-size: 12px;
        color: #495057;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2>RFQ Approval Dashboard</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-primary">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">RFQ Approvals</li>
                </ol>
            </nav>
        </div>
        <div class="user-info">
            <span class="badge badge-primary p-2">
                <i class="fas fa-user mr-2"></i>John Doe (R2 Approver)
            </span>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-group">
            <label>Filter by Authorization:</label>
            <select class="filter-select">
                <option>All Categories</option>
                <option>RM (Customer Controlled)</option>
                <option>SPN</option>
                <option>Raw Materials</option>
            </select>
        </div>
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
    <div class="table-section">
        <div class="section-title">
            <i class="fas fa-file-invoice"></i>
            RFQ Approval Queue
            <span class="badge badge-primary ml-2">2 items</span>
        </div>

        <table class="rfq-table">
            <thead>
                <tr>
                    <th style="width: 30px"></th>
                    <th>RFQ No.</th>
                    <th>Category</th>
                    <th>Product / Part</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Approval Stage</th>
                    <th>Expected Delivery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- RFQ 1 - Pending at R2 (Action Required) -->
                <tr class="parent-row action-required" onclick="toggleRow(this, 'rfq1-detail')" data-target="rfq1-detail">
                    <td>
                        <i class="fe fe-chevron-right"></i>
                    </td>
                    <td>
                        <strong>260211005</strong>
                    </td>
                    <td>SPN</td>
                    <td>PUMP WATER GASKET</td>
                    <td>4</td>
                    <td>
                        <span class="status-badge under-approval">
                            <span class="status-dot under-approval"></span>
                            Under Approval
                        </span>
                    </td>
                    <td>
                        <span class="approval-stage stage-active">
                            <i class="fas fa-clock mr-1"></i>R2/3
                        </span>
                        <span class="action-badge">Your Turn</span>
                    </td>
                    <td>11/02/26</td>
                    <td>
                        <button class="btn-review" onclick="event.stopPropagation(); expandAndScroll('rfq1-detail')">
                            <i class="fas fa-eye mr-1"></i>Review
                        </button>
                    </td>
                </tr>
                <!-- Detail Row for RFQ 1 -->
                <tr class="detail-row" id="rfq1-detail" style="display: none;">
                    <td colspan="9">
                        <div class="detail-content">
                            <!-- Info Grid -->
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Selected Rate</span>
                                    <span class="info-value">₹300.00 <small>per unit</small></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Make/Manufacturer</span>
                                    <span class="info-value">G.E. ELECTRICALS</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">UOM</span>
                                    <span class="info-value">each</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Added On</span>
                                    <span class="info-value">11/02/26, 04:21 pm</span>
                                </div>
                            </div>

                            <!-- Approval Stepper -->
                            <div class="approval-stepper">
                                <div class="stepper-item completed">
                                    <div class="stepper-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="stepper-label">R1 - Level 1</div>
                                    <div class="stepper-status">Completed</div>
                                </div>
                                <div class="stepper-item active">
                                    <div class="stepper-icon">2</div>
                                    <div class="stepper-label">R2 - Level 2</div>
                                    <div class="stepper-status">Your Action Required</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="stepper-icon">3</div>
                                    <div class="stepper-label">R3 - Level 3</div>
                                    <div class="stepper-status">Pending</div>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div class="comments-section">
                                <div class="comments-title">
                                    <i class="far fa-comments mr-2"></i>
                                    Approval Comments
                                </div>
                                
                                <!-- R1 Comment -->
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author">
                                            <i class="fas fa-user-check text-success mr-2"></i>
                                            R1 Approver (Sarah Johnson)
                                        </span>
                                        <span class="comment-level">Level 1</span>
                                    </div>
                                    <div class="comment-text">
                                        "Documentation looks good. Pricing is within range. Approved for next level."
                                    </div>
                                    <div class="comment-time">
                                        <i class="far fa-clock mr-1"></i> 11/02/26, 04:30 pm
                                    </div>
                                </div>

                                <!-- Current User's Comment Input -->
                                <div class="comment-item" style="background-color: #fff3cd;">
                                    <div class="comment-header">
                                        <span class="comment-author">
                                            <i class="fas fa-user-clock text-warning mr-2"></i>
                                            Your Comment (R2)
                                        </span>
                                    </div>
                                    <div class="comment-input-group">
                                        <textarea class="comment-input" rows="2" placeholder="Add your comments here... (Optional but recommended)"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button class="btn-reject" onclick="handleReject(this)">
                                    <i class="fas fa-times mr-2"></i>Reject
                                </button>
                                <button class="btn-approve" onclick="handleApprove(this)">
                                    <i class="fas fa-check mr-2"></i>Approve
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- RFQ 2 - Rejected -->
                <tr class="parent-row" onclick="toggleRow(this, 'rfq2-detail')" data-target="rfq2-detail">
                    <td>
                        <i class="fe fe-chevron-right"></i>
                    </td>
                    <td>
                        <strong>260209003</strong>
                    </td>
                    <td>RM (Customer Controlled)</td>
                    <td>NO XW4Z</td>
                    <td>100</td>
                    <td>
                        <span class="status-badge rejected">
                            <span class="status-dot rejected"></span>
                            REJECTED
                        </span>
                    </td>
                    <td>
                        <span class="approval-stage">
                            <i class="fas fa-times mr-1"></i>Rejected at R2
                        </span>
                    </td>
                    <td>25/02/26</td>
                    <td>
                        <button class="btn-review" disabled>
                            <i class="fas fa-eye mr-1"></i>View
                        </button>
                    </td>
                </tr>
                <!-- Detail Row for RFQ 2 -->
                <tr class="detail-row" id="rfq2-detail" style="display: none;">
                    <td colspan="9">
                        <div class="detail-content">
                            <!-- Info Grid -->
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Selected Rate</span>
                                    <span class="info-value">₹450.00 <small>per unit</small></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Make/Manufacturer</span>
                                    <span class="info-value">G.E. ELECTRICALS</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">UOM</span>
                                    <span class="info-value">One</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Added On</span>
                                    <span class="info-value">11/02/26, 02:38 pm</span>
                                </div>
                            </div>

                            <!-- Approval Stepper (Rejected) -->
                            <div class="approval-stepper">
                                <div class="stepper-item completed">
                                    <div class="stepper-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="stepper-label">R1 - Level 1</div>
                                    <div class="stepper-status">Completed</div>
                                </div>
                                <div class="stepper-item rejected">
                                    <div class="stepper-icon">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div class="stepper-label">R2 - Level 2</div>
                                    <div class="stepper-status">Rejected</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="stepper-icon">3</div>
                                    <div class="stepper-label">R3 - Level 3</div>
                                    <div class="stepper-status">Cancelled</div>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div class="comments-section">
                                <div class="comments-title">
                                    <i class="far fa-comments mr-2"></i>
                                    Approval Comments
                                </div>
                                
                                <!-- R1 Comment -->
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author">
                                            <i class="fas fa-user-check text-success mr-2"></i>
                                            R1 Approver (Sarah Johnson)
                                        </span>
                                        <span class="comment-level">Level 1</span>
                                    </div>
                                    <div class="comment-text">
                                        "Pricing seems high. Please review and negotiate."
                                    </div>
                                    <div class="comment-time">
                                        <i class="far fa-clock mr-1"></i> 11/02/26, 02:45 pm
                                    </div>
                                </div>

                                <!-- R2 Rejection Comment -->
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author">
                                            <i class="fas fa-user-times text-danger mr-2"></i>
                                            R2 Approver (John Doe)
                                        </span>
                                        <span class="comment-level">Level 2</span>
                                    </div>
                                    <div class="comment-text">
                                        "Rejected: Unable to proceed with current pricing. Need to get better rates from alternative suppliers."
                                    </div>
                                    <div class="comment-time">
                                        <i class="far fa-clock mr-1"></i> 11/02/26, 03:15 pm
                                    </div>
                                </div>
                            </div>

                            <!-- Disabled Action Buttons -->
                            <div class="action-buttons">
                                <button class="btn-reject" disabled>
                                    <i class="fas fa-times mr-2"></i>Reject
                                </button>
                                <button class="btn-approve" disabled>
                                    <i class="fas fa-check mr-2"></i>Approve
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="pagination-info">
                Showing 1 to 2 of 2 entries
            </div>
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Testing Data Note -->
        <div class="testing-note">
            <i class="fas fa-info-circle mr-2"></i>
            Testing Data: R1_STATUS: Approved, R2_STATUS: Pending Your Action (for RFQ 260211005), R3_STATUS: Pending
        </div>
    </div>
</div>

<script>
    // Toggle row expansion
    function toggleRow(element, targetId) {
        // Don't toggle if clicking on button
        if (event.target.tagName === 'BUTTON' || event.target.tagName === 'I') {
            return;
        }
        
        const targetRow = document.getElementById(targetId);
        const isExpanded = targetRow.style.display === 'table-row';
        
        // Close all other expanded rows first
        document.querySelectorAll('.detail-row').forEach(row => {
            row.style.display = 'none';
        });
        
        document.querySelectorAll('.parent-row').forEach(row => {
            row.classList.remove('expanded');
        });
        
        // Toggle current row
        if (!isExpanded) {
            targetRow.style.display = 'table-row';
            element.classList.add('expanded');
        }
    }
    
    // Expand specific row and scroll to it
    function expandAndScroll(targetId) {
        event.stopPropagation();
        
        const targetRow = document.getElementById(targetId);
        const parentRow = targetRow.previousElementSibling;
        
        // Close all other expanded rows
        document.querySelectorAll('.detail-row').forEach(row => {
            row.style.display = 'none';
        });
        
        document.querySelectorAll('.parent-row').forEach(row => {
            row.classList.remove('expanded');
        });
        
        // Open target row
        targetRow.style.display = 'table-row';
        parentRow.classList.add('expanded');
        
        // Scroll to the detail content
        setTimeout(() => {
            targetRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
    }
    
    // Handle approve action
    function handleApprove(button) {
        const commentArea = button.closest('.detail-content').querySelector('.comment-input');
        const comment = commentArea ? commentArea.value : '';
        
        if (confirm('Are you sure you want to approve this RFQ?')) {
            alert('RFQ Approved! (This would update the status in a real application)');
            // Here you would typically make an API call to update the status
        }
    }
    
    // Handle reject action
    function handleReject(button) {
        const commentArea = button.closest('.detail-content').querySelector('.comment-input');
        const comment = commentArea ? commentArea.value : '';
        
        if (!comment) {
            alert('Please add a comment explaining the reason for rejection.');
            return;
        }
        
        if (confirm('Are you sure you want to reject this RFQ?')) {
            alert('RFQ Rejected! (This would update the status in a real application)');
            // Here you would typically make an API call to update the status
        }
    }
    
    // Expand first row by default on page load
    window.onload = function() {
        const firstParentRow = document.querySelector('.parent-row');
        if (firstParentRow) {
            const targetId = firstParentRow.getAttribute('data-target');
            const targetRow = document.getElementById(targetId);
            if (targetRow) {
                targetRow.style.display = 'table-row';
                firstParentRow.classList.add('expanded');
            }
        }
    };
</script>