<?php
if($pdetail)
{
    if($pdetail->ptype == "content")
    {
    $page = 'content-planner';
    }
    elseif($pdetail->ptype == "goal_strategy")
    {
    $page = 'goals-list';
    }
    else
    {
    $page = 'projects-list';
    }
}
else
{
$page = 'projects-list';
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title><?php 
        if($pdetail->ptype == "content")
        {
            echo 'Content Edit';
        }
        else
        {
            echo 'Project Edit';
        }?></title>
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

    <body data-sidebar="dark" <?php if(empty($pdetail->gid)){ echo 'onload="return get_portfolio_id_edit();"';}?>>
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
<?php
if($pdetail)
{
    $check_Portfolio_owner_id = $this->Front_model->getPortfolioById($pdetail->portfolio_id);
    $portfolio_owner_id = "";
    if($check_Portfolio_owner_id)
    {
        $portfolio_owner_id = $check_Portfolio_owner_id->portfolio_createdby;
    }
    if(($pdetail->pcreated_by == $this->session->userdata('d168_id')) || ($pdetail->pmanager == $this->session->userdata('d168_id')) || ($portfolio_owner_id == $this->session->userdata('d168_id')))
    {
?>
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-2">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Edit</h4>
                    </div>
                </div>
                <div class="col-10">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Project Edit</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2"><?php 
                                        if($pdetail->ptype == "content")
                                        {
                                            echo 'Edit Content';
                                        }
                                        else
                                        {
                                            echo 'Edit Project';
                                        }?></h4>
                                        <form method="post" name="edit_project_form" id="edit_project_form" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="id" id="pid" value="<?php echo $pdetail->pid;?>">
                                            <input type="hidden" name="ptype" value="<?php echo $pdetail->ptype;?>">
                                            <?php
                                            if($pdetail->ptype == "content")
                                            {
                                            ?>
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-2">Publish Date <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                <?php
                                                if($pdetail->gid != '0')
                                                {
                                                    $gdetail = $this->Front_model->GoalDetail($pdetail->gid);
                                                    if($gdetail)
                                                    {
                                                    ?>
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date" value="<?php echo $gdetail->gstart_date;?>">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date" value="<?php echo $gdetail->gend_date;?>">
                                                    <div class="input-group" id="datepicker2">
                                                        <input id="p_publish" name="p_publish" class="form-control" onmouseover="return goal_content_publish_date();" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker2" data-date-format="yyyy-m-d" data-provide="datepicker" value="<?php echo $pdetail->p_publish;?>" required/>
                                                    </div>
                                                    <?php
                                                    }
                                                } 
                                                else
                                                {
                                                ?>
                                                <div class="input-group" id="datepicker2">
                                                    <input id="p_publish" name="p_publish" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker2" data-date-format="yyyy-m-d" data-provide="datepicker" value="<?php echo $pdetail->p_publish;?>" required/>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <span class="text-danger" id="p_publishErr"></span>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2"><?php 
                                                if($pdetail->ptype == "content")
                                                {
                                                    echo 'Content Name';
                                                }
                                                else
                                                {
                                                    echo 'Project Name';
                                                }?> <span class="text-danger">*</span></label>
                                                <div class="col-lg-10">
                                                    <input id="pname" name="pname" type="text" class="form-control" placeholder="Enter Project Name..." value="<?php echo $pdetail->pname;?>" required="">
                                                    <span id="pnameErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="pdes" class="col-form-label col-lg-2"><?php 
                                                if($pdetail->ptype == "content")
                                                {
                                                    echo 'Content Description';
                                                }
                                                else
                                                {
                                                    echo 'Project Description';
                                                }?></label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" id="pdes" name="pdes" rows="3" placeholder="Enter Description..."><?php echo $pdetail->pdes;?></textarea>
                                                </div>
                                            </div>
                                            <?php
                                            if($pdetail->gid != '0')
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
                                                                if($p_dept->portfolio_dept_id == $pdetail->dept_id)
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
                                                            <option value="<?php echo $p_dept->portfolio_dept_id;?>" <?php if($p_dept->portfolio_dept_id == $pdetail->dept_id) { echo "selected";}?>><?php echo $p_dept->department;?></option>
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
                                                    <select class="form-select select2" name="portfolio_id" id="portfolio_id" onchange="return get_portfolio_id_edit();" required>
                                                        <?php                                                            $Portfolio = $this->Front_model->Portfolio();
                                                            $AcceptedProjectList = $this->Front_model->AcceptedProjectListPortfolio();       
                                                        if($Portfolio || $AcceptedProjectList)
                                                        {
                                                            foreach($Portfolio as $c)
                                                            {
                                                        ?>
                                                        <option value="<?php echo $c->portfolio_id;?>" <?php if($pdetail->portfolio_id == $c->portfolio_id){ echo "selected";}?>><span><?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name.' '.$c->portfolio_lname;}?></span></option>
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
                                                                    <option value="<?php echo $getAllPortfolio->portfolio_id;?>"<?php if($pdetail->portfolio_id == $getAllPortfolio->portfolio_id){ echo "selected";}?>><span><?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}?></span></option>
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
                                                ?>     
                                            </div>

                                            <div class="row mb-2">
                                                <label for="pname" class="col-form-label col-lg-2">Add Team Members</label>
                                                <?php
                                                if(!empty($pdetail->gid))
                                                {
                                                $pcreated = $pdetail->pcreated_by;
                                                $porttm = $this->Front_model->GoalTeamMemberAccepted($pdetail->gid); 
                                                ?> 
                                                <div class="col-lg-10"> 
                                                <select name="team_member" id="team_member" class="form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                <?php
                                                if($porttm)
                                                {
                                                  foreach ($porttm as $ptm) 
                                                  {
                                                    $m = $this->Front_model->getStudentById($ptm->gmember);
                                                    $check_pm = $this->Front_model->check_pm($m->reg_id,$pdetail->pid,$pdetail->portfolio_id);
                                                      if($m)
                                                      {
                                                        $check_pm_pmember = "";
                                                        if($check_pm)
                                                        {
                                                          $check_pm_pmember = $check_pm->pmember;
                                                        }
                                                        if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pm_pmember))
                                                        {
                                                          if($m->reg_id != $pcreated)
                                                          {
                                                          ?>
                                                          <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                          <?php
                                                          }
                                                        }
                                                      }
                                                      if($check_pm && $m)
                                                      {
                                                        if((($check_pm->status == 'accepted') || ($check_pm->status == 'send')) && ($m->reg_id == $check_pm->pmember) && ($m->reg_id != $pcreated))
                                                        {
                                                        ?>
                                                        <option value="<?php echo $m->reg_id;?>" selected><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                        <?php
                                                        }
                                                      }
                                                    }
                                                }
                                                ?>
                                                </select> 
                                                <?php 
                                                $ptm = $this->Front_model->ProjectTeamMember($pdetail->pid);
                                                if(!empty($ptm))
                                                {
                                                    $all_tm_list = array();
                                                    $all_tm = "";
                                                    foreach($ptm as $atm)
                                                    {
                                                        $all_tm_list[] = $atm->pmember;
                                                    }
                                                    $all_tm = implode(',',$all_tm_list);
                                                }
                                                ?>                                                 
                                                <input type="hidden" name="selected_T_member" id="selected_T_member" value="<?php if(!empty($all_tm)) { echo $all_tm;}?>">
                                                </div>                                             
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="col-lg-8">
                                                    <select name="team_member" id="team_member" class="form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                        
                                                    </select> 
                                                    <?php 
                                                    $ptm = $this->Front_model->ProjectTeamMember($pdetail->pid);
                                                    if(!empty($ptm))
                                                    {
                                                        $all_tm_list = array();
                                                        $all_tm = "";
                                                        foreach($ptm as $atm)
                                                        {
                                                            $all_tm_list[] = $atm->pmember;
                                                        }
                                                        $all_tm = implode(',',$all_tm_list);
                                                    }
                                                    ?>                                                 
                                                    <input type="hidden" name="selected_T_member" id="selected_T_member" value="<?php if(!empty($all_tm)) { echo $all_tm;}?>">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add_dup_member btn btn-d text-white btn-sm">Invite More Member</button>                                                    
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="imember_div">
                                            </div>
                                            <span id="err_valid" class="text-danger"></span>
                                        <?php
                                        if(!empty($pdetail->plink))
                                        {
                                        $plink = explode(',', $pdetail->plink);
                                        $plink_comment = explode(',',$pdetail->plink_comment);
                                        ?>
                                        <div class="row mb-2">
                                            <label class="col-form-label col-lg-2"><?php 
                                                if($pdetail->ptype == "content")
                                                {
                                                    echo 'Content';
                                                }
                                                else
                                                {
                                                    echo 'Project';
                                                }?> Link(s) & Comment(s)</label>
                                            <div class="col-lg-4">
                                                <input id="plink" name="plink[]" type="text" class="form-control" value="<?php echo $plink[0];?>">
                                                <span id="plinkErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <input id="plink_comment" name="plink_comment[]" type="text" class="form-control" value="<?php if(!empty($plink_comment[0])){ echo $plink_comment[0]; }?>">
                                                <span id="plink_commentErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add_dup_plink btn btn-d btn-sm">Add Another link</button>                                                   
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="row mb-2">
                                            <label class="col-form-label col-lg-2">Link(s) & Comment(s)</label>
                                            <div class="col-lg-4">
                                                <input id="plink" name="plink[]" type="text" class="form-control" placeholder="Enter Link...">
                                                <span id="plinkErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <input id="plink_comment" name="plink_comment[]" type="text" class="form-control" placeholder="Enter Link Comment...">
                                                <span id="plink_commentErr" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add_dup_plink btn btn-d btn-sm">Add Another link</button>                                                   
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="plink_div">
                                            <?php
                                            if(!empty($pdetail->plink))
                                            {
                                                $plink = explode(',', $pdetail->plink);
                                                $plink_comment = explode(',',$pdetail->plink_comment);
                                                $plcount = count($plink); 
                                                if($plcount > 0)
                                                {
                                                    for ($i=1; $i<$plcount; $i++)
                                                    {
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-2"></label>
                                                            <div class="col-lg-4">
                                                                <input id="plink" name="plink[]" type="text" class="form-control" value="<?php echo $plink[$i];?>">
                                                                <span id="plinkErr" class="text-danger"></span>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input id="plink_comment" name="plink_comment[]" type="text" class="form-control" value="<?php if(!empty($plink_comment[$i])){ echo $plink_comment[$i]; }?>">
                                                                <span id="plink_commentErr" class="text-danger"></span>
                                                            </div>
                                                            <div class="col-lg-2 card-title mb-2">
                                                                <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_plink2" style="margin-left: 30px;">
                                                                    <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
                                                                </button>
                                                                <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_plink" style="margin-left: 15px;">
                                                                    <span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span>
                                                                </button>
                                                            </div>                                           
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span id="link_validErr" class="text-danger" style="padding-left: 173px;"></span>
                                        <div class="row mb-3">
                                            <label class="col-form-label col-lg-2">Attached File(s)</label>
                                            <div class="col-lg-4">
                                            <input class="form-control" name="pfile[]" id="pfile" type="file" multiple="" /><span></span>
                                                <span id="pfileErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" id="edit_project_button" class="btn btn-d btn-sm">Save Changes</button>
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
                }
                }
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
   var plinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-2"></label><div class="col-lg-4"><input id="plink" name="plink[]" type="text" class="form-control" placeholder="Enter Link..."><span id="plinkErr" class="text-danger"></span></div><div class="col-lg-4"><input id="plink_comment" name="plink_comment[]" type="text" class="form-control" placeholder="Enter Link Comment..."><span id="plink_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_plink2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_plink" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
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
    </body>

</html>
