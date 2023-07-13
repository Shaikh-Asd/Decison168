<?php
$page = 'roles-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Roles List | Decision168</title>
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
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Roles</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_role">
                                    <i class="mdi mdi-plus"></i> Add
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                   
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
                                            <table id="sa_ndatatable" class="table align-middle table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="display:none;">id</th>
                                                        <!-- <th scope="col">Sr.No</th> -->
                                                        <th scope="col">Role</th>
                                                        <th scope="col">Privilege</th>
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
                                                                    <td style="display:none;"><?php echo $l->ccr_id;?></td>
                                                                    <!-- <td><?php echo $cnt;?></td> -->
                                                                    <td><?php echo $l->role;?></td>
                                                                    <td><?php echo 'Access to '.$l->privilege;?></td>
                                                                    <td>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return edit_role('<?php echo $l->ccr_id;?>')">Edit</a>
                                                                    <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return delete_role('<?php echo $l->ccr_id;?>')">Delete</a>
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

<!-- Add Role Modal -->
<div class="modal fade" id="add_role" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_roleForm" id="add_roleForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-2">Role <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input id="role" name="role" type="text" class="form-control" placeholder="Enter Role..." required="">
                                <span id="roleErr" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row me-2 ms-2 mt-2">
<div class="card p-4" style="background: #f6f6f6; border:1px solid #e5e3e3;">
    <h4 class="card-title">Privileges:</h4>
      <input class="selected_rpivilege_option" type="hidden" name="rpivilege_option" id="rpivilege_option" value="all">
      <span id="rpivilege_optionErr" class="text-danger"></span>
    <div class="card-body" style="background: #ffffff;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#rpivilege_opt_all" role="tab" aria-selected="false" onclick="return choose_rpivilege_option('all');">
                    <span class="d-sm-block">
                    All
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#rpivilege_opt_cus" role="tab" aria-selected="true" onclick="return choose_rpivilege_option('cus');">
                    <span class="d-sm-block">
                    Custom
                    </span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="rpivilege_opt_all" role="tabpanel">
                <p class="mb-0">
                    <ul class="list-unstyled fw-medium">
                        <li>
                            Access to :
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Portfolio
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Goals & strategies</span>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Projects</span>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Content planner
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Task & subtask
                        </li>
                    </ul>
                </p>
            </div>
            <div class="tab-pane" id="rpivilege_opt_cus" role="tabpanel">
                <p class="mb-0">
                    <div class="row mb-2">
                    Access to :
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt" type="checkbox" name="cus_privilege[]" value="portfolio" onclick="return view_option_disable();">
                            <label class="form-check-label">Portfolio</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt" type="checkbox" name="cus_privilege[]" value="goals, strategies" onclick="return view_option_disable();">
                            <label class="form-check-label">Goals & strategies</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt" type="checkbox" name="cus_privilege[]" value="projects" onclick="return view_option_disable();">
                            <label class="form-check-label">Projects</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt" type="checkbox" name="cus_privilege[]" value="content planner" onclick="return view_option_disable();">
                            <label class="form-check-label">Content planner</label>
                        </div>
                      </div> 
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="cus_privilege[]" value="view" id="view_only_opt" onclick="return view_option_visible();">
                            <label class="form-check-label">View only</label>
                        </div>
                      </div>                      
                    </div>
                    <span class="text-danger">(* Member can access task & subtask! (Not in view option))</span>
                </p>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_roleButton" class="btn btn-sm btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  

<!-- Edit Modal -->
<div id="EditRoleModal" class="modal fade" tabindex="-1" aria-labelledby="#EditRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="EditRoleModal_content">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                
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
<script type="text/javascript">
function view_option_visible()
{
    if($('#view_only_opt').prop('checked') == true)
    {
        $('.other_opt').prop('checked', false);
        $('.other_opt').attr('disabled', true); 
    }
    else
    {
        $('.other_opt').removeAttr('disabled'); 
    } 
}

function view_option_disable()
{
    if($('.other_opt:checkbox:checked').prop('checked') == true)
    {
        $('#view_only_opt').prop('checked', false);
        $('#view_only_opt').attr('disabled', true); 
    }
    else
    {
        $('#view_only_opt').removeAttr('disabled'); 
    } 
}
</script>
    </body>

</html>
