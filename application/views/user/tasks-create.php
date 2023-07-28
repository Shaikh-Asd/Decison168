<?php
$page = 'tasks-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Tasks Create</title>
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
<style>
    
</style>
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
                        <h4 class="mb-sm-0 font-size-18">Create</h4>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks Create</a></li> -->
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
                                        <h4 class="card-title mb-2">Create New Task</h4>
                                        <form method="post" name="create_task_form" id="create_task_form" enctype="multipart/form-data" autocomplete="off">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                <div class="row">
                                                  <div class="col-md-6">   
                                                    <?php                    
                                                    if((!empty($this->input->post('gid'))) && (!empty($this->input->post('sid'))))
                                                    {
                                                    ?>
                                                    <input type="hidden" name="gid" value="<?php echo $this->input->post('gid');?>">
                                                    <input type="hidden" name="sid" value="<?php echo $this->input->post('sid');?>">
                                                    <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="get_gid" id="get_gid">
                                                    <input type="hidden" name="get_sid" id="get_sid">
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Task <span class="text-danger">*</span></label>
                                                        <input id="tname" name="tname" type="text" class="form-control" placeholder="Enter Task Name..." required="">
                                                        <span id="tnameErr" class="text-danger"></span>
                                                    </div>                                                    
                                                    <div class="form-group mb-2">
                                                        <label class="col-form-label">Description</label>
                                                        <textarea class="form-control" id="tdes" name="tdes" rows="7" placeholder="Enter Task Description..."></textarea>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="col-form-label">Note</label>
                                                        <textarea class="form-control" id="tnote" name="tnote" rows="7" placeholder="Enter Task Note..."></textarea>
                                                    </div>                                                    
                                                  </div>                                                  
                                                  <div class="col-md-6">  
                                                    <?php
                                                    if(!empty($this->input->post('pid')))
                                                    {
                                                        $pro = $this->Front_model->getProjectById($this->input->post('pid'));
                                                        $get_portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Project</label>
                                                       <select class="form-select" name="tproject_assign" id="tproject_assign" readonly>
                                                                <option value="<?php echo $this->input->post('pid');?>" selected=""><?php echo $pro->pname;?></option>
                                                        </select>
                                                            <span id="tproject_assignErr" class="text-danger"></span> 
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="dept" class="col-form-label">Identify Department <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="dept" id="dept" required>
                                                            <?php
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                            $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                            if($check_port_dept) 
                                                            {
                                                                foreach($check_port_dept as $p_dept)
                                                                {
                                                                    if($p_dept->portfolio_dept_id == $this->input->post('gdept'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $p_dept->portfolio_dept_id;?>" selected><?php echo $p_dept->department;?></option>
                                                                <?php  
                                                                    }
                                                                }         
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="deptErr" class="text-danger"></span>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Portfolio <span class="text-danger">*</span></label>
                                                        <?php 
                                                        if(!empty($get_portfolio))
                                                        {
                                                        ?>
                                                        <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" value="<?php echo $get_portfolio->portfolio_name.' '.$get_portfolio->portfolio_lname;?>" readonly required>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" readonly required>
                                                        <?php
                                                        }
                                                        ?>
                                                        <span id="portfolio_nameErr" class="text-danger"></span> 
                                                    </div>
                                                    <?php
                                                    if($pro)
                                                    {
                                                        if($pro->ptype == "content")
                                                        {
                                                        ?>
                                                        <input type="hidden" name="get_pub_date" id="get_pub_date" value="<?php echo $pro->p_publish;?>">
                                                        <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                        <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" onmouseover="return pub_tdue_date()" class="form-control" id="pub_tdue_date_id" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                                                            </div>
                                                            <span id="pub_tdue_date_idErr" class="text-danger"></span>
                                                        </div>
                                                        <?php
                                                        }
                                                        elseif($pro->ptype == "goal_strategy")
                                                        {
                                                            $gdetail = $this->Front_model->GoalDetail($this->input->post('gid'));
                                                            if($gdetail)
                                                            {
                                                        ?>
                                                        <input type="hidden" name="get_pub_date" id="get_pub_date">
                                                        <input type="hidden" name="get_gstart_date" id="get_gstart_date" value="<?php echo $gdetail->gstart_date;?>">
                                                        <input type="hidden" name="get_gend_date" id="get_gend_date" value="<?php echo $gdetail->gend_date;?>">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" onmouseover="return pub_tdue_date()" class="form-control" id="pub_tdue_date_id" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                                                            </div>
                                                            <span id="pub_tdue_date_idErr" class="text-danger"></span>
                                                        </div>
                                                        <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <input type="hidden" name="get_pub_date" id="get_pub_date">
                                                        <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                        <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" class="form-control" id="tdue_date" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                                                            </div>
                                                            <span id="tdue_dateErr" class="text-danger"></span>
                                                        </div>
                                                        <?php
                                                        }
                                                    } 
                                                    
                                                    }
                                                    else
                                                    {
                                                        if($plist || $accepted_plist)
                                                        {
                                                    ?>
                                                    
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Project</label>
                                                        <select class="form-select" name="tproject_assign" id="tproject_assign" onchange="return get_project_id();">
                                                            <option value="" selected="">Select Project</option>
                                                            <?php
                                                                foreach($plist as $pl)
                                                                {
                                                            ?>
                                                            <option value="<?php echo $pl->pid;?>"><?php echo $pl->pname;?></option>
                                                            <?php
                                                                }
                                                                foreach($accepted_plist as $apl)
                                                                {
                                                            ?>
                                                            <option value="<?php echo $apl->pid;?>"><?php echo $apl->pname;?></option>
                                                            <?php
                                                                }
                                                            ?>
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
                                                                <option value="<?php echo $p_dept->portfolio_dept_id;?>"><?php echo $p_dept->department;?></option>
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
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            $port = $this->Front_model->getAllPortfolio($_COOKIE["d168_selectedportfolio"]);
                                                        ?>
                                                        <input id="portfolio_name" name="portfolio_name" value="<?php if($port->portfolio_user == 'company'){ echo $port->portfolio_name;}elseif($port->portfolio_user == 'individual'){ echo $port->portfolio_name.' '.$port->portfolio_lname;}else{ echo $port->portfolio_name.' '.$port->portfolio_lname;}?>" type="text" class="form-control" readonly required>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" readonly required>
                                                        <?php
                                                        }
                                                        ?>
                                                        <span id="portfolio_nameErr" class="text-danger"></span>
                                                        <input type="hidden" name="get_pub_date" id="get_pub_date">
                                                        <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                        <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" onmouseover="return pub_tdue_date()" class="form-control" id="pub_tdue_date_id" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                                                            </div>
                                                            <span id="pub_tdue_date_idErr" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            $get_portfolio = $this->Front_model->getPortfolio2($_COOKIE["d168_selectedportfolio"]);
                                                            ?>
                                                            <div class="form-group mb-2">
                                                                <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                                <div class="input-group" id="datepicker2">
                                                                    <input type="text" class="form-control" id="tdue_date" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                                                                </div>
                                                                <span id="tdue_dateErr" class="text-danger"></span>
                                                            </div>
                                                            <?php
                                                            if(!empty($get_portfolio))
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2">
                                                                <label for="tname" class="col-form-label">Portfolio <span class="text-danger">*</span></label>
                                                                <?php 
                                                                if(!empty($get_portfolio))
                                                                {
                                                                ?>
                                                                <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" value="<?php echo $get_portfolio->portfolio_name.' '.$get_portfolio->portfolio_lname;?>" readonly required>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" readonly required>
                                                                <?php
                                                                }
                                                                ?>
                                                                <span id="portfolio_nameErr" class="text-danger"></span> 
                                                            </div>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                    ?>                                                    
                                                      <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Priority <span class="text-danger">*</span></label>
                                                          <select class="form-select" name="tpriority" id="tpriority" required="">
                                                                <option value="" selected="">Set Priority</option>
                                                                <option value="high">High</option>
                                                                <option value="medium">Medium</option>
                                                                <option value="low">Low</option>
                                                            </select>
                                                            <span id="tpriorityErr" class="text-danger"></span>
                                                      </div>                                                    
                                                    <?php 
                                                    if(!empty($this->input->post('pid')))
                                                    {
                                                       $get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                                                       $porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);
                                                        ?>
                                                        <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Assignee <span class="text-danger">*</span></label>
                                                        
                                                            <select name="team_member2" id="team_member2" class="form-control"  style="line-height: 1.5;" required="">
                                                            <?php                                           
                                                            if($porttm){
                                                                foreach ($porttm as $ptm) {
                                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                    if($m)
                                                                    {
                                                                    if($m->reg_id != $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                    <?php
                                                                        }
                                                                    if($m->reg_id == $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
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
                                                            <span id="team_member2Err" class="text-danger"></span>
                                                            
                                                       <!--  <?php
                                                            if($get_pdetail->pcreated_by == $this->session->userdata('d168_id'))
                                                            {
                                                        ?>
                                                            <div class="col-lg-3 mt-1">
                                                                <button type="button" class="btn btn-d btn-sm" data-bs-toggle="modal" data-bs-target="#pdetail_AddMember" title="Add Team Member">Add Member</button>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Assignee <span class="text-danger">*</span></label>
                                                        
                                                            <select name="team_member2" id="team_member2" class="form-control"  style="line-height: 1.5;" required="">
                                                            <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                            </select> 
                                                        <span id="team_member2Err" class="text-danger"></span>
                                                        
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                  </div>
                                                  <div class="mb-3 col-md-5">
                                                        <label class="col-form-label">Attached File(s)</label>
                                                        <input class="form-control" name="tfile[]" id="tfile" type="file" multiple="" />
                                                            <span id="tfileErr" class="text-danger"></span>
                                                        
                                                    </div>
                                                  <div class="mb-3 col-md-1">

                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="col-form-label">Estimate Time<span class="text-danger">*</span> (For example: XhXm)</label>
                                                        <input class="form-control" name="estimated_time" id="estimated_time" type="text" placeholder="Enter time in hour format" required />
                                                            <div id="suggestionContainer"></div>    
                                                        <span id="estimated_timeErr" class="text-danger"></span>
                                                        
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
                                                    <div class="tlink_div">
                                                    </div>
                                                    <span id="link_validErr" class="text-danger"></span>
                                                  
                                                    <div class="justify-content-end">
                                                        <span id="limit_taskErr" class="text-danger"></span>
                                                        <button type="submit" id="create_task_button" class="btn btn-d btn-sm">Create Task</button>
                                                        <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                        <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                            Cancel 
                                                        </a>
                                                    </div>
                                                </div>                                                        
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
<script type="text/javascript">
    $(document).ready(function(){
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
<?php
if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
?>
    <script type="text/javascript">
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "tasks-create")
          {
            localStorage.setItem('tour_session', 'no');
            var steps = [ 
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Here you can create your Task</p>"
                }, 
                {
                    title: "Task: Name",
                    id: "tname",
                    content: "<p class='popover-content'>Enter Task Name</p>"
                }, 
                {
                    title: "Task: Description",
                    id: "tdes",
                    content: "<p class='popover-content'>Enter Task Description</p>"
                }, 
                {
                    title: "Task: Note",
                    id: "tnote",
                    content: "<p class='popover-content'>Enter Task Note</p>"
                }, 
                {
                    title: "Task: Project",
                    id: "select2-tproject_assign-container",
                    content: "<p class='popover-content'>Select Project</p>"
                },
                {
                    title: "Task: Department",
                    id: "select2-dept-container",
                    content: "<p class='popover-content'>Select Department for the Task</p>"
                },
                {
                    title: "Task: Portfolio",
                    id: "portfolio_name",
                    content: "<p class='popover-content'>Select Portfolio for the Task</p>"
                },
                {
                    title: "Task: Due Date",
                    id: "pub_tdue_date_id",
                    content: "<p class='popover-content'>Select Due Date for the Task</p>"
                },
                {
                    title: "Task: Priority",
                    id: "tpriority",
                    content: "<p class='popover-content'>Set Priority for the Task</p>"
                },
                {
                    title: "Task: Assignee",
                    id: "select2-team_member2-container",
                    content: "<p class='popover-content'>Select Assignee for the Task</p>"
                },
                {
                    title: "Task: Links",
                    id: "tlink",
                    content: "<p class='popover-content'>Enter links related to the Task</p>"
                },
                {
                    title: "Task: Comment",
                    id: "tlink_comment",
                    content: "<p class='popover-content'>Enter Comment related to the Task Link</p>"
                },
                {
                    title: "Task: File Upload",
                    id: "tfile",
                    content: "<p class='popover-content'>Upload Files related to the Task</p>"
                },
                {
                    title: "Task: Submit",
                    id: "create_task_button",
                    content: "<p class='popover-content'>Click here to Create Task</p>"
                }
            ];
            var my_tour = new Tour(steps);
            my_tour.show();            
          }
        }
    </script>
    <?php
}
?>
    </body>
</html>