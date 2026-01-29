<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RFQ</title>
    <!-- Simple bar CSS -->
  <?= $this->Html->css('simplebar.css') ?>
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="https://www.jbmgroup.com/wp-content/themes/jbm-group/images/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="https://www.jbmgroup.com/wp-content/themes/jbm-group/images/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="https://www.jbmgroup.com/wp-content/themes/jbm-group/images/favicon-32x32.png" sizes="32x32">
  <!-- Icons CSS -->
  <?= $this->Html->css("feather.css") ?>

  <!-- Date Range Picker CSS -->
  <?= $this->Html->css("daterangepicker.css") ?>
  <?= $this->Html->css("jquery.timepicker.css") ?>
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
  <?= $this->Html->script('jquery.timepicker.js') ?>
  <?= $this->Html->script('jquery.stickOnScroll.js') ?>
  <?= $this->Html->script('tinycolor-min.js') ?>

  </head>
  <body class="light">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="<?= $this->Url->build(['controller' => 'users' , 'action' => 'login']) ?>" method="POST">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= $this->Url->build('/') ?>">
            <?= $this->Html->image('jbm_logo.png' , ['style' => 'width:50%']) ?>
          </a>
          <h1 class="h6 mb-3">Sign in</h1>
          <input type="hidden" name="_csrfToken" value="<?= h($this->request->getAttribute('csrfToken')) ?>">
          <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name = "email" id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name = "password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
          </div>
          <div class="checkbox mb-3">
            <label><input type="checkbox" value="remember-me"> Stay logged in </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <p class="mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
        </form>
      </div>
    </div>
    
  </body>
</html>
</body>
</html>