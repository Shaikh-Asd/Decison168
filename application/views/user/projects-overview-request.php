<?php
if($pdetail)
{
    if(isset($_COOKIE["d168_selectedportfolio"]))
    {
        if($_COOKIE["d168_selectedportfolio"] != $pdetail->portfolio_id)
        {
            setcookie("d168_selectedportfolio",$pdetail->portfolio_id,time()+ (10 * 365 * 24 * 60 * 60),'/');
            header("Refresh:0");
        }
    }
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
<title>Overview</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <?php
include('header_links.php');
?>
    </head>

    <body data-sidebar="dark">
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
                        <h4 class="mb-sm-0 font-size-18">Overview</h4>
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
                            <?php
                            if(!isset($_COOKIE["d168_selectedportfolio"]))
                            {
                            ?>
                            <li class="nav-item">
                                <?php
                                if($pdetail)
                                {
                                if($pdetail->ptype == "content")
                                {
                                ?>
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('contents-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Content List
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('projects-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Project List
                                </a>
                                <?php
                                }
                                }
                                ?>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Projects Overview</a></li> -->
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
 if($pdetail)
 {
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
                            <div class="col-lg-8">
                                <div class="card">
                                  <div data-simplebar style="max-height: 800px;"> 
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
                                                                    
                                                <div class="row task-dates">
                                                    <div class="col-3">
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
                                                    </div>

                                                    <div class="col-3">
                                                            <a href="<?php echo base_url('projects-request2/'.$pid.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                                                 Accept Request
                                                            </a>
                                                    </div>    
                                                    <div class="col-4">
                                                           <a href="<?php echo base_url('projects-request2/'.$pid.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                                                 Request More Info
                                                            </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="font-size-15 mt-4">Description :</h5>

                                        <p class="text-muted pdes"><?php 
                                        if(!empty($pdetail->pdes))
                                            {
                                                echo $pdetail->pdes;
                                            }
                                        ?></p>
                                        
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

                            <div class="col-lg-4">
                                <div class="card">
                                    <button class="btn members-button-d" style="text-align: start;font-size: 15px;font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                       <i class="mdi mdi-account-group me-1"></i> Members <i class="mdi mdi-chevron-down h3 me-1 members-button-a" style="float:right;"></i>
                                    </button>
                                    <div class="collapse" id="collapseExample" style="">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Team Members</h4>
                                      <div data-simplebar style="max-height: 800px;"> 
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                <tbody>
                                                    <tr class="table-dark">
                                                        <th colspan="3">Project Owner : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $powner->reg_id;?>)" class="text-white" title="View Profile"><?php echo $powner->first_name.' '.$powner->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                    if($pdetail->pmanager != '0')
                                                    {
                                                        $pmanager_det = $this->Front_model->getStudentById($pdetail->pmanager);
                                                        if($pmanager_det)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <th colspan="3">Project Manager : <a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pdetail->pmanager;?>)" class="text-dark" title="View Profile"><?php echo $pmanager_det->first_name.' '.$pmanager_det->last_name;?></a></th>
                                                    </tr>
                                                    <?php
                                                        }
                                                    } 
                                                    ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestsent-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background: #fcf0db;color: #383838;">
                                                            Request Sent To:
                                                        </button>
                                                    </h2>
                                                    <div id="requestsent-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                                        <div class="accordion-body text-muted">
                                                           <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap" style="margin-bottom: 0rem;">
                                                              <tbody>
                                                                <?php
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if(!empty($pm->status)){
                                                        if($pm->status == 'send')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                         echo "No Data Available!";
                                                    }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    } 
                                                    ?>
                                                              </tbody>
                                                            </table>
                                                           </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#requestaccepted-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background: #d6f3e9;color: #383838;">
                                                            Request Accepted By:
                                                        </button>
                                                    </h2>
                                                    <div id="requestaccepted-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    if($ptm){
                                                    foreach($ptm as $pm)
                                                    {
                                                        if(!empty($pm->status)){
                                                        if($pm->status == 'accepted')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                <?php
                                                                if($pm->photo)
                                                                {
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                    $profile_name = "";

                                                                    foreach ($member_name as $n) 
                                                                    {
                                                                      $profile_name .= $n[0];
                                                                    }
                                                                    ?>
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle btn-d text-white font-size-16">
                                                                            <?php echo strtoupper($profile_name);?>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><a href="javascript:void(0)" onclick="return TeamProfileModal(<?php echo $pm->reg_id;?>)" class="text-dark" title="View Profile"><?php echo $pm->first_name." ".$pm->last_name; ?></a></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    } 
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#invited_member-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background: #fde1e1;color: #383838;">
                                                            Invited Members:
                                                        </button>
                                                    </h2>
                                                    <div id="invited_member-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                    <tbody>
                                                                        <?php
                                                    $invited_member = $this->Front_model->InvitedProjectMember($pid); 
                                                    if($invited_member){
                                                    foreach($invited_member as $im)
                                                    {
                                                        if(!empty($im->status)){
                                                        if($im->status == 'pending')
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                            <i class="bx bx-user"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-size-14 m-0"><?php echo $im->sent_to;?></h5></td>
                                                            </tr>                                                            
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    }
                                                    } 
                                                    }
                                                    else
                                                    {
                                                        echo "No Data Available!";
                                                    }
                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
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
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/project-overview.init.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>
    </body>

</html>
