<?php
$page = 'index';
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Dashboard | Decision168 Super-Admin</title>
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
                                                        <span class="img-thumbnail rounded-circle" style="font-size: xxx-large;">SA</span>
                                                </div>
                                                <h5 class="font-size-15 text-truncate">Super Admin</h5>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="pt-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="font-size-15">
                                                                <?php
                                                                $count_rl = $this->Superadmin_model->count_registered_list();
                                                                    if($count_rl)
                                                                    {
                                                                        echo $count_rl['count_rows'];   
                                                                    }
                                                                ?>
                                                            </h5>
                                                            <a href="<?php echo base_url('super-admin/registered-list');?>" class="nameLink" title="View Registered Users">Registered Users</a>
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