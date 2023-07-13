<?php
$page = 'supporters';
?>
<!doctype html>
<html lang="en">
    <head>        
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Supporters | Decision168 Super-Admin</title>
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
                                            <h4 class="mb-sm-0 font-size-18">Supporters</h4>
                                        </div>
                                        <div class="col-9">
                                            <ul class="nav nav-pills justify-content-end">
                                                <li class="nav-item">
                                                    <a class="btn btn-sm btn-d text-white" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addSupporter">
                                                        <i class="mdi mdi-plus"></i> Add Resources
                                                    </a>
                                                </li>
                                            </ul>
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
                                                        <th scope="col">Invitation Status</th>
                                                        <th scope="col">Reg. Date</th>
                                                        <th scope="col">Last Login</th>
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
                                                                        if($l->supporter_mail == 1 && $l->supporter_approve == ""){
                                                                            echo '<span class="badge badge-soft-warning">Invited</span>';
                                                                        }else if($l->supporter_mail == 1 && $l->supporter_approve == "no"){
                                                                            echo '<span class="badge badge-soft-danger">Denied</span>';
                                                                        }else if($l->supporter_mail == 1 && $l->supporter_approve == "yes" && $l->role == "supporter"){
                                                                            echo '<span class="badge badge-soft-success">Approved</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $l->reg_date;?></td>
                                                                    <td><?php if($l->last_login != '0000-00-00 00:00:00') { echo $l->last_login; }?></td>
                                                                    <td>
                                                                        <?php
                                                                        if($l->supporter_approve == 'no'){
                                                                            ?>
                                                                            <a href="javascript:void(0)" class="btn btn-dark btn-sm" onclick="return removeSupporter(<?php echo $l->reg_id;?>,'<?php echo $l->supporter_approve;?>')">Remove</a>
                                                                            <?php
                                                                        }else{
                                                                            if($l->supporter_status == 'active'){
                                                                                ?>
                                                                                <div class="square-switch">
                                                                                    <input type="checkbox" id="square-switch<?php echo $cnt;?>" switch="bool" onchange="return removeSupporter(<?php echo $l->reg_id;?>,'<?php echo $l->supporter_approve;?>')" checked />
                                                                                    <label for="square-switch<?php echo $cnt;?>" data-on-label="Yes"
                                                                                        data-off-label="No" class="m-0"></label>
                                                                                </div>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <div class="square-switch">
                                                                                    <input type="checkbox" id="square-switch<?php echo $cnt;?>" switch="bool" onchange="return removeSupporter(<?php echo $l->reg_id;?>,'<?php echo $l->supporter_approve;?>')" />
                                                                                    <label for="square-switch<?php echo $cnt;?>" data-on-label="Yes"
                                                                                        data-off-label="No" class="m-0"></label>
                                                                                </div>
                                                                                <?php
                                                                            }
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
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="pb-3 page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Invited Email Addresses</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Sr.No</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Invitation Status</th>
                                                        <th scope="col">Invited On</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($elist)
                                                        {
                                                            $cnt = 1;
                                                            foreach($elist as $el)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td><?php echo $el->email_address;?></td>
                                                                    <td>
                                                                        <?php
                                                                        if($el->approve == "yes"){
                                                                            echo '<span class="badge badge-soft-warning">Approved</span>';
                                                                        }else if($el->approve == "no"){
                                                                            echo '<span class="badge badge-soft-danger">Denied</span>';
                                                                        }else if($el->approve == ""){
                                                                            echo '<span class="badge badge-soft-success">Invited</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $el->sent_on;?></td>
                                                                    <td>
                                                                        <?php
                                                                        if($el->approve == "no" || $el->approve == ""){
                                                                            ?>
                                                                            <a href="javascript:void(0)" class="btn btn-dark btn-sm" onclick="return removeSupporterEmail(<?php echo $el->invite_id;?>)">Remove</a>
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

        </div>
        <!-- END layout-wrapper -->
        <!-- Add Supporter Modal -->
        <div class="modal fade" id="addSupporter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <h5 class="modal-title" id="staticBackdropLabel">Add Supporter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="addSupporterForm" id="addSupporterForm" method="post">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-lg-7">
                                    <?php
                                    $notSupp = $this->Superadmin_model->getNotSupporters();
                                    ?>
                                    <select name="supporter_member" id="supporter_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Supporters..." onchange="return supporter_members();" style="width: 100%">
                                        <?php
                                        if($notSupp){
                                          foreach ($notSupp as $ns) {
                                            ?>
                                            <option value="<?php echo $ns->reg_id;?>"><span><?php echo $ns->first_name.' '.$ns->last_name; ?></span></option>
                                            <?php
                                            }
                                          }
                                          ?>
                                    </select>                                                  
                                    <input type="hidden" name="selected_S_member" id="selected_S_member">
                                    <span id="selected_S_memberErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-5">
                                    <button type="button" class="add_dup_ismember btn btn-d text-white">Invite though Email Id</button>
                                </div>
                            </div>
                            <div class="ismember_div">
                            </div>
                            <span id="ismemberErr" class="text-danger"></span>
                            <span id="err_valid" class="text-danger"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="addSupporterButton" class="btn btn-d">Invite</button>
                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                        </div>                
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->
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
        <script type="text/javascript">
            $(document).ready(function(){
                var add_dup_ismember = $('.add_dup_ismember'); //Add button selector
                var ismember_div = $('.ismember_div'); //Input field wrapper
                var memberHTML = '<div class="row mb-2"><div class="col-lg-7"><input type="email" id="supporter_email" name="supporter_email[]" class="form-control" placeholder="Enter Email ID..."><span id="supporter_emailErr" class="text-danger"></span></div><div class="col-lg-5 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_ismember2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_imember" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
                var x = 1; //Initial field counter is 1
               
                //Once add button is clicked
                $(add_dup_ismember).click(function(){
                       $(ismember_div).append(memberHTML); //Add field html
                });

                $(ismember_div).on('click', '.add_dup_ismember2', function(e){
                  //
                       $(ismember_div).append(memberHTML); 
                });
               
                //Once remove button is clicked
                $(ismember_div).on('click', '.remove_dup_imember', function(e){
                   e.preventDefault();
                   $(this).parent('div').parent('div').remove(); //Remove field html
                   x--; //Decrement field counter
                });
            });

            function supporter_members()
            {
               var selected = [];
              for (var option of document.getElementById('supporter_member').options) {
                if (option.selected) {
                  selected.push(option.value);
                }
              }
             
              document.getElementById("selected_S_member").value = selected;
            }
        </script>
    </body>
</html>