<?php
$page = 'support';
?>
<!doctype html>
<html lang="en">
    <head>      
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Ticket Overview | Decision168 Super-Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- Emoji Data -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/emoji/css/jquery.emojipicker.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/emoji/css/jquery.emojipicker.tw.css">

        <?php
        include('header_links.php');
        ?>
        <style type="text/css">
            .ticket-modal .form-select{
                display: inline-block;
            }
            .ticket-modal .select2-container{
                width: 50% !important;
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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <h4 class="mb-sm-0 font-size-18">Overview</h4>
                                        </div>
                                        <div class="col-9">
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
                        ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ticket-modal">
                                            <div class="media">
                                                <div class="avatar-sm me-4">
                                                    <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                    <i class="bx bx-support"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body overflow-hidden">
                                                    <span><h5 class="font-size-15" style="padding: 6px 0;">
                                                        <strong>TICKET:</strong> <b>T-<?php echo $tickets_del->unique_id; ?></b>
                                                    </h5>
                                                    <small><strong>Opened On:</strong>
                                                        <?php
                                                        $date_opened = date('dS M Y',strtotime($tickets_del->opened_date));
                                                        echo $date_opened;
                                                        ?>
                                                    </small>
                                                </span>

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <p>
                                                        <i class="fas fa-align-left align-middle me-1 text-d"></i>
                                                        <strong>Subject:</strong> <?php echo $tickets_del->subject; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>
                                                        <i class="fas fa-align-left align-middle me-1 text-d"></i>
                                                        <strong>Description:</strong> <br>
                                                        <span class="ml-25 pdes"><?php echo $tickets_del->description; ?></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-exclamation-triangle align-middle me-1 text-d"></i>
                                                        <strong>Type:</strong> <?php echo $tickets_del->type; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-sort-amount-up align-middle me-1 text-d"></i>
                                                        <strong>Priority:</strong> <?php echo $tickets_del->priority; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-user-plus align-middle me-1 text-d"></i>
                                                        <strong>Created By:</strong> 
                                                        <?php
                                                        if($tickets_del->created_by != 0){
                                                            $stud_del = $this->Superadmin_model->getStudentById($tickets_del->created_by);
                                                            echo $stud_del->first_name.' '.$stud_del->last_name;
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-calendar-check align-middle me-1 text-d"></i>
                                                        <strong>Created On:</strong> 
                                                        <?php
                                                        if($tickets_del->opened_date != '0000-00-00 00:00:00'){
                                                            $opened_date = date('dS M Y',strtotime($tickets_del->opened_date));
                                                            echo $opened_date;
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-user-cog align-middle me-1 text-d"></i>
                                                        <strong>Assignee: </strong>
                                                        <span class="assignee-row-<?php echo $tickets_del->ticket_id; ?>">
                                                        <?php
                                                        if($tickets_del->status == 'closed' || $tickets_del->status == 'cancelled' || $tickets_del->status == 'resolved'){
                                                            $assg_del = $this->Superadmin_model->getStudentById($tickets_del->assignee);
                                                            if($assg_del){
                                                                echo $assg_del->first_name.' '.$assg_del->last_name;
                                                            }                                    
                                                        }else{
                                                            ?>
                                                            <select id="assign_supporter" class="form-select select2" onchange="return assignTicket(this.value,<?php echo $tickets_del->ticket_id; ?>);">
                                                                <?php
                                                                if($tickets_del->assignee == 0){ ?><option value="">Assign</option><?php }
                                                                if($supporters){
                                                                    foreach ($supporters as $sp) {
                                                                        ?>
                                                                        <option value="<?php echo $sp->reg_id; ?>" <?php if($tickets_del->assignee == $sp->reg_id){ echo 'selected'; } ?> ><?php echo $sp->first_name.' '.$sp->last_name; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php
                                                        }
                                                        ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-calendar-check align-middle me-1 text-d"></i>
                                                        <strong>Assigned On:</strong> 
                                                        <?php
                                                        if($tickets_del->assigned_date != '0000-00-00 00:00:00'){
                                                            $assigned_date = date('dS M Y',strtotime($tickets_del->assigned_date));
                                                            echo $assigned_date;
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p><i class="fas fa-user-check align-middle me-1 text-d"></i>
                                                    <strong>Assigned By:</strong> 
                                                        <?php
                                                        if($tickets_del->assigned_by != 0 && $tickets_del->assignee != 0){
                                                            $stud_del = $this->Superadmin_model->getStudentById($tickets_del->assigned_by);
                                                            echo $stud_del->first_name.' '.$stud_del->last_name;
                                                        }else if($tickets_del->assigned_by == 0 && $tickets_del->assignee != 0){
                                                            echo 'Support Admin';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <?php
                                                if($tickets_del->assignee_comment != ""){
                                                    ?>
                                                    <div class="col-md-12">
                                                        <p>
                                                            <i class="fas fa-comment-dots align-middle me-1 text-d"></i>
                                                            <strong>Assignee Comment:</strong> 
                                                            <?php
                                                            if($tickets_del->assignee_comment != ""){
                                                                echo $tickets_del->assignee_comment;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fas fa-toggle-on align-middle me-1 text-d"></i>
                                                        <strong>Status:</strong> 
                                                        <span class="status-row-<?php echo $tickets_del->ticket_id; ?>">
                                                            <?php 
                                                            if($tickets_del->status == 'open'){
                                                                echo 'Open';
                                                            }else if($tickets_del->status == 'assigned'){
                                                                echo 'Assigned';
                                                            }else if($tickets_del->status == 'in progress'){
                                                                echo 'In Progress';
                                                            }else if($tickets_del->status == 'in review'){
                                                                echo 'In Review'; 
                                                            }else if($tickets_del->status == 'pending'){
                                                                echo 'Pending'; 
                                                            }else if($tickets_del->status == 'resolved'){
                                                                echo 'Resolved'; 
                                                            }else if($tickets_del->status == 'closed'){
                                                                echo 'Closed'; 
                                                            }else if($tickets_del->status == 'cancelled'){
                                                                echo 'Cancelled'; 
                                                            }
                                                            ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <?php
                                                if($tickets_del->status == 'resolved'){
                                                    ?>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
                                                            <strong>Resolved On:</strong> 
                                                            <?php
                                                            if($tickets_del->resolved_date != '0000-00-00 00:00:00'){
                                                                $resolved_date = date('dS M Y',strtotime($tickets_del->resolved_date));
                                                                echo $resolved_date;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                }else if($tickets_del->status == 'closed'){
                                                    ?>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
                                                            <strong>Closed On:</strong> 
                                                            <?php
                                                            if($tickets_del->closed_date != '0000-00-00 00:00:00'){
                                                                $closed_date = date('dS M Y',strtotime($tickets_del->closed_date));
                                                                echo $closed_date;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                }else if($tickets_del->status == 'cancelled'){
                                                    ?>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
                                                            <strong>Cancelled On:</strong> 
                                                            <?php
                                                            if($tickets_del->cancelled_date != '0000-00-00 00:00:00'){
                                                                $cancelled_date = date('dS M Y',strtotime($tickets_del->cancelled_date));
                                                                echo $cancelled_date;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-10">Attached Files</h4>
                                            <?php
                                            if($tickets_del->attached_files != ""){
                                                ?>
                                                <div data-simplebar style="max-height: 200px;"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-nowrap align-middle table-hover mb-0">
                                                            <tbody>
                                                                <?php 
                                                                if($tickets_del->attached_files != ""){
                                                                    $file_array = explode(',', $tickets_del->attached_files);
                                                                    foreach ($file_array as $fa) {
                                                                        ?>
                                                        <tr>
                                                            <td style="width: 20px;">
                                                                <div class="avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                        <i class="bx bx-file"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-size-14">
                                                                    <a href="javascript: void(0);" class="nameLink" title="<?php echo $fa; ?>" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview">
                                                                        <?php
                                                                        if(strlen($fa)>45)
                                                                        {
                                                                            print(substr($fa,0,45)."...");
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $fa;
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <a href="<?php echo base_url().'superadmin/download_TicketFileAttachment/'.$fa.'/'.$tickets_del->ticket_id; ?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                                                    <a href="javascript: void(0);" class="nameLink float-end" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
                                                                </div>
                                                            </td>
                                                                        <?php
                                                                    }
                                                                } 
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Chat Section</h4>
                                                <div class="w-100 user-chat">
                                                    <div class="card">
                                                        <div id="scrollbottom_tmodal" class="chat-conversation p-2">
                                                            <ul class="list-unstyled mb-0" data-simplebar style="max-height: 300px;">
                                                                <?php
                                                                $data = array(  'notify' => 1,
                                                                                'notify_date' => date('Y-m-d H:i:s')
                                                                             );
                                                                $this->Superadmin_model->update_ticket_chat_notify($data,$tickets_del->ticket_id);
                                                                
                                                                $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                                                if($ticket_chat){
                                                                    $tm_cnt=1;
                                                                    $comment_date = "";
                                                                    foreach ($ticket_chat as $tm) {
                                                                        $stud_del = $this->Superadmin_model->getStudentById($tm->user_id);
                                                                        $message_date = date('g:i A',strtotime($tm->message_date));
                                                                        $msg_date = date("Y-m-d", strtotime($tm->message_date));
                                                                        if($msg_date == $comment_date)
                                                                        {
                                                                            echo '';
                                                                        }
                                                                        elseif($msg_date == date("Y-m-d"))
                                                                        {
                                                                        ?>
                                                                        <li> 
                                                                            <div class="chat-day-title">
                                                                                <span class="title">Today</span>
                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                        }
                                                                        elseif($msg_date == date("Y-m-d",strtotime("-1 days")))
                                                                        {
                                                                        ?>
                                                                        <li> 
                                                                            <div class="chat-day-title">
                                                                                <span class="title">Yesterday</span>
                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <li> 
                                                                            <div class="chat-day-title">
                                                                                <span class="title"><?php echo date("j M, Y", strtotime($tm->message_date));?></span>
                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                        }
                                                                        if($tm->user_role == 'user'){
                                                                            ?>
                                                                            <li id="ticket_message<?php echo $tm->chat_id; ?>">
                                                                                <?php
                                                                                if($tm->status == 'active'){
                                                                                    ?>
                                                                                    <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(User)</small></div>
                                                                                            <p>
                                                                                                <?php 
                                                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                                                echo $ticket_message; 
                                                                                                ?>
                                                                                            </p>
                                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                }else{
                                                                                   ?>
                                                                                   <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(User)</small></div>
                                                                                            <p><i><i class="mdi mdi-block-helper"></i> This message was deleted</i></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php 
                                                                                }
                                                                                ?>
                                                                            </li>
                                                                            <?php
                                                                        }else if($tm->user_role == 'supporter'){
                                                                            ?>
                                                                            <li id="ticket_message<?php echo $tm->chat_id; ?>">
                                                                                <?php
                                                                                if($tm->status == 'active'){
                                                                                    ?>
                                                                                    <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(Supporter)</small></div>
                                                                                            <p>
                                                                                                <?php 
                                                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                                                echo $ticket_message; 
                                                                                                ?>
                                                                                            </p>
                                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                }else{
                                                                                   ?>
                                                                                   <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(Supporter)</small></div>
                                                                                            <p><i><i class="mdi mdi-block-helper"></i> This message was deleted</i></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php 
                                                                                }
                                                                                ?>
                                                                            </li>
                                                                            <?php
                                                                        }else if($tm->user_role == 'superadmin'){
                                                                            ?>
                                                                            <li class="right" id="ticket_message<?php echo $tm->chat_id; ?>">
                                                                                <?php
                                                                                if($tm->status == 'active'){
                                                                                    ?>
                                                                                    <div class="conversation-list">
                                                                                        <div class="dropdown">
                                                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                                              </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" onclick="return delete_ticket_chat('<?php echo $tm->chat_id; ?>');" href="javascript:void(0);">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name">Support Admin</div>
                                                                                            <p>
                                                                                                <?php 
                                                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                                                echo $ticket_message; 
                                                                                                ?>
                                                                                            </p>
                                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                }else{
                                                                                    ?>
                                                                                    <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="conversation-name">Support Admin</div>
                                                                                            <p>
                                                                                                <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                                                                            </p>
                                                                                            <p class="chat-time mb-0 text-muted"></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </li> 
                                                                            <?php
                                                                        }
                                                                        $comment_date = $msg_date;
                                                                        $tm_cnt++;                            
                                                                    }
                                                                }else{
                                                                    ?>
                                                                    <p class="text-muted p-2 no_ticket_message">No message...</p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="p-2 chat-input-section">
                                                            <?php
                                                            if($tickets_del->status == 'cancelled' || $tickets_del->status == 'closed'){
                                                                ?>
                                                                <span class="text-muted mt-4">Ticket is <?php echo $tickets_del->status; ?>..</span> &nbsp;&nbsp;
                                                                <?php
                                                                $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                                                if($ticket_chat){
                                                                ?>
                                                                    <button type="button" onclick="window.location='<?php echo base_url('super-admin/download-chat/'.$tickets_del->ticket_id); ?>'"; class="btn btn-sm btn-d waves-effect waves-light float-end"><span class="d-none d-sm-inline-block me-2">Download Chat</span> <i class="mdi mdi-download"></i></button>
                                                                    <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                <form method="post" class="ticket_chat_form" id="ticket_chat_form" enctype="multipart/form-data" autocomplete="off">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="position-relative">
                                                                                <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Message..." required="">                                            
                                                                                <span id="messageErr" class="text-danger"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $tickets_del->ticket_id; ?>">

                                                                            <?php
                                                                            $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                                                            if($ticket_chat){
                                                                            ?>
                                                                                <button type="button" onclick="window.location='<?php echo base_url('super-admin/download-chat/'.$tickets_del->ticket_id); ?>'"; class="btn btn-sm btn-d waves-effect waves-light mt-2"><span class="d-none d-sm-inline-block me-2">Download Chat</span> <i class="mdi mdi-download"></i></button>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                            <button type="submit" id="ticket_chat_button" class="btn btn-sm btn-d chat-send waves-effect waves-light float-end mt-2"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <p class="download-content" style="display: none;"><?php
                                                        $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                                        if($ticket_chat){
                                                            foreach ($ticket_chat as $tm) {
                                                                $supp_del = $this->Superadmin_model->getStudentById($tm->user_id);
                                                                if($tm->status == 'active'){
                                                                    if($tm->user_role == 'supporter'){
                                                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name."(Supporter): ".$tm->message."\r\n"; 
                                                                    }
                                                                    else if($tm->user_role == 'superadmin'){
                                                                        echo $tm->message_date." - Support Admin: ".$tm->message."\r\n"; 
                                                                    }
                                                                    else{
                                                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name."(User): ".$tm->message."\r\n"; 
                                                                    }
                                                                }else{
                                                                    if($tm->user_role == 'supporter'){
                                                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name.": This message was deleted\r\n";
                                                                    }
                                                                    else if($tm->user_role == 'superadmin'){
                                                                        echo $tm->message_date." - Support Admin: You deleted this message\r\n";
                                                                    }
                                                                    else{
                                                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name.": This message was deleted\r\n";
                                                                    }   
                                                                }                  
                                                            }
                                                        }
                                                        ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <?php
                        if($view_history_date)
                        {
                        ?>
                        <div class="card">
                            <div class="card-body" data-simplebar style="max-height: 500px;">
                                <button type="button" class="btn btn-d btn-sm" data-bs-toggle="modal" data-bs-target="#pdf_format_date_options" style="float: right;">
                                    Export To PDF
                                </button>
                                <h4 class="card-title mb-5">Ticket History</h4>
                                
                                <ul class="verti-timeline list-unstyled">
                                    <?php
                                    $prev_date ='';
                                    foreach($view_history_date as $v)
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_ticket_hlist('<?php echo $tickets_del->ticket_id; ?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Today - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_ticket_hlist('<?php echo $tickets_del->ticket_id; ?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo 'Yesterday - '.date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
                                                <h5 class="font-size-14 card-title"><a href="javascript:void(0)" onclick="return display_ticket_hlist('<?php echo $tickets_del->ticket_id; ?>','<?php echo $v->DateOnly;?>');" class="text-dark"><?php echo date("D, F d, Y", strtotime($v->DateOnly));?></a></h5>
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
        <!-- Export to PDF Format Modal -->
        <div class="modal fade" id="pdf_format_date_options" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <h5 class="modal-title" id="staticBackdropLabel">Select Any One Option</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="history_pdf_format_form" name="history_pdf_format_form" autocomplete="off">
                        <div class="modal-body">                   
                            <div class="mb-2 row">
                                <label class="col-md-2 col-form-label">Date :</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" class="form-control" placeholder="Date" data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" id="only_date" name="only_date">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->  
                                </div>
                            </div>
                            <div class="m-2 text-center">
                                <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light">OR</button>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-md-2 col-form-label">Range :</label>
                                <div class="col-md-10">
                                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                          <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" />
                                          <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" />
                                    </div>
                                </div>
                            </div>
                            <div class="m-2 text-center">
                                <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light">OR</button>
                            </div>
                            <div class="m-1 row">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="all_history" id="all_history" value="1">
                                    <label class="form-check-label">
                                        All History
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="m-1 row">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="chat_history" id="chat_history" value="1">
                                    <label class="form-check-label" for="chat_history">
                                        Chat History
                                    </label>
                                </div>
                            </div>
                                    <input type="hidden" name="ticket_id" value="<?php echo $tickets_del->ticket_id; ?>">
                                    <input type="hidden" name="unique_id" value="T-<?php echo $tickets_del->unique_id; ?>">
                                    <span id="empty_optionErr" class="text-danger"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="history_pdf_format_button" name="history_pdf_format_button" class="btn btn-d">Export To PDF</button>
                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                        </div>                
                    </form>
                </div>
            </div>
        </div> 
        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 

        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- form advanced init -->
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>

        <!-- Emoji Data -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/emoji/js/jquery.emojipicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/emoji/js/jquery.emojis.js"></script>

        <?php
        include('footer_links.php');
        ?>
        <script type="text/javascript">
        function supporter_members()
        {
           var selected = [];
          for (var option of document.getElementById('supporter_member').options) {
            if (option.selected) {
              selected.push(option.value);
            }
          }
         
          document.getElementById("selected_S_member").value = selected;
        }

        function delete_ticket_chat(chat_id)
        { 
        //debugger;  
          var chat_id = chat_id; 
            Swal.fire({
              title: "Are you sure?",
              text: "You want to Delete the Chat",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#c7df19",
              cancelButtonColor: "#383838",
              confirmButtonText: "Yes"
              }).then(function (result) {
                  if (result.value) {
                    // AJAX request
                     $.ajax({
                      url:  base_url+'superadmin/delete_ticket_chat',
                      type: 'post',
                      data: {chat_id: chat_id},
                      success: function(data){ 
                        $('#ticket_message'+chat_id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Support Admin</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');
                      }
                    });
                  }
              });       
        }

        function saveFile()
        {
            // Get the data from each element on the form
            var msg = $('.download-content').html();
            
            // This variable stores all the data.
            var data = msg;
            
            // Convert the text to BLOB.
            let textToBLOB = new Blob([data], {type: 'text/html'});
            let sFileName = 'chat-T<?php echo $tickets_del->unique_id; ?>.txt';      // The file to save the data.

            var newLink = document.createElement("a");
            newLink.download = sFileName;

            if (window.webkitURL != null) {
                newLink.href = window.webkitURL.createObjectURL(textToBLOB);
            }
            else {
                newLink.href = window.URL.createObjectURL(textToBLOB);
                newLink.style.display = "none";
                document.body.appendChild(newLink);
            }

            newLink.click(); 
        }
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));

                $('#ticket_chat_form').on('submit',function(event){    
                    event.preventDefault(); // Stop page from refreshing
                    $('#ticket_chat_button').hide();
                    $('#loader2').css('visibility','visible');
                    var formData = new FormData(this); 
                    $.ajax({
                      url:base_url+'superadmin/insert_ticket_chat',
                      type:"POST",
                      data:formData,
                      contentType:false,
                      processData:false,
                      cache:false,
                      success: function(data){
                        $('#ticket_chat_button').show();
                        $('#loader2').css('visibility','hidden'); 
                        if (data.status == false)
                        {
                            //show errors
                            $('[id*=Err]').html('');
                            $.each(data.errors, function(key, val) {
                                var key =key.replace(/\[]/g, '');
                                key=key+'Err';
                                //console.log(key);    
                                $('#'+ key).html(val);
                            }) 
                        }
                        else{ 
                            $('.no_ticket_message').hide();
                            $('#ticket_chat_form').trigger('reset');
                            $('#ticketCommentModal_content').html(data);
                            $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));
                            window.location.reload();
                        }
                        // console.log(data);
                    }// success msg ends here
                 });
                });

                $('#message').emojiPicker({
                    position: 'left',
                    width: '100%',
                    height: '230px'
                });

            });
        </script>
    </body>
</html>