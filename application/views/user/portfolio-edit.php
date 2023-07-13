<?php
$page = 'portfolio';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="utf-8" />
    <title>Portfolio Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<?php
include('header_links.php');
?>
    </head>

    <body onload="return show_selected_user();" data-sidebar="dark">
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
                        <h4 class="mb-sm-0 font-size-18">Edit</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Portfolio</a></li> -->
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
if($getp)
{
?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <form method="POST" class="EditPortfolioForm" id="EditPortfolioForm" name="EditPortfolioForm" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="c_id" id="c_id" value="<?php echo $getp->portfolio_id;?>">
                        <input type="hidden" name="old_photo" id="old_photo" value="<?php echo $getp->photo;?>">
                        <input type="hidden" name="cover_old_photo" id="cover_old_photo" value="<?php echo $getp->cover_photo;?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="formrow-client-input" class="form-label">Portfolio Type <span class="text-danger">*</span></label>
                                        <select name="portfolio_user" class="form-control" id="portfolio_user" onchange="return show_selected_user();" required="" style="line-height: 1.2;">
                                            <!-- <option value="">Select Portfolio Type</option> -->
                                            <option value="company" <?php if($getp->portfolio_user == "company"){ echo 'selected'; } ?>>Company</option>
                                            <option value="individual" <?php if($getp->portfolio_user == "individual"){ echo 'selected'; } ?>>Individual</option>
                                        </select>
                                        <span id="portfolio_userErr" class="text-danger clear_span_err"></span>
                                    </div>
                                </div>                                
                            </div>

                            <!-- Company Div Start -->
                            <div class="portfolio_user_company_div" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" name="portfolio_name" class="form-control" placeholder="Enter Company Name" title="Enter Company name" id="portfolio_name" value="<?php echo $getp->portfolio_name;?>">
                                            <span id="portfolio_nameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-about_me-input" class="form-label">About Company</label>
                                            <textarea name="about_portfolio" class="form-control" title="Enter about company" placeholder="About Company" id="about_portfolio" value="<?php echo $getp->about_portfolio;?>"><?php echo $getp->about_portfolio;?></textarea>
                                            <span id="about_portfolioErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_fname" class="form-control" placeholder="Enter First Name" title="Enter First Name" id="contact_fname" value="<?php echo $getp->contact_fname;?>">
                                            <span id="contact_fnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person Middle Name </label>
                                            <input type="text" name="contact_mname" class="form-control" placeholder="Enter Middle Name" title="Enter Middle Name" id="contact_mname" value="<?php echo $getp->contact_mname;?>">
                                            <span id="contact_mnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_lname" class="form-control" placeholder="Enter Last Name" title="Enter Last Name" id="contact_lname" value="<?php echo $getp->contact_lname;?>">
                                            <span id="contact_lnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Contact Person Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_phone_number" class="form-control" placeholder="Enter phone number" id="contact_phone_number" value="<?php echo $getp->contact_phone_number;?>">
                                            <span id="contact_phone_numberErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-email-input" class="form-label">Company Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email_address" class="form-control" title="Email Address cannot be updated" placeholder="Enter email address" id="email_address" value="<?php echo $getp->email_address;?>">
                                            <span id="email_addressErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Company Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" id="phone_number" value="<?php echo $getp->phone_number;?>">
                                            <span id="phone_numberErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Company Website <span class="text-danger">*</span></label>
                                            <input type="text" name="company_website" class="form-control" placeholder="Enter Website" id="company_website" value="<?php echo $getp->company_website;?>">
                                            <span id="company_websiteErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Street</label>
                                            <input type="text" name="street" class="form-control" placeholder="Enter street" id="street" value="<?php echo $getp->street;?>">
                                            <span id="streetErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="Enter city" id="city" value="<?php echo $getp->city;?>">
                                            <span id="cityErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Enter state" id="state" value="<?php echo $getp->state;?>">
                                            <span id="stateErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-country-input" class="form-label">Country</label>
                                            <select name="country" class="form-control select2" id="country">
                                                <option value="">Select Country</option>
                                                <?php
                                                if($country){
                                                    foreach ($country as $cnty) {
                                                        ?><option value="<?php echo $cnty->country_code;?>" <?php if($cnty->country_code == $getp->country){ echo 'selected'; } ?>><?php echo $cnty->country_name;?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span id="countryErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profilePic" title="Add / Change Company Logo"><i class="fa fa-camera"></i> Add / Change Company Logo</a>
                                            <input type="hidden" name="photo" id="photo">
                                            <span id="photoErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label id="user-photo-name" class="form-label font-weight-semibold"></label>
                                            <?php
                                            if(!empty($getp->photo)){
                                                ?><img class="profile-photo" id="user-photo" src="<?php echo base_url('assets/portfolio_photos/'.$getp->photo);?>"><?php
                                            }else{
                                                ?><img class="profile-photo" id="user-photo" src="<?php echo base_url('assets/portfolio_photos/user-1.png');?>"><?php
                                            }
                                            ?>
                                            <img class="profile-photo" id="user-choosen-photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profileCover" title="Add / Change Cover Picture"><i class="fa fa-camera"></i> Add / Change Cover Picture</a>
                                            <input type="hidden" name="cover_photo" id="cover_photo">
                                            <span id="cover_photoErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-4">
                                            <label id="user-cover-name" class="form-label"></label>
                                            <?php
                                            if(!empty($getp->cover_photo)){
                                                ?><div class="bg-profile-cover" id="user-cover" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/'.$getp->cover_photo);?>);background-repeat: no-repeat;background-size: 100%;height: 250px;"></div><?php
                                            }else{
                                                ?><div class="bg-profile-cover" id="user-cover" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/cover.jpg');?>);background-repeat: no-repeat;background-size: 100%;height: 250px;"></div><?php
                                            }
                                            ?>                                        
                                            <div id="user-choosen-cover"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Company Div End -->

                        <!-- Individual Div Start -->
                        <div class="portfolio_user_individual_div" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="portfolio_name2" class="form-control" placeholder="Enter First Name" title="Enter First Name" id="portfolio_name2" value="<?php echo $getp->portfolio_name;?>">
                                            <span id="portfolio_name2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Middle Name </label>
                                            <input type="text" name="portfolio_mname2" class="form-control" placeholder="Enter Middle Name" title="Enter Middle Name" id="portfolio_mname2" value="<?php echo $getp->portfolio_mname;?>">
                                            <span id="portfolio_mname2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="portfolio_lname2" class="form-control" placeholder="Enter Last Name" title="Enter Last Name" id="portfolio_lname2" value="<?php echo $getp->portfolio_lname;?>">
                                            <span id="portfolio_lname2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-about_me-input" class="form-label">About Individual</label>
                                            <textarea name="about_portfolio2" class="form-control" title="Enter about individual" placeholder="About Individual" id="about_portfolio2" value="<?php echo $getp->about_portfolio;?>"><?php echo $getp->about_portfolio;?></textarea>
                                            <span id="about_portfolio2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number2" class="form-control" placeholder="Enter phone number" id="phone_number2" value="<?php echo $getp->phone_number;?>">
                                            <span id="phone_number2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-email-input" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email_address2" class="form-control" title="Email Address cannot be updated" placeholder="Enter email address" id="email_address2" value="<?php echo $getp->email_address;?>">
                                            <span id="email_address2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-designation-input" class="form-label">Designation </label>
                                            <input type="text" name="designation2" class="form-control" placeholder="Enter designation" id="designation2" value="<?php echo $getp->designation;?>">
                                            <span id="designation2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-designation-input" class="form-label">Company </label>
                                            <input type="text" name="company_individual2" class="form-control" placeholder="Enter Company Name" id="company_individual2" value="<?php echo $getp->company_individual;?>">
                                            <span id="company_individual2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>                               
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <h5 class="font-size-14 mb-2">Gender</h5>
                                            <div class="d-inline-flex">
                                                <div class="form-check form-radio-secondary mr-20">
                                                    <input onclick="return showOtherGender(1,this.value);" class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($getp->gender == 'male'){ echo 'checked'; } ?>>
                                                    <label class="form-check-label" for="male">
                                                    Male
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary mr-20">
                                                    <input onclick="return showOtherGender(2,this.value);" class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($getp->gender == 'female'){ echo 'checked'; } ?>>
                                                    <label class="form-check-label" for="female">
                                                    Female
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary mr-15">
                                                    <input onclick="return showOtherGender(3,this.value);" class="form-check-input" type="radio" name="gender" id="other" value="other" <?php if($getp->gender == 'other'){ echo 'checked'; } ?>>
                                                    <label class="form-check-label" for="other">
                                                    Other
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary">
                                                    <input onclick="return showOtherGender(4,this.value);" class="form-check-input" type="radio" name="gender" id="prefer_not" value="prefer not to say"<?php if($getp->gender == 'prefer not to say'){ echo 'checked'; } ?>>
                                                    <label class="form-check-label" for="prefer_not">
                                                    Prefer not to say 
                                                    </label>
                                                </div>
                                            </div>
                                            <span id="genderErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="other_gender" <?php if($getp->gender == 'other'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
                                        <div class="mb-4">
                                            <label for="formrow-gender_other-input" class="form-label">Other Gender</label>
                                            <input type="text" name="gender_other" value="<?php echo $getp->gender_other;?>" class="form-control" placeholder="Enter other gender" id="formrow-gender_other-input">
                                            <span id="gender_otherErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Street</label>
                                            <input type="text" name="street2" class="form-control" placeholder="Enter street" id="street2" value="<?php echo $getp->street;?>">
                                            <span id="street2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">City</label>
                                            <input type="text" name="city2" class="form-control" placeholder="Enter city" id="city2" value="<?php echo $getp->city;?>">
                                            <span id="city2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">State</label>
                                            <input type="text" name="state2" class="form-control" placeholder="Enter state" id="state2" value="<?php echo $getp->state;?>">
                                            <span id="state2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-country-input" class="form-label">Country</label>
                                            <select name="country2" class="form-control select2" id="country2">
                                                <option value="">Select Country</option>
                                                <?php
                                                if($country){
                                                    foreach ($country as $cnty) {
                                                        ?><option value="<?php echo $cnty->country_code;?>" <?php if($cnty->country_code == $getp->country){ echo 'selected'; } ?>><?php echo $cnty->country_name;?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span id="country2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profilePic2" title="Add / Change Profile Picture"><i class="fa fa-camera"></i> Add / Change Profile Picture</a>
                                            <input type="hidden" name="photo2" id="photo2">
                                            <span id="photo2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label id="user-photo-name2" class="form-label font-weight-semibold"></label>
                                            <?php
                                            if(!empty($getp->photo)){
                                                ?><img class="profile-photo" id="user-photo2" src="<?php echo base_url('assets/portfolio_photos/'.$getp->photo);?>"><?php
                                            }else{
                                                ?><img class="profile-photo" id="user-photo2" src="<?php echo base_url('assets/portfolio_photos/user-1.png');?>"><?php
                                            }
                                            ?>
                                            <img class="profile-photo" id="user-choosen-photo2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profileCover2" title="Add / Change Cover Picture"><i class="fa fa-camera"></i> Add / Change Cover Picture</a>
                                            <input type="hidden" name="cover_photo2" id="cover_photo2">
                                            <span id="cover_photo2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-4">
                                            <label id="user-cover-name2" class="form-label"></label>
                                            <?php
                                            if(!empty($getp->cover_photo)){
                                                ?><div class="bg-profile-cover" id="user-cover2" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/'.$getp->cover_photo);?>);background-repeat: no-repeat;background-size: 100%;height: 250px;"></div><?php
                                            }else{
                                                ?><div class="bg-profile-cover" id="user-cover2" style="background-image: url(<?php echo base_url('assets/portfolio_cover_photos/cover.jpg');?>);background-repeat: no-repeat;background-size: 100%;height: 250px;"></div><?php
                                            }
                                            ?>                                        
                                            <div id="user-choosen-cover2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Individual Div End -->
                            <div class="common_div" style="display: none;">          
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label class="form-label font-size-16">Add Department : &nbsp;<span style="font-size: 20px; color: #23211ea1; cursor: pointer;" class="fa fa-plus-circle add_dept" title="Add more"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="dept_wrapper">
                                               
                                </div>  -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label font-size-16">Add Social Media Links : &nbsp;<span style="font-size: 20px; color: #23211ea1; cursor: pointer;" class="fa fa-plus-circle add_social_media" title="Add more"></span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="social_media_wrapper">
                               <?php
                                if($getp->social_media != ""){
                                    $social_media_icon = explode(',', $getp->social_media_icon);
                                    $social_media = explode(',', $getp->social_media);
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
                                                            <input type="url" name="social_media[]" value="<?php echo $social_media[$i];?>" class="form-control" placeholder="Enter Link" required="">
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
                            <span id="social_mediaErr" class="text-danger clear_span_err"></span>
                            </div>
                            <div>
                                <button type="submit" id="EditPortfolioButton" class="btn btn-sm btn-d btn-d">Save Changes</button>
                                <img id="cloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->

    </div> 

    <div style='clear:both'></div>

            </div>
        </div>
        <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?php
}
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
<!-- Profile Cover 2 Modal -->
<div class="modal fade" id="profileCover2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Cover Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-ProfileCover2"></div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="white-text"><h4>Select Image:</h4></div>
                        <br>
                        <div class="col-md-6">
                        <input type="file" class="form-control" id="upload_NewProfileCover2">
                        <span style="color: red;" id="profilecover_error2"></span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-d upload-profileCoverresult2">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Profile Pic 2 Modal -->
<div class="modal fade" id="profilePic2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-Profilepic2"></div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="white-text"><h4>Select Image:</h4></div>
                        <br>
                        <div class="col-md-6">
                        <input type="file" class="form-control" id="upload_NewProfilepic2">
                        <span style="color: red;" id="profilepic_error2"></span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-d upload-profilepicresult2">Add</button>
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
    $('#user-choosen-photo').attr('src', resp).width('100px');
  });
  }
  else
    {
        $("#profilepic_error").html("Please choose file!");
    }
});
</script>
<script type="text/javascript">
$uploadCrop12 = $('#upload-ProfileCover2').croppie({
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

$('#upload_NewProfileCover2').on('change', function () {

        var allowedFiles = [".png", ".jpeg", ".jpg"];
        var image12 = document.getElementById("upload_NewProfileCover2");
        var lblError12 = document.getElementById("profilecover_error2");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(image12.value.toLowerCase())) {
            lblError12.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
            return false;
        }
        else
        {
          lblError12.innerHTML = "";
             var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop12.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
        }
});

$('#upload_NewProfileCover2').on('click', function () {
  $('.cr-image').attr('src','');
});

$('.upload-profileCoverresult2').on('click', function (ev) {
    //debugger;
if((document.getElementById("profilecover_error2").innerHTML == "") && (document.getElementById("upload_NewProfileCover2").value != ""))
{
   $uploadCrop12.croppie('result', {
    type: 'canvas',
    size: 'size1'
  }).then(function (resp1) {
       $('#cover_photo2').val(resp1); 
       $('#profileCover2').modal('hide');
       $('#user-cover2').hide();
       $('#user-choosen-cover2').css('background-image', 'url(' + resp1 + ')').css('background-repeat', 'no-repeat').css('background-size', '100%').height('250px');
  });
}
else
    {
        $("#profilecover_error2").html("Please choose file!");
    } 
});
</script>
<script type="text/javascript">
$uploadCrop2 = $('#upload-Profilepic2').croppie({
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

$('#upload_NewProfilepic2').on('change', function () { 
  var allowedFiles = [".png", ".jpeg", ".jpg"];
        var image2 = document.getElementById("upload_NewProfilepic2");
        var lblError2 = document.getElementById("profilepic_error2");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(image2.value.toLowerCase())) {
            lblError2.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
            return false;
        }
        else{
          lblError2.innerHTML = "";
            var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop2.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
        }
});

$('#upload_NewProfilepic2').on('click', function () {
  $('.cr-image').attr('src','');
});

$('.upload-profilepicresult2').on('click', function (ev) {
  
  if((document.getElementById("profilepic_error2").innerHTML == "") && (document.getElementById("upload_NewProfilepic2").value != ""))
  {
    $uploadCrop2.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
    console.log(resp);
    $('#photo2').val(resp); 
    $('#profilePic2').modal('hide');
    $('#user-photo2').hide();
    $('#user-choosen-photo2').attr('src', resp).width('100px');
  });
  }
  else
    {
        $("#profilepic_error2").html("Please choose file!");
    } 
});
</script>
<script type="text/javascript">
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

