<?php
$page = 'portfolio';
$this->session->set_userdata('created_tl_pid',$pid);
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Portfolio Tasks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
 <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- dragula css -->
<link href="<?php echo base_url();?>assets/libs/dragula/dragula.min.css" rel="stylesheet" type="text/css" />
        <?php
include('header_links.php');
?>
<link href="<?php echo base_url();?>assets/css/new-cards.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.tree,
.tree ul {
  margin:0 0 0 1em; /* indentation */
  padding:0;
  list-style:none;
  color:#7b7b7b;
  position:relative;
  width: 100%
}

.tree ul {margin-left:.5em} /* (indentation/2) */

.tree:before,
.tree ul:before {
  content:"";
  display:block;
  width:0;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  border-left:2px solid #c7df19;
}

.tree li {
  margin:0;
  padding:0 1.5em 1em; /* indentation + .5em */
  position:relative;
}

.tree li > span:first-of-type {
  width: 800px;
  display: inline-block;
}

.tree li:before {
  content:"";
  display:block;
  width:10px; /* same with indentation */
  height:0;
  border-top:2px solid #c7df19;
  margin-top:-1px; /* border top width */
  position:absolute;
  top:1.25em; /* (line-height/2) */
  left:0;
}

.tree li:last-child:before {
  background:white; /* same with body background */
  height:auto;
  top:1.25em; /* (line-height/2) */
  bottom:0;
}

/* toggler */
.toggler::before {
  content: "\25B6";
  display: inline-block;
  transition: transform 0.3s ease-in-out;
}

