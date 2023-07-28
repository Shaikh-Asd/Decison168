<?php
$page = 'goals';
$tm_active = "no";
$portfolio_owner_id = "";
$all_managers = array();
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Goal Overview</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css"> -->
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
    <!-- <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php echo base_url();?>assets/css/new-modals.css" rel="stylesheet" type="text/css" /> -->
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

if($gdetail)
{    
$gchecktm = $this->Front_model->GoalDetailAccepted($gdetail->gid);
if($gchecktm > 0)
{
    $tm_active = "yes";
}

if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($gdetail->gmanager == $this->session->userdata('d168_id')) || ($tm_active == "yes"))
{
    $gid = $gdetail->gid;
    $gcreated_by = $gdetail->gcreated_by;
    $powner = $this->Front_model->getStudentById($gcreated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($gdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($gdetail->portfolio_id);
        
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
                                                if($gdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($gdetail->portfolio_id);
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
                                                    <h5 class="font-size-15" style="padding: 8px;"><strong>GOAL:</strong> <b class="new_gname<?php echo $gdetail->gid;?>"><?php echo $gdetail->gname;?></b>
                                                    </h5>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
// $get_pro_managers_gid = $this->Front_model->get_pro_managers_gid($gdetail->gid);

if($gdetail != '0')
{
    // foreach($get_pro_managers_gid as $gpm)
    // {
        $all_managers[] = $gdetail->gmanager;
    // }
}
                                                        if($_COOKIE["d168_selectedportfolio"] == $gdetail->portfolio_id)
                                                        {
                                                            if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))  || (in_array($this->session->userdata('d168_id'), $all_managers)))
                                                            {
if(empty($this->session->userdata('d168_user_cor_id')))
{                                                                
    ?> 
    <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return GoalEditModal('<?php echo $gdetail->gid;?>');"><i class="mdi mdi-file-edit"></i> Edit Goal</a>
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
            if(in_array('goals', $cus_privilege))
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
        <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return GoalEditModal('<?php echo $gdetail->gid;?>');"><i class="mdi mdi-file-edit"></i> Edit Goal</a>
        <?php
      }
    }    
  }
}                                                            
                                                            }
