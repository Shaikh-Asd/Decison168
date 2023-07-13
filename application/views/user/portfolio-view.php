<?php
$page = 'portfolio-view';

if($getp)
{
    $porttm = $this->Front_model->getAll_Accepted_PortTM($getp->portfolio_id);
    if($porttm)
    {
        foreach($porttm as $ptm)
        {
            $get_portfolio_accepted_notification = $this->Front_model->get_portfolio_accepted_notification($ptm->pim_id);
            if($get_portfolio_accepted_notification)
            {
                foreach($get_portfolio_accepted_notification as $gpars)
                {
                  $id13 = $gpars->pim_id;
                  $data13 = array(
                                        'status_notify' => 'seen',
                                    );
                  $data13 = $this->security->xss_clean($data13); // xss filter
                  $this->Front_model->update_PortfolioMember($data13,$ptm->pim_id);
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <meta charset="utf-8" />
    <title>Portfolio Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<?php
include('header_links.php');
?>
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
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Portfolio</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio Profile</a></li> -->
                </ol>
            </div>

        </div>
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

if($getp)
{
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($getp->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
?>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-9">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-secondary">
                        <?php
                        if(!empty($getp->cover_photo)){
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/'.$getp->cover_photo)?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <!-- <div class="col-12">
                                <div class="text-d p-3">
                                    <h5 class="text-d">Welcome Back !</h5>
                                    <p>It will seem like simplified</p>
                                </div>
                            </div> -->
                        </div>
                       <?php
                        }else{
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/cover.jpg')?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <!-- <div class="col-12">
                                <div class="text-d p-3">
                                    <h5 class="text-d">Welcome Back !</h5>
                                    <p>It will seem like simplified</p>
                                </div>
                            </div> -->
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <?php
                            if(!empty($getp->photo)){
                                ?>
                                <img class="img-thumbnail rounded-circle avatar-md" src="<?php echo base_url('assets/portfolio_photos/'.$getp->photo);?>" alt="<?php echo $getp->portfolio_name;?>">
                                <?php
                            }else{
                                $fullname = $getp->portfolio_name;
                                $student_name = explode(" ", $fullname);
                                $profile_name = "";

                                foreach ($student_name as $sn) {
                                  $profile_name .= $sn[0];
                                }
                                ?>
                                <span class="avatar-title rounded-circle btn-d text-white font-size-24" style="font-size: xx-large;"><?php echo strtoupper($profile_name);?></span>
                                <?php
                            }
                            ?>
                                </div>
                                <h5 class="font-size-15 text-truncate"><?php if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}?></h5>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="font-size-15">
                                                <?php
                                                $count_cp = $this->Front_model->count_Portfolio_project($getp->portfolio_id);
                                                    if($count_cp)
                                                    {
                                                        echo $count_cp['count_rows'];
                                                    }
                                                ?>
                                            </h5>
                                            <a href="<?php echo base_url('portfolio-projects/'.$getp->portfolio_id);?>" class="nameLink" title="View Projects">Projects</a>
                                        </div>
                                        <div class="col">
                                            <h5 class="font-size-15">
                                                <?php
                                                $count_ccp = $this->Front_model->count_portfolio_project_content($getp->portfolio_id);
                                                    if($count_cp)
                                                    {
                                                        echo $count_ccp['count_rows'];
                                                    }
                                                ?>
                                            </h5>
                                            <a href="<?php echo base_url('portfolio-contents/'.$getp->portfolio_id);?>" class="nameLink" title="View Contents">Planned Content</a>
                                        </div>
                                        <div class="col">
                                            <h5 class="font-size-15">
                                                <?php
                                                $count_ct = $this->Front_model->count_Portfolio_task($getp->portfolio_id);
                                                    if($count_ct)
                                                    {
                                                        echo $count_ct['count_rows'];
                                                    }
                                                ?>
                                            </h5>
                                            <a href="<?php echo base_url('portfolio-tasks/'.$getp->portfolio_id);?>" class="nameLink" title="View Tasks">Tasks</a>
                                        </div>
                                          <?php
                                          if ($getp->portfolio_createdby == $this->session->userdata('d168_id')) {
                                            ?>
                                            <div class="col">
                                              <a  href="<?php echo base_url('portfolio-report/'.$getp->portfolio_id);?>"  class="btn btn-sm btn-d text-white">Portfolio report<i class="mdi mdi-arrow-right ms-1"></i></a>
                                            </div>
                                            <?php
                                            }
                                           ?>



                                    </div>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-6"><?php
                                        if($getp->portfolio_createdby == $this->session->userdata('d168_id'))
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
        
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
        
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
            </form>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Member</a>
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
                <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>

                <?php
            }
            else
            {
                ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Member</a>
                <?php
            }
          }
          else
          {

            ?>
            <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>
                <?php
            }
            else
            {
                ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Member</a>
                <?php
            }
          }
          else
          {

            ?>
            <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Member</a>
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
                    <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>

                    <?php
                }
                else
                {
                    ?>
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Member</a>
                    <?php
                }
              }
              else
              {

                ?>
                <button type="button" class="btn btn-d waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#portfolio_AddMember" title="Add Portfolio Team Member">Add Member <i class="mdi mdi-arrow-right ms-1"></i></button>
                <?php
              }
            }
          }
        }
      }
    }    
  }
}

