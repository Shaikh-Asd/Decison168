<?php
$page = 'today-tasks';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Today Tasks</title>
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
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link active" id="v-pills-grid-tab" data-bs-toggle="pill" href="#v-pills-grid" role="tab" aria-controls="v-pills-grid" aria-selected="true">
                                    <i class="mdi mdi-view-grid-outline"></i>
                                </a>
                            </li>
<?php
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if(isset($_COOKIE["d168_selectedportfolio"]))
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
        <li class="nav-item">
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getTaskCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            $total_all_pro = trim($getPackDetail->pack_projects);
            $total_all_task = $total_tasks;
            if(is_numeric($total_all_pro))
            {
              $total_all_task = $total_tasks * $total_all_pro;
            }
            if($used_tasks < $total_all_task)
            {
              if(isset($_COOKIE["d168_selectedportfolio"]))
              {
                    ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                            <i class="mdi mdi-plus"></i> Create New
                        </a>
                    </li>
                    <?php
              }
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
                <?php
            }
          }
          else
          {
            if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
                <?php
                }
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getTaskCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            $total_all_pro = trim($getPackDetail->pack_projects);
            $total_all_task = $total_tasks;
            if(is_numeric($total_all_pro))
            {
              $total_all_task = $total_tasks * $total_all_pro;
            }
            if($used_tasks < $total_all_task)
            {
              if(isset($_COOKIE["d168_selectedportfolio"]))
              {
                    ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                            <i class="mdi mdi-plus"></i> Create New
                        </a>
                    </li>
                    <?php
              }
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
                <?php
            }
          }
          else
          {
            if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
                <?php
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
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount = $this->Front_model->getTaskCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_tasks = trim($getPackDetail->pack_tasks);
              $used_tasks = trim($getTaskCount['task_count_rows']);
              $check_type = is_numeric($total_tasks);
              if($check_type == 'true')
              {
                $total_all_pro = trim($getPackDetail->pack_projects);
                $total_all_task = $total_tasks;
                if(is_numeric($total_all_pro))
                {
                  $total_all_task = $total_tasks * $total_all_pro;
                }
                if($used_tasks < $total_all_task)
                {
                  if(isset($_COOKIE["d168_selectedportfolio"]))
                  {
                        ?>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                                <i class="mdi mdi-plus"></i> Create New
                            </a>
                        </li>
                        <?php
                  }
                }
                else
                {
                    ?>
                    <li class="nav-item">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                    </li>
                    <?php
                }
              }
              else
              {
                if(isset($_COOKIE["d168_selectedportfolio"]))
                    {
                    ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                            <i class="mdi mdi-plus"></i> Create New
                        </a>
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
?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">                    
                <ol class="breadcrumb m-0">                    
                    <li class="breadcrumb-item">
                        <div class="row">
                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8"></div>
                            <div>
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
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        
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
            <div class="row mb-2">
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
if($TodayTasks)
{
    foreach($TodayTasks as $atl)
    {
        $getTaskSubtaskToCheck = $this->Front_model->getTaskSubtaskToCheck($atl->tid);
        if($getTaskSubtaskToCheck == 0)
        {
            $check_pro_createdby = "";
        if(!empty($atl->tproject_assign))
        {
            $pro = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro)
            {
                $check_pro_createdby = $pro->pcreated_by;
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if($privilege_only_view == 'no')
            {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php } echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
            $today = date('Y-m-d');
            $getTaskSubtaskToCheckList = $this->Front_model->getTaskTODAYSubtaskToCheckList($atl->tid,$today);
            $check_sub_not_assigned = "not_assigned";
            if($getTaskSubtaskToCheckList)
            {
                foreach($getTaskSubtaskToCheckList as $subTaskList)
                {
                    if($subTaskList->stassignee == $this->session->userdata('d168_id'))
                    {
                        $check_sub_not_assigned = "yes_assigned";
                    }
                }
            }
        if($check_sub_not_assigned == "not_assigned")
        {
            $check_pro_createdby = "";
        if(!empty($atl->tproject_assign))
        {
            $pro = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro)
            {
                $check_pro_createdby = $pro->pcreated_by;
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if($privilege_only_view == 'no')
            {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php } echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
}
if($TodaySubtasklist_Task)
{
    $check_tid = "";
    foreach($TodaySubtasklist_Task as $get_atl)
    {
    
    if($check_tid != $get_atl->tid)
    {
        $atl = $this->Front_model->getTasksDetail($get_atl->tid);
        if($atl)
        {
            if((($atl->tcreated_by != $this->session->userdata('d168_id')) && ($atl->tassignee == $this->session->userdata('d168_id'))) || (($atl->tcreated_by == $this->session->userdata('d168_id')) && ($atl->tassignee != $this->session->userdata('d168_id'))) || (($atl->tcreated_by != $this->session->userdata('d168_id')) && ($atl->tassignee != $this->session->userdata('d168_id'))))
            {
                if($atl->tassignee != $this->session->userdata('d168_id'))
            {
            $check_pro_createdby = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
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
    <div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
                if($privilege_only_view == 'no')
                {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php
                }
            }
            else
            {
            ?>
            <i class="mdi mdi-block-helper"></i>
            <?php
            }
             echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
            elseif($atl->tassignee == $this->session->userdata('d168_id'))
            {
            $check_pro_createdby = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
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
    <div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;"';}?>>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
                if($privilege_only_view == 'no')
                {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php
                }
            }
            else
            {
            ?>
            <i class="mdi mdi-block-helper"></i>
            <?php
            }
             echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
            else
            {
                if($atl->tassignee != $this->session->userdata('d168_id'))
            {
            $check_pro_createdby = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
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
    <div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
                if($privilege_only_view == 'no')
                {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php
                }
            }
            else
            {
            ?>
            <i class="mdi mdi-block-helper"></i>
            <?php
            }
             echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
            elseif($atl->tassignee == $this->session->userdata('d168_id'))
            {
            $check_pro_createdby = "";
            if(!empty($atl->tproject_assign))
            {
                $pro = $this->Front_model->getProjectById($atl->tproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
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
    <div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
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
<div class="row mb-2 search-list new_tid_top" data-toptid="<?php echo $atl->tid;?>">   
    <div class="col-lg-12">
        <div class="card" <?php if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;"';} else { echo 'style="margin-bottom: 0px;"';}?>>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($atl->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
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
<?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
<i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskAttachment('<?php echo $atl->tid;?>');"></i>
<?php
}
?>
<i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return TaskCommentModal('<?php echo $atl->tid;?>');"></i>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
                if($privilege_only_view == 'no')
                {
            ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
            <?php
                }
            }
            else
            {
            ?>
            <i class="mdi mdi-block-helper"></i>
            <?php
            }
             echo $atl->tcode;?>
        </div>
        <div class="col-lg">
        <span class="timerBtn_<?php echo $atl->tid;?>"><?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerBtn_<?php echo $atl->tid;?>"  onclick="toggleTimer('<?php echo $atl->tid;?>');"></i><?php } ?></span>
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
              <div class="description-details">
                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
              <div class="description-details">
                <p><?php 
                        if($atl->tpriority == 'low')
                            {
                ?>
                <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                <?php
                            }
                        elseif($atl->tpriority == 'medium')
                            {
                ?>
                <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                <?php
                            }
                        elseif($atl->tpriority == 'high')
                            {
                ?>
                <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
            if(($atl->tassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
            {
            ?>
            <fieldset class="description">
              <div class="description-details">
                <p><?php 
                        if($atl->tstatus == 'to_do')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_progress')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                <?php
                            }
                        elseif($atl->tstatus == 'in_review')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                <?php
                            }
                        elseif($atl->tstatus == 'done')
                            {
                ?>
                <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                <?php
                            }             
                ?></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
              </div>
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
                <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $atl->tdue_date;?></span></p>
                <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
              </div>
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
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) { echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
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
                                    if(!empty($l_subtask->stproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($l_subtask->stproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
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
                        <?php
        }
    }
}

if($privilege_only_view == 'no')
{
?>
                        <i class="fas fa-paperclip mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskAttachment('<?php echo $l_subtask->stid;?>');"></i>
<?php
}
?>
                        <i class="fas fa-comments mt-1 me-2 float-end" style="cursor: pointer;" onclick="return SubtaskCommentModal('<?php echo $l_subtask->stid;?>');"></i>
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                    if($privilege_only_view == 'no')
                                    {
                                ?>
                                <input class="form-check-input" type="checkbox" <?php if($l_subtask->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $l_subtask->stid;?>','<?php echo $l_subtask->ststatus;?>','<?php echo $l_subtask->tid;?>');">
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <i class="mdi mdi-block-helper"></i>
                                <?php
                                }
                                 echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg">
                            <span class="timerSBtn_<?php echo $l_subtask->stid;?>">
                                <?php if($privilege_only_view == 'no') { ?><i class="bx bx-play-circle  timerSBtn_<?php echo $l_subtask->stid;?>"  onclick="SubtaskTimer('<?php echo $l_subtask->stid;?>');"></i><?php } ?>
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
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p class="description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>><?php 
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
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>High</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><?php 
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>>Done</span>
                                    <?php
                                                }             
                                    ?></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-angle-down" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field2();"<?php } ?>></i><?php } ?>
                                  </div>
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
                                  <div class="description-details" onmousemove="return task_subtask_datepicker(<?php echo $l_subtask->stid;?>);">
                                    <p><span class="badge badge-soft-primary description-content" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>><?php echo $l_subtask->stdue_date;?></span></p>
                                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt" <?php if($privilege_only_view == 'no') { ?> onclick="return editable_field();"<?php } ?>></i><?php } ?>
                                  </div>
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
    }
    $check_tid = $get_atl->tid;
    }
}
?>
</div>
                                    
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
<div id="refresh_grid_message">
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
</div>
                                                       
                            <div class="row">
                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->
                                            <h4 class="card-title mb-4">To Do</h4>
                                            <div id="task-1">
                                                <div <?php if($privilege_only_view == 'no') { ?>id="to_do-task"<?php } ?> class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                    if($TodayTasks)
                                                    {
                                                        foreach($TodayTasks as $atl)
                                                        {
                                                            if($atl->tstatus == "to_do")
                                                            {
        $check_pro_createdby_grid = "";
        if(!empty($atl->tproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->tproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->tname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                }
                                } 
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tname<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTname(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tname" id="task_name<?php echo $atl->tid; ?>" value="<?php echo $atl->tname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTnameModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                 <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditTnameModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>" id="task-name<?php echo $atl->tid;?>">
                        <?php echo $atl->tname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->tproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tduedate<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTduedate(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date22<?php echo $atl->tid; ?>" value="<?php echo $get_pubD->p_publish;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_pubD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_goalD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
                }
              }
              else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }  
            }
            else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              } 
            ?>
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTduedateModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="task-duedate<?php echo $atl->tid;?>"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    
                                                    if($TodaySubtasks)
                                                    {
                                                        foreach($TodaySubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "to_do")
                                                            {
        $check_pro_createdby_grid = "";
        if(!empty($atl->stproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->stproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->stproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->stproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->stproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->stname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                    ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                } 
                            }
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stname<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTname(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="stname" id="subtask_name<?php echo $atl->stid; ?>" value="<?php echo $atl->stname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="stid" id="stid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTnameModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditSTnameModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" id="subtask-name<?php echo $atl->stid;?>">
                        <?php echo $atl->stname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->stproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stduedate<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTduedate(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
                                               $getTdue = $this->Front_model->getTasksDetail($atl->tid);
                                               $Tdue = "";
                                               if($getTdue)
                                               {
                                                $Tdue = $getTdue->tdue_date;
                                               }
                                                ?>
                                                <input type="hidden" name="get_tdue_date" id="get_tdue_date2<?php echo $atl->stid; ?>" value="<?php echo $Tdue;?>">
                                                <?php
                                                if($getTdue)
                                                {
                                                $gdetail = $this->Front_model->GoalDetail($getTdue->gid);
                                                if($gdetail)
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                                <?php
                                                } 
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                } 
                                                }
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                }
                                                ?>
                                                <input type="text" class="form-control" onmouseenter="return subtask_datepicker2(<?php echo $atl->stid;?>);" id="stdue_date2<?php echo $atl->stid; ?>" name="stdue_date" placeholder="Due Date" value="<?php echo $atl->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTduedateModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditSTduedateModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="subtask-duedate<?php echo $atl->stid;?>"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body">   -->      
                                            <h4 class="card-title mb-4">In Progress</h4>
                                            <div id="task-2">
                                                <div <?php if($privilege_only_view == 'no') { ?>id="in_progress-task"<?php } ?> class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                        if($TodayTasks)
                                                        {
                                                            foreach($TodayTasks as $atl)
                                                            {
                                                                if($atl->tstatus == "in_progress")
                                                                {
        $check_pro_createdby_grid = "";
        if(!empty($atl->tproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->tproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->tname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                }
                                } 
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tname<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTname(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tname" id="task_name<?php echo $atl->tid; ?>" value="<?php echo $atl->tname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTnameModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditTnameModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>" id="task-name<?php echo $atl->tid;?>">
                        <?php echo $atl->tname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->tproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tduedate<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTduedate(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date22<?php echo $atl->tid; ?>" value="<?php echo $get_pubD->p_publish;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_pubD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_goalD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
                }
              }
              else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }  
            }
            else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
            ?>
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTduedateModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="task-duedate<?php echo $atl->tid;?>"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($TodaySubtasks)
                                                    {
                                                        foreach($TodaySubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "in_progress")
                                                            {
        $check_pro_createdby_grid = "";
        if(!empty($atl->stproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->stproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->stproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->stproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->stproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->stname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                } 
                            }
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stname<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTname(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="stname" id="subtask_name<?php echo $atl->stid; ?>" value="<?php echo $atl->stname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="stid" id="stid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTnameModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditSTnameModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" id="subtask-name<?php echo $atl->stid;?>">
                        <?php echo $atl->stname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->stproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            } 
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stduedate<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTduedate(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
                                               $getTdue = $this->Front_model->getTasksDetail($atl->tid);
                                               $Tdue = "";
                                               if($getTdue)
                                               {
                                                $Tdue = $getTdue->tdue_date;
                                               }
                                                ?>
                                                <input type="hidden" name="get_tdue_date" id="get_tdue_date2<?php echo $atl->stid; ?>" value="<?php echo $Tdue;?>">
                                                <?php
                                                if($getTdue)
                                                {
                                                $gdetail = $this->Front_model->GoalDetail($getTdue->gid);
                                                if($gdetail)
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                                <?php
                                                } 
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                } 
                                                }
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                }
                                                ?>
                                                <input type="text" class="form-control" onmouseenter="return subtask_datepicker2(<?php echo $atl->stid;?>);" id="stdue_date2<?php echo $atl->stid; ?>" name="stdue_date" placeholder="Due Date" value="<?php echo $atl->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTduedateModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditSTduedateModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="subtask-duedate<?php echo $atl->stid;?>"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body">  -->       
                                            <h4 class="card-title mb-4">In Review</h4>
                                            <div id="task-2">
                                                <div <?php if($privilege_only_view == 'no') { ?>id="in_review-task"<?php } ?> class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                        if($TodayTasks)
                                                        {
                                                            foreach($TodayTasks as $atl)
                                                            {
                                                                if($atl->tstatus == "in_review")
                                                                {
        $check_pro_createdby_grid = "";
        if(!empty($atl->tproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->tproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->tname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                }
                                } 
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tname<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTname(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tname" id="task_name<?php echo $atl->tid; ?>" value="<?php echo $atl->tname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTnameModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditTnameModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>" id="task-name<?php echo $atl->tid;?>">
                        <?php echo $atl->tname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->tproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tduedate<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTduedate(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date22<?php echo $atl->tid; ?>" value="<?php echo $get_pubD->p_publish;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_pubD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_goalD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
                }
              }
              else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }  
            }
            else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
            ?>
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTduedateModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="task-duedate<?php echo $atl->tid;?>"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($TodaySubtasks)
                                                    {
                                                        foreach($TodaySubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "in_review")
                                                            {
        $check_pro_createdby_grid = "";
        if(!empty($atl->stproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->stproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->stproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->stproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->stproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->stname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                } 
                            }
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stname<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTname(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="stname" id="subtask_name<?php echo $atl->stid; ?>" value="<?php echo $atl->stname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="stid" id="stid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTnameModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditSTnameModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" id="subtask-name<?php echo $atl->stid;?>">
                        <?php echo $atl->stname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->stproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stduedate<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTduedate(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
                                               $getTdue = $this->Front_model->getTasksDetail($atl->tid);
                                               $Tdue = "";
                                               if($getTdue)
                                               {
                                                $Tdue = $getTdue->tdue_date;
                                               }
                                                ?>
                                                <input type="hidden" name="get_tdue_date" id="get_tdue_date2<?php echo $atl->stid; ?>" value="<?php echo $Tdue;?>">
                                                <?php
                                                if($getTdue)
                                                {
                                                $gdetail = $this->Front_model->GoalDetail($getTdue->gid);
                                                if($gdetail)
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                                <?php
                                                } 
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                } 
                                                }
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                }
                                                ?>
                                                <input type="text" class="form-control" onmouseenter="return subtask_datepicker2(<?php echo $atl->stid;?>);" id="stdue_date2<?php echo $atl->stid; ?>" name="stdue_date" placeholder="Due Date" value="<?php echo $atl->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTduedateModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditSTduedateModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="subtask-duedate<?php echo $atl->stid;?>"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body">  -->       
                                            <h4 class="card-title mb-4">Done</h4>
                                            <div id="task-3">
                                                <div <?php if($privilege_only_view == 'no') { ?>id="done-task"<?php } ?> class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                        if($TodayTasks)
                                                        {
                                                            foreach($TodayTasks as $atl)
                                                            {
                                                                if($atl->tstatus == "done")
                                                                {
        $check_pro_createdby_grid = "";
        if(!empty($atl->tproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->tproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->tproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->tproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->tproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->tname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                }
                                } 
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tname<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTname(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tname" id="task_name<?php echo $atl->tid; ?>" value="<?php echo $atl->tname;?>" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTnameModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditTnameModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>" id="task-name<?php echo $atl->tid;?>">
                        <?php echo $atl->tname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->tproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-tduedate<?php echo $atl->tid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeTduedate(<?php echo $atl->tid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
            $get_pubD = $this->Front_model->getProjectById($atl->tproject_assign);
            if($get_pubD)
            {
              if($get_pubD->ptype == "content")
              {
                ?>
                <input type="hidden" name="get_pub_date" id="get_pub_date22<?php echo $atl->tid; ?>" value="<?php echo $get_pubD->p_publish;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_pubD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }
              elseif($get_pubD->ptype == "goal_strategy")
              {
                $gdetail = $this->Front_model->GoalDetail($get_pubD->gid);
                if($gdetail)
                {
                ?>
                <input type="hidden" name="get_gstart_date" id="get_gstart_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gstart_date;?>">
                <input type="hidden" name="get_gend_date" id="get_gend_date22<?php echo $atl->tid;?>" value="<?php echo $gdetail->gend_date;?>">
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker_goalD2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
                }
              }
              else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              }  
            }
            else
              {
                ?>
                <input type="text" class="form-control task_datepicker_field" onmouseenter="return task_datepicker2(<?php echo $atl->tid;?>);" id="task_duedate<?php echo $atl->tid; ?>" name="tdue_date" placeholder="Due Date" value="<?php echo $atl->tdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                <?php
              } 
            ?>
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->tid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->tid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditTduedateModal(<?php echo $atl->tid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->tid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<?php if($privilege_only_view == 'no') { ?><i class="fas fa-calendar-alt text-d ms-1 new_cursor_editable" onclick="showEditTduedateModal(<?php echo $atl->tid; ?>);"></i><?php } ?>
                  <p class="ng-binding" id="task-duedate<?php echo $atl->tid;?>"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($TodaySubtasks)
                                                    {
                                                        foreach($TodaySubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "done")
                                                            {
        $check_pro_createdby_grid = "";
        if(!empty($atl->stproject_assign))
        {
            $pro2 = $this->Front_model->getProjectById($atl->stproject_assign);
            if($pro2)
            {
                $check_pro_createdby_grid = $pro2->pcreated_by;
            }
        }
        $check_pro_member_status_grid = "";
        $check_ProjectMToClear2 = $this->Front_model->check_ProjectMToClear($atl->stproject_assign);
        if($check_ProjectMToClear2)
        {
            $check_pro_member_status_grid = $check_ProjectMToClear2->status;
        }
        if(($atl->stproject_assign != '0') && ($check_pro_member_status_grid != 'accepted') && ($check_pro_createdby_grid != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($atl->stproject_assign);
        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo" title="Accept Project">
                        AP
                    </span>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to2">
                  <p class="ng-binding"><?php echo $atl->stname;?></p>
                  <?php
                  if($check_suggested)
                    {
                  ?>
                  <p class="ng-binding">
                        Request Not Send 
                  </p>
                  <p class="ng-binding">
                       From Project Owner
                  </p>
                  <?php
                    }
                    else
                    {
                  ?>
                  <p class="ng-binding">
                        <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light">
                             Accept Request
                        </a>
                  </p>
                  <p class="ng-binding">
                       <a href="<?php echo base_url('projects-modal-request2/'.$atl->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             More Info
                      </a>
                  </p>
                  <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
        <?php
        }
        else
        {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back m--back--c">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($portfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($portfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                        else
                                        { 
                                            $fullname = $portfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }?></span>
                                </a>
                                <?php
                                } 
                            }
                            }
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stname<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTname(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="stname" id="subtask_name<?php echo $atl->stid; ?>" value="<?php echo $atl->stname;?>">
                                                <input type="hidden" name="stid" id="stid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTnameModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <?php if($privilege_only_view == 'no') { ?><i class="fas fa-pencil-alt text-d new_cursor_editable" onclick="showEditSTnameModal(<?php echo $atl->stid; ?>);"></i><?php } ?>
                    <a href="javascript: void(0);" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" id="subtask-name<?php echo $atl->stid;?>">
                        <?php echo $atl->stname;?>
                     </a>
                 </p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($atl->stproject_assign != 0) { echo 'Project: '.$getPname->pname;}?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <!-- Edit Project Name Modal -->
                <div id="show-edit-stduedate<?php echo $atl->stid; ?>" class="modal" style="display: none;">
                    <div class="modal-dialog modal-sm" style="padding: 0px 10px 0px 10px;">
                        <div class="modal-content" style="border: 1px solid #383838 !important;">
                            <div class="modal-body" style="padding: 0.3rem;">
                                <form method="POST" onsubmit="return changeSTduedate(<?php echo $atl->stid;?>);" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php
                                               $getTdue = $this->Front_model->getTasksDetail($atl->tid);
                                               $Tdue = "";
                                               if($getTdue)
                                               {
                                                $Tdue = $getTdue->tdue_date;
                                               }
                                                ?>
                                                <input type="hidden" name="get_tdue_date" id="get_tdue_date2<?php echo $atl->stid; ?>" value="<?php echo $Tdue;?>">
                                                <?php
                                                if($getTdue)
                                                {
                                                $gdetail = $this->Front_model->GoalDetail($getTdue->gid);
                                                if($gdetail)
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gstart_date;?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>" value="<?php echo $gdetail->gend_date;?>">
                                                <?php
                                                } 
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                } 
                                                }
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date2<?php echo $atl->stid; ?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date2<?php echo $atl->stid; ?>">
                                                <?php
                                                }
                                                ?>
                                                <input type="text" class="form-control" onmouseenter="return subtask_datepicker2(<?php echo $atl->stid;?>);" id="stdue_date2<?php echo $atl->stid; ?>" name="stdue_date" placeholder="Due Date" value="<?php echo $atl->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="" style="background: #f8f8fb !important;border-color: #c7df19 !important;">
                                                <input type="hidden" name="tid" id="tid" value="<?php echo $atl->stid;?>">
                                                <span class="text-danger req_tfield<?php echo $atl->stid;?>" style="display: none;">Field is required</span>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="edit-close-button" style="display: inline-flex;padding-top: 6px;">
                                                <button type="button" class="btn btn-sm bg-d text-white waves-effect waves-light me-2" style="font-size: 13px; margin-left:-18px;padding: 0.0rem 0.3rem !important;" onclick="closeEditSTduedateModal(<?php echo $atl->stid;?>);"><i class="fas fa-times"></i></button>
                                                <button type="submit" class="btn btn-d btn-sm waves-effect waves-light edit_yes_but_grid<?php echo $atl->stid;?>" style="font-size: 13px; margin-left:-5px;padding: 0.0rem 0.3rem !important;"><i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="new_card__face__deliv-date ng-binding">
                  Due<i class="fas fa-calendar-alt ms-1" onclick="showEditSTduedateModal(<?php echo $atl->stid; ?>);"></i>
                  <p class="ng-binding" id="subtask-duedate<?php echo $atl->stid;?>"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
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
    $('.search-cards').hide();
    $('#search-clear-list').css('display','block');
    var txt = $('#search-criteria-list').val();
    $('.search-list').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
           $(this).show();
       }
    });
    $('.search-cards').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
           $(this).show();
       }
    });
});
    $("#search-clear-list").click(function(){
            $("#search-criteria-list").val("");
            $('.search-list').show();
            $('.search-cards').show();
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
