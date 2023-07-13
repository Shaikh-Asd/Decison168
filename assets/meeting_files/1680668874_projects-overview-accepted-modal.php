<?php
 if($pdetail)
 {
    $pfile_detail1 = $this->Front_model->ProjectFile($pdetail->pid);
    foreach($pfile_detail1 as $pf1)
    {
        $p_files1 = explode(',', $pf1->pfnotify); 
          $index1 = array_search($this->session->userdata('d168_id'),$p_files1);
                      if($index1 !== FALSE){
                          unset($p_files1[$index1]);
                      }
                      $final_mem1 = implode(',', $p_files1); 
                      $data2 = array(
                                      'pfnotify' => $final_mem1,
                                      'pfnotify_clear' => $final_mem1,
                                                        );
                                  $data2 = $this->security->xss_clean($data2); // xss filter
                                  $this->Front_model->edit_project_files_by_pfileId($data2,$pf1->pfile_id);
    }

    $ptm = $this->Front_model->ProjectTeamMember($pdetail->pid);
    if($ptm)
    {
        foreach($ptm as $pm)
        {
            $get_project_accepted_notification = $this->Front_model->get_project_accepted_notification($pm->pm_id);
            if($get_project_accepted_notification)
            {
                foreach($get_project_accepted_notification as $gpars)
                {
                    $pm_id = $gpars->pm_id;
                    $data2 = array(
                                    'status_notify' => 'seen',
                                );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Front_model->edit_project_members_notify($data2,$pm_id);
                }
            }
        }
    }

    $invited_member = $this->Front_model->InvitedProjectMember($pdetail->pid); 
    if($invited_member)
    {
        foreach($invited_member as $im)
        {
            if($im->status == "accepted" && $im->status_notify == "yes")
            {
              $id15 = $im->im_id;
              $data15 = array(
                                    'status_notify' => 'seen',
                                );
              $data15 = $this->security->xss_clean($data15); // xss filter
              $this->Front_model->edit_project_invite_members_notify($data15,$id15);
            }
        }
    }


    $pid = $pdetail->pid;
    $pcreated_by = $pdetail->pcreated_by;
    $powner = $this->Front_model->getStudentById($pcreated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($pdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">                                    
                                  <div data-simplebar style="max-height: 400px;"> 
                                    <div class="card-body">
                                                                   
                                        <div class="media">
                                           <div class="avatar-sm me-2">
                                                 <?php
                                                if($pdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($pdetail->portfolio_id);
                                                    if($portfolio){
                                            if($portfolio->photo)
                                                    {
                                                    ?>                                 
                                                            <div class="avatar-group-item">
                                                                <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
                                                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                <!-- </a> -->
                                                            </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div>
                                                        <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
                                                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                                        if($portfolio->portfolio_user == 'company')
                                                            { 
                                                                $fullname = $portfolio->portfolio_name;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }
                                                        elseif($portfolio->portfolio_user == 'individual')
                                                            { 
                                                                $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }
                                                            else
                                                            { 
                                                                $fullname = $portfolio->portfolio_name;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }?></span>
                                                        <!-- </a> -->
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                }
                                                else 
                                                {
                                                     ?>
                                                     <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                            <i class="bx bx-detail"></i>
                                                    </span>
                                                     <?php
                                                } 
                                            ?>
                                           </div>

                                            <div class="media-body overflow-hidden">
                                                <span>
                                                    <h5 class="font-size-15" style="padding: 8px;"><strong><?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                        echo "CONTENT:";
                                                    }
                                                    else
                                                    {
                                                        echo "PROJECT:";
                                                    }
                                                ?></strong> <b><?php echo $pdetail->pname;?></b></h5>
                                                    <?php
                                                    $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pdetail->portfolio_id);
                                                    $portfolio_owner_id = "";
                                                    if($check_Portfolio_owner_id)
                                                    {
                                                        $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
                                                    }
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                                                        {
                                                        if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))                                
                                                        {
                                                        ?>
                                                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> 
                                                        <?php
                                                        if($pdetail->ptype == "content")
                                                        {
                                                            echo "Edit Content";
                                                        }
                                                        else
                                                        {
                                                            echo "Edit Project";
                                                        }
                                                        ?>
                                                        </a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        $check_edit = $this->Front_model->check_edit_permission($pdetail->pid);
                                                        if($check_edit->edit_allow == 'no')
                                                        {
                                                    ?>
                                                    <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return project_accepted_edit_request('<?php echo $pdetail->pid?>');"><i class="mdi mdi-file-edit"></i> <?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                        echo "Edit Content";
                                                    }
                                                    else
                                                    {
                                                        echo "Edit Project";
                                                    }
                                                    ?></a>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-accepted-edit/'.$pdetail->pid)?>"><i class="mdi mdi-file-edit"></i> <?php
                                                            if($pdetail->ptype == "content")
                                                            {
                                                                echo "Edit Content";
                                                            }
                                                            else
                                                            {
                                                                echo "Edit Project";
                                                            }
                                                            ?></a>
                                                            <?php
                                                        }
                                                    }
                                                                            
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
        $getTaskCount = $this->Front_model->getProject_TaskCount($pdetail->pid);
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
        $getTaskCount = $this->Front_model->getProject_TaskCount($pdetail->pid);
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                <input type="hidden" name="pid" value="<?php echo $pid;?>">
                <input type="hidden" name="gid" value="<?php echo $pdetail->gid;?>">
                <input type="hidden" name="sid" value="<?php echo $pdetail->sid;?>">
                <input type="hidden" name="gdept" value="<?php echo $pdetail->dept_id;?>">
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
                                                            echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                    }
                                                    if(($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))                                
                                                        {
                                                    ?>
                                                    <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                        <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                        <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                        <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>  
                                                    </form>
                                                    <?php
                                                        }
                                                    ?>
                                                </span>
                                                
                                            </div>
                                        </div>

                                        <?php
                                             if($p_tasks || $p_subtasks)
                                                        {
                                        ?>
                                        <h5 class="font-size-15 mt-4">Status :-
                                           <?php 
                                            $progress_done = $this->Front_model->progress_done($pid);
                                            $progress_total = $this->Front_model->progress_total($pid);
                                            $sub_progress_done = $this->Front_model->sub_progress_done($pid);
                                            $sub_progress_total = $this->Front_model->sub_progress_total($pid);
                                            if($progress_total || $sub_progress_total)
                                            {
                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                            ?>
                                            <span>
                                                Done: <?php echo $total_pro_progress_done; ?>  
                                                Total: <?php echo $total_pro_progress; ?> </span>
                                            <div class="progress mt-2">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                if($progress == 0)
                                                {
                                                    echo '2%';
                                                }
                                                else
                                                {
                                                    echo $progress.'%';
                                                }
                                                ?>"><?php echo round($progress).'%'; ?></div>
                                            </div>
                                                <?php
                                                }
                                                ?>
                                        </h5>
                                        <?php
                                        }
                                        ?>

                                        <h5 class="font-size-15 mt-4">Description :</h5>

                                        <p class="text-muted pdes"><?php 
                                        if(!empty($pdetail->pdes))
                                            {
                                                echo $pdetail->pdes;
                                            }
                                        ?></p>

                                        <h5 class="font-size-15 mt-4">Project Links & Comments :</h5>
                                        <p><?php if(!empty($pdetail->plink))
                                                        {
                                                            $plink = explode(',', $pdetail->plink);
                                                            $plink_comment = explode(',',$pdetail->plink_comment);
                                                            $plcount = count($plink);
                                                            if($plcount > 0){
                                                ?>
                                                <ul class="list-unstyled fw-medium">
                                                <?php
                                                for ($i=0; $i<$plcount; $i++){
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                <a href="<?php echo $plink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                <?php
                                                                                    echo $plink[$i];
                                                                                ?>
                                                                                </a>
                                                            </div>
                                                            <div class="col-6">
                                                                                <?php
                                                                                    if(!empty($plink_comment[$i])){
                                                                                        echo $plink_comment[$i];
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
                                        
                                        <div class="row task-dates">
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar  font-size-16 me-1 text-d"></i> Created Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->pcreated_date));?></p>
                                                </div>
                                            </div>
                                            
                                            <?php
                                            if($pdetail->ptype == "content")
                                            {
                                            ?>
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar-check font-size-16 me-1 text-d"></i> Publish Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->p_publish));?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                    <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-folder-open font-size-16 align-middle me-1 text-d"></i>Type</h5>
                                                    <?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Content</p>
                                                    <?php
                                                    }
                                                    elseif($pdetail->ptype == "goal_strategy")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Goals & Strategies</p>
                                                    <?php  
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Project</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->          
<?php
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
