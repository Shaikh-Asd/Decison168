<?php
$page = 'Team-Members-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Team Members List | Decision168</title>
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
                        <h4 class="mb-sm-0 font-size-18">Team Members</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <?php
                            if($count_temp < $exact_totalemp)
                            { 
                            ?>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_emp">
                                    <i class="mdi mdi-plus"></i> Add
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <span class="badge badge-soft-warning font-size-12">Package Members : <?php echo $exact_totalemp;?></span>
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

$rlist = $this->Company_model->getCompanyRolesAsc($this->session->userdata('d168_comp_id'));
?>
                        <div class="row">
                            <div class="col-lg-12">
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
                                                       if($cl->emp_status == 'inactive')
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
                                                    Total Members: <?php echo $total_users; ?>                 
                                                </span>
                                                <span class="badge badge-soft-success me-2">
                                                    Active Members: <?php echo $active_users; ?>
                                                </span>
                                                 <span class="badge badge-soft-danger me-2">
                                                   Inactive Members: <?php echo $inactive_users; ?>  
                                                 </span>
                                            </span>
                                        </h5>
                                        <div class="table-responsive">
                                            <table id="sa_ndatatable" class="table align-middle table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="display:none;">id</th>
                                                    <!-- <th scope="col">Sr.No</th> -->
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Date</th>
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
                                                    $empdel = $this->Company_model->getStudentByEmailId($l->emp_email);
                                                    ?>
                                                    <tr>
                                                        <td style="display:none;"><?php echo $l->cce_id;?></td>
                                                        <!-- <td><?php echo $cnt;?></td> -->
                                                        <td><?php echo $l->emp_email;?></td>
                                                        <td>
                                                        <?php
                                                        if($empdel)
                                                        {
                                                            if($empdel->role_in_comp == 'contacted_user')
                                                            {
                                                                echo 'Contacted User';
                                                            }
                                                            elseif($empdel->role_in_comp == 'employee')
                                                            {
                                                                echo 'Member';
                                                            }
                                                            elseif(is_numeric($empdel->role_in_comp))
                                                            {
                                                                $rdel = $this->Company_model->role_detail($empdel->role_in_comp); 
                                                                if($rdel)
                                                                {
                                                                    echo $rdel->role;
                                                                }
                                                            }
                                                        }
                                                        ?>  
                                                        </td>
                                                        <td><?php echo $l->cce_date;?></td>
                                                        <td>
                                                        <?php 
                                                        if(($l->contacted_user == 'no') && ($l->status != 'sent'))
                                                        {
                                                        if($l->emp_status == "active")
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return Inactive_Emp('<?php echo $l->cce_id;?>')">Active</a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return Active_Emp('<?php echo $l->cce_id;?>')">Inactive</a>
                                                        <?php
                                                        }
                                                        if($empdel)
                                                        {
                                                            if($empdel->role_in_comp == 'employee')
                                                            {
                                                                if($rlist)
                                                                {
                                                            ?>
                                                            <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return assign_emprole('<?php echo $l->cce_id;?>')">Assign Role</a>
                                                            <?php
                                                                }
                                                                else
                                                                {
                                                            ?>
                                                            <a href="<?php echo base_url('company/roles');?>" class="btn btn-d btn-sm">Assign Role</a>
                                                            <?php        
                                                                }
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return switch_emprole('<?php echo $l->cce_id;?>')">Switch Role</a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>  
                                                        <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return delete_Emp('<?php echo $l->cce_id;?>')">Delete</a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                            if($l->status == 'sent')
                                                            {
                                                                echo 'Not Registered!';
                                                            }
                                                            else
                                                            {
                                                                echo 'Contacted User!';
                                                            }                     
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

<!-- Add Emp Modal -->
<div class="modal fade" id="add_emp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_empForm" id="add_empForm" method="post">
            <input type="hidden" name="exact_totalemp" id="exact_totalemp" value="<?php echo $exact_totalemp;?>">
            <input type="hidden" name="count_temp" id="count_temp" value="<?php echo $count_temp + '1';?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <div class="input-group">
                                    <input type="email" name="insert_emp[]" class="form-control" id="insert_emp" placeholder="Enter Email Address" required="">
                                    <div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-plus-circle add_emp" title="Add">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="emp_wrapper">
                    </div>
                    <span class="text-danger" id="insert_empErr"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_empButton" class="btn btn-sm btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  

<div id="CompOpenWorkModal" class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="#CompOpenWorkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="CompOpenWorkModal_content" style="border: 2px solid #c7df19 !important">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="CompOpenWorkModalDel" class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="#CompOpenWorkModalDelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="CompOpenWorkModalDel_content" style="border: 2px solid #c7df19 !important">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                

<!-- Assign Emp Modal -->
<div class="modal fade" id="assign_emprolemodal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Assign Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="assign_emproleForm" id="assign_emproleForm" method="post">
            <input type="hidden" name="cce_id" id="cce_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="role_id" id="role_id" class=" form-control" data-placeholder="Assign Role..." required>
                                <option value=""><span>Select Role to Assign</span></option>
                                <?php                
                                if($rlist)
                                {
                                    foreach ($rlist as $rl) 
                                    {
                                    ?>
                                    <option value="<?php echo $rl->ccr_id;?>"><span><?php echo $rl->role; ?></span></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <span class="text-danger" id="cce_idErr"></span>
                        <span class="text-danger" id="role_idErr"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="assign_emproleButton" class="btn btn-sm btn-d">Assign</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  

<!-- Switch Role Modal -->
<div id="SwitchRoleModal" class="modal fade" aria-labelledby="#SwitchRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="SwitchRoleModal_content">
            
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
$(document).ready(function(){
    //ADD DEPARTMENT
    var add_emp = $('.add_emp'); //Add button selector
    var emp_wrapper = $('.emp_wrapper'); //Input field wrapper
    var exact_totalemp = $('#exact_totalemp').val();
    var a = $('#count_temp').val();
    var empHTML = '<div class="row"><div class="col-md-12"><div class="mb-2"><div class="input-group"><input type="email" name="insert_emp[]" class="form-control" id="insert_emp" placeholder="Enter Email Address" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_emp" title="Remove"></div></div></div></div></div>'; //New input field html
    var x2 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(add_emp).click(function(){
    // console.log(a);
    // console.log(exact_totalemp);
        if(parseInt(a) < parseInt(exact_totalemp))
          {
            $(emp_wrapper).prepend(empHTML); //Add field html
            a++;
          }
          else
          {
            $('#insert_empErr').html('Limit Exceeds!');
          }
    });

    //Once remove button is clicked
    $(emp_wrapper).on('click', '.remove_emp', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
        x2--; //Decrement field counter
        if(exact_totalemp != "")
        {
           a--;
          $('#insert_empErr').html('');
        }
    });

});
</script>
    </body>

</html>
