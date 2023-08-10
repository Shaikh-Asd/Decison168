<?php
$page = 'calendar';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Calendar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

        <link href="<?php echo base_url();?>assets/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/select2-calendar/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/@fullcalendar/list/main.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/new-modals.css" rel="stylesheet" type="text/css" />

<script src="https://cdn.tiny.cloud/1/7v7gor314fr62t10k0vg4eqgh84efoxsibchc4767ohrfzas/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?php
include('header_links.php');
?>
<style type="text/css">
.description {
  display: inline;
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
  padding: 0 25px;
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
  left: 5px;
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
  width: 480px;
  padding: 0 8px;
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

.description .description-edit textarea {
  width: 480px;
  height: 70px;
  padding: 0 8px;
  background: #f8f8fb !important;
  border: 1px solid #c7df19;
  font-weight: 300;
}
.description .description-edit textarea:hover {
  border: 1px solid #c7df19;
}
.description .description-edit textarea:focus-visible {
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
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
<!-- <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Calendar</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Calendar</a></li>
                </ol>
            </div>

        </div>
    </div>
</div> -->
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                    <?php 
                    $getStudentEmail_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
                    if($getStudentEmail_ID)
                    {
                    ?>
                    <input type="hidden" name="get_sess_email" id="get_sess_email" value="<?php echo $getStudentEmail_ID->email_address; ?>">
                    <?php
                    }
                    ?>                       
                        <div id="calendar"></div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-3">
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
                <div class="card">
                    <div class="card-body">
                        <button class="btn font-16 bg-d text-white btn-block w-100" data-bs-toggle="modal" onclick="return resetSelectDrag();"><i class="mdi mdi-plus-circle-outline"></i> Create Draggable Event</button>
                        <!-- <div class="row justify-content-center mt-5">
                            <img src="<?php echo base_url();?>assets/images/calendar.png" alt="" class="img-fluid d-block">
                        </div> -->
                        <div id="external-events" class="m-t-20">
                        <br>
                        <p class="text-muted">Drag and drop your draggable event in calendar.</p>
                        <div data-simplebar style="max-height: 100px;">
                            <?php
                        if($draggable_events){
                            foreach ($draggable_events as $ev) {
                                if($ev->event_repeat_option == 'Does not repeat')
                                {
                                ?>
                                <div id="<?php echo $ev->id;?>" class="external-event fc-event drag-event<?php echo $ev->id;?> <?php echo $ev->event_color;?>" data-class="<?php echo $ev->event_color;?>">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 m-1"></i>
                                    <?php 
                                    if(strlen($ev->event_name)>20)
                                    {
                                        print(substr($ev->event_name,0,16)."..");
                                    }
                                    else
                                    {
                                        print($ev->event_name);
                                    }
                                    ?>
                                    <!-- Delete Draggable Event -->
                                    <i onclick="return removeDragEvent(<?php echo $ev->id;?>);" style="cursor: pointer;" class="float-end fas fa-times m-1"></i>
                                    <!-- Edit Draggable Event -->
                                    <i onclick="return editModalDragEvent(<?php echo $ev->id;?>);" style="cursor: pointer;" class="float-end fas fa-pen m-1"></i>
                                </div>
                                <?php
                                }
                            }
                        }
                        ?>
                        </div>  
                    </div>
                    <?php
                    if($draggable_events)
                    {
                    ?>
                    <div class="event-fc-bt mx-15 my-20">
                    <!-- checkbox -->
                        <div class="form-check form-checkbox-outline form-check-success mt-3">
                            <input class="form-check-input" type="checkbox" id="drop-remove">
                            <label class="form-check-label" for="drop-remove">
                                 Remove after drop
                            </label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div> <!-- end col-->
    </div> 

    <div style='clear:both'></div>
                                                
<!-- Add New Event MODAL -->
<div class="modal fade" data-bs-backdrop="static" id="add-new-events">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="create-category" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Create New</h5>
                <button type="button" class="btn-close close-category" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div data-simplebar style="max-height: 320px;">
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified hide_type_radio" role="tablist">
                <input type="radio" value="event" name="created_type" id="created_type_event" checked>
                <input type="radio" value="task" name="created_type" id="created_type_task">
                <input type="radio" value="reminder" name="created_type" id="created_type_reminder">
                <input type="radio" value="meeting" name="created_type" id="created_type_meeting">
                <li class="nav-item">
                    <a class="nav-link eclose_remove_active active" data-bs-toggle="tab" href="#cevent" role="tab" aria-selected="true" onclick="event_type_event()">
                        <span class="d-sm-block">Event</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tclose_remove_active" data-bs-toggle="tab" href="#ctask" role="tab" aria-selected="false" onclick="event_type_task()">
                        <span class="d-sm-block">To Do</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rclose_remove_active" data-bs-toggle="tab" href="#creminder" role="tab" aria-selected="false" onclick="event_type_reminder()">
                        <span class="d-sm-block">Reminder</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mclose_remove_active" data-bs-toggle="tab" href="#cmeeting" role="tab" aria-selected="false" onclick="event_type_meeting()">
                        <span class="d-sm-block">Meeting</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="padding: 1rem 1rem 0rem 1rem;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fas fa-pen"></i></span>
                                </div>
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
                            <div class="cus_input_group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_button_icon"><i class="fas fa-paint-brush"></i></span>
                                </div>
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle cus_button_icon_align" data-bs-toggle="dropdown" id="selected_color" aria-expanded="false">
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
                <div id="meeting_sec_div" style="display: none;"> 
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-select select2" name="portfolio_id" id="portfolio_id" onchange="return get_portfolio_id();">
                                        <option value="">Select Portfolio</option>
                                        <?php                                                            
                                        $Portfolio = $this->Front_model->Portfolio();
                                            $AcceptedProjectList = $this->Front_model->AcceptedProjectListPortfolio();       
                                        if($Portfolio || $AcceptedProjectList)
                                        {
                                            foreach($Portfolio as $c)
                                            {
                                        ?>
                                        <option value="<?php echo $c->portfolio_id;?>"><span><?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name.' '.$c->portfolio_lname;}?></span></option>
                                        <?php        
                                            }
                                            foreach($AcceptedProjectList as $al)
                                                {
                                                    $c_id = $al->portfolio_id;
                                                    if($c_id != 0)
                                                    {
                                                    $getAllPortfolio = $this->Front_model->getAllPortfolio($c_id);
                                                    if($getAllPortfolio->portfolio_createdby != $this->session->userdata('d168_id'))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $getAllPortfolio->portfolio_id;?>"><span><?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?></span></option>
                                                    <?php
                                                    }
                                                    }
                                                }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span id="portfolio_idErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="team_member" id="team_member" class="form-control meeting_members_dd" multiple="multiple" data-placeholder="Select Team Members..." onchange="return Team_Members();">
                                                        
                                    </select>
                                    <input type="hidden" name="selected_T_member" id="selected_T_member">
                                </div>
                                <span id="team_memberErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="add_dup_member btn btn-d btn-sm">Invite More</button>                                                    
                        </div>
                    </div>
                    <div class="imember_div">

                    </div>
                </div>
                <div class="row mb-3" id="event_start_end_date_select">
                    <div class="col-md-12">
                        <div class="form-group">

                            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="far fa-calendar-alt"></i></span>
                                </div>

                                <input type="text" class="form-control" name="event_start_date_nn" id="event_start_date_nn" placeholder="Start Date" value=""  onchange="customChange()"/>

                                <input type="text" class="form-control" name="event_end_date_nn" id="event_end_date_nn" placeholder="End Date" value="" onchange="customChange()"/>

                            </div>
                            <span id="event_start_end_dateErr" class="text-danger"></span>
                            <span id="event_start_end_dateErr" class="text-danger"></span>
                         </div>
                    </div>
                </div>
                <!-- <div class="row mb-3" id="event_start_end_date_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="datepicker2">
                                <input type="text" class="form-control" id="event_start_end_date_new" name="event_start_end_date_new" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" required="">
                            </div>
                            <span id="event_start_end_date_new" class="text-danger" ></span>
                         </div>
                    </div>
                </div> -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-sync"></i></span>
                                </div>
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
                <div class="row" id="date-time-section">
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
                <div class="row">
                    <div class="col-md-6" id="old_reminder">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                    <div class="col-md-6" id="task_priority_div" style="display: none;">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-level-up-alt"></i></span>
                                </div>
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
                <!-- </div>
                <div class="row mb-3"> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="event_allDay" id="event_allDay" class="form-check-input" onclick="check_reminder(this.value)">
                            <label class="control-label" for="event_allDay">
                                All Day
                            </label>
                            <span id="event_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group" id="draggable_field_create">
                            <input type="checkbox" name="draggable_event" id="draggable_event" class="form-check-input">
                            <label class="control-label" for="draggable_event"> 
                                Draggable Event
                            </label>
                            <span id="draggable_eventErr" class="text-danger"></span>
                        </div>
                    </div> -->
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
                <div id="meeting_sec_div2" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                      <span class="input-group-text cus_textbox_icon"><i class="far fa-copy" onclick="copyFunction()"></i></span>
                                    </div>
                                    <input class="form-control form-white" placeholder="Meeting Link" type="url" name="meeting_link" id="meeting_link"/>
                                </div>
                                <span id="meeting_linkErr" class="text-danger"></span>                                
                            </div>
                            <div style="margin-top: 10px">
                            <input type="checkbox" name="own_meet" id="own_meet" class="form-check-input" onclick="return ownMeet()">
                                <label class="control-label" for="own_meet">Create Own Link</label>
                                <input type="hidden" name="meet_value_get" id="meet_value_get" value="true" >
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                      <span class="input-group-text cus_textbox_icon"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input class="form-control form-white" placeholder="Add Location" type="text" name="meeting_location" id="meeting_location"/>
                                </div>
                                <span id="meeting_locationErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div>
                                    <input class="form-control" name="mfile[]" id="mfile" type="file" multiple="" onchange="return display_add_mfile_button_create();"/>
                                    <input type="hidden" name="mfile_old" id="mfile_old">
                                    <!-- <input type="hidden" name="mfile_add_create" id="mfile_add_create"> -->
                                    <div class="all_mfiles"></div>
                                    <div class="all_mfiles_name"></div>
                                    <input type="hidden" name="cmf_cntVal" id="cmf_cntVal" value="0">
                                    <input type="hidden" name="cmf_cntVal2" id="cmf_cntVal2" value="0">
                                </div>
                                <span id="mfileErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div>
                                    <button type="button" class="btn btn-sm btn-d waves-effect waves-light" onclick="return add_mfile_button_create();" id="add_mfile_but_create" title="Add Files" style="display:none;">
                                     Add
                                    </button>
                                    <img id="mrabcloader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="refresh_display_maddfiles">
                        <ul class="list-unstyled fw-medium display_all_maddfiles_li">
                        </ul>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <textarea class="form-control form-white" placeholder="Type details for this new meeting" name="meeting_agenda" id="meeting_agenda"></textarea>
                                </div>
                                <span id="meeting_agendaErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--add event task -->
                 <!-- <div class="event-task-panel"> -->
                    <!-- <button class="btn btn-light event-add-task" onclick="showPriority(2);" type="button">Add task</button> -->
                    <!-- <div class="panel add-task-panel" style="display:none;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Title</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task_name" placeholder="Title">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-info"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="width: 85%;">
                                    <label>Set Priority</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="selected-text2" name="priority" readonly="" placeholder="set priority">
                                        <div class="input-group-append">
                                            <div class="input-group-text" id="my-icon-select2"></div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Reminder</label>
                                        <div class="input-group mb-3">
                                            <select id="task_reminder" name="task_reminder" class="form-control">
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
                                        <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-bell-o"></i></span>
                                            </div>
                                        </div>
                                        <span id="task_reminderErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ti-alarm-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="task-time-section2">
                                    <div class="form-group">
                                        <label>Start time</label>
                                        <div class="input-group mb-3">
                                            <select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 85%;">
                                                <?php
                                                if($time_12hrs){
                                                    foreach ($time_12hrs as $t12hrs) {
                                                        ?>
                                                        <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '11:00 AM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ti-alarm-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="task_allDay" id="task_allDay2" class="filled-in chk-col-success">
                                        <label class="control-label" for="task_allDay2">All Day</label>
                                        <span id="task_allDayErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                </div> -->
                <!--event task end-->
                <input type="hidden" name="type" id="type" value="event">
            </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-d waves-effect waves-light save-category">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-category" data-bs-dismiss="modal">Cancel</button>
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

                <button id="add_todobut" class="btn btn-sm btn-d waves-effect waves-light me-2 add-todo" type="button" data-bs-toggle="modal" data-bs-target="#add-todo"><i class="mdi mdi-plus"></i> Add todo</button>
                <button type="button" class="btn btn-sm btn-d waves-effect waves-light me-2 edit-event">
                    <i class="mdi mdi-file-edit"></i> Edit
                </button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect me-2 delete-event">
                    <i class="mdi mdi-delete"></i> Delete
                </button>

                <button type="button" class="btn-close view_modal_close" onclick="return view_modal_close();" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4"></div>
                <div class="modal-body-inside-todo"></div>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Update Event MODAL -->
<div class="modal fade bs-example-modal-sm" id="myModalUpdate" role="dialog" style="background: #62626273">
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
                    <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_updateOptions();">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" data-bs-backdrop="static" id="update-event">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="update-category" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Update</h5>
                <button type="button" class="btn-close" aria-label="Close"  onclick="reset_updateCalFrom()"></button>
            </div>
            <div data-simplebar style="max-height: 320px;"> 
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">

                <ul class="nav nav-tabs nav-tabs-custom nav-justified hide_type_radio" role="tablist">
                <input type="radio" value="event" name="created_type" id="created_type_event_update" checked>
                <input type="radio" value="task" name="created_type" id="created_type_task_update">
                <input type="radio" value="reminder" name="created_type" id="created_type_reminder_update">
                <input type="radio" value="meeting" name="created_type" id="created_type_meeting_update">
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fas fa-pen"></i></span>
                                </div>
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
                            <div class="cus_input_group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_button_icon"><i class="fas fa-paint-brush"></i></span>
                                </div>
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle cus_button_icon_align" data-bs-toggle="dropdown" id="selected_color_update" aria-expanded="false">
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
                <div id="meeting_sec_div_update">                    
                    <div class="row mb-3" id="show_porfolio_div">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-select select2" name="portfolio_id" id="portfolio_id_up" onchange="return get_portfolio_id_Cal_up();">
                                        
                                    </select>
                                </div>
                                <span id="portfolio_idErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="show_member_div">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="team_member" id="team_member_up" class="form-control meeting_members_dd" multiple="multiple" data-placeholder="Select Team Members..." onchange="return Team_Members_Cal_up();">
                                                        
                                    </select>
                                    <input type="hidden" name="selected_T_member" id="selected_T_member_up">
                                </div>
                                <span id="team_memberErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="add_dup_member_up btn btn-d btn-sm">Invite More</button>                                                    
                        </div>
                    </div>
                    <div class="imember_div_up">

                    </div>
                </div>
                <div id="event_field_hide">
                <div class="row mb-3" id="event_start_end_date_select_update">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-daterange input-group" id="datepicker3" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker3'>
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="far fa-calendar-alt"></i></span>
                                </div>

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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-sync"></i></span>
                                </div>
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
                <div class="row" id="date-time-section1">
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
                <div class="row">
                    <div class="col-md-6" id="old_reminder_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-level-up-alt"></i></span>
                                </div>
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
                <!-- </div>
                <div class="row mb-3"> -->
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
                <div id="meeting_sec_div_update2">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                      <span class="input-group-text cus_textbox_icon"><i class="far fa-copy" onclick="copyFunction()"></i></span>
                                    </div>
                                    <input class="form-control form-white" placeholder="Meeting Link" type="url" name="meeting_link" id="meeting_link_up" />
                                </div>
                                <span id="meeting_linkErr" class="text-danger"></span>
                            </div>
                            <div style="margin-top: 10px">
                            <input type="checkbox" name="own_meet" id="own_meet" class="form-check-input" onclick="return ownMeet()">
                                <label class="control-label" for="own_meet">Create Own Link</label>
                                <input type="hidden" name="meet_value_get" id="meet_value_get" value="true" >
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                      <span class="input-group-text cus_textbox_icon"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input class="form-control form-white" placeholder="Add Location" type="text" name="meeting_location" id="meeting_location_up"/>
                                </div>
                                <span id="meeting_locationErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div>
                                    <input class="form-control" name="mfile[]" id="mfile_up" type="file" multiple="" onchange="return display_add_mfile_button();" />
                                    <input type="hidden" name="mfile_old" id="mfile_old_up">
                                    <input type="hidden" name="mfile_add_create" id="mfile_add_create_up">
                                </div>
                                <span id="mfileupErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div>
                                    <button type="button" class="btn btn-sm btn-d waves-effect waves-light" onclick="return add_mfile_button();" id="add_mfile_but" title="Add Files" style="display:none;">
                                     Add
                                    </button>
                                    <img id="mrabloader2" style="display: none;" src="<?php echo base_url()?>assets/images/loading.gif">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="refresh_remove_mdelfiles">
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <textarea class="form-control form-white" placeholder="Type details for this new meeting" name="meeting_agenda" id="meeting_agenda_up"></textarea>
                                </div>
                                <span id="meeting_agendaErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="checkbox_value_get_update" id="checkbox_value_get_update" value="" >
                <input type="hidden" name="draggable_id" id="draggable_id">
                <input type="hidden" name="type" id="type" value="event">
                <input type="hidden" name="event_id" id="event_id">
                <!--add event task -->
                 <!-- <div class="event-task-panel">
                            <button class="btn btn-light event-add-task" onclick="showPriority(3);" type="button">Add task</button> 
                            <div class="panel add-task-panel" style="display:none;">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="task_name" placeholder="Title">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-text"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-info"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="width: 85%;">
                                            <label>Set Priority</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="selected-text3" name="priority" readonly="" placeholder="set priority">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="my-icon-select3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add Reminder</label>
                                                <div class="input-group mb-3">
                                                    <select id="task_reminder" name="task_reminder" class="form-control">
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
                                                <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-bell-o"></i></span>
                                                    </div>
                                                </div>
                                                <span id="task_reminderErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start date</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="ti-alarm-clock"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="task-time-section2">
                                            <div class="form-group">
                                                <label>Start time</label>
                                                <div class="input-group mb-3">
                                                    <select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 85%;">
                                                        <?php
                                                        if($time_12hrs){
                                                            foreach ($time_12hrs as $t12hrs) {
                                                                ?>
                                                                <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '11:00 AM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="ti-alarm-clock"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" name="task_allDay" id="task_allDay2" class="filled-in chk-col-success">
                                                <label class="control-label" for="task_allDay2">All Day</label>
                                                <span id="task_allDayErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>                  
                                </div>
                            </div>
                        </div> -->
                <!--event task end-->
            </div>

            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-d waves-effect waves-light update-event-btn">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_updateCalFrom();">Cancel</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Delete Event MODAL -->
<div class="modal fade bs-example-modal-sm" id="myModal" role="dialog" style="background: #62626273">
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
                    <button type="button" class="btn btn-sm bg-d text-white waves-effect" onclick="return reset_deleteOptions();">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal-->

<!-- Add New Drag Event MODAL -->
<div class="modal fade" data-bs-backdrop="static" id="add-new-drag">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="create-category-drag" id="create-category-drag" method="post" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Create New Draggable Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">
            <div class="tab-content" style="padding: 1rem 1rem 0rem 1rem;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fas fa-pen"></i></span>
                                </div>
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
                            <div class="cus_input_group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_button_icon"><i class="fas fa-paint-brush"></i></span>
                                </div>
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle cus_button_icon_align" data-bs-toggle="dropdown" id="selected_color_drag" aria-expanded="false">
                                <span id="selected_color_drag_text">Choose a color...</span><i class="mdi mdi-chevron-down float-end"></i>
                               </button>
                                <div class="dropdown-menu">
                                <div class="dropdown-item cal_cus_colors">
                                <ul style="padding: 0 !important;margin: 0 !important;">
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color1"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color2"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color3"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color4"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color5"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color6"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color7"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color8"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color9"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color10"></li>
                                    <br>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color11"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color12"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color13"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color14"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color15"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color16"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color17"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color18"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color19"></li>
                                    <li onclick="return select_cal_cus_colors_drag_insert(this);" class="cus_cal_color20"></li>
                                    <input type="hidden" name="event_color" id="event_color" value="" required>
                                </ul>
                            </div>
                            </div>
                            </div>
                            <span id="event_colorErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control form-white" placeholder="Add Note" name="event_note"></textarea>
                            </div>
                            <span id="event_noteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="datepicker4">
                                <input type="text" class="form-control" id="reservation_drag" name="event_start_end_date_drag" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" value="<?php echo date('Y-m-d');?>" required="">
                            </div>
                            <span id="event_start_end_date_dragErr" class="text-danger" ></span>
                         </div>
                    </div>
                </div> -->
                <div class="row mb-3" id="date-time-section-drag">
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_start_time" name="event_start_time" class="form-control select2 create_event_start_time" onchange="return change_end_time_drag(this.value);" style="width: 86%;">
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
                                <select id="event_end_time" name="event_end_time" class="form-control select2 changed_end_time_drag" style="width: 86%;">
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
                              <span id="event_end_time_dragErr" class="text-danger"></span>
                         </div>
                        </div>
                    </div>
                </div> 
                <div class="row mb-3">
                    <div class="col-md-6" id="old_reminder_drag">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                    <div class="col-md-6" id="new_reminder_drag" style="display: none;">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="event_allDay_drag" id="event_allDay_drag" class="form-check-input" onclick="check_reminder_drag(this.value)">
                            <label class="control-label" for="event_allDay_drag">
                                All Day
                            </label>
                            <span id="event_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>                
                <input type="hidden" name="draggable_event_drag" id="draggable_event_drag" class="filled-in chk-col-success" value="on">
                <input type="hidden" name="event_repeat_option_drag" id="event_repeat_option_drag" value="Does not repeat">
                <input type="hidden" name="checkbox_value_get_drag" id="checkbox_value_get_drag" value="true">
                <input type="hidden" name="type" id="type" value="event">
            </div>

            </div>
            <div class="modal-footer">
                <img id="drag_form_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
                <button type="submit" id="inside_drag" class="btn btn-sm btn-d waves-effect waves-light save-category-drag">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-category-drag" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Edit Drag Event MODAL -->
<div class="modal fade" data-bs-backdrop="static" id="edit-new-drag">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="update-category-drag" id="update-category-drag" method="post" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Update Draggable Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">
            <div class="tab-content" style="padding: 1rem 1rem 0rem 1rem;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fas fa-pen"></i></span>
                                </div>
                                <input class="form-control form-white" placeholder="Enter Title *" type="text" name="event_name" required="" />
                            </div>
                            <span id="event_nameErr" class="text-danger"></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <select class="form-control form-select" data-placeholder="Choose a color..." id="event_color_drag_update" name="event_color" required="">
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
                            <div class="cus_input_group">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_button_icon"><i class="fas fa-paint-brush"></i></span>
                                </div>
                               <button type="button" class="btn btn-cus-textbox dropdown-toggle cus_button_icon_align" data-bs-toggle="dropdown" id="selected_color_drag_update" aria-expanded="false">
                                <span id="selected_color_drag_update_text">Choose a color...</span><i class="mdi mdi-chevron-down float-end"></i>
                               </button>
                                <div class="dropdown-menu">
                                <div class="dropdown-item cal_cus_colors">
                                <ul style="padding: 0 !important;margin: 0 !important;">
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color1"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color2"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color3"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color4"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color5"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color6"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color7"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color8"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color9"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color10"></li>
                                    <br>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color11"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color12"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color13"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color14"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color15"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color16"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color17"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color18"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color19"></li>
                                    <li onclick="return select_cal_cus_colors_drag_update(this);" class="cus_cal_color20"></li>
                                    <input type="hidden" name="event_color" id="event_color" required>
                                </ul>
                            </div>
                            </div>
                            </div>
                            <span id="event_colorErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control form-white" placeholder="Add Note" name="event_note"></textarea>
                            </div>
                            <span id="event_noteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="datepicker5">
                                <input type="text" class="form-control" id="reservation_drag_update" name="event_start_end_date_drag_update" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker5' data-provide="datepicker" data-date-autoclose="true" value="" required="">
                            </div>
                            <span id="event_start_end_date_drag_updateErr" class="text-danger" ></span>
                         </div>
                    </div>
                </div> -->
                <div class="row mb-3" id="date-time-section-drag-update">
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <select id="event_start_time_ud" name="event_start_time" class="form-control select2 create_event_start_time" onchange="return change_end_time_drag_up(this.value);" style="width: 86%;">
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
                                <select id="event_end_time_ud" name="event_end_time" class="form-control select2 changed_end_time_drag_up" style="width: 86%;">
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
                              <span id="event_end_time_drag_upErr" class="text-danger"></span>
                         </div>
                        </div>
                    </div>
                </div> 
                <div class="row mb-3">
                    <div class="col-md-6" id="old_reminder_drag_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                    <div class="col-md-6" id="new_reminder_drag_update">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="event_allDay_drag_update" id="event_allDay_drag_update" class="form-check-input" onclick="check_reminder_dragUpdate(this.value)">
                            <label class="control-label" for="event_allDay_drag_update">
                                All Day
                            </label>
                            <span id="event_allDayErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>                
                <input type="hidden" name="drag_id" id="drag_id">
                <input type="hidden" name="event_repeat_option_update" id="event_repeat_option_update" value="Does not repeat">
                <input type="hidden" name="checkbox_value_get_drag_update" id="checkbox_value_get_drag_update" value="">
                <input type="hidden" name="event_start_end_date_drag_update" value="">
            </div>

            </div>
            <div class="modal-footer">
                <img id="drag_form_loader_update" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
                <button type="submit" id="inside_drag_update" class="btn btn-sm btn-d waves-effect waves-light save-category-drag">Save</button>
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-category-drag" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Add Inside To Do Modal -->
<div class="modal fade" data-bs-backdrop="static" id="add-todo" style="background: #62626273">
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fas fa-pen"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-level-up-alt"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="fa fa-bell"></i></span>
                                </div>
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
                                <div class="input-group-append">
                                  <span class="input-group-text cus_textbox_icon"><i class="far fa-calendar-alt"></i></span>
                                </div>
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
                <button type="button" class="btn btn-sm bg-d text-white waves-effect close-todo" onclick="return reset_todoForm();">Cancel</button>
            </div>
            </form>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
<!-- end modal-->

<!-- Preview file modal content -->
<div id="previewMeetingModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="previewMeetingModal_Content">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<div id="RemoveMemberMailModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#RemoveMemberMailModalLabel" aria-hidden="true" style="background: #62626273">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form name="RemoveMemberForm" id="RemoveMemberForm" method="post">
                <div class="modal-body">
                    <input type="hidden" name="member" id="member_rmmf">
                    <input type="hidden" name="mid" id="mid_rmmf">
                    <input type="hidden" name="imid" id="imid_rmmf">
                    <input type="hidden" name="memtype" id="memtype_rmmf">
                    <input type="hidden" name="butsel" id="butsel">
                    <p>
                        <strong>Would you like to send meeting cancellation email to removed member?</strong>
                    </p>
                   <textarea class="form-control form-white" rows="4" placeholder="Add an optional message for cancellation" name="optional_msg"></textarea> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" onclick="return CloseRemoveMemberMailModal();">Back</button>
                    <button type="button" class="btn btn-sm btn-light" onclick="return RemoveMemberDontSendMail();" name="dont_send" id="dont_send">Do not send</button>
                    <button type="button" class="btn btn-sm btn-d" onclick="return RemoveMemberSendMail();" name="send" id="send">Send</button>
                    <img id="mrloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- for email send or not to removed mem from update modal -->
<div id="RemoveMemberMailUpdateModal" data-bs-backdrop="static" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#RemoveMemberMailUpdateModalLabel" aria-hidden="true" style="background: #62626273">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form name="RemoveMemberUpdateForm" id="RemoveMemberUpdateForm" method="post">
                <div class="modal-body">
                    <input type="hidden" name="removedmem" id="removedmem">
                    <input type="hidden" name="removedunique_key" id="removedunique_key">
                    <input type="hidden" name="butsel_up" id="butsel_up">
                    <p>
                        <strong>Would you like to send meeting cancellation email to removed member?</strong>
                    </p>
                   <textarea class="form-control form-white" rows="4" placeholder="Add an optional message for cancellation" name="optional_msg_up"></textarea> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" onclick="return RemoveMemberDontSendMailUpdate();" name="dont_send" id="dont_send_up">Do not send</button>
                    <button type="button" class="btn btn-sm btn-d" onclick="return RemoveMemberSendMailUpdate();" name="send" id="send_up">Send</button>
                    <img id="mrloader2_up" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- for email send or not to removed mem from update modal -->

<!-- Preview create meeting added file modal content -->
<div id="previewCAddedMeetingModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewCAddedMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="btn-close" onclick="close_previewCAddedMeetingModal();"></button>
                </div>
                <div class="modal-body" id="previewCAddedMeetingModal_Content" style="height:500px">
                                             
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

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

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2-calendar/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

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
    //debugger;
  $(this).removeClass('active');
  $('#quoteModal').removeClass('hidden');
});

    // Function to select own link 

function ownMeet(){  
    // debugger;   
        var check_new_value = $('#meet_value_get').val();
        var meeting_link = $('#meeting_link').val();
        if(check_new_value == 'true'){
            $('#meeting_link').val(" ");
            $('#meet_value_get').val("false");
        }else{
            var meetingId = generateMeetingId();
        document.getElementById("meeting_link").value = base_url + "meeting/"+ meetingId;
            $('#meet_value_get').val("true");

        }
    }

    // Function to copy the link
    function copyFunction() {
    // debugger;   
      /* Get the text field */
      var copyText = document.getElementById("meeting_link");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);
    }

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

<!-- plugin js -->
<script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
<!-- <script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script> -->
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/core/main.min.js"></script>
<script src='<?php echo base_url();?>assets/libs/@fullcalendar/google-calendar/main.js'></script>
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/interaction/main.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/@fullcalendar/list/main.min.js"></script>

<!-- Calendar init -->
<script src="<?php echo base_url();?>assets/js/pages/calendar.init.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
<?php
include('footer_links.php');
?>
<script type="text/javascript">
$(document).ready(function(){
    //debugger;
    //console.log('yes');
   var add_dup_member = $('.add_dup_member'); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var memberHTML = '<div class="row mb-2"><div class="col-lg-8"><input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-4 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_member).click(function(){
    //debugger;
           $(imember_div).append(memberHTML); //Add field html
   });
   
   $(imember_div).on('click', '.add_dup_member2', function(e){
      //debugger;
           $(imember_div).append(memberHTML); 
   });

   //Once remove button is clicked
   $(imember_div).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       x--; //Decrement field counter
   });

   //for update
   var add_dup_member_up = $('.add_dup_member_up'); //Add button selector
   var imember_div_up = $('.imember_div_up'); //Input field wrapper
   var memberHTML_up = '<div class="row mb-2"><div class="col-lg-8"><input type="email" id="imemail_up" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-4 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member_up2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var y = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_member_up).click(function(){
    //debugger;
           $(imember_div_up).append(memberHTML_up); //Add field html
   });
   
   $(imember_div_up).on('click', '.add_dup_member_up2', function(e){
      //debugger;
           $(imember_div_up).append(memberHTML_up); 
   });

   //Once remove button is clicked
   $(imember_div_up).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       y--; //Decrement field counter
   });
});
</script>
<!-- <script src="<?php echo base_url('assets/js/lib/control/iconselect.js');?>"></script> -->
<!-- <script src="<?php echo base_url('assets/js/lib/iscroll.js');?>"></script> -->
<!-- <script type="text/javascript">  
$('#task_priority_div').hide();
function showPriority(i){
    var iconSelect;
    var selectedText;
    selectedText = document.getElementById('selected-text'+i);
    
    document.getElementById('my-icon-select'+i).addEventListener('changed', function(e){
       selectedText.value = iconSelect.getSelectedValue();
    });

    iconSelect = new IconSelect("my-icon-select"+i, 
        {'selectedIconWidth':30,
        'selectedIconHeight':30,
        'selectedBoxPadding':1,
        'iconsWidth':23,
        'iconsHeight':23,
        'boxIconSpace':1,
        'vectoralIconNumber':4,
        'horizontalIconNumber':4});

    var icons = [];
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/2-removebg-preview.png');?>', 'iconValue':'High Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/3-removebg-preview.png');?>', 'iconValue':'Medium Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/4-removebg-preview.png');?>', 'iconValue':'Low Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/6-removebg-preview.png');?>', 'iconValue':'None'});
    
    iconSelect.refresh(icons);
}   
</script> -->
<!--ends custom js-->
<script type="text/javascript">
    $("#create_event").click(function () {
        $('.create-category').find("#type").val('event');
        $('.create-category').find("#reservation").prop('required',true);
        $('.create-category').find("#datepicker").prop('required',false);
      });

      $("#create_task").click(function () {
        $('.create-category').find("#type").val('task');
        $('.create-category').find("#reservation").prop('required',false);
        $('.create-category').find("#datepicker").prop('required',true);
      });
