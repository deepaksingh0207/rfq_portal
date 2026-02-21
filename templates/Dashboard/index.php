<?= $this->Html->css('portal/dashboard_index.css') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-1">
                <div class="col">
                    <h2 class="h5 page-title">Performance Dashboard</h2>
                </div>
                <div class="col-auto">
                    <select class="form-control select2" id="plant-select">
                        <option value="">-- Select Plant Here --</option>
                        <?php foreach ($plant_list as $plant_code => $plant_name) : ?>
                            <option value="<?= $plant_code ?>"><?= $plant_code ?> - <?= $plant_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-control select2" id="buyer-select">
                        <option value="">-- Select Buyer Here --</option>
                        <?php foreach ($buyer_list as $buyer_code => $buyer_name) : ?>
                            <option value="<?= $buyer_code ?>"><?= $buyer_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="reportrange" class="sr-only">Date Ranges</label>
                    <div id="reportrange" class="border px-2 py-2" style="background-color: white;color:black">
                        <i class="fe fe-calendar fe-16 mx-2"></i>
                        <span></span>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-info">Reset Filters</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div class="accordion w-100" id="accordion1">
                        <div class="card shadow">
                            <div class="card-header" id="heading1">
                                <button class="btn btn-link w-100 text-start d-flex align-items-center justify-content-between collapsed"
                                    data-toggle="collapse"
                                    data-target="#collapse1"
                                    aria-expanded="false"
                                    aria-controls="collapse1">
                                    <strong>Metric #1</strong>
                                    <i class="fe fe-chevron-down accordion-icon"></i>
                                </button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="align-items-center">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-2">
                                                <div class="card shadow">
                                                    <div class="card-body">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Total Spend</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2 text-white ml-2" viewBox="0 0 16 16">
                                                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                                                </svg>
                                                            </span>
                                                        </div>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹ <?= $total_spend ?? 0 ?></h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card shadow">
                                                    <div class="card-body">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Today's PRs</span>
                                                            <span>Total PRs</span>
                                                            <span>PO Converted</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-edit text-white"></i>
                                                            </span>
                                                        </div>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0"><?= $today_pr_count ?? 0 ?></h6>
                                                            <h6 class="mb-0 ml-4"><?= $total_pr_count ?? 0 ?></h6>
                                                            <h6 class="mb-0"><?= $po_converted_from_pr ?? 0 ?></h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2">
                                                <div class="card shadow">
                                                    <div class="card-body">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Savings @LPO</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-dollar-sign text-white"></i>
                                                            </span>
                                                        </div>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹4,487.50L</h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2">
                                                <div class="card shadow">
                                                    <div class="card-body">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span style="font-size: 13px;">Cost Avoidance</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-file-text text-white"></i>
                                                            </span>
                                                        </div>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹44,931.68L</h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2">
                                                <div class="card shadow">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <div class="circle circle-md bg-light">
                                                                <span class="fe fe-monitor fe-24 text-muted"></span>
                                                            </div>
                                                            <div class="">
                                                                <strong style="font-size: 10px;">Alerts</strong><br>
                                                                <span class="my-0 text-muted small">(5)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <div class="circle circle-md bg-light">
                                                                <span class="fe fe-alert-triangle fe-24 text-muted"></span>
                                                            </div>
                                                            <div class="">
                                                                <strong style="font-size: 10px;">Notifications</strong><br>
                                                                <span class="my-0 text-muted small">(20)</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header" id="heading1">
                                <button class="btn btn-link w-100 text-start d-flex align-items-center justify-content-between collapsed"
                                    data-toggle="collapse"
                                    data-target="#collapse2"
                                    aria-expanded="false"
                                    aria-controls="collapse2">
                                    <strong>Metric #2</strong>
                                    <i class="fe fe-chevron-down accordion-icon"></i>
                                </button>
                            </div>
                            <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="row items-align-baseline">
                                        <div class="col-md-12 col-lg-2 col-padding">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold">PR Status</h6>
                                                    <div id="prStatusChart"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-2 col-padding">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold">PR Aging</h6>
                                                    <div id="prAgingChart"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-5 col-padding">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <h6 class="font-weight-bold">PO Created</h6>

                                                        <div class="row">

                                                            <!-- Card -->
                                                            <div class="col-md-6">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold">Via ARC</h6>

                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0" id="via_arc_count">1,606</div>
                                                                                <small class="h6 text-success" id="via_arc_percentage">(5.13%)</small>
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0" id="via_arc_total_value">₹ 4,519.72L</div>
                                                                                <small class="h6 text-success" id="via_arc_total_value_percentage">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Repeat cards -->
                                                            <div class="col-md-6">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold">Via RFx / Auction</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0" id="via_rfx_count">1,606</div>
                                                                                <small class="h6 text-success" id="via_rfx_percentage">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0" id="via_rfx_total_value">₹ 4,519.72L</div>
                                                                                <small class="h6 text-success" id="via_rfx_total_value_percentage">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Second row -->
                                                            <div class="col-md-6 mt-1">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold">Via Repeat PO</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0" id="via_repeat_po_count">1,606</div>
                                                                                <small class="h6 text-success" id="via_repeat_po_percentage">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0" id="via_repeat_po_total_value">₹ 4,519.72L</div>
                                                                                <small class="h6 text-success" id="via_repeat_po_total_value_percentage">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mt-1">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold">Via Standalone</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0" id="via_standalone_count">1,606</div>
                                                                                <small class="h6 text-success" id="via_standalone_percentage">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0" id="via_standalone_total_value">₹ 4,519.72L</div>
                                                                                <small class="h6 text-success" id="via_standalone_total_value_percentage">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>

                                        <div class="col-md-12 col-lg-3 col-padding">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold ">Award Status</h6>
                                                    <!-- Under Approval -->
                                                    <div class="mb-0">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Under Approval</h6>
                                                            <h6 class="font-weight-bold" id="award_status_under_approval_h_tag">₹ 6,192.90L</h6>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-primary" style="width: 70%" id="award_status_under_approval_progress_bar"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <h6 id="award_status_under_approval_pr_count">1145</h6>
                                                            <h6 id="award_status_under_approval_total_pr_count">1631 PRs</h6>
                                                        </div>
                                                    </div>

                                                    <!-- Pending for PO -->
                                                    <div class="mb-0">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Pending for PO</h6>
                                                            <h6 class="font-weight-bold" id="pending_po_h_tag">₹ 827.88L</h6>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-warning" style="width: 55%" id="pending_po_progress_bar"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <h6 id="pending_po_pr_count">87</h6>
                                                            <h6 id="pending_po_total_pr_count">157 PRs</h6>
                                                        </div>
                                                    </div>

                                                    <!-- PO Created -->
                                                    <div class="mb-0">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>PO Created</h6>
                                                            <h6 class="font-weight-bold" id="po_created_h_tag">₹ 44,931.68L</h6>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-success" style="width: 85%" id="po_created_progress_bar"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <h6 id="po_created_pr_count">20006</h6>
                                                            <h6 id="po_created_total_pr_count">31,282 PRs</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header" id="heading1">
                                <button class="btn btn-link w-100 text-start d-flex align-items-center justify-content-between collapsed"
                                    data-toggle="collapse"
                                    data-target="#collapse3"
                                    aria-expanded="false"
                                    aria-controls="collapse3">
                                    <strong>Metric #3</strong>
                                    <i class="fe fe-chevron-down accordion-icon"></i>
                                </button>
                            </div>
                            <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4 h-80 col-padding">
                                            <div class="card shadow mb-0">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="mb-0 font-weight-bold">Spend By Category</h6>
                                                        <span class="circle-icon">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </span>
                                                    </div>

                                                    <div id="spendCategoryTree" style="height:300px;"></div>

                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4 h-80 col-padding">
                                            <div class="card shadow mb-0">
                                                <div class="card-body">
                                                    <div id="cycleTimeChart" style="height:300px;"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4 h-80 col-padding">
                                            <div class="card shadow mb-0">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold">RFQ Status</h6>

                                                    <!-- Published -->
                                                    <div class="">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Published</h6>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar mt-1 bg-success" style="width: 62%"></div>
                                                        </div>
                                                        <div class="d-flex mt-1 justify-content-between small font-weight-bold">
                                                            <h6>5</h6>
                                                            <h6>8 RFQs</h6>
                                                        </div>
                                                    </div>

                                                    <!-- Closed -->
                                                    <div class="">
                                                        <h6>Closed</h6>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" style="width: 55%"></div>
                                                        </div>
                                                        <div class="d-flex mt-1 justify-content-between small font-weight-bold">
                                                            <h6>323</h6>
                                                            <h6>582 RFQs</h6>
                                                        </div>
                                                    </div>

                                                    <!-- Technical Approval Pending -->
                                                    <div class="">
                                                        <h6>Under Approval</h6>
                                                        <div class="progress">
                                                            <div class="progress-bar mt-1 bg-primary" style="width: 68%"></div>
                                                        </div>
                                                        <div class="d-flex mt-1 justify-content-between small font-weight-bold">
                                                            <h6>59</h6>
                                                            <h6>87 RFQs</h6>
                                                        </div>
                                                    </div>

                                                    <!-- Technically Approved -->
                                                    <div>
                                                        <h6>Draft</h6>
                                                        <div class="progress">
                                                            <div class="progress-bar mt-1 bg-warning" style="width: 78%"></div>
                                                        </div>
                                                        <div class="d-flex mt-1 justify-content-between small font-weight-bold">
                                                            <h6>128</h6>
                                                            <h6>226 RFQs</h6>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4 col-padding">
                                            <div class="card shadow h-100">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold mb-3">Contract Expiry</h6>
                                                    <div id="contractExpiryChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-padding">
                                            <div class="card shadow h-100">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold mb-3">Spend By Award Type</h6>
                                                    <div id="awardTypeChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-padding">
                                            <div class="card shadow h-100">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold mb-3">Spend By Award Category</h6>
                                                    <div id="awardCategoryChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <!-- Spend by Supplier -->
                                        <div class="col-md-12 col-lg-6 col-padding">
                                            <div class="card shadow spend-card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="font-weight-bold mb-0">Spend by Supplier</h6>
                                                        <span class="circle-icon">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </span>
                                                    </div>

                                                    <ul class="list-unstyled spend-list">
                                                        <li>
                                                            <span class="name">5000085 - VEEASSURE PRIVATE LIMITED</span>
                                                            <span class="percent">7.07%</span>
                                                            <span class="amount">₹3,176.09 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">3000762 - ALLIANZ ELASTOMER</span>
                                                            <span class="percent">5.71%</span>
                                                            <span class="amount">₹2,564.58 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">3000735 - KOTHARI METSOL PVT. LTD.</span>
                                                            <span class="percent">5.20%</span>
                                                            <span class="amount">₹2,335.94 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">3020649 - MIVAAN STEELS LIMITED</span>
                                                            <span class="percent">3.54%</span>
                                                            <span class="amount">₹1,591.43 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">3020750 - ELECTROSTEEL CASTINGS LTD</span>
                                                            <span class="percent">3.11%</span>
                                                            <span class="amount">₹1,398.66 L</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Spend by Items -->
                                        <div class="col-md-12 col-lg-6 col-padding">
                                            <div class="card shadow spend-card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="font-weight-bold mb-0">Spend by Items</h6>
                                                        <span class="circle-icon">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </span>
                                                    </div>

                                                    <ul class="list-unstyled spend-list">
                                                        <li>
                                                            <span class="name">11120090001 - ZINC WIRE-THICKNESS 4MM</span>
                                                            <span class="percent">7.07%</span>
                                                            <span class="amount">₹2,579.11 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">11120080001 - FERRO SILICON</span>
                                                            <span class="percent">5.71%</span>
                                                            <span class="amount">₹1,824.58 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">121800020097 - SILICO MANGANESE; 60-65%</span>
                                                            <span class="percent">5.20%</span>
                                                            <span class="amount">₹1,591.43 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">11120050003 - QUARTZITE</span>
                                                            <span class="percent">3.54%</span>
                                                            <span class="amount">₹510.80 L</span>
                                                        </li>
                                                        <li>
                                                            <span class="name">132080010202 - RESIN; MUDGUN MASS</span>
                                                            <span class="percent">3.11%</span>
                                                            <span class="amount">₹500.55 L</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-box fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Package has uploaded successfull</strong></small>
                                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                <small class="badge badge-pill badge-light text-muted">1m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-download fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Widgets are updated successfull</strong></small>
                                <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                <small class="badge badge-pill badge-light text-muted">2m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-link fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Link was attached to menu</strong></small>
                                <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                <small class="badge badge-pill badge-light text-muted">1h ago</small>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .list-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
            </div>
        </div>
    </div>
</div>

<script>
    let series_data_for_pr_status_chart = [<?= implode(",", array_values($pr_status)) ?>];
    let labels_for_pr_status_chart = [<?= implode(",", array_map(function ($val) {
                                            return "'$val'";
                                        }, array_keys($pr_status))) ?>];

    let series_data_for_pr_aging_chart = [<?= implode(",", array_values($pr_aging)) ?>];
    let labels_for_pr_aging_chart = [<?= implode(",", array_map(function ($val) {
                                            return "'$val'";
                                        }, array_keys($pr_aging))) ?>];
</script>

<?= $this->Html->script('config.js') ?>
<?= $this->Html->script('apexcharts.min.js') ?>
<?= $this->Html->script('apexcharts.custom.js') ?>
<?= $this->Html->script("echarts.min.js") ?>
<?= $this->Html->script('portal/dashboard_index.js') ?>