<?php
$page = 'contacted-sales-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Contacted Sales List | Decision168 Super-Admin</title>
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
            <h4 class="mb-sm-0 font-size-18">Contacted Sales List</h4>

            <div class="page-title-right">
                <!-- <ol class="breadcrumb m-0">
                    
                </ol> -->
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
                                            <table id="datatable" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Sr.No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Users</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Contacted Date</th>
                                                        <th scope="col">Action</th>
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
                                                                    <td><?php echo $l->fname;?></td>
                                                                    <td><?php echo $l->email;?></td>
                                                                    <td><?php echo $l->phone;?></td>
                                                                    <td><?php echo $l->total_users;?></td>
                                                                    <td><?php echo $l->response_status;?></td>
                                                                    <td><?php echo date('Y-m-d',strtotime($l->contacted_date));?></td>
                                                                    <td>
                                                                    <?php
                                                                    $cus_pack_made = $this->Superadmin_model->check_cus_plan_made($l->cid,$l->reg_id);
                                                                    if(!empty($cus_pack_made))
                                                                    {
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return PackageViewModal('<?php echo $cus_pack_made->pack_id;?>')">View</a>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return PackageEditModal('<?php echo $cus_pack_made->pack_id;?>')">Edit</a>
                                                                    <?php
                                                                    if($cus_pack_made->pack_status == "active")
                                                                    {
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return Inactive_Pack('<?php echo $cus_pack_made->pack_id;?>')">Active</a>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return Active_Pack('<?php echo $cus_pack_made->pack_id;?>')">Inactive</a>
                                                                    <?php
                                                                    }
                                                                    
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return pass_cus_user_id('<?php echo $l->cid;?>','<?php echo $l->reg_id;?>');" data-bs-toggle="modal" data-bs-target="#Add_Package">Create Custom Package</a>
                                                                    <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return DeleteContactSalesReq('<?php echo $l->cid;?>')">Delete</a>
                                                                    <?php
                                                                    }  
                                                                    ?>
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

<!-- Add Package Modal -->
<div class="modal fade" id="Add_Package" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_packageForm" id="add_packageForm" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" name="pack_creation_page" id="pack_creation_page" value="contacted_page">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="contacted_id" id="contacted_id">
                    <input type="hidden" name="pack_stripe_link" id="pack_stripe_link" value="yes">
                    <span id="user_idErr" class="text-danger"></span>
                    <span id="contacted_idErr" class="text-danger"></span>

                    <h4 class="card-title">Company Details</h4> 
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label>Company Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name..." type="text" required />
                            <span id="company_nameErr" class="text-danger"></span>
                        </div>
                        <!-- </div>
                        <div class="row mb-2"> -->
                        <div class="col-lg-6">
                            <label>Exact No of Users <span class="text-danger">*</span></label>
                            <input class="form-control" name="company_users" id="company_users" placeholder="Enter Total Users..." type="text" required />
                            <span id="company_usersErr" class="text-danger"></span>
                        </div>
                    </div>
                    <hr>

                    <h4 class="card-title">Company Credentials</h4> 
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label>Company Username <span class="text-danger">*</span></label>
                            <input class="form-control" name="company_username" id="company_username" placeholder="Create Company Username..." type="text" required />
                            <span id="company_usernameErr" class="text-danger"></span>
                        </div>
                    <!-- </div>
                    <div class="row mb-2"> -->
                        <div class="col-lg-6">
                            <label>Company Password <span class="text-danger">*</span></label>
                            <input class="form-control" name="company_password" id="company_password" placeholder="Create Company Password..." type="text" required />
                            <span id="company_passwordErr" class="text-danger"></span>
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
                            <label class="col-form-label">Package Validity <span class="text-danger">* (in Days)</span><i class="bx bx-info-circle h4" style="cursor: pointer;padding-left: 10px;" title="30 - One Month&#010;90 - 3 Months&#010;180 - 6 Months&#010;270 - 9 Months&#010;365 - One Year"></i></label>
                            <div>
                                <input id="pack_validity" name="pack_validity" type="text" class="form-control" placeholder="Enter Package Validity..." required="">
                            <span id="pack_validityErr" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label class="col-form-label">Validity Period <span class="text-danger">*</span></label>
                            <div>
                                <input id="validity_period" name="validity_period" type="text" class="form-control" placeholder="Enter Validity Period..." required="">
                            <span id="validity_periodErr" class="text-danger"></span>
                            </div>
                        </div>
                    
                        <div class="col-lg-6">
                            <label class="col-form-label">Package Price <span class="text-danger">* (in $)</span></label>
                            <div>
                                <input id="pack_price" name="pack_price" type="text" class="form-control" placeholder="Enter Package Price..." required="">
                            <span id="pack_priceErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Portfolio <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_portfolio" name="pack_portfolio" type="text" class="form-control" placeholder="Enter Total Portfolio..." required="">
                            <span id="pack_portfolioErr" class="text-danger"></span>
                            </div>
                        </div>
                    <!-- </div>

                    <div class="row mb-2">-->                        
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
                    <!-- </div>

                    <div class="row mb-2"> -->
                        <!-- <div class="col-lg-6">
                            <label class="col-form-label">Total KPI Projects<span class="text-danger">* (per KPI)</span></label>
                            <div>
                                <input id="pack_goals_strategies_projects" name="pack_goals_strategies_projects" type="text" class="form-control" placeholder="Enter Total KPI Projects..." required="">
                            <span id="pack_goals_strategies_projectssErr" class="text-danger"></span>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Projects <span class="text-danger">* (per portfolio)</span></label>
                            <div>
                                <input id="pack_projects" name="pack_projects" type="text" class="form-control" placeholder="Enter Total Projects..." required="">
                            <span id="pack_projectsErr" class="text-danger"></span>
                            </div>
                        </div>
                    <!-- </div>

                    <div class="row mb-2"> -->
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
                    <!-- </div>

                    <div class="row mb-2"> -->
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
                    <button type="submit" id="add_packageButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  
    
                                    <!-- Package Edit Modal -->
                                    <div id="PackageEditModal" class="modal fade" tabindex="-1" aria-labelledby="#PackageEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="PackageEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Package View Modal -->
                                    <div id="PackageViewModal" class="modal fade" tabindex="-1" aria-labelledby="#PackageViewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="PackageViewModal_content">
                                                
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

        </div>
        <!-- END layout-wrapper -->
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
