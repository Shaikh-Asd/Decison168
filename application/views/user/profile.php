<?php
$page = 'profile';

$approve_expert_clear = $this->Front_model->getApproveExpertNotify_clear();//Expert call rate notification
if($approve_expert_clear){
    $data = array(
                    'call_notify_clear' => 'yes',
                );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Front_model->updateRegistration($data,$this->session->userdata('d168_id'));
}

$getApproveExpertNotify = $this->Front_model->getApproveExpertNotify();//Expert Call Rate notification
if($getApproveExpertNotify){
    $data = array(
                    'call_notify' => 'sent_seen',
                );
    $data = $this->security->xss_clean($data); // xss filter
    $res = $this->Front_model->updateRegistration($data,$this->session->userdata('d168_id'));
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="utf-8" />
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <?php
    include('header_links.php');
    ?>
    <style type="text/css">
        .bg-black {
            background-color: #000!important;
        }
        .font-size-60{
            font-size: 60px!important;
        }
        .card-3{
            box-shadow: 0px 12px 18px -6px rgba(0,0,0,0.3) !important;
            background-color: #fbfafa !important;
        }
        .landing-footer {
            padding: 20px 0 20px!important;
            background-color: #232323!important;
        }
        .no-image-card{
            width: 256px;
            height: 256px;
            font-size: 8em;
            font-weight: bolder;
            padding: 19%;
            background-color: #c6de18;
        }
        .expert_photo-section{
            width: 150px;
            height: 150px;
            border: 2px solid #ced4da;
            background-color: #fbfbfb;
            border-radius: 3%;
        }
        .image-text{
            position: absolute;
            top: 50%;
            left: 20%;
            right: 25%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            margin: 0 auto;
            text-shadow: 1px 0 0 #ffffff, 0 -1px 0 #ffffff, 0 1px 0 #ffffff, -1px 0 0 #ffffff;
        }
        .border-left{
            border-left: 1px solid #e1e1e1;
        }
    </style>
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
                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>
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
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-9">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-secondary">
                        <?php
                        if(!empty($stud_del->cover_photo)){
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/'.$stud_del->cover_photo)?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <div class="col-12">
                                <div class="float-end p-3">
                                    <a href="javascript: void(0);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#profileCover" title="Change Cover Picture">
                                        <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-image-add" style="font-size: 1.2rem;"></i>
                                        </span>
                                    </a>
                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                    <!-- <p>It will seem like simplified</p> -->
                                </div>
                            </div>
                        </div>
                       <?php
                        }else{
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/cover.jpg')?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <div class="col-12">
                                <div class="float-end p-3">
                                    <a href="javascript: void(0);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" data-bs-toggle="modal" data-bs-target="#profileCover" title="Add Cover Picture">
                                        <span class="avatar-title bg-transparent text-reset">
                                                <i class="bx bx-image-add" style="font-size: 1.2rem;"></i>
                                        </span>
                                    </a>
                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                    <!-- <p>It will seem like simplified</p> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>                        
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <?php
                            if(!empty($stud_del->photo)){
                                ?>
                                <img class="img-thumbnail rounded-circle avatar-md" src="<?php echo base_url('assets/student_photos/'.$stud_del->photo);?>" alt="<?php echo $stud_del->first_name;?>" data-bs-toggle="modal" data-bs-target="#profilePic" title="Change Profile Picture" style="cursor: pointer;">
                                <?php
                            }else{
                                $fullname = $stud_del->first_name.' '.$stud_del->last_name;
                                $student_name = explode(" ", $fullname);
                                $profile_name = "";

                                foreach ($student_name as $sn) {
                                  $profile_name .= $sn[0];
                                }
                                ?>
                                <span class="avatar-title rounded-circle btn-d text-white font-size-24" data-bs-toggle="modal" data-bs-target="#profilePic" title="Add Profile Picture" style="cursor: pointer;"><?php echo strtoupper($profile_name);?></span>
                                <?php
                            }
                            ?> 
                                </div>
                                <h5 class="font-size-15 text-truncate"><?php echo $stud_del->first_name.' '.$stud_del->last_name;?></h5>
                                <p class="text-muted mb-0 text-truncate"><?php echo $stud_del->designation;?></p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">
                                   
                                    <div class="row">
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($count_total_portfolio)
                                                    {
                                                        echo $count_total_portfolio['count_rows'];   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('portfolio');?>" class="nameLink" title="View Portfolios">Portfolios</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_member_project_count || $view_created_project_count)
                                                    {
                                                        $total_projects = $view_member_project_count['count_rows'] + $view_created_project_count['count_rows'];
                                                        echo $total_projects;   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('projects-list');?>" class="nameLink" title="View Projects">Projects</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_member_project_content_count || $view_created_project_content_count)
                                                {
                                                    $total_cprojects = $view_member_project_content_count['count_rows'] + $view_created_project_content_count['count_rows'];
                                                    echo $total_cprojects;   
                                                }
                                            ?></h5>
                                            <a href="<?php echo base_url('contents-list');?>" class="nameLink" title="View Contents">Planned Content</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_left_task_counts || $view_left_subtask_counts)
                                                    {
                                                        $view_total_left_tasks_subtasks_count = $view_left_task_counts['count_rows'] + $view_left_subtask_counts['count_rows'];
                                                        echo $view_total_left_tasks_subtasks_count;   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('all-tasks');?>" class="nameLink" title="View Tasks">Tasks</a>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="<?php echo base_url('update-profile');?>" class="btn btn-d waves-effect waves-light btn-sm">Update Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <!-- <button type="button" class="btn btn-d waves-effect waves-light btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#change_my_passwordModal">Change Password <i class="mdi mdi-arrow-right ms-1"></i></button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-2">Personal Information</h4>
                        <p class="pdes mb-4"><?php echo $stud_del->about_me;?></p>

                        <div class="table-responsive conversation-list" data-simplebar>
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td><?php echo $stud_del->first_name.' '.$stud_del->middle_name.' '.$stud_del->last_name;?></td>
                                    </tr>
                                    <?php
                                    if($stud_del->phone_number && $stud_del->phone_number != 0){
                                        ?>
                                        <tr>
                                            <th scope="row">Mobile :</th>
                                            <td><?php echo $stud_del->phone_number;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row">E-mail Address :</th>
                                        <td><?php echo $stud_del->email_address;?></td>
                                    </tr> 
                                    <?php
                                    if($stud_del->company){
                                        ?>
                                        <tr>
                                            <th scope="row">Company :</th>
                                            <td><?php echo $stud_del->company;?></td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    if($stud_del->gender){
                                        ?>
                                        <tr>
                                            <th scope="row">Gender :</th>
                                            <td><?php echo $stud_del->gender;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($stud_del->dob != '0000-00-00'){
                                        ?>
                                        <tr>
                                            <th scope="row">Date of Birth :</th>
                                            <td><?php echo date('d M, Y',strtotime($stud_del->dob));?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>                                   
                                    <?php 
                                    if($stud_del->country){
                                        $get_c = $this->Front_model->getCountryByCode($stud_del->country);
                                        ?>
                                        <tr>
                                            <th scope="row">Country :</th>
                                            <td><?php echo $get_c->country_name;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?> 
                                    <?php
                                    if($stud_del->social_media){
                                        ?>
                                        <tr>
                                            <th>Social Media Link(s) :</th>
                                            <td><?php
                                                $social_media_icon = explode(',', $stud_del->social_media_icon);
                                                $social_media = explode(',', $stud_del->social_media);
                                                $count = count($social_media);
                                                if($count > 0){
                                                    for ($i=0; $i<$count; $i++){
                                                        $icon_name = strtolower($social_media_icon[$i]);
                                                        ?>
                                                        <span class="profile-icon-span"><a target="_blank" href="<?php echo prep_url($social_media[$i]);?>">
                                                            <!-- <img class="profile-icon" title="<?php echo $social_media_icon[$i];?>" src="<?php echo base_url('assets/images/icons/'.$icon_name.'.png');?>"> -->
                                                            <span><i class="fab fa-<?php echo $icon_name;?> h3 text-d"></i></span>
                                                        </a></span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>                                   
                                </tbody>
                            </table>
                        </div>

                        <?php
                        if($stud_del->expert_approve == 1){
                            ?>
                            <h4 class="card-title mb-2 mt-4">Expertise</h4>
                            <p class="pdes mb-4"><?php echo $stud_del->expertise; ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- end card -->
            </div>  
            <div class="col-lg-3">
                <?php
                if(($stud_del->expert == 1) && ($stud_del->expert_approve == 1)){
                    ?>
                    <div class="card border border-success" style="border-color: #c7df19 !important;">
                        <div class="card-body p-4">
                            <div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" style="color: #383838 !important;">View :</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false">
                                            <i class="mdi mdi-format-list-bulleted"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item me-2">
                                        <a class="nav-link active" id="v-pills-grid-tab" data-bs-toggle="pill" href="#v-pills-grid" role="tab" aria-controls="v-pills-grid" aria-selected="true">
                                            <i class="mdi mdi-view-grid-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                                <hr>
                                <p style="cursor: pointer;color: #383838;font-size: 13px;" data-bs-toggle="modal" data-bs-target="#update-dm_profile"><i class="bx bxs-user-rectangle"></i> Update Decision Maker Profile </p>
                                <hr>
                                <p style="cursor: pointer;color: #383838;font-size: 13px;" data-bs-toggle="modal" data-bs-target="#update-call_rate"><i class="bx bxs-video-plus"></i> Update Call Rate</p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- end card -->
            </div>  

    </div> 

    <div style='clear:both'></div>

            </div>
        </div>
        <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<!-- Add Team Member Modal -->
<div class="modal fade" id="change_my_passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="my_cp_form" id="my_cp_form" class="login_form" autocomplete="off">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="old_password" id="old_password" class="form-control pl-15" placeholder="Current Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="oldPassword();" class="fa fa-eye" id="togglePassword1"></i></span>
                                </div>
                            </div>
                            <span id="old_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="new_password" id="new_password" class="form-control pl-15" placeholder="New Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="newPassword();" class="fa fa-eye" id="togglePassword2"></i></span>
                                </div>
                            </div>
                            <span id="new_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="conf_password" id="conf_password" class="form-control pl-15" placeholder="Confirm Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="confPassword();" class="fa fa-eye" id="togglePassword3"></i></span>
                                </div>
                            </div>
                            <span id="conf_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-d btn-sm w-md waves-effect waves-light" type="submit">Change Password</button>
                            <button type="button" class="btn btn-sm bg-d text-white ms-1" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  

<!-- Profile Cover Modal -->
<div class="modal fade" id="profileCover" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cover Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-ProfileCover"></div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="white-text"><h4>Select Image:</h4></div>
                        <br>
                        <div class="col-md-6">
                        <input type="file" class="form-control" id="upload_NewProfileCover">
                        <span style="color: red;" id="profilecover_error"></span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-d upload-profileCoverresult">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Pic Modal -->
<div class="modal fade" id="profilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-Profilepic"></div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="white-text"><h4>Select Image:</h4></div>
                        <br>
                        <div class="col-md-6">
                        <input type="file" class="form-control" id="upload_NewProfilepic">
                        <span style="color: red;" id="profilepic_error"></span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-d upload-profilepicresult">Save</button>
            </div>
        </div>
    </div>
</div>

<!--  Update Call Rate Modal-->
<div class="modal fade bs-example-modal-sm" id="update-call_rate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Call Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="expert-section row">
                    <div class="col-lg-12">
                        <div class="right-expert-section">
                            <div class="about-section">
                                <form class="call_rate_form" name="call_rate_form" id="call_rate_form" method="post" autocomplete="off">
                                    <div class="row mb-2">
                                        <div class="col-lg-12">
                                            <label class="mb-0">Add Call Rate as per the minute <span class="text-d">(in $)</span>:</label>
                                            <?php
                                            $expert_id = $this->session->userdata('d168_id');
                                            $stud_del = $this->Front_model->getStudentById($expert_id);
                                            $expert_name = ucwords($stud_del->first_name.' '.$stud_del->last_name);
                                            $ecd = $this->Front_model->countExpertCallRate($expert_id);  
                                            if($ecd){
                                                ?>
                                                <br><small>(Leaving the field blank will delete the package)</small><br><br>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                    <?php
                                    $call_minutes = $this->Front_model->callMinutes();
                                    if($call_minutes){
                                        foreach ($call_minutes as $cm) {
                                            $cm_id = $cm->cm_id;
                                            $call_rate_del = $this->Front_model->callRateByCId($cm_id,$expert_id);      
                                            if($call_rate_del){
                                                $call_rate = $call_rate_del->call_rate;
                                            }else{
                                                $call_rate = "";
                                            }                                     
                                            $cm_cnt=1;
                                            ?>
                                            <div class="row mb-2">
                                                <div class="col-lg-6">
                                                    <label class="form-label"><?php echo $cm->minute; ?></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" placeholder="Call Rate($)" type="text" name="call_rate<?php echo $cm_id; ?>" value="<?php echo $call_rate; ?>" />
                                                    <span id="call_rate<?php echo $cm_id; ?>Err" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="pack_name<?php echo $cm_id; ?>" value="Decision Maker (<?php echo $expert_name; ?>) <?php echo $cm->minute; ?>">
                                            <?php
                                            $cm_cnt++;
                                        }
                                    }
                                    ?>
                                    <span id="call_rate_error" class="text-danger"></span>
                                    <div class="mb-3">
                                        <button type="submit" id="call_rate-submit" class="btn btn-md btn-d waves-effect waves-light buttonText">Update</button>
                                    </div>                                    
                                </form>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  Update Profile Modal -->
<div class="modal fade" id="update-dm_profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="expert-section row">
                    <div class="col-lg-2">
                        <div class="left-expert-section">
                            <img src="<?php echo base_url('assets/images/Decision-168.png'); ?>" class="rounded img-fluid mx-auto d-block" style="width: 106px; height: auto;">
                        </div>
                    </div>
                    <div class="col-lg-10 border-left">
                        <div class="right-expert-section">
                            <div class="about-section p-3">
                                <form class="dm_profilePic_form" name="dm_profilePic_form" id="dm_profilePic_form" method="post" autocomplete="off">
                                    <div class="row mb-3">
                                        <div class="col-lg-4"> 
                                            <div id="dm_user-choosen-photo" class="expert_photo-section">
                                                <?php
                                                if($stud_del->expert_photo != ""){
                                                    ?>
                                                    <img class="img-thumbnail" data-bs-toggle="modal" data-bs-target="#dm_profilePic" title="Change Profile Picture" style="cursor: pointer;" src="<?php echo base_url('assets/student_photos/'.$stud_del->expert_photo); ?>">
                                                    <?php
                                                }
                                                ?>                                                
                                            </div>
                                            <a href="javascript:void(0);" class="image-text text-dark font-weight-semibold font-size-14" data-bs-toggle="modal" data-bs-target="#dm_profilePic" title="Change Profile Picture">Upload Photo</a>
                                            <input type="hidden" name="expert_photo" value="<?php echo $stud_del->expert_photo; ?>" id="expert_photo">
                                            <span id="expert_photoErr" class="text-danger"></span>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="formrow-email_address-input" class="form-label">Email Address</label>
                                                        <input class="form-control" placeholder="Email Address *" type="text" name="email_address" required="" value="<?php echo $stud_del->email_address; ?>" readonly />
                                                        <span id="email_addressErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-first_name-input" class="form-label">First Name</label>
                                                        <input class="form-control" placeholder="First Name *" type="text" name="first_name" required="" value="<?php echo $stud_del->first_name; ?>" readonly />
                                                        <span id="first_nameErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-last_name-input" class="form-label">Last Name</label>
                                                        <input class="form-control" placeholder="Last Name *" type="text" name="last_name" required="" value="<?php echo $stud_del->last_name; ?>" readonly />
                                                        <span id="last_nameErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="formrow-designation-input" class="form-label">Designation</label>
                                                <input class="form-control" placeholder="Designation *" type="text" name="designation" required="" value="<?php echo $stud_del->designation; ?>" />
                                                <span id="designationErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="formrow-company-input" class="form-label">Company</label>
                                                <input class="form-control" placeholder="Company *" type="text" name="company" required="" value="<?php echo $stud_del->company; ?>" />
                                                <span id="companyErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formrow-expertise-input" class="form-label">Describe your expertise:</label>
                                                <textarea class="form-control" placeholder="Expertise *" name="expertise" required="" rows="4"><?php echo $stud_del->expertise; ?></textarea>
                                                <span id="expertiseErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <p class="form-label">Add Decision Maker Tag:</p>
                                                <input type="checkbox" name="add_expert_tag" id="add_expert_tag" switch="primary" <?php if($stud_del->add_expert_tag == '1'){echo "checked"; } ?> >
                                                <label for="add_expert_tag" data-off-label="No" data-on-label="Yes"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" id="about-submit" class="btn btn-md btn-d waves-effect waves-light buttonText">Update</button>
                                    </div>                                    
                                </form>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- DM Profile Pic Modal -->
<div class="modal fade bs-example-modal-lg" id="dm_profilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel1">Add Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-dm_profilePic"></div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="white-text"><h4>Select Image:</h4></div>
                        <br>
                        <div class="col-md-6">
                        <input type="file" class="form-control" id="upload_Newdm_profilePic">
                        <span style="color: red;" id="dm_profilePic_error"></span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-d upload-dm_profilePicresult">Add</button>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
<script type="text/javascript">
function oldPassword() {
  var x = document.getElementById("old_password");
  var y = document.getElementById("togglePassword1");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function newPassword() {
  var x = document.getElementById("new_password");
  var y = document.getElementById("togglePassword2");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function confPassword() {
  var x = document.getElementById("conf_password");
  var y = document.getElementById("togglePassword3");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}
</script>
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
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- plugin js -->
<script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
<?php
include('footer_links.php');
?>
<script src="<?php echo base_url();?>assets/js/croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/croppie.css">
<script type="text/javascript">
    $uploadCrop1 = $('#upload-ProfileCover').croppie({
        enableExif: true,
        viewport: {
            width: 605,
            height: 210,
            type: 'square'
        },
        boundary: {
            width: 660,
            height: 255
        },
        size1: {
            width: 740,
            height: 250,
            type: 'square'
        }
    });

    $('#upload_NewProfileCover').on('change', function () {

            var allowedFiles = [".png", ".jpeg", ".jpg"];
            var image1 = document.getElementById("upload_NewProfileCover");
            var lblError1 = document.getElementById("profilecover_error");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(image1.value.toLowerCase())) {
                lblError1.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
            else
            {
              lblError1.innerHTML = "";
                 var reader = new FileReader();
        reader.onload = function (e) {
          $uploadCrop1.croppie('bind', {
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
            }
    });

    $('#upload_NewProfileCover').on('click', function () {
      $('.cr-image').attr('src','');
    });

    $('.upload-profileCoverresult').on('click', function (ev) {
        //debugger;
    if((document.getElementById("profilecover_error").innerHTML == "") && (document.getElementById("upload_NewProfileCover").value != ""))
    {
        console.log('yes');
       $uploadCrop1.croppie('result', {
        type: 'canvas',
        size: 'size1'
      }).then(function (resp1) {
           $.ajax({
          url: "front/uploadProfilecover",
          type: "POST",
          data: {"image":resp1},
          success: function (data) {
            window.location.reload();
          }
        }); 
      });
    } 
    else
        {
            $("#profilecover_error").html("Please choose file!");
        } 
    });
</script>
<script type="text/javascript">
    $uploadCrop = $('#upload-Profilepic').croppie({
        enableExif: true,
        viewport: {
            width: 100,
            height: 100,
            type: 'square'
        },
        boundary: {
            width: 130,
            height: 130
        }
    });

    $('#upload_NewProfilepic').on('change', function () { 
      var allowedFiles = [".png", ".jpeg", ".jpg"];
            var image = document.getElementById("upload_NewProfilepic");
            var lblError = document.getElementById("profilepic_error");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(image.value.toLowerCase())) {
                lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
            else{
              lblError.innerHTML = "";
                var reader = new FileReader();
        reader.onload = function (e) {
          $uploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
            }
    });

    $('#upload_NewProfilepic').on('click', function () {
      $('.cr-image').attr('src','');
    });

    $('.upload-profilepicresult').on('click', function (ev) {
      
      if((document.getElementById("profilepic_error").innerHTML == "") && (document.getElementById("upload_NewProfilepic").value != ""))
      {
        $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function (resp) {
    $.ajax({
          url: "front/uploadProfilepic",
          type: "POST",
          data: {"image":resp},
          success: function (data) {
            window.location.reload();
          }
        }); 
      });
      }
      else
        {
            $("#profilepic_error").html("Please choose file!");
        }
    });
</script>
<script type="text/javascript">
    $uploadCrop_dm = $('#upload-dm_profilePic').croppie({
        enableExif: true,
        viewport: {
            width: 250,
            height: 250,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload_Newdm_profilePic').on('change', function () { 
      var allowedFiles_dm = [".png", ".jpeg", ".jpg"];
            var image_dm = document.getElementById("upload_Newdm_profilePic");
            var lblError_dm = document.getElementById("dm_profilePic_error");
            var regex_dm = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles_dm.join('|') + ")$");
            if (!regex_dm.test(image_dm.value.toLowerCase())) {
                lblError_dm.innerHTML = "Please upload files having extensions: <b>" + allowedFiles_dm.join(', ') + "</b> only.";
                return false;
            }
            else{
              lblError_dm.innerHTML = "";
                var reader_dm = new FileReader();
        reader_dm.onload = function (e) {
          $uploadCrop_dm.croppie('bind', {
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader_dm.readAsDataURL(this.files[0]);
            }
    });

    $('#upload_Newdm_profilePic').on('click', function () {
      $('.cr-image_dm').attr('src','');
    });

    $('.upload-dm_profilePicresult').on('click', function (ev) {
      if((document.getElementById("dm_profilePic_error").innerHTML == "") && (document.getElementById("upload_Newdm_profilePic").value != ""))
      {
        $uploadCrop_dm.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp_dm) {
            $('#expert_photo').val(resp_dm); 
            $('#dm_profilePic').modal('hide');
            $('#user-photo').hide();
            $('#dm_user-choosen-photo').html('<img class="img-thumbnail" src="'+resp_dm+'" data-bs-toggle="modal" data-bs-target="#dm_profilePic" title="Change Profile Picture" style="cursor: pointer;">');
            $('#update-dm_profile').modal('show');
        });
      }
      else
      {
        $("#dm_profilePic_error").html("Please choose file!");
      }
    });

    $('#dm_profilePic_form').on('submit',function(event){
        event.preventDefault(); // Stop page from refreshing
        var formData = new FormData(this); 
        $.ajax({
             url:'front/update_expert_profile',
             type:"POST",
             data:formData,
             contentType:false,
             processData:false,
             cache:false,
             success: function(data){
              if (data.status == false)
              {
                //show errors
                $('[id*=Err]').html('');
                $.each(data.errors, function(key, val) {
                    var key =key.replace(/\[]/g, '');
                    key=key+'Err';
                    //console.log(key);    
                    $('#'+ key).html(val);
                })
              }
              else if(data.status == true){
                console.log('set successfully');
                window.location.reload();
              }
              console.log(data); 
           }// success msg ends here

         });
    });

    $('#call_rate_form').on('submit',function(event){
        event.preventDefault(); // Stop page from refreshing
        var formData = new FormData(this); 
        $.ajax({
             url:'front/update_call_rate',
             type:"POST",
             data:formData,
             contentType:false,
             processData:false,
             cache:false,
             success: function(data){
                if(data.status == 'blank'){
                    $('#call_rate_error').html('Please enter atleast one value');
                }
                else if(data.status == false)
                {
                    //show errors
                    $('[id*=Err]').html('');
                    $.each(data.errors, function(key, val) {
                        var key =key.replace(/\[]/g, '');
                        key=key+'Err';
                        //console.log(key);    
                        $('#'+ key).html(val);
                    })
                }
                else if(data.status == true){
                    console.log('set successfully');
                    window.location.reload();
                }
                console.log(data); 
            }// success msg ends here

        });
    });
</script>
    </body>

</html>