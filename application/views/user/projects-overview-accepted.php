<?php
if($pdetail)
{
    if(isset($_COOKIE["d168_selectedportfolio"]))
    {
        if($_COOKIE["d168_selectedportfolio"] != $pdetail->portfolio_id)
        {
            setcookie("d168_selectedportfolio",$pdetail->portfolio_id,time()+ (10 * 365 * 24 * 60 * 60),'/');
            header("Refresh:0");
        }
    }
    if($pdetail->ptype == "content")
    {
    $page = 'content-planner';
    }
    elseif($pdetail->ptype == "goal_strategy")
    {
    $page = 'goals-list';
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
if($pdetail)
{
    $pfile_detail1 = $this->Front_model->ProjectFile($pdetail->pid);
    foreach($pfile_detail1 as $pf1)
    {
        $p_files1 = explode(',', $pf1->pfnotify); 
          $index1 = array_search($this->session->userdata('d168_id'),$p_files1);
                      if($index1 !== FALSE){
                          unset($p_files1[$index1]);
                      }
                      $final_mem1 = implode(',', $p_files1); 
                      $data2 = array(
                                      'pfnotify' => $final_mem1,
                                      'pfnotify_clear' => $final_mem1,
                                                        );
                                  $data2 = $this->security->xss_clean($data2); // xss filter
                                  $this->Front_model->edit_project_files_by_pfileId($data2,$pf1->pfile_id);
    } 
    $pcn_allAssigneesByPID = $this->Front_model->pcn_allAssigneesByPID($pdetail->pid);
    if($pcn_allAssigneesByPID)
            {
              foreach($pcn_allAssigneesByPID as $pcn)
                {
                    $pcn_assignee = explode(',', $pcn->pc_notify);
                    $pcn_assignee_cnt = count($pcn_assignee);
                    if($pcn_assignee_cnt > 0)
                    {
                      for ($rpcn_i=0; $rpcn_i<$pcn_assignee_cnt; $rpcn_i++)
                      {
                        $index = array_search($this->session->userdata('d168_id'),$pcn_assignee);
                          if($index !== FALSE){
                              unset($pcn_assignee[$index]);
                          }
                      }
                    }
                      $final_mem = implode(',', $pcn_assignee); 
                      $data = array(
                                      'pc_notify' => $final_mem,
                                                        );
                      $data = $this->security->xss_clean($data); // xss filter
                      $this->Front_model->update_Content($data,$pcn->pc_id);
                }
            }   

    $getProjectComments = $this->Front_model->getProjectComments($pdetail->pid);
    if($getProjectComments)
    {
      foreach($getProjectComments as $pComment)
      {
            $p_comments = explode(',', $pComment->c_notify); 
            $index = array_search($this->session->userdata('d168_id'),$p_comments);
                      if($index !== FALSE){
                          unset($p_comments[$index]);
                      }
                      $final_mem = implode(',', $p_comments); 
                      $data = array(
                                      'c_notify' => $final_mem,
                                      'c_notify_clear' => $final_mem,
                                                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->update_CommentbyCid($data,$pComment->cid);
      }            
    }       

    $ptm = $this->Front_model->ProjectTeamMember($pdetail->pid);
    if($ptm)
    {
        foreach($ptm as $pm)
        {
            $get_project_accepted_notification = $this->Front_model->get_project_accepted_notification($pm->pm_id);
            if($get_project_accepted_notification)
            {
                foreach($get_project_accepted_notification as $gpars)
                {
                    $pm_id = $gpars->pm_id;
                    $data2 = array(
                                    'status_notify' => 'seen',
                                );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Front_model->edit_project_members_notify($data2,$pm_id);
                }
            }
        }
    }

    $invited_member = $this->Front_model->InvitedProjectMember($pdetail->pid); 
    if($invited_member)
    {
        foreach($invited_member as $im)
        {
            if($im->status == "accepted" && $im->status_notify == "yes")
            {
              $id15 = $im->im_id;
              $data15 = array(
                                    'status_notify' => 'seen',
                                );
              $data15 = $this->security->xss_clean($data15); // xss filter
              $this->Front_model->edit_project_invite_members_notify($data15,$id15);
            }
        }
    }

    //Project Membership Request Notification
      $check_project_membership_notify = $this->Front_model->check_project_membership_notify($pdetail->pid);
        if($check_project_membership_notify)
        {
            $rer_id17 = $check_project_membership_notify->req_id;
            $data17 = array(
                            'mreq_notify' => 'seen',
                            'mreq_notify_clear' => 'yes',
                              );
            $data17 = $this->security->xss_clean($data17); // xss filter
            $this->Front_model->edit_project_membership_req_notify($data17,$rer_id17);
        }
    //file preview permission response
    $check_file_preview_access = $this->Front_model->check_file_preview_access($pdetail->pid);
        if($check_file_preview_access)
        {
              $id = $check_file_preview_access->fpid;
              $data2 = array(
                              'res_notify_clear' => 'yes',
                              'res_notify' => 'seen',
                                );
              $data2 = $this->security->xss_clean($data2); // xss filter
              $this->Front_model->update_file_preview_access_req($data2,$id);
        }
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Overview</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
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
                            if(!empty($pdetail->gid))
                            {
                            ?>
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('goal-overview/'.$pdetail->gid)?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Go To Goal 
                                </a>
                            </li>
                            <?php
                            }
                            if(!empty($pdetail->sid))
                            {
                            ?>
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('kpi-overview/'.$pdetail->sid)?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Go To KPI 
                                </a>
                            </li>
                            <?php
                            }
                            if(!isset($_COOKIE["d168_selectedportfolio"]))
                            {
                            ?>
                            <li class="nav-item">
                                <?php
                                if($pdetail)
                                {
                                if($pdetail->ptype == "content")
                                {
                                ?>
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('contents-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Content List
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('projects-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Project List
                                </a>
                                <?php
                                }
                                }
                                ?>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Projects Overview</a></li> -->
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
 if($pdetail)
 {
    $pid = $pdetail->pid;

    $check_permission = $this->Front_model->check_file_preview_access($pid);
    
    $pcreated_by = $pdetail->pcreated_by;
    $pmanager = $pdetail->pmanager;

    $powner = $this->Front_model->getStudentById($pcreated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($pdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
?> 
                        <div class="row">
                            <div class="col-lg-8">
                            <div class="col-lg-12">
                                <div class="card">                                    
                                  <div data-simplebar style="max-height: 400px;"> 
                                    <div class="card-body">
                                        
                                        <div class="media">
                                           <div class="avatar-sm me-2">
                                                <?php
                                                if($pdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($pdetail->portfolio_id);
                                                    if($portfolio){
                                            if($portfolio->photo)
                                                    {
                                                    ?>                                 
                                                            <div class="avatar-group-item">
                                                                <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
                                                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                <!-- </a> -->
                                                            </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div>
                                                        <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
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
                                                        <!-- </a> -->
                                                    </div>
                                                    <?php
                                                    } 
                                                }
                                                }
                                                else 
                                                {
                                                     ?>
                                                     <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                            <i class="bx bx-detail"></i>
                                                    </span>
                                                     <?php
                                                } 
                                            ?>
                                           </div>

                                            <div class="media-body overflow-hidden">
                                                <span>
                                                                 
                                                    <h5 class="font-size-15" style="padding: 8px;"><strong><?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                        echo "CONTENT:";
                                                    }
                                                    else
                                                    {
                                                        echo "PROJECT:";
                                                    }
                                                ?></strong> <b><?php echo $pdetail->pname;?></b></h5>
                                                    <?php
                                                    $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pdetail->portfolio_id);
                                                    $portfolio_owner_id = "";
                                                    if($check_Portfolio_owner_id)
                                                    {
                                                        $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                                    }
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                                                        {
if($privilege_only_view == 'no')
{
if(empty($this->session->userdata('d168_user_cor_id')))
{
                                                        if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))                                
                                                        {
                                                        ?>
                                                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> 
                                                        <?php
                                                        if($pdetail->ptype == "content")
                                                        {
                                                            echo "Edit Content";
                                                        }
                                                        else
                                                        {
                                                            echo "Edit Project";
                                                        }
                                                        ?>
                                                        </a>
                                                        <?php
                                                        }                     
                                                        else
                                                        {  
                                                        $check_edit = $this->Front_model->check_edit_permission($pdetail->pid);
                                                        if($check_edit->edit_allow == 'no')
                                                        {
                                                    ?>
                                                    <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return project_accepted_edit_request('<?php echo $pdetail->pid?>');"><i class="mdi mdi-file-edit"></i> <?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                        echo "Edit Content";
                                                    }
                                                    else
                                                    {
                                                        echo "Edit Project";
                                                    }
                                                    ?></a>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-accepted-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> <?php
                                                            if($pdetail->ptype == "content")
                                                            {
                                                                echo "Edit Content";
                                                            }
                                                            else
                                                            {
                                                                echo "Edit Project";
                                                            }
                                                            ?></a>
                                                            <?php
                                                        }
                                                    }
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if($pdetail->ptype == "content")
            {
               if(in_array('content planner', $cus_privilege))
                {
                  $privilege = "yes";
                } 
            }
            else
            {
              if(in_array('projects', $cus_privilege))
                {
                  $privilege = "yes";
                }  
            } 
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))                                
        {
        ?>
        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> 
        <?php
        if($pdetail->ptype == "content")
        {
            echo "Edit Content";
        }
        else
        {
            echo "Edit Project";
        }
        ?>
        </a>
        <?php
        }                     
        else
        {  
        $check_edit = $this->Front_model->check_edit_permission($pdetail->pid);
        if($check_edit->edit_allow == 'no')
        {
        ?>
        <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return project_accepted_edit_request('<?php echo $pdetail->pid?>');"><i class="mdi mdi-file-edit"></i> <?php
        if($pdetail->ptype == "content")
        {
            echo "Edit Content";
        }
        else
        {
            echo "Edit Project";
        }
        ?></a>
        <?php
            }
            else
            {
                ?>
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-accepted-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> <?php
                if($pdetail->ptype == "content")
                {
                    echo "Edit Content";
                }
                else
                {
                    echo "Edit Project";
                }
                ?></a>
                <?php
            }
        }
      }
      elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
      {
        ?>
        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> 
        <?php
        if($pdetail->ptype == "content")
        {
            echo "Edit Content";
        }
        else
        {
            echo "Edit Project";
        }
        ?>
        </a>
        <?php
      }
    }    
  }
  elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
      {
        ?>
        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> 
        <?php
        if($pdetail->ptype == "content")
        {
            echo "Edit Content";
        }
        else
        {
            echo "Edit Project";
        }
        ?>
        </a>
        <?php
      }
}
}
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
              ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
              ?> 
            <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                  ?> 
                <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="pid" value="<?php echo $pid;?>">
                    <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                    <input type="hidden" name="pid" value="<?php echo $pid;?>">
                    <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                                                    if($pdetail->ptype == "content")
                                                    {
if($privilege_only_view == 'no')
{
                                                        if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                    <button type="button" onclick="return get_project_id5(<?php echo $this->uri->segment(2); ?>);" data-bs-toggle="modal" data-bs-target=".add-new-content" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add New Content</button> 
                                                    <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                    <button type="button" onclick="return get_project_id5(<?php echo $this->uri->segment(2); ?>);" data-bs-toggle="modal" data-bs-target=".add-new-content" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add New Content</button> 
                                                    <?php
          }
        }    
      }  
    }
}
                                                    $check_content_to_pro = $this->Front_model->check_content_to_pro($pdetail->regularproj_to_contentproj);
                                                        if(!empty($check_content_to_pro))
                                                        {
                                                            if($check_content_to_pro->pcreated_by == $this->session->userdata('d168_id'))
                                                            {
                                                                ?>
                                                                <a class="btn btn-sm btn-d text-white" target="_blank" href="<?php echo base_url('projects-overview/'.$pdetail->regularproj_to_contentproj)?>"><i class="mdi mdi-bag-checked"></i> View Project</a>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                $check_if_pmember = $this->Front_model->CheckProjectTeamMember($pdetail->regularproj_to_contentproj);
                                                                if($check_if_pmember)
                                                                {
                                                                    foreach($check_if_pmember as $member)
                                                                    {
                                                                    if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                        {
                                                                    ?>
                                                                    <a class="btn btn-sm btn-d text-white" target="_blank" href="<?php echo base_url('projects-overview-accepted/'.$pdetail->regularproj_to_contentproj)?>"><i class="mdi mdi-bag-checked"></i> View Project</a> 
                                                                    <?php   
                                                                        }
                                                                    elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                        {
                                                                    ?>
                                                                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-overview-request/'.$pdetail->regularproj_to_contentproj)?>"><i class="mdi mdi-bag-checked"></i> View Project</a>
                                                                    <?php   
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return RequestAsMember(<?php echo $pdetail->regularproj_to_contentproj;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pdetail->regularproj_to_contentproj;?>"><i class="mdi mdi-view-grid-outline"></i> View Project</a>
                                                                <?php
                                                                }
                                                            }  
                                                        }
                                                    }
                                                    elseif($pdetail->ptype == "regular")
                                                    {
                                                        $check_pro_to_content = $this->Front_model->check_pro_to_content($pid);
                                                        if(!empty($check_pro_to_content))
                                                        {
                                                         if($check_pro_to_content->pcreated_by == $this->session->userdata('d168_id'))
                                                            {
                                                                ?>
                                                                <a class="btn btn-sm btn-d text-white" target="_blank" href="<?php echo base_url('projects-overview/'.$check_pro_to_content->pid)?>"><i class="mdi mdi-view-grid-outline"></i> View Content</a>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                $check_content_request_user = $this->Front_model->check_content_request_user($check_pro_to_content->pid);
                                                                if($check_content_request_user)
                                                                {
                                                                    if($check_content_request_user->status == 'accepted')
                                                                    {
                                                                    ?>
                                                                <a class="btn btn-sm btn-d text-white" target="_blank" href="<?php echo base_url('projects-overview-accepted/'.$check_pro_to_content->pid)?>"><i class="mdi mdi-view-grid-outline"></i> View Content</a>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                     ?>
                                                                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-overview-request/'.$check_pro_to_content->pid)?>"><i class="mdi mdi-view-grid-outline"></i> View Content</a>
                                                                    <?php   
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return content_request_send_by_tm('<?php echo $check_pro_to_content->pid;?>');"><i class="mdi mdi-view-grid-outline"></i> View Content</a>
                                                                <?php
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
                                                    if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))                                
                                                        {
if($privilege_only_view == 'no')
{
                                                        if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                    <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                        <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                        <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                        <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>  
                                                    </form>
                                                    <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                    <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                        <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                        <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                        <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>  
                                                    </form>
                                                    <?php
          }
          elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
          {
            ?>
                                                    <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                        <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                        <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                        <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>  
                                                    </form>
                                                    <?php
          }
        }    
      }
      elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
          {
            ?>
                                                    <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                        <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                        <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                        <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>  
                                                    </form>
                                                    <?php
          }  
    }
}
                                                        }
                                                    ?>
                                                </span>
                                                
                                            </div>
                                        </div>

                                        <?php
                                             if($p_tasks || $p_subtasks)
                                                        {
                                        ?>
                                        <h5 class="font-size-15 mt-4">Status :-
                                           <?php 
                                            $progress_done = $this->Front_model->progress_done($pid);
                                            $progress_total = $this->Front_model->progress_total($pid);
                                            $sub_progress_done = $this->Front_model->sub_progress_done($pid);
                                            $sub_progress_total = $this->Front_model->sub_progress_total($pid);
                                            if($progress_total || $sub_progress_total)
                                            {
                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                            ?>
                                            <span>
                                                Done: <?php echo $total_pro_progress_done; ?>  
                                                Total: <?php echo $total_pro_progress; ?> </span>
                                            <div class="progress mt-2">
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
                                        </h5>
                                        <?php
                                        }
                                        ?>

                                        <h5 class="font-size-15 mt-4">Description :</h5>

                                        <p class="text-muted pdes"><?php 
                                        if(!empty($pdetail->pdes))
                                            {
                                                echo $pdetail->pdes;
                                            }
                                        ?></p>
                                        
                                        <div class="row task-dates">
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar  font-size-16 me-1 text-d"></i> Created Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->pcreated_date));?></p>
                                                </div>
                                            </div>
                                            
                                            <?php
                                            if($pdetail->ptype == "content")
                                            {
                                            ?>
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar-check font-size-16 me-1 text-d"></i> Publish Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->p_publish));?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                    <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-folder-open font-size-16 align-middle me-1 text-d"></i>Type</h5>
                                                    <?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Content</p>
                                                    <?php
                                                    }
                                                    elseif($pdetail->ptype == "goal_strategy")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Goals & Strategies</p>
                                                    <?php  
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Project</p>
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

                        <?php
                        if($pdetail->ptype == "content")
                        {
                        if($p_planned_content_project)
                        {
                        ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body project-content-wrapper">
                                    <h4 class="card-title mb-4">Planned Content</h4>
                        <?php
                        $cp_cnt=1;
                            foreach($p_planned_content_project as $get_cpd)
                            {
                                    ?>
                                    <div data-repeater-list="outer-group" class="outer">
                                    <div data-repeater-item class="outer accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item" id="plan-content-90<?php echo $cp_cnt; ?>">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#plannedcontent<?php echo $get_cpd->pc_id;?>-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background: #f3f3f3;;color: #383838;font-weight: 600;">
                                                    <?php 
                                                    if($get_cpd->platform == 'twitter')
                                                    {
                                                        $maxlength = 280;
                                                        echo 'Twitter';             
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="twitter" id="platform" name="platform1" style="display:none;" checked><?php
                                                    }
                                                    elseif($get_cpd->platform == 'facebook')
                                                    {
                                                        $maxlength = 63206;
                                                        echo 'Facebook';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="facebook" id="platform" name="platform1" style="display:none;" checked><?php

                                                    }
                                                    elseif($get_cpd->platform == 'instagram')
                                                    {
                                                        $maxlength = 2200;
                                                        echo 'Instagram';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="instagram" id="platform" name="platform1" style="display:none;" checked><?php
                                                        

                                                    }
                                                    elseif($get_cpd->platform == 'linkedin')
                                                    {
                                                        $maxlength = 2985;
                                                        echo 'LinkedIn';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="linkedin" id="platform" name="platform1" style="display:none;" checked><?php
                                                        

                                                    }
                                                    elseif($get_cpd->platform == 'google-my-business')
                                                    {
                                                        $maxlength = 1500;
                                                        echo 'Google My Business';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="google-my-business" id="platform" name="platform1" style="display:none;" checked><?php
                                                        
                                                    }
                                                    elseif($get_cpd->platform == 'pinterest')
                                                    {
                                                        $maxlength = 500;
                                                        echo 'Pinterest';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="pinterest" id="platform" name="platform1" style="display:none;" checked><?php
                                                        
                                                    }
                                                    elseif($get_cpd->platform == 'youtube')
                                                    {
                                                        $maxlength = 5000;
                                                        echo 'YouTube';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="youtube" id="platform" name="platform1" style="display:none;" checked><?php
                                                        
                                                    }
                                                    elseif($get_cpd->platform == 'blogger')
                                                    {
                                                        $maxlength = 50000;
                                                        echo 'Blog';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="blogger" id="platform" name="platform1" style="display:none;" checked><?php
                                                        
                                                    }
                                                    elseif($get_cpd->platform == 'tiktok')
                                                    {
                                                        $maxlength = 100;
                                                        echo 'TikTok';
                                                        ?><input type="radio" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" value="tiktok" id="platform" name="platform1" style="display:none;" checked><?php
                                                        
                                                    }
                                                    ?>
                                                </button>
                                            </h2>
                                            <div id="plannedcontent<?php echo $get_cpd->pc_id;?>-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                                <div class="accordion-body text-muted">
                                                  <div class="row">
                                                    <h6 class="modal-title mt-0 font-weight-semibold" id="EditCPModalLabel">Created By: 
                                                        <?php 
                                                        $pcb = $this->Front_model->getStudentById($get_cpd->pc_created_by);
                                                        $platform_created_by = ucfirst($pcb->first_name).' '.ucfirst($pcb->last_name);
                                                        echo $platform_created_by; 
                                                        ?>
                                                    </h6>
                                                    <div class="justify-content-end float-end mb-2" style="margin-top: -25px;">
                                                    <?php
                                                        if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')))
                                                            {
if($privilege_only_view == 'no')
{
          if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return delete_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-trash"></i> Delete</a>
                                                                <!-- <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return archive_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-archive-in"></i> Archive</a> -->
                                                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return file_it_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="mdi mdi-folder-multiple-plus-outline"></i> File it</a>
                                                            <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return delete_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-trash"></i> Delete</a>
                                                                <!-- <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return archive_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-archive-in"></i> Archive</a> -->
                                                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return file_it_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="mdi mdi-folder-multiple-plus-outline"></i> File it</a>
                                                            <?php
          }
        }    
      }  
    }                                                      
}
                                                            } 

if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?> 
               <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="show_platform_modal('overview','<?php echo $get_cpd->platform; ?>',<?php echo $get_cpd->pc_id;?>);" style="display: inline;float: right;padding: 4.5px;" >Preview</a>                                                        
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if(in_array('content planner', $cus_privilege))
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
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            ?> 
               <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="show_platform_modal('overview','<?php echo $get_cpd->platform; ?>',<?php echo $get_cpd->pc_id;?>);" style="display: inline;float: right;padding: 4.5px;" >Preview</a>                                                        
<?php
          }
        }    
      }  
    }
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
               <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="show_platform_modal('overview','<?php echo $get_cpd->platform; ?>',<?php echo $get_cpd->pc_id;?>);" style="display: inline;float: right;padding: 4.5px;" >Preview</a>                                                        
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="show_platform_modal('overview','<?php echo $get_cpd->platform; ?>',<?php echo $get_cpd->pc_id;?>);" style="display: inline;float: right;padding: 4.5px;" >Preview</a>
        <?php
        }
        else
        {
        ?> 
            <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="return file_preview_access_req('<?php echo $pid;?>')" style="display: inline;float: right;padding: 4.5px;" >Preview</a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a class="btn btn-d btn-sm me-1" href="javascript:void(0)" onclick="return file_preview_access_req('<?php echo $pid;?>')" style="display: inline;float: right;padding: 4.5px;" >Preview</a>
    <?php 
    }    
}
?>

                                                        
                                                    </div>
                                                    <form method="post" class="pro_edit_content_form" name="pro_edit_content_form" id="pro_edit_content_form" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="pc_id" id="pc_id" value="<?php echo $get_cpd->pc_id;?>">
                                                        <input type="hidden" name="pc_code" id="pc_code" value="<?php echo $get_cpd->pc_code;?>">
                                                        <input type="hidden" name="pc_project_assign" id="pc_project_assign" value="<?php echo $get_cpd->pc_project_assign;?>">
                                                        <input type="hidden" name="platform1" id="platform1" value="<?php echo $get_cpd->platform;?>">
                                                        <div class="row">
                                                          <div class="col-md-6">
                                                            <?php
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            if($get_cpd->platform == 'pinterest' || $get_cpd->platform == 'youtube' || $get_cpd->platform == 'blogger')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 youtube-title">
                                                                <label for="pc_title" class="col-form-label pc_title_label">Title </label>
                                                                <input maxlength="100" onkeyup="return onTitleChange(this.value,90<?php echo $cp_cnt; ?>);" id="pc_title" name="pc_title1" type="text" class="form-control youtube-field" placeholder="Enter Title" value="<?php echo $get_cpd->pc_title;?>">
                                                                <span style="display: none;" class="text-danger title-span"></span>
                                                                <span id="pc_titleErr" class="text-danger"></span>
                                                            </div> 
                                                            <?php
                                                            }
                                                            }
                                                            else
                                                            {
                                                                if($get_cpd->platform == 'pinterest' || $get_cpd->platform == 'youtube' || $get_cpd->platform == 'blogger')
                                                                {
                                                            ?>
                                                            <div class="form-group mb-2 youtube-title">
                                                                <label for="pc_title" class="col-form-label pc_title_label">Title </label>
                                                                <input maxlength="100" id="pc_title" name="pc_title1" type="text" class="form-control youtube-field" placeholder="Enter Title" value="<?php echo $get_cpd->pc_title;?>" readonly>
                                                                <span style="display: none;" class="text-danger title-span"></span>
                                                                <span id="pc_titleErr" class="text-danger"></span>
                                                            </div>
                                                            <?php
                                                                }
                                                            }
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            ?>  
                                                            <div class="form-group mb-2 written_content">
                                                                <label for="written_content" class="col-form-label written_content_label">Written Content </label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" onkeyup="return onWrittenContentChange(this.value,90<?php echo $cp_cnt; ?>);" class="form-control" id="written_content" name="written_content1" rows="5" placeholder="Enter Written Content"><?php echo $get_cpd->written_content;?></textarea>
                                                                <span style="display:none;" class="text-danger written-content-span"></span>
                                                                <span id="written_contentErr" class="text-danger"></span>
                                                            </div> 
                                                            <?php 
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 written_content">
                                                                <label for="written_content" class="col-form-label written_content_label">Written Content </label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" class="form-control" id="written_content" name="written_content1" rows="5" placeholder="Enter Written Content" readonly><?php echo $get_cpd->written_content;?></textarea>
                                                                <span style="display:none;" class="text-danger written-content-span"></span>
                                                                <span id="written_contentErr" class="text-danger"></span>
                                                            </div> 
                                                            <?php
                                                            }
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            if($get_cpd->platform == 'pinterest')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 written-content-2">
                                                                <label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" onkeyup="return onWrittenContent2Change(this.value,90<?php echo $cp_cnt; ?>);" class="form-control" id="written_content_2" name="written_content_21" rows="5" placeholder="Enter Written Content"><?php echo $get_cpd->written_content_2;?></textarea>
                                                                <span style="display:none;" class="text-danger written-content-2-span"></span>
                                                                <span id="written_content_2Err" class="text-danger"></span>
                                                            </div> 
                                                            <?php 
                                                            }
                                                            }
                                                            else
                                                            {
                                                                if($get_cpd->platform == 'pinterest')
                                                                {
                                                            ?>
                                                            <div class="form-group mb-2 written-content-2">
                                                                <label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" class="form-control" id="written_content_2" name="written_content_21" rows="5" placeholder="Enter Written Content" readonly><?php echo $get_cpd->written_content_2;?></textarea>
                                                                <span style="display:none;" class="text-danger written-content-2-span"></span>
                                                                <span id="written_content_2Err" class="text-danger"></span>
                                                            </div>
                                                            <?php
                                                                }
                                                            }
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            if($get_cpd->platform == 'blogger')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="target_audience" class="col-form-label target_audience_label">Target Audience</label>
                                                                <input id="target_audience" name="target_audience1" type="text" class="form-control blog-field" placeholder="Enter Target Audience" value="<?php echo $get_cpd->target_audience;?>">
                                                                <span style="display: none;" class="text-danger target_audience-span"></span>
                                                                <span id="target_audienceErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="solutions" class="col-form-label solutions_label">Solutions</label>
                                                                <input id="solutions" name="solutions1" type="text" class="form-control blog-field" placeholder="Enter Solutions" value="<?php echo $get_cpd->solutions;?>">
                                                                <span style="display: none;" class="text-danger solutions-span"></span>
                                                                <span id="solutionsErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="keywords" class="col-form-label keywords_label">Keywords</label>
                                                                <input id="keywords" name="keywords1" type="text" class="form-control blog-field" placeholder="Enter Keywords" value="<?php echo $get_cpd->keywords;?>">
                                                                <span style="display: none;" class="text-danger keywords-span"></span>
                                                                <span id="keywordsErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="internal_links" class="col-form-label internal_links_label">Internal Links</label>
                                                                <input id="internal_links" name="internal_links1" type="text" class="form-control blog-field" placeholder="Enter Internal Links" value="<?php echo $get_cpd->internal_links;?>">
                                                                <span style="display: none;" class="text-danger internal_links-span"></span>
                                                                <span id="internal_linksErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="external_links" class="col-form-label external_links_label">External Links</label>
                                                                <input id="external_links" name="external_links1" type="text" class="form-control blog-field" placeholder="Enter External Links" value="<?php echo $get_cpd->external_links;?>">
                                                                <span style="display: none;" class="text-danger external_links-span"></span>
                                                                <span id="external_linksErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="meta_title" class="col-form-label meta_title_label">Meta title</label>
                                                                <input id="meta_title" name="meta_title1" type="text" class="form-control blog-field" placeholder="Enter Meta title" value="<?php echo $get_cpd->meta_title;?>">
                                                                <span style="display: none;" class="text-danger meta_title-span"></span>
                                                                <span id="meta_titleErr" class="text-danger"></span>
                                                            </div>  

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="meta_description" class="col-form-label meta_description_label">Meta Description</label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" id="meta_description" name="meta_description1" class="form-control blog-field" rows="5" placeholder="Enter Meta Description"><?php echo $get_cpd->meta_description;?></textarea>
                                                                <span style="display: none;" class="text-danger meta_description-span"></span>
                                                                <span id="meta_descriptionErr" class="text-danger"></span>
                                                            </div>
                                                            <?php
                                                            }
                                                            }
                                                            else
                                                            {
                                                            if($get_cpd->platform == 'blogger')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="target_audience" class="col-form-label target_audience_label">Target Audience</label>
                                                                <input id="target_audience" name="target_audience1" type="text" class="form-control blog-field" placeholder="Enter Target Audience" value="<?php echo $get_cpd->target_audience;?>" readonly>
                                                                <span style="display: none;" class="text-danger target_audience-span"></span>
                                                                <span id="target_audienceErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="solutions" class="col-form-label solutions_label">Solutions</label>
                                                                <input id="solutions" name="solutions1" type="text" class="form-control blog-field" placeholder="Enter Solutions" value="<?php echo $get_cpd->solutions;?>" readonly>
                                                                <span style="display: none;" class="text-danger solutions-span"></span>
                                                                <span id="solutionsErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="keywords" class="col-form-label keywords_label">Keywords</label>
                                                                <input id="keywords" name="keywords1" type="text" class="form-control blog-field" placeholder="Enter Keywords" value="<?php echo $get_cpd->keywords;?>" readonly>
                                                                <span style="display: none;" class="text-danger keywords-span"></span>
                                                                <span id="keywordsErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="internal_links" class="col-form-label internal_links_label">Internal Links</label>
                                                                <input id="internal_links" name="internal_links1" type="text" class="form-control blog-field" placeholder="Enter Internal Links" value="<?php echo $get_cpd->internal_links;?>" readonly>
                                                                <span style="display: none;" class="text-danger internal_links-span"></span>
                                                                <span id="internal_linksErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="external_links" class="col-form-label external_links_label">External Links</label>
                                                                <input id="external_links" name="external_links1" type="text" class="form-control blog-field" placeholder="Enter External Links" value="<?php echo $get_cpd->external_links;?>" readonly>
                                                                <span style="display: none;" class="text-danger external_links-span"></span>
                                                                <span id="external_linksErr" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="meta_title" class="col-form-label meta_title_label">Meta title</label>
                                                                <input id="meta_title" name="meta_title1" type="text" class="form-control blog-field" placeholder="Enter Meta title" value="<?php echo $get_cpd->meta_title;?>" readonly>
                                                                <span style="display: none;" class="text-danger meta_title-span"></span>
                                                                <span id="meta_titleErr" class="text-danger"></span>
                                                            </div>  

                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label for="meta_description" class="col-form-label meta_description_label">Meta Description</label>
                                                                <textarea maxlength="<?php echo $maxlength; ?>" id="meta_description" name="meta_description1" class="form-control blog-field" rows="5" placeholder="Enter Meta Description" readonly><?php echo $get_cpd->meta_description;?></textarea>
                                                                <span style="display: none;" class="text-danger meta_description-span"></span>
                                                                <span id="meta_descriptionErr" class="text-danger"></span>
                                                            </div>
                                                            <?php
                                                            }  
                                                            }

                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            if($get_cpd->platform == 'youtube')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 tags">
                                                                <label for="tags" class="col-form-label tags_label">Tags</label>
                                                                <textarea maxlength="400" class="form-control" id="tags" name="tags1" rows="5" placeholder="Add Tag"><?php echo $get_cpd->tags;?></textarea>
                                                                <span style="display:none;" class="text-danger tags-span"></span>
                                                                <span id="tagsErr" class="text-danger"></span>
                                                            </div>
                                                            <?php 
                                                            }
                                                            }
                                                            else
                                                            {
                                                            if($get_cpd->platform == 'youtube')
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 tags">
                                                                <label for="tags" class="col-form-label tags_label">Tags</label>
                                                                <textarea maxlength="400" class="form-control" id="tags" name="tags1" rows="5" placeholder="Add Tag" readonly><?php echo $get_cpd->tags;?></textarea>
                                                                <span style="display:none;" class="text-danger tags-span"></span>
                                                                <span id="tagsErr" class="text-danger"></span>
                                                            </div>
                                                            <?php 
                                                            } 
                                                            }

                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 pc_file">
                                                                <label class="col-form-label pc_file_label">Attach Media</label>
                                                                <input type="hidden" name="total_content[]" id="total_content" value="1">
                                                                <input class="form-control limitCPFiles" name="pc_file1[]" id="pc_file" type="file" accept="video/*,image/*" data-id="90<?php echo $get_cpd->pc_id; ?>" multiple="" />
                                                                <span id="limitCPFilesErr90<?php echo $get_cpd->pc_id; ?>" class="text-danger"></span>
                                                                <span id="pc_fileErr<?php echo $get_cpd->pc_id;?>" class="text-danger"></span>                              
                                                            </div>
                                                            <div class="form-group mb-2 pc_old_file">
                                                                <label class="col-form-label pc_file_label">Attached Media</label>
                                                                <?php if(!empty($get_cpd->pc_file))
                                                                        {
                                                                            $all_pc_file = explode(',', $get_cpd->pc_file);
                                                                            $old_cpfile = count($all_pc_file);
                                                                            //$count = count($pc_file);
                                                                            if($all_pc_file)
                                                                            {
                                                                                ?>
                                                                                <input type="hidden" id="limitCPOldFiles90<?php echo $get_cpd->pc_id; ?>" name="limitCPOldFiles" value="<?php echo $old_cpfile;?>">
                                                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                                                    <p></p>
                                                                                <?php
                                                                                $count = 0;
                                                                                foreach($all_pc_file as $pc_file)
                                                                                {
                                                                                    ?>
                                                                                    <li style="padding-left: 15px;" id="field_id<?php echo $count;?>">
                                                                                        <div class="row">
                                                                                            <div class="col-8"> <i class="mdi mdi-chevron-double-right text-d"></i>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?> 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?> 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
          }
          else
            {
             ?> 
                            <a href="javascript: void(0);" class="nameLink"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
          }
        }    
      }  
    }
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
           <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a> 
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
    <?php 
    }    
}
?>
                                                                                            </div>
                                                                                            <div class="col-4">
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                                <a href="javascript:void(0)" onclick="return delete_pro_pc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentFileAttachment/'.$pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                                <a href="javascript:void(0)" onclick="return delete_pro_pc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentFileAttachment/'.$pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php
          }
        }    
      }  
    }
}
?>
                                                                                            </div>
                                                                                        </div></li>
                                                                                    <?php
                                                                                     $count++;
                                                                                }
                                                                                ?>
                                                                                </ul>
                                                                                <?php
                                                                            }
                                                                        }?>                               
                                                            </div> 
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 pc_old_file">
                                                                <label class="col-form-label pc_file_label">Attached Media</label>
                                                                <?php if(!empty($get_cpd->pc_file))
                                                                        {
                                                                            $all_pc_file = explode(',', $get_cpd->pc_file);
                                                                            $old_cpfile = count($all_pc_file);
                                                                            //$count = count($pc_file);
                                                                            if($all_pc_file)
                                                                            {
                                                                                ?>
                                                                                <input type="hidden" id="limitCPOldFiles90<?php echo $get_cpd->pc_id; ?>" name="limitCPOldFiles" value="<?php echo $old_cpfile;?>">
                                                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                                                    <p></p>
                                                                                <?php
                                                                                $count = 0;
                                                                                foreach($all_pc_file as $pc_file)
                                                                                {
                                                                                    ?>
                                                                                    <li style="padding-left: 15px;" id="field_id<?php echo $count;?>">
                                                                                        <div class="row">
                                                                                            <div class="col-8"> 
                                                                                                <i class="mdi mdi-chevron-double-right text-d"></i>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
          }
          else
            {
             ?> 
                            <a href="javascript: void(0);" class="nameLink"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
          }
        }    
      }  
    }
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
    <?php 
    }    
}
?>                                                                
                                                                                            </div>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                        <div class="col-4">
                                                            <a href="<?php echo base_url().'front/download_ContentFileAttachment/'.$pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                        </div>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                        <div class="col-4">
                                                            <a href="<?php echo base_url().'front/download_ContentFileAttachment/'.$pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                        </div>