if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers)))
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
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</a>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                    <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</button> 
            </form>
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</a>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                    <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</i></button> 
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                    <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                            <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add KPIs</button> 
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

                                                    if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers)))
                                                    {
if($privilege_only_view == 'no')
{
                                                        if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                    <form method="post" action="<?php echo base_url('view-goal-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>">
                                                        <input type="hidden" name="gname" id="gname" value="<?php echo $gdetail->gname;?>">
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
                if(in_array('goals', $cus_privilege))
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
                                                    <form method="post" action="<?php echo base_url('view-goal-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>">
                                                        <input type="hidden" name="gname" id="gname" value="<?php echo $gdetail->gname;?>">
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
                                                        if($_COOKIE["d168_selectedportfolio"] == $gdetail->portfolio_id)
                                                        {
                                                            if($gdetail->gcreated_by == $this->session->userdata('d168_id'))
                                                            {
if($privilege_only_view == 'no')
{
                                                        if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                    <!-- <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a> -->
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
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
                if(in_array('goals', $cus_privilege))
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
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                    <!-- <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a> -->
                                                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_goal('<?php echo $gdetail->gid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
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
        $getPackDetailG = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getGoalCount = $this->Front_model->getGoalCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetailG)
        {
          $total_projectsG = trim($getPackDetailG->pack_goals);
          $used_projectsG = trim($getGoalCount['goal_count_rows']);
          $check_typeG = is_numeric($total_projectsG);
          if($check_typeG == 'true')
          {
            if($used_projectsG < $total_projectsG)
            {
              ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetailG = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getGoalCount = $this->Front_model->getGoalCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetailG)
        {
          $total_projectsG = trim($getPackDetailG->pack_goals);
          $used_projectsG = trim($getGoalCount['goal_count_rows']);
          $check_typeG = is_numeric($total_projectsG);
          if($check_typeG == 'true')
          {
            if($used_projectsG < $total_projectsG)
            {
              ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            if(in_array('goals', $cus_privilege))
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
            $getPackDetailG = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getGoalCount = $this->Front_model->getGoalCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetailG)
            {
              $total_projectsG = trim($getPackDetailG->pack_goals);
              $used_projectsG = trim($getGoalCount['goal_count_rows']);
              $check_typeG = is_numeric($total_projectsG);
              if($check_typeG == 'true')
              {
                if($used_projectsG < $total_projectsG)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_goal('<?php echo $gdetail->gid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                                        if($Goal_tasks || $Goal_subtasks)
                                        {
                                        ?>
                                        <h5 class="font-size-15 mt-4">Progress :-
                                           <?php 
                                            $progress_done = $this->Front_model->Goalprogress_done($gid);
                                            $progress_total = $this->Front_model->Goalprogress_total($gid);
                                            $sub_progress_done = $this->Front_model->Goalsub_progress_done($gid);
                                            $sub_progress_total = $this->Front_model->Goalsub_progress_total($gid);
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

                                        <p class="text-muted pdes new_gdes<?php echo $gdetail->gid;?>"><?php 
                                        if(!empty($gdetail->gdes))
                                            {
                                                echo $gdetail->gdes;
                                            }
                                        ?></p>
                                        
                                        <div class="row task-dates">
                                        <?php
                                        $est = 0; // Variable to store the sum of estimated times
                                        $trc = 0;
                                        $total_seconds = 0;
                                        $totalTime = "00:00:00";
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
                                                $estimatedTime = $time->estimated_time;
                                                $totalMinutes += timeStringToMinutes($estimatedTime);
                                            }
                                        
                                            return minutesToTimeString($totalMinutes);
                                        }

                                        $est = calculateTotalTime($Goal_tasks);
                                        foreach ($Goal_tasks as $item) {
                                            $tracked_time = $item->tracked_time;
                                            $trackedTimeInSeconds = strtotime($tracked_time) - strtotime('00:00:00');
                                            $trc += $trackedTimeInSeconds;
                                            $character = "'";
                                             if (strpos($tracked_time, $character) !== false) {
                                                $tracked_time = str_replace($character, "", $tracked_time);
                                            } else {
                                            }
                                            // Create DateTime objects for the current time and the total time
                                            $datetime1 = DateTime::createFromFormat('H:i:s', $tracked_time);
                                            $datetime2 = DateTime::createFromFormat('H:i:s', $totalTime);

                                            // Add the current time to the total time
                                            $datetime2->add(new DateInterval('PT' . $datetime1->format('H') . 'H' . $datetime1->format('i') . 'M' . $datetime1->format('s') . 'S'));

                                            // Update the total time
                                            $totalTime = $datetime2->format('H:i:s');
                                        }
                                        ?>
                                            <div class="col-sm-3">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-time-five me-1 text-d"></i> Time Estimated</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $est; ?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-timer me-1 text-d"></i>  Time Tracked</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $totalTime; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row task-dates">
                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-d"></i> Start Date</h5>
                                                    <p class="text-muted mb-0 new_gsd<?php echo $gdetail->gid;?>"><?php echo date("j M, Y", strtotime($gdetail->gstart_date));?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-d"></i> End Date</h5>
                                                    <p class="text-muted mb-0 new_ged<?php echo $gdetail->gid;?>"><?php echo date("j M, Y", strtotime($gdetail->gend_date));?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-briefcase-alt-2 me-1 text-d"></i> Department</h5>
                                                    <p class="text-muted mb-0 new_gdept<?php echo $gdetail->gid;?>">
                                                    <?php 
                                                    $pdept = $this->Front_model->get_PDepartment($gdetail->gdept);
                                                    if($pdept)
                                                    {
                                                        echo $pdept->department;
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
                            if($g_strategies)
                            {
                            ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            KPIs
                                            <!-- <?php
                                            if($g_strategies)
                                                {
                                            ?>
                                            <a href="<?php echo base_url('portfolio-goal-strategies').'/'.$gid;?>" class="text-dark">
                                                <span class="badge bg-d">View All</span>
                                            </a>
                                            <?php
                                                }
                                            ?> -->
                                        </h4>
                                        <?php
                                        if($g_strategies)
                                        {
                                            foreach($g_strategies as $gs)
                                            {
                                            ?>
                                        <div class="accordion mb-2" id="accordionPanelsStayOpenExample<?php echo $gs->sid;?>">
                                            <div class="accordion-item">
                                              <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $gs->sid;?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $gs->sid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $gs->sid;?>">
                                                <strong>KPI:</strong> <span class="ms-1 new_sname<?php echo $gs->sid;?>"><?php echo $gs->sname;?></span>
                                                <?php
                                                                        $Strategy_tasks = $this->Front_model->file_itStrategy_tasks($gs->sid);
                                                                        $Strategy_subtasks = $this->Front_model->file_itStrategy_subtasks($gs->sid);
                                                                        
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      
                                                                      $estg = calculateTotalTime($Strategy_tasks);

                                                                      foreach ($Strategy_tasks as $itemg) {
                                                                          $tracked_timeg = $itemg->tracked_time;

                                                                          $trackedTimeg = $itemg->tracked_time;
                                                                          $trackedTimeInSecondsg = strtotime($trackedTimeg) - strtotime('00:00:00');
                                                                          $trcg += $trackedTimeInSecondsg;

                                                                          $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>
                                                                    </button>
                                              </h2>
                                              <div id="panelsStayOpen-collapseOne<?php echo $gs->sid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $gs->sid;?>">
                                                <div class="accordion-body">

                                                    <h5 class="font-size-14">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <p class="text-muted mb-0 font-size-12 new_sdes<?php echo $gs->sid;?>">
                                                                    <?php
                                                                    if(!empty($gs->sdes))
                                                                    {
                                                                        if(strlen($gs->sdes) > 160)
                                                                        {
                                                                          print_r(substr($gs->sdes,0,160).'...');
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $gs->sdes;
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "No Description!";
                                                                    }             
                                                                    ?>
                                                                </p>
                                                                <!-- <a href="<?php echo base_url('kpi-overview/'.$gs->sid)?>" class="nameLink new_sname<?php echo $gs->sid;?>" title="Open Strategy">
                                                                    <?php echo $gs->sname;?>
                                                                </a>  --> 
                                                            </div>
                                                            <div class="col-4">
                                                            <?php
                                                            // $Strategy_tasks = $this->Front_model->Strategy_tasks($gs->sid);
                                                            // $Strategy_subtasks = $this->Front_model->Strategy_subtasks($gs->sid);
                                                            if($Strategy_tasks || $Strategy_subtasks)
                                                            {
                                                                $progress_done = $this->Front_model->Strategyprogress_done($gs->sid);
                                                                $progress_total = $this->Front_model->Strategyprogress_total($gs->sid);
                                                                $sub_progress_done = $this->Front_model->Strategysub_progress_done($gs->sid);
                                                                $sub_progress_total = $this->Front_model->Strategysub_progress_total($gs->sid);
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
                                                            <div class="col-1">
                                                                <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return StrategiesOverviewModal(<?php echo $gs->sid;?>)" title="Preview KPI"><i class="mdi mdi-eye-outline"></i></a> 
                                                            </div>
                                                        </div>                                         
                                                    </h5>

                                                    <?php
                                                    $pro_list = $this->Front_model->StrategyAllProjectsList($gs->sid);
                                                    if($pro_list)
                                                    {
                                                        foreach($pro_list as $pr)
                                                        {
                                                        ?>
                                                        <div class="accordion-item mb-2">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $gs->sid.$pr->pid;?>">
                                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree<?php echo $gs->sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree<?php echo $gs->sid.$pr->pid;?>">
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

<?php
                                                                        $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      $estg = calculateTotalTime($p_tasks);
                                                                      foreach ($p_tasks as $itemg) {
                                                                            $tracked_timeg = $itemg->tracked_time;
                                                                            $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>


                                                          </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapseThree<?php echo $gs->sid.$pr->pid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree<?php echo $gs->sid.$pr->pid;?>">
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
                                                                            if(strlen($pr->pdes) > 95)
                                                                            {
                                                                              print_r(substr($pr->pdes,0,95).'...');
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
                                                                    </a>  -->   
                                                                </div>
                                                                <div class="col-4">
                                                                    <?php
                                                                    
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
                                                                                echo '8%';
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
                                                            </div>                                     <?php                         
                                                            }
                                                            else
                                                            {
                                                            $gmember = $this->Front_model->CheckProjectTeamMember($pr->pid);
                                                            if(!empty($gmember))
                                                            {
                                                                foreach($gmember as $member)
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
                                                                            if(strlen($pr->pdes) > 95)
                                                                            {
                                                                              print_r(substr($pr->pdes,0,95).'...');
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
                                                                                echo '8%';
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
                                                                                if(strlen($pr->pdes) > 95)
                                                                                {
                                                                                  print_r(substr($pr->pdes,0,95).'...');
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
                                                                                echo '8%';
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
                                                        <?php
                                                        }
                                                    }
$gdetail = $this->Front_model->GoalDetail($gs->gid);
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
if($_COOKIE["d168_selectedportfolio"] == $gs->portfolio_id)
{                   
if(($gs->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
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
                        <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                        <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                            <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                        <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                    <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                    <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                        <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                        <input type="hidden" name="gid" value="<?php echo $gs->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $gs->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gs->gdept_id;?>">
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
                                        </div>                                       
                                            <?php
                                            }
                                        }
if($_COOKIE["d168_selectedportfolio"] == $gdetail->portfolio_id)
{
if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers)))
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
        <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm" onclick="return Expire_Package_popup();" title="Add KPI">
                <span class="avatar-title bg-transparent text-reset">
                    <i class="bx bx-plus"></i> Add KPIs
                </span>
        </button>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                                <span class="avatar-title bg-transparent text-reset">
                                    <i class="bx bx-plus"></i> Add KPIs
                                </span>
                        </button> 
                </form>
              <?php
            }
            else
            {
                ?>
                <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm" onclick="return limit_Exceeds_popup();" title="Add KPI">
                        <span class="avatar-title bg-transparent text-reset">
                            <i class="bx bx-plus"></i> Add KPIs
                        </span>
                </button>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                    <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                            <span class="avatar-title bg-transparent text-reset">
                                <i class="bx bx-plus"></i> Add KPIs
                            </span>
                    </button>
            </form>
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                                <span class="avatar-title bg-transparent text-reset">
                                    <i class="bx bx-plus"></i> Add KPIs
                                </span>
                        </button>
                </form>
              <?php
            }
            else
            {
                ?>
                <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm" onclick="return limit_Exceeds_popup();" title="Add KPI">
                        <span class="avatar-title bg-transparent text-reset">
                            <i class="bx bx-plus"></i> Add KPIs
                        </span>
                </button>
                <?php
            }
          }
          else
          {
            ?>
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                    <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                    <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                            <span class="avatar-title bg-transparent text-reset">
                                <i class="bx bx-plus"></i> Add KPIs
                            </span>
                    </button>
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
            <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm" onclick="return Expire_Package_popup();" title="Add KPI">
                    <span class="avatar-title bg-transparent text-reset">
                        <i class="bx bx-plus"></i> Add KPIs
                    </span>
            </button>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$gdetail->gid);
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
                    <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                            <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                            <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                                    <span class="avatar-title bg-transparent text-reset">
                                        <i class="bx bx-plus"></i> Add KPIs
                                    </span>
                            </button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm" onclick="return limit_Exceeds_popup();" title="Add KPI">
                            <span class="avatar-title bg-transparent text-reset">
                                <i class="bx bx-plus"></i> Add KPIs
                            </span>
                    </button>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $gdetail->gdept;?>">
                        <input type="hidden" name="port_id" value="<?php echo $gdetail->portfolio_id;?>">
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Add KPI">
                                <span class="avatar-title bg-transparent text-reset">
                                    <i class="bx bx-plus"></i> Add KPIs
                                </span>
                        </button>
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
                        
                        <!-- <div class="motivator_div_cal">
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
                        </div> -->
                        
                        <?php
                        if($gdetail->gcreated_by == $this->session->userdata('d168_id'))//for goal owner
                        {
                        ?>
                        <div class="card">
                                    <button class="btn members-button-d" style="text-align: start;font-size: 15px;font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                       <i class="mdi mdi-account-group me-1"></i> Members 
                                       <?php
                                       $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                       if($check_notify_goal_suggested)
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
                                        <!-- Nav tabs -->
                                        <h4 class="card-title">Team Members
<?php
if($privilege_only_view == 'no')
{
?>
                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#gdetail_AddMember" title="Add Team Member">
                                                    <span class="avatar-title bg-transparent text-reset">
                                                        <i class="bx bx-plus"></i>
                                                    </span>
                                            </button>
<?php
}
?>
                                        </h4>
                                        <!-- <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#team_membertab" role="tab">
                                                    <span>Team Members
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#gdetail_AddMember" title="Add Team Member">
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
                                        </ul> -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="team_membertab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 800px;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Goal Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($gdetail->gmanager != '0')
                                                    {
                                                        $gmanager_det = $this->Front_model->getStudentById($gdetail->gmanager);
                                                        if($gmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Goal Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $gdetail->gmanager;?>)" class="text-dark" title="View Profile"><?php echo $gmanager_det->first_name.' '.$gmanager_det->last_name;?></a>
<?php
if($privilege_only_view == 'no')
{
?> 
                                                            <a href="javascript:void(0)" onclick="return direct_remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $gmanager_det->first_name;?>','<?php echo $gmanager_det->last_name;?>');" class="pt-2 pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3 m-1"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
<?php
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
                                                    $ptm = $this->Front_model->GoalTeamMember($gid);
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
                                                                        if($gdetail->gmanager == $pm->gmember)
                                                                        {
                                                                          ?>
                                                                         <a href="javascript:void(0)" onclick="return remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php   
                                                                        }
                                                                        ?>

                                                                        <a href="javascript:void(0)" onclick="return delete_gMember('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark"title="Remove" ><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                        if($gcreated_by != $pm->gmember)
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
                                                                        if($gdetail->gmanager == "0")
                                                                        {
                                                                         ?>
                                                                         <a href="javascript:void(0)" onclick="return assign_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php   
                                                                        }
                                                                        else
                                                                        {
                                                                            if($gdetail->gmanager == $pm->gmember)
                                                                            {
                                                                              ?>
                                                                             <a href="javascript:void(0)" onclick="return remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                             <?php   
                                                                            }
                                                                            else
                                                                            {
                                                                               $exist_manager = "";
                                                                               $manager_name = $this->Front_model->getStudentById($gdetail->gmanager);
                                                                               if($manager_name) 
                                                                               {
                                                                                $exist_manager = $manager_name->first_name.' '.$manager_name->last_name;
                                                                               }
                                                                            ?>
                                                                             <a href="javascript:void(0)" onclick="return assign_goalmanager_replace('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>','<?php echo $exist_manager;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                             <?php 
                                                                            }
                                                                        }
                                                                        ?>
                                                                        
                                                                        
                                                                        <a href="javascript:void(0)" onclick="return delete_gMember('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                    $invited_member = $this->Front_model->InvitedGoalMember($gid); 
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
                                                                        <a href="javascript:void(0)" onclick="return delete_iGMember('<?php echo $gdetail->gid;?>','<?php echo $im->igm_id;?>','<?php echo $im->sent_to;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                           $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                                           if($check_notify_goal_suggested)
                                                            {
                                                                if($check_notify_goal_suggested->already_register == 'yes')
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
                                                    $suggested_member = $this->Front_model->SuggestedGoalMember($gid);
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
                                                                        <a href="javascript:void(0)" onclick="return add_SuggestedGMember('<?php echo $gdetail->gid;?>','<?php echo $sm->suggest_id;?>','<?php echo $sm->first_name;?>','<?php echo $sm->last_name;?>');" class="text-dark" id="add_SuggestedGMemberButton<?php echo $sm->suggest_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                                           $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                                           if($check_notify_goal_suggested)
                                                            {
                                                                if($check_notify_goal_suggested->already_register == 'no')
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
                                                    $sinvited_member = $this->Front_model->SuggestedInviteGoalMember($gid); 
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
            <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
            <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                    <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                  <!-- <div class="tab-pane" id="request_membertab" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 300px;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr class="table-primary">
                                                        <th colspan="3">Membership Requested:</th>
                                                    </tr>
                                                    <?php
                                                    $RequestAsProjectMember = $this->Front_model->RequestAsProjectMember($gid);
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
                                                                <td><h5 class="font-size-14 m-0"><a href="<?php echo base_url('team-view-profile/'.$rpm->reg_id)?>" class="text-dark" title="View Profile"><?php echo $rpm->first_name." ".$rpm->last_name; ?></a></h5></td>
                                                                <td>
                                                                <?php
                                                                if($rpm->mode == "sent_req")
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return sentReq_to_Requestedgmember('<?php echo $gdetail->gid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedgmemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                                                                </div>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return add_Requestedgmember('<?php echo $gdetail->gid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedgmemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                      </div>
                                                </p>
                                            </div> -->
                              </div>
                                    </div>
                                </div>
                                </div>
                        <?php
                        }
                        elseif(($portfolio_owner_id == $this->session->userdata('d168_id'))  || (in_array($this->session->userdata('d168_id'), $all_managers)))// for goal manager & portfolio owner
                        {
                        ?>
                        <div class="card">
                                    <button class="btn members-button-d" style="text-align: start;font-size: 15px;font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                       <i class="mdi mdi-account-group me-1"></i> Members 
                                       <?php
                                       $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                       if($check_notify_goal_suggested)
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
                                        <!-- Nav tabs -->
                                        <h4 class="card-title">Team Members
<?php
if($privilege_only_view == 'no')
{
?>
                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#gdetail_AddMember" title="Add Team Member">
                                                    <span class="avatar-title bg-transparent text-reset">
                                                        <i class="bx bx-plus"></i>
                                                    </span>
                                            </button>
<?php 
}
?>
                                        </h4>
                                        <!-- <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#team_membertab" role="tab">
                                                    <span>Team Members
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#gdetail_AddMember" title="Add Team Member">
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
                                        </ul> -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="team_membertab" role="tabpanel">
                                        <p class="mb-0">
                                      <div data-simplebar style="max-height: 800px;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Goal Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($gdetail->gmanager != '0')
                                                    {
                                                        $gmanager_det = $this->Front_model->getStudentById($gdetail->gmanager);
                                                        if($gmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Goal Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $gdetail->gmanager;?>)" class="text-dark" title="View Profile"><?php echo $gmanager_det->first_name.' '.$gmanager_det->last_name;?></a> 
                                                            <?php
                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                            {
if($privilege_only_view == 'no')
{
                                                                ?>
                                                            <a href="javascript:void(0)" onclick="return direct_remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $gmanager_det->first_name;?>','<?php echo $gmanager_det->last_name;?>');" class="pt-2 pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3 m-1"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
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
                                                    $ptm = $this->Front_model->GoalTeamMember($gid);
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
                                                                        if($gdetail->gmanager == $pm->gmember)
                                                                        {
                                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                            {
                                                                          ?>
                                                                         <a href="javascript:void(0)" onclick="return remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php
                                                                            }   
                                                                        }

                                                                        if($pm->gmember != $this->session->userdata('d168_id'))
                                                                        {
                                                                            if($pm->gmember != $portfolio_owner_id)
                                                                            {
                                                                        ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_gMember('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark"title="Remove" ><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                        if($gcreated_by != $pm->gmember)
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
                                                                        if($gdetail->gmanager == "0")
                                                                        {
                                                                            if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                            {
                                                                         ?>
                                                                         <a href="javascript:void(0)" onclick="return assign_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                         <?php  
                                                                            } 
                                                                        }
                                                                        else
                                                                        {
                                                                            if($gdetail->gmanager == $pm->gmember)
                                                                            {
                                                                                if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                              ?>
                                                                             <a href="javascript:void(0)" onclick="return remove_goalmanager('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="pro_manager_icon" title="Remove as Manager"><i class="bx bx-user-x text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                             <?php  
                                                                                } 
                                                                            }
                                                                            else
                                                                            {
                                                                                if($portfolio_owner_id == $this->session->userdata('d168_id'))
                                                                                {
                                                                               $exist_manager = "";
                                                                               $manager_name = $this->Front_model->getStudentById($gdetail->gmanager);
                                                                               if($manager_name) 
                                                                               {
                                                                                $exist_manager = $manager_name->first_name.' '.$manager_name->last_name;
                                                                               }
                                                                            ?>
                                                                             <a href="javascript:void(0)" onclick="return assign_goalmanager_replace('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>','<?php echo $exist_manager;?>');" class="pro_manager_icon" title="Assign as Manager"><i class="bx bx-user-plus text-d h3"></i></a><img class="manager_loader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                             <?php 
                                                                                }
                                                                            }
                                                                        }
                                                                        if($pm->gmember != $this->session->userdata('d168_id'))
                                                                        {
                                                                            if($pm->gmember != $portfolio_owner_id)
                                                                            {
                                                                        ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_gMember('<?php echo $gdetail->gid;?>','<?php echo $pm->gmid;?>','<?php echo $pm->first_name;?>','<?php echo $pm->last_name;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                    $invited_member = $this->Front_model->InvitedGoalMember($gid); 
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
                                                                        <a href="javascript:void(0)" onclick="return delete_iGMember('<?php echo $gdetail->gid;?>','<?php echo $im->igm_id;?>','<?php echo $im->sent_to;?>');" class="text-dark" title="Remove"><i class="bx bxs-x-square h3 m-1"></i></a>
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
                                                           $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                                           if($check_notify_goal_suggested)
                                                            {
                                                                if($check_notify_goal_suggested->already_register == 'yes')
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
                                                    $suggested_member = $this->Front_model->SuggestedGoalMember($gid);
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
                                                                        <a href="javascript:void(0)" onclick="return add_SuggestedGMember('<?php echo $gdetail->gid;?>','<?php echo $sm->suggest_id;?>','<?php echo $sm->first_name;?>','<?php echo $sm->last_name;?>');" class="text-dark" id="add_SuggestedGMemberButton<?php echo $sm->suggest_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                                           $check_notify_goal_suggested = $this->Front_model->check_notify_goal_suggested($gid);
                                                           if($check_notify_goal_suggested)
                                                            {
                                                                if($check_notify_goal_suggested->already_register == 'no')
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
                                                    $sinvited_member = $this->Front_model->SuggestedInviteGoalMember($gid); 
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
            <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
            <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                    <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                <a href="javascript:void(0)" onclick="return add_Suggested_IGmember('<?php echo $gdetail->gid;?>','<?php echo $sim->suggest_id;?>','<?php echo $sim->gs_id;?>');" class="text-dark" id="add_Suggested_IGmemberButton<?php echo $sim->gs_id;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                  <!-- <div class="tab-pane" id="request_membertab" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 300px;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr class="table-primary">
                                                        <th colspan="3">Membership Requested:</th>
                                                    </tr>
                                                    <?php
                                                    $RequestAsProjectMember = $this->Front_model->RequestAsProjectMember($gid);
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
                                                                <td><h5 class="font-size-14 m-0"><a href="<?php echo base_url('team-view-profile/'.$rpm->reg_id)?>" class="text-dark" title="View Profile"><?php echo $rpm->first_name." ".$rpm->last_name; ?></a></h5></td>
                                                                <td>
                                                                <?php
                                                                if($rpm->mode == "sent_req")
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return sentReq_to_Requestedgmember('<?php echo $gdetail->gid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedgmemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
                                                                </div>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <div>
                                                                    <a href="javascript:void(0)" onclick="return add_Requestedgmember('<?php echo $gdetail->gid;?>','<?php echo $rpm->member;?>','<?php echo $rpm->first_name;?>','<?php echo $rpm->last_name;?>');" class="text-dark" id="add_RequestedgmemberButton<?php echo $rpm->member;?>" title="Add"><i class="bx bxs-plus-square h3 m-1 text-d"></i></a>
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
                                      </div>
                                                </p>
                                            </div> -->
                              </div>
                                    </div>
                                </div>
                                </div>
                        <?php
                        }
                        else //for goal team members
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
                                            <button type="button" class="btn btn-sm btn-light btn-rounded waves-effect" data-bs-toggle="modal" data-bs-target="#gdetail_SuggestTMember" title="Suggest Team Member"><i class="bx bx-plus"></i> Suggest Member</button>
                                            <?php 
                                            }
                                            ?>
                                        </h4>
                                      <div data-simplebar style="max-height: 800px;"> 
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Goal Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($gdetail->gmanager != '0')
                                                    {
                                                        $gmanager_det = $this->Front_model->getStudentById($gdetail->gmanager);
                                                        if($gmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Goal Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $gdetail->gmanager;?>)" class="text-dark" title="View Profile"><?php echo $gmanager_det->first_name.' '.$gmanager_det->last_name;?></a></th>
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
                                                    $ptm = $this->Front_model->GoalTeamMember($gid);
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
                                                        if($gcreated_by != $pm->gmember)
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
                                                    $invited_member = $this->Front_model->InvitedGoalMember($gid); 
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
                                                    $suggested_member = $this->Front_model->SuggestedGoalMember($gid);
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
                                                    $sinvited_member = $this->Front_model->SuggestedInviteGoalMember($gid); 
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
                        

                        <?php
                        if($view_history_date_goal)
                        {
                        ?>
                        <div class="card">
                            <div class="card-body" data-simplebar style="max-height: 500px;">
                                <h4 class="card-title mb-5">History</h4>
                                <ul class="verti-timeline list-unstyled">
                                    <?php
                                    $prev_date ='';
                                    foreach($view_history_date_goal as $v)
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_goal_hlist('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Today - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_goal_hlist('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Yesterday - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_goal_hlist('<?php echo $gid;?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
            }
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
                                    <!-- Goal Edit Modal -->
                                    <div id="GoalEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#GoalEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="GoalEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Strategies Overview Modal -->
                                    <div id="StrategiesOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#StrategiesOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="StrategiesOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

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

                                    <div id="GoalInsideOpenWorkModal" class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="#OpenWorkModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="GoalInsideOpenWorkModal_content" style="border: 2px solid #c7df19 !important">

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
<?php
if(($gdetail) || ($tm_active == "yes"))
{
if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))  || (in_array($this->session->userdata('d168_id'), $all_managers)))// for goal owner, goal manager & portfolio owner
{
    if($privilege_only_view == 'no')
    {
?>
<!-- Add Team Member Modal -->
<div class="modal fade" id="gdetail_AddMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="gdetail_AddTeamMemberForm" id="gdetail_AddTeamMemberForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg">
                            <?php
                            $port_id = $gdetail->portfolio_id;
                            $gid = $gdetail->gid;
                            $porttm = $this->Front_model->getAccepted_PortTM($port_id);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                    if($m)
                                    {
                                    $check_gm = $this->Front_model->check_gm($m->reg_id,$gid,$port_id);
                                    $check_gmem = "";
                                    if($check_gm)
                                    {
                                        $check_gmem = $check_gm->gmember;
                                    }
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_gmem))
                                      {
                                        $get_pdetail = $this->Front_model->getProjectById($gid);
                                        if($m->reg_id != $get_pdetail->gcreated_by)
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
                            <input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="gdetail_AddTeamMemberButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div> 
<?php
    }
}
else //for goal team members
{
    if($privilege_only_view == 'no')
    {
?>
<!-- Suggest Team Member Modal -->
<div class="modal fade" id="gdetail_SuggestTMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Suggest Team Members To Goal Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="gdetail_SuggestTMemberForm" id="gdetail_SuggestTMemberForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-7">
                            <?php
                            $port_id = $gdetail->portfolio_id;
                            $gid = $gdetail->gid;
                            $porttm = $this->Front_model->getAccepted_PortTM($port_id);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                    $check_gm = $this->Front_model->check_gm($m->reg_id,$gid,$port_id);
                                    $check_gmem = "";
                                    if($check_gm)
                                    {
                                        $check_gmem = $check_gm->gmember;
                                    }
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_gmem))
                                      {
                                        $get_pdetail = $this->Front_model->getProjectById($gid);
                                        if($m->reg_id != $get_pdetail->gcreated_by)
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
                            <input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>">
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
                    <button type="submit" id="gdetail_SuggestTMemberButton" class="btn btn-d">Suggest</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  
<?php
    }
}
}
?>
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- Required datatable js -->
<!-- <script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script> -->

<!-- Datatable init js -->
<!-- <script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>  -->
<script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>
<?php
if(($gdetail) || ($tm_active == "yes"))
{
if(($gdetail->gcreated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id'))  || (in_array($this->session->userdata('d168_id'), $all_managers)))// for goal owner, goal manager & portfolio owner
{
?>
<script>
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
</script>
<?php
}
else //for goal team members
{
?>
<script>
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
<?php
}
}
?>
<!-- Quote Modal -->
<!-- <div id="new_Modal_Design">
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
</div> -->
<!-- Quote Modal -->

<script>
// $("#nope_quoteModal, #close_quoteModal").on('click', function () {
//   $('#quoteModal').addClass('hidden');
//   $('#quoteModal').addClass('active');
// });

// $("#open_quoteModal").on('click', function () {
//     //debugger;
//   $(this).removeClass('active');
//   $('#quoteModal').removeClass('hidden');
// });

// //motivator read more option
// function motivator_readMore(i) {
//     var motivator_read_more = document.getElementById("motivator_read_more"+i);
//     var motivator_read_more_clicked = document.getElementById("motivator_read_more_clicked"+i);
//       motivator_read_more.style.display = "none";
//       motivator_read_more_clicked.style.display = "block";
//       $('.motivator_div_cal').css('min-height', '60%');
//       $('.motivator_body_cal').css('padding', '45px 30px');
//   }
// //motivator read less option
// function motivator_readLess(i) {
//     //debugger;
//     var motivator_read_more = document.getElementById("motivator_read_more"+i);
//     var motivator_read_more_clicked = document.getElementById("motivator_read_more_clicked"+i);
//       motivator_read_more.style.display = "block";
//       motivator_read_more_clicked.style.display = "none";
//       $('.motivator_div_cal').removeAttr("style");
//       $('.motivator_body_cal').removeAttr("style");
//   }
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
