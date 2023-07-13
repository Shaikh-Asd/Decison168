<?php
$page = 'update_profile';

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
    <title>Update Profile</title>
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
                        <h4 class="mb-sm-0 font-size-18">Update</h4>
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
                            <li class="nav-item me-2">
                                <!-- <button type="button" class="btn btn-d waves-effect waves-light btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#change_my_passwordModal"><i class="mdi mdi-lock"></i> Change Password</button> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <a class="btn btn-sm btn-d text-white mb-2" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#My_Plan"><i class="bx bx bx-detail"></i> My Plan</a> -->
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
                <div class="card">
                    <div class="card-body">
                       <form method="POST" class="update-profile-form" id="update-profile-form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="bg-primary bg-secondary">
                                        <?php
                                        if(!empty($stud_del->cover_photo)){
                                            ?>
                                        <div class="bg-profile-cover" id="user-cover" style="background-image: url(<?php echo base_url('assets/student_cover_photos/'.$stud_del->cover_photo);?>);background-repeat: no-repeat;background-size: cover;height: 250px;">
                                            <a href="javascript: void(0);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle float-end m-2" data-bs-toggle="modal" data-bs-target="#profileCover" title="Change Cover Picture">
                                                <span class="avatar-title bg-transparent text-reset">
                                                        <i class="bx bx-image-add" style="font-size: 1.2rem;"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <?php
                                        }else{
                                            ?>
                                        <div class="bg-profile-cover" id="user-cover" style="background-image: url(<?php echo base_url('assets/student_cover_photos/cover.jpg');?>);background-repeat: no-repeat;background-size: cover;height: 245px;">
                                            <a href="javascript: void(0);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle float-end m-2" data-bs-toggle="modal" data-bs-target="#profileCover" title="Add Cover Picture">
                                                <span class="avatar-title bg-transparent text-reset">
                                                        <i class="bx bx-image-add" style="font-size: 1.2rem;"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <?php
                                        }
                                        ?>                                        
                                        <div id="user-choosen-cover"></div> 
                                        <input type="hidden" name="cover_photo" id="cover_photo">
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="avatar-md profile-user-wid" id="user-photo">
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
                                                <div id="user-choosen-photo"></div>
                                                <input type="hidden" name="photo" id="photo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-firstname-input" class="form-label">First name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" value="<?php echo $stud_del->first_name;?>" class="form-control" placeholder="Enter first name" title="Enter first name" id="formrow-firstname-input" required="">
                                        <span id="first_nameErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-middlename-input" class="form-label">Middle Name</label>
                                        <input type="text" name="middle_name" value="<?php echo $stud_del->middle_name;?>" class="form-control" placeholder="Enter middle name" title="Enter middle name" id="formrow-middlename-input">
                                        <span id="middle_nameErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-lastname-input" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" value="<?php echo $stud_del->last_name;?>" class="form-control" placeholder="Enter last name" title="Enter last name" id="formrow-lastname-input" required="">
                                        <span id="last_nameErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="formrow-about_me-input" class="form-label">About me</label>
                                        <textarea name="about_me" value="<?php echo $stud_del->about_me;?>" class="form-control" title="Enter about me" placeholder="About me" id="formrow-about_me-input"><?php echo $stud_del->about_me;?></textarea>
                                        <span id="about_meErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-email-input" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email_address" value="<?php echo $stud_del->email_address;?>" class="form-control" title="Email Address cannot be updated" readonly="" placeholder="Enter email address" id="formrow-email-input" required="">
                                        <span id="email_addressErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-designation-input" class="form-label">Designation</label>
                                        <input type="text" name="designation" value="<?php echo $stud_del->designation;?>" class="form-control" placeholder="Enter designation" id="formrow-designation-input">
                                        <span id="designationErr" class="text-danger"></span>
                                    </div>
                                </div>   
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-company-input" class="form-label">Company</label>
                                        <input type="text" name="company" value="<?php echo $stud_del->company;?>" class="form-control" placeholder="Enter company" id="formrow-company-input">
                                        <span id="companyErr" class="text-danger"></span>
                                    </div>
                                </div>                             
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h5 class="font-size-14 mb-2">Gender</h5>
                                        <div class="d-inline-flex">
                                            <div class="form-check form-radio-secondary mr-20">
                                                <input onclick="return showOtherGender(1,this.value);" class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($stud_del->gender == 'male'){ echo 'checked'; } ?>>
                                                <label class="form-check-label" for="male">
                                                Male
                                                </label>
                                            </div>
                                            <div class="form-check form-radio-secondary mr-20">
                                                <input onclick="return showOtherGender(2,this.value);" class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($stud_del->gender == 'female'){ echo 'checked'; } ?>>
                                                <label class="form-check-label" for="female">
                                                Female
                                                </label>
                                            </div>
                                            <div class="form-check form-radio-secondary mr-15">
                                                <input onclick="return showOtherGender(3,this.value);" class="form-check-input" type="radio" name="gender" id="other" value="other" <?php if($stud_del->gender == 'other'){ echo 'checked'; } ?>>
                                                <label class="form-check-label" for="other">
                                                Other
                                                </label>
                                            </div>
                                            <div class="form-check form-radio-secondary">
                                                <input onclick="return showOtherGender(4,this.value);" class="form-check-input" type="radio" name="gender" id="prefer not to say" value="prefer not to say" <?php if($stud_del->gender == 'prefer not to say'){ echo 'checked'; } ?>>
                                                <label class="form-check-label" for="prefer_not">
                                                Prefer not to say 
                                                </label>
                                            </div>
                                        </div>
                                        <span id="genderErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6" id="other_gender" <?php if($stud_del->gender == 'other'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
                                    <div class="mb-4">
                                        <label for="formrow-gender_other-input" class="form-label">Other Gender <span class="text-danger">*</span></label>
                                        <input type="text" name="gender_other" value="<?php echo $stud_del->gender_other;?>" class="form-control" placeholder="Enter other gender" id="formrow-gender_other-input">
                                        <span id="gender_otherErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-country-input" class="form-label">Country</label>
                                        <select name="country" class="form-control select2" id="formrow-country-input">
                                            <option value="">Select Country</option>
                                            <?php
                                            if($country){
                                                foreach ($country as $cnty) {
                                                    ?><option <?php if($cnty->country_code == $stud_del->country){ echo 'selected'; } ?> value="<?php echo $cnty->country_code;?>"><?php echo $cnty->country_name;?></option><?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="countryErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-phone-input" class="form-label">Phone Number <small class="text-secondary">(only numbers)</small></label>
                                        <input type="text" name="phone_number" value="<?php echo $stud_del->phone_number;?>" class="form-control" placeholder="Enter phone number" id="formrow-phone-input">
                                        <span id="phone_numberErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-dob-input" class="form-label">DOB</label>
                                        <?php
                                        if($stud_del->dob != '0000-00-00')
                                        {
                                        ?>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" name="dob" value="<?php echo $stud_del->dob;?>" title="Enter Date of birth" class="form-control" placeholder="yyyy-m-d" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                        <span id="dobErr" class="text-danger"></span>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" name="dob" title="Enter Date of birth" class="form-control" placeholder="yyyy-m-d" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                        <span id="dobErr" class="text-danger"></span>
                                        <?php
                                        }
                                        ?>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label font-size-16">Add Social Media Links : &nbsp;<span style="font-size: 20px; color: #23211ea1; cursor: pointer;" class="fa fa-plus-circle add_social_media" title="Add more"></span></label>
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="social_media_wrapper">
                                <?php
                                if($stud_del->social_media != ""){
                                    $social_media_icon = explode(',', $stud_del->social_media_icon);
                                    $social_media = explode(',', $stud_del->social_media);
                                    $count = count($social_media);                                   
                                    if($count > 0){
                                        $smcnt=1;
                                        for ($i=0; $i<$count; $i++)
                                        {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-4 templating-select">
                                                        <label class="form-label">Select Icon</label>
                                                        <select class="form-control select2-templating" name="social_media_icon[]" required="">
                                                            <option value="">Choose one</option>
                                                            <option <?php if($social_media_icon[$i] == 'Behance'){ echo 'selected'; } ?> value="Behance">Behance</option>
                                                            <option <?php if($social_media_icon[$i] == 'Dribbble'){ echo 'selected'; } ?> value="Dribbble">Dribbble</option>
                                                            <option <?php if($social_media_icon[$i] == 'Facebook'){ echo 'selected'; } ?> value="Facebook">Facebook</option>
                                                            <option <?php if($social_media_icon[$i] == 'Instagram'){ echo 'selected'; } ?> value="Instagram">Instagram</option>
                                                            <option <?php if($social_media_icon[$i] == 'LinkedIn'){ echo 'selected'; } ?> value="LinkedIn">LinkedIn</option>
                                                            <option <?php if($social_media_icon[$i] == 'Medium'){ echo 'selected'; } ?> value="Medium">Medium</option>
                                                            <option <?php if($social_media_icon[$i] == 'Pinterest'){ echo 'selected'; } ?> value="Pinterest">Pinterest</option>
                                                            <option <?php if($social_media_icon[$i] == 'Reddit'){ echo 'selected'; } ?> value="Reddit">Reddit</option>
                                                            <option <?php if($social_media_icon[$i] == 'Slack'){ echo 'selected'; } ?> value="Slack">Slack</option>
                                                            <option <?php if($social_media_icon[$i] == 'Snapchat'){ echo 'selected'; } ?> value="Snapchat">Snapchat</option>
                                                            <option <?php if($social_media_icon[$i] == 'Tumblr'){ echo 'selected'; } ?> value="Tumblr">Tumblr</option>
                                                            <option <?php if($social_media_icon[$i] == 'Twitch'){ echo 'selected'; } ?> value="Twitch">Twitch</option>
                                                            <option <?php if($social_media_icon[$i] == 'Twitter'){ echo 'selected'; } ?> value="Twitter">Twitter</option>
                                                            <option <?php if($social_media_icon[$i] == 'Vimeo'){ echo 'selected'; } ?> value="Vimeo">Vimeo</option>
                                                            <option <?php if($social_media_icon[$i] == 'WhatsApp'){ echo 'selected'; } ?> value="WhatsApp">WhatsApp</option>
                                                            <option <?php if($social_media_icon[$i] == 'YouTube'){ echo 'selected'; } ?> value="YouTube">YouTube</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">Link</label>
                                                        <div class="input-group">          
                                                            <input type="text" name="social_media[]" value="<?php echo $social_media[$i];?>" class="form-control" placeholder="Enter Link" required="">
                                                            <div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_social_media" title="Remove"></div>
                                                        </div>                                       
                                                    </div>
                                                </div>                                
                                            </div>
                                            <?php
                                            $smcnt++;
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <span id="social_mediaErr" class="text-danger"></span>
                            <?php   
                            if($stud_del->expert_approve == 1){ 
                                ?>  
                                <div class="row">   
                                    <div class="col-md-12"> 
                                        <div class="mb-4">  
                                            <label for="formrow-expertise-input" class="form-label">Describe your expertise:</label>    
                                            <textarea class="form-control" placeholder="Expertise *" name="expertise" required="" rows="8"><?php echo $stud_del->expertise; ?></textarea>   
                                            <span id="expertiseErr" class="text-danger"></span> 
                                        </div>  
                                    </div>  
                                </div>  
                                <?php   
                            }   
                            ?>
                            <div>
                                <button type="submit" class="btn btn-sm btn-d w-md">Save Changes</button>
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-3">
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
                            <p style="cursor: pointer;color: #383838;" data-bs-toggle="modal" data-bs-target="#change_my_passwordModal"><i class="mdi mdi-lock h5"></i> Change Password </p>
                            <hr>
                            <p style="cursor: pointer;color: #383838;" data-bs-toggle="modal" data-bs-target="#My_Plan"><i class="bx bx bx-detail h5"></i> My Plan</p>
                            <?php
                            if(!empty($this->session->userdata('d168_user_cor_id')))
                            {
                                if(empty($stud_del->personal_acc_created))
                                {
                            ?>
                                <hr>
                                <p style="cursor: pointer;color: #383838;" onclick="create_personal_account();"><i class="mdi mdi-account h5"></i> Create Personal Account</p>
                            <?php 
                                }
                                else
                                {
                                    ?>
                                    <hr>
                                    <p style="cursor: pointer;color: #383838;" onclick="switch_to_personal_account();"><i class="mdi mdi-account h5"></i> Switch To Personal Account</p>
                                    <?php
                                }
                            }  
                            if(($stud_del->expert == 1) && ($stud_del->expert_approve == 1)){   
                                ?>  
                                <hr>    
                                <p style="cursor: pointer;color: #383838;font-size: 13px;" data-bs-toggle="modal" data-bs-target="#update-dm_profile"><i class="bx bxs-user-rectangle"></i> Update Decision Maker Profile </p>  
                                <hr>    
                                <p style="cursor: pointer;color: #383838;font-size: 13px;" data-bs-toggle="modal" data-bs-target="#update-call_rate"><i class="bx bxs-video-plus"></i> Update Call Rate</p> 
                                <?php   
                            } 
                            ?>                           
                        </div>
                    </div>
                </div>
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
<?php
include('footer.php');
?>
   </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- Profile Cover Modal -->
<div class="modal fade" id="profileCover" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Cover Picture</h5>
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
                <button type="button" class="btn btn-sm btn-d upload-profileCoverresult">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Profile Pic Modal -->
<div class="modal fade" id="profilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Profile Picture</h5>
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
                <button type="button" class="btn btn-sm btn-d upload-profilepicresult">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- My Plan Modal -->
<div class="modal fade bs-example-modal-lg" id="My_Plan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">My Plan Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row m-4">
                <div class="col-12">
                    <?php
                    $myPlan = $this->Front_model->getEmailID($this->session->userdata('d168_id'));
                    if($myPlan)
                    {
                        //if($myPlan->payment_status == "refund" || $myPlan->payment_status == "refund_succeeded")
                        if($myPlan->refund_status == "refund")
                        {
                    ?>
                    <div class="alert alert-warning" role="alert">
                       <?php
                       if($myPlan->refund_status == "refund")
                        {
                            $oldplan = $this->Front_model->getPackDetail($myPlan->old_package);
                            if($oldplan)
                            {
                                echo "Refund of <strong>".$oldplan->pack_name."</strong> Package is in Process and <strong>Paid Amount</strong> will be credit with in <strong>5 Working Days</strong>!";
                            }
                            else
                            {
                                echo "Refund of <strong>Previous</strong> Package is in Process and <strong>Paid Amount</strong> will be credit with in <strong>5 Working Days</strong>!";
                            }
                        } 
                        // elseif($myPlan->payment_status == "refund_succeeded")
                        // {
                        //     echo "Refund is Successful and Please check your account! Refund Amount: $".$myPlan->refund_amount;
                        // }
                       ?>
                    </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered border-success mb-0">
                            <thead>
                                <tr>
                                    <th>Current Package</th>
                                    <th>Package Price</th>
                                    <!-- <th>Balance Amount <span class="text-danger">(* If Any)</span></th> -->
                                    <th>Amount Paid</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <!-- <th>Auto Renew</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $myPlan_detail = $this->Front_model->getPackDetail($myPlan->package_id);
                                if($myPlan_detail) 
                                {
                                ?>
                                <tr>
                                    <td><?php echo $myPlan_detail->pack_name;?></td>
                                    <td><?php echo '$ '.$myPlan_detail->pack_price;?></td>
                                    <!-- <td><?php if(!empty($myPlan->balance_amount)){ echo '$ '.$myPlan->balance_amount;}?></td> -->
                                    <td><?php if(!empty($myPlan->paid_amount)){ echo '$ '.$myPlan->paid_amount;} else { echo "---";}?></td>
                                    <td><?php echo date('dS M Y g:i A',strtotime($myPlan->package_start));?></td>
                                    <td><?php if(DateTime::createFromFormat('Y-m-d H:i:s', $myPlan->package_expiry) !== false)
                                        {
                                            echo date('dS M Y g:i A',strtotime($myPlan->package_expiry));
                                        }
                                        else
                                        {
                                            echo '---';
                                        }?></td>
                                    <!-- <td><?php 
                                    if(DateTime::createFromFormat('Y-m-d H:i:s', $myPlan->package_expiry) !== false)
                                    {
                                    if($myPlan->renew == "auto")
                                    {
                                        ?>
                                        <div>
                                            <input type="checkbox" id="switch1" switch="none" checked="" onclick="return turn_off_auto_renew();">
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div>
                                            <input type="checkbox" id="switch1" switch="none" onclick="return turn_on_auto_renew();">
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <?php
                                    }
                                    }
                                    else
                                    {
                                        echo '---';
                                    }
                                    ?></td> -->
                                </tr>
                                <?php
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
<!-- My Credit Card Modal -->
<div class="modal fade" id="My_Card_Detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">My Credit Card Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    $myccd = $this->Front_model->getEmailID($this->session->userdata('d168_id'));
                    if($myccd)
                    {
                        if($myccd->package_id != '1')
                        {
                    ?>
                    <form method="POST" name="my_update_ccd" id="my_update_ccd" autocomplete="off">
                    <div class="modal-body">
                        <div class="row m-2">
                            <div class="form-group mb-4">
                                <label for="tname" class="col-form-label">CARD NUMBER <span class="text-danger">*</span></label>
                                <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" class="form-control" value="<?php if($myccd) { echo "$myccd->card_number";}?>" required="">
                                <span id="card_numberErr" class="text-danger"></span>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <label>EXPIRY DATE <span class="text-danger">*</span></label>
                                            <div class="col">
                                                <input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" class="form-control" value="<?php if($myccd) { echo "$myccd->card_exp_month";}?>" required="">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" class="form-control" value="<?php if($myccd) { echo "$myccd->card_exp_year";}?>" required="">
                                            </div>
                                            <span id="card_exp_monthErr" class="text-danger"></span>
                                            <span id="card_exp_yearErr" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                        <label>CVC CODE <span class="text-danger">*</span></label>
                                        <input type="text" name="card_cvc" id="card_cvc" class="form-control" placeholder="CVC" autocomplete="off" value="<?php if($myccd) { echo base64_decode($myccd->card_cvc);}?>" required="">
                                        <span id="card_cvcErr" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                <button class="btn btn-d btn-sm waves-effect waves-light" id="my_update_ccd_but" type="submit">Save</button>
                                <button type="button" class="btn btn-sm bg-d text-white ms-1" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                    }
                    else
                    {
                        ?>
                        <div class="modal-body">
                            <div class="row m-2">
                                <div class="form-group mb-4">
                                     Solo Pack Selected! Its <strong>Free Forever</strong>!
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } 
                ?>
                </div>
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
       $uploadCrop1.croppie('result', {
        type: 'canvas',
        size: 'size1'
      }).then(function (resp1) {
           $('#cover_photo').val(resp1); 
           $('#profileCover').modal('hide');
           $('#user-cover').hide();
           $('#user-choosen-cover').css('background-image', 'url(' + resp1 + ')').css('background-repeat', 'no-repeat').css('background-size', '100%').height('250px');
           $('#user-choosen-cover').html('<a href="javascript: void(0);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle float-end m-2" data-bs-toggle="modal" data-bs-target="#profileCover" title="Change Cover Picture"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-image-add" style="font-size: 1.2rem;"></i></span></a>');
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
        $('#photo').val(resp); 
        $('#profilePic').modal('hide');
        $('#user-photo').hide();
        $('#user-choosen-photo').html('<div class="avatar-md profile-user-wid"><img class="img-thumbnail rounded-circle avatar-md" src="'+resp+'" data-bs-toggle="modal" data-bs-target="#profilePic" title="Change Profile Picture" style="cursor: pointer;"></div>');
      });
      }
      else
      {
        $("#profilepic_error").html("Please choose file!");
      }
    });
</script>
<script type="text/javascript">
    // function readphotoURL(input) {
    //     if (input.files && input.files[0])
    //     {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('#user-choosen-photo')
    //                 .attr('src', e.target.result)
    //                 .width('100px');
    //         };
    //         reader.readAsDataURL(input.files[0]);

    //         $('#user-choosen-photo').show();
    //         $('#user-photo').hide();
    //         $('#user-photo-name').hide();
    //     }
    //     else
    //     {
    //         $('#user-choosen-photo').hide();
    //         $('#user-photo').show();
    //         $('#user-photo-name').show();
    //     }
    // }

    // function readcoverURL(input) {
    //     if (input.files && input.files[0])
    //     {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('#user-choosen-cover')
    //                 .css('background-image', 'url(' + e.target.result + ')')
    //                 .css('background-repeat', 'no-repeat')
    //                 .css('background-size', '100%')
    //                 .height('250px');
                    
    //         };
    //         reader.readAsDataURL(input.files[0]);

    //         $('#user-choosen-cover').show();
    //         $('#user-cover').hide();
    //         $('#user-cover-name').hide();
    //     }
    //     else
    //     {
    //         $('#user-choosen-cover').hide();
    //         $('#user-cover').show();
    //         $('#user-cover-name').show();
    //     }
    // }

    function showOtherGender(cnt,val){
        if (val == 'other') 
        {
            $("#other_gender").css("display","block");
            $("#formrow-gender_other-input").prop('required',true);
        }
        else
        {
            $("#other_gender").css("display","none");
            $("#formrow-gender_other-input").val('');
            $("#formrow-gender_other-input").prop('required',false);
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var add_social_media = $('.add_social_media'); //Add button selector
        var social_media_wrapper = $('.social_media_wrapper'); //Input field wrapper
        var social_mediaHTML = '<div class="row"><div class="col-md-6"><div class="mb-4 templating-select"><label class="form-label">Select Icon</label><select class="form-control select2-templating1" name="social_media_icon[]" required=""><option value="">Choose one</option><option value="Behance">Behance</option><option value="Dribbble">Dribbble</option><option value="Facebook">Facebook</option><option value="Instagram">Instagram</option><option value="LinkedIn">linkedIn</option><option value="Medium">Medium</option><option value="Pinterest">Pinterest</option><option value="Reddit">Reddit</option><option value="Slack">Slack</option><option value="Snapchat">Snapchat</option><option value="Tumblr">Tumblr</option><option value="Twitch">Twitch</option><option value="Twitter">Twitter</option><option value="Vimeo">Vimeo</option><option value="WhatsApp">WhatsApp</option><option value="YouTube">YouTube</option></select></div></div><div class="col-md-6"><div class="mb-4"><label class="form-label">Link</label><div class="input-group"><input type="text" name="social_media[]" class="form-control" placeholder="Enter Link" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_social_media" title="Remove"></div></div></div></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(add_social_media).click(function(){
                $(social_media_wrapper).prepend(social_mediaHTML); //Add field html
                function formatState1(state) {
                  if (!state.id) {
                    return state.text;
                  }
                  // var baseUrl = "./assets/images/icons";
                  // var $state = $(
                  //   '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
                  // );
                  var $state = $(
                    '<span><i class="fab fa-'+ state.element.value.toLowerCase() +' h3 social-d"></i> ' + state.text + '</span>'
                  );
                  return $state;
                };
                $(".select2-templating1").select2({
                  templateResult: formatState1
                });
        });
        
        //Once remove button is clicked
        $(social_media_wrapper).on('click', '.remove_social_media', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<script type="text/javascript">
    $uploadCrop3 = $('#upload-dm_profilePic').croppie({
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
      var allowedFiles3 = [".png", ".jpeg", ".jpg"];
            var image3 = document.getElementById("upload_Newdm_profilePic");
            var lblError3 = document.getElementById("dm_profilePic_error");
            var regex3 = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles3.join('|') + ")$");
            if (!regex3.test(image3.value.toLowerCase())) {
                lblError3.innerHTML = "Please upload files having extensions: <b>" + allowedFiles3.join(', ') + "</b> only.";
                return false;
            }
            else{
              lblError3.innerHTML = "";
                var reader3 = new FileReader();
        reader3.onload = function (e) {
          $uploadCrop3.croppie('bind', {
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader3.readAsDataURL(this.files[0]);
            }
    });

    $('#upload_Newdm_profilePic').on('click', function () {
      $('.cr-image3').attr('src','');
    });

    $('.upload-dm_profilePicresult').on('click', function (ev) {
      if((document.getElementById("dm_profilePic_error").innerHTML == "") && (document.getElementById("upload_Newdm_profilePic").value != ""))
      {
        $uploadCrop3.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp3) {
            $('#expert_photo').val(resp3); 
            $('#dm_profilePic').modal('hide');
            $('#user-photo').hide();
            $('#dm_user-choosen-photo').html('<img class="img-thumbnail" src="'+resp3+'" data-bs-toggle="modal" data-bs-target="#dm_profilePic" title="Change Profile Picture" style="cursor: pointer;">');
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