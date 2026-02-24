<div class="card border-0 shadow-sm p-4 mb-1">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h5 class="font-weight-bold">RFQ-<?= $rfq_header_data->rfq_number ?></h5>
        <button class="btn btn-outline-primary btn-sm px-3 shadow-none" style="color: #004a80; border-color: #004a80;">
            <i class="fas fa-copy mr-1"></i> Copy
        </button>
    </div>

    <div class="row">
        <div class="col-md-3 mb-1">
            <small class="text-muted d-block">PR No</small>
            <span class="font-weight-bold"><?= "N/A" ?></span>
        </div>

        <div class="col-md-3 mb-1">
            <small class="text-muted d-block">RFQ Type</small>
            <span class="font-weight-bold"><?= ucwords($rfq_header_data->rfq_type) ?></span>
        </div>
        
        <div class="col-md-3 mb-1">
            <small class="text-muted d-block">Quoatation Deadline</small>
            <span class="font-weight-bold"><?= date("d M, Y" , strtotime($rfq_header_data->quotation_deadline)) ?></span>
        </div>
    </div>
</div>
<div class="card border-0 shadow-sm p-4 mb-1">

    <div class="d-flex justify-content-between align-items-start mb-1">
        <h5 class="text-primary font-weight-bold">Item Details</h5>
    </div>
    <div class="row">
        <div class="table-responsive shadow-sm rounded border">
            <table class="table table-hover mb-0">
                <thead style="background-color: #004a80; color: white;">
                    <tr>
                        <th class="border-0">Category</th>
                        <th class="border-0">Item No</th>
                        <th class="border-0">Material Code</th>
                        <th class="border-0">Material Description</th>
                        <th class="border-0">Quantity</th>
                        <th class="border-0">Delivery Date</th>
                        <th class="border-0">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach($rfq_footer_data as $rfd) : ?>
                        <tr>
                            <td><?= $rfd->category_name ?? 'N/A' ?></td>
                            <td><?= $rfd->item_no ?? 'N/A' ?></td>
                            <td><?= ltrim($rfd->material_code , '0') ?></td>
                            <td><?= $rfd->material_description ?></td>
                            <td><?= $rfd->quantity." ".$rfd->uom ?></td>
                            <td><?= date("d M, Y" ,strtotime($rfd->delivery_date)) ?></td>
                            <td>
                                <a class = 'btn btn-link' href = '<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'item-view' , $rfd->id] ) ?>'>
                                    <i class="fe fe-file"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>