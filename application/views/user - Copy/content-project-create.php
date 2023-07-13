<?php
$page = 'content-planner';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Plan New Content</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- dropzone css -->
        <link href="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

        <?php
include('header_links.php');
?>
    </head>

    <body data-sidebar="dark" <?php if(empty($this->input->post('gid'))){ echo 'onload="return get_portfolio_id();"';}?>>
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php
            include('header.php');
            ?>
<!-- ========== Left Sidebar Start ========== -->
            <?php
            include('sidebar.php');
            ?>
<!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Plan</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('contents-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Content List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Project Create</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
<?php echo $this->session->flashdata('message'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">Plan New Content</h4>
                                        <form method="post" name="create_project_form" id="create_project_form" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="ptype" value="content">
                                            <?php
                                            if(!empty($this->input->post('regular_pid')))
                                            {
                                            ?>
                                            <input type="hidden" name="regular_pid_conv" value="<?php echo $this->input->post('regular_pid');?>">
                                            <input type="hidden" name="gid" value="<?php echo $this->input->post('gid');?>">
                                            <input type="hidden" name="sid" value="<?php echo $this->input->post('sid');?>">
                                            <?php
                                            }
                                            elseif((!empty($this->input->post('gid'))) && (!empty($this->input->post('sid'))))
                                            {
                                            ?>
                                            <input type="hidden" name="gid" value="<?php echo $this->input->post('gid');?>">
                                            <input type="hidden" name="sid" value="<?php echo $this->input->post('sid');?>">
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <input type="hidden" name="regular_pid_conv" value="">
                                            <?php
                                            }
                                            ?>
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-2">Publish Date <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                <?php
                                                if(!empty($this->input->post('gid')))
                                                {
                                                $gdetail = $this->Front_model->GoalDetail($this->input->post('gid'));
                                                    if($gdetail)
                                                    {
                                                    ?>
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date" value="<?php echo $gdetail->gstart_date;?>">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date" value="<?php echo $gdetail->gend_date;?>">
                                                    <div class="input-group" id="datepicker2">
                                                        <input id="p_publish" name="p_publish" class="form-control" onmouseover="return goal_content_publish_date();" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker2" data-date-format="yyyy-m-d" data-provide="datepicker" required />
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="input-group" id="datepicker2">
                                                    <input id="p_publish" name="p_publish" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker2" data-date-format="yyyy-m-d" data-provide="datepicker" required />
                                                </div>
                                                <?php
                                                }
                                                ?>                                                
                                                <span class="text-danger" id="p_publishErr"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2">Content Name <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                    <input id="pname" name="pname" type="text" class="form-control" value="<?php if(!empty($this->input->post('regular_pname'))) { echo $this->input->post('regular_pname');}?>" placeholder="Enter Content Name..." required="">
                                                    <span id="pnameErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="pdes" class="col-form-label col-lg-2">Content Description</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" id="pdes" name="pdes" rows="3" placeholder="Enter Content Description..."><?php if(!empty($this->input->post('regular_pdes'))) { echo $this->input->post('regular_pdes');}?></textarea>
                                                </div>
                                            </div>
                                            <?php
                                            if(!empty($this->input->post('gdept')))
                                            {
                                            ?>
                                            <div class="row mb-2">
                                                <label for="dept" class="col-form-label col-lg-2">Identify Department <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                    <select class="form-select select2" name="dept" id="dept" required>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                        $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                        if($check_port_dept) 
                                                        {
                                                            foreach($check_port_dept as $p_dept)
                                                            {
                                                                if($p_dept->portfolio_dept_id == $this->input->post('gdept'))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $p_dept->portfolio_dept_id;?>" selected><?php echo $p_dept->department;?></option>
                                                            <?php  
                                                                }
                                                            }         
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="deptErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <div class="row mb-2">
                                                <label for="dept" class="col-form-label col-lg-2">Identify Department <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                    <select class="form-select select2" name="dept" id="dept" required>
                                                        <option value="">Select Department</option>
                                                        <?php
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                        $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                        if($check_port_dept) 
                                                        {
                                                            foreach($check_port_dept as $p_dept)
                                                            {
                                                            ?>
                                                            <option value="<?php echo $p_dept->portfolio_dept_id;?>"><?php echo $p_dept->department;?></option>
                                                            <?php  
                                                            }         
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="deptErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="row mb-2" id="refresh_portfolio_id">
                                                <label class="col-form-label col-lg-2">Assign Portfolio <span class="text-danger">*</span></label>
                                                    <?php
                                                    if(!empty($this->input->post('regular_pportfolio')))
                                                    {
                                                        $port = $this->Front_model->getAllPortfolio($this->input->post('regular_pportfolio'));
                                                    ?>
                                                        <div class="col-lg-10">
                                                            <select class="form-select select2" name="portfolio_id" id="portfolio_id" required>
                                                                <option value="<?php echo $this->input->post('regular_pportfolio');?>" selected=""><?php if($port->portfolio_user == 'company'){ echo $port->portfolio_name;}elseif($port->portfolio_user == 'individual'){ echo $port->portfolio_name.' '.$port->portfolio_lname;}else{ echo $port->portfolio_name.' '.$port->portfolio_lname;}?></option>
                                                            </select>
                                                            <span id="portfolio_idErr" class="text-danger"></span>
                                                        </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        if(isset($_COOKIE["d168_selectedportfolio"]))
                                                        {
                                                            $port = $this->Front_model->getAllPortfolio($_COOKIE["d168_selectedportfolio"]);
                                                        ?>
                                                        <div class="col-lg-10">
                                                            <select class="form-select select2" name="portfolio_id" id="portfolio_id" required>
                                                                <option value="<?php echo $_COOKIE["d168_selectedportfolio"];?>" selected=""><?php if($port->portfolio_user == 'company'){ echo $port->portfolio_name;}elseif($port->portfolio_user == 'individual'){ echo $port->portfolio_name.' '.$port->portfolio_lname;}else{ echo $port->portfolio_name.' '.$port->portfolio_lname;}?></option>
                                                            </select>
                                                            <span id="portfolio_idErr" class="text-danger"></span>
                                                        </div>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <div class="col-lg-8">
                                                            <select class="form-select select2" name="portfolio_id" id="portfolio_id" onchange="return get_portfolio_id();">
                                                                <?php                                                            $Portfolio = $this->Front_model->Portfolio();
                                                                    $AcceptedProjectList = $this->Front_model->AcceptedProjectListPortfolio();       
                                                                if($Portfolio || $AcceptedProjectList)
                                                                {
                                                                    foreach($Portfolio as $c)
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $c->portfolio_id;?>"><span><?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name.' '.$c->portfolio_lname;}?></span></option>
                                                                <?php        
                                                                    }
                                                                    foreach($AcceptedProjectList as $al)
                                                                        {
                                                                            $c_id = $al->portfolio_id;
                                                                            if($c_id != 0)
                                                                            {
                                                                            $getAllPortfolio = $this->Front_model->getAllPortfolio($c_id);
                                                                            if($getAllPortfolio->portfolio_createdby != $this->session->userdata('d168_id'))
                                                                            {
                                                                            ?>
                                                                            <option value="<?php echo $getAllPortfolio->portfolio_id;?>"><span><?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?></span></option>
                                                                            <?php
                                                                            }
                                                                            }
                                                                        }
                                                                
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id="portfolio_idErr" class="text-danger"></span>
                                                        </div>  
                                                        <div class="col-lg-2">
                                                            <button type="button" class="btn btn-d btn-sm" data-bs-toggle="modal" data-bs-target="#AddPortfolio">Add Portfolio</button>
                                                        </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?> 
                                            </div>

                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2">Assign Project Manager</label>
                                                <div class="col-lg-10">  
                                                    <?php
                                                    if(!empty($this->input->post('gid')))
                                                    {
                                                        $porttm = $this->Front_model->GoalTeamMemberAccepted($this->input->post('gid'));
                                                    ?>
                                                    <select name="project_manager" id="project_manager" class="form-control pro_team_member" data-placeholder="Assign Project Manager..." onchange="return manager_selected_goal_tm_list(<?php echo $this->input->post('gid');?>);">
                                                        <option value=""><span>Select Project Manager</span></option>
                                                        <?php                                           
                                                        if($porttm){
                                                            foreach ($porttm as $ptm) {
                                                                $m = $this->Front_model->getStudentById($ptm->gmember);
                                                                if($m){
                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php
                                                                    }
                                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                                                <?php
                                                                    }
                                                                }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    if(!empty($this->input->post('port_id')))
                                                    {
                                                        $porttm = $this->Front_model->getAccepted_PortTM($this->input->post('port_id'));
                                                    ?>
                                                    <select name="project_manager" id="project_manager" class=" form-control pro_team_member" data-placeholder="Assign Project Manager..." onchange="return manager_selected();">
                                                        <option value=""><span>Select Project Manager</span></option>
                                                        <?php                                           
                                                        if($porttm){
                                                            foreach ($porttm as $ptm) {
                                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                if($m){
                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php
                                                                    }
                                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                                                <?php
                                                                    }
                                                                }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?php
                                                    }
                                                    elseif(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        $porttm = $this->Front_model->getAccepted_PortTM($_COOKIE["d168_selectedportfolio"]);
                                                    ?>
                                                    <select name="project_manager" id="project_manager" class=" form-control pro_team_member" data-placeholder="Assign Project Manager..." onchange="return manager_selected();">
                                                        <option value=""><span>Select Project Manager</span></option>
                                                        <?php                                           
                                                        if($porttm){
                                                            foreach ($porttm as $ptm) {
                                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                if($m){
                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php
                                                                    }
                                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                                                <?php
                                                                    }
                                                                }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?php
                                                    }
                                                    }
                                                    ?>                 
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2">Add Team Members</label>
                                                <?php
                                                if(!empty($this->input->post('gid')))
                                                {
                                                    $porttm = $this->Front_model->GoalTeamMemberAccepted($this->input->post('gid'));
                                                ?>
                                                <div class="col-lg-10" id="select2-team_member-container">
                                                <select name="team_member" id="team_member" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                    <?php                                           
                                                    if($porttm){
                                                        foreach ($porttm as $ptm) {
                                                            $m = $this->Front_model->getStudentById($ptm->gmember);
                                                            if($m){
                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                            <?php
                                                                }
                                                            }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="selected_T_member" id="selected_T_member">
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="col-lg-8" id="select2-team_member-container">
                                                    <!-- <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                        <?php                                           
                                                        if($t_members){
                                                            foreach ($t_members as $m) {
                                                                ?>
                                                                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>  -->   
                                                    <?php
                                                    if(!empty($this->input->post('port_id')))
                                                    {
                                                        $porttm = $this->Front_model->getAccepted_PortTM($this->input->post('port_id'));
                                                    ?>
                                                    <select name="team_member" id="team_member" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                        <?php                                           
                                                        if($porttm){
                                                            foreach ($porttm as $ptm) {
                                                                $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                if($m){
                                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php
                                                                    }
                                                                }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <select name="team_member" id="team_member" class="form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                        
                                                    </select>
                                                    <?php
                                                    }
                                                    ?>                                                
                                                    <input type="hidden" name="selected_T_member" id="selected_T_member">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add_dup_member btn btn-d btn-sm">Invite More Member</button>                                                    
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="imember_div">
                                            </div>
                                             <span id="err_valid" class="text-danger"></span>
                                        <div class="row mb-2">
                                            <label class="col-form-label col-lg-2">Content Link(s) & Comment(s)</label>
                                            <div class="col-lg-4">
                                                <input id="plink" name="plink[]" type="text" class="form-control" placeholder="Enter Project Link...">
                                                <span id="plinkErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <input id="plink_comment" name="plink_comment[]" type="text" class="form-control" placeholder="Enter Project Link Comment...">
                                                <span id="plink_commentErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add_dup_plink btn btn-d btn-sm">Add Another link</button>                                                   
                                            </div>
                                        </div>
                                        <div class="plink_div">
                                        </div>
                                        <span id="link_validErr" class="text-danger" style="padding-left: 173px;"></span>
                                        <div class="row mb-3">
                                            <label class="col-form-label col-lg-2">Attached File(s)</label>
                                            <div class="col-lg-4">
                                            <input class="form-control" name="pfile[]" id="pfile" type="file" multiple="" />
                                                <span id="pfileErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" id="create_project_button" class="btn btn-d btn-sm">Create Content</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                                </a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <?php
                include('footer.php');
                ?>
                            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
<!-- Add Portfolio Modal -->
<div class="modal fade" id="AddPortfolio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Portfolio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="AddPortfolioForm" id="AddPortfolioForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <label for="pname" class="col-form-label col-lg-3">Portfolio Name <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" placeholder="Enter Portfolio Name..." required="">
                            <span id="portfolio_nameErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="AddPortfolioButton" class="btn btn-d">ADD</button>
                    <img id="cloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>     
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- dropzone plugin -->
        <script src="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>
<script type="text/javascript">
$(document).ready(function(){
    //debugger;
   var add_dup_member = $('.add_dup_member'); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var memberHTML = '<div class="row mb-2"><label class="col-form-label col-lg-2"></label><div class="col-lg-8"><input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_member).click(function(){
    //debugger;
           $(imember_div).append(memberHTML); //Add field html
   });
   
   $(imember_div).on('click', '.add_dup_member2', function(e){
      //debugger;
           $(imember_div).append(memberHTML); 
   });

   //Once remove button is clicked
   $(imember_div).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       x--; //Decrement field counter
   });

//plink clone
var add_dup_plink = $('.add_dup_plink'); //Add button selector
   var plink_div = $('.plink_div'); //Input field wrapper
   var plinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-2"></label><div class="col-lg-4"><input id="plink" name="plink[]" type="text" class="form-control" placeholder="Enter Project Link..."><span id="plinkErr" class="text-danger"></span></div><div class="col-lg-4"><input id="plink_comment" name="plink_comment[]" type="text" class="form-control" placeholder="Enter Project Link Comment..."><span id="plink_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_plink2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_plink" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_plink).click(function(){
    //debugger;
           $(plink_div).append(plinkHTML); //Add field html
   });
   
   $(plink_div).on('click', '.add_dup_plink2', function(e){
      //debugger;
           $(plink_div).append(plinkHTML); 
   });

   //Once remove button is clicked
   $(plink_div).on('click', '.remove_dup_plink', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
   });

});
</script>
<?php
if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
?>
    <script type="text/javascript">
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "content-project-create")
          {
            localStorage.setItem('tour_session', 'no');
            var steps = [ 
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Here you can create your Content</p>"
                }, 
                {
                    title: "Content: Publish Date",
                    id: "p_publish",
                    content: "<p class='popover-content'>Select Publish Date</p>"
                }, 
                {
                    title: "Content: Name",
                    id: "pname",
                    content: "<p class='popover-content'>Enter Content Name</p>"
                }, 
                {
                    title: "Content: Description",
                    id: "pdes",
                    content: "<p class='popover-content'>Enter Content Description</p>"
                },
                {
                    title: "Content: Department",
                    id: "select2-dept-container",
                    content: "<p class='popover-content'>Select Department for the Content</p>"
                },
                {
                    title: "Content: Portfolio",
                    id: "select2-portfolio_id-container",
                    content: "<p class='popover-content'>Select Portfolio for the Content</p>"
                },
                {
                    title: "Content: Project Manager",
                    id: "select2-project_manager-container",
                    content: "<p class='popover-content'>Select Project Manager</p>"
                },
                {
                    title: "Content: Team Members",
                    id: "select2-team_member-container",
                    content: "<p class='popover-content'>Add Team Members for the Content</p>"
                },
                {
                    title: "Content: Links",
                    id: "plink",
                    content: "<p class='popover-content'>Enter links related to the Content</p>"
                },
                {
                    title: "Content: Comment",
                    id: "plink_comment",
                    content: "<p class='popover-content'>Enter Comment related to the Content Link</p>"
                },
                {
                    title: "Content: File Upload",
                    id: "pfile",
                    content: "<p class='popover-content'>Upload Files related to the Content</p>"
                },
                {
                    title: "Content: Submit",
                    id: "create_project_button",
                    content: "<p class='popover-content'>Click here to Create Content</p>"
                }
            ];
            var my_tour = new Tour(steps);
            my_tour.show();
          }
        }
    </script>
    <?php
}
?>
    </body>
</html>