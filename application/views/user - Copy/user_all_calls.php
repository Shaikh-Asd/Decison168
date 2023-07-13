<?php
$page = 'user-all-calls'; 
?>
<!doctype html>
<html lang="en">    
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>All Calls</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Stripe JavaScript library -->
        <script src="https://js.stripe.com/v3/"></script>
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
                                        <div class="col-12">
                                            <h4 class="mb-sm-0 font-size-18">All Calls</h4>
                                        </div>
                                    </div>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">
                                                <div class="row">
                                                    <div class="col-2" style="padding: 0px"> 
                                                        <i class="mdi mdi-filter h3 float-end mt-1" style="cursor: pointer;" id="filter_files" onclick="return show_FilterOptions();"></i>
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
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="all" checked>
                       <label class="form-check-label">All</label>
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
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="pending">
                       <label class="form-check-label">Pending</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="text-center">
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="accepted">
                       <label class="form-check-label">Accepted</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="text-center">
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="rejected">
                       <label class="form-check-label">Declined</label>
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
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="done-calls">
                       <label class="form-check-label">Done Calls</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="text-center">
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="today-calls">
                       <label class="form-check-label">Today's Calls</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="text-center">
                       <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="upcoming-calls">
                       <label class="form-check-label">Upcoming Calls</label>
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
                                        <h4 class="card-title">All Calls</h4>
                                        <div class="table-responsive">
                                            <table id="datatable-buttons1" class="table table-striped display dataTable" style="border: 1px #f5f5f5 solid;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Decision Maker</th>
                                                        <th scope="col">Call Duration</th>
                                                        <th scope="col">On Date</th>
                                                        <th scope="col">On Time</th>
                                                        <th scope="col">Call Rate</th>
                                                        <th scope="col">Payment</th>
                                                        <th scope="col">Video Call</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Booked On</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if($request){
                                                        $req_cnt=1;
                                                        foreach ($request as $req) {

                                                            $cm_id = $req->cm_id;
                                                            $expert_id = $req->expert_id;
                                                            $call_rate_del = $this->Front_model->callRateByCId($cm_id,$expert_id);
                                                            $min_del = $this->Front_model->callMinutesById($cm_id);

                                                            if($min_del->minute == 'Quick - 15 Min'){
                                                                $duration = '15 minute';
                                                            }else if($min_del->minute == 'Regular - 30 Min'){
                                                                $duration = '30 minute';
                                                            }else if($min_del->minute == 'Extra - 45 Min'){
                                                                $duration = '45 minute';
                                                            }else if($min_del->minute == 'All Access - 60 Min'){
                                                                $duration = '60 minute';
                                                            }else if($min_del->minute == 'VIP - 75 Min'){
                                                                $duration = '75 minute';
                                                            }else if($min_del->minute == 'Bonus - 90 Min'){
                                                                $duration = '90 minute';
                                                            }

                                                            $date_time = $req->booking_date.' '.$req->book_time;

                                                            $db_date_time = date('Y-m-d H:i', strtotime($date_time));

                                                            $af_date_time = date('Y-m-d H:i', strtotime($date_time .' + '.$duration));

                                                            $nw_date_time = date('Y-m-d H:i');

                                                            $db_date = date('Y-m-d', strtotime($date_time));
                                                            $nw_date = date('Y-m-d');

                                                            if($db_date == $nw_date)
                                                            {
                                                                $status1 = 'today-calls';
                                                            }else{
                                                                $status1 = '';
                                                            }
                                                            if($db_date > $nw_date)
                                                            {
                                                                $status2 = 'upcoming-calls';
                                                            }else{
                                                                $status2 = '';
                                                            }
                                                            if($db_date_time < $nw_date_time)
                                                            {
                                                                $status3 = 'done-calls';
                                                            }else{
                                                                $status3 = '';
                                                            }

                                                            if($req->expert_approval == 1){
                                                                $status4 = 'accepted-request';
                                                            }else if($req->expert_approval == 0 && $req->reject_reason != ""){
                                                                $status4 = 'rejected-request';
                                                            }else{
                                                                $status4 = 'pending-request';
                                                            }
                                                            ?>
                                                            <tr class="search-list <?php echo $status1; ?> <?php echo $status2; ?> <?php echo $status3; ?> <?php echo $status4; ?>">
                                                                <td>
                                                                    <?php
                                                                    $assg_del = $this->Front_model->getStudentById($req->expert_id);
                                                                        if($assg_del){
                                                                            echo ucwords($assg_del->first_name.' '.$assg_del->last_name);
                                                                        } 
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $min_del->minute; ?></td>
                                                                <td><?php echo $req->booking_date; ?></td>
                                                                <td><?php echo $req->book_time; ?></td>
                                                                <td>$<?php echo $call_rate_del->call_rate; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if($req->paid == 0){
                                                                        if($req->expert_approval == 1){
                                                                            ?>
                                                                            <form class="make_payment" method="POST" autocomplete="off">
                                                                                <input type="hidden" name="call_id" value="<?php echo $req->cid; ?>">
                                                                                <input type="hidden" name="call_rate" value="<?php echo $req->call_rate; ?>">
                                                                                <input type="hidden" name="price_id" value="<?php echo $call_rate_del->stripe_price_id; ?>">
                                                                                <div class="spinner hidden spinner"></div>
                                                                                <button type="submit" class="pay btn btn-d buttonText">Pay</button>
                                                                            </form>
                                                                            <?php
                                                                        }
                                                                    }else{
                                                                        echo 'Paid';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if($req->expert_approval == 1 && $req->paid == 1){
                                                                        if(($nw_date_time >= $db_date_time) && ($nw_date_time <= $af_date_time)){
                                                                            ?>
                                                                            <a class="btn btn-d" href="<?php echo base_url('video-session/'.$req->meeting_id.'/'.$req->cid); ?>" target="_blank">Start</a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if($req->expert_approval == 1){
                                                                        echo '<span class="text-success">Accepted</span>';
                                                                    }else if($req->expert_approval == 0 && $req->reject_reason != ""){
                                                                        echo 'Declined <br> <span class="text-danger">Reason: '.$req->reject_reason.'</span>';
                                                                    }else{
                                                                        echo '<span class="text-warning">Pending</span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $req->booked_date; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if($req->paid != 1){
                                                                        ?>
                                                                        <i title="Cancel Booking" class="fas fa-times-circle font-size-18 mt-1 me-2 text-danger" style="cursor: pointer;" onclick="return cancelBooking(<?php echo $req->cid; ?>);"></i>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $req_cnt++;
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
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
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

                $("input[name='fileIt_radio']").click(function () {
                    var fileIt_radio = $(this).val();
                    if(fileIt_radio == 'all'){
                        $('.done-calls').show();
                        $('.today-calls').show();
                        $('.upcoming-calls').show();

                        $('.accepted-request').show();
                        $('.rejected-request').show();
                        $('.pending-request').show();
                    }
                    else if(fileIt_radio == 'done-calls'){
                        $('.accepted-request').hide();
                        $('.rejected-request').hide();
                        $('.pending-request').hide();

                        $('.today-calls').hide();
                        $('.upcoming-calls').hide();
                        $('.done-calls').show();
                    }
                    else if(fileIt_radio == 'today-calls'){
                        $('.accepted-request').hide();
                        $('.rejected-request').hide();
                        $('.pending-request').hide();

                        $('.done-calls').hide();
                        $('.upcoming-calls').hide();
                        $('.today-calls').show();
                    }
                    else if(fileIt_radio == 'upcoming-calls'){
                        $('.accepted-request').hide();
                        $('.rejected-request').hide();
                        $('.pending-request').hide();

                        $('.done-calls').hide();
                        $('.today-calls').hide();
                        $('.upcoming-calls').show();
                    }
                    else if(fileIt_radio == 'accepted'){
                        $('.done-calls').hide();
                        $('.today-calls').hide();
                        $('.upcoming-calls').hide();

                        $('.rejected-request').hide();
                        $('.pending-request').hide();
                        $('.accepted-request').show();
                    }
                    else if(fileIt_radio == 'rejected'){
                        $('.done-calls').hide();
                        $('.today-calls').hide();
                        $('.upcoming-calls').hide();

                        $('.accepted-request').hide();
                        $('.pending-request').hide();
                        $('.rejected-request').show();
                    }
                    else if(fileIt_radio == 'pending'){
                        $('.done-calls').hide();
                        $('.today-calls').hide();
                        $('.upcoming-calls').hide();

                        $('.accepted-request').hide();
                        $('.rejected-request').hide();
                        $('.pending-request').show();
                    }
                });
            });

            // Set Stripe publishable key to initialize Stripe.js
            const stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');
            // Select payment button
            const payBtn = document.getElementsByTagName("button");

            // Payment request handler
            $('.make_payment').on('submit',function(event){
                event.preventDefault(); // Stop page from refreshing
                setLoading(true);
                var formData = new FormData(this); 
                $.ajax({
                     url:'front/set_dm_price_id_session',
                     type:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     success: function(data){
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
                      else if(data.status == true){
                        console.log('set');
                        createCheckoutSession().then(function (data) {
                            if(data.sessionId){
                                stripe.redirectToCheckout({
                                    sessionId: data.sessionId,
                                }).then(handleResult);
                            }else{
                                handleResult(data);
                            }
                        });
                      }
                      console.log(data);
                      console.log('set successfully');  
                   }// success msg ends here

                 });
            });
                
            // Create a Checkout Session with the selected product
            const createCheckoutSession = function (stripe) {
                return fetch("<?php echo base_url('front/dm_checkout_payment_initialize');?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        createCheckoutSession: 1,
                    }),
                }).then(function (result) {
                    return result.json();
                });
            };

            // Handle any errors returned from Checkout
            const handleResult = function (result) {
                if (result.error) {
                    showMessage(result.error.message);
                }
                
                setLoading(false);
            };

            // Show a spinner on payment processing
            function setLoading(isLoading) {
                if (isLoading) {
                    // Disable the button and show a spinner
                    for (var i = 0; i < payBtn.length; i++) {
                            payBtn.disabled = true;
                        }        
                    document.querySelector(".spinner").classList.remove("hidden");
                    document.querySelector(".buttonText").classList.add("hidden");
                } else {
                    // Enable the button and hide spinner
                    for (var i = 0; i < payBtn.length; i++) {
                            payBtn.disabled = false;
                        } 
                    document.querySelector(".spinner").classList.add("hidden");
                    document.querySelector(".buttonText").classList.remove("hidden");
                }
            }

            // Display message
            function showMessage(messageText) {
                const messageContainer = document.querySelector("#paymentResponse");
                
                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;
                
                setTimeout(function () {
                    messageContainer.classList.add("hidden");
                    messageText.textContent = "";
                }, 5000);
            }
        </script>
    </body>
</html>
