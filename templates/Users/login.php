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
  <?= $this->Html->script('particles.min.js') ?>

  <style>
    /* This ensures the particles cover the whole screen */
    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: #f8f9fa;
      /* Match your light theme */
      background-image: url("");
      /* Optional background image */
      background-repeat: no-repeat;
      background-size: cover;
      background-position: 50% 50%;
      z-index: -1;
      /* Pushes it behind the form */
    }

    /* Ensure the wrapper is transparent so particles show through */
    .wrapper {
      background: transparent !important;
      position: relative;
    }

    .v2container {
      color: white;
      background-color: #2b9afb !important;
      background: #084e8b !important;
      background: -webkit-linear-gradient(to right, #2c3e50, #2980b9) !important;
      background: linear-gradient(to bottom, #095AA3, #040404) !important;
      height: auto !important;
      min-height: calc(100vh - 0px) !important;
    }

    .v2container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.2);
      pointer-events: none;
    }

    body {
      overflow: hidden;
      /* Disables both vertical and horizontal */
    }

    /* Or target specific axes */
    .container {
      overflow-x: hidden;
      /* Disables horizontal only */
      overflow-y: hidden;
      /* Disables vertical only */
    }
  </style>
</head>

<body class="light">
  <div class="v2container" id="particles-js"></div>
  <div class="wrapper vh-100">
    <div class="row align-items-center h-100">
      <div class="col-lg-3 col-md-4 col-10 mx-auto">
        <div class="card shadow-lg border-0">
          <div class="card-body p-5 text-center">
            <form action="<?= $this->Url->build(['controller' => 'users', 'action' => 'login']) ?>" method="POST">
              <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= $this->Url->build('/') ?>">
                <?= $this->Html->image('jbm_logo.png', ['style' => 'width:70%']) ?>
              </a>
              <h1 class="h4 mb-3">RFQ - Sign in</h1>
              <input type="hidden" name="_csrfToken" value="<?= h($this->request->getAttribute('csrfToken')) ?>">
              <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
              </div>
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
              </div>
              <!-- <div class="checkbox mb-3">
                <label><input type="checkbox" value="remember-me"> Stay logged in </label>
              </div> -->
              <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
              <p class="h5 mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
</body>
<script>
  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 80,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#fcfcfc"
      }, // Adjust color to match your JBM logo
      "shape": {
        "type": "circle"
      },
      "opacity": {
        "value": 0.5,
        "random": false
      },
      "size": {
        "value": 3,
        "random": true
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "bounce": false
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      }
    },
    "retina_detect": true
  });
</script>

</html>