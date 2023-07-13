<?php
// if($this->session->userdata('d168_refresh_page'))
// {
//   if($this->session->userdata('d168_refresh_page') == "true") 
//   { 
//     //echo "yes";
//     //die();
//     header("Refresh:0");
//     $this->session->set_userdata('d168_refresh_page','false');
//   }
// }
header("Cache-Control: no cache");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /><?php
$privilege_only_view = "no";//for company guest role

$get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));

$sideb_email = "";
$get_my_active_pack_id = "";
if($get_active_Email_ID)
{
$sideb_email = $get_active_Email_ID->email_address;
$get_my_active_pack_id = $get_active_Email_ID->package_id;
}

if(isset($_COOKIE["d168_selectedportfolio"]))
{
    $abc = $this->Front_model->getAllPortfolio($_COOKIE["d168_selectedportfolio"]);
    if(empty($abc))
    {
        setcookie("d168_selectedportfolio", "", time()-(60*60*24*7),"/");
        //header("Refresh:0");
        redirect(base_url('dashboard'));
    }
    else
    {
        $ActiveEmail_ID = "";
        if($get_active_Email_ID)
        {
            $ActiveEmail_ID = $get_active_Email_ID->email_address;
        }
        $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($_COOKIE["d168_selectedportfolio"], $ActiveEmail_ID);
        //print_r($check_active_portfolio);
        //die();
        $check_to_redirect = "yes";
        if($check_active_portfolio)
        {
          $check_to_redirect = "no";
        }
        if($check_to_redirect == "yes")
        {
            setcookie("d168_selectedportfolio", "", time()-(60*60*24*7),"/");
            //header("Refresh:0");
            redirect(base_url('dashboard'));
        }
    }
}
//delete data from trash after 30 days
      $get_today_date = date('Y-m-d');
      //portfolio trash
      $get_portfolio_trash = $this->Front_model->get_portfolio_trash_date($get_today_date);
      if($get_portfolio_trash)
      {
        foreach($get_portfolio_trash as $port_trash)
        {
          $get_portfolio_id = $port_trash->portfolio_id;
          $get_port_pro_trash = $this->Front_model->portfolio_projectsTrash($get_portfolio_id);
          $get_port_task_trash = $this->Front_model->getPortfolioAllTaskTrash($get_portfolio_id);
          $get_port_subtask_trash = $this->Front_model->getPortfolioAllSubtaskTrash($get_portfolio_id);
          $get_port_cp_trash = $this->Front_model->getPortfolioAllCPTrash($get_portfolio_id);
          $get_port_goals_trash = $this->Front_model->portfolio_goalsTrash($get_portfolio_id);
          $get_port_strategies_trash = $this->Front_model->portfolio_strategiesTrash($get_portfolio_id);
          $get_port_dept_trash = $this->Front_model->get_PortfolioAllDepartment($get_portfolio_id);          
          if($get_port_goals_trash)
          {
            $this->Front_model->delete_portfolio_goals($get_portfolio_id);
          }
          if($get_port_strategies_trash)
          {
            $this->Front_model->delete_portfolio_strategies($get_portfolio_id);
          }
          if($get_port_dept_trash)
          {
            $this->Front_model->delete_portfolio_dept($get_portfolio_id);
          }
          if($get_port_pro_trash)
          {
            foreach($get_port_pro_trash as $port_pro_trash)
            {
                $get_pid = $port_pro_trash->pid;
                $this->Front_model->delete_project_files($get_pid);
                $this->Front_model->delete_project_invited_members($get_pid);
                $this->Front_model->delete_project_management($get_pid);
                $this->Front_model->delete_project_management_fields($get_pid);
                $this->Front_model->delete_project_members($get_pid);
                $this->Front_model->delete_project_suggested_members($get_pid);
                $this->Front_model->delete_project_history($get_pid);
                $this->Front_model->delete_project_request_member($get_pid);
            }
            $this->Front_model->delete_portfolio_project($get_portfolio_id);
          }
          if($get_port_task_trash)
          {
            foreach($get_port_task_trash as $port_task_trash)
            {
                $get_tid = $port_task_trash->tid;
                $this->Front_model->delete_task_t_trash($get_tid);
            }
            $this->Front_model->delete_portfolio_task($get_portfolio_id);
          }
          if($get_port_subtask_trash)
          {
            foreach($get_port_subtask_trash as $port_stask_trash)
            {
                $get_stid = $port_stask_trash->stid;
                $this->Front_model->delete_task_st_trash($get_stid);
            }
            $this->Front_model->delete_portfolio_subtask($get_portfolio_id);
          }
          if($get_port_cp_trash)
          {
            foreach($get_port_cp_trash as $port_cp_trash)
            {
                $get_pc_id = $port_cp_trash->pc_id;
                $this->Front_model->delete_cp_t_trash($get_pc_id);
            }
            $this->Front_model->delete_portfolio_cp($get_portfolio_id);
          }
          $this->Front_model->delete_portfolio_member($get_portfolio_id);
          $this->Front_model->delete_portfolio($get_portfolio_id);
        }
      } 
      //goal trash
      $get_goal_trash = $this->Front_model->get_goal_trash_date($get_today_date);
      if($get_goal_trash)
      {
        foreach($get_goal_trash as $g_trash)
        {
            $get_gid = $g_trash->gid;
            $get_goal_strategies_trash = $this->Front_model->GoalsAllStrategiesList_to_delete($get_gid);
            if($get_goal_strategies_trash)
            {
                  foreach($get_goal_strategies_trash as $s_trash)
                  {
                    $get_sid = $s_trash->sid;
                    $get_goal_strategies_projects_trash = $this->Front_model->StrategyAllProjectsList_to_delete($get_sid);
                    if($get_goal_strategies_projects_trash)
                    {
                        foreach($get_goal_strategies_projects_trash as $s_p_trash)
                        {
                            $get_pid = $s_p_trash->pid;
                            $get_pro_task_trash = $this->Front_model->getProjectAllTaskTrash($get_pid);
                            $get_pro_subtask_trash = $this->Front_model->getProjectAllSubtaskTrash($get_pid);
                            $get_pro_cp_trash = $this->Front_model->getProjectAllCPTrash($get_pid);

                              $this->Front_model->delete_project_files($get_pid);
                              $this->Front_model->delete_project_invited_members($get_pid);
                              $this->Front_model->delete_project_management($get_pid);
                              $this->Front_model->delete_project_management_fields($get_pid);
                              $this->Front_model->delete_project_members($get_pid);
                              $this->Front_model->delete_project_suggested_members($get_pid);
                              $this->Front_model->delete_project_history($get_pid);
                              $this->Front_model->delete_project_request_member($get_pid);
                            if($get_pro_task_trash)
                            {
                              foreach($get_pro_task_trash as $pro_task_trash)
                              {
                                  $get_tid = $pro_task_trash->tid;
                                  $this->Front_model->delete_task_t_trash($get_tid);
                              }
                              $this->Front_model->delete_project_tasks($get_pid);
                            }
                            if($get_pro_subtask_trash)
                            {
                              foreach($get_pro_subtask_trash as $pro_stask_trash)
                              {
                                  $get_stid = $pro_stask_trash->stid;
                                  $this->Front_model->delete_task_st_trash($get_stid);
                              }
                              $this->Front_model->delete_project_subtasks($get_pid);
                            }
                            if($get_pro_cp_trash)
                            {
                              foreach($get_pro_cp_trash as $pro_cp_trash)
                              {
                                  $get_pc_id = $pro_cp_trash->pc_id;
                                  $this->Front_model->delete_cp_t_trash($get_pc_id);
                              }
                              $this->Front_model->delete_project_cp($get_pid);
                            }
                              $this->Front_model->delete_project($get_pid);
                        }
                    }
                    $this->Front_model->delete_strategies($get_sid);    
                  }
            }
            $this->Front_model->delete_goal($get_gid);
        }
      }
      //strategies trash
      $get_strategies_trash = $this->Front_model->get_strategies_trash_date($get_today_date);
      if($get_strategies_trash)
      {
            foreach($get_strategies_trash as $s_trash)
            {
              $get_sid = $s_trash->sid;
              $get_goal_strategies_projects_trash = $this->Front_model->StrategyAllProjectsList_to_delete($get_sid);
                if($get_goal_strategies_projects_trash)
                {
                    foreach($get_goal_strategies_projects_trash as $s_p_trash)
                    {
                        $get_pid = $s_p_trash->pid;
                        $get_pro_task_trash = $this->Front_model->getProjectAllTaskTrash($get_pid);
                        $get_pro_subtask_trash = $this->Front_model->getProjectAllSubtaskTrash($get_pid);
                        $get_pro_cp_trash = $this->Front_model->getProjectAllCPTrash($get_pid);

                          $this->Front_model->delete_project_files($get_pid);
                          $this->Front_model->delete_project_invited_members($get_pid);
                          $this->Front_model->delete_project_management($get_pid);
                          $this->Front_model->delete_project_management_fields($get_pid);
                          $this->Front_model->delete_project_members($get_pid);
                          $this->Front_model->delete_project_suggested_members($get_pid);
                          $this->Front_model->delete_project_history($get_pid);
                          $this->Front_model->delete_project_request_member($get_pid);
                        if($get_pro_task_trash)
                        {
                          foreach($get_pro_task_trash as $pro_task_trash)
                          {
                              $get_tid = $pro_task_trash->tid;
                              $this->Front_model->delete_task_t_trash($get_tid);
                          }
                          $this->Front_model->delete_project_tasks($get_pid);
                        }
                        if($get_pro_subtask_trash)
                        {
                          foreach($get_pro_subtask_trash as $pro_stask_trash)
                          {
                              $get_stid = $pro_stask_trash->stid;
                              $this->Front_model->delete_task_st_trash($get_stid);
                          }
                          $this->Front_model->delete_project_subtasks($get_pid);
                        }
                        if($get_pro_cp_trash)
                        {
                          foreach($get_pro_cp_trash as $pro_cp_trash)
                          {
                              $get_pc_id = $pro_cp_trash->pc_id;
                              $this->Front_model->delete_cp_t_trash($get_pc_id);
                          }
                          $this->Front_model->delete_project_cp($get_pid);
                        }
                          $this->Front_model->delete_project($get_pid);
                    }
                }
                $this->Front_model->delete_strategies($get_sid);    
            }
       }
      //project trash
      $get_project_trash = $this->Front_model->get_project_trash_date($get_today_date);
      if($get_project_trash)
      {
        foreach($get_project_trash as $p_trash)
        {
          $get_pid = $p_trash->pid;
          $get_pro_task_trash = $this->Front_model->getProjectAllTaskTrash($get_pid);
          $get_pro_subtask_trash = $this->Front_model->getProjectAllSubtaskTrash($get_pid);
          $get_pro_cp_trash = $this->Front_model->getProjectAllCPTrash($get_pid);

            $this->Front_model->delete_project_files($get_pid);
            $this->Front_model->delete_project_invited_members($get_pid);
            $this->Front_model->delete_project_management($get_pid);
            $this->Front_model->delete_project_management_fields($get_pid);
            $this->Front_model->delete_project_members($get_pid);
            $this->Front_model->delete_project_suggested_members($get_pid);
            $this->Front_model->delete_project_history($get_pid);
            $this->Front_model->delete_project_request_member($get_pid);
          if($get_pro_task_trash)
          {
            foreach($get_pro_task_trash as $pro_task_trash)
            {
                $get_tid = $pro_task_trash->tid;
                $this->Front_model->delete_task_t_trash($get_tid);
            }
            $this->Front_model->delete_project_tasks($get_pid);
          }
          if($get_pro_subtask_trash)
          {
            foreach($get_pro_subtask_trash as $pro_stask_trash)
            {
                $get_stid = $pro_stask_trash->stid;
                $this->Front_model->delete_task_st_trash($get_stid);
            }
            $this->Front_model->delete_project_subtasks($get_pid);
          }
          if($get_pro_cp_trash)
          {
            foreach($get_pro_cp_trash as $pro_cp_trash)
            {
                $get_pc_id = $pro_cp_trash->pc_id;
                $this->Front_model->delete_cp_t_trash($get_pc_id);
            }
            $this->Front_model->delete_project_cp($get_pid);
          }
            $this->Front_model->delete_project($get_pid);
        }
      }
      //project file trash
      $get_pfile_trash = $this->Front_model->get_pfile_trash($get_today_date);
      if($get_pfile_trash)
      {
        foreach($get_pfile_trash as $pfile_trash)
        {
            $get_pfile_id = $pfile_trash->pfile_id;
            $res = $this->Front_model->delete_pfile($get_pfile_id);
            if ($res == true) 
            {
                unlink("assets/project_files/".$pfile_trash->pfile);
            }
        }
      }
      //task trash
      $get_task_trash = $this->Front_model->get_task_trash_date($get_today_date);
      if($get_task_trash)
      {
        foreach($get_task_trash as $t_trash)
        {
          $get_tid = $t_trash->tid;
          $this->Front_model->delete_task_subtask($get_tid);
          $this->Front_model->delete_task_subtask_trash($get_tid);
          $this->Front_model->delete_task_t_trash($get_tid);
          $this->Front_model->delete_task($get_tid);
        }
      }
      //task file trash
      $get_tfile_trash = $this->Front_model->get_tfile_trash($get_today_date);
      if($get_tfile_trash)
      {
        foreach($get_tfile_trash as $tfile_trash)
        {
            $get_tfile_id = $tfile_trash->trash_id;
            $res = $this->Front_model->delete_tfile_trash($get_tfile_id);
            if ($res == true) 
            {
                unlink("assets/task_files/".$tfile_trash->tfile);
            }
        }
      }
      //subtask trash
      $get_subtask_trash = $this->Front_model->get_subtask_trash_date($get_today_date);
      if($get_subtask_trash)
      {
        foreach($get_subtask_trash as $st_trash)
        {
          $get_stid = $st_trash->stid;
          $this->Front_model->delete_task_st_trash($get_stid);
          $this->Front_model->delete_subtask($get_stid);
        }
      }
      //subtask file trash
      $get_stfile_trash = $this->Front_model->get_stfile_trash($get_today_date);
      if($get_stfile_trash)
      {
        foreach($get_stfile_trash as $stfile_trash)
        {
            $get_stfile_id = $stfile_trash->strash_id;
            $res = $this->Front_model->delete_stfile_trash($get_stfile_id);
            if ($res == true) 
            {
                unlink("assets/task_files/".$stfile_trash->stfile);
            }
        }
      }
      //platform trash
      $get_platform_trash = $this->Front_model->get_platform_trash_date($get_today_date);
      if($get_platform_trash)
      {
        foreach($get_platform_trash as $cp_trash)
        {
          $get_pc_id = $cp_trash->pc_id;
          $this->Front_model->delete_cp_t_trash($get_pc_id);
          $this->Front_model->delete_platform($get_pc_id);
        }
      }
      //platform file trash
      $get_platformfile_trash = $this->Front_model->get_platformfile_trash($get_today_date);
      if($get_platformfile_trash)
      {
        foreach($get_platformfile_trash as $cpfile_trash)
        {
            $get_cpfile_id = $cpfile_trash->pc_trash_id;
            $res = $this->Front_model->delete_platformfile_trash($get_cpfile_id);
            if ($res == true) 
            {
                unlink("assets/plan_content_files/".$cpfile_trash->pc_file);
            }
        }
      }
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url();?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo base_url();?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="65" style="margin-left: -7px;">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url();?>assets/images/logo-main.png" alt="" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect fixed-sidebar-cust" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- App Search-->
            
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="tour_change_portfolio" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    if(isset($_COOKIE["d168_selectedportfolio"]))
                    {
                        if($abc)
                        {
                            if($abc->photo)
                            {
                            ?>      
                            <img class="rounded-circle header-profile-user" src="<?php echo base_url('assets/portfolio_photos/'.$abc->photo);?>" alt="Header Avatar" style="padding: 0px !important;">
                            <span class="d-none d-xl-inline-block ms-2" key="t-henry"><?php if($abc->portfolio_user == 'company'){ echo $abc->portfolio_name;}elseif($abc->portfolio_user == 'individual'){ echo $abc->portfolio_name.' '.$abc->portfolio_mname.' '.$abc->portfolio_lname;}else{ echo $abc->portfolio_name;}?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            <?php
                            }
                            else
                            {
                            ?>
                            <span class="text-white avatar-title img-thumbnail rounded-circle header_portfolio_logo">
                            <?php 
                            if($abc->portfolio_user == 'company')
                                { 
                                    $fullname = $abc->portfolio_name;
                                    $member_name = explode(" ", $fullname);
                                    $profile_name = "";
                                    foreach ($member_name as $n) 
                                    {
                                      $profile_name .= $n[0];
                                    }
                                    echo strtoupper($profile_name);
                                }
                            elseif($abc->portfolio_user == 'individual')
                                { 
                                    $fullname = $abc->portfolio_name.' '.$abc->portfolio_lname;
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
                                $fullname = $abc->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n) 
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                            ?>                                
                            </span>
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php if($abc->portfolio_user == 'company'){ echo $abc->portfolio_name;}elseif($abc->portfolio_user == 'individual'){ echo $abc->portfolio_name.' '.$abc->portfolio_mname.' '.$abc->portfolio_lname;}else{ echo $abc->portfolio_name;}?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            <?php
                            }
                        }
                        else
                        {
                            delete_cookie('d168_selectedportfolio');
                        }
                    }
                    else
                    {
                    ?>
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url('assets/images/portfolio_image_logo.png');?>" alt="Header Avatar" style="background-color: #b9b8b966 !important;">
                    <span class="d-none d-xl-inline-block ms-2" key="t-henry">Portfolio</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    <?php
                    }
                    ?>                    
                </button>
                <div class="dropdown-menu" style="margin: 0px;min-width: 15rem;">
                <div data-simplebar style="max-height: 450px;">
                    <!-- item-->
                    <?php
                        $Side_Portfolio = $this->Front_model->get_SideBar_Portfolio($sideb_email); 
                        if($Side_Portfolio)
                        {
                            foreach($Side_Portfolio as $c)
                                {
                    ?>
                    <a class="dropdown-item <?php if(isset($_COOKIE["d168_selectedportfolio"])) { if($_COOKIE["d168_selectedportfolio"] == $c->portfolio_id) { echo 'mm-active';} }?>" href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $c->portfolio_id;?>');">
                        <?php if($c->photo)
                        {
                        ?>   
                        <img class="rounded-circle header-profile-user me-2" src="<?php echo base_url('assets/portfolio_photos/'.$c->photo);?>" alt="Header Avatar" style="padding: 0px !important;">               
                        <?php
                        }
                        else
                        {
                        ?>
                        <span class="text-white avatar-title img-thumbnail rounded-circle header_portfolio_logo">
                        <?php 
                        if($c->portfolio_user == 'company')
                            { 
                                $fullname = $c->portfolio_name;
                                $member_name = explode(" ", $fullname);
                                $profile_name = "";
                                foreach ($member_name as $n) 
                                {
                                  $profile_name .= $n[0];
                                }
                                echo strtoupper($profile_name);
                            }
                        elseif($c->portfolio_user == 'individual')
                            { 
                                $fullname = $c->portfolio_name.' '.$c->portfolio_lname;
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
                            $fullname = $c->portfolio_name;
                            $member_name = explode(" ", $fullname);
                            $profile_name = "";
                            foreach ($member_name as $n) 
                            {
                              $profile_name .= $n[0];
                            }
                            echo strtoupper($profile_name);
                        }
                        ?>                                            
                        </span>
                        <?php
                        }
                        ?>
                        <span><?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?></span>
                    </a>
                    <?php
                                }
                            ?>
                            <div class="dropdown-divider"></div>
                            <?php
                        }
                    ?>
                    </div>
