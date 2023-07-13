<?php
if($pdetail)
{
    if($pdetail->ptype == "content")
    {
    $page = 'content-planner';
    }
    elseif($pdetail->ptype == "goal_strategy")
    {
    $page = 'goals-list';
    }
    else
    {
    $page = 'projects-list';
    }
}
else
{
$page = 'projects-list';
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title><?php 
        if($pdetail->ptype == "content")
        {
            echo 'Content Edit';
        }
        else
        {
            echo 'Project Edit';
        }?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- dropzone css -->
        <link href="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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
<?php
if($pdetail)
{
?>

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Edit</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Project Edit</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2"><?php 
                                        if($pdetail->ptype == "content")
                                        {
                                            echo 'Edit Content';
                                        }
                                        else
                                        {
                                            echo 'Edit Project';
                                        }?></h4>
                                        <?php 
                                            if(empty($check_status))
                                            {
                                        ?>
                                        <form method="post" name="edit_accepted_project_form" id="edit_accepted_project_form" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="id" value="<?php echo $pdetail->pid;?>">
                                            <input type="hidden" name="pcreated_by" value="<?php echo $pdetail->pcreated_by;?>">
                                            <input type="hidden" name="mid" value="<?php echo $mid;?>">
                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2"><?php 
                                                if($pdetail->ptype == "content")
                                                {
                                                    echo 'Content Name';
                                                }
                                                else
                                                {
                                                    echo 'Project Name';
                                                }?> <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                    <input id="pname" name="pname" type="text" class="form-control" placeholder="Enter Project Name..." value="<?php echo $pdetail->pname;?>" required="">
                                                    <span id="pnameErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="pdes" class="col-form-label col-lg-2"><?php 
                                                if($pdetail->ptype == "content")
                                                {
                                                    echo 'Content Description';
                                                }
                                                else
                                                {
                                                    echo 'Project Description';
                                                }?></label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" id="pdes" name="pdes" rows="3" placeholder="Enter Description..."><?php echo $pdetail->pdes;?></textarea>
                                                </div>
                                            </div>
                                            
                                        <div class="row mb-3">
                                            <label class="col-form-label col-lg-2">Attached Files</label>
                                            <div class="col-lg-4">
                                            <input class="form-control" name="pfile[]" id="pfile" type="file" multiple="" /><span></span>
                                                <span id="pfileErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" id="edit_accepted_project_button" class="btn btn-d">Send For Approval</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                                </a>
                                            </div>
                                        </div>
                                        </form>
                                        <?php
                                            }
                                            else
                                            {
                                                echo "Edit Field Request Sent To Project Owner Please Wait For Approval!";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
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
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- dropzone plugin -->
        <script src="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>

    </body>

</html>