<?php
          }
        }    
      }  
    }
}
?>
                                                                                        </div></li>
                                                                                    <?php
                                                                                     $count++;
                                                                                }
                                                                                ?>
                                                                                </ul>
                                                                                <?php
                                                                            }
                                                                        }?>                               
                                                            </div>
                                                            <?php 
                                                            }
                                                            if($get_cpd->platform == 'blogger')
                                                            {
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 blog-field-div">
                                                                <label class="col-form-label pc_file_label">Attach Documents</label>
                                                                <input class="form-control blog-field" name="doc_pc_file1[]" id="doc_pc_file" type="file" data-id="90<?php echo $get_cpd->pc_id; ?>" multiple="" />
                                                                <span id="doc_pc_fileErr" class="text-danger"></span>                               
                                                            </div>
                                                            <div class="form-group mb-2 pc_old_file">
                                                                <label class="col-form-label pc_file_label">Attached Documents</label>
                                                                <?php if(!empty($get_cpd->doc_pc_file))
                                                                        {
                                                                            $all_doc_pc_file = explode(',', $get_cpd->doc_pc_file);
                                                                            $old_doc_cpfile = count($all_doc_pc_file);
                                                                            //$count = count($pc_file);
                                                                            if($all_doc_pc_file)
                                                                            {
                                                                                ?>
                                                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                                                    <p></p>
                                                                                <?php
                                                                                $count = 0;
                                                                                foreach($all_doc_pc_file as $doc_pc_file)
                                                                                {
                                                                                    ?>
                                                                                    <li style="padding-left: 15px;" id="field_id<?php echo $count;?>">
                                                                                        <div class="row">
                                                                                            <div class="col-8"> <i class="mdi mdi-chevron-double-right text-d"></i>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
          }
          else
            {
             ?> 
                            <a href="javascript: void(0);" class="nameLink"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
          }
        }    
      }  
    }
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
           <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a> 
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
    <?php 
    }    
}
?>                                                                
                                                                                            </div>
                                                                                            <div class="col-4">
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                                <a href="javascript:void(0)" onclick="return delete_pro_pc_doc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentDocFileAttachment/'.$doc_pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php 
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                                <a href="javascript:void(0)" onclick="return delete_pro_pc_doc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentDocFileAttachment/'.$doc_pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php 
          }
        }    
      }  
    }
}
?>
                                                                                            </div>
                                                                                        </div></li>
                                                                                    <?php
                                                                                     $count++;
                                                                                }
                                                                                ?>
                                                                                </ul>
                                                                                <?php
                                                                            }
                                                                        }?>                               
                                                            </div> 
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="form-group mb-2 pc_old_file">
                                                                <label class="col-form-label pc_file_label">Attached Documents</label>
                                                                <?php if(!empty($get_cpd->doc_pc_file))
                                                                        {
                                                                            $all_doc_pc_file = explode(',', $get_cpd->doc_pc_file);
                                                                            $old_doc_cpfile = count($all_doc_pc_file);
                                                                            //$count = count($pc_file);
                                                                            if($all_doc_pc_file)
                                                                            {
                                                                                ?>
                                                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                                                    <p></p>
                                                                                <?php
                                                                                $count = 0;
                                                                                foreach($all_doc_pc_file as $doc_pc_file)
                                                                                {
                                                                                    ?>
                                                                                    <li style="padding-left: 15px;" id="field_id<?php echo $count;?>">
                                                                                        <div class="row">
                                                                                            <div class="col-8"> 
                                                                                                <i class="mdi mdi-chevron-double-right text-d"></i>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
          }
          else
            {
             ?> 
                            <a href="javascript: void(0);" class="nameLink"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
          }
        }    
      }  
    }
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
    <?php 
    }    
}
?>                                                                
                                                                                            </div>
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                    <div class="col-4">
                                                        <a href="<?php echo base_url().'front/download_ContentDocFileAttachment/'.$doc_pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                    </div>
