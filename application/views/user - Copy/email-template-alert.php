<?php
$page = 'email-template-alert';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Alert Email</title>
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
            <h4 class="mb-sm-0 font-size-18">Keep Notes</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Remember Notes</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <!-- Left sidebar -->
                                <div class="email-leftbar card">
                                    <button type="button" class="btn btn-d btn-block waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#composemodal">
                                        + New
                                    </button>
                                    <div class="mail-list mt-4">
                                        
                                    <p class="text-muted mb-2">Recent Notes</p>
                                    
                                    <div class="list-group list-group-flush">

                                        <a href="#" class="list-group-item text-muted py-3 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate">Beautiful Day with Friends</h5>
                                                    <p class="mb-0 text-truncate">10 Apr, 2020</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="list-group-item text-muted py-3 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate">Drawing a sketch</h5>
                                                    <p class="mb-0 text-truncate">24 Mar, 2020</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="list-group-item text-muted py-3 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate active">Project discussion with team</h5>
                                                    <p class="mb-0 text-truncate">11 Mar, 2020</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    </div>
                                    
                                </div>
                                <!-- End Left sidebar -->

                                <!-- Right Sidebar -->
                                <div class="email-rightbar mb-3">

                                    <div class="card">
                                        <div class="btn-toolbar p-3" role="toolbar">
                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-sm bg-d text-white"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                            

                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-sm bg-d text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    More <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Mark as Important</a>
                                                    <a class="dropdown-item" href="#">Mute</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            

                                            
                                           <textarea id="email-editor" name="notes"></textarea>
                                            
                                            
                                            <a href="javascript: void(0);" class="btn btn-sm bg-d text-white mt-4"><i class="mdi mdi-content-save-edit-outline"></i> Edit</a>
                                        </div>

                                    </div>
                                </div>
                                <!-- card -->

                            </div>
                            <!-- end Col-9 -->

                        </div>

                    </div>
                    <!-- End row -->
                </div>
                <!-- container-fluid -->
            
                <!-- End Page-content -->

                
                <?php
                include('footer.php');
                ?>
                          </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        
        <!-- Modal -->
             <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="composemodalTitle">Keep New Notes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Title">
                                </div>

                                
                                <div class="mb-3">
                                    <form method="post">
                                        <textarea id="email-editor" name="area"></textarea>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save <i class="fas fa-save ms-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

        
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<!--tinymce js-->
        <script src="<?php echo base_url();?>assets/libs/tinymce/tinymce.min.js"></script>

        <!-- email editor init -->
        <script src="<?php echo base_url();?>assets/js/pages/email-editor.init.js"></script>
        <?php
include('footer_links.php');
?>

    </body>

</html>
