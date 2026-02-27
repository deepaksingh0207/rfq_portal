<style>
    .quotation-page {
        max-width: 100%;
        margin: 0 auto;
    }

    .quotation-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .quotation-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 5px 15px;
    }

    .quotation-header h2 {
        font-weight: 600;
        margin: 0;
        font-size: 1.8rem;
    }

    .quotation-header .rfq-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 30px;
        font-size: 0.9rem;
        display: inline-block;
    }

    .quotation-body {
        padding: 10px;
    }

    .info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 5px;
        height: 100%;
        transition: transform 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .info-label {
        color: #6c757d;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .rating-stars {
        color: #ffc107;
    }

    .price-highlight {
        color: #28a745;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .table-custom {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table-custom thead th {
        background: #f8f9fa;
        border: none;
        padding: 5px;
        font-weight: 600;
        color: #495057;
    }

    .table-custom tbody td {
        padding: 5px;
        vertical-align: middle;
    }

    .charges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .charge-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        flex-shrink: 0;
    }

    .avatar-vendor {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .avatar-buyer {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    }

    .avatar-system {
        background: #6c757d;
    }

    .comment-bubble {
        background: white;
        border-radius: 18px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        max-width: 80%;
    }

    .comment-bubble-sent {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .comment-time {
        font-size: 0.75rem;
        color: #6c757d;
    }

    .comment-time-sent {
        color: rgba(255, 255, 255, 0.8);
    }

    .comments-container {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 20px;
        max-height: 350px;
        overflow-y: auto;
    }

    .send-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 0 30px 30px 0;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .send-btn:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .close-btn {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 12px 40px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .close-btn:hover {
        background: #f8f9fa;
        border-color: #dee2e6;
        transform: translateY(-2px);
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #667eea;
        font-weight: 500;
        text-decoration: none;
    }

    .back-link:hover {
        color: #764ba2;
        text-decoration: none;
    }

    .total-amount-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 15px 20px;
        border: 1px solid #dee2e6;
    }

    .badge-delivery {
        background: #fff3cd;
        color: #856404;
        padding: 5px 12px;
        border-radius: 30px;
        font-weight: 500;
    }
</style>

<div class="quotation-page">

    <!-- Main Quotation Card -->
    <div class="quotation-card">
        <!-- Header -->
        <div class="quotation-header d-flex justify-content-between align-items-center">
            <div>
                <h4>Quotation Details</h4>
                <div class="">
                    <span class="rfq-badge mr-2">RFQ #260114007</span>
                    <span class="rfq-badge">FTSolutions</span>
                </div>
            </div>
            <div class="text-right">
                <!-- <div class="rfq-badge">Status: <span class="badge badge-warning">Under Review</span></div> -->
            </div>
        </div>

        <!-- Body -->
        <div class="quotation-body">
            <!-- Vendor Info Row -->
            <div class="row mb-1">
                <div class="col-md-6 mb-1 mb-md-0">
                    <div class="info-card">
                        <div class="info-label">Vendor Details</div>
                        <h5 class="mb-1"><?= $user_data->name ?></h5>
                        <p class="mb-1">Email - <?= $user_data->email ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">Item Specifications</div>
                        <h6 class="mb-2"><?= !empty($rfq_footer_data->item_no) ? $rfq_footer_data->item_no . " - " : '' ?> <?= ltrim($rfq_footer_data->material_code, 0) ?> - <?= $rfq_footer_data->material_description ?></h6>
                        <p class="mb-0">Make : <?= $rfq_footer_data->make ?></p>
                        <p class="mb-0">Model : <?= $rfq_footer_data->model ?></p>
                        <p class="mb-0">Specification : <?= $rfq_footer_data->specification ?></p>
                    </div>
                </div>
            </div>

            <!-- Quotation Details Table -->
            <h5 class="mb-1"><i class="fas fa-chart-line text-primary mr-2"></i>Quotations</h5>
            <div class="table-responsive table-custom mb-4">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Qty</th>
                            <th>Rate(₹)</th>
                            <th>Price(₹)</th>
                            <th>Discount(₹)</th>
                            <th>Freight(₹)</th>
                            <th>Tax(₹)</th>
                            <th>Installation(₹)</th>
                            <th>Total Amount(₹)</th>
                            <th>Delivery Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rfq_quote_revisions_data as $rqrd) : ?>
                        <tr>
                            <td><strong><?= $rfq_footer_data->quantity ?></strong></td>
                            <td><?= $rqrd->unit_price ?></td>
                            <td><?= $rqrd->line_total ?></td>
                            <td><?= $rqrd->discount_amount ?></td>
                            <td><?= $rqrd->freight_value ?>(<?= $rqrd->freight_type ?>)</td>
                            <td><?= ($rqrd->total_amount - $rqrd->sub_total)  ?> (<?= strtoupper($rqrd->tax_type) ?> - <?= $rqrd->tax_value ?>%)</td>
                            <td><?= $rqrd->installation_charges ?></td>
                            <td><?= $rqrd->total_amount ?></td>
                            <td><?= date("d M, Y" , strtotime($rqrd->delivery_date)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Comments Section - Enhanced Chat Style -->
            <div class="mt-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="mb-0"><i class="fas fa-comments text-primary mr-2"></i>Comments </h5>
                    <span class="badge badge-primary"><?= $comments_count ?></span>
                </div>

                <!-- Comments Container -->
                <div class="comments-container mb-1" id="chat_messages_div">
                    
                </div>

                <!-- Add Comment Input with Actions -->
                <div class="mt-1">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Type your comment here..." style="border-radius: 30px 0 0 30px; border: 2px solid #e9ecef; border-right: none;" id="comment_message">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" style="border-radius: 0 30px 30px 0; padding-left: 30px; padding-right: 30px; border: 2px solid #667eea;" id="comment_send_btn">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let load_chat_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'load-comments-for-buyer' , $rfq_footer_data->id , $vendor_user_id]) ?>";
</script>

<?= $this->Html->script('portal/rfq_view_quotation_details.js') ?>