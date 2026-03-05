<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <link rel="icon" href="favicon.ico">
    <title>RFQ</title>
    <!-- Simple bar CSS -->
    <?= $this->Html->css("simplebar.css") ?>

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
    <?= $this->Html->script('d3.min.js') ?>
    <?= $this->Html->script('topojson.min.js') ?>
    <?= $this->Html->script('datamaps.all.min.js') ?>
    <?= $this->Html->script('datamaps-zoomto.js') ?>
    <?= $this->Html->script('datamaps.custom.js') ?>
    <?= $this->Html->script('Chart.min.js') ?>

    <?= $this->Html->script('gauge.min.js') ?>
    <?= $this->Html->script('jquery.sparkline.min.js') ?>

    <?= $this->Html->script('jquery.mask.min.js') ?>
    <?= $this->Html->script('select2.min.js') ?>
    <?= $this->Html->script('jquery.steps.min.js') ?>
    <?= $this->Html->script('jquery.validate.min.js') ?>
    <?= $this->Html->script('jquery.timepicker.js') ?>
    <?= $this->Html->script('dropzone.min.js') ?>
    <?= $this->Html->script('uppy.min.js') ?>
    <?= $this->Html->script('quill.min.js') ?>

    <?= $this->Html->css('dataTables.bootstrap4.css') ?>
    <?= $this->Html->script('jquery.dataTables.min.js') ?>
    <?= $this->Html->script('dataTables.bootstrap4.min.js') ?>

    <!-- Bootstrap4 Toggle -->
    <?= $this->Html->css("bootstrap4-toggle.min.css") ?>
    <?= $this->Html->script("bootstrap4-toggle.min.js") ?>

    <!-- Toastr Notification -->
    <?= $this->Html->css('toastr.min.css') ?>
    <?= $this->Html->script('toastr.min.js') ?>

    <style>
        .link-active {
            background: deepskyblue !important;
            color: white !important;
        }

        /* #leftSidebar {
            width: 200px !important;   
            min-width: 200px !important;
            overflow-y: hidden;
        }

        .main-content,
        .content,
        main {
            margin-left: 200px !important;
        }

        @media (min-width: 992px) {
            #leftSidebar {
                width: 200px !important;
            }
        }

        @media (max-width: 991px) {
            #leftSidebar {
                width: 0 !important;
                overflow: hidden;
            }
        }

        #leftSidebar .navbar-nav .nav-link {
            padding-left: 12px;
            padding-right: 12px;
        }

        #leftSidebar .item-text {
            font-size: 13px;
        }

        .vertical .topnav, .vertical.hover .topnav, .narrow.open .topnav {
            margin-left: 13rem;
            padding-left: 2.2rem;
            padding-right: 2.2rem;
        }

        .navbar {
            padding: 0px 10px!important;
        }

        .main-content, .container-fluid {
            padding: 5px!important;
        } */
        
        .main-content {
            padding : 0.5rem !important;
        }
    </style>
</head>
<?php
    $currentController = strtolower($this->request->getParam('controller'));
    $currentAction = strtolower($this->request->getParam('action'));
    $session = $this->getRequest()->getSession();
    $session_user_name = $session->read('Auth.user.name');
    $session_user_group = strtolower($session->read('Auth.user.group'));
?>