if($privilege_only_view == 'no') 
{
?>
                            <a href="javascript:void(0)" onclick="return PortfolioViewMembers(<?php echo $getp->portfolio_id?>);" class="btn btn-d waves-effect waves-light btn-sm cus-margin-top cus-margin-bottom2" title="View Members" style="width: 95px;">Members <i class="mdi mdi-arrow-right ms-1"></i></a>
                            <div class="btn-group dropend me-1 cus-margin-top2">
                                <button type="button" class="btn bg-d text-white btn-sm waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100px;">
                                    More <i class="mdi mdi-chevron-right"></i>
                                </button>
                                <div class="dropdown-menu" style="margin: 0px;">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#portfolio_AddDepartment">Add Department</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="return PortfolioViewAllDepartments(<?php echo $getp->portfolio_id?>);">View Departments</a>
                                    <a class="dropdown-item" href="<?php echo base_url('portfolio-edit/'.$getp->portfolio_id);?>">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="return ArchivePortfolio(<?php echo $getp->portfolio_id;?>);">Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="return DeletePortfolioModal(<?php echo $getp->portfolio_id?>);">Delete</a>
                                </div>
                            </div>
<?php 
}
?>
                                        <!-- <a href="<?php echo base_url('portfolio-edit/'.$getp->portfolio_id);?>" class="btn btn-d waves-effect waves-light btn-sm mt-2" title="Edit Portfolio">Edit <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a class="btn bg-d text-white waves-effect waves-light btn-sm mt-2" href="javascript:void(0)" onclick="return ArchivePortfolio(<?php echo $getp->portfolio_id;?>);" title="Archive Portfolio">Archive <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a href="javascript:void(0)" onclick="return DeletePortfolio(<?php echo $getp->portfolio_id?>);" class="btn bg-d text-white waves-effect waves-light btn-sm mt-2" title="Delete Portfolio">Delete <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a href="javascript:void(0)" onclick="return PortfolioViewMembers(<?php echo $getp->portfolio_id?>);" class="btn btn-d waves-effect waves-light btn-sm mt-2" title="View Members">View Members <i class="mdi mdi-arrow-right ms-1"></i></a> -->
                                        <?php
                                        }
                                        else
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
        
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
        
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
            </form>
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
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                        <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom">Add Project <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                                        ?></div>
                                        <div class="col-6">
                                        <div class="avatar-group" id="few_portfolio_members_display">
                                            <?php
                                            $porttm = $this->Front_model->getAccepted_PortTM($getp->portfolio_id);
                                            if($porttm)
                                            {
                                                $p=0;
                                                $pcnt=0;
                                                foreach($porttm as $ptm)
                                                {
                                                    $pcnt++;
                                                    if($p==8) break;
                                                    $pm = $this->Front_model->selectLogin($ptm->sent_to);
                                                    if($pm)
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
                                                    }
                                                $p++;
                                                }
                                                if($pcnt > 8)
                                                {
                                                ?>
                                            <div class="avatar-group-item">
                                                <a href="javascript:void(0)" onclick="return display_all_port_view_members();" class="text-white" title="Display all">
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle btn-d text-white font-size-16">
                                                            <i class="mdi mdi-arrow-expand-right"></i>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="avatar-group" id="all_portfolio_members_display" style="display: none;">
                                            <?php
                                            $porttm = $this->Front_model->getAccepted_PortTM($getp->portfolio_id);
                                            if($porttm)
                                            {
                                                foreach($porttm as $ptm)
                                                {
                                                    $pm = $this->Front_model->selectLogin($ptm->sent_to);
                                                    if($pm)
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
                                                    }
                                                }
                                                ?>
                                            <div class="avatar-group-item">
                                                <a href="javascript:void(0)" onclick="return display_few_port_view_members();" class="text-white" title="Hide all">
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle btn-d text-white font-size-16">
                                                            <i class="mdi mdi-arrow-expand-left"></i>
                                                        </span>
                                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Information</h4>

                        <p class="pdes mb-4"><?php if(!empty($getp->about_portfolio)){ echo $getp->about_portfolio;}?></p>
                        <div class="table-responsive conversation-list" data-simplebar>
                            <table class="table mb-0">
                                <tbody>
                                    <?php
                                    if($getp->portfolio_user == 'company')
                                    {
                                        if(!empty($getp->contact_fname))
                                        {
                                        ?>
                                        <tr>
                                            <th scope="row">Contact Person Name :</th>
                                            <td><?php echo $getp->contact_fname.' '.$getp->contact_mname.' '.$getp->contact_lname;?></td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    ?>


                                    <tr>
                                        <th scope="row">Created By :</th>
                                        <td>

                                          <?php
                                          $portfolio_createdby = $this->Front_model->getStudentById($getp->portfolio_createdby);
                                              if($portfolio_createdby)
                                              {
                                                  echo $portfolio_createdby->first_name.' '.$portfolio_createdby->last_name;
                                              }
                                          ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Type :</th>
                                        <td>

                                          <?php
                                              if($getp->portfolio_user == 'company')
                                              {
                                                  echo 'Company';
                                              }
                                              elseif($getp->portfolio_user == 'individual')
                                              {
                                                  echo "Individual";
                                              }
                                              else
                                              {
                                                  echo 'Not Assigned';
                                              }
                                          ?>
                                        </td>
                                    </tr>


                                      <?php
                                    if(!empty($getp->email_address))
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row">Email Address :</th>
                                            <td><?php echo $getp->email_address;?></td>
                                        </tr>
                                        <?php
                                    }

                                    if(!empty($getp->company_website))
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row">Company Website :</th>
                                            <td><?php echo $getp->company_website;?></td>
                                        </tr>
                                        <?php
                                    }

                                    if(!empty($getp->designation))
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row">Designation :</th>
                                            <td><?php echo $getp->designation;?></td>
                                        </tr>
                                        <?php
                                    }

                                    if(!empty($getp->company_individual))
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row">Company Name :</th>
                                            <td><?php echo $getp->company_individual;?></td>
                                        </tr>
                                        <?php
                                    }

                                    if($getp->country){
                                        $get_c = $this->Front_model->getCountryByCode($getp->country);
                                        ?>
                                        <tr>
                                            <th scope="row">Country :</th>
                                            <td><?php echo $get_c->country_name;?></td>
                                        </tr>
                                        <?php
                                    }

                                    if($getp->social_media){
                                        ?>
                                        <tr>
                                            <th>Social Media Link(s) :</th>
                                            <td><?php
                                                $social_media_icon = explode(',', $getp->social_media_icon);
                                                $social_media = explode(',', $getp->social_media);
                                                $count = count($social_media);
                                                if($count > 0){
                                                    for ($i=0; $i<$count; $i++){
                                                        $icon_name = strtolower($social_media_icon[$i]);
                                                        ?>
                                                        <span class="profile-icon-span"><a target="_blank" href="<?php echo prep_url($social_media[$i]);?>">
                                                            <!-- <img class="profile-icon" title="<?php echo $social_media_icon[$i];?>" src="<?php echo base_url('assets/images/icons/'.$icon_name.'.png');?>"> -->
                                                            <span><i class="fab fa-<?php echo $icon_name;?> h3 text-d"></i></span>
                                                        </a></span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }

                                    $check_port_dept = $this->Front_model->get_PortfolioDepartment($getp->portfolio_id);
                                    $get_all_depts = array();
                                    if($check_port_dept){
                                        ?>
                                        <tr>
                                            <th>Department(s) :</th>
                                            <td><?php
                                                foreach($check_port_dept as $p_dept)
                                                {
                                                    ?>
                                                    <span class="badge badge-soft-dark me-2 mb-2 dname_<?php echo $p_dept->portfolio_dept_id;?>" style="font-size: 90%;"><?php echo $p_dept->department;?></span>
                                                    <?php
                                                    $get_all_depts[] = $p_dept->department;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>

    </div>

    <div style='clear:both'></div>

            </div>
        </div>
        <!-- end row -->
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
else
{
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Portfolio closed or deleted by its Created User!</h4>
                    </div>
                </div>
            </div>
        </div>
<?php
}
?>
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
<div class="modal fade" id="portfolio_AddMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add to Portfolio Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="portfolio_AddTeamMemberForm" id="portfolio_AddTeamMemberForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg">
                            <input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Portfolio Member...">
                            <span id="imemailErr" class="text-danger"></span>
                        </div>
<?php
if($getPackDetail)
{
  $total_team_members = trim($getPackDetail->pack_team_members);
  $used_team_members = trim($getPortfolioMemberCount['portfolio_member_count_rows']);
  $check_type = is_numeric($total_team_members);
  if($check_type == 'true')
  {
    if($used_team_members < $total_team_members)
    {
        ?>
        <div class="col-lg-3 card-title mb-2">
        <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="<?php echo $total_team_members;?>">
        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member">
            <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
        </button>
        </div>
        <?php
    }
  }
  else
  {

    ?>
    <div class="col-lg-3 card-title mb-2">
    <input type="hidden" name="pass_totalTM" id="pass_totalTM" value="">
    <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member">
        <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
    </button>
    </div>
    <?php
  }
}
?>

                    </div>
                    <div class="imember_div">
                    </div>
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="portfolio_AddTeamMemberButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>
            </form>
        </div>
    </div>
</div>

                                    <!-- View Portfolio Members Modal Modal -->
                                    <div id="PortfolioViewMembersModal" class="modal fade" tabindex="-1" aria-labelledby="#PortfolioViewMembersModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="PortfolioViewMembersModal_content">

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <div id="OpenWorkModal" class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="#OpenWorkModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="OpenWorkModal_content" style="border: 2px solid #c7df19 !important">

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Delete Portfolio Modal -->
                                    <div id="DeletePortfolioModal" class="modal fade" tabindex="-1" aria-labelledby="#DeletePortfolioModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="DeletePortfolioModal_content">

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- View Portfolio Department Modal Modal -->
                                    <div id="PortfolioViewAllDepartmentsModal" class="modal fade" tabindex="-1" aria-labelledby="#PortfolioViewAllDepartmentsLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="PortfolioViewAllDepartmentsModal_content">

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
<!-- Add Department Modal -->
<div class="modal fade" id="portfolio_AddDepartment" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="portfolio_AddDepartmentLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="portfolio_AddDepartmentForm" id="portfolio_AddDepartmentForm" method="post">
                <div class="modal-body">
                    <?php
                    if(empty($get_all_depts))
                    {
                    ?>
                    <div class="row listed_departments">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <select name="department[]" class="form-control select2 select2-multiple" multiple="multiple" id="department" data-placeholder="Choose ..." >
                                    <option value="Administration" >Administration</option>
                                    <option value="Accounting & Finance">Accounting & Finance</option>
                                    <option value="Customer service">Customer service</option>
                                    <option value="Human resources">Human resources</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Research & Development">Research & Development</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    else
                    {
                        $search_this = array ('Administration','Accounting & Finance','Customer service','Human resources','Marketing','Sales','Research & Development');
                        // echo "<pre>";
                        // print_r($search_this);
                        // echo "<br><pre>";
                        // print_r($get_all_depts);
                        //$containsAllValues = array_diff($search_this, $get_all_depts);
                        $containsSearch = count(array_intersect($search_this, $get_all_depts)) === count($search_this);
                        if(empty($containsSearch))
                        {
                    ?>
                    <div class="row listed_departments">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <select name="department[]" class="form-control select2 select2-multiple" multiple="multiple" id="department" data-placeholder="Choose ..." >
                                    <?php
                                    if(in_array('Administration', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Administration" >Administration</option>
                                    <?php
                                    }
                                    if(in_array('Accounting & Finance', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Accounting & Finance">Accounting & Finance</option>
                                    <?php
                                    }
                                    if(in_array('Customer service', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Customer service">Customer service</option>
                                    <?php
                                    }
                                    if(in_array('Human resources', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Human resources">Human resources</option>
                                    <?php
                                    }
                                    if(in_array('Marketing', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Marketing">Marketing</option>
                                    <?php
                                    }
                                    if(in_array('Sales', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Sales">Sales</option>
                                    <?php
                                    }
                                    if(in_array('Research & Development', $get_all_depts) == false)
                                    {
                                    ?>
                                    <option value="Research & Development">Research & Development</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <button type="button" class="add_dept btn btn-d btn-sm">Add Custom Departments</button>
                            </div>
                        </div>
                    </div>
                    <div class="dept_wrapper">
                    <?php
                    if(!empty($containsSearch))
                    {
                    ?>
                    <div class="row"><div class="col-md-12"><div class="mb-2"><div class="input-group"><input type="text" name="cus_department[]" class="form-control" id="department" placeholder="Enter Department" required=""></div></div></div></div>
                    <?php
                    }
                    ?>
                    </div>
                    <span id="departmentErr" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="port_id" value="<?php echo $getp->portfolio_id;?>">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-d" id="portfolio_AddDepartmentButton">Add</button>
                    <img id="loader21" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- plugin js -->
<script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
<?php
include('footer_links.php');
?>
<script type="text/javascript">
$(document).ready(function(){
    //ADD DEPARTMENT
    var add_dept = $('.add_dept'); //Add button selector
    var dept_wrapper = $('.dept_wrapper'); //Input field wrapper
    var deptHTML = '<div class="row"><div class="col-md-12"><div class="mb-2"><div class="input-group"><input type="text" name="cus_department[]" class="form-control" id="department" placeholder="Enter Department" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_dept" title="Remove"></div></div></div></div></div>'; //New input field html
    var x2 = 1; //Initial field counter is 1

    //Once add button is clicked
    $(add_dept).click(function(){
            $('.listed_departments').hide();
            $(dept_wrapper).prepend(deptHTML); //Add field html
    });

    //Once remove button is clicked
    $(dept_wrapper).on('click', '.remove_dept', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
        x2--; //Decrement field counter
        function isEmpty( el ){
          return !$.trim(el.html())
        }
        if (isEmpty($('.dept_wrapper'))){
          $('.listed_departments').show();
        }
    });

    //debugger;
   var add_dup_member = $('.add_dup_member'); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var pass_totalTM = $('#pass_totalTM').val();
   //console.log(pass_totalTM);
   var memberHTML = '<div class="row mb-2"><div class="col-lg-9"><input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Portfolio Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-3 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member2"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   var a = 3;
   //Once add button is clicked
   $(add_dup_member).click(function(){
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

   //console.log(pass_totalTM);

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
    </body>

</html>