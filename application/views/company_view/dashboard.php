<?php
$page = 'index';
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Dashboard | Decision168 </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<?php
include('header_links.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<style>

td {
  border-radius: 0 !important;
}

tr th {
      font-weight: 500;
}

.timepicker {
  max-width: 100px;
  border-radius: 0;
}
</style>
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
            <div class="main-content" id="main">

                <div class="page-content">
                    <div class="container-fluid">
 
                       <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome Back !</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> -->
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
                            <div class="col-xl-12">
                                <div class="row">
                                <div class="col-lg-9">
                                <div class="card overflow-hidden">
                                    <div class="bg-d">
                                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/cover.jpg')?>); background-repeat: no-repeat;background-size: 100%;height: 250px;">
                                            <div class="col-12">
                                                <div class="text-d p-2">
                                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="avatar-md profile-user-wid mb-2">
                                                    <?php
                                                        $profile_name = "";
                                                        $cname = "";
                                                        if($compd)
                                                        {
                                                            $cname = $compd->cc_name;
                                                            $profile_name = strtoupper(substr(trim($cname), 0, 2));
                                                        }
                                                    ?>
                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-24"><?php echo $profile_name;?></span>
                                                </div>
                                                <h5 class="font-size-15 text-truncate"><?php echo $cname;?></h5>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="pt-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            
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
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php
                if($packageExpired == "yes")
                {
                ?>
                <!--Package Expiry --> 
                <div class="modal fade" id="packageExpiryModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-4">
                                    <div class="avatar-md mx-auto mb-4">
                                        <div class="avatar-title bg-light rounded-circle text-d h1">
                                            <i class="mdi mdi-package-down"></i>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-xl-10">
                                            <h4 class="text-d">Plan Expired !</h4>
                                            <p class="text-muted font-size-14 mb-4">To keep using Decision 168 without interruption, choose a plan from packages!</p>

                                              
                                                <a href="<?php echo base_url('company/pricing-package');?>" class="btn btn-d btn-sm">Go To Pricing</a>

                                                <button type="button" class="btn btn-sm btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Package Expiry -->
                <?php
                }
                
                include('footer.php');
                ?>           
</div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- dashboard init -->
        <script src="<?php echo base_url();?>assets/js/pages/dashboard.init.js"></script>
<?php
include('footer_links.php');
?>
<script id="rendered-js">
$('.contact-side li').hover(function () {
  $(this).stop().animate({
    'right': 0 },
  500);

}, function () {
  $(this).stop().animate({
    'right': "-140px" },
  300);
});

    </script>

 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<!--tinymce js-->
<script src="<?php echo base_url();?>assets/libs/tinymce/tinymce.min.js"></script>

<!-- email editor init -->
<script src="<?php echo base_url();?>assets/js/pages/email-editor.init.js"></script>
      <script id="rendered-js">
moment.locale('en', {
  week: { dow: 1 } // Monday is the first day of the week
});

$('#datetimepicker12').datetimepicker({
  inline: true,
  sideBySide: true,
  format: 'DD-MM-YY',
  stepping: 30,
  minDate: moment() });
    </script>
    

    </body>

</html>