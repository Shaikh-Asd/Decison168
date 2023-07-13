<?php
$page = 'cal-todo-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Calendar Todo List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
 <link href="<?php echo base_url();?>assets/libs/select2-calendar/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
  width: 100%;
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
<div class="row mb-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding-bottom: 0px !important;">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Todo's</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript: void(0);" onclick="return add_event_list_modal();">
                                    <i class="mdi mdi-plus"></i> Create New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">                    
                <ol class="breadcrumb m-0">                    
                    <li class="breadcrumb-item">
<div class="row">
    <div class="col-2" style="padding: 0px"> 
        <i class="mdi mdi-filter h3 float-end mt-1" style="cursor: pointer;" onclick="return show_FilterOptions();"></i>
        <div class="modal bs-example-modal-lg filtercollapse" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" onclick="$('.filtercollapse').css('display','none');"></button>
                        <div class="row">
                            <div class="col-xl">
                                <div class="mt-4 mt-xl-0">
                                    <div class="docs-options">
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="all" checked>
                                               <label class="form-check-label">All</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="today">
                                               <label class="form-check-label">Today</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl">
                                <div class="mt-4 mt-xl-0">
                                    <div class="docs-options">
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="tomorrow">
                                               <label class="form-check-label">Tomorrow</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="this_week">
                                               <label class="form-check-label">This Week</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl">
                                <div class="mt-4 mt-xl-0">
                                    <div class="docs-options"> 
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="week">
                                               <label class="form-check-label">Next 168</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="text-center">
                                               <input class="form-check-input" type="radio" name="calendarEvents_filter_radio" id="calendarEvents_filter_radio" value="overdue">
                                               <label class="form-check-label">Overdue</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
    <div class="col-10" style="padding: 0px;">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria-list" style="line-height: 1.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear-list">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div id="refresh_tasklist_status_change">
    <div class="row mb-2">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <div class="text-center" style="font-weight: 900;">Todo</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Start Date</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Start Time</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Reminder Time</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Type</div>
                </div>
                <div class="col-lg-2">
                    <div style="font-weight: 900;">Priority</div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