// function readcoverURL2(input) {
//     if (input.files && input.files[0])
//     {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#user-choosen-cover2')
//                 .css('background-image', 'url(' + e.target.result + ')')
//                 .css('background-repeat', 'no-repeat')
//                 .css('background-size', '100%')
//                 .height('250px');
                
//         };
//         reader.readAsDataURL(input.files[0]);

//         $('#user-choosen-cover2').show();
//         $('#user-cover2').hide();
//         $('#user-cover-name2').hide();
//     }
//     else
//     {
//         $('#user-choosen-cover2').hide();
//         $('#user-cover2').show();
//         $('#user-cover-name2').show();
//     }
// }

// function readURL(input) {
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

// function readURL2(input) {
//     if (input.files && input.files[0])
//     {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#user-choosen-photo2')
//                 .attr('src', e.target.result)
//                 .width('100px');
//         };
//         reader.readAsDataURL(input.files[0]);

//         $('#user-choosen-photo2').show();
//         $('#user-photo2').hide();
//         $('#user-photo-name2').hide();
//     }
//     else
//     {
//         $('#user-choosen-photo2').hide();
//         $('#user-photo2').show();
//         $('#user-photo-name2').show();
//     }
// }

function showOtherGender(cnt,val){
    if (val == 'other') 
    {
        $("#other_gender").css("display","block");
        $("#gender_other").prop('required',true);
    }
    else
    {
        $("#other_gender").css("display","none");
        $("#gender_other").val('');
        $("#gender_other").prop('required',false);
    }
}

