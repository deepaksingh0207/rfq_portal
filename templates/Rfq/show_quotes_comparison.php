<style>
    body {
        background-color: #f8f9fa;
        font-size: 0.85rem;
    }

    .quote-header {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }

    .table-comparison thead th {
        background-color: #f1f3f5;
        border-bottom: 2px solid #dee2e6;
    }

    .selected-column {
        background-color: #d4edda !important;
        border: 2px solid #28a745 !important;
    }

    .vendor-title {
        font-weight: bold;
        color: #333;
    }

    .sticky-col {
        position: sticky;
        left: 0;
        background: #f8f9fa;
        z-index: 2;
        border-right: 1px solid #dee2e6;
    }

    .action-cell {
        background: #e9ecef;
    }
</style>

<div class="container-fluid py-4">
    <div class="quote-header p-3 mb-1">
        <div class="row">
            <div class="col-md-3">
                <small class="text-muted d-block">RFQ No</small>
                <strong>#17112536542</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Item No</small>
                <strong>10</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Material Code</small>
                <strong>10</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Material Description</small>
                <strong>Test Material Description</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <small class="text-muted d-block">Make</small>
                <strong>MAT-458-7892</strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Model</small>
                <strong>Hydraulic Pump — Type B</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Specifications</small>
                <strong>Industrial Hydraulic Pump — Type B</strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Quantity</small>
                <strong>50 Units</strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Plant Location</small>
                <strong>Pune — MH Plant 03</strong>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white text-center">
            <thead>
                <tr>
                    <th class="sticky-col text-left" style="min-width: 200px;">Item Details</th>
                    <th style="min-width: 200px;" colspan="1">
                        <div class="text-left">
                            <span class="vendor-title">Bharati Industries Ltd.</span><br>
                            <small>Contact: Ramesh Patel<br>Mobile: +91 98765 43210</small>
                        </div>
                    </th>
                    <th colspan="1" class="selected-column">
                        <div class="text-left">
                            <span class="vendor-title">Bharat Industries Ltd.</span><br>
                            <small>Contact: Ramesh Patel<br>Mobile: +91 98765 43210</small>
                        </div>
                    </th>
                    <th colspan="1">
                        <div class="text-left">
                            <span class="vendor-title">Bharat1 Industries Ltd.</span>
                            <small class="d-block">Contact: Ramesh Patel</small>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Quote #1</td>
                    <td class="selected-column">Quote #2</td>
                    <td class="d-none">Quote #1</td>
                    <td>Quote #3</td>
                    <td class="d-none">Quote #2</td>
                    <td class="d-none">Quote #1</td>

                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Quantity</td>
                    <td>50</td>
                    <td class="selected-column">50</td>
                    <td class="d-none">50</td>
                    <td >50</td>
                    <td class="d-none">50</td>
                    <td class="d-none">50</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Rate per Unit</td>
                    <td>₹ 4,800</td>
                    <td class="selected-column">₹ 4,200</td>
                    <td class="d-none">₹ 4,450</td>
                    <td>₹ 4,450</td>
                    <td class="d-none">₹ 4,450</td>
                    <td class="d-none">₹ 4,450</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Sub Total</td>
                    <td>₹ 12,00,000</td>
                    <td class="selected-column">₹ 10,50,000</td>
                    <td class="d-none">₹ 11,12,500</td>
                    <td >₹ 10,50,000</td>
                    <td class="d-none">₹ 10,50,000</td>
                    <td class="d-none">₹ 11,12,500</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Discount</td>
                    <td class="text-danger">- ₹ 24,000 (2%)</td>
                    <td class="selected-column text-danger">- ₹ 52,500 (5%)</td>
                    <td class="text-danger d-none">- ₹ 33,375 (3%)</td>
                    <td>- ₹ 52,500</td>
                    <td class="d-none">- ₹ 33,375</td>
                    <td class="d-none">- ₹ 33,375</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Freight</td>
                    <td class="font-weight-bold">₹ 13,87,680</td>
                    <td class="selected-column font-weight-bold">₹ 11,77,050</td>
                    <td class="font-weight-bold d-none">₹ 12,73,368</td>
                    <td>₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Tax</td>
                    <td class="font-weight-bold">₹ 13,87,680</td>
                    <td class="selected-column font-weight-bold">₹ 11,77,050</td>
                    <td class="font-weight-bold d-none">₹ 12,73,368</td>
                    <td>₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Total</td>
                    <td class="font-weight-bold">₹ 13,87,680</td>
                    <td class="selected-column font-weight-bold">₹ 11,77,050</td>
                    <td class="font-weight-bold d-none">₹ 12,73,368</td>
                    <td>₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                    <td class="d-none">₹ 11,77,050</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Delivery Date</td>
                    <td>28 Mar 2026</td>
                    <td class="selected-column">10 Mar 2026</td>
                    <td class="d-none">10 Mar 2026</td>
                    <td >10 Mar 2026</td>
                    <td class="d-none">10 Mar 2026</td>
                    <td class="d-none">10 Mar 2026</td>
                </tr>
                <tr>
                    <td class="sticky-col text-left action-cell font-weight-bold">Actions</td>
                    <td><input type="checkbox"></td>
                    <td class="selected-column"><input type="checkbox" checked></td>
                    <td class="d-none"><input type="checkbox"></td>
                    <td><input type="checkbox"></td>
                    <td class="d-none"><input type="checkbox"></td>
                    <td class="d-none"><input type="checkbox"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-outline-primary mr-2">Resubmit Quote</button>
        <button class="btn btn-primary">Send For Approval</button>
    </div>
</div>