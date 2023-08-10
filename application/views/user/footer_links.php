<!-- toastr plugin -->
<script src="<?php echo base_url();?>assets/libs/toastr/build/toastr.min.js"></script><!-- Sweet Alerts js -->
<script src="<?php echo base_url();?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- App js -->
<script src="<?php echo base_url();?>assets/js/app.js"></script>
        
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script src="<?php echo base_url();?>assets/js/function.js"></script>
<!-- <script src="<?php echo base_url();?>assets/libs/tinymce_notes/js/tinymce/tinymce.min.js"></script> -->
<!-- <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5-stable/tinymce.min.js"></script> -->

<script src="<?php echo base_url();?>assets/tour/js/bs5-intro-tour.js"></script>
    <style> 
    #suggestionContainer{
        position: absolute;
        z-index: 999;
        height: 50px;
        overflow: auto;
        width: 95%;
        
    }
        #suggestionContainer div{
        background-color: #fff;
        border: 2px solid #E5E4E2;
        padding: 12px;
    }

    #suggestionSContainer{
        position: absolute;
        z-index: 999;
        height: 50px;
        overflow: auto;
        width: 95%;
    }
        #suggestionSContainer div{
        background-color: #fff;
        border: 2px solid #E5E4E2;
        padding: 12px;
    }

    .suggestionSContainer{
        position: absolute;
        z-index: 999;
        height: 50px;
        overflow: auto;
        width: 95%;
    }
        .suggestionSContainer div{
        background-color: #fff;
        border: 2px solid #E5E4E2;
        padding: 12px;
    }


            .float-button { 
        text-decoration: none;  
        position: fixed;    
        padding: 10px;  
        padding-right: 15px;    
        bottom: 30px;   
        right: 30px;    
        color: #000;    
        background-color:#c7df19;   
        border-radius: 25px 30px 5px 25px;  
        z-index: 100;   
        font-family: Arial; 
        font-size: 17px;    
        animation: whatsapp-animation 0.5s ease-in-out; 
        box-shadow: 1px 2px 5px 2px rgba(30,30,30,0.3); 
        transition:all 0.3s ease-out;   
    }   
    .float-button:hover {   
         background-color: #c7df19; 
          color: #000;  
    }   
    .fa-whatsapp {  
        font-size: 20px !important; 
        padding-right: 5px; 
        padding-left: 5px;  
    }   
    @keyframes whatsapp-animation { 
        from {  
            opacity: 0%;    
        }   
        to {    
            opacity: 100%   
        }   
    }   
    @media screen and (max-width: 545px) {  
        span {  
            display: none;  
        }   
        .float-button { 
            bottom: 15px;   
            right: 15px;    
            width: 20px;    
            border-radius: 20px 20px 5px 20px;  
        }   
        .fa-whatsapp {  
            font-size: 22px !important; 
            padding: 4px;   
        }   
    }   
    .timer-continue {   
        background-color: #e5f08f !important;   
    }   
</style>    
<a class="float-button" id="floatButton" style="display:none;"></a> 
<!-- timer alert -->    
<div class="timer_alertDiv">    
        
            
        
    <!-- end modal -->  
</div>  
<input type="hidden"  id="timer_started_label"  value="">
									<!-- My Tour Modal -->
                                    <div id="myTourModal" class="modal fade bs-example-modal-sm" tabindex="-1" aria-labelledby="#myTourModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content" id="myTourModal_content">
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Get Started Modal -->
                                    <div id="getStartedModal" class="modal fade bs-example-modal-sm" tabindex="-1" aria-labelledby="#getStartedModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content" id="getStartedModal_content">
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Tasks Overview Notification Modal -->
                                    <div id="TaskOverviewNotificationModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#TaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="TaskOverviewNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtasks Overview Notification Modal -->
                                    <div id="SubtaskOverviewNotificationModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskOverviewNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Overview Request Notification Modal -->
                                    <div id="ProjectOverviewRequestNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectOverviewRequestNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Overview File Notification Modal -->
                                    <div id="ProjectOverviewFileNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewFileNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectOverviewFileNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Task File Notification Modal -->
                                    <div id="TaskFileNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#TaskFileNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="TaskFileNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subask File Notification Modal -->
                                    <div id="SubtaskFileNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#SubtaskFileNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="SubtaskFileNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Overview Planned Content Notification Modal -->
                                    <div id="PlannedContentNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewFileNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="PlannedContentNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Portfolio Request Accepted Notification Modal -->
                                    <div id="PortfolioAcceptedReqNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#PortfolioAcceptedReqNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="PortfolioAcceptedReqNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Request Accepted Notification Modal -->
                                    <div id="ProjectAcceptedReqNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectAcceptedReqNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectAcceptedReqNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Invite Request Accepted Notification Modal -->
                                    <div id="ProjectAcceptedInviteReqNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectAcceptedInviteReqNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="ProjectAcceptedInviteReqNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Goal Duplicate Modal -->
                                    <div id="duplicate_goalModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_goalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="duplicate_goalModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Strategy Duplicate Modal -->
                                    <div id="duplicate_strategyModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_strategyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="duplicate_strategyModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Duplicate Modal -->
                                    <div id="duplicate_projectModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_projectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="duplicate_projectModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Task Duplicate Modal -->
                                    <div id="duplicate_taskModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_taskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="duplicate_taskModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Subtask Duplicate Modal -->
                                    <div id="duplicate_subtaskModal" class="modal fade" tabindex="-1" aria-labelledby="#duplicate_subtaskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="duplicate_subtaskModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Project Membership Notification Modal -->
                                    <div id="MembershipReqNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#MembershipReqNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="MembershipReqNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 
                                    <!-- Meeting Member Notification Modal -->
                                    <div id="MeetingMemberNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#MeetingMemberNotificationModalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="MeetingMemberNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 
                                    <!-- Goal Overview Request Notification Modal -->
                                    <div id="GoalOverviewRequestNotificationModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewRequestNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="GoalOverviewRequestNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 
                                    <!-- Team Profile Modal -->
                                    <div id="TeamProfileModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#TeamProfileModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content" id="TeamProfileModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 
                                    <!-- File Preview Permission Notification Modal -->
                                    <div id="FilePreviewPermissionNotificationModal" class="modal fade bs-example-modal-lg" aria-labelledby="#FilePreviewPermissionNotificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="FilePreviewPermissionNotificationModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 

                                    <div id="TaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#TaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div></div>
                                            <div class="modal-content" id="TaskOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="SubtaskOverviewModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

