<?php
$page = 'index';
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<link href="<?php echo base_url();?>assets/libs/select2-calendar/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
include('header_links.php');
?>
<link href="<?php echo base_url();?>assets/css/new-modals.css" rel="stylesheet" type="text/css" />
<style>

td {
  border-radius: 0 !important;
}

tr th {
      font-weight: 500;
}

.timepicker {
  max-width: 100px;
  border-radius: 0;
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
            <div class="main-content" id="main">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<!-- <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome Back !</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0"> -->
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> -->
                <!-- </ol>
            </div>

        </div>
    </div>
</div> -->
<!-- end page title -->
<?php
// Support functions ------//-----//----//----//----
if($msg_for_supporter != ''){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="mdi mdi-check-all me-2"></i>
    <?php echo $msg_for_supporter; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
// End Support functions ------//-----//----//----//----
?>
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
if(($this->session->flashdata('ex_al_message')) && ($this->session->flashdata('ex_al_message') != ""))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        <?php echo $this->session->flashdata('ex_al_message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
if($getMyPack)
{
    if($getMyPack->package_id != '1')
    {
       if((!empty($getMyPack->sub_cancel_reason)) && ($getMyPack->sub_cancel_reason_notify == 'yes'))
       {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="sub_cancel_reason_div">
            <i class="mdi mdi-alert-outline me-2"></i>
            <strong>Subscription Canceled</strong> due to Card Expired or for some other reason!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="return sub_cancel_reason_seen();"></button>
        </div>
        <?php
       }
    }
}
$task_notification = $this->Front_model->task_notification();//new task notification
$currentDate = date("Y-m-d");
$OverdueTasks = $this->Front_model->OverdueTasks($currentDate);//overdue task notification
$OverdueSubtasks = $this->Front_model->OverdueSubtasks($currentDate);//overdue subtask notification
$pending_plist = $this->Front_model->PendingProjectList();//pending project notification
$check_task_review_sent = $this->Front_model->check_task_review_sent();//sent to review
$check_task_review_deny = $this->Front_model->check_task_review_deny();//review denied
$check_task_review_approve = $this->Front_model->check_task_review_approve();//review approved
$get_all_cproject = $this->Front_model->ProjectList();//project file
$get_all_aproject = $this->Front_model->AcceptedProjectList();//project file 
$get_all_pproject = $this->Front_model->PendingProjectList();//project file
$get_all_rproject = $this->Front_model->ReadMoreProjectList();//project file                  
$subtask_notification = $this->Front_model->subtask_notification();//new subtask notification
$check_subtask_review_sent = $this->Front_model->check_subtask_review_sent();//sent to review
$check_subtask_review_deny = $this->Front_model->check_subtask_review_deny();//review denied
$check_subtask_review_approve = $this->Front_model->check_subtask_review_approve();//review approved
$check_task_arrive_review = $this->Front_model->check_task_arrive_review();//arrive for review
$check_subtask_arrive_review = $this->Front_model->check_subtask_arrive_review();//arrive for review
$check_portfolio_accepted_notify = $this->Front_model->check_portfolio_accepted_notify();//portfolio accepted
$check_project_accepted_notify = $this->Front_model->check_project_accepted_notify(); //project accepted 
$check_project_invite_accepted_notify = $this->Front_model->check_project_invite_accepted_notify(); //project accepted 

?>                        
                        <div class="row">
                            <!-- <button class="openbtn" id="hidebtn" onclick="openNav()"><i class="fa fa-calendar" aria-hidden="true"></i></button> -->                
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                <div class="col-md-8">
                                <div class="card overflow-hidden" id="tour_coverpage">
                                    <div class="bg-d">
                                        <?php
                                        if(!empty($stud_del->cover_photo)){
                                            ?>
                                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/'.$stud_del->cover_photo)?>); background-repeat: no-repeat;background-size: cover;height: 200px;">
                                            <div class="col-12">
                                                <div class="text-d p-2">
                                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                                </div>
                                            </div>
                                        </div>
                                       <?php
                                        }else{
                                            ?>
                                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/cover.jpg')?>); background-repeat: no-repeat;background-size: cover;height: 200px;">
                                            <div class="col-12">
                                                <div class="text-d p-2">
                                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="avatar-md profile-user-wid mb-2">
                                                    <?php
                                                    if(!empty($stud_del->photo)){
                                                        ?>
                                                        <img class="img-thumbnail rounded-circle avatar-md" src="<?php echo base_url('assets/student_photos/'.$stud_del->photo);?>" alt="<?php echo $stud_del->first_name;?>">
                                                        <?php
                                                    }else{
                                                        $fullname = $stud_del->first_name.' '.$stud_del->last_name;
                                                        $student_name = explode(" ", $fullname);
                                                        $profile_name = "";

                                                        foreach ($student_name as $sn) {
                                                          $profile_name .= $sn[0];
                                                        }
                                                        ?>
                                                        <span class="avatar-title rounded-circle btn-d text-white font-size-24"><?php echo strtoupper($profile_name);?></span>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <h5 class="font-size-15 text-truncate"><?php echo $stud_del->first_name.' '.$stud_del->last_name;;?></h5>
                                                <p class="text-muted mb-0 text-truncate"><?php echo $stud_del->designation;?></p>
                                            </div>

                                            <div class="col-sm-9">
                                                <div class="pt-4">

                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="font-size-15"><?php
                                                                if($count_total_portfolio)
                                                                {
                                                                    echo $count_total_portfolio['count_rows'];   
                                                                }
                                                            ?></h5>
                                                            <a href="<?php echo base_url('portfolio');?>" class="nameLink" title="View Portfolios">Portfolios</a>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="font-size-15"><?php
                                                                if($view_member_project_count || $view_created_project_count)
                                                                {
                                                                    $total_projects = $view_member_project_count['count_rows'] + $view_created_project_count['count_rows'];
                                                                    echo $total_projects;   
                                                                }
                                                            ?></h5>
                                                            <a href="<?php echo base_url('projects-list');?>" class="nameLink" title="View Projects">Projects</a>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="font-size-15"><?php
                                                                if($view_member_project_content_count || $view_created_project_content_count)
                                                                {
                                                                    $total_cprojects = $view_member_project_content_count['count_rows'] + $view_created_project_content_count['count_rows'];
                                                                    echo $total_cprojects;   
                                                                }
                                                            ?></h5>
                                                            <a href="<?php echo base_url('contents-list');?>" class="nameLink" title="View Contents">Planned Content</a>
                                                        </div>
                                                        <div class="col">
                                                                    <h5 class="font-size-15"><?php
                                                                        if($view_left_task_counts || $view_left_subtask_counts)
                                                                        {
                                                                            $view_total_left_tasks_subtasks_count = $view_left_task_counts['count_rows'] + $view_left_subtask_counts['count_rows'];
                                                                            echo $view_total_left_tasks_subtasks_count;   
                                                                        }
                                                                    ?></h5>
                                                                <a href="<?php echo base_url('all-tasks');?>" class="nameLink" title="View Tasks">Tasks</a>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <a href="javascript:void(0)" onclick="return ProfileModal()" class="btn btn-d waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="motivator_div_cal" id="tour_motivational_quotes">
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

                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid" id="tour_my_day">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="mb-0">My Day
                                                            <?php
                                                            $today = date('Y-m-d');
                                                            $TodayTasks = $this->Front_model->TodayTasksDashboard($today);
                                                            $TodaySubtasks = $this->Front_model->TodaySubtasksDashboard($today);
                                                            $TodayCalEvents = $this->Front_model->TodayCalEvents($today);
                                                            $TodayCalInsideTodo = $this->Front_model->TodayCalInsideTodo($today);
                                                            if($TodayTasks || $TodaySubtasks || $TodayCalEvents || $TodayCalInsideTodo)
                                                            {
                                                            ?>
                                                            <a href="<?php echo base_url('today-tasks');?>" class="nameLink font-size-14"><i class="mdi mdi-arrow-right ms-1 me-1"></i>View All</a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </h4>
                                                    </div>

                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle font-size-16">
                                                                <i class="bx bx-task"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="media border-top">
                                                    <div class="media-body">
                                                        <div data-simplebar style="max-height: 300px;">
                                                        <ul class="verti-timeline list-unstyled">
                                                        <?php
                                                        if($TodayCalEvents)
                                                        {
                                                            foreach($TodayCalEvents as $tct)
                                                            {
                                                        ?>
                                                        <a href="javascript: void(0);" class="nameLink"  onclick="return EventListViewModal(<?php echo $tct->id;?>)">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">
                                                                        <?php 
                                                                        if($tct->created_type == "task")
                                                                        {
                                                                            echo "To Do";
                                                                        }
                                                                        else
                                                                        {
                                                                           echo ucfirst($tct->created_type); 
                                                                        }    
                                                                        ?> 
                                                                        <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $tct->event_name;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                            }
                                                        }
                                                        if($TodayCalInsideTodo)
                                                        {
                                                            foreach($TodayCalInsideTodo as $tict)
                                                            {
                                                        ?>
                                                        <a href="javascript: void(0);" class="nameLink"  onclick="return EventListViewModal(<?php echo $tict->event_id;?>)">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">
                                                                        To Do
                                                                        <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $tict->task_name;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                            }
                                                        }
                                                        if($TodayTasks)
                                                        {
                                                            //$i = 0;
                                                            foreach($TodayTasks as $tt)
                                                            {
                                                                //if($i==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $tt->tid;?>)" class="nameLink">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Task <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $tt->tname;?></p>
                                                                            <p class="mb-0"><?php
                                                                            if($tt->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($tt->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($tt->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById($tt->tproject_assign);
                                                                                if($getPname)
                                                                                {
                                                                                    echo $getPname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                //$i++;
                                                            }
                                                        }
                                                        if($TodaySubtasks)
                                                        {
                                                            //$a = 0;
                                                            foreach($TodaySubtasks as $tst)
                                                            {
                                                                //if($a==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $tst->stid;?>)" class="nameLink">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Subtask <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $tst->stname;?></p>
                                                                            <p class="mb-0">
                                                                            <?php
                                                                            if($tst->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($tst->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($tst->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($tst->stproject_assign);
                                                                                if($getPname)
                                                                                {
                                                                                    echo $getPname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                //$a++;
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid" id="tour_my_next168">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="mb-0">My Next 168
                                                        <?php         
                                                        $FirstDay = date('Y-m-d', strtotime('+1 day'));
                                                        $LastDay = date('Y-m-d', strtotime($FirstDay .' +6 days'));
                                                        $WeekTasks = $this->Front_model->WeekTasksDashboard($FirstDay,$LastDay);
                                                        $WeekSubtasks = $this->Front_model->WeekSubtasksDashboard($FirstDay,$LastDay);
                                                        $WeekCalEvents = $this->Front_model->WeekCalEvents($FirstDay,$LastDay);
                                                        $WeekCalInsideTodo = $this->Front_model->WeekCalInsideTodo($FirstDay,$LastDay);
                                                        if($WeekTasks || $WeekSubtasks || $WeekCalEvents || $WeekCalInsideTodo)
                                                        {
                                                        ?>
                                                        <a href="<?php echo base_url('week-tasks');?>" class="nameLink font-size-14"><i class="mdi mdi-arrow-right ms-1 me-1"></i>View All</a>
                                                        <?php
                                                        }
                                                        ?>
                                                        </h4>
                                                    </div>

                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle font-size-16">
                                                                <i class="bx bx-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="media border-top">
                                                    <div class="media-body">
                                                        <div data-simplebar style="max-height: 300px;">
                                                        <ul class="verti-timeline list-unstyled" id="dash_next168_date_top">
                                                        <?php
                                                        if($WeekCalEvents)
                                                        {
                                                            foreach($WeekCalEvents as $wct)
                                                            {
                                                        ?>
                                                        <a href="javascript: void(0);" class="nameLink next168_date_top"  onclick="return EventListViewModal(<?php echo $wct->id;?>)" data-dashrecentdate="<?php echo $wct->event_start_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">
                                                                        <?php 
                                                                        if($wct->created_type == "task")
                                                                        {
                                                                            echo "To Do";
                                                                        }
                                                                        else
                                                                        {
                                                                           echo ucfirst($wct->created_type); 
                                                                        }    
                                                                        ?> 
                                                                        <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $wct->event_name;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                            }
                                                        }
                                                        if($WeekCalInsideTodo)
                                                        {
                                                            foreach($WeekCalInsideTodo as $wcit)
                                                            {
                                                        ?>
                                                        <a href="javascript: void(0);" class="nameLink next168_date_top"  onclick="return EventListViewModal(<?php echo $wcit->event_id;?>)" data-dashrecentdate="<?php echo $wcit->task_start_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">
                                                                        To Do 
                                                                        <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $wcit->task_name;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                            }
                                                        }
                                                        if($WeekTasks)
                                                        {
                                                            //$j = 0;
                                                            foreach($WeekTasks as $wt)
                                                            {
                                                                //if($j==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $wt->tid;?>)" class="nameLink next168_date_top" data-dashrecentdate="<?php echo $wt->tdue_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Task <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $wt->tname;?></p>
                                                                            <p class="mb-0"><?php
                                                                            if($wt->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($wt->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($wt->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById($wt->tproject_assign);
                                                                                if($getPname)
                                                                                {
                                                                                    echo $getPname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                //$j++;
                                                            }
                                                        }
                                                        if($WeekSubtasks)
                                                        {
                                                            //$b = 0;
                                                            foreach($WeekSubtasks as $wst)
                                                            {
                                                                //if($b==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $wst->stid;?>)" class="nameLink next168_date_top" data-dashrecentdate="<?php echo $wst->stdue_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Subtask <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $wst->stname;?></p>
                                                                            <p class="mb-0"><?php
                                                                            if($wst->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($wst->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($wst->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($wst->stproject_assign);
                                                                                if($getPname)
                                                                                {
                                                                                    echo $getPname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                //$b++;
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid" id="tour_my_alerts">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="mb-0">My Alerts
                                                        <?php
                                                        $currentDate = date("Y-m-d");
                                                        $OverdueTasks = $this->Front_model->OverdueTasksDashboard($currentDate);//overdue task notification
                                                        $OverdueSubtasks = $this->Front_model->OverdueSubtasksDashboard($currentDate);
                                                        if($task_notification || $OverdueTasks || $OverdueSubtasks || $pending_plist || $check_task_review_sent || $check_task_review_deny || $check_task_review_approve || $get_all_cproject || $get_all_aproject || $get_all_cproject || $get_all_aproject || $subtask_notification || $check_subtask_review_sent || $check_subtask_review_deny || $check_subtask_review_approve || $check_task_arrive_review || $check_subtask_arrive_review || $check_portfolio_accepted_notify || $check_project_accepted_notify || $check_project_invite_accepted_notify)
                                                        {
                                                        ?><a href="<?php echo base_url('my-alerts');?>" class="nameLink font-size-14"><i class="mdi mdi-arrow-right ms-1 me-1"></i>View All</a>
                                                        <?php
                                                        }
                                                        ?>
                                                        </h4>
                                                    </div>

                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle font-size-16">
                                                                <i class="bx bx-notification"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="media border-top">
                                                    <div class="media-body">
                                                        <div data-simplebar style="max-height: 300px;">
                                                        <ul class="verti-timeline list-unstyled" id="dash_alert_date_top">
                                                        <?php
                                                        if($OverdueTasks)
                                                        {
                                                            //$k = 0;
                                                            foreach($OverdueTasks as $ota)
                                                            {
                                                                if($ota->tstatus != 'done')
                                                                {
                                                                    //if($k==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $ota->tid;?>)" class="nameLink alert_date_top" data-dashrecentoddate="<?php echo $ota->tdue_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Task <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $ota->tname;?></p>
                                                                            <p class="mb-0"><?php
                                                                            if($ota->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($ota->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($ota->tproject_assign != 0) 
                                                                            {
                                                                                $otn_pname = $this->Front_model->check_project_dates($ota->tproject_assign);
                                                                                if($otn_pname)
                                                                                {
                                                                                    echo $otn_pname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                    //$k++;
                                                                }
                                                            }
                                                        }
                                                        if($OverdueSubtasks)
                                                        {
                                                            //$c = 0;
                                                            foreach($OverdueSubtasks as $osta)
                                                            {
                                                                if($osta->ststatus != 'done')
                                                                {
                                                                    //if($c==5) break;
                                                        ?>
                                                        <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $osta->stid;?>)" class="nameLink alert_date_top" data-dashrecentoddate="<?php echo $osta->stdue_date;?>">
                                                        <li class="event-list mt-3">
                                                            <div class="event-timeline-dot">
                                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            </div>
                                                            <div class="media">
                                                                <div class="me-3">
                                                                    <h5 class="font-size-14">Subtask <i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div>
                                                                        <p class="mb-1" key="t-grammer"><?php echo $osta->stname;?></p>
                                                                            <p class="mb-0"><?php
                                                                            if($osta->portfolio_id == 0)
                                                                            {
                                                                                echo "--- : ";
                                                                            }
                                                                            else
                                                                            {
                                                                            $portfolio = $this->Front_model->getPortfolio2($osta->portfolio_id);
                                                                                if($portfolio)
                                                                                {
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name." : ";}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname." : ";}else{ echo $portfolio->portfolio_name." : ";}
                                                                                }
                                                                            }
                                                                            if($osta->stproject_assign != 0) 
                                                                            {
                                                                                $otn_pname = $this->Front_model->check_project_dates($osta->stproject_assign);
                                                                                if($otn_pname)
                                                                                {
                                                                                    echo $otn_pname->pname;
                                                                                }
                                                                            }
                                                                            ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        </a>
                                                        <?php
                                                                    //$c++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </ul>  
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- <?php
                            //include('right_sidebar.php');
                            ?> -->
                        </div>
                        <!-- end row -->  
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php
                if($packageExpired == "yes")
                {
                ?>
                <!--Package Expiry --> 
                <div class="modal fade" id="packageExpiryModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-4">
                                    <div class="avatar-md mx-auto mb-4">
                                        <div class="avatar-title bg-light rounded-circle text-d h1">
                                            <i class="mdi mdi-package-down"></i>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-xl-10">
                                            <h4 class="text-d">Plan Expired !</h4>
                                            <p class="text-muted font-size-14 mb-4">To keep using Decision 168 without interruption, choose a plan from packages!</p>

                                              
                                                <a href="<?php echo base_url('pricing-packages');?>" class="btn btn-d btn-sm">Go To Pricing</a>

                                                <button type="button" class="btn btn-sm btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Package Expiry -->
                <?php
                }

                include('footer.php');
                ?>           
</div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
                                    <!-- Profile Modal -->
                                    <div id="ProfileModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProfileModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProfileModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2-calendar/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!-- apexcharts -->
        <!-- <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script> -->

        <!-- dashboard init -->
        <!-- <script src="<?php echo base_url();?>assets/js/pages/dashboard.init.js"></script> -->
<script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
<?php
include('footer_links.php');
?>
<!-- Subtasks Overview Modal -->
                                    <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskOverviewModal_content">
                                                
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
                                    <!-- Subtasks Edit Modal -->
                                    <div id="SubtaskEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#SubtaskEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="SubtaskEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

<!-- View Event MODAL -->
<div class="modal fade bs-example-modal-center" id="view-event" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 view_label_modal"></h5>

                <button id="add_todobut" class="btn btn-sm btn-d waves-effect waves-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#add-todo"><i class="mdi mdi-plus"></i> Add todo</button>
                <button type="button" class="btn btn-sm btn-d waves-effect waves-light me-2 edit-event edit-list-events">
                    <i class="mdi mdi-file-edit"></i> Edit
                </button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect me-2 delete-event delete-list-events">
                    <i class="mdi mdi-delete"></i> Delete
                </button>

                <button type="button" class="btn-close view_modal_close refresh-list-events" onclick="return view_modal_close_dash();" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4"></div>
                <div class="modal-body-inside-todo"></div>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Update Event MODAL -->
<div class="modal fade bs-example-modal-sm" id="myModalUpdate" role="dialog" style="background: rgba(222, 240, 238, 0.3);">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_type_edit">Choose Option</h5>
                <button type="button" class="btn-close" onclick="return reset_updateOptions();" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div id="update_event_one">
                    <input type="radio" class="form-check-input" id="update_check_value1" name="update_check_value" value="0">
                    <label for="update_check_value1">Update only this !</label><br>
                </div>
                <div id="update_event_one_new">
                    <input type="radio" class="form-check-input" id="update_check_value1" name="update_check_value" value="1">
                    <label for="update_check_value1">Update only this !</label><br>
                </div>
                <div id="update_event_two">
                    <div id="update_event_three">
                        <input type="radio" class="form-check-input" id="update_check_value2" name="update_check_value" value="2">
                        <label for="update_check_value2">Update this and following !</label><br>
                    </div>
                    <input type="radio" class="form-check-input" id="update_check_value3" name="update_check_value" value="1">
                    <label for="update_check_value3">Update all !</label>
                    <br>
                </div>
                <span id="event_update_Err" class="text-danger" ></span>
                <div class="modal_button_up mt-4 float-end" >
                    <button type="button" class="btn btn-sm btn-d waves-effect waves-light update-next-event">Update</button>
                    <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_updateOptions();">Close</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" data-bs-backdrop="static" id="update-event">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="update-category" method="post" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  onclick="reset_updateCalFrom()"></button>
            </div>
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">

                <ul class="nav nav-tabs nav-tabs-custom nav-justified hide_type_radio" role="tablist">
                <input type="radio" value="event" name="created_type" id="created_type_event_update" checked>
                <input type="radio" value="task" name="created_type" id="created_type_task_update">
                <input type="radio" value="reminder" name="created_type" id="created_type_reminder_update">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#cevent" role="tab" aria-selected="true">
                        <span class="d-sm-block selected_type_name"></span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#ctask" role="tab" aria-selected="false" onclick="event_type_task()">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Task</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#creminder" role="tab" aria-selected="false" onclick="event_type_reminder()">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Reminder</span>
                    </a>
                </li> -->
            </ul>
            <div class="tab-content" style="padding: 1rem 1rem 0rem 1rem;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control form-white" placeholder="Enter Title *" type="text" name="event_name" required="" />
                            </div>
                            <span id="event_nameErr" class="text-danger"></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <select class="form-control form-select" data-placeholder="Choose a color..." name="event_color" required="">
                                    <option value="">Select Color *</option>
                                    <option class="bg-success" value="bg-success">Green</option>
                                    <option class="bg-danger" value="bg-danger">Red</option>
                                    <option class="bg-info" value="bg-info">Light Blue</option>
                                    <option class="bg-primary" value="bg-primary">Dark Blue</option>
                                    <option class="bg-warning" value="bg-warning">Orange</option>
                                </select>
                            </div>
                            <span id="event_colorErr" class="text-danger"></span>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle" data-bs-toggle="dropdown" id="selected_color_update" aria-expanded="false">
                                <span id="selected_color_update_text">Choose a color...</span><i class="mdi mdi-chevron-down float-end"></i>
                               </button>
                                <div class="dropdown-menu">
                                <div class="dropdown-item cal_cus_colors">
                                <ul style="padding: 0 !important;margin: 0 !important;">
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color1"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color2"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color3"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color4"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color5"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color6"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color7"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color8"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color9"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color10"></li>
                                    <br>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color11"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color12"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color13"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color14"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color15"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color16"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color17"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color18"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color19"></li>
                                    <li onclick="return select_cal_cus_colors_update(this);" class="cus_cal_color20"></li>
                                    <input type="hidden" name="event_color" id="event_color" required>
                                </ul>
                            </div>
                            </div>
                            </div>
                            <span id="event_colorErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="add_note_div_update">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control form-white" placeholder="Add Note" name="event_note"></textarea>
                            </div>
                            <span id="event_noteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div id="event_field_hide">
                <div class="row mb-3" id="event_start_end_date_select_update">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-daterange input-group" id="datepicker3" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker3'>

                                <input type="text" class="form-control" name="event_start_date_nn" id="event_start_date_nnn" placeholder="Start Date" value=""  onchange="customChangeUpdate()"/>

                                <input type="text" class="form-control" name="event_end_date_nn" id="event_end_date_nnn" placeholder="End Date" value="" onchange="customChangeUpdate()"/>

                            </div>
                            <!-- <span id="event_start_end_dateErr" class="text-danger"></span>
                            <span id="event_start_end_dateErr" class="text-danger"></span> -->
                         </div>
                    </div>
                </div>
                <!-- <div class="row mb-3" id="event_start_end_date_div_update">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="datepicker1">
                                <input type="text" class="form-control" id="event_start_end_date_neww" name="event_start_end_date_new" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" required="">
                            </div>
                            <span id="event_start_end_date_new" class="text-danger" ></span>
                         </div>
                    </div>
                </div> -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <select id="event_repeat_option" name="event_repeat_option" class="form-control form-select event_repeat_optionn" onchange="showEndDateUpdate(this.value);">
                                <option value="Does not repeat">Does not repeat</option>
                                <option value="Daily">Daily</option>
                                <option value="Every Weekday">Every Weekday (Monday to Friday)</option>
                                <option value="Custom" class="custom_value_update">Custom</option>
                                <option value="Weekly" id="weekday_value" class="weekday_value_update">Weekly</option>
                                <option value="Monthly" id="monthly_value" class="monthly_value_update">Monthly</option>
                                <option value="Yearly" id="yearly_value" class="yearly_value_update">Annually</option>
                                </select>
                            </div>
                            <span id="event_repeat_optionErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row custom-class-update" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group mb-3">
                            <div class="cus_radioBTN">
                                <div class="selector">
                                    <div class="selecotr-item" id="radioupdate1">
                                        <input type="checkbox" id="radioupdate_Sun" name="custom_check[]" class="selector-item_radio"  value="Sun">
                                        <label for="radioupdate_Sun" class="selector-item_label">Su</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate2">
                                        <input type="checkbox" id="radioupdate_Mon" name="custom_check[]" class="selector-item_radio" value="Mon">
                                        <label for="radioupdate_Mon" class="selector-item_label">Mo</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate3">
                                        <input type="checkbox" id="radioupdate_Tue" name="custom_check[]" class="selector-item_radio" value="Tue">
                                        <label for="radioupdate_Tue" class="selector-item_label">Tu</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate4">
                                        <input type="checkbox" id="radioupdate_Wed" name="custom_check[]" class="selector-item_radio" value="Wed">
                                        <label for="radioupdate_Wed" class="selector-item_label">We</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate5">
                                        <input type="checkbox" id="radioupdate_Thu" name="custom_check[]" class="selector-item_radio" value="Thu">
                                        <label for="radioupdate_Thu" class="selector-item_label">Th</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate6">
                                        <input type="checkbox" id="radioupdate_Fri" name="custom_check[]" class="selector-item_radio" value="Fri">
                                        <label for="radioupdate_Fri" class="selector-item_label">Fr</label>
                                    </div>
                                    <div class="selecotr-item" id="radioupdate7">
                                        <input type="checkbox" id="radioupdate_Sat" name="custom_check[]" class="selector-item_radio" value="Sat">
                                        <label for="radioupdate_Sat" class="selector-item_label">Sa</label>
                                    </div>
                                </div>
                                <span id="custom_checkErr_update" class="text-danger"></span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <div class="row mb-3" id="date-time-section1">
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_start_time" name="event_start_time" class="form-control select2 update_event_start_time" style="width: 86%;">
                                    <?php
                                    if($time_12hrs){
                                        foreach ($time_12hrs as $t12hrs) {
                                            ?>
                                            <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '06:00 AM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="event_start_timeErr" class="text-danger"></span>
                         </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_end_time" name="event_end_time" class="form-control select2" style="width: 86%;">
                                <?php
                                    if($time_12hrs){
                                        foreach ($time_12hrs as $t12hrs) {
                                            ?>
                                            <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '06:30 AM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                              <span id="event_end_timeErr" class="text-danger"></span>
                         </div>
                        </div>
                    </div>
                </div> 
                <div class="row mb-3">
                    <div class="col-md-6" id="old_reminder_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_reminder" name="event_reminder" class="form-control form-select">
                                <option value="No reminder">No reminder</option>
                                <option value="5 minutes before">5 minutes before</option>
                                <option value="15 minutes before">15 minutes before</option>
                                <option value="30 minutes before">30 minutes before</option>
                                <option value="1 hour before">1 hour before</option>
                                <option value="4 hours before">4 hours before</option>
                                <option value="1 day before">1 day before</option>
                                <option value="2 days before">2 days before</option>
                                <option value="1 week before">1 week before</option>
                                </select>
                            </div>
                                <span id="event_reminderErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6" id="new_reminder_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_reminder" name="event_reminder_new" class="form-control form-select">
                                <option value="No reminder">No reminder</option>
                                <?php
                                    if($time_12hrs){
                                        foreach ($time_12hrs as $t12hrs) {
                                            ?>
                                            <option value="<?php echo $t12hrs->time; ?>"><?php echo $t12hrs->time; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                                <span id="event_reminderErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6" id="task_priority_div_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="task_priority" name="task_priority" class="form-control form-select">
                                    <option value="No Priority">No Priority</option>
                                    <option value="High Priority">High Priority</option>
                                    <option value="Medium Priority">Medium Priority</option>
                                    <option value="Low Priority">Low Priority</option>
                                </select>
                            </div>
                                <span id="task_priorityErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="event_allDay" id="event_allDay1" class="form-check-input" onclick="check_reminder_update(this.value)">
                            <label class="control-label" for="event_allDay1">
                                All Day
                            </label>
                            <span id="event_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group" id="draggable_field_update">
                            <input type="checkbox" name="draggable_event" id="draggable_event1" class="form-check-input">
                            <label class="control-label" for="draggable_event1"> 
                                Draggable Event
                            </label>
                            <span id="draggable_eventErr" class="text-danger"></span>
                        </div>
                    </div> -->
                    <input type="hidden" name="draggable_event" id="draggable_event1" value="">
                </div>
                <div class="row mb-3 end-date-class" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>End date</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="end_date" id="datepicker">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="checkbox_value_get_update" id="checkbox_value_get_update" value="" >
                <input type="hidden" name="draggable_id" id="draggable_id">
                <input type="hidden" name="type" id="type" value="event">
                <input type="hidden" name="event_id" id="event_id">
            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-d waves-effect waves-light update-event-btn">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_updateCalFrom();">Close</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Delete Event MODAL -->
<div class="modal fade bs-example-modal-sm" id="myModal" role="dialog" style="background: rgba(222, 240, 238, 0.3);">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete_type_edit">Choose Option</h5>
                <button type="button" class="btn-close" onclick="return reset_deleteOptions();" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div id="delete_event_one">
                    <input type="radio" class="form-check-input" id="delete_check_value1" name="delete_check_value" value="0">
                    <label for="delete_check_value1">Delete only this !</label><br>
                </div>
                <div id="delete_event_two">
                    <div id="delete_event_three">
                        <input type="radio" class="form-check-input" id="delete_check_value2" name="delete_check_value" value="2">
                        <label for="delete_check_value2">Delete this and following !</label><br>
                    </div>
                    <input type="radio"class="form-check-input" id="delete_check_value3" name="delete_check_value" value="1">
                    <label for="delete_check_value3">Delete all !</label>
                    <br>
                </div>
                <span id="event_delete_Err" class="text-danger" ></span>
                <div class="modal_button_up mt-4 float-end" >
                    <button type="button" class="btn btn-sm btn-d waves-effect waves-light delete-next-event">Delete</button>
                    <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_deleteOptions();">Close</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal-->

<!-- Add Inside To Do Modal -->
<div class="modal fade" data-bs-backdrop="static" id="add-todo" style="background: rgba(222, 240, 238, 0.3);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="add-inside-todo" method="post" name="add-inside-todo" id="add-inside-todo" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel-todo">Create New To Do</h5>
                <button type="button" class="btn-close close-todo" onclick="return reset_todoForm();" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control form-white" placeholder="Enter Title *" type="text" name="task_name" required="" />
                            </div>
                            <span id="task_nameErr" class="text-danger"></span>
                        </div>
                    </div>                    
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control form-white" placeholder="Add Note" name="task_note"></textarea>
                            </div>
                            <span id="task_noteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="priority" name="priority" class="form-control form-select">
                                    <option value="No Priority">No Priority</option>
                                    <option value="High Priority">High Priority</option>
                                    <option value="Medium Priority">Medium Priority</option>
                                    <option value="Low Priority">Low Priority</option>
                                </select>
                            </div>
                                <span id="priorityErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="task_reminder" name="task_reminder" class="form-control form-select">
                                <option value="No reminder">No reminder</option>
                                <option value="5 minutes before">5 minutes before</option>
                                <option value="15 minutes before">15 minutes before</option>
                                <option value="30 minutes before">30 minutes before</option>
                                <option value="1 hour before">1 hour before</option>
                                <option value="4 hours before">4 hours before</option>
                                <option value="1 day before">1 day before</option>
                                <option value="2 days before">2 days before</option>
                                <option value="1 week before">1 week before</option>
                                </select>
                            </div>
                                <span id="task_reminderErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md" id="cl_task_start_date" onmousemove="return todo_inside_datepicker();">
                        <div class="form-group">
                            <div class="input-group" id="datepicker9">
                                <input type="text" class="form-control task_start_date_class" id="task_start_date" name="task_start_date" data-date-format="yyyy-mm-dd" data-date-container='#datepicker9' data-provide="datepicker" data-date-autoclose="true" required="" onchange="return restricted_event_start_time(this.value);">
                            </div>

                            <span id="task_start_dateErr" class="text-danger"></span>
                         </div>
                    </div>
                    <div class="col-md" id="task-time-section">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="task_start_time" name="sel_task_start_time" class="form-control task_create_event_start_time" style="width: 86%;" onchange="return get_selected_todo_time1();">
                                    <option value="">Select time *</option>
                                   
                                </select> 

                                <select id="task_start_time" name="sel_task_start_time" class="form-control all-task-time-section" style="width: 86%; display: none;" onchange="return get_selected_todo_time2();">
                                    <option value="">Select time *</option>
                                    <?php
                                    if($time_12hrs){
                                        foreach ($time_12hrs as $t12hrs) {
                                            ?>
                                            <option value="<?php echo $t12hrs->time; ?>"><?php echo $t12hrs->time; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <span id="task_start_timeErr" class="text-danger"></span>
                         </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="all-day-task-time-section" style="display: none;">
                        <div class="form-group" style="padding: 9px 0px;">
                            <input type="checkbox" name="task_allDay" id="task_allDay" onclick="check_start_time_todo(this.value)" class="form-check-input">
                            <label class="control-label" for="task_allDay">
                                All Day
                            </label>
                            <span id="task_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                 <input type="hidden" name="event_id">
                 <input type="hidden" name="event_unique_key">
                 <input type="hidden" name="get_task_start_date">
                 <input type="hidden" name="task_start_time" id="task_start_time_val">
                 <input type="hidden" name="hidden_event_id">
            </div>
            <div class="modal-footer">
                <div class="form-check form-checkbox-outline form-check-success">
                    <input type="hidden" name="another-todo-cnt" id="another-todo-cnt" value="0">
                    <input class="form-check-input" type="checkbox" name="another-todo" id="another-todo">
                    <label class="form-check-label" for="another-todo">
                         Create another todo
                    </label>
                <span class="badge badge-soft-success" id="show-another-todo-cnt"></span>
                </div>

                <button type="submit" class="btn btn-sm btn-d waves-effect waves-light save-todo">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-todo" onclick="return reset_todoForm();">Close</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->


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

<script id="rendered-js">
$('.contact-side li').hover(function () {
  $(this).stop().animate({
    'right': 0 },
  500);

}, function () {
  $(this).stop().animate({
    'right': "-140px" },
  300);
});
</script>
<script>
$("#nope_quoteModal, #close_quoteModal").on('click', function () {
  $('#quoteModal').addClass('hidden');
  $('#quoteModal').addClass('active');
});

$("#open_quoteModal").on('click', function () {
  $(this).removeClass('active');
  $('#quoteModal').removeClass('hidden');
});

</script>

<script src="<?php echo base_url();?>assets/js/croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/croppie.css">

 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!--tinymce js-->
<!-- <script src="<?php echo base_url();?>assets/libs/tinymce/tinymce.min.js"></script> -->

<!-- email editor init -->
<!-- <script src="<?php echo base_url();?>assets/js/pages/email-editor.init.js"></script> -->
      <!-- <script id="rendered-js">
moment.locale('en', {
  week: { dow: 1 } // Monday is the first day of the week
});

$('#datetimepicker12').datetimepicker({
  inline: true,
  sideBySide: true,
  format: 'DD-MM-YY',
  stepping: 30,
  minDate: moment() });
    </script> -->
    <script src="<?php echo base_url('assets/js/front_calendar_list.js');?>"></script>
    <?php
    include('start_tour.php');
    include('my_tour.php');
    include('start_specific_tour.php');
    ?>
    </body>

</html>