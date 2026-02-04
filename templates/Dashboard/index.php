<?= $this->Html->css('portal/dashboard_index.css') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h5 page-title">Performance Dashboard</h2>
                </div>
                <div class="col-auto">
                    <select class="form-control select2" id="plant-select">
                        <option value="">-- Select Plant Here --</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-control select2" id="buyer-select">
                        <option value="">-- Select Buyer Here --</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                <div class="col-md-12 mb-4">
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
                                    <div class="mb-2 align-items-center">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-2 mb-4">
                                                <div class="card shadow h-100">
                                                    <div class="card-body d-flex flex-column justify-content-between">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Total Spend</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2 text-white ml-2" viewBox="0 0 16 16">
                                                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                                                </svg>
                                                            </span>
                                                        </div>

                                                        <br>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹44,931.68L</h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-4 mb-4">
                                                <div class="card shadow h-100">
                                                    <div class="card-body d-flex flex-column justify-content-between">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Today's PRs</span>
                                                            <span>Total PRs</span>
                                                            <span>PO Converted</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-edit text-white"></i>
                                                            </span>
                                                        </div>

                                                        <br>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h4 class="mb-0">0</h4>
                                                            <h4 class="mb-0 ml-4">34,944</h4>
                                                            <h4 class="mb-0">31,282</h4>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 mb-4">
                                                <div class="card shadow h-100">
                                                    <div class="card-body d-flex flex-column justify-content-between">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span>Savings @LPO</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-dollar-sign text-white"></i>
                                                            </span>
                                                        </div>

                                                        <br>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹4,487.50L</h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 mb-4">
                                                <div class="card shadow h-100">
                                                    <div class="card-body d-flex flex-column justify-content-between">

                                                        <!-- TOP ROW -->
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <span style="font-size: 13px;">Cost Avoidance</span>
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-16 fe-file-text text-white"></i>
                                                            </span>
                                                        </div>

                                                        <br>

                                                        <!-- BOTTOM ROW -->
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <h6 class="mb-0">₹44,931.68L</h6>
                                                            <i class="fe fe-24 fe-arrow-right"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 mb-4">
                                                <div class="card shadow h-100">
                                                    <div class="row mt-4">
                                                        <div class="col-6 text-center">
                                                            <div class="circle circle-md bg-light">
                                                                <span class="fe fe-monitor fe-24 text-muted"></span>
                                                            </div>
                                                            <div class="mt-2">
                                                                <strong style="font-size: 10px;">Alerts</strong><br>
                                                                <span class="my-0 text-muted small">(5)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <div class="circle circle-md bg-light">
                                                                <span class="fe fe-alert-triangle fe-24 text-muted"></span>
                                                            </div>
                                                            <div class="mt-2">
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
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <div id="prStatusChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body">
                                                    <div id="prAgingChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body">
                                                    <h5 class="font-weight-bold mb-4">Award Status</h5>
                                                    <!-- Under Approval -->
                                                    <div class="mb-4">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Under Approval</span>
                                                            <span class="font-weight-bold">₹ 6,192.90L</span>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-primary" style="width: 70%"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <span>1145</span>
                                                            <span>1631 PRs</span>
                                                        </div>
                                                    </div>

                                                    <!-- Pending for PO -->
                                                    <div class="mb-4">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Pending for PO</span>
                                                            <span class="font-weight-bold">₹ 827.88L</span>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-warning" style="width: 55%"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <span>87</span>
                                                            <span>157 PRs</span>
                                                        </div>
                                                    </div>

                                                    <!-- PO Created -->
                                                    <div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>PO Created</span>
                                                            <span class="font-weight-bold">₹ 44,931.68L</span>
                                                        </div>

                                                        <div class="progress my-2" style="height: 8px;">
                                                            <div class="progress-bar bg-success" style="width: 85%"></div>
                                                        </div>

                                                        <div class="d-flex justify-content-between text-muted small">
                                                            <span>20006</span>
                                                            <span>31,282 PRs</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row items-align-baseline">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <h6 class="mb-3 font-weight-bold">PO Created</h6>

                                                        <div class="row">

                                                            <!-- Card -->
                                                            <div class="col-md-3 mb-3">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold mb-3">Via ARC</h6>

                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0">1,606</div>
                                                                                <small class="text-success">(5.13%)</small>
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0">₹ 4,519.72L</div>
                                                                                <small class="text-success">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Repeat cards -->
                                                            <div class="col-md-3 mb-3">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold mb-3">Via RFx / Auction</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0">1,606</div>
                                                                                <small class="text-success">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0">₹ 4,519.72L</div>
                                                                                <small class="text-success">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-3 mb-3">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold mb-3">Via ERP</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0">1,606</div>
                                                                                <small class="text-success">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0">₹ 4,519.72L</div>
                                                                                <small class="text-success">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->

                                                            <!-- Second row -->
                                                            <div class="col-md-3 mb-3">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold mb-3">Via Repeat PO</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0">1,606</div>
                                                                                <small class="text-success">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0">₹ 4,519.72L</div>
                                                                                <small class="text-success">(10.06%)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 mb-3">
                                                                <div class="card h-100 border-primary shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="font-weight-bold mb-3">Via Standalone</h6>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <div class="h6 mb-0">1,606</div>
                                                                                <small class="text-success">(5.13%)</small>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <div class="h6 text-primary mb-0">₹ 4,519.72L</div>
                                                                                <small class="text-success">(10.06%)</small>
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
                                    <div class="row items-align-baseline">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="mb-0 font-weight-bold">Spend By Category</h6>
                                                        <span class="circle circle-sm bg-primary text-white">
                                                            <i class="fe fe-arrow-right"></i>
                                                        </span>
                                                    </div>

                                                    <div id="spendCategoryTree" style="width:100%; height:420px;"></div>

                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <div id="cycleTimeChart" style="width:100%; height:320px;"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <h6 class="font-weight-bold mb-3">RFQ Status</h6>

                                                    <!-- Published -->
                                                    <div class="mb-3">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Published</span>
                                                        </div>
                                                        <div class="progress mt-1">
                                                            <div class="progress-bar bg-success" style="width: 62%"></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-1 small font-weight-bold">
                                                            <span>5</span>
                                                            <span>8 PRs</span>
                                                        </div>
                                                    </div>

                                                    <!-- Closed -->
                                                    <div class="mb-3">
                                                        <span>Closed</span>
                                                        <div class="progress mt-1">
                                                            <div class="progress-bar bg-danger" style="width: 55%"></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-1 small font-weight-bold">
                                                            <span>323</span>
                                                            <span>582 PRs</span>
                                                        </div>
                                                    </div>

                                                    <!-- Technical Approval Pending -->
                                                    <div class="mb-3">
                                                        <span>Technical Approval Pending</span>
                                                        <div class="progress mt-1">
                                                            <div class="progress-bar bg-primary" style="width: 68%"></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-1 small font-weight-bold">
                                                            <span>59</span>
                                                            <span>87 PRs</span>
                                                        </div>
                                                    </div>

                                                    <!-- Technically Approved -->
                                                    <div>
                                                        <span>Technically Approved - Action Pending</span>
                                                        <div class="progress mt-1">
                                                            <div class="progress-bar bg-warning" style="width: 78%"></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-1 small font-weight-bold">
                                                            <span>128</span>
                                                            <span>226 PRs</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row items-align-baseline">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <h6 class="font-weight-bold mb-3">Contract Expiry</h6>
                                                    <div id="contractExpiryChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <h6 class="font-weight-bold mb-3">Spend By Award Type</h6>
                                                    <div id="awardTypeChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body mb-n3">
                                                    <h6 class="font-weight-bold mb-3">Spend By Award Category</h6>
                                                    <div id="awardCategoryChart"></div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                    </div>
                                    <div class="row row items-align-baseline">
                                        <!-- Spend by Supplier -->
                                        <div class="col-md-12 col-lg-6">
                                            <div class="card shadow spend-card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="font-weight-bold mb-0">Spend by Supplier</h6>
                                                        <span class="circle-icon">
                                                            <i class="fe fe-arrow-right"></i>
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
                                        <div class="col-md-12 col-lg-6">
                                            <div class="card shadow spend-card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="font-weight-bold mb-0">Spend by Items</h6>
                                                        <span class="circle-icon">
                                                            <i class="fe fe-arrow-right"></i>
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

<?= $this->Html->script('config.js') ?>
<?= $this->Html->script('apexcharts.min.js') ?>
<?= $this->Html->script('apexcharts.custom.js') ?>
<?= $this->Html->script("echarts.min.js") ?>
<?= $this->Html->script('portal/dashboard_index.js') ?>