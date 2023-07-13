<?php
$page = 'content-planner';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Content Planner</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                        <h4 class="mb-sm-0 font-size-18">Content</h4>
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
        <li class="nav-item me-2">
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        if($getPackDetail)
        {
          $total_content_planner = trim($getPackDetail->pack_content_planner);
          $check_type = is_numeric($total_content_planner);
          if($check_type == 'true')
          {
            $current_month = date('m');
            $current_year = date('Y');
            $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
            $used_content = trim($getMonthWiseContent['content_count_rows']);
            if($used_content < $total_content_planner)
            {
              ?>
            <li class="nav-item me-2">
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
                    <i class="mdi mdi-plus"></i> Create New
                </a>
            </li>
            <?php
            }
            else
            {
              ?>
                <li class="nav-item me-2">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
            <?php
            }
          }
          else
          {
            ?>
                <li class="nav-item">
                    <!-- <a class="btn btn-sm btn-d text-white" data-bs-toggle="modal" data-bs-target=".select-project" onclick="$('#select_project_form').trigger('reset');">
                        <i class="mdi mdi-plus"></i> Plan Content
                    </a> -->
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        if($getPackDetail)
        {
          $total_content_planner = trim($getPackDetail->pack_content_planner);
          $check_type = is_numeric($total_content_planner);
          if($check_type == 'true')
          {
            $current_month = date('m');
            $current_year = date('Y');
            $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
            $used_content = trim($getMonthWiseContent['content_count_rows']);
            if($used_content < $total_content_planner)
            {
              ?>
            <li class="nav-item me-2">
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
                    <i class="mdi mdi-plus"></i> Create New
                </a>
            </li>
            <?php
            }
            else
            {
              ?>
                <li class="nav-item me-2">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
            <?php
            }
          }
          else
          {
            ?>
                <li class="nav-item">
                    <!-- <a class="btn btn-sm btn-d text-white" data-bs-toggle="modal" data-bs-target=".select-project" onclick="$('#select_project_form').trigger('reset');">
                        <i class="mdi mdi-plus"></i> Plan Content
                    </a> -->
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
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
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <li class="nav-item me-2">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            if($getPackDetail)
            {
              $total_content_planner = trim($getPackDetail->pack_content_planner);
              $check_type = is_numeric($total_content_planner);
              if($check_type == 'true')
              {
                $current_month = date('m');
                $current_year = date('Y');
                $getMonthWiseContent = $this->Front_model->getMonthWiseContentCorp($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                $used_content = trim($getMonthWiseContent['content_count_rows']);
                if($used_content < $total_content_planner)
                {
                  ?>
                <li class="nav-item me-2">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
                <?php
                }
                else
                {
                  ?>
                    <li class="nav-item me-2">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                    </li>
                <?php
                }
              }
              else
              {
                ?>
                    <li class="nav-item">
                        <!-- <a class="btn btn-sm btn-d text-white" data-bs-toggle="modal" data-bs-target=".select-project" onclick="$('#select_project_form').trigger('reset');">
                            <i class="mdi mdi-plus"></i> Plan Content
                        </a> -->
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('content-project-create');?>">
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
                                   <input class="form-check-input" name="filter_proj" type="radio" id="all_project" onclick="return all_project_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="created_project" onclick="return project_filter();">
                                   <label class="form-check-label">Created</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="accepted_project" onclick="return project_filter();">
                                   <label class="form-check-label">Accepted</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="pending_project" onclick="return project_filter();">
                                   <label class="form-check-label">Pending</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="more_project" onclick="return project_filter();">
                                   <label class="form-check-label">More Info Content</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="regular_project" onclick="return project_filter();">
                                   <label class="form-check-label">Regular Content</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="goal_project" onclick="return project_filter();">
                                   <label class="form-check-label">Goal Content</label>
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
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="all_project2" onclick="return all_project_filter2();" checked>
                                       <label class="form-check-label">All</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="created_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">Created Content</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="accepted_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">Accepted Content</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="pending_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">Pending Content</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="more_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">More Info Content</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="regular_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">Regular Content</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_proj2" type="radio" id="goal_project2" onclick="return project_filter2();">
                                       <label class="form-check-label">Goal Content</label></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li> -->
                </ol>
            </div>
            <!-- <div class="page-title-center">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="checkbox" id="all_project" onclick="return all_project_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="checkbox" id="created_plan_content" onclick="return project_filter();">
                                   <label class="form-check-label">Created Content</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="checkbox" id="assigned_plan_content" onclick="return project_filter();">
                                   <label class="form-check-label">Assigned Content</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- <div class="page-title-right">                    
                <ol class="breadcrumb m-0">
                    <li class="nav-item">
                    <?php
                    if($contentPlanningPublishDate)
                    {
                    ?>
                    <form name="portfolio_projects_content_search" id="portfolio_projects_content_search" method="post">
                            <div class="form-group mb-2">
                                    <input type="hidden" name="port_id" value="<?php echo $port_id;?>">
                                    <select class="form-select" name="pid_contentplan" id="pid_contentplan" onchange="return portfolio_projects_content_search_submit();" style="width: 180px !important;">
                                        <option value="" selected="">Select Publish Date</option>
                                        <?php
                                        if($contentPlanningPublishDate)
                                        {
                                            foreach($contentPlanningPublishDate as $cpdl)
                                            {
                                        ?>
                                        <option value="<?php echo $cpdl->publish_date;?>"><?php echo $cpdl->publish_date;?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span id="pid_contentplanErr" class="text-danger"></span>   
                            </div>
                    </form>
                    <?php
                        }
                    ?>
                </li>
                </ol>
            </div> -->
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

<!-- START CARD VIEW OF CONTENT PLANNER -->
<div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
<div class="row">
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8"></div>
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria" style="line-height: 1.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div> 
<!-- <div data-simplebar style="max-height: 800px;"> -->
<div id="created_project_grid">
<div class="row">
<?php
if($contentPlanningDetails_plist)
{
    $ccnt=1;
    foreach($contentPlanningDetails_plist as $cpd)
    {
        $check_permission = $this->Front_model->check_file_preview_access($cpd->pid);
        $getProject1 = $this->Front_model->getProjectDetailID($cpd->pid);
        if($getProject1)
        {
            $pcreated_by1 = $getProject1->pcreated_by;
            $pmanager1 = $getProject1->pmanager;        
        }
        $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($cpd->pid);
        $proj_del = $this->Front_model->getProjectById($cpd->pid);
        $port_del = $this->Front_model->getPortfolio2($cpd->portfolio_id);
?>

<div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php if($cpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
    <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                if($port_del)
                {                    
                    if($port_del->photo)
                    {
                    ?>  
                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                            <img src="<?php echo base_url('assets/portfolio_photos/'.$port_del->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php
                        if($port_del->portfolio_user == 'company')
                            {
                                $fullname = $port_del->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n)
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                        elseif($port_del->portfolio_user == 'individual')
                            {
                                $fullname = $port_del->portfolio_name.' '.$port_del->portfolio_lname;
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
                                $fullname = $port_del->portfolio_name;
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
            ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <?php
                if(!empty($cpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($cpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($cpd->pid);
                        ?>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview/'.$cpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                             </a>
                         </p>
                        <?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($cpd->pid);
                        ?>
                        <a href="" class="nameLink" title="Open Project"></a>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview-accepted/'.$cpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                            </a>
                        </p>
                         <?php
                    }
                }
                ?>
                <p class="ng-binding">
                   <?php 
                if($getContentPlanningByDel){
                    $cpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        if($privilege_only_view == 'no')
                        {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
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
            ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
          }
        }    
      }  
    }
                        }
                        elseif(($pcreated_by1 == $this->session->userdata('d168_id')) || ($pmanager1 == $this->session->userdata('d168_id')))
                        {
                            ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                        }
                        else
                        {
                            if($check_permission)
                            {
                                if($check_permission->req_status == 'accepted')
                                {
                                 ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                                }
                                else
                                {
                                 ?><a href="#" onclick="return file_preview_access_req('<?php echo $cpd->pid;?>')"><?php 
                                }
                            }
                            else
                            {
                            ?><a href="#" onclick="return file_preview_access_req('<?php echo $cpd->pid;?>')"><?php 
                            }    
                        }
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d mr-10" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d mr-10" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d mr-10" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d mr-10" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d mr-10" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d mr-10" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d mr-10" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d mr-10" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d mr-10" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $cpcnt++;
                    }
                }
                ?> 
                </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding"> 
                 Publish<i class="fas fa-calendar-alt ms-1"></i>
                  <p class="ng-binding">
                     <?php echo $cpd->p_publish; ?>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                    <p class="ng-binding"> <a onclick="return get_project_id5(<?php echo $cpd->pid; ?>);" href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a></p>
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
                    <p class="ng-binding"> <a onclick="return get_project_id5(<?php echo $cpd->pid; ?>);" href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a></p>
<?php
          }
        }    
      }  
    }
}
?> 
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <?php 
                    if($getContentPlanningByDel){
                        ?>
                        <div class="avatar-group">
                            <?php
                            $assignee_id_array = array();
                            foreach ($getContentPlanningByDel as $cp) {
                                $assignee_id_array[] = $cp->written_content_assignee;
                                $assignee_id_array[] = $cp->pc_file_assignee;
                                $assignee_id_array[] = $cp->submit_to_approval;
                                $assignee_id_array[] = $cp->pc_assignee;
                            }
                            $unique_id_array = array_unique($assignee_id_array);
                            foreach ($unique_id_array as $aia) {
                               $pc_id = $cp->pc_id;
                               $wca = $this->Front_model->getStudentById($aia);
                               if($wca)
                                {            
                                    if($wca->photo)
                                    {
                                    ?>                                 
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    else
                                    {
                                        $fullname = $wca->first_name.' '.$wca->last_name;
                                        $member_name = explode(" ", $fullname);
                                        $profile_name = "";
                                        foreach ($member_name as $n) 
                                        {
                                            $profile_name .= $n[0];
                                        }
                                        ?>
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } 
                            }
                            ?>
                        </div><?php
                    }
                    ?> 
                  </p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
<?php 
$ccnt++;
}
}
?>
</div>
</div>

<div id="accepted_project_grid">
<div class="row">
<?php
if($contentPlanningDetails_accepted_plist)
{
    $ccnt=1;
    foreach($contentPlanningDetails_accepted_plist as $acpd)
    {
        $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($acpd->pid);
        $check_permission = $this->Front_model->check_file_preview_access($acpd->pid);
        $getProject4 = $this->Front_model->getProjectDetailID($acpd->pid);
        if($getProject4)
        {
            $pcreated_by4 = $getProject4->pcreated_by;
            $pmanager4 = $getProject4->pmanager;        
        }
        $proj_del = $this->Front_model->getProjectById($acpd->pid);
        $port_del = $this->Front_model->getPortfolio2($acpd->portfolio_id);
?>

<div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php if($acpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                if($port_del)
                {                    
                    if($port_del->photo)
                    {
                    ?>  
                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                            <img src="<?php echo base_url('assets/portfolio_photos/'.$port_del->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php
                        if($port_del->portfolio_user == 'company')
                            {
                                $fullname = $port_del->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n)
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                        elseif($port_del->portfolio_user == 'individual')
                            {
                                $fullname = $port_del->portfolio_name.' '.$port_del->portfolio_lname;
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
                                $fullname = $port_del->portfolio_name;
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
            ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <?php
                if(!empty($acpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($acpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($acpd->pid);
                        ?>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview/'.$acpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                             </a>
                         </p>
                        <?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($acpd->pid);
                        ?>
                        <a href="" class="nameLink" title="Open Project"></a>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview-accepted/'.$acpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                            </a>
                        </p>
                         <?php
                    }
                }
                ?>
                <p class="ng-binding">
                   <?php 
                if($getContentPlanningByDel){
                    $cpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        if($privilege_only_view == 'no')
                        {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
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
            ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
          }
        }    
      }  
    }
                        }
                        elseif(($pcreated_by4 == $this->session->userdata('d168_id')) || ($pmanager4 == $this->session->userdata('d168_id')))
                        {
                            ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                        }
                        else
                        {
                            if($check_permission)
                            {
                                if($check_permission->req_status == 'accepted')
                                {
                                ?><a href="#" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                                }
                                else
                                {
                                ?><a href="#" onclick="return file_preview_access_req('<?php echo $acpd->pid;?>')"><?php
                                }
                            }
                            else
                            {
                            ?><a href="#" onclick="return file_preview_access_req('<?php echo $acpd->pid;?>')"><?php
                            }    
                        }
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d mr-10" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d mr-10" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d mr-10" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d mr-10" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d mr-10" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d mr-10" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d mr-10" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d mr-10" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d mr-10" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $cpcnt++;
                    }
                }
                ?> 
                </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding"> 
                 Publish<i class="fas fa-calendar-alt ms-1"></i>
                  <p class="ng-binding">
                     <?php echo $acpd->p_publish; ?>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
<?php
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                    <p class="ng-binding"> <a onclick="return get_project_id5(<?php echo $acpd->pid; ?>);" href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#c7df19 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a></p>
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
                    <p class="ng-binding"> <a onclick="return get_project_id5(<?php echo $acpd->pid; ?>);" href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#c7df19 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a></p>
<?php
          }
        }    
      }  
    } 
}
?>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <?php 
                    if($getContentPlanningByDel){
                        ?>
                        <div class="avatar-group">
                            <?php
                            $assignee_id_array = array();
                            foreach ($getContentPlanningByDel as $cp) {
                                $assignee_id_array[] = $cp->written_content_assignee;
                                $assignee_id_array[] = $cp->pc_file_assignee;
                                $assignee_id_array[] = $cp->submit_to_approval;
                                $assignee_id_array[] = $cp->pc_assignee;
                            }
                            $unique_id_array = array_unique($assignee_id_array);
                            foreach ($unique_id_array as $aia) {
                               $pc_id = $cp->pc_id;
                               $wca = $this->Front_model->getStudentById($aia);
                               if($wca)
                                {            
                                    if($wca->photo)
                                    {
                                    ?>                                 
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    else
                                    {
                                        $fullname = $wca->first_name.' '.$wca->last_name;
                                        $member_name = explode(" ", $fullname);
                                        $profile_name = "";
                                        foreach ($member_name as $n) 
                                        {
                                            $profile_name .= $n[0];
                                        }
                                        ?>
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } 
                            }
                            ?>
                        </div><?php
                    }
                    ?> 
                  </p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
<?php 
$ccnt++;
}
}
?>
</div>
</div>

<div id="pending_project_grid">
<div class="row">
<?php
if($contentPlanningDetails_pending_plist)
{
    $ccnt=1;
    foreach($contentPlanningDetails_pending_plist as $pcpd)
    {
        $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($pcpd->pid);
        $proj_del = $this->Front_model->getProjectById($pcpd->pid);
        $port_del = $this->Front_model->getPortfolio2($pcpd->portfolio_id);
?>

<div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php if($pcpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                if($port_del)
                {                    
                    if($port_del->photo)
                    {
                    ?>  
                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                            <img src="<?php echo base_url('assets/portfolio_photos/'.$port_del->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php
                        if($port_del->portfolio_user == 'company')
                            {
                                $fullname = $port_del->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n)
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                        elseif($port_del->portfolio_user == 'individual')
                            {
                                $fullname = $port_del->portfolio_name.' '.$port_del->portfolio_lname;
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
                                $fullname = $port_del->portfolio_name;
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
            ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <?php
                if(!empty($pcpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($pcpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($pcpd->pid);
                        ?>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview/'.$pcpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                             </a>
                         </p>
                        <?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($pcpd->pid);
                        ?>
                        <a href="" class="nameLink" title="Open Project"></a>
                        <p class="ng-binding">
                            <a onclick="return ProjectOverviewRequestModal(<?php echo $pcpd->pid;?>)" href="javascript: void(0);" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                            </a>
                        </p>
                         <?php
                    }
                }
                ?>
                <p class="ng-binding">
                   <?php 
                if($getContentPlanningByDel){
                    $cpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        ?><a href="#"><?php
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d mr-10" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d mr-10" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d mr-10" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d mr-10" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d mr-10" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d mr-10" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d mr-10" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d mr-10" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d mr-10" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $cpcnt++;
                    }
                }
                ?> 
                </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding"> 
                 Publish<i class="fas fa-calendar-alt ms-1"></i>
                  <p class="ng-binding">
                     <?php echo $pcpd->p_publish; ?>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                    <p class="ng-binding"> <a onclick="return ProjectOverviewRequestModal(<?php echo $pcpd->pid;?>)" href="javascript: void(0);" class="float-end h4 eye_preview"  title="Preview Content"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <?php 
                    if($getContentPlanningByDel){
                        ?>
                        <div class="avatar-group">
                            <?php
                            $assignee_id_array = array();
                            foreach ($getContentPlanningByDel as $cp) {
                                $assignee_id_array[] = $cp->written_content_assignee;
                                $assignee_id_array[] = $cp->pc_file_assignee;
                                $assignee_id_array[] = $cp->submit_to_approval;
                                $assignee_id_array[] = $cp->pc_assignee;
                            }
                            $unique_id_array = array_unique($assignee_id_array);
                            foreach ($unique_id_array as $aia) {
                               $pc_id = $cp->pc_id;
                               $wca = $this->Front_model->getStudentById($aia);
                               if($wca)
                                {            
                                    if($wca->photo)
                                    {
                                    ?>                                 
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    else
                                    {
                                        $fullname = $wca->first_name.' '.$wca->last_name;
                                        $member_name = explode(" ", $fullname);
                                        $profile_name = "";
                                        foreach ($member_name as $n) 
                                        {
                                            $profile_name .= $n[0];
                                        }
                                        ?>
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } 
                            }
                            ?>
                        </div><?php
                    }
                    ?> 
                  </p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
<?php 
$ccnt++;
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

<div id="more_project_grid">
<div class="row">
<?php
if($contentPlanningDetails_readmore_plist)
{
    $ccnt=1;
    foreach($contentPlanningDetails_readmore_plist as $rcpd)
    {
        $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($rcpd->pid);
        $proj_del = $this->Front_model->getProjectById($rcpd->pid);
        $port_del = $this->Front_model->getPortfolio2($rcpd->portfolio_id);
?>

<div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php if($rcpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
    <section ng-repeat="new_card in new_cards" class="new_card theme-orange" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                if($port_del)
                {                    
                    if($port_del->photo)
                    {
                    ?>  
                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                            <img src="<?php echo base_url('assets/portfolio_photos/'.$port_del->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $port_del->portfolio_id;?>');" title="View Portfolio: <?php if($port_del->portfolio_user == 'company'){ echo $port_del->portfolio_name;}elseif($port_del->portfolio_user == 'individual'){ echo $port_del->portfolio_name.' '.$port_del->portfolio_lname;}else{ echo $port_del->portfolio_name;}?>">
                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php
                        if($port_del->portfolio_user == 'company')
                            {
                                $fullname = $port_del->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n)
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                        elseif($port_del->portfolio_user == 'individual')
                            {
                                $fullname = $port_del->portfolio_name.' '.$port_del->portfolio_lname;
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
                                $fullname = $port_del->portfolio_name;
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
            ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <?php
                if(!empty($rcpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($rcpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($rcpd->pid);
                        ?>
                        <p class="ng-binding">
                            <a href="<?php echo base_url('projects-overview/'.$rcpd->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                             </a>
                         </p>
                        <?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($rcpd->pid);
                        ?>
                        <a href="" class="nameLink" title="Open Project"></a>
                        <p class="ng-binding">
                            <a onclick="return ProjectOverviewRequestModal(<?php echo $rcpd->pid;?>)" href="javascript: void(0);" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $proj_del->pname; ?>">
                                <?php echo $proj_del->pname; ?>
                            </a>
                        </p>
                         <?php
                    }
                }
                ?>
                <p class="ng-binding">
                   <?php 
                if($getContentPlanningByDel){
                    $cpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        ?><a href="#"><?php
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d mr-10" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d mr-10" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d mr-10" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d mr-10" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d mr-10" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d mr-10" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d mr-10" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d mr-10" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d mr-10" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $cpcnt++;
                    }
                }
                ?> 
                </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding"> 
                 Publish<i class="fas fa-calendar-alt ms-1"></i>
                  <p class="ng-binding">
                     <?php echo $rcpd->p_publish; ?>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                    <p class="ng-binding"> <a onclick="return ProjectOverviewRequestModal(<?php echo $rcpd->pid;?>)" href="javascript: void(0);" class="float-end h4 eye_preview" title="Preview Content"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <?php 
                    if($getContentPlanningByDel){
                        ?>
                        <div class="avatar-group">
                            <?php
                            $assignee_id_array = array();
                            foreach ($getContentPlanningByDel as $cp) {
                                $assignee_id_array[] = $cp->written_content_assignee;
                                $assignee_id_array[] = $cp->pc_file_assignee;
                                $assignee_id_array[] = $cp->submit_to_approval;
                                $assignee_id_array[] = $cp->pc_assignee;
                            }
                            $unique_id_array = array_unique($assignee_id_array);
                            foreach ($unique_id_array as $aia) {
                               $pc_id = $cp->pc_id;
                               $wca = $this->Front_model->getStudentById($aia);
                               if($wca)
                                {            
                                    if($wca->photo)
                                    {
                                    ?>                                 
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    else
                                    {
                                        $fullname = $wca->first_name.' '.$wca->last_name;
                                        $member_name = explode(" ", $fullname);
                                        $profile_name = "";
                                        foreach ($member_name as $n) 
                                        {
                                            $profile_name .= $n[0];
                                        }
                                        ?>
                                        <div class="avatar-group-item">
                                            <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } 
                            }
                            ?>
                        </div><?php
                    }
                    ?> 
                  </p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>
<?php 
$ccnt++;
}
}
?>
</div>
</div>

<?php 
   if(empty($contentPlanningDetails_plist) && empty($contentPlanningDetails_accepted_plist) && empty($contentPlanningDetails_pending_plist) && empty($contentPlanningDetails_readmore_plist))
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
<!-- END LIST CARD OF CONTENT PLANNER -->

<!-- START LIST VIEW OF CONTENT PLANNER -->
<div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
<div class="row">
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8"></div>
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria-list" style="line-height: 1.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear-list">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>

    <div class="row" id="created_project_list">
        <div class="col-lg-12">                                
            <div class="card card-body">
                <h4 class="card-title">Created Contents</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Project</th>
                                <th scope="col">Platform (Shown If Assigned or Created by You)</th>
                                <th scope="col">Assignee</th>
                            </tr>
                        </thead>
<tbody>
    <?php
        if($contentPlanningDetails_plist)
        {
            $lcnt=1;
            foreach($contentPlanningDetails_plist as $cpd)
            {
                $check_permission = $this->Front_model->check_file_preview_access($cpd->pid);
                $getProject2 = $this->Front_model->getProjectDetailID($cpd->pid);
                if($getProject2)
                {
                    $pcreated_by2 = $getProject2->pcreated_by;
                    $pmanager2 = $getProject2->pmanager;        
                }
                $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($cpd->pid);
                $proj_del = $this->Front_model->getProjectById($cpd->pid);
                $port_del = $this->Front_model->getPortfolio2($cpd->portfolio_id);
                ?>
                <tr class="search-list <?php if($cpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
                <td><?php echo $cpd->p_publish; ?></td>
                <td><?php
                if(!empty($cpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($cpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($cpd->pid);
                        ?><a href="<?php echo base_url('projects-overview/'.$cpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($cpd->pid);
                        ?><a href="<?php echo base_url('projects-overview-accepted/'.$cpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                }
                ?></td>
                <td>                                               
                <?php 
                if($getContentPlanningByDel){
                    $lpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        if($privilege_only_view == 'no')
                        {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
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
            ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
          }
        }    
      }  
    }
                        }
                        elseif(($pcreated_by2 == $this->session->userdata('d168_id')) || ($pmanager2 == $this->session->userdata('d168_id')))
                        {
                            ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                        }
                        else
                        {
                            if($check_permission)
                            {
                                if($check_permission->req_status == 'accepted')
                                {
                                ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                                }
                                else
                                {
                                ?><a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $cpd->pid;?>')"><?php
                                }
                            }
                            else
                            {
                            ?><a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $cpd->pid;?>')"><?php
                            }    
                        }
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d m-1" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d m-1" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d m-1" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d m-1" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d m-1" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d m-1" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d m-1" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d m-1" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d m-1" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $lpcnt++;
                    }
                }
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                <a onclick="return get_project_id5(<?php echo $cpd->pid; ?>);" href="javascript: void(0);" class="h4" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a>   
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
                <a onclick="return get_project_id5(<?php echo $cpd->pid; ?>);" href="javascript: void(0);" class="h4" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a>   
<?php
          }
        }    
      }  
    }
}
?>                     
                </td>
                <td><?php 
                if($getContentPlanningByDel){
                    ?>
                    <div class="avatar-group">
                    <?php
                        $assignee_id_array = array();
                        foreach ($getContentPlanningByDel as $cp) {
                            $assignee_id_array[] = $cp->written_content_assignee;
                            $assignee_id_array[] = $cp->pc_file_assignee;
                            $assignee_id_array[] = $cp->submit_to_approval;
                            $assignee_id_array[] = $cp->pc_assignee;
                        }
                        $unique_id_array = array_unique($assignee_id_array);
                        foreach ($unique_id_array as $aia) {
                           $pc_id = $cp->pc_id;
                           $wca = $this->Front_model->getStudentById($aia);
                           if($wca)
                            {            
                                if($wca->photo)
                                {
                                ?>                                 
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                <?php
                                }
                                else
                                {
                                    $fullname = $wca->first_name.' '.$wca->last_name;
                                    $member_name = explode(" ", $fullname);
                                    $profile_name = "";
                                    foreach ($member_name as $n) 
                                    {
                                        $profile_name .= $n[0];
                                    }
                                    ?>
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } 
                        }
                        ?>
                    </div><?php
                }
                ?></td>
                </tr>
                <?php
                $lcnt++;
            }
        }
        else
        {
            ?>
            <tr><td colspan="5"><center>No Data</center></td></tr>
            <?php
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
                <h4 class="card-title">Accepted Contents</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Project</th>
                                <th scope="col">Platform (Shown If Assigned or Created by You)</th>
                                <th scope="col">Assignee</th>
                            </tr>
                        </thead>
<tbody>
    <?php
        if($contentPlanningDetails_accepted_plist)
        {
            $lcnt=1;
            foreach($contentPlanningDetails_accepted_plist as $acpd)
            {
                $check_permission = $this->Front_model->check_file_preview_access($acpd->pid);
                $getProject3 = $this->Front_model->getProjectDetailID($acpd->pid);
                if($getProject3)
                {
                    $pcreated_by3 = $getProject3->pcreated_by;
                    $pmanager3 = $getProject3->pmanager;        
                }
                $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($acpd->pid);
                $proj_del = $this->Front_model->getProjectById($acpd->pid);
                $port_del = $this->Front_model->getPortfolio2($acpd->portfolio_id);
                ?>
                <tr class="search-list <?php if($acpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
                <td><?php echo $acpd->p_publish; ?></td>                
                <td><?php
                if(!empty($acpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($acpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($acpd->pid);
                        ?><a href="<?php echo base_url('projects-overview/'.$acpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($acpd->pid);
                        ?><a href="<?php echo base_url('projects-overview-accepted/'.$acpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                }
                ?></td>
                <td>                                               
                <?php 
                if($getContentPlanningByDel){
                    $lpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        if($privilege_only_view == 'no')
                        {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
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
            ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
          }
        }    
      }  
    }
                        }
                        elseif(($pcreated_by3 == $this->session->userdata('d168_id')) || ($pmanager3 == $this->session->userdata('d168_id')))
                        {
                            ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                        }
                        else
                        {
                            if($check_permission)
                            {
                                if($check_permission->req_status == 'accepted')
                                {
                                ?><a href="javascript: void(0);" onclick="show_platform_modal('planner','<?php echo $cp->platform; ?>',<?php echo $cp->pc_id; ?>);"><?php
                                }
                                else
                                {
                                ?><a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $acpd->pid;?>')"><?php 
                                }
                            }
                            else
                            {
                            ?><a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $acpd->pid;?>')"><?php 
                            }    
                        }
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d m-1" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d m-1" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d m-1" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d m-1" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d m-1" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d m-1" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d m-1" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d m-1" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d m-1" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $lpcnt++;
                    }
                }
if($privilege_only_view == 'no')
{
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                <a onclick="return get_project_id5(<?php echo $acpd->pid; ?>);" href="javascript: void(0);" class="h4" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a>    
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
                <a onclick="return get_project_id5(<?php echo $acpd->pid; ?>);" href="javascript: void(0);" class="h4" style="color:#383838 !important" title="Add More Content"><i class="mdi mdi-plus"></i></a>    
            <?php
          }
        }    
      }  
    }
}
?>                    
                </td>
                <td><?php 
                if($getContentPlanningByDel){
                    ?>
                    <div class="avatar-group">
                    <?php
                        $assignee_id_array = array();
                        foreach ($getContentPlanningByDel as $cp) {
                            $assignee_id_array[] = $cp->written_content_assignee;
                            $assignee_id_array[] = $cp->pc_file_assignee;
                            $assignee_id_array[] = $cp->submit_to_approval;
                            $assignee_id_array[] = $cp->pc_assignee;
                        }
                        $unique_id_array = array_unique($assignee_id_array);
                        foreach ($unique_id_array as $aia) {
                           $pc_id = $cp->pc_id;
                           $wca = $this->Front_model->getStudentById($aia);
                           if($wca)
                            {            
                                if($wca->photo)
                                {
                                ?>                                 
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                <?php
                                }
                                else
                                {
                                    $fullname = $wca->first_name.' '.$wca->last_name;
                                    $member_name = explode(" ", $fullname);
                                    $profile_name = "";
                                    foreach ($member_name as $n) 
                                    {
                                        $profile_name .= $n[0];
                                    }
                                    ?>
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } 
                        }
                        ?>
                    </div><?php
                }
                ?></td>
                </tr>
                <?php
                $lcnt++;
            }
        }
        else
        {
            ?>
            <tr><td colspan="5"><center>No Data</center></td></tr>
            <?php
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
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Project</th>
                                <th scope="col">Platform (Shown If Assigned or Created by You)</th>
                                <th scope="col">Assignee</th>
                            </tr>
                        </thead>
<tbody>
    <?php
        if($contentPlanningDetails_pending_plist)
        {
            $lcnt=1;
            foreach($contentPlanningDetails_pending_plist as $pcpd)
            {
                $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($pcpd->pid);
                $proj_del = $this->Front_model->getProjectById($pcpd->pid);
                $port_del = $this->Front_model->getPortfolio2($pcpd->portfolio_id);
                ?>
                <tr class="search-list <?php if($pcpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">                
                <td><?php echo $pcpd->p_publish; ?></td>
                <td><?php
                if(!empty($pcpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($pcpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($pcpd->pid);
                        ?><a href="<?php echo base_url('projects-overview/'.$pcpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($pcpd->pid);
                        ?><a onclick="return ProjectOverviewRequestModal(<?php echo $pcpd->pid;?>)" href="javascript: void(0);" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                }
                ?></td>
                <td>                                               
                <?php 
                if($getContentPlanningByDel){
                    $lpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        ?><a href="javascript: void(0);"><?php
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d m-1" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d m-1" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d m-1" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d m-1" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d m-1" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d m-1" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d m-1" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d m-1" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d m-1" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $lpcnt++;
                    }
                }
                ?>                        
                </td>
                <td><?php 
                if($getContentPlanningByDel){
                    ?>
                    <div class="avatar-group">
                    <?php
                        $assignee_id_array = array();
                        foreach ($getContentPlanningByDel as $cp) {
                            $assignee_id_array[] = $cp->written_content_assignee;
                            $assignee_id_array[] = $cp->pc_file_assignee;
                            $assignee_id_array[] = $cp->submit_to_approval;
                            $assignee_id_array[] = $cp->pc_assignee;
                        }
                        $unique_id_array = array_unique($assignee_id_array);
                        foreach ($unique_id_array as $aia) {
                           $pc_id = $cp->pc_id;
                           $wca = $this->Front_model->getStudentById($aia);
                           if($wca)
                            {            
                                if($wca->photo)
                                {
                                ?>                                 
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                <?php
                                }
                                else
                                {
                                    $fullname = $wca->first_name.' '.$wca->last_name;
                                    $member_name = explode(" ", $fullname);
                                    $profile_name = "";
                                    foreach ($member_name as $n) 
                                    {
                                        $profile_name .= $n[0];
                                    }
                                    ?>
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } 
                        }
                        ?>
                    </div><?php
                }
                ?></td>
                </tr>
                <?php
                $lcnt++;
            }
        }
        else
        {
            ?>
            <tr><td colspan="5"><center>No Data</center></td></tr>
            <?php
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
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Project</th>
                                <th scope="col">Platform (Shown If Assigned or Created by You)</th>
                                <th scope="col">Assignee</th>
                            </tr>
                        </thead>
<tbody>
    <?php
        if($contentPlanningDetails_readmore_plist)
        {
            $lcnt=1;
            foreach($contentPlanningDetails_readmore_plist as $rcpd)
            {
                $getContentPlanningByDel = $this->Front_model->getContentPlanningByDel($rcpd->pid);
                $proj_del = $this->Front_model->getProjectById($rcpd->pid);
                $port_del = $this->Front_model->getPortfolio2($rcpd->portfolio_id);
                ?>
                <tr class="search-list <?php if($rcpd->gid == 0){ echo "regular_proj";} else { echo "goal_proj";}?>">
                <td><?php echo $rcpd->p_publish; ?></td>
                <td><?php
                if(!empty($rcpd->pid))
                {
                    $check_page = $this->Front_model->ProjectDetail($rcpd->pid);
                    if($check_page)
                    {
                        $pro = $this->Front_model->getProjectById($rcpd->pid);
                        ?><a href="<?php echo base_url('projects-overview/'.$rcpd->pid)?>" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                    else
                    {
                        $pro = $this->Front_model->getProjectById($rcpd->pid);
                        ?><a onclick="return ProjectOverviewRequestModal(<?php echo $rcpd->pid;?>)" href="javascript: void(0);" class="nameLink" title="Open Project"><?php echo $proj_del->pname; ?></a><?php
                    }
                }
                ?></td>
                <td>                                               
                <?php 
                if($getContentPlanningByDel){
                    $lpcnt=1;
                    foreach ($getContentPlanningByDel as $cp) {
                        ?><a href="javascript: void(0);"><?php
                        if($cp->platform == 'twitter')
                        {
                            echo '<i class="fab fa-twitter font-size-24 social-d m-1" title="Twitter"></i>';
                        }else if($cp->platform == 'facebook')
                        {
                            echo '<i class="fab fa-facebook font-size-24 social-d m-1" title="Facebook"></i>';
                        }else if($cp->platform == 'instagram')
                        {
                            echo '<i class="fab fa-instagram font-size-24 social-d m-1" title="Instagram"></i>';
                        }else if($cp->platform == 'linkedin')
                        {
                            echo '<i class="fab fa-linkedin font-size-24 social-d m-1" title="LinkedIn"></i>';
                        }else if($cp->platform == 'google-my-business')
                        {
                            echo '<i class="mdi mdi-google-my-business font-size-24 social-d m-1" title="Google My Business"></i>';
                        }else if($cp->platform == 'pinterest')
                        {
                            echo '<i class="fab fa-pinterest font-size-24 social-d m-1" title="Pinterest"></i>';
                        }else if($cp->platform == 'youtube')
                        {
                            echo '<i class="fab fa-youtube font-size-24 social-d m-1" title="YouTube"></i>';
                        }else if($cp->platform == 'blogger')
                        {
                            echo '<i class="fab fa-blogger font-size-24 social-d m-1" title="Blog"></i>';
                        }else if($cp->platform == 'tiktok')
                        {
                            echo '<i class="fab fa-tiktok font-size-24 social-d m-1" title="TikTok"></i>';
                        }else{
                            echo $cp->platform;
                        }
                        ?></a><?php
                        $lpcnt++;
                    }
                }
                ?>                        
                </td>
                <td><?php 
                if($getContentPlanningByDel){
                    ?>
                    <div class="avatar-group">
                    <?php
                        $assignee_id_array = array();
                        foreach ($getContentPlanningByDel as $cp) {
                            $assignee_id_array[] = $cp->written_content_assignee;
                            $assignee_id_array[] = $cp->pc_file_assignee;
                            $assignee_id_array[] = $cp->submit_to_approval;
                            $assignee_id_array[] = $cp->pc_assignee;
                        }
                        $unique_id_array = array_unique($assignee_id_array);
                        foreach ($unique_id_array as $aia) {
                           $pc_id = $cp->pc_id;
                           $wca = $this->Front_model->getStudentById($aia);
                           if($wca)
                            {            
                                if($wca->photo)
                                {
                                ?>                                 
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <img src="<?php echo base_url('assets/student_photos/'.$wca->photo);?>" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                <?php
                                }
                                else
                                {
                                    $fullname = $wca->first_name.' '.$wca->last_name;
                                    $member_name = explode(" ", $fullname);
                                    $profile_name = "";
                                    foreach ($member_name as $n) 
                                    {
                                        $profile_name .= $n[0];
                                    }
                                    ?>
                                    <div class="avatar-group-item">
                                        <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $wca->reg_id;?>)" class="text-white" title="<?php echo "View: ".$wca->first_name.' '.$wca->last_name;?>">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle btn-d text-white font-size-16"><?php echo strtoupper($profile_name);?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } 
                        }
                        ?>
                    </div><?php
                }
                ?></td>
                </tr>
                <?php
                $lcnt++;
            }
        }
        else
        {
            ?>
            <tr><td colspan="5"><center>No Data</center></td></tr>
            <?php
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
<!-- END LIST VIEW OF CONTENT PLANNER -->

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

<!-- MODAL START SELECT PORTFOLIO AND PROJECT -->
<div class="modal fade select-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Plan New Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" name="select_project_form" id="select_project_form">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if($plist || $accepted_plist)
                            {
                                ?>
                                <div class="form-group mb-2">
                                    <label for="portfolio_name" class="col-form-label">Portfolio <span class="text-danger">*</span></label>
                                    <select class="form-select select2" onchange="get_portfolio_projects(this.value);" name="portfolio_id" id="portfolio_id">
                                        <option value="" selected="">Select Portfolio</option>
                                    <?php
                                    $portfolio = $this->Front_model->Portfolio();
                                    $acceptedProjectList = $this->Front_model->AcceptedProjectListPortfolio();       
                                    if($portfolio || $acceptedProjectList)
                                    {
                                        if($portfolio){
                                            foreach($portfolio as $c)
                                            {
                                                ?>
                                                <option value="<?php echo $c->portfolio_id;?>">
                                                    <span><?php 
                                                    if($c->portfolio_user == 'company')
                                                    { 
                                                        echo $c->portfolio_name;
                                                    }
                                                    elseif($c->portfolio_user == 'individual')
                                                    { 
                                                        echo $c->portfolio_name.' '.$c->portfolio_lname;
                                                    }
                                                    else{ 
                                                        echo $c->portfolio_name.' '.$c->portfolio_lname;
                                                    }
                                                ?></span></option>
                                                <?php        
                                            }
                                        }
                                        if($acceptedProjectList){
                                            foreach($acceptedProjectList as $al)
                                            {
                                                $c_id = $al->portfolio_id;
                                                if($c_id != 0)
                                                {
                                                    $getAllPortfolio = $this->Front_model->getAllPortfolio($c_id);
                                                    if($getAllPortfolio){
                                                        if($getAllPortfolio->portfolio_createdby != $this->session->userdata('d168_id'))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $getAllPortfolio->portfolio_id;?>">
                                                                <span><?php 
                                                                if($getAllPortfolio->portfolio_user == 'company')
                                                                { 
                                                                    echo $getAllPortfolio->portfolio_name;
                                                                }elseif($getAllPortfolio->portfolio_user == 'individual')
                                                                { 
                                                                    echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;
                                                                }
                                                                else
                                                                { 
                                                                    echo $getAllPortfolio->portfolio_name;
                                                                }
                                                            ?></span>
                                                            </option>
                                                            <?php
                                                        }
                                                    }                                                    
                                                }
                                            }
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value=""><span>No Portfolio. Create New</span></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                </div>                                
                                <div class="form-group mb-2">
                                    <label for="pc_project_assign" class="col-form-label">Project <span class="text-danger">*</span></label>
                                    
                                        <select class="form-select" name="pc_project_assign" id="pc_project_assign" onchange="return get_project_id6();" required="">
                                            <option value="" selected="">Select Project</option>
                                        </select>
                                        <span id="pc_project_assignErr" class="text-danger"></span>
                                    
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="justify-content-end">
                            <button type="submit" id="select_project_button" class="btn btn-d btn-sm">Add New Content</button>
                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                            <a class="btn btn-sm bg-d text-white" data-bs-dismiss="modal" href="#">
                                Cancel 
                            </a>
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            <div class="font-weight-bold"><h5> -- OR -- </h5></div>
                        </div>
                        <div class="col-md-12">
                            <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-create');?>">
                                <i class="mdi mdi-plus"></i> Create Project and Add New Content
                            </a>
                        </div>
                    </div>
                </form>
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- MODAL END SELECT PORTFOLIO AND PROJECT -->

<!--  MODAL START ADD NEW CONTENT -->
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
                                    <input type="hidden" name="pc_id1" id="pc_id" value="">
                                </h2>
                                <div id="flush-collapse-1" class="row accordion-collapse collapse show accordion-body" aria-labelledby="flush-heading-1" data-bs-parent="#accordionFlushExample">
                                    <div class="col-md-6">                          
                                        <div class="form-group mb-2 platform">
                                            <label for="platform" class="col-form-label">Select Platform <span class="text-danger">*</span></label>
                                            <div class="platform-section">
                                                <label class="mr-10"><input onclick="platformChanges(this.value,1);" type="radio" value="twitter" class="InputPlatformCP1" id="platform" name="platform1">
                                                <i class="fab fa-twitter font-size-24" class="InputPlatformCP1" title="Twitter"></i></label>

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
                                            <textarea maxlength="5000" onkeyup="return onWrittenContentChange(this.value,1);" class="form-control" id="written_content" name="written_content1" rows="5" placeholder="Enter Written Content"></textarea>
                                            <span style="display:none;" class="text-danger written-content-span"></span>
                                            <span id="written_contentErr" class="text-danger"></span>
                                        </div>  

                                        <div class="form-group mb-2 written-content-2" style="display:none;">
                                            <label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label>
                                            <textarea maxlength="500" onkeyup="return onWrittenContent2Change(this.value,1);" class="form-control" id="written_content_2" name="written_content_21" rows="5" placeholder="Enter Written Content 2"></textarea>
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
                                            <textarea maxlength="5000" id="meta_description" name="meta_description1" class="form-control blog-field" rows="5" placeholder="Enter Meta Description"></textarea>
                                            <span style="display: none;" class="text-danger meta_description-span"></span>
                                            <span id="meta_descriptionErr" class="text-danger"></span>
                                        </div>   

                                        <div class="form-group mb-2 tags" style="display:none;">
                                            <label for="tags" class="col-form-label tags_label">Tags</label>
                                            <textarea maxlength="400" class="form-control" id="tags" name="tags1" rows="5" placeholder="Add Tag"></textarea>
                                            <span style="display:none;" class="text-danger tags-span"></span>
                                            <span id="tagsErr" class="text-danger"></span>
                                        </div>  

                                        <div class="form-group mb-2 pc_file">
                                            <label class="col-form-label pc_file_label">Attach Media </label>
                                            <input type="hidden" name="total_content[]" id="total_content" value="1">
                                            <input class="form-control limitInputCPFiles" name="pc_file1[]" id="pc_file" type="file" accept="video/*,image/*" multiple="" data-id="1" />
                                            <span id="limitInputCPFilesErr1" class="text-danger"></span>
                                            <span id="pc_file1Err" class="text-danger"></span>
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
                                    if(!empty($this->input->post('pid')))
                                    {
                                       $get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                                       $porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);
                                        ?>
                                        <div class="form-group mb-2">
                                        <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                        
                                            <select name="written_content_assignee1" id="written_content_assignee1" class="form-control select2 written_content_assignee"  style="line-height: 1.5;">
                                            <?php                                           
                                            if($porttm){
                                                foreach ($porttm as $ptm) {
                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
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
                                    if(!empty($this->input->post('pid')))
                                    {
                                       $get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                                       $porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);
                                        ?>
                                        <div class="form-group mb-2">
                                        <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                        
                                            <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control select2 pc_file_assignee"  style="line-height: 1.5;">
                                            <?php                                           
                                            if($porttm){
                                                foreach ($porttm as $ptm) {
                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
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
                                    if(!empty($this->input->post('pid')))
                                    {
                                       $get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                                       $porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);
                                        ?>
                                        <div class="form-group mb-2">
                                        <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                        
                                            <select name="submit_to_approval1" id="submit_to_approval1" class="form-control select2 submit_to_approval"  style="line-height: 1.5;">
                                            <?php                                           
                                            if($porttm){
                                                foreach ($porttm as $ptm) {
                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
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
                                    if(!empty($this->input->post('pid')))
                                    {
                                       $get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));
                                       $porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);
                                        ?>
                                        <div class="form-group mb-2">
                                        <label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label>
                                        
                                            <select name="pc_assignee1" id="pc_assignee1" class="form-control select2 pc_assignee"  style="line-height: 1.5;">
                                            <?php                                           
                                            if($porttm){
                                                foreach ($porttm as $ptm) {
                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
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
                                        <label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label>
                                        
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
                                        <div class="col-lg-2">
                                            <button type="button" class="add_dup_pc_link1 btn btn-d btn-sm">Add Another link</button>                                                   
                                        </div>
                                    </div>
                                    <div class="pc_link_div1"></div>
                                    <span id="link_validErr1" class="text-danger"></span>                    
                                </div> 
                            </div>                                                         
                        </div><br>
                        <button type="button" id="add_more_plan_content" class="btn btn-d btn-sm">Add More Content</button>
                        <div class="row float-end mb-5"><div class="justify-content-end float-end">
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
</div>
<!--  MODAL END ADD NEW CONTENT -->
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
<!-- CP Edit Modal -->
<div class="modal fade" id="EditCPModalLabel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-scrollable">
       <div class="modal-content" id="EditCPModalLabel_content">
           
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
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
        window.scrollTo(0, 0);
        var plan_content_wrapper = $('.plan-content-wrapper');
        var plan_content_id = plan_content_wrapper.children().last().attr('id');
        var plan_content_array = plan_content_id.split("-");
        var current_plan_id = plan_content_array[2];
        $('#flush-heading-'+current_plan_id).find('.platform-button-'+current_plan_id).addClass('collapsed');
        $('#flush-heading-'+current_plan_id).find('.platform-button-'+current_plan_id).attr('aria-expanded',false);
        $('#flush-collapse-'+current_plan_id).removeClass('show');
        var plan_id = parseInt(current_plan_id)+1;
        var plan_wrapperHTML = '<div class="accordion-item" id="plan-content-'+plan_id+'"><h2 class="accordion-header" id="flush-heading-'+plan_id+'"><button class="accordion-button fw-medium font-weight-semibold platform-button-'+plan_id+'" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-'+plan_id+'" aria-expanded="true" aria-controls="flush-collapse-'+plan_id+'">Platform '+plan_id+'</button><input type="hidden" name="pc_id'+plan_id+'" id="pc_id" value=""></h2><div id="flush-collapse-'+plan_id+'" class="row accordion-collapse collapse show accordion-body" aria-labelledby="flush-heading-'+plan_id+'" data-bs-parent="#accordionFlushExample"><div class="col-md-6"><div class="form-group mb-2 platform"><label for="platform" class="col-form-label">Select Platform <span class="text-danger">*</span></label><div class="platform-section"><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="twitter" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-twitter font-size-24" title="Twitter"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="facebook" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-facebook font-size-24" title="Facebook"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="instagram" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-instagram font-size-24" title="Instagram"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="linkedin" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-linkedin font-size-24" title="LinkedIn"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="google-my-business" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="mdi mdi-google-my-business font-size-24" title="Google My Business"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="pinterest" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-pinterest font-size-24" title="Pinterest"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="youtube" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-youtube font-size-24" title="YouTube"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="blogger" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-blogger font-size-24" title="Blog"></i></label><label class="mr-10"><input onclick="platformChanges(this.value,'+plan_id+');" type="radio" value="tiktok" class="InputPlatformCP'+plan_id+'" id="platform" name="platform'+plan_id+'"><i class="fab fa-tiktok font-size-24" title="TikTok"></i> </label></div><span id="platformErr" class="text-danger"></span></div><div class="form-group mb-2 youtube-title" style="display:none;"><label for="pc_title" class="col-form-label pc_title_label">Title </label><input onkeyup="return onTitleChange(this.value,'+plan_id+');" id="pc_title" name="pc_title'+plan_id+'" type="text" class="form-control youtube-field" placeholder="Enter Title" maxlength="100"><span style="display: none;" class="text-danger title-span"></span><span id="pc_titleErr" class="text-danger"></span></div><div class="form-group mb-2 written_content"><label for="written_content" class="col-form-label written_content_label">Written Content </label><textarea maxlength="5000" onkeyup="return onWrittenContentChange(this.value,'+plan_id+');" class="form-control" id="written_content" name="written_content'+plan_id+'" rows="5" placeholder="Enter Written Content"></textarea><span style="display:none;" class="text-danger written-content-span"></span><span id="written_contentErr" class="text-danger"></span></div><div class="form-group mb-2 written-content-2" style="display:none;"><label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label><textarea maxlength="500" onkeyup="return onWrittenContent2Change(this.value,'+plan_id+');" class="form-control" id="written_content_2" name="written_content_2'+plan_id+'" rows="5" placeholder="Enter Written Content 2"></textarea><span style="display:none;" class="text-danger written-content-2-span"></span><span id="written_content_2Err" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="target_audience" class="col-form-label target_audience_label">Target Audience</label><input id="target_audience" name="target_audience'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Target Audience"><span style="display: none;" class="text-danger target_audience-span"></span><span id="target_audienceErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="solutions" class="col-form-label solutions_label">Solutions</label><input id="solutions" name="solutions'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Solutions"><span style="display: none;" class="text-danger solutions-span"></span><span id="solutionsErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="keywords" class="col-form-label keywords_label">Keywords</label><input id="keywords" name="keywords'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Keywords"><span style="display: none;" class="text-danger keywords-span"></span><span id="keywordsErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="internal_links" class="col-form-label internal_links_label">Internal Links</label><input id="internal_links" name="internal_links'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Internal Links"><span style="display: none;" class="text-danger internal_links-span"></span><span id="internal_linksErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="external_links" class="col-form-label external_links_label">External Links</label><input id="external_links" name="external_links'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter External Links"><span style="display: none;" class="text-danger external_links-span"></span><span id="external_linksErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="meta_title" class="col-form-label meta_title_label">Meta title</label><input id="meta_title" name="meta_title'+plan_id+'" type="text" class="form-control blog-field" placeholder="Enter Meta title"><span style="display: none;" class="text-danger meta_title-span"></span><span id="meta_titleErr" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display:none;"><label for="meta_description" class="col-form-label meta_description_label">Meta Description</label><textarea maxlength="5000" id="meta_description" name="meta_description'+plan_id+'" class="form-control blog-field" rows="5" placeholder="Enter Meta Description"></textarea><span style="display: none;" class="text-danger meta_description-span"></span><span id="meta_descriptionErr" class="text-danger"></span></div><div class="form-group mb-2 tags" style="display:none;"><label for="tags" class="col-form-label tags_label">Tags</label><textarea maxlength="400" class="form-control" id="tags" name="tags'+plan_id+'" rows="5" placeholder="Add Tag"></textarea><span style="display:none;" class="text-danger tags-span"></span><span id="tagsErr" class="text-danger"></span></div><div class="form-group mb-2 pc_file"><label class="col-form-label pc_file_label">Attach Media </label><input type="hidden" name="total_content[]" id="total_content" value="'+plan_id+'"><input class="form-control limitInputCPFiles'+plan_id+'" name="pc_file'+plan_id+'[]" id="pc_file" type="file" accept="video/*,image/*" multiple="" /><span id="limitInputCPFilesErr'+plan_id+'" class="text-danger"></span><span id="pc_file'+plan_id+'Err" class="text-danger"></span></div><div class="form-group mb-2 blog-field-div" style="display: none;"><label class="col-form-label pc_file_label">Attach Documents </label><input class="form-control blog-field" name="doc_pc_file'+plan_id+'[]" id="doc_pc_file" type="file" multiple="" /><span id="doc_pc_file'+plan_id+'Err" class="text-danger"></span></div></div><div class="col-md-6" style="margin-top: 90px;"><?php if(!empty($this->input->post('pid'))){$get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));$porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);?><div class="form-group mb-2"><label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label><select name="written_content_assignee'+plan_id+'" id="written_content_assignee'+plan_id+'" class="form-control written_content_assignee" style="line-height: 1.5;"><?php if($porttm){foreach ($porttm as $ptm) {$m = $this->Front_model->selectLogin($ptm->sent_to);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }?></select> <span id="written_content_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label><select name="written_content_assignee'+plan_id+'" id="written_content_assignee'+plan_id+'" class="form-control written_content_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="written_content_assigneeErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->input->post('pid'))){$get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));$porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);?><div class="form-group mb-2"><label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label><select name="pc_file_assignee'+plan_id+'" id="pc_file_assignee'+plan_id+'" class="form-control pc_file_assignee" style="line-height: 1.5;"><?php if($porttm){foreach ($porttm as $ptm) {$m = $this->Front_model->selectLogin($ptm->sent_to);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?></select> <span id="pc_file_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label><select name="pc_file_assignee'+plan_id+'" id="pc_file_assignee'+plan_id+'" class="form-control pc_file_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="pc_file_assigneeErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->input->post('pid'))){$get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));$porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);?><div class="form-group mb-2"><label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label><select name="submit_to_approval'+plan_id+'" id="submit_to_approval'+plan_id+'" class="form-control submit_to_approval" style="line-height: 1.5;"><?php if($porttm){foreach ($porttm as $ptm) {$m = $this->Front_model->selectLogin($ptm->sent_to);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?></select> <span id="submit_to_approvalErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label><select name="submit_to_approval'+plan_id+'" id="submit_to_approval'+plan_id+'" class="form-control submit_to_approval" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option></select> <span id="submit_to_approvalErr" class="text-danger"></span></div><?php } ?><?php if(!empty($this->input->post('pid'))){$get_pdetail = $this->Front_model->getProjectById($this->input->post('pid'));$porttm = $this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id);?><div class="form-group mb-2"><label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label><select name="pc_assignee'+plan_id+'" id="pc_assignee'+plan_id+'" class="form-control pc_assignee" style="line-height: 1.5;"><?php if($porttm){foreach ($porttm as $ptm) {$m = $this->Front_model->selectLogin($ptm->sent_to);if($m->reg_id != $this->session->userdata('d168_id')){?><option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option><?php }if($m->reg_id == $this->session->userdata('d168_id')){ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php }}}else{ ?><option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option><?php } ?><option value=""><span>None</span></option></select> <span id="pc_assigneeErr" class="text-danger"></span></div><?php }else{ ?> <div class="form-group mb-2"><label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label><select name="pc_assignee'+plan_id+'" id="pc_assignee'+plan_id+'" class="form-control pc_assignee" style="line-height: 1.5;"><option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option><option value=""><span>None</span></option></select> <span id="pc_assigneeErr" class="text-danger"></span></div><?php } ?></div><div class="row mb-2"><label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label><div class="col-lg-5"><input id="pc_link" name="pc_link'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="pc_link_comment" name="pc_link_comment'+plan_id+'[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-2"><button type="button" class="add_dup_pc_link'+plan_id+' btn btn-d btn-sm">Add Another link</button></div></div><div class="pc_link_div'+plan_id+'"></div><span id="link_validErr'+plan_id+'" class="text-danger"></span><br><div class="row float-end"><div class="justify-content-end float-end"><button style="float:right;" type="button" class="btn btn-sm bg-d text-white remove_plan_content">Remove Content</button></div></div></div></div>';
        $(plan_content_wrapper).append(plan_wrapperHTML); 
        // $('.plan-content-wrapper').find('.pub_Cdate').datepicker({todayHighlight: true,startDate: new Date()});
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
</script>
    </body>

</html>