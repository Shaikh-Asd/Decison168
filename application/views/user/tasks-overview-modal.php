<?php
$privilege_only_view = 'no';
if(!empty($this->session->userdata('d168_user_cor_id')))
{
$getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
if($getCompPackInfo)
{
  $privilege = "no";
  if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
  {
    $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
    if($getCompRolesInfo)
    {
      if($getCompRolesInfo->privilege != 'all')
      {
        $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
        if(in_array('view', $cus_privilege))
        {
          $privilege_only_view = 'yes';
        }
      }
      else
      {
        $privilege = "yes";
      }
    }      
  }
}
}

$check_permission = $this->Front_model->check_file_preview_access($tdetail->tproject_assign);

$getProject = $this->Front_model->getProjectDetailID($tdetail->tproject_assign);
if($getProject)
{
    $pcreated_by = $getProject->pcreated_by;
    $pmanager = $getProject->pmanager;        
}
$data_task = $this->Front_model->getTasksDetail($tdetail->tid);
if($data_task->flag == '1'){
        ?>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
        <?php
        if($tdetail)
        {
            $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
            $ActiveEmail_ID = "";
            if($get_active_Email_ID)
            {
                $ActiveEmail_ID = $get_active_Email_ID->email_address;
            }
            $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
            if($check_active_portfolio)
            {
    
            if($tdetail->tassignee == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'tnotify' => 'seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_TaskNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
    
                if($tdetail->review_notify == 'sent_yes')
                {
                $data = array(
                                'review_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
               $res = $this->Front_model->edit_TaskReviewNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
                }
            }
        //Arrive for review
            $pro_car = $this->Front_model->getProjectById($tdetail->tproject_assign);
            if($pro_car)
            {
                if($tdetail->po_review_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
                elseif($tdetail->po_review_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
            }
    
            $t_files1 = explode(',', $tdetail->tfnotify); 
                $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                                if($index1 !== FALSE){
                                    unset($t_files1[$index1]);
                                }
                                $final_mem1 = implode(',', $t_files1); 
                                $data = array(
                                                'tfnotify' => $final_mem1,
                                        );
                                        $data = $this->security->xss_clean($data); // xss filter
                                        $this->Front_model->edit_NewTask($data,$tdetail->tid);
                $check_pro_createdby = "";
                if(!empty($tdetail->tproject_assign))
                {
                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                    if($pro)
                    {
                        $check_pro_createdby = $pro->pcreated_by;
                    }
                }
                $check_pro_member_status = "";
                $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($tdetail->tproject_assign);
                if($check_ProjectMToClear)
                {
                    $check_pro_member_status = $check_ProjectMToClear->status;
                }
                if(($tdetail->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
                {
                    $check_suggested = $this->Front_model->check_project_suggested_member($tdetail->tproject_assign);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                            <div class="row mb-2">
                            <?php
                          if($check_suggested)
                            {
                          ?>
                          <div class="col-lg-12">Project Request is not send from Project Owner. Task Name: <?php echo $tdetail->tname;?></div>
                          <?php
                            }
                            elseif((empty($check_suggested)) && ($check_pro_member_status != 'send'))
                            {
                            ?>
                            <div class="col-lg-12">Not Allowed to View Task</div>
                            <?php
                            }
                            else
                            {
                          ?>
                            <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $tdetail->tname;?></div>
                            <div class="col-lg-2">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                     Accept Request
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                     Request More Info
                                </a>
                            </div>
                          <?php
                            }
                          ?>
                        </div>
                           </div>
                       </div>
                   </div>
                </div>
                <?php
                }
                else
                {
        ?> 
                            <div data-simplebar style="max-height: 400px;"> 
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                   <div class="avatar-sm me-4">
                                                        <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                <i class="bx bx-detail"></i>
                                                        </span>
                                                   </div>
    
                                                    <div class="media-body overflow-hidden">
                                                        <span>
                                                            <h5 class="font-size-15" style="padding: 8px;"><strong>TASK:</strong> <b><?php echo $tdetail->tname;?></b></h5>
                                                            <?php 
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                                if($_COOKIE["d168_selectedportfolio"] == $tdetail->portfolio_id)
                                                                {
                                                                // if(!empty($tdetail->tproject_assign))
                                                                //                 {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
        $getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        if($getMydetail)
        {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
            {
              if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
              }
              else
              {
                $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
            }
        }
    }
    else
    {
      
        $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
        if($getCompPackInfo)
        {
          $privilege = "no";
          if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
          {
            $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
            if($getCompRolesInfo)
            {
              if($getCompRolesInfo->privilege != 'all')
              {
                $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
                if(in_array('task', $cus_privilege))
                {
                  $privilege = "yes";
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
            {
              if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
              }
              else
              {
                $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
              }
            }
          }
        }    
      
    }
                                                                                //}
    if($privilege_only_view == 'no')
    {
                                                            ?>
                                                            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                                                                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                                                                <input type="hidden" name="tid" value="<?php echo $tdetail->tid;?>">
                                                                <input type="hidden" name="port_id" value="<?php echo $tdetail->portfolio_id;?>">
                                                                <input type="hidden" name="task_dd" value="<?php echo $tdetail->tdue_date;?>">
                                                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Sub Task</button> 
                                                            </form>
                                                            <a href="<?php echo base_url("tasks-edit/".$tdetail->tid)?>" class="btn btn-sm btn-d text-white"><i class="mdi mdi-file-edit"></i> Edit Task</a>
                                                            <?php
    }
                                                            $check_pro_createdby = "";
                                                                if(!empty($tdetail->tproject_assign))
                                                                {
                                                                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                    if($pro)
                                                                    {
                                                                        $check_pro_createdby = $pro->pcreated_by;
                                                                    }
                                                                }
                                                               if(($tdetail->tassignee == $this->session->userdata('d168_id')) || ($tdetail->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
                                                                {
    if($privilege_only_view == 'no')
    {
                                                            $data_task = $this->Front_model->getTasksDetail($tdetail->tid);
             
                                                         if($data_task->flag == '1'){
                                                         if($data_task->start_timer_new != "" ){
                                                        // Old time
                                                        $old_time = $data_task->start_timer_new;
                                                        }
                                                        else{
                                                        $old_time = $data_task->start_timer;
                                                        }
    
                                                            // Current time
                                                         $current_time = date("Y-m-d H:i:s");
                                                            // Create DateTime objects for old and current times
                                                         $old_datetime = new DateTime($old_time);
                                                         $current_datetime = new DateTime($current_time);
                                                            // Calculate the time difference
                                                         $interval_new = $current_datetime->diff($old_datetime);
                                                            // Access the time difference components
                                                         $diff_hours = $interval_new->h;
                                                         $diff_minutes = $interval_new->i;
                                                         $diff_seconds = $interval_new->s;
                                                         $timer = $diff_hours.':'.$diff_minutes.':'.$diff_seconds;
                                                         $timer = sprintf("%02d:%02d:%02d", $diff_hours, $diff_minutes, $diff_seconds);
                                                         $time1 = $timer;
                                                         $time2 = $data_task->tracked_time;
    
                                                         $time1 = new DateTime($time1);
                                                         $time2 = new DateTime($time2);
    
                                                         $interval = new DateInterval('PT' . $time1->format('H') . 'H' . $time1->format('i') . 'M' . $time1->format('s') . 'S');
                                                         $time2->add($interval);
    
                                                         $timer = $time2->format('H:i:s');
                                                         }
                                                        
                                                         else{
                                                           if($data_task->tracked_time != ""){
                                                           $timer = $data_task->tracked_time;
                                                           }
                                                           else{
                                                           $timer = '00:00:00';
                                                           }
                                                         }
                                                         ?>
                                                            <span class="timerBtn_<?php echo $tdetail->tid;?> timerBtn_new_<?php echo $tdetail->tid;?>" style="margin-left: 25px;font-size: 20px; margin-top: 2px;">
                                                            <i class="bx bx-play-circle" onclick="toggleTimer3(<?php echo $tdetail->tid;?>);"></i>
                                                            </span>
                                                            <span class="counter_<?php echo $tdetail->tid;?> counter_modal_<?php echo $tdetail->tid;?>" data-id="<?php echo $tdetail->tid;?>" style="margin-left: 10px;font-size: 20px;"><?php echo $timer;?></span>
                                                            <input type="hidden" value="<?php echo $data_task->flag;?>" id="timer_flag_<?php echo $data_task->flag;?>" class="timer_flag_<?php echo $data_task->flag;?>"/>
                                                            <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $tdetail->tid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                            <?php
                                                            $previous_url = $_SERVER['HTTP_REFERER'];
                                                            $previous_url_array = explode('/', $previous_url);
                                                            $previous_page_name = end($previous_url_array);
                                                            if($previous_page_name == 'file-cabinet'){
                                                                ?>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                                <?php
                                                            }
                                                            ?>
        <?php
    }
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
        if($getMydetail)
        {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
            {
              if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
              }
              else
              {
                $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
            }
        }
    }
    else
    {
      
        $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
        if($getCompPackInfo)
        {
          $privilege = "no";
          if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
          {
            $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
            if($getCompRolesInfo)
            {
              if($getCompRolesInfo->privilege != 'all')
              {
                $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
                if(in_array('task', $cus_privilege))
                {
                  $privilege = "yes";
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
           if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
            {
              if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
              }
              else
              {
                $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            } 
          }
        }    
      
    }
                                                                }
                                                            
                                                                }
                                                                else
                                                                {
                                                                    echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                            }
                                                            ?>      
                                                        </span>
                                                        
                                                    </div>
                                                </div>
    
                                                <h5 class="font-size-15 mt-4">Task Code :</h5>
                                                <p><?php echo $tdetail->tcode;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Notes :</h5>
                                                <p class="pdes"><?php echo $tdetail->tnote;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Description :</h5>
    
                                                <p class="pdes"><?php 
                                                if(!empty($tdetail->tdes))
                                                    {
                                                        echo $tdetail->tdes;
                                                    }
                                                ?></p>
    
                                                <h5 class="font-size-15 mt-4">Tasks Links and Comments :</h5>
                                                <p><?php if(!empty($tdetail->tlink))
                                                                {
                                                                    $tlink = explode(',', $tdetail->tlink);
                                                                    $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                                    $tlcount = count($tlink);
                                                                    if($tlcount > 0){
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for ($i=0; $i<$tlcount; $i++){
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                        <a href="<?php echo $tlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                        <?php
                                                                                            echo $tlink[$i];
                                                                                        ?>
                                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                                        <?php
                                                                                        if(!empty($tlink_comment[$i])){
                                                                                            echo $tlink_comment[$i];
                                                                                        }
                                                                                        ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Files :</h5>
                                                <p><?php if(!empty($tdetail->tfile))
                                                {
                                                    $tfile = explode(',', $tdetail->tfile);
                                                    $count = count($tfile);
                                                    if($count > 0)
                                                    {
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for($i=0; $i<$count; $i++)
                                                        {
                                                            $tfile_name = $tfile[$i];
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
    <?php
    if($privilege_only_view == 'no')
    {
    ?>                                                                    
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?>                                                                    
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                    <div class="col-3">
    <?php 
    if($privilege_only_view == 'no')
    {
    ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
    
                                                                        <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
    <?php
    }
    
    if($privilege_only_view == 'no')
    {
    ?> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Subtasks :</h5>
                                                <p><?php 
                                                $Check_Task_Subtasks = $this->Front_model->Check_Task_Subtasks2($tdetail->tid);
                                                if($Check_Task_Subtasks)
                                                {
                                                ?>
                                                    <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        foreach($Check_Task_Subtasks as $subtask)
                                                        {
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <?php
                                                                            if($subtask->ststatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                        <i class="mdi mdi-checkbox-blank-circle-outline me-1 h4" title="To Do"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_progress')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-dots-horizontal-circle-outline me-1 h4" title="In Progress"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_review')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi mdi-progress-check me-1 h4" title="In Review"></i>
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'done')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-check-circle-outline me-1 text-d h4" title="Done"></i>
                                                                        <?php
                                                                        } 
                                                                        ?>
                                                                        <a href="javascript: void(0);" class="nameLink h6" onclick="return SubtaskOverviewModal('<?php echo $subtask->stid;?>')"><?php echo $subtask->stcode." : ".$subtask->stname;?></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?></p>
    
                                                <div class="row m-4">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                        <?php
                                                                                    $check_page = $this->Front_model->ProjectDetail($tdetail->tproject_assign);
                                                                                    if($check_page)
                                                                                    {
                                                                                        $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                            <a class="nameLink" href="<?php echo base_url('projects-overview/'.$tdetail->tproject_assign);?>">
                                                                                <?php echo $pro->pname;?>
                                                                            </a>
                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                        <a class="nameLink" href="<?php echo base_url('projects-overview-accepted/'.$tdetail->tproject_assign);?>">
                                                                                <?php echo $pro->pname;?>
                                                                        </a>
                                                                        <?php
                                                                                    }
                                                                        ?>
                                                                        </p>
                                                                        <?php
                                                                                }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                            $stud = $this->Front_model->getStudentById($tdetail->tassignee);
                                                                             echo $stud->first_name.' '.$stud->last_name;
                                                                            ?>
                                                                        </p>                                                         
                                                                        <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($tdetail->tcreated_date));?></p>
                                                                        <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $tdetail->first_name.' '.$tdetail->last_name;?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                        if($pro){
                                                                                if($pro->portfolio_id != 0)
                                                                                {
                                                                                    $portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                                                    if($portfolio){
                                                                                    if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                                }
                                                                                }
                                                                                } 
                                                                            ?></p>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($tdetail->tdue_date));?></p>
                                                                        <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $tdetail->tpriority;?></p>
                                                                        <?php
                                                                        $tid = $tdetail->tid;
                                                                        $assignee_status = $this->Front_model->check_assignee_status($tid);
    if($privilege_only_view == 'no')
    {
                                                                        if($assignee_status)
                                                                        {
                                                                            if($assignee_status->tstatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            To Do <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'in_progress')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Progress <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'in_review')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Review <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'done')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            Done <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        elseif($check_pro_createdby == $this->session->userdata('d168_id'))
                                                                        {
                                                                           if($tdetail->tstatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            To Do <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'in_progress')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Progress <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'in_review')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Review <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'done')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            Done <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            } 
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                            <?php
                                                                                    if($tdetail->tstatus == 'to_do')
                                                                                    {
                                                                                        echo "To Do";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_progress')
                                                                                    {
                                                                                        echo "In Progress";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_review')
                                                                                    {
                                                                                        echo "In Review";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'done')
                                                                                    {
                                                                                        echo "Done";
                                                                                    } 
                                                                            ?>
                                                                        </p>
                                                                        <?php
                                                                        }
    }
    else
    {
    ?>
    <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
        <?php
                if($tdetail->tstatus == 'to_do')
                {
                    echo "To Do";
                }
                elseif($tdetail->tstatus == 'in_progress')
                {
                    echo "In Progress";
                }
                elseif($tdetail->tstatus == 'in_review')
                {
                    echo "In Review";
                }
                elseif($tdetail->tstatus == 'done')
                {
                    echo "Done";
                } 
        ?>
    </p>
    <?php
    }
                                                                        ?>                                                             
                                                                    </div>
                                                                </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div><!-- end col -->   
                                        <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-body">
        <?php
        if($tdetail->tproject_assign != '0')
        {
           //$comments = $this->Front_model->getProjectComments($tdetail->tproject_assign);
           $comments = $this->Front_model->getTaskComments($tdetail->tid);
           $check_Powner = $this->Front_model->getProjectById($tdetail->tproject_assign);
           $checkpro_Owner = "";
           $pownerName = "";
           if($check_Powner)
           {
                $Powner_detail = $this->Front_model->getStudentById($check_Powner->pcreated_by);  
                if($Powner_detail)  
                {
                    $pownerName = $Powner_detail->first_name.' '.$Powner_detail->last_name;
                }
                if($check_Powner->pcreated_by == $this->session->userdata('d168_id'))
                {
                    $checkpro_Owner = "owner";
                }
                else
                {
                    $checkpro_Owner = "team";
                }
           }
           if($checkpro_Owner == "owner")
           {
                $mentionList = $this->Front_model->MentionList($tdetail->tproject_assign); 
           }
           elseif($checkpro_Owner == "team")
           {
                $MentionListforAccepted = $this->Front_model->MentionListforAccepted($tdetail->tproject_assign);
                //print_r($MentionListforAccepted);
                $ownerMention[]['name'] = $pownerName;
                //print_r($ownerMention);
                $mentionList = array_merge($MentionListforAccepted,$ownerMention);
           }
        }
        else
        {
            $comments = $this->Front_model->getTaskComments($tdetail->tid);
            $mentionList = array();
        }
        ?>
        <!-- Start Comment section -->
        <h4 class="card-title">Comment Section</h4>
        <div class="w-100 user-chat">
            <div class="card">        
                <div id="scrollbottom" class="chat-conversation p-2">
                    <ul class="list-unstyled mb-0 append_new_msg" data-simplebar style="max-height: 250px;">
                        <?php   
                        if($comments){
                            $comment_date = "";
                            foreach ($comments as $cm) {
                                $msg_date = date("Y-m-d", strtotime($cm->c_created_date));
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
                                        <span class="title"><?php echo date("j M, Y", strtotime($cm->c_created_date));?></span>
                                    </div>
                                </li>
                                <?php
                                }
                                $studdel = $this->Front_model->getStudentById($cm->c_created_by);
                                if($cm->c_created_by == $this->session->userdata('d168_id')){
                                    $today_date = date("Y-m-d H:i:s");
                                    $delete_allow = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($cm->c_created_date)));
                                    ?>
                                <li class="right" id="msg_id<?php echo $cm->cid?>">
                                    <div class="conversation-list">
                                        <?php
                                        if(($today_date < $delete_allow) && (empty($cm->delete_msg)))
                                        {
                                        ?>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                              </a>
                                            <div class="dropdown-menu">
                                                <!-- <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a> -->
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment('<?php echo $cm->cid?>');">Delete</a>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">Me</div>
                                            <?php
                                            if($cm->delete_msg == 'yes')
                                            {
                                            ?>
                                            <p>
                                                <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                            </p>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <p>
                                                <?php echo $cm->message; ?>
                                            </p>
                                            <?php
                                            }
                                            ?>
                                            <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                        </div>
                                    </div>
                                </li>
                                    <?php
                                }else{
                                    ?>
                                <li>
                                    <div class="conversation-list">
                                        <!-- <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                              </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div> -->
                                        <div class="ctext-wrap">
                                            <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?></div>
                                            <?php
                                            if($cm->delete_msg == 'yes')
                                            {
                                            ?>
                                            <p>
                                                <i><i class="mdi mdi-block-helper"></i> this message was deleted</i>
                                            </p>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <p>
                                                <?php echo $cm->message; ?>
                                            </p>
                                            <?php
                                            }
                                            ?>
                                            <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                        </div>
                                    </div>
                                </li>
                                    <?php
                                } 
                                $comment_date = $msg_date;                       
                            }
                        }else{
                            ?>
                            <p class="text-muted p-2 no_comment">No comments...</p>
                            <?php
                        }
                        ?>                      
                    </ul>
                </div>
                <div class="p-3 chat-input-section">
                    <form method="POST" name="comment_form" id="comment_form" class="comment_form" autocomplete="off">
                        <div class="row">
                            <div class="col" style="padding-right: 0px !important;">
                                <div class="position-relative">
                                    <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                                    <span id="messageErr" class="text-danger"></span>
                                    <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign; ?>">
                                    <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid; ?>">
                                    <input type="hidden" name="stid" id="stid" value="0">
                                    <input type="hidden" name="area_type" value="from_modal">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="comment_form_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                        <img id="loader6" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    </form>
                </div>
            </div>
        </div>
        <!-- End Comment section -->
                                            </div>
                                        </div>
                                        </div><!-- end col -->
    
                            </div> <!-- end row -->
                        </div>          
        <?php
            }
        }
        else
        {
        ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        }
        ?>
        <script src="<?php echo base_url('assets/js/front.js');?>"></script>
        <script src="<?php echo base_url();?>assets/js/mention.js"></script>
        <script>
        var jArray= <?php echo json_encode($mentionList);?>;
        //console.log(jArray);
         var myMention = new Mention({
            input: document.querySelector('#message'),
            options: jArray
         })
        </script>
        <?php
    // } 
}
else{
    if($previous_page_name == 'file-cabinet'){
        if($tdetail)
        {
            $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
            $ActiveEmail_ID = "";
            if($get_active_Email_ID)
            {
                $ActiveEmail_ID = $get_active_Email_ID->email_address;
            }
            $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
            if($check_active_portfolio)
            {
    
            if($tdetail->tassignee == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'tnotify' => 'seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_TaskNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
    
                if($tdetail->review_notify == 'sent_yes')
                {
                $data = array(
                                'review_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
               $res = $this->Front_model->edit_TaskReviewNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
                }
            }
        //Arrive for review
            $pro_car = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
            if($pro_car)
            {
                if($tdetail->po_review_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
                elseif($tdetail->po_review_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
            }
    
            $t_files1 = explode(',', $tdetail->tfnotify); 
                $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                                if($index1 !== FALSE){
                                    unset($t_files1[$index1]);
                                }
                                $final_mem1 = implode(',', $t_files1); 
                                $data = array(
                                                'tfnotify' => $final_mem1,
                                        );
                                        $data = $this->security->xss_clean($data); // xss filter
                                        $this->Front_model->edit_NewTask($data,$tdetail->tid);
                $check_pro_createdby = "";
                if(!empty($tdetail->tproject_assign))
                {
                    $pro = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
                    if($pro)
                    {
                        $check_pro_createdby = $pro->pcreated_by;
                    }
                }
                $check_pro_member_status = "";
                $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($tdetail->tproject_assign);
                if($check_ProjectMToClear)
                {
                    $check_pro_member_status = $check_ProjectMToClear->status;
                }
                if(($tdetail->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
                {
                    $check_suggested = $this->Front_model->file_itcheck_project_suggested_member($tdetail->tproject_assign);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                            <div class="row mb-2">
                            <?php
                          if($check_suggested)
                            {
                          ?>
                          <div class="col-lg-12">Project Request is not send from Project Owner. Task Name: <?php echo $tdetail->tname;?></div>
                          <?php
                            }
                            elseif((empty($check_suggested)) && ($check_pro_member_status != 'send'))
                            {
                            ?>
                            <div class="col-lg-12">Not Allowed to View Task</div>
                            <?php
                            }
                            else
                            {
                          ?>
                            <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $tdetail->tname;?></div>
                            <div class="col-lg-2">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                     Accept Request
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                     Request More Info
                                </a>
                            </div>
                          <?php
                            }
                          ?>
                        </div>
                           </div>
                       </div>
                   </div>
                </div>
                <?php
                }
                else
                {
        ?> 
                            <div data-simplebar style="max-height: 400px;"> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                   <div class="avatar-sm me-4">
                                                        <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                <i class="bx bx-detail"></i>
                                                        </span>
                                                   </div>
    
                                                    <div class="media-body overflow-hidden">
                                                        <span>
                                                            <h5 class="font-size-15" style="padding: 8px;"><strong>TASK:</strong> <b><?php echo $tdetail->tname;?></b></h5>
                                                            <?php 
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                                if($_COOKIE["d168_selectedportfolio"] == $tdetail->portfolio_id)
                                                                {
                                                                    $check_pro_createdby = "";
                                                                    if(!empty($tdetail->tproject_assign))
                                                                    {
                                                                        $pro = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
                                                                        if($pro)
                                                                        {
                                                                            $check_pro_createdby = $pro->pcreated_by;
                                                                        }
                                                                    }
                                                                   if(($tdetail->tassignee == $this->session->userdata('d168_id')) || ($tdetail->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
                                                                    {
                                                                        if($privilege_only_view == 'no')
                                                                        {
    
                                                                        ?>
                                                                        <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $tdetail->tid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                            }
                                                            ?>      
                                                        </span>
                                                    </div>
                                                </div>
    
                                                <h5 class="font-size-15 mt-4">Task Code :</h5>
                                                <p><?php echo $tdetail->tcode;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Notes :</h5>
                                                <p class="pdes"><?php echo $tdetail->tnote;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Description :</h5>
    
                                                <p class="pdes"><?php 
                                                if(!empty($tdetail->tdes))
                                                    {
                                                        echo $tdetail->tdes;
                                                    }
                                                ?></p>
    
                                                <h5 class="font-size-15 mt-4">Tasks Links and Comments :</h5>
                                                <p><?php if(!empty($tdetail->tlink))
                                                                {
                                                                    $tlink = explode(',', $tdetail->tlink);
                                                                    $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                                    $tlcount = count($tlink);
                                                                    if($tlcount > 0){
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for ($i=0; $i<$tlcount; $i++){
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                        <a href="<?php echo $tlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                        <?php
                                                                            echo $tlink[$i];
                                                                        ?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                    <?php
                                                                    if(!empty($tlink_comment[$i])){
                                                                        echo $tlink_comment[$i];
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Files :</h5>
                                                <p><?php if(!empty($tdetail->tfile))
                                                {
                                                    $tfile = explode(',', $tdetail->tfile);
                                                    $count = count($tfile);
                                                    if($count > 0)
                                                    {
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for($i=0; $i<$count; $i++)
                                                        {
                                                            $tfile_name = $tfile[$i];
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
    <?php
    if($privilege_only_view == 'no')
    {
    ?>                                                                     
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?>                                                                     
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                    <div class="col-3">
    <?php 
    if($privilege_only_view == 'no')
    {
    ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
    
                                                                        <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
    <?php
    }
    
    if($privilege_only_view == 'no')
    {
    ?>
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?>
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Subtasks :</h5>
                                                <p><?php 
                                                $Check_Task_Subtasks = $this->Front_model->file_itCheck_Task_Subtasks2($tdetail->tid);
                                                if($Check_Task_Subtasks)
                                                {
                                                ?>
                                                    <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        foreach($Check_Task_Subtasks as $subtask)
                                                        {
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <?php
                                                                            if($subtask->ststatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                        <i class="mdi mdi-checkbox-blank-circle-outline me-1 h4" title="To Do"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_progress')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-dots-horizontal-circle-outline me-1 h4" title="In Progress"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_review')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi mdi-progress-check me-1 h4" title="In Review"></i>
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'done')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-check-circle-outline me-1 text-d h4" title="Done"></i>
                                                                        <?php
                                                                        } 
                                                                        ?>
                                                                        <a href="javascript: void(0);" class="nameLink h6" onclick="return SubtaskOverviewModal('<?php echo $subtask->stid;?>')"><?php echo $subtask->stcode." : ".$subtask->stname;?></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?></p>
    
                                                <div class="row m-4">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                        <?php
                                                                                    $check_page = $this->Front_model->file_itProjectDetail($tdetail->tproject_assign);
                                                                                    if($check_page)
                                                                                    {
                                                                                        $pro = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
                                                                                        echo $pro->pname;
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $pro = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
                                                                                        echo $pro->pname;
                                                                                    }
                                                                        ?>
                                                                        </p>
                                                                        <?php
                                                                                }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                            $stud = $this->Front_model->getStudentById($tdetail->tassignee);
                                                                             echo $stud->first_name.' '.$stud->last_name;
                                                                            ?>
                                                                        </p>                                                         
                                                                        <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($tdetail->tcreated_date));?></p>
                                                                        <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $tdetail->first_name.' '.$tdetail->last_name;?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                                    $pro = $this->Front_model->file_itgetProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                        if($pro){
                                                                                if($pro->portfolio_id != 0)
                                                                                {
                                                                                    $portfolio = $this->Front_model->file_itgetPortfolio2($pro->portfolio_id);
                                                                                    if($portfolio){
                                                                                    if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                                }
                                                                                }
                                                                                } 
                                                                            ?></p>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($tdetail->tdue_date));?></p>
                                                                        <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $tdetail->tpriority;?></p>
                                                                        <?php
                                                                        $tid = $tdetail->tid;
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                            <?php
                                                                                    if($tdetail->tstatus == 'to_do')
                                                                                    {
                                                                                        echo "To Do";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_progress')
                                                                                    {
                                                                                        echo "In Progress";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_review')
                                                                                    {
                                                                                        echo "In Review";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'done')
                                                                                    {
                                                                                        echo "Done";
                                                                                    } 
                                                                            ?>
                                                                        </p>                                                           
                                                                    </div>
                                                                </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div><!-- end col -->
                            </div> <!-- end row -->
                        </div>          
        <?php
            }
        }
        else
        {
        ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        }
    }else{
        ?>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
        <?php
        if($tdetail)
        {
            $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
            $ActiveEmail_ID = "";
            if($get_active_Email_ID)
            {
                $ActiveEmail_ID = $get_active_Email_ID->email_address;
            }
            $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
            if($check_active_portfolio)
            {
    
            if($tdetail->tassignee == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'tnotify' => 'seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_TaskNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
    
                if($tdetail->review_notify == 'sent_yes')
                {
                $data = array(
                                'review_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
               $res = $this->Front_model->edit_TaskReviewNotify($data,$tdetail->tproject_assign,$tdetail->tassignee,$tdetail->tid);
                }
            }
        //Arrive for review
            $pro_car = $this->Front_model->getProjectById($tdetail->tproject_assign);
            if($pro_car)
            {
                if($tdetail->po_review_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
                elseif($tdetail->po_review_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
                {
                    $data = array(
                                    'po_review_notify' => 'sent_seen',
                                );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
                }
            }
    
            $t_files1 = explode(',', $tdetail->tfnotify); 
                $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                                if($index1 !== FALSE){
                                    unset($t_files1[$index1]);
                                }
                                $final_mem1 = implode(',', $t_files1); 
                                $data = array(
                                                'tfnotify' => $final_mem1,
                                        );
                                        $data = $this->security->xss_clean($data); // xss filter
                                        $this->Front_model->edit_NewTask($data,$tdetail->tid);
                $check_pro_createdby = "";
                if(!empty($tdetail->tproject_assign))
                {
                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                    if($pro)
                    {
                        $check_pro_createdby = $pro->pcreated_by;
                    }
                }
                $check_pro_member_status = "";
                $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($tdetail->tproject_assign);
                if($check_ProjectMToClear)
                {
                    $check_pro_member_status = $check_ProjectMToClear->status;
                }
                if(($tdetail->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
                {
                    $check_suggested = $this->Front_model->check_project_suggested_member($tdetail->tproject_assign);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                            <div class="row mb-2">
                            <?php
                          if($check_suggested)
                            {
                          ?>
                          <div class="col-lg-12">Project Request is not send from Project Owner. Task Name: <?php echo $tdetail->tname;?></div>
                          <?php
                            }
                            elseif((empty($check_suggested)) && ($check_pro_member_status != 'send'))
                            {
                            ?>
                            <div class="col-lg-12">Not Allowed to View Task</div>
                            <?php
                            }
                            else
                            {
                          ?>
                            <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $tdetail->tname;?></div>
                            <div class="col-lg-2">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                     Accept Request
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                     Request More Info
                                </a>
                            </div>
                          <?php
                            }
                          ?>
                        </div>
                           </div>
                       </div>
                   </div>
                </div>
                <?php
                }
                else
                {
        ?> 
                            <div data-simplebar style="max-height: 400px;"> 
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                   <div class="avatar-sm me-4">
                                                        <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                                <i class="bx bx-detail"></i>
                                                        </span>
                                                   </div>
    
                                                    <div class="media-body overflow-hidden">
                                                        <span>
                                                            <h5 class="font-size-15" style="padding: 8px;"><strong>TASK:</strong> <b><?php echo $tdetail->tname;?></b></h5>
                                                            <?php 
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                                if($_COOKIE["d168_selectedportfolio"] == $tdetail->portfolio_id)
                                                                {
                                                                // if(!empty($tdetail->tproject_assign))
                                                                //                 {
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
        $getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        if($getMydetail)
        {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
            {
              if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
              }
              else
              {
                $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
            }
        }
    }
    else
    {
      
        $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
        if($getCompPackInfo)
        {
          $privilege = "no";
          if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
          {
            $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
            if($getCompRolesInfo)
            {
              if($getCompRolesInfo->privilege != 'all')
              {
                $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
                if(in_array('task', $cus_privilege))
                {
                  $privilege = "yes";
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
            {
              if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                <?php
              }
              else
              {
                $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
                $getTaskCount = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
                if($getPackDetail)
                {
                  $total_tasks = trim($getPackDetail->pack_tasks);
                  $used_tasks = trim($getTaskCount['task_count_rows']);
                  $check_type = is_numeric($total_tasks);
                  if($check_type == 'true')
                  {
                    if($used_tasks < $total_tasks)
                    {
                      ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                    }
                    else
                    {
                        ?>
                            <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <form action="<?php echo base_url('tasks-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                        <input type="hidden" name="gid" value="<?php echo $tdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $tdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $tdetail->dept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Task</button> 
                    </form>
                    <?php
                  }
                }
              }
            }
          }
        }    
      
    }
                                                                                //}
    if($privilege_only_view == 'no')
    {
                                                            ?>
                                                            <form action="<?php echo base_url('subtasks-create');?>" method="post" style="display: inline;">
                                                                <input type="hidden" name="pid" value="<?php echo $tdetail->tproject_assign;?>">
                                                                <input type="hidden" name="tid" value="<?php echo $tdetail->tid;?>">
                                                                <input type="hidden" name="port_id" value="<?php echo $tdetail->portfolio_id;?>">
                                                                <input type="hidden" name="task_dd" value="<?php echo $tdetail->tdue_date;?>">
                                                                <button type="submit" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Add Sub Task</button> 
                                                            </form>
                                                            <a href="<?php echo base_url("tasks-edit/".$tdetail->tid)?>" class="btn btn-sm btn-d text-white"><i class="mdi mdi-file-edit"></i> Edit Task</a>
                                                            <?php
    }
                                                            $check_pro_createdby = "";
                                                                if(!empty($tdetail->tproject_assign))
                                                                {
                                                                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                    if($pro)
                                                                    {
                                                                        $check_pro_createdby = $pro->pcreated_by;
                                                                    }
                                                                }
                                                               if(($tdetail->tassignee == $this->session->userdata('d168_id')) || ($tdetail->tcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id')))  
                                                                {
    if($privilege_only_view == 'no')
    {
                                                            $data_task = $this->Front_model->getTasksDetail($tdetail->tid);
             
                                                         if($data_task->flag == '1'){
                                                         if($data_task->start_timer_new != "" ){
                                                        // Old time
                                                        $old_time = $data_task->start_timer_new;
                                                        }
                                                        else{
                                                        $old_time = $data_task->start_timer;
                                                        }
    
                                                            // Current time
                                                         $current_time = date("Y-m-d H:i:s");
                                                            // Create DateTime objects for old and current times
                                                         $old_datetime = new DateTime($old_time);
                                                         $current_datetime = new DateTime($current_time);
                                                            // Calculate the time difference
                                                         $interval_new = $current_datetime->diff($old_datetime);
                                                            // Access the time difference components
                                                         $diff_hours = $interval_new->h;
                                                         $diff_minutes = $interval_new->i;
                                                         $diff_seconds = $interval_new->s;
                                                         $timer = $diff_hours.':'.$diff_minutes.':'.$diff_seconds;
                                                         $timer = sprintf("%02d:%02d:%02d", $diff_hours, $diff_minutes, $diff_seconds);
                                                         $time1 = $timer;
                                                         $time2 = $data_task->tracked_time;
    
                                                         $time1 = new DateTime($time1);
                                                         $time2 = new DateTime($time2);
    
                                                         $interval = new DateInterval('PT' . $time1->format('H') . 'H' . $time1->format('i') . 'M' . $time1->format('s') . 'S');
                                                         $time2->add($interval);
    
                                                         $timer = $time2->format('H:i:s');
                                                         }
                                                        
                                                         else{
                                                           if($data_task->tracked_time != ""){
                                                           $timer = $data_task->tracked_time;
                                                           }
                                                           else{
                                                           $timer = '00:00:00';
                                                           }
                                                         }
                                                         ?>
                                                            <span class="timerBtn_<?php echo $tdetail->tid;?> timerBtn_new_<?php echo $tdetail->tid;?>" style="margin-left: 25px;font-size: 20px; margin-top: 2px;">
                                                            <i class="bx bx-play-circle" onclick="toggleTimer3(<?php echo $tdetail->tid;?>);"></i>
                                                            </span>
                                                            <span class="counter_<?php echo $tdetail->tid;?> counter_modal_<?php echo $tdetail->tid;?>" data-id="<?php echo $tdetail->tid;?>" style="margin-left: 10px;font-size: 20px;"><?php echo $timer;?></span>
                                                            <input type="hidden" value="<?php echo $data_task->flag;?>" id="timer_flag_<?php echo $data_task->flag;?>" class="timer_flag_<?php echo $data_task->flag;?>"/>
                                                            <a href="javascript:void(0)" onclick="return tasks_delete('<?php echo $tdetail->tid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                            <?php
                                                            $previous_url = $_SERVER['HTTP_REFERER'];
                                                            $previous_url_array = explode('/', $previous_url);
                                                            $previous_page_name = end($previous_url_array);
                                                            if($previous_page_name == 'file-cabinet'){
                                                                ?>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_task('<?php echo $tdetail->tid;?>');" style="padding: 0 !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                                <?php
                                                            }
                                                            ?>
        <?php
    }
    if(empty($this->session->userdata('d168_user_cor_id')))
    {
        if($getMydetail)
        {
            if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
            {
              if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
              }
              else
              {
                $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCount($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
            }
        }
    }
    else
    {
      
        $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
        if($getCompPackInfo)
        {
          $privilege = "no";
          if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
          {
            $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
            if($getCompRolesInfo)
            {
              if($getCompRolesInfo->privilege != 'all')
              {
                $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
                if(in_array('task', $cus_privilege))
                {
                  $privilege = "yes";
                }
              }
              else
              {
                $privilege = "yes";
              }
            }      
          }
          if(($this->session->userdata('d168_user_role_in_comp') == 'employee') || ($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
           if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
            {
              if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
              {
                ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <?php
              }
              else
              {
                $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
                $getTaskCount2 = $this->Front_model->getProject_TaskCountCorp($tdetail->tproject_assign);
                if($getPackDetail2)
                {
                  $total_tasks2 = trim($getPackDetail2->pack_tasks);
                  $used_tasks2 = trim($getTaskCount2['task_count_rows']);
                  $check_type2 = is_numeric($total_tasks2);
                  if($check_type2 == 'true')
                  {
                    if($used_tasks2 < $total_tasks2)
                    {
                      ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                    }
                    else
                    {
                        ?>
                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return limit_Exceeds_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                        <?php
                    }
                  }
                  else
                  {
                    ?> 
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_task('<?php echo $tdetail->tid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                    <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            } 
          }
        }    
      
    }
                                                                }
                                                            
                                                                }
                                                                else
                                                                {
                                                                    echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                            }
                                                            ?>      
                                                        </span>
                                                        
                                                    </div>
                                                </div>
    
                                                <h5 class="font-size-15 mt-4">Task Code :</h5>
                                                <p><?php echo $tdetail->tcode;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Notes :</h5>
                                                <p class="pdes"><?php echo $tdetail->tnote;?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Description :</h5>
    
                                                <p class="pdes"><?php 
                                                if(!empty($tdetail->tdes))
                                                    {
                                                        echo $tdetail->tdes;
                                                    }
                                                ?></p>
    
                                                <h5 class="font-size-15 mt-4">Tasks Links and Comments :</h5>
                                                <p><?php if(!empty($tdetail->tlink))
                                                                {
                                                                    $tlink = explode(',', $tdetail->tlink);
                                                                    $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                                    $tlcount = count($tlink);
                                                                    if($tlcount > 0){
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for ($i=0; $i<$tlcount; $i++){
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                        <a href="<?php echo $tlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                        <?php
                                                                                            echo $tlink[$i];
                                                                                        ?>
                                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                                        <?php
                                                                                        if(!empty($tlink_comment[$i])){
                                                                                            echo $tlink_comment[$i];
                                                                                        }
                                                                                        ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Task Files :</h5>
                                                <p><?php if(!empty($tdetail->tfile))
                                                {
                                                    $tfile = explode(',', $tdetail->tfile);
                                                    $count = count($tfile);
                                                    if($count > 0)
                                                    {
                                                        ?>
                                                        <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        for($i=0; $i<$count; $i++)
                                                        {
                                                            $tfile_name = $tfile[$i];
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
    <?php
    if($privilege_only_view == 'no')
    {
    ?>                                                                    
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?>                                                                    
                                                                        <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                    <div class="col-3">
    <?php 
    if($privilege_only_view == 'no')
    {
    ?>
                                                                        <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
    
                                                                        <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
    <?php
    }
    
    if($privilege_only_view == 'no')
    {
    ?> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
    {
    ?> 
                                                                        <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php
    }
    else
    {
        if($check_permission)
        {
            if($check_permission->req_status == 'accepted')
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php
            }
            else
            {
            ?> 
                <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
            <?php 
            }
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }    
    }
    ?>
                                                                    </div>
                                                                </div></li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                }?></p>
    
                                                <h5 class="font-size-15 mt-4">Subtasks :</h5>
                                                <p><?php 
                                                $Check_Task_Subtasks = $this->Front_model->Check_Task_Subtasks2($tdetail->tid);
                                                if($Check_Task_Subtasks)
                                                {
                                                ?>
                                                    <ul class="list-unstyled fw-medium">
                                                        <?php
                                                        foreach($Check_Task_Subtasks as $subtask)
                                                        {
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <?php
                                                                            if($subtask->ststatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                        <i class="mdi mdi-checkbox-blank-circle-outline me-1 h4" title="To Do"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_progress')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-dots-horizontal-circle-outline me-1 h4" title="In Progress"></i> 
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'in_review')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi mdi-progress-check me-1 h4" title="In Review"></i>
                                                                        <?php
                                                                        }
                                                                        elseif($subtask->ststatus == 'done')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-check-circle-outline me-1 text-d h4" title="Done"></i>
                                                                        <?php
                                                                        } 
                                                                        ?>
                                                                        <a href="javascript: void(0);" class="nameLink h6" onclick="return SubtaskOverviewModal('<?php echo $subtask->stid;?>')"><?php echo $subtask->stcode." : ".$subtask->stname;?></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?></p>
    
                                                <div class="row m-4">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                        <?php
                                                                                    $check_page = $this->Front_model->ProjectDetail($tdetail->tproject_assign);
                                                                                    if($check_page)
                                                                                    {
                                                                                        $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                            <a class="nameLink" href="<?php echo base_url('projects-overview/'.$tdetail->tproject_assign);?>">
                                                                                <?php echo $pro->pname;?>
                                                                            </a>
                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                        <a class="nameLink" href="<?php echo base_url('projects-overview-accepted/'.$tdetail->tproject_assign);?>">
                                                                                <?php echo $pro->pname;?>
                                                                        </a>
                                                                        <?php
                                                                                    }
                                                                        ?>
                                                                        </p>
                                                                        <?php
                                                                                }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                            $stud = $this->Front_model->getStudentById($tdetail->tassignee);
                                                                             echo $stud->first_name.' '.$stud->last_name;
                                                                            ?>
                                                                        </p>                                                         
                                                                        <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($tdetail->tcreated_date));?></p>
                                                                        <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $tdetail->first_name.' '.$tdetail->last_name;?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <?php
                                                                            if(!empty($tdetail->tproject_assign))
                                                                                {
                                                                                    $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                        if($pro){
                                                                                if($pro->portfolio_id != 0)
                                                                                {
                                                                                    $portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                                                    if($portfolio){
                                                                                    if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                                }
                                                                                }
                                                                                } 
                                                                            ?></p>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($tdetail->tdue_date));?></p>
                                                                        <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $tdetail->tpriority;?></p>
                                                                        <?php
                                                                        $tid = $tdetail->tid;
                                                                        $assignee_status = $this->Front_model->check_assignee_status($tid);
    if($privilege_only_view == 'no')
    {
                                                                        if($assignee_status)
                                                                        {
                                                                            if($assignee_status->tstatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            To Do <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'in_progress')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Progress <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'in_review')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Review <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($assignee_status->tstatus == 'done')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            Done <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        elseif($check_pro_createdby == $this->session->userdata('d168_id'))
                                                                        {
                                                                           if($tdetail->tstatus == 'to_do')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            To Do <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'in_progress')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Progress <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'in_review')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            In Review <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            }
    
                                                                            if($tdetail->tstatus == 'done')
                                                                            {
                                                                        ?>
                                                                    <div class="btn-group dropstart">
                                                                        <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                        <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            Done <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                            <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                                <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                                <input type="hidden" name="tassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                                <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                        <?php
                                                                            } 
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                            <?php
                                                                                    if($tdetail->tstatus == 'to_do')
                                                                                    {
                                                                                        echo "To Do";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_progress')
                                                                                    {
                                                                                        echo "In Progress";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'in_review')
                                                                                    {
                                                                                        echo "In Review";
                                                                                    }
                                                                                    elseif($tdetail->tstatus == 'done')
                                                                                    {
                                                                                        echo "Done";
                                                                                    } 
                                                                            ?>
                                                                        </p>
                                                                        <?php
                                                                        }
    }
    else
    {
    ?>
    <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
        <?php
                if($tdetail->tstatus == 'to_do')
                {
                    echo "To Do";
                }
                elseif($tdetail->tstatus == 'in_progress')
                {
                    echo "In Progress";
                }
                elseif($tdetail->tstatus == 'in_review')
                {
                    echo "In Review";
                }
                elseif($tdetail->tstatus == 'done')
                {
                    echo "Done";
                } 
        ?>
    </p>
    <?php
    }
                                                                        ?>                                                             
                                                                    </div>
                                                                </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div><!-- end col -->   
                                        <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-body">
        <?php
        if($tdetail->tproject_assign != '0')
        {
           //$comments = $this->Front_model->getProjectComments($tdetail->tproject_assign);
           $comments = $this->Front_model->getTaskComments($tdetail->tid);
           $check_Powner = $this->Front_model->getProjectById($tdetail->tproject_assign);
           $checkpro_Owner = "";
           $pownerName = "";
           if($check_Powner)
           {
                $Powner_detail = $this->Front_model->getStudentById($check_Powner->pcreated_by);  
                if($Powner_detail)  
                {
                    $pownerName = $Powner_detail->first_name.' '.$Powner_detail->last_name;
                }
                if($check_Powner->pcreated_by == $this->session->userdata('d168_id'))
                {
                    $checkpro_Owner = "owner";
                }
                else
                {
                    $checkpro_Owner = "team";
                }
           }
           if($checkpro_Owner == "owner")
           {
                $mentionList = $this->Front_model->MentionList($tdetail->tproject_assign); 
           }
           elseif($checkpro_Owner == "team")
           {
                $MentionListforAccepted = $this->Front_model->MentionListforAccepted($tdetail->tproject_assign);
                //print_r($MentionListforAccepted);
                $ownerMention[]['name'] = $pownerName;
                //print_r($ownerMention);
                $mentionList = array_merge($MentionListforAccepted,$ownerMention);
           }
        }
        else
        {
            $comments = $this->Front_model->getTaskComments($tdetail->tid);
            $mentionList = array();
        }
        ?>
        <!-- Start Comment section -->
        <h4 class="card-title">Comment Section</h4>
        <div class="w-100 user-chat">
            <div class="card">        
                <div id="scrollbottom" class="chat-conversation p-2">
                    <ul class="list-unstyled mb-0 append_new_msg" data-simplebar style="max-height: 250px;">
                        <?php   
                        if($comments){
                            $comment_date = "";
                            foreach ($comments as $cm) {
                                $msg_date = date("Y-m-d", strtotime($cm->c_created_date));
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
                                        <span class="title"><?php echo date("j M, Y", strtotime($cm->c_created_date));?></span>
                                    </div>
                                </li>
                                <?php
                                }
                                $studdel = $this->Front_model->getStudentById($cm->c_created_by);
                                if($cm->c_created_by == $this->session->userdata('d168_id')){
                                    $today_date = date("Y-m-d H:i:s");
                                    $delete_allow = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($cm->c_created_date)));
                                    ?>
                                <li class="right" id="msg_id<?php echo $cm->cid?>">
                                    <div class="conversation-list">
                                        <?php
                                        if(($today_date < $delete_allow) && (empty($cm->delete_msg)))
                                        {
                                        ?>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                              </a>
                                            <div class="dropdown-menu">
                                                <!-- <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a> -->
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment('<?php echo $cm->cid?>');">Delete</a>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">Me</div>
                                            <?php
                                            if($cm->delete_msg == 'yes')
                                            {
                                            ?>
                                            <p>
                                                <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                            </p>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <p>
                                                <?php echo $cm->message; ?>
                                            </p>
                                            <?php
                                            }
                                            ?>
                                            <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                        </div>
                                    </div>
                                </li>
                                    <?php
                                }else{
                                    ?>
                                <li>
                                    <div class="conversation-list">
                                        <!-- <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                              </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div> -->
                                        <div class="ctext-wrap">
                                            <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?></div>
                                            <?php
                                            if($cm->delete_msg == 'yes')
                                            {
                                            ?>
                                            <p>
                                                <i><i class="mdi mdi-block-helper"></i> this message was deleted</i>
                                            </p>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <p>
                                                <?php echo $cm->message; ?>
                                            </p>
                                            <?php
                                            }
                                            ?>
                                            <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                        </div>
                                    </div>
                                </li>
                                    <?php
                                } 
                                $comment_date = $msg_date;                       
                            }
                        }else{
                            ?>
                            <p class="text-muted p-2 no_comment">No comments...</p>
                            <?php
                        }
                        ?>                      
                    </ul>
                </div>
                <div class="p-3 chat-input-section">
                    <form method="POST" name="comment_form" id="comment_form" class="comment_form" autocomplete="off">
                        <div class="row">
                            <div class="col" style="padding-right: 0px !important;">
                                <div class="position-relative">
                                    <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                                    <span id="messageErr" class="text-danger"></span>
                                    <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign; ?>">
                                    <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid; ?>">
                                    <input type="hidden" name="stid" id="stid" value="0">
                                    <input type="hidden" name="area_type" value="from_modal">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="comment_form_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                        <img id="loader6" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    </form>
                </div>
            </div>
        </div>
        <!-- End Comment section -->
                                            </div>
                                        </div>
                                        </div><!-- end col -->
    
                            </div> <!-- end row -->
                        </div>          
        <?php
            }
        }
        else
        {
        ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        }
        ?>
        <script src="<?php echo base_url('assets/js/front.js');?>"></script>
        <script src="<?php echo base_url();?>assets/js/mention.js"></script>
        <script>
        var jArray= <?php echo json_encode($mentionList);?>;
        //console.log(jArray);
         var myMention = new Mention({
            input: document.querySelector('#message'),
            options: jArray
         })
        </script>
        <?php
    }
}

?>