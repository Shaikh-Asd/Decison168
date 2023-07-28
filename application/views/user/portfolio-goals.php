<?php
$page = 'goals';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Goal List</title>
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
                        <h4 class="mb-sm-0 font-size-18">GOALS</h4>
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
        $getGoalCount = $this->Front_model->getGoalCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_goals = trim($getPackDetail->pack_goals);
          $used_goals = trim($getGoalCount['goal_count_rows']);
          $check_type = is_numeric($total_goals);
          if($check_type == 'true')
          {
            if($used_goals < $total_goals)
            {
              ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
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
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
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
        $getGoalCount = $this->Front_model->getGoalCount($_COOKIE["d168_selectedportfolio"]);
        if($getPackDetail)
        {
          $total_goals = trim($getPackDetail->pack_goals);
          $used_goals = trim($getGoalCount['goal_count_rows']);
          $check_type = is_numeric($total_goals);
          if($check_type == 'true')
          {
            if($used_goals < $total_goals)
            {
              ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
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
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
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
            <li class="nav-item">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getGoalCount = $this->Front_model->getGoalCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_goals = trim($getPackDetail->pack_goals);
              $used_goals = trim($getGoalCount['goal_count_rows']);
              $check_type = is_numeric($total_goals);
              if($check_type == 'true')
              {
                if($used_goals < $total_goals)
                {
                  ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
                            <i class="mdi mdi-plus"></i> Create New
                        </a>
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
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('goal-create');?>">
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
                                   <input class="form-check-input" name="filter_goal" type="radio" id="all_goal" onclick="return all_goal_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_goal" type="radio" id="created_goal" onclick="return goal_filter();">
                                   <label class="form-check-label">Created Goals</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_goal" type="radio" id="accepted_goal" onclick="return goal_filter();">
                                   <label class="form-check-label">Accepted Goals</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_goal" type="radio" id="pending_goal" onclick="return goal_filter();">
                                   <label class="form-check-label">Pending Requests</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_goal" type="radio" id="more_goal" onclick="return goal_filter();">
                                   <label class="form-check-label">More Info Requests</label>
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
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_goal2" type="radio" id="all_goal2" onclick="return all_goal_filter2();" checked>
                                       <label class="form-check-label">All</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_goal2" type="radio" id="created_goal2" onclick="return goal_filter2();">
                                       <label class="form-check-label">Created Goals</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_goal2" type="radio" id="accepted_goal2" onclick="return goal_filter2();">
                                       <label class="form-check-label">Accepted Goals</label></a>
                               <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_goal2" type="radio" id="pending_goal2" onclick="return goal_filter2();">
                                        <label class="form-check-label">Pending Requests</label></a>
                               <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_goal2" type="radio" id="more_goal2" onclick="return goal_filter2();">
                                        <label class="form-check-label">More Info Requests</label></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Goals</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title-->
<?php

function timeStringToMinutes($timeString) {
    list($hours, $minutes) = sscanf($timeString, '%dh%dm');
    return $hours * 60 + $minutes;
  }
  
  function minutesToTimeString($totalMinutes) {
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;
    return sprintf('%dh %02dm', $hours, $minutes);
  }

  function calculateTotalTime($Goal_tasks) {
    $totalMinutes = 0;
    
    foreach ($Goal_tasks as $time) {
        $estimatedTime = $time->estimated_time;
        $totalMinutes += timeStringToMinutes($estimatedTime);
    }

    return minutesToTimeString($totalMinutes);
}

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
?> 
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row" id="created_goal_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Created Goals</h4>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Goals</th>
                                                    <th scope="col">Progress</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
                                                    <th scope="col">Time Estimate</th>
                                                    <th scope="col">Time Tracked</th>
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
                                                                <td style="width: 25%;">
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
                                                                    <h5 class="font-size-14 ms-2">
                                                                        <a href="<?php echo base_url('goal-overview/'.$p->gid)?>" class="nameLink new_gname<?php echo $p->gid;?>" title="Open Goal">
                                                                        <?php echo $p->gname;;?> 
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return GoalOverviewModal(<?php echo $p->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a> 
                                                                    </h5>
                                                                    <p class="text-muted ms-2 mb-0 new_gdes<?php echo $p->gid;?>">
                                                                    <?php
                                                                    if(!empty($p->gdes))
                                                                    {
                                                                        if(strlen($p->gdes) > 45)
                                                                        {
                                                                          print_r(substr($p->gdes,0,45).'...');
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $p->gdes;
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
                                                            <td>
                                                    <?php
                                                    $Goal_tasks = $this->Front_model->Goal_tasks($p->gid);
                                                    $Goal_subtasks = $this->Front_model->Goal_subtasks($p->gid);
                                                    
                                                   

                                                    if($Goal_tasks || $Goal_subtasks)
                                                    {
                                                        $progress_done = $this->Front_model->Goalprogress_done($p->gid);
                                                        $progress_total = $this->Front_model->Goalprogress_total($p->gid);
                                                        $sub_progress_done = $this->Front_model->Goalsub_progress_done($p->gid);
                                                        $sub_progress_total = $this->Front_model->Goalsub_progress_total($p->gid);
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
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-soft-primary"><?php echo $p->gstart_date;?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-soft-dark"><?php echo $p->gend_date;?></span>
                                                            </td>
                                                            <?php
                                        $est = 0; // Variable to store the sum of estimated times
                                        $trc = 0;
                                        $total_seconds = 0;
                                        $totalTime = "00:00:00";
                                       
                                        // Assuming $Goal_tasks is an array of objects with 'estimated_time' property
                                       

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
                                                            <td>
                                                            <?php echo $est;?>

                                                            </td>
                                                            <td>
                                                            <?php echo $totalTime;?>

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

                        <div class="row" id="accepted_goal_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Accepted Goals</h4>
                                    <div class="table-responsive">
                                        <table id="datatable2" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Goals</th>
                                                    <th scope="col">Progress</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
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
                                                                    <h5 class="font-size-14 ms-2">
                                                                        <a href="<?php echo base_url('goal-overview/'.$ap->gid)?>" class="nameLink new_gname<?php echo $ap->gid;?>" title="Open Goal">
                                                                            <?php echo $ap->gname;?>
                                                                        </a> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return GoalOverviewModal(<?php echo $ap->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>  
                                                                    </h5>
                                                                    <p class="text-muted ms-2 mb-0 new_gdes<?php echo $ap->gid;?>">
                                                                        <?php
                                                                        if(!empty($ap->gdes))
                                                                        {
                                                                            if(strlen($ap->gdes) > 45)
                                                                            {
                                                                              print_r(substr($ap->gdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $ap->gdes;
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
                                                                <td>
                                                        <?php
                                                        $Goal_tasks = $this->Front_model->Goal_tasks($ap->gid);
                                                        $Goal_subtasks = $this->Front_model->Goal_subtasks($ap->gid);
                                                        if($Goal_tasks || $Goal_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->Goalprogress_done($ap->gid);
                                                            $progress_total = $this->Front_model->Goalprogress_total($ap->gid);
                                                            $sub_progress_done = $this->Front_model->Goalsub_progress_done($ap->gid);
                                                            $sub_progress_total = $this->Front_model->Goalsub_progress_total($ap->gid);
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
                                                            <td>
                                                                <span class="badge badge-soft-primary"><?php echo $ap->gstart_date;?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-soft-dark"><?php echo $ap->gend_date;?></span>
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

                        <div class="row" id="pending_goal_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Pending Requests</h4>
                                    <div class="table-responsive">
                                        <table id="datatable3" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Goals</th>
                                                    <th scope="col">Progress</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
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
                                                                    <h5 class="font-size-14 ms-2">
                                                                        <a href="javascript: void(0);" onclick="return GoalOverviewRequestNotificationModal(<?php echo $pp->gid;?>)" class="nameLink new_gname<?php echo $pp->gid;?>" title="Open Goal">
                                                                            <?php echo $pp->gname;?>
                                                                        </a> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return GoalOverviewRequestNotificationModal(<?php echo $pp->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>  
                                                                    </h5>
                                                                    <p class="text-muted ms-2 mb-0 new_gdes<?php echo $pp->gid;?>">
                                                                        <?php
                                                                        if(!empty($pp->gdes))
                                                                        {
                                                                            if(strlen($pp->gdes) > 45)
                                                                            {
                                                                              print_r(substr($pp->gdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $pp->gdes;
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
                                                                <td>
                                                        <?php
                                                        $Goal_tasks = $this->Front_model->Goal_tasks($pp->gid);
                                                        $Goal_subtasks = $this->Front_model->Goal_subtasks($pp->gid);
                                                        if($Goal_tasks || $Goal_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->Goalprogress_done($pp->gid);
                                                            $progress_total = $this->Front_model->Goalprogress_total($pp->gid);
                                                            $sub_progress_done = $this->Front_model->Goalsub_progress_done($pp->gid);
                                                            $sub_progress_total = $this->Front_model->Goalsub_progress_total($pp->gid);
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
                                                            <td>
                                                                <span class="badge badge-soft-primary"><?php echo $pp->gstart_date;?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-soft-dark"><?php echo $pp->gend_date;?></span>
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

                        <div class="row" id="more_goal_list">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">More Info Requests</h4>
                                    <div class="table-responsive">
                                        <table id="datatable4" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Goals</th>
                                                    <th scope="col">Progress</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
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
                                                                    <h5 class="font-size-14 ms-2">
                                                                        <a href="javascript: void(0);" onclick="return GoalOverviewRequestNotificationModal(<?php echo $rp->gid;?>)" class="nameLink new_gname<?php echo $rp->gid;?>" title="Open Goal">
                                                                            <?php echo $rp->gname;?>
                                                                        </a> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return GoalOverviewRequestNotificationModal(<?php echo $rp->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>  
                                                                    </h5>
                                                                    <p class="text-muted ms-2 mb-0 new_gdes<?php echo $rp->gid;?>">
                                                                        <?php
                                                                        if(!empty($rp->gdes))
                                                                        {
                                                                            if(strlen($rp->gdes) > 45)
                                                                            {
                                                                              print_r(substr($rp->gdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $rp->gdes;
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
                                                                <td>
                                                        <?php
                                                        $Goal_tasks = $this->Front_model->Goal_tasks($rp->gid);
                                                        $Goal_subtasks = $this->Front_model->Goal_subtasks($rp->gid);
                                                        if($Goal_tasks || $Goal_subtasks)
                                                        {
                                                            $progress_done = $this->Front_model->Goalprogress_done($rp->gid);
                                                            $progress_total = $this->Front_model->Goalprogress_total($rp->gid);
                                                            $sub_progress_done = $this->Front_model->Goalsub_progress_done($rp->gid);
                                                            $sub_progress_total = $this->Front_model->Goalsub_progress_total($rp->gid);
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
                                                            <td>
                                                                <span class="badge badge-soft-primary"><?php echo $rp->gstart_date;?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-soft-dark"><?php echo $rp->gend_date;?></span>
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
                        <!-- <div data-simplebar style="max-height: 400px;" id="created_goal_grid">  -->
                        <div id="created_goal_grid">
                        <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>My Created Projects</h4> -->
                            <?php
                            $get_goals = "no_goals";
                                if($plist)
                                    {
                                        foreach($plist as $p)
                                            {
                                                $get_goals = "yes_goals";
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
                    <a href="<?php echo base_url('goal-overview/'.$p->gid)?>" class="nameLink new_gname<?php echo $p->gid;?>" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $p->gname;?>">
                        <?php echo $p->gname;?>
                     </a></p>
                    <p class="ng-binding"><?php
                        if(!empty($p->gdes))
                        {
                            if(strlen($p->gdes) > 45)
                            {
                              print_r(substr($p->gdes,0,45).'...');
                            }
                            else
                            {
                                echo $p->gdes;
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
                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color:#383838 !important" onclick="return GoalOverviewModal(<?php echo $p->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                    <p class="ng-binding">
                    <div class="avatar-group" style="padding-top: 6px;">
                       End: <?php echo $p->gend_date;?>
                    </div>
                    </p>
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
                            <div id="accepted_goal_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>Accepted Projects</h4> -->
                            <?php
                                if($accepted_plist)
                                    {
                                        foreach($accepted_plist as $ap)
                                            {
                                                $get_goals = "yes_goals";
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
                    <a href="<?php echo base_url('goal-overview/'.$ap->gid)?>" class="nameLink new_gname<?php echo $ap->gid;?>" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $ap->gname;?>">
                        <?php echo $ap->gname;?>
                     </a>
                  </p>
                  <p class="ng-binding"><?php
                        if(!empty($ap->gdes))
                        {
                            if(strlen($ap->gdes) > 45)
                            {
                              print_r(substr($ap->gdes,0,45).'...');
                            }
                            else
                            {
                                echo $ap->gdes;
                            }
                        }
                        else
                        {
                            echo "No Description!";
                        }  
                        ?> 
                  </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color: #c7df19;" onclick="return GoalOverviewModal(<?php echo $ap->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <div class="avatar-group" style="padding-top: 6px;">
                       End: <?php echo $ap->gend_date;?>
                    </div>
                  </p>
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
                            <div id="pending_goal_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>Accepted Projects</h4> -->
                            <?php
                                if($pending_plist)
                                    {
                                        foreach($pending_plist as $pp)
                                            {
                                                $get_goals = "yes_goals";
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
                    <a href="javascript: void(0);" onclick="return GoalOverviewRequestNotificationModal(<?php echo $pp->gid;?>)" class="nameLink new_gname<?php echo $pp->gid;?>" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $pp->gname;?>">
                        <?php echo $pp->gname;?>
                     </a>
                  </p>
                  <p class="ng-binding"><?php
                        if(!empty($pp->gdes))
                        {
                            if(strlen($pp->gdes) > 45)
                            {
                              print_r(substr($pp->gdes,0,45).'...');
                            }
                            else
                            {
                                echo $pp->gdes;
                            }
                        }
                        else
                        {
                            echo "No Description!";
                        }  
                        ?> 
                  </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color: #c7df19;" onclick="return GoalOverviewRequestNotificationModal(<?php echo $pp->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <div class="avatar-group" style="padding-top: 6px;">
                       End: <?php echo $pp->gend_date;?>
                    </div>
                  </p>
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
                            <div id="more_goal_grid">
                            <div class="row">
                            <!-- <h4 class='card-title mb-4 mt-4'>Accepted Projects</h4> -->
                            <?php
                                if($readmore_plist)
                                    {
                                        foreach($readmore_plist as $rp)
                                            {
                                                $get_goals = "yes_goals";
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
                    <a href="javascript: void(0);" onclick="return GoalOverviewRequestNotificationModal(<?php echo $rp->gid;?>)" class="nameLink new_gname<?php echo $rp->gid;?>" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $rp->gname;?>">
                        <?php echo $rp->gname;?>
                     </a>
                  </p>
                  <p class="ng-binding"><?php
                        if(!empty($rp->gdes))
                        {
                            if(strlen($rp->gdes) > 45)
                            {
                              print_r(substr($rp->gdes,0,45).'...');
                            }
                            else
                            {
                                echo $rp->gdes;
                            }
                        }
                        else
                        {
                            echo "No Description!";
                        }  
                        ?> 
                  </p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                    <a href="javascript: void(0);" class="float-end h4 eye_preview" style="color: #c7df19;" onclick="return GoalOverviewRequestNotificationModal(<?php echo $rp->gid;?>)" title="Preview Goal"><i class="mdi mdi-eye-outline"></i></a>
                  </p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding">
                    <div class="avatar-group" style="padding-top: 6px;">
                       End: <?php echo $rp->gend_date;?>
                    </div>
                  </p>
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
                               if((empty($plist)) && (empty($accepted_plist)) && (empty($pending_plist))  && (empty($readmore_plist))  || ($get_goals == "no_goals"))
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
                                    <!-- Goal Overview Modal -->
                                    <div id="GoalOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="GoalOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Goal Overview Accepted Modal -->
                                    <div id="GoalOverviewAcceptedModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewAcceptedModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="GoalOverviewAcceptedModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Goal Overview Request Modal -->
                                    <div id="GoalOverviewRequestModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="GoalOverviewRequestModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

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