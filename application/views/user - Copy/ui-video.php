<?php
$page = 'video';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Videos</title>
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
            <h4 class="mb-sm-0 font-size-18">Videos</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Videos</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/QFL5K7tbG3U" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/32OkJZ99EbE" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->        
                        </div> <!-- end row -->
        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/9o3VXFSxDHI" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">        
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/8KvbOdOWbKc" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

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
        
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
        <?php
include('footer_links.php');
?>

    </body>

</html>
