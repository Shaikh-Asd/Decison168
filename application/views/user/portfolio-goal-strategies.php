<?php
$page = 'goals';
$check_port_id = "";
if(!empty($gdetail))
{
  $check_port_id = $gdetail->portfolio_id;  
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>KPIs List</title>
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
                        <h4 class="mb-sm-0 font-size-18">KPIs</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
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
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$get_goal_id);
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
                        <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                        <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</button> 
                </form>
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
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                    <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</button> 
            </form>
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$get_goal_id);
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
                        <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                        <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</button> 
                </form>
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
            <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                    <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                    <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                    <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</i></button> 
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
            <li class="nav-item">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$get_goal_id);
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
                            <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                            <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</button> 
                    </form>
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
                <form action="<?php echo base_url('goal-kpi-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $get_goal_id;?>">
                        <input type="hidden" name="port_id" value="<?php echo $check_port_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create New</button> 
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
?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-center">
                <div class="row">
                    <div class="col-12">
                        <!-- <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="all_project" onclick="return all_project_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="created_project" onclick="return project_filter();">
                                   <label class="form-check-label">Created Strategies</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_proj" type="radio" id="accepted_project" onclick="return project_filter();">
                                   <label class="form-check-label">Accepted Strategies</label>
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
                        </ul> -->
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

