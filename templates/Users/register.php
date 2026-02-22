<!DOCTYPE html>
<html lang="en">

<head>

  <?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
  <?= $this->Html->script("CakeLte./AdminLTE/plugins/jquery-validation/jquery.validate.min.js") ?>

  <style type="text/css">
    input[type='radio'] {
      accent-color: #004B88 !important;
    border: 0px;
    width: 1.3em;
    height: 1.3em;
}

    span#otp_error {
      display: inline-block;
      padding-bottom: 10px;
    }

    button#otploginclick {
      margin-bottom: 30px !important;
      margin-top: 0px !important;
    }

    div#email_login {
      margin-top: 20px;
      width: 95%;
    }

    .error {
      color: #FF0000;
      text-align: left;
      display: block;
    }

    input::placeholder {
      font-size: 14px;
    }

    .signupcard .signupform__signin--signinText {
      margin-bottom: 5% !important;
    }

    .mb-0 {
      margin-bottom: 0px;
    }

    p.error-msg {
      color: #e31720;
      text-align: left;
      margin-top: 5px;
      font-size: 12px;
      font-style: italic;
    }

    .custom-radio label {
      font-size: 1rem;

    }

    .signupcard .signupform__signin {
      justify-content: center;
      flex-direction: column;
      align-items: center;
      padding: 8% 15% 5% !important
        /* height: 600px; */
    }

    #mobile_login_otp {
      padding: 0% 15% 5% !important;
      margin-top: -30px;
    }

    .ant-card-body {
      padding: 0px !important;
    }

    /*.ant-card.signupcard.ant-card-bordered {
    height: 100%;
} */

    .v2container {
      color: white;
      background-color: #004B88 !important;
      background: #004B88 !important;
      background: -webkit-linear-gradient(to right, #2c3e50, #2980b9) !important;
      background: linear-gradient(to bottom, #004B88, #2980b9) !important;
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

    div#mobile_login {
      width: 100%;

    }

    canvas.particles-js-canvas-el {

      position: absolute;
      width: 100%;
      height: 100%;
      z-index: 99;
      left: 0;
      top: 0;
      bottom: 0;
      right: 0;
    }

    .left-content h1 {
      color: #fff;
      font-size: 2.8vw;
      line-height: 3.5rem;
    }

    .left-content {
      padding-left: 65px;
    }

    .left-content p {
      font-size: 20px;
    }

    img.flow-img {
      width: 55%;
    }

    .ant-row {
      position: absolute;
      top: 50%;
      left: 50%;
      align-items: center;
      transform: translate(-50%, -50%);
      text-align: center;
      width: 100%;
      height: 100%;
      z-index: 999;
    }

    .form-control[type="file"] { font-size: 16px !important;}

    .s-logo {
      width: 50%;
    }

    .sub-btn {
      background-image: linear-gradient(to right, #004B88 0%, #2980b9 51%, #2980b9 100%) !important;
      transition: 0.5s;
      background-size: 200% auto !important;
      color: white;
      box-shadow: 0 0 20px #eee !important;
      border-radius: 30px !important;
      display: block;
      font-size: 15px !important;
      line-height: 1.1em !important;
      margin: 0px !important;
      height: 40px !important;
      border: none !important;
      margin-top: 7px !important;
    }

    .sub-btn:hover {
      background-position: right center !important;
      color: #fff;
      text-decoration: none;
    }

    .anticon {
      display: inline-block;
      color: inherit;
      font-style: normal;
      line-height: 0;
      text-align: center;
      text-transform: none;
      vertical-align: -0.125em;
      text-rendering: optimizeLegibility;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .anticon>* {
      line-height: 1;
    }

    .anticon svg {
      display: inline-block;
    }

    .anticon::before {
      display: none;
    }

    .anticon .anticon-icon {
      display: block;
    }

    .anticon[tabindex] {
      cursor: pointer;
    }

    .anticon-spin::before,
    .anticon-spin {
      display: inline-block;
      -webkit-animation: loadingCircle 1s infinite linear;
      animation: loadingCircle 1s infinite linear;
    }

    .forget-pwd {
      font-size: 14px;
      margin-bottom: 10px !important;
    }
    .material-textfield .material-label,.material-textfield .material-input{
      font-size: 1.2rem !important;
    }

    @-webkit-keyframes loadingCircle {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    @keyframes loadingCircle {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    body {
      font-family: 'Heebo', sans-serif;
    }

    /* Responsive Styling start here */

    @media only screen and (max-width: 1024px) {
        .custom-radio label { font-size: .8rem ;}
        .custom-radio { display: flex; align-items: center; gap: 5px;}
    }

    @media only screen and (max-width: 768px) {
      .left-content { padding: 20px 40px 20px !important;}
      .left-content h1 { font-size: 36px;}
    }
    @media only screen and (max-width: 425px) {
      .left-content h1 { font-size: 32px;}
      .left-content p { font-size: 16px;}
    }

  </style>
  <meta charset="utf-8">
  <link rel="icon" href="./favicon.ico">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#000000">
  <meta name="description"
    content="Sign up now! Unlock the best platform to discover freight rates, execute your shipments &amp; track containers">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>css/all.min.css">
  <link href="<?= $this->Url->build('/') ?>css/5.7cec8de0.chunk.css" rel="stylesheet">
  <link href="<?= $this->Url->build('/') ?>css/main.26d266c0.chunk.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script charset="utf-8" src="<?= $this->Url->build('/') ?>js/0.5bbd83f8.chunk.js"></script>
  <script charset="utf-8" src="<?= $this->Url->build('/') ?>js/1.a9e5058d.chunk.js"></script>
  <script charset="utf-8" src="<?= $this->Url->build('/') ?>js/6.3128c4ca.chunk.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/') ?>css/13.656858bb.chunk.css">
  <script charset="utf-8" src="<?= $this->Url->build('/') ?>js/13.b8dbb772.chunk.js"></script>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
  <?= $this->Html->script("CakeLte./AdminLTE/plugins/jquery-validation/jquery.validate.min.js") ?>
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
</head>

<body>
  <div id="root">
    <div class="App">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

      <div class="v2container" id="particles-js">
        <div class="ant-row">
          <div
            class="ant-col otherdetails-container ant-col-xs-24 ant-col-sm-24 ant-col-md-24 ant-col-lg-12 ant-col-xl-12">
            <div class="left-content animate__animated animate__backInLeft">
              <h1>Welcome to JBM Groups Supplier Portal</h1>
              <p>A single window digital interface and communication platform for supplier assessment and onboarding-
                Towards Co-creating Governance.</p>
              <img class="flow-img" src="<?= $this->Url->build('/') ?>img/login-img.png">
            </div>
          </div>
          <div class="ant-col content-container ant-col-xs-24 ant-col-sm-24 ant-col-md-24 ant-col-lg-12 ant-col-xl-12">
            <div class="ant-card signupcard ant-card-bordered">
              <div class="ant-card-body">

                <div class="signupform signupform__signin">
                  <p class="signupform__signin--signinText">
                    <img src="<?= $this->Url->build('/') ?>img/jbm_logo.png" class="xxl-logo">
                  </p>

                  <?= $this->Flash->render('auth') ?>
 <h3 id="registration-result" style="color:green"></h3>
                  <div id="email_login">
                                       <?= $this->Form->create(null, ['id' => 'register-form', 'url' => ['controller' => 'Users', 'action' => 'register'], 'type' => 'post']) ?>

                    
                    <span class="error userpassError" style="margin-bottom:20px;margin-top: -20px;"></span>
                    <div style="width: 100%;">
                    <div class="material-textfield mb-0 form-group">
                           <?= $this->Form->control('company_name', [
                          'class' => 'material-input sentence form-control',
                          'placeholder' => 'Enter Company Name',
                          'required' => true,
                          'label' => [
                            'text' => 'Company Name',
                            'class' => 'material-label',
                            'style' => 'left: 0px;'
                          ]
                        ]); ?>
                      </div>
                      <div class="material-textfield mb-0 form-group">
                           <?= $this->Form->control('email', [
                          'class' => 'material-input sentence form-control',
                          'placeholder' => 'Enter Email',
                          'required' => true,
                          'label' => [
                            'text' => 'Email',
                            'class' => 'material-label',
                            'style' => 'left: 0px;'
                          ]
                        ]); ?>
                      </div>
                      

                    </div>
                    <div style="width: 100%;">
                      <div class="material-textfield signin-textfield form-group">
                        <?= $this->Form->control('mobile', [
                                                    'class' => 'material-input sentence form-control',
                                                    'placeholder' => 'Enter Mobile Number',
                                                    'required' => true,
                                                    'type' => 'text',
                                                    'label' => [
                                                        'text' => 'Mobile',
                                                        'class' => 'material-label',
                                                        'style' => 'left: 0px;'
                                                    ]
                                                ]); ?>
                      </div>

                      <div class="material-textfield signin-textfield form-group">
                <?= $this->Form->control('user_type', [
                  'type' => 'select', 
                  'options' => ['Buyer' => 'buyer', 'Vendor' => 'vendor'], 
                  'class' => 'material-input sentence form-control', 
                  'label' => ['text' => 'User Type', 'class' => 'material-label']
                ]) ?>
              </div>
                      <p class="signupform__signin--dontHaveAccount">Have an account?<a href="login"
                        style="cursor: pointer;">Login</a></p>
                    </div>
                    <button type="submit" id="loginclick"
                      class="ant-btn btn btn__get-started-btn sub-btn">Register</button>
                    
                    <?= $this->Form->end() ?>
                     <div id="registration-result"></div>
                    <p style="text-align: center;font-weight: 500;margin-top:10px;"><a href="mailto: support@fts-pl.com"
                        style="margin-right: 5px;border-right: 1px solid;padding-right: 10px;">Help</a> <a
                        href="https://www.fts-pl.com/privacy-policy/">Privacy Terms</a></p>
                    <p class="text-center" style="text-align:center"> <img
                        src="<?= $this->Url->build('/') ?>img/ftspl.png" width="120px"></p>

                  </div>
                  


                

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= $this->Url->build('/') ?>js/5.b662bfe1.chunk.js"></script>
  <script src="<?= $this->Url->build('/') ?>js/main.d308f349.chunk.js"></script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script>
    // background particles
    particlesJS("particles-js", {
      "particles": {
        "number": {
          "value": 50,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": "#ffffff"
        },
        "shape": {
          "type": "triangle",
          "stroke": {
            "width": 0,
            "color": "#000000"
          },
          "polygon": {
            "nb_sides": 4
          },
          "image": {
            "src": "img/github.svg",
            "width": 150,
            "height": 150
          }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 2,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 3,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 100,
          "color": "#ffffff",
          "opacity": 0.4,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": true,
          "straight": false,
          "out_mode": "out",
          "bounce": true,
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "window",
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
        },
        "modes": {
          "grab": {
            "distance": 140,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 100,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 100,
            "duration": 0.8
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
    });


    /*$('#loginclick').click(function (e) {
      e.preventDefault(); // Prevent the form from submitting normally
      // var formData = $(this).serialize();

      $.ajax({
        type: "POST",
        url: "<?php echo \Cake\Routing\Router::url(array('/controller' => 'users', 'action' => 'save-user')); ?>",
        data: $("#registerForm").serialize(),
        dataType: 'json',
        beforeSend: function () { $("#gif_loader").show(); },
        success: function (response) {
          if (response.status == '1') {
            window.location.href = response.redirect.controller;
          } else {
            $('span.userpassError').empty().append(response.message);
          }
        },
        complete: function () { $("#gif_loader").hide(); }
      });
    });*/



    

    //end


        var userregurl = '<?= $this->Url->build(['controller' => 'users', 'action' => 'register']); ?>';
    $(document).ready(function () {

 $('#register-form').validate({
            rules: {
                company_name: { required: true },
                mobile: { required: true, digits: true, minlength: 10, maxlength: 10 },
                email: { required: true, email: true }
              
            },
            messages: {
                company_name: { required: "Please enter a company name." },
                mobile: {
                    required: "Please enter a 10-digit mobile number.",
                    digits: "Please enter only digits.",
                    minlength: "Mobile number must be exactly 10 digits long.",
                    maxlength: "Mobile number must be exactly 10 digits long."
                },
                email: {
                    required: "Please enter an email address.",
                    email: "Please enter a valid email address."
                }               
            },
            submitHandler: function(form) {


    $.ajax({
    type: 'POST',
    url: userregurl,
    data: $("#register-form").serialize(),
    dataType: 'json',
    headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // Fetch the CSRF token from meta tag
    },
    success: function(response) {
        console.log(response);
        if (response.message) {
            $('#registration-result').html('<div class="alert alert-success">' + response.message + '</div>');
        } else {
            $('#registration-result').html('<div class="alert alert-danger">' + response.error + '</div>');
        }
    },
    error: function(xhr) {
        $('#registration-result').html('<div class="alert alert-danger">Error: ' + xhr.status + ': ' + xhr.statusText + '</div>');
    }
});


                return false; // Prevent form submission
            }
        });
    });
    // for password hide/show
    
  </script>
</body>

</html>