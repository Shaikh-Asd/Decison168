<?php
if($pdetail)
{
    if($pdetail->ptype == "content")
    {
    $page = 'content-planner';
    }
    else
    {
    $page = 'projects-list';
    }
}
else
{
$page = 'projects-list';
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Team Member Tasks List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
 <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- dragula css -->
<link href="<?php echo base_url();?>assets/libs/dragula/dragula.min.css" rel="stylesheet" type="text/css" />
        <?php
include('header_links.php');
?>
<link href="<?php echo base_url();?>assets/css/new-cards.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.tree,
.tree ul {
  margin:0 0 0 1em; /* indentation */
  padding:0;
  list-style:none;
  color:#7b7b7b;
  position:relative;
  width: 100%;
}

.tree ul {margin-left:.5em} /* (indentation/2) */

.tree:before,
.tree ul:before {
  content:"";
  display:block;
  width:0;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  border-left:2px solid #c7df19;
}

.tree li {
  margin:0;
  padding:0 1.5em 1em; /* indentation + .5em */
  position:relative;
}

.tree li > span:first-of-type {
  width: 800px;
  display: inline-block;
}

.tree li:before {
  content:"";
  display:block;
  width:10px; /* same with indentation */
  height:0;
  border-top:2px solid #c7df19;
  margin-top:-1px; /* border top width */
  position:absolute;
  top:1.25em; /* (line-height/2) */
  left:0;
}

.tree li:last-child:before {
  background:white; /* same with body background */
  height:auto;
  top:1.25em; /* (line-height/2) */
  bottom:0;
}

/* toggler */
.toggler::before {
  content: "\25B6";
  display: inline-block;
  transition: transform 0.3s ease-in-out;
}

.toggler.active::before {
  transform: rotate(90deg);
}
</style> 
    </head>
<style type="text/css">
.description {
  position: relative;
  margin: 0 0 0px;
  padding: 0;
  border: 0;
}
.description .description-term {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
}
.description .description-term i {
  margin-left: 4px;
  font-size: 0.875rem;
}
.description .description-details {
  position: relative;
  border-radius: 4px;
  padding: 0 8px;
  margin: 0;
  line-height: 40px;
  font-weigth: 300;
}
.description .description-details p {
  margin-top: -10px;
  line-height: 1.5;
  padding-top: 8px;
}
.description .description-details i {
  position: absolute;
  top: 0;
  left: -10px;
  line-height: 40px;
  color: #383838;
}
.description .description-details:hover {
  border-color: #007BFF;
  cursor: pointer;
}
.description .description-details:hover i {
  display: inline-block;
}
.description .description-edit {
  position: relative;
  display: none;
  border-radius: 4px;
  margin: 0;
  line-height: 40px;
  font-weigth: 300;
}
.description .description-edit p {
  margin: 0;
  margin-bottom: 0px !important;
}
.description .description-edit .description-controls {
  top: 0;
  right: 0;
}
.description .description-edit .description-controls .button {
  margin: 0 -2px;
  border: 0;
  border-radius: 0;
}
.description.editable .description-details {
  display: none;
}
.description.editable .description-edit {
  display: block;
}

.description .description-edit input {
  width: 100%;
  padding: 0 8px;
  font-size: 1rem;
  line-height: 40px;
  background: #f8f8fb !important;
  border: 1px solid #c7df19;
  font-weight: 300;
}
.description .description-edit input:hover {
  border: 1px solid #c7df19;
}
.description .description-edit input:focus-visible {
  border: 1px solid #c7df19;
  background: #F3F3F4;
}
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
        <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding-bottom: 0px !important;">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Tasks</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('team-member-tasks-list/'.$pid.'/'.$tassignee);?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back
                                </a>
                            </li>
<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <li class="nav-item">
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getProject_TaskCount($pdetail->pid);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            if($used_tasks < $total_tasks)
            {
              if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    if($pdetail)
                    {
                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                        {
                ?> 
                        <li class="nav-item">
                            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                            </form>
                        </li>
                <?php
                        }
                    }
                }
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                </li>
                <?php
            }
          }
          else
          {
            if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    if($pdetail)
                    {
                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                        {
                ?> 
                        <li class="nav-item">
                            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                            </form>
                        </li>
                <?php
                        }
                    }
                }
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getProject_TaskCount($pdetail->pid);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            if($used_tasks < $total_tasks)
            {
              if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    if($pdetail)
                    {
                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                        {
                ?> 
                        <li class="nav-item">
                            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                            </form>
                        </li>
                <?php
                        }
                    }
                }
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                </li>
                <?php
            }
          }
          else
          {
            if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    if($pdetail)
                    {
                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                        {
                ?> 
                        <li class="nav-item">
                            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                            </form>
                        </li>
                <?php
                        }
                    }
                }
          }
        }
    }
}
}
else
{
  
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('task', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <li class="nav-item">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount = $this->Front_model->getProject_TaskCountCorp($pdetail->pid);
            if($getPackDetail)
            {
              $total_tasks = trim($getPackDetail->pack_tasks);
              $used_tasks = trim($getTaskCount['task_count_rows']);
              $check_type = is_numeric($total_tasks);
              if($check_type == 'true')
              {
                if($used_tasks < $total_tasks)
                {
                  if(isset($_COOKIE["d168_selectedportfolio"]))
                    {
                        if($pdetail)
                        {
                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                            {
                    ?> 
                            <li class="nav-item">
                                <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                    <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                    <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                    <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                    <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                                </form>
                            </li>
                    <?php
                            }
                        }
                    }
                }
                else
                {
                    ?>
                    <li class="nav-item">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                    </li>
                    <?php
                }
              }
              else
              {
                if(isset($_COOKIE["d168_selectedportfolio"]))
                    {
                        if($pdetail)
                        {
                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                            {
                    ?> 
                            <li class="nav-item">
                                <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                                    <input type="hidden" name="pid" value="<?php echo $pid;?>">
                                    <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                                    <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                                    <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
                                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                                </form>
                            </li>
                    <?php
                            }
                        }
                    }
              }
            }
          }
        }
      }
    }    
  
}
?> 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">                    
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
<div class="row">
    <div class="col-2" style="padding: 0px"> 
        <i class="mdi mdi-filter h3 float-end mt-1" style="cursor: pointer;" onclick="return show_FilterOptions();"></i>
        <div class="modal bs-example-modal-lg filtercollapse" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" onclick="$('.filtercollapse').css('display','none');"></button>
                        <div class="row">             
                            <div class="col-xl-12">
                                <div class="mt-4 mt-xl-0">
                                    <div class="docs-actions">
                                        <div class="input-group mb-3">
                                            <form name="task_date_filter" id="task_date_filter" method="post" autocomplete="off">
                                                <input type="hidden" name="port_id" value="<?php echo $_COOKIE["d168_selectedportfolio"];?>">
                                                <input type="hidden" name="date_filter_page_name" value="team_member_tasks">
                                                <div class="row">
                                                    <div class="col-5"></div>
                                                    <div class="col-5">
                                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                            <input type="text" class="form-control" name="tf_start_date" id="tf_start_date" placeholder="Start Date" value="<?php echo $tf_start_date;?>" style="height: 29px !important;"/>
                                                            <input type="text" class="form-control" name="tf_end_date" id="tf_end_date" placeholder="End Date" value="<?php echo $tf_end_date;?>" style="height: 29px !important;"/>
                                                            <span id="tf_start_dateErr" class="text-danger"></span>
                                                            <span id="tf_end_dateErr" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="submit" class="btn btn-sm btn-d text-white">GO</button>
                                                    </div>
                                                    <div class="col-1">
                                                        <a class="btn btn-sm bg-d text-white" style="font-weight: 300 !important;font-size: 12px;" href="<?php echo base_url('team-member-tasks-list/'.$pid.'/'.$tassignee);?>">Clear</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
    <div class="col-10" style="padding: 0px;">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria-list" style="line-height: 1.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear-list">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php
