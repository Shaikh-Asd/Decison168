<?php
$page = 'coupon-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Coupon List | Decision168 Super-Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="mb-sm-0 font-size-18">Coupon's</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Add_coupon">
                                    <i class="mdi mdi-plus"></i> Add New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Quotes List</a></li> -->
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" width="12%">Sr.No</th>
                                                        <th scope="col" width="20%">Code</th>
                                                        <th scope="col" width="20%">Used</th>
                                                        <th scope="col" width="20%">Limit</th>
                                                        <th scope="col" width="20%">Balance</th>
                                                        <th scope="col" width="20%">Validity</th>
                                                        <th scope="col" width="20%">Package</th>
                                                        <th scope="col" width="20%">Action</th>
                                                        <th scope="col" width="20%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $all_users_coupon = $this->Superadmin_model->all_users_coupon();
                                                        $all_userscp = array();
                                                        $userscp_ex = array();
                                                        if($all_users_coupon)
                                                        {
                                                            foreach($all_users_coupon as $aucp)
                                                            {
                                                                $all_userscp[] = $aucp->used_package_coupon_id;
                                                            }
                                                        }
                                                        $userscp = implode(',',$all_userscp);
                                                        $userscp_ex = explode(',',$userscp);
                                                        //print_r($userscp_ex);
                                                        if($list)
                                                        {
                                                            $cnt = 1;
                                                            foreach($list as $l)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td><?php echo $l->code;?></td> 
                                                                    <td><?php 
                                                                    $total_cp = "0";
                                                                    $total_acp = "0";
                                                                    $total_ucp = "0";
                                                                    $currently_used = $this->Superadmin_model->users_active_coupon($l->co_id);
                                                                    if($currently_used)
                                                                    {
                                                                      $total_acp = $currently_used['count_rows'];
                                                                    }
                                                                    $total_ucp = count(array_keys($userscp_ex, $l->co_id));

                                                                    $total_cp = $total_acp + $total_ucp;
                                                                    if($total_cp == '0')
                                                                    {
                                                                     echo $total_cp;   
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <strong><a href="<?php echo base_url('super-admin/coupon-used-users/'.$l->co_id)?>" class="text-d" title="View Users"><?php echo $total_cp;?></a></strong>
                                                                    <?php
                                                                    }                               
                                                                    ?>   
                                                                    </td>
                                                                    <td><?php echo $l->co_limit;?></td><td><?php 
                                                                    if(is_numeric($l->co_limit))
                                                                    {
                                                                        $bal = $l->co_limit - $total_cp;
                                                                        echo $bal; 
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $l->co_limit;
                                                                    }
                                                                    ?></td>
                                                                    <td><?php echo $l->co_validity.' days';?></td>
                                                                    <td><?php 
                                                                    $pdetail = $this->Superadmin_model->package_detail($l->pack_id);
                                                                    if($pdetail)
                                                                    {
                                                                        echo $pdetail->pack_name;
                                                                    }
                                                                    ?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return CouponEditModal('<?php echo $l->co_id;?>','<?php echo $l->pack_id;?>')">View/Edit</a>
                                                                    </td>
                                                                    <td><?php 
                                                                    if($l->co_status == 'active')
                                                                        { 
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm me-1" onclick="return Coupon_Inactive('<?php echo $l->co_id;?>')">Active</a>
                                                                    <?php
                                                                        } 
                                                                    elseif($l->co_status == 'inactive')
                                                                        { 
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn bg-d text-white waves-effect waves-light btn-sm" onclick="return Coupon_Active('<?php echo $l->co_id;?>')">Inactive</a>
                                                                    <?php
                                                                        } 
                                                                    ?></td>
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

<!-- Add Logo Modal -->
<div class="modal fade" id="Add_coupon" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Coupon & it's package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="Add_couponForm" id="Add_couponForm" method="post">
                <div class="modal-body">  

                    <h4 class="card-title">Coupon Detail</h4>  
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label>Code <span class="text-danger">*</span></label>
                            <input class="form-control" name="code" id="code" placeholder="Enter Coupon Code..." type="text" required />
                            <span id="codeErr" class="text-danger"></span>
                        </div>
                    <!-- </div>
                    <div class="row mb-2"> -->
                        <div class="col-lg-6">
                            <label>Validity <span class="text-danger">* (in Days)</span></label>
                            <input class="form-control" name="co_validity" id="co_validity" placeholder="Enter Coupon Validity..." type="text" required />
                            <span id="co_validityErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row mb-2">   
                        <div class="col-lg-6">  
                            <label>Coupon Limitation <span class="text-danger">*</span></label>
                            <input class="form-control" name="co_limit" id="co_limit" placeholder="Enter Coupon Limitation..." type="text" required />
                            <span id="co_limitErr" class="text-danger"></span>                    
                        </div>                     
                        <div class="col-lg-6">
                            <label>Choose</span></label>
                            <select class="form-control select2" id="pack_clone" name="pack_clone" onchange="return pack_clone_details();" style="-webkit-appearance: menulist;">
                                <option value="cus_coupon">Custom Pack</option> 
                                 <?php
                                 if($packs)
                                 {
                                    foreach($packs as $pks)
                                    {
                                        if($pks->pack_id != '1')
                                        {
                                        ?>
                                        <option value="<?php echo $pks->pack_id;?>"><?php echo $pks->pack_name;?></option>
                                        <?php
                                        }
                                    }
                                 }
                                 ?>                            
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h4 class="card-title">Package Detail</h4>                     
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Package Name <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_name" name="pack_name" type="text" class="form-control" placeholder="Enter Package Name..." required="">
                            <span id="pack_nameErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Portfolio <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_portfolio" name="pack_portfolio" type="text" class="form-control" placeholder="Enter Total Portfolio..." required="">
                            <span id="pack_portfolioErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Goals <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_goals" name="pack_goals" type="text" class="form-control" placeholder="Enter Total Goals..." required="">
                            <span id="pack_goalsErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total KPIs <span class="text-danger">* (per goal)</span></label>
                            <div>
                                <input id="pack_goals_strategies" name="pack_goals_strategies" type="text" class="form-control" placeholder="Enter Total KPIs..." required="">
                            <span id="pack_goals_strategiesErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Projects <span class="text-danger">* (per portfolio)</span></label>
                            <div>
                                <input id="pack_projects" name="pack_projects" type="text" class="form-control" placeholder="Enter Total Projects..." required="">
                            <span id="pack_projectsErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Team Members <span class="text-danger">* (per portfolio)</span></label>
                            <div>
                                <input id="pack_team_members" name="pack_team_members" type="text" class="form-control" placeholder="Enter Total Team Members..." required="">
                            <span id="pack_team_membersErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Tasks <span class="text-danger">* (per project)</span></label>
                            <div>
                                <input id="pack_tasks" name="pack_tasks" type="text" class="form-control" placeholder="Enter Total Tasks..." required="">
                            <span id="pack_tasksErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Storage <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_storage" name="pack_storage" type="text" class="form-control" placeholder="Enter Total Storage..." required="">
                            <span id="pack_storageErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Content Planner <span class="text-danger">* (portfolio posts / mo)</span></label>
                            <div>
                                <input id="pack_content_planner" name="pack_content_planner" type="text" class="form-control" placeholder="Enter Total Content Planner..." required="">
                            <span id="pack_content_plannerErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Package Tagline</label>
                            <div>
                                <input id="pack_tagline" name="pack_tagline" type="text" class="form-control" placeholder="Enter Package Tagline...">
                            <span id="pack_taglineErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="Add_couponButton" class="btn btn-d">ADD</button>
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

                                    <!-- Coupon Edit Modal -->
                                    <div id="CouponEditModal" class="modal fade" tabindex="-1" aria-labelledby="#CouponEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="CouponEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

<!-- Change Modal -->
<div class="modal fade" id="change_label" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="change_label_content">
            
        </div>
    </div>
</div>

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
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