function show_selected_user()
{
    if($('#portfolio_user').val() == 'company')
    {
        $(".portfolio_user_company_div").css("display","block");
        $(".portfolio_user_individual_div").css("display","none");
        $(".clear_span_err").html('');
        $(".common_div").css("display","block");
    }
    else if($('#portfolio_user').val() == 'individual')
    {
        $(".portfolio_user_company_div").css("display","none");
        $(".portfolio_user_individual_div").css("display","block");
        $(".clear_span_err").html('');
        $(".common_div").css("display","block");
    }
    else
    {
        $(".portfolio_user_company_div").css("display","none");
        $(".portfolio_user_individual_div").css("display","none");
        $(".clear_span_err").html('');
        $(".common_div").css("display","none");
    }
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    //ADD DEPARTMENT
    // var add_dept = $('.add_dept'); //Add button selector
    // var dept_wrapper = $('.dept_wrapper'); //Input field wrapper
    // var deptHTML = '<div class="row"><div class="col-md-6"><div class="mb-4"><div class="input-group"><input type="text" name="department[]" class="form-control" placeholder="Enter Department" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_dept" title="Remove"></div></div></div></div></div>'; //New input field html 
    // var x2 = 1; //Initial field counter is 1
    
    // //Once add button is clicked
    // $(add_dept).click(function(){
    //         $(dept_wrapper).prepend(deptHTML); //Add field html
    // });
    
    // //Once remove button is clicked
    // $(dept_wrapper).on('click', '.remove_dept', function(e){
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
    //     x2--; //Decrement field counter
    // });

    
    var add_social_media = $('.add_social_media'); //Add button selector
    var social_media_wrapper = $('.social_media_wrapper'); //Input field wrapper
    var social_mediaHTML = '<div class="row"><div class="col-md-6"><div class="mb-4 templating-select"><label class="form-label">Select Icon</label><select class="form-control select2-templating1" name="social_media_icon[]" required=""><option value="">Choose one</option><option value="Behance">Behance</option><option value="Dribbble">Dribbble</option><option value="Facebook">Facebook</option><option value="Instagram">Instagram</option><option value="LinkedIn">LinkedIn</option><option value="Medium">Medium</option><option value="Pinterest">Pinterest</option><option value="Reddit">Reddit</option><option value="Slack">Slack</option><option value="Snapchat">Snapchat</option><option value="Tumblr">Tumblr</option><option value="Twitch">Twitch</option><option value="Twitter">Twitter</option><option value="Vimeo">Vimeo</option><option value="WhatsApp">WhatsApp</option><option value="YouTube">YouTube</option></select></div></div><div class="col-md-6"><div class="mb-4"><label class="form-label">Link</label><div class="input-group"><input type="url" name="social_media[]" class="form-control" placeholder="Enter Link" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_social_media" title="Remove"></div></div></div></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(add_social_media).click(function(){
            $(social_media_wrapper).prepend(social_mediaHTML); //Add field html
            function formatState1(state) {
              if (!state.id) {
                return state.text;
              }
              //var baseUrl = "../assets/images/icons";
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
    </body>

</html>
