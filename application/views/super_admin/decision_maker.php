<?php
$page = 'decision_maker';
?>
<!doctype html>
<html lang="en">
    <head>        
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Decision Makers | Decision168 Super-Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                            <h4 class="mb-sm-0 font-size-18">Decision Makers</h4>
                                        </div>
                                        <div class="col-9">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-lg-12">
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Sr.No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Applied On</th>
                                                        <th scope="col">Approved On</th>
                                                        <th scope="col">Active</th>
                                                        <th scope="col">Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($list)
                                                        {
                                                            $cnt = 1;
                                                            foreach($list as $l)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td>
                                                                    <?php echo ucfirst($l->first_name)." ".ucfirst($l->middle_name)." ".ucfirst($l->last_name);
                                                                    if(($l->reg_acc_status == 'deactivated') && ($l->send_activate_req == 'yes'))
                                                                    {
                                                                    ?>
                                                                    <a href="javascript:void(0)" id="activate_acc<?php echo $l->reg_id?>" data-link="<?php echo ('user-activate-account-request/'.$l->reg_id.'/1/2');?>" class="btn btn-d btn-sm me-1" onclick="return ActivateUserAccount('<?php echo $l->reg_id?>');">RE-ENABLE ACCOUNT</a>
                                                                    <?php
                                                                    }
                                                                    ?>                                  
                                                                    </td>
                                                                    <td><?php echo $l->email_address;?></td>
                                                                    <td>
                                                                        <?php
                                                                        if($l->expert_approve == 1 && $l->expert == 1){
                                                                            echo '<span class="badge badge-soft-success">Approved</span>';
                                                                        }else{
                                                                            ?>
                                                                            <button onclick="return approveExpert(<?php echo $l->reg_id;?>)" class="btn btn-warning">Approve</button>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $l->expert_apply_date;?></td>
                                                                    <td><?php if($l->expert_approved_date != '0000-00-00 00:00:00') { echo $l->expert_approved_date; }?></td>
                                                                    <td>
                                                                        <?php
                                                                        if($l->expert_status == 'active'){
                                                                            ?>
                                                                            <div class="square-switch">
                                                                                <input type="checkbox" id="square-switch<?php echo $cnt;?>" switch="bool" onchange="return expertStatus(<?php echo $l->reg_id;?>,'<?php echo $l->expert_status;?>')" checked />
                                                                                <label for="square-switch<?php echo $cnt;?>" data-on-label="Yes"
                                                                                    data-off-label="No" class="m-0"></label>
                                                                            </div>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <div class="square-switch">
                                                                                <input type="checkbox" id="square-switch<?php echo $cnt;?>" switch="bool" onchange="return expertStatus(<?php echo $l->reg_id;?>,'<?php echo $l->expert_status;?>')" />
                                                                                <label for="square-switch<?php echo $cnt;?>" data-on-label="Yes"
                                                                                    data-off-label="No" class="m-0"></label>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return ViewRegisteredInfoModal('<?php echo $l->reg_id;?>')">View</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $cnt++;
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
        <!-- View Registered Info Modal Modal -->
        <div id="ViewRegisteredInfoModal" class="modal fade" tabindex="-1" aria-labelledby="#ViewRegisteredInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="ViewRegisteredInfoModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
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