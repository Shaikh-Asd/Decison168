<style type="text/css">
.left-expert-section-modal{
    min-height: 450px;
    padding: 0 40px;
}
.right-expert-section-modal{
    min-height: 450px;
    padding: 0 40px;
}
/*.no-image-card{
    width: 300px;
    height: 300px;
    font-size: 8em;
    font-weight: bolder;
    padding: 11%;
    background-color: #c6de18;
}*/
.custom-section {
    padding-top: 130px;
    padding-bottom: 130px;
}
</style>
<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- App Css-->
<link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<div class="modal-body">
    <div class="bg-white expert-section pt-2 pb-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-expert-section-modal">
                    <div class="blog-box mb-4 mb-xl-0">
                        <p class="font-size-14 text-muted">Powered by <strong class="font-size-16 text-dark">Decision168</strong></p>
                        <?php
                        $expert_id = $dm->reg_id;
                        if(!empty($dm->expert_photo)){
                            ?>
                            <img class="rounded d-block" style="width: 300px; height: auto;" src="<?php echo base_url('assets/student_photos/'.$dm->expert_photo);?>" alt="<?php echo $dm->first_name;?>">
                            <?php
                        }else{
                            $fullname = $dm->first_name.' '.$dm->last_name;
                            $student_name = explode(" ", $fullname);
                            $profile_name = "";

                            foreach ($student_name as $sn) {
                              $profile_name .= $sn[0];
                            }
                            ?>
                            <span class="rounded img-fluid mx-auto d-block no-image-card"><?php echo strtoupper($profile_name);?></span>
                            <?php
                        }
                        ?>                                      
                        <div class="mt-4 text-muted">
                            <?php
                            $expert_call_del1 = $this->Front_model->expertLessCallRate($expert_id);
                            if($expert_call_del1){
                                ?>
                                <p class="mb-2">$<span class="call-rate"><?php echo $expert_call_del1->call_rate; ?></span> • Session</p>
                                <?php
                            }
                            ?>                                 
                            <h5 class="mb-1 font-weight-semibold"><a class="text-dark" href="<?php echo base_url('decision-maker/'.$dm->reg_id.'/'.$dm->first_name.$dm->last_name); ?>"><?php echo ucfirst($dm->first_name).' '.ucfirst($dm->last_name); ?></a></h5>
                            <p><?php echo ucfirst($dm->designation); ?>, <?php echo $dm->company; ?></p>
                            <?php
                            if($dm->social_media){
                                ?>
                                <div class="float-end">
                                    <?php
                                        $social_media_icon = explode(',', $dm->social_media_icon);
                                        $social_media = explode(',', $dm->social_media);
                                        $count = count($social_media);
                                        if($count > 0){
                                            for ($i=0; $i<$count; $i++){
                                                $icon_name = strtolower($social_media_icon[$i]);
                                                ?>
                                                <span class="profile-icon-span"><a target="_blank" href="<?php echo prep_url($social_media[$i]);?>">
                                                    <span><i class="fab fa-<?php echo $icon_name;?> h3 text-d"></i></span>
                                                </a></span>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                            if($dm->expertise){
                                ?>
                                <h5 class="font-weight-semibold">About Me</h5>
                                <p class="pdes text-dark"><?php echo $dm->expertise; ?></p>
                                <?php
                            }
                            ?>                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 border-left">
                <div class="right-expert-section-modal">
                    <form class="book_call_form" id="book_call_form" autocomplete="off" method="POST">
                        <div class="blog-box mb-4 ml-10">
                            <h3 class="font-weight-semibold mt-3 mb-3">Book a Video Call</h3>
                            <div class="mb-4">
                                <h6>1) Select the call duration:</h6>
                                <div class="form-group">
                                    <select class="form-control select2" onchange="return changeCallRate(this.value,<?php echo $expert_id; ?>);" name="call_duration" id="call_duration" required>
                                        <?php                                        
                                        $expert_call_del = $this->Front_model->expertCallRate($expert_id);
                                        if($expert_call_del){
                                            foreach ($expert_call_del as $ecd) {
                                                $min_del = $this->Front_model->callMinutesById($ecd->cm_id);
                                                ?>
                                                <option value="<?php echo $min_del->cm_id; ?>"><?php echo $min_del->minute; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span id="call_durationErr" class="text-danger"></span>
                                </div>                            
                            </div>
                            <div class="mb-4">
                                <h6>2) Select the date:</h6>
                                <div data-provide="datepicker-inline" id="pickyDate" class="bootstrap-datepicker-inline"></div>
                                <input type="hidden" name="booking_date" id="booking_date"/>
                                <span id="booking_dateErr" class="text-danger"></span>
                            </div>  
                            <div class="mb-4">
                                <h6>3) Select the time you're available for a video session: <small class="text-d">(Time Zone : America/New_York)</small></h6>
                                <div class="form-group">
                                    <select class="form-select select2" name="book_time" id="book_time" required>
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
                                    <span id="book_timeErr" class="text-danger"></span>
                                </div>                            
                            </div>
                            <input type="hidden" name="expert_id" id="expert_id" value="<?php echo $dm->reg_id; ?>">
                            <?php
                            $expert_call_del1 = $this->Front_model->expertLessCallRate($expert_id);
                            if($expert_call_del1){
                                ?>
                                <span class="mb-2 h5 font-weight-semibold">$<span class="call-rate"><?php echo $expert_call_del1->call_rate; ?></span> • Session</span>
                                <?php
                            }
                            ?>
                            
                            <button type="submit" id="book_call_button" class="btn btn-d btn-md float-end">Request</button>                      
                        </div>   
                    </form>                          
                </div>                            
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
    $('#pickyDate').datepicker({
      format: "yyyy-m-d",
      startDate: new Date(),
      // todayBtn: "linked",
      // language: "de",
      // daysOfWeekDisabled: "0,6",
      // daysOfWeekHighlighted: "4",
      // todayHighlight: true,
    }).on('changeDate', showTestDate);

function showTestDate(){
  var value = $('#pickyDate').datepicker('getFormattedDate');
  $("#booking_date").val(value);
}

$('#book_call_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#book_timeErr').html();
    var formData = new FormData(this); 
    $.ajax({
         url:'front/insert_call_booking',
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
          else if(data.status == 'less_time'){
            $('#book_timeErr').html('Select Time greater than current time');
          }
          else if(data.status == 'already_exists'){
            $('#book_timeErr').html('Sold Out');
          }
          else if(data.status == true){
            Swal.fire("Submitted!", "Successfully.", "success");
            window.location.reload();
          }
          console.log(data); 
       }// success msg ends here

     });
});

function changeCallRate(cm_id,expert_id){
    $.ajax({
        url: 'front/get_call_rate_data',
        type: 'POST',
        data: {cm_id:cm_id,expert_id:expert_id},  
        success: function(data) {
            if(data.status == true){
                $('.call-rate').html(data.call_rate);
            }                 
        }
    });
}
</script>