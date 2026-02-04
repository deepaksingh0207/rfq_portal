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
    <style>
        .link-active {
            background: deepskyblue !important;
            color: white !important;
        }
    </style>
</head>


<body class="vertical light  ">
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
                        <span style="font-weight: bold;color:black;font-size:12px">Admin</span><br>
                        <small style="font-size: 11px;">Admin</small>
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
                    <li class="nav-item active">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link link-active">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                                <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5z" />
                            </svg>
                            <span class="ml-3 item-text">Requisitions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <i class="fe fe-calendar fe-16"></i>
                            <span class="ml-3 item-text">Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z" />
                            </svg>
                            <span class="ml-3 item-text">Awards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-range" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM9 8a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1m-8 2h4a1 1 0 1 1 0 2H1z" />
                            </svg>
                            <span class="ml-3 item-text">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                            </svg>
                            <span class="ml-3 item-text">Contacts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            </svg>
                            <span class="ml-3 item-text">Supplier</span>
                        </a>
                    </li>
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
            <?= $this->fetch('content') ?>
        </main>
    </div> <!-- .wrapper -->


    <?= $this->Html->script('apps.js') ?>
</body>

</html>