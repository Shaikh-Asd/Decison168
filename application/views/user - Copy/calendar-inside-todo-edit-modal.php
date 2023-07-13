<?php
if($intodo_data)
{
$itd_t12hrs = date('h:i A',strtotime($intodo_data->task_start_time));
?>
<form class="add-inside-todo" method="post" name="update-inside-todo-modal" id="update-inside-todo-modal" autocomplete="off">
<div class="modal-header">
    <h5 class="modal-title mt-0">Update New To Do</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" style="padding: 0.5rem 1rem 0rem 1rem !important;">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control form-white" placeholder="Enter Title *" type="text" name="task_name" value="<?php echo $intodo_data->task_name;?>" required="" />
                </div>
                <span id="task_nameErr" class="text-danger"></span>
            </div>
        </div>                    
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <textarea class="form-control form-white" placeholder="Add Note" name="task_note"><?php echo $intodo_data->task_note;?></textarea>
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
                        <option value="No Priority" <?php if($intodo_data->priority == 'No Priority'){ echo "selected";}?>>No Priority</option>
                        <option value="High Priority" <?php if($intodo_data->priority == 'High Priority'){ echo "selected";}?>>High Priority</option>
                        <option value="Medium Priority" <?php if($intodo_data->priority == 'Medium Priority'){ echo "selected";}?>>Medium Priority</option>
                        <option value="Low Priority" <?php if($intodo_data->priority == 'Low Priority'){ echo "selected";}?>>Low Priority</option>
                    </select>
                </div>
                    <span id="priorityErr" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group mb-3">
                    <select id="task_reminder" name="task_reminder" class="form-control form-select">
                    <option value="No reminder" <?php if($intodo_data->task_reminder == 'No reminder'){ echo "selected";}?>>No reminder</option>
                    <option value="5 minutes before" <?php if($intodo_data->task_reminder == '5 minutes before'){ echo "selected";}?>>5 minutes before</option>
                    <option value="15 minutes before" <?php if($intodo_data->task_reminder == '15 minutes before'){ echo "selected";}?>>15 minutes before</option>
                    <option value="30 minutes before" <?php if($intodo_data->task_reminder == '30 minutes before'){ echo "selected";}?>>30 minutes before</option>
                    <option value="1 hour before" <?php if($intodo_data->task_reminder == '1 hour before'){ echo "selected";}?>>1 hour before</option>
                    <option value="4 hours before" <?php if($intodo_data->task_reminder == '4 hours before'){ echo "selected";}?>>4 hours before</option>
                    <option value="1 day before" <?php if($intodo_data->task_reminder == '1 day before'){ echo "selected";}?>>1 day before</option>
                    <option value="2 days before" <?php if($intodo_data->task_reminder == '2 days before'){ echo "selected";}?>>2 days before</option>
                    <option value="1 week before" <?php if($intodo_data->task_reminder == '1 week before'){ echo "selected";}?>>1 week before</option>
                    </select>
                </div>
                    <span id="task_reminderErr" class="text-danger"></span>
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md" onmousemove="return todo_inside_datepicker_update();">
            <div class="form-group">
                <div class="input-group" id="datepicker09">
                    <input type="text" class="form-control task_start_date_class" id="task_start_date" name="task_start_date" data-date-format="yyyy-mm-dd" data-date-container='#datepicker09' data-provide="datepicker" data-date-autoclose="true" value="<?php echo $intodo_data->task_start_date;?>" required="" onchange="return restricted_event_start_time_update(this.value);">
                </div>

                <span id="task_start_dateErr" class="text-danger"></span>
             </div>
        </div>
        <div class="col-md" id="task-time-section-update" <?php if($intodo_data->task_allDay == "true") { echo "style=display:none";}?>>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                <div class="input-group mb-3">
                    <select id="task_start_time" name="sel_task_start_time" class="form-control task_update_event_start_time" style="width: 86%;<?php if($intodo_data->task_allDay != "true"){ echo "display: none";}?>" onchange="return get_selected_todo_time1_up();">
                        <option value="">Select time *</option>
                        <?php
                        $time_12hrs = $this->Front_model->gettime_12hrs();
                        if($time_12hrs)
                        {
                          foreach ($time_12hrs as $t12hrs) 
                          {
                              ?>
                              <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $itd_t12hrs){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                              <?php
                          }
                        }
                        ?>
                    </select> 

                    <select id="task_start_time" name="sel_task_start_time" class="form-control all-task-time-section-update"  style="width: 86%;<?php if($intodo_data->task_allDay == "true"){ echo "display: none";}?>" onchange="return get_selected_todo_time2_up();">
                        <option value="">Select time *</option>
                        <?php
                        $get_edetail = $this->Front_model->getEventTime($intodo_data->event_id);
                        $get_etime = $this->Front_model->getEventTimeUniqueKey($get_edetail->unique_key);
                        if($get_etime)
                        {
                        if($get_etime->event_allDay == "true")
                        {
                            $time_12hrs = $this->Front_model->gettime_12hrs();
                            if($time_12hrs)
                            {
                              foreach ($time_12hrs as $t12hrs) 
                              {
                                  ?>
                                  <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $itd_t12hrs){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                  <?php
                              }
                            }
                        }   
                        elseif(($intodo_data->task_allDay == "true"))
                        {
                            $event_start_time = date('h:i A',strtotime($get_etime->event_start_time));
                            $event_end_time = date('h:i A',strtotime($get_etime->event_end_time));
                            $time_12hrs = $this->Front_model->gettime_12hrs_inside_todo($event_start_time,$event_end_time);
                            if($time_12hrs)
                            {
                              foreach ($time_12hrs as $t12hrs) 
                              {
                                  ?>
                                  <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $itd_t12hrs){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                  <?php
                              }
                            }
                         }                       
                         elseif($get_etime->event_end_date == $intodo_data->task_start_date)  
                         {
                            $event_start_time = date('h:i A',strtotime($get_etime->event_start_time));
                            $event_end_time = date('h:i A',strtotime($get_etime->event_end_time));
                            $time_12hrs = $this->Front_model->gettime_12hrs_inside_todo($event_start_time,$event_end_time);
                            if($time_12hrs)
                            {
                              foreach ($time_12hrs as $t12hrs) 
                              {
                                  ?>
                                  <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $itd_t12hrs){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                  <?php
                              }
                            }
                         }
                         else
                         {
                            $time_12hrs = $this->Front_model->gettime_12hrs();
                            if($time_12hrs)
                            {
                              foreach ($time_12hrs as $t12hrs) 
                              {
                                  ?>
                                  <option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $itd_t12hrs){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
                                  <?php
                              }
                            }
                         }
                        }
                        else
                        {
                          ?>
                          <option value="<?php echo $itd_t12hrs; ?>"><?php echo $itd_t12hrs; ?></option>
                          <?php
                        } 
                        ?>
                    </select>
                </div>
                <span id="uptask_start_timeErr" class="text-danger"></span>
             </div>
            </div>
        </div>
        
        <div class="col-md-2" id="all-day-task-time-section-update" <?php if($get_etime->event_end_date == $intodo_data->task_start_date){ echo "style=display:none";}?>>
            <div class="form-group" style="padding: 9px 0px;">
                <input type="checkbox" name="task_allDay" id="task_allDay_update" onclick="check_start_time_todo_update(this.value)" class="form-check-input" <?php if($intodo_data->task_allDay == "true") { echo "checked"; echo " value='true'";} else {  echo "value='false'";}?>>
                <label class="control-label" for="task_allDay_update">
                    All Day
                </label>
                <span id="task_allDayErr" class="text-danger"></span>
            </div>
        </div>
    </div>

     <input type="hidden" name="event_id" id="get_main_event_id" value="<?php echo $intodo_data->event_id;?>">
     <input type="hidden" name="id" id="get_task_up_id" value="<?php echo $intodo_data->id; ?>">
     <input type="hidden" name="get_task_start_date" value="<?php echo $get_etime->event_end_date; ?>">
     <input type="hidden" name="task_start_time" id="task_start_time_val_up" value="<?php echo $itd_t12hrs; ?>">
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-sm btn-d waves-effect waves-light">Save</button>
    <button type="button" class="btn btn-sm bg-d text-white waves-effect" data-bs-dismiss="modal" >Close</button>
</div>
</form>
<?php
    }