if(($this->session->flashdata('al_message')) && ($this->session->flashdata('al_message') != ""))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        <?php echo $this->session->flashdata('al_message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>                        
<div class="row p-3">
    <div class="col pt-1 pb-3" style="background: #ffffff">
        <?php 
        $progress_done = $this->Front_model->progress_done3_date_range($pid,$tassignee,$tf_start_date,$tf_end_date);
        $progress_total = $this->Front_model->progress_total3_date_range($pid,$tassignee,$tf_start_date,$tf_end_date);
        $sub_progress_done = $this->Front_model->sub_progress_done3_date_range($pid,$tassignee,$tf_start_date,$tf_end_date);
        $sub_progress_total = $this->Front_model->sub_progress_total3_date_range($pid,$tassignee,$tf_start_date,$tf_end_date);
        if($progress_total || $sub_progress_total)
        {
            $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
            $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
            $progress = 0;
            if($total_pro_progress != 0)
            {
                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
            }
        ?>
        <span class="mt-1">
            Done: <?php echo $total_pro_progress_done; ?>  
            Total: <?php echo $total_pro_progress; ?> </span>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
            if($progress == 0)
            {
                echo '2%';
            }
            else
            {
                echo $progress.'%';
            }
            ?>"><?php echo round($progress).'%'; ?></div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
                        
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
<div id="refresh_tasklist_status_change">
    <div class="row mb-2 heading_strip">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
            <div class="row mb-1">
                <div class="col-lg">
                    <div class="text-center" style="font-weight: 900;">Code</div>
                </div>                
                <div class="col-lg">
                    <div style="font-weight: 900;">Tracked Time</div>
                </div>
                <div class="col-lg">
                    <div style="font-weight: 900;">Task</div>
                </div>
                <div class="col-lg">
                    <div style="font-weight: 900;">Assignee</div>
                </div>
                <div class="col-lg">
                    <div style="font-weight: 900;">Priority</div>
                </div>
                <div class="col-lg">
                    <div style="font-weight: 900;">Status</div>
                </div>
                <div class="col-lg">
                    <div style="font-weight: 900;">Due Date</div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
<?php
if($tlist)
{
    foreach($tlist as $atl)
    {
        $getTaskSubtaskToCheck = $this->Front_model->getTaskSubtaskToCheck($atl->tid);
        if($getTaskSubtaskToCheck == 0)
        {
        $check_pro_createdby = "";
        $check_pro_manager = "";
        $portfolio_owner_id = "";
        if(!empty($atl->tproject_assign))
        {
            $pro = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro)
            {
                $check_pro_createdby = $pro->pcreated_by;
                $check_pro_manager = $pro->pmanager;
                $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                if($check_Portfolio_owner_id)
                {
                    $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                }
            }
        }
        $check_pro_member_status = "";
        $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear)
        {
            $check_pro_member_status = $check_ProjectMToClear->status;
        }
?>
<div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<!--Task with subtask-->
<?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $atl->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
    <div class="dropdown float-end">
        <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="javascript:void(0)" onclick="return TaskEditModal('<?php echo $atl->tid;?>')">Edit</a>
            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $atl->tproject_assign;?>">
                    <input type="hidden" name="tid" value="<?php echo $atl->tid;?>">
                    <input type="hidden" name="port_id" value="<?php echo $atl->portfolio_id;?>">
                    <input type="hidden" id="timer_flag_new_<?php echo $atl->tid;?>" value="<?php echo $atl->flag;?>">                      
                    <input type="hidden" id="timer_flag_poup_<?php echo $atl->tid;?>" value="">         
                    <input type="hidden"  id="timer_started_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">    
                    <input type="hidden"  id="timer_started_popup_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">
                    <input type="hidden" name="task_dd" value="<?php echo $atl->tdue_date;?>">
                    <button type="submit" class="dropdown-item">Add Subtask</button> 
            </form>
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))  
                {
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
        <?php
      }
      else
      {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
              ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
              ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
    }
}
}
else
{
  
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('task', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($atl->tproject_assign);
            if($getPackDetail2)
            {
              $total_tasks2 = trim($getPackDetail2->pack_tasks);
              $used_tasks2 = trim($getTaskCount2['task_count_rows']);
              $check_type2 = is_numeric($total_tasks2);
              if($check_type2 == 'true')
              {
                if($used_tasks2 < $total_tasks2)
                {
                  ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
                }
                else
                {
                    ?>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                    <?php
                }
              }
              else
              {
                ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
              }
            }
          }
        }
      }
    }    
  
}
            ?>
                
                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_task('<?php echo $atl->tid;?>');">Archive</a> -->
                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_task('<?php echo $atl->tid;?>');">File it</a>
                <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $atl->tid;?>');" class="dropdown-item">Delete</a>
            <?php
                }
            ?>
        </div>
    </div> <!-- end dropdown -->
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
<?php
    }
}
?>
    <div class="row m-1">
        <div class="col-lg-1">
            <?php
            $Check_Task_L_Subtasks = $this->Front_model->Check_Task_Subtasks2($atl->tid);
            if($Check_Task_L_Subtasks)
            {
                $sub_L_cnt = 0;
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
                    $sub_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->tid;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->tid;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $sub_L_cnt;?></span>
            </a>
            <?php
            }
            else
            {
            ?>
            <a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>
            <?php
            }
            ?>
            <?php echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><i class="bx bx-play-circle timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i></span>
        <span class="counter_<?php echo $atl->tid;?> counter_task" data-id="<?php echo $atl->tid;?>">
        <?php
            if($atl->flag == '1'){
                if($atl->start_timer_new != ''){
                  // Old time
                  $old_time_task = $atl->start_timer_new;                                                                
                }
                else{
                $old_time_task = $atl->start_timer;
                }
                
                // Current time
                $current_time_task = date("Y-m-d H:i:s");
                // Create DateTime objects for old and current times
                $old_datetime_task = new DateTime($old_time_task);
                $current_datetime_task = new DateTime($current_time_task);
                // Calculate the time difference
                $interval_task = $current_datetime_task->diff($old_datetime_task);
              // Access the time difference components
                $diff_hours_task = $interval_task->h;
                $diff_minutes_task = $interval_task->i;
                $diff_seconds_task = $interval_task->s;
                $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                $time1_task = $timer_task;
                $time2_task = $atl->tracked_time;

                $task_time1 = new DateTime($time1_task);
                $task_time2 = new DateTime($time2_task);
            
                $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                $task_time2->add($interval_task);
                
                $timer_task = $task_time2->format('H:i:s');
                }
                
                else{
                  if($atl->tracked_time != ""){
                  $timer_task = $atl->tracked_time;
                  }
                  else{
                  $timer_task = '00:00:00';
                  }
                }
              echo trim($timer_task);
        ?>
        </span>
            <!-- <div id="" style="margin-left: 5px;font-size: 20px; margin-top: 2px;"><i class="bx bx-reset" onclick="toggleStop('<?php echo $tdetail->tid;?>');"></i></div> -->
            <input type="hidden" value="<?php echo $atl->flag?>" id="timer_flag_<?php echo $atl->flag?>">

        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input name="tname" id="tname" value="<?php echo $atl->tname;?>" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();"  data-class="task_editable" data-name="tname_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="description-content" onclick="return editable_field2();"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="description-content"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                    <?php                                           
                    if($porttm){
                        foreach ($porttm as $ptm) {
                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                            if($m)
                            {
                            if($m->reg_id != $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $m->reg_id;?>" <?php if($atl->tassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                            <?php
                                }
                            if($m->reg_id == $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                                }
                            }
                            }
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                        }
                    ?>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tassignee_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content">High</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="high" <?php if($atl->tpriority == 'high'){ echo "selected";}?>>High</option>
                    <option value="medium" <?php if($atl->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                    <option value="low" <?php if($atl->tpriority == 'low'){ echo "selected";}?>>Low</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tpriority_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                              if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                <?php
                              }  
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                <?php
                            }             
                ?></p>
                <?php  
                if($atl->tstatus == 'in_review') 
                {
                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                      {
                        echo "";
                      }
                      else
                      {
                        ?>
                        <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                        <?php
                      }
                }
                else
                {
                ?>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                <?php
                }
                ?>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                              if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                <?php
                              }  
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?></p>
                <?php  
                if($atl->tstatus == 'in_review') 
                {
                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                      {
                        echo "";
                      }
                }
                ?>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="to_do" <?php if($atl->tstatus == 'to_do'){ echo "selected";}?>>To Do</option>
                    <option value="in_progress" <?php if($atl->tstatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                    <option value="in_review" <?php if($atl->tstatus == 'in_review'){ echo "selected";}?>>In Review</option>
                    <option value="done" <?php if($atl->tstatus == 'done'){ echo "selected";}?>>Done</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tstatus_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
            <?php
            }
            else
            {
            ?>
            <fieldset class="mt-1 ms-2">
                <?php
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">Done</span>
                <?php
                            }
                ?>
                </fieldset>
                <?php 
            }
            ?>
        </div>
        <div class="col-lg">
            <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date<?php echo $atl->tid;?>" value="<?php echo $get_pubD->p_publish;?>">
                <?php
              }  
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <?php
                }
              }
            }
            ?>
            <fieldset class="description">
            <?php
