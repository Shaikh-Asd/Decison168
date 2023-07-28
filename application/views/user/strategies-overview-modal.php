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
if($previous_page_name == 'file-cabinet'){
    if($sdetail)
    {
        $sid = $sdetail->sid;
        $screated_by = $sdetail->screated_by;
        $powner = $this->Front_model->getStudentById($screated_by);
        $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        $ActiveEmail_ID = "";
        if($get_active_Email_ID)
        {
            $ActiveEmail_ID = $get_active_Email_ID->email_address;
        }
        $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($sdetail->portfolio_id, $ActiveEmail_ID);
        if($check_active_portfolio)
        {
            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($sdetail->portfolio_id);
            $portfolio_owner_id = "";
            if($check_Portfolio_owner_id)
            {
                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
            }
    ?> 
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                      <div data-simplebar style="max-height: 400px;"> 
                                        <div class="card-body">
                                                                        
                                            <div class="media">
                                               <div class="avatar-sm me-2">
                                                    <?php
                                                    if($sdetail->portfolio_id != 0)
                                                    {
                                                        $portfolio = $this->Front_model->file_itgetPortfolio2($sdetail->portfolio_id);
                                                        if($portfolio){
                                                if($portfolio->photo)
                                                        {
                                                        ?>                                 
                                                                <div class="avatar-group-item">
                                                                        <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                </div>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <div>
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
                                                        <h5 class="font-size-15" style="padding: 8px;"><strong>KPI:</strong> <b class="new_sname<?php echo $sdetail->sid;?>"><?php echo $sdetail->sname;?></b>
                                                        </h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            $gdetail = $this->Front_model->file_itGoalDetail($sdetail->gid);
                                                            $all_managers_sid = array();
                                                            if($gdetail)
                                                            {
                                                              if($gdetail != '0')
                                                                {
                                                                        $all_managers_sid[] = $gdetail->gmanager;
                                                                }  
                                                            }
                                                            if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                            {}
                                                            else
                                                            {
                                                                echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                        }

                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                            {
                                                                if($sdetail->screated_by == $this->session->userdata('d168_id'))
                                                                {
                                                                    if($privilege_only_view == 'no')
                                                                    {
                                                            if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                                <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if(in_array('strategies', $cus_privilege))
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
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            ?>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                                <?php
          }
        }    
      }  
    }
                                                                    }                                                    
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                            <?php
                                            if($Strategy_tasks || $Strategy_subtasks)
                                            {
                                            ?>
                                            <h5 class="font-size-15 mt-4">Status :-
                                              <?php 
                                                $progress_done = $this->Front_model->file_itStrategyprogress_done($sid);
                                                $progress_total = $this->Front_model->file_itStrategyprogress_total($sid);
                                                $sub_progress_done = $this->Front_model->file_itStrategysub_progress_done($sid);
                                                $sub_progress_total = $this->Front_model->file_itStrategysub_progress_total($sid);
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

                                            <p class="text-muted pdes new_sdes<?php echo $sdetail->sid;?>"><?php 
                                            if(!empty($sdetail->sdes))
                                                {
                                                    echo $sdetail->sdes;
                                                }
                                            ?></p>

<div class="row task-dates">
                                        <?php
                                        $est = 0; // Variable to store the sum of estimated times
                                        $trc = 0;
                                        $total_seconds = 0;
                                        $totalTime = "00:00:00";
                                        function timeStringToMinutes($timeString) {
                                          list($hours, $minutes) = sscanf($timeString, '%dh%dm');
                                          return $hours * 60 + $minutes;
                                        }
                                        
                                        function minutesToTimeString($totalMinutes) {
                                          $hours = floor($totalMinutes / 60);
                                          $minutes = $totalMinutes % 60;
                                          return sprintf('%dh %02dm', $hours, $minutes);
                                        }
                                      // Assuming $Goal_tasks is an array of objects with 'estimated_time' property
                                      function calculateTotalTime($Goal_tasks) {
                                          $totalMinutes = 0;
                                          
                                          foreach ($Goal_tasks as $time) {
                                              $estimatedTime = $time->estimated_time;
                                              $totalMinutes += timeStringToMinutes($estimatedTime);
                                          }
                                      
                                          return minutesToTimeString($totalMinutes);
                                      }

                                        $est = calculateTotalTime($Strategy_tasks);

                                        foreach ($Strategy_tasks as $item) {
                                            $estimatedTime = $item->estimated_time;
                                            $tracked_time = $item->tracked_time;
                                            $est += $estimatedTime;

                                            $trackedTime = $item->tracked_time;
                                            $trackedTimeInSeconds = strtotime($trackedTime) - strtotime('00:00:00');
                                            $trc += $trackedTimeInSeconds;

                                            $character = "'";
                                                                                        
                                            if (strpos($tracked_time, $character) !== false) {
                                                $tracked_time = str_replace($character, "", $tracked_time);
                                            } else {
                                            }
                                            // Create DateTime objects for the current time and the total time
                                            $datetime1 = DateTime::createFromFormat('H:i:s', $tracked_time);
                                            $datetime2 = DateTime::createFromFormat('H:i:s', $totalTime);

                                            // Add the current time to the total time
                                            $datetime2->add(new DateInterval('PT' . $datetime1->format('H') . 'H' . $datetime1->format('i') . 'M' . $datetime1->format('s') . 'S'));

                                            // Update the total time
                                            $totalTime = $datetime2->format('H:i:s');
                                        }
                                        ?>
                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-time-five me-1 text-d"></i> Time Estimated</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $est; ?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-timer me-1 text-d"></i> Time Tracked</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $totalTime; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- lasjd -->
                                            <div class="row task-dates">
                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-d"></i> Created Date</h5>
                                                        <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($sdetail->screated_date));?></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bx-briefcase-alt-2 me-1 text-d"></i> Progress</h5>
                                                        <p class="text-muted mb-0">
                                                        <?php 
                                                        if($sdetail->sprogress == "to_do")
                                                        {
                                                            echo "To Do";
                                                        }
                                                        elseif($sdetail->sprogress == "in_progress")
                                                        {
                                                            echo "In Progress";
                                                        }
                                                        elseif($sdetail->sprogress == "in_review")
                                                        {
                                                            echo "In Review";
                                                        }
                                                        elseif($sdetail->sprogress == "done")
                                                        {
                                                            echo "Done";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                </div>
        
                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                        <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!-- end col -->

                               <?php
                                if($s_projects)
                                {
                                ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">
                                                Projects
                                            </h4>
                                            <div data-simplebar style="max-height: 200px;"> 
                                            <div class="table-responsive">
                                                <table class="table table-nowrap align-middle table-hover mb-0">
                                                    <tbody>
                                                        <?php
                                                        if($s_projects)
                                                        {
                                                            foreach($s_projects as $pr)
                                                            {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <h5 class="font-size-14 m-0">
                                                                    <?php
                                                                    $p_tasks = $this->Front_model->file_itp_tasks($pr->pid);
                                                                    $p_subtasks = $this->Front_model->file_itp_subtasks($pr->pid);
                                                                    
                                                                    if($pr->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname; 
                                                                                
                                                                                ?>
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                        $total_secondsg = 0;
                                                                        $totalTimeg = "00:00:00";
                                                                        
                                                                      $estg = calculateTotalTime($p_tasks);

                                                                        foreach ($p_tasks as $itemg) {;
                                                                            $tracked_timeg = $itemg->tracked_time;
                                                                            $characterg = "'";
                                                                                                                        
                                                                            if (strpos($tracked_timeg, $characterg) !== false) {
                                                                                $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                            } else {
                                                                            }
                                                                            // Create DateTime objects for the current time and the total time
                                                                            $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                            $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);
  
                                                                            // Add the current time to the total time
                                                                            $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));
  
                                                                            // Update the total time
                                                                            $totalTimeg = $datetime2g->format('H:i:s');
                                                                        }
                                                                        ?> 
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <div class="col">
                                                                            <?php
                                                                            if($p_tasks || $p_subtasks)
                                                                            {
                                                                                $progress_done = $this->Front_model->file_itprogress_done($pr->pid);
                                                                                $progress_total = $this->Front_model->file_itprogress_total($pr->pid);
                                                                                $sub_progress_done = $this->Front_model->file_itsub_progress_done($pr->pid);
                                                                                $sub_progress_total = $this->Front_model->file_itsub_progress_total($pr->pid);
                                                                                if($progress_total || $sub_progress_total)
                                                                                {
                                                                                    $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                    $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                    $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                            ?>
                                                                                <div class="progress mt-2">
                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                    if($progress == 0)
                                                                                    {
                                                                                        echo '5%';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $progress.'%';
                                                                                    }
                                                                                    ?>"><?php echo round($progress).'%'; ?></div>
                                                                                </div>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                                                                                    
                                                                    </div>
                                                                    <?php                         
                                                                    }
                                                                    else
                                                                    {
                                                                    $pmember = $this->Front_model->file_itCheckProjectTeamMember($pr->pid);
                                                                    if(!empty($pmember))
                                                                    {
                                                                        foreach($pmember as $member)
                                                                        {
                                                                            if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                            {
                                                                              $p_tasks = $this->Front_model->file_itp_tasks($pr->pid);
                                                                            $p_subtasks = $this->Front_model->file_itp_subtasks($pr->pid);
                                                                            
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;
                                                                                
                                                                                ?>
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      $estg = calculateTotalTime($p_tasks);

                                                                      foreach ($p_tasks as $itemg) {
                                                                          $tracked_timeg = $itemg->tracked_time;
                                                                          $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>

                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <div class="col">
                                                                            <?php
                                                                            if($p_tasks || $p_subtasks)
                                                                            {
                                                                                $progress_done = $this->Front_model->file_itprogress_done($pr->pid);
                                                                                $progress_total = $this->Front_model->file_itprogress_total($pr->pid);
                                                                                $sub_progress_done = $this->Front_model->file_itsub_progress_done($pr->pid);
                                                                                $sub_progress_total = $this->Front_model->file_itsub_progress_total($pr->pid);
                                                                                if($progress_total || $sub_progress_total)
                                                                                {
                                                                                    $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                    $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                    $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                            ?>
                                                                                <div class="progress mt-2">
                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                    if($progress == 0)
                                                                                    {
                                                                                        echo '5%';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $progress.'%';
                                                                                    }
                                                                                    ?>"><?php echo round($progress).'%'; ?></div>
                                                                                </div>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <?php    
                                                                            }
                                                                            elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                            {
                                                                              $p_tasks = $this->Front_model->file_itp_tasks($pr->pid);
                                                                            $p_subtasks = $this->Front_model->file_itp_subtasks($pr->pid);
                                                                            
                                                                    ?>
                                                                                    <div class="row">
                                                                        <div class="col">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;
                                                                                ?>
                                                                               
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      $estg = calculateTotalTime($p_tasks);

                                                                      foreach ($p_tasks as $itemg) {
                                                                        $tracked_timeg = $itemg->tracked_time;
                                                                        $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>
                                                                      <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <div class="col">
                                                                        <?php
                                                                        $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                        if($p_tasks || $p_subtasks)
                                                                        {
                                                                            $progress_done = $this->Front_model->file_itprogress_done($pr->pid);
                                                                            $progress_total = $this->Front_model->file_itprogress_total($pr->pid);
                                                                            $sub_progress_done = $this->Front_model->file_itsub_progress_done($pr->pid);
                                                                            $sub_progress_total = $this->Front_model->file_itsub_progress_total($pr->pid);
                                                                            if($progress_total || $sub_progress_total)
                                                                            {
                                                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                        ?>
                                                                            <div class="progress mt-2">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                if($progress == 0)
                                                                                {
                                                                                    echo '5%';
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo $progress.'%';
                                                                                }
                                                                                ?>"><?php echo round($progress).'%'; ?></div>
                                                                            </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                                    <?php  
                                                                                }
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                    <p class="font-size-14 text-muted">
                                                                        <strong>
                                                                            <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;?>
                                                                            </strong> 
                                                                                - Not added in project as a member!
                                                                        </p>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </h5>
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
                                <?php
                                }
                                ?>

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
}else{
    if($sdetail)
    {
        $sid = $sdetail->sid;
        $screated_by = $sdetail->screated_by;
        $powner = $this->Front_model->getStudentById($screated_by);
        $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
        $ActiveEmail_ID = "";
        if($get_active_Email_ID)
        {
            $ActiveEmail_ID = $get_active_Email_ID->email_address;
        }
        $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($sdetail->portfolio_id, $ActiveEmail_ID);
        if($check_active_portfolio)
        {
            $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($sdetail->portfolio_id);
            $portfolio_owner_id = "";
            if($check_Portfolio_owner_id)
            {
                $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
            }
    ?> 
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                      <div data-simplebar style="max-height: 400px;"> 
                                        <div class="card-body">
                                                                        
                                            <div class="media">
                                               <div class="avatar-sm me-2">
                                                    <?php
                                                    if($sdetail->portfolio_id != 0)
                                                    {
                                                        $portfolio = $this->Front_model->getPortfolio2($sdetail->portfolio_id);
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
                                                        <h5 class="font-size-15" style="padding: 8px;"><strong>KPI:</strong> <b class="new_sname<?php echo $sdetail->sid;?>"><?php echo $sdetail->sname;?></b>
                                                        </h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
    // $get_pro_managers_sid = $this->Front_model->get_pro_managers_sid($sdetail->sid);
    // $all_managers_sid = array();
    // if($get_pro_managers_sid)
    // {
    //     foreach($get_pro_managers_sid as $gpm)
    //     {
    //         $all_managers_sid[] = $gpm->pmanager;
    //     }
    // }
                                                            
    $gdetail = $this->Front_model->GoalDetail($sdetail->gid);
    $all_managers_sid = array();
    if($gdetail)
    {
      if($gdetail != '0')
        {
            // foreach($get_pro_managers_gid as $gpm)
            // {
                $all_managers_sid[] = $gdetail->gmanager;
            // }
        }  
    }
                                                            if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                            {
                                                                if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
                                                                {
if(empty($this->session->userdata('d168_user_cor_id')))
{
    ?> 
    <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return StrategiesEditModal('<?php echo $sdetail->sid;?>');"><i class="mdi mdi-file-edit"></i> Edit KPI</a>
    <?php
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('strategies', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        ?> 
        <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" onclick="return StrategiesEditModal('<?php echo $sdetail->sid;?>');"><i class="mdi mdi-file-edit"></i> Edit KPI</a>
        <?php
      }
    }    
  }
}
                                                                }
    if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
    {
    $getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if(empty($this->session->userdata('d168_user_cor_id')))
{
    if($getMydetail)
    {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
        {
          if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_projects = trim($getPackDetail->pack_projects);
              $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
              $check_type = is_numeric($total_projects);
              if($check_type == 'true')
              {
                if($used_projects < $total_projects)
                {
                  ?>
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
                <?php
              }
            } 
          }
        }
        else
        {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_projects = trim($getPackDetail->pack_projects);
              $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
              $check_type = is_numeric($total_projects);
              if($check_type == 'true')
              {
                if($used_projects < $total_projects)
                {
                  ?>
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
                <?php
              }
            }
        }
    }
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('projects', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail)
            {
              $total_projects = trim($getPackDetail->pack_projects);
              $used_projects = trim($getStrategiesProjectCount['project_count_rows']);
              $check_type = is_numeric($total_projects);
              if($check_type == 'true')
              {
                if($used_projects < $total_projects)
                {
                  ?>
                    <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                            <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                            <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                            <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                            <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                    </form>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</a>
                    <?php
                }
              }
              else
              {
                ?>
                <form action="<?php echo base_url('projects-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Add Project</button> 
                </form>
                <?php
              }
            } 
          }
        }
      }
    }    
  }
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
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            if($getPackDetail)
            {
              $total_content_planner = trim($getPackDetail->pack_content_planner);
              $check_type = is_numeric($total_content_planner);
              if($check_type == 'true')
              {
                $current_month = date('m');
                $current_year = date('Y');
                $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                $used_content = trim($getMonthWiseContent['content_count_rows']);
                if($used_content < $total_content_planner)
                {
                  ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
                <?php
                }
                else
                {
                  ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
                <?php
                }
              }
              else
              {
                ?>
                    <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                    </form>
                <?php
              }
            }
          }
        }
        else
        {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            if($getPackDetail)
            {
              $total_content_planner = trim($getPackDetail->pack_content_planner);
              $check_type = is_numeric($total_content_planner);
              if($check_type == 'true')
              {
                $current_month = date('m');
                $current_year = date('Y');
                $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                $used_content = trim($getMonthWiseContent['content_count_rows']);
                if($used_content < $total_content_planner)
                {
                  ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
                <?php
                }
                else
                {
                  ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
                <?php
                }
              }
              else
              {
                ?>
                    <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                    </form>
                <?php
              }
            }
        }
    }
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('content planner', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            if($getPackDetail)
            {
              $total_content_planner = trim($getPackDetail->pack_content_planner);
              $check_type = is_numeric($total_content_planner);
              if($check_type == 'true')
              {
                $current_month = date('m');
                $current_year = date('Y');
                $getMonthWiseContent = $this->Front_model->getMonthWiseContentCorp($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                $used_content = trim($getMonthWiseContent['content_count_rows']);
                if($used_content < $total_content_planner)
                {
                  ?>
                <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                </form>
                <?php
                }
                else
                {
                  ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</a>
                <?php
                }
              }
              else
              {
                ?>
                    <form action="<?php echo base_url('content-project-create');?>" method="post" style="display: inline;">
                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">
                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">
                        <input type="hidden" name="gdept" value="<?php echo $sdetail->gdept_id;?>">
                        <button type="submit" class="btn btn-sm btn-d text-white cus-margin-bottom"><i class="mdi mdi-plus"></i> Create Content</button> 
                    </form>
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

                                                        if(($sdetail->screated_by == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')) || (in_array($this->session->userdata('d168_id'), $all_managers_sid)))
                                                        {
if($privilege_only_view == 'no')
{
                                                            if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                        <form method="post" action="<?php echo base_url('view-kpi-history');?>" style="display: inline;float: right;">
                                                            <input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
                                                            <input type="hidden" name="sname" id="sname" value="<?php echo $sdetail->sname;?>">
                                                           <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>   
                                                        </form>
                                                        <?php
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if(in_array('strategies', $cus_privilege))
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
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            ?>
                                                        <form method="post" action="<?php echo base_url('view-kpi-history');?>" style="display: inline;float: right;">
                                                            <input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
                                                            <input type="hidden" name="sname" id="sname" value="<?php echo $sdetail->sname;?>">
                                                           <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>   
                                                        </form>
                                                        <?php
          }
        }    
      }  
    }
}
                                                        }

                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $sdetail->portfolio_id)
                                                            {
                                                                if($sdetail->screated_by == $this->session->userdata('d168_id'))
                                                                {
if($privilege_only_view == 'no')
{
                                                            if(empty($this->session->userdata('d168_user_cor_id')))
    {
?>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <?php
                                                        $previous_url = $_SERVER['HTTP_REFERER'];
                                                        $previous_url_array = explode('/', $previous_url);
                                                        $previous_page_name = end($previous_url_array);
                                                        if($previous_page_name == 'file-cabinet'){
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                            <?php
                                                        }
    }
    else
    {
      if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
                if(in_array('strategies', $cus_privilege))
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
          if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
          {
            ?>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <?php
                                                        $previous_url = $_SERVER['HTTP_REFERER'];
                                                        $previous_url_array = explode('/', $previous_url);
                                                        $previous_page_name = end($previous_url_array);
                                                        if($previous_page_name == 'file-cabinet'){
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_strategy('<?php echo $sdetail->sid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                            <?php
                                                        }
          }
        }    
      }  
    }
}
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
            if($getPackDetail)
            {
              $total_strategies = trim($getPackDetail->pack_goals_strategies);
              $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
              $check_type = is_numeric($total_strategies);
              if($check_type == 'true')
              {
                if($used_strategies < $total_strategies)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                <?php
              }
            } 
          }
        }
        else
        {
            $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
            if($getPackDetail)
            {
              $total_strategies = trim($getPackDetail->pack_goals_strategies);
              $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
              $check_type = is_numeric($total_strategies);
              if($check_type == 'true')
              {
                if($used_strategies < $total_strategies)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                      <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                <?php
              }
            }
        }
    } 
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('strategies', $cus_privilege))
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
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
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
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$sdetail->gid);
            if($getPackDetail)
            {
              $total_strategies = trim($getPackDetail->pack_goals_strategies);
              $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
              $check_type = is_numeric($total_strategies);
              if($check_type == 'true')
              {
                if($used_strategies < $total_strategies)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_strategy('<?php echo $sdetail->sid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                                                            }
                                                        }
                                                        ?>
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                            <?php
                                            if($Strategy_tasks || $Strategy_subtasks)
                                            {
                                            ?>
                                            <h5 class="font-size-15 mt-4">Status :-
                                              <?php 
                                                $progress_done = $this->Front_model->Strategyprogress_done($sid);
                                                $progress_total = $this->Front_model->Strategyprogress_total($sid);
                                                $sub_progress_done = $this->Front_model->Strategysub_progress_done($sid);
                                                $sub_progress_total = $this->Front_model->Strategysub_progress_total($sid);
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

                                            <p class="text-muted pdes new_sdes<?php echo $sdetail->sid;?>"><?php 
                                            if(!empty($sdetail->sdes))
                                                {
                                                    echo $sdetail->sdes;
                                                }
                                            ?></p>
                                      <div class="row task-dates">
                                        <?php
                                        $est = 0; // Variable to store the sum of estimated times
                                        $trc = 0;
                                        $total_seconds = 0;
                                        $totalTime = "00:00:00";
                                        function timeStringToMinutes($timeString) {
                                          list($hours, $minutes) = sscanf($timeString, '%dh%dm');
                                          return $hours * 60 + $minutes;
                                        }
                                        
                                        function minutesToTimeString($totalMinutes) {
                                          $hours = floor($totalMinutes / 60);
                                          $minutes = $totalMinutes % 60;
                                          return sprintf('%dh %02dm', $hours, $minutes);
                                        }
                                      // Assuming $Goal_tasks is an array of objects with 'estimated_time' property
                                      function calculateTotalTime($Goal_tasks) {
                                          $totalMinutes = 0;
                                          
                                          foreach ($Goal_tasks as $time) {
                                              $estimatedTime = $time->estimated_time;
                                              $totalMinutes += timeStringToMinutes($estimatedTime);
                                          }
                                      
                                          return minutesToTimeString($totalMinutes);
                                      }

                                        $est = calculateTotalTime($Strategy_tasks);

                                        foreach ($Strategy_tasks as $item) {
                                            // $estimatedTime = $item->estimated_time;
                                            $tracked_time = $item->tracked_time;
                                            // $est += $estimatedTime;

                                            $trackedTime = $item->tracked_time;
                                            $trackedTimeInSeconds = strtotime($trackedTime) - strtotime('00:00:00');
                                            $trc += $trackedTimeInSeconds;

                                            $character = "'";
                                                                                        
                                            if (strpos($tracked_time, $character) !== false) {
                                                $tracked_time = str_replace($character, "", $tracked_time);
                                            } else {
                                            }
                                            // Create DateTime objects for the current time and the total time
                                            $datetime1 = DateTime::createFromFormat('H:i:s', $tracked_time);
                                            $datetime2 = DateTime::createFromFormat('H:i:s', $totalTime);

                                            // Add the current time to the total time
                                            $datetime2->add(new DateInterval('PT' . $datetime1->format('H') . 'H' . $datetime1->format('i') . 'M' . $datetime1->format('s') . 'S'));

                                            // Update the total time
                                            $totalTime = $datetime2->format('H:i:s');
                                        }
                                        ?>
                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-time-five me-1 text-d"></i> Time Estimated</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $est; ?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-timer me-1 text-d"></i> Time Tracked</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $totalTime; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- lasjd --> 
                                                                            
                                            <div class="row task-dates">
                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-d"></i> Created Date</h5>
                                                        <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($sdetail->screated_date));?></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bx-briefcase-alt-2 me-1 text-d"></i> Progress</h5>
                                                        <p class="text-muted mb-0">
                                                        <?php 
                                                        if($sdetail->sprogress == "to_do")
                                                        {
                                                            echo "To Do";
                                                        }
                                                        elseif($sdetail->sprogress == "in_progress")
                                                        {
                                                            echo "In Progress";
                                                        }
                                                        elseif($sdetail->sprogress == "in_review")
                                                        {
                                                            echo "In Review";
                                                        }
                                                        elseif($sdetail->sprogress == "done")
                                                        {
                                                            echo "Done";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                </div>
        
                                                <div class="col-sm col-6">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                        <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!-- end col -->

                               <?php
                                if($s_projects)
                                {
                                ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">
                                                Projects
                                                <!-- <?php
                                                if($s_projects)
                                                    {
                                                ?>
                                                <a href="<?php echo base_url('portfolio-goals-strategies-projects').'/'.$sid;?>" class="text-dark">
                                                    <span class="badge bg-d">View All</span>
                                                </a>
                                                <?php
                                                    }
                                                ?> -->
                                            </h4>
                                            <div data-simplebar style="max-height: 200px;"> 
                                            <div class="table-responsive">
                                                <table class="table table-nowrap align-middle table-hover mb-0">
                                                    <tbody>
                                                        <?php
                                                        if($s_projects)
                                                        {
                                                            foreach($s_projects as $pr)
                                                            {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <h5 class="font-size-14 m-0">
                                                                    <?php
                                                                    if($pr->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                      $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                            
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="<?php echo base_url('projects-overview/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;
                                                                                ?>
                                                                            </a>    
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      $estg = calculateTotalTime($p_tasks);

                                                                      foreach ($p_tasks as $itemg) {
                                                                        $tracked_timeg = $itemg->tracked_time;

                                                                          $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>
                                                                        
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <?php
                                                                            
                                                                            if($p_tasks || $p_subtasks)
                                                                            {
                                                                                $progress_done = $this->Front_model->progress_done($pr->pid);
                                                                                $progress_total = $this->Front_model->progress_total($pr->pid);
                                                                                $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                                                $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                                                if($progress_total || $sub_progress_total)
                                                                                {
                                                                                    $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                    $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                    $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                            ?>
                                                                        <div class="col">
                                                                           
                                                                                <div class="progress mt-2">
                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                    if($progress == 0)
                                                                                    {
                                                                                        echo '5%';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $progress.'%';
                                                                                    }
                                                                                    ?>"><?php echo round($progress).'%'; ?></div>
                                                                                </div>
                                                                                </div>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                       
                                                                        <div class="col">
                                                                            <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                        <?php
                                                                        if($p_tasks || $p_subtasks)
                                                                        {
                                                                        ?>
                                                                            <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                    <?php                         
                                                                    }
                                                                    else
                                                                    {
                                                                    $pmember = $this->Front_model->CheckProjectTeamMember($pr->pid);
                                                                    if(!empty($pmember))
                                                                    {
                                                                        foreach($pmember as $member)
                                                                        {
                                                                            if($member->pmember == $this->session->userdata('d168_id') && $member->status == 'accepted')
                                                                            {
                                                                              $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                            
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="<?php echo base_url('projects-overview-accepted/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;
                                                                                ?>
                                                                                
                                                                            </a>  
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                      $trcg = 0;
                                                                      $total_secondsg = 0;
                                                                      $totalTimeg = "00:00:00";
                                                                      $estg = calculateTotalTime($p_tasks);
                                                                      
                                                                      foreach ($p_tasks as $itemg) {
                                                                        $tracked_timeg = $itemg->tracked_time;
                                                                        $characterg = "'";
                                                                                                                      
                                                                          if (strpos($tracked_timeg, $characterg) !== false) {
                                                                              $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                          } else {
                                                                          }
                                                                          // Create DateTime objects for the current time and the total time
                                                                          $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                          $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);

                                                                          // Add the current time to the total time
                                                                          $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));

                                                                          // Update the total time
                                                                          $totalTimeg = $datetime2g->format('H:i:s');
                                                                      }
                                                                      ?>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <div class="col">
                                                                            <?php
                                                                            $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                            $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                            if($p_tasks || $p_subtasks)
                                                                            {
                                                                                $progress_done = $this->Front_model->progress_done($pr->pid);
                                                                                $progress_total = $this->Front_model->progress_total($pr->pid);
                                                                                $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                                                $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                                                if($progress_total || $sub_progress_total)
                                                                                {
                                                                                    $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                    $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                    $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                            ?>
                                                                                <div class="progress mt-2">
                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                    if($progress == 0)
                                                                                    {
                                                                                        echo '5%';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $progress.'%';
                                                                                    }
                                                                                    ?>"><?php echo round($progress).'%'; ?></div>
                                                                                </div>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewAcceptedModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                            <?php
                                                                            if($p_tasks || $p_subtasks)
                                                                            {
                                                                            ?>
                                                                                <a href="<?php echo base_url('project-tasks-list').'/'.$pr->pid;?>" class="nameLink float-end h4 text-d me-2" title="View All Tasks"><i class="mdi mdi-clipboard-check-outline"></i></a>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <?php    
                                                                            }
                                                                            elseif($member->pmember == $this->session->userdata('d168_id') && ($member->status == 'send' || $member->status == 'read_more'))
                                                                            {

                                                                              $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                            
                                                                    ?>
                                                                                    <div class="row">
                                                                        <div class="col">
                                                                           <a  href="<?php echo base_url('projects-overview-request/'.$pr->pid)?>" class="nameLink" title="Open Project">
                                                                               <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;
                                                                                
                                                                                ?>
                                                                            </a> 
                                                                        </div>
                                                                        <?php
                                                                        $estg = 0; // Variable to store the sum of estimated times
                                                                        $trcg = 0;
                                                                        $total_secondsg = 0;
                                                                        $totalTimeg = "00:00:00";
                                                                        $estg = calculateTotalTime($p_tasks);

                                                                        foreach ($p_tasks as $itemg) {
                                                                          $tracked_timeg = $itemg->tracked_time;
                                                                          $characterg = "'";
                                                                                                                        
                                                                            if (strpos($tracked_timeg, $characterg) !== false) {
                                                                                $tracked_timeg = str_replace($characterg, "", $tracked_timeg);
                                                                            } else {
                                                                            }
                                                                            // Create DateTime objects for the current time and the total time
                                                                            $datetime1g = DateTime::createFromFormat('H:i:s', $tracked_timeg);
                                                                            $datetime2g = DateTime::createFromFormat('H:i:s', $totalTimeg);
  
                                                                            // Add the current time to the total time
                                                                            $datetime2g->add(new DateInterval('PT' . $datetime1g->format('H') . 'H' . $datetime1g->format('i') . 'M' . $datetime1g->format('s') . 'S'));
  
                                                                            // Update the total time
                                                                            $totalTimeg = $datetime2g->format('H:i:s');
                                                                        }
                                                                        ?>
                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Estimated:</strong> <span class="ms-1 new_sname"><?php echo $estg;?></span>

                                                                          </div>
                                                                        <div class="col">
                                                                        <strong style="margin-left: 15px;">Time Tracked:</strong> <span class="ms-1 new_sname"><?php echo $totalTimeg;?></span>

                                                                        </div>
                                                                        <div class="col">
                                                                        <?php
                                                                        $p_tasks = $this->Front_model->p_tasks($pr->pid);
                                                                        $p_subtasks = $this->Front_model->p_subtasks($pr->pid);
                                                                        if($p_tasks || $p_subtasks)
                                                                        {
                                                                            $progress_done = $this->Front_model->progress_done($pr->pid);
                                                                            $progress_total = $this->Front_model->progress_total($pr->pid);
                                                                            $sub_progress_done = $this->Front_model->sub_progress_done($pr->pid);
                                                                            $sub_progress_total = $this->Front_model->sub_progress_total($pr->pid);
                                                                            if($progress_total || $sub_progress_total)
                                                                            {
                                                                                $total_pro_progress_done = $progress_done['count_rows'] + $sub_progress_done['count_rows'];
                                                                                $total_pro_progress = $progress_total['count_rows'] + $sub_progress_total['count_rows'];
                                                                                $progress = ($total_pro_progress_done / $total_pro_progress) * 100;
                                                                        ?>
                                                                            <div class="progress mt-2">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated btn-d" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                                                if($progress == 0)
                                                                                {
                                                                                    echo '5%';
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo $progress.'%';
                                                                                }
                                                                                ?>"><?php echo round($progress).'%'; ?></div>
                                                                            </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                        <div class="col">
                                                                            <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $pr->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                                    <?php  
                                                                                }
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                    <p class="font-size-14 text-muted">
                                                                        <strong>
                                                                            <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;?>
                                                                            </strong> 
                                                                                - Not added in project as a member!
                                                                        </p>
                                                                        <!-- <a  href="javascript: void(0);" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" class="nameLink" title="Open Project">
                                                                           <?php
                                                                               if($pr->ptype == 'content')
                                                                               {
                                                                                echo '<strong>CONTENT:</strong>  ';
                                                                               }
                                                                               else
                                                                               {
                                                                                echo '<strong>PROJECT:</strong>  ';
                                                                               }
                                                                                echo $pr->pname;?>
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return RequestAsMember(<?php echo $pr->pid;?>,<?php echo $this->session->userdata('d168_id');?>);" id="request_id<?php echo $pr->pid;?>" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a> -->
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </h5>
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
                                <?php
                                }
                                ?>

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
}
?>