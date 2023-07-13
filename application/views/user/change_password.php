<?php
$page = 'change-password';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <meta charset="utf-8" />
<title>Change Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/owl.carousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap Css -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="auth-body-bg">

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12 text-center mb-5">
                                            <div class="text-white-50">
                                                <h1 class="text-white mb-3 hero-title" style="font-size: 54px;"><strong>Visualize. <span class="text-d">Plan</span>. Implement…Repeat!</span></strong></h1>
                                                <p class="font-size-18 text-white">“THE DECISIONS WE MAKE TODAY, SHAPE THE US OF TOMORROW”</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <h4 class="mb-3 text-white"><i class="bx bxs-quote-alt-left text-d h1 align-middle me-3"></i>Let’s get you unstuck!</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4 text-white">Use this platform to reclaim time, gain brand exposure, & to focus on what’s important for you to build an innovative personal or professional life – or both. (<span class="text-d">24</span>x<span class="text-d">7</span>=<span class="text-d">168</span>)</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-d">#decision168</h4>
                                                                    <p class="font-size-14 mb-0 text-white"> #StrongerTogether #NowMoreThanEver</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4 text-white">DECISION 168 is on a mission to Empower Small Businesses, Entrepreneurs, and Individuals. Through the relationships and experience of our network, we will make a difference together. Our goal is to help people across the world perform and function at their highest levels and utilize their unique talents, so that they may make an impact within their communities and beyond.</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-d">#decision168</h4>
                                                                    <p class="font-size-14 mb-0 text-white"> #StrongerTogether #NowMoreThanEver</p>
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
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="<?php echo base_url();?>" class="d-block auth-logo">
                                        <img src="<?php echo base_url();?>assets/images/Decision-168-Black-Invert.png" alt="" height="40" class="auth-logo-dark">
                                        <img src="<?php echo base_url();?>assets/images/Decision-168-Black-Invert.png" alt="" height="40" class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-d"> Change Password</h5>
                                        <p class="text-white">Change-Password with Decision 168.</p>
                                    </div>

                                    <div class="mt-4">
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
<?php echo $this->session->flashdata('message'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
                        
                                        <form method="POST" name="cp_form" id="cp_form" class="login_form" autocomplete="off">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_address" id="email_address" value="<?php echo $stud_del->email_address;?>" readonly="" class="form-control pl-15" placeholder="Email Address" required="">
                                                </div>
                                                <span id="email_addressErr" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                   <input type="password" name="new_password" id="new_password" class="form-control pl-15" placeholder="New Password" required="">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i onclick="newPassword();" class="fa fa-eye" id="togglePassword2"></i></span>
                                                    </div>
                                                </div>
                                                <span id="new_passwordErr" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="password" name="conf_password" id="conf_password" class="form-control pl-15" placeholder="Confirm Password" required="">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i onclick="confPassword();" class="fa fa-eye" id="togglePassword3"></i></span>
                                                    </div>
                                                </div>
                                                <span id="conf_passwordErr" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="g-recaptcha" data-sitekey="6LeGztMcAAAAAP6yPwVYpzxL2qPnmdK2nVgFb1Dp"style="transform:scale(0.80);-webkit-transform:scale(0.80);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                                </div>
                                                <span id="recaptchaErr" class="text-danger"></span>
                                            </div>
                                            <input type="hidden" name="reg_id" id="reg_id" value="<?php echo $stud_del->reg_id;?>">
                                            <div class="text-end">
                                                <button class="btn btn-d btn-sm w-md waves-effect waves-light" type="submit">Change Password</button>
                                            </div>
                                        </form> 
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <div class="mt-5 text-center">
                                            <p class="text-white">Remember It ? <a href="<?php echo base_url('login');?>" class="fw-medium text-d"> Sign In here</a> </p>
                                        </div>
                                    </div>
                                </div>

                               <div class="mt-4 mt-md-5 text-center text-white">
                                    <p class="mb-0 font-size-12">© Copyright 2013 - <span id="copyright"> <script> document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> |   <a href="http://decision168.com" target="_blank">DECISION 168, Inc</a><br>|   <a href="https://www.decision168.com/?page_id=841" target="_blank"> Cookies Policy</a>  |  <a href="https://www.decision168.com/terms-conditions/" target="_blank"> Terms &amp; Conditions</a>  |   <a href="https://www.decision168.com/privacy-policy/" target="_blank"> Privacy Policy</a>  <br>   All Rights Reserved   |   Powered by <a href="http://z2squared.com" target="_blank">z2 Squared</a></p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
<script type="text/javascript">
function newPassword() {
  var x = document.getElementById("new_password");
  var y = document.getElementById("togglePassword2");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function confPassword() {
  var x = document.getElementById("conf_password");
  var y = document.getElementById("togglePassword3");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}
</script>
    <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
    <!-- owl.carousel js -->
    <script src="<?php echo base_url();?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- auth-2-carousel init -->
    <script src="<?php echo base_url();?>assets/js/pages/auth-2-carousel.init.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url();?>assets/js/app.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
        $(function(){
  function rescaleCaptcha(){
    var width = $('.g-recaptcha').parent().width();
    var scale;
    if (width < 302) {
      scale = width / 302;
    } else{
      scale = 1.0; 
    }

    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
  }

  rescaleCaptcha();
  $( window ).resize(function() { rescaleCaptcha(); });

});
</script>
</body>

</html>