if($privilege_only_view == 'no')
{
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_pubD(<?php echo $atl->tid;?>);">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_goalD(<?php echo $atl->tid;?>);">
                <?php
              }
              else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }  
            }
            else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }
            ?>
                <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $atl->tdue_date;?></span></p>
                <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>
              <div>
                <p><span class="badge badge-soft-primary description-content"><?php echo $atl->tdue_date;?></span></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input type="text" class="form-control task_datepicker_field" onchange="return edit_yes_calendar(this);" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>" id="tdue_date<?php echo $atl->tid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->tid;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_Task_L_Subtasks)
            {
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
            ?>
            <!-- single sub task area start -->
            <li>
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $l_subtask->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0)" onclick="return SubtaskEditModal('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Edit</a>
                                <?php
                                $check_pro_createdby = "";
                                $check_pro_manager = "";
                                $portfolio_owner_id = "";
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                            $check_pro_manager = $pro->pmanager;
                                            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                                            if($check_Portfolio_owner_id)
                                            {
                                                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                            }
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) 
                                    {
                                ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_subtask('<?php echo $l_subtask->stid;?>');" id="dup_pro_id">Duplicate</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $l_subtask->stid;?>');">Archive</a> -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_subtask('<?php echo $l_subtask->stid;?>');">File it</a>
                                <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Delete</a>
                                <?php
                                    }
                                ?>     
                            </div>
                        </div> <!-- end dropdown -->
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <?php
    }
}
?>
                        <div class="row">
                            <div class="col-lg">
                                <?php echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <i class="bx bx-play-circle timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i>
                            </span>
                                <span class="countersubtask_<?php echo $l_subtask->stid;?> counter_stask" data-id="<?php echo $l_subtask->stid;?>">
                                <?php
                                    if($l_subtask->sflag == '1'){
                                        if($l_subtask->start_stimer_new != ''){
                                          // Old time
                                          $old_time_task = $l_subtask->start_stimer_new;                                                                
                                        }
                                        else{
                                        $old_time_task = $l_subtask->start_stimer;
                                        }
                                        
                                        // Current time
                                        $current_time_task = date("Y-m-d H:i:s");
                                        // Create DateTime objects for old and current times
                                        $old_datetime_task = new DateTime($old_time_task);
                                        $current_datetime_task = new DateTime($current_time_task);
                                        // Calculate the time difference
                                        $interval_task = $current_datetime_task->diff($old_datetime_task);
                                      // Access the time difference components
                                        $diff_hours_task = $interval_task->h;
                                        $diff_minutes_task = $interval_task->i;
                                        $diff_seconds_task = $interval_task->s;
                                        $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                                        $time1_task = $timer_task;
                                        $time2_task = $l_subtask->tracked_stime;

                                        $task_time1 = new DateTime($time1_task);
                                        $task_time2 = new DateTime($time2_task);
                                    
                                        $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                                        $task_time2->add($interval_task);
                                        
                                        $timer_stask = $task_time2->format('H:i:s');
                                        }
                                        
                                        else{
                                          if($l_subtask->tracked_stime != ""){
                                          $timer_stask = $l_subtask->tracked_stime;
                                          }
                                          else{
                                          $timer_stask = '00:00:00';
                                          }
                                        }
                                      echo trim($timer_stask);
                                ?>
                            </span>
                                                                <input type="hidden" value="<?php echo $l_subtask->sflag?>" id="timer_sflag_<?php echo $l_subtask->stid?>">

                                <input type="hidden" id="timer_sflag_new_<?php echo $l_subtask->stid;?>" value="<?php echo $l_subtask->sflag;?>">                   
                                <input type="hidden" id="timer_sflag_poup_<?php echo $l_subtask->stid;?>" value="">     
                                <input type="hidden"  id="stimer_started_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">
                                <input type="hidden"  id="stimer_started_popup_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">

                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input name="stname" id="stname" value="<?php echo $l_subtask->stname;?>" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stname_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="description-content" onclick="return editable_field2();"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="description-content"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                                        <?php                                           
                                        if($porttm){
                                            foreach ($porttm as $ptm) {
                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($l_subtask->stassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stassignee_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="stpriority" id="stpriority" required="">
                                        <option value="high" <?php if($l_subtask->stpriority == 'high'){ echo "selected";}?>>High</option>
                                        <option value="medium" <?php if($l_subtask->stpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                        <option value="low" <?php if($l_subtask->stpriority == 'low'){ echo "selected";}?>>Low</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stpriority_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                  if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                  {
                                                    ?>
                                                    <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                                    <?php
                                                  }  
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php  
                                    if($l_subtask->ststatus == 'in_review') 
                                    {
                                        if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                          {
                                            echo "";
                                          }
                                          else
                                          {
                                            ?>
                                            <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                            <?php
                                          }
                                    }
                                    else
                                    {
                                    ?>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                    <?php
                                    }
                                    ?>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                  if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                  {
                                                    ?>
                                                    <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                                    <?php
                                                  }  
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php  
                                    if($l_subtask->ststatus == 'in_review') 
                                    {
                                        if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                          {
                                            echo "";
                                          }
                                    }
                                    ?>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="tpriority" id="tpriority" required="">
                                        <option value="to_do" <?php if($l_subtask->ststatus == 'to_do'){ echo "selected";}?>>To Do</option>
                                        <option value="in_progress" <?php if($l_subtask->ststatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                                        <option value="in_review" <?php if($l_subtask->ststatus == 'in_review'){ echo "selected";}?>>In Review</option>
                                        <option value="done" <?php if($l_subtask->ststatus == 'done'){ echo "selected";}?>>Done</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="ststatus_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                                <?php
                                }
                                else
                                {
                                ?>
                                <fieldset class="mt-1 ms-2">
                                    <?php
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">Done</span>
                                    <?php
                                                }
                                    ?>
                                    </fieldset>
                                    <?php 
                                }
                                ?>
                            </div>
                            <div class="col-lg">
                                <input type="hidden" name="get_tdue_date" class="if_task_date_change<?php echo $atl->tid;?>" id="get_tdue_date<?php echo $l_subtask->stid; ?>" value="<?php echo $atl->tdue_date;?>">
                                <?php
                                $gdetail = $this->Front_model->GoalDetail($atl->gid);
                                if($gdetail)
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                <?php
                                } 
                                else
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>">
                                <?php
                                } 
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $l_subtask->stdue_date;?></span></p>
                                    <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><span class="badge badge-soft-primary description-content"><?php echo $l_subtask->stdue_date;?></span></p>
                                  </div>
<?php
}
?>                                  
                                  <div class="description-edit">
                                    <input type="text" class="form-control task_date_changed<?php echo $atl->tid;?>" onchange="return edit_yes_calendar(this);" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>" id="stdue_date<?php echo $l_subtask->stid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $l_subtask->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>  
            </li>
            <!-- single sub task area end -->
            <?php
                }
            }
            ?>          
        </ul>
    </div>
</div>
<!-- sub task area end -->
<!--Task with subtask end-->
            </div>
        </div>
    </div>
</div>
<?php
        }
        else
        {
            $getTaskSubtaskToCheckList = $this->Front_model->getTaskSubtaskToCheckList($atl->tid);
            $check_sub_not_assigned = "not_assigned";
            if($getTaskSubtaskToCheckList)
            {
                foreach($getTaskSubtaskToCheckList as $subTaskList)
                {
                    if($subTaskList->stassignee == $tassignee)
                    {
                        $check_sub_not_assigned = "yes_assigned";
                    }
                }
            }
            $Check_Task_L_Subtasks_due = $this->Front_model->Check_Task_Subtasks2_date_range($atl->tid,$tf_start_date,$tf_end_date);
            $check_sub_due_not_assigned = "not_same_due";
            if($Check_Task_L_Subtasks_due)
            {
                foreach($Check_Task_L_Subtasks_due as $subTaskListdue)
                {
                    if($subTaskListdue->stassignee == $tassignee)
                    {
                        $check_sub_due_not_assigned = "same_due";
                    }
                }
            }
            if(($check_sub_not_assigned == "not_assigned") || (($check_sub_not_assigned == "yes_assigned") && ($check_sub_due_not_assigned == "not_same_due")))
            {
        $check_pro_createdby = "";
        $check_pro_manager = "";
        $portfolio_owner_id = "";
        if(!empty($atl->tproject_assign))
        {
            $pro = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro)
            {
                $check_pro_createdby = $pro->pcreated_by;
                $check_pro_manager = $pro->pmanager;
                $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                if($check_Portfolio_owner_id)
                {
                    $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                }
            }
        }
        $check_pro_member_status = "";
        $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear)
        {
            $check_pro_member_status = $check_ProjectMToClear->status;
        }
?>
<div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">  
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<!--Task with subtask-->
<?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $atl->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
    <div class="dropdown float-end">
        <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="javascript:void(0)" onclick="return TaskEditModal('<?php echo $atl->tid;?>')">Edit</a>
            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $atl->tproject_assign;?>">
                    <input type="hidden" name="tid" value="<?php echo $atl->tid;?>">
                    <input type="hidden" name="port_id" value="<?php echo $atl->portfolio_id;?>">
                    <input type="hidden" id="timer_flag_new_<?php echo $atl->tid;?>" value="<?php echo $atl->flag;?>">                      
                    <input type="hidden" id="timer_flag_poup_<?php echo $atl->tid;?>" value="">         
                    <input type="hidden"  id="timer_started_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">    
                    <input type="hidden"  id="timer_started_popup_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">
                    <input type="hidden" name="task_dd" value="<?php echo $atl->tdue_date;?>">
                    <button type="submit" class="dropdown-item">Add Subtask</button> 
            </form>
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))  
                {
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
        <?php
      }
      else
      {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
    }
}
}
else
{
  
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('task', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($atl->tproject_assign);
            if($getPackDetail2)
            {
              $total_tasks2 = trim($getPackDetail2->pack_tasks);
              $used_tasks2 = trim($getTaskCount2['task_count_rows']);
              $check_type2 = is_numeric($total_tasks2);
              if($check_type2 == 'true')
              {
                if($used_tasks2 < $total_tasks2)
                {
                    ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                    <?php
                }
              }
              else
              {
                ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
              }
            }
          }
        }
      }
    }    
  
}
            ?>
                
                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_task('<?php echo $atl->tid;?>');">Archive</a> -->
                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_task('<?php echo $atl->tid;?>');">File it</a>
                <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $atl->tid;?>');" class="dropdown-item">Delete</a>
            <?php
                }
            ?>
        </div>
    </div> <!-- end dropdown -->
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
<?php
    }
}
?>
    <div class="row m-1">
        <div class="col-lg">
            <?php
            $Check_Task_L_Subtasks = $this->Front_model->Check_Task_Subtasks2($atl->tid);
            if($Check_Task_L_Subtasks)
            {
                $sub_L_cnt = 0;
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
                    $sub_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->tid;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->tid;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $sub_L_cnt;?></span>
            </a>
            <?php
            }
            else
            {
            ?>
            <a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>
            <?php
            }
            ?>
            <?php echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><i class="bx bx-play-circle timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i></span>
        <span class="counter_<?php echo $atl->tid;?> counter_task" data-id="<?php echo $atl->tid;?>">
        <?php
            if($atl->flag == '1'){
                if($atl->start_timer_new != ''){
                  // Old time
                  $old_time_task = $atl->start_timer_new;                                                                
                }
                else{
                $old_time_task = $atl->start_timer;
                }
                
                // Current time
                $current_time_task = date("Y-m-d H:i:s");
                // Create DateTime objects for old and current times
                $old_datetime_task = new DateTime($old_time_task);
                $current_datetime_task = new DateTime($current_time_task);
                // Calculate the time difference
                $interval_task = $current_datetime_task->diff($old_datetime_task);
              // Access the time difference components
                $diff_hours_task = $interval_task->h;
                $diff_minutes_task = $interval_task->i;
                $diff_seconds_task = $interval_task->s;
                $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                $time1_task = $timer_task;
                $time2_task = $atl->tracked_time;

                $task_time1 = new DateTime($time1_task);
                $task_time2 = new DateTime($time2_task);
            
                $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                $task_time2->add($interval_task);
                
                $timer_task = $task_time2->format('H:i:s');
                }
                
                else{
                  if($atl->tracked_time != ""){
                  $timer_task = $atl->tracked_time;
                  }
                  else{
                  $timer_task = '00:00:00';
                  }
                }
              echo trim($timer_task);
        ?>
        </span>
            <!-- <div id="" style="margin-left: 5px;font-size: 20px; margin-top: 2px;"><i class="bx bx-reset" onclick="toggleStop('<?php echo $tdetail->tid;?>');"></i></div> -->
            <input type="hidden" value="<?php echo $atl->flag?>" id="timer_flag_<?php echo $atl->flag?>">

        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>
              <div>
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
              </div>
