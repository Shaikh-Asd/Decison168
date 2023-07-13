<?php
$page = 'index';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>My Alerts</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="mb-sm-0 font-size-18">Alerts</h4>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">My Alerts</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<style>
            .filterIcon {
                height: 16px;
                width: 16px;
                margin-left: 6px;
            }

            .modalFilter {
                display: none;
                height: auto;
                background: #FFF;
                border: solid 1px #ccc;
                padding: 8px;
                position: absolute;
                z-index: 1001;
                min-width: 160px;
            }

            .modalFilter .modal-content {
                max-height: 250px;
                overflow-y: auto;
            }

            .modalFilter .modal-footer {
                background: #FFF;
                height: 35px;
                padding-top: 6px;
            }

            .modalFilter .btn {
                padding: 0 1em;
                height: 28px;
                line-height: 28px;
                text-transform: none;
            }

        #mask {
            display: none;
            background: transparent;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            opacity: 1000;
        }
    </style>
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
$task_notification = $this->Front_model->task_notification();//new task notification
$currentDate = date("Y-m-d");
$OverdueTasks = $this->Front_model->OverdueTasksDashboard($currentDate);//overdue task notification
$OverdueSubtasks = $this->Front_model->OverdueSubtasksDashboard($currentDate);//overdue subtask notification
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
$check_portfolio_accepted_notify = $this->Front_model->check_portfolio_accepted_notify(); //portfolio accepted
$check_project_accepted_notify = $this->Front_model->check_project_accepted_notify(); //project accepted 
$check_project_invite_accepted_notify = $this->Front_model->check_project_invite_accepted_notify(); //project accepted
$getMeetingInvites_inApp_notify = $this->Front_model->getMeetingInvites_inApp_notify(); //meeting member request notification  
$pending_glist = $this->Front_model->PendingGoalList();//pending goal notification
$getApproveExpertNotify = $this->Front_model->getApproveExpertNotify();//Expert Call Rate notification
$file_preview_permission_notify = $this->Front_model->file_preview_permission_notify();//preview permission notification
$file_preview_permission_resp_notify = $this->Front_model->file_preview_permission_resp_notify();//preview permission response notification
 if($task_notification || $OverdueTasks || $OverdueSubtasks || $pending_plist || $check_task_review_sent || $check_task_review_deny || $check_task_review_approve || $get_all_cproject || $get_all_aproject || $get_all_cproject || $get_all_aproject || $subtask_notification || $check_subtask_review_sent || $check_subtask_review_deny || $check_subtask_review_approve || $check_task_arrive_review || $check_subtask_arrive_review || $check_portfolio_accepted_notify || $check_project_accepted_notify || $check_project_invite_accepted_notify || $getMeetingInvites_inApp_notify || $pending_glist || $getApproveExpertNotify || $file_preview_permission_notify || $file_preview_permission_resp_notify)
 {
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                         <table id="alert_datatable" class="table align-middle table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th scope="col">My Alerts</th>
                                                        <th scope="col">For</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if($task_notification)
                                                    {
                                                        foreach($task_notification as $tn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($tn->tnotify_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $tn->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                T
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $tn->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $tn->tname;?></p>
                                                                                <p class="mb-0"><?php echo $tn->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>New Task Assigned</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($subtask_notification)
                                                    {
                                                        foreach($subtask_notification as $stn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($stn->stnotify_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $stn->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                ST
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $stn->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $stn->stname;?></p>
                                                                                <p class="mb-0"><?php echo $stn->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>New Subtask Assigned</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($get_all_cproject)
                                                    {
                                                        foreach($get_all_cproject as $getcproject)
                                                        {
                                                            $cproject_files = $this->Front_model->ProjectFile($getcproject->pid);
                                                            foreach($cproject_files as $cpro_file)
                                                            {
                                                                if((!empty($cpro_file->pfnotify)) && ($cpro_file->pcreated_by != $this->session->userdata('d168_id')))
                                                                {
                                                                    $c_pfn = explode(',', $cpro_file->pfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $c_pfn))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($cpro_file->pfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return ProjectOverviewFileNotificationModal(<?php echo $getcproject->pid;?>,<?php echo $cpro_file->pfile_id;?>)">
                                                                            <div class="text-reset notification-item">
                                                                                <div class="media">
                                                                                    <div class="avatar-xs me-3">
                                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                            PF
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="media-body me-3">
                                                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php $cpro_filename = substr(trim($cpro_file->pfile), strpos(trim($cpro_file->pfile), '_') + 1); echo substr($cpro_filename,0,30).'...';?></h6>
                                                                                        <div class="font-size-12 text-muted">
                                                                                            <p class="mb-1" key="t-grammer"><?php echo $getcproject->pname;?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Project File</td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                        }   
                                                    }

                                                if($get_all_aproject)
                                                    {
                                                        foreach($get_all_aproject as $getaproject)
                                                        {
                                                            $aproject_files = $this->Front_model->ProjectFile($getaproject->pid);
                                                            foreach($aproject_files as $apro_file)
                                                            {
                                                                if((!empty($apro_file->pfnotify)) && ($apro_file->pcreated_by != $this->session->userdata('d168_id')))
                                                                {
                                                                    $a_pfn = explode(',', $apro_file->pfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $a_pfn))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($apro_file->pfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return ProjectOverviewFileNotificationModal(<?php echo $getaproject->pid;?>,<?php echo $apro_file->pfile_id;?>)">
                                                                            <div class="text-reset notification-item">
                                                                                <div class="media">
                                                                                    <div class="avatar-xs me-3">
                                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                            PF
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="media-body me-3">
                                                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php $apro_filename = substr(trim($apro_file->pfile), strpos(trim($apro_file->pfile), '_') + 1); echo substr($apro_filename,0,30).'...';?></h6>
                                                                                        <div class="font-size-12 text-muted">
                                                                                            <p class="mb-1" key="t-grammer"><?php echo $getaproject->pname;?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Project File</td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if($get_all_cproject)
                                                    {
                                                        foreach($get_all_cproject as $getcproject)
                                                        {
                                                            $cpro_task = $this->Front_model->getTasksProject($getcproject->pid);
                                                            foreach($cpro_task as $c_pt)
                                                            {
                                                                $c_ptnew = explode(',', $c_pt->tfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $c_ptnew))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($c_pt->tfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return TaskFileNotificationModal(<?php echo $c_pt->tid;?>)">
                                                        <div class="text-reset notification-item">
                                                            <div class="media">
                                                                <div class="avatar-xs me-3">
                                                                    <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                        TF
                                                                    </span>
                                                                </div>
                                                                <div class="media-body me-3">
                                                                    <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                                        $all_new_tfile = explode(',', $c_pt->new_file);
                                                                        $count_new_tfile = count($all_new_tfile);
                                                                        for ($it=0; $it<$count_new_tfile; $it++)
                                                                        {
                                                                            $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                                            echo substr($tnew_file,0,30).'...';
                                                                            echo "<br>";
                                                                        }?></h6>
                                                                    <div class="font-size-12 text-muted">
                                                                        <p class="mb-0"><?php echo $c_pt->tcode;?></p>
                                                                            <p class="mb-0"><?php echo $c_pt->tname;?></p>
                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Task File</td>
                                                                </tr>
                                                                <?php
                                                                    } 
                                                            }
                                                        }   
                                                    }
                                                    if($get_all_aproject)
                                                    {
                                                        foreach($get_all_aproject as $getaproject)
                                                        {
                                                            $apro_task = $this->Front_model->getTasksProject($getaproject->pid);
                                                            foreach($apro_task as $a_pt)
                                                            {
                                                                $a_ptnew = explode(',', $a_pt->tfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $a_ptnew))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($a_pt->tfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return TaskFileNotificationModal(<?php echo $a_pt->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                TF
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                                                $all_new_tfile = explode(',', $a_pt->new_file);
                                                                                $count_new_tfile = count($all_new_tfile);
                                                                                for ($it=0; $it<$count_new_tfile; $it++)
                                                                                {
                                                                                    $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                                                    echo substr($tnew_file,0,30).'...';
                                                                                    echo "<br>";
                                                                                }?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-0"><?php echo $a_pt->tcode;?></p>
                                                                                    <p class="mb-0"><?php echo $a_pt->tname;?></p>
                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Task File</td>
                                                                </tr>
                                                                <?php
                                                                    } 
                                                            }
                                                        }
                                                    }

                                                    if($get_all_cproject)
                                                    {
                                                        foreach($get_all_cproject as $getcproject)
                                                        {
                                                            $cpro_subtask = $this->Front_model->getSubtasksProject($getcproject->pid);
                                                            foreach($cpro_subtask as $c_pst)
                                                            {
                                                                $c_pstnew = explode(',', $c_pst->stfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $c_pstnew))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($c_pst->stfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return SubtaskFileNotificationModal(<?php echo $c_pst->stid;?>)">
                                                            <div class="text-reset notification-item">
                                                                <div class="media">
                                                                    <div class="avatar-xs me-3">
                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                            SF
                                                                        </span>
                                                                    </div>
                                                                    <div class="media-body me-3">
                                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                                            $all_new_tfile = explode(',', $c_pst->snew_file);
                                                                            $count_new_tfile = count($all_new_tfile);
                                                                            for ($it=0; $it<$count_new_tfile; $it++)
                                                                            {
                                                                                $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                                                echo substr($tnew_file,0,30).'...';
                                                                                echo "<br>";
                                                                            }?></h6>
                                                                        <div class="font-size-12 text-muted">
                                                                            <p class="mb-0"><?php echo $c_pst->stcode;?></p>
                                                                                <p class="mb-0"><?php echo $c_pst->stname;?></p>
                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Subtask File</td>
                                                                </tr>
                                                                <?php
                                                                    } 
                                                            }
                                                        }   
                                                    }
                                                    if($get_all_aproject)
                                                    {
                                                        foreach($get_all_aproject as $getaproject)
                                                        {
                                                            $apro_subtask = $this->Front_model->getSubtasksProject($getaproject->pid);
                                                            foreach($apro_subtask as $a_pst)
                                                            {
                                                                $a_pstnew = explode(',', $a_pst->stfnotify);
                                                                    if(in_array($this->session->userdata('d168_id'), $a_pstnew))
                                                                    {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($a_pst->stfnotify_date));?></td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" onclick="return SubtaskFileNotificationModal(<?php echo $a_pst->stid;?>)">
                                                            <div class="text-reset notification-item">
                                                                <div class="media">
                                                                    <div class="avatar-xs me-3">
                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                            SF
                                                                        </span>
                                                                    </div>
                                                                    <div class="media-body me-3">
                                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                                            $all_new_tfile = explode(',', $a_pst->snew_file);
                                                                            $count_new_tfile = count($all_new_tfile);
                                                                            for ($it=0; $it<$count_new_tfile; $it++)
                                                                            {
                                                                                $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                                                echo substr($tnew_file,0,30).'...';
                                                                                echo "<br>";
                                                                            }?></h6>
                                                                        <div class="font-size-12 text-muted">
                                                                            <p class="mb-0"><?php echo $a_pst->stcode;?></p>
                                                                                <p class="mb-0"><?php echo $a_pst->stname;?></p>
                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Subtask File</td>
                                                                </tr>
                                                                <?php
                                                                    } 
                                                            }
                                                        }
                                                    }

                                                    if($check_task_review_sent)
                                                    {
                                                        foreach($check_task_review_sent as $trsn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($trsn->review_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $trsn->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RT
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $trsn->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $trsn->tname;?></p>
                                                                                <p class="mb-0">Task sent for Review!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Task Sent to Review</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_task_review_deny)
                                                    {
                                                        foreach($check_task_review_deny as $trdn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($trdn->review_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $trdn->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                                                                DT
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $trdn->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $trdn->tname;?></p>
                                                                                <p class="mb-0">Task Review and Denied! Do it Again!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Task Review & Denied</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_task_review_approve)
                                                    {
                                                        foreach($check_task_review_approve as $tran)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($tran->review_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $tran->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RT
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $tran->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $tran->tname;?></p>
                                                                                <p class="mb-0">Task Review and Approved!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Task Review & Approved</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_subtask_review_sent)
                                                    {
                                                        foreach($check_subtask_review_sent as $trsn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($trsn->sreview_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $trsn->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RS
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $trsn->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $trsn->stname;?></p>
                                                                                <p class="mb-0">Subtask sent for Review!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Subtask Sent to Review</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_subtask_review_deny)
                                                    {
                                                        foreach($check_subtask_review_deny as $trdn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($trdn->sreview_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $trdn->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                                                                DS
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $trdn->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $trdn->stname;?></p>
                                                                                <p class="mb-0">Subtask Review and Denied! Do it Again!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Subtask Review & Denied</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_subtask_review_approve)
                                                    {
                                                        foreach($check_subtask_review_approve as $tran)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($tran->sreview_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $tran->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RS
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $tran->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $tran->stname;?></p>
                                                                                <p class="mb-0">Subtask Review and Approved!</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Subtask Review & Approved</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($pending_plist)
                                                    {
                                                        foreach($pending_plist as $ppn)
                                                        {
                                                            if($ppn->portfolio_id != 0)
                                                                {
                                                                    $portfolio = $this->Front_model->getPortfolio2($ppn->portfolio_id);
                                                                    $port_name = $portfolio->portfolio_name;
                                                                } 
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($ppn->sent_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return ProjectOverviewRequestNotificationModal(<?php echo $ppn->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                P
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $ppn->pname;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php if(!empty($port_name)){echo $port_name;}?></p>
                                                                                <p class="mb-0"><?php 
                                                                                if($ppn->ptype == "content")
                                                                                {
                                                                                    echo 'Type : Content';
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo 'Type : Project';
                                                                                }?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>New Project Request</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($OverdueTasks)
                                                    {
                                                        foreach($OverdueTasks as $otn)
                                                        {
                                                            if($otn->tstatus != 'done')
                                                            {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($otn->tdue_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $otn->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                                                                OT
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $otn->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $otn->tname;?></p>
                                                                                <p class="mb-0"><?php
                                                                                if($otn->tproject_assign != 0) 
                                                                                {
                                                                                    $otn_pname = $this->Front_model->check_project_dates($otn->tproject_assign);
                                                                                    if($otn_pname)
                                                                                    {
                                                                                        echo $otn_pname->pname;
                                                                                    }
                                                                                }
                                                                                ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Task Overdue</td>
                                                    </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    if($OverdueSubtasks)
                                                    {
                                                        foreach($OverdueSubtasks as $ostn)
                                                        {
                                                            if($ostn->ststatus != 'done')
                                                            {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($ostn->stdue_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $ostn->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                                                                OS
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $ostn->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $ostn->stname;?></p>
                                                                                <p class="mb-0"><?php
                                                                                if($ostn->stproject_assign != 0) 
                                                                                {
                                                                                    $otn_pname = $this->Front_model->check_project_dates($ostn->stproject_assign);
                                                                                    if($otn_pname)
                                                                                    {
                                                                                        echo $otn_pname->pname;
                                                                                    }
                                                                                }
                                                                                ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Subtask Overdue</td>
                                                    </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }

                                                    if($get_all_cproject)
                                                    {
                                                        foreach($get_all_cproject as $pcn_pro)
                                                        {
                                                            $pcn_pid = $pcn_pro->pid;
                                                            $pcn_allAssigneesByPID = $this->Front_model->pcn_allAssigneesByPID($pcn_pid);
                                                            if($pcn_allAssigneesByPID)
                                                            {
                                                                $check_cpnotify = 'no';
                                                                $get_pcn_pc_code = array();
                                                                $get_pcn_platform = array();
                                                                $get_pcn_notify_date = array();
                                                                $new_pcn_notify = $pcn_pro->pcreated_date;
                                                                foreach($pcn_allAssigneesByPID as $pcn)
                                                                {
                                                                    $pcn_assignee = explode(',', $pcn->pc_notify);
                                                                    if((!empty($pcn->pc_notify)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                                                    {
                                                                        if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                                                        {
                                                                            $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                                            $get_pcn_pc_code[] = $pcn->pc_code;
                                                                            $get_pcn_platform[] = $pcn->platform;
                                                                            $check_cpnotify = 'yes';
                                                                        }
                                                                    }
                                                                }
                                                                if(!empty($get_pcn_notify_date))
                                                                {
                                                                    $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                                                    $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                                                    if(!empty($pcn_notify_date[0]))
                                                                    {
                                                                      $new_pcn_notify = $pcn_notify_date[0];  
                                                                    }
                                                                }
                                                                if($check_cpnotify == 'yes')
                                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                CP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer">
                                                                    <?php
                                                                    if(!empty($get_pcn_platform))
                                                                    {
                                                                        $new_pcn_platform = implode(',', $get_pcn_platform);
                                                                        $pcn_platform = explode(',', $new_pcn_platform);
                                                                        $pcn_platform_cnt = count($pcn_platform);
                                                                        if($pcn_platform_cnt > 0)
                                                                        {
                                                                            for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                                            {
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> </label>
                                                          <?php
                                                          }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></p>
                                                                                <p class="mb-0"><?php echo $pcn_pro->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Planned Content Assignee</td>
                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if($get_all_aproject)
                                                    {
                                                        foreach($get_all_aproject as $pcn_pro)
                                                        {
                                                            $pcn_pid = $pcn_pro->pid;
                                                            $pcn_allAssigneesByPID = $this->Front_model->pcn_allAssigneesByPID($pcn_pid);
                                                            if($pcn_allAssigneesByPID)
                                                            {
                                                                $check_cpnotify = 'no';
                                                                $get_pcn_pc_code = array();
                                                                $get_pcn_platform = array();
                                                                $get_pcn_notify_date = array();
                                                                $new_pcn_notify = $pcn_pro->pcreated_date;
                                                                foreach($pcn_allAssigneesByPID as $pcn)
                                                                {
                                                                    $pcn_assignee = explode(',', $pcn->pc_notify);
                                                                    if((!empty($pcn->pc_notify)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                                                    {
                                                                        if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                                                        {
                                                                            $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                                            $get_pcn_pc_code[] = $pcn->pc_code;
                                                                            $get_pcn_platform[] = $pcn->platform;
                                                                            $check_cpnotify = 'yes';
                                                                        }
                                                                    }
                                                                }
                                                                if(!empty($get_pcn_notify_date))
                                                                {
                                                                    $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                                                    $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                                                    if(!empty($pcn_notify_date[0]))
                                                                    {
                                                                      $new_pcn_notify = $pcn_notify_date[0];  
                                                                    }
                                                                }
                                                                if($check_cpnotify == 'yes')
                                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                CP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer">
                                                                    <?php
                                                                    if(!empty($get_pcn_platform))
                                                                    {
                                                                        $new_pcn_platform = implode(',', $get_pcn_platform);
                                                                        $pcn_platform = explode(',', $new_pcn_platform);
                                                                        $pcn_platform_cnt = count($pcn_platform);
                                                                        if($pcn_platform_cnt > 0)
                                                                        {
                                                                            for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                                            {
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> </label>
                                                          <?php
                                                          }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></p>
                                                                                <p class="mb-0"><?php echo $pcn_pro->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Planned Content Assignee</td>
                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if($get_all_pproject)
                                                    {
                                                        foreach($get_all_pproject as $pcn_pro)
                                                        {
                                                            $pcn_pid = $pcn_pro->pid;
                                                            $pcn_allAssigneesByPID = $this->Front_model->pcn_allAssigneesByPID($pcn_pid);
                                                            if($pcn_allAssigneesByPID)
                                                            {
                                                                $check_cpnotify = 'no';
                                                                $get_pcn_pc_code = array();
                                                                $get_pcn_platform = array();
                                                                $get_pcn_notify_date = array();
                                                                $new_pcn_notify = $pcn_pro->pcreated_date;
                                                                foreach($pcn_allAssigneesByPID as $pcn)
                                                                {
                                                                    $pcn_assignee = explode(',', $pcn->pc_notify);
                                                                    if((!empty($pcn->pc_notify)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                                                    {
                                                                        if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                                                        {
                                                                            $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                                            $get_pcn_pc_code[] = $pcn->pc_code;
                                                                            $get_pcn_platform[] = $pcn->platform;
                                                                            $check_cpnotify = 'yes';
                                                                        }
                                                                    }
                                                                }
                                                                if(!empty($get_pcn_notify_date))
                                                                {
                                                                    $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                                                    $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                                                    if(!empty($pcn_notify_date[0]))
                                                                    {
                                                                      $new_pcn_notify = $pcn_notify_date[0];  
                                                                    }
                                                                }
                                                                if($check_cpnotify == 'yes')
                                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                CP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer">
                                                                    <?php
                                                                    if(!empty($get_pcn_platform))
                                                                    {
                                                                        $new_pcn_platform = implode(',', $get_pcn_platform);
                                                                        $pcn_platform = explode(',', $new_pcn_platform);
                                                                        $pcn_platform_cnt = count($pcn_platform);
                                                                        if($pcn_platform_cnt > 0)
                                                                        {
                                                                            for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                                            {
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> </label>
                                                          <?php
                                                          }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></p>
                                                                                <p class="mb-0"><?php echo $pcn_pro->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Planned Content Assignee</td>
                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if($get_all_rproject)
                                                    {
                                                        foreach($get_all_rproject as $pcn_pro)
                                                        {
                                                            $pcn_pid = $pcn_pro->pid;
                                                            $pcn_allAssigneesByPID = $this->Front_model->pcn_allAssigneesByPID($pcn_pid);
                                                            if($pcn_allAssigneesByPID)
                                                            {
                                                                $check_cpnotify = 'no';
                                                                $get_pcn_pc_code = array();
                                                                $get_pcn_platform = array();
                                                                $get_pcn_notify_date = array();
                                                                $new_pcn_notify = $pcn_pro->pcreated_date;
                                                                foreach($pcn_allAssigneesByPID as $pcn)
                                                                {
                                                                    $pcn_assignee = explode(',', $pcn->pc_notify);
                                                                    if((!empty($pcn->pc_notify)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                                                    {
                                                                        if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                                                        {
                                                                            $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                                            $get_pcn_pc_code[] = $pcn->pc_code;
                                                                            $get_pcn_platform[] = $pcn->platform;
                                                                            $check_cpnotify = 'yes';
                                                                        }
                                                                    }
                                                                }
                                                                if(!empty($get_pcn_notify_date))
                                                                {
                                                                    $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                                                    $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                                                    if(!empty($pcn_notify_date[0]))
                                                                    {
                                                                      $new_pcn_notify = $pcn_notify_date[0];  
                                                                    }
                                                                }
                                                                if($check_cpnotify == 'yes')
                                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                CP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer">
                                                                    <?php
                                                                    if(!empty($get_pcn_platform))
                                                                    {
                                                                        $new_pcn_platform = implode(',', $get_pcn_platform);
                                                                        $pcn_platform = explode(',', $new_pcn_platform);
                                                                        $pcn_platform_cnt = count($pcn_platform);
                                                                        if($pcn_platform_cnt > 0)
                                                                        {
                                                                            for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                                            { 
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i></label>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> </label>
                                                          <?php
                                                          }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></p>
                                                                                <p class="mb-0"><?php echo $pcn_pro->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Planned Content Assignee</td>
                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if($check_task_arrive_review)
                                                    {
                                                        foreach($check_task_arrive_review as $tarn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($tarn->review_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return TaskOverviewNotificationModal(<?php echo $tarn->tid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RT
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $tarn->tcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $tarn->tname;?></p>
                                                                                <p class="mb-0"><?php echo $tarn->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Task Arrive for Review</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_subtask_arrive_review)
                                                    {
                                                        foreach($check_subtask_arrive_review as $starn)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($starn->sreview_notdate));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return SubtaskOverviewNotificationModal(<?php echo $starn->stid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                RS
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $starn->stcode;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $starn->stname;?></p>
                                                                                <p class="mb-0"><?php echo $starn->pname;?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Subtask Arrive for Review</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }

                                                    if($check_portfolio_accepted_notify)
                                                    {
                                                        foreach($check_portfolio_accepted_notify as $cpanc)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($cpanc->status_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return PortfolioAcceptedReqNotificationModal(<?php echo $cpanc->pim_id;?>,<?php echo $cpanc->portfolio_id;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                AP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $cpanc->sent_to;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php if($cpanc->portfolio_user == 'company'){ echo $cpanc->portfolio_name;}elseif($cpanc->portfolio_user == 'individual'){ echo $cpanc->portfolio_name.' '.$cpanc->portfolio_lname;}else{ echo $cpanc->portfolio_name;}?></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Portfolio Accepted Request</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    if($check_project_accepted_notify)
                                                    {
                                                        foreach($check_project_accepted_notify as $cpranc)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($cpranc->status_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return ProjectAcceptedReqNotificationModal(<?php echo $cpranc->pm_id;?>,<?php echo $cpranc->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                AP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php $reg_name = $this->Front_model->getStudentById($cpranc->pmember);
                                                                            if($reg_name)
                                                                                {
                                                                                    echo $reg_name->first_name." ".$reg_name->last_name;
                                                                                }?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $cpranc->pname;?></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Project Request Accepted</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    if($check_project_invite_accepted_notify)
                                                    {
                                                        foreach($check_project_invite_accepted_notify as $cpiranc)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($cpiranc->accept_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return ProjectAcceptedInviteReqNotificationModal(<?php echo $cpiranc->im_id;?>,<?php echo $cpiranc->pid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                AP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $cpiranc->sent_to;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $cpiranc->pname;?></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Project Request Accepted</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    if($get_all_cproject)
                                                    {
                                                        foreach($get_all_cproject as $getcproject)
                                                        {
                                                            $cproject_comment = $this->Front_model->ProjectComment($getcproject->pid);
                                                            $check_proComment = "";
                                                            foreach($cproject_comment as $cpro_comment)
                                                            {
                                                                if((!empty($cpro_comment->c_notify)) && ($cpro_comment->c_created_by != $this->session->userdata('d168_id')))
                                                                {
                                                                    $c_pfn = explode(',', $cpro_comment->c_notify);
                                                                    if(in_array($this->session->userdata('d168_id'), $c_pfn))
                                                                    {
                                                                        if($check_proComment != $cpro_comment->project_id)
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($cpro_comment->c_created_date));?></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url('projects-overview'.'/'.$getcproject->pid)?>">
                                                                            <div class="text-reset notification-item">
                                                                                <div class="media">
                                                                                    <div class="avatar-xs me-3">
                                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                            PC
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="media-body me-3">
                                                                                        <h6 class="mt-0 mb-1" key="t-your-order">Comment Added, Click to check!</h6>
                                                                                        <div class="font-size-12 text-muted">
                                                                                            <p class="mb-1" key="t-grammer"><?php echo $getcproject->pname;?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Project Comment</td>
                                                                </tr>
                                                                <?php
                                                                        $check_proComment = $getcproject->pid;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }   
                                                    }

                                                if($get_all_aproject)
                                                    {
                                                        foreach($get_all_aproject as $getaproject)
                                                        {
                                                            $aproject_comment = $this->Front_model->ProjectComment($getaproject->pid);
                                                            $check_proComment2 = "";
                                                            foreach($aproject_comment as $apro_comment)
                                                            {
                                                                if((!empty($apro_comment->c_notify)) && ($apro_comment->c_created_by != $this->session->userdata('d168_id')))
                                                                {
                                                                    $a_pfn = explode(',', $apro_comment->c_notify);
                                                                    if(in_array($this->session->userdata('d168_id'), $a_pfn))
                                                                    {
                                                                        if($check_proComment2 != $apro_comment->project_id)
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d',strtotime($apro_comment->c_created_date));?></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url('projects-overview-accepted'.'/'.$getaproject->pid)?>">
                                                                            <div class="text-reset notification-item">
                                                                                <div class="media">
                                                                                    <div class="avatar-xs me-3">
                                                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                            PC
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="media-body me-3">
                                                                                        <h6 class="mt-0 mb-1" key="t-your-order">Comment Added, Click to check!</h6>
                                                                                        <div class="font-size-12 text-muted">
                                                                                            <p class="mb-1" key="t-grammer"><?php echo $getaproject->pname;?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>New Project Comment</td>
                                                                </tr>
                                                                <?php
                                                                        $check_proComment2 = $getaproject->pid;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($getMeetingInvites_inApp_notify)
                                                    {
                                                        foreach($getMeetingInvites_inApp_notify as $mina)
                                                        {
                                                            $evt_detail = $this->Front_model->getEventMeetingDetail($mina->event_unique_key);
                                                              $mina_date = date('Y-m-d',strtotime($mina->status_date));
                                                              if($evt_detail)
                                                              {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($mina_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return MeetingMemberNotificationModal('<?php echo $mina->event_unique_key;?>')">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                MR
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $evt_detail->event_name;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>Meeting Member Request</td>
                                                    </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }     

                                                    if($pending_glist)
                                                    {
                                                        foreach($pending_glist as $gpn)
                                                        {
                                                            if($gpn->portfolio_id != 0)
                                                                {
                                                                    $portfolio = $this->Front_model->getPortfolio2($gpn->portfolio_id);
                                                                    $port_name = $portfolio->portfolio_name;
                                                                } 
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d',strtotime($gpn->sent_date));?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return GoalOverviewRequestNotificationModal(<?php echo $gpn->gid;?>)">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                G
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $gpn->gname;?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php if(!empty($port_name)){echo $port_name;}?></p>
                                                                                <p class="mb-0"><?php echo 'Type : Goals & Strategies';?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>New Goal Request</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }    

                                                    if($getApproveExpertNotify) 
                                                    {   
                                                        foreach($getApproveExpertNotify as $gaen)   
                                                        {   
                                                    ?>  
                                                    <tr>    
                                                        <td><?php echo date('Y-m-d',strtotime($gaen->expert_approved_date));?></td> 
                                                        <td>    
                                                            <a href="<?php echo base_url('profile'); ?>">   
                                                                <div class="text-reset notification-item">  
                                                                    <div class="media"> 
                                                                        <div class="avatar-xs me-3">    
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">    
                                                                                EA  
                                                                            </span> 
                                                                        </div>  
                                                                        <div class="media-body me-3">   
                                                                            <h6 class="mt-0 mb-1" key="t-your-order">Admin Approved your request for becoming Decision Maker</h6>   
                                                                            <div class="font-size-12 text-muted">   
                                                                                <p class="mb-0">Update your call rate</p>   
                                                                            </div>  
                                                                        </div>  
                                                                    </div>  
                                                                </div>  
                                                            </a>    
                                                        </td>   
                                                        <td>Approved as Decision Maker</td> 
                                                    </tr>   
                                                    <?php   
                                                        }   
                                                    } 
                                                                                            
                                                    if($file_preview_permission_notify)
                                                    {
                                                        foreach($file_preview_permission_notify as $fppn)
                                                        {
                                                            $getEmailID = $this->Front_model->getStudentById($fppn->req_by);
                                                            $getProject = $this->Front_model->getProjectDetailID($fppn->pid);
                                                            if(($getEmailID) && ($getProject))
                                                            {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $fppn->req_date;?></td>
                                                        <td>
                                                            <a href="javascript: void(0);" onclick="return FilePreviewPermissionNotificationModal('<?php echo $fppn->fpid;?>')">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                FP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo ucfirst($getEmailID->first_name).' '.ucfirst($getEmailID->last_name).' has requested to preview files';?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $getProject->pname;?></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>File Preview Permission Request</td>
                                                    </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }  

                                                    if($file_preview_permission_resp_notify)
                                                    {
                                                        foreach($file_preview_permission_resp_notify as $fpprn)
                                                        {
                                                            $getProject = $this->Front_model->getProjectDetailID($fpprn->pid);
                                                            if($getProject)
                                                            {
                                                                $checkif_pmem_ex = $this->Front_model->check_pro_member_exists($fpprn->pid,$this->session->userdata('d168_id'));
                                                                  if($checkif_pmem_ex)
                                                                  {
                                                                    if($checkif_pmem_ex->status == 'accepted')
                                                                    {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $fpprn->res_date;?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('projects-overview-accepted'.'/'.$fpprn->pid)?>">
                                                                <div class="text-reset notification-item">
                                                                    <div class="media">
                                                                        <div class="avatar-xs me-3">
                                                                            <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                                FP
                                                                            </span>
                                                                        </div>
                                                                        <div class="media-body me-3">
                                                                            <h6 class="mt-0 mb-1" key="t-your-order"><?php echo 'File preview permission '.$fpprn->req_status.'!';?></h6>
                                                                            <div class="font-size-12 text-muted">
                                                                                <p class="mb-1" key="t-grammer"><?php echo $getProject->pname;?></p>
                                                                                <p class="mb-0"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>File Preview Permission Request</td>
                                                    </tr>
                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }        
                                                    ?> 
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
          
                <?php
                }
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script><!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script> 
        <?php
include('footer_links.php');
?>
                                    <!-- Subtasks Edit Modal -->
                                    <div id="SubtaskEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#SubtaskEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="SubtaskEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
<script>
    function configFilter($this, colArray) {
        //debugger;
            setTimeout(function () {
                var tableName = $this[0].id;
                var columns = $this.api().columns();
                $.each(colArray, function (i, arg) {
                    $('#' + tableName + ' th:eq(' + arg + ')').append('<img src="<?php echo base_url('assets/images/filter.png');?>" class="filterIcon" onclick="showFilter(event,\'' + tableName + '_' + arg + '\')" />');
                });

                var template = '<div class="modalFilter">' +
                                 '<div class="modal-content">' +
                                 '{0}</div>' +
                                 '<div class="modal-footer">' +
                                     '<a href="#!" onclick="clearFilter(this, {1}, \'{2}\');"  class=" btn bg-d btn-sm text-white">Clear</a>' +
                                     '<a href="#!" onclick="performFilter(this, {1}, \'{2}\');"  class=" btn btn-d btn-sm">Ok</a>' +
                                 '</div>' +
                             '</div>';
                $.each(colArray, function (index, value) {
                    //debugger;
                    columns.every(function (i) {
                        //debugger;
                        if (value === i) {
                            var column = this, content = '<input type="text" class="filterSearchText" onkeyup="filterValues(this)" /> <br/>';
                            var columnName = $(this.header()).text().replace(/\s+/g, "_");
                            var distinctArray = [];
                            column.data().each(function (d, j) {
                                if (distinctArray.indexOf(d) == -1) {
                                    var id = tableName + "_" + columnName + "_" + j; // onchange="formatValues(this,' + value + ');
                                    content += '<div><input type="checkbox" style="margin-right:10px;" value="' + d + '"  id="' + id + '"/><label for="' + id + '"> ' + d + '</label></div>';
                                    distinctArray.push(d);
                                }
                            });
                            var newTemplate = $(template.replace('{0}', content).replace('{1}', value).replace('{1}', value).replace('{2}', tableName).replace('{2}', tableName));
                            $('body').append(newTemplate);
                            modalFilterArray[tableName + "_" + value] = newTemplate;
                            content = '';
                        }
                    });
                });
            }, 50);
        }
        var modalFilterArray = {};
        //User to show the filter modal
        function showFilter(e, index) {
            $('.modalFilter').hide();
            $(modalFilterArray[index]).css({ left: 0, top: 0 });
            var th = $(e.target).parent();
            var pos = th.offset();
            console.log(th);
            $(modalFilterArray[index]).width(th.width() * 0.9);
            $(modalFilterArray[index]).css({ 'left': pos.left, 'top': pos.top });
            $(modalFilterArray[index]).show();
            $('#mask').show();
            e.stopPropagation();
        }

        //This function is to use the searchbox to filter the checkbox
        function filterValues(node) {
            var searchString = $(node).val();
            var rootNode = $(node).parent();
            if (searchString == '') {
                rootNode.find('div').show();
            } else {
                rootNode.find("div").hide();
                rootNode.find("div:contains('" + searchString + "')").show();
            }
        }

        //Execute the filter on the table for a given column
        function performFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            var searchString = '', counter = 0;

            rootNode.find('input:checkbox').each(function (index, checkbox) {
                if (checkbox.checked) {
                    searchString += (counter == 0) ? checkbox.value : '|' + checkbox.value;
                    counter++;
                }
            });
            $('#' + tableId).DataTable().column(i).search(
                searchString,
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }

        //Removes the filter from the table for a given column
        function clearFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            rootNode.find(".filterSearchText").val('');
            rootNode.find('input:checkbox').each(function (index, checkbox) {
                checkbox.checked = false;
                $(checkbox).parent().show();
            });
            $('#' + tableId).DataTable().column(i).search(
                '',
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }
    </script>
    </body>

</html>