<!-- calendar reminder -->
<div class="refresh_if_reminder">
    
        
    
    <!-- end modal -->
</div>
<!-- calendar inside todo reminder -->
<div class="refresh_if_inside_todo_reminder">
    
        
    
    <!-- end modal -->
</div>
<?php   
include('call_booking_header.php'); 
?>
<script>
function refresh_reminder_div() {
    //debugger;   
$.ajax({
    url:  '<?php echo base_url("front/auto_in_app_calendar_reminder");?>',
    type: 'post',
    success: function(data){ 
        //console.log(data.get_evt_rem);
      if(data.get_evt_rem == 'new_evt_rem')
      {    
      //debugger;     
           $('.refresh_if_reminder').append(data.reminder_detail);
           $('.calendarReminderModal'+data.get_evt_id).modal('show');
      }
    }
  });
}

t = setInterval(refresh_reminder_div,30 * 1000);


function refresh_inside_todo_reminder_div() {
    //debugger;   
$.ajax({
    url:  '<?php echo base_url("front/auto_in_app_calendar_inside_todo_reminder");?>',
    type: 'post',
    success: function(data){ 
        //console.log(data.get_evt_rem);
      if(data.get_inside_todo_rem == 'new_inside_todo_rem')
      {    
            //debugger;     
           $('.refresh_if_inside_todo_reminder').append(data.inside_todo_reminder_detail);
           $('.calendarInsideTodoReminderModal'+data.get_inside_todo_id).modal('show');
      }
    }
  });
}

t = setInterval(refresh_inside_todo_reminder_div,30 * 1000);

//session time out starts//
    // $('body').on('load',function(){
    //     logoutStartTimer();
    // });
    // $('body').on('mousemove',function(){
    //     logoutResetTimer();
    // });
    // Set timeout variables.
    var timoutWarning = 1800000; // Display warning in 60Mins in milliseconds is 3600000.
    var timoutNow = 1830000; // Timeout in 61 mins in milliseconds is 3660000.
    var logoutUrl = '<?php echo base_url('front/timer_logout'); ?>';

    var warningTimer;
    var timeoutTimer;

    // Start timers.
    function logoutStartTimer() {
        warningTimer = setTimeout("IdleWarning()", timoutWarning);
        timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
    }

    // Reset timers.
    function logoutResetTimer() {
        clearTimeout(warningTimer);
        clearTimeout(timeoutTimer);
        logoutStartTimer();
        //Swal.close();
    }

    // Show idle timeout warning dialog.
    function IdleWarning() {
        //debugger;
        var myAudio = new Audio('<?php echo base_url('assets/images/session-out.wav'); ?>');
        myAudio.play();
        Swal.fire({
            title: "Session about To Timeout",
            text: "You will be automatically logged out in 1 minute.",
            icon: "warning",
            timer: 60000,
            confirmButtonColor: "#c7df19",
            confirmButtonText: "Keep me logged in",
        });
    }
    // Logout the user.
    function IdleTimeout() {
        window.location = logoutUrl;
    }
//session time out ends//

      function refresh_report_file() {
    //debugger;   
    $.ajax({
        url:  '<?php echo base_url("front/templateFileDelete");?>',
        type: 'post',
        success: function(data){
            
        }
    });
    }

z = setInterval(refresh_report_file,30 * 1000);


function refresh_userreport_file() {
    //debugger;   
    $.ajax({
        url:  '<?php echo base_url("front/templateUserFileDelete");?>',
        type: 'post',
        success: function(data){
            
        }
    });
    }    

z = setInterval(refresh_userreport_file,30 * 1000);

    
function timer_alert_status() { 
$.ajax({    
    url:  '<?php echo base_url("front/timerReminder");?>',  
    type: 'post',   
    success: function(data){    
      if(data.now_alert == 'alert_subtask') 
      {     
            var timerAlert = data.timer_alert;  
            timerAlert = timerAlert.replace(/\\/g, ''); 
           $('.timer_alertDiv').append(timerAlert); 
           $('.timerModal'+data.sid).modal('show'); 
      } 
     else if(data.now_alert == 'alert_task')    
      {     
            var timerAlert = data.timer_alert;  
            timerAlert = timerAlert.replace(/\\/g, ''); 
           $('.timer_alertDiv').append(timerAlert); 
           $('.timerModal'+data.tid).modal('show'); 
      } 
    }   
  });   
}   
// g = setInterval(timer_alert_status, 1000);
</script>