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
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:40px;">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>PR No</th>
                            <th>Item No</th>
                            <th>Material Code</th>
                            <th>Material Description</th>
                            <th class="text-right">Quantity</th>
                            <th>UOM</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Row 1 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="pr-item-checkbox"
                                    data-pr="PR1001"
                                    data-item="00010"
                                    data-material="MAT-001"
                                    data-qty="10">
                            </td>
                            <td>PR1001</td>
                            <td>00010</td>
                            <td>MAT-001</td>
                            <td>Steel Bolt M10</td>
                            <td class="text-right">10</td>
                            <td>EA</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="pr-item-checkbox"
                                    data-pr="PR1002"
                                    data-item="00020"
                                    data-material="MAT-001"
                                    data-qty="15">
                            </td>
                            <td>PR1002</td>
                            <td>00020</td>
                            <td>MAT-001</td>
                            <td>Steel Bolt M10</td>
                            <td class="text-right">15</td>
                            <td>EA</td>
                        </tr>

                        <!-- Row 3 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="pr-item-checkbox"
                                    data-pr="PR1003"
                                    data-item="00010"
                                    data-material="MAT-005"
                                    data-qty="5">
                            </td>
                            <td>PR1003</td>
                            <td>00010</td>
                            <td>MAT-005</td>
                            <td>Industrial Lubricant</td>
                            <td class="text-right">5</td>
                            <td>LTR</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->Html->script('portal/purchase_requisitions_index.js') ?>