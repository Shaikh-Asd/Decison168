<?php
$page = 'portfolio-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="utf-8" />
    <title>Portfolio Create</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
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
                        <h4 class="mb-sm-0 font-size-18">Create</h4>
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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Create Portfolio</a></li> -->
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
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <form method="POST" class="CreatePortfolioForm" id="CreatePortfolioForm" name="CreatePortfolioForm" autocomplete="off" enctype="multipart/form-data">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="formrow-client-input" class="form-label">Portfolio Type <span class="text-danger">*</span></label>
                                        <select name="portfolio_user" class="form-control" id="portfolio_user" onchange="return show_selected_user();" required="" style="line-height: 1.2;">
                                            <!-- <option value="">Select Portfolio Type</option> -->
                                            <option value="company" selected>Company</option>
                                            <option value="individual">Individual</option>
                                        </select>
                                        <span id="portfolio_userErr" class="text-danger clear_span_err"></span>
                                    </div>
                                </div>                                
                        </div>

                        <!-- Company Div Start -->
                        <div class="portfolio_user_company_div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" name="portfolio_name" class="form-control" placeholder="Enter Company Name" title="Enter Company name" id="portfolio_name">
                                            <span id="portfolio_nameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-about_me-input" class="form-label">About Company</label>
                                            <textarea name="about_portfolio" class="form-control" title="Enter about company" placeholder="About Company" id="about_portfolio"></textarea>
                                            <span id="about_portfolioErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_fname" class="form-control" placeholder="Enter First Name" title="Enter First Name" id="contact_fname">
                                            <span id="contact_fnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person Middle Name </label>
                                            <input type="text" name="contact_mname" class="form-control" placeholder="Enter Middle Name" title="Enter Middle Name" id="contact_mname">
                                            <span id="contact_mnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Contact Person Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_lname" class="form-control" placeholder="Enter Last Name" title="Enter Last Name" id="contact_lname">
                                            <span id="contact_lnameErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Contact Person Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_phone_number" class="form-control" placeholder="Enter phone number" id="contact_phone_number">
                                            <span id="contact_phone_numberErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-email-input" class="form-label">Company Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email_address" class="form-control" title="Email Address cannot be updated" placeholder="Enter email address" id="email_address">
                                            <span id="email_addressErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Company Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" id="phone_number">
                                            <span id="phone_numberErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Company Website <span class="text-danger">*</span></label>
                                            <input type="text" name="company_website" class="form-control" placeholder="Enter Website" id="company_website">
                                            <span id="company_websiteErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Street</label>
                                            <input type="text" name="street" class="form-control" placeholder="Enter street" id="street">
                                            <span id="streetErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="Enter city" id="city">
                                            <span id="cityErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Enter state" id="state">
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
                                                        ?><option value="<?php echo $cnty->country_code;?>"><?php echo $cnty->country_name;?></option>
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
                                            <a href="javascript: void(0);" id="company_logo" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profilePic" title="Add Company Logo"><i class="fa fa-camera"></i> Add Company Logo</a>
                                            <input type="hidden" name="photo" id="photo">
                                            <span id="photoErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label id="user-photo-name" class="form-label font-weight-semibold"></label>
                                            <img class="profile-photo" id="user-choosen-photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" id="cover_picture" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profileCover" title="Add Cover Picture"><i class="fa fa-camera"></i> Add Cover Picture</a>
                                            <input type="hidden" name="cover_photo" id="cover_photo">
                                            <span id="cover_photoErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-4">
                                            <label id="user-cover-name" class="form-label"></label>
                                            <p id="user-cover-name" class="form-label"></p>
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
                                            <input type="text" name="portfolio_name2" class="form-control" placeholder="Enter First Name" title="Enter First Name" id="portfolio_name2">
                                            <span id="portfolio_name2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Middle Name </label>
                                            <input type="text" name="portfolio_mname2" class="form-control" placeholder="Enter Middle Name" title="Enter Middle Name" id="portfolio_mname2">
                                            <span id="portfolio_mname2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-firstname-input" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="portfolio_lname2" class="form-control" placeholder="Enter Last Name" title="Enter Last Name" id="portfolio_lname2">
                                            <span id="portfolio_lname2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-about_me-input" class="form-label">About Individual</label>
                                            <textarea name="about_portfolio2" class="form-control" title="Enter about individual" placeholder="About Individual" id="about_portfolio2"></textarea>
                                            <span id="about_portfolio2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number2" class="form-control" placeholder="Enter phone number" id="phone_number2">
                                            <span id="phone_number2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-email-input" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email_address2" class="form-control" title="Email Address cannot be updated" placeholder="Enter email address" id="email_address2">
                                            <span id="email_address2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-designation-input" class="form-label">Designation </label>
                                            <input type="text" name="designation2" class="form-control" placeholder="Enter designation" id="designation2">
                                            <span id="designation2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="formrow-designation-input" class="form-label">Company </label>
                                            <input type="text" name="company_individual2" class="form-control" placeholder="Enter Company Name" id="company_individual2">
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
                                                    <input onclick="return showOtherGender(1,this.value);" class="form-check-input" type="radio" name="gender" id="male" value="male">
                                                    <label class="form-check-label" for="male">
                                                    Male
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary mr-20">
                                                    <input onclick="return showOtherGender(2,this.value);" class="form-check-input" type="radio" name="gender" id="female" value="female">
                                                    <label class="form-check-label" for="female">
                                                    Female
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary mr-15">
                                                    <input onclick="return showOtherGender(3,this.value);" class="form-check-input" type="radio" name="gender" id="other" value="other">
                                                    <label class="form-check-label" for="other">
                                                    Other
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-secondary">
                                                    <input onclick="return showOtherGender(4,this.value);" class="form-check-input" type="radio" name="gender" id="prefer_not" value="prefer not to say">
                                                    <label class="form-check-label" for="prefer_not">
                                                    Prefer not to say 
                                                    </label>
                                                </div>
                                            </div>
                                            <span id="genderErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="other_gender" style="display: none;">
                                        <div class="mb-4">
                                            <label for="formrow-gender_other-input" class="form-label">Other Gender</label>
                                            <input type="text" name="gender_other" value="" class="form-control" placeholder="Enter other gender" id="formrow-gender_other-input">
                                            <span id="gender_otherErr" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">Street</label>
                                            <input type="text" name="street2" class="form-control" placeholder="Enter street" id="street2">
                                            <span id="street2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">City</label>
                                            <input type="text" name="city2" class="form-control" placeholder="Enter city" id="city2">
                                            <span id="city2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="formrow-phone-input" class="form-label">State</label>
                                            <input type="text" name="state2" class="form-control" placeholder="Enter state" id="state2">
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
                                                        ?><option value="<?php echo $cnty->country_code;?>"><?php echo $cnty->country_name;?></option>
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
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profilePic2" title="Add Profile Picture"><i class="fa fa-camera"></i> Add Profile Picture</a>
                                            <input type="hidden" name="photo2" id="photo2">
                                            <span id="photo2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label id="user-photo-name2" class="form-label font-weight-semibold"></label>
                                            <img class="profile-photo" id="user-choosen-photo2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-4">
                                            <label for="formrow-cover_photo-input" class="form-label"></label>
                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect" data-bs-toggle="modal" data-bs-target="#profileCover2" title="Add Cover Picture"><i class="fa fa-camera"></i> Add Cover Picture</a>
                                            <input type="hidden" name="cover_photo2" id="cover_photo2">
                                            <span id="cover_photo2Err" class="text-danger clear_span_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-4">
                                            <label id="user-cover-name2" class="form-label"></label>
                                            <p id="user-cover-name2" class="form-label"></p>
                                            <div id="user-choosen-cover2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Individual Div End -->
                            <div class="common_div">     
                                <div class="row">
                                    <div class="col-md-12">
                                            <label class="form-label font-size-16">Add Department <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="mb-4" id="add_department">
                                            <select name="department[]" class="form-control select2 select2-multiple" multiple="multiple" id="department">
                                                <option value="Administration">Administration</option>
                                                <option value="Accounting & Finance">Accounting & Finance</option>
                                                <option value="Customer service">Customer service</option>
                                                <option value="Human resources">Human resources</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Research & Development">Research & Development</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-4">
                                            <button type="button" class="add_dept btn btn-d btn-sm">Add Custom Departments</button> 
                                        </div>                      
                                    </div>
                                </div>
                                <div class="row dept_wrapper">         
                                </div> 
                                <span id="departmentErr" class="text-danger"></span>  

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label class="form-label font-size-16" id="social_media_links">Add Social Media Links : &nbsp;<span style="font-size: 20px; color: #23211ea1; cursor: pointer;" class="fa fa-plus-circle add_social_media" title="Add more"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="social_media_wrapper">
                                               
                                </div>
                                <span id="social_mediaErr" class="text-danger clear_span_err"></span>
                            </div>
                            <div>
                                <button type="submit" id="CreatePortfolioButton" class="btn btn-sm btn-d btn-d">Create</button>
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
    var add_dept = $('.add_dept'); //Add button selector
    var dept_wrapper = $('.dept_wrapper'); //Input field wrapper
    var deptHTML = '<div class="col-md-6"><div class="mb-4"><div class="input-group"><input type="text" name="cus_department[]" class="form-control" placeholder="Enter Department" id="department" required=""><div style="font-size: 20px; color: #23211ea1; cursor: pointer; padding: 6px 6px 6px 6px;" class="input-group-text fa fa-minus-circle remove_dept" title="Remove"></div></div></div></div>'; //New input field html 
    var x2 = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(add_dept).click(function(){
            $(dept_wrapper).prepend(deptHTML); //Add field html
    });
    
    //Once remove button is clicked
    $(dept_wrapper).on('click', '.remove_dept', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x2--; //Decrement field counter
    });


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
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "portfolio-create")
          {
            localStorage.setItem('tour_session', 'no');
            var steps = [ 
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Here you can create your Portfolio</p>"
                },
                {
                    title: "Portfolio: Type",
                    id: "portfolio_user",
                    content: "<p class='popover-content'>Select Portfolio Type</p>"
                },
                {
                    title: "Portfolio: Company Name",
                    id: "portfolio_name",
                    content: "<p class='popover-content'>Enter Company Name</p>"
                },
                {
                    title: "Portfolio: About Company",
                    id: "about_portfolio",
                    content: "<p class='popover-content'>About Company</p>"
                },
                {
                    title: "Portfolio: Contact Person First Name",
                    id: "contact_fname",
                    content: "<p class='popover-content'>Enter First Name</p>"
                },
                {
                    title: "Portfolio: Contact Person Middle Name",
                    id: "contact_mname",
                    content: "<p class='popover-content'>Enter Middle Name</p>"
                },
                {
                    title: "Portfolio: Contact Person Last Name",
                    id: "contact_lname",
                    content: "<p class='popover-content'>Enter Last Name</p>"
                },
                {
                    title: "Portfolio: Contact Person Phone Number",
                    id: "contact_phone_number",
                    content: "<p class='popover-content'>Enter Phone Number</p>"
                },
                {
                    title: "Portfolio: Company Email Address ",
                    id: "email_address",
                    content: "<p class='popover-content'>Enter Email Address </p>"
                },
                {
                    title: "Portfolio: Company Phone Number",
                    id: "phone_number",
                    content: "<p class='popover-content'>Enter phone number</p>"
                },
                {
                    title: "Portfolio: Company Website",
                    id: "company_website",
                    content: "<p class='popover-content'>Enter Website</p>"
                },
                {
                    title: "Portfolio: Street",
                    id: "street",
                    content: "<p class='popover-content'>Enter street</p>"
                },
                {
                    title: "Portfolio: City",
                    id: "city",
                    content: "<p class='popover-content'>Enter city</p>"
                },
                {
                    title: "Portfolio: State",
                    id: "state",
                    content: "<p class='popover-content'>Enter state</p>"
                },
                {
                    title: "Portfolio: Country",
                    id: "select2-country-container",
                    content: "<p class='popover-content'>Select Country</p>"
                },
                {
                    title: "Portfolio: Company Logo",
                    id: "company_logo",
                    content: "<p class='popover-content'>Add Company Logo</p>"
                },
                {
                    title: "Portfolio: Cover Picture",
                    id: "cover_picture",
                    content: "<p class='popover-content'>Add Cover Picture</p>"
                },
                {
                    title: "Portfolio: ",
                    id: "add_department",
                    content: "<p class='popover-content'></p>"
                },
                {
                    title: "Portfolio: ",
                    id: "social_media_links",
                    content: "<p class='popover-content'></p>"
                },
            ];
            var my_tour = new Tour(steps);
            // var my_tour = new Tour({
            //     onShown: function(tour) {
            //         var steps = tour.steps[tour.currentTab];
            //         $(steps.element).attr('disabled', true);
            //     },
            //     onHidden: function(tour) {
            //         var steps = tour.steps[tour.currentTab];
            //         $(steps.element).removeAttr('disabled');
            //     }
            // });
            my_tour.show();            
          }
        }
    </script>
    </body>
</html>