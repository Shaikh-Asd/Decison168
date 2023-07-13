<?php
$page = 'goals';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>KPI Overview</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css"> -->
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/new-modals.css" rel="stylesheet" type="text/css" />
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
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Subtasks Overview</a></li> -->
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
if($sdetail)
{
    $sid = $sdetail->sid;
    $screated_by = $sdetail->screated_by;
    $powner = $this->Front_model->getStudentById($screated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($sdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($sdetail->portfolio_id);
        $portfolio_owner_id = "";
        if($check_Portfolio_owner_id)
        {
            $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
        }
?>      
                        <div class="row">
                        <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div data-simplebar style="max-height: 600px;"> 
                                    <div class="card-body">
                                        <div class="media">
                                           <div class="avatar-sm me-2">
                                                <?php
                                                if($sdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($sdetail->portfolio_id);
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
                                                    <h5 class="font-size-15" style="padding: 8px;"><strong>KPI:</strong> <b class="new_sname<?php echo $sdetail->sid;?>"><?php echo $sdetail->sname;?></b>
                                                    </h5>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
// $get_pro_managers_sid = $this->Front_model->get_pro_managers_sid($sdetail->sid);
// $all_managers_sid = array();
// if($get_pro_managers_sid)
// {
//     foreach($get_pro_managers_sid as $gpm)
//     {
//         $all_managers_sid[] = $gpm->pmanager;
//     }
// }

$gdetail = $this->Front_model->GoalDetail($sdetail->gid);
$all_managers_sid = array();
if($gdetail)
{
  if($gdetail != '0')
    {
        // foreach($get_pro_managers_gid as $gpm)
        // {
            $all_managers_sid[] = $gdetail->gmanager;
        // }
    }  
}

                                                        if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                        {
                                                            if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
                                                            {
if(empty($this->session->userdata('d168_user_cor_id')))
{
    ?> 
    <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return StrategiesEditModal('<?php echo $sdetail->sid;?>');"><i class="mdi mdi-file-edit"></i> Edit KPI</a>
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
            if(in_array('strategies', $cus_privilege))
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
        <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return StrategiesEditModal('<?php echo $sdetail->sid;?>');"><i class="mdi mdi-file-edit"></i> Edit KPI</a>
        <?php
      }
    }    
  }
}
                                                           }
if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
{
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if(empty($this->session->userdata('d168_user_cor_id')))
{
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
            </form>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
            </form>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
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
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
                <?php
              }
            } 
          }
        }
      }
    }    
  }
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
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
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
            <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
            </form>
            <?php
            }
            else
            {
              ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
            }
          }
          else
          {
            ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
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
            <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
            </form>
            <?php
            }
            else
            {
              ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
            }
          }
          else
          {
            ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
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
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
                <?php
                }
                else
                {
                  ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
                <?php
                }
              }
              else
              {
                ?>
                    <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                    </form>
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
                                                        else
                                                        {
                                                            echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                    }

                                                    if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
                                                    {
if($privilege_only_view == 'no')
{
      if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                    <form method="post" action="<?php echo base_url('view-kpi-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
                                                        <input type="hidden" name="sname" id="sname" value="<?php echo $sdetail->sname;?>">
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
                if(in_array('strategies', $cus_privilege))
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
                                                    <form method="post" action="<?php echo base_url('view-kpi-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
                                                        <input type="hidden" name="sname" id="sname" value="<?php echo $sdetail->sname;?>">
                                                       <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>   
                                                    </form>
                                                    <?php
          }
        }    
      }  
    }                                                  
}
                                                    }

                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                        {
                                                            if($sdetail->screated_by == $this->session->userdata('d168_id'))
                                                            {
if($privilege_only_view == 'no')
{
       if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                    <!-- <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a> -->
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
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
                if(in_array('strategies', $cus_privilege))
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
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                    <!-- <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a> -->
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
<?php
          }
        }    
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
        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
        if($getPackDetail)
        {
          $total_strategies = trim($getPackDetail->pack_goals_strategies);
          $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
          $check_type = is_numeric($total_strategies);
          if($check_type == 'true')
          {
            if($used_strategies < $total_strategies)
            {
              ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
        if($getPackDetail)
        {
          $total_strategies = trim($getPackDetail->pack_goals_strategies);
          $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
          $check_type = is_numeric($total_strategies);
          if($check_type == 'true')
          {
            if($used_strategies < $total_strategies)
            {
              ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                  <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
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
            if(in_array('strategies', $cus_privilege))
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
            if($getPackDetail)
            {
              $total_strategies = trim($getPackDetail->pack_goals_strategies);
              $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
              $check_type = is_numeric($total_strategies);
              if($check_type == 'true')
              {
                if($used_strategies < $total_strategies)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                
                                            </div>
                                        </div>

                                        <?php
                                        if($Strategy_tasks || $Strategy_subtasks)
                                        {
                                        ?>
                                        <h5 class="font-size-15 mt-4">Status :-
                                          <?php 
                                            $progress_done = $this->Front_model->Strategyprogress_done($sid);
                                            $progress_total = $this->Front_model->Strategyprogress_total($sid);
                                            $sub_progress_done = $this->Front_model->Strategysub_progress_done($sid);
                                            $sub_progress_total = $this->Front_model->Strategysub_progress_total($sid);
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

                                        <p class="text-muted pdes new_sdes<?php echo $sdetail->sid;?>"><?php 
                                        if(!empty($sdetail->sdes))
                                            {
                                                echo $sdetail->sdes;
                                            }
                                        ?></p>

                                        <div class="row task-dates">
                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-d"></i> Created Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($sdetail->screated_date));?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-briefcase-alt-2 me-1 text-d"></i> Progress</h5>
                                                    <p class="text-muted mb-0">
                                                    <?php 
                                                    if($sdetail->sprogress == "to_do")
                                                    {
                                                        echo "To Do";
                                                    }
                                                    elseif($sdetail->sprogress == "in_progress")
                                                    {
                                                        echo "In Progress";
                                                    }
                                                    elseif($sdetail->sprogress == "in_review")
                                                    {
                                                        echo "In Review";
                                                    }
                                                    elseif($sdetail->sprogress == "done")
                                                    {
                                                        echo "Done";
                                                    }
                                                    ?>
                                                    </p>
                                                </div>
                                            </div>
    
                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                    <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- end col -->   

                            <?php
                            if($s_projects)
                            {
                            ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            Projects
                                            <!-- <?php
                                            if($s_projects)
                                                {
                                            ?>
                                            <a href="<?php echo base_url('portfolio-goals-strategies-projects').'/'.$sid;?>" class="text-dark">
                                                <span class="badge bg-d">View All</span>
                                            </a>
                                            <?php
                                                }
                                            ?> -->
                                        </h4>
                                       <?php
                                        if($s_projects)
                                        {
                                            foreach($s_projects as $pr)
                                            {
                                            ?>
                                        <div class="accordion mb-2" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $sid.$pr->pid;?>">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree<?php echo $sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree<?php echo $sid.$pr->pid;?>">
                                                <?php
                                                   if($pr->ptype == 'content')
                                                   {
                                                    echo '<strong>CONTENT:</strong>  ';
                                                   }
                                                   else
                                                   {
                                                    echo '<strong>PROJECT:</strong>  ';
                                                   }
                                                    echo '<span class="ms-1">'.$pr->pname.'</span>';
                                                ?> 
                                              </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseThree<?php echo $sid.$pr->pid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree<?php echo $sid.$pr->pid;?>">
                                              <div class="accordion-body">

                                                <h5 class="font-size-14">
                                                <?php
                                                if($pr->pcreated_by == $this->session->userdata('d168_id'))
                                                {
                                                ?>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="text-muted mb-0 font-size-12">
                                                            <?php
                                                            if(!empty($pr->pdes))
                                                            {
                                                                if(strlen($pr->pdes) > 100)
                                                                {
                                                                  print_r(substr($pr->pdes,0,100).'...');
                                                                }
                                                                else
                                                                {
                                                                    echo $pr->pdes;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "No Description!";
                                                            }             
                                                            ?>
                                                        </p>
                                                        <!-- <a href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                            <?php echo $pr->pname;?>
                                                        </a> -->    
                                                    </div>
                                                    <div class="col-4">
                                                        <?php
                                                        $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                        if($p_tasks || $p_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->progress_done($pr->pid);
                                                            $progress_total = $this->Front_model->progress_total($pr->pid);
                                                            $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                            $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                            if($progress_total || $sub_progress_total)
                                                            {
                                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                        ?>
                                                            <div class="progress mt-2">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                if($progress == 0)
                                                                {
                                                                    echo '7%';
                                                                }
                                                                else
                                                                {
                                                                    echo $progress.'%';
                                                                }
                                                                ?>"><?php echo round($progress).'%'; ?></div>
                                                            </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                    <?php
                                                    if($p_tasks || $p_subtasks)
                                                    {
                                                    ?>
                                                        <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <?php                         
                                                }
                                                else
                                                {
                                                $pmember = $this->Front_model->CheckProjectTeamMember($pr->pid);
                                                if(!empty($pmember))
                                                {
                                                    foreach($pmember as $member)
                                                    {
                                                        if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                        {
                                                ?>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="text-muted mb-0 font-size-12">
                                                            <?php
                                                            if(!empty($pr->pdes))
                                                            {
                                                                if(strlen($pr->pdes) > 100)
                                                                {
                                                                  print_r(substr($pr->pdes,0,100).'...');
                                                                }
                                                                else
                                                                {
                                                                    echo $pr->pdes;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "No Description!";
                                                            }             
                                                            ?>
                                                        </p>
                                                        <!-- <a href="<?php echo base_url('projects-overview-accepted/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                            <?php echo $pr->pname;?>
                                                        </a>  --> 
                                                    </div>
                                                    <div class="col-4">
                                                        <?php
                                                        $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                        if($p_tasks || $p_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->progress_done($pr->pid);
                                                            $progress_total = $this->Front_model->progress_total($pr->pid);
                                                            $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                            $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                            if($progress_total || $sub_progress_total)
                                                            {
                                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                        ?>
                                                            <div class="progress mt-2">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                if($progress == 0)
                                                                {
                                                                    echo '7%';
                                                                }
                                                                else
                                                                {
                                                                    echo $progress.'%';
                                                                }
                                                                ?>"><?php echo round($progress).'%'; ?></div>
                                                            </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewAcceptedModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                        <?php
                                                        if($p_tasks || $p_subtasks)
                                                        {
                                                        ?>
                                                            <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php    
                                                        }
                                                        elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                        {
                                                ?>
                                                       <div class="row">
                                                            <div class="col-6">
                                                                <p class="text-muted mb-0 font-size-12">
                                                                    <?php
                                                                    if(!empty($pr->pdes))
                                                                    {
                                                                        if(strlen($pr->pdes) > 100)
                                                                        {
                                                                          print_r(substr($pr->pdes,0,100).'...');
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $pr->pdes;
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "No Description!";
                                                                    }             
                                                                    ?>
                                                                </p>
                                                               <!-- <a  href="<?php echo base_url('projects-overview-request/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                    <?php echo $pr->pname;?>
                                                                </a>  -->
                                                            </div>
                                                            <div class="col-4">
                                                            <?php
                                                            $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                            $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                            if($p_tasks || $p_subtasks)
                                                            {
                                                                $progress_done = $this->Front_model->progress_done($pr->pid);
                                                                $progress_total = $this->Front_model->progress_total($pr->pid);
                                                                $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                                $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                                if($progress_total || $sub_progress_total)
                                                                {
                                                                    $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                    $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                    $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                            ?>
                                                                <div class="progress mt-2">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                    if($progress == 0)
                                                                    {
                                                                        echo '7%';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $progress.'%';
                                                                    }
                                                                    ?>"><?php echo round($progress).'%'; ?></div>
                                                                </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                            <div class="col-2">
                                                                <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                            </div>
                                                        </div>     
                                                <?php  
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                <p class="mb-0 font-size-14 text-muted">
                                                   <strong>Not added in project as a member!</strong> 
                                                </p>
                                                    <!-- <a  href="javascript: void(0);" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" class="nameLink" title="Open Project">
                                                        Request to add in project as a member!
                                                    </a>
                                                    <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a> -->
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                </h5>
                                              </div>
                                            </div>
                                            </div>
                                        </div>
                                            <?php
                                            }
                                        }
if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
{                   
if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
{
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
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</a>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
            </form>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
            </form>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</a>
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
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                            <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
                <?php
              }
            } 
          }
        }
      }
    }    
  }
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
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</a>
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
            <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
            </form>
            <?php
            }
            else
            {
              ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
            }
          }
          else
          {
            ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
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
            <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
            </form>
            <?php
            }
            else
            {
              ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
            }
          }
          else
          {
            ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</a>
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
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
                <?php
                }
                else
                {
                  ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</a>
                <?php
                }
              }
              else
              {
                ?>
                    <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm"><i class="mdi mdi-plus"></i> Create Content</button> 
                    </form>
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
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                        </div>
                        <!-- end row -->

                    </div> 
                    <div class="col-lg-4">
                        
                        <div class="motivator_div_cal">
                            <div class="motivator_body_cal mb-2">
                                <h4 class="font-size-14 mt-3"><i class="bx bxs-quote-alt-left text-d h2 align-middle me-3"></i>
                                    <?php 
                                    if($motivator)
                                    {
                                        echo $motivator->quote;
                                        // if(strlen($motivator->quote)>90)
                                        // {
                                        //     echo '<span id="motivator_read_more'.$motivator->id.'">'.substr($motivator->quote,0,85).' ... <a href="javascript: void(0);" onclick="motivator_readMore('.$motivator->id.')" class="text-d" style="font-size: 13px;">See more</a></span>';

                                        //     echo '<span id="motivator_read_more_clicked'.$motivator->id.'" style=display:none;>'.$motivator->quote.' <a href="javascript: void(0);" onclick="motivator_readLess('.$motivator->id.')" class="text-d" style="font-size: 13px;">See less</a></span>';
                                        // }
                                        // else
                                        // {
                                        //     print($motivator->quote);
                                        // }
                                    }
                                    ?>
                                    <i class="bx bxs-quote-alt-right text-d h2 align-middle ms-3"></i></h4>
                                <p class="card-text font-size-12"><i class="bx bx-minus text-d h3 align-middle mt-2 me-1"></i>
                                    <?php 
                                    if($motivator)
                                    {
                                        echo $motivator->writer;
                                    }
                                    ?>
                                </p>
                                <div class="row mt-3">
                                    <div class="col-12 font-size-11">
                                    Submit a <a href="javascript:void(0)" id="open_quoteModal" class="text-d">Quote</a> 
                                    </div>
                                </div>                            
                            </div>
                        </div>

                        <?php
                        if($view_history_date_strategy)
                        {
                        ?>
                        <div class="card">
                            <div class="card-body" data-simplebar style="max-height: 500px;">
                                <h4 class="card-title mb-5">History</h4>
                                <ul class="verti-timeline list-unstyled">
                                    <?php
                                    $prev_date ='';
                                    foreach($view_history_date_strategy as $v)
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_strategy_hlist('<?php echo $sid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Today - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_strategy_hlist('<?php echo $sid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Yesterday - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_strategy_hlist('<?php echo $sid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                    <!-- Strategies Edit Modal -->
                                    <div id="StrategiesEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#StrategiesEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="StrategiesEditModal_content">
                                                
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
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script> 
<script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
        <?php
include('footer_links.php');
?>
<!-- Quote Modal -->
<div id="new_Modal_Design">
<div class="modals hidden" id="quoteModal">
  <div class="form" style="border-top-left-radius: 0.4rem;border-bottom-left-radius: 0.4rem;">
    <div class="row">
        <div class="col-12 text-center h4 m-3" style="color: #c5dc1c;">Submit A Quote</div>
    </div>
    <form name="request_quoteForm" id="request_quoteForm" method="post">
      <label>Author <span class="text-danger">*</span></label>
        <input id="writer" name="writer" type="text" class="form-control" placeholder="Enter Author Name..." required="">
        <span id="writerErr" class="text-danger"></span>

      <label>Quote <span class="text-danger">*</span></label>
        <textarea class="form-control" id="quote" name="quote" rows="4" placeholder="Enter Quote..." required=""></textarea>
        <span id="quoteErr" class="text-danger"></span>
      <br>
      <button type="submit" id="request_quoteButton" class="btn btn-sm btn-d">Send Request</button>
      <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
    </form>
  </div>
  <div class="invite" style="border-bottom-right-radius: 0.4rem;">
    <h3 style="margin-top: 13px;"><b style="color: #383838;">Got some Inspiration or Motivation to Share?</b></h3>
    <p style="font-size: 15px;">You can submit a quote, once approved, we will add it to the motivator rotation on the dashboard.</p>
    <div class="nope" id="nope_quoteModal">No Thanks</div>
    <div class="close" title="close" id="close_quoteModal"></div>
  </div>
</div>
</div>
<!-- Quote Modal -->

<script>
$("#nope_quoteModal, #close_quoteModal").on('click', function () {
  $('#quoteModal').addClass('hidden');
  $('#quoteModal').addClass('active');
});

$("#open_quoteModal").on('click', function () {
    //debugger;
  $(this).removeClass('active');
  $('#quoteModal').removeClass('hidden');
});

//motivator read more option
function motivator_readMore(i) {
    var motivator_read_more = document.getElementById("motivator_read_more"+i);
    var motivator_read_more_clicked = document.getElementById("motivator_read_more_clicked"+i);
      motivator_read_more.style.display = "none";
      motivator_read_more_clicked.style.display = "block";
      $('.motivator_div_cal').css('min-height', '60%');
      $('.motivator_body_cal').css('padding', '45px 30px');
  }
//motivator read less option
function motivator_readLess(i) {
    //debugger;
    var motivator_read_more = document.getElementById("motivator_read_more"+i);
    var motivator_read_more_clicked = document.getElementById("motivator_read_more_clicked"+i);
      motivator_read_more.style.display = "block";
      motivator_read_more_clicked.style.display = "none";
      $('.motivator_div_cal').removeAttr("style");
      $('.motivator_body_cal').removeAttr("style");
  }
</script>
<script src="<?php echo base_url();?>assets/js/croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/croppie.css">

<!-- <script src="<?php echo base_url();?>assets/js/mention.js"></script>
<script>
$(window).on( "load", function() {
    $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
});
var jArray= <?php echo json_encode($subtask_mentionList);?>;
//console.log(jArray);
 var myMention = new Mention({
    input: document.querySelector('#sub_message'),
    options: jArray
 })
</script> -->
    </body>

</html>