<div class="refresh_evt_lists">
<?php
if($getAll_NextTodos)
{
    foreach($getAll_NextTodos as $atl)
    {
?>
<div class="row mb-2 search-list parent_task all-data" data-searchid="<?php echo $atl->event_start_date;?>" data-end-searchid="<?php echo $atl->event_end_date;?>">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<i class="mdi mdi-delete h5 mt-1 me-2 float-end delete-list-events" data-deval="<?php echo $atl->id;?>" style="cursor: pointer;"></i>
<i class="mdi mdi-file-edit h5 mt-1 me-2 float-end text-d edit-list-events" data-eval="<?php echo $atl->id;?>" style="cursor: pointer;"></i>
<!--Events with inside todo-->
    <div class="row m-1">
        <div class="col-lg-2">
            <span id="toggler_inside_todo<?php echo $atl->id;?>">
            <?php
            $Check_getEventTodo = $this->Front_model->getEventTodo($this->session->userdata('d168_id'),$atl->id);
            if($Check_getEventTodo)
            {
                $intodo_L_cnt = 0;
                foreach($Check_getEventTodo as $l_getEventTodo)
                {
                    $intodo_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->id;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->id;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $intodo_L_cnt;?></span>
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
            </span>
            <a href="javascript: void(0);" class="nameLink" onclick="return EventListViewModal(<?php echo $atl->id;?>)"><?php echo $atl->event_name;?></a>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-primary"><?php echo $atl->event_start_date;?></span></p>
        </div>
        <div class="col-lg-2">
            <p>
                <?php 
                if($atl->event_allDay == 'true')
                            {
                ?>
                <span class="badge badge-soft-info">All day</span>
                <?php
                            }
                        else
                            {
                ?>
                <span class="badge badge-soft-info"><?php echo date('h:i A',strtotime($atl->event_start_time));?></span>
                <?php
                            }            
                ?>
            </p>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-dark"><?php echo $atl->event_reminder;?></span></p>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-success"><?php echo $atl->event_repeat_option_type;?></span></p>
        </div>
        <div class="col-lg-2">
            <p>
            <?php 
            if($atl->task_priority == 'No Priority')
                        {
            ?>
            <span class="badge bg-success">No Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'Low Priority')
                        {
            ?>
            <span class="badge bg-primary">Low Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'Medium Priority')
                        {
            ?>
            <span class="badge bg-warning">Medium Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'High Priority')
                        {
            ?>
            <span class="badge bg-danger">High Priority</span>
            <?php
                        }             
            ?>
            </p>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->id;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_getEventTodo)
            {
                foreach($Check_getEventTodo as $l_getEventTodo)
                {
            ?>
            <!-- single sub task area start -->
            <li class="all-data todo_all_details<?php echo $l_getEventTodo->id;?> <?php if($l_getEventTodo->is_completed != 'yes'){ echo 'incomplete_class';} else { echo 'complete_class';}?>" data-searchid="<?php echo $l_getEventTodo->task_start_date;?>" data-end-searchid="<?php echo $l_getEventTodo->task_start_date;;?>">
                <div class="card" style="margin-bottom: 0px;background: #f6f6f6;">
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <i class="mdi mdi-delete h5 mt-1 me-2 float-end" onclick="return delete_inside_todo_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');"  style="cursor: pointer;"></i>
                        <i class="mdi mdi-file-edit h5 mt-1 me-2 float-end text-d" onclick="return update_inside_todo_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');" style="cursor: pointer;"></i>
                        <div class="row">
                            <div class="col-lg-2">
                                <p>
                                    <?php
                                    if($l_getEventTodo->is_completed != 'yes')
                                    {
                                    ?>
                                        <input class="form-check-input ms-1 me-2 mb-1" id="todo_cbl<?php echo $l_getEventTodo->id;?>" type="checkbox" onclick="return inside_events_todo_complete_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');">
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <input class="form-check-input ms-1 me-2 mb-1" id="todo_cbl<?php echo $l_getEventTodo->id;?>" type="checkbox" onclick="return inside_events_todo_complete_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');" checked>
                                    <?php
                                    }
                                    ?>                                    
                                    <a href="javascript: void(0);" class="nameLink up_task_name<?php echo $l_getEventTodo->id;?>" onclick="return InsideTodoViewModal(<?php echo $l_getEventTodo->id;?>)"><?php echo $l_getEventTodo->task_name;?></a></p>
                            </div>
                            <div class="col-lg-2">
                                 <p><span class="badge badge-soft-primary up_task_date<?php echo $l_getEventTodo->id;?>"><?php echo $l_getEventTodo->task_start_date;?></span></p>
                            </div>
                            <div class="col-lg-2">
                                <p class="up_task_start<?php echo $l_getEventTodo->id;?>">
                                    <?php 
                                    if($l_getEventTodo->task_allDay == 'true')
                                                {
                                    ?>
                                    <span class="badge badge-soft-info">All day</span>
                                    <?php
                                                }
                                            else
                                                {
                                    ?>
                                    <span class="badge badge-soft-info"><?php echo date('h:i A',strtotime($l_getEventTodo->task_start_time));?></span>
                                    <?php
                                                }            
                                    ?>
                                </p>
                            </div>
                            <div class="col-lg-2">
                                <p><span class="badge badge-soft-dark up_task_rem<?php echo $l_getEventTodo->id;?>"><?php echo $l_getEventTodo->task_reminder;?></span></p>
                            </div>
                            <div class="col-lg-2">
                                <p></p>
                            </div>
                            <div class="col-lg-2">
                                <p class="up_task_priority<?php echo $l_getEventTodo->id;?>">
                                    <?php 
                                    if($l_getEventTodo->priority == 'No Priority')
                                                {
                                    ?>
                                    <span class="badge bg-success">No Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'Low Priority')
                                                {
                                    ?>
                                    <span class="badge bg-primary">Low Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'Medium Priority')
                                                {
                                    ?>
                                    <span class="badge bg-warning">Medium Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'High Priority')
                                                {
                                    ?>
                                    <span class="badge bg-danger">High Priority</span>
                                    <?php
                                                }             
                                    ?>
                                </p>
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
if($getAll_PrevTodos)
{
    foreach($getAll_PrevTodos as $atl)
    {
?>
<div class="row mb-2 search-list parent_task all-data" data-searchid="<?php echo $atl->event_start_date;?>" data-end-searchid="<?php echo $atl->event_end_date;?>">   
    <div class="col-lg-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding: 8px 0px 0px 0px;">
<i class="mdi mdi-delete h5 mt-1 me-2 float-end delete-list-events" data-deval="<?php echo $atl->id;?>" style="cursor: pointer;"></i>
<i class="mdi mdi-file-edit h5 mt-1 me-2 float-end text-d edit-list-events" data-eval="<?php echo $atl->id;?>" style="cursor: pointer;"></i>
<!--Events with inside todo-->
    <div class="row m-1">
        <div class="col-lg-2">
            <span id="toggler_inside_todo<?php echo $atl->id;?>">
            <?php
            $Check_getEventTodo = $this->Front_model->getEventTodo($this->session->userdata('d168_id'),$atl->id);
            if($Check_getEventTodo)
            {
                $intodo_L_cnt = 0;
                foreach($Check_getEventTodo as $l_getEventTodo)
                {
                    $intodo_L_cnt++;
                }
            ?>
            <a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->id;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->id;?>">
            <span class="badge" style="background-color: #383838 !important;"><?php echo $intodo_L_cnt;?></span>
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
            </span>
            <a href="javascript: void(0);" class="nameLink" onclick="return EventListViewModal(<?php echo $atl->id;?>)"><?php echo $atl->event_name;?></a>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-primary"><?php echo $atl->event_start_date;?></span></p>
        </div>
        <div class="col-lg-2">
            <p>
                <?php 
                if($atl->event_allDay == 'true')
                            {
                ?>
                <span class="badge badge-soft-info">All day</span>
                <?php
                            }
                        else
                            {
                ?>
                <span class="badge badge-soft-info"><?php echo date('h:i A',strtotime($atl->event_start_time));?></span>
                <?php
                            }            
                ?>
            </p>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-dark"><?php echo $atl->event_reminder;?></span></p>
        </div>
        <div class="col-lg-2">
            <p><span class="badge badge-soft-success"><?php echo $atl->event_repeat_option_type;?></span></p>
        </div>
        <div class="col-lg-2">
            <p>
            <?php 
            if($atl->task_priority == 'No Priority')
                        {
            ?>
            <span class="badge bg-success">No Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'Low Priority')
                        {
            ?>
            <span class="badge bg-primary">Low Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'Medium Priority')
                        {
            ?>
            <span class="badge bg-warning">Medium Priority</span>
            <?php
                        }
                    elseif($atl->task_priority == 'High Priority')
                        {
            ?>
            <span class="badge bg-danger">High Priority</span>
            <?php
                        }             
            ?>
            </p>
        </div>
    </div>
     <!-- sub task area start -->
    <div class="collapse toggler-target" id="collapseExample<?php echo $atl->id;?>">
     <div class="card border shadow-none card-body text-muted mb-0">
        <ul class="tree">
            <?php 
            if($Check_getEventTodo)
            {
                foreach($Check_getEventTodo as $l_getEventTodo)
                {
            ?>
            <!-- single sub task area start -->
            <li class="all-data todo_all_details<?php echo $l_getEventTodo->id;?> <?php if($l_getEventTodo->is_completed != 'yes'){ echo 'incomplete_class';} else { echo 'complete_class';}?>" data-searchid="<?php echo $l_getEventTodo->task_start_date;?>" data-end-searchid="<?php echo $l_getEventTodo->task_start_date;;?>">
                <div class="card" style="margin-bottom: 0px;background: #f6f6f6;">
                    <div class="card-body" style="padding: 8px 0px 0px 0px;">
                        <i class="mdi mdi-delete h5 mt-1 me-2 float-end" onclick="return delete_inside_todo_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');"  style="cursor: pointer;"></i>
                        <i class="mdi mdi-file-edit h5 mt-1 me-2 float-end text-d" onclick="return update_inside_todo_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');" style="cursor: pointer;"></i>
                        <div class="row">
                            <div class="col-lg-2">
                                <p>
                                    <?php
                                    if($l_getEventTodo->is_completed != 'yes')
                                    {
                                    ?>
                                        <input class="form-check-input ms-1 me-2 mb-1" id="todo_cbl<?php echo $l_getEventTodo->id;?>" type="checkbox" onclick="return inside_events_todo_complete_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');">
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <input class="form-check-input ms-1 me-2 mb-1" id="todo_cbl<?php echo $l_getEventTodo->id;?>" type="checkbox" onclick="return inside_events_todo_complete_list('<?php echo $l_getEventTodo->id; ?>','<?php echo $atl->id;?>');" checked>
                                    <?php
                                    }
                                    ?>                                    
                                    <a href="javascript: void(0);" class="nameLink up_task_name<?php echo $l_getEventTodo->id;?>" onclick="return InsideTodoViewModal(<?php echo $l_getEventTodo->id;?>)"><?php echo $l_getEventTodo->task_name;?></a></p>
                            </div>
                            <div class="col-lg-2">
                                 <p><span class="badge badge-soft-primary up_task_date<?php echo $l_getEventTodo->id;?>"><?php echo $l_getEventTodo->task_start_date;?></span></p>
                            </div>
                            <div class="col-lg-2">
                                <p class="up_task_start<?php echo $l_getEventTodo->id;?>">
                                    <?php 
                                    if($l_getEventTodo->task_allDay == 'true')
                                                {
                                    ?>
                                    <span class="badge badge-soft-info">All day</span>
                                    <?php
                                                }
                                            else
                                                {
                                    ?>
                                    <span class="badge badge-soft-info"><?php echo date('h:i A',strtotime($l_getEventTodo->task_start_time));?></span>
                                    <?php
                                                }            
                                    ?>
                                </p>
                            </div>
                            <div class="col-lg-2">
                                <p><span class="badge badge-soft-dark up_task_rem<?php echo $l_getEventTodo->id;?>"><?php echo $l_getEventTodo->task_reminder;?></span></p>
                            </div>
                            <div class="col-lg-2">
                                <p></p>
                            </div>
                            <div class="col-lg-2">
                                <p class="up_task_priority<?php echo $l_getEventTodo->id;?>">
                                    <?php 
                                    if($l_getEventTodo->priority == 'No Priority')
                                                {
                                    ?>
                                    <span class="badge bg-success">No Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'Low Priority')
                                                {
                                    ?>
                                    <span class="badge bg-primary">Low Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'Medium Priority')
                                                {
                                    ?>
                                    <span class="badge bg-warning">Medium Priority</span>
                                    <?php
                                                }
                                            elseif($l_getEventTodo->priority == 'High Priority')
                                                {
                                    ?>
                                    <span class="badge bg-danger">High Priority</span>
                                    <?php
                                                }             
                                    ?>
                                </p>
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
<button type="button" class="btn btn-outline-dark waves-effect waves-light btn-sm mb-3" onclick="return add_event_list_modal();">
        <span class="avatar-title bg-transparent text-reset">
            <i class="bx bx-plus"></i> Create New
        </span>
</button>
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
<!-- Add New Event MODAL -->
<div class="modal fade" data-bs-backdrop="static" id="add-new-events">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="create-category" method="post" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Create New</h5>
                <button type="button" class="btn-close close-category" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">

                <ul class="nav nav-tabs nav-tabs-custom nav-justified hide_type_radio" role="tablist">
                <input type="radio" value="task" name="created_type" id="created_type_task" checked>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#cevent" role="tab" aria-selected="true">
                        <span class="d-sm-block">To Do</span>
                    </a>
                </li>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle" data-bs-toggle="dropdown" id="selected_color" aria-expanded="false">
                                <span id="selected_color_text">Choose a color...</span><i class="mdi mdi-chevron-down float-end"></i>
                               </button>
                                <div class="dropdown-menu">
                                <div class="dropdown-item cal_cus_colors">
                                <ul style="padding: 0 !important;margin: 0 !important;">
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color1"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color2"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color3"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color4"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color5"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color6"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color7"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color8"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color9"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color10"></li>
                                    <br>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color11"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color12"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color13"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color14"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color15"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color16"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color17"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color18"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color19"></li>
                                    <li onclick="return select_cal_cus_colors_insert(this);" class="cus_cal_color20"></li>
                                    <input type="hidden" name="event_color" id="event_color" value="" required>
                                </ul>
                            </div>
                            </div>
                            </div>
                            <span id="event_colorErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="add_note_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control form-white" placeholder="Add Note" name="event_note"></textarea>
                            </div>
                            <span id="event_noteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="event_start_end_date_select">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>

                                <input type="text" class="form-control" name="event_start_date_nn" id="event_start_date_nn" placeholder="Start Date" value="<?php echo date('Y-m-d')?>"  onchange="customChange()"/>

                                <input type="text" class="form-control" name="event_end_date_nn" id="event_end_date_nn" placeholder="End Date" value="<?php echo date('Y-m-d')?>" onchange="customChange()"/>

                            </div>
                            <span id="event_start_end_dateErr" class="text-danger"></span>
                            <span id="event_start_end_dateErr" class="text-danger"></span>
                         </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <select id="event_repeat_option" name="event_repeat_option" class="form-control" onchange="showEndDate(this.value);">
                                <option value="Does not repeat">Does not repeat</option>
                                <option value="Daily">Daily</option>
                                <option value="Every Weekday">Every Weekday (Monday to Friday)</option>
                                <option value="Custom" id="custom_value">Custom</option>
                                <option value="Weekly" id="weekday_value">Weekly</option>
                                <option value="Monthly" id="monthly_value">Monthly</option>
                                <option value="Yearly" id="yearly_value">Yearly</option>
                                </select>
                            </div>
                                <span id="event_repeat_optionErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row custom-class" style="display: none;"  id="cus_radioBTN">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group mb-3">
                            <div class="cus_radioBTN">
                                <div class="selector">
                                    <div class="selecotr-item" id="radioId1">
                                        <input type="checkbox" id="radio1" name="custom_check[]" class="selector-item_radio"  value="Sun">
                                        <label for="radio1" class="selector-item_label">Su</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId2">
                                        <input type="checkbox" id="radio2" name="custom_check[]" class="selector-item_radio" value="Mon">
                                        <label for="radio2" class="selector-item_label">Mo</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId3">
                                        <input type="checkbox" id="radio3" name="custom_check[]" class="selector-item_radio" value="Tue">
                                        <label for="radio3" class="selector-item_label">Tu</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId4">
                                        <input type="checkbox" id="radio4" name="custom_check[]" class="selector-item_radio" value="Wed">
                                        <label for="radio4" class="selector-item_label">We</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId5">
                                        <input type="checkbox" id="radio5" name="custom_check[]" class="selector-item_radio" value="Thu">
                                        <label for="radio5" class="selector-item_label">Th</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId6">
                                        <input type="checkbox" id="radio6" name="custom_check[]" class="selector-item_radio" value="Fri">
                                        <label for="radio6" class="selector-item_label">Fr</label>
                                    </div>
                                    <div class="selecotr-item" id="radioId7">
                                        <input type="checkbox" id="radio7" name="custom_check[]" class="selector-item_radio" value="Sat">
                                        <label for="radio7" class="selector-item_label">Sa</label>
                                    </div>
                                </div>
                                <span id="custom_checkErr" class="text-danger"></span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row mb-3" id="date-time-section">
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_start_time" name="event_start_time" class="form-control select2 create_event_start_time" onchange="return change_end_time(this.value);" style="width: 86%;">
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
                                <select id="event_end_time" name="event_end_time" class="form-control select2 changed_end_time" style="width: 86%;">
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
                    <div class="col-md-6" id="old_reminder">
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
                    <div class="col-md-6" id="new_reminder">
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
                    <div class="col-md-6" id="task_priority_div">
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
                            <input type="checkbox" name="event_allDay" id="event_allDay" class="form-check-input" onclick="check_reminder(this.value)">
                            <label class="control-label" for="event_allDay">
                                All Day
                            </label>
                            <span id="event_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                    <input type="hidden" name="draggable_event" id="draggable_event" value="on">
                    <input type="hidden" name="checkbox_value_get" id="checkbox_value_get" value="true" >
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
                <input type="hidden" name="type" id="type" value="event">
            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-d waves-effect waves-light save-category">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-category" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

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

                <button type="button" class="btn-close view_modal_close refresh-list-events" onclick="return view_modal_close_list();" aria-label="Close"></button>
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
                    <input type="radio" class="form-check-input checked_if_single" id="update_check_value1" name="update_check_value" value="1">
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
                    <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_updateOptions();" aria-label="Close">Close</button>
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
                <button type="button" class="btn-close" onclick="reset_updateCalFrom()"></button>
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
                                <select id="event_start_time" name="event_start_time" class="form-control select2 update_event_start_time" onchange="return change_end_time_up(this.value);" style="width: 86%;">
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
                                <select id="event_end_time" name="event_end_time" class="form-control select2 changed_end_time_up" style="width: 86%;">
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
                <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="reset_updateCalFrom()">Close</button>
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

<!-- View Inside Todo MODAL -->
<div class="modal fade bs-example-modal-center" id="view-inside-todo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"></h5>
                <button type="button" class="btn-close view_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4"></div>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Inside Todo Edit Modal -->
<div id="InsideTodoEditModal" class="modal fade bs-example-modal-center" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="InsideTodoEditModal_content">
            
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
<script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
        <?php
include('footer_links.php');
?>
<script src="<?php echo base_url('assets/js/front_calendar_list.js');?>"></script>
<script type="text/javascript">
    //change end time according to start time
    function change_end_time(value)
    {
        //console.log(value);
        $(".changed_end_time").find('option').removeAttr("selected");
        $(".changed_end_time option:contains(" + value + ")").attr('selected', 'selected');
        $(".changed_end_time").val(value).change();
    }

    function change_end_time_up(value)
    {
        //console.log(value);
        $(".changed_end_time_up").find('option').removeAttr("selected");
        $(".changed_end_time_up option:contains(" + value + ")").attr('selected', 'selected');
        $(".changed_end_time_up").val(value).change();
    }
    //change end time according to start time

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