<?php    
}
?>              
              <div class="description-edit">
                <input name="tname" id="tname" value="<?php echo $atl->tname;?>" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();"  data-class="task_editable" data-name="tname_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="description-content" onclick="return editable_field2();"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="description-content"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                    <?php                                           
                    if($porttm){
                        foreach ($porttm as $ptm) {
                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                            if($m)
                            {
                            if($m->reg_id != $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $m->reg_id;?>" <?php if($atl->tassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                            <?php
                                }
                            if($m->reg_id == $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                                }
                            }
                            }
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                        }
                    ?>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tassignee_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content">High</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="high" <?php if($atl->tpriority == 'high'){ echo "selected";}?>>High</option>
                    <option value="medium" <?php if($atl->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                    <option value="low" <?php if($atl->tpriority == 'low'){ echo "selected";}?>>Low</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tpriority_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                              if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                <?php
                              }  
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                <?php
                            }             
                ?></p>
                <?php  
                if($atl->tstatus == 'in_review') 
                {
                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                      {
                        echo "";
                      }
                      else
                      {
                        ?>
                        <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                        <?php
                      }
                }
                else
                {
                ?>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                <?php
                }
                ?>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                              if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                <?php
                              }  
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?></p>
                <?php  
                if($atl->tstatus == 'in_review') 
                {
                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                      {
                        echo "";
                      }
                }
                ?>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="to_do" <?php if($atl->tstatus == 'to_do'){ echo "selected";}?>>To Do</option>
                    <option value="in_progress" <?php if($atl->tstatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                    <option value="in_review" <?php if($atl->tstatus == 'in_review'){ echo "selected";}?>>In Review</option>
                    <option value="done" <?php if($atl->tstatus == 'done'){ echo "selected";}?>>Done</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tstatus_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
            <?php
            }
            else
            {
            ?>
            <fieldset class="mt-1 ms-2">
                <?php
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark">Done</span>
                <?php
                            }
                ?>
                </fieldset>
                <?php 
            }
            ?>
        </div>
        <div class="col-lg">
            <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date<?php echo $atl->tid;?>" value="<?php echo $get_pubD->p_publish;?>">
                <?php
              } 
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <?php
                }
              } 
            }
            ?>
            <fieldset class="description">
            <?php
if($privilege_only_view == 'no')
{
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_pubD(<?php echo $atl->tid;?>);">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_goalD(<?php echo $atl->tid;?>);">
                <?php
              }
              else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }  
            }
            else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }
            ?>
                <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $atl->tdue_date;?></span></p>
                <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>
              <div class="description-details">
                <p><span class="badge badge-soft-primary description-content"><?php echo $atl->tdue_date;?></span></p>
              </div>
<?php
}
?>
              <div class="description-edit">
                <input type="text" class="form-control task_datepicker_field" onchange="return edit_yes_calendar(this);" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>" id="tdue_date<?php echo $atl->tid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->tid;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_Task_L_Subtasks)
            {
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
            ?>
            <!-- single sub task area start -->
            <li>
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $l_subtask->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0)" onclick="return SubtaskEditModal('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Edit</a>
                                <?php
                                $check_pro_createdby = "";
                                $check_pro_manager = "";
                                $portfolio_owner_id = "";
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                            $check_pro_manager = $pro->pmanager;
                                            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                                            if($check_Portfolio_owner_id)
                                            {
                                                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                            }
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) 
                                    {
                                ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_subtask('<?php echo $l_subtask->stid;?>');" id="dup_pro_id">Duplicate</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $l_subtask->stid;?>');">Archive</a> -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_subtask('<?php echo $l_subtask->stid;?>');">File it</a>
                                <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Delete</a>
                                <?php
                                    }
                                ?>     
                            </div>
                        </div> <!-- end dropdown -->
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <?php
    }
}
?>
                        <div class="row">
                            <div class="col-lg">
                                <?php echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <i class="bx bx-play-circle timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i>
                            </span>
                                <span class="countersubtask_<?php echo $l_subtask->stid;?> counter_stask" data-id="<?php echo $l_subtask->stid;?>">
                                <?php
                                    if($l_subtask->sflag == '1'){
                                        if($l_subtask->start_stimer_new != ''){
                                          // Old time
                                          $old_time_task = $l_subtask->start_stimer_new;                                                                
                                        }
                                        else{
                                        $old_time_task = $l_subtask->start_stimer;
                                        }
                                        
                                        // Current time
                                        $current_time_task = date("Y-m-d H:i:s");
                                        // Create DateTime objects for old and current times
                                        $old_datetime_task = new DateTime($old_time_task);
                                        $current_datetime_task = new DateTime($current_time_task);
                                        // Calculate the time difference
                                        $interval_task = $current_datetime_task->diff($old_datetime_task);
                                      // Access the time difference components
                                        $diff_hours_task = $interval_task->h;
                                        $diff_minutes_task = $interval_task->i;
                                        $diff_seconds_task = $interval_task->s;
                                        $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                                        $time1_task = $timer_task;
                                        $time2_task = $l_subtask->tracked_stime;

                                        $task_time1 = new DateTime($time1_task);
                                        $task_time2 = new DateTime($time2_task);
                                    
                                        $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                                        $task_time2->add($interval_task);
                                        
                                        $timer_stask = $task_time2->format('H:i:s');
                                        }
                                        
                                        else{
                                          if($l_subtask->tracked_stime != ""){
                                          $timer_stask = $l_subtask->tracked_stime;
                                          }
                                          else{
                                          $timer_stask = '00:00:00';
                                          }
                                        }
                                      echo trim($timer_stask);
                                ?>
                            </span>
                                                                <input type="hidden" value="<?php echo $l_subtask->sflag?>" id="timer_sflag_<?php echo $l_subtask->stid?>">

                                <input type="hidden" id="timer_sflag_new_<?php echo $l_subtask->stid;?>" value="<?php echo $l_subtask->sflag;?>">                   
                                <input type="hidden" id="timer_sflag_poup_<?php echo $l_subtask->stid;?>" value="">     
                                <input type="hidden"  id="stimer_started_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">
                                <input type="hidden"  id="stimer_started_popup_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">

                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input name="stname" id="stname" value="<?php echo $l_subtask->stname;?>" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stname_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="description-content" onclick="return editable_field2();"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="description-content"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                                        <?php                                           
                                        if($porttm){
                                            foreach ($porttm as $ptm) {
                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($l_subtask->stassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stassignee_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="stpriority" id="stpriority" required="">
                                        <option value="high" <?php if($l_subtask->stpriority == 'high'){ echo "selected";}?>>High</option>
                                        <option value="medium" <?php if($l_subtask->stpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                        <option value="low" <?php if($l_subtask->stpriority == 'low'){ echo "selected";}?>>Low</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stpriority_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                  if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                  {
                                                    ?>
                                                    <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                                    <?php
                                                  }  
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php  
                                    if($l_subtask->ststatus == 'in_review') 
                                    {
                                        if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                          {
                                            echo "";
                                          }
                                          else
                                          {
                                            ?>
                                            <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                            <?php
                                          }
                                    }
                                    else
                                    {
                                    ?>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                    <?php
                                    }
                                    ?>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                  if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                  {
                                                    ?>
                                                    <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                                    <?php
                                                  }  
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php  
                                    if($l_subtask->ststatus == 'in_review') 
                                    {
                                        if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                          {
                                            echo "";
                                          }
                                    }
                                    ?>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="tpriority" id="tpriority" required="">
                                        <option value="to_do" <?php if($l_subtask->ststatus == 'to_do'){ echo "selected";}?>>To Do</option>
                                        <option value="in_progress" <?php if($l_subtask->ststatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                                        <option value="in_review" <?php if($l_subtask->ststatus == 'in_review'){ echo "selected";}?>>In Review</option>
                                        <option value="done" <?php if($l_subtask->ststatus == 'done'){ echo "selected";}?>>Done</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="ststatus_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                                <?php
                                }
                                else
                                {
                                ?>
                                <fieldset class="mt-1 ms-2">
                                    <?php
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">Done</span>
                                    <?php
                                                }
                                    ?>
                                    </fieldset>
                                    <?php 
                                }
                                ?>
                            </div>
                            <div class="col-lg">
                                <input type="hidden" name="get_tdue_date" class="if_task_date_change<?php echo $atl->tid;?>" id="get_tdue_date<?php echo $l_subtask->stid; ?>" value="<?php echo $atl->tdue_date;?>">
                                <?php
                                $gdetail = $this->Front_model->GoalDetail($atl->gid);
                                if($gdetail)
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                <?php
                                } 
                                else
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>">
                                <?php
                                } 
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $l_subtask->stdue_date;?></span></p>
                                    <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div class="description-details">
                                    <p><span class="badge badge-soft-primary description-content"><?php echo $l_subtask->stdue_date;?></span></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input type="text" class="form-control task_date_changed<?php echo $atl->tid;?>" onchange="return edit_yes_calendar(this);" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>" id="stdue_date<?php echo $l_subtask->stid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $l_subtask->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>  
            </li>
            <!-- single sub task area end -->
            <?php
                }
            }
            ?>          
        </ul>
    </div>
