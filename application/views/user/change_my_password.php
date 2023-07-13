<?php
$page = 'change-my-password';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Change My Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
    <?php
include('header_links.php');
?>
    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php
            include('header.php');
            ?>
<!-- ========== Left Sidebar Start ========== -->
            <?php
            include('sidebar.php');
            ?>
<!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Change Password</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Change Password</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
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
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" name="my_cp_form" id="my_cp_form" class="login_form" autocomplete="off">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                   <input type="password" name="old_password" id="old_password" class="form-control pl-15" placeholder="Current Password" required="">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i onclick="oldPassword();" class="fa fa-eye" id="togglePassword1"></i></span>
                                                    </div>
                                                </div>
                                                <span id="old_passwordErr" class="text-danger"></span>
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
                                            <div class="text-end">
                                                <button class="btn btn-d btn-sm w-md waves-effect waves-light" type="submit">Change Password</button>
                                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                                </a>
                                            </div>
                                        </form>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
<script type="text/javascript">
function oldPassword() {
  var x = document.getElementById("old_password");
  var y = document.getElementById("togglePassword1");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

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
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>       
<?php
include('footer_links.php');
?>

    </body>

</html>
