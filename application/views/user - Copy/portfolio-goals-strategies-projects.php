<?php
$page = 'goals';
$check_port_id = "";
if(!empty($sdetail))
{
  $check_port_id = $sdetail->portfolio_id;  
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Project List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php
include('header_links.php');
?>
<link href="<?php echo base_url();?>assets/css/new-cards.css" rel="stylesheet" type="text/css" />
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
            $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
            $ActiveEmail_ID = "";
            if($get_active_Email_ID)
            {
                $ActiveEmail_ID = $get_active_Email_ID->email_address;
            }
            $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($check_port_id, $ActiveEmail_ID);
            if($check_active_portfolio)
            {
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
                        <h4 class="mb-sm-0 font-size-18">Projects</h4>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_projects = trim($getPackDetail->pack_projects);
          $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
          $check_type = is_numeric($total_projects);
          if($check_type == 'true')
          {
            if($used_projects < $total_projects)
            {
              ?>
                <li class="nav-item">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
                    </form>
                </li>
              <?php
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
            ?>
            <li class="nav-item">
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
                </form>
            </li>
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_projects = trim($getPackDetail->pack_projects);
          $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
          $check_type = is_numeric($total_projects);
          if($check_type == 'true')
          {
            if($used_projects < $total_projects)
            {
              ?>
                <li class="nav-item">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
                    </form>
                </li>
              <?php
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
            ?>
            <li class="nav-item">
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
                </form>
            </li>
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
            if(in_array('projects', $cus_privilege))
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
            <li class="nav-item">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_projects = trim($getPackDetail->pack_projects);
              $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
              $check_type = is_numeric($total_projects);
              if($check_type == 'true')
              {
                if($used_projects < $total_projects)
                {
                  ?>
                    <li class="nav-item">
                        <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                                <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                                <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
                        </form>
                    </li>
                  <?php
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
                ?>
                <li class="nav-item">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</button> 
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
?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-center">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="all_project" onclick="return all_project_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="created_project" onclick="return project_filter();">
                                   <label class="form-check-label">Created Projects</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="accepted_project" onclick="return project_filter();">
                                   <label class="form-check-label">Accepted Projects</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="pending_project" onclick="return project_filter();">
                                   <label class="form-check-label">Pending Requests</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="more_project" onclick="return project_filter();">
                                   <label class="form-check-label">More Info Requests</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title-->
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

if($Strategy_tasks || $Strategy_subtasks)
{
?> 
<div class="row p-3 progressbar_display">
    <div class="col pt-1 pb-3" style="background: #ffffff">
        <?php 
        $progress_done = $this->Front_model->Strategyprogress_done($sid);
        $progress_total = $this->Front_model->Strategyprogress_total($sid);
        $sub_progress_done = $this->Front_model->Strategysub_progress_done($sid);
        $sub_progress_total = $this->Front_model->Strategysub_progress_total($sid);
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
}
?>
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row" id="created_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Created Projects</h4>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Projects</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col">Accepted Team</th>
                                                    <th scope="col">Invited Team</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($plist)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($plist as $p)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                    <?php
                                                                        if($p->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($p->portfolio_id);
                                                                            if($portfolio){
                                                                    if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item me-1">
                                                                                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                        } 
                                                                        }
                                                                    ?>
                                                                </div>
                                                                        <div class="col-10">
                                                                    <h5 class="font-size-14"><a  href="<?php echo base_url('projects-overview/'.$p->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php
                                                                                echo $p->pname;
                                                                        
                                                                        $check_notify_project_management = $this->Front_model->check_notify_project_management($p->pid);
                                                                        $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($p->pid);
                                                                        $check_notify_project_task = $this->Front_model->check_notify_project_task($p->pid);
                                                                        if($check_notify_project_management)
                                                                        {
                                                                            if($check_notify_project_management->status == 'sent')
                                                                        {
                                                                        ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        elseif($check_notify_project_suggested)
                                                                        {
                                                                            if($check_notify_project_suggested->status == 'suggested')
                                                                        {
                                                                        ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        elseif($check_notify_project_task)
                                                                        {                   
                                                                        ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        </a>
                                                                        <!-- <a href="javascript:void(0)" class="nameLink float-end" onclick="return delete_project('<?php echo $p->pid;?>','<?php echo $p->pname;?>');"><i class="bx bx-trash"></i></a> -->
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $p->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($p->pdes))
                                                                        {
                                                                            if(strlen($p->pdes) > 45)
                                                                            {
                                                                              print_r(substr($p->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $p->pdes;
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "No Description!";
                                                                        }             
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                    </div>
                                                                </td>
                                                                <!-- <td><span class="badge bg-d-caps">Completed</span></td> -->
                                                                <td>
                                                                    <?php                                                           $pid = $p->pid;
                                                                        $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                                        if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'accepted')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php                                                           if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'send')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        //$cnt++;
                                                        }
                                                    }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="accepted_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Accepted Projects</h4>
                                    <div class="table-responsive">
                                        <table id="datatable2" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Projects</th>
                                                    <!--<th scope="col">Status</th>-->
                                                    <th scope="col">Accepted Team</th>
                                                    <th scope="col">Invited Team</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($accepted_plist)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($accepted_plist as $ap)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                    <?php
                                                                        if($ap->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($ap->portfolio_id);
                                                                    if($portfolio){
                                                                    if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        } 
                                                                    ?>
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <h5 class="font-size-14"><a href="<?php echo base_url('projects-overview-accepted/'.$ap->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php                
                                                                                echo $ap->pname;
                                                                        $check_notify_project_task = $this->Front_model->check_notify_project_task($ap->pid);
                                                                        if($check_notify_project_task)
                                                                        {                   
                                                                        ?>
                                                                            <i class="bx bx-bell bx-tada"></i>
                                                                        <?php
                                                                        }
                                                                        ?>  
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewAcceptedModal(<?php echo $ap->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($ap->pdes))
                                                                        {
                                                                        if(strlen($ap->pdes) > 45)
                                                                            {
                                                                              print_r(substr($ap->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $ap->pdes;
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "No Description!";
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <!-- <td><span class="badge bg-d-caps">Completed</span></td> -->
                                                                <td>
                                                                    <?php                                                           $pid = $ap->pid;
                                                                        $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                                        if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'accepted')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php                                                           if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'send')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        //$cnt++;
                                                        }
                                                    }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="pending_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Pending Requests</h4>
                                    <div class="table-responsive">
                                        <table id="datatable3" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Projects</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col">Accepted Team</th>
                                                    <th scope="col">Invited Team</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($pending_plist)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($pending_plist as $pp)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                    <?php
                                                                        if($pp->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($pp->portfolio_id);
                                                                    if($portfolio){
                                                                    if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                        } 
                                                                    ?>
                                                                        </div>
                                                                        <div class="col-10">
                                                                    <h5 class="font-size-14"><a href="<?php echo base_url('projects-overview-request/'.$pp->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php
                                                                                echo $pp->pname;
                                                                        ?>  
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $pp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($pp->pdes))
                                                                        {
                                                                        if(strlen($pp->pdes) > 45)
                                                                            {
                                                                              print_r(substr($pp->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $pp->pdes;
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "No Description!";
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                        </div>
                                                                    </div>                           
                                                                </td>
                                                                <!-- <td><span class="badge bg-d-caps">Completed</span></td> -->
                                                                <td>
                                                                    <?php                                                           $pid = $pp->pid;
                                                                        $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                                        if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'accepted')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php                                                           if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'send')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        //$cnt++;
                                                        }
                                                    }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="more_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">More Info Requests</h4>
                                    <div class="table-responsive">
                                        <table id="datatable4" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Projects</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col">Accepted Team</th>
                                                    <th scope="col">Invited Team</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($readmore_plist)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($readmore_plist as $rp)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                    <?php
                                                                        if($rp->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($rp->portfolio_id);
                                                                            if($portfolio){
                                                                    if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $portfolio->portfolio_id;?>');" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                        } 
                                                                    ?> 
                                                                        </div>
                                                                        <div class="col-10">
                                                                    <h5 class="font-size-14">
                                                                        <a href="<?php echo base_url('projects-overview-request/'.$rp->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php
                                                                                echo $rp->pname;
                                                                        ?>  
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $rp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($rp->pdes))
                                                                        {
                                                                        if(strlen($rp->pdes) > 45)
                                                                            {
                                                                              print_r(substr($rp->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $rp->pdes;
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "No Description!";
                                                                        } 
                                                                        ?>
                                                                    </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <!-- <td><span class="badge bg-d-caps">Completed</span></td> -->
                                                                <td>
                                                                    <?php                                                           $pid = $rp->pid;
                                                                        $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                                        if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'accepted')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php                                                           if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'send')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
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
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        //$cnt++;
                                                        }
                                                    }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                        <!-- <input type="text" id="search-criteria"/><a href="" onclick="return false;" id="search-clear">X</a> -->
<div class="row">
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8"></div>
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria" style="line-height: 0.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>

                        <!-- <div data-simplebar style="max-height: 800px;"> -->
                        <!-- <div data-simplebar style="max-height: 400px;" id="created_project_grid">  -->
                        <div id="created_project_grid">
                        <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>My Created Projects</h4> -->
                            <?php
                                if($plist)
                                    {
                                        foreach($plist as $p)
                                            {
                            ?>
    <div class="col-md-6 col-xs-12 col-lg-3 search-cards">
    <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($p->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($p->portfolio_id);
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <a href="<?php echo base_url('projects-overview/'.$p->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $p->pname;?>">
                        <?php echo $p->pname;?>
                     </a></p>
                  <p class="ng-binding"><?php
                                                        if(!empty($p->pdes))
                                                            {
                                                                if(strlen($p->pdes) > 45)
                                                                    {
                                                                        print_r(substr($p->pdes,0,45).'...');
                                                                    }
                                                                else
                                                                    {
                                                                        echo $p->pdes;
                                                                    }
                                                            }
                                                        else
                                                            {
                                                                echo "No Description!";
                                                            } 
                                                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding"><a href="<?php echo base_url('projects-overview/'.$p->pid)?>" class="float-end h4 bell_preview" title="Open Project">
                                                        <?php                   
                                                            $check_notify_project_management = $this->Front_model->check_notify_project_management($p->pid);
                                                            $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($p->pid);
                                                            $check_notify_project_task = $this->Front_model->check_notify_project_task($p->pid);
                                                                if($check_notify_project_management)
                                                                {
                                                                    if($check_notify_project_management->status == 'sent')
                                                                        {
                                                                ?>
                                                                    <i class="bx bx-bell bx-tada"></i>
                                                                <?php
                                                                        }
                                                                }
                                                                elseif($check_notify_project_suggested)
                                                                {
                                                                    if($check_notify_project_suggested->status == 'suggested')
                                                                        {
                                                                ?>                                                                  <i class="bx bx-bell bx-tada"></i>
                                                                <?php
                                                                        }
                                                                }
                                                                elseif($check_notify_project_task)
                                                                {                   
                                                                ?>
                                                                    <i class="bx bx-bell bx-tada"></i>
                                                                <?php
                                                                }
                                                        ?>
                                                        </a>
                                                        <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" onclick="return ProjectOverviewModal(<?php echo $p->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $p->pid;
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                        if($ptm)
                                                            {
                                                ?>
                                                        <div class="avatar-group">
                                                <?php
                                                        foreach($ptm as $pm)
                                                           {
                                                            if($pm->status == 'accepted' || $pm->status == 'send')
                                                                {
                                                                    if($pm->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
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
                                                                            if($pm->status == 'send')
                                                                                {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                           }
                                                        }
                                                    } 
                                                ?>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="avatar-group mb-3">
                                                    Team Not Selected!
                                                </div>
                                                <?php
                                                }
                                                ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
                            <?php 
                                    }
                                }
                            ?>
                            </div>
                            </div>
                            <!-- </div> -->


                            <!-- <div data-simplebar style="max-height: 400px;"> -->
                            <div id="accepted_project_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>Accepted Projects</h4> -->
                            <?php
                                if($accepted_plist)
                                    {
                                        foreach($accepted_plist as $ap)
                                            {
                            ?>
    <div class="col-md-6 col-xs-12 col-lg-3 search-cards">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($ap->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($ap->portfolio_id);
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <a href="<?php echo base_url('projects-overview-accepted/'.$ap->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $ap->pname;?>">
                        <?php echo $ap->pname;?>
                     </a></p>
                  <p class="ng-binding"><?php
                                                        if(!empty($ap->pdes))
                                                        {
                                                            if(strlen($ap->pdes) > 45)
                                                                {
                                                                    print_r(substr($ap->pdes,0,45).'...');
                                                                }
                                                            else
                                                                {
                                                                    echo $ap->pdes;
                                                                }
                                                        }
                                                        else
                                                        {
                                                            echo "No Description!";
                                                        } 
                                                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                                                        <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color: #c7df19;" onclick="return ProjectOverviewAcceptedModal(<?php echo $ap->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $ap->pid;
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                        if($ptm)
                                                            {
                                                ?>
                                                        <div class="avatar-group">
                                                <?php
                                                        foreach($ptm as $pm)
                                                           {
                                                            if($pm->status == 'accepted' || $pm->status == 'send')
                                                                {
                                                                    if($pm->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
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
                                                                            if($pm->status == 'send')
                                                                                {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                           }
                                                        }
                                                    } 
                                                ?>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="avatar-group mb-3">
                                                    Team Not Selected!
                                                </div>
                                                <?php
                                                }
                                                ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
                            <?php 
                                    }
                                }
                            ?>
                            </div>
                            </div>
                            <!-- </div> -->

                            
                            <!-- <div data-simplebar style="max-height: 400px;"> -->
                            <div id="pending_project_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>Pending Projects Request</h4> -->
                            <?php
                                if($pending_plist)
                                    {
                                        foreach($pending_plist as $pp)
                                            {
                            ?>
    <div class="col-md-6 col-xs-12 col-lg-3 search-cards">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($pp->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($pp->portfolio_id);
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <a href="<?php echo base_url('projects-overview-request/'.$pp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $pp->pname;?>">
                        <?php echo $pp->pname;?>
                     </a></p>
                  <p class="ng-binding"><?php
                                                        if(!empty($pp->pdes))
                                                            {
                                                                if(strlen($pp->pdes) > 45)
                                                                    {
                                                                        print_r(substr($pp->pdes,0,45).'...');
                                                                    }
                                                                else
                                                                    {
                                                                        echo $pp->pdes;
                                                                    }
                                                            }
                                                        else
                                                            {
                                                                echo "No Description!";
                                                            }
                                                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                                                        <a href="javascript: void(0);" class="nameLink float-end h4 eye_preview" style="color: #c7df19;" onclick="return ProjectOverviewRequestModal(<?php echo $pp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $pp->pid;
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                        if($ptm)
                                                            {
                                                ?>
                                                        <div class="avatar-group">
                                                <?php
                                                        foreach($ptm as $pm)
                                                           {
                                                            if($pm->status == 'accepted' || $pm->status == 'send')
                                                                {
                                                                    if($pm->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
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
                                                                            if($pm->status == 'send')
                                                                                {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                           }
                                                        }
                                                    } 
                                                ?>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="avatar-group mb-3">
                                                    Team Not Selected!
                                                </div>
                                                <?php
                                                }
                                                ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>                            
                            <?php 
                                    }
                                }
                                else
                                {
                                ?>
                                <div style="display: none;text-align: center;" id="no_pending_req_img">
                                   <img src="<?php echo base_url('/assets/images/no_pending_req_d168.png');?>" class="img-thumbnail" style="max-width: 30% !important;">
                                </div>
                                <?php
                                }
                            ?>
                            </div>
                            </div>
                            <!-- </div> -->
                            

                            <!-- <div data-simplebar style="max-height: 400px;"> -->
                            <div id="more_project_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>More Projects Request</h4> -->
                            <?php
                                if($readmore_plist)
                                    {
                                        foreach($readmore_plist as $rp)
                                            {
                            ?>
    <div class="col-md-6 col-xs-12 col-lg-3 search-cards">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($rp->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($rp->portfolio_id);
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <a href="<?php echo base_url('projects-overview-request/'.$rp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $rp->pname;?>">
                        <?php echo $rp->pname;?>
                     </a></p>
                  <p class="ng-binding"><?php
                                                        if(!empty($rp->pdes))
                                                            {
                                                                if(strlen($rp->pdes) > 45)
                                                                    {
                                                                        print_r(substr($rp->pdes,0,45).'...');
                                                                    }
                                                                else
                                                                    {
                                                                        echo $rp->pdes;
                                                                    }
                                                            }
                                                        else
                                                            {
                                                                echo "No Description!";
                                                            }
                                                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                                                        <a href="javascript: void(0);" class="nameLink float-end h4 eye_preview" style="color: #c7df19;" onclick="return ProjectOverviewRequestModal(<?php echo $rp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $rp->pid;
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                        if($ptm)
                                                            {
                                                ?>
                                                        <div class="avatar-group">
                                                <?php
                                                        foreach($ptm as $pm)
                                                           {
                                                            if($pm->status == 'accepted' || $pm->status == 'send')
                                                                {
                                                                    if($pm->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
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
                                                                            if($pm->status == 'send')
                                                                                {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                           }
                                                        }
                                                    } 
                                                ?>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="avatar-group mb-3">
                                                    Team Not Selected!
                                                </div>
                                                <?php
                                                }
                                                ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
                            <?php 
                                    }
                                }
                            ?>
                            </div>
                            </div>
                            <!-- </div> -->
                            <?php 
                               if(empty($plist) && empty($accepted_plist) && empty($pending_plist) && empty($readmore_plist))
                                {
                            ?>
                            <div class="col-xl-3 col-sm-6" id="hide_no_data">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">No Data</h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <!-- </div> -->

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
        <?php 
    }
?>                                   
                                    <!-- Project Overview Modal -->
                                    <div id="ProjectOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Project Overview Accepted Modal -->
                                    <div id="ProjectOverviewAcceptedModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewAcceptedModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectOverviewAcceptedModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Project Overview Request Modal -->
                                    <div id="ProjectOverviewRequestModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectOverviewRequestModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

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
</script>

    </body>

</html>