<body class="vertical light">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light shadow-sm" style="background-color: white;">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <span class="navbar-toggler-icon">
                    <?= $this->Html->image('../assets/icons/menu-icon-64.png', ['alt' => 'Menu', 'style' => 'width:25px']) ?>
                </span>
            </button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2 d-none" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-24"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted pr-0" href="./#" data-toggle="modal" data-target=".modal-notif">
                        <div style="width: 40px;height: 40px;background-color: #f1f1f1; /* light grey */border-radius: 50%;display: flex;align-items: center;justify-content: center;cursor: pointer;">
                            <?= $this->Html->image('../assets/icons/notification-icon-32.png', ['alt' => 'Notification', 'style' => 'width:20px']) ?>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted pr-0" href="#" role="button">
                        <div style="width: 40px;height: 40px;background-color: #f1f1f1; /* light grey */border-radius: 50%;display: flex;align-items: center;justify-content: center;cursor: pointer;">
                            <?= $this->Html->image('../assets/icons/person-icon-64.png', ['alt' => 'Notification', 'style' => 'width:20px']) ?>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="my-2 ml-2">
                        <span style="font-weight: bold;color:black;font-size:12px"><?= $session_user_name ?></span><br>
                        <small style="font-size: 11px;"><?= ucwords($session_user_group) ?></small>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light d-flex flex-column vh-100">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= $this->Url->build(['controller' => 'dashboard', 'action' => 'index']) ?>">
                        <?= $this->Html->image('jbm_logo.png', ['style' => 'width:50%']) ?>
                    </a>
                </div>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item <?= $currentController == 'dashboard' ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'dashboard' , 'action' => 'index']) ?>" class="nav-link <?= $currentController == 'dashboard' ? 'link-active' : '' ?>">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text">Dashboard</span>
                        </a>
                    </li>
                    <?php if(in_array($session_user_group , ['admin' , 'buyer'])) : ?>
                    <li class="nav-item <?= $currentController == 'purchaserequisitions' ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'purchase-requisitions' , 'action' => 'index']) ?>" class="nav-link <?= $currentController == 'purchaserequisitions' ? 'link-active' : '' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                                <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5z" />
                            </svg>
                            <span class="ml-3 item-text">Requisitions</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array($session_user_group , ['admin' , 'buyer' , 'vendor'])) : ?>
                    <li class="nav-item <?= ($currentController == 'rfq' && $currentAction != 'rfqforapprovallist') ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'index']) ?>" class="nav-link <?= ($currentController == 'rfq' && $currentAction != 'rfqforapprovallist') ? 'link-active' : '' ?>">
                            <i class="fe fe-calendar fe-16"></i>
                            <span class="ml-3 item-text">RFQs</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(in_array($session_user_group , ['admin' , 'approver'])) : ?>
                    <li class="nav-item <?= ($currentController == 'rfq' && $currentAction == 'rfqforapprovallist') ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'rfq' , 'action' => 'rfq-for-approval-list']) ?>" class="nav-link <?= ($currentController == 'rfq' && $currentAction == 'rfqforapprovallist') ? 'link-active' : '' ?>">
                            <i class="fe fe-server fe-16"></i>
                            <span class="ml-3 item-text">RFQ Approval</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(in_array($session_user_group , ['admin'])) : ?>
                    <li class="nav-item <?= $currentController == 'users' ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'users' , 'action' => 'index']) ?>" class="nav-link <?= $currentController == 'users' ? 'link-active' : '' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            </svg>
                            <span class="ml-3 item-text">Users</span>
                        </a>
                    </li>
                    <li class="nav-item <?= $currentController == 'CategoryApproverMappings' ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'category-approver-mappings' , 'action' => 'index']) ?>" class="nav-link <?= $currentController == 'category-approver-mappings' ? 'link-active' : '' ?>">
                            <i class="fe fe-sliders fe-16"></i>
                            <span class="ml-3 item-text">Approver Mapping</span>
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>

                <div class="btn-box w-100 mt-auto mb-3 px-3">
                    <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'logout']) ?>"
                        class="btn btn-danger btn-lg w-100 d-flex align-items-center justify-content-center">
                        <i class="fe fe-log-out fe-18 me-2 mx-3"></i>
                        <span class="small mt-1" style="font-weight: bold;">Logout</span>
                    </a>
                </div>
            </nav>
        </aside>
        <main role="main" class="main-content">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </main>
    </div> <!-- .wrapper -->


    <?= $this->Html->script('apps.js') ?>
</body>

</html>