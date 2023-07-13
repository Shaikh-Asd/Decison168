<?php
$page = 'portfolio';
if(isset($_COOKIE["d168_selectedportfolio"]))
{
    if($_COOKIE["d168_selectedportfolio"] != $c_id)
    {
        setcookie("d168_selectedportfolio",$c_id,time()+ (10 * 365 * 24 * 60 * 60),'/');
        header("Refresh:0");
    }
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Portfolio Projects</title>
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
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_projects = trim($getPackDetail->pack_projects);
          $used_projects = trim($getProjectCount['project_count_rows']);
          $check_type = is_numeric($total_projects);
          if($check_type == 'true')
          {
            if($used_projects < $total_projects)
            {
              ?>
                <li class="nav-item me-2">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                </li>
              <?php
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</a>
                </li>
                <?php
            }
          }
          else
          {
            ?>
            <li class="nav-item me-2">
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
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
        $getProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_projects = trim($getPackDetail->pack_projects);
          $used_projects = trim($getProjectCount['project_count_rows']);
          $check_type = is_numeric($total_projects);
          if($check_type == 'true')
          {
            if($used_projects < $total_projects)
            {
              ?>
                <li class="nav-item me-2">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                </li>
              <?php
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</a>
                </li>
                <?php
            }
          }
          else
          {
            ?>
            <li class="nav-item me-2">
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
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
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getProjectCount = $this->Front_model->getProjectCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_projects = trim($getPackDetail->pack_projects);
              $used_projects = trim($getProjectCount['project_count_rows']);
              $check_type = is_numeric($total_projects);
              if($check_type == 'true')
              {
                if($used_projects < $total_projects)
                {
                  ?>
                    <li class="nav-item me-2">
                        <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
                        </form>
                    </li>
                  <?php
                }
                else
                {
                    ?>
                    <li class="nav-item">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</a>
                    </li>
                    <?php
                }
              }
              else
              {
                ?>
                <li class="nav-item me-2">
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $c_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Project</button> 
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
                <div class="row d-none d-sm-block">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port_proj" type="radio" id="all_port_project" onclick="return all_portfolio_project_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port_proj" type="radio" id="regular_port_project" onclick="return portfolio_project_filter();">
                                   <label class="form-check-label">Regular Projects</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port_proj" type="radio" id="goal_port_project" onclick="return portfolio_project_filter();">
                                   <label class="form-check-label">Goal Projects</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row d-block d-sm-none">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="btn-group me-1 mt-2">
                            <button class="btn btn-d btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter By <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port_proj2" type="radio" id="all_port_project2" onclick="return all_portfolio_project_filter2();" checked>
                                       <label class="form-check-label">All</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port_proj2" type="radio" id="regular_port_project2" onclick="return portfolio_project_filter2();">
                                       <label class="form-check-label">Regular Projects</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port_proj2" type="radio" id="goal_port_project2" onclick="return portfolio_project_filter2();">
                                       <label class="form-check-label">Goal Projects</label></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio Projects</a></li> -->
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
?> 
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
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
                                                    if($portfolio_projects)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($portfolio_projects as $cp)
                                                        {
                                                            ?>
                                                            <tr class="<?php if($cp->gid == 0){ echo "regular_port_proj";} else { echo "goal_port_proj";}?>">
                                                                <td>
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                <?php
                                                                        if($cp->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($cp->portfolio_id);
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
                                                                        <?php 
                                                                            if($cp->pcreated_by == $this->session->userdata('d168_id'))
                                                                            {
                                                                        ?>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                        <a href="<?php echo base_url('projects-overview/'.$cp->pid)?>" class="nameLink" title="Open Project">      
                                                                        <?php   
                                                                            }
                                                                            else
                                                                            {
                                                                                $pmember = $this->Front_model->CheckProjectTeamMember($cp->pid);
                                                                                if(!empty($pmember))
                                                                                {
                                                                                    foreach($pmember as $member)
                                                                                    {
                                                                                    if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                                        {
                                                                                    ?>
                                                                                    <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewAcceptedModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                                    <a href="<?php echo base_url('projects-overview-accepted/'.$cp->pid)?>" class="nameLink" title="Open Project"> 
                                                                                    <?php   
                                                                                        }
                                                                                    elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                                        {
                                                                                    ?>
                                                                                    <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                                    <a href="<?php echo base_url('projects-overview-request/'.$cp->pid)?>" class="nameLink" title="Open Project">
                                                                                    <?php   
                                                                                        }
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                ?>
                                                                                <a href="javascript: void(0);" class="nameLink" <?php if($cp->gid == 0) {?> onclick="return RequestAsMember(<?php echo $cp->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $cp->pid;?>" <?php } else {?> onclick="return RequestAsGoalMember();" <?php }?> >
                                                                                <?php 
                                                                                }
                                                                            }
                                                                       
                                                                                echo $cp->pname;
                                                                        
                                                                        $check_notify_project_management = $this->Front_model->check_notify_project_management($cp->pid);
                                                                        $check_notify_project_suggested = $this->Front_model->check_notify_project_suggested($cp->pid);
                                                                        $check_notify_project_task = $this->Front_model->check_notify_project_task($cp->pid);
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
                                                                        </a></h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($cp->pdes))
                                                                        {
                                                                            if(strlen($cp->pdes) > 45)
                                                                            {
                                                                              print_r(substr($cp->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $cp->pdes;
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
                                                                    <?php                                                           $pid = $cp->pid;
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
                        <!-- <div data-simplebar style="max-height: 800px;">  -->
                        <div class="row">
                            <?php
                                if($portfolio_projects)
                                    {
                                        foreach($portfolio_projects as $cp)
                                            {
                            ?>
    <div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php if($cp->gid == 0){ echo "regular_port_proj";} else { echo "goal_port_proj";}?>">
    <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($cp->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($cp->portfolio_id);
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
                        <?php
                                                                        if($cp->pcreated_by == $this->session->userdata('d168_id'))
                                                                            {
                                                                        ?>
                    <a href="<?php echo base_url('projects-overview/'.$cp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $cp->pname;?>">
                                                                        <?php   
                                                                            }
                                                                            else
                                                                            {
                                                                                $pmember = $this->Front_model->CheckProjectTeamMember($cp->pid);
                                                                                if(!empty($pmember))
                                                                                {
                                                                                    foreach($pmember as $member)
                                                                                    {
                                                                                    if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                                        {
                                                                                    ?>
                <a href="<?php echo base_url('projects-overview-accepted/'.$cp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $cp->pname;?>">
                                                                                    <?php   
                                                                                        }
                                                                                    elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                                        {
                                                                                    ?>
                    <a href="<?php echo base_url('projects-overview-request/'.$cp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $cp->pname;?>">
                                                                                    <?php   
                                                                                        }
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                ?>
                    <a href="javascript: void(0);" <?php if($cp->gid == 0) {?> onclick="return RequestAsMember(<?php echo $cp->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" <?php } else {?> onclick="return RequestAsGoalMember();" <?php }?>  class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $cp->pname;?>">
                                                                                <?php 
                                                                                }
                                                                            }
                        ?>
                        <?php echo $cp->pname;;?>
                     </a></p>
                  <p class="ng-binding"> <?php
                                                        if(!empty($cp->pdes))
                                                            {
                                                                if(strlen($cp->pdes) > 45)
                                                                    {
                                                                        print_r(substr($cp->pdes,0,45).'...');
                                                                    }
                                                                else
                                                                    {
                                                                        echo $cp->pdes;
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
                                                        <?php
                                                        if($cp->pcreated_by == $this->session->userdata('d168_id'))
                                                                            {
                                                                        ?>
                                                                        <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" onclick="return ProjectOverviewModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                        <?php   
                                                                            }
                                                                            else
                                                                            {
                                                                                $pmember = $this->Front_model->CheckProjectTeamMember($cp->pid);
                                                                                if(!empty($pmember))
                                                                                {
                                                                                    foreach($pmember as $member)
                                                                                    {
                                                                                    if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                                        {
                                                                                    ?>
                                                                                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" onclick="return ProjectOverviewAcceptedModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                                    
                                                                                    <?php   
                                                                                        }
                                                                                    elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                                        {
                                                                                    ?>
                                                                                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" onclick="return ProjectOverviewRequestModal(<?php echo $cp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                                    <?php   
                                                                                        }
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                ?>
                                                                                <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" <?php if($cp->gid == 0) {?> onclick="return RequestAsMember(<?php echo $cp->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" <?php } else {?> onclick="return RequestAsGoalMember();" <?php }?> ><i class="mdi mdi-eye-outline"></i></a>
                                                                                <?php 
                                                                                }
                                                                            }
                                                        ?>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $cp->pid;
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
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">No Data</h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            </div>
                            <!-- </div>                   -->
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
