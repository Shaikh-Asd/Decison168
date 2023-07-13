<?php
$page = 'goals';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title><?php echo ucfirst($gname);?> History</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">History</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Project History</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title-->
<?php
if($view_history_date)
{
?>
                    <div class="row">
                        <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-5"><?php echo $gname;?> History
                                             <button type="button" class="btn btn-d" data-bs-toggle="modal" data-bs-target="#excel_date_options" style="float: right;">
                                                    Export To Excel
                                            </button>
                                        </h4>
                                        <ul class="verti-timeline list-unstyled">
                                            <?php
                                            $prev_date ='';
                                            foreach($view_history_date as $v)
                                            {
                                                $h_date = date("Y-m-d", strtotime($v->DateOnly));
                                                if($h_date == $prev_date)
                                                {
                                                }
                                                elseif ($h_date == date("Y-m-d")) 
                                                {
                                            ?>
                                            <li class="event-list active" style="padding-bottom: 25px;">
                                                <div class="event-timeline-dot">
                                                    <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="me-3">
                                                        <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_hlist_goal('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Today - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                                elseif ($h_date == date('Y-m-d',strtotime("-1 days"))) 
                                                {
                                            ?>
                                            <li class="event-list active" style="padding-bottom: 25px;">
                                                <div class="event-timeline-dot">
                                                    <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="me-3">
                                                        <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_hlist_goal('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Yesterday - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <li class="event-list active" style="padding-bottom: 25px;">
                                                <div class="event-timeline-dot">
                                                    <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="me-3">
                                                        <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_hlist_goal('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                                ?>                                                
                                            <div class="clear_list" id="hlist<?php echo $v->DateOnly;?>"></div>
                                                <?php                                            
                                                $prev_date = $h_date;
                                            }
                                            ?>  
                                        </ul>
                                    </div>
                                </div>
                            </div>
                </div> <!-- end row --> 
<?php
}
?>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<!-- Export to Excel Modal -->
<div class="modal fade" id="excel_date_options" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Select Any One Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="goal_history_excel_form" name="goal_history_excel_form" autocomplete="off">
                <div class="modal-body">                   
                    <div class="mb-2 row">
                        <label class="col-md-2 col-form-label">Date :</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datepicker2">
                                <input type="text" class="form-control" placeholder="Date" data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" id="only_date" name="only_date">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div><!-- input-group -->  
                        </div>
                    </div>
                    <div class="m-2 text-center">
                        <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light">OR</button>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-md-2 col-form-label">Range :</label>
                        <div class="col-md-10">
                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                  <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" />
                                  <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" />
                            </div>
                        </div>
                    </div>
                    <div class="m-2 text-center">
                        <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light">OR</button>
                    </div>
                    <div class="m-1 row">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="all_history" id="all_history" value="1">
                            <label class="form-check-label">
                                All History
                            </label>
                        </div>
                    </div>
                            <input type="hidden" name="gid" value="<?php echo $gid;?>">
                            <input type="hidden" name="gname" value="<?php echo $gname;?>">
                            <span id="empty_optionErr" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="history_excel_button" name="history_excel_button" class="btn btn-d">Export To Excel</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div> 
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
<!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>
       <?php
include('footer_links.php');
?>

    </body>

</html>
