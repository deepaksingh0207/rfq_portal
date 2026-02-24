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
                <option value="DRAFT">DRAFT</option>
                <option value="UNDER_APPROVAL">UNDER_APPROVAL</option>
                <option value="PUBLISHED">PUBLISHED</option>
                <option value="REJECTED">REJECTED</option>
                <option value="EXPIRED">EXPIRED</option>
                <option value="CLOSED">CLOSED</option>
            </select>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-add-rfq px-4 py-2" href="<?= $this->Url->build(['controller' => 'rfq', 'action' => 'add']) ?>">ADD RFQ</a>
        </div>
    </div>

    <div class="table-responsive shadow-sm bg-white">
        <table class="table table-hover mb-0" id="rfq_list_table">
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

<!-- End Chat Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    var getAllDetails = "<?php echo $this->Url->build(['controller' => 'rfq-details', 'action' => 'get-all-details']) ?>";
    var get_vendor_quotes_for_rfq_detail = "<?php echo  $this->Url->build(['controller' => 'rfq-details', 'action' => 'get-rfq-details']) ?>";
    var sendChatUrl = "<?php echo  $this->Url->build(['controller' => 'rfq-details', 'action' => 'send']) ?>";
    var loadChatUrl = "<?php echo  $this->Url->build(['controller' => 'rfq-details', 'action' => 'load']) ?>";

    $(document).ready(function() {
        var table = $('#example1').DataTable({
            paging: true,
            ordering: true,
            info: true,
            dom: 'lrtipf'
        });
        $('#example1_filter').hide();
        $('#statusFilter').on('change', function() {
            var status = $(this).val();
            table.column(7).search(status, true, false).draw();
            const url = new URL(window.location);
            if (status) {
                url.searchParams.set('status', status);
            } else {
                url.searchParams.delete('status');
            }
            history.replaceState(null, '', url);
        });
        $(document).ready(function() {
            const params = new URLSearchParams(window.location.search);
            const status = params.get('status');
            if (status) {
                $('#statusFilter').val(status);
                $('#statusFilter').trigger('change');
            }
        });
        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

    function updateModalContent(rfq_detail_id) {
        $('#modalHeader').empty();
        $('#modalTableBody').empty();

        var vendorsData = [];

        $.ajax({
            type: "POST",
            url: get_vendor_quotes_for_rfq_detail,
            data: {
                rfq_detail_id: rfq_detail_id
            },
            dataType: "json",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    $.each(response.rfq_inquiries_results, function(index, value) {
                        var rfq_no = response.rfq_details.rfq_no;
                        var category = response.rfq_details.product.name;
                        var company = value.UserProfiles.company_name;
                        var qty = value.qty;
                        var rate = parseFloat((value.rate));
                        var amt = parseFloat(value.sub_total);
                        var delivery_date = value.delivery_date;
                        var discount = value.discount;
                        var first_name = value.UserProfiles.first_name;
                        var mobile = value.UserProfiles.mobile;
                        var address = value.UserProfiles.address;
                        var neg_rate = '';
                        var vendor_user_id = value.user_profile_id;
                        var total_discounted_amt = amt - discount;
                        var gst = total_discounted_amt * 0.18;
                        var sub_total = total_discounted_amt + gst;
                        sub_total = sub_total.toFixed(2);

                        vendorsData.push({
                            rfq_no: rfq_no,
                            company: company,
                            category: category,
                            qty: qty,
                            rate: rate,
                            amt: amt,
                            discount: discount,
                            total_discounted_amt: total_discounted_amt,
                            gst: gst.toFixed(2),
                            sub_total: sub_total,
                            delivery_date: delivery_date,
                            first_name: first_name,
                            mobile: mobile,
                            address: address,
                            neg_rate: neg_rate,
                            vendor_user_id: vendor_user_id
                        });
                    });

                    let product_names_html = '';

                    $.each(response.unique_product_names, function(k, v) {
                        product_names_html += '<label><input type="checkbox" name="products[]" value="' + v + '">' + v + '</label>';
                    });

                    $.ajax({
                        url: getAllDetails,
                        type: 'GET',
                        data: {
                            rfq_detail_id: rfq_detail_id
                        },
                        success: function(response) {
                            if (response.rfq_revises_inquiries && response.rfq_no) {
                                const groupedData = response.rfq_revises_inquiries.reduce((result, item) => {
                                    if (!result[item.user_profile_id]) {
                                        result[item.user_profile_id] = [];
                                    }
                                    result[item.user_profile_id].push(item);
                                    return result;
                                }, {});

                                // Helper function to generate vendor columns
                                function generateVendorColumns(callback) {
                                    let columns = '';
                                    Object.keys(groupedData).forEach((vendorProfileId) => {
                                        if (!groupedData[vendorProfileId]) {
                                            columns += `<td colspan="12"></td>`;
                                            return;
                                        }

                                        const vendorData = groupedData[vendorProfileId];
                                        columns += `
                                        <td style="padding:0 !important; position:relative; height:100% !important" colspan="12">
                                            <table style="font-size:small !important; height:100% !important">
                                                <tbody style="display:flex; height:100% !important" class="collapsed_td${vendorProfileId}">`;

                                        vendorData.forEach((vendor, i) => {
                                            const rate = vendor.rate || 0;
                                            const qty = vendor.qty || 0;
                                            const amt = rate * qty;
                                            const discount = vendor.discount || 0;
                                            const total_discounted_amt = amt - discount;
                                            const gst = total_discounted_amt * 0.18;
                                            const sub_total = total_discounted_amt + gst;
                                            const deliverydate = vendor.delivery_date || 'N/A';

                                            columns += callback(vendor, i, {
                                                rate,
                                                qty,
                                                amt,
                                                discount,
                                                total_discounted_amt,
                                                gst,
                                                sub_total: sub_total.toFixed(2),
                                                deliverydate
                                            });
                                        });

                                        columns += `
                                                </tbody>
                                            </table>
                                        </td>`;
                                    });
                                    return columns;
                                }

                                // Build the complete table
                                let staticHeaderRows = `
                                <tr>
                                    <td colspan="4"><strong>PLANT</strong></td>
                                    <td colspan="12"><strong></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>Requirement for</strong></td>`;

                                // Add vendor headers
                                Object.keys(groupedData).forEach((userProfileId, index) => {
                                    const userProfile = groupedData[userProfileId][0].user_profile || {};
                                    staticHeaderRows += `
                                    <td colspan="12" class="header">
                                        <strong>Vendor ${index + 1}</strong>
                                        <div style="display:inline-block; float:right;">
                                            <button type="button" class="btn-primary" onclick="printComparison(this)">
                                                <i class="fa fa-print"></i>
                                            </button>
                                            <button class="btn-primary toggle-history" data-userprofileid="${userProfileId}">
                                                <i class="fa fa-plus" id="fa_icon_${userProfileId}"></i>
                                            </button>
                                        </div>
                                    </td>`;
                                });

                                staticHeaderRows += `</tr>`;

                                // Vendor details rows
                                ['first_name', 'address', 'first_name', 'mobile'].forEach((field, idx) => {
                                    const labels = ['Name:', 'Location:', 'Person:', 'Phone:'];
                                    staticHeaderRows += `
                                    <tr>
                                        <td colspan="4"><strong></strong></td>`;

                                    Object.keys(groupedData).forEach(userProfileId => {
                                        const userProfile = groupedData[userProfileId][0].user_profile || {};
                                        let value = userProfile[field] || 'N/A';
                                        if (field === 'mobile' && !value) value = 'N/A';

                                        staticHeaderRows += `
                                        <td colspan="12" class="header">
                                            <strong>${labels[idx]} ${value}</strong>
                                        </td>`;
                                    });

                                    staticHeaderRows += `</tr>`;
                                });

                                // Table headers
                                staticHeaderRows += `
                                <tr>
                                    <td class="header"><strong>S.N.</strong></td>
                                    <td class="header"><strong>ITEM DESCRIPTION</strong></td>
                                    <td class="header"><strong>QTY</strong></td>
                                    <td class="header"><strong>U/M</strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="header"><strong>RATE</strong></td>
                                            <td style="width:80px !important;" class="header"><strong>AMT</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Product names row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name">
                                        <div style="display: flex; flex-direction: column;" id="product_names_by_user">
                                            ${product_names_html}
                                        </div>
                                    </td>
                                    <td class="plant-name"><strong>${vendorsData.length > 0 ? vendorsData[0].qty : ''}</strong></td>
                                    <td class="plant-name"><strong>EA</strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.rate !== 0 ? data.rate : 'N/A'}</strong>
                                            </td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.amt > 0 ? data.amt.toFixed(2) : 'N/A'}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // DISCOUNT row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>DISCOUNT</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.amt > 0 ? data.amt.toFixed(2) : 'N/A'}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // TOTAL BASIC VALUE RS. row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>TOTAL BASIC VALUE RS.</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.total_discounted_amt.toFixed(2)}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Packing and Forwarding row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>Packing and Forwarding.</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong>0.00</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Sub Total - A row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name" style="color: green;"><strong>Sub Total - A.</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important; color: green;" class="plant-name">
                                                <strong>${data.total_discounted_amt.toFixed(2)}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // GST @ 18 % row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>GST @ 18 % .</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.gst.toFixed(2)}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // SUB TOTAL - B row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name" style="color: green;"><strong>SUB TOTAL - B.</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important; color: green;" class="plant-name">
                                                <strong>${data.sub_total}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // NET COST RS. row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>NET COST RS.</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.sub_total}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Installation Charges row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>Installation Charges</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong>0.00</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // ITC(Input Tax Credit) row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>ITC(Input Tax Credit)</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // FREIGHT CHARGES row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>FREIGHT CHARGES</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong>0.00</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // OTHERS row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>OTHERS</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong>0.00</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // COST TO THE COMPANY row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>COST TO THE COMPANY</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.sub_total}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // OTHERS (JBMA SND) row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>OTHERS</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong>JBMA SND</strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // DELIVERY row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>DELIVERY</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor, i, data) => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>${data.deliverydate}</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // PAYMENT TERMS row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>PAYMENT TERMS</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name">
                                                <strong>100% With in 30 days after Received the Material</strong>
                                            </td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Warranty row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong>Warranty</strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns(() => `
                                        <tr style="border-left:1px solid #777;">
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                            <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                        </tr>
                                    `)}
                                </tr>`;

                                // Checkbox row
                                staticHeaderRows += `
                                <tr>
                                    <td class="plant-name"></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    <td class="plant-name"><strong></strong></td>
                                    ${generateVendorColumns((vendor) => {
                                        const rate = vendor.rate || 0;
                                        const qty = vendor.qty || 0;
                                        const amt = rate * qty;
                                        const userProfileId = vendor.user_profile_id || 0;
                                        const isChecked = vendor.isChecked ? 'checked' : '';
                                        const isDisabled = vendor.isDisabled ? 'disabled' : '';
                                        
                                        return `
                                            <tr style="border-left:1px solid #777;">
                                                <td style="width:80px !important;" class="plant-name"><strong></strong></td>
                                                <td style="width:80px !important;" class="plant-name">
                                                    <strong>
                                                        <input 
                                                            type="checkbox" 
                                                            class="vendor-checkbox" 
                                                            data-vendor_user_id="${userProfileId}" 
                                                            data-amt="${amt}"
                                                            data-rfq_no="${response.rfq_no}"
                                                            ${isChecked} 
                                                            ${isDisabled}
                                                        >
                                                    </strong>
                                                </td>
                                            </tr>
                                        `;
                                    })}
                                </tr>`;

                                $('#modalHeader').html(staticHeaderRows);
                                $('#compareIndexModal').modal('show');
                            } else {
                                console.log("No records found in rfq_revises_inquiries.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error fetching RFQ revises inquiries:", error);
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching vendor quotes:", error);
            }
        });
    }

    function printComparison(ele) {
        let clicked_td_index = $(ele).closest('td').index();
        let first_td_index = 0;

        console.log({
            clicked_td_index,
            first_td_index
        });

        let tr_html = '';

        let count = 0;
        $('.comp_table').find('thead').children('tr').each(function(index, element) {
            // element == this
            tr_html += '';

            if (index < 6) {
                tr_html += '<tr>';

                let td_html = $(element).find(`td:eq(${first_td_index})`).clone();
                td_html.find('input, button, select, textarea, style, script').remove();
                td_html.removeAttr('style').removeAttr('class');
                tr_html += '<td>' + td_html.text().trim() + '</td>';

                td_html = $(element).find(`td:eq(${clicked_td_index})`).clone();
                td_html.find('input, button, select, textarea, style, script').remove();
                td_html.removeAttr('style').removeAttr('class');
                tr_html += '<td>' + td_html.text().trim() + '</td>';
                tr_html += '<td></td><td></td><td></td><td></td>';

                tr_html += '</tr>';
            }

            if (index >= 6 && index < 24) {
                tr_html += '<tr>';
                td_html = $(element).children('td').slice(first_td_index, 4).map(function() {
                    var tdClone = $(this).clone();
                    tdClone.find('input, button, select, textarea, style, script').remove();
                    tdClone.removeAttr('style').removeAttr('class');
                    return '<td>' + tdClone.text().trim() + '</td>';
                }).get().join('');
                td_html += '<td>' + $(element).children(`td:eq(${(clicked_td_index + 3)})`).find('td:eq(0)').html() + '</td>';
                td_html += '<td>' + $(element).children(`td:eq(${(clicked_td_index + 3)})`).find('td:eq(1)').html() + '</td>';
                tr_html += td_html;
                tr_html += '</tr>';
            }
        });

        let table_html = `
                <html>
                    <head>
                        <style>
                            body {
                                background-color: white !important;
                                color: black !important; /* Ensure text is black */
                                margin: 0; /* Reset default body margins */
                                padding: 0; /* Reset default body paddings */
                            }
                            table {
                                background-color: white !important;
                                color: black !important;
                                width: 100%; /* Make table full width */
                                border-collapse: collapse; /* For clean borders */
                            }
                            thead {
                                background-color: white !important;
                                color: black !important;
                            }
                            td, th {
                                background-color: white !important; /* Ensure cells are white */
                                color: black !important; /* Ensure cell text is black */
                                border: 1px solid #ccc; /* Add borders for table structure */
                                padding: 8px; /* Add padding for readability */
                                text-align: left;
                                vertical-align: top; /* Important for multi-line content in cells */
                                white-space: pre-line; /* Preserves line breaks and allows wrapping */
                            }
                            strong {
                                color: black !important; /* Ensure strong text is black */
                            }
                        </style>
                    </head>
                    <body>
                        <table border = 1>
                        <thead>
                        ${tr_html}
                        </thead>
                        </table>
                    </body>
                </html>
            `;
        table_html.replace('undefined', '');
        console.log(table_html);
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = table_html;
        document.body.appendChild(tempDiv);

        html2canvas(tempDiv, {
            backgroundColor: 'white'
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF();
            const imgWidth = 210; // A4 width in mm
            const pageHeight = 295; // A4 height in mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save('report.pdf');
            document.body.removeChild(tempDiv); // Clean up the temporary div
        });
    }
</script>
<script>
    const currentUserId = <?= $this->request->getSession()->read('user_profile_id') ?>;
    let currentRfqId = null;
    let currentBuyerId = null;
    const csrfToken = document.querySelector('meta[name="csrfToken"]').getAttribute('content');

    function formatAMPM(dateString) {
        const date = new Date(dateString);
        let hours = date.getHours();
        let minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours %= 12;
        hours = hours || 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes + ' ' + ampm;
    }

    function formatDateGroup(dateString) {
        const date = new Date(dateString);
        const today = new Date();
        if (
            date.getDate() === today.getDate() &&
            date.getMonth() === today.getMonth() &&
            date.getFullYear() === today.getFullYear()
        ) {
            return 'Today';
        } else {
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }
    }

    function appendMessage(msg) {
        const isMine = msg.sender_id === currentUserId;
        const align = isMine ? 'chat-left' : 'chat-right';
        const bg = isMine ? 'bg-light' : 'bg-primary';
        const time = formatAMPM(msg.created);
        const dateGroup = formatDateGroup(msg.created);

        const lastDate = $('#chatContent').data('lastDate');
        if (lastDate !== dateGroup) {
            $('#chatContent').append(`<div class="chat-date-label">${dateGroup}</div>`);
            $('#chatContent').data('lastDate', dateGroup);
        }

        $('#chatContent').append(`
            <div class="${align}">
                <div class="chat-bubble ${bg}">
                    ${escapeHtml(msg.message)}
                    <div class="chat-time">${time}</div>
                </div>
            </div>
        `);
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }

    function scrollToBottom() {
        const el = $('#chatContent');
        el.scrollTop(el.prop("scrollHeight"));
    }
    $('.open-chat-modal').on('click', function() {
        currentRfqId = $(this).data('rfq-id');
        currentBuyerId = $(this).data('buyer-id');

        $('#chatContent').empty().data('lastDate', null);
        $('#chatMessage').val('');
        $('#chatModal').modal('show');

        $.ajax({
            url: loadChatUrl,
            type: 'POST',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            data: {
                rfq_id: currentRfqId,
                buyer_id: currentBuyerId
            },
            success: function(response) {
                if (Array.isArray(response.messages)) {
                    response.messages.forEach(msg => appendMessage(msg));
                    scrollToBottom();
                } else {
                    $('#chatContent').append('<div class="text-muted">No messages found.</div>');
                }
            },
            error: function(xhr, status, error) {
                alert('Error loading chat: ' + error);
            }
        });
    });
    $('#sendChatBtn').on('click', function() {
        const message = $('#chatMessage').val().trim();
        if (!message) return;

        $.ajax({
            url: sendChatUrl,
            type: 'POST',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            data: {
                rfq_id: currentRfqId,
                buyer_id: currentBuyerId,
                message: message
            },
            success: function(res) {
                if (res.status === 'success') {
                    appendMessage({
                        sender_id: currentUserId,
                        message: message,
                        created: new Date().toISOString()
                    });
                    $('#chatMessage').val('');
                    scrollToBottom();
                } else {
                    alert(res.error || 'Send failed');
                }
            },
            error: function(xhr, status, error) {
                alert('Send error: ' + error);
            }
        });
    });
</script>

<script>
    let get_rfq_list_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'index']) ?>";
    let edit_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'edit']) ?>";
    let view_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'view']) ?>";
    let copy_rfq_url = "<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'copy']) ?>";
</script>

<?= $this->Html->script('portal/rfq_index.js') ?>