</div>
<!-- sub task area end -->
<!--Task with subtask end-->
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
    }
}
if($stlist)
{
    $check_tid = "";
    foreach($stlist as $get_atl)
    {
    if($check_tid != $get_atl->s_tid)
    {
        $atl = $this->Front_model->getTasksDetail($get_atl->s_tid);
        if($atl)
        {
            if((($atl->tcreated_by != $this->session->userdata('d168_id')) && ($atl->tassignee == $this->session->userdata('d168_id'))) || (($atl->tcreated_by == $this->session->userdata('d168_id')) && ($atl->tassignee != $this->session->userdata('d168_id'))) || (($atl->tcreated_by != $this->session->userdata('d168_id')) && ($atl->tassignee != $this->session->userdata('d168_id'))))
            {
            $check_pro_createdby = "";
            $check_pro_manager = "";
            $portfolio_owner_id = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
                    $check_pro_manager = $pro->pmanager;
                    $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                    if($check_Portfolio_owner_id)
                    {
                        $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                    }
                }
            }
            $check_pro_member_status = "";
            $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
            if($check_ProjectMToClear)
            {
                $check_pro_member_status = $check_ProjectMToClear->status;
            }
            if(($atl->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
            {
                $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
            ?>
    <div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">   
        <div class="col-lg-12">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body" style="padding: 8px 0px 0px 0px;">
                    <div class="row mb-2">
                        <div class="col-lg-1"></div>
                        <?php
                  if($check_suggested)
                    {
                  ?>
                  <div class="col-lg-11">Project Request is not send from Project Owner. Task Name: <?php echo $atl->tname;?></div>
                  <?php
                    }
                    else
                    {
                  ?>
                    <div class="col-lg-7">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $atl->tname;?></div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                             Accept Request
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             Request More Info
                        </a>
                    </div>
                  <?php
                    }
                  ?>
                    </div>                
                </div>
            </div>
        </div>
    </div>
            <?php
            }
            else
            {
?>
<div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<!--Task with subtask-->
<?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $atl->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
    <div class="dropdown float-end">
        <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="javascript:void(0)" onclick="return TaskEditModal('<?php echo $atl->tid;?>')">Edit</a>
            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $atl->tproject_assign;?>">
                    <input type="hidden" name="tid" value="<?php echo $atl->tid;?>">
                    <input type="hidden" name="port_id" value="<?php echo $atl->portfolio_id;?>">
                    <input type="hidden" id="timer_flag_new_<?php echo $atl->tid;?>" value="<?php echo $atl->flag;?>">                      
                    <input type="hidden" id="timer_flag_poup_<?php echo $atl->tid;?>" value="">         
                    <input type="hidden"  id="timer_started_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">    
                    <input type="hidden"  id="timer_started_popup_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">
                    <input type="hidden" name="task_dd" value="<?php echo $atl->tdue_date;?>">
                    <button type="submit" class="dropdown-item">Add Subtask</button> 
            </form>
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))  
                {
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
        <?php
      }
      else
      {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
    }
}
}
else
{
  
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('task', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($atl->tproject_assign);
            if($getPackDetail2)
            {
              $total_tasks2 = trim($getPackDetail2->pack_tasks);
              $used_tasks2 = trim($getTaskCount2['task_count_rows']);
              $check_type2 = is_numeric($total_tasks2);
              if($check_type2 == 'true')
              {
                if($used_tasks2 < $total_tasks2)
                {
                    ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                    <?php
                }
              }
              else
              {
                ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
              }
            }
          }
        }
      }
    }    
  
}
            ?>
                
                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_task('<?php echo $atl->tid;?>');">Archive</a> -->
                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_task('<?php echo $atl->tid;?>');">File it</a>
                <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $atl->tid;?>');" class="dropdown-item">Delete</a>
            <?php
                }
            ?>
        </div>
    </div> <!-- end dropdown -->
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
<?php
    }
}
?>
    <div class="row m-1">
        <div class="col-lg">
            <?php
            $Check_Task_L_Subtasks = $this->Front_model->Check_Task_Subtasks2($atl->tid);
            if($Check_Task_L_Subtasks)
            {
                $sub_L_cnt = 0;
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
                    $sub_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->tid;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->tid;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $sub_L_cnt;?></span>
            </a>
            <?php
            }
            else
            {
            ?>
            <a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>
            <?php
            }
            echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><i class="bx bx-play-circle timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i></span>
        <span class="counter_<?php echo $atl->tid;?> counter_task" data-id="<?php echo $atl->tid;?>">
        <?php
            if($atl->flag == '1'){
                if($atl->start_timer_new != ''){
                  // Old time
                  $old_time_task = $atl->start_timer_new;                                                                
                }
                else{
                $old_time_task = $atl->start_timer;
                }
                
                // Current time
                $current_time_task = date("Y-m-d H:i:s");
                // Create DateTime objects for old and current times
                $old_datetime_task = new DateTime($old_time_task);
                $current_datetime_task = new DateTime($current_time_task);
                // Calculate the time difference
                $interval_task = $current_datetime_task->diff($old_datetime_task);
              // Access the time difference components
                $diff_hours_task = $interval_task->h;
                $diff_minutes_task = $interval_task->i;
                $diff_seconds_task = $interval_task->s;
                $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                $time1_task = $timer_task;
                $time2_task = $atl->tracked_time;

                $task_time1 = new DateTime($time1_task);
                $task_time2 = new DateTime($time2_task);
            
                $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                $task_time2->add($interval_task);
                
                $timer_task = $task_time2->format('H:i:s');
                }
                
                else{
                  if($atl->tracked_time != ""){
                  $timer_task = $atl->tracked_time;
                  }
                  else{
                  $timer_task = '00:00:00';
                  }
                }
              echo trim($timer_task);
        ?>
        </span>
            <!-- <div id="" style="margin-left: 5px;font-size: 20px; margin-top: 2px;"><i class="bx bx-reset" onclick="toggleStop('<?php echo $tdetail->tid;?>');"></i></div> -->
            <input type="hidden" value="<?php echo $atl->flag?>" id="timer_flag_<?php echo $atl->flag?>">

        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input name="tname" id="tname" value="<?php echo $atl->tname;?>" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tname_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="description-content" onclick="return editable_field2();"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="description-content"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                    <?php                                           
                    if($porttm){
                        foreach ($porttm as $ptm) {
                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                            if($m->reg_id != $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $m->reg_id;?>" <?php if($atl->tassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                            <?php
                                }
                            if($m->reg_id == $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                        }
                    ?>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tassignee_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content">High</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="high" <?php if($atl->tpriority == 'high'){ echo "selected";}?>>High</option>
                    <option value="medium" <?php if($atl->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                    <option value="low" <?php if($atl->tpriority == 'low'){ echo "selected";}?>>Low</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tpriority_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                                if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                <?php
                              }
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                                if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                <?php
                              }
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="to_do" <?php if($atl->tstatus == 'to_do'){ echo "selected";}?>>To Do</option>
                    <option value="in_progress" <?php if($atl->tstatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                    <option value="in_review" <?php if($atl->tstatus == 'in_review'){ echo "selected";}?>>In Review</option>
                    <option value="done" <?php if($atl->tstatus == 'done'){ echo "selected";}?>>Done</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tstatus_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
            <?php
            }
            else
            {
            ?>
            <fieldset class="ms-2">
                <?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?>
                </fieldset>
                <?php 
            }
            ?>
        </div>
        <div class="col-lg">
            <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date<?php echo $atl->tid;?>" value="<?php echo $get_pubD->p_publish;?>">
                <?php
              }  
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <?php
                }
              }
            }
            ?>
            <fieldset class="description">
            <?php
