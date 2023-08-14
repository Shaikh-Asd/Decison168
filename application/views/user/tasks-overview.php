<?php
$page = 'tasks-list';
if($tdetail)
{
    if(isset($_COOKIE["d168_selectedportfolio"]))
    {
        if($_COOKIE["d168_selectedportfolio"] != $tdetail->portfolio_id)
        {
            setcookie("d168_selectedportfolio",$tdetail->portfolio_id,time()+ (10 * 365 * 24 * 60 * 60),'/');
            header("Refresh:0");
        }
    }
    if($tdetail->tassignee == $this->session->userdata('d168_id'))
        {
            $data = array(
                            'tnotify' => 'seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->edit_TaskNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);

            if($tdetail->review_notify == 'sent_yes')
            {
            $data = array(
                            'review_notify' => 'sent_seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
           $res = $this->Front_model->edit_TaskReviewNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
            }
        }

    //Arrive for review
    $pro_car = $this->Front_model->getProjectById($tdetail->tproject_assign);
    if($pro_car)
    {
        if($tdetail->po_review_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
        {
            $data = array(
                            'po_review_notify' => 'sent_seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
        }
        elseif($tdetail->po_review_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
        {
            $data = array(
                            'po_review_notify' => 'sent_seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
        }
    }

        $t_files1 = explode(',', $tdetail->tfnotify); 
        $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                        if($index1 !== FALSE){
                            unset($t_files1[$index1]);
                        }
                        $final_mem1 = implode(',', $t_files1); 
                        $data = array(
                                        'tfnotify' => $final_mem1,
                                );
                                $data = $this->security->xss_clean($data); // xss filter
                                $this->Front_model->edit_NewTask($data,$tdetail->tid);
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Task Overview</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php
include('header_links.php');
?>
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
                        <h4 class="mb-sm-0 font-size-18">Overview</h4>
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
                            <?php
                            if($tdetail)
                            {
                                $check_pro_createdby = "";
                                    if(!empty($tdetail->tproject_assign))
                                    {
                                        $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                        if($pro)
                                        {
                                            $check_pro_createdby = $pro->pcreated_by;
                                        }
                                    }
                                    $check_pro_member_status = "";
                                    $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($tdetail->tproject_assign);
                                    if($check_ProjectMToClear)
                                    {
                                        $check_pro_member_status = $check_ProjectMToClear->status;
                                    }
                                    if(($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
                                    {
                                        $check_suggested = $this->Front_model->check_project_suggested_member($tdetail->tproject_assign);
                                        if($check_suggested)
                                        {
                                            echo "";
                                        }
                                        else
                                        {
                                    ?>
                                    <li class="nav-item">
                                        <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('projects-overview-request/'.$tdetail->tproject_assign);?>">
                                            <i class="mdi mdi-keyboard-backspace"></i> Go To Project
                                        </a>
                                    </li>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                if(!empty($tdetail->tproject_assign))
                                    {
                                        $check_page = $this->Front_model->ProjectDetail($tdetail->tproject_assign);
                                        if($check_page)
                                        {
                            ?>
                            <li class="nav-item">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('projects-overview/'.$tdetail->tproject_assign);?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Go To Project
                                </a>
                            </li>
                            <?php
                                        }
                                        else
                                        {
                            ?>
                            <li class="nav-item">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('projects-overview-accepted/'.$tdetail->tproject_assign);?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Go To Project
                                </a>
                            </li>
                            <?php
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks Overview</a></li> -->
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
    $check_permission = $this->Front_model->check_file_preview_access($tdetail->tproject_assign);
    $getProject = $this->Front_model->getProjectDetailID($tdetail->tproject_assign);
    if($getProject)
    {
        $pcreated_by = $getProject->pcreated_by;
        $pmanager = $getProject->pmanager;        
    }

    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        if(($tdetail->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($tdetail->tproject_assign);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   <div class="card-body">
                    <div class="row mb-2">
                    <?php
                  if($check_suggested)
                    {
                  ?>
                  <div class="col-lg-12">Project Request is not send from Project Owner. Task Name: <?php echo $tdetail->tname;?></div>
                  <?php
                    }
                    elseif((empty($check_suggested)) && ($check_pro_member_status != 'send'))
                    {
                    ?>
                    <div class="col-lg-12">Not Allowed to View Task</div>
                    <?php
                    }
                    else
                    {
                  ?>
                    <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $tdetail->tname;?></div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                             Accept Request
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
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
                    <div class="row">
                        <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div data-simplebar style="max-height: 600px;"> 
                                    <div class="card-body">
                                        <div class="media">
                                           <div class="avatar-sm me-4">
                                                <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                        <i class="bx bx-detail"></i>
                                                </span>
                                           </div>

                                            <div class="media-body overflow-hidden">
                                                <span>
                                                    <h5 class="font-size-15" style="padding: 8px;"><strong>TASK:</strong> <b><?php echo $tdetail->tname;?></b></h5>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        if($_COOKIE["d168_selectedportfolio"] == $tdetail->portfolio_id)
                                                        { 
                                                        // if(!empty($tdetail->tproject_assign))
                                                        //                 {
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
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            if($used_tasks < $total_tasks)
            {
              ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
            </form>
            <?php
            }
            else
            {
                ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
            }
          }
          else
          {
            ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
            </form>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
        if($getPackDetail)
        {
          $total_tasks = trim($getPackDetail->pack_tasks);
          $used_tasks = trim($getTaskCount['task_count_rows']);
          $check_type = is_numeric($total_tasks);
          if($check_type == 'true')
          {
            if($used_tasks < $total_tasks)
            {
              ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
            </form>
            <?php
            }
            else
            {
                ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
            }
          }
          else
          {
            ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
            </form>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
            if($getPackDetail)
            {
              $total_tasks = trim($getPackDetail->pack_tasks);
              $used_tasks = trim($getTaskCount['task_count_rows']);
              $check_type = is_numeric($total_tasks);
              if($check_type == 'true')
              {
                if($used_tasks < $total_tasks)
                {
                  ?> 
                <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                    <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                </form>
                <?php
                }
                else
                {
                    ?>
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                    <?php
                }
              }
              else
              {
                ?> 
                <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                    <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                </form>
                <?php
              }
            }
          }
        }
      }
    }    
  
}
                                                                        //}
if($privilege_only_view == 'no')
{
                                                    ?>                                                    
                                                    <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                                                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                                                        <input type="hidden" name="tid" value="<?php echo $tdetail->tid;?>">
                                                        <input type="hidden" name="port_id" value="<?php echo $tdetail->portfolio_id;?>">
                                                        <input type="hidden" name="task_dd" value="<?php echo $tdetail->tdue_date;?>">
                                                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Sub Task</button> 
                                                    </form>
                                                    <a href="<?php echo base_url("tasks-edit/".$tdetail->tid)?>" class="btn btn-sm btn-d text-white"><i class="mdi mdi-file-edit"></i> Edit Task</a>
                                                         <?php 
                                                    if($tdetail->estimated_time){ ?>
                                                    <input type="hidden" id="timer_flag_new_<?php echo $tdetail->tid;?>" value="<?php echo $tdetail->flag;?>">                   
                                                    <input type="hidden"  id="timer_started_<?php echo $tdetail->tid?>" value="<?php echo $tdetail->flag?>">
                                                    <span class="timerBtn_<?php echo $tdetail->tid;?>" style="margin-left: 25px;font-size: 20px; margin-top: 2px;"><i class="bx bx-play-circle timerBtn_<?php echo $tdetail->tid;?>" onclick="toggleTimer('<?php echo $tdetail->tid;?>');"></i></span>
                                                    <span class="counter_<?php echo $tdetail->tid;?>" data-id="<?php echo $tdetail->tid;?>" style="margin-left: 10px;font-size: 20px;">
                                                    <?php
                                                        if($tdetail->flag == '1'){
                                                            if($tdetail->start_timer_new != "" ){
                                                              // Old time
                                                              $old_time = $tdetail->start_timer_new;
                                                            }
                                                            else{
                                                            $old_time = $tdetail->start_timer;
                                                            }
                                                    
                                                            // Current time
                                                            $current_time = date("Y-m-d H:i:s");
                                                            // Create DateTime objects for old and current times
                                                            $old_datetime = new DateTime($old_time);
                                                            $current_datetime = new DateTime($current_time);
                                                            // Calculate the time difference
                                                            $interval_new = $current_datetime->diff($old_datetime);
                                                          // Access the time difference components
                                                            $diff_hours = $interval_new->h;
                                                            $diff_minutes = $interval_new->i;
                                                            $diff_seconds = $interval_new->s;
                                                            // $timer = $diff_hours.':'.$diff_minutes.':'.$diff_seconds;
                                                            $timer = sprintf("%02d:%02d:%02d", $diff_hours, $diff_minutes, $diff_seconds);
                                                            $time1 = $timer;
                                                            $time2 = $tdetail->tracked_time;
                                                    
                                                            $time1 = new DateTime($time1);
                                                            $time2 = new DateTime($time2);
                                                    
                                                            $interval = new DateInterval('PT' . $time1->format('H') . 'H' . $time1->format('i') . 'M' . $time1->format('s') . 'S');
                                                            $time2->add($interval);
                                                    
                                                            $timer = $time2->format('H:i:s');
                                                            }
                                                            
                                                            else{
                                                              if($tdetail->tracked_time != ""){
                                                              $timer = $tdetail->tracked_time;
                                                              }
                                                              else{
                                                              $timer = '00:00:00';
                                                              }
                                                            }
                                                          echo $timer;
                                                    ?>
                                                </span>
                                                    <input type="hidden" value="<?php echo $tdetail->flag?>" id="timer_flag_<?php echo $tdetail->tid;?>">
                                                           
                                                    <?php
}}
                                                    $check_pro_createdby = "";
                                                        if(!empty($tdetail->tproject_assign))
                                                        {
                                                            $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                            if($pro)
                                                            {
                                                                $check_pro_createdby = $pro->pcreated_by;
                                                            }
                                                        }
                                                        if(($tdetail->tassignee == $this->session->userdata('d168_id')) || ($tdetail->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
                                                        {
if($privilege_only_view == 'no')
{
                                                    ?>
                                                    <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $tdetail->tid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                    <!-- <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a> -->
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
<?php
}
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
        <?php
      }
      else
      {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            <?php
            }
            else
            {
                ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            <?php
            }
            else
            {
                ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
            }
          }
          else
          {
            ?> 
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                <?php
                }
                else
                {
                    ?>
                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <?php
                }
              }
              else
              {
                ?> 
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
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
                                                        else
                                                        {
                                                            echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                    }
                                                    ?>              
                                                </span>
                                                
                                            </div>
                                        </div>

                                        <h5 class="font-size-15 mt-4">Task Code :</h5>
                                        <p><?php echo $tdetail->tcode;?></p>

                                        <h5 class="font-size-15 mt-4">Task Notes :</h5>
                                        <p class="pdes"><?php echo $tdetail->tnote;?></p>

                                        <h5 class="font-size-15 mt-4">Task Description :</h5>

                                        <p class="pdes"><?php 
                                        if(!empty($tdetail->tdes))
                                            {
                                                echo $tdetail->tdes;
                                            }
                                        ?></p>

                                        <div class="row m-4">
                                                        <div class="col-md-6">
                                                            <div>
                                                                <?php
                                                                    if(!empty($tdetail->tproject_assign))
                                                                        {
                                                                            $est = 0; // Variable to store the sum of estimated times
                                                                                $trc = 0;
                                                                                $total_seconds = 0;
                                                                                $totalTime = "00:00:00";
                                                                                $Check_Task_Subtasks = $this->Front_model->Check_Task_Subtasks2($tdetail->tid);
                                                                                function timeStringToMinutes($timeString) {
                                                                                    list($hours, $minutes) = sscanf($timeString, '%dh%dm');
                                                                                    return $hours * 60 + $minutes;
                                                                                  }
                                                                                  
                                                                                  function minutesToTimeString($totalMinutes) {
                                                                                    $hours = floor($totalMinutes / 60);
                                                                                    $minutes = $totalMinutes % 60;
                                                                                    return sprintf('%dh %02dm', $hours, $minutes);
                                                                                  }
                                                                                // Assuming $Goal_tasks is an array of objects with 'estimated_time' property
                                                                                function calculateTotalTime($Goal_tasks) {
                                                                                    $totalMinutes = 0;
                                                                                    
                                                                                    foreach ($Goal_tasks as $time) {
                                                                                        $estimatedTime = $time->estimated_stime;
                                                                                        $totalMinutes += timeStringToMinutes($estimatedTime);
                                                                                    }
                                                                                
                                                                                    return minutesToTimeString($totalMinutes);
                                                                                }
                                                                                  
                                                                                  $totalStime = calculateTotalTime($Check_Task_Subtasks);

                                                                                foreach ($Check_Task_Subtasks as $subtask) {

                                                                                    $tracked_time = $subtask->tracked_stime;
                                                                                    $character = "'";
                                                                                                                                
                                                                                    if (strpos($tracked_time, $character) !== false) {
                                                                                        $tracked_time = str_replace($character, " ", $tracked_time);
                                                                                    } else {
                                                                                    }
                                                                                    if (empty($tracked_time)) {
                                                                                        $tracked_stime = '00:00:00';
                                                                                    }
                                                                                    else{
                                                                                        $tracked_stime = $tracked_time;
                                                                                    }
                                                                                    // Create DateTime objects for the current time and the total time
                                                                                    $datetime1 = DateTime::createFromFormat('H:i:s', $tracked_stime);
                                                                                    $datetime2 = DateTime::createFromFormat('H:i:s', $totalTime);
                                                                                    // Add the current time to the total time
                                                                                    $datetime2->add(new DateInterval('PT' . $datetime1->format('H') . 'H' . $datetime1->format('i') . 'M' . $datetime1->format('s') . 'S'));
                                                                                    // Update the total time
                                                                                    $totalTime = $datetime2->format('H:i:s');
                                                                                }
                                                                                $time1 = $totalTime;
                                                                                $time2 = $tdetail->tracked_time;

                                                                                // Convert time values to seconds
                                                                                $time1_parts = explode(':', $time1);
                                                                                $time2_parts = explode(':', $time2);

                                                                                $time1_seconds = $time1_parts[0] * 3600 + $time1_parts[1] * 60 + $time1_parts[2];
                                                                                $time2_seconds = $time2_parts[0] * 3600 + $time2_parts[1] * 60 + $time2_parts[2];

                                                                                // Add the seconds
                                                                                $total_seconds = $time1_seconds + $time2_seconds;
                                                                                // Convert total seconds back to time format
                                                                                $totalTimes = gmdate('H:i:s', $total_seconds);
                                                                                $TimEstimated = $totalStime ;

                                                                                function timeToMinutes($time) {
                                                                                    $time_parts = explode('h', $time);
                                                                                    $hours = intval($time_parts[0]);
                                                                                    $minutes = 0;
                                                                                    
                                                                                    if (count($time_parts) > 1) {
                                                                                        $minutes_parts = explode('m', $time_parts[1]);
                                                                                        $minutes = intval($minutes_parts[0]);
                                                                                    }
                                                                                    
                                                                                    return $hours * 60 + $minutes;
                                                                                }
                                                                                
                                                                                // Given time values
                                                                                $time1 = $totalStime;
                                                                                $time2 = $tdetail->estimated_time;
                                                                                
                                                                                // Convert times to minutes
                                                                                $time1_minutes = timeToMinutes($time1);
                                                                                $time2_minutes = timeToMinutes($time2);
                                                                                
                                                                                // Add the minutes
                                                                                $total_minutes = $time1_minutes + $time2_minutes;
                                                                                
                                                                                // Convert back to hours and minutes
                                                                                $total_hours = floor($total_minutes / 60);
                                                                                $remaining_minutes = $total_minutes % 60;
                                                                                
                                                                                // Format the result
                                                                                $result = $total_hours . "h".' '. $remaining_minutes . "m";
                                                                            ?>
                                                                        <p class="text-muted"><i class="bx bx-time-five font-size-16 align-middle me-1 text-d"></i> Time Estimated : <?php echo $result; ?></p>
                                                                        <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                <?php
                                                                            $check_page = $this->Front_model->ProjectDetail($tdetail->tproject_assign);
                                                                            if($check_page)
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                                    <a class="nameLink" href="<?php echo base_url('projects-overview/'.$tdetail->tproject_assign);?>">
                                                                        <?php echo $pro->pname;?>
                                                                    </a>
                                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                                <a class="nameLink" href="<?php echo base_url('projects-overview-accepted/'.$tdetail->tproject_assign);?>">
                                                                        <?php echo $pro->pname;?>
                                                                </a>
                                                                <?php
                                                                            }
                                                                ?>
                                                                </p>
                                                                <?php
                                                                        }
                                                                ?>
                                                                <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                    $stud = $this->Front_model->getStudentById($tdetail->tassignee);
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    ?>
                                                                </p>                                                         
                                                                <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($tdetail->tcreated_date));?></p>
                                                                <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $tdetail->first_name.' '.$tdetail->last_name;?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <?php
                                                                    if(!empty($tdetail->tproject_assign))
                                                                        {
                                                                            $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                               <p class="text-muted"><i class="bx bx-timer font-size-16 align-middle me-1 text-d"></i> Time Tracked : <?php  echo $totalTimes; ?></p>
                                                                <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                if($pro){
                                                                        if($pro->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                                            if($portfolio){
                                                                             if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                         }
                                                                        }
                                                                        } 
                                                                    ?></p>
                                                                <?php
                                                                }
                                                                ?>
                                                                <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($tdetail->tdue_date));?></p>
                                                                <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $tdetail->tpriority;?></p>
                                                                <?php
                                                                $tid = $tdetail->tid;
                                                                $assignee_status = $this->Front_model->check_assignee_status($tid);
if($privilege_only_view == 'no')
{
                                                                if($assignee_status)
                                                                {
                                                                    if($assignee_status->tstatus == 'to_do')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    To Do <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'in_progress')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Progress <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'in_review')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Review <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'done')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    Done <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }
                                                                }
                                                                elseif($check_pro_createdby == $this->session->userdata('d168_id'))
                                                                {
                                                                   if($tdetail->tstatus == 'to_do')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    To Do <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($tdetail->tstatus == 'in_progress')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Progress <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($tdetail->tstatus == 'in_review')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Review <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($tdetail->tstatus == 'done')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    Done <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    } 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                    <?php
                                                                            if($tdetail->tstatus == 'to_do')
                                                                            {
                                                                                echo "To Do";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'in_progress')
                                                                            {
                                                                                echo "In Progress";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'in_review')
                                                                            {
                                                                                echo "In Review";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'done')
                                                                            {
                                                                                echo "Done";
                                                                            } 
                                                                    ?>
                                                                </p>
                                                                <?php
                                                                }
}
else
{
?>
<p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
    <?php
            if($tdetail->tstatus == 'to_do')
            {
                echo "To Do";
            }
            elseif($tdetail->tstatus == 'in_progress')
            {
                echo "In Progress";
            }
            elseif($tdetail->tstatus == 'in_review')
            {
                echo "In Review";
            }
            elseif($tdetail->tstatus == 'done')
            {
                echo "Done";
            } 
    ?>
</p>
<?php
}
                                                                ?>                                                             
                                                            </div>
                                                        </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- end col --> 
    
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Tasks Links and Comments</h4>
                                        <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    if(!empty($tdetail->tlink))
                                                        {
                                                            $tlink = explode(',', $tdetail->tlink);
                                                            $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                            $tlcount = count($tlink);
                                                            if($tlcount > 0){
                                                                for ($i=0; $i<$tlcount; $i++){
                                                                    ?>
                                                                    <tr>
                                                                        <td style="width: 45px;">
                                                                            <div class="avatar-sm">
                                                                                <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                                    <i class="bx bx-link-alt"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1">
                                                                                <a href="<?php echo $tlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                <?php
                                                                                    echo $tlink[$i];
                                                                                ?>
                                                                                </a>
                                                                            </h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1">
                                                                                <?php
                                                                                    if(!empty($tlink_comment[$i])){
                                                                                    echo $tlink_comment[$i];
                                                                                }
                                                                                ?>
                                                                            </h5>
                                                                        </td>
                                                                    </tr> 
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Task Links!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Tasks Files</h4>
                                      <?php
                                                if(!empty($tdetail->tfile))
                                                {
                                                        $tfile = explode(',', $tdetail->tfile);
                                                        $count = count($tfile);
                                                        if($count > 0)
                                                        {
                                                ?>
                                                <div data-simplebar style="max-height: 200px;"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle table-hover mb-0">
                                                            <tbody>
                                                <?php
                                                            for ($i=0; $i<$count; $i++)
                                                            {
                                                                $tfile_name = $tfile[$i];
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="avatar-sm">
                                                                            <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                                <i class="bx bx-file"></i>
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1">
<?php
if($privilege_only_view == 'no')
{
?>                                                                             
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview">
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                             
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview">
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview">  
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview">
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview">
    <?php 
    }    
}
                                                                                    $filename = substr($tfile_name, strpos($tfile_name, '_') + 1);
                                                                                        if(strlen($filename) > 35)
                                                                                            {
                                                                                                print_r(substr($filename,0,32).'...');
                                                                                            }
                                                                                        else
                                                                                            {
                                                                                                echo $filename;
                                                                                            }
                                                                                ?>
                                                                            </a>
                                                                        </h5>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
<?php
if($privilege_only_view == 'no')
{
?>                                                                             
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                             
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
           <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a> 
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php 
    }    
}

if($privilege_only_view == 'no')
{
?>
                                                                            <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                                                            <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
<?php 
}
?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                                        }
                                                }
                                                ?>
                                    </div>
                                </div>
                            </div> 
                            <!-- end col -->  
                            <div class="col-lg-12">
                                        <!-- sub task area start -->
     <div class="card border shadow-none card-body text-muted mb-0">
            <h4 class="card-title mb-4">Subtasks</h4>
        <ul class="tree">
            <?php 
            $Check_Task_Subtasks = $this->Front_model->Check_Task_Subtasks2($tdetail->tid);
            if($Check_Task_Subtasks)
            {
                foreach($Check_Task_Subtasks as $l_subtask)
                {
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
                                $check_pro_manager = $pro->pmanager;
                                $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pro->portfolio_id);
                                if($check_Portfolio_owner_id)
                                {
                                    $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                }
                            }
                        }
            ?>
            <!-- single sub task area start -->
            <li>
                <div class="card" <?php if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))){ echo 'style="margin-bottom: 0px;background: #f6f6f6;"';} else { echo 'style="margin-bottom: 0px;background: #dbdbdb;"';}?>>
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
<?php
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
                        <div class="row">
                            <div class="col-lg">
                                <?php
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
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
                                 <?php 
            if($l_subtask->estimated_stime){ ?>
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
<?php } else { ?>
                        <span>NA</span>
                    <?php } ?>
                                                </div>
                                                <div class="col-lg">
<?php
if($privilege_only_view == 'no')
{
?>
                                <fieldset class="description">
                                  <div class="description-details">
                                    <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                                    <i class="fas fa-pencil-alt" onclick="return editable_field();"></i>
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
<?php
}
else
{
 ?>
 <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
 <?php
}
?> 
                            </div>
                            <div class="col-lg">
                                <fieldset class="description">
                                  <div class="description-details">
<?php
if($privilege_only_view == 'no')
{
?>
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
<?php
}
else
{
?>
<p><?php 
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
<?php
}
?> 
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
                                if(($l_subtask->stassignee == $this->session->userdata('d168_id')) || ($l_subtask->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')) || ($check_pro_manager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <fieldset class="description">
<?php
if($privilege_only_view == 'no')
{
?>
                                  <div class="description-details">
                                    <p><?php 
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
                                                  ?>
                                                    <span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Review</span>
                                                    <?php 
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
<p><?php 
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
              ?>
                <span class="badge rounded-pill badge-soft-dark description-content">In Review</span>
                <?php 
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
                                <input type="hidden" name="get_tdue_date" class="if_task_date_change<?php echo $tdetail->tid;?>" id="get_tdue_date<?php echo $l_subtask->stid; ?>" value="<?php echo $tdetail->tdue_date;?>">
                                <?php
                                $gdetail = $this->Front_model->GoalDetail($tdetail->gid);
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
                                    <input type="text" class="form-control task_date_changed<?php echo $tdetail->tid;?>" onchange="return edit_yes_calendar(this);" data-class="subtask_editable" data-name="stduedate_field" data-id="<?php echo $l_subtask->stid;?>" id="stdue_date<?php echo $l_subtask->stid;?>" name="tdue_date" placeholder="Due Date" value="<?php echo $l_subtask->stdue_date;?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true" required="">
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
<!-- sub task area end -->
                            </div>                     
                        </div>
                        <!-- end row -->

                    </div> <!-- col -->
                  <div class="col-lg-4">
                    <div class="card">
                                    <div class="card-body">
<?php
if($tdetail->tproject_assign != '0')
{
   //$comments = $this->Front_model->getProjectComments($tdetail->tproject_assign); 
   $comments = $this->Front_model->getTaskComments($tdetail->tid);
   $check_Powner = $this->Front_model->getProjectById($tdetail->tproject_assign);
   $checkpro_Owner = "";
   $pownerName = "";
   if($check_Powner)
   {
        $Powner_detail = $this->Front_model->getStudentById($check_Powner->pcreated_by);  
        if($Powner_detail)  
        {
            $pownerName = $Powner_detail->first_name.' '.$Powner_detail->last_name;
        }
        if($check_Powner->pcreated_by == $this->session->userdata('d168_id'))
        {
            $checkpro_Owner = "owner";
        }
        else
        {
            $checkpro_Owner = "team";
        }
   }
   if($checkpro_Owner == "owner")
   {
        $mentionList = $this->Front_model->MentionList($tdetail->tproject_assign); 
   }
   elseif($checkpro_Owner == "team")
   {
        $MentionListforAccepted = $this->Front_model->MentionListforAccepted($tdetail->tproject_assign);
        //print_r($MentionListforAccepted);
        $ownerMention[]['name'] = $pownerName;
        //print_r($ownerMention);
        $mentionList = array_merge($MentionListforAccepted,$ownerMention);
   }
}
else
{
    $comments = $this->Front_model->getTaskComments($tdetail->tid);
    $mentionList = array();
}
?>
<!-- Start Comment section -->
<h4 class="card-title">Comment Section</h4>
<div class="w-100 user-chat">
    <div class="card">        
        <div id="scrollbottom" class="chat-conversation p-2">
            <ul class="list-unstyled mb-0 append_new_msg" data-simplebar style="max-height: 400px;">
                <?php   
                if($comments){
                    $comment_date = "";
                    foreach ($comments as $cm) {
                        $msg_date = date("Y-m-d", strtotime($cm->c_created_date));
                        if($msg_date == $comment_date)
                        {
                            echo '';
                        }
                        elseif($msg_date == date("Y-m-d"))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li>
                        <?php
                        }
                        elseif($msg_date == date("Y-m-d",strtotime("-1 days")))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Yesterday</span>
                            </div>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title"><?php echo date("j M, Y", strtotime($cm->c_created_date));?></span>
                            </div>
                        </li>
                        <?php
                        }
                        $studdel = $this->Front_model->getStudentById($cm->c_created_by);
                        if($cm->c_created_by == $this->session->userdata('d168_id')){
                            $today_date = date("Y-m-d H:i:s");
                            $delete_allow = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($cm->c_created_date)));
                            ?>
                        <li class="right" id="msg_id<?php echo $cm->cid?>">
                            <div class="conversation-list">
                                <?php
                                if(($today_date < $delete_allow) && (empty($cm->delete_msg)))
                                {
                                ?>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <!-- <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment('<?php echo $cm->cid?>');">Delete</a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Me</div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        }else{
                            ?>
                        <li>
                            <div class="conversation-list">
                                <!-- <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div> -->
                                <div class="ctext-wrap">
                                    <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?></div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> this message was deleted</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        } 
                        $comment_date = $msg_date;                       
                    }
                }else{
                    ?>
                    <p class="text-muted p-2 no_comment">No comments...</p>
                    <?php
                }
                ?>                      
            </ul>
        </div>
        <div class="p-3 chat-input-section">
            <form method="POST" name="comment_form" id="comment_form" class="comment_form" autocomplete="off">
                <div class="row">
                    <div class="col" style="padding-right: 0px !important;">
                        <div class="position-relative">
                            <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                            <span id="messageErr" class="text-danger"></span>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign; ?>">
                            <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid; ?>">
                            <input type="hidden" name="stid" id="stid" value="0">
                            <input type="hidden" name="area_type" value="from_modal">
                        </div>
                    </div>
                </div>
                <button type="submit" id="comment_form_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                <img id="loader6" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            </form>
        </div>
    </div>
</div>
<!-- End Comment section -->
                                    </div>
                                </div>
                  </div>

                </div>                
          </div>
      </div>
                <?php
                    }
                }
                else
                {
                ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                }
            }
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
                                    <!-- Subtask Attach File Modal -->
                                    <div id="subtask_attachmentModal" class="modal fade" tabindex="-1" aria-labelledby="#subtask_attachmentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="subtask_attachmentModal_content">
                                                
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
                                    <!-- Subtasks Overview Modal -->
                                    <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskOverviewModal_content">
                                                
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
<script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
        <?php
include('footer_links.php');
?>
<script src="<?php echo base_url();?>assets/js/mention.js"></script>
<script type="text/javascript">
    var id =  $('#tid').val();
var flag =  $('#timer_flag_'+id).val();
    if(flag == '1'){
    toggleTimer1(id);
    } 

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
<script>
$(window).on( "load", function() {
    $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
});
var jArray= <?php echo json_encode($mentionList);?>;
//console.log(jArray);
 var myMention = new Mention({
    input: document.querySelector('#message'),
    options: jArray
 })
</script>
    </body>

</html>
