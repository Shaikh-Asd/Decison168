<?php
$page = 'tasks-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Subtasks Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker css -->
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
  
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Subtask</h4>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Add Subtasks</a></li> -->
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
                                        <h4 class="card-title mb-2">Add Subtask</h4>
                                        <form method="post" name="create_subtask_form" id="create_subtask_form" enctype="multipart/form-data" autocomplete="off">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                <div class="row">
                                                  <div class="col-md-6"> 
                                                    <?php
                                                        if(!empty($this->input->post('tid')))
                                                        {
                                                            $task = $this->Front_model->getTasksDetail($this->input->post('tid'));
                                                    ?>    
                                                    <input type="hidden" name="tid" value="<?php echo $this->input->post('tid');?>">   
                                                    <input type="hidden" name="dept" value="<?php echo $task->dept_id;?>"> 
                                                    <input type="hidden" name="task_dd" id="tdue_date" value="<?php if($task){ echo $task->tdue_date;}else{ echo $this->input->post('task_dd'); }?>"> 
                                                    <input type="hidden" name="get_gid" id="get_gid" value="<?php echo $task->gid;?>">
                                                    <input type="hidden" name="get_sid" id="get_sid" value="<?php echo $task->sid;?>">
                                                    <?php
                                                    $gdetail = $this->Front_model->GoalDetail($task->gid);
                                                    if($gdetail)
                                                    {
                                                    ?>
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date" value="<?php echo $gdetail->gstart_date;?>">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date" value="<?php echo $gdetail->gend_date;?>">
                                                    <?php
                                                    } 
                                                    else
                                                    {
                                                    ?>
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                    <?php
                                                    } 
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Task <span class="text-danger">*</span></label>
                                                        <input id="tname" name="tname" type="text" class="form-control" value="<?php echo $task->tname;?>" readonly="" required="">
                                                        <span id="tidErr" class="text-danger"></span>
                                                    </div>                                                    
                                                  </div>
                                                  <div class="col-md-6">
                                                      <?php
                                                      if(!empty($this->input->post('pid')))
                                                        {
                                                            $pro = $this->Front_model->getProjectById($this->input->post('pid'));
                                                        ?>
                                                        <input type="hidden" name="portfolio_id" value="<?php echo $this->input->post('port_id');?>">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Project </label>
                                                           <select class="form-select" id="tproject_assign" name="tproject_assign" readonly>
                                                                    <option value="<?php echo $this->input->post('pid');?>" selected=""><?php echo $pro->pname;?></option>
                                                            </select>
                                                                <span id="tproject_assignErr" class="text-danger"></span> 
                                                        </div>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <input type="hidden" name="portfolio_id" value="<?php echo $_COOKIE["d168_selectedportfolio"];?>">
                                                        <?php
                                                        }
                                                      ?>
                                                  </div>
                                                </div>
                                                <?php
                                                $check_tdue = "";
                                                if($task)
                                                {
                                                   $check_tdue = $task->tdue_date;
                                                }
                                                //echo $check_tdue;
                                                //echo date('Y-m-d');
                                                $today_d = date('Y-m-d');
                                                if($today_d <= $check_tdue)
                                                {
                                                ?>
                                                <div class="row mb-2 mt-2" style="border-top: 2px solid #eff2f7;padding: 30px;">
                                                    <input type="hidden" name="getYvalue" id="getYvalue" value="1">
                                                    <input type="hidden" name="data_below_insert" id="data_below_insert" value="1">
                                                    <div class="col-md-6">
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="stname">Sub Task <span class="text-danger">*</span></label> 
                                                            <input id="stname" name="stname1" class="form-control" placeholder="Enter Subtask Name..." required />
                                                            <span class="text-danger" id="tnameErr"></span>
                                                        </div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label">Description</label> 
                                                            <textarea class="form-control" id="tdes" name="tdes1" placeholder="Enter Subtask Description..." rows="3"></textarea></div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select" id="tpriority" name="tpriority1" required>
                                                                <option value="" selected>Set Subtask Priority</option>
                                                                <option value="high">High</option>
                                                                <option value="medium">Medium</option>
                                                                <option value="low">Low</option>
                                                            </select>
                                                            <span class="text-danger" id="tpriorityErr"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker3">
                                                                <input onmouseover="return st_duedate(1)" id="tdue_date1" name="tdue_date1" class="form-control" placeholder="Subtask Due Date" data-date-autoclose="true" data-date-container="#datepicker3" data-date-format="yyyy-m-d" data-provide="datepicker" required=""
                                                                />
                                                            </div>
                                                            <span class="text-danger" id="tdue_dateErr"></span>
                                                        </div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label">Note</label> 
                                                            <textarea class="form-control" id="tnote" name="tnote1" placeholder="Enter Subtask Note..." rows="3"></textarea>
                                                        </div>
                                                        <?php 
                                                        if(!empty($this->input->post('pid')))
                                                            {
                                                                $get_pdetail=$this->Front_model->getProjectById($this->input->post('pid'));
                                                                $porttm=$this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id); ?>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Assignee <span class="text-danger">*</span></label>
                                                            <select class="form-control team_member21" name="team_member21" style="line-height: 1.5;" required="">
                                                                <?php 
                                                                if($porttm)
                                                                    {
                                                                        foreach($porttm as $ptm)
                                                                            {
                                                                                $m=$this->Front_model->selectLogin($ptm->sent_to);
                                                                                if($m){
                                                                                if($m->reg_id!=$this->session->userdata('d168_id'))
                                                                                    { 
                                                                                    ?>
                                                                <option value="<?php echo $m->reg_id; ?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php 
                                                                                    }
                                                                if($m->reg_id==$this->session->userdata('d168_id'))
                                                                                    { 
                                                                    ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id'); ?>"><span>Assign To Me</span></option>
                                                                <?php 
                                                                                    }
                                                                                }
                                                                            }
                                                                    } 
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span class="text-danger" id="team_member21Err"></span>
                                                        </div>
                                                        <?php 
                                                        }
                                                        else
                                                        { 
                                                        ?>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Assignee <span class="text-danger">*</span></label>
                                                            <select class="form-control team_member21" name="team_member21" style="line-height: 1.5;" required="">
                                                                <option value="<?php echo $this->session->userdata('d168_id'); ?>">Assign To Me</option>
                                                            </select>
                                                            <span class="text-danger" id="team_member2Err"></span>
                                                        </div>
                                                        <?php 
                                                        } 
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="col-form-label">Attached File(s)</label>
                                                        <input class="form-control" id="tfile1" name="tfile1[]" multiple type="file" />
                                                        <span class="text-danger" id="tfile1Err"></span>
                                                    </div>
                                                    <div class="mb-3 col-md-1">
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label class="col-form-label">Estimate Time<span class="text-danger">*</span></label>
                                                        <input class="form-control " name="estimated_stime1" id="estimated_stime1" type="text" oninput = "gentime(event);" data-id="1"/>
                                                        <div  class="suggestionSContainer" id="suggestionSContainer1" ></div>    
                                                        <span id="estimated_stimeErr" class="text-danger"></span>
                                                        
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Subtask Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="stlink" name="stlink1[]" type="text" class="form-control" placeholder="Enter Subtask Link...">
                                                            <span id="stlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input id="stlink_comment" name="stlink_comment1[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment...">
                                                            <span id="stlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="add_dup_stlink1 btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <div class="stlink_div1">
                                                    </div>
                                                    <span id="stlink_validErr" class="text-danger"></span>
                                                    
                                                </div>                                                
                                                    <div class="dup_sub_task_fields">
                                                    
                                                    </div> 
                                                    <button type="button" class="col-md-2 m-2 mb-2 add_dup_sub_task_fields btn btn-d btn-sm" onclick="get_subtask_pid(document.getElementById('getYvalue').value)">Add Another Subtask</button>
                                                    <div class="row float-end">
                                                        <div class="justify-content-end float-end">
                                                            <button type="submit" id="create_subtask_button" class="btn btn-d btn-sm">Create Subtask</button>
                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                            <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                                Cancel 
                                                            </a>
                                                        </div>
                                                    </div>  
                                                    <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="row mb-2 mt-2" style="border-top: 2px solid #eff2f7;padding: 30px;">
                                                                <h5 class="text-danger">Cannot Add Subtask! Today's Date is greater then Task Duedate!</h5>
                                                            </div>
                                                            <div class="row float-end">
                                                                <div class="justify-content-end float-end">
                                                                    <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                                        Cancel 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }

                                                        }
                                                    ?>                                                       
                                                </div>
                                            </div>                                    
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

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
<!-- Add Team Member Modal
<div class="modal fade" id="pdetail_AddMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add to Project Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="pdetail_AddTeamMemberForm_task" id="pdetail_AddTeamMemberForm_task" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <?php
                            $pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                            $port_id = $pdetail->portfolio_id;
                            $pid = $pdetail->pid;
                            $porttm = $this->Front_model->getAccepted_PortTM($port_id);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                    $check_pm = $this->Front_model->check_pm($m->reg_id,$pid,$port_id);
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pm->pmember))
                                      {
                                        $get_pdetail = $this->Front_model->getProjectById($pid);
                                        if($m->reg_id != $get_pdetail->pcreated_by)
                                        {
                                        ?>
                                        <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                        <?php
                                        }
                                      }
                                    }
                                  }
                                  ?>
                            </select>                                                                               
                            <input type="hidden" name="selected_T_member" id="selected_T_member">
                            <span id="selected_T_memberErr" class="text-danger"></span>
                            <?php
                            if(!empty($this->input->post('pid')))
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $this->input->post('pid');?>">
                                <?php
                            }
                            else
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="imember_div">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="pdetail_AddTeamMemberButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  -->
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- form advanced init -->
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        
        <!-- form repeater js -->
        <script src="<?php echo base_url();?>assets/libs/jquery.repeater/jquery.repeater.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/task-create.init.js"></script>
        <!-- dropzone plugin -->
        <script src="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.js"></script>

    <?php