?>
<script type="text/javascript">
// FOR Update INSIDE TO DO MODAL ----------------------------------------
$('#update-inside-todo-modal').on('submit',function(event){
  //debugger;
  event.preventDefault(); // Stop page from refreshing
  // event.stopImmediatePropagation();
  // return false;
  var id = $.trim($('#update-inside-todo-modal').find("#get_task_up_id").val());
  var formData = new FormData(this);
  //debugger;
  var sel1 = $.trim($('#update-inside-todo-modal').find("#task_start_time_val_up").val());
  var all_day = $('#task_allDay_update').val();
  if(sel1 !== "")
  {
    $.ajax({
         url:base_url+'front/update_events_todo',
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
          else if(data){
            //debugger;
            //console.log(data);
              $('.up_task_name'+id).html(data.task_name);
              $('.up_task_start'+id).html('<span class="badge badge-soft-info">'+data.up_task_start+'</span>');
              $('.up_task_rem'+id).html(data.up_task_rem);
              $('.up_task_date'+id).html(data.up_task_date);
              $('.up_task_priority'+id).html('<span class="badge bg-success">'+data.up_task_priority+'</span>')
              $('#InsideTodoEditModal').modal('hide');
              Swal.fire("Updated!", "Successfully.", "success");
          }
          //console.log(data);
       }// success msg ends here

     });
  }
  else if(all_day === 'true')
  {
    $.ajax({
         url:base_url+'front/update_events_todo',
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
          else if(data){
            //debugger;
            //console.log(data);
              $('.up_task_name'+id).html(data.task_name);
              $('.up_task_start'+id).html('<span class="badge badge-soft-info">'+data.up_task_start+'</span>');
              $('.up_task_rem'+id).html(data.up_task_rem);
              $('.up_task_date'+id).html(data.up_task_date);
              $('.up_task_priority'+id).html('<span class="badge bg-success">'+data.up_task_priority+'</span>')
              $('#InsideTodoEditModal').modal('hide');
              Swal.fire("Updated!", "Successfully.", "success");
          }
          //console.log(data);
       }// success msg ends here

     });
  }
  else
  {
    $('#uptask_start_timeErr').html('Start time is required!');
  }
  
});

