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
    if($pdetail)
    {
        $pfile_detail1 = $this->Front_model->file_itProjectFile($pdetail->pid);
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
        $pid = $pdetail->pid;
        $pcreated_by = $pdetail->pcreated_by;
        $pmanager = $pdetail->pmanager;
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
                                                        $portfolio = $this->Front_model->file_itgetPortfolio2($pdetail->portfolio_id);
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
                                                        <h5 class="font-size-15" style="padding: 8px;"><strong><?php
                                                        if($pdetail->ptype == "content")
                                                        {
                                                            echo "CONTENT:";
                                                        }
                                                        else
                                                        {
                                                            echo "PROJECT:";
                                                        }
                                                    ?></strong> <b><?php echo $pdetail->pname;?></b>
                                                        </h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
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
                                                        ?>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                                                            {
                                                                if($pcreated_by == $this->session->userdata('d168_id')){
                                                                    if($privilege_only_view == 'no')
                                                                    {
                                                                        if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
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
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
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
                                                 if($p_tasks || $p_subtasks)
                                                            {
                                            ?>
                                            <h5 class="font-size-15 mt-4">Status :-
                                               <?php 
                                                $progress_done = $this->Front_model->file_itprogress_done($pid);
                                                $progress_total = $this->Front_model->file_itprogress_total($pid);
                                                $sub_progress_done = $this->Front_model->file_itsub_progress_done($pid);
                                                $sub_progress_total = $this->Front_model->file_itsub_progress_total($pid);
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

                                        <h5 class="font-size-15 mt-4">Links & Comments :</h5>
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
}else{
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
                                                    ?></strong> <b><?php echo $pdetail->pname;?></b>
                                                        </h5>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                                                            {
if($privilege_only_view == 'no')
{
                                                                    if(empty($this->session->userdata('d168_user_cor_id')))
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
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
          elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
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
        }    
      }
      elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
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
            $getTaskCount = $this->Front_model->getProject_TaskCountCorp($pdetail->pid);
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
if($privilege_only_view == 'no')
{
                                                            if(empty($this->session->userdata('d168_user_cor_id')))
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
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
                                                        <form method="post" action="<?php echo base_url('view-project-history');?>" style="display: inline;float: right;">
                                                            <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>">
                                                            <input type="hidden" name="pname" id="pname" value="<?php echo $pdetail->pname;?>">
                                                            <input type="hidden" name="pagename" id="pagename" value="<?php if($pdetail->ptype == "content"){ echo 'content-planner';}elseif($pdetail->ptype == "goal_strategy"){ echo 'goals-list';}else{ echo 'projects-list';}?>">
                                                           <button type="submit" class="btn" style="padding: 0 !important;" title="View History"><i class="mdi mdi-clock-check h3 eye_preview float-end me-1" style="padding: 0 !important;font-size: 1.2rem;"></i></button>   
                                                        </form>
                                                        <?php
          }
          elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
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
        }    
      } 
      elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
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
    }
}
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            if($_COOKIE["d168_selectedportfolio"] == $pdetail->portfolio_id)
                                                            {
if($privilege_only_view == 'no')
{
       if(empty($this->session->userdata('d168_user_cor_id')))
    {
 ?>
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <?php
                                                        $previous_url = $_SERVER['HTTP_REFERER'];
                                                        $previous_url_array = explode('/', $previous_url);
                                                        $previous_page_name = end($previous_url_array);
                                                        if($previous_page_name == 'file-cabinet'){
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
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
                if($pdetail->ptype == "content")
                {
                   if(in_array('content planner', $cus_privilege))
                    {
                      $privilege = "yes";
                    } 
                }
                else
                {
                  if(in_array('projects', $cus_privilege))
                    {
                      $privilege = "yes";
                    }  
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
                                                        <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return delete_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 3px !important;font-size: 1.2rem;" title="Delete"><i class="bx bx-trash"></i></a>
                                                        <?php
                                                        $previous_url = $_SERVER['HTTP_REFERER'];
                                                        $previous_url_array = explode('/', $previous_url);
                                                        $previous_page_name = end($previous_url_array);
                                                        if($previous_page_name == 'file-cabinet'){
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return archive_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="Archive"><i class="bx bx-archive-in"></i></a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return file_it_project('<?php echo $pdetail->pid;?>');" style="padding: 0 !important;padding-top: 4px !important;font-size: 1.2rem;" title="File it"><i class="mdi mdi-folder-multiple-plus-outline"></i></a>
                                                            <?php
                                                        }
          }
        }    
      }  
    }                                                             
                                                        
}
    if($pdetail->ptype == 'regular')
    {
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
                $getProjectCount2 = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
                if($getPackDetail2)
                {
                  $total_projects2 = trim($getPackDetail2->pack_projects);
                  $used_projects2 = trim($getProjectCount2['project_count_rows']);
                  $check_type2 = is_numeric($total_projects2);
                  if($check_type2 == 'true')
                  {
                    if($used_projects2 < $total_projects2)
                    {
                      ?>
                      <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                      <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                      <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail2 = $this->Front_model->getPackDetail($getMydetail->package_id);
                $getProjectCount2 = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
                if($getPackDetail2)
                {
                  $total_projects2 = trim($getPackDetail2->pack_projects);
                  $used_projects2 = trim($getProjectCount2['project_count_rows']);
                  $check_type2 = is_numeric($total_projects2);
                  if($check_type2 == 'true')
                  {
                    if($used_projects2 < $total_projects2)
                    {
                      ?>
                      <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                      <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetail2 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getProjectCount2 = $this->Front_model->getProjectCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetail2)
            {
              $total_projects2 = trim($getPackDetail2->pack_projects);
              $used_projects2 = trim($getProjectCount2['project_count_rows']);
              $check_type2 = is_numeric($total_projects2);
              if($check_type2 == 'true')
              {
                if($used_projects2 < $total_projects2)
                {
                  ?>
                  <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                  <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
    elseif($pdetail->ptype == "goal_strategy")
    {
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
            $getPackDetailG = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetailG)
            {
              $total_projectsG = trim($getPackDetailG->pack_projects);
              $used_projectsG = trim($getStrategiesProjectCount['project_count_rows']);
              $check_typeG = is_numeric($total_projectsG);
              if($check_typeG == 'true')
              {
                if($used_projectsG < $total_projectsG)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                <?php
              }
            } 
          }
        }
        else
        {
            $getPackDetailG = $this->Front_model->getPackDetail($getMydetail->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCount($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetailG)
            {
              $total_projectsG = trim($getPackDetailG->pack_projects);
              $used_projectsG = trim($getStrategiesProjectCount['project_count_rows']);
              $check_typeG = is_numeric($total_projectsG);
              if($check_typeG == 'true')
              {
                if($used_projectsG < $total_projectsG)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetailG = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesProjectCount = $this->Front_model->getProjectCountCorp($_COOKIE["d168_selectedportfolio"]);
            if($getPackDetailG)
            {
              $total_projectsG = trim($getPackDetailG->pack_projects);
              $used_projectsG = trim($getStrategiesProjectCount['project_count_rows']);
              $check_typeG = is_numeric($total_projectsG);
              if($check_typeG == 'true')
              {
                if($used_projectsG < $total_projectsG)
                {
                  ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
    elseif($pdetail->ptype == "content")
    {
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
                $getPackDetail3 = $this->Front_model->getPackDetail($getMydetail->package_id);
                if($getPackDetail3)
                {
                  $total_content_planner = trim($getPackDetail3->pack_content_planner);
                  $check_type3 = is_numeric($total_content_planner);
                  if($check_type3 == 'true')
                  {
                    $current_month = date('m');
                    $current_year = date('Y');
                    $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                    $used_content = trim($getMonthWiseContent['content_count_rows']);
                    if($used_content < $total_content_planner)
                    {
                      ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
                          <img id="dup_loader" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <?php
                  }
                }
              }
            }
            else
            {
                $getPackDetail3 = $this->Front_model->getPackDetail($getMydetail->package_id);
                if($getPackDetail3)
                {
                  $total_content_planner = trim($getPackDetail3->pack_content_planner);
                  $check_type3 = is_numeric($total_content_planner);
                  if($check_type3 == 'true')
                  {
                    $current_month = date('m');
                    $current_year = date('Y');
                    $getMonthWiseContent = $this->Front_model->getMonthWiseContent($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                    $used_content = trim($getMonthWiseContent['content_count_rows']);
                    if($used_content < $total_content_planner)
                    {
                      ?>
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                    <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
            <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return Expire_Package_popup();" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
            <?php
          }
          else
          {
            $getPackDetail3 = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            if($getPackDetail3)
            {
              $total_content_planner = trim($getPackDetail3->pack_content_planner);
              $check_type3 = is_numeric($total_content_planner);
              if($check_type3 == 'true')
              {
                $current_month = date('m');
                $current_year = date('Y');
                $getMonthWiseContent = $this->Front_model->getMonthWiseContentCorp($current_month,$current_year,$_COOKIE["d168_selectedportfolio"]);
                $used_content = trim($getMonthWiseContent['content_count_rows']);
                if($used_content < $total_content_planner)
                {
                  ?>
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                <a class="h3 eye_preview float-end me-1" href="javascript:void(0)" onclick="return duplicate_project('<?php echo $pdetail->pid;?>');" id="dup_pro_id" style="padding: 0 !important;font-size: 1.2rem;" title="Duplicate"><i class="mdi mdi-content-duplicate"></i></a>
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
                                       
                                        <h5 class="font-size-15 mt-4">Links & Comments :</h5>
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
                                        
                                        $est = calculateTotalTime($p_tasks);
                                      
                                        foreach ($p_tasks as $item) {
                                          $tracked_time = $item->tracked_time;
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
                                                    <h5 class="font-size-14"><i class="bx bx-timer me-1 text-d"></i>Time Tracked</h5>
                                                    <p class="text-muted mb-0 " style="margin-left: 22px;"><?php echo $totalTime; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- lasjd -->
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
}
?>