<?php
$page = 'overdue-tasks';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Overdue Tasks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- dragula css -->
<link href="<?php echo base_url();?>assets/libs/dragula/dragula.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="mb-sm-0 font-size-18">Tasks</h4>
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
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('tasks-create');?>">
                                    <i class="mdi mdi-plus"></i> Create New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="btn btn-sm bg-d text-white mb-2" data-bs-toggle="collapse" href="#trashGrid" aria-expanded="true" aria-controls="trashGrid"><i class="bx bx-trash"></i> Trash</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php
if(($this->session->flashdata('alert_message')) && ($this->session->flashdata('alert_message') != ""))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
<?php echo $this->session->flashdata('alert_message'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row">   
                          <div class="col-lg-12">
                                <div class="card"> 
                                    <div class="card-body" id="refresh_tasklist_status_change">
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
                                       <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#all_task" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-clipboard-list"></i></span>
                                                    <span class="d-none d-sm-block">Overdue Task</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#completed" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-check"></i></span>
                                                    <span class="d-none d-sm-block">Completed</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#in_complete" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-window-close"></i></span>
                                                    <span class="d-none d-sm-block">Incomplete</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#trash" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-trash-alt"></i></span>
                                                    <span class="d-none d-sm-block">Trash</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="all_task" role="tabpanel">
                                                <p class="mb-0">
                                                   <div data-simplebar style="max-height: 800px;">
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle mb-0"> 
                                                            <tbody>
                                                                <?php
                                                                if($OverdueTasks)
                                                                {
                                                                    foreach($OverdueTasks as $atl)
                                                                    {
                                                                        if($atl->tstatus != 'done')
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
                                                                        </div>
                                                                    </td>        
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);

                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->tcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->tname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->tname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->tname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->tdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->tdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->tdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->tdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tstatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
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
                                                                if($OverdueSubtasks)
                                                                {
                                                                    foreach($OverdueSubtasks as $atl)
                                                                    {
                                                                ?>
                                                                <tr style="background-color: aliceblue;">
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $atl->stid;?>','<?php echo $atl->ststatus;?>');">
                                                                        </div>
                                                                    </td>       
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                            } 
                                                                                        }
                                                                                    }
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        } 
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->stcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->stname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->stname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->stname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->stdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->stdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->stdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->stdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->stpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->ststatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
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
                                            </div>
                                            <div class="tab-pane" id="completed" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 800px;">
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle mb-0"> 
                                                            <tbody>
                                                                <?php
                                                                if($OverdueTasks)
                                                                {
                                                                    foreach($OverdueTasks as $atl)
                                                                    {
                                                                        if($atl->tstatus == 'done')
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
                                                                        </div>
                                                                    </td>        
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);

                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->tcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->tname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->tname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->tname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->tdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->tdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->tdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->tdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tstatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
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
                                                                if($OverdueSubtasks)
                                                                {
                                                                    foreach($OverdueSubtasks as $atl)
                                                                    {
                                                                        if($atl->ststatus == 'done')
                                                                        {
                                                                ?>
                                                                <tr style="background-color: aliceblue;">
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $atl->stid;?>','<?php echo $atl->ststatus;?>');">
                                                                        </div>
                                                                    </td>       
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                            } 
                                                                                        }
                                                                                    }
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        } 
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->stcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->stname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->stname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->stname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->stdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->stdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->stdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->stdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->stpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->ststatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
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
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="in_complete" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 800px;">
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle mb-0"> 
                                                            <tbody>
                                                                <?php
                                                                if($OverdueTasks)
                                                                {
                                                                    foreach($OverdueTasks as $atl)
                                                                    {
                                                                        if($atl->tstatus != 'done')
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->tstatus == 'done'){ echo "checked";}?> onclick="return tasklist_status_change('<?php echo $atl->tid;?>','<?php echo $atl->tstatus;?>');">
                                                                        </div>
                                                                    </td>        
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);

                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->tcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->tname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->tname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->tname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->tdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->tdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->tdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->tdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->tstatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->tstatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
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
                                                                if($OverdueSubtasks)
                                                                {
                                                                    foreach($OverdueSubtasks as $atl)
                                                                    {
                                                                        if($atl->ststatus != 'done')
                                                                        {
                                                                ?>
                                                                <tr style="background-color: aliceblue;">
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center">
                                                                        <input class="form-check-input" type="checkbox" <?php if($atl->ststatus == 'done'){ echo "checked";}?> onclick="return subtasklist_status_change('<?php echo $atl->stid;?>','<?php echo $atl->ststatus;?>');">
                                                                        </div>
                                                                    </td>       
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($atl->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                                                                                ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                            } 
                                                                                        }
                                                                                    }
                                                                                        else
                                                                                        {
                                                                                            echo $getPname->pname;
                                                                                        } 
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $atl->stcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="nameLink" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                                                                                        <?php
                                                                                        if(strlen($atl->stname) > 20)
                                                                                            {
                                                                                                print_r(substr($atl->stname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $atl->stname;
                                                                                            }
                                                                                        ?>
                                                                                    </a></h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($atl->stdes) > 35)
                                                                                        {
                                                                                            print_r(substr($atl->stdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $atl->stdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $atl->stdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->stpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->stpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($atl->ststatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($atl->ststatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
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
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="trash" role="tabpanel">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 800px;">
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle mb-0"> 
                                                            <tbody>
                                                                <?php
                                                                if($OverdueTasksTrashlist)
                                                                {
                                                                    foreach($OverdueTasksTrashlist as $ttl)
                                                                    { 
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center form-check-danger">
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $ttl->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $ttl->tid;?>">Restore</a>
                                                                        </div>
                                                                    </td>       
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($ttl->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($ttl->tproject_assign);

                                                                                  ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                         echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $ttl->tcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                                        <?php
                                                                                        if(strlen($ttl->tname) > 20)
                                                                                            {
                                                                                                print_r(substr($ttl->tname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $ttl->tname;
                                                                                            }
                                                                                        ?>
                                                                                            
                                                                                        </h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($ttl->tdes) > 35)
                                                                                        {
                                                                                            print_r(substr($ttl->tdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $ttl->tdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                        <?php echo "Assignee: ".$ttl->first_name.' '.$ttl->last_name;?>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $ttl->tdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->tpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->tstatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td>    
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                if($OverdueSubtasksTrashlist)
                                                                {
                                                                    foreach($OverdueSubtasksTrashlist as $ttl)
                                                                    { 
                                                                ?>
                                                                <tr style="background-color: aliceblue;">
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center form-check-danger">
                                                                        <a href="javascript:void(0)"  onclick="return subtask_retrieve('<?php echo $ttl->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $ttl->stid;?>">Restore</a>
                                                                        </div>
                                                                    </td>     
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($ttl->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($ttl->stproject_assign);

                                                                                  ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                         echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $ttl->stcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                                        <?php
                                                                                        if(strlen($ttl->stname) > 20)
                                                                                            {
                                                                                                print_r(substr($ttl->stname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $ttl->stname;
                                                                                            }
                                                                                        ?>
                                                                                            
                                                                                        </h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($ttl->stdes) > 35)
                                                                                        {
                                                                                            print_r(substr($ttl->stdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $ttl->stdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                        <?php echo "Assignee: ".$ttl->first_name.' '.$ttl->last_name;?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $ttl->stdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->stpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->stpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->stpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->ststatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
<div id="refresh_grid_message">
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
</div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                <div class="collapse" id="trashGrid" style="">
                                    <div class="card border shadow-none card-body text-muted mb-0">
                                                <p class="mb-0">
                                                    <div data-simplebar style="max-height: 200px;">
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle mb-0"> 
                                                            <tbody>
                                                                <?php
                                                                if($OverdueTasksTrashlist)
                                                                {
                                                                    foreach($OverdueTasksTrashlist as $ttl)
                                                                    { 
                                                                ?>
                                                                <tr>
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center form-check-danger">
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $ttl->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $ttl->tid;?>">Restore</a>
                                                                        </div>
                                                                    </td>       
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($ttl->tproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($ttl->tproject_assign);

                                                                                  ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                         echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $ttl->tcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                                        <?php
                                                                                        if(strlen($ttl->tname) > 20)
                                                                                            {
                                                                                                print_r(substr($ttl->tname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $ttl->tname;
                                                                                            }
                                                                                        ?>
                                                                                            
                                                                                        </h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($ttl->tdes) > 35)
                                                                                        {
                                                                                            print_r(substr($ttl->tdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $ttl->tdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                        <?php echo "Assignee: ".$ttl->first_name.' '.$ttl->last_name;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $ttl->tdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->tpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->tstatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->tstatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td>    
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                if($OverdueSubtasksTrashlist)
                                                                {
                                                                    foreach($OverdueSubtasksTrashlist as $ttl)
                                                                    { 
                                                                ?>
                                                                <tr style="background-color: aliceblue;">
                                                                    <td style="width: 45px;">
                                                                        <div class="text-center form-check-danger">
                                                                        <a href="javascript:void(0)"  onclick="return subtask_retrieve('<?php echo $ttl->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $ttl->stid;?>">Restore</a>
                                                                        </div>
                                                                    </td>     
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php
                                                                            if($ttl->stproject_assign == 0)
                                                                            {
                                                                                echo "---";
                                                                            }
                                                                            else
                                                                            {  
                                                                                $getPname = $this->Front_model->getProjectById2($ttl->stproject_assign);

                                                                                  ?>
                                                                                <p class="text-muted"><?php
                                                                                        if($getPname){
                                                                                        if($getPname->portfolio_id != 0)
                                                                                        {
                                                                                            $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                                                                            if($portfolio){
                                                                                            if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a><span class="ms-2"><?php echo $getPname->pname;?></span>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                                        }
                                                                                        } 
                                                                                        else
                                                                                        {
                                                                                         echo $getPname->pname;
                                                                                        }
                                                                                    ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php echo $ttl->stcode;?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 m-0">
                                                                                        <?php
                                                                                        if(strlen($ttl->stname) > 20)
                                                                                            {
                                                                                                print_r(substr($ttl->stname,0,25).'...');
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo $ttl->stname;
                                                                                            }
                                                                                        ?>
                                                                                            
                                                                                        </h5>
                                                                                    <p class="text-muted mb-1">
                                                                                    <?php
                                                                                    if(strlen($ttl->stdes) > 35)
                                                                                        {
                                                                                            print_r(substr($ttl->stdes,0,40).'...');
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            echo $ttl->stdes;
                                                                                        }
                                                                                    ?>
                                                                                    </p>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                        <?php echo "Assignee: ".$ttl->first_name.' '.$ttl->last_name;?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <span class="badge badge-soft-primary"><?php echo $ttl->stdue_date;?></span>
                                                                        </div>
                                                                    </td>  
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->stpriority == 'low')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-primary">Low</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->stpriority == 'medium')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-warning">Medium</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->stpriority == 'high')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge bg-danger">High</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
                                                                    </td> 
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <?php 
                                                                                    if($ttl->ststatus == 'to_do')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'in_progress')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'in_review')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                                                            <?php
                                                                                        }
                                                                                    elseif($ttl->ststatus == 'done')
                                                                                        {
                                                                            ?>
                                                                            <span class="badge rounded-pill badge-soft-dark">Done</span>
                                                                            <?php
                                                                                        }             
                                                                            ?>
                                                                        </div>
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
                                    </div>
                                </div>
                                </div>
                            </div>
<div class="row">
    <div class="col-10"></div>
    <div class="col-2">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria" style="line-height: 0.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->
                                            <h4 class="card-title mb-4">To Do</h4>
                                            <div id="task-1">
                                                <div id="to_do-task" class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                    if($OverdueTasks)
                                                    {
                                                        foreach($OverdueTasks as $atl)
                                                        {
                                                            if($atl->tstatus == "to_do")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>"  onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                    <?php echo $atl->tname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($OverdueSubtasks)
                                                    {
                                                        foreach($OverdueSubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "to_do")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-orange search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                    <?php echo $atl->stname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            } 
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->        
                                            <h4 class="card-title mb-4">In Progress</h4>
                                            <div id="task-2">
                                                <div id="in_progress-task" class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                    if($OverdueTasks)
                                                    {
                                                        foreach($OverdueTasks as $atl)
                                                        {
                                                            if($atl->tstatus == "in_progress")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>"  onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                    <?php echo $atl->tname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($OverdueSubtasks)
                                                    {
                                                        foreach($OverdueSubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "in_progress")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                    <?php echo $atl->stname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            } 
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body">  -->       
                                            <h4 class="card-title mb-4">In Review</h4>
                                            <div id="task-2">
                                                <div id="in_review-task" class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                    if($OverdueTasks)
                                                    {
                                                        foreach($OverdueTasks as $atl)
                                                        {
                                                            if($atl->tstatus == "in_review")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>"  onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                    <?php echo $atl->tname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($OverdueSubtasks)
                                                    {
                                                        foreach($OverdueSubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "in_review")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-green search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                    <?php echo $atl->stname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            }
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div data-simplebar style="max-height: 800px;">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->        
                                            <h4 class="card-title mb-4">Done</h4>
                                            <div id="task-3">
                                                <div id="done-task" class="pb-1 task-list draggable_area_cus">
                                                    <?php
                                                    
                                                    if($OverdueTasks)
                                                    {
                                                        foreach($OverdueTasks as $atl)
                                                        {
                                                            if($atl->tstatus == "done")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A" data-id="<?php echo $atl->tid;?>" data-class="task_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->tproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->tpriority == 'low'){ echo 'theme-green'; } elseif($atl->tpriority == 'medium'){ echo 'theme-orange';} elseif($atl->tpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->tpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->tname;?>"  onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)">
                    <?php echo $atl->tname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->tproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->tproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            } 
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->tdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->tcode;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"><?php 
                    $get_totalSubtask_count = $this->Front_model->get_totalSubtask_count($atl->tid);
                    if($get_totalSubtask_count)
                        { 
                            echo $get_totalSubtask_count['count_rows'];
                        } 
                    ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    
                                                    if($OverdueSubtasks)
                                                    {
                                                        foreach($OverdueSubtasks as $atl)
                                                        {
                                                            if($atl->ststatus == "done")
                                                            {
                                                        ?>
        <section ng-repeat="new_card in new_cards" class="new_card theme-red search-cards" data-color="#52A43A" data-id="<?php echo $atl->stid;?>" data-class="subtask_class">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                        if($atl->stproject_assign == 0)
                        {
                           ?>                           
                            <span class="avatar-title img-thumbnail rounded-circle portfolio_logo">T</span>
                           <?php
                        }
                        else
                        {
                            $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                            if($getPname){
                            if($getPname->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($getPname->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                            } 
                        }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path <?php if($atl->stpriority == 'low'){ echo 'theme-green'; } elseif($atl->stpriority == 'medium'){ echo 'theme-orange';} elseif($atl->stpriority == 'high'){ echo 'theme-red';} ?>" title="<?php echo $atl->stpriority;?>"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $atl->stname;?>" onclick="return SubtaskOverviewModal(<?php echo $atl->stid;?>)">
                    <?php echo $atl->stname; ?></p>
                  <p class="ng-binding" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo 'Project: '.$getPname->pname;?>"><?php
                    if($atl->stproject_assign == 0)
                    {
                        echo "Project: ---";
                    }
                    else
                    {
                        $getPname = $this->Front_model->getProjectById2($atl->stproject_assign);
                         if($getPname)
                            {
                                echo 'Project: '.$getPname->pname;
                            } 
                    }
                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">
                  Due
                  <p class="ng-binding"><?php echo $atl->stdue_date;?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Code
                  <p class="ng-binding"><?php echo $atl->stcode;?></p>
                </div>
                <!-- <div class="new_card__face__stats new_card__face__stats--pledge">
                  Stask
                  <p class="ng-binding"></p>
                </div> -->
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
                                                    <!-- end task card -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
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
                                    <!-- Tasks Overview Modal -->
                                    <div id="TaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#TaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="TaskOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
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
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<!-- dragula plugins -->
<script src="<?php echo base_url();?>assets/libs/dragula/dragula.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pages/tasklist.init.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/task-kanban.init.js"></script>
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
