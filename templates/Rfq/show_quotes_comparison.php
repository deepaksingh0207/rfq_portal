<style>
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

    .container-fluid {
        padding: 0px!important;
    }
</style>

<?php 
$th_html = '';
$quotes_tr_html = '';
$quantity_tr_html = '';
$rate_per_unit_tr_html = "";
$sub_total_tr_html = "";
$discount_tr_html = "";
$freight_tr_html = "";
$tax_tr_html = "";
$total_tr_html = "";
$delivery_date_tr_html = "";
$actions_tr_html = "";
// dd($data_for_comparison);

$incr = 1;
$temp = json_decode(json_encode($data_for_comparison) , true);
$unit_price_arr = (array_column($temp , 'unit_price'));
sort($unit_price_arr);

foreach($data_for_comparison as $user_id => $dfc) {
    $class = '';
    if($unit_price_arr[0] == $dfc->unit_price) {
        $class = "class = 'selected-column'";
    }

    $th_html .= '<th style="min-width: 200px;" colspan="1" '.$class.' >
        <div class="text-left">
            <span class="vendor-title">'.$dfc->vendor_name.'</span><br>
            <small>Email : '.$dfc->vendor_email.'</small>
        </div>
    </th>'; 

    $quotes_tr_html .= '<td '.$class.'>Quote #'.$incr.'</td>';

    $quantity_tr_html .= "<td $class >$rfq_footer_data->quantity</td>";

    $rate_per_unit_tr_html .= "<td $class >$dfc->unit_price</td>";

    $sub_total_tr_html .= "<td $class >$dfc->line_total</td>";
    
    $discount_tr_html .= "<td $class >$dfc->discount_amount</td>";
    
    $freight_tr_html .= "<td $class >$dfc->freight_value</td>";

    $tax_tr_html .= "<td $class >$dfc->tax_value</td>";

    $total_tr_html .= "<td $class >$dfc->total_amount</td>";

    $delivery_date_tr_html .= "<td $class >".date('d M, Y' , strtotime($dfc->delivery_date))."</td>";

    $actions_tr_html .= "<td $class ><input type='checkbox' class='quotes-checkbox' value='$dfc->rfq_quote_revision_id'></td>";

    $incr++;
}

?>

<div class="container-fluid">
    <div class="quote-header p-3 mb-1">
        <div class="row">
            <div class="col-md-3">
                <small class="text-muted d-block">RFQ No</small>
                <strong># <?= $rfq_header_data->rfq_number ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Item No</small>
                <strong><?= $rfq_footer_data->item_no ?? 'N/A' ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Material Code</small>
                <strong><?= ltrim($rfq_footer_data->material_code , 0) ?? 'N/A' ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Material Description</small>
                <strong><?= $rfq_footer_data->material_description ?? 'N/A' ?></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <small class="text-muted d-block">Make</small>
                <strong><?= $rfq_footer_data->make ?? 'N/A' ?></strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Model</small>
                <strong><?= $rfq_footer_data->model ?? 'N/A' ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Specifications</small>
                <strong><?= $rfq_footer_data->specification ?? 'N/A' ?></strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Quantity</small>
                <strong><?= $rfq_footer_data->quantity." ".$rfq_footer_data->uom ?></strong>
            </div>
            <div class="col-md-2">
                <small class="text-muted d-block">Plant Location</small>
                <strong><?= $rfq_footer_data->plant ?? 'N/A' ?></strong>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white text-center">
            <thead>
                <tr>
                    <th class="sticky-col text-left" style="min-width: 200px; color:black">Item Details</th>
                    <?= $th_html ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <?= $quotes_tr_html ?>

                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Quantity</td>
                    <?= $quantity_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Rate per Unit</td>
                    <?= $rate_per_unit_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Sub Total</td>
                    <?= $sub_total_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Discount</td>
                    <?= $discount_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Freight</td>
                    <?= $freight_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Tax</td>
                    <?= $tax_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Total</td>
                    <?= $total_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left font-weight-bold">Delivery Date</td>
                    <?= $delivery_date_tr_html ?>
                </tr>
                <tr>
                    <td class="sticky-col text-left action-cell font-weight-bold">Actions</td>
                    <?= $actions_tr_html ?>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-outline-primary mr-2">Resubmit Quote</button>
        <button class="btn btn-primary">Send For Approval</button>
    </div>
</div>

<?= $this->Html->script('portal/rfq_show_quotes_comparison.js') ?>