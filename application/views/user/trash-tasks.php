<?php
$page = 'trash-tasks';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Trash Tasks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
            <h4 class="mb-sm-0 font-size-18">Trash Tasks</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trash Tasks</a></li>
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
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <table id="datatable5" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Task</th>
                                                        <th scope="col">Assignee</th>
                                                        <th scope="col">Project</th>
                                                        <th scope="col">Priority</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($TrashTasks)
                                                        {
                                                            foreach($TrashTasks as $l)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $l->tcode;?>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1"><?php echo $l->tname;?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $l->first_name.' '.$l->last_name;?>
                                                                    </td>       
                                                                    <td>
                                                                            <?php
                                                                            if($l->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->file_itgetProjectById2($l->tproject_assign);
                                                                                echo $getPname->pname;
                                                                            }
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $l->tpriority;?>
                                                                    </td>
                                                                    <td>
                                                                        <?php 
                                                                        if($l->tstatus == 'to_do')
                                                                        {
                                                                            echo "To Do";
                                                                        }
                                                                        if($l->tstatus == 'in_progress')
                                                                        {
                                                                            echo "In Progress";
                                                                        }
                                                                        if($l->tstatus == 'done')
                                                                        {
                                                                            echo "Done";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $l->tdue_date;?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $l->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l->tid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>       
<?php
include('footer_links.php');
?>

    </body>

</html>