if($privilege_only_view == 'no')
{
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_pubD(<?php echo $atl->tid;?>);">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_goalD(<?php echo $atl->tid;?>);">
                <?php
              }
              else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }  
            }
            else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }
            ?>
                <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $atl->tdue_date;?></span></p>
                <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>
              <div class="description-details">
                <p><span class="badge badge-soft-primary description-content"><?php echo $atl->tdue_date;?></span></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input type="text" class="form-control task_datepicker_field" onchange="return edit_yes_calendar(this);" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>" id="tdue_date<?php echo $atl->tid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->tid;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_Task_L_Subtasks)
            {
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
            ?>
            <!-- single sub task area start -->
            <li class="all-data" data-searchid="<?php echo $l_subtask->stdue_date;?>">
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $l_subtask->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0)" onclick="return SubtaskEditModal('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Edit</a>
                                <?php
                                $check_pro_createdby = "";
                                $check_pro_manager = "";
                                $portfolio_owner_id = "";
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                            $check_pro_manager = $pro->pmanager;
                                            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                                            if($check_Portfolio_owner_id)
                                            {
                                                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                            }
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) 
                                    {
                                ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_subtask('<?php echo $l_subtask->stid;?>');" id="dup_pro_id">Duplicate</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $l_subtask->stid;?>');">Archive</a> -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_subtask('<?php echo $l_subtask->stid;?>');">File it</a>
                                <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Delete</a>
                                <?php
                                    }
                                ?>     
                            </div>
                        </div> <!-- end dropdown -->
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <?php
    }
}
?>
                        <div class="row">
                            <div class="col-lg">
                                <?php echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <i class="bx bx-play-circle timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i>
                            </span>
                                <span class="countersubtask_<?php echo $l_subtask->stid;?> counter_stask" data-id="<?php echo $l_subtask->stid;?>">
                                <?php
                                    if($l_subtask->sflag == '1'){
                                        if($l_subtask->start_stimer_new != ''){
                                          // Old time
                                          $old_time_task = $l_subtask->start_stimer_new;                                                                
                                        }
                                        else{
                                        $old_time_task = $l_subtask->start_stimer;
                                        }
                                        
                                        // Current time
                                        $current_time_task = date("Y-m-d H:i:s");
                                        // Create DateTime objects for old and current times
                                        $old_datetime_task = new DateTime($old_time_task);
                                        $current_datetime_task = new DateTime($current_time_task);
                                        // Calculate the time difference
                                        $interval_task = $current_datetime_task->diff($old_datetime_task);
                                      // Access the time difference components
                                        $diff_hours_task = $interval_task->h;
                                        $diff_minutes_task = $interval_task->i;
                                        $diff_seconds_task = $interval_task->s;
                                        $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                                        $time1_task = $timer_task;
                                        $time2_task = $l_subtask->tracked_stime;

                                        $task_time1 = new DateTime($time1_task);
                                        $task_time2 = new DateTime($time2_task);
                                    
                                        $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                                        $task_time2->add($interval_task);
                                        
                                        $timer_stask = $task_time2->format('H:i:s');
                                        }
                                        
                                        else{
                                          if($l_subtask->tracked_stime != ""){
                                          $timer_stask = $l_subtask->tracked_stime;
                                          }
                                          else{
                                          $timer_stask = '00:00:00';
                                          }
                                        }
                                      echo trim($timer_stask);
                                ?>
                            </span>
                                                                <input type="hidden" value="<?php echo $l_subtask->sflag?>" id="timer_sflag_<?php echo $l_subtask->stid?>">

                                <input type="hidden" id="timer_sflag_new_<?php echo $l_subtask->stid;?>" value="<?php echo $l_subtask->sflag;?>">                   
                                <input type="hidden" id="timer_sflag_poup_<?php echo $l_subtask->stid;?>" value="">     
                                <input type="hidden"  id="stimer_started_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">
                                <input type="hidden"  id="stimer_started_popup_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">

                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input name="stname" id="stname" value="<?php echo $l_subtask->stname;?>" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stname_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="description-content" onclick="return editable_field2();"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="description-content"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                                        <?php                                           
                                        if($porttm){
                                            foreach ($porttm as $ptm) {
                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($l_subtask->stassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stassignee_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="stpriority" id="stpriority" required="">
                                        <option value="high" <?php if($l_subtask->stpriority == 'high'){ echo "selected";}?>>High</option>
                                        <option value="medium" <?php if($l_subtask->stpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                        <option value="low" <?php if($l_subtask->stpriority == 'low'){ echo "selected";}?>>Low</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stpriority_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                      {
                                                        ?>
                                                        <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                                        <?php
                                                      }
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                      {
                                                        ?>
                                                        <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                                        <?php
                                                      }
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="tpriority" id="tpriority" required="">
                                        <option value="to_do" <?php if($l_subtask->ststatus == 'to_do'){ echo "selected";}?>>To Do</option>
                                        <option value="in_progress" <?php if($l_subtask->ststatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                                        <option value="in_review" <?php if($l_subtask->ststatus == 'in_review'){ echo "selected";}?>>In Review</option>
                                        <option value="done" <?php if($l_subtask->ststatus == 'done'){ echo "selected";}?>>Done</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="ststatus_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                                <?php
                                }
                                else
                                {
                                ?>
                                <fieldset class="mt-1 ms-2">
                                    <?php
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">Done</span>
                                    <?php
                                                }
                                    ?>
                                    </fieldset>
                                    <?php 
                                }
                                ?>
                            </div>
                            <div class="col-lg">
                                <input type="hidden" name="get_tdue_date" class="if_task_date_change<?php echo $atl->tid;?>" id="get_tdue_date<?php echo $l_subtask->stid; ?>" value="<?php echo $atl->tdue_date;?>">
                                <?php
                                $gdetail = $this->Front_model->GoalDetail($atl->gid);
                                if($gdetail)
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                <?php
                                } 
                                else
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>">
                                <?php
                                } 
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $l_subtask->stdue_date;?></span></p>
                                    <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><span class="badge badge-soft-primary description-content"><?php echo $l_subtask->stdue_date;?></span></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input type="text" class="form-control task_date_changed<?php echo $atl->tid;?>" onchange="return edit_yes_calendar(this);" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>" id="stdue_date<?php echo $l_subtask->stid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $l_subtask->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>  
            </li>
            <!-- single sub task area end -->
            <?php
                }
            }
            ?>          
        </ul>
    </div>
</div>
<!-- sub task area end -->
<!--Task with subtask end-->
            </div>
        </div>
    </div>