<?php
$getMydetailSide = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if($getMydetailSide)
{
  if($getMydetailSide->role_in_comp != $this->session->userdata('d168_user_role_in_comp'))
  {
    $this->session->set_userdata('d168_user_role_in_comp',$getMydetailSide->role_in_comp);
  }
}
//echo $this->session->userdata('d168_user_role_in_comp');
if(empty($this->session->userdata('d168_user_cor_id')))
{              
  if($getMydetailSide)
  {
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetailSide->package_expiry) !== false)
    {
      if($getMydetailSide->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" onclick="return Expire_Package_popup();" href="javascript: void(0);">
            <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
            <span>Create New Portfolio</span>
        </a>
        <?php
      }
      else
      {
        $getPackDetailSide = $this->Front_model->getPackDetail($getMydetailSide->package_id);
        $getPortfolioCountSide = $this->Front_model->getPortfolioCount();
        if($getPackDetailSide)
        {
          $total_portfolioSide = trim($getPackDetailSide->pack_portfolio);
          $used_portfolioSide = trim($getPortfolioCountSide['portfolio_count_rows']);
          $check_typeSide = is_numeric($total_portfolioSide);
          if($check_typeSide == 'true')
          {
            if($used_portfolioSide < $total_portfolioSide)
            {
              ?>
              <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                  <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                  <span>Create New Portfolio</span>
              </a>
              <?php
            }
            else
            {
              ?>
              <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="javascript: void(0);" onclick="return limit_Exceeds_popup();">
                  <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                  <span>Create New Portfolio</span>
              </a>
              <?php
            }
          }
          else
          {
            ?>
            <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                <span>Create New Portfolio</span>
            </a>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetailSide = $this->Front_model->getPackDetail($getMydetailSide->package_id);
        $getPortfolioCountSide = $this->Front_model->getPortfolioCount();
        if($getPackDetailSide)
        {
          $total_portfolioSide = trim($getPackDetailSide->pack_portfolio);
          $used_portfolioSide = trim($getPortfolioCountSide['portfolio_count_rows']);
          $check_typeSide = is_numeric($total_portfolioSide);
          if($check_typeSide == 'true')
          {
            if($used_portfolioSide < $total_portfolioSide)
            {
              ?>
              <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                  <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                  <span>Create New Portfolio</span>
              </a>
              <?php
            }
            else
            {
              ?>
              <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="javascript: void(0);" onclick="return limit_Exceeds_popup();">
                  <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                  <span>Create New Portfolio</span>
              </a>
              <?php
            }
          }
          else
          {
            ?>
            <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                <span>Create New Portfolio</span>
            </a>
            <?php
          }
        }
    }
  } 
}
else
{
  //echo $this->session->userdata('d168_user_cor_id');
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
            if(in_array('portfolio', $cus_privilege))
            {
              $privilege = "yes";
            }
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
      //echo $privilege_only_view;
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" onclick="return Expire_Package_popup();" href="javascript: void(0);">
                <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                <span>Create New Portfolio</span>
            </a>
            <?php
          }
          else
          {
            $getPackDetailSide = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getPortfolioCountSide = $this->Front_model->getPortfolioCountCorp();
            if($getPackDetailSide)
            {
              $total_portfolioSide = trim($getPackDetailSide->pack_portfolio);
              $used_portfolioSide = trim($getPortfolioCountSide['portfolio_count_rows']);
              $check_typeSide = is_numeric($total_portfolioSide);
              if($check_typeSide == 'true')
              {
                if($used_portfolioSide < $total_portfolioSide)
                {
                  ?>
                  <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                      <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                      <span>Create New Portfolio</span>
                  </a>
                  <?php
                }
                else
                {
                  ?>
                  <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="javascript: void(0);" onclick="return limit_Exceeds_popup();">
                      <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                      <span>Create New Portfolio</span>
                  </a>
                  <?php
                }
              }
              else
              {
                ?>
                <a class="dropdown-item <?php if($page == 'portfolio-create') { echo 'mm-active';} ?>" href="<?php echo base_url('portfolio-create');?>">
                    <i class="bx bx-plus font-size-16 align-middle me-1"></i> 
                    <span>Create New Portfolio</span>
                </a>
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
                </div>
            </div>        
        </div>

        <div class="dropdown d-lg-inline-block ms-1 mt-1 center">
           <?php
           if($page == 'index')
            { 
                if($get_active_Email_ID)
                {
                    if($get_active_Email_ID->msg_flag == '0')
                    {
                        $upData1 = array(
                          'msg_flag' => '1',
                        );
                        $upData1 = $this->security->xss_clean($upData1); // xss filter
                        $this->Front_model->updateRegistration($upData1,$this->session->userdata('d168_id'));
                    ?>
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <h4 class="font-size-18 mt-2">Welcome !</h4>
                        </div>
                    </form>
                    <?php
                    }
                    else
                    {
                    ?>
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <h4 class="font-size-18 mt-2">Welcome Back !</h4>
                        </div>
                    </form>
                    <?php
                    }
                }
                else
                {
                ?>
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <h4 class="font-size-18 mt-2">Welcome Back !</h4>
                    </div>
                </form>
                <?php
                }
            } 
           ?>
        </div>
         
        <div class="d-flex">

            <!-- <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-d" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->

            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-customize"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/github.png" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/bitbucket.png" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/dribbble.png" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/dropbox.png" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?php echo base_url();?>assets/images/brands/slack.png" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
?>           
<div class="row d-none d-sm-block" id="tour_upgrade_button">
  <?php
  $active_ad = $this->Front_model->active_ad($this->session->userdata('d168_id'));
  //print_r($active_ad);
  if($active_ad)
  {
      if($active_ad->pack_id != $get_my_active_pack_id)
      {
      ?>
          <div class="dropdown d-lg-inline-block ms-1 mt-1">
              <a href="<?php echo base_url('pricing-packages');?>">
                  <img src="<?php echo base_url('/assets/ad_header/'.$active_ad->ad);?>" class="img-fluid">
              </a>
          </div>
      <?php
      }
      else
      {
      ?>
      <div class="dropdown d-lg-inline-block ms-1 mt-1">
          <a class="btn btn-sm btn-d text-white mt-3" href="<?php echo base_url('pricing-packages');?>">
              <strong>Upgrade</strong>
          </a>
      </div>
      <?php  
      }
  }
  else
  {
  ?>
  <div class="dropdown d-lg-inline-block ms-1 mt-1">
      <a class="btn btn-sm btn-d text-white mt-3" href="<?php echo base_url('pricing-packages');?>">
          <strong>Upgrade</strong>
      </a>
  </div>
  <?php
  }
  ?>
</div>
<div class="row d-block d-sm-none">
  <div class="dropdown d-lg-inline-block ms-1 mt-1">
      <a class="btn btn-sm btn-d text-white mt-3" href="<?php echo base_url('pricing-packages');?>">
          <strong>Upgrade</strong>
      </a>
  </div>
</div>
<?php
}
?>
                        

            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <a class="btn header-item noti-icon waves-effect" href="http://support.decision168.com" style="font-weight: 400;line-height: 4.7;" title="Support" target="_blank">
                    <i class="bx bx-support"></i>
                </a>
            </div> -->

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                    
                    <?php
                        $task_notification_clear = $this->Front_model->task_notification_clear();//new task notification
                        $currentDate = date("Y-m-d");
                        $OverdueTasks_clear = $this->Front_model->OverdueTasks_clear($currentDate);//overdue task notification
                        $OverdueSubtasks_clear = $this->Front_model->OverdueSubtasks_clear($currentDate);//overdue subtask notification
                        $pending_plist_clear = $this->Front_model->PendingProjectList_clear();//pending project notification
                        $check_task_review_sent_clear = $this->Front_model->check_task_review_sent_clear();//sent to review
                        $check_task_review_deny_clear = $this->Front_model->check_task_review_deny_clear();//review denied
                        $check_task_review_approve_clear = $this->Front_model->check_task_review_approve_clear();//review approved
                        $get_all_cproject = $this->Front_model->ProjectList();//project file
                        $get_all_aproject = $this->Front_model->AcceptedProjectList();//project file       
                        $get_all_pproject = $this->Front_model->PendingProjectList();//project file
                        $get_all_rproject = $this->Front_model->ReadMoreProjectList();//project file                             
                        $subtask_notification_clear = $this->Front_model->subtask_notification_clear();//new subtask notification
                        $check_subtask_review_sent_clear = $this->Front_model->check_subtask_review_sent_clear();//sent to review
                        $check_subtask_review_deny_clear = $this->Front_model->check_subtask_review_deny_clear();//review denied
                        $check_subtask_review_approve_clear = $this->Front_model->check_subtask_review_approve_clear();//review approved
                        $check_task_arrive_review_clear = $this->Front_model->check_task_arrive_review_clear();//arrive for review
                        $check_subtask_arrive_review_clear = $this->Front_model->check_subtask_arrive_review_clear();//arrive for review
                        $check_portfolio_accepted_notify_clear = $this->Front_model->check_portfolio_accepted_notify_clear(); //portfolio accepted 
                        $check_project_accepted_notify_clear = $this->Front_model->check_project_accepted_notify_clear(); //project accepted 
                        $check_project_invite_accepted_notify_clear = $this->Front_model->check_project_invite_accepted_notify_clear(); //project accepted 
                        $check_project_request_member_notify_clear = $this->Front_model->check_project_request_member_notify_clear(); //membership requested notification 
                        $getMeetingInvites_inApp_notify_clear = $this->Front_model->getMeetingInvites_inApp_notify_clear(); //meeting member request notification 
                        $pending_glist_clear = $this->Front_model->PendingGoalList_clear();//pending goal notification
                        $approve_expert_clear = $this->Front_model->getApproveExpertNotify_clear();//Expert call rate notification
                        $file_preview_permission_notify_clear = $this->Front_model->file_preview_permission_notify_clear();//preview permission notification
                        $file_preview_permission_resp_notify_clear = $this->Front_model->file_preview_permission_resp_notify_clear();//preview permission response  notification
                        $check_meeting_invite = "";
                        if($getMeetingInvites_inApp_notify_clear)
                        {
                            foreach($getMeetingInvites_inApp_notify_clear as $mina)
                            {
                              $evt_detail = $this->Front_model->getEventMeetingDetail($mina->event_unique_key);
                              if($evt_detail)
                              {
                                $check_meeting_invite = "yes"; 
                              }
                            }
                        }
                        $notify_cnt = 0;
                        if($task_notification_clear || $OverdueTasks_clear || $OverdueSubtasks_clear || $pending_plist_clear || $check_task_review_sent_clear || $check_task_review_deny_clear || $check_task_review_approve_clear || $get_all_cproject || $get_all_aproject || $get_all_pproject || $get_all_rproject || $subtask_notification_clear || $check_subtask_review_sent_clear || $check_subtask_review_deny_clear || $check_subtask_review_approve_clear || $check_task_arrive_review_clear || $check_subtask_arrive_review_clear || $check_portfolio_accepted_notify_clear || $check_project_accepted_notify_clear || $check_project_invite_accepted_notify_clear || $check_project_request_member_notify_clear || $check_meeting_invite || $pending_glist_clear || $approve_expert_clear || $file_preview_permission_notify_clear || $file_preview_permission_resp_notify_clear)
                        {
                            $cnt1 = 0;
                            $cnt2 = 0;
                            $cnt3 = 0;
                            $cnt4 = 0;
                            $cnt5 = 0;
                            $cnt6 = 0;
                            $cnt7 = 0;
                            $cnt8 = 0;
                            $cnt9 = 0;
                            $cnt10 = 0;
                            $cnt11 = 0;
                            $cnt12 = 0;
                            $cnt13 = 0;
                            $cnt14 = 0;
                            $cnt15 = 0;
                            $cnt16 = 0;
                            $cnt17 = 0;
                            $cnt18 = 0;
                            $cnt19 = 0;
                            $cnt20 = 0;
                            $cnt21 = 0;
                            $cnt22 = 0;
                            $cnt23 = 0;
                            $cnt24 = 0;
                            $cnt25 = 0;
                            $cnt26 = 0;
                            $cnt27 = 0;
                            $cnt28 = 0;
                            $cnt29 = 0;
                            $cnt30 = 0;
                            $cnt31 = 0;
                            $cnt32 = 0;
                            $cnt33 = 0;
                            $cnt34 = 0;
                            if($task_notification_clear)
                            {
                                foreach($task_notification_clear as $tn)
                                {
                                    $cnt1++; 
                                }
                            }
                            if($OverdueTasks_clear)
                            {
                            foreach($OverdueTasks_clear as $otn)
                                {
                                    if($otn->tstatus != 'done')
                                    {
                                    $cnt2++; 
                                    }
                                }
                            }
                            if($pending_plist_clear)
                            {
                                foreach($pending_plist_clear as $ppn)
                                {
                                    $cnt3++;
                                }
                            }
                            if($check_task_review_sent_clear)
                            {
                                foreach($check_task_review_sent_clear as $trsn)
                                {
                                    $cnt4++;
                                }
                            }
                            if($check_task_review_deny_clear)
                            {
                                foreach($check_task_review_deny_clear as $trdn)
                                {
                                    $cnt5++;
                                }
                            }
                            if($check_task_review_approve_clear)
                            {
                                foreach($check_task_review_approve_clear as $tran)
                                {
                                    $cnt6++;
                                }
                            }
                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cproject_files = $this->Front_model->ProjectFile_clear($getcproject->pid);
                                    if($cproject_files)
                                    {
                                    foreach($cproject_files as $cpro_file)
                                    {
                                        if((!empty($cpro_file->pfnotify_clear)) && ($cpro_file->pcreated_by != $this->session->userdata('d168_id')))
                                        {
                                            $c_pfn = explode(',', $cpro_file->pfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pfn))
                                            {
                                                $cnt7++;
                                            } 
                                        }
                                    }
                                    }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $aproject_files = $this->Front_model->ProjectFile_clear($getaproject->pid);
                                    if($aproject_files)
                                    {
                                    foreach($aproject_files as $apro_file)
                                    {
                                        if((!empty($apro_file->pfnotify_clear)) && ($apro_file->pcreated_by != $this->session->userdata('d168_id')))
                                        {
                                            $a_pfn = explode(',', $apro_file->pfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pfn))
                                            {
                                                $cnt8++;
                                            } 
                                        }
                                    }
                                    }
                                }
                            }
                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cpro_task = $this->Front_model->getTasksProject_clear($getcproject->pid);
                                    if($cpro_task)
                                    {
                                    foreach($cpro_task as $c_pt)
                                    {
                                        $c_ptnew = explode(',', $c_pt->tfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_ptnew))
                                            {
                                                $cnt9++;
                                            } 
                                    }
                                    }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $apro_task = $this->Front_model->getTasksProject_clear($getaproject->pid);
                                    if($apro_task)
                                    {
                                    foreach($apro_task as $a_pt)
                                    {
                                        $a_ptnew = explode(',', $a_pt->tfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_ptnew))
                                            {
                                                $cnt10++;
                                            } 
                                    }
                                    }
                                }
                            }
                            if($subtask_notification_clear)
                            {
                                foreach($subtask_notification_clear as $tn)
                                {
                                    $cnt11++; 
                                }
                            }
                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cpro_subtask = $this->Front_model->getSubtasksProject_clear($getcproject->pid);
                                    if($cpro_subtask)
                                    {
                                    foreach($cpro_subtask as $c_pst)
                                    {
                                        $c_pstnew = explode(',', $c_pst->stfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pstnew))
                                            {
                                                $cnt12++;
                                            } 
                                    }
                                    }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $apro_subtask = $this->Front_model->getSubtasksProject_clear($getaproject->pid);
                                    if($apro_subtask)
                                    {
                                    foreach($apro_subtask as $a_pst)
                                    {
                                        $a_pstnew = explode(',', $a_pst->stfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pstnew))
                                            {
                                                $cnt13++;
                                            } 
                                    }
                                    }
                                }
                            }
                            if($check_subtask_review_sent_clear)
                            {
                                foreach($check_subtask_review_sent_clear as $trsn)
                                {
                                    $cnt14++;
                                }
                            }
                            if($check_subtask_review_deny_clear)
                            {
                                foreach($check_subtask_review_deny_clear as $trdn)
                                {
                                    $cnt15++;
                                }
                            }
                            if($check_subtask_review_approve_clear)
                            {
                                foreach($check_subtask_review_approve_clear as $tran)
                                {
                                    $cnt16++;
                                }
                            }
                            if($OverdueSubtasks_clear)
                            {
                            foreach($OverdueSubtasks_clear as $ostn)
                                {
                                    if($ostn->ststatus != 'done')
                                    {
                                    $cnt17++; 
                                    }
                                }
                            }
                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                $check_cpnotify = 'no';
                                    $pcn_pid = $getcproject->pid;
                                    $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                    if($pcn_allAssigneesByPID_clear)
                                    {
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                           $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                           if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                               $check_cpnotify = 'yes';
                                            } 
                                        }
                                    }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                                         $cnt18++;
                                    }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                $check_cpnotify = 'no';
                                    $pcn_pid = $getaproject->pid;
                                    $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                    if($pcn_allAssigneesByPID_clear)
                                    {
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                           $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                           if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $check_cpnotify = 'yes';
                                            } 
                                        }
                                    }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                                        $cnt19++;
                                    }
                                }
                            }
                            if($get_all_pproject)
                            {
                                foreach($get_all_pproject as $getpproject)
                                {
                                $check_cpnotify = 'no';
                                    $pcn_pid = $getpproject->pid;
                                    $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                    if($pcn_allAssigneesByPID_clear)
                                    {
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                           $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                           if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                               $check_cpnotify = 'yes'; 
                                            } 
                                        }
                                    }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                                        $cnt20++;
                                    }
                                }
                            }
                            if($get_all_rproject)
                            {
                                foreach($get_all_rproject as $getrproject)
                                {
                                $check_cpnotify = 'no';
                                    $pcn_pid = $getrproject->pid;
                                    $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                    if($pcn_allAssigneesByPID_clear)
                                    {
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                           $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                           if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $check_cpnotify = 'yes';
                                            } 
                                        }
                                    }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                                        $cnt21++;
                                    }
                                }
                            }
                            if($check_task_arrive_review_clear)
                            {
                                foreach($check_task_arrive_review_clear as $tarn)
                                {
                                    $cnt22++;
                                }
                            }
                            if($check_subtask_arrive_review_clear)
                            {
                                foreach($check_subtask_arrive_review_clear as $starn)
                                {
                                    $cnt23++;
                                }
                            }
                            if($check_portfolio_accepted_notify_clear)
                            {
                                foreach($check_portfolio_accepted_notify_clear as $cpanc)
                                {
                                    $cnt24++;
                                }
                            }
                            if($check_project_accepted_notify_clear)
                            {
                                foreach($check_project_accepted_notify_clear as $cpranc)
                                {
                                    $cnt25++;
                                }
                            }
                            if($check_project_invite_accepted_notify_clear)
                            {
                                foreach($check_project_invite_accepted_notify_clear as $cpiranc)
                                {
                                    $cnt26++;
                                }
                            }
                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cproject_comment = $this->Front_model->ProjectComment_clear($getcproject->pid);
                                    $check_proComment = "";
                                    if($cproject_comment)
                                    {
                                    foreach($cproject_comment as $cpro_comment)
                                    {
                                        if((!empty($cpro_comment->c_notify_clear)) && ($cpro_comment->c_created_by != $this->session->userdata('d168_id')))
                                        {
                                            $c_pcn = explode(',', $cpro_comment->c_notify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pcn))
                                            {
                                                if($check_proComment != $cpro_comment->project_id)
                                                {
                                                $cnt27++;
                                                $check_proComment = $getcproject->pid;
                                                }
                                            } 
                                        }
                                    }                                    
                                    }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $aproject_comment = $this->Front_model->ProjectComment_clear($getaproject->pid);
                                    $check_proComment2 = "";
                                    if($aproject_comment)
                                    {
                                    foreach($aproject_comment as $apro_comment)
                                    {
                                        if((!empty($apro_comment->c_notify_clear)) && ($apro_comment->c_created_by != $this->session->userdata('d168_id')))
                                        {
                                            $a_pcn = explode(',', $apro_comment->c_notify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pcn))
                                            {
                                                if($check_proComment2 != $apro_comment->project_id)
                                                {
                                                $cnt28++;
                                                $check_proComment2 = $getaproject->pid;
                                                }
                                            } 
                                        }
                                    }
                                    }
                                }
                            }
                            if($check_project_request_member_notify_clear)
                            {
                                foreach($check_project_request_member_notify_clear as $cprmnc)
                                {
                                    $cnt29++;
                                }
                            }
                            if($getMeetingInvites_inApp_notify_clear)
                            {
                                foreach($getMeetingInvites_inApp_notify_clear as $mina)
                                {
                                  $evt_detail = $this->Front_model->getEventMeetingDetail($mina->event_unique_key);
                                  if($evt_detail)
                                  {
                                    $cnt30++; 
                                  }
                                }
                            }
                            if($pending_glist_clear)
                            {
                                foreach($pending_glist_clear as $gpn)
                                {
                                    $cnt31++;
                                }
                            }
                            if($approve_expert_clear) 
                            { 
                                foreach($approve_expert_clear as $aec)  
                                { 
                                    $cnt32++; 
                                } 
                            }
                            if($file_preview_permission_notify_clear)
                            {
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
                                  }      
                                }
                              }
                              }
                              if($privilege_only_view == 'no')
                              {
                                foreach($file_preview_permission_notify_clear as $fppnc)
                                {
                                  $getEmailID = $this->Front_model->getStudentById($fppnc->req_by);
                                  $getProject = $this->Front_model->getProjectDetailID($fppnc->pid);
                                  if(($getEmailID) && ($getProject))
                                  {
                                    $cnt33++;
                                  }
                                }
                              }                                
                            }                            
                            if($file_preview_permission_resp_notify_clear)
                            {
                              foreach($file_preview_permission_resp_notify_clear as $fpprnc)
                              {
                                $getProject = $this->Front_model->getProjectDetailID($fpprnc->pid);
                                if($getProject)
                                {
                                  $checkif_pmem_ex = $this->Front_model->check_pro_member_exists($fpprnc->pid,$this->session->userdata('d168_id'));
                                  if($checkif_pmem_ex)
                                  {
                                    if($checkif_pmem_ex->status == 'accepted')
                                    {
                                      $cnt34++;
                                    }                                    
                                  }                                  
                                }
                              }                               
                            }
                        $notify_cnt = $cnt1 + $cnt2 + $cnt3 + $cnt4 + $cnt5 + $cnt6 + $cnt7 + $cnt8 + $cnt9 + $cnt10 + $cnt11 + $cnt12 + $cnt13 + $cnt14 + $cnt15 + $cnt16 + $cnt17 + $cnt18 + $cnt19 + $cnt20 + $cnt21 + $cnt22 + $cnt23 + $cnt24 + $cnt25 + $cnt26 + $cnt27 + $cnt28 + $cnt29 + $cnt30 + $cnt31  + $cnt32 + $cnt33 + $cnt34;
                            if($notify_cnt != 0)
                            {
                    ?>
                    <i class="bx bx-bell bx-tada"></i>
                    <input type="hidden" name="get_notify_cnt_val" id="get_notify_cnt_val" value="<?php echo $notify_cnt;?>">
                    <span class="badge bg-danger rounded-pill" id="notify_cnt_val"><?php echo $notify_cnt;?></span>
                    <?php
                            }
                            else
                            {
                    ?>
                    <i class="bx bx-bell"></i>
                    <?php  
                            }
                        }
                        else
                        {
                    ?>
                    <i class="bx bx-bell"></i>
                    <?php
                        }
                    ?>                    
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown" id="fix_notification_box">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"><b>Notifications</b></h6>
                            </div>
                            <?php
                            if($notify_cnt != 0)
                            {
                            ?>
                            <div class="col-auto">
                                <a href="javascript: void(0);" key="t-view-all" style="color: #c7df19 !important;" onclick="return AllNotificationClearYes();"> Clear All </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 450px;">
                        <div id="new_notify_top_div">
                        <?php
                        if($task_notification_clear)
                        {
                            foreach($task_notification_clear as $tn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tn->tnotify_date;?>" id="tncy<?php echo $tn->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            T
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $tn->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $tn->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $tn->tname;?></p>
                                            <p class="mb-1"><?php echo $tn->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($tn->tnotify_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskNotificationClearYes(<?php echo $tn->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($subtask_notification_clear)
                        {
                            foreach($subtask_notification_clear as $stn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $stn->stnotify_date;?>" id="stncy<?php echo $stn->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            ST
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $stn->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $stn->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $stn->stname;?></p>
                                            <p class="mb-1"><?php echo $stn->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($stn->stnotify_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskNotificationClearYes(<?php echo $stn->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cproject_files = $this->Front_model->ProjectFile_clear($getcproject->pid);
                                    if($cproject_files)
                                    {
                                    foreach($cproject_files as $cpro_file)
                                    {
                                        if((!empty($cpro_file->pfnotify_clear)) && ($cpro_file->pcreated_by != $this->session->userdata('d168_id')))
                                        {
                                            $c_pfn = explode(',', $cpro_file->pfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pfn))
                                            {
                                        ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $cpro_file->pfnotify_date;?>" id="pfncy<?php echo $cpro_file->pfile_id;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           PF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return ProjectOverviewFileNotificationModal(<?php echo $getcproject->pid;?>,<?php echo $cpro_file->pfile_id;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php $cpro_filename = substr(trim($cpro_file->pfile), strpos(trim($cpro_file->pfile), '_') + 1); echo substr($cpro_filename,0,30).'...';?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $getcproject->pname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cpro_file->pfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectFileNotificationClearYes(<?php echo $cpro_file->pfile_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            }
                                        }
                                    }
                                }
                                }   
                            }

                        if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $aproject_files = $this->Front_model->ProjectFile_clear($getaproject->pid);
                                    if($aproject_files)
                                    {
                                    foreach($aproject_files as $apro_file)
                                    {
                                        if((!empty($apro_file->pfnotify_clear)) && ($apro_file->pcreated_by != $this->session->userdata('d168_id')))
                                        {
                                            $a_pfn = explode(',', $apro_file->pfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pfn))
                                            {
                                        ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $apro_file->pfnotify_date;?>" id="pfncy<?php echo $apro_file->pfile_id;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           PF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return ProjectOverviewFileNotificationModal(<?php echo $getaproject->pid;?>,<?php echo $apro_file->pfile_id;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php $apro_filename = substr(trim($apro_file->pfile), strpos(trim($apro_file->pfile), '_') + 1); echo substr($apro_filename,0,30).'...';?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $getaproject->pname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($apro_file->pfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectFileNotificationClearYes(<?php echo $apro_file->pfile_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            }
                                        }
                                    }
                                }
                                }
                            }

                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cpro_task = $this->Front_model->getTasksProject_clear($getcproject->pid);
                                    if($cpro_task)
                                    {
                                    foreach($cpro_task as $c_pt)
                                    {
                                        $c_ptnew = explode(',', $c_pt->tfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_ptnew))
                                            {
                                             ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $c_pt->tfnotify_date;?>" id="tfncy<?php echo $c_pt->tid;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           TF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return TaskFileNotificationModal(<?php echo $c_pt->tid;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                        $all_new_tfile = explode(',', $c_pt->new_file);
                                                        $count_new_tfile = count($all_new_tfile);
                                                        for ($it=0; $it<$count_new_tfile; $it++)
                                                        {
                                                            $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                            echo substr($tnew_file,0,30).'...';
                                                            echo "<br>";
                                                        }?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $c_pt->tcode;?></p>
                                                            <p class="mb-1"><?php echo $c_pt->tname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($c_pt->tfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskFileNotificationClearYes(<?php echo $c_pt->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            } 
                                    }
                                }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $apro_task = $this->Front_model->getTasksProject_clear($getaproject->pid);
                                    if($apro_task)
                                    {
                                    foreach($apro_task as $a_pt)
                                    {
                                        $a_ptnew = explode(',', $a_pt->tfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_ptnew))
                                            {
                                            ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $a_pt->tfnotify_date;?>" id="tfncy<?php echo $a_pt->tid;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           TF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return TaskFileNotificationModal(<?php echo $a_pt->tid;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                        $all_new_tfile = explode(',', $a_pt->new_file);
                                                        $count_new_tfile = count($all_new_tfile);
                                                        for ($it=0; $it<$count_new_tfile; $it++)
                                                        {
                                                            $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                            echo substr($tnew_file,0,30).'...';
                                                            echo "<br>";
                                                        }?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $a_pt->tcode;?></p>
                                                            <p class="mb-1"><?php echo $a_pt->tname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($a_pt->tfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskFileNotificationClearYes(<?php echo $a_pt->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            } 
                                    }
                                }
                                }
                            }

                            if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cpro_subtask = $this->Front_model->getSubtasksProject_clear($getcproject->pid);
                                    if($cpro_subtask)
                                    {
                                    foreach($cpro_subtask as $c_pst)
                                    {
                                        $c_pstnew = explode(',', $c_pst->stfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pstnew))
                                            {
                                             ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $c_pst->stfnotify_date;?>" id="stfncy<?php echo $c_pst->stid;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           SF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return SubtaskFileNotificationModal(<?php echo $c_pst->stid;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                        $all_new_tfile = explode(',', $c_pst->snew_file);
                                                        $count_new_tfile = count($all_new_tfile);
                                                        for ($it=0; $it<$count_new_tfile; $it++)
                                                        {
                                                            $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                            echo substr($tnew_file,0,30).'...';
                                                            echo "<br>";
                                                        }?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $c_pst->stcode;?></p>
                                                            <p class="mb-1"><?php echo $c_pst->stname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($c_pst->stfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskFileNotificationClearYes(<?php echo $c_pst->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            } 
                                    }
                                }
                                }   
                            }
                            if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $apro_subtask = $this->Front_model->getSubtasksProject_clear($getaproject->pid);
                                    if($apro_subtask)
                                    {
                                    foreach($apro_subtask as $a_pst)
                                    {
                                        $a_pstnew = explode(',', $a_pst->stfnotify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pstnew))
                                            {
                                            ?>
                                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $a_pst->stfnotify_date;?>" id="stfncy<?php echo $a_pst->stid;?>">
                                            <div class="text-reset notification-item border-top">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           SF
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted" onclick="return SubtaskFileNotificationModal(<?php echo $a_pst->stid;?>)">
                                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php 
                                                        $all_new_tfile = explode(',', $a_pst->snew_file);
                                                        $count_new_tfile = count($all_new_tfile);
                                                        for ($it=0; $it<$count_new_tfile; $it++)
                                                        {
                                                            $tnew_file = substr(trim($all_new_tfile[$it]), strpos(trim($all_new_tfile[$it]), '_') + 1); 
                                                            echo substr($tnew_file,0,30).'...';
                                                            echo "<br>";
                                                        }?></h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $a_pst->stcode;?></p>
                                                            <p class="mb-1"><?php echo $a_pst->stname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($a_pst->stfnotify_date));?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskFileNotificationClearYes(<?php echo $a_pst->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                            } 
                                    }
                                }
                                }
                            }

                        if($check_task_review_sent_clear)
                        {
                            foreach($check_task_review_sent_clear as $trsn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $trsn->review_notdate;?>" id="trncy<?php echo $trsn->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RT
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $trsn->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $trsn->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $trsn->tname;?></p>
                                            <p class="mb-1">Task sent for Review!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($trsn->review_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskReviewNotificationClearYes(<?php echo $trsn->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_task_review_deny_clear)
                        {
                            foreach($check_task_review_deny_clear as $trdn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $trdn->review_notdate;?>" id="trncy<?php echo $trdn->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                            DT
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $trdn->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $trdn->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $trdn->tname;?></p>
                                            <p class="mb-1">Review and Denied! Do it Again!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($trdn->review_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskReviewNotificationClearYes(<?php echo $trdn->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_task_review_approve_clear)
                        {
                            foreach($check_task_review_approve_clear as $tran)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tran->review_notdate;?>" id="trncy<?php echo $tran->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RT
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $tran->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $tran->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $tran->tname;?></p>
                                            <p class="mb-1">Review and Approved!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($tran->review_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskReviewNotificationClearYes(<?php echo $tran->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_subtask_review_sent_clear)
                        {
                            foreach($check_subtask_review_sent_clear as $trsn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $trsn->sreview_notdate;?>" id="strncy<?php echo $trsn->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RS
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $trsn->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $trsn->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $trsn->stname;?></p>
                                            <p class="mb-1">Subtask sent for Review!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($trsn->sreview_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskReviewNotificationClearYes(<?php echo $trsn->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_subtask_review_deny_clear)
                        {
                            foreach($check_subtask_review_deny_clear as $trdn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $trdn->sreview_notdate;?>" id="strncy<?php echo $trdn->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                            DS
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $trdn->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $trdn->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $trdn->stname;?></p>
                                            <p class="mb-1">Review and Denied! Do it Again!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($trdn->sreview_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskReviewNotificationClearYes(<?php echo $trdn->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_subtask_review_approve_clear)
                        {
                            foreach($check_subtask_review_approve_clear as $tran)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tran->sreview_notdate;?>" id="strncy<?php echo $tran->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RS
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $tran->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $tran->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $tran->stname;?></p>
                                            <p class="mb-1">Review and Approved!</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($tran->sreview_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskReviewNotificationClearYes(<?php echo $tran->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($pending_plist_clear)
                        {
                            foreach($pending_plist_clear as $ppn)
                            {
                                if($ppn->portfolio_id != 0)
                                    {
                                        $portfolio = $this->Front_model->getPortfolio2($ppn->portfolio_id);
                                        $port_name = $portfolio->portfolio_name;
                                    } 
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $ppn->sent_date;?>" id="pqncy<?php echo $ppn->pid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            P
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return ProjectOverviewRequestNotificationModal(<?php echo $ppn->pid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $ppn->pname;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php if(!empty($port_name)){echo $port_name;}?></p>
                                            <p class="mb-1"><?php 
                                            if($ppn->ptype == "content")
                                            {
                                                echo 'Type : Content';
                                            }
                                            else
                                            {
                                                echo 'Type : Project';
                                            }?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($ppn->sent_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PendingRequestNotificationClearYes(<?php echo $ppn->pid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($OverdueTasks_clear)
                        {
                            foreach($OverdueTasks_clear as $otn)
                            {
                                if($otn->tstatus != 'done')
                                {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $otn->tdue_date;?>" id="otncy<?php echo $otn->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                            OT
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $otn->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $otn->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $otn->tname;?></p>
                                            <p class="mb-1"><?php
                                            if($otn->tproject_assign != 0) 
                                            {
                                                $otn_pname = $this->Front_model->check_project_dates($otn->tproject_assign);
                                                if($otn_pname)
                                                {
                                                    echo $otn_pname->pname;
                                                }
                                            }
                                            ?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($otn->tdue_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return OverdueTaskNotificationClearYes(<?php echo $otn->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                }
                            }
                        }
                        if($OverdueSubtasks_clear)
                        {
                            foreach($OverdueSubtasks_clear as $ostn)
                            {
                                if($ostn->ststatus != 'done')
                                {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $ostn->stdue_date;?>" id="ostncy<?php echo $ostn->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-d text-white rounded-circle font-size-16">
                                            OS
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $ostn->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $ostn->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $ostn->stname;?></p>
                                            <p class="mb-1"><?php
                                            if($ostn->stproject_assign != 0) 
                                            {
                                                $otn_pname = $this->Front_model->check_project_dates($ostn->stproject_assign);
                                                if($otn_pname)
                                                {
                                                    echo $otn_pname->pname;
                                                }
                                            }
                                            ?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($ostn->stdue_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return OverdueSubtaskNotificationClearYes(<?php echo $ostn->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                }
                            }
                        }
                        if($get_all_cproject)
                        {
                            foreach($get_all_cproject as $pcn_pro)
                            {
                                $pcn_pid = $pcn_pro->pid;
                                $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                if($pcn_allAssigneesByPID_clear)
                                {
                                    $check_cpnotify = 'no';
                                    $get_pcn_pc_code = array();
                                    $get_pcn_platform = array();
                                    $get_pcn_notify_date = array();
                                    $new_pcn_notify = $pcn_pro->pcreated_date;
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                            if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                $get_pcn_pc_code[] = $pcn->pc_code;
                                                $get_pcn_platform[] = $pcn->platform;
                                                $check_cpnotify = 'yes';
                                            }
                                        }
                                    }
                                    if(!empty($get_pcn_notify_date))
                                    {
                                        $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                        $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                        if(!empty($pcn_notify_date[0]))
                                        {
                                          $new_pcn_notify = $pcn_notify_date[0];  
                                        }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $new_pcn_notify;?>" id="pcncy<?php echo $pcn_pro->pid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            CP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer">
                                            <?php
                                            if(!empty($get_pcn_platform))
                                            {
                                                $new_pcn_platform = implode(',', $get_pcn_platform);
                                                $pcn_platform = explode(',', $new_pcn_platform);
                                                $pcn_platform_cnt = count($pcn_platform);
                                                if($pcn_platform_cnt > 0)
                                                {
                                                    for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                    {
                                                       if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> 
                                                          <?php
                                                          }
                                                    }
                                                }
                                            }
                                            ?>                                                    
                                            </p>
                                            <p class="mb-1"><?php echo $pcn_pro->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PlannedContentNotificationClearYes(<?php echo $pcn_pro->pid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                            }
                                }
                            }
                        }
                        if($get_all_aproject)
                        {
                            foreach($get_all_aproject as $pcn_pro)
                            {
                                $pcn_pid = $pcn_pro->pid;
                                $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                if($pcn_allAssigneesByPID_clear)
                                {
                                    $check_cpnotify = 'no';
                                    $get_pcn_pc_code = array();
                                    $get_pcn_platform = array();
                                    $get_pcn_notify_date = array();
                                    $new_pcn_notify = $pcn_pro->pcreated_date;
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                            if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                $get_pcn_pc_code[] = $pcn->pc_code;
                                                $get_pcn_platform[] = $pcn->platform;
                                                $check_cpnotify = 'yes';
                                            }
                                        }
                                    }
                                    if(!empty($get_pcn_notify_date))
                                    {
                                        $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                        $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                        if(!empty($pcn_notify_date[0]))
                                        {
                                          $new_pcn_notify = $pcn_notify_date[0];  
                                        }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $new_pcn_notify;?>" id="pcncy<?php echo $pcn_pro->pid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            CP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer">
                                            <?php
                                            if(!empty($get_pcn_platform))
                                            {
                                                $new_pcn_platform = implode(',', $get_pcn_platform);
                                                $pcn_platform = explode(',', $new_pcn_platform);
                                                $pcn_platform_cnt = count($pcn_platform);
                                                if($pcn_platform_cnt > 0)
                                                {
                                                    for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                    { 
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> 
                                                          <?php
                                                          }
                                                    }
                                                }
                                            }
                                            ?>                                                    
                                            </p>
                                            <p class="mb-1"><?php echo $pcn_pro->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PlannedContentNotificationClearYes(<?php echo $pcn_pro->pid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                                }
                                }
                            }
                        }
                        if($get_all_pproject)
                        {
                            foreach($get_all_pproject as $pcn_pro)
                            {
                                $pcn_pid = $pcn_pro->pid;
                                $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                if($pcn_allAssigneesByPID_clear)
                                {
                                    $check_cpnotify = 'no';
                                    $get_pcn_pc_code = array();
                                    $get_pcn_platform = array();
                                    $get_pcn_notify_date = array();
                                    $new_pcn_notify = $pcn_pro->pcreated_date;
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                            if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                $get_pcn_pc_code[] = $pcn->pc_code;
                                                $get_pcn_platform[] = $pcn->platform;
                                                $check_cpnotify = 'yes';
                                            }
                                        }
                                    }
                                    if(!empty($get_pcn_notify_date))
                                    {
                                        $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                        $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                        if(!empty($pcn_notify_date[0]))
                                        {
                                          $new_pcn_notify = $pcn_notify_date[0];  
                                        }
                                    }
                                    if($check_cpnotify == 'yes')
                                    {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $new_pcn_notify;?>" id="pcncy<?php echo $pcn_pro->pid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            CP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer">
                                            <?php
                                            if(!empty($get_pcn_platform))
                                            {
                                                $new_pcn_platform = implode(',', $get_pcn_platform);
                                                $pcn_platform = explode(',', $new_pcn_platform);
                                                $pcn_platform_cnt = count($pcn_platform);
                                                if($pcn_platform_cnt > 0)
                                                {
                                                    for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                    { 
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> 
                                                          <?php
                                                          }
                                                    }
                                                }
                                            }
                                            ?>                                                    
                                            </p>
                                            <p class="mb-1"><?php echo $pcn_pro->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PlannedContentNotificationClearYes(<?php echo $pcn_pro->pid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                                    }
                                }
                            }
                        }
                        if($get_all_rproject)
                        {
                            foreach($get_all_rproject as $pcn_pro)
                            {
                                $pcn_pid = $pcn_pro->pid;
                                $pcn_allAssigneesByPID_clear = $this->Front_model->pcn_allAssigneesByPID_clear($pcn_pid);
                                if($pcn_allAssigneesByPID_clear)
                                {
                                    $check_cpnotify = 'no';
                                    $get_pcn_pc_code = array();
                                    $get_pcn_platform = array();
                                    $get_pcn_notify_date = array();
                                    $new_pcn_notify = $pcn_pro->pcreated_date;
                                    foreach($pcn_allAssigneesByPID_clear as $pcn)
                                    {
                                        $pcn_assignee = explode(',', $pcn->pc_notify_clear);
                                        if((!empty($pcn->pc_notify_clear)) && ($pcn->pc_created_by != $this->session->userdata('d168_id')))
                                        {
                                            if(in_array($this->session->userdata('d168_id'), $pcn_assignee))
                                            {
                                                $get_pcn_notify_date[] = $pcn->pc_notify_date;
                                                $get_pcn_pc_code[] = $pcn->pc_code;
                                                $get_pcn_platform[] = $pcn->platform;
                                                $check_cpnotify = 'yes';
                                            }
                                        }
                                    }
                                    if(!empty($get_pcn_notify_date))
                                    {
                                        $new_pcn_notify_date = implode(',', $get_pcn_notify_date);
                                        $pcn_notify_date = explode(',', $new_pcn_notify_date);
                                        if(!empty($pcn_notify_date[0]))
                                        {
                                          $new_pcn_notify = $pcn_notify_date[0];  
                                        }
                                    }
                                    if($check_cpnotify = 'yes')
                                    {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $new_pcn_notify;?>" id="pcncy<?php echo $pcn_pro->pid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            CP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return PlannedContentNotificationModal(<?php echo $pcn_pro->pid;?>)">
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer">
                                            <?php
                                            if(!empty($get_pcn_platform))
                                            {
                                                $new_pcn_platform = implode(',', $get_pcn_platform);
                                                $pcn_platform = explode(',', $new_pcn_platform);
                                                $pcn_platform_cnt = count($pcn_platform);
                                                if($pcn_platform_cnt > 0)
                                                {
                                                    for ($pcn_j=0; $pcn_j<$pcn_platform_cnt; $pcn_j++)
                                                    { 
                                                        if($pcn_platform[$pcn_j] == 'twitter')
                                                          {
                                                          ?>
                                                          <i class="fab fa-twitter me-1 font-size-20" title="Twitter"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'facebook')
                                                          { 
                                                          ?>                 
                                                          <i class="fab fa-facebook me-1 font-size-20" title="Facebook"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'instagram')
                                                          {
                                                          ?>
                                                          <i class="fab fa-instagram me-1 font-size-20" title="Instagram"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'linkedin')
                                                          {
                                                          ?>
                                                          <i class="fab fa-linkedin me-1 font-size-20" title="LinkedIn"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'google-my-business')
                                                          {
                                                          ?>
                                                          <i class="mdi mdi-google-my-business me-1 font-size-20" title="Google My Business"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'pinterest')
                                                          {
                                                          ?>
                                                          <i class="fab fa-pinterest me-1 font-size-20" title="Pinterest"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'youtube')
                                                          {
                                                          ?>
                                                          <i class="fab fa-youtube me-1 font-size-20" title="YouTube"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'blogger')
                                                          {
                                                          ?>
                                                          <i class="fab fa-blogger me-1 font-size-20" title="Blog"></i>
                                                          <?php
                                                          }
                                                          elseif($pcn_platform[$pcn_j] == 'tiktok')
                                                          {
                                                          ?>
                                                          <i class="fab fa-tiktok me-1 font-size-20" title="TikTok"></i> 
                                                          <?php
                                                          }
                                                    }
                                                }
                                            }
                                            ?>                                                    
                                            </p>
                                            <p class="mb-1"><?php echo $pcn_pro->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($new_pcn_notify));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PlannedContentNotificationClearYes(<?php echo $pcn_pro->pid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                                    }
                                }
                            }
                        }
                        if($check_task_arrive_review_clear)
                        {
                            foreach($check_task_arrive_review_clear as $tarn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tarn->review_notdate;?>" id="tarncy<?php echo $tarn->tid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RT
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return TaskOverviewNotificationModal(<?php echo $tarn->tid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $tarn->tcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $tarn->tname;?></p>
                                            <p class="mb-1"><?php echo $tarn->pname;?> (Task Arrive for Review)</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($tarn->review_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return TaskArriveReviewNotificationClearYes(<?php echo $tarn->tid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }
                        if($check_subtask_arrive_review_clear)
                        {
                            foreach($check_subtask_arrive_review_clear as $starn)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $starn->sreview_notdate;?>" id="starncy<?php echo $starn->stid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            RS
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return SubtaskOverviewNotificationModal(<?php echo $starn->stid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark"><?php echo $starn->stcode;?></span></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $starn->stname;?></p>
                                            <p class="mb-1"><?php echo $starn->pname;?> (Subtask Arrive for Review)</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($starn->sreview_notdate));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return SubtaskArriveReviewNotificationClearYes(<?php echo $starn->stid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }
                        if($check_portfolio_accepted_notify_clear)
                        {
                            foreach($check_portfolio_accepted_notify_clear as $cpanc)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $cpanc->status_date;?>" id="cpancy<?php echo $cpanc->pim_id;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            AP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return PortfolioAcceptedReqNotificationModal(<?php echo $cpanc->pim_id;?>,<?php echo $cpanc->portfolio_id;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $cpanc->sent_to;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php if($cpanc->portfolio_user == 'company'){ echo $cpanc->portfolio_name;}elseif($cpanc->portfolio_user == 'individual'){ echo $cpanc->portfolio_name.' '.$cpanc->portfolio_lname;}else{ echo $cpanc->portfolio_name;}?></p>
                                            <p class="mb-1">Portfolio Accepted Request</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cpanc->status_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return PortfolioAcceptedReqClearYes(<?php echo $cpanc->pim_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_project_accepted_notify_clear)
                        {
                            foreach($check_project_accepted_notify_clear as $cpranc)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $cpranc->status_date;?>" id="cprancy<?php echo $cpranc->pm_id;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            AP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return ProjectAcceptedReqNotificationModal(<?php echo $cpranc->pm_id;?>,<?php echo $cpranc->pid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php $reg_name = $this->Front_model->getStudentById($cpranc->pmember);
                                        if($reg_name)
                                            {
                                                echo $reg_name->first_name." ".$reg_name->last_name;
                                            }?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $cpranc->pname;?></p>
                                            <p class="mb-1">Project Request Accepted</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cpranc->status_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectAcceptedReqClearYes(<?php echo $cpranc->pm_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($check_project_invite_accepted_notify_clear)
                        {
                            foreach($check_project_invite_accepted_notify_clear as $cpiranc)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $cpiranc->accept_date;?>" id="cpirancy<?php echo $cpiranc->im_id;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            AP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return ProjectAcceptedInviteReqNotificationModal(<?php echo $cpiranc->im_id;?>,<?php echo $cpiranc->pid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $cpiranc->sent_to;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $cpiranc->pname;?></p>
                                            <p class="mb-1">Project Request Accepted</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cpiranc->accept_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectAcceptedInviteReqClearYes(<?php echo $cpiranc->im_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }
                        if($get_all_cproject)
                            {
                                foreach($get_all_cproject as $getcproject)
                                {
                                    $cproject_comment = $this->Front_model->ProjectComment_clear($getcproject->pid);
                                    $check_proComment = "";
                                    if($cproject_comment)
                                    {
                                    foreach($cproject_comment as $cpro_comment)
                                    {
                                        if((!empty($cpro_comment->c_notify_clear)) && ($cpro_comment->c_created_by != $this->session->userdata('d168_id')))
                                        {
                                            $c_pcn = explode(',', $cpro_comment->c_notify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $c_pcn))
                                            {
                                                if($check_proComment != $cpro_comment->project_id)
                                                {
                                        ?>
                                        <a href="javascript: void(0);" class="new_notify_top pconcy<?php echo $cpro_comment->project_id;?>" data-topdate="<?php echo $cpro_comment->c_created_date;?>" >
                                            <div class="text-reset notification-item border-top pconcy<?php echo $cpro_comment->project_id;?>">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           PC
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted">
                                                        <a href="<?php echo base_url('projects-overview'.'/'.$getcproject->pid)?>">
                                                        <h6 class="mt-0 mb-1" key="t-your-order">Comment Added, Click to check!</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $getcproject->pname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cpro_comment->c_created_date));?></span></p>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectCommentNotificationClearYes(<?php echo $cpro_comment->project_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                                $check_proComment = $getcproject->pid;
                                                }
                                            }
                                        }
                                    }
                                }
                                }   
                            }

                        if($get_all_aproject)
                            {
                                foreach($get_all_aproject as $getaproject)
                                {
                                    $aproject_comment = $this->Front_model->ProjectComment_clear($getaproject->pid);
                                    $check_proComment2 = "";
                                    if($aproject_comment)
                                    {
                                    foreach($aproject_comment as $apro_comment)
                                    {
                                        if((!empty($apro_comment->c_notify_clear)) && ($apro_comment->c_created_by != $this->session->userdata('d168_id')))
                                        {
                                            $a_pcn = explode(',', $apro_comment->c_notify_clear);
                                            if(in_array($this->session->userdata('d168_id'), $a_pcn))
                                            {
                                                if($check_proComment2 != $apro_comment->project_id)
                                                {
                                        ?>
                                        <a href="javascript: void(0);" class="new_notify_top pconcy<?php echo $apro_comment->project_id;?>" data-topdate="<?php echo $apro_comment->c_created_date;?>" >
                                            <div class="text-reset notification-item border-top pconcy<?php echo $apro_comment->project_id;?>">
                                                <div class="media">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                           PC
                                                        </span>
                                                    </div>
                                                    <div class="media-body me-3 text-muted">
                                                        <a href="<?php echo base_url('projects-overview-accepted'.'/'.$getaproject->pid)?>">
                                                        <h6 class="mt-0 mb-1" key="t-your-order">Comment Added, Click to check!</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1"><?php echo $getaproject->pname;?></p>
                                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($apro_comment->c_created_date));?></span></p>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="float-end" style="padding-right: 10px;">
                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return ProjectCommentNotificationClearYes(<?php echo $apro_comment->project_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                                            <span class="avatar-title bg-transparent text-reset">
                                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                                $check_proComment2 = $getaproject->pid;
                                                }
                                            }
                                        }
                                    }
                                }
                                }
                            }

                        if($check_project_request_member_notify_clear)
                        {
                            foreach($check_project_request_member_notify_clear as $cprmnc)
                            {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $cprmnc->date;?>" id="cprmncy<?php echo $cprmnc->req_id;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            MR
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return MembershipReqNotificationModal(<?php echo $cprmnc->req_id;?>,<?php echo $cprmnc->pid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $cprmnc->first_name.' '.$cprmnc->last_name;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php echo $cprmnc->pname;?></p>
                                            <p class="mb-1">Project Membership Request</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($cprmnc->date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return MembershipReqClearYes(<?php echo $cprmnc->req_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($getMeetingInvites_inApp_notify_clear)
                        {
                            foreach($getMeetingInvites_inApp_notify_clear as $mina)
                            {
                              $evt_detail = $this->Front_model->getEventMeetingDetail($mina->event_unique_key);
                              $mina_date = date('Y-m-d',strtotime($mina->status_date));
                              if($evt_detail)
                              {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $mina_date;?>" id="minac<?php echo $mina->event_unique_key;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            MR
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return MeetingMemberNotificationModal('<?php echo $mina->event_unique_key;?>')">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $evt_detail->event_name;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <!-- <p class="mb-1" key="t-grammer"><?php echo $evt_detail->meeting_agenda;?></p> -->
                                            <p class="mb-1">Meeting Member Request</p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($mina_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return MeetingMemberReqClearYes('<?php echo $mina->event_unique_key;?>');" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                              }
                            }
                        }

                        if($pending_glist_clear)
                        {
                            foreach($pending_glist_clear as $gpn)
                            {
                                if($gpn->portfolio_id != 0)
                                    {
                                        $portfolio = $this->Front_model->getPortfolio2($gpn->portfolio_id);
                                        $port_name = $portfolio->portfolio_name;
                                    }
                                    $gpn_date = date('Y-m-d',strtotime($gpn->sent_date)); 
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $gpn_date;?>" id="gqncy<?php echo $gpn->gid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            G
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return GoalOverviewRequestNotificationModal(<?php echo $gpn->gid;?>)">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo $gpn->gname;?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer"><?php if(!empty($port_name)){echo $port_name;}?></p>
                                            <p class="mb-1"><?php echo 'Type : Goals & Strategies';?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo date('Y-m-d',strtotime($gpn_date));?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return GoalPendingRequestNotificationClearYes(<?php echo $gpn->gid;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        }

                        if($approve_expert_clear) 
                        { 
                            foreach($approve_expert_clear as $aec)  
                            { 
                              $aec_date = date('Y-m-d',strtotime($aec->expert_approved_date));  
                        ?>  
                        <a href="<?php echo base_url('profile'); ?>" class="new_notify_top" data-topdate="<?php echo $aec_date;?>" id="aecy<?php echo $aec->reg_id;?>"> 
                            <div class="text-reset notification-item border-top"> 
                                <div class="media"> 
                                    <div class="avatar-xs me-3">  
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">  
                                            EA  
                                        </span> 
                                    </div>  
                                    <div class="media-body me-3"> 
                                        <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark">Approved as Decision Maker</span></h6> 
                                        <div class="font-size-12 text-muted"> 
                                            <p class="mb-1">Update your call rate</p> 
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo $aec_date; ?></span></p>  
                                        </div>  
                                    </div>  
                                    <div class="float-end" style="padding-right: 10px;">  
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return expertApproveNotificationClearYes(<?php echo $aec->reg_id;?>);" title="Remove" style="height: 1.6rem;width: 1.6rem;">  
                                            <span class="avatar-title bg-transparent text-reset"> 
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>  
                                            </span> 
                                        </button> 
                                    </div>  
                                </div>  
                            </div>  
                        </a>  
                        <?php 
                            }
                        }

                        if($file_preview_permission_notify_clear)
                        {
                          if($privilege_only_view == 'no')
                          {
                            foreach($file_preview_permission_notify_clear as $fppnc)
                            {
                              $getEmailID = $this->Front_model->getStudentById($fppnc->req_by);
                              $getProject = $this->Front_model->getProjectDetailID($fppnc->pid);
                              if(($getEmailID) && ($getProject))
                              {
                        ?>
                        <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $fppnc->req_date;?>" id="fppnc<?php echo $fppnc->fpid;?>">
                            <div class="text-reset notification-item border-top">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                            FP
                                        </span>
                                    </div>
                                    <div class="media-body me-3" onclick="return FilePreviewPermissionNotificationModal('<?php echo $fppnc->fpid;?>')">
                                        <h6 class="mt-0 mb-1" key="t-your-order"><?php echo ucfirst($getEmailID->first_name).' '.ucfirst($getEmailID->last_name).' has requested to preview files';?></h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1"><?php echo $getProject->pname;?></p>
                                            <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo $fppnc->req_date;?></span></p>
                                        </div>
                                    </div>
                                    <div class="float-end" style="padding-right: 10px;">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return FilePreviewPermissionReqClearYes('<?php echo $fppnc->fpid;?>');" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                            <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                              }
                            }
                          }
                        }

                        if($file_preview_permission_resp_notify_clear)
                        {
                          foreach($file_preview_permission_resp_notify_clear as $fpprnc)
                          {
                            $getProject = $this->Front_model->getProjectDetailID($fpprnc->pid);
                            if($getProject)
                            {
                              $checkif_pmem_ex = $this->Front_model->check_pro_member_exists($fpprnc->pid,$this->session->userdata('d168_id'));
                                if($checkif_pmem_ex)
                                {
                                  if($checkif_pmem_ex->status == 'accepted')
                                  {

                      ?>
                      <a href="javascript: void(0);" class="new_notify_top fpprncc<?php echo $fpprnc->fpid;?>" data-topdate="<?php echo $fpprnc->res_date;?>" id="fpprnc<?php echo $fpprnc->fpid;?>">
                          <div class="text-reset notification-item border-top">
                              <div class="media fpprncc<?php echo $fpprnc->fpid;?>">
                                  <div class="avatar-xs me-3">
                                      <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                          FP
                                      </span>
                                  </div>
                                  <div class="media-body me-3">
                                      <a href="<?php echo base_url('projects-overview-accepted'.'/'.$fpprnc->pid)?>">
                                      <h6 class="mt-0 mb-1" key="t-your-order"><?php echo 'File preview permission '.$fpprnc->req_status.'!';?></h6>
                                      <div class="font-size-12 text-muted">
                                          <p class="mb-1"><?php echo $fpprnc->pname;?></p>
                                          <p class="mb-0"><i class="mdi mdi-calendar-outline"></i> <span key="t-min-ago"><?php echo $fpprnc->req_date;?></span></p>
                                      </div>
                                      </a>
                                  </div>
                                  <div class="float-end" style="padding-right: 10px;">
                                      <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" onclick="return FilePreviewPermissionRespClearYes('<?php echo $fpprnc->fpid;?>');" title="Remove" style="height: 1.6rem;width: 1.6rem;">
                                          <span class="avatar-title bg-transparent text-reset">
                                              <i class="bx bx-x" style="font-size: 1.2rem;"></i>
                                          </span>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </a>
                      <?php
                                  }
                              }
                            }
                          }
                        }
                        ?>
                        </div>                         
                    </div>
                </div>
            </div>
           <!--  <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-note-text-outline"></i>
                </button>
            </div> -->
            <?php
            if(($this->session->userdata('d168_id')) || ($this->session->userdata('d168_id') != ""))
            {
              $student_id = $this->session->userdata('d168_id');
              $d168_del = $this->Front_model->getStudentById($student_id);
            }
            ?>
            <div class="dropdown d-inline-block" id="tour_logout_menu">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                if(!empty($d168_del->photo)){
                    ?>
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url('assets/student_photos/'.$d168_del->photo);?>" alt="<?php echo $d168_del->first_name;?>">
                    <?php
                }else{
                    $fullname = $d168_del->first_name.' '.$d168_del->last_name;
                    $student_name = explode(" ", $fullname);
                    $profile_name = "";

                    foreach ($student_name as $sn) {
                      $profile_name .= $sn[0];
                    }
                    ?>
                    <span class="rounded-circle header-profile-user"><?php echo strtoupper($profile_name);?></span>
                    <?php
                }
                ?>                    
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $d168_del->first_name;?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end"> 
                    <!-- item-->
                    <a class="dropdown-item" href="<?php echo base_url('profile');?>"><i class="bx bxs-user-detail font-size-16 align-middle me-1"></i> <span key="t-profile">My Profile</span></a>
                    <a class="dropdown-item" href="<?php echo base_url('update-profile');?>"><i class="bx bx-cog font-size-16 align-middle me-1"></i> <span key="t-profile">Setting</span></a>
                    <?php
                    $user_role_del = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
                    if($user_role_del->role == 'supporter' && $user_role_del->supporter_status == 'active'){
                        $this->session->set_userdata('d168_role','supporter');
                        ?>
                        <a class="dropdown-item d-block" href="https://support.app.decision168.com/login" title="Support" target="_blank"><i class="bx bx-support font-size-16 align-middle me-1"></i> <span key="t-settings">Assigned Support</span></a>
                        <?php
                    }else{
                        $this->session->set_userdata('d168_role','');
                        ?>
                        <a class="dropdown-item d-block" href="https://support.app.decision168.com/login" title="Support" target="_blank"><i class="bx bx-support font-size-16 align-middle me-1"></i> <span key="t-settings">Support</span></a>
                        <?php
                    }
                    ?>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="return myTourModal();"><i class="bx bx-street-view font-size-16 align-middle me-1"></i> <span key="t-profile">My Tour</span></a>

                    <a class="dropdown-item" href="javascript:void(0);" onclick="return getStartedModal();"><i class="bx bxs-right-arrow-circle font-size-16 align-middle me-1"></i> <span key="t-profile">Get Started</span></a>   
                    <!-- <a class="dropdown-item" href="auth-lock-screen.html"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="logout();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="right-bar">
    <div data-simplebar="init" class="h-100"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -17px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
            <h5 class="m-0 me-2">Notes</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0">
        
        <div class="p-2">
            <div class="list-group list-group-flush">

                <a href="#" class="list-group-item text-muted py-3 px-2">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-13 text-truncate">Beautiful Day with Friends</h5>
                            <p class="mb-0 text-truncate">10 Apr, 2020</p>
                        </div>
                    </div>
                </a>
    
                <a href="#" class="list-group-item text-muted py-3 px-2">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-13 text-truncate">Drawing a sketch</h5>
                            <p class="mb-0 text-truncate">24 Mar, 2020</p>
                        </div>
                    </div>
                </a>
    
                <a href="#" class="list-group-item text-muted py-3 px-2">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-13 text-truncate active">Project discussion with team</h5>
                            <p class="mb-0 text-truncate">11 Mar, 2020</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1096px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 150px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll-menu-->
</div>