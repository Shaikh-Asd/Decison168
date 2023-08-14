<?php
$page = 'tasks-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Tasks Edit</title>
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

    <body data-sidebar="dark" onload="return get_project_id2();">
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
                        <h4 class="mb-sm-0 font-size-18">Edit</h4>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks Edit</a></li> -->
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
if($tdetail)
{
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">Edit Task</h4>
                                        <form method="post" name="edit_task_form" id="edit_task_form" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid;?>">
                                            <input type="hidden" name="tcode" id="tcode" value="<?php echo $tdetail->tcode;?>">
                                            <input type="hidden" name="tfile_old" id="tfile_old" value="<?php echo $tdetail->tfile;?>">
                                            <input type="hidden" name="get_gid" id="get_gid" value="<?php echo $tdetail->gid;?>">
                                            <input type="hidden" name="get_sid" id="get_sid" value="<?php echo $tdetail->sid;?>">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                       <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Task <span class="text-danger">*</span></label>
                                                            <input id="tname" name="tname" type="text" class="form-control" placeholder="Enter Task Name..." required="" value="<?php echo $tdetail->tname;?>">
                                                            <span id="tnameErr" class="text-danger"></span>
                                                       </div>
                                                    <div class="form-group mb-2">
                                                        <label class="col-form-label">Description</label>
                                                        <textarea class="form-control" id="tdes" name="tdes" rows="7" placeholder="Enter Task Description..."><?php echo $tdetail->tdes;?></textarea>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="col-form-label">Note</label>
                                                            <textarea class="form-control" id="tnote" name="tnote" rows="7" placeholder="Enter Task Note..."><?php echo $tdetail->tnote;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                        if($plist || $accepted_plist)
                                                        {
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label col-lg-2">Project</label>
                                                        <select class="form-select" name="tproject_assign" id="tproject_assign2" onchange="return get_project_id2();">
                                                                <?php
                                                                    foreach($plist as $pl)
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $pl->pid;?>" <?php if($tdetail->tproject_assign == $pl->pid){ echo "selected";}?>><?php echo $pl->pname;?></option>
                                                                <?php
                                                                    }
                                                                    foreach($accepted_plist as $apl)
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $apl->pid;?>" <?php if($tdetail->tproject_assign == $apl->pid){ echo "selected";}?>><?php echo $apl->pname;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <option value="" <?php if($tdetail->tproject_assign == 0){ echo "selected";}?>>Select Project</option>
                                                            </select>
                                                            <span id="tproject_assignErr" class="text-danger"></span>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="dept" class="col-form-label">Identify Department <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="dept" id="dept" required>
                                                            <option value="">Select Department</option>
                                                            <?php
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                            $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                            if($check_port_dept) 
                                                            {
                                                                foreach($check_port_dept as $p_dept)
                                                                {
                                                                ?>
                                                                <option value="<?php echo $p_dept->portfolio_dept_id;?>" <?php if($p_dept->portfolio_dept_id == $tdetail->dept_id) { echo "selected";}?>><?php echo $p_dept->department;?></option>
                                                                <?php  
                                                                }         
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="deptErr" class="text-danger"></span>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Portfolio <span class="text-danger">*</span></label>
                                                        <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" readonly required>
                                                        <span id="portfolio_nameErr" class="text-danger"></span>
                                                    </div>
                                                    <input type="hidden" name="get_pub_date" id="get_pub_date">
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" onmouseover="return pub_tdue_date()" class="form-control" id="pub_tdue_date_id" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" value="<?php echo $tdetail->tdue_date;?>" required="">
                                                            </div>
                                                            <span id="pub_tdue_date_idErr" class="text-danger"></span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                     <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select" name="tpriority" id="tpriority" required="">
                                                                <option value="high" <?php if($tdetail->tpriority == 'high'){ echo "selected";}?>>High</option>
                                                                <option value="medium" <?php if($tdetail->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                                                <option value="low" <?php if($tdetail->tpriority == 'low'){ echo "selected";}?>>Low</option>
                                                            </select>
                                                            <span id="tpriorityErr" class="text-danger"></span>
                                                    </div>
                                                    
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Assignee <span class="text-danger">*</span></label>
                                                        <?php
                                                         $get_pdetail = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                         $porttm = $this->Front_model->getAccepted_PortTM($tdetail->portfolio_id);
                                                        ?>
                                                            <select name="team_member2" id="team_member2" class="form-control change_team_member" style="line-height: 1.5;" required="">
                                                                <?php                                    
                                                            if($tdetail->tproject_assign != 0)
                                                            {
                                                            if($porttm){
                                                                foreach ($porttm as $ptm) {
                                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                    if($m)
                                                                    {
                                                                    if($m->reg_id != $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $m->reg_id;?>" <?php if($tdetail->tassignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                    <?php
                                                                        }
                                                                    if($m->reg_id == $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            </select> 
                                                            <span id="team_member2Err" class="text-danger"></span>
                                                        <!-- <?php
                                                        if($get_pdetail)
                                                        {
                                                            if($get_pdetail->pcreated_by == $this->session->userdata('d168_id'))
                                                            {
                                                        ?>
                                                            <div class="col-lg-3 mt-1">
                                                                <button type="button" class="btn btn-d btn-sm" data-bs-toggle="modal" data-bs-target="#pdetail_AddMember" title="Add Team Member">Add Member</button>
                                                            </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?> -->
                                                        </div>
                                                      </div>
                                                    <?php
                                                    if(!empty($tdetail->tlink))
                                                    {
                                                        $tlink = explode(',', $tdetail->tlink);
                                                        $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Task Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" value="<?php echo $tlink[0];?>">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" value="<?php if(!empty($tlink_comment[0])){ echo $tlink_comment[0]; }?>">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="add_dup_tlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    else
                                                    {

                                                            if ($tdetail->estimated_time) {
                                                                $time_in = 'block';
                                                                $checked = 'checked';
                                                                $val = 'false';
                                                            } else {
                                                                $time_in = 'none';
                                                                $checked = '';
                                                                $val = 'true';
                                                            }
                                                            ?>
                                                            <div style="margin-top: 10px; margin-left: 605px;" >
                                                                <input type="checkbox" name="task_track" id="task_track" class="form-check-input" onclick="return taskTrack()" <?php echo $checked; ?>>
                                                                <label class="control-label" for="task_track">Track your task</label>
                                                                <input type="hidden" name="track_value_get" id="track_value_get" value="<?php echo $val; ?>" >
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="col-form-label">Attached File(s)</label>
                                                                <input class="form-control" name="tfile[]" id="tfile1" type="file" multiple="" />
                                                                    <span id="tfile1Err" class="text-danger"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-1">
                                                            </div>
                                                            <div class="mb-3 col-md-6" id="taskTrack" style="display:<?php echo $time_in; ?>">
                                                            <div class="form-group mb-2">
                                                                        <label for="estimated_time" class="col-form-label">Estimated Time  (For example: XhXm)</label>
                                                                        <input id="estimated_time" name="estimated_time" type="text" class="form-control" placeholder="Enter time in hour format" value="<?php echo $tdetail->estimated_time;?>">
                                                                <div id="suggestionContainer"></div>        
                                                                <span id="estimated_timeErr" class="text-danger"></span>
                                                             </div>
                                                             </div>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Task Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" placeholder="Enter Task Link...">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" placeholder="Enter Task Link Comment...">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="add_dup_tlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="tlink_div">
                                                    <?php
                                                    if(!empty($tdetail->tlink))
                                                    {
                                                        $tlink = explode(',', $tdetail->tlink);
                                                        $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                        $tlcount = count($tlink); 
                                                        if($tlcount > 0)
                                                        {
                                                            for ($i=1; $i<$tlcount; $i++)
                                                            {
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12"></label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" value="<?php echo $tlink[$i];?>">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" value="<?php if(!empty($tlink_comment[$i])){ echo $tlink_comment[$i]; }?>">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-2 card-title mb-2">
                                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_tlink2" style="margin-left: 30px;">
                                                                <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
                                                            </button>
                                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_tlink" style="margin-left: 15px;">
                                                                <span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                    <span id="link_validErr" class="text-danger"></span>
                                                    
                                                             
                                                    </div>
                                                    <div class="dup_sub_task_fields mt-5">
                                                    
                                                    </div> 
                                                    <input type="hidden" name="getYvalue" id="getYvalue" value="1">
                                                    <input type="hidden" name="data_below_insert" id="data_below_insert" value="1">
                                                    <?php
                                                    $check_tdue = $tdetail->tdue_date;
                                                    //echo $check_tdue;
                                                    //echo date('Y-m-d');
                                                    $today_d = date('Y-m-d');
                                                    if($today_d <= $check_tdue)
                                                    {
                                                    ?>
                                                    <button type="button" class="col-md-2 m-2 mb-2 add_dup_sub_task_fields btn btn-d btn-sm" onclick="get_subtask_pid_task_edit(document.getElementById('getYvalue').value)">Add Subtask</button>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="justify-content-end float-end">
                                                        <button type="submit" id="edit_task_button" class="btn btn-d btn-sm">Save Changes</button>
                                                        <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                        <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                         Cancel 
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>                      
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
<?php
}
else
{
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">Only Task Assignee and Task Created User can Edit Task Details!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
}
?>
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
<!-- Add Team Member Modal -->
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
                            $pdetail = $this->Front_model->getProjectById($tdetail->tproject_assign);
                            $port_id = $pdetail->portfolio_id;
                            $pid = $pdetail->pid;
                            $porttm = $this->Front_model->getAccepted_PortTM($port_id);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                    if($m)
                                    {
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
                                  }
                                  ?>
                            </select>                                                    
                            <input type="hidden" name="selected_T_member" id="selected_T_member">
                            <span id="selected_T_memberErr" class="text-danger"></span>
                            <?php
                            if(!empty($tdetail->tproject_assign))
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign;?>">
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
</div>  
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
<!-- <script type="text/javascript">
    // FOR EDIT TASK FORM ----------------------------------------
  $('#edit_task_form').on('submit',function(event){   
  debugger; 
    event.preventDefault(); // Stop page from refreshing
    $('#edit_task_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_task',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          //debugger;
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('File Uploading Error! Please Try Again!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            //var tid = data.tid;
            //window.location = base_url+'tasks-overview/'+tid;
            window.location = document.referrer;
          }
          //console.log(data);
       }// success msg ends here

     });
  });
    </script> -->
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
    //debugger;
           y++;
              var memberHTML = '<div class="row" style="border-top: 2px solid #eff2f7;padding: 30px;"><div class="col-md-6"><div class="mb-2 form-group"><label class="col-form-label"for="stname">Sub Task <span class="text-danger">*</span></label> <input id="stname"name="stname'+y+'"class="form-control"placeholder="Enter Subtask Name..." required=""> <span class="text-danger"id="tnameErr"></span></div><div class="mb-2 form-group"><label class="col-form-label">Description</label> <textarea class="form-control"id="tdes"name="tdes'+y+'"placeholder="Enter Subtask Description..."rows="3"></textarea></div><div class="mb-2 form-group"><label class="col-form-label"for="tname">Priority <span class="text-danger">*</span></label> <select class="form-select"id="tpriority"name="tpriority'+y+'" required=""><option value=""selected>Set Subtask Priority</option><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select> <span class="text-danger"id="tpriorityErr"></span></div></div><div class="col-md-6"><div class="mb-2 form-group"><label class="col-form-label"for="tname">Due Date <span class="text-danger">*</span></label><div class="input-group"id="datepicker3"><input onmouseover="return st_duedate2('+y+')"id="tdue_date'+y+'"name="tdue_date'+y+'"class="form-control"placeholder="Subtask Due Date"data-date-autoclose="true"data-date-container="#datepicker3"data-date-format="yyyy-m-d"data-provide="datepicker" required=""></div><span class="text-danger"id="tdue_dateErr"></span></div><div class="mb-2 form-group"><label class="col-form-label">Note</label> <textarea class="form-control"id="tnote"name="tnote'+y+'"placeholder="Enter Subtask Note..."rows="3"></textarea></div><?php if(!empty($this->input->post('pid'))){$get_pdetail=$this->Front_model->getProjectById($this->input->post('pid'));$porttm=$this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id); ?><div class="mb-2 form-group"><label class="col-form-label"for="tname">Assignee <span class="text-danger">*</span></label> <select class="form-control team_member21'+y+'  change_team_member"name="team_member2'+y+'"style="line-height:1.5" required=""><?php if($porttm){foreach($porttm as $ptm){$m=$this->Front_model->selectLogin($ptm->sent_to); if($m){ if($m->reg_id!=$this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id; ?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id==$this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id'); ?>"><span>Assign To Me</span></option><?php }}}} ?></select> <span class="text-danger"id="team_member21Err"></span></div><?php }else{ ?><div class="mb-2 form-group"><label class="col-form-label"for="tname">Assignee <span class="text-danger">*</span></label> <select class="form-control team_member21'+y+'  change_team_member"name="team_member2'+y+'"style="line-height:1.5" required=""><option value="<?php echo $this->session->userdata('d168_id'); ?>">Assign To Me</option></select> <span class="text-danger"id="team_member2Err"></span></div><?php } ?></div><div style=" margin-left: 570px;"><input type="checkbox" name="stask_track'+y+'" id="stask_track'+y+'" class="form-check-input" onclick="return subtaskTrack('+y+')"><label class="control-label" for="stask_track"> Track your subtask</label><input type="hidden" name="strack_value_get'+y+'" id="strack_value_get'+y+'" value="true" ></div><div class="col-md-5"><label class="col-form-label">Attached File(s)</label><input class="form-control" id="tfile'+y+'"name="tfile'+y+'[]"multiple type="file"><span class="text-danger"id="tfile'+y+'Err"></span></div><div class="mb-3 col-md-1"></div><div class="mb-3 col-md-6" id="staskTrack'+y+'" style="display:none;"><div class="form-group mb-2"><label for="estimated_stime" class="col-form-label">Estimated Time  (For example: XhXm)</label><input oninput = "gentime(event);" data-id="'+y+'" id="estimated_stime'+y+'" name="estimated_stime'+y+'" type="text" class="form-control estimated_stime" placeholder="Enter time in hour format"  value=""><div class="suggestionSContainer" id="suggestionSContainer'+y+'" ></div><span id="estimated_timeErr" class="text-danger"></span></div></div><div class="row mb-2"><label class="col-form-label col-lg-12">Subtask Link(s) & Comment(s)</label><div class="col-lg-5"><input id="stlink" name="stlink'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link..."><span id="stlinkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="stlink_comment" name="stlink_comment'+y+'[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment..."><span id="stlink_commentErr" class="text-danger"></span></div><div class="col-lg-2"><button type="button" class="add_dup_stlink'+y+' btn btn-d btn-sm">Add Another link</button></div></div><div class="stlink_div'+y+'"></div><span id="stlink_validErr" class="text-danger"></span><div class="row justify-content-end float-end mb-4"><button class="mb-2 bg-d btn btn-sm col-md-2 m-2 remove_dup_sub_task_fields text-white"type="button">Remove Subtask</button></div></div>'; //New input field html
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

//                var timeInputEdit = document.getElementById('estimated_stime');
// var suggestionContainerEdit = document.getElementById('suggestionSContainer');

// timeInputEdit.addEventListener('input', () => {
//   var enteredTimeEdit = timeInputEdit.value;
//   var suggestionsEdit = generateTimeSuggestions(enteredTimeEdit);

//   suggestionContainerEdit.innerHTML = '';

//   suggestionsEdit.forEach((suggestionEdit) => {
//     var suggestionOptionEdit = document.createElement('div');
//     suggestionOptionEdit.textContent = suggestionEdit;
//     suggestionOptionEdit.addEventListener('click', () => {
//       timeInputEdit.value = suggestionEdit;
//       suggestionContainerEdit.innerHTML = '';
//       timeInputEdit.focus();



//     });
//     suggestionContainerEdit.appendChild(suggestionOptionEdit);
//   });
// });
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

   //plink clone
var add_dup_tlink = $('.add_dup_tlink'); //Add button selector
   var tlink_div = $('.tlink_div'); //Input field wrapper
   var tlinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="tlink" name="tlink[]" type="text" class="form-control" placeholder="Enter Task Link..."><span id="tlinkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" placeholder="Enter Task Link Comment..."><span id="tlink_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_tlink2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_tlink" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_tlink).click(function(){
    //debugger;
           $(tlink_div).append(tlinkHTML); //Add field html
   });
   
   $(tlink_div).on('click', '.add_dup_tlink2', function(e){
      //debugger;
           $(tlink_div).append(tlinkHTML); 
   });

   //Once remove button is clicked
   $(tlink_div).on('click', '.remove_dup_tlink', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
   });


});
</script>
    </body>

</html>