</div>
<?php
                }
            }
            else
            {
            $check_pro_createdby = "";
            $check_pro_manager = "";
            $portfolio_owner_id = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
                    $check_pro_manager = $pro->pmanager;
                    $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                    if($check_Portfolio_owner_id)
                    {
                        $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                    }
                }
            }
            $check_pro_member_status = "";
            $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
            if($check_ProjectMToClear)
            {
                $check_pro_member_status = $check_ProjectMToClear->status;
            }
            if(($atl->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
            {
                $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
            ?>
    <div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">  
        <div class="col-lg-12">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body" style="padding: 8px 0px 0px 0px;">
                    <div class="row mb-2">
                        <div class="col-lg-1"></div>
                        <?php
                  if($check_suggested)
                    {
                  ?>
                  <div class="col-lg-11">Project Request is not send from Project Owner. Task Name: <?php echo $atl->tname;?></div>
                  <?php
                    }
                    else
                    {
                  ?>
                    <div class="col-lg-7">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $atl->tname;?></div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                             Accept Request
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             Request More Info
                        </a>
                    </div>
                  <?php
                    }
                  ?>
                    </div>                
                </div>
            </div>
        </div>
    </div>
            <?php
            }
            else
            {
?>
<div class="row mb-2 search-list new_tid_top parent_task all-data <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>"> 
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<!--Task with subtask-->
<?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $atl->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
    <div class="dropdown float-end">
        <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="javascript:void(0)" onclick="return TaskEditModal('<?php echo $atl->tid;?>')">Edit</a>
            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $atl->tproject_assign;?>">
                    <input type="hidden" name="tid" value="<?php echo $atl->tid;?>">
                    <input type="hidden" name="port_id" value="<?php echo $atl->portfolio_id;?>">
                    <input type="hidden" id="timer_flag_new_<?php echo $atl->tid;?>" value="<?php echo $atl->flag;?>">                      
                    <input type="hidden" id="timer_flag_poup_<?php echo $atl->tid;?>" value="">         
                    <input type="hidden"  id="timer_started_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">    
                    <input type="hidden"  id="timer_started_popup_<?php echo $atl->tid?>" value="<?php echo $atl->flag?>">
                    <input type="hidden" name="task_dd" value="<?php echo $atl->tdue_date;?>">
                    <button type="submit" class="dropdown-item">Add Subtask</button> 
            </form>
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))  
                {
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
        <?php
      }
      else
      {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($atl->tproject_assign);
        if($getPackDetail2)
        {
          $total_tasks2 = trim($getPackDetail2->pack_tasks);
          $used_tasks2 = trim($getTaskCount2['task_count_rows']);
          $check_type2 = is_numeric($total_tasks2);
          if($check_type2 == 'true')
          {
            if($used_tasks2 < $total_tasks2)
            {
                ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
            }
            else
            {
                ?>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
            <?php
          }
        }
    }
}
}
else
{
  
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('task', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return Expire_Package_popup();">Duplicate</a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($atl->tproject_assign);
            if($getPackDetail2)
            {
              $total_tasks2 = trim($getPackDetail2->pack_tasks);
              $used_tasks2 = trim($getTaskCount2['task_count_rows']);
              $check_type2 = is_numeric($total_tasks2);
              if($check_type2 == 'true')
              {
                if($used_tasks2 < $total_tasks2)
                {
                    ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="return limit_Exceeds_popup();">Duplicate</a>
                    <?php
                }
              }
              else
              {
                ?> 
                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $atl->tid;?>');" id="dup_pro_id">Duplicate</a>
                <?php
              }
            }
          }
        }
      }
    }    
  
}
            ?>
                
                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_task('<?php echo $atl->tid;?>');">Archive</a> -->
                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_task('<?php echo $atl->tid;?>');">File it</a>
                <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $atl->tid;?>');" class="dropdown-item">Delete</a>
            <?php
                }
            ?>
        </div>
    </div> <!-- end dropdown -->
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
<?php
    }
}
?>
    <div class="row m-1">
        <div class="col-lg">
            <?php
            $Check_Task_L_Subtasks = $this->Front_model->Check_Task_Subtasks2($atl->tid);
            if($Check_Task_L_Subtasks)
            {
                $sub_L_cnt = 0;
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
                    $sub_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->tid;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->tid;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $sub_L_cnt;?></span>
            </a>
            <?php
            }
            else
            {
            ?>
            <a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>
            <?php
            }
            echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><i class="bx bx-play-circle timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i></span>
        <span class="counter_<?php echo $atl->tid;?> counter_task" data-id="<?php echo $atl->tid;?>">
        <?php
            if($atl->flag == '1'){
                if($atl->start_timer_new != ''){
                  // Old time
                  $old_time_task = $atl->start_timer_new;                                                                
                }
                else{
                $old_time_task = $atl->start_timer;
                }
                
                // Current time
                $current_time_task = date("Y-m-d H:i:s");
                // Create DateTime objects for old and current times
                $old_datetime_task = new DateTime($old_time_task);
                $current_datetime_task = new DateTime($current_time_task);
                // Calculate the time difference
                $interval_task = $current_datetime_task->diff($old_datetime_task);
              // Access the time difference components
                $diff_hours_task = $interval_task->h;
                $diff_minutes_task = $interval_task->i;
                $diff_seconds_task = $interval_task->s;
                $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                $time1_task = $timer_task;
                $time2_task = $atl->tracked_time;

                $task_time1 = new DateTime($time1_task);
                $task_time2 = new DateTime($time2_task);
            
                $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                $task_time2->add($interval_task);
                
                $timer_task = $task_time2->format('H:i:s');
                }
                
                else{
                  if($atl->tracked_time != ""){
                  $timer_task = $atl->tracked_time;
                  }
                  else{
                  $timer_task = '00:00:00';
                  }
                }
              echo trim($timer_task);
        ?>
        </span>
            <!-- <div id="" style="margin-left: 5px;font-size: 20px; margin-top: 2px;"><i class="bx bx-reset" onclick="toggleStop('<?php echo $tdetail->tid;?>');"></i></div> -->
            <input type="hidden" value="<?php echo $atl->flag?>" id="timer_flag_<?php echo $atl->flag?>">

        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input name="tname" id="tname" value="<?php echo $atl->tname;?>" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tname_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="description-content" onclick="return editable_field2();"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="description-content"><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                    <?php                                           
                    if($porttm){
                        foreach ($porttm as $ptm) {
                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                            if($m->reg_id != $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $m->reg_id;?>" <?php if($atl->tassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                            <?php
                                }
                            if($m->reg_id == $this->session->userdata('d168_id'))
                                {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($atl->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                            <?php
                        }
                    ?>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tassignee_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content">Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content">Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content">High</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="high" <?php if($atl->tpriority == 'high'){ echo "selected";}?>>High</option>
                    <option value="medium" <?php if($atl->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                    <option value="low" <?php if($atl->tpriority == 'low'){ echo "selected";}?>>Low</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tpriority_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
        <div class="col-lg">
            <?php
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                
              <div class="description-details">
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                                if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                <?php
                              }
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                <?php
                            }             
                ?></p>
                <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
              </div>
<?php
}
else
{
?>                
              <div>
                <p class="task_review_status<?php echo $atl->tid;?>"><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                                if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                              {
                                ?>
                                <span class="badge btn-d text-white" onclick="return TaskReviewModal('<?php echo $atl->tid;?>')">Review</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                <?php
                              }
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <select class="form-select" name="tpriority" id="tpriority" required="">
                    <option value="to_do" <?php if($atl->tstatus == 'to_do'){ echo "selected";}?>>To Do</option>
                    <option value="in_progress" <?php if($atl->tstatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                    <option value="in_review" <?php if($atl->tstatus == 'in_review'){ echo "selected";}?>>In Review</option>
                    <option value="done" <?php if($atl->tstatus == 'done'){ echo "selected";}?>>Done</option>
                </select>
                <div class="description-controls float-end">
                  <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes2();" data-class="task_editable" data-name="tstatus_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
            <?php
            }
            else
            {
            ?>
            <fieldset class="ms-2">
                <?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                <?php
                            }             
                ?>
                </fieldset>
                <?php 
            }
            ?>
        </div>
        <div class="col-lg">
            <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date<?php echo $atl->tid;?>" value="<?php echo $get_pubD->p_publish;?>">
                <?php
              }  
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <?php
                }
              }
            }
            ?>
            <fieldset class="description">
            <?php
if($privilege_only_view == 'no')
{
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_pubD(<?php echo $atl->tid;?>);">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker_goalD(<?php echo $atl->tid;?>);">
                <?php
              }
              else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              }  
            }
            else
              {
                ?>
                <div class="description-details" onmousemove="return task_datepicker(<?php echo $atl->tid;?>);">
                <?php
              } 
            ?>
                <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $atl->tdue_date;?></span></p>
                <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
              </div>