function todo_inside_datepicker_update()
{
//debugger;
var end_dd = $('#update-inside-todo-modal').find("input[name=get_task_start_date]").val();
//console.log(end_dd);
$('.task_start_date_class').datepicker({endDate: new Date(end_dd)});
}

function restricted_event_start_time_update(sel_date)
{
    //debugger;
  var sel_date = sel_date;
  var end_dd = $('#update-inside-todo-modal').find("input[name=get_task_start_date]").val();
  var id = $('#update-inside-todo-modal').find("input[name=id]").val();
  var event_id = $('#update-inside-todo-modal').find("input[name=event_id]").val();
  // console.log(sel_date);
  // console.log(end_dd);
  $('#update-inside-todo-modal').find('#task_start_time_val_up').val('');
  $('#task-time-section-update').show();
  if(end_dd == sel_date)
  {
    $('#task_allDay_update').val('false');
    $('#task_allDay_update').prop('checked', false);
    $('#all-day-task-time-section-update').hide();
    $('.task_update_event_start_time').hide();
    $.ajax({
          url: base_url+'front/restrict_task_start_time_update_modal',
          method: 'POST',
          data: {id:id, event_id:event_id, new_date:sel_date},  
          success: function(data) {
              $('.all-task-time-section-update').html(data);
              //console.log(data);                   
          }
    });
    $('.all-task-time-section-update').show();
  }
  else
  {
    $('#task_allDay_update').val('false');
    $('#task_allDay_update').prop('checked', false);
    $('#all-day-task-time-section-update').show();
    $('.task_update_event_start_time').show();
    $('.all-task-time-section-update').hide();
  }
}

function get_selected_todo_time1_up()
{
  $('#task_start_time_val_up').val($('.task_update_event_start_time').val());
}

function get_selected_todo_time2_up()
{
  $('#task_start_time_val_up').val($('.all-task-time-section-update').val());
}

function check_start_time_todo_update(value) {
   // alert();
   //debugger;
   var check_new_value = $('#task_allDay_update').val();
   if (check_new_value == 'true') {
     $('#task_allDay_update').val("false");
     $("#task-time-section-update").show(); 
   } else {
     $('#task_allDay_update').val("true");
     $("#task-time-section-update").hide();
     $('#uptask_start_timeErr').html('')
   }
}
</script>