</script>
<script type="text/javascript">
    $('#new_reminder').hide();
    // $('#event_start_end_date_select').hide();
    // $('#event_start_end_date_div').show();
    function showEndDate(value) 
    {
        if(value == "Does not repeat")
        {
            var check_start_date = $('#event_start_date_nn').val();
            $(".create-category").find("input[name=event_end_date_nn]").val(moment(check_start_date).format('Y-MM-DD'));
        }

        if(value == "Daily" || value == "Does not repeat"){
            // $('#draggable_field_create').show();
            $('#draggable_event').val("on");
        }else{
            // $('#draggable_field_create').hide();
            $('#draggable_event').val("");
        }
        if(value == 'Custom'){
            //console.log("Fgf");
            //debugger;
            var start_date_selected = $('#event_start_date_nn').val();
            var end_date_selected = $('#event_end_date_nn').val();
            var date1 = new Date(start_date_selected.split('-'));
            var date2 = new Date(end_date_selected.split('-'));
            var Difference_In_Time = date2.getTime() - date1.getTime();
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            // console.log('Current Date');
            // console.log(new Date());
            // console.log('start date selected');
            // console.log(start_date_selected);
            // console.log(date1);            
            // console.log('end date selected');
            // console.log(end_date_selected);
            // console.log(date2);  
            // console.log("Difference_In_Time");
            // console.log(Difference_In_Days);
            if(Difference_In_Days > 5){
                $('#event_start_end_date_select').show();
                //$('#event_start_end_date_div').hide();  
                $('.custom-class').css('display','block');
                for($i =1;$i<=7;$i++){
                    $('#radioId'+$i).show();
                }
            }else{
                for($i =1;$i<=7;$i++){
                    $('#radioId'+$i).hide();
                }
                $('#event_start_end_date_select').show();
                //$('#event_start_end_date_div').hide();
                $('.custom-class').css('display','block'); 
                var dateArray = new Array();
                var currentDate = date1;
                while (currentDate <= date2) {
                    dateArray.push(new Date (currentDate));
                    currentDate = moment(currentDate).add(1, 'days');
                }
                var arrayLength = dateArray.length;
                for (var i = 0; i < arrayLength; i++) {
                    let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                    $('#radioId'+day_new_value).show();
                }

            }
            
        }
        // else if(value == 'Does not repeat'){
        //     $('#event_start_end_date_select').hide();
        //     $('#event_start_end_date_div').show();
        //     $('.custom-class').css('display','none');
        // }
        else
        {
            $('#event_start_end_date_select').show();
            // $('#event_start_end_date_div').hide();
            $('.custom-class').css('display','none');
        }
    }
    function showEndDateUpdate(value) 
    {
        //debugger;
        if(value == "Does not repeat")
        {
            var check_start_date = $('#event_start_date_nnn').val();
            $(".update-category").find("input[name=event_end_date_nn]").val(moment(check_start_date).format('Y-MM-DD'));
        }

        if(value == "Daily" || value == "Does not repeat"){
            // $('#draggable_field').show();
            $('#draggable_event1').val("on");
        }else{
            // $('#draggable_field').hide();
            $('#draggable_event1').val("");
        }
        if(value == 'Custom'){
            
            var start_date_selected = $('#event_start_date_nnn').val();
            var end_date_selected = $('#event_end_date_nnn').val();
            var date1 = new Date(start_date_selected.split('-'));
            var date2 = new Date(end_date_selected.split('-'));
            var Difference_In_Time = date2.getTime() - date1.getTime();
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            //console.log("Difference_In_Time");
            //console.log(Difference_In_Days);
            if(Difference_In_Days > 5){
                $('#event_start_end_date_select_update').show();
                //$('#event_start_end_date_div_update').hide();
                $('.custom-class-update').css('display','block');
            }else{
                for($i =1;$i<=7;$i++){
                    $('#radioupdate'+$i).hide();
                }
                $('#event_start_end_date_select_update').show();
                //$('#event_start_end_date_div_update').hide();
                $('.custom-class-update').css('display','block');
                var dateArray = new Array();
                var currentDate = date1;
                while (currentDate <= date2) {
                    dateArray.push(new Date (currentDate));
                    currentDate = moment(currentDate).add(1, 'days');
                }
                var arrayLength = dateArray.length;
                for (var i = 0; i < arrayLength; i++) {
                    let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                    $('#radioupdate'+day_new_value).show();
                }

            } 
        }
        // else if(value == 'Does not repeat')
        // {
        //     $('#event_start_end_date_select_update').hide();
        //     $('#event_start_end_date_div_update').show();
        //     $('.custom-class-update').css('display','none');
        // }
        else{
            $('#event_start_end_date_select_update').show();
            //$('#event_start_end_date_div_update').hide();
            $('.custom-class-update').css('display','none');
        }
    }
    function check_reminder(value){  
    //debugger;   
        var check_new_value = $('#checkbox_value_get').val();
        if(check_new_value == 'true'){
            $('#checkbox_value_get').val("false");
            $('#date-time-section').hide();
            $('#old_reminder').hide();
            $('#new_reminder').show();
        }else{
            $('#checkbox_value_get').val("true");
            $('#date-time-section').show();
            $('#old_reminder').show();
            $('#new_reminder').hide();
        }

    }
    function check_reminder_update(value){    
    //debugger;  
        var check_new_value = $('#checkbox_value_get_update').val();
        if(check_new_value == 'true'){
            $('#checkbox_value_get_update').val("false");
            $('#date-time-section1').hide();
            $('#old_reminder_update').hide();
            $('#new_reminder_update').show();
        }else{
            $('#checkbox_value_get_update').val("true");
            $('#date-time-section1').show();
            $('#old_reminder_update').show();
            $('#new_reminder_update').hide();
            $("#update-event").find("select[name=event_start_time]").select2().trigger('change');
            $("#update-event").find("select[name=event_end_time]").select2().trigger('change');
        }

    }
    function check_reminder_drag(value) {
       // alert();
       var check_new_value = $('#checkbox_value_get_drag').val();
       if (check_new_value == 'true') {
         $('#checkbox_value_get_drag').val("false");
         $('#old_reminder_drag').hide();
         $('#date-time-section-drag').hide();
         $('#new_reminder_drag').show();
       } else {
         $('#checkbox_value_get_drag').val("true");
         $('#old_reminder_drag').show();
         $('#date-time-section-drag').show();
         $('#new_reminder_drag').hide();
       }
     }
     function check_reminder_dragUpdate(value) {
       // alert();
       var check_new_value = $('#checkbox_value_get_drag_update').val();
       if (check_new_value == 'true') {
         //alert('1')
         $('#checkbox_value_get_drag_update').val("false");
         $('#old_reminder_drag_update').hide();
         $('#date-time-section-drag-update').hide();
         $('#new_reminder_drag_update').show();
       } else {
         //alert('2')
         $('#checkbox_value_get_drag_update').val("true");
         $('#old_reminder_drag_update').show();
         $('#date-time-section-drag-update').show();
         $('#new_reminder_drag_update').hide();
       }
     }
    function dateChange(value){
        alert(value);
    }
    
    function event_type_task(){
        $('#created_type_event').prop('checked', false);
        $('#created_type_task').prop('checked', true);
        $('#created_type_reminder').prop('checked', false);
        $('#created_type_meeting').prop('checked', false);
        $('#task_priority_div').show();
        $('#add_note_div').show();
        $('#meeting_sec_div').hide();
        $('#meeting_sec_div2').hide();
        // $('#meeting_link').prop('required', false);
    }
    function event_type_event(){
        $('#created_type_event').prop('checked', true);
        $('#created_type_task').prop('checked', false);
        $('#created_type_reminder').prop('checked', false);
        $('#created_type_meeting').prop('checked', false);
        $('#task_priority_div').hide();
        $('#add_note_div').show();
        $('#meeting_sec_div').hide();
        $('#meeting_sec_div2').hide();
        // $('#meeting_link').prop('required', false);
    }
    function event_type_reminder(){
        $('#created_type_event').prop('checked', false);
        $('#created_type_task').prop('checked', false);
        $('#created_type_reminder').prop('checked', true);
        $('#created_type_meeting').prop('checked', false);
        $('#add_note_div').hide();
        $('#task_priority_div').hide();
        $('#meeting_sec_div').hide();
        $('#meeting_sec_div2').hide();
        // $('#meeting_link').prop('required', false);
    }

    function event_type_meeting(){
        $('#created_type_event').prop('checked', false);
        $('#created_type_task').prop('checked', false);
        $('#created_type_reminder').prop('checked', false);
        $('#created_type_meeting').prop('checked', true);
        $('#add_note_div').hide();
        $('#task_priority_div').hide();
        $('#meeting_sec_div').show();
        $('#meeting_sec_div2').show();
        // $('#meeting_link').prop('required', true);
        // createMeeting();
        // generateMeetingId();
        var meetingId = generateMeetingId();
        document.getElementById("meeting_link").value = base_url + "meeting/"+ meetingId;

    }

    

    function generateMeetingId() {
    const alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789';
    let meetingId = '';

    // Generate random characters in the format 'xxx-xxx-xxx'
    for (let i = 0; i < 3; i++) {
        for (let j = 0; j < 3; j++) {
        const randomIndex = Math.floor(Math.random() * alphabet.length);
        meetingId += alphabet[randomIndex];
        }
        if (i < 2) {
        meetingId += '-';
        }
    } 
    // Append the current date and time in the format 'DDHHmmss'
    const now = new Date();
    const dateStr = now.toISOString().replace(/[-:.T]/g, '').slice(6, 14);
    meetingId += '-' + dateStr;

    return meetingId;
    }


    // function createMeeting() {
    //     let meetingId =  'xxxxyxxx'.replace(/[xy]/g, function(c) {
    //         var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    //         return v.toString(16);
    //     });
        
    //     // let meetingId = 'xxxxxxxxxxxx'.replace(/[x]/g, function() {
    //     //     return (Math.floor(Math.random() * 16)).toString(16);
    //     //     });
    //     document.getElementById("meeting_link").value = "http://"+ window.location.host + "/meeting/"+ meetingId;
    // }

    function customChange(){
        //console.log("customChangeFunction");
        //debugger;
        $('#custom_value').prop('disabled', false);
        var check_start_date = $('#event_start_date_nn').val();
        var check_end_date = $('#event_end_date_nn').val();
        var check_event_repeat_option = $(".create-category").find("select[name='event_repeat_option']").val();
        if(check_start_date == check_end_date)
        {
            $(".create-category").find("select[name='event_repeat_option']").val('Does not repeat');
            $('.custom-class').hide();
        }
        else
        {
            if(check_event_repeat_option == 'Does not repeat')
            {
                $(".create-category").find("select[name='event_repeat_option']").val('Daily');
            }
            else
            {
                $(".create-category").find("select[name='event_repeat_option']").val(check_event_repeat_option);
            }
        }

        var event_repeat_option = $('#event_repeat_option').val();
        //console.log("Ddfd"+event_repeat_option);
        if(event_repeat_option == "Custom"){
            for($i =1;$i<=7;$i++){
                    $('#radioId'+$i).hide();
                }
                $('#event_start_end_date_select').show();
                //$('#event_start_end_date_div').hide();
                $('.custom-class').css('display','block'); 
                var start_date_selected = $('#event_start_date_nn').val();
                var end_date_selected = $('#event_end_date_nn').val();
                var date1 = new Date(start_date_selected.split('-'));
                var date2 = new Date(end_date_selected.split('-'));
                var dateArray = new Array();
                var currentDate = date1;
                while (currentDate <= date2) {
                    dateArray.push(new Date (currentDate));
                    currentDate = moment(currentDate).add(1, 'days');
                }
                var arrayLength = dateArray.length;
                //console.log("array_leng"+arrayLength);
                for (var i = 0; i < arrayLength; i++) {
                    let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                    $('#radioId'+day_new_value).show();
                }
                
        }
        /////////   Event date time update
        //debugger;
        var start_date_selected = $('#event_start_date_nn').val();
        var end_date_selected = $('#event_end_date_nn').val();
        var date1 = new Date(start_date_selected.split('-'));
        var startd = start_date_selected;
        let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd.split('-')).getDay()];
        let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ][new Date(startd.split('-')).getMonth()];
        var start_day_value = new Date(startd.split('-')).getDate();
        $("#weekday_value").html("Weekly on "+weekday);
        $("#monthly_value").html("Monthly on "+start_day_value);
        $("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

        var start_update = new Date(start_date_selected.split('-')),
        end_update   = new Date(end_date_selected.split('-')),
        diff_update  = new Date(end_update - start_update),
        days_diff  = diff_update/1000/60/60/24;
        //console.log("days_diff");
        //console.log(days_diff);
        if(days_diff < 2){
            $("#custom_value").html("Custom (Please select more than 2 Days in date range!)");
            $('#custom_value').prop('disabled', true);
        }else{
            $("#custom_value").html("Custom");
            $('#custom_value').prop('disabled', false);
        }
        if(days_diff < 7){
            $("#weekday_value").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
            $('#weekday_value').prop('disabled', true);
        }else{
            $('#weekday_value').prop('disabled', false);
        }
        if(days_diff < 31){
            $("#monthly_value").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
            $('#monthly_value').prop('disabled', true);
        }else{
            $('#monthly_value').prop('disabled', false);
        }
        if(days_diff < 365){
            $("#yearly_value").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
            $('#yearly_value').prop('disabled', true);
        }else{
            $('#yearly_value').prop('disabled', false);
        }

    }
    function customChangeUpdate(){
        //console.log("Dfdfd");
        //debugger;
        $('.custom_value_update').prop('disabled', false);
        var check_start_date = $('#event_start_date_nnn').val();
        var check_end_date = $('#event_end_date_nnn').val();
        var check_event_repeat_option = $(".update-category").find("select[name='event_repeat_option']").val();
        if(check_start_date == check_end_date)
        {
            $(".update-category").find("select[name='event_repeat_option']").val('Does not repeat');
            $('.custom-class-update').hide();
        }
        else
        {
            if(check_event_repeat_option == 'Does not repeat')
            {
                $(".update-category").find("select[name='event_repeat_option']").val('Daily');
            }
            else
            {
                $(".update-category").find("select[name='event_repeat_option']").val(check_event_repeat_option);
            }
        }

        var event_repeat_option = $('.event_repeat_optionn').val();
        //console.log("event_repeat_optionkkk");
        //console.log(event_repeat_option);
        if(event_repeat_option == "Custom"){
            //console.log("custommmmmm");
            var start_date_selected = $('#event_start_date_nnn').val();
            var end_date_selected = $('#event_end_date_nnn').val();
            var date1 = new Date(start_date_selected.split('-'));
            var date2 = new Date(end_date_selected.split('-'));
            var Difference_In_Time = date2.getTime() - date1.getTime();
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            //console.log("Difference_In_Time");
            //console.log(Difference_In_Days);
            if(Difference_In_Days > 5){
                $('#event_start_end_date_select_update').show();
                //$('#event_start_end_date_div_update').hide();
                $('.custom-class-update').css('display','block');
                for($i =1;$i<=7;$i++){
                    $('#radioupdate'+$i).show();
                }
            }else{
                for($i =1;$i<=7;$i++){
                    $('#radioupdate'+$i).hide();
                }
                $('#event_start_end_date_select_update').show();
                //$('#event_start_end_date_div_update').hide();
                $('.custom-class-update').css('display','block');
                var dateArray = new Array();
                var currentDate = date1;
                while (currentDate <= date2) {
                    dateArray.push(new Date (currentDate));
                    currentDate = moment(currentDate).add(1, 'days');
                }
                var arrayLength = dateArray.length;
                for (var i = 0; i < arrayLength; i++) {
                    let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                    $('#radioupdate'+day_new_value).show();
                }

            }
        }
        /////////   Event date time update
        //console.log("rrrrrrrrrrr");
        var start_date_selected = $('#event_start_date_nnn').val();
        var end_date_selected = $('#event_end_date_nnn').val();
        var startd = start_date_selected;
        let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd.split('-')).getDay()];
        let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ][new Date(startd.split('-')).getMonth()];
        var start_day_value = new Date(startd.split('-')).getDate();
        $(".weekday_value_update").html("Weekly on "+weekday);
        $(".monthly_value_update").html("Monthly on "+start_day_value);
        $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames);

        var start_update = new Date(start_date_selected.split('-')),
        end_update   = new Date(end_date_selected.split('-')),
        diff_update  = new Date(end_update - start_update),
        days_diff  = diff_update/1000/60/60/24;
        //console.log("days_diff");
        //console.log(days_diff);
        if(days_diff < 2){
            $(".custom_value_update").html("Custom (Please select more than 2 Days in date range!)");
            $('.custom_value_update').prop('disabled', true);
        }else{
            $(".custom_value_update").html("Custom");
            $('.custom_value_update').prop('disabled', false);
        }
        if(days_diff < 7){
            $(".weekday_value_update").html("Weekly on "+weekday+" (Please select more than 1 week in date range!)");
            $('.weekday_value_update').prop('disabled', true);
        }else{
            $('.weekday_value_update').prop('disabled', false);
        }
        if(days_diff < 31){
            $(".monthly_value_update").html("Monthly on "+start_day_value+" (Please select more than 1 month in date range!)");
            $('.monthly_value_update').prop('disabled', true);
        }else{
            $('.monthly_value_update').prop('disabled', false);
        }
        if(days_diff < 365){
            $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (Please select more than 1 year in date range!)");
            $('.yearly_value_update').prop('disabled', true);
        }else{
            $('.yearly_value_update').prop('disabled', false);
        }
    }
    
    // $( function() {
    //     $( "#task_start_date" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    //     // $( "#event_end_date_nn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    //     // $( "#event_start_end_date_new" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    //     // $( "#event_start_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    //     // $( "#event_end_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    //     // $( "#event_start_end_date_neww" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
    // } );
    function resetSelectDrag()
    {
        $("#add-new-drag").modal('show');
        $("#add-new-drag").find("select[name=event_start_time]").select2().trigger('change');
        $("#add-new-drag").find("select[name=event_end_time]").select2().trigger('change');
    }    

    function reset_updateCalFrom()
    {
        //console.log('1');
        var updatecategoryForm = $(".update-category");
        updatecategoryForm.trigger("reset");
        updatecategoryForm.find('#event_start_end_date_select_update').load(document.URL + ' #event_start_end_date_select_update>*'); 
            updatecategoryForm.find('#selected_color_update').removeClass (function (index, css) {
             return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
            });
            updatecategoryForm.find('#event_color').val('');
            updatecategoryForm.find('#selected_color_update_text').html('Choose a color...');
        $("input[type=radio][name=update_check_value]").prop('checked', false);
        $('#update-event').modal('hide');
        $('#myModalUpdate').modal('hide');
    }

    function reset_updateOptions()
    {
        //console.log('1');
        $("input[type=radio][name=update_check_value]").prop('checked', false);
        $('#myModalUpdate').modal('hide');
    }

    function reset_deleteOptions()
    {
        //console.log('1');
        $("input[type=radio][name=delete_check_value]").prop('checked', false);
        $('#myModal').modal('hide');
    }

    //preview modal for attached file
    function PreviewMeetingFile(mfile,event_id){           
       var mfile = mfile;
       var event_id = event_id;
       // AJAX request
       $.ajax({
        url:  base_url+'front/preview_meeting_file',
        type: 'post',
        data: {mfile: mfile, event_id: event_id},
        success: function(data){ 
          // Add response in Modal body
          //console.log(data);
          $('#previewMeetingModal_Content').html(data);
          // Display Modal
          $('#previewMeetingModal').modal('show'); 
        }
      });
     }

    //for add file at time of create
    function display_add_mfile_button_create()
    {
        $('#add_mfile_but_create').show();
    }

    function add_mfile_button_create()
    {
        $('#add_mfile_but_create').hide();
        $('#mrabcloader2').show();
        var totalfiles = document.getElementById('mfile').files.length;
        //console.log(totalfiles);
        if(totalfiles == '0')
        {
            $('#mfileErr').html('Choose file(s) to Upload!');
            $('#add_mfile_but_create').show();
            $('#mrabcloader2').hide();
        }
        else
        {
            $('#mfileErr').html('');
            for (var index = 0; index < totalfiles; index++) 
            {
                var cnt = $('#cmf_cntVal').val();
                var cntVal = parseInt(cnt) + parseInt('1');
                $('#cmf_cntVal').val(cntVal);
                // console.log(cntVal);
                var f = document.getElementById("mfile").files[index];
                var fsize = f.size||f.fileSize;
                if(fsize > 2000000)
                {
                    //console.log('1');
                    $('#mfileErr').html('Oops Size is Large! It must be less than 2MB.');
                    $('#add_mfile_but_create').show();
                    $('#mrabcloader2').hide();
                    var fileHTML2 = '<li></li>';
                }
                else
                {
                    //console.log('2');
                    var reader = new FileReader();
                    //var fsrc = [];
                    reader.onload = function (event) {
                        var cnt2 = $('#cmf_cntVal2').val();
                        var cntVal2 = parseInt(cnt2) + parseInt('1');
                        $('#cmf_cntVal2').val(cntVal2);
                        // console.log(cntVal2);
                        $($.parseHTML('<input type="hidden" name="mfile_add_create[]" class="camf_no_'+cntVal2+'" id="getfi_id'+cntVal2+'">')).attr('value', event.target.result).appendTo('div.all_mfiles');
                        //fsrc.push(event.target.result);
                        //console.log(fsrc);
                    };

                    $($.parseHTML('<input type="hidden" name="mfile_add_create_fname[]" class="camf_no_'+cntVal+'" id="getfn_id'+cntVal+'">')).attr('value', document.getElementById("mfile").files[index].name).appendTo('div.all_mfiles_name');

                    reader.readAsDataURL(document.getElementById("mfile").files[index]);
                    
                    if(index == 0)
                    {
                        var fileHTML2 = '';
                    }                    

                    //console.log(fsrc);
                    var fileHTML2 = '<li class="camf_no_'+cntVal+'"><div class="row"><div class="col-8"><a href="javascript: void(0);" class="nameLink" onclick="return PreviewCreateMeetingAddedFile('+cntVal+')" title="Preview">'+document.getElementById("mfile").files[index].name+'</a></div><div class="col-4"><a href="javascript:void(0)" onclick="return RemoveCreateMeetingAddedFile('+cntVal+');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a><a href="javascript: void(0);" class="text-dark float-end" onclick="return PreviewCreateMeetingAddedFile('+cntVal+')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a></div></div></li>'.concat(fileHTML2);
                }
            }

            $('.display_all_maddfiles_li').prepend(fileHTML2);
            $('#mfile').val('');
            $('#add_mfile_but_create').hide();
            $('#mrabcloader2').hide();
        }
    }

    function RemoveCreateMeetingAddedFile(val)
    {
        var val = val;
        //console.log(val);
        Swal.fire({
          title: "Are you sure?",
          text: "You want to Remove this File!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#c7df19",
          cancelButtonColor: "#383838",
          confirmButtonText: "Yes"
          }).then(function (result) {
              if (result.value) {
                $('.camf_no_'+val).remove();
                Swal.fire("Removed!", "Successfully.", "success");
              }
          });         
    }

    function PreviewCreateMeetingAddedFile(id)
    {
        var id = id;
        var finfo = $('#getfi_id'+id).val();
        var fname = $('#getfn_id'+id).val();
        //console.log(finfo);
        //console.log(fname);
        var ext = fname.split('.').pop();

        if(ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG' || ext == 'png' || ext == 'PNG' || ext == 'svg' || ext == 'SVG' || ext == 'webp' || ext == 'WEBP')
        {
            $('#previewCAddedMeetingModal_Content').html('<img src="'+finfo+'" height="100%" width="100%">');
        }
        else if(ext == 'pdf' || ext == 'PDF' || ext == 'gif' || ext == 'GIF' || ext == 'txt' || ext == 'TXT')
        {
            $('#previewCAddedMeetingModal_Content').html('<iframe src="'+finfo+'" height="100%" width="100%"></iframe>');
        }
        else if(ext == 'mp4' || ext == 'MP4' || ext == 'mov' || ext == 'MOV' || ext == 'webm' || ext == 'WEBM' || ext == 'mkv'  || ext == 'MKV')
        {
            $('#previewCAddedMeetingModal_Content').html('<video height="100%" width="100%" controls autoplay><source src="'+finfo+'"></video>');
        }
        else
        {
            $('#previewCAddedMeetingModal_Content').html('<div class="col-md-4"></div><div class="col-md-4"><div class="card"><img class="card-img-top img-fluid" src="./assets/images/invalid.png"><div class="card-body"><p class="card-text font-size-15"><strong>Cannot view this file!</strong></p></div></div></div><div class="col-md-4"></div>');
        }
        // else if(ext == 'csv' || ext == 'CSV')
        // {
        //     $('#previewCAddedMeetingModal_Content').html('<iframe src="https://docs.google.com/viewer?embedded=true&url='+finfo+'" width="100%" height="100%" allowfullscreen webkitallowfullscreen></iframe>');
        // }
        // else
        // {
        //     $('#previewCAddedMeetingModal_Content').html('<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='+finfo+'" width="100%" height="100%" allowfullscreen webkitallowfullscreen></iframe>');
        // }        
        // Display Modal
        $('#previewCAddedMeetingModal').modal('show'); 
    }

    function close_previewCAddedMeetingModal()
    {
        $('#previewCAddedMeetingModal').modal('hide'); 
    }

    // function add_mfile_button_create()
    // {
    //     $('#add_mfile_but_create').hide();
    //     $('#mrabcloader2').show();

    //     var totalfiles = document.getElementById('mfile').files.length;
    //     //console.log(totalfiles);
    //     if(totalfiles == '0')
    //     {
    //         $('#mfileErr').html('Choose file(s) to Upload!');
    //         $('#add_mfile_but_create').show();
    //         $('#mrabcloader2').hide();
    //     }
    //     else
    //     {
    //         $('#mfileErr').html('');
    //         var name = document.getElementById("mfile").files[0].name;
    //         //var form_data = new FormData();
    //         var fileHTML1 ='<ul class="list-unstyled fw-medium refresh_pcf_remove">'; 
    //         for (var index = 0; index < totalfiles; index++) 
    //         {
    //             var mfile_add_create = document.getElementById("mfile_add_create").value;
    //             var selfile = document.getElementById('mfile').files[index];
    //             //form_data.append("mfile[]", selfile);
    //             if(mfile_add_create == '')
    //             {
    //                 var new_value = selfile.name;
    //             }
    //             else
    //             {
    //               var new_value = mfile_add_create + ',' +selfile.name;  
    //             }                
    //             $("#mfile_add_create").val(new_value);
    //             var fileHTML2 = '<li><div class="row"><div class="col-8">'+selfile.name+'</div><div class="col-4"></div></div></li>';
    //         }        
    //         var fileHTML3 = '</ul>';
    //         var fileHTML = fileHTML1.concat(fileHTML2);
    //         var newfileHTML = fileHTML.concat(fileHTML3);
    //         $('.refresh_display_maddfiles').append(newfileHTML);
    //         $('#add_mfile_but_create').show();
    //         $('#mrabcloader2').hide();
    //     }
    // }
    //for add file at time of create

    //for add file at time of update
    function display_add_mfile_button()
    {
        $('#add_mfile_but').show();
    }

    function add_mfile_button()
    {
        $('#add_mfile_but').hide();
        $('#mrabloader2').show();
        var totalfiles = document.getElementById('mfile_up').files.length;
        //console.log(totalfiles);
        if(totalfiles == '0')
        {
            $('#mfileupErr').html('Choose file(s) to Upload!');
            $('#add_mfile_but').show();
            $('#mrabloader2').hide();
        }
        else
        {
            $('#mfileupErr').html('');
            var name = document.getElementById("mfile_up").files[0].name;
            var event_id = document.getElementById("event_id").value;
            var mfile_old = document.getElementById("mfile_old_up").value;
            var form_data = new FormData();

            for (var index = 0; index < totalfiles; index++) 
            {
                form_data.append("mfile[]", document.getElementById('mfile_up').files[index]);
            }        
               form_data.append('event_id',event_id);
               form_data.append('mfile_old',mfile_old);
           $.ajax({
            url:base_url+'front/add_meeting_file',
            method:"POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                  if(data.status == 'file_uploadSizeErr')
                  {
                    $('#mfileupErr').html('Oops Size is Large! It must be less than 2MB.');
                    $('#add_mfile_but').show();
                    $('#mrabloader2').hide();
                  }
                  else if(data.status == 'Error_Uploading')
                  {
                    $('#mfileupErr').html('File Uploading Error! Please Try Again!');
                    $('#add_mfile_but').show();
                    $('#mrabloader2').hide();           
                  }
                  else
                  {
                       //debugger;
                       console.log(data);
                       $('#mfile_up').val('');
                       $('#mfile_old_up').val(data.meeting_old_files_up);
                       $('.refresh_remove_mdelfiles').html(data.all_files);
                       $('#add_mfile_but').hide();
                       $('#mrabloader2').hide();
                       //$('.preview-platform').modal('hide');
                   } 
                 }
           });
        }
    }
    //for add file at time of update

    //delete mfile
    function delete_meeting_file(index_id,event_id)
    {  
     var index_id = index_id;
     var event_id = event_id;
       Swal.fire({
         title: "Are you sure?",
         text: "You want to Delete File",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#c7df19",
         cancelButtonColor: "#383838",
         confirmButtonText: "Yes"
         }).then(function (result) {
             if (result.value) {
               // AJAX request
                $.ajax({
                 url:  base_url+'front/delete_meeting_file',
                 type: 'post',
                 data: {index_id: index_id, event_id: event_id},
                 success: function(data){
                   //debugger;
                   console.log(data);
                   $('#mfile_old_up').val(data.meeting_old_files_up);
                   Swal.fire("Deleted!", "Successfully.", "success");
                   $('.refresh_remove_mdelfiles').html(data.all_files);
                   //$('.preview-platform').modal('hide'); 
                 }
               });
             }
         });      
    }

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

    function change_end_time_drag(value)
    {
        //console.log(value);
        $(".changed_end_time_drag").find('option').removeAttr("selected");
        $(".changed_end_time_drag option:contains(" + value + ")").attr('selected', 'selected');
        $(".changed_end_time_drag").val(value).change();
    }

    function change_end_time_drag_up(value)
    {
        //console.log(value);
        $(".changed_end_time_drag_up").find('option').removeAttr("selected");
        $(".changed_end_time_drag_up option:contains(" + value + ")").attr('selected', 'selected');
        $(".changed_end_time_drag_up").val(value).change();
    }
    //change end time according to start time

    $('.meeting_members_dd').select2({
      closeOnSelect: false,
      /* Sort data using localeCompare- task assignee alphabetical order  */
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
    });
</script>   
<script>
    tinymce.init({
      selector: 'textarea#meeting_agenda',
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 400,
      toolbar_mode: 'sliding',
      statusbar: false,
    });

    tinymce.init({
      selector: 'textarea#meeting_agenda_up',
      plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount contextmenu',
      contextmenu: 'copy cut paste | link inserttable | cell row column deletetable',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
      width: "100%",
      height: 400,
      toolbar_mode: 'sliding',
      statusbar: false
    });
  </script>
  
    </body>

</html>