.toggler.active::before {
  transform: rotate(90deg);
}
</style> 
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
    <body onload="return GetPortfolioTask_Filter();" data-sidebar="dark">
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
        <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding-bottom: 0px !important;">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Tasks</h4>
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
            <div class="page-title-center">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">

                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="portfolioTask_radio" id="portfolioTask_radio" value="all" <?php if(!empty($getFilter)){ if($getFilter == "all"){ echo "checked";}}?>>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="portfolioTask_radio" id="portfolioTask_radio" value="today" <?php if(!empty($getFilter)){ if($getFilter == "today"){ echo "checked";}}?>>
                                   <label class="form-check-label">Today</label>
                                </div>
                            </li>
                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="portfolioTask_radio" id="portfolioTask_radio" value="tomorrow" <?php if(!empty($getFilter)){ if($getFilter == "tomorrow"){ echo "checked";}}?>>
                                   <label class="form-check-label">Tomorrow</label>
                                </div>
                            </li>
                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="portfolioTask_radio" id="portfolioTask_radio" value="week" <?php if(!empty($getFilter)){ if($getFilter == "week"){ echo "checked";}}?>>
                                   <label class="form-check-label">This Week</label>
                                </div>
                            </li>
                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="portfolioTask_radio" id="portfolioTask_radio" value="overdue" <?php if(!empty($getFilter)){ if($getFilter == "overdue"){ echo "checked";}}?>>
                                   <label class="form-check-label">Overdue</label>
                                </div>
                            </li>
                            <li class="nav-item me-3 mt-2">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="redirect_task_list" id="redirect_task_list" onclick="return redirect_to_task_list();">
                                   <label class="form-check-label">My Created</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">                    
                <ol class="breadcrumb m-0">
                    <li class="nav-item">
                    <?php
                    if($plist || $accepted_plist)
                        {
                    ?>
                    <form name="all_project_search_task" id="all_project_search_task" method="post">
                            <div class="form-group mb-2">
                                    <input type="hidden" name="page_name" value="portfolio_tasks_page">
                                    <input type="hidden" name="port_id_tl" value="<?php echo $port_id_tl;?>">
                                    <input type="hidden" name="taskFilter" id="taskFilter" value="<?php if(!empty($getFilter)){ echo $getFilter;}else{ echo "all";}?>"> 
                                    <!-- <label>Search</label> -->
                                    <select class="form-select" name="pid_task" id="pid_task" onchange="return all_project_search_task_submit();" style="width: 180px !important;">
                                        <?php
                                        if($plist)
                                        {
                                            foreach($plist as $pl)
                                            {
                                                $t_avail = "";
                                                $st_avail = "";
                                                $check_t_avail = $this->Front_model->check_t_avail($pl->pid);
                                                if($check_t_avail > 0)
                                                {
                                                    $t_avail = "yes";
                                                }
                                                $check_st_avail = $this->Front_model->check_st_avail($pl->pid);
                                                if($check_st_avail > 0)
                                                {
                                                    $st_avail = "yes";
                                                }
                                                //echo $t_avail;
                                                //echo $st_avail;
                                                if(($t_avail == "yes") || ($st_avail == "yes"))
                                                {
                                        ?>
                                        <option value="<?php echo $pl->pid;?>" <?php if($pid == $pl->pid){ echo "selected";}?>><?php echo $pl->pname;?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        if($accepted_plist)
                                        {
                                            foreach($accepted_plist as $apl)
                                            {
                                                $t_avail2 = "";
                                                $st_avail2 = "";
                                                $check_t_avail2 = $this->Front_model->check_t_avail2($apl->pid);
                                                if($check_t_avail2 > 0)
                                                {
                                                    $t_avail2 = "yes";
                                                }
                                                $check_st_avail2 = $this->Front_model->check_st_avail2($apl->pid);
                                                if($check_st_avail2 > 0)
                                                {
                                                    $st_avail2 = "yes";
                                                }
                                                //echo $t_avail2;
                                                //echo $st_avail2;
                                                if(($t_avail2 == "yes") || ($st_avail2 == "yes"))
                                                {
                                        ?>
                                        <option value="<?php echo $apl->pid;?>" <?php if($pid == $apl->pid){ echo "selected";}?>><?php echo $apl->pname;?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span id="pid_taskErr" class="text-danger"></span>
                                    <?php 
                                    if($this->session->userdata('searched_page_name') == "portfolio_tasks_page")
                                    {
                                    ?>
                                    <a class="float-end nameLink" style="font-weight: 300 !important;font-size: 12px;" href="<?php echo base_url('portfolio-tasks/'.$port_id_tl);?>">Clear Filter</a> 
                                    <?php
                                    }
                                    ?>   
                            </div>
                    </form>
                    <?php
                        }
                    ?>
                </li>
                    <!-- <li class="breadcrumb-item"><a class="btn btn-sm bg-d text-white mb-2" data-bs-toggle="collapse" href="#trashGrid" aria-expanded="true" aria-controls="trashGrid"><i class="bx bx-trash"></i> Trash</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php
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
<div id="refresh_tasklist_status_change">
    <div class="row mb-2 heading_strip">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <div class="text-center" style="font-weight: 900;">Code</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Task</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Assignee</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Priority</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Status</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Due Date</div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
<?php
if($portfolio_tasks)
{
    foreach($portfolio_tasks as $atl)
    {
?>
<div class="row mb-2 search-list new_tid_top parent_task all-data <?php if(($atl->tdue_date < date('Y-m-d')) && ($atl->tstatus != 'done')){ echo "overdue_task_in_list";}else{ echo "future_task_in_list";}?> <?php echo $atl->tstatus.'_class';?>" data-toptid="<?php echo $atl->tid;?>" data-searchid="<?php echo $atl->tdue_date;?>">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<!--Task with subtask-->
    <div class="row m-1">
        <div class="col-lg-2">
            <?php
            $Check_Task_L_Subtasks = $this->Front_model->Check_Task_Subtasks2($atl->tid);
            if($Check_Task_L_Subtasks)
            {
                $sub_L_cnt = 0;
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
                    $sub_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->tid;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->tid;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $sub_L_cnt;?></span>
            </a>
            <?php
            }
            else
            {
            ?>
            <a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>
            <?php
            }
            ?>
            <?php echo $atl->tcode;?>
        </div>
        <div class="col-lg-2">
            <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return TaskOverviewModal(<?php echo $atl->tid;?>)"><?php echo $atl->tname;?></a></p>
        </div>
        <div class="col-lg-2">
            <p><?php 
                $stud = $this->Front_model->getStudentById($atl->tassignee);
                $porttm = $this->Front_model->getAccepted_PortTM($atl->portfolio_id);

                if($atl->tassignee == $this->session->userdata('d168_id'))
                {
                    echo "Assign To Me";
                }
                else
                {
                  if($stud)
                    {
                        echo $stud->first_name.' '.$stud->last_name;
                    }  
                } 
                ?></p>
        </div>
        <div class="col-lg-2">
            <p><?php 
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
                ?></p>
        </div>
        <div class="col-lg-2">
            <p><?php 
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
                ?></p>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-primary"><?php echo $atl->tdue_date;?></span></p>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->tid;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_Task_L_Subtasks)
            {
                foreach($Check_Task_L_Subtasks as $l_subtask)
                {
            ?>
            <!-- single sub task area start -->
            <li class="all-data <?php if(($l_subtask->stdue_date < date('Y-m-d')) && ($l_subtask->ststatus != 'done')){ echo "overdue_task_in_list";}else{ echo "future_task_in_list";}?> <?php echo $l_subtask->ststatus.'_class';?>" data-searchid="<?php echo $l_subtask->stdue_date;?>">
                <div class="card" style="margin-bottom: 0px;background: #f6f6f6;">
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <div class="row">
                            <div class="col-lg-2">
                                <?php echo $l_subtask->stcode;?>
                            </div>
                            <div class="col-lg-2">
                                <p><a href="javascript: void(0);" class="nameLink description-content" onclick="return SubtaskOverviewModal(<?php echo $l_subtask->stid;?>)"><?php echo $l_subtask->stname;?></a></p>
                            </div>
                            <div class="col-lg-2">
                                <p><?php 
                                    $stud = $this->Front_model->getStudentById($l_subtask->stassignee);
                                    $porttm = $this->Front_model->getAccepted_PortTM($l_subtask->portfolio_id);

                                    if($l_subtask->stassignee == $this->session->userdata('d168_id'))
                                    {
                                        echo "Assign To Me";
                                    }
                                    else
                                    {
                                      if($stud)
                                        {
                                            echo $stud->first_name.' '.$stud->last_name;
                                        }  
                                    } 
                                    ?></p>
                            </div>
                            <div class="col-lg-2">
                                <p><?php 
                                            if($l_subtask->stpriority == 'low')
                                                {
                                    ?>
                                    <span class="badge bg-primary">Low</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'medium')
                                                {
                                    ?>
                                    <span class="badge bg-warning">Medium</span>
                                    <?php
                                                }
                                            elseif($l_subtask->stpriority == 'high')
                                                {
                                    ?>
                                    <span class="badge bg-danger">High</span>
                                    <?php
                                                }             
                                    ?></p>
                            </div>
                            <div class="col-lg-2">
                                <fieldset class="mt-1 ms-2">
                                    <?php
                                            if($l_subtask->ststatus == 'to_do')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">To Do</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_progress')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Progress</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'in_review')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">In Review</span>
                                    <?php
                                                }
                                            elseif($l_subtask->ststatus == 'done')
                                                {
                                    ?>
                                    <span class="badge rounded-pill badge-soft-dark">Done</span>
                                    <?php
                                                }
                                    ?>
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <p><span class="badge badge-soft-primary"><?php echo $l_subtask->stdue_date;?></span></p>
                            </div>
                        </div>
                    </div>
                </div>  
            </li>
            <!-- single sub task area end -->
            <?php
                }
            }
            ?>          
        </ul>
    </div>
</div>
<!-- sub task area end -->
<!--Task with subtask end-->
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>
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
                                    <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
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
                                    <!-- Tasks Edit Modal -->
                                    <div id="TaskEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#TaskEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="TaskEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>
<!-- dragula plugins -->
<script src="<?php echo base_url();?>assets/libs/dragula/dragula.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pages/tasklist.init.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/task-kanban.init.js"></script>
        <?php
include('footer_links.php');
?>
<!-- <script type="text/javascript">
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
</script> -->
<script type="text/javascript">
    $('#search-criteria-list').keyup(function(){
        //debugger;
    $('.search-list').hide();
    $('#search-clear-list').css('display','block');
    var txt = $('#search-criteria-list').val();
    if($('.all-data').hasClass('active_searched'))
    {
        //debugger;
        $('.active_searched').each(function(){
           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
               $(this).show();
           }
        });
    }
    else
    {
        //debugger;
       $('.search-list').each(function(){
           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
               $(this).show();
           }
        }); 
    }    
});
    $("#search-clear-list").click(function(){
            if($('.all-data').hasClass('active_searched'))
            {
                $("#search-criteria-list").val("");
                $('.active_searched').show();
                $('#search-clear-list').css('display','none'); 
            }
            else
            {
                $("#search-criteria-list").val("");
                $('.search-list').show();
                $('#search-clear-list').css('display','none');  
            }            
          });
</script>
<script type="text/javascript">
const togglers = document.querySelectorAll(".toggler");

togglers.forEach((toggler) => {
  toggler.addEventListener("click", () => {
    toggler.classList.toggle("active");
    toggler.nextElementSibling.classList.toggle("active");
  });
});
</script>
    </body>

</html>
