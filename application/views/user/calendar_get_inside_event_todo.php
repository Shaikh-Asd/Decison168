<!-- Start Task Section of specific Event -->
<div class="task-section<?php echo $event_id;?>">
<?php
$todo = $this->Front_model->getEventTodo($student_id,$event_id);
if($todo)
{	
	$todo_count = count($todo);
	$comp_tasks = $this->Front_model->getCompleteEventTodoCount($student_id,$event_id);
	$todo_percent = round(($comp_tasks/$todo_count)*100);
?>
	<div class="show_todo_progress<?php echo $event_id;?>">
	<hr style="margin: 0px;">
	<h5 class="font-weight-500 m-2 mb-3">To Do</h5>
	<div class="progress m-2">
        <div class="progress-bar progress-bar-striped progress-bar-animated btn-d todo-progress-bar<?php echo $event_id;?>" role="progressbar" aria-valuenow="<?php echo $todo_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $todo_percent; ?>%">
        	<span class="sr-only<?php echo $event_id;?>"><?php echo $todo_percent; ?>%</span>
        </div>
    </div>
    <div>

<div data-simplebar style="max-height: 200px;">
	<div class="accordion m-2" id="accordionTodo<?php echo $event_id;?>">
    <?php
    foreach ($todo as $tk) 
    {
    ?>
    <div class="accordion-item todo_all_details<?php echo $tk->id;?>">
        <h2 class="accordion-header" id="headingTodo<?php echo $tk->id;?>">
            <button class="accordion-button fw-medium collapsed" id="todo_cbut<?php echo $tk->id;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTodo<?php echo $tk->id;?>" aria-expanded="false" aria-controls="collapseTodo<?php echo $tk->id;?>">

            	<span class="todo_status_icon<?php echo $tk->id;?>">
        		<?php
					if($tk->is_completed != 'yes')
					{
				?>
	        		<i class="mdi mdi-checkbox-blank-circle-outline me-1 mb-0 h4" title="Incomplete"></i>
	        	<?php
					}
					else
					{
				?>
            		<i class="mdi mdi-check-circle-outline me-1 mb-0 text-d h4" title="Completed"></i>
				<?php
					}
				?>
            	</span>

            	<span id="new_todo_name<?php echo $tk->id;?>"><?php echo $tk->task_name;?></span>
            </button>
        </h2>
        <div id="collapseTodo<?php echo $tk->id;?>" class="accordion-collapse collapse" aria-labelledby="headingTodo<?php echo $tk->id;?>" data-bs-parent="#accordionTodo<?php echo $event_id;?>">
            <div class="accordion-body">

                <div class="row">
                	<div class="col-8">
		                <fieldset class="description">
			              <div class="description-details">
			                <p class="description-content" onclick="return todo_editable_field();">
			                	<?php echo $tk->task_name;?>
			                </p>
			                <i class="fas fa-pencil-alt" onclick="return todo_editable_field();"></i>
			              </div>
			              <div class="description-edit">
			                <input name="task_name" id="task_name" value="<?php echo trim($tk->task_name);?>" required="">
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes();"  data-class="todo_editable" data-name="task_name" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			              <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
                	</div>
                	<div class="col-4">
                		<?php
							if($tk->is_completed != 'yes')
							{
						?>
			        		<input class="form-check-input ms-1 me-2 mb-1" id="todo_cb<?php echo $tk->id;?>" type="checkbox" onclick="return inside_events_todo_complete('<?php echo $tk->id; ?>','<?php echo $event_id;?>');">
							<span class="badge todo_status_label<?php echo $tk->id;?>" style="color: #c7df19;background-color: rgb(199 223 25 / 17%);">Incomplete</span>
			        	<?php
							}
							else
							{
						?>
							<input class="form-check-input ms-1 me-2 mb-1" id="todo_cb<?php echo $tk->id;?>" type="checkbox" onclick="return inside_events_todo_complete('<?php echo $tk->id; ?>','<?php echo $event_id;?>');" checked>
							<span class="badge todo_status_label<?php echo $tk->id;?>" style="color: #c7df19;background-color: rgb(199 223 25 / 17%);">Completed</span>
						<?php
							}
						?>
			            <a class="float-end text-dark" href="javascript:void(0)" onclick="return delete_inside_todo('<?php echo $tk->id; ?>','<?php echo $event_id;?>');"><i class="fas fa-trash-alt"></i></a>
                	</div>
                </div>

                <div class="row">
                	<div class="col-8">
                		<fieldset class="description todo_des_div<?php echo $tk->id;?>">
			              <div class="description-details">
			                <p class="description-content" onclick="return todo_editable_field_tarea();">
			                	<?php 
			                	if(empty($tk->task_note))
			                	{
			                		echo "Add Note";
			                	}
			                	else
			                	{
			                		echo $tk->task_note;
			                	}
			                	?>                		
			                </p>
			                <i class="fas fa-pencil-alt" onclick="return todo_editable_field_tarea();"></i>
			              </div>
			              <div class="description-edit">
			              	<textarea class="form-control form-white" placeholder="Add Note" name="task_note"><?php echo $tk->task_note;?></textarea>
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit_tarea();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes_tarea();"  data-class="todo_editable" data-name="task_note" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			              <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
                	</div>
	        		<div class="col-4">
	        			<fieldset class="description">
			              <div class="description-details">
			                <p><?php 
			                if($tk->priority == 'No Priority')
			                            {
			                ?>
			                <span class="badge bg-success description-content" onclick="return todo_editable_field2();">No Priority</span>
			                <?php
			                            }
			                        elseif($tk->priority == 'Low Priority')
			                            {
			                ?>
			                <span class="badge bg-primary description-content" onclick="return todo_editable_field2();">Low Priority</span>
			                <?php
			                            }
			                        elseif($tk->priority == 'Medium Priority')
			                            {
			                ?>
			                <span class="badge bg-warning description-content" onclick="return todo_editable_field2();">Medium Priority</span>
			                <?php
			                            }
			                        elseif($tk->priority == 'High Priority')
			                            {
			                ?>
			                <span class="badge bg-danger description-content" onclick="return todo_editable_field2();">High Priority</span>
			                <?php
			                            }             
			                ?></p>
			                <i class="fas fa-angle-down" onclick="return todo_editable_field2();"></i>
			              </div>
			              <div class="description-edit">
			                <select class="form-select" name="priority" id="priority" required="">
			                    <option value="No Priority" <?php if($tk->priority == 'No Priority'){ echo "selected";}?>>No Priority</option>
			                    <option value="High Priority" <?php if($tk->priority == 'High Priority'){ echo "selected";}?>>High Priority</option>
			                    <option value="Medium Priority" <?php if($tk->priority == 'Medium Priority'){ echo "selected";}?>>Medium Priority</option>
			                    <option value="Low Priority" <?php if($tk->priority == 'Low Priority'){ echo "selected";}?>>Low Priority</option>
			                </select>
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes2();" data-class="todo_editable" data-name="priority" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
	        		</div>                	
                </div>

                <div class="row">	
	        		<div class="col">
	        			<fieldset class="description">
			              <div class="description-details">
			                <p><?php 
			                if($tk->task_reminder == 'No reminder')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">No reminder</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '5 minutes before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">5 minutes before</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '15 minutes before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">15 minutes before</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '30 minutes before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">30 minutes before</span>
			                <?php
			                            }   
			                        elseif($tk->task_reminder == '1 hour before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">1 hour before</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '4 hours before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">4 hours before</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '1 day before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">1 day before</span>
			                <?php
			                            }
			                        elseif($tk->task_reminder == '2 days before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">2 days before</span>
			                <?php
			                            }    
			                        elseif($tk->task_reminder == '1 week before')
			                            {
			                ?>
			                <span class="badge badge-soft-dark description-content" onclick="return todo_editable_field2();">1 week before</span>
			                <?php
			                            }        
			                ?></p>
			                <i class="fas fa-angle-down" onclick="return todo_editable_field2();"></i>
			              </div>
			              <div class="description-edit">
			                <select class="form-select" name="task_reminder" id="task_reminder" required="">
			                    <option value="No reminder" <?php if($tk->task_reminder == 'No reminder'){ echo "selected";}?>>No reminder</option>
			                    <option value="5 minutes before" <?php if($tk->task_reminder == '5 minutes before'){ echo "selected";}?>>5 minutes before</option>
			                    <option value="15 minutes before" <?php if($tk->task_reminder == '15 minutes before'){ echo "selected";}?>>15 minutes before</option>
			                    <option value="30 minutes before" <?php if($tk->task_reminder == '30 minutes before'){ echo "selected";}?>>30 minutes before</option>
			                    <option value="1 hour before" <?php if($tk->task_reminder == '1 hour before'){ echo "selected";}?>>1 hour before</option>
			                    <option value="4 hours before" <?php if($tk->task_reminder == '4 hours before'){ echo "selected";}?>>4 hours before</option>
			                    <option value="1 day before" <?php if($tk->task_reminder == '1 day before'){ echo "selected";}?>>1 day before</option>
			                    <option value="2 days before" <?php if($tk->task_reminder == '2 days before'){ echo "selected";}?>>2 days before</option>
			                    <option value="1 week before" <?php if($tk->task_reminder == '1 week before'){ echo "selected";}?>>1 week before</option>
			                </select>
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes2();" data-class="todo_editable" data-name="task_reminder" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
	        		</div>       		
	        	   	<div class="col">
	        			<fieldset class="description">
			              <div class="description-details" onmousemove="return todo_inside_datepicker();">			                
			                <p><span class="badge badge-soft-primary description-content" onclick="return todo_editable_field();"><?php echo $tk->task_start_date;?></span></p>
			                <i class="fas fa-calendar-alt" onclick="return todo_editable_field();"></i>
			              </div>
			              <div class="description-edit" style="line-height:13px">
			              	<div class="input-group" id="datepicker1<?php echo $tk->id;?>">
                                <input type="text" class="form-control task_start_date_class" id="task_start_date" name="task_start_date" onchange="return todo_edit_yes_calendar(this);" data-class="todo_editable" data-name="task_start_date" data-id="<?php echo $tk->id;?>" data-event-id="<?php echo $event_id;?>" placeholder="Start Date" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1<?php echo $tk->id;?>' data-provide="datepicker" value="<?php echo $tk->task_start_date;?>" data-date-autoclose="true" required="" style="width: 100%;">
                            </div>
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes_calendar();" data-event-id="<?php echo $event_id;?>" data-class="todo_editable" data-name="task_start_date" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
	        		</div>
	        		<div class="col">
	        			<fieldset class="description">
			              <div class="description-details">
			                <p><?php 
			                if($tk->task_allDay == 'true')
			                            {
                            $itd_t12hrs = 'true';
			                ?>
			                <span class="badge badge-soft-info description-content new_changed_start_time<?php echo $tk->id;?>" onclick="return todo_editable_field2();">All day</span>
			                <?php
			                            }
			                        else
			                            {
                            $itd_t12hrs = date('h:i A',strtotime($tk->task_start_time));
			                ?>
			                <span class="badge badge-soft-info description-content new_changed_start_time<?php echo $tk->id;?>" onclick="return todo_editable_field2();"><?php 
			                			$itd_t12hrs = date('h:i A',strtotime($tk->task_start_time));
	                                    echo $itd_t12hrs;?></span>
			                <?php
			                            }            
			                ?></p>
			                <i class="fas fa-clock" onclick="return todo_editable_field2();"></i>
			              </div>
			              <div class="description-edit">
			                <select class="form-select select2 changed_start_time<?php echo $tk->id;?>" name="task_start_time" id="task_start_time" required="">
                           <?php
                            $get_edetail = $this->Front_model->getEventTime($event_id);
    						$get_etime = $this->Front_model->getEventTimeUniqueKey($get_edetail->unique_key);
						    if($get_etime)
						    {
						     if($get_etime->event_end_date == $tk->task_start_date)  
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
						        	?>
						        	<option value="true" <?php if($tk->task_allDay == 'true'){ echo "selected";}?>>All day</option>
						        	<?php
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
			                <div class="description-controls float-end">
			                  <a onclick="return todo_dont_edit2();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
			                  <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light todo_edit_yes_but<?php echo $tk->id;?>" onclick="return todo_edit_yes2();" data-class="todo_editable" data-name="task_start_time" data-id="<?php echo $tk->id;?>"></i>
			                </div>
			              </div>
			                  <span class="text-danger req_tfield" style="display: none;">Field is required</span>
			            </fieldset>
	        		</div> 
	        	</div>

            </div>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
</div>
<div class="row mt-3 mb-2 ms-0 show_todo_progress<?php echo $event_id;?>">
	<div class="col-3">
		<button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" id="add_todobut" data-bs-toggle="modal" data-bs-target="#add-todo" title="Add todo">
                <span class="avatar-title bg-transparent text-reset">
                    <i class="bx bx-plus"></i>
                </span>
        </button>
	</div>
</div>
<?php
}
?>
</div>