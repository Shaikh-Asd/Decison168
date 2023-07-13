<?php
$page = 'registered-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Registered List | Decision168 Super-Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
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
            <h4 class="mb-sm-0 font-size-18">Registered List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a class="btn btn-sm bg-d text-white mb-2" href="<?php echo base_url('super-admin/deactivated-users');?>"><i class="bx bxs-user-detail"></i> Deactivated Users</a>
                    <a class="btn btn-sm btn-d text-white mb-2 ms-2" href="<?php echo base_url('super-admin/refund-list');?>"><i class="bx bx bx-detail"></i> Refund List</a>
                </ol>
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
                                        <h5 class="font-size-15 mb-3">
                                            <?php 
                                                $active_users = '0';
                                                $inactive_users = '0';
                                                $total_users = '0';
                                                if($list)
                                                {
                                                    $active_cnt = 0;
                                                    $inactive_cnt = 0;
                                                    foreach($list as $cl)
                                                    {
                                                       if($cl->reg_acc_status == 'deactivated')
                                                       {
                                                            $inactive_cnt++;
                                                       } 
                                                       else
                                                       {
                                                            $active_cnt++;
                                                       }
                                                    }
                                                    $active_users = $active_cnt;
                                                    $inactive_users = $inactive_cnt;
                                                    $total_users = $active_cnt + $inactive_cnt;
                                                }
                                            ?>
                                            <span>
                                                <span class="badge badge-soft-info me-2">
                                                    Total Users: <?php echo $total_users; ?>                 
                                                </span>
                                                <span class="badge badge-soft-success me-2">
                                                    Active Users: <?php echo $active_users; ?>
                                                </span>
                                                 <span class="badge badge-soft-danger me-2">
                                                   Inactive Users: <?php echo $inactive_users; ?>  
                                                 </span>
                                            </span>
                                        </h5>
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Reg ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Account Status</th>
                                                        <!-- <th scope="col">Phone</th> -->
                                                        <th scope="col">Reg. Date</th>
                                                        <th scope="col">Last Login</th>
                                                        <th scope="col">Package</th>
                                                        <!-- <th scope="col">Balance Amount (in $)</th> -->
                                                        <!-- <th scope="col">Amount Paid (in $)</th> -->
                                                        <!-- <th scope="col">Transaction ID</th> -->
                                                        <!-- <th scope="col">Package Expiry</th> -->
                                                        <!-- <th scope="col">Payment Status</th> -->
                                                        <!-- <th scope="col">Refund Package</th>
                                                        <th scope="col">Refund Invoice ID</th> -->
                                                        <!-- <th scope="col">Refund Amount (in $)</th> -->
                                                        <!-- <th scope="col">Refund Status</th> -->
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
                                                                    <td><?php echo $l->reg_id;?></td>
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
                                                                    <td><?php if($l->reg_acc_status == 'deactivated') { echo '<span class="text-danger">Inactive</span>'; } else { echo 'Active';}?></td>
                                                                    <!-- <td><?php echo $l->phone_number;?></td> -->
                                                                    <td><?php echo $l->reg_date;?></td>
                                                                    <td><?php if($l->last_login != '0000-00-00 00:00:00') { echo $l->last_login; }?></td>
                                                                    <td>
                                                                        <?php 
                                                                        $packD = $this->Superadmin_model->package_detail($l->package_id);
                                                                        if($packD)
                                                                        {
                                                                            echo $packD->pack_name;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <!-- <td><?php echo $l->balance_amount;?></td> -->
                                                                    <!-- <td><?php echo $l->paid_amount;?></td> -->
                                                                    <!-- <td><?php echo $l->txn_id;?></td> -->
                                                                    <!-- <td><?php 
                                                                    if($l->package_expiry == 'free_forever')
                                                                    {
                                                                        echo "Free Forever";
                                                                    }
                                                                    elseif($l->package_expiry == 'unlimited')
                                                                    {
                                                                        echo "Unlimited";
                                                                    }
                                                                    else
                                                                    {
                                                                    echo date('dS M Y g:i A',strtotime($l->package_expiry));
                                                                    }?></td> -->
                                                                    <!-- <td><?php 
                                                                    if($l->payment_status == "active") 
                                                                    { 
                                                                        echo "<span class='text-success'>SUCCEEDED</span>";
                                                                    }
                                                                    ?></td> -->
                                                                    <!-- <td>
                                                                        <?php 
                                                                        $packD = $this->Superadmin_model->package_detail($l->old_package);
                                                                        if($packD)
                                                                        {
                                                                            echo $packD->pack_name;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $l->refund_txn_id;?></td> -->
                                                                    <!-- <td><?php echo $l->refund_amount;?></td> -->
                                                                    <!-- <td>
                                                                    <?php
                                                                    if($l->refund_status == "refund")
                                                                    {
                                                                    ?>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Refund Initiated <i class="mdi mdi-chevron-down"></i></button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="javascript: void(0);" onclick="return refund_complete('<?php echo $l->reg_id;?>');">Refund Complete</a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                    // elseif($l->refund_status == "refund_succeeded")
                                                                    // {
                                                                    //     echo "<span class='text-success'>REFUND COMPLETED</span>";
                                                                    // }
                                                                    // elseif($l->refund_status == "no_refund")
                                                                    // {
                                                                    //     echo "<span class='text-primary'>NO REFUND</span>";
                                                                    // }
                                                                    ?>
                                                                    </td> -->
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
