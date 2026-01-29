<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <?= $this->Html->css("feather.css") ?>
    <?= $this->Html->css("select2.css") ?>
    <?= $this->Html->css("dropzone.css") ?>
    <?= $this->Html->css("uppy.min.css") ?>
    <?= $this->Html->css("jquery.steps.css") ?>
    <?= $this->Html->css("jquery.timepicker.css") ?>
    <?= $this->Html->css("quill.snow.css") ?>

    <!-- Date Range Picker CSS -->
    <?= $this->Html->css("daterangepicker.css") ?>
    <!-- App CSS -->
    <?= $this->Html->css('app-light.css', ['id' => 'lightTheme']) ?>
    <?= $this->Html->css('app-dark.css', ['id' => 'darkTheme', 'disabled']) ?>

    <!-- JS -->
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('moment.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('simplebar.min.js') ?>
    <?= $this->Html->script('daterangepicker.js') ?>
    <?= $this->Html->script('jquery.stickOnScroll.js') ?>
    <?= $this->Html->script('tinycolor-min.js') ?>
    <?= $this->Html->script('config.js') ?>
    <?= $this->Html->script('d3.min.js') ?>
    <?= $this->Html->script('topojson.min.js') ?>
    <?= $this->Html->script('datamaps.all.min.js') ?>
    <?= $this->Html->script('datamaps-zoomto.js') ?>
    <?= $this->Html->script('datamaps.custom.js') ?>
    <?= $this->Html->script('Chart.min.js') ?>

    <?= $this->Html->script('gauge.min.js') ?>
    <?= $this->Html->script('jquery.sparkline.min.js') ?>
    <?= $this->Html->script('apexcharts.min.js') ?>
    <?= $this->Html->script('apexcharts.custom.js') ?>
    <?= $this->Html->script('jquery.mask.min.js') ?>
    <?= $this->Html->script('select2.min.js') ?>
    <?= $this->Html->script('jquery.steps.min.js') ?>
    <?= $this->Html->script('jquery.validate.min.js') ?>
    <?= $this->Html->script('jquery.timepicker.js') ?>
    <?= $this->Html->script('dropzone.min.js') ?>
    <?= $this->Html->script('uppy.min.js') ?>
    <?= $this->Html->script('quill.min.js') ?>
</head>

<body class="horizontal light  ">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
            <div class="container-fluid px-0">
                <a class="navbar-brand mx-lg-1 mr-0" href="./index.html">
                    <?= $this->Html->image('jbm_logo.png', ['style' => 'width:30%']) ?>
                </a>
                <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                    <i class="fe fe-menu navbar-toggler-icon"></i>
                </button>
                <div class="navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
                    <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                        <i class="fe fe-x"><span class="sr-only"></span></i>
                    </a>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Dashboard</span>
                                <!-- <span class="badge badge-pill badge-primary">New</span> -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Requisitions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Events</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Awards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Contracts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <span class="ml-lg-2">Supplier</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <form class="form-inline ml-md-auto d-none d-lg-flex searchform text-muted">
                    <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
                </form>
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item">
                        <a class="nav-link text-muted my-2" href="./#" id="modeSwitcher" data-mode="light">
                            <i class="fe fe-sun fe-16"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                            <i class="fe fe-grid fe-16"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-notif">
                        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                            <i class="fe fe-bell fe-16"></i>
                            <span class="dot dot-md bg-success"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown ml-lg-0">
                        <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar avatar-sm mt-2">
                                <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="<?= $this->Url->build(['controller' => 'users' , 'action' => 'logout']) ?>">Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="main-content mt-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h2 class="h5 page-title">Performance Dashboard!</h2>
                            </div>
                            <div class="col-auto">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <!-- <label for="custom-select">Custom Select</label> -->
                                        <select class="custom-select" id="custom-select">
                                            <option selected="">Select plant here</option>
                                            <option value="1">Plant 1</option>
                                            <option value="2">Plant 2</option>
                                            <option value="3">Plant 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="custom-select">Custom Select</label> -->
                                        <select class="custom-select" id="custom-select">
                                            <option selected="">Select buyer here</option>
                                            <option value="1">Buyer 1</option>
                                            <option value="2">Buyer 2</option>
                                            <option value="3">Buyer 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-none d-lg-inline">
                                        <label for="reportrange" class="sr-only">Date Ranges</label>
                                        <div id="reportrange" class="px-2 py-2 text-muted">
                                            <span class="small"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                                        <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xl-2 mb-3 pr-0">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <span class="card-title">Total Spend</span>
                                        <a class="float-right small text-muted" href="#!"><i class="fe fe-more-vertical fe-12"></i></a>
                                    </div>
                                    <div class="card-body my-n2">
                                        <div class="d-flex">
                                            <div class="flex-fill">
                                                <h4 class="h6 mb-0">Rs. 4,66,764.78L</h4>
                                            </div>
                                            <div class="flex-fill text-right">
                                                <!-- <p class="mb-0 small">+20%</p> -->
                                                <p class="mb-0 small">Till Now</p>
                                            </div>
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                            <div class="col-md-6 col-xl-4 mb-3 pr-0">
                                <div class="card d-flex flex-row shadow">
                                    <div>
                                        <div class="card-header">
                                            <span class="card-title">Today's PR</span>
                                        </div>
                                        <div class="card-body my-n2">
                                            <div class="d-flex">
                                                <div class="flex-fill">
                                                    <h4 class="h6 mb-0">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="card-header">
                                            <span class="card-title">Total PR</span>
                                        </div>
                                        <div class="card-body my-n2">
                                            <div class="d-flex">
                                                <div class="flex-fill">
                                                    <h4 class="h6 mb-0">32546</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="card-header">
                                            <span class="card-title">PO Converted</span>
                                        </div>
                                        <div class="card-body my-n2">
                                            <div class="d-flex">
                                                <div class="flex-fill">
                                                    <h4 class="h6 mb-0">31282</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-2 mb-3 pr-0">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <span class="card-title">Savings @LPO</span>
                                    </div>
                                    <div class="card-body my-n2">
                                        <div class="d-flex">
                                            <div class="flex-fill">
                                                <h4 class="h6 mb-0">Rs. 4,66,764.78L</h4>
                                            </div>
                                            <div class="flex-fill text-right">
                                                <!-- <p class="mb-0 small">+20%</p> -->
                                            </div>
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                            <div class="col-md-4 col-xl-2 mb-3 pr-0">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <span class="card-title">Cost Avoidance</span>
                                    </div>
                                    <div class="card-body my-n2">
                                        <div class="d-flex">
                                            <div class="flex-fill">
                                                <h4 class="h6 mb-0">Rs. 4,66,764.78L</h4>
                                            </div>
                                            <div class="flex-fill text-right">
                                                <!-- <p class="mb-0 small">+20%</p> -->
                                            </div>
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                        </div>
                        <div class="row">
                            <div class="mb-2 card col-8">
                                <div class="col-12 col-lg-3">
                                    <div class="card shadow mb-4">
                                        <div class="card-header">
                                            <strong class="card-title mb-0">Donut Chart</strong>
                                        </div>
                                        <div class="card-body text-center">
                                            <div id="donutChart"></div>
                                        </div> <!-- /.card-body -->
                                    </div> <!-- /.card -->
                                </div> <!-- /. col -->
                            </div>
                            <div class="mb-2 col-4">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title">Notification List</strong>
                                        <a class="float-right small text-muted" href="#!">View all</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush my-n3">
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="fe fe-box fe-24"></span>
                                                    </div>
                                                    <div class="col">
                                                        <small><strong>Package has uploaded successfull</strong></small>
                                                        <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="fe fe-download fe-24"></span>
                                                    </div>
                                                    <div class="col">
                                                        <small><strong>Widgets are updated successfull</strong></small>
                                                        <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="fe fe-inbox fe-24"></span>
                                                    </div>
                                                    <div class="col">
                                                        <small><strong>Notifications have been sent</strong></small>
                                                        <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                                    </div>
                                                </div> <!-- / .row -->
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="fe fe-link fe-24"></span>
                                                    </div>
                                                    <div class="col">
                                                        <small><strong>Link was attached to menu</strong></small>
                                                        <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                                    </div>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div> <!-- / .list-group -->
                                    </div> <!-- / .card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-0">
                                <div class="card shadow mb-2">
                                    <div class="card-header">
                                        <strong>RFQ Status</strong>
                                    </div>
                                    <div class="card-body px-4">
                                        <div class="row border-bottom">
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">5</span><br>
                                                <span class="small ">8 PR's</span><br><br>
                                                <p class="mb-1 ">Published</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">260</span><br>
                                                <span class="small ">592 PR's</span><br><br>
                                                <p class="mb-1  ">Closed</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">59</span><br>
                                                <span class="small ">87 PR's</span><br><br>
                                                <p class="mb-1  ">Technical Approval Pending</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">128</span><br>
                                                <span class="small ">276 PR's</span><br><br>
                                                <p class="mb-1  ">Technically Approved - Action Pending</p>
                                            </div>
                                        </div>

                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                            <div class="col-md-6">
                                <div class="card shadow mb-2">
                                    <div class="card-header">
                                        <strong>Award Status</strong>
                                    </div>
                                    <div class="card-body px-4">
                                        <div class="row border-bottom">
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">5</span><br>
                                                <span class="small ">8 PR's</span><br><br>
                                                <p class="mb-1 ">Published</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">260</span><br>
                                                <span class="small ">592 PR's</span><br><br>
                                                <p class="mb-1  ">Closed</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">59</span><br>
                                                <span class="small ">87 PR's</span><br><br>
                                                <p class="mb-1  ">Technical Approval Pending</p>
                                            </div>
                                            <div class="col-3 text-center mb-3">

                                                <span class="h4">128</span><br>
                                                <span class="small ">276 PR's</span><br><br>
                                                <p class="mb-1  ">Technically Approved - Action Pending</p>
                                            </div>
                                        </div>

                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4 pr-0">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title mb-0">Cycle Time</strong>
                                    </div>
                                    <div class="card-body">
                                        <div id="columnChart"></div>
                                    </div> <!-- /.card-body -->
                                </div> <!-- /.card -->
                            </div> <!-- /. col -->
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title mb-0">Bar Chart</strong>
                                    </div>
                                    <div class="card-body">
                                        <div id="barChart"></div>
                                    </div> <!-- /.card-body -->
                                </div> <!-- /.card -->
                            </div> <!-- /. col -->

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title">Spend Visibility</strong>
                                    </div>
                                    <div class="card-body my-n2">
                                        <table class="table table-striped table-hover table-borderless">

                                            <tbody>
                                                <tr>
                                                    <td>2474</td>
                                                    <th scope="col">Brown, Asher D.</th>
                                                    <td>Ap #331-7123 Lobortis Avenue</td>
                                                    <td>(958) 421-0798</td>
                                                    <td>13/09/2020</td>

                                                </tr>
                                                <tr>
                                                    <td>2786</td>
                                                    <th scope="col">Leblanc, Yoshio V.</th>
                                                    <td>287-8300 Nisl. St.</td>
                                                    <td>(899) 881-3833</td>
                                                    <td>04/05/2019</td>

                                                </tr>
                                                <tr>
                                                    <td>2747</td>
                                                    <th scope="col">Hester, Nissim L.</th>
                                                    <td>4577 Cras St.</td>
                                                    <td>(977) 220-6518</td>
                                                    <td>04/06/2019</td>

                                                </tr>
                                                <tr>
                                                    <td>2639</td>
                                                    <th scope="col">Gardner, Leigh S.</th>
                                                    <td>P.O. Box 228, 7512 Lectus Ave</td>
                                                    <td>(537) 315-1481</td>
                                                    <td>04/08/2019</td>

                                                </tr>
                                                <tr>
                                                    <td>2238</td>
                                                    <th scope="col">Higgins, Uriah L.</th>
                                                    <td>Ap #377-5357 Sed Road</td>
                                                    <td>(238) 386-0247</td>
                                                    <td>04/01/2019</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- Striped rows -->
                        </div>
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
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
            <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-5">
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-success justify-content-center">
                                        <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Control area</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Activity</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Droplet</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Upload</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Users</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Settings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> <!-- main -->
    </div> <!-- .wrapper -->

    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });
        $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
        $('.time-input').timepicker({
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
        /** date range picker */
        if ($('.datetimes').length) {
            $('.datetimes').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        }
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
        $('.input-placeholder').mask("00/00/0000", {
            placeholder: "__/__/____"
        });
        $('.input-zip').mask('00000-000', {
            placeholder: "____-___"
        });
        $('.input-money').mask("#.##0,00", {
            reverse: true
        });
        $('.input-phoneus').mask('(000) 000-0000');
        $('.input-mixed').mask('AAA 000-S0S');
        $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                }
            },
            placeholder: "___.___.___.___"
        });
        // editor
        var editor = document.getElementById('editor');
        if (editor) {
            var toolbarOptions = [
                [{
                    'font': []
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                        'header': 1
                    },
                    {
                        'header': 2
                    }
                ],
                [{
                        'list': 'ordered'
                    },
                    {
                        'list': 'bullet'
                    }
                ],
                [{
                        'script': 'sub'
                    },
                    {
                        'script': 'super'
                    }
                ],
                [{
                        'indent': '-1'
                    },
                    {
                        'indent': '+1'
                    }
                ], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction
                [{
                        'color': []
                    },
                    {
                        'background': []
                    }
                ], // dropdown with defaults from theme
                [{
                    'align': []
                }],
                ['clean'] // remove formatting button
            ];
            var quill = new Quill(editor, {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        var uptarg = document.getElementById('drag-drop-area');
        if (uptarg) {
            var uppy = Uppy.Core().use(Uppy.Dashboard, {
                inline: true,
                target: uptarg,
                proudlyDisplayPoweredByUppy: false,
                theme: 'dark',
                width: 770,
                height: 210,
                plugins: ['Webcam']
            }).use(Uppy.Tus, {
                endpoint: 'https://master.tus.io/files/'
            });
            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
            });
        }
    </script>
    <script src="js/apps.js"></script>
</body>

</html>