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
$check_permission = $this->Front_model->check_file_preview_access($stdetail->stproject_assign);

$getProject = $this->Front_model->getProjectDetailID($stdetail->stproject_assign);
if($getProject)
{
    $pcreated_by = $getProject->pcreated_by;
    $pmanager = $getProject->pmanager;        
}

if($previous_page_name == 'file-cabinet'){
    if($stdetail)
    {
        $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        $ActiveEmail_ID = "";
        if($get_active_Email_ID)
        {
            $ActiveEmail_ID = $get_active_Email_ID->email_address;
        }
        $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($stdetail->portfolio_id, $ActiveEmail_ID);
        if($check_active_portfolio)
        {

        if($stdetail->stassignee == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'stnotify' => 'seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskNotify($data,$stdetail->stproject_assign,$stdetail->stassignee,$stdetail->stid);

                if($stdetail->sreview_notify == 'sent_yes')
                {
                $data = array(
                                'sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
               $res = $this->Front_model->edit_SubtaskReviewNotify($data,$stdetail->stproject_assign,$stdetail->stassignee,$stdetail->stid);
                }
            }
        //Arrive for review
        $pro_car = $this->Front_model->file_itgetProjectById($stdetail->stproject_assign);
        if($pro_car)
        {
            if($stdetail->po_sreview_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'po_sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskArriveReviewNotify($data,$stdetail->stproject_assign,$stdetail->stid);
            }
            elseif($stdetail->po_sreview_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'po_sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskArriveReviewNotify($data,$stdetail->stproject_assign,$stdetail->stid);
            }
        }
        $t_files1 = explode(',', $stdetail->stfnotify); 
            $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                            if($index1 !== FALSE){
                                unset($t_files1[$index1]);
                            }
                            $final_mem1 = implode(',', $t_files1); 
                            $data = array(
                                            'stfnotify' => $final_mem1,
                                    );
                                    $data = $this->security->xss_clean($data); // xss filter
                                    $this->Front_model->edit_NewSubtask($data,$stdetail->stid);
        $check_pro_createdby = "";
            if(!empty($stdetail->stproject_assign))
            {
                $pro = $this->Front_model->file_itgetProjectById($stdetail->stproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
                }
            }
            $check_pro_member_status = "";
            $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($stdetail->stproject_assign);
            if($check_ProjectMToClear)
            {
                $check_pro_member_status = $check_ProjectMToClear->status;
            }
            if(($stdetail->stproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
            {
                $check_suggested = $this->Front_model->file_itcheck_project_suggested_member($stdetail->stproject_assign);
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
                      <div class="col-lg-12">Project Request is not send from Project Owner. Subtask Name: <?php echo $stdetail->stname;?></div>
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
                        <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Subtask Name: <?php echo $stdetail->stname;?></div>
                        <div class="col-lg-2">
                            <a href="<?php echo base_url('projects-modal-request2/'.$stdetail->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                 Accept Request
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?php echo base_url('projects-modal-request2/'.$stdetail->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
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
                                                        <h5 class="font-size-15" style="padding: 8px;"><strong>SUBTASK:</strong> <b><?php echo $stdetail->stname;?></b></h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $stdetail->portfolio_id)
                                                            {
                                                                $check_pro_createdby = "";
                                                            if(!empty($stdetail->stproject_assign))
                                                            {
                                                                $pro = $this->Front_model->file_itgetProjectById($stdetail->stproject_assign);
                                                                if($pro)
                                                                {
                                                                    $check_pro_createdby = $pro->pcreated_by;
                                                                }
                                                            }
                                                            if(($stdetail->stassignee == $this->session->userdata('d168_id')) || ($stdetail->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
                                                            {
                                                                if($privilege_only_view == 'no')
                                                                {
                                                        $data_stask = $this->Front_model->check_subtask($stdetail->stid);

                                                        if($data_stask->sflag == '1'){
                                                          if($data_stask->start_stimer_new != "" ){
                                                            // Old time
                                                            $old_time = $data_stask->start_stimer_new;
                                                          }
                                                          else{
                                                          $old_time = $data_stask->start_stimer;
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
                                                          // $timer = $diff_hours.':'.$diff_minutes.':'.$diff_seconds;
                                                          $timer = sprintf("%02d:%02d:%02d", $diff_hours, $diff_minutes, $diff_seconds);
                                                          $time1 = $timer;
                                                          $time2 = $data_stask->tracked_stime;
                                                  
                                                          $time1 = new DateTime($time1);
                                                          $time2 = new DateTime($time2);
                                                  
                                                          $interval = new DateInterval('PT' . $time1->format('H') . 'H' . $time1->format('i') . 'M' . $time1->format('s') . 'S');
                                                          $time2->add($interval);
                                                  
                                                          $timer = $time2->format('H:i:s');
                                                          }
                                                          
                                                          else{
                                                            if($data_stask->tracked_stime != ""){
                                                            $timer = $data_stask->tracked_stime;
                                                            }
                                                            else{
                                                            $timer = '00:00:00';
                                                            }
                                                          }

                                                        ?>

                                                        <span class="timerSBtn_<?php echo $data_stask->stid?> timerSBtn_new_<?php echo $data_stask->stid?>" style="margin-left: 25px;font-size: 20px; margin-top: 2px;">
                                                        <i class="bx bx-play-circle" onclick="SubtaskTimer6(<?php echo $data_stask->stid?>);"></i>
                                                        </span>
                                                        <span class="countersubtask_<?php echo $data_stask->stid?> countersubtask_modal_<?php echo $data_stask->stid?>" data-id="<?php echo $data_stask->stid?>" style="margin-left: 10px;font-size: 20px;"><?php echo $timer?></span>
                                                        <input type="hidden" value="<?php echo $data_stask->sflag?>" id="timer_sflag_<?php echo $data_stask->sflag?>" class="timer_sflag_<?php echo $data_stask->sflag?>"/>
                                                        <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $stdetail->stid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                        
                                                        <a class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $stdetail->stid;?>');" title="Archive"><i class="bx bx-archive-in"></i></a>
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

                                            <h5 class="font-size-15 mt-4">Task : <?php if($stdetail->tid){
                                                            $task = $this->Front_model->file_itgetTasksDetail($stdetail->tid);
                                                            if($task)
                                                            {
                                                                echo $task->tname;
                                                            }
                                                        };?></h5>
                                                        
                                            <h5 class="font-size-15 mt-4">Subtask Code :</h5>
                                            <p><?php echo $stdetail->stcode;?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Notes :</h5>
                                            <p class="pdes"><?php echo $stdetail->stnote;?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Description :</h5>

                                            <p class="pdes"><?php 
                                            if(!empty($stdetail->stdes))
                                                {
                                                    echo $stdetail->stdes;
                                                }
                                            ?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Links and Comments :</h5>
                                            <p><?php if(!empty($stdetail->stlink))
                                                            {
                                                                $stlink = explode(',', $stdetail->stlink);
                                                                $stlink_comment = explode(',',$stdetail->stlink_comment);
                                                                $stlcount = count($stlink);
                                                                if($stlcount > 0){
                                                    ?>
                                                    <ul class="list-unstyled fw-medium">
                                                    <?php
                                                    for ($i=0; $i<$stlcount; $i++){
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                    <a href="<?php echo $stlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                    <?php
                                                                                        echo $stlink[$i];
                                                                                    ?>
                                                                                    </a>
                                                                </div>
                                                                <div class="col-6">
                                                                                    <?php
                                                                                    if(!empty($stlink_comment[$i])){
                                                                                        echo $stlink_comment[$i];
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
                                            <p><?php if(!empty($stdetail->stfile))
                                            {
                                                $stfile = explode(',', $stdetail->stfile);
                                                $count = count($stfile);
                                                if($count > 0)
                                                {
                                                    ?>
                                                    <ul class="list-unstyled fw-medium">
                                                    <?php
                                                    for($i=0; $i<$count; $i++)
                                                    {
                                                        $stfile_name = $stfile[$i];
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
<?php
if($privilege_only_view == 'no')
{
?>
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a>
        <?php
        }
        else
        {
        ?> 
           <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
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
                                                                    <a href="javascript:void(0)" onclick="return delete_subtaskfile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>

                                                                    <a href="<?php echo base_url().'front/download_subtaskFileAttachment/'.$stfile_name.'/'.$stdetail->stid;?>" class='text-dark float-end'><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php
}

if($privilege_only_view == 'no')
{
?> 
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>  
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>  
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>
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

                                            <div class="row m-4">
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <?php
                                                                        if(!empty($stdetail->stproject_assign))
                                                                            {
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                    <?php
                                                                                $check_page = $this->Front_model->file_itProjectDetail($stdetail->stproject_assign);
                                                                                if($check_page)
                                                                                {
                                                                                    $pro = $this->Front_model->file_itgetProjectById2($stdetail->stproject_assign);
                                                                    ?>
                                                                            <?php echo $pro->pname;?>
                                                                    <?php
                                                                                }
                                                                                else
                                                                                {
                                                                                    $pro = $this->Front_model->file_itgetProjectById2($stdetail->stproject_assign);
                                                                    ?>
                                                                    
                                                                            <?php echo $pro->pname;?>
                                                                    
                                                                    <?php
                                                                                }
                                                                    ?>
                                                                    </p>
                                                                    <?php
                                                                            }
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                        $stud = $this->Front_model->getStudentById($stdetail->stassignee);
                                                                         echo $stud->first_name.' '.$stud->last_name;
                                                                        ?>
                                                                    </p>                                                         
                                                                    <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($stdetail->stcreated_date));?></p>
                                                                    <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $stdetail->first_name.' '.$stdetail->last_name;?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <?php
                                                                        if(!empty($stdetail->stproject_assign))
                                                                            {
                                                                                $pro = $this->Front_model->file_itgetProjectById2($stdetail->stproject_assign);
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
                                                                    <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($stdetail->stdue_date));?></p>
                                                                    <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $stdetail->stpriority;?></p>
                                                                    <?php
                                                                    $stid = $stdetail->stid;
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                        <?php
                                                                                if($stdetail->ststatus == 'to_do')
                                                                                {
                                                                                    echo "To Do";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_progress')
                                                                                {
                                                                                    echo "In Progress";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_review')
                                                                                {
                                                                                    echo "In Review";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'done')
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
                                    </div>
                                    
                                </div>
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
    if($stdetail)
    {
        $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        $ActiveEmail_ID = "";
        if($get_active_Email_ID)
        {
            $ActiveEmail_ID = $get_active_Email_ID->email_address;
        }
        $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($stdetail->portfolio_id, $ActiveEmail_ID);
        if($check_active_portfolio)
        {

        if($stdetail->stassignee == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'stnotify' => 'seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskNotify($data,$stdetail->stproject_assign,$stdetail->stassignee,$stdetail->stid);

                if($stdetail->sreview_notify == 'sent_yes')
                {
                $data = array(
                                'sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
               $res = $this->Front_model->edit_SubtaskReviewNotify($data,$stdetail->stproject_assign,$stdetail->stassignee,$stdetail->stid);
                }
            }
        //Arrive for review
        $pro_car = $this->Front_model->getProjectById($stdetail->stproject_assign);
        if($pro_car)
        {
            if($stdetail->po_sreview_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'po_sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskArriveReviewNotify($data,$stdetail->stproject_assign,$stdetail->stid);
            }
            elseif($stdetail->po_sreview_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
            {
                $data = array(
                                'po_sreview_notify' => 'sent_seen',
                            );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->edit_SubtaskArriveReviewNotify($data,$stdetail->stproject_assign,$stdetail->stid);
            }
        }
        $t_files1 = explode(',', $stdetail->stfnotify); 
            $index1 = array_search($this->session->userdata('d168_id'),$t_files1);
                            if($index1 !== FALSE){
                                unset($t_files1[$index1]);
                            }
                            $final_mem1 = implode(',', $t_files1); 
                            $data = array(
                                            'stfnotify' => $final_mem1,
                                    );
                                    $data = $this->security->xss_clean($data); // xss filter
                                    $this->Front_model->edit_NewSubtask($data,$stdetail->stid);
        $check_pro_createdby = "";
            if(!empty($stdetail->stproject_assign))
            {
                $pro = $this->Front_model->getProjectById($stdetail->stproject_assign);
                if($pro)
                {
                    $check_pro_createdby = $pro->pcreated_by;
                }
            }
            $check_pro_member_status = "";
            $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($stdetail->stproject_assign);
            if($check_ProjectMToClear)
            {
                $check_pro_member_status = $check_ProjectMToClear->status;
            }
            if(($stdetail->stproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
            {
                $check_suggested = $this->Front_model->check_project_suggested_member($stdetail->stproject_assign);
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
                      <div class="col-lg-12">Project Request is not send from Project Owner. Subtask Name: <?php echo $stdetail->stname;?></div>
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
                        <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Subtask Name: <?php echo $stdetail->stname;?></div>
                        <div class="col-lg-2">
                            <a href="<?php echo base_url('projects-modal-request2/'.$stdetail->stproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                 Accept Request
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?php echo base_url('projects-modal-request2/'.$stdetail->stproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
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
                                                        <h5 class="font-size-15" style="padding: 8px;"><strong>SUBTASK:</strong> <b><?php echo $stdetail->stname;?></b></h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $stdetail->portfolio_id)
                                                            {
if($privilege_only_view == 'no')
{
                                                                ?>
                                                        <a href="javascript:void(0)" onclick="return SubtaskEditModal('<?php echo $stdetail->stid;?>');" class="btn btn-sm btn-d text-white"><i class="mdi mdi-delete"></i> Edit Subtask</a>
                                                        <?php
}
                                                        $check_pro_createdby = "";
                                                            if(!empty($stdetail->stproject_assign))
                                                            {
                                                                $pro = $this->Front_model->getProjectById($stdetail->stproject_assign);
                                                                if($pro)
                                                                {
                                                                    $check_pro_createdby = $pro->pcreated_by;
                                                                }
                                                            }
                                                            if(($stdetail->stassignee == $this->session->userdata('d168_id')) || ($stdetail->stcreated_by == $this->session->userdata('d168_id')) || ($check_pro_createdby == $this->session->userdata('d168_id'))) 
                                                            {
if($privilege_only_view == 'no')
{
                                                        $data_stask = $this->Front_model->check_subtask($stdetail->stid);

                                                        if($data_stask->sflag == '1'){
                                                          if($data_stask->start_stimer_new != "" ){
                                                            // Old time
                                                            $old_time = $data_stask->start_stimer_new;
                                                          }
                                                          else{
                                                          $old_time = $data_stask->start_stimer;
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
                                                          // $timer = $diff_hours.':'.$diff_minutes.':'.$diff_seconds;
                                                          $timer = sprintf("%02d:%02d:%02d", $diff_hours, $diff_minutes, $diff_seconds);
                                                          $time1 = $timer;
                                                          $time2 = $data_stask->tracked_stime;
                                                  
                                                          $time1 = new DateTime($time1);
                                                          $time2 = new DateTime($time2);
                                                  
                                                          $interval = new DateInterval('PT' . $time1->format('H') . 'H' . $time1->format('i') . 'M' . $time1->format('s') . 'S');
                                                          $time2->add($interval);
                                                  
                                                          $timer = $time2->format('H:i:s');
                                                          }
                                                          
                                                          else{
                                                            if($data_stask->tracked_stime != ""){
                                                            $timer = $data_stask->tracked_stime;
                                                            }
                                                            else{
                                                            $timer = '00:00:00';
                                                            }
                                                          }

                                                        ?>

                                                        <span class="timerSBtn_<?php echo $data_stask->stid?> timerSBtn_new_<?php echo $data_stask->stid?>" style="margin-left: 25px;font-size: 20px; margin-top: 2px;">
                                                        <i class="bx bx-play-circle" onclick="SubtaskTimer6(<?php echo $data_stask->stid?>);"></i>
                                                        </span>
                                                        <span class="countersubtask_<?php echo $data_stask->stid?> countersubtask_modal_<?php echo $data_stask->stid?>" data-id="<?php echo $data_stask->stid?>" style="margin-left: 10px;font-size: 20px;"><?php echo $timer?></span>
                                                        <input type="hidden" value="<?php echo $data_stask->sflag?>" id="timer_sflag_<?php echo $data_stask->sflag?>" class="timer_sflag_<?php echo $data_stask->sflag?>"/>
                                                        <a href="javascript:void(0)" onclick="return subtasks_delete('<?php echo $stdetail->stid;?>');" class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 1px !important;font-size: 1.2rem;" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                        <?php
                                                        $previous_url = $_SERVER['HTTP_REFERER'];
                                                        $previous_url_array = explode('/', $previous_url);
                                                        $previous_page_name = end($previous_url_array);
                                                        if($previous_page_name == 'file-cabinet'){
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" href="javascript:void(0)" onclick="return archive_subtask('<?php echo $stdetail->stid;?>');" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;" href="javascript:void(0)" onclick="return file_it_subtask('<?php echo $stdetail->stid;?>');" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <a class="h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;" href="javascript:void(0)" onclick="return duplicate_subtask('<?php echo $stdetail->stid;?>');" id="dup_pro_id" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                                                        <img id="dup_loader" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
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

                                            <h5 class="font-size-15 mt-4">Task : <?php if($stdetail->tid){
                                                            $task = $this->Front_model->getTasksDetail($stdetail->tid);
                                                            if($task)
                                                            {
                                                                echo $task->tname;
                                                            }
                                                        };?></h5>
                                                        
                                            <h5 class="font-size-15 mt-4">Subtask Code :</h5>
                                            <p><?php echo $stdetail->stcode;?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Notes :</h5>
                                            <p class="pdes"><?php echo $stdetail->stnote;?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Description :</h5>

                                            <p class="pdes"><?php 
                                            if(!empty($stdetail->stdes))
                                                {
                                                    echo $stdetail->stdes;
                                                }
                                            ?></p>

                                            <h5 class="font-size-15 mt-4">Subtask Links and Comments :</h5>
                                            <p><?php if(!empty($stdetail->stlink))
                                                            {
                                                                $stlink = explode(',', $stdetail->stlink);
                                                                $stlink_comment = explode(',',$stdetail->stlink_comment);
                                                                $stlcount = count($stlink);
                                                                if($stlcount > 0){
                                                    ?>
                                                    <ul class="list-unstyled fw-medium">
                                                    <?php
                                                    for ($i=0; $i<$stlcount; $i++){
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                    <a href="<?php echo $stlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                    <?php
                                                                                        echo $stlink[$i];
                                                                                    ?>
                                                                                    </a>
                                                                </div>
                                                                <div class="col-6">
                                                                                    <?php
                                                                                    if(!empty($stlink_comment[$i])){
                                                                                        echo $stlink_comment[$i];
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
                                            <p><?php if(!empty($stdetail->stfile))
                                            {
                                                $stfile = explode(',', $stdetail->stfile);
                                                $count = count($stfile);
                                                if($count > 0)
                                                {
                                                    ?>
                                                    <ul class="list-unstyled fw-medium">
                                                    <?php
                                                    for($i=0; $i<$count; $i++)
                                                    {
                                                        $stfile_name = $stfile[$i];
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
<?php
if($privilege_only_view == 'no')
{
?> 
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?> 
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a> 
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a>
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
                                                                    <a href="javascript:void(0)" onclick="return delete_subtaskfile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>

                                                                    <a href="<?php echo base_url().'front/download_subtaskFileAttachment/'.$stfile_name.'/'.$stdetail->stid;?>" class='text-dark float-end'><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php
}

if($privilege_only_view == 'no')
{
?>
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>  
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>
                                                                    <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>  
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a> 
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a> 
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" onclick="return file_preview_access_req('<?php echo $stdetail->stproject_assign;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a> 
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

                                            <div class="row m-4">
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <?php
                                                                        if(!empty($stdetail->stproject_assign))
                                                                            {
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                    <?php
                                                                                $check_page = $this->Front_model->ProjectDetail($stdetail->stproject_assign);
                                                                                if($check_page)
                                                                                {
                                                                                    $pro = $this->Front_model->getProjectById2($stdetail->stproject_assign);
                                                                    ?>
                                                                        <a class="nameLink" href="<?php echo base_url('projects-overview/'.$stdetail->stproject_assign);?>">
                                                                            <?php echo $pro->pname;?>
                                                                        </a>
                                                                    <?php
                                                                                }
                                                                                else
                                                                                {
                                                                                    $pro = $this->Front_model->getProjectById2($stdetail->stproject_assign);
                                                                    ?>
                                                                    <a class="nameLink" href="<?php echo base_url('projects-overview-accepted/'.$stdetail->stproject_assign);?>">
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
                                                                        $stud = $this->Front_model->getStudentById($stdetail->stassignee);
                                                                         echo $stud->first_name.' '.$stud->last_name;
                                                                        ?>
                                                                    </p>                                                         
                                                                    <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($stdetail->stcreated_date));?></p>
                                                                    <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $stdetail->first_name.' '.$stdetail->last_name;?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <?php
                                                                        if(!empty($stdetail->stproject_assign))
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById2($stdetail->stproject_assign);
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
                                                                    <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($stdetail->stdue_date));?></p>
                                                                    <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $stdetail->stpriority;?></p>
                                                                    <?php
                                                                    $stid = $stdetail->stid;
                                                                    $assignee_status = $this->Front_model->check_subtask_assignee_status($stid);
if($privilege_only_view == 'no')
{
                                                                    if($assignee_status)
                                                                    {
                                                                        if($assignee_status->ststatus == 'to_do')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        To Do <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'in_progress')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Progress <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'in_review')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Review <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'done')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        Done <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
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
                                                                        if($stdetail->ststatus == 'to_do')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        To Do <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($stdetail->ststatus == 'in_progress')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Progress <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($stdetail->ststatus == 'in_review')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Review <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($stdetail->ststatus == 'done')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        Done <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" action="<?php echo(base_url('change_subtaskStatus'));?>">
                                                                            <input type="hidden" name="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" value="<?php echo $this->session->userdata('d168_id');?>">  
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
                                                                                if($stdetail->ststatus == 'to_do')
                                                                                {
                                                                                    echo "To Do";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_progress')
                                                                                {
                                                                                    echo "In Progress";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_review')
                                                                                {
                                                                                    echo "In Review";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'done')
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
            if($stdetail->ststatus == 'to_do')
            {
                echo "To Do";
            }
            elseif($stdetail->ststatus == 'in_progress')
            {
                echo "In Progress";
            }
            elseif($stdetail->ststatus == 'in_review')
            {
                echo "In Review";
            }
            elseif($stdetail->ststatus == 'done')
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
                                                            
                                                            <!-- <div class="col-md-6">
                                                                <div>
                                                                    <?php
                                                                        if(!empty($stdetail->stproject_assign))
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById2($stdetail->stproject_assign);
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                            if($pro->portfolio_id != 0)
                                                                            {
                                                                                $portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                                                if($portfolio){
                                                                                if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                            }
                                                                            } 
                                                                        ?></p>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($stdetail->stdue_date));?></p>
                                                                    <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $stdetail->stpriority;?></p>
                                                                    <?php
                                                                    $stid = $stdetail->stid;
                                                                    $assignee_status = $this->Front_model->check_subtask_assignee_status($stid);
                                                                    if($assignee_status)
                                                                    {
                                                                        if($assignee_status->ststatus == 'to_do')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        To Do <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" id="change_suboverviewstatus">
                                                                            <input type="hidden" name="stid" id="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" id="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'in_progress')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Progress <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" id="change_suboverviewstatus">
                                                                            <input type="hidden" name="stid" id="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" id="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_review">Submit for Review</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'in_review')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        In Review <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" id="change_suboverviewstatus">
                                                                            <input type="hidden" name="stid" id="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" name="stassignee" id="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="done">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                    <?php
                                                                        }

                                                                        if($assignee_status->ststatus == 'done')
                                                                        {
                                                                    ?>
                                                                <div class="btn-group dropstart">
                                                                    <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                    <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        Done <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                        <form method="post" id="change_suboverviewstatus">
                                                                            <input type="hidden" name="stid" id="stid" value="<?php echo $stid;?>">
                                                                            <input type="hidden" id="stassignee" name="stassignee" value="<?php echo $assignee_status->stassignee;?>">  
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                            <button type="button" class="dropdown-item status_but_val" name="status_but" id="status_but" value="in_review">Submit for Review</button>
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
                                                                                if($stdetail->ststatus == 'to_do')
                                                                                {
                                                                                    echo "To Do";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_progress')
                                                                                {
                                                                                    echo "In Progress";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'in_review')
                                                                                {
                                                                                    echo "In Review";
                                                                                }
                                                                                elseif($stdetail->ststatus == 'done')
                                                                                {
                                                                                    echo "Done";
                                                                                } 
                                                                        ?>
                                                                    </p>
                                                                    <?php
                                                                    }
                                                                    ?>                                                             
                                                                </div>
                                                            </div> -->
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                        <div class="card-body">
    <?php
    if($stdetail->stproject_assign != '0')
    {
       //$comments = $this->Front_model->getProjectComments($stdetail->stproject_assign); 
       $comments = $this->Front_model->getSubtaskComments($stdetail->stid);
       $check_Powner = $this->Front_model->getProjectById($stdetail->stproject_assign);
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
            $subtask_mentionList = $this->Front_model->MentionList($stdetail->stproject_assign); 
       }
       elseif($checkpro_Owner == "team")
       {
            $subtask_mentionListforAccepted = $this->Front_model->MentionListforAccepted($stdetail->stproject_assign);
            //print_r($subtask_mentionListforAccepted);
            $ownerMention[]['name'] = $pownerName;
            //print_r($ownerMention);
            $subtask_mentionList = array_merge($subtask_mentionListforAccepted,$ownerMention);
       }
    }
    else
    {
        //$comments = $this->Front_model->getTaskComments($stdetail->tid);
        $comments = $this->Front_model->getSubtaskComments($stdetail->stid);
        $subtask_mentionList = array();
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
                <form method="POST" name="subtask_comment_form" id="subtask_comment_form" class="comment_form" autocomplete="off">
                    <div class="row">
                        <div class="col" style="padding-right: 0px !important;">
                            <div class="position-relative">
                                <input type="text" id="sub_message" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                                <span id="messageErr" class="text-danger"></span>
                                <input type="hidden" name="pid" id="pid" value="<?php echo $stdetail->stproject_assign; ?>">
                                <input type="hidden" name="tid" id="tid" value="<?php echo $stdetail->tid; ?>">
                                <input type="hidden" name="stid" id="stid" value="<?php echo $stdetail->stid; ?>">
                                <input type="hidden" name="area_type" value="from_modal">
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="subtask_comment_form_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                    <img id="loader6" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </form>
            </div>
        </div>
    </div>
    <!-- End Comment section -->
                                        </div>
                                    </div>
                                    </div>
                                </div>
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
    var jArray= <?php echo json_encode($subtask_mentionList);?>;
    //console.log(jArray);
     var myMention = new Mention({
        input: document.querySelector('#sub_message'),
        options: jArray
     })
    </script>
    <?php
}
?>