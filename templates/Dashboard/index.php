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
                                                    <div class="chart-widget mb-2">
                                                        <div id="radialbar"></div>
                                                    </div>
                                                    <div class="row items-align-center">
                                                        <div class="col-4 text-center">
                                                            <p class="text-muted mb-1">Cost</p>
                                                            <h6 class="mb-1">$1,823</h6>
                                                            <p class="text-muted mb-0">+12%</p>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <p class="text-muted mb-1">Revenue</p>
                                                            <h6 class="mb-1">$6,830</h6>
                                                            <p class="text-muted mb-0">+8%</p>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <p class="text-muted mb-1">Earning</p>
                                                            <h6 class="mb-1">$4,830</h6>
                                                            <p class="text-muted mb-0">+8%</p>
                                                        </div>
                                                    </div>
                                                </div> <!-- .card-body -->
                                            </div> <!-- .card -->
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card shadow eq-card mb-4">
                                                <div class="card-body">
                                                    <div class="d-flex mt-3 mb-4">
                                                        <div class="flex-fill pt-2">
                                                            <p class="mb-0 text-muted">Total</p>
                                                            <h4 class="mb-0">108</h4>
                                                            <span class="small text-muted">+37.7%</span>
                                                        </div>
                                                        <div class="flex-fill chart-box mt-n2">
                                                            <div id="barChartWidget"></div>
                                                        </div>
                                                    </div> <!-- .d-flex -->
                                                    <div class="row border-top">
                                                        <div class="col-md-6 pt-4">
                                                            <h6 class="mb-0">108 <span class="small text-muted">+37.7%</span></h6>
                                                            <p class="mb-0 text-muted">Cost</p>
                                                        </div>
                                                        <div class="col-md-6 pt-4">
                                                            <h6 class="mb-0">1168 <span class="small text-muted">-18.9%</span></h6>
                                                            <p class="mb-0 text-muted">Revenue</p>
                                                        </div>
                                                    </div> <!-- .row -->
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
                                    <div class="row">
                                        <!-- Recent Activity -->
                                        <div class="col-md-12 col-lg-4 mb-4">
                                            <div class="card timeline shadow">
                                                <div class="card-header">
                                                    <strong class="card-title">Recent Activity</strong>
                                                    <a class="float-right small text-muted" href="#!">View all</a>
                                                </div>
                                                <div class="card-body" data-simplebar style="height:355px; overflow-y: auto; overflow-x: hidden;">
                                                    <h6 class="text-uppercase text-muted mb-4">Today</h6>
                                                    <div class="pb-3 timeline-item item-primary">
                                                        <div class="pl-5">
                                                            <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted small mx-2">Just create new layout Index, form, table</span><strong>Tiny Admin</strong></div>
                                                            <p class="small text-muted">Creative Design <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pb-3 timeline-item item-warning">
                                                        <div class="pl-5">
                                                            <div class="mb-3"><strong>@Hester Nissim</strong><span class="text-muted small mx-2">has upload new files to</span><strong>Tiny Admin</strong></div>
                                                            <div class="row mb-3">
                                                                <div class="col"><img src="./assets/products/p1.jpg" alt="..." class="img-fluid rounded"></div>
                                                                <div class="col"><img src="./assets/products/p2.jpg" alt="..." class="img-fluid rounded"></div>
                                                                <div class="col"><img src="./assets/products/p3.jpg" alt="..." class="img-fluid rounded"></div>
                                                                <div class="col"><img src="./assets/products/p4.jpg" alt="..." class="img-fluid rounded"></div>
                                                            </div>
                                                            <p class="small text-muted">Front-End Development <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pb-3 timeline-item item-success">
                                                        <div class="pl-5">
                                                            <div class="mb-3"><strong>@Kelley Sonya</strong><span class="text-muted small mx-2">has commented on</span><strong>Advanced table</strong></div>
                                                            <div class="card d-inline-flex mb-2">
                                                                <div class="card-body bg-light py-2 px-3 small rounded"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim nulla eu quam cursus placerat. Vivamus non odio ullamcorper, lacinia ante nec, blandit leo. </div>
                                                            </div>
                                                            <p class="small text-muted">Back-End Development <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="text-uppercase text-muted mb-4">Yesterday</h6>
                                                    <div class="pb-3 timeline-item item-warning">
                                                        <div class="pl-5">
                                                            <div class="mb-3"><strong>@Fletcher Everett</strong><span class="text-muted small mx-2">created new group for</span><strong>Tiny Admin</strong></div>
                                                            <ul class="avatars-list mb-3">
                                                                <li>
                                                                    <a href="#!" class="avatar avatar-sm">
                                                                        <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-1.jpg">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#!" class="avatar avatar-sm">
                                                                        <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-4.jpg">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#!" class="avatar avatar-sm">
                                                                        <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-3.jpg">
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <p class="small text-muted">Front-End Development <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pb-3 timeline-item item-success">
                                                        <div class="pl-5">
                                                            <div class="mb-3"><strong>@Bertha Ball</strong><span class="text-muted small mx-2">has commented on</span><strong>Advanced table</strong></div>
                                                            <div class="card d-inline-flex mb-2">
                                                                <div class="card-body bg-light py-2 px-3"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim nulla eu quam cursus placerat. Vivamus non odio ullamcorper, lacinia ante nec, blandit leo. </div>
                                                            </div>
                                                            <p class="small text-muted">Back-End Development <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pb-3 timeline-item item-danger">
                                                        <div class="pl-5">
                                                            <div class="mb-3"><strong>@Lillith Joseph</strong><span class="text-muted small mx-2">has upload new files to</span><strong>Tiny Admin</strong></div>
                                                            <div class="row mb-3">
                                                                <div class="col"><img src="./assets/products/p4.jpg" alt="..." class="img-fluid rounded"></div>
                                                                <div class="col"><img src="./assets/products/p1.jpg" alt="..." class="img-fluid rounded"></div>
                                                                <div class="col"><img src="./assets/products/p2.jpg" alt="..." class="img-fluid rounded"></div>
                                                            </div>
                                                            <p class="small text-muted">Front-End Development <span class="badge badge-light">1h ago</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div> <!-- / .card-body -->
                                            </div> <!-- / .card -->
                                        </div> <!-- / .col-md-6 -->
                                        <!-- Striped rows -->
                                        <div class="col-md-12 col-lg-8">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <strong class="card-title">Recent Data</strong>
                                                    <a class="float-right small text-muted" href="#!">View all</a>
                                                </div>
                                                <div class="card-body my-n2">
                                                    <table class="table table-striped table-hover table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Address</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>2474</td>
                                                                <th scope="col">Brown, Asher D.</th>
                                                                <td>Ap #331-7123 Lobortis Avenue</td>
                                                                <td>13/09/2020</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-muted sr-only">Action</span>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Remove</a>
                                                                            <a class="dropdown-item" href="#">Assign</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2786</td>
                                                                <th scope="col">Leblanc, Yoshio V.</th>
                                                                <td>287-8300 Nisl. St.</td>
                                                                <td>04/05/2019</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-muted sr-only">Action</span>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr2">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Remove</a>
                                                                            <a class="dropdown-item" href="#">Assign</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2747</td>
                                                                <th scope="col">Hester, Nissim L.</th>
                                                                <td>4577 Cras St.</td>
                                                                <td>04/06/2019</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-muted sr-only">Action</span>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Remove</a>
                                                                            <a class="dropdown-item" href="#">Assign</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2639</td>
                                                                <th scope="col">Gardner, Leigh S.</th>
                                                                <td>P.O. Box 228, 7512 Lectus Ave</td>
                                                                <td>04/08/2019</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-muted sr-only">Action</span>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr4">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Remove</a>
                                                                            <a class="dropdown-item" href="#">Assign</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2238</td>
                                                                <th scope="col">Higgins, Uriah L.</th>
                                                                <td>Ap #377-5357 Sed Road</td>
                                                                <td>04/01/2019</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-muted sr-only">Action</span>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr5">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Remove</a>
                                                                            <a class="dropdown-item" href="#">Assign</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> <!-- Striped rows -->
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
<?= $this->Html->script('portal/dashboard_index.js') ?>

