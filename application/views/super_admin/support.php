<?php
$page = 'support';
?>
<!doctype html>
<html lang="en">
    <head>      
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Ticket Management | Decision168 Super-Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Emoji Data -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/emoji/css/jquery.emojipicker.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/emoji/css/jquery.emojipicker.tw.css">

        <?php
        include('header_links.php');
        ?>
        <style type="text/css">
            .chat-notification{
                position: relative;
                top: -10px;
                right: 16px;
            }
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
            td{
             max-width: 200px;
             overflow: hidden;
             text-overflow: ellipsis;
             white-space: nowrap;
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
                                        <div class="col-12">
                                            <h4 class="mb-sm-0 font-size-18">Ticket Management</h4>
                                        </div>
                                    </div>
                                    <div class="page-title-center">
                                        <div class="row d-block d-sm-none">
                                            <div class="col-6"></div>
                                            <div class="col-6">
                                                <div class="btn-group me-1 mt-2">
                                                    <button class="btn btn-d btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Filter By <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="all_ticket2" onclick="return ticket_filter2();" checked>
                                                        <label class="form-check-label">All</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="open_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Open</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="assigned_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Assigned</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="in_progress_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">In Progress</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="in_review_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">In Review</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="pending_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Pending</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="resolved_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Resolved</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="closed_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Closed</label></a>
                                                        <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_ticket2" type="radio" id="cancelled_ticket2" onclick="return ticket_filter2();">
                                                        <label class="form-check-label">Cancelled</label></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">
                                                <div class="row">
<div class="col-2 d-none d-sm-block" style="padding: 0px"> 
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
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="all_ticket" onclick="return ticket_filter();" checked>
                                            <label class="form-check-label">All</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="text-center">
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="open_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Open</label>
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
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="assigned_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Assigned</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="text-center">
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="in_progress_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">In Progress</label>
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
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="in_review_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">In Review</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="text-center">
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="pending_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Pending</label>
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
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="resolved_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Resolved</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="text-center">
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="closed_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Closed</label>
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
                                            <input class="form-check-input" name="filter_ticket" type="radio" id="cancelled_ticket" onclick="return ticket_filter();">
                                            <label class="form-check-label">Cancelled</label>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-body my_ticket">
                                        <h4 class="card-title">All Tickets</h4>
                                        <div class="table-responsive">
                                            <table id="datatable-buttons1" class="table table-striped display dataTable" style="border: 1px #f5f5f5 solid;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Ticket ID</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Priority</th>
                                                        <th scope="col">Opened On</th>
                                                        <th scope="col">End Date</th>
                                                        <th scope="col">Assigned to</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                        <!-- <th scope="col">Closed/Cancelled On</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if($tickets_del){
                                                        foreach ($tickets_del as $td) {
                                                            $date_opened = date('Y-m-d',strtotime($td->opened_date));
                                                            $date_closed = '';
                                                            if($td->closed_date != '0000-00-00 00:00:00'){
                                                                $closed_date = date('Y-m-d',strtotime($td->closed_date));
                                                            }
                                                            $end_date = '';
                                                            if($td->end_date != '0000-00-00 00:00:00'){
                                                                $end_date = date('Y-m-d',strtotime($td->end_date));
                                                            }
                                                            if($td->cancelled_date != '0000-00-00 00:00:00'){
                                                                $cancelled_date = date('Y-m-d',strtotime($td->cancelled_date));
                                                            }
                                                            if($td->status == 'open'){
                                                                $ticket_status = 'open_ticket';
                                                            }else if($td->status == 'assigned'){
                                                                $ticket_status = 'assigned_ticket';
                                                            }else if($td->status == 'in progress'){
                                                                $ticket_status = 'in_progress_ticket';
                                                            }else if($td->status == 'in review'){
                                                                $ticket_status = 'in_review_ticket';
                                                            }else if($td->status == 'pending'){
                                                                $ticket_status = 'pending_ticket';
                                                            }else if($td->status == 'resolved'){
                                                                $ticket_status = 'resolved_ticket';
                                                            }else if($td->status == 'closed'){
                                                                $ticket_status = 'closed_ticket';
                                                            }else if($td->status == 'cancelled'){
                                                                $ticket_status = 'cancelled_ticket';
                                                            }
                                                            ?>
                                                            <tr class="<?php echo $ticket_status; ?> search-list">
                                                                <td>
                                                                    T-<?php echo $td->unique_id; ?>
                                                                    <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ticketOverviewModal(<?php echo $td->ticket_id; ?>)" title="Preview Ticket"><i class="mdi mdi-eye-outline"></i></a>
                                                                </td>
                                                                <td><?php echo $td->subject; ?></td>
                                                                <td><?php echo $td->priority; ?></td>
                                                                <td><span class="badge badge-soft-primary"><?php echo $date_opened; ?></span></td>
                                                                <td><span class="badge badge-soft-primary"><?php echo $end_date; ?></span></td>
                                                                <td class="assignee-row-<?php echo $td->ticket_id; ?>">
                                                                    <?php
                                                                    if($td->status == 'closed' || $td->status == 'cancelled' || $td->status == 'resolved'){
                                                                        $assg_del = $this->Superadmin_model->getStudentById($td->assignee);
                                                                        if($assg_del){
                                                                            echo $assg_del->first_name.' '.$assg_del->last_name;
                                                                        } 
                                                                    }else{
                                                                        ?>
                                                                        <select id="assign_supporter<?php echo $td->ticket_id; ?>" class="form-select select2 assign_supporter" onchange="return assignTicket(this.value,<?php echo $td->ticket_id; ?>);">
                                                                            <?php
                                                                            if($supporters){
                                                                                if($td->assignee == 0){ ?><option value="">Assign</option><?php }
                                                                                foreach ($supporters as $sp) {
                                                                                    ?>
                                                                                    <option value="<?php echo $sp->reg_id; ?>" <?php if($td->assignee == $sp->reg_id){ echo 'selected'; } ?> ><?php echo $sp->first_name.' '.$sp->last_name; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    
                                                                </td>
                                                                <td class="status-row-<?php echo $td->ticket_id; ?>">
                                                    <?php 
                                                    if($td->status == 'open'){
                                                        echo 'Open';
                                                    }else if($td->status == 'assigned'){
                                                        echo 'Assigned';
                                                    }else if($td->status == 'in progress'){
                                                        echo 'In Progress';
                                                    }else if($td->status == 'in review'){
                                                        echo 'In Review'; 
                                                    }else if($td->status == 'pending'){
                                                        echo 'Pending'; 
                                                    }else if($td->status == 'resolved'){
                                                        echo 'Resolved'; 
                                                    }else if($td->status == 'closed'){
                                                        echo 'Closed'; 
                                                    }else if($td->status == 'cancelled'){
                                                        echo 'Cancelled'; 
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <i title="Delete" class="fas fa-trash-alt mt-1 me-2 text-danger" style="cursor: pointer;" onclick="return deleteTicket(<?php echo $td->ticket_id; ?>);"></i>
                                                    <i title="Attachments" class="fas fa-paperclip mt-1 me-2" style="cursor: pointer;" onclick="return ticketAttachFilesModal(<?php echo $td->ticket_id; ?>);"></i>
                                                    <i title="Chat" class="fas fa-comments mt-1 me-2" style="cursor: pointer;" onclick="return ticketCommentModal(<?php echo $td->ticket_id; ?>);"></i>
                                                    <?php
                                                    $chat_count = $this->Superadmin_model->getTicketChatCount($td->ticket_id);
                                                    if($chat_count > 0){
                                                        ?>
                                                        <span class="badge bg-danger rounded-pill chat-notification" id="chat-notification<?php echo $td->ticket_id; ?>">
                                                            <?php echo $chat_count; ?>
                                                        </span>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <span class="chat-notification" id="chat-notification<?php echo $td->ticket_id; ?>"></span>
                                                        <?php
                                                    }
                                                    ?>                                                    
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

        
        <!-- Ticket Comment Modal -->
        <div id="ticketCommentModal" class="modal fade bs-example-modal-md" tabindex="-1" aria-labelledby="#ticketCommentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content" id="ticketCommentModal_content">
                    
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
        <!-- Required datatable js -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Datatable init js -->
        <script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>   
        <!-- form advanced init -->
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>

        <!-- Emoji Data -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/emoji/js/jquery.emojipicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/emoji/js/jquery.emojis.js"></script>
        <?php
        include('footer_links.php');
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#search-criteria-list').keyup(function(){
                    $('.search-list').hide();
                    $('.search-cards').hide();
                    $('#search-clear-list').css('display','block');
                    var txt = $('#search-criteria-list').val();
                    if($('.all-data').hasClass('active_searched'))
                    {
                        $('.active_searched').each(function(){
                           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                               $(this).show();
                           }
                        });
                    }
                    else
                    {
                       $('.search-list').each(function(){
                           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                               $(this).show();
                           }
                        }); 
                       $('.search-cards').each(function(){
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
                        $('.search-cards').show();
                        $('#search-clear-list').css('display','none');  
                    }            
                });
            });

            $('#ticketCommentModal').on('mouseenter', function (e){
                //debugger;
                $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));
            });
        </script>
    </body>
</html>