<?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                    <div class="col-4">
                                                        <a href="<?php echo base_url().'front/download_ContentDocFileAttachment/'.$doc_pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                    </div>
<?php
          }
        }    
      }  
    }
}
?>
                                                                                        </div></li>
                                                                                    <?php
                                                                                     $count++;
                                                                                }
                                                                                ?>
                                                                                </ul>
                                                                                <?php
                                                                            }
                                                                        }?>                               
                                                            </div>
                                                            <?php 
                                                            }
                                                            }
                                                            // if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
                                                            // {
                                                            ?>  
                                                            <!-- <div class="mb-2 form-group">
                                                                <label class="col-form-label" for="tname">Publish Date <span class="text-danger">*</span></label>
                                                                <div class="input-group" id="datepicker110<?php echo $cp_cnt; ?>">
                                                                    <input id="pub_date<?php echo $cp_cnt; ?>" name="pub_date1" onmouseenter="return get_pub_cdate(<?php echo $cp_cnt; ?>);" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker110<?php echo $cp_cnt; ?>" data-date-format="yyyy-m-d" data-provide="datepicker" value="<?php echo $get_cpd->publish_date; ?>" required="" />
                                                                </div>
                                                                <span class="text-danger" id="pub_date1Err"></span>
                                                            </div> -->
                                                            <?php 
                                                            // }
                                                            // else
                                                            // {
                                                            ?>
                                                            <!-- <div class="mb-2 form-group">
                                                                <label class="col-form-label" for="tname">Publish Date <span class="text-danger">*</span></label>
                                                                <div class="input-group" id="datepicker110<?php echo $cp_cnt; ?>">
                                                                    <input id="pub_date<?php echo $cp_cnt; ?>" name="pub_date1" onmouseenter="return get_pub_cdate(<?php echo $cp_cnt; ?>);" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker110<?php echo $cp_cnt; ?>" data-date-format="yyyy-m-d" data-provide="datepicker" value="<?php echo $get_cpd->publish_date; ?>" required="" readonly />
                                                                </div>
                                                                <span class="text-danger" id="pub_date1Err"></span>
                                                            </div> -->
                                                            <?php
                                                            // }
                                                            ?>                                       
                                                          </div> 
                                                          <?php
                                                          if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id'))) 
                                                          {
                                                          ?>                                           
                                                          <div class="col-md-6">                           
                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                                                
                                                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee1"  style="line-height: 1.5;">
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="written_content_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                                                
                                                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee1"  style="line-height: 1.5;">
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="written_content_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                                                
                                                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee1"  style="line-height: 1.5;">
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="pc_file_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                                                
                                                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee1"  style="line-height: 1.5;">
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="pc_file_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                                                
                                                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval1"  style="line-height: 1.5;">
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="submit_to_approval1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                                                
                                                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval1"  style="line-height: 1.5;">
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="submit_to_approval1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>
                                                                
                                                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee1"  style="line-height: 1.5;">
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <option value="" <?php if($get_cpd->pc_assignee == 0){ echo "selected";}?>><span>None</span></option>
                                                                    </select> 
                                                                    <span id="pc_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>
                                                                
                                                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee1"  style="line-height: 1.5;">
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="pc_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                          </div>
                                                          <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="col-md-6">                           
                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                                                
                                                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee1"  style="line-height: 1.5;" disabled>
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="written_content_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                                                
                                                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee1"  style="line-height: 1.5;" disabled>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="written_content_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                                                
                                                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee1"  style="line-height: 1.5;" disabled>
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="pc_file_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                                                
                                                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee1"  style="line-height: 1.5;" disabled>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="pc_file_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                                                
                                                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval1"  style="line-height: 1.5;" disabled>
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <span id="submit_to_approval1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                                                
                                                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval1"  style="line-height: 1.5;" disabled>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="submit_to_approval1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                                                ?>
                                                                <div class="form-group mb-2">
                                                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>
                                                                
                                                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee1"  style="line-height: 1.5;" disabled>
                                                                    <?php                                           
                                                                    if($projtm){
                                                                        foreach ($projtm as $ptm) {
                                                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                                                            if($m){
                                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                            <?php
                                                                                }
                                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                            ?>
                                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                            <?php
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
                                                                    <option value="" <?php if($get_cpd->pc_assignee == 0){ echo "selected";}?>><span>None</span></option>
                                                                    </select> 
                                                                    <span id="pc_assignee1Err" class="text-danger"></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>                            
                                                            <div class="form-group mb-2">
                                                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>
                                                                
                                                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee1"  style="line-height: 1.5;" disabled> 
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                                                    </select> 
                                                                <span id="pc_assignee1Err" class="text-danger"></span>
                                                                
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                          </div>
                                                            <?php
                                                            }

                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id'))  || ($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')))
                                                            {
                                                            if(!empty($get_cpd->pc_link))
                                                            {
                                                                $pc_link = explode(',', $get_cpd->pc_link);
                                                                $pc_link_comment = explode(',',$get_cpd->pc_link_comment);
                                                          ?>
                                                            <div class="row mb-2">
                                                                <label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label>
                                                                <div class="col-lg-4">
                                                                    <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link" value="<?php echo $pc_link[0];?>">
                                                                    <span id="pc_linkErr" class="text-danger"></span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment" value="<?php if(!empty($pc_link_comment[0])){ echo $pc_link_comment[0]; }?>">
                                                                    <span id="pc_link_commentErr" class="text-danger"></span>
                                                                </div>
<?php
if($privilege_only_view == 'no')
{
?>
                                                                <div class="col-lg-4">
                                                                    <button type="button" class="add_dup_pc_link12 btn btn-d btn-sm">Add Another link</button>  
                                                                </div>
<?php 
}
?>
                                                            </div>
                                                          <?php
                                                            }
                                                            else
                                                            {
                                                          ?>
                                                            <div class="row mb-2">
                                                                <label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label>
                                                                <div class="col-lg-4">
                                                                    <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link">
                                                                    <span id="pc_linkErr" class="text-danger"></span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment">
                                                                    <span id="pc_link_commentErr" class="text-danger"></span>
                                                                </div>
<?php
if($privilege_only_view == 'no')
{
?>                                                               
                                                                <div class="col-lg-4">
                                                                    <button type="button" class="add_dup_pc_link12 btn btn-d btn-sm">Add Another link</button>
                                                                </div>
<?php
}
?> 
                                                            </div>
                                                          <?php
                                                            }
                                                          ?>
                                                            <div class="pc_link_div12">
                                                                <?php
                                                                    if(!empty($get_cpd->pc_link))
                                                                    {
                                                                        $pc_link = explode(',', $get_cpd->pc_link);
                                                                        $pc_link_comment = explode(',',$get_cpd->pc_link_comment);
                                                                        $pccount = count($pc_link); 
                                                                        if($pccount > 0)
                                                                        {
                                                                            for ($i=1; $i<$pccount; $i++)
                                                                            {
                                                                ?>
                                                                <div class="row mb-2">
                                                                    <label class="col-form-label col-lg-12"></label>
                                                                    <div class="col-lg-4">
                                                                        <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link" value="<?php echo $pc_link[$i];?>">
                                                                        <span id="pc_linkErr" class="text-danger"></span>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment" value="<?php if(!empty($pc_link_comment[$i])){ echo $pc_link_comment[$i]; }?>">
                                                                        <span id="pc_link_commentErr" class="text-danger"></span>
                                                                    </div>
                                                                    <div class="col-lg-4 card-title mb-2">
                                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec12" style="margin-left: 30px;">
                                                                            <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
                                                                        </button>
                                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link12" style="margin-left: 15px;">
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
                                                            <span id="link_validErr1" class="text-danger"></span>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                                if(!empty($get_cpd->pc_link))
                                                                    {
                                                                        $pc_link = explode(',', $get_cpd->pc_link);
                                                                        $pc_link_comment = explode(',',$get_cpd->pc_link_comment);
                                                                        $pccount = count($pc_link); 
                                                                        if($pccount > 0)
                                                                        {
                                                                            for ($i=0; $i<$pccount; $i++)
                                                                            {
                                                                ?>
                                                                <div class="row mb-2">
                                                                    <label class="col-form-label col-lg-12"><?php if($i==0){ echo "Link(s) & Comment(s)";}?></label>
                                                                    <div class="col-lg-6">
                                                                        <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link" value="<?php echo $pc_link[$i];?>" readonly>
                                                                        <span id="pc_linkErr" class="text-danger"></span>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment" value="<?php if(!empty($pc_link_comment[$i])){ echo $pc_link_comment[$i]; }?>" readonly>
                                                                        <span id="pc_link_commentErr" class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                            }
                                                            ?>                            
                                                        </div> 
                                                        <br>                       
                                                        <div class="justify-content-end float-end">
                                                            <?php
                                                            if(!empty($get_cpd->pc_project_assign))
                                                            {
                                                                ?>
                                                            <input type="hidden" name="pid" id="pid" value="<?php echo $get_cpd->pc_project_assign;?>">
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                            <input type="hidden" name="pid" id="pid">
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')) || ($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')))
                                                            {
if($privilege_only_view == 'no')
{
                if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                            <button type="submit" id="pro_edit_content_button" class="btn btn-d btn-sm">Save Changes</button>
                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                            <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
             ?>
                                                            <button type="submit" id="pro_edit_content_button" class="btn btn-d btn-sm">Save Changes</button>
                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                            <?php
          }
        }    
      }  
    }                                                
}
                                                            }
                                                            ?>
                                                            <button class="btn btn-sm bg-d text-white fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#plannedcontent<?php echo $get_cpd->pc_id;?>-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                Cancel 
                                                            </button>
                                                        </div>                                   
                                                </form>
                                                  </div>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                                    $cp_cnt++;
                            }
                        ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }
                        ?>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <?php
                                            if($pdetail->ptype == "content")
                                            {
                                                echo "Content Tasks Assigned";
                                            }
                                            else
                                            {
                                                echo "Project Tasks Assigned";
                                            }

                                            if($p_tasks || $p_subtasks)
                                                {
                                            ?>
                                            <a href="<?php echo base_url('project-tasks-list').'/'.$pid;?>" class="text-dark">
                                                <span class="badge bg-d">View All Tasks</span>
                                            </a>
                                            <?php
                                                }
                                            ?>
                                        </h4>
                                        <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <h5 class="font-size-15">Tasks :</h5>
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    if($p_tasks)
                                                        {
                                                            foreach($p_tasks as $pt)
                                                            {
                                                                $members = $this->Front_model->getStudentById($pt->tassignee);
                                                                if($members)
                                                                {
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                            <?php
                                                                            if($members->photo)
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo base_url('assets/student_photos/'.$members->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                $fullname = $members->first_name.' '.$members->last_name;
                                                                                $member_name = explode(" ", $fullname);
                                                                                $profile_name = "";

                                                                                foreach ($member_name as $n) 
                                                                                {
                                                                                  $profile_name .= $n[0];
                                                                                }
                                                                                ?>
                                                                                <div class="avatar-xs">
                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                                        <?php echo strtoupper($profile_name);?>
                                                                                    </span>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                        <a href="<?php echo base_url('team-member-tasks-list').'/'.$pid.'/'.$pt->tassignee;?>" class="text-dark" title="View Tasks">
                                                                            <?php echo $members->first_name.' '.$members->last_name;
                                                                            if($pt->tassignee == $this->session->userdata('d168_id'))
                                                                            {
                                                                            $check_notify_tm_task = $this->Front_model->check_notify_tm_task($pt->tassignee,$pid);
                                                                            if($check_notify_tm_task)
                                                                            {
                                                                            ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        <!-- <span class="badge bg-d">View Tasks</span> -->
                                                                        </a>
                                                                        </h5>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                             if($p_tasks)
                                                                                        {
                                                                            $progress_done3 = $this->Front_model->progress_done3($pid,$pt->tassignee);
                                                                            $progress_total3 = $this->Front_model->progress_total3($pid,$pt->tassignee);
                                                                            if($progress_total3)
                                                                            {
                                                                                $progress3 = ($progress_done3['count_rows'] / $progress_total3['count_rows']) * 100;
                                                                            ?>
                                                                            <span>
                                                                                Done: <?php echo $progress_done3['count_rows']; ?>  
                                                                                Total: <?php echo $progress_total3['count_rows']; ?>                                  
                                                                            <div class="progress mt-2">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                if($progress3 == 0)
                                                                                {
                                                                                    echo '8%';
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo $progress3.'%';
                                                                                }
                                                                                ?>"><?php echo round($progress3).'%'; ?></div>
                                                                            </div>
                                                                            </span>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Tasks!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <h5 class="font-size-15 mt-4">Subtasks :</h5>
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    if($p_subtasks)
                                                        {
                                                            foreach($p_subtasks as $pst)
                                                            {
                                                                $members = $this->Front_model->getStudentById($pst->stassignee);
                                                                if($members)
                                                                {
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                            <?php
                                                                            if($members->photo)
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo base_url('assets/student_photos/'.$members->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                $fullname = $members->first_name.' '.$members->last_name;
                                                                                $member_name = explode(" ", $fullname);
                                                                                $profile_name = "";

                                                                                foreach ($member_name as $n) 
                                                                                {
                                                                                  $profile_name .= $n[0];
                                                                                }
                                                                                ?>
                                                                                <div class="avatar-xs">
                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                                        <?php echo strtoupper($profile_name);?>
                                                                                    </span>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                        <a href="<?php echo base_url('team-member-tasks-list').'/'.$pid.'/'.$pst->stassignee;?>" class="text-dark" title="View Tasks">
                                                                            <?php echo $members->first_name.' '.$members->last_name;
                                                                            if($pst->stassignee == $this->session->userdata('d168_id'))
                                                                            {
                                                                            $check_notify_tm_task = $this->Front_model->check_notify_tm_task($pst->stassignee,$pid);
                                                                            if($check_notify_tm_task)
                                                                            {
                                                                            ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        <!-- <span class="badge bg-d">View Tasks</span> -->
                                                                        </a>
                                                                        </h5>
                                                                    </td>
                                                                     <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                             if($p_subtasks)
                                                                                        {
                                                                            $sub_progress_done3 = $this->Front_model->sub_progress_done3($pid,$pst->stassignee);
                                                                            $sub_progress_total3 = $this->Front_model->sub_progress_total3($pid,$pst->stassignee);
                                                                            if($sub_progress_total3)
                                                                            {
                                                                                $sub_progress3 = ($sub_progress_done3['count_rows'] / $sub_progress_total3['count_rows']) * 100;
                                                                            ?>
                                                                            <span>
                                                                                Done: <?php echo $sub_progress_done3['count_rows']; ?>  
                                                                                Total: <?php echo $sub_progress_total3['count_rows']; ?>                                  
                                                                            <div class="progress mt-2">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                if($sub_progress3 == 0)
                                                                                {
                                                                                    echo '8%';
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo $sub_progress3.'%';
                                                                                }
                                                                                ?>"><?php echo round($sub_progress3).'%'; ?></div>
                                                                            </div>
                                                                            </span>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Subtasks!";
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
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#plink_tab" role="tab">
                                                    <h4 class="card-title mb-4"><?php
                                                            echo "Links & Comments";
                                                    ?></h4>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tlink_tab" role="tab">
                                                    <h4 class="card-title mb-4">Tasks Links & Comments</h4>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#stlink_tab" role="tab">
                                                    <h4 class="card-title mb-4">Subtasks Links & Comments</h4>
                                                </a>
                                            </li>
                                        </ul>
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="plink_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    if(!empty($pdetail->plink))
                                                        {
                                                            $plink = explode(',', $pdetail->plink);
                                                            $plink_comment = explode(',',$pdetail->plink_comment);
                                                            $plcount = count($plink);
                                                            if($plcount > 0){
                                                                for ($i=0; $i<$plcount; $i++){
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
                                                                                <a href="<?php echo $plink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                <?php
                                                                                    echo $plink[$i];
                                                                                ?>
                                                                                </a>
                                                                            </h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><?php
                                                                                    if(!empty($plink_comment[$i])){
                                                                                        echo $plink_comment[$i];
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
                                                            echo "No Links!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                  </p>
                              </div>
                              <div class="tab-pane" id="tlink_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    $tdetail = $this->Front_model->getTasksProjectLinks($pid);

                                                    if($tdetail)
                                                    {
                                                    foreach($tdetail as $td)
                                                    {
                                                        if(!empty($td->tlink))
                                                        {
                                                            $tlink = explode(',', $td->tlink);
                                                            $tlink_comment = explode(',',$td->tlink_comment);
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
                                                                                <p class="mt-2"><span class="badge badge-soft-dark"><?php echo $td->tname;?></span></p>
                                                                            </h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><?php
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
                                  </p>
                              </div>
                              <div class="tab-pane" id="stlink_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    $stdetail = $this->Front_model->getSubtasksProjectLinks($pid);
                                                    if($stdetail)
                                                    {
                                                    foreach($stdetail as $std)
                                                    {
                                                        if(!empty($std->stlink))
                                                        {
                                                            $stlink = explode(',', $std->stlink);
                                                            $stlink_comment = explode(',',$std->stlink_comment);
                                                            $stlcount = count($stlink);
                                                            if($stlcount > 0){
                                                                for ($i=0; $i<$stlcount; $i++){
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
                                                                                <a href="<?php echo $stlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                <?php
                                                                                    echo $stlink[$i];
                                                                                ?>
                                                                                </a>
                                                                                <p class="mt-2"><span class="badge badge-soft-dark"><?php echo $std->stname;?></span></p>
                                                                            </h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><?php
                                                                                     if(!empty($stlink_comment[$i])){
                                                                                    echo $stlink_comment[$i];
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
                                                            echo "No Subtask Links!";
                                                        }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Subtask Links!";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                  </p>
                              </div>
                          </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->  
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Attached Files
<?php
if($privilege_only_view == 'no')
{
?>
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" id="pfile_but" onclick="return add_pfile_button();" title="Add Files">
                                                                <span class="avatar-title bg-transparent text-reset">
                                                                    <i class="bx bx-plus"></i>
                                                                </span>
                                                        </button>
                                                        <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                        <form method="post" id="add_Pfile_form" name="add_Pfile_form" enctype="multipart/form-data">
                                                            <input type="hidden" name="pid" id="pid" value="<?php echo $pdetail->pid;?>">
                                                            <input type="file" name="add_pfile[]" id="add_pfile" multiple="" style="display: none;">
                                                            <span id="add_pfileErr" class="text-danger"></span>
                                                        </form>
<?php
}
?> 
                                        </h4>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#pfile_tab" role="tab">
                                                    <h4 class="card-title mb-4">Files</h4>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tfile_tab" role="tab">
                                                    <h4 class="card-title mb-4">Tasks Files</h4>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#stfile_tab" role="tab">
                                                    <h4 class="card-title mb-4">Subtasks Files</h4>
                                                </a>
                                            </li>
                                        </ul>
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="pfile_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    $pfile = $this->Front_model->ProjectFile($pid);
                                                        if($pfile)
                                                        {
                                                            foreach($pfile as $p)
                                                            {
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
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview">
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview">
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview">
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
    <?php 
    }    
}
                                                                                $filename = substr($p->pfile, strpos($p->pfile, '_') + 1);
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
                                                                            <!-- <a href="<?php echo base_url().'front/download_PFileAttachment/'.$pdetail->pid.'/'.$p->pfile_id?>" class="text-dark">
                                                                            <?php
                                                                                $filename = substr($p->pfile, strpos($p->pfile, '_') + 1);
                                                                                if(strlen($filename) > 35)
                                                                                    {
                                                                                        print_r(substr($filename,0,32).'...');
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $filename;
                                                                                    }
                                                                            ?>
                                                                            </a> -->
                                                                        </h5>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
<?php
if($privilege_only_view == 'no')
{
?> 
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return previewModalFullscreen(<?php echo $p->pfile_id;?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php 
    }    
}

if($privilege_only_view == 'no')
{
?>
                                                                            <a href="<?php echo base_url().'front/download_PFileAttachment/'.$pdetail->pid.'/'.$p->pfile_id;?>" class="text-dark" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                                                            <a href="javascript:void(0)" onclick="return delete_pfile('<?php echo $pdetail->pid;?>','<?php echo $p->pfile_id;?>','<?php echo $p->pfile;?>');" class="text-dark" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
<?php
}
?> 
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Attached Files!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                  </p>
                              </div>
                              <div class="tab-pane" id="tfile_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    $tfile = $this->Front_model->TaskFile($pid);
                                                        if(!empty($tfile))
                                                        {
                                                            foreach($tfile as $t)
                                                            {
                                                                $tfile = explode(',', $t->tfile);
                                                                $count = count($tfile);
                                                                if($count > 0)
                                                                {
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
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview">
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview">
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview">
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
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
                                                                            <p class="mt-2"><span class="badge badge-soft-dark"><?php echo $t->tname;?></span></p>
                                                                        </h5>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
<?php
if($privilege_only_view == 'no')
{
?>                                                                            
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                            
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php 
    }    
}

if($privilege_only_view == 'no')
{
?>
                                                                            <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$t->tid;?>" class="text-dark" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                                                            <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $t->tid;?>');" class="text-dark" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
<?php 
}
?>
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Attached Files!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                  </p>
                              </div>
                              <div class="tab-pane" id="stfile_tab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 200px;"> 
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <?php
                                                    $stfile = $this->Front_model->SubtaskFile($pid);
                                                        if(!empty($stfile))
                                                        {
                                                            foreach($stfile as $st)
                                                            {
                                                                $stfile = explode(',', $st->stfile);
                                                                $scount = count($stfile);
                                                                if($scount > 0)
                                                                {
                                                                    for ($i=0; $i<$scount; $i++)
                                                                    {
                                                                         $stfile_name = $stfile[$i];
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
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return  PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview">
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return  PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview">
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return  PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview">
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview">
    <?php 
    }    
}
                                                                                    $filename = substr($stfile_name, strpos($stfile_name, '_') + 1);
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
                                                                            <p class="mt-2"><span class="badge badge-soft-dark"><?php echo $st->stname;?></span></p>
                                                                        </h5>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
<?php
if($privilege_only_view == 'no')
{
?>                                                                            
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                            
                                                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $pid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php 
    }    
}

if($privilege_only_view == 'no')
{
?>
                                                                            <a href="<?php echo base_url().'front/download_subtaskFileAttachment/'.$stfile_name.'/'.$st->stid;?>" class="text-dark" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                                                            <a href="javascript:void(0)" onclick="return delete_subtaskfile('<?php echo $stfile_name;?>','<?php echo $st->stid;?>');" class="text-dark" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
<?php 
}
?>
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Attached Files!";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                  </p>
                              </div>
                          </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                            <div class="col-lg-4">
                                <?php
                                if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
                                {
                                ?>
                                <div class="card">
                                    <button class="btn members-button-d" style="text-align: start;font-size: 15px;font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                       <i class="mdi mdi-account-group me-1"></i> Members 
                                       <?php
                                       $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($pid);
                                       if($check_notify_project_suggested)
                                        {
                                        ?>
                                            <i class="bx bx-bell bx-tada m-2"></i>
                                        <?php
                                        }
                                       ?>
                                       <i class="mdi mdi-chevron-down h3 me-1 members-button-a" style="float:right;"></i>
                                    </button>
                                    <div class="collapse" id="collapseExample" style="">
                                    <div class="card-body">
                                        <?php
if($privilege_only_view == 'no')
{
                                        if(!empty($pdetail->gid))
                                        {
                                        ?>
                                        <h4 class="card-title">Team Members
                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#pdetail_AddMember" title="Add Team Member">
                                                    <span class="avatar-title bg-transparent text-reset">
                                                        <i class="bx bx-plus"></i>
                                                    </span>
                                            </button>
                                        </h4>
                                        <?php
                                        }
                                        else
                                        { 
                                        ?>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#team_membertab" role="tab">
                                                    <span>Team Members
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#pdetail_AddMember" title="Add Team Member">
                                                                <span class="avatar-title bg-transparent text-reset">
                                                                    <i class="bx bx-plus"></i>
                                                                </span>
                                                        </button>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#request_membertab" role="tab">
                                                    <span>Membership<br>Requested</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <?php
                                        }
}
else
{
    ?>
    <h4 class="card-title">Team Members</h4>
    <?php
}
                                        ?>
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="team_membertab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 800px;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Project Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($pdetail->pmanager != '0')
                                                    {
                                                        $pmanager_det = $this->Front_model->getStudentById($pdetail->pmanager);
                                                        if($pmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Project Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pdetail->pmanager;?>)" class="text-dark" title="View Profile"><?php echo $pmanager_det->first_name.' '.$pmanager_det->last_name;?></a> 
                                                            <?php
                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                            {
if($privilege_only_view == 'no')
{
                                                                ?>
                                                            <a href="javascript:void(0)" onclick="return direct_remove_manager('<?php echo $pdetail->pid;?>','<?php echo $pmanager_det->first_name;?>','<?php echo $pmanager_det->last_name;?>');" class="pt-2 pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3 m-1"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                            <?php
}
                                                            }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                        }
                                                    } 
                                                    ?>                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestsent-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background: #fcf0db;color: #383838;">
                                                            Request Sent To:
                                                        </button>
                                                    </h2>
                                                    <div id="requestsent-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                                        <div class="accordion-body text-muted">
                                                           <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                              <tbody>
                                                                <?php
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if(!empty($pm->status)){
                                                        if($pm->status == 'send')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                                <td>
                                                                    <div>
                                                                        <?php
if($privilege_only_view == 'no')
{
                                                                        if($pdetail->pmanager == $pm->pmember)
                                                                        {
                                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                            {
                                                                          ?>
                                                                         <a href="javascript:void(0)" onclick="return remove_manager('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php
                                                                            }   
                                                                        }

                                                                        if($pm->pmember != $this->session->userdata('d168_id'))
                                                                        {
                                                                            if($pm->pmember != $portfolio_owner_id)
                                                                            {
                                                                        ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_pMember('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark"title="Remove" ><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                        <?php
                                                                            }
                                                                        }
}
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    } 
                                                    ?>
                                                              </tbody>
                                                            </table>
                                                           </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestaccepted-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background: #d6f3e9;color: #383838;">
                                                            Request Accepted By:
                                                        </button>
                                                    </h2>
                                                    <div id="requestaccepted-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if(!empty($pm->status)){
                                                        if($pm->status == 'accepted')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                                <td>
                                                                    <div>
                                                                        <?php
if($privilege_only_view == 'no')
{
                                                                        if($pdetail->pmanager == "0")
                                                                        {
                                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                            {
                                                                         ?>
                                                                         <a href="javascript:void(0)" onclick="return assign_manager('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php  
                                                                            } 
                                                                        }
                                                                        else
                                                                        {
                                                                            if($pdetail->pmanager == $pm->pmember)
                                                                            {
                                                                                if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                              ?>
                                                                             <a href="javascript:void(0)" onclick="return remove_manager('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                             <?php  
                                                                                } 
                                                                            }
                                                                            else
                                                                            {
                                                                                if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                            {
                                                                                $exist_manager = "";
                                                                               $manager_name = $this->Front_model->getStudentById($pdetail->pmanager);
                                                                               if($manager_name) 
                                                                               {
                                                                                $exist_manager = $manager_name->first_name.' '.$manager_name->last_name;
                                                                               }
                                                                         ?>
                                                                         <a href="javascript:void(0)" onclick="return assign_manager_replace('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>','<?php echo $exist_manager;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php  
                                                                                }
                                                                            }
                                                                        }
                                                                        if($pm->pmember != $this->session->userdata('d168_id'))
                                                                        {
                                                                            if($pm->pmember != $portfolio_owner_id)
                                                                            {
                                                                        ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_pMember('<?php echo $pdetail->pid;?>','<?php echo $pm->pm_id;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                        <?php
                                                                            }
                                                                        }
}
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    } 
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#invited_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: #fde1e1;color: #383838;">
                                                            Invited Members:
                                                        </button>
                                                    </h2>
                                                    <div id="invited_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $invited_member = $this->Front_model->InvitedProjectMember($pid); 
                                                    if($invited_member)
                                                    {
                                                    foreach($invited_member as $im)
                                                    {
                                                        if(!empty($im->status)){
                                                        if($im->status == 'pending')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <i class="bx bx-user"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><?php echo $im->sent_to;?></h5></td>
                                                                <td>
                                                                    <div>
<?php
if($privilege_only_view == 'no')
{
?>

                                                                        <a href="javascript:void(0)" onclick="return delete_iMember('<?php echo $pdetail->pid;?>','<?php echo $im->im_id;?>','<?php echo $im->sent_to;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
<?php
}
?>                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    } 
                                                }
                                                else
                                                {
                                                    echo "No Data Available!";
                                                }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#suggested_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: #dde2fa;color: #383838;">
                                                            Suggested Members:
                                                            <?php
                                                           $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($pid);
                                                           if($check_notify_project_suggested)
                                                            {
                                                                if($check_notify_project_suggested->already_register == 'yes')
                                                                {
                                                            ?>
                                                                <i class="bx bx-bell bx-tada m-2"></i>
                                                            <?php
                                                                }
                                                            }
                                                           ?>
                                                        </button>
                                                    </h2>
                                                    <div id="suggested_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $suggested_member = $this->Front_model->SuggestedProjectMember($pid);
                                                    if($suggested_member){
                                                    foreach($suggested_member as $sm)
                                                    {
                                                        if(!empty($sm->status)){
                                                        if($sm->status == 'suggested')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($sm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$sm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $sm->first_name.' '.$sm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $sm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $sm->first_name." ".$sm->last_name; ?></a></h5></td>
                                                                <td>
                                                                    <div>
<?php
if($privilege_only_view == 'no')
{
?>
                                                                        <a href="javascript:void(0)" onclick="return add_SuggestedPMember('<?php echo $pdetail->pid;?>','<?php echo $sm->suggest_id;?>','<?php echo $sm->first_name;?>','<?php echo $sm->last_name;?>');" class="text-dark" id="add_SuggestedPMemberButton<?php echo $sm->suggest_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
<?php 
}
?>
                                                                    </div>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    } 
                                                }
                                                else
                                                {
                                                    echo "No Data Available!";
                                                }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#suggest_invited_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: lavenderblush;color: #383838;">
                                                            Suggested Invite Members:
                                                            <?php
                                                           $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($pid);
                                                           if($check_notify_project_suggested)
                                                            {
                                                                if($check_notify_project_suggested->already_register == 'no')
                                                                {
                                                            ?>
                                                                <i class="bx bx-bell bx-tada m-2"></i>
                                                            <?php
                                                                }
                                                            }
                                                           ?>
                                                        </button>
                                                    </h2>
                                                    <div id="suggest_invited_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $sinvited_member = $this->Front_model->SuggestedInviteProjectMember($pid); 
                                                    if($sinvited_member){
                                                    foreach($sinvited_member as $sim)
                                                    {
                                                        if(!empty($sim->status)){
                                                        if($sim->status == 'suggested')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <i class="bx bx-user"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><?php echo $sim->suggest_id;?></h5></td>
                                                                <td>
                                                                    <div>
<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a href="javascript:void(0)" onclick="return Expire_Package_popup();" class="text-dark" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_team_members = trim($getPackDetail->pack_team_members);
          $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
          $check_type = is_numeric($total_team_members);
          if($check_type == 'true')
          {
            $all_tm = $total_team_members + 1;
            if($used_team_members < $all_tm)
            {
                ?>
                <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                <?php
            }
            else
            {
                ?>
                <a href="javascript:void(0)" onclick="return limit_Exceeds_popup();" class="text-dark" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                <?php
            }
          }
          else
          {
            
            ?>
            <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_team_members = trim($getPackDetail->pack_team_members);
          $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
          $check_type = is_numeric($total_team_members);
          if($check_type == 'true')
          {
            $all_tm = $total_team_members + 1;
            if($used_team_members < $all_tm)
            {
                ?>
                <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                <?php
            }
            else
            {
                ?>
                <a href="javascript:void(0)" onclick="return limit_Exceeds_popup();" class="text-dark" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                <?php
            }
          }
          else
          {
            
            ?>
            <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
            <?php
          }
        }
    }
}
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('portfolio', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a href="javascript:void(0)" onclick="return Expire_Package_popup();" class="text-dark" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_team_members = trim($getPackDetail->pack_team_members);
              $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
              $check_type = is_numeric($total_team_members);
              if($check_type == 'true')
              {
                $all_tm = $total_team_members + 1;
                if($used_team_members < $all_tm)
                {
                    ?>
                    <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="javascript:void(0)" onclick="return limit_Exceeds_popup();" class="text-dark" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                    <?php
                }
              }
              else
              {
                
                ?>
                <a href="javascript:void(0)" onclick="return add_Suggested_IPMember('<?php echo $pdetail->pid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->s_id;?>');" class="text-dark" id="add_Suggested_IPMemberButton<?php echo $sim->s_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                <?php
              }
            }
          }
        }
      }
    }    
  }
}
?>
                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                           echo "No Data Available!"; 
                                                        }
                                                    } 
                                                }
                                                else
                                                {
                                                    echo "No Data Available!";
                                                }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                      </div>
                                     </p>
                                  </div>
                                  <div class="tab-pane" id="request_membertab" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 300px;">
<?php
if($privilege_only_view == 'no')
{
?>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr class="table-primary">
                                                        <th colspan="3">Membership Requested:</th>
                                                    </tr>
                                                    <?php
                                                    $RequestAsProjectMember = $this->Front_model->RequestAsProjectMember($pid);
                                                    if($RequestAsProjectMember)
                                                    {
                                                    foreach($RequestAsProjectMember as $rpm)
                                                    {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($rpm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$rpm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $rpm->first_name.' '.$rpm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $rpm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $rpm->first_name." ".$rpm->last_name; ?></a></h5></td>
                                                                <td>
                                                                <?php
                                                                if($rpm->mode == "sent_req")
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return sentReq_to_RequestedPMember('<?php echo $pdetail->pid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedPMemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                                                                </div>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return add_RequestedPMember('<?php echo $pdetail->pid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedPMemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>                        
                                                                </td>
                                                            </tr>                                                            
                                                            <?php
                                                    }
                                                    } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
<?php
}
?> 
                                      </div>
                                                </p>
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
                                <div class="card">
                                    <button class="btn members-button-d" style="text-align: start;font-size: 15px;font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                       <i class="mdi mdi-account-group me-1"></i> Members <i class="mdi mdi-chevron-down h3 me-1 members-button-a" style="float:right;"></i>
                                    </button>
                                    <div class="collapse" id="collapseExample" style="">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Team Members
<?php
if($privilege_only_view == 'no')
{
?>
                                            <button type="button" class="btn btn-sm btn-light btn-rounded waves-effect" data-bs-toggle="modal" data-bs-target="#pdetail_SuggestTMember" title="Suggest Team Member"><i class="bx bx-plus"></i> Suggest Member</button>
<?php 
}
?>
                                        </h4>
                                      <div data-simplebar style="max-height: 800px;"> 
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Project Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($pdetail->pmanager != '0')
                                                    {
                                                        $pmanager_det = $this->Front_model->getStudentById($pdetail->pmanager);
                                                        if($pmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Project Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pdetail->pmanager;?>)" class="text-dark" title="View Profile"><?php echo $pmanager_det->first_name.' '.$pmanager_det->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                        }
                                                    } 
                                                    ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestsent-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background: #fcf0db;color: #383838;">
                                                            Request Sent To:
                                                        </button>
                                                    </h2>
                                                    <div id="requestsent-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                                        <div class="accordion-body text-muted">
                                                           <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                              <tbody>
                                                                <?php
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if($pm->status){
                                                        if($pm->status == 'send')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Available Data!";
                                                        }
                                                    } 
                                                }
                                                else
                                                {
                                                    echo "No Data Available!";
                                                }
                                                    ?>
                                                              </tbody>
                                                            </table>
                                                           </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestaccepted-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background: #d6f3e9;color: #383838;">
                                                            Request Accepted By:
                                                        </button>
                                                    </h2>
                                                    <div id="requestaccepted-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if(!empty($pm->status)){
                                                        if($pm->status == 'accepted')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle btn-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    } 
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#invited_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: #fde1e1;color: #383838;">
                                                            Invited Members:
                                                        </button>
                                                    </h2>
                                                    <div id="invited_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $invited_member = $this->Front_model->InvitedProjectMember($pid); 
                                                    if($invited_member){
                                                    foreach($invited_member as $im)
                                                    {
                                                        if(!empty($im->status)){
                                                        if($im->status == 'pending')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <i class="bx bx-user"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><?php echo $im->sent_to;?></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    } 
                                                }
                                                else
                                                {
                                                    echo "No Data Available!";
                                                }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#suggested_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: #dde2fa;color: #383838;">
                                                            Suggested Members:
                                                        </button>
                                                    </h2>
                                                    <div id="suggested_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $suggested_member = $this->Front_model->SuggestedProjectMember($pid);
                                                    if($suggested_member){
                                                    foreach($suggested_member as $sm)
                                                    {
                                                        if(!empty($sm->status)){
                                                        if($sm->status == 'suggested')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($sm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$sm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $sm->first_name.' '.$sm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $sm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $sm->first_name." ".$sm->last_name; ?></a></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available";
                                                        }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available";
                                                    } 
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#suggest_invited_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: lavenderblush;color: #383838;">
                                                            Suggested Invite Members:
                                                        </button>
                                                    </h2>
                                                    <div id="suggest_invited_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $sinvited_member = $this->Front_model->SuggestedInviteProjectMember($pid); 
                                                    if($sinvited_member){
                                                    foreach($sinvited_member as $sim)
                                                    {
                                                        if(!empty($sim->status)){
                                                        if($sim->status == 'suggested')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <i class="bx bx-user"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><?php echo $sim->suggest_id;?></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                        else
                                                        {
                                                            echo "No Data Available!";
                                                        }
                                                    } 
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <?php
                        }
                        ?>

                        <div class="card">
                                    <div class="card-body">
<!-- Start Comment section -->
<h4 class="card-title">Comment Section</h4>
<div class="w-100 user-chat">
    <div class="card">        
        <div id="scrollbottom" class="chat-conversation p-2">
            <ul class="list-unstyled mb-0 append_new_msg" data-simplebar style="max-height: 400px;">
                <?php 
                $MentionListforAccepted = $this->Front_model->MentionListforAccepted($pid);
                //print_r($MentionListforAccepted);
                $ownerMention[]['name'] = $powner->first_name.' '.$powner->last_name;
                //print_r($ownerMention);
                $newMention = array_merge($MentionListforAccepted,$ownerMention);
                //print_r($newMention);
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
                                    <div class="conversation-name">
                                    <?php
                                    if(($cm->task_id != '0') && ($cm->subtask_id == '0') && ($cm->delete_msg != 'yes'))
                                    {
                                        $getTcode = $this->Front_model->getTasksbyID($cm->task_id);
                                        if($getTcode)
                                        {
                                        ?>
                                            <a href="<?php echo base_url('tasks-overview/'.$cm->task_id);?>" class="me-4" style="float: left;"><?php echo $getTcode->tcode;?></a> 
                                        <?php  
                                        }                                        
                                    }
                                    elseif(($cm->subtask_id != '0') && ($cm->delete_msg != 'yes'))
                                    {
                                        $getSTcode = $this->Front_model->getSubtasksbyID($cm->subtask_id);
                                        if($getSTcode)
                                        {
                                        ?>
                                            <a href="<?php echo base_url('subtasks-overview/'.$cm->subtask_id);?>" class="me-4" style="float: left;"><?php echo $getSTcode->stcode;?></a> 
                                        <?php  
                                        } 
                                    }
                                    ?>  
                                    Me</div>
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
                                    <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?> 
                                <?php
                                if(($cm->task_id != '0') && ($cm->subtask_id == '0') && ($cm->delete_msg != 'yes'))
                                {
                                    $getTcode = $this->Front_model->getTasksbyID($cm->task_id);
                                    if($getTcode)
                                    {
                                    ?>
                                        <a href="<?php echo base_url('tasks-overview/'.$cm->task_id);?>" class="ms-4" style="float: right;"><?php echo $getTcode->tcode;?></a> 
                                    <?php  
                                    }                                        
                                }
                                elseif(($cm->subtask_id != '0') && ($cm->delete_msg != 'yes'))
                                {
                                    $getSTcode = $this->Front_model->getSubtasksbyID($cm->subtask_id);
                                    if($getSTcode)
                                    {
                                    ?>
                                        <a href="<?php echo base_url('subtasks-overview/'.$cm->subtask_id);?>" class="ms-4" style="float: right;"><?php echo $getSTcode->stcode;?></a> 
                                    <?php  
                                    } 
                                }
                                ?>
                                </div>
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
                    <div class="col">
                        <div class="position-relative">
                            <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                            <span id="messageErr" class="text-danger"></span>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $this->uri->segment(2); ?>">
                            <input type="hidden" name="tid" id="tid" value="0">
                            <input type="hidden" name="stid" id="stid" value="0">
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
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <?php
                        if($view_history_date)
                        {
                        ?>
                        <div class="card">
                            <div class="card-body" data-simplebar style="max-height: 500px;">
                                <h4 class="card-title mb-5">History</h4>
                                <ul class="verti-timeline list-unstyled">
                                    <?php
                                    $prev_date ='';
                                    foreach($view_history_date as $v)
                                    {
                                        $h_date = date("Y-m-d", strtotime($v->DateOnly));
                                        if($h_date == $prev_date)
                                        {
                                        }
                                        elseif ($h_date == date("Y-m-d")) 
                                        {
                                    ?>
                                    <li class="event-list active" style="padding-bottom: 25px;">
                                        <div class="event-timeline-dot">
                                            <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_pro_hlist('<?php echo $pid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Today - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                        elseif ($h_date == date('Y-m-d',strtotime("-1 days"))) 
                                        {
                                    ?>
                                    <li class="event-list active" style="padding-bottom: 25px;">
                                        <div class="event-timeline-dot">
                                            <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_pro_hlist('<?php echo $pid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Yesterday - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                    <li class="event-list active" style="padding-bottom: 25px;">
                                        <div class="event-timeline-dot">
                                            <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_pro_hlist('<?php echo $pid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                        ?>                                                
                                    <div class="clear_list" id="hlist<?php echo $v->DateOnly;?>"></div>
                                        <?php                                            
                                        $prev_date = $h_date;
                                    }
                                    ?>  
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<?php 
if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
{
?>
<!-- Add Team Member Modal -->
<div class="modal fade" id="pdetail_AddMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="pdetail_AddTeamMemberForm" id="pdetail_AddTeamMemberForm" method="post">
                <div class="modal-body">
                    <?php 
                    if(!empty($pdetail->gid))
                    {
                    ?>
                    <div class="row mb-2">
                        <div class="col-lg">
                            <?php
                            $pid = $pdetail->pid;
                            $porttm = $this->Front_model->GoalTeamMemberAccepted($pdetail->gid);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->getStudentById($ptm->gmember);
                                    if($m)
                                    {
                                    $check_pm = $this->Front_model->check_pm($m->reg_id,$pdetail->pid,$pdetail->portfolio_id);
                                    $check_pmem = "";
                                    if($check_pm)
                                    {
                                        $check_pmem = $check_pm->pmember;
                                    }
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pmem))
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
                            <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                        </div>                        
                    </div>
                    <span id="err_valid" class="text-danger"></span>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="row mb-2">
                        <div class="col-lg">
                            <?php
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
                                    $check_pmem = "";
                                    if($check_pm)
                                    {
                                        $check_pmem = $check_pm->pmember;
                                    }
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pmem))
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
                            <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                        </div>
<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <div class="col-lg-5">
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-d text-white">Invite More Member</a>
        </div>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_team_members = trim($getPackDetail->pack_team_members);
          $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
          $check_type = is_numeric($total_team_members);
          if($check_type == 'true')
          {
            $all_tm = $total_team_members + 1;
            if($used_team_members < $all_tm)
            {
                ?>
                <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="<?php echo $total_team_members;?>">
                <div class="col-lg-5">
                    <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="col-lg-5">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-d text-white">Invite More Member</a>
                </div>
                <?php
            }
          }
          else
          {
            
            ?>
            <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="">
            <div class="col-lg-5">
                <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
            </div>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_team_members = trim($getPackDetail->pack_team_members);
          $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
          $check_type = is_numeric($total_team_members);
          if($check_type == 'true')
          {
            $all_tm = $total_team_members + 1;
            if($used_team_members < $all_tm)
            {
                ?>
                <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="<?php echo $total_team_members;?>">
                <div class="col-lg-5">
                    <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="col-lg-5">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-d text-white">Invite More Member</a>
                </div>
                <?php
            }
          }
          else
          {
            
            ?>
            <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="">
            <div class="col-lg-5">
                <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
            </div>
            <?php
          }
        }
    }
}
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('portfolio', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <div class="col-lg-5">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-d text-white">Invite More Member</a>
            </div>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getPortfolioMemberCount = $this->Front_model->getPortfolioMemberCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_team_members = trim($getPackDetail->pack_team_members);
              $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
              $check_type = is_numeric($total_team_members);
              if($check_type == 'true')
              {
                $all_tm = $total_team_members + 1;
                if($used_team_members < $all_tm)
                {
                    ?>
                    <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="<?php echo $total_team_members;?>">
                    <div class="col-lg-5">
                        <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-lg-5">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-d text-white">Invite More Member</a>
                    </div>
                    <?php
                }
              }
              else
              {
                
                ?>
                <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="">
                <div class="col-lg-5">
                    <button type="button" class="add_dup_member btn btn-d text-white">Invite More Member</button>
                </div>
                <?php
              }
            }
          }
        }
      }
    }    
  }
}
?>
                        
                    </div>
                    <div class="imember_div">
                    </div>
                    <span id="err_valid" class="text-danger"></span>
                    <?php
                    }
                    ?>
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
<?php
}
else
{
?>
<!-- Suggest Team Member Modal -->
<div class="modal fade" id="pdetail_SuggestTMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Suggest Team Members To Project Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="pdetail_SuggestTMemberForm" id="pdetail_SuggestTMemberForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-7">
                            <?php
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
                                    $check_pmem = "";
                                    if($check_pm)
                                    {
                                        $check_pmem = $check_pm->pmember;
                                    }
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pmem))
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
                            <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                        </div>
                        <div class="col-lg-5">
                            <button type="button" class="add_dup_ismember btn btn-d text-white">Suggest More Member</button>
                        </div>
                    </div>
                    <div class="ismember_div">
                    </div>
                    <span id="ismemberErr" class="text-danger"></span>
                    <span id="err_valid" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="pdetail_SuggestTMemberButton" class="btn btn-d">Suggest</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  
<?php
}
?>


                                    <!-- Preview file modal content -->
                                    <div id="previewModalFullscreen" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewModalFullscreenLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="previewModalFullscreen_content">
                                                
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
<!-- MODAL START PREVIEW PLATFORM -->
<div class="modal fade preview-platform" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row platform-card twitter-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="twitter-content"></div>
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselTwitterIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators twitter-images-ol">
                                    </ol>
                                    <div class="carousel-inner twitter-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselTwitterIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselTwitterIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="twitter-icon-card">
                            <div class="twitter-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-comment-outline"></i> &nbsp; 0
                            </div>
                            <div class="twitter-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-twitter-retweet"></i> &nbsp; 0
                            </div>
                            <div class="twitter-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-heart-outline"></i> &nbsp; 0
                            </div>
                            <div class="twitter-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-export-variant"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row platform-card facebook-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="facebook-content"></div>
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselFBIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators facebook-images-ol">
                                    </ol>
                                    <div class="carousel-inner facebook-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselFBIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselFBIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="facebook-icon-card">
                            <div class="facebook-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-thumb-up-outline"></i> Like
                            </div>
                            <div class="facebook-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-chat-processing-outline"></i> Comment
                            </div>
                            <div class="facebook-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-share"></i> Share
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row platform-card instagram-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselInstaIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators instagram-images-ol">
                                    </ol>
                                    <div class="carousel-inner instagram-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselInstaIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselInstaIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="instagram-icon-card">
                            <div class="instagram-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-heart-outline"></i>
                            </div>
                            <div class="instagram-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-chat-outline"></i>
                            </div>
                            <div class="instagram-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-send"></i>
                            </div>
                        </div>
                            <div class="instagram-icon text-center float-end">
                                <i aria-hidden="true" class="mdi mdi-bookmark-outline"></i>
                            </div>
                        <div class="instagram-content"></div>
                    </div>
                </div>
                <div class="row platform-card linkedin-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="linkedin-content"></div>
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselLIIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators linkedin-images-ol">
                                    </ol>
                                    <div class="carousel-inner linkedin-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselLIIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselLIIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="linkedin-icon-card">
                            <div class="linkedin-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-thumb-up-outline"></i> Like
                            </div>
                            <div class="linkedin-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-chat-processing-outline"></i> Comment
                            </div>
                            <div class="linkedin-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-share"></i> Share
                            </div>
                            <div class="linkedin-icon text-center">
                                <i aria-hidden="true" class="mdi mdi-send"></i> Send
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row platform-card google-my-business-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselGMBIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators google-my-business-images-ol">
                                    </ol>
                                    <div class="carousel-inner google-my-business-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselGMBIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselGMBIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="google-my-business-content"></div>
                        <div class="google-my-business-icon-card">
                            <div class="google-my-business-icon text-center">
                                CTA
                            </div>
                        </div>
                        <div class="text-center float-end" style="font-size: 18px;">
                            <i aria-hidden="true" class="mdi mdi-share-variant"></i>
                        </div>
                    </div>
                </div>
                <div class="row platform-card pinterest-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselPinterestIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators pinterest-images-ol">
                                    </ol>
                                    <div class="carousel-inner pinterest-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselPinterestIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselPinterestIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="pinterest-title"></div>
                        <div class="pinterest-content-1"></div>
                        <div class="pinterest-content-2"></div>
                    </div>
                </div>
                <div class="row platform-card youtube-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselYTIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators youtube-images-ol">
                                    </ol>
                                    <div class="carousel-inner youtube-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselYTIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselYTIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="youtube-pc_title"></div>
                        <div class="youtube-content"></div>
                    </div>
                </div>
                <div class="row platform-card blogger-card" style="display: none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselBlogIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators blogger-images-ol">
                                    </ol>
                                    <div class="carousel-inner blogger-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselBlogIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselBlogIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="blogger-title"></div>
                        <div class="blogger-content"></div>
                    </div>
                </div>
                <div class="row platform-card tiktok-card" style="display: none;">
                    <div class="col-md-12">                        
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div id="carouselTiktokIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators tiktok-images-ol">
                                    </ol>
                                    <div class="carousel-inner tiktok-images" role="listbox">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselTiktokIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselTiktokIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tiktok-content"></div>
                    </div>
                </div>
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- MODAL END PREVIEW PLATFORM -->


<!--  Extra Large modal example -->
<div class="modal fade add-new-content" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" name="create_content_form" id="create_content_form" enctype="multipart/form-data" autocomplete="off">
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer plan-content-wrapper accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item" id="plan-content-1">
                          <h2 class="accordion-header" id="flush-heading-1">
                            <button class="accordion-button fw-medium font-weight-semibold platform-button-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-1" aria-expanded="true" aria-controls="flush-collapse-1">
                                Platform 1
                            </button>
                          </h2>
                          <div id="flush-collapse-1" class="row accordion-collapse collapse show accordion-body" aria-labelledby="flush-heading-1" data-bs-parent="#accordionFlushExample">
                          <div class="col-md-6">                          
                            <div class="form-group mb-2 platform">
                                <label for="platform" class="col-form-label">Select Platform <span class="text-danger">*</span></label>
                                <div class="platform-section">
                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="twitter" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-twitter font-size-24" title="Twitter"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="facebook" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-facebook font-size-24" title="Facebook"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="instagram" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-instagram font-size-24" title="Instagram"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="linkedin" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-linkedin font-size-24" title="LinkedIn"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="google-my-business" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="mdi mdi-google-my-business font-size-24" title="Google My Business"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="pinterest" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-pinterest font-size-24" title="Pinterest"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="youtube" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-youtube font-size-24" title="YouTube"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="blogger" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-blogger font-size-24" title="Blog"></i></label>

                                    <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="tiktok" class="InputPlatformCP1" id="platform" name="platform1">
                                    <i class="fab fa-tiktok font-size-24" title="TikTok"></i> </label>
                                </div>
                                <span id="platformErr" class="text-danger"></span>
                            </div>  
                            <div class="form-group mb-2 youtube-title" style="display:none;">
                                <label for="pc_title" class="col-form-label pc_title_label">Title </label>
                                <input onkeyup="return onTitleChange(this.value,1);" id="pc_title" name="pc_title1" type="text" class="form-control youtube-field" placeholder="Enter Title"  maxlength="100">
                                <span style="display: none;" class="text-danger title-span"></span>
                                <span id="pc_titleErr" class="text-danger"></span>
                            </div> 

                            <div class="form-group mb-2 written_content">
                                <label for="written_content" class="col-form-label written_content_label">Written Content </label>
                                <textarea onkeyup="return onWrittenContentChange(this.value,1);" class="form-control" id="written_content" name="written_content1" rows="5" placeholder="Enter Written Content" maxlength="5000"></textarea>
                                <span style="display:none;" class="text-danger written-content-span"></span>
                                <span id="written_contentErr" class="text-danger"></span>
                            </div>  

                            <div class="form-group mb-2 written-content-2" style="display:none;">
                                <label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label>
                                <textarea onkeyup="return onWrittenContent2Change(this.value,1);" class="form-control" id="written_content_2" name="written_content_21" maxlength="500" rows="5" placeholder="Enter Written Content 2"></textarea>
                                <span style="display:none;" class="text-danger written-content-2-span"></span>
                                <span id="written_content_2Err" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="target_audience" class="col-form-label target_audience_label">Target Audience</label>
                                <input id="target_audience" name="target_audience1" type="text" class="form-control blog-field" placeholder="Enter Target Audience">
                                <span style="display: none;" class="text-danger target_audience-span"></span>
                                <span id="target_audienceErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="solutions" class="col-form-label solutions_label">Solutions</label>
                                <input id="solutions" name="solutions1" type="text" class="form-control blog-field" placeholder="Enter Solutions">
                                <span style="display: none;" class="text-danger solutions-span"></span>
                                <span id="solutionsErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="keywords" class="col-form-label keywords_label">Keywords</label>
                                <input id="keywords" name="keywords1" type="text" class="form-control blog-field" placeholder="Enter Keywords">
                                <span style="display: none;" class="text-danger keywords-span"></span>
                                <span id="keywordsErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="internal_links" class="col-form-label internal_links_label">Internal Links</label>
                                <input id="internal_links" name="internal_links1" type="text" class="form-control blog-field" placeholder="Enter Internal Links">
                                <span style="display: none;" class="text-danger internal_links-span"></span>
                                <span id="internal_linksErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="external_links" class="col-form-label external_links_label">External Links</label>
                                <input id="external_links" name="external_links1" type="text" class="form-control blog-field" placeholder="Enter External Links">
                                <span style="display: none;" class="text-danger external_links-span"></span>
                                <span id="external_linksErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="meta_title" class="col-form-label meta_title_label">Meta title</label>
                                <input id="meta_title" name="meta_title1" type="text" class="form-control blog-field" placeholder="Enter Meta title">
                                <span style="display: none;" class="text-danger meta_title-span"></span>
                                <span id="meta_titleErr" class="text-danger"></span>
                            </div>  

                            <div class="form-group mb-2 blog-field-div" style="display:none;">
                                <label for="meta_description" class="col-form-label meta_description_label">Meta Description</label>
                                <textarea id="meta_description" name="meta_description1" class="form-control blog-field" rows="5" maxlength="5000" placeholder="Enter Meta Description"></textarea>
                                <span style="display: none;" class="text-danger meta_description-span"></span>
                                <span id="meta_descriptionErr" class="text-danger"></span>
                            </div>   

                            <div class="form-group mb-2 tags" style="display:none;">
                                
                                <label for="tags" class="col-form-label tags_label">Tags</label>
                                <textarea class="form-control" maxlength="400" id="tags" name="tags1" rows="5" placeholder="Add Tag"></textarea>
                                <span style="display:none;" class="text-danger tags-span"></span>
                                <span id="tagsErr" class="text-danger"></span>
                            </div> 

                            <div class="form-group mb-2 pc_file">
                                <label class="col-form-label pc_file_label">Attach Media </label>
                                <input type="hidden" name="total_content[]" id="total_content" value="1">
                                <input class="form-control limitInputCPFiles" name="pc_file1[]" id="pc_file" type="file" accept="video/*,image/*" multiple="" data-id="1"  />
                                <span id="limitInputCPFilesErr1" class="text-danger"></span>
                                <span id="pc_fileErr1" class="text-danger"></span>                               
                            </div> 
                            <div class="form-group mb-2 blog-field-div" style="display: none;">
                                <label class="col-form-label pc_file_label">Attach Documents </label>
                                <input class="form-control blog-field" name="doc_pc_file1[]" id="doc_pc_file" type="file" multiple="" data-id="1" />
                                <span id="doc_pc_file1Err" class="text-danger"></span>
                            </div> 
                            <!-- <div class="mb-2 form-group">
                                <label class="col-form-label" for="tname">Publish Date <span class="text-danger">*</span></label>
                                <div class="input-group" id="datepicker1">
                                    <input id="pub_date1" name="pub_date1" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker1" data-date-format="yyyy-m-d" data-provide="datepicker" required=""
                                    />
                                </div>
                                <span class="text-danger" id="pub_date1Err"></span>
                            </div>  -->                                            
                          </div>                                                  
                          <div class="col-md-6" style="margin-top: 90px;">                                                   
                            <?php
                            if(!empty($this->uri->segment(2)))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));
                                ?>
                                <div class="form-group mb-2">
                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                
                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee"  style="line-height: 1.5;">
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
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
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
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
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="written_content_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                
                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee"  style="line-height: 1.5;">
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="written_content_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($this->uri->segment(2)))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));
                                ?>
                                <div class="form-group mb-2">
                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                
                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee"  style="line-height: 1.5;">
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
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
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
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
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="pc_file_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                
                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee"  style="line-height: 1.5;">
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="pc_file_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($this->uri->segment(2)))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));
                                ?>
                                <div class="form-group mb-2">
                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                
                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval"  style="line-height: 1.5;">
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
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
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
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
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="submit_to_approvalErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                
                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval"  style="line-height: 1.5;">
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="submit_to_approvalErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($this->uri->segment(2)))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));
                                ?>
                                <div class="form-group mb-2">
                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>
                                
                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee"  style="line-height: 1.5;">
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
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
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
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
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                        <option value=""><span>None</span></option>
                                    </select> 
                                    <span id="pc_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label>                                
                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee"  style="line-height: 1.5;">
                                        <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                        <option value=""><span>None</span></option>
                                    </select> 
                                <span id="pc_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>
                          </div>
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label>
                                <div class="col-lg-5">
                                    <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link">
                                    <span id="pc_linkErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-5">
                                    <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment">
                                    <span id="pc_link_commentErr" class="text-danger"></span>
                                </div>
<?php
if($privilege_only_view == 'no')
{
?>
                                <div class="col-lg-2">
                                    <button type="button" class="add_dup_pc_link1 btn btn-d btn-sm">Add Another link</button>                        
                                </div>
<?php 
}
?>
                            </div>
                            <div class="pc_link_div1">
                            </div>
                            <span id="link_validErr1" class="text-danger"></span>                    
                        </div> 
                        </div>                                                        
                        </div><br>
                        <button type="button" id="add_more_plan_content" class="btn btn-d btn-sm">Add More Content</button>
                        <div class="row float-end mb-5"><div class="justify-content-end float-end">
                            <?php
                            if(!empty($this->uri->segment(2)))
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $this->uri->segment(2);?>">
                                <?php
                            }
                            else
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid">
                                <?php
                            }
                            ?>
                            <button type="submit" id="create_content_button" class="btn btn-d btn-sm">Create Content</button>
                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                            <a class="btn btn-sm bg-d text-white" data-bs-dismiss="modal" href="#">
                                Cancel 
                            </a>
                        </div></div>                     
                        
                    </div>                                    
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
          
                <?php
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

<!-- Preview content planner file modal content -->
<div id="previewContentModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="previewContentModal_Content">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Preview content planner document modal content -->
<div id="previewContentDocModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewContentDocModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="previewContentDocModal_Content">
            
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
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>
<script type="text/javascript">
$('.limitCPFiles').change(function() {
  
    var id = $(this).attr('data-id');
    var platform = $('.PlatformCP'+id).val();
    var get_old_cpfile = $('#limitCPOldFiles'+id).val();
    if(get_old_cpfile == null)
    {
        var old_cpfile = 0;
    }
    else
    {
        var old_cpfile = get_old_cpfile;
    }
    var new_cpfile = this.files.length;
    var total_cpfile = parseInt(old_cpfile) + parseInt(new_cpfile);
    //console.log(total_cpfile);
    //console.log('.PlatformCP'+id);
    if(platform == 'twitter')
    {
      if (total_cpfile > 4)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    } 
    if(platform == 'facebook')
    {
      if (total_cpfile > 6)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    } 
    if(platform == 'instagram')
    {
      if (total_cpfile > 10)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'linkedin')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'google-my-business')
    {
      if (total_cpfile > 10)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'pinterest')
    {
      if (total_cpfile > 5)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'youtube')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'blogger')
    {
      if (total_cpfile > 4)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'tiktok')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    } 
  });
$('.limitInputCPFiles').change(function() {
  
    var id = $(this).attr('data-id');
    var platform = $('.InputPlatformCP'+id+':checked').val();
    if(platform == 'twitter')
    {
      if (this.files.length > 4)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    } 
    if(platform == 'facebook')
    {
      if (this.files.length > 6)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'instagram')
    {
      if (this.files.length > 10)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'linkedin')
    {
      if (this.files.length > 1)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'google-my-business')
    {
      if (this.files.length > 10)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'pinterest')
    {
      if (this.files.length > 5)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'youtube')
    {
      if (this.files.length > 1)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'blogger')
    {
      if (this.files.length > 4)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }
    if(platform == 'tiktok')
    {
      if (this.files.length > 1)
      {
        $('#limitInputCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitInputCPFilesErr'+id).html('');
      }
    }    
  });
$(document).ready(function(){
   var add_dup_member = $('.add_dup_member'); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var pass_totalTM = $('#pass_totalTM').val();
   var memberHTML = '<div class="row mb-2"><div class="col-lg-7"><input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-5 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   var a = 2;
   
   //Once add button is clicked
   $(add_dup_member).click(function(){
    if(pass_totalTM != "")
    {
        if(a < pass_totalTM)
          {
               $(imember_div).append(memberHTML);
               a++;
          }
    }
    else
    {
        $(imember_div).append(memberHTML);
    }
    
   });

   $(imember_div).on('click', '.add_dup_member2', function(e){
      //debugger;
      if(pass_totalTM != "")
        {
            if(a < pass_totalTM)
              {
                   $(imember_div).append(memberHTML);
                   a++;
              }
        }
        else
        {
            $(imember_div).append(memberHTML);
        }
   });
   
   //Once remove button is clicked
   $(imember_div).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       if(pass_totalTM != "")
        {
           a--;
        }
       x--; //Decrement field counter
   });

});

$(document).ready(function(){
   var add_dup_ismember = $('.add_dup_ismember'); //Add button selector
   var ismember_div = $('.ismember_div'); //Input field wrapper
   var memberHTML = '<div class="row mb-2"><div class="col-lg-7"><input type="email" id="ismemail" name="ismemail[]" class="form-control" placeholder="Enter Email ID to Suggest Invite Member..."><span id="ismemailErr" class="text-danger"></span></div><div class="col-lg-5 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_ismember2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_imember" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
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
</script>
<script type="text/javascript">
$(document).ready(function(){
//
    var add_dup_pc_link12 = $('.add_dup_pc_link12'); //Add button selector
    var pc_link_div12 = $('.pc_link_div12'); //Input field wrapper
    var pc_linkHTML12 = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-4"><input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-4"><input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-4 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec12" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link12" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
    var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
    $(add_dup_pc_link12).click(function(){
        $(pc_link_div12).append(pc_linkHTML12); //Add field html
    });
   
    $(pc_link_div12).on('click', '.add_dup_pc_link_sec12', function(e){
        $(pc_link_div12).append(pc_linkHTML12); 
    });

   //Once remove button is clicked
    $(pc_link_div12).on('click', '.remove_dup_pc_link12', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
    });
});
$(document).ready(function(){
    var add_dup_pc_link1 = $('.add_dup_pc_link1'); //Add button selector
    var pc_link_div1 = $('.pc_link_div1'); //Input field wrapper
    var pc_linkHTML1 = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec1" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link1" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
    var a = 1; //Initial field counter is 1
   
    //Once add button is clicked
    $(add_dup_pc_link1).click(function(){
        $(pc_link_div1).append(pc_linkHTML1); //Add field html
    });
   
    $(pc_link_div1).on('click', '.add_dup_pc_link_sec1', function(e){
        $(pc_link_div1).append(pc_linkHTML1); 
    });

    //Once remove button is clicked
    $(pc_link_div1).on('click', '.remove_dup_pc_link1', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
    });

    $('#add_more_plan_content').on('click',function(event){
        var plan_content_wrapper = $('.plan-content-wrapper');
        var plan_content_id = plan_content_wrapper.children().last().attr('id');
        var plan_content_array = plan_content_id.split("-");
        var current_plan_id = plan_content_array[2];
        $('#flush-heading-'+current_plan_id).find('.platform-button-'+current_plan_id).addClass('collapsed');
        $('#flush-heading-'+current_plan_id).find('.platform-button-'+current_plan_id).attr('aria-expanded',false);
        $('#flush-collapse-'+current_plan_id).removeClass('show');
        var plan_id = parseInt(current_plan_id)+1;
        var plan_wrapperHTML = '<div class="accordion-item" id="plan-content-'+plan_id+'"><h2 class="accordion-header" id="flush-heading-'+plan_id+'"><button class="accordion-button fw-medium font-weight-semibold platform-button-'+plan_id+'" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-'+plan_id+'" aria-expanded="true" aria-controls="flush-collapse-'+plan_id+'">Platform '+plan_id+'</button></h2><div id="flush-collapse-'+plan_id+'" class="row accordion-collapse collapse show accordion-body" aria-labelledby="flush-heading-'+plan_id+'" data-bs-parent="#accordionFlushExample"><div class="col-md-6"><div class="form-group mb-2 platform"><label for="platform" class="col-form-label">Select Platform <span class="text-danger">*</span></label><div class="platform-section"><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="twitter" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-twitter font-size-24" title="Twitter"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="facebook" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-facebook font-size-24" title="Facebook"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="instagram" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-instagram font-size-24" title="Instagram"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="linkedin" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-linkedin font-size-24" title="LinkedIn"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="google-my-business" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="mdi mdi-google-my-business font-size-24" title="Google My Business"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="pinterest" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-pinterest font-size-24" title="Pinterest"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="youtube" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-youtube font-size-24" title="YouTube"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="blogger" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-blogger font-size-24" title="Blog"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="tiktok" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-tiktok font-size-24" title="TikTok"></i> </label></div><span id="platformErr" class="text-danger"></span></div><div class="form-group mb-2 youtube-title" style="display:none;"><label for="pc_title" class="col-form-label pc_title_label">Title </label><input onkeyup="return onTitleChange(this.value,'+plan_id+');" id="pc_title" name="pc_title'+plan_id+'" type="text" class="form-control youtube-field" placeholder="Enter Title" maxlength="100"><span style="display: none;" class="text-danger title-span"></span><span id="pc_titleErr" class="text-danger"></span></div><div class="form-group mb-2 written_content"><label for="written_content" class="col-form-label written_content_label">Written Content </label><textarea onkeyup="return onWrittenContentChange(this.value,'+plan_id+');" class="form-control" id="written_content" name="written_content'+plan_id+'" rows="5" placeholder="Enter Written Content" maxlength="5000"></textarea><span style="display:none;" class="text-danger written-content-span"></span><span id="written_contentErr" class="text-danger"></span></div><div class="form-group mb-2 written-content-2" style="display:none;"><label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label><textarea onkeyup="return onWrittenContent2Change(this.value,'+plan_id+');" class="form-control" id="written_content_2" name="written_content_2'+plan_id+'" rows="5" placeholder="Enter Written Content 2" maxlength="500"></textarea><span style="display:none;" class="text-danger written-content-2-span"></span><span id="written_content_2Err" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="target_audience" class="col-form-label target_audience_label">Target Audience</label><input id="target_audience" name="target_audience'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Target Audience"><span style="display: none;" class="text-danger target_audience-span"></span><span id="target_audienceErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="solutions" class="col-form-label solutions_label">Solutions</label><input id="solutions" name="solutions'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Solutions"><span style="display: none;" class="text-danger solutions-span"></span><span id="solutionsErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="keywords" class="col-form-label keywords_label">Keywords</label><input id="keywords" name="keywords'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Keywords"><span style="display: none;" class="text-danger keywords-span"></span><span id="keywordsErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="internal_links" class="col-form-label internal_links_label">Internal Links</label><input id="internal_links" name="internal_links'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Internal Links"><span style="display: none;" class="text-danger internal_links-span"></span><span id="internal_linksErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="external_links" class="col-form-label external_links_label">External Links</label><input id="external_links" name="external_links'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter External Links"><span style="display: none;" class="text-danger external_links-span"></span><span id="external_linksErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="meta_title" class="col-form-label meta_title_label">Meta title</label><input id="meta_title" name="meta_title'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Meta title"><span style="display: none;" class="text-danger meta_title-span"></span><span id="meta_titleErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="meta_description" class="col-form-label meta_description_label">Meta Description</label><textarea id="meta_description" name="meta_description'+plan_id+'" class="form-control blog-field" rows="5" placeholder="Enter Meta Description" maxlength="5000"></textarea><span style="display: none;" class="text-danger meta_description-span"></span><span id="meta_descriptionErr" class="text-danger"></span></div><div class="form-group mb-2 tags" style="display:none;"><label for="tags" class="col-form-label tags_label">Tags</label><textarea class="form-control" id="tags" name="tags'+plan_id+'" rows="5" placeholder="Add Tag" maxlength="400"></textarea><span style="display:none;" class="text-danger tags-span"></span><span id="tagsErr" class="text-danger"></span></div><div class="form-group mb-2 pc_file"><label class="col-form-label pc_file_label">Attach Media </label><input type="hidden" name="total_content[]" id="total_content" value="'+plan_id+'"><input class="form-control limitInputCPFiles'+plan_id+'" name="pc_file'+plan_id+'[]" id="pc_file" type="file" accept="video/*,image/*" multiple="" /><span id="limitInputCPFilesErr'+plan_id+'" class="text-danger"></span><span id="pc_file'+plan_id+'Err" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display: none;"><label class="col-form-label pc_file_label">Attach Documents </label><input class="form-control blog-field" name="doc_pc_file'+plan_id+'[]" id="doc_pc_file" type="file" multiple="" /><span id="doc_pc_file'+plan_id+'Err" class="text-danger"></span></div></div><div class="col-md-6" style="margin-top: 90px;"><?php if(!empty($this->uri->segment(2))){$projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));?><div class="form-group mb-2"><label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label><select name="written_content_assignee'+plan_id+'" id="written_content_assignee'+plan_id+'" class="form-control written_content_assignee" style="line-height: 1.5;"><?php if($projtm){foreach ($projtm as $ptm) {$m = $this->Front_model->getStudentById($ptm->pmember);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}$proj_del = $this->Front_model->getProjectById($ptm->pid);$m = $this->Front_model->getStudentById($proj_del->pcreated_by);if($m){if($m->reg_id != $this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }?></select> <span id="written_content_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label><select name="written_content_assignee'+plan_id+'" id="written_content_assignee'+plan_id+'" class="form-control written_content_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="written_content_assigneeErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->uri->segment(2))){$projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));?><div class="form-group mb-2"><label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label><select name="pc_file_assignee'+plan_id+'" id="pc_file_assignee'+plan_id+'" class="form-control pc_file_assignee" style="line-height: 1.5;"><?php if($projtm){foreach ($projtm as $ptm) {$m = $this->Front_model->getStudentById($ptm->pmember);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}$proj_del = $this->Front_model->getProjectById($ptm->pid);$m = $this->Front_model->getStudentById($proj_del->pcreated_by);if($m){if($m->reg_id != $this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?></select> <span id="pc_file_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label><select name="pc_file_assignee'+plan_id+'" id="pc_file_assignee'+plan_id+'" class="form-control pc_file_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="pc_file_assigneeErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->uri->segment(2))){$projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));?><div class="form-group mb-2"><label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label><select name="submit_to_approval'+plan_id+'" id="submit_to_approval'+plan_id+'" class="form-control submit_to_approval" style="line-height: 1.5;"><?php if($projtm){foreach ($projtm as $ptm) {$m = $this->Front_model->getStudentById($ptm->pmember);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}$proj_del = $this->Front_model->getProjectById($ptm->pid);$m = $this->Front_model->getStudentById($proj_del->pcreated_by);if($m){if($m->reg_id != $this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?></select> <span id="submit_to_approvalErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label><select name="submit_to_approval'+plan_id+'" id="submit_to_approval'+plan_id+'" class="form-control submit_to_approval" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="submit_to_approvalErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->uri->segment(2))){$projtm = $this->Front_model->getAccepted_ProjTM($this->uri->segment(2));?><div class="form-group mb-2"><label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label><select name="pc_assignee'+plan_id+'" id="pc_assignee'+plan_id+'" class="form-control pc_assignee" style="line-height: 1.5;"><?php if($projtm){foreach ($projtm as $ptm) {$m = $this->Front_model->getStudentById($ptm->pmember);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}$proj_del = $this->Front_model->getProjectById($ptm->pid);$m = $this->Front_model->getStudentById($proj_del->pcreated_by);if($m){if($m->reg_id != $this->session->userdata('d168_id')){ ?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?><option value=""><span>None</span></option></select> <span id="pc_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="pc_assignee" class="col-form-label pc_assignee_label">Scheduler </label><select name="pc_assignee'+plan_id+'" id="pc_assignee'+plan_id+'" class="form-control pc_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option><option value=""><span>None</span></option></select> <span id="pc_assigneeErr" class="text-danger"></span></div><?php } ?></div><div class="row mb-2"><label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label><div class="col-lg-5"><input id="pc_link" name="pc_link'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="pc_link_comment" name="pc_link_comment'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-2"><button type="button" class="add_dup_pc_link'+plan_id+' btn btn-d btn-sm">Add Another link</button></div></div><div class="pc_link_div'+plan_id+'"></div><span id="link_validErr'+plan_id+'" class="text-danger"></span><br><div class="row float-end"><div class="justify-content-end float-end"><button style="float:right;" type="button" class="btn btn-sm bg-d text-white remove_plan_content">Remove Content</button></div></div></div></div>';
        $(plan_content_wrapper).append(plan_wrapperHTML); 
        //$('.plan-content-wrapper').find('.pub_Cdate').datepicker({todayHighlight: true,startDate: new Date()});
        $('.plan-content-wrapper textarea, .plan-content-wrapper #pc_title').maxlength({
          alwaysShow: true,
          warningClass: "badge bg-info",
          limitReachedClass: "badge bg-warning"
        });
        var tproject_assign= $("#pid").val(); 
        $.ajax({
            url: base_url+'front/select_project_assignees',
            method: 'POST',
            data: {pid:tproject_assign},  
            success: function(data) {
                $('.plan-content-wrapper').find('#written_content_assignee'+plan_id).html(data.assignees);
                $('.plan-content-wrapper').find('#pc_file_assignee'+plan_id).html(data.assignees);
                $('.plan-content-wrapper').find('#submit_to_approval'+plan_id).html(data.assignees);
                $('.plan-content-wrapper').find('#pc_assignee'+plan_id).html(data.none_assignee);   

                var prev_wca = $('.plan-content-wrapper').find('#written_content_assignee'+current_plan_id).val();      
                var prev_pfa = $('.plan-content-wrapper').find('#pc_file_assignee'+current_plan_id).val();      
                var prev_sta = $('.plan-content-wrapper').find('#submit_to_approval'+current_plan_id).val();      
                var prev_pa = $('.plan-content-wrapper').find('#pc_assignee'+current_plan_id).val(); 
                     
                $('.plan-content-wrapper').find('#written_content_assignee'+plan_id).val(prev_wca);    
                $('.plan-content-wrapper').find('#pc_file_assignee'+plan_id).val(prev_pfa);    
                $('.plan-content-wrapper').find('#submit_to_approval'+plan_id).val(prev_sta);    
                $('.plan-content-wrapper').find('#pc_assignee'+plan_id).val(prev_pa);               
            }
        });

        var pc_linkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="pc_link" name="pc_link'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="pc_link_comment" name="pc_link_comment'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec'+plan_id+'" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link'+plan_id+'" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
        var a = 1; //Initial field counter is 1
       
        //Once add button is clicked
        $('.add_dup_pc_link'+plan_id).on('click',function(e){
            $('.pc_link_div'+plan_id).append(pc_linkHTML); //Add field html
        });

        $('.pc_link_div'+plan_id).on('click', '.add_dup_pc_link_sec'+plan_id, function(e){
            $('.pc_link_div'+plan_id).append(pc_linkHTML); 
        });

        //Once remove button is clicked
        $('.pc_link_div'+plan_id).on('click', '.remove_dup_pc_link'+plan_id, function(e){
           e.preventDefault();
           $(this).parent('div').parent('div').remove(); //Remove field html
           a--; //Decrement field counter
        });

        $('.remove_plan_content').on('click',function(e){
            e.preventDefault();
           $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
        });

        $('.limitInputCPFiles'+plan_id).change(function() {
          
            var platform = $('.InputPlatformCP'+plan_id+':checked').val();
            if(platform == 'twitter')
            {
              if (this.files.length > 4)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            } 
            if(platform == 'facebook')
            {
              if (this.files.length > 6)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'instagram')
            {
              if (this.files.length > 10)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'linkedin')
            {
              if (this.files.length > 1)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'google-my-business')
            {
              if (this.files.length > 10)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'pinterest')
            {
              if (this.files.length > 5)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'youtube')
            {
              if (this.files.length > 1)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'blogger')
            {
              if (this.files.length > 4)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }
            if(platform == 'tiktok')
            {
              if (this.files.length > 1)
              {
                $('#limitInputCPFilesErr'+plan_id).html('Too Many Files Attached');
                $(this).val('');
              }else{
                $('#limitInputCPFilesErr'+plan_id).html('');
              }
            }   
          });
    });
});

function platformChanges(platform,id){
    var plan_content_id = $('#plan-content-'+id);
    if(platform == 'twitter'){
        plan_content_id.find('.platform-button-'+id).html('Twitter');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','280');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'facebook'){
        plan_content_id.find('.platform-button-'+id).html('Facebook');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','63206');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'instagram'){
        plan_content_id.find('.platform-button-'+id).html('Instagram');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','2200');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'linkedin'){
        plan_content_id.find('.platform-button-'+id).html('LinkedIn');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','2985');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'google-my-business'){
        plan_content_id.find('.platform-button-'+id).html('Google My Business');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','1500');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'pinterest'){
        plan_content_id.find('.platform-button-'+id).html('Pinterest');
        plan_content_id.find('.youtube-title').css('display','block');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',true);
        plan_content_id.find('.written-content-2').css('display','block');
        plan_content_id.find('.written_content_label').html('Written Content 1 ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content  ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content 1');
        plan_content_id.find('#written_content').attr('maxlength','500');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'youtube'){
        plan_content_id.find('.platform-button-'+id).html('YouTube');
        plan_content_id.find('.youtube-title').css('display','block');
        plan_content_id.find('.tags').css('display','block');
        // plan_content_id.find('#pc_title').prop('required',true);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Description ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Description ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Description');
        plan_content_id.find('#written_content').attr('maxlength','5000');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else if(platform == 'blogger'){
        plan_content_id.find('.platform-button-'+id).html('Blog');
        plan_content_id.find('.youtube-title').css('display','block');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',true);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','50000');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field-div').css('display','block');
    }else if(platform == 'tiktok'){
        plan_content_id.find('.platform-button-'+id).html('TikTok');
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','100');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }else{
        plan_content_id.find('.platform-button-'+id).html('Platform '+id);
        plan_content_id.find('.youtube-title').css('display','none');
        plan_content_id.find('.tags').css('display','none');
        // plan_content_id.find('#pc_title').prop('required',false);
        plan_content_id.find('.written-content-2').css('display','none');
        plan_content_id.find('.written_content_label').html('Written Content ');
        plan_content_id.find('.written_content_assignee_label').html('Assignee for Written Content ');
        plan_content_id.find('#written_content').attr('placeholder', 'Enter Written Content');
        plan_content_id.find('#written_content').attr('maxlength','5000');
        plan_content_id.find('#pc_title').val('');
        plan_content_id.find('#written_content').val('');
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
        plan_content_id.find('.blog-field').val('');
        plan_content_id.find('.blog-field-div').css('display','none');
    }
}

// function get_pub_cdate(id)
// {
//     var plan_content_id = $('#plan-content-'+id);
//     plan_content_id.find('.pub_Cdate').datepicker({todayHighlight: true,startDate: new Date()});
// }

function onWrittenContentChange(value,id){
    var plan_content_id = $('#plan-content-'+id);
    var platform = plan_content_id.find('#platform:checked').val();
    plan_content_id.find('.written-content-2-span').html('');
    plan_content_id.find('.written-content-2-span').css('display','none');
    plan_content_id.find('.title-span').html('');
    plan_content_id.find('.title-span').css('display','none');
    if(platform == 'twitter'){
        var character_count = 280;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        }        
    }
    else if(platform == 'facebook'){
        var character_count = 63206;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'instagram'){
        var character_count = 2200;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'linkedin'){
        var character_count = 2985;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'google-my-business'){
        var character_count = 1500;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'pinterest'){
        var character_count = 500;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'youtube'){
        var character_count = 5000;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'blogger'){
        var character_count = 50000;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'tiktok'){
        var character_count = 100;
        if(value.length > character_count){
            plan_content_id.find('.written-content-span').css('display','block');
            plan_content_id.find('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            plan_content_id.find('.written-content-span').html('');
            plan_content_id.find('.written-content-span').css('display','none');
        } 
    }
    else{
        plan_content_id.find('.written-content-span').html('');
        plan_content_id.find('.written-content-span').css('display','none');
    }
}

function onWrittenContent2Change(value,id){
    var plan_content_id = $('#plan-content-'+id);
    var character_count = 500;
    if(value.length > character_count){
        plan_content_id.find('.written-content-2-span').css('display','block');
        plan_content_id.find('.written-content-2-span').html('Max characters allowed '+character_count+'.');
    }else{
        plan_content_id.find('.written-content-2-span').html('');
        plan_content_id.find('.written-content-2-span').css('display','none');
    }      
}

function onTitleChange(value,id){
    var plan_content_id = $('#plan-content-'+id);
    var character_count = 100;
    if(value.length > character_count){
        plan_content_id.find('.title-span').css('display','block');
        plan_content_id.find('.title-span').html('Max characters allowed '+character_count+'.');
    }else{
        plan_content_id.find('.title-span').html('');
        plan_content_id.find('.title-span').css('display','none');
    }        
}
$(window).on( "load", function() {
    $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
});
</script>
<script src="<?php echo base_url();?>assets/js/mention.js"></script>
<script>
var jArray= <?php echo json_encode($newMention);?>;
//console.log(jArray);
 var myMention = new Mention({
    input: document.querySelector('#message'),
    options: jArray
 })
</script>
    </body>

</html>