<?php
}
else
{
?>
              <div class="description-details">
                <p><span class="badge badge-soft-primary description-content"><?php echo $atl->tdue_date;?></span></p>
              </div>
<?php    
}
?>
              <div class="description-edit">
                <input type="text" class="form-control task_datepicker_field" onchange="return edit_yes_calendar(this);" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>" id="tdue_date<?php echo $atl->tid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                <div class="description-controls float-end">
                  <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $atl->tid;?>" onclick="return edit_yes();" data-class="task_editable" data-name="tduedate_field" data-id="<?php echo $atl->tid;?>"></i>
                </div>
              </div>
                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
            </fieldset>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->tid;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_Task_L_Subtasks)
            {
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
            ?>
            <!-- single sub task area start -->
            <li class="all-data" data-searchid="<?php echo $l_subtask->stdue_date;?>">
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <?php
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] == $l_subtask->portfolio_id)
    {
if($privilege_only_view == 'no')
{
        ?> 
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0)" onclick="return SubtaskEditModal('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Edit</a>
                                <?php
                                $check_pro_createdby = "";
                                $check_pro_manager = "";
                                $portfolio_owner_id = "";
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                            $check_pro_manager = $pro->pmanager;
                                            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                                            if($check_Portfolio_owner_id)
                                            {
                                                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                            }
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))) 
                                    {
                                ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return duplicate_subtask('<?php echo $l_subtask->stid;?>');" id="dup_pro_id">Duplicate</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $l_subtask->stid;?>');">Archive</a> -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="return file_it_subtask('<?php echo $l_subtask->stid;?>');">File it</a>
                                <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $l_subtask->stid;?>');" class="dropdown-item">Delete</a>
                                <?php
                                    }
                                ?>     
                            </div>
                        </div> <!-- end dropdown -->
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <?php
    }
}
?>
                        <div class="row">
                            <div class="col-lg">
                                <?php echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <i class="bx bx-play-circle timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i>
                            </span>
                                <span class="countersubtask_<?php echo $l_subtask->stid;?> counter_stask" data-id="<?php echo $l_subtask->stid;?>">
                                <?php
                                    if($l_subtask->sflag == '1'){
                                        if($l_subtask->start_stimer_new != ''){
                                          // Old time
                                          $old_time_task = $l_subtask->start_stimer_new;                                                                
                                        }
                                        else{
                                        $old_time_task = $l_subtask->start_stimer;
                                        }
                                        
                                        // Current time
                                        $current_time_task = date("Y-m-d H:i:s");
                                        // Create DateTime objects for old and current times
                                        $old_datetime_task = new DateTime($old_time_task);
                                        $current_datetime_task = new DateTime($current_time_task);
                                        // Calculate the time difference
                                        $interval_task = $current_datetime_task->diff($old_datetime_task);
                                      // Access the time difference components
                                        $diff_hours_task = $interval_task->h;
                                        $diff_minutes_task = $interval_task->i;
                                        $diff_seconds_task = $interval_task->s;
                                        $timer_task = sprintf("%02d:%02d:%02d", $diff_hours_task, $diff_minutes_task, $diff_seconds_task);
                                        $time1_task = $timer_task;
                                        $time2_task = $l_subtask->tracked_stime;

                                        $task_time1 = new DateTime($time1_task);
                                        $task_time2 = new DateTime($time2_task);
                                    
                                        $interval_task = new DateInterval('PT' . $task_time1->format('H') . 'H' . $task_time1->format('i') . 'M' . $task_time1->format('s') . 'S');
                                        $task_time2->add($interval_task);
                                        
                                        $timer_stask = $task_time2->format('H:i:s');
                                        }
                                        
                                        else{
                                          if($l_subtask->tracked_stime != ""){
                                          $timer_stask = $l_subtask->tracked_stime;
                                          }
                                          else{
                                          $timer_stask = '00:00:00';
                                          }
                                        }
                                      echo trim($timer_stask);
                                ?>
                            </span>
                                                                <input type="hidden" value="<?php echo $l_subtask->sflag?>" id="timer_sflag_<?php echo $l_subtask->stid?>">

                                <input type="hidden" id="timer_sflag_new_<?php echo $l_subtask->stid;?>" value="<?php echo $l_subtask->sflag;?>">                   
                                <input type="hidden" id="timer_sflag_poup_<?php echo $l_subtask->stid;?>" value="">     
                                <input type="hidden"  id="stimer_started_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">
                                <input type="hidden"  id="stimer_started_popup_<?php echo $l_subtask->stid?>" value="<?php echo $l_subtask->sflag?>">

                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input name="stname" id="stname" value="<?php echo $l_subtask->stname;?>" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stname_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="description-content" onclick="return editable_field2();"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="description-content"><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-control editable_team_member" name="editable_team_member2" id="editable_team_member2" required="">
                                        <?php                                           
                                        if($porttm){
                                            foreach ($porttm as $ptm) {
                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($l_subtask->stassignee == $m->reg_id){ echo "selected";}?>><?php echo $m->first_name." ".$m->last_name; ?></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($l_subtask->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stassignee_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" onclick="return editable_field2();">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" onclick="return editable_field2();">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" onclick="return editable_field2();">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content">High</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="stpriority" id="stpriority" required="">
                                        <option value="high" <?php if($l_subtask->stpriority == 'high'){ echo "selected";}?>>High</option>
                                        <option value="medium" <?php if($l_subtask->stpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                        <option value="low" <?php if($l_subtask->stpriority == 'low'){ echo "selected";}?>>Low</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="stpriority_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>                                    
                                  <div class="description-details">
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                      {
                                                        ?>
                                                        <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                                        <?php
                                                      }
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <i class="fas fa-angle-down" onclick="return editable_field2();"></i>
                                  </div>
<?php
}
else
{
?>                                    
                                  <div>
                                    <p class="subtask_review_status<?php echo $l_subtask->stid;?>"><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                                    if(($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                                      {
                                                        ?>
                                                        <span class="badge btn-d text-white" onclick="return SubtaskReviewModal('<?php echo $l_subtask->stid;?>')">Review</span>
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                                                        <?php
                                                      }
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content">Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                  </div>
<?php    
}
?>
                                  <div class="description-edit">
                                    <select class="form-select" name="tpriority" id="tpriority" required="">
                                        <option value="to_do" <?php if($l_subtask->ststatus == 'to_do'){ echo "selected";}?>>To Do</option>
                                        <option value="in_progress" <?php if($l_subtask->ststatus == 'in_progress'){ echo "selected";}?>>In Progress</option>
                                        <option value="in_review" <?php if($l_subtask->ststatus == 'in_review'){ echo "selected";}?>>In Review</option>
                                        <option value="done" <?php if($l_subtask->ststatus == 'done'){ echo "selected";}?>>Done</option>
                                    </select>
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes2();" data-mtask_id="<?php echo $l_subtask->tid;?>" data-class="subtask_editable" data-name="ststatus_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                                <?php
                                }
                                else
                                {
                                ?>
                                <fieldset class="mt-1 ms-2">
                                    <?php
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">Done</span>
                                    <?php
                                                }
                                    ?>
                                    </fieldset>
                                    <?php 
                                }
                                ?>
                            </div>
                            <div class="col-lg">
                                <input type="hidden" name="get_tdue_date" class="if_task_date_change<?php echo $atl->tid;?>" id="get_tdue_date<?php echo $l_subtask->stid; ?>" value="<?php echo $atl->tdue_date;?>">
                                <?php
                                $gdetail = $this->Front_model->GoalDetail($atl->gid);
                                if($gdetail)
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                <?php
                                } 
                                else
                                {
                                ?>
                                <input type="hidden" name="get_gstart_date" id="get_gstart_date<?php echo $l_subtask->stid; ?>">
                                <input type="hidden" name="get_gend_date" id="get_gend_date<?php echo $l_subtask->stid; ?>">
                                <?php
                                } 
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" onclick="return editable_field();"><?php echo $l_subtask->stdue_date;?></span></p>
                                    <i class="fas fa-calendar-alt" onclick="return editable_field();"></i>
                                  </div>
<?php
}
else
{
?>
                                  <div>
                                    <p><span class="badge badge-soft-primary description-content"><?php echo $l_subtask->stdue_date;?></span></p>
                                  </div>
<?php    
}
?>                                  
                                  <div class="description-edit">
                                    <input type="text" class="form-control task_date_changed<?php echo $atl->tid;?>" onchange="return edit_yes_calendar(this);" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>" id="stdue_date<?php echo $l_subtask->stid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $l_subtask->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
                                    <div class="description-controls float-end">
                                      <a onclick="return dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                      <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but<?php echo $l_subtask->stid;?>" onclick="return edit_yes();" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>"></i>
                                    </div>
                                  </div>
                                      <span class="text-danger req_tfield" style="display: none;">Field is required</span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>  
            </li>
            <!-- single sub task area end -->
            <?php
                }
            }
            ?>          
        </ul>
    </div>
</div>
<!-- sub task area end -->
<!--Task with subtask end-->
            </div>
        </div>
    </div>
</div>
<?php
                }
            }
        }
    }
    $check_tid = $get_atl->s_tid;
    }
}
?>
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
                                    <!-- Task Attach File Modal -->
                                    <div id="task_attachmentModal" class="modal fade" tabindex="-1" aria-labelledby="#task_attachmentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="task_attachmentModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtask Attach File Modal -->
                                    <div id="subtask_attachmentModal" class="modal fade" tabindex="-1" aria-labelledby="#subtask_attachmentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="subtask_attachmentModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Tasks Overview Modal -->
                                    <div id="TaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#TaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="TaskOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtasks Overview Modal -->
                                    <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                     <!-- Preview task file modal content -->
                                    <div id="previewTaskModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewTaskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="PreviewTaskFile_Content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Preview subtask file modal content -->
                                    <div id="previewSubtaskModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewSubtaskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="previewSubtaskModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtasks Edit Modal -->
                                    <div id="SubtaskEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#SubtaskEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="SubtaskEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Tasks Edit Modal -->
                                    <div id="TaskEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#TaskEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="TaskEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                     <!-- Tasks Review Modal -->
                                    <div id="TaskReviewModal" class="modal fade bs-example-modal-xl" aria-labelledby="#TaskReviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="TaskReviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subasks Review Modal -->
                                    <div id="SubtaskReviewModal" class="modal fade bs-example-modal-xl" aria-labelledby="#SubtaskReviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskReviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Task Comment Modal -->
                                    <div id="task_commentModal" class="modal modal_display_cus" >
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content" id="task_commentmodal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtask Comment Modal -->
                                    <div id="subtask_commentModal" class="modal modal_display_cus">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content" id="subtask_commentmodal_content">
                                                
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
<!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>
<!-- dragula plugins -->
<script src="<?php echo base_url();?>assets/libs/dragula/dragula.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pages/tasklist.init.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/task-kanban.init.js"></script>
        <?php
include('footer_links.php');
?>
<!-- <script type="text/javascript">
    $('#search-criteria').keyup(function(){
        //debugger;
    $('.search-cards').hide();
    $('#search-clear').css('display','block');
    var txt = $('#search-criteria').val();
    $('.search-cards').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
           $(this).show();
       }
    });
});
    $("#search-clear").click(function(){
            $("#search-criteria").val("");
            $('.search-cards').show();
            $('#search-clear').css('display','none');
          });
</script> -->
<script type="text/javascript">
    $('#search-criteria-list').keyup(function(){
        //debugger;
    $('.search-list').hide();
    $('#search-clear-list').css('display','block');
    var txt = $('#search-criteria-list').val();
    $('.search-list').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
           $(this).show();
       }
    });
});
    $("#search-clear-list").click(function(){
            $("#search-criteria-list").val("");
            $('.search-list').show();
            $('#search-clear-list').css('display','none');
          });
</script>
<script type="text/javascript">
    var  elements = document.querySelectorAll('.counter_task[data-id]');

elements.forEach(element => {
  var  dataId = element.getAttribute('data-id');
  $.ajax({
        url: base_url+'front/get_flag',
        type: 'POST', 
        data: {id: dataId},
        success: function(data){
  var data = JSON.parse(data);
         if (data.flag == '1')
         {  
             toggleTimer1(dataId);        
         }
        }
      });
    });


    var  elements_subtask = document.querySelectorAll('.counter_stask[data-id]');

    elements_subtask.forEach(element_subtask => {
  var  dataSId = element_subtask.getAttribute('data-id');
  $.ajax({
        url: base_url+'front/get_sflag',
        type: 'POST', 
        data: {id: dataSId},
        success: function(data){
  var data = JSON.parse(data);
         if (data.sflag == '1')
         {  
            SubtaskTimer3(dataSId);        
         }
        }
      });
    });
const togglers = document.querySelectorAll(".toggler");

togglers.forEach((toggler) => {
  toggler.addEventListener("click", () => {
    toggler.classList.toggle("active");
    toggler.nextElementSibling.classList.toggle("active");
  });
});
</script>
    </body>

</html>