include('footer_links.php');
?>
<script type="text/javascript">
$(document).ready(function(){
    //debugger;
   var add_dup_sub_task_fields = $('.add_dup_sub_task_fields'); //Add button selector
   var dup_sub_task_fields = $('.dup_sub_task_fields'); //Input field wrapper
   
   if(!y)
   {
    var y = 1;
   }

   var x = 1; //Initial field counter is 1
   var y = y;
   //Once add button is clicked
   $(add_dup_sub_task_fields).click(function(){
              y++;

              var memberHTML = '<div class="row" style="border-top: 2px solid #eff2f7;padding: 30px;"><div class="col-md-6"><div class="mb-2 form-group"><label class="col-form-label"for="stname">Sub Task <span class="text-danger">*</span></label> <input id="stname"name="stname'+y+'"class="form-control"placeholder="Enter Subtask Name..." required=""> <span class="text-danger"id="tnameErr"></span></div><div class="mb-2 form-group"><label class="col-form-label">Description</label> <textarea class="form-control"id="tdes"name="tdes'+y+'"placeholder="Enter Subtask Description..."rows="3"></textarea></div><div class="mb-2 form-group"><label class="col-form-label"for="tname">Priority <span class="text-danger">*</span></label> <select class="form-select"id="tpriority"name="tpriority'+y+'" required=""><option value=""selected>Set Subtask Priority</option><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select> <span class="text-danger"id="tpriorityErr"></span></div></div><div class="col-md-6"><div class="mb-2 form-group"><label class="col-form-label"for="tname">Due Date <span class="text-danger">*</span></label><div class="input-group"id="datepicker3"><input onmouseover="return st_duedate2('+y+')"id="tdue_date'+y+'"name="tdue_date'+y+'"class="form-control"placeholder="Subtask Due Date"data-date-autoclose="true"data-date-container="#datepicker3"data-date-format="yyyy-m-d"data-provide="datepicker" required=""></div><span class="text-danger"id="tdue_dateErr"></span></div><div class="mb-2 form-group"><label class="col-form-label">Note</label> <textarea class="form-control"id="tnote"name="tnote'+y+'"placeholder="Enter Subtask Note..."rows="3"></textarea></div><?php if(!empty($this->input->post('pid'))){$get_pdetail=$this->Front_model->getProjectById($this->input->post('pid'));$porttm=$this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id); ?><div class="mb-2 form-group"><label class="col-form-label"for="tname">Assignee <span class="text-danger">*</span></label> <select class="form-control team_member21'+y+'  change_team_member"name="team_member2'+y+'"style="line-height:1.5" required=""><?php if($porttm){foreach($porttm as $ptm){$m=$this->Front_model->selectLogin($ptm->sent_to); if($m){ if($m->reg_id!=$this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id; ?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id==$this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id'); ?>"><span>Assign To Me</span></option><?php }}}} ?></select> <span class="text-danger"id="team_member21Err"></span></div><?php }else{ ?><div class="mb-2 form-group"><label class="col-form-label"for="tname">Assignee <span class="text-danger">*</span></label> <select class="form-control team_member21'+y+'  change_team_member"name="team_member2'+y+'"style="line-height:1.5" required=""><option value="<?php echo $this->session->userdata('d168_id'); ?>">Assign To Me</option></select> <span class="text-danger"id="team_member2Err"></span></div><?php } ?></div><div class="col-md-5"><label class="col-form-label">Attached File(s)</label><input class="form-control" id="tfile'+y+'"name="tfile'+y+'[]"multiple type="file"><span class="text-danger"id="tfile'+y+'Err"></span></div><div class="mb-3 col-md-1"></div><div class="mb-3 col-md-6"><div class="form-group mb-2"><label for="estimated_stime" class="col-form-label">Estimated Time <span class="text-danger">*</span></label><input oninput = "gentime(event);" data-id="'+y+'" id="estimated_stime'+y+'" name="estimated_stime'+y+'" type="text" class="form-control estimated_stime" placeholder="Enter time in hour format" required="" value=""><div class="suggestionSContainer" id="suggestionSContainer'+y+'" ></div><span id="estimated_timeErr" class="text-danger"></span></div></div><div class="row mb-2"><label class="col-form-label col-lg-12">Subtask Link(s) & Comment(s)</label><div class="col-lg-5"><input id="stlink" name="stlink'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link..."><span id="stlinkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="stlink_comment" name="stlink_comment'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment..."><span id="stlink_commentErr" class="text-danger"></span></div><div class="col-lg-2"><button type="button" class="add_dup_stlink'+y+' btn btn-d btn-sm">Add Another link</button></div></div><div class="stlink_div'+y+'"></div><span id="stlink_validErr" class="text-danger"></span><div class="row justify-content-end float-end mb-4"><button class="mb-2 bg-d btn btn-sm col-md-2 m-2 remove_dup_sub_task_fields text-white"type="button">Remove Subtask</button></div></div>'; //New input field html
           $(dup_sub_task_fields).append(memberHTML); //Add field html
           $('#getYvalue').val(y);

            //stlink clone
            var add_dup_stlink = $('.add_dup_stlink'+y); //Add button selector
            var stlink_div = $('.stlink_div'+y); //Input field wrapper
            var stlinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="stlink" name="stlink'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link..."><span id="stlinkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="stlink_comment" name="stlink_comment'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment..."><span id="stlink_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup2_stlink'+y+'" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_stlink'+y+'" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
               var a = 1; //Initial field counter is 1
               
               //Once add button is clicked
               $(add_dup_stlink).click(function(){
                //debugger;
                       $(stlink_div).append(stlinkHTML); //Add field html
               });
               
               $(stlink_div).on('click', '.add_dup2_stlink'+y, function(e){
                  //debugger;
                       $(stlink_div).append(stlinkHTML); 
               });

               //Once remove button is clicked
               $(stlink_div).on('click', '.remove_dup_stlink'+y, function(e){
                   e.preventDefault();
                   $(this).parent('div').parent('div').remove(); //Remove field html
                   a--; //Decrement field counter
               });
   });
   
   // $(dup_sub_task_fields).on('click', '.add_dup_sub_task_fields2', function(e){
   //    //debugger;
   //         y++;
   //         $(dup_sub_task_fields).append(memberHTML);
   // });

   //Once remove button is clicked
   $(dup_sub_task_fields).on('click', '.remove_dup_sub_task_fields', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       x--; //Decrement field counter
   });

   //stlink clone
            var add_dup_stlink = $('.add_dup_stlink1'); //Add button selector
            var stlink_div = $('.stlink_div1'); //Input field wrapper
            var stlinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="stlink" name="stlink1[]" type="text" class="form-control" placeholder="Enter Subtask Link..."><span id="stlinkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="stlink_comment" name="stlink_comment1[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment..."><span id="stlink_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup2_stlink1" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_stlink1" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
               var a = 1; //Initial field counter is 1
               
               //Once add button is clicked
               $(add_dup_stlink).click(function(){
                //debugger;
                       $(stlink_div).append(stlinkHTML); //Add field html
               });
               
               $(stlink_div).on('click', '.add_dup2_stlink1', function(e){
                  //debugger;
                       $(stlink_div).append(stlinkHTML); 
               });

               //Once remove button is clicked
               $(stlink_div).on('click', '.remove_dup_stlink1', function(e){
                   e.preventDefault();
                   $(this).parent('div').parent('div').remove(); //Remove field html
                   a--; //Decrement field counter
               });

});
</script>
    </body>

</html>