if($Goal_tasks || $Goal_subtasks)
{
?> 
<div class="row p-3 progressbar_display">
    <div class="col pt-2 pb-2" style="background: #ffffff">
        <?php 
        $progress_done = $this->Front_model->Goalprogress_done($get_goal_id);
        $progress_total = $this->Front_model->Goalprogress_total($get_goal_id);
        $sub_progress_done = $this->Front_model->Goalsub_progress_done($get_goal_id);
        $sub_progress_total = $this->Front_model->Goalsub_progress_total($get_goal_id);
        if($progress_total || $sub_progress_total)
        {
            $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
            $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
            $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
        ?>
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

                        <div class="row" id="created_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Created KPIs</h4>
                                <?php
                                if($plist)
                                {
                                    foreach($plist as $p)
                                    {
                                    ?>
                                <div class="accordion mb-2" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $p->sid;?>">
                                        <button class="accordion-button collapsed new_sname<?php echo $p->sid;?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $p->sid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $p->sid;?>">
                                          <?php echo $p->sname;?>
                                        </button>
                                      </h2>
                                      <div id="panelsStayOpen-collapseOne<?php echo $p->sid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $p->sid;?>">
                                        <div class="accordion-body">

                                            <h5 class="font-size-14">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <a href="<?php echo base_url('kpi-overview/'.$p->sid)?>" class="nameLink new_sname<?php echo $p->sid;?>" title="Open KPI">
                                                            <?php echo $p->sname;?>
                                                        </a>        
                                                    </div>
                                                    <div class="col-4">
                                                        <?php
                                                        $Strategy_tasks = $this->Front_model->Strategy_tasks($p->sid);
                                                        $Strategy_subtasks = $this->Front_model->Strategy_subtasks($p->sid);
                                                        if($Strategy_tasks || $Strategy_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->Strategyprogress_done($p->sid);
                                                            $progress_total = $this->Front_model->Strategyprogress_total($p->sid);
                                                            $sub_progress_done = $this->Front_model->Strategysub_progress_done($p->sid);
                                                            $sub_progress_total = $this->Front_model->Strategysub_progress_total($p->sid);
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
                                                                    echo '5%';
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
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return StrategiesOverviewModal(<?php echo $p->sid;?>)" title="Preview KPI"><i class="mdi mdi-eye-outline"></i></a>        
                                                    </div>    
                                                </div>                                                
                                            </h5>
                                            <p class="text-muted mb-0 new_sdes<?php echo $p->sid;?>">
                                                <?php
                                                if(!empty($p->sdes))
                                                {
                                                    if(strlen($p->sdes) > 45)
                                                    {
                                                      print_r(substr($p->sdes,0,45).'...');
                                                    }
                                                    else
                                                    {
                                                        echo $p->sdes;
                                                    }
                                                }
                                                else
                                                {
                                                    echo "No Description!";
                                                }             
                                                ?>
                                            </p>

                                            <?php
                                            $pro_list = $this->Front_model->GoalsStrategiesProjectList($p->sid);
                                            if($pro_list)
                                            {
                                                foreach($pro_list as $pr)
                                                {
                                                ?>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $p->sid.$pr->pid;?>">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree<?php echo $p->sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree<?php echo $p->sid.$pr->pid;?>">
                                                    <?php echo $pr->pname;?>
                                                  </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseThree<?php echo $p->sid.$pr->pid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree<?php echo $p->sid.$pr->pid;?>">
                                                  <div class="accordion-body">

                                                    <h5 class="font-size-14">
                                                    <?php
                                                    if($pr->pcreated_by == $this->session->userdata('d168_id'))
                                                    {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <a href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                <?php echo $pr->pname;?>
                                                            </a>    
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
                                                                        echo '5%';
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
                                                        <div class="col-7">
                                                            <a href="<?php echo base_url('projects-overview-accepted/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                <?php echo $pr->pname;?>
                                                            </a>  
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
                                                                        echo '5%';
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
                                                                    <a  href="<?php echo base_url('projects-overview-request/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php echo $pr->pname;?>
                                                                    </a>
                                                                    <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    <?php  
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <a  href="javascript: void(0);" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" class="nameLink" title="Open Project">
                                                            <?php echo $pr->pname;?>
                                                        </a>
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        <?php
                                                        if(!empty($pr->pdes))
                                                        {
                                                            if(strlen($pr->pdes) > 45)
                                                            {
                                                              print_r(substr($pr->pdes,0,45).'...');
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
                                                  </div>
                                                </div>
                                                </div>
                                                <?php
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
                                ?> 
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="accepted_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Accepted KPIs</h4>
                                <?php
                                if($accepted_plist)
                                {
                                    foreach($accepted_plist as $ap)
                                    {
                                    ?>
                                <div class="accordion mb-2" id="accordionPanelsStayOpenAcceptedExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $ap->sid;?>">
                                        <button class="accordion-button collapsed new_sname<?php echo $ap->sid;?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $ap->sid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $ap->sid;?>">
                                          <?php echo $ap->sname;?>
                                        </button>
                                      </h2>
                                      <div id="panelsStayOpen-collapseOne<?php echo $ap->sid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $ap->sid;?>">
                                        <div class="accordion-body">

                                            <h5 class="font-size-14">
                                                <a  href="<?php echo base_url('kpi-overview/'.$ap->sid)?>" class="nameLink new_sname<?php echo $ap->sid;?>" title="Open KPI">
                                                <?php echo $ap->sname;?>
                                                </a>
                                                <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return StrategiesOverviewModal(<?php echo $ap->sid;?>)" title="Preview KPI"><i class="mdi mdi-eye-outline"></i></a>
                                            </h5>
                                            <p class="text-muted mb-0 new_sdes<?php echo $ap->sid;?>">
                                                <?php
                                                if(!empty($ap->sdes))
                                                {
                                                    if(strlen($ap->sdes) > 45)
                                                    {
                                                      print_r(substr($ap->sdes,0,45).'...');
                                                    }
                                                    else
                                                    {
                                                        echo $ap->sdes;
                                                    }
                                                }
                                                else
                                                {
                                                    echo "No Description!";
                                                }             
                                                ?>
                                            </p>

                                            <?php
                                            $pro_list = $this->Front_model->GoalsStrategiesProjectList($ap->sid);
                                            if($pro_list)
                                            {
                                                foreach($pro_list as $pr)
                                                {
                                                ?>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $ap->sid.$pr->pid;?>">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree<?php echo $ap->sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree<?php echo $ap->sid.$pr->pid;?>">
                                                    <?php echo $pr->pname;?>
                                                  </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseThree<?php echo $ap->sid.$pr->pid;?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree<?php echo $ap->sid.$pr->pid;?>">
                                                  <div class="accordion-body">

                                                    <h5 class="font-size-14">
                                                        <a  href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                <?php echo $pr->pname;?>
                                                        </a>
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                        <?php
                                                        $check_p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                        $check_p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                        if($check_p_tasks || $check_p_subtasks)
                                                        {
                                                        ?>
                                                        <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        <?php
                                                        if(!empty($pr->pdes))
                                                        {
                                                            if(strlen($pr->pdes) > 45)
                                                            {
                                                              print_r(substr($pr->pdes,0,45).'...');
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
                                                  </div>
                                                </div>
                                                </div>
                                                <?php
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
                                ?> 
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="pending_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Pending Requests</h4>
                                <?php
                                if($pending_plist)
                                {
                                    foreach($pending_plist as $pp)
                                    {
                                    ?>                                    
                                <div class="accordion mb-2" id="accordionPanelsStayOpenPendingExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $pp->sid;?>">
                                        <button class="accordion-button collppsed new_sname<?php echo $pp->sid;?>" type="button" data-bs-toggle="collppse" data-bs-target="#panelsStayOpen-collppseOne<?php echo $pp->sid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collppseOne<?php echo $pp->sid;?>">
                                          <?php echo $pp->sname;?>
                                        </button>
                                      </h2>
                                      <div id="panelsStayOpen-collppseOne<?php echo $pp->sid;?>" class="accordion-collppse collppse" aria-labelledby="panelsStayOpen-headingOne<?php echo $pp->sid;?>">
                                        <div class="accordion-body">

                                            <h5 class="font-size-14">
                                                <a  href="<?php echo base_url('kpi-overview/'.$pp->sid)?>" class="nameLink new_sname<?php echo $pp->sid;?>" title="Open KPI">
                                                <?php echo $pp->sname;?>
                                                </a>
                                                <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return StrategiesOverviewModal(<?php echo $pp->sid;?>)" title="Preview KPI"><i class="mdi mdi-eye-outline"></i></a>
                                            </h5>
                                            <p class="text-muted mb-0 new_sdes<?php echo $pp->sid;?>">
                                                <?php
                                                if(!empty($pp->sdes))
                                                {
                                                    if(strlen($pp->sdes) > 45)
                                                    {
                                                      print_r(substr($pp->sdes,0,45).'...');
                                                    }
                                                    else
                                                    {
                                                        echo $pp->sdes;
                                                    }
                                                }
                                                else
                                                {
                                                    echo "No Description!";
                                                }             
                                                ?>
                                            </p>

                                            <?php
                                            $pro_list = $this->Front_model->GoalsStrategiesProjectList($pp->sid);
                                            if($pro_list)
                                            {
                                                foreach($pro_list as $pr)
                                                {
                                                ?>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $pp->sid.$pr->pid;?>">
                                                  <button class="accordion-button collppsed" type="button" data-bs-toggle="collppse" data-bs-target="#panelsStayOpen-collppseThree<?php echo $pp->sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collppseThree<?php echo $pp->sid.$pr->pid;?>">
                                                    <?php echo $pr->pname;?>
                                                  </button>
                                                </h2>
                                                <div id="panelsStayOpen-collppseThree<?php echo $pp->sid.$pr->pid;?>" class="accordion-collppse collppse" aria-labelledby="panelsStayOpen-headingThree<?php echo $pp->sid.$pr->pid;?>">
                                                  <div class="accordion-body">

                                                    <h5 class="font-size-14">
                                                        <a  href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                <?php echo $pr->pname;?>
                                                        </a>
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                        <?php
                                                        $check_p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                        $check_p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                        if($check_p_tasks || $check_p_subtasks)
                                                        {
                                                        ?>
                                                        <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        <?php
                                                        if(!empty($pr->pdes))
                                                        {
                                                            if(strlen($pr->pdes) > 45)
                                                            {
                                                              print_r(substr($pr->pdes,0,45).'...');
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
                                                  </div>
                                                </div>
                                                </div>
                                                <?php
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
                                ?> 
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row" id="more_project_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">More Info Requests</h4>
                                <?php
                                if($readmore_plist)
                                {
                                    foreach($readmore_plist as $rp)
                                    {
                                    ?>
                                <div class="accordion mb-2" id="accordionPanelsStayOpenMoreExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $rp->sid;?>">
                                        <button class="accordion-button collrpsed new_sname<?php echo $rp->sid;?>" type="button" data-bs-toggle="collrpse" data-bs-target="#panelsStayOpen-collrpseOne<?php echo $rp->sid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collrpseOne<?php echo $rp->sid;?>">
                                          <?php echo $rp->sname;?>
                                        </button>
                                      </h2>
                                      <div id="panelsStayOpen-collrpseOne<?php echo $rp->sid;?>" class="accordion-collrpse collrpse" aria-labelledby="panelsStayOpen-headingOne<?php echo $rp->sid;?>">
                                        <div class="accordion-body">

                                            <h5 class="font-size-14">
                                                <a  href="<?php echo base_url('kpi-overview/'.$rp->sid)?>" class="nameLink new_sname<?php echo $rp->sid;?>" title="Open KPI">
                                                <?php echo $rp->sname;?>
                                                </a>
                                                <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return StrategiesOverviewModal(<?php echo $rp->sid;?>)" title="Preview KPI"><i class="mdi mdi-eye-outline"></i></a>
                                            </h5>
                                            <p class="text-muted mb-0 new_sdes<?php echo $rp->sid;?>">
                                                <?php
                                                if(!empty($rp->sdes))
                                                {
                                                    if(strlen($rp->sdes) > 45)
                                                    {
                                                      print_r(substr($rp->sdes,0,45).'...');
                                                    }
                                                    else
                                                    {
                                                        echo $rp->sdes;
                                                    }
                                                }
                                                else
                                                {
                                                    echo "No Description!";
                                                }             
                                                ?>
                                            </p>

                                            <?php
                                            $pro_list = $this->Front_model->GoalsStrategiesProjectList($rp->sid);
                                            if($pro_list)
                                            {
                                                foreach($pro_list as $pr)
                                                {
                                                ?>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingThree<?php echo $rp->sid.$pr->pid;?>">
                                                  <button class="accordion-button collrpsed" type="button" data-bs-toggle="collrpse" data-bs-target="#panelsStayOpen-collrpseThree<?php echo $rp->sid.$pr->pid;?>" aria-expanded="false" aria-controls="panelsStayOpen-collrpseThree<?php echo $rp->sid.$pr->pid;?>">
                                                    <?php echo $pr->pname;?>
                                                  </button>
                                                </h2>
                                                <div id="panelsStayOpen-collrpseThree<?php echo $rp->sid.$pr->pid;?>" class="accordion-collrpse collrpse" aria-labelledby="panelsStayOpen-headingThree<?php echo $rp->sid.$pr->pid;?>">
                                                  <div class="accordion-body">

                                                    <h5 class="font-size-14">
                                                        <a  href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                <?php echo $pr->pname;?>
                                                        </a>
                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                        <?php
                                                        $check_p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                        $check_p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                        if($check_p_tasks || $check_p_subtasks)
                                                        {
                                                        ?>
                                                        <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        <?php
                                                        if(!empty($pr->pdes))
                                                        {
                                                            if(strlen($pr->pdes) > 45)
                                                            {
                                                              print_r(substr($pr->pdes,0,45).'...');
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
                                                  </div>
                                                </div>
                                                </div>
                                                <?php
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
                                ?> 
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
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