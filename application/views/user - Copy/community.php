<?php
$page = 'community'; 
?>
<!doctype html>
<html lang="en">    
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Decision168 - Book Decision Maker & get Advice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/owl.carousel/assets/owl.theme.default.min.css">
        <!-- Bootstrap Css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <?php
            include('header_links.php');
            ?>
            <style type="text/css">
                .hero-section .hero-title {
                    font-size: 4vw;
                    font-weight: 600;
                    text-shadow: 0em 0.3em 1.4em rgba(0,0,0,0.24);
                }
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

    <body data-bs-spy="scroll" data-bs-target="#topnav-menu" data-bs-offset="60" style="background-image: url(<?php echo base_url();?>assets/images/D168-Progress-Chart-BG-1197x988-1.webp);">

        <nav class="navbar navbar-expand-lg navigation fixed-top sticky bg-black" style="border-bottom-color: #004225; border-bottom-width: 5px;">
            <div class="container">
                <a class="navbar-logo" href="<?php echo base_url(); ?>">
                    <img src="assets/images/Decision-168-On-Target-Logo.webp" alt="" height="55" class="logo logo-dark">
                    <img src="assets/images/Decision-168-On-Target-Logo.webp" alt="" height="55" class="logo logo-light">
                </a>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
              
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav ms-auto" id="topnav-menu" >
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url(); ?>">PLATFORM</a>
                        </li>

                    </ul>

                    <?php
                    if($stud_del->expert_approve == 0){
                        ?>
                        <div class="my-2 ms-lg-2">
                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#become-expert" class="btn btn-d font-weight-semibold">Become a Decision Maker</a>
                        </div>
                        <?php
                    }
                    ?>                    
                </div>
            </div>
        </nav>

        <!-- hero section start -->
        <section class="section hero-section" id="home" style="background-image: url(<?php echo base_url();?>assets/images/D168-login-image.png);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="text-white-50 text-center">
                            <h1 class="text-white fw-semibold mb-3 hero-title">Book the world’s most in-demand Decision Maker & get advice over a video call </h1>
                            
                            <div class="gap-2 mt-4 text-center">
                                <a href="javascript: void(0);" class="btn btn-d btn-lg font-weight-semibold">Book a Decision Maker</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- hero section end -->
        
        <!-- currency price section start -->
        <section class="section p-0">
            <div class="container">
                <div class="currency-price">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-18">
                                                    <i class="mdi mdi-bitcoin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="font-weight-semibold">Get access to the world’s best Decision Maker</h4>
                                            <h6>Choose from our list of the top Decision Maker in a variety of topics</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-d bg-soft text-d font-size-18">
                                                    <i class="mdi mdi-ethereum"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="font-weight-semibold">Personalized advice just for you</h4>
                                            <h6>Book a 1-on-1 virtual session & get advice that is tailored to you</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                    <i class="mdi mdi-litecoin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="font-weight-semibold">Save time and money, guaranteed</h4>
                                            <h6>Our guarantee — find value in your first session or your money back</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- currency price section end -->
        
        <!-- Blog start -->
        <section class="section pt-0" id="news">
            <div class="container">
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
                        <div class="text-center mb-5">
                            <div class="small-title">Decision Maker.</div>
                            <h4>Access to the best has never been easier</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <?php
                    if($decision_maker){
                        $dm_cnt=1;
                        foreach ($decision_maker as $dm) {
                            ?>
                            <div class="col-xl-3 col-sm-6">
                                <div class="blog-box mb-4 mb-xl-0">
                                    <div class="position-relative">
                                        <?php
                                        if(!empty($dm->expert_photo)){
                                            ?>
                                            <img class="rounded img-fluid mx-auto d-block" style="width: 256px; height: auto;" src="<?php echo base_url('assets/student_photos/'.$dm->expert_photo);?>" alt="<?php echo $dm->first_name;?>">
                                            <?php
                                        }else{
                                            $fullname = $dm->first_name.' '.$dm->last_name;
                                            $student_name = explode(" ", $fullname);
                                            $profile_name = "";

                                            foreach ($student_name as $sn) {
                                              $profile_name .= $sn[0];
                                            }
                                            ?>
                                            <span class="rounded img-fluid mx-auto d-block no-image-card"><?php echo strtoupper($profile_name);?></span>
                                            <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($dm->add_expert_tag == 1){
                                            ?><div class="badge bg-success blog-badge font-size-11">Decision Maker</div><?php
                                        }
                                        ?>                                        
                                    </div>

                                    <div class="mt-4 text-muted">
                                        <?php
                                        $expert_id = $dm->reg_id;
                                        $expert_call_del1 = $this->Front_model->expertLessCallRate($expert_id);
                                        if($expert_call_del1){
                                            ?>
                                            <p class="mb-2">$<span class="call-rate<?php echo $expert_id?>"><?php echo $expert_call_del1->call_rate; ?></span> • Session</p>
                                            <?php
                                        }
                                        ?>                                        
                                        <h5 class="mb-1"><a class="text-dark" href="javascript:void(0);" onclick="expertProfileModal(<?php echo $dm->reg_id; ?>);"><?php echo ucfirst($dm->first_name).' '.ucfirst($dm->last_name); ?></a></h5>
                                        <p><?php echo ucfirst($dm->designation); ?>, <?php echo $dm->company; ?></p>
            
                                        <div>
                                            <a href="javascript:void(0);" onclick="expertProfileModal(<?php echo $dm->reg_id; ?>);">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $dm_cnt++;
                        }
                    }else{
                        ?>
                        <div class="text-center">
                            <h2>Here Decision Makers are to be listed...</h2>
                        </div>                        
                        <?php
                    }
                    ?>
                </div>                                
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Blog end -->


        <!-- Roadmap start -->
        <section class="section bg-black text-center" id="roadmap">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="hori-timeline" dir="ltr">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div>
                                        <div class="event-date">
                                            <h4 class="mb-4 text-white">Book a Decision Maker</h4>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-clipboard-search-outline h1 text-d font-size-60"></i>
                                        </div>

                                        <div class="mt-3">
                                            <h5 class="text-muted">Discover and choose from our list of the world’s most in-demand Decision Maker</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div>
                                        <div class="event-date">
                                            <h4 class="mb-4 text-white">Book a video call</h4>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-calendar-month-outline h1 text-d font-size-60"></i>
                                        </div>

                                        <div class="mt-3">
                                            <h5 class="text-muted">Select a time that works for both you and your Decision Maker’s schedule</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div>
                                        <div class="event-date">
                                            <h4 class="mb-4 text-white">Virtual consultation</h4>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-video-box h1 text-d font-size-60"></i>
                                        </div>

                                        <div class="mt-3">
                                            <h5 class="text-muted">Join the 1-on-1 video call, ask questions, and get Decision Maker's advice</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Roadmap end -->

        <!--  Large modal example -->
        <div class="modal fade bs-example-modal-lg" id="become-expert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
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
                                    <?php
                                    if(($this->session->userdata('expert_session_id')) || ($this->session->userdata('expert_session_id') != "")){
                                        if(($stud_del->expert == 0) && ($stud_del->expert_approve == 0)){
                                            ?>
                                            <div class="about-section p-3">
                                                <h3 class="font-weight-semibold">Join as a Decision Maker</h3>
                                                <h5 class="text-muted mb-4">Tell us a little about yourself. We'll use this to review your application:</h5>
                                                <form class="about_form" name="about_form" id="about_form" method="post" autocomplete="off">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4"> 
                                                            <div id="user-choosen-photo" class="expert_photo-section"></div>
                                                            <a href="javascript:void(0);" class="image-text text-dark font-weight-semibold font-size-14" data-bs-toggle="modal" data-bs-target="#profilePic" title="Change Profile Picture">Upload Photo</a>
                                                            <input type="hidden" name="expert_photo" id="photo">
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
                                                    </div>
                                                    <input type="hidden" name="add_expert_tag" value="No">

                                                    <div class="mb-3">
                                                        <button type="submit" id="about-submit" class="btn btn-md btn-d waves-effect waves-light buttonText">Continue</button>
                                                    </div>                                    
                                                </form>
                                            </div>
                                            <div class="success-section p-4" style="display:none;">
                                                <h4 class="font-weight-semibold">Your Request for Becoming a Decision Maker has been send to Admin for Verification, You will receive the mail of Verification Status</h4>
                                            </div>
                                            <?php
                                        }else if(($stud_del->expert == 1) && ($stud_del->expert_approve == 0)){
                                            ?>
                                            <div class="success-section p-4">
                                                <h4 class="font-weight-semibold">Your Request for Becoming a Decision Maker has been send to Admin for Verification, You will receive the mail of Verification Status</h4>
                                            </div>
                                            <?php
                                        }                                        
                                    }else{
                                        ?>
                                        <div class="phone-section p-3">
                                            <h3 class="font-weight-semibold">Create an account, or log in</h3>
                                            <h5 class="text-muted">Start by entering your mobile number. We'll send you an OTP to verify:</h5>
                                            <form class="otp_form" name="otp_form" id="otp_form" method="post" autocomplete="off">
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label for="formrow-phone_number-input" class="form-label">Mobile Number</label>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <select class="form-control" id="dailing_code" name="dailing_code" required="">
                                                                    <option value="+93">+93 (Afghanistan)</option>
                                                                    <option value="+355">+355 (Albania)</option>
                                                                    <option value="+213">+213 (Algeria)</option>
                                                                    <option value="+1684">+1684 (American Samoa)</option>
                                                                    <option value="+376">+376 (Andorra)</option>
                                                                    <option value="+244">+244 (Angola)</option>
                                                                    <option value="+1264">+1264 (Anguilla)</option>
                                                                    <option value="+1268">+1268 (Antigua and Barbuda)</option>
                                                                    <option value="+54">+54 (Argentina)</option>
                                                                    <option value="+374">+374 (Armenia)</option>
                                                                    <option value="+297">+297 (Aruba)</option>
                                                                    <option value="+61">+61 (Australia)</option>
                                                                    <option value="+43">+43 (Austria)</option>
                                                                    <option value="+994">+994 (Azerbaijan)</option>
                                                                    <option value="+1242">+1242 (Bahamas)</option>
                                                                    <option value="+973">+973 (Bahrain)</option>
                                                                    <option value="+880">+880 (Bangladesh)</option>
                                                                    <option value="+1246">+1246 (Barbados)</option>
                                                                    <option value="+375">+375 (Belarus)</option>
                                                                    <option value="+32">+32 (Belgium)</option>
                                                                    <option value="+501">+501 (Belize)</option>
                                                                    <option value="+229">+229 (Benin)</option>
                                                                    <option value="+1441">+1441 (Bermuda)</option>
                                                                    <option value="+975">+975 (Bhutan)</option>
                                                                    <option value="+591">+591 (Bolivia)</option>
                                                                    <option value="+387">+387 (Bosnia and Herzegovina)</option>
                                                                    <option value="+267">+267 (Botswana)</option>
                                                                    <option value="+55">+55 (Brazil)</option>
                                                                    <option value="+673">+673 (Brunei)</option>
                                                                    <option value="+359">+359 (Bulgaria)</option>
                                                                    <option value="+226">+226 (Burkina Faso)</option>
                                                                    <option value="+257">+257 (Burundi)</option>
                                                                    <option value="+855">+855 (Cambodia)</option>
                                                                    <option value="+237">+237 (Cameroon)</option>
                                                                    <option value="+1">+1 (Canada)</option>
                                                                    <option value="+238">+238 (Cape Verde)</option>
                                                                    <option value="+1345">+1345 (Cayman Islands)</option>
                                                                    <option value="+236">+236 (Central African Republic)</option>
                                                                    <option value="+235">+235 (Chad)</option>
                                                                    <option value="+56">+56 (Chile)</option>
                                                                    <option value="+86">+86 (China)</option>
                                                                    <option value="+57">+57 (Colombia)</option>
                                                                    <option value="+269">+269 (Comoros)</option>
                                                                    <option value="+242">+242 (Congo)</option>
                                                                    <option value="+243">+243 (Congo Democratic Republic)</option>
                                                                    <option value="+682">+682 (Cook Islands)</option>
                                                                    <option value="+506">+506 (Costa Rica)</option>
                                                                    <option value="+225">+225 (Cote D'Ivoire)</option>
                                                                    <option value="+385">+385 (Croatia)</option>
                                                                    <option value="+53">+53 (Cuba)</option>
                                                                    <option value="+357">+357 (Cyprus)</option>
                                                                    <option value="+420">+420 (Czech Republic)</option>
                                                                    <option value="+45">+45 (Denmark)</option>
                                                                    <option value="+253">+253 (Djibouti)</option>
                                                                    <option value="+1767">+1767 (Dominica)</option>
                                                                    <option value="+1809">+1809 (Dominican Republic)</option>
                                                                    <option value="+593">+593 (Ecuador)</option>
                                                                    <option value="+20">+20 (Egypt)</option>
                                                                    <option value="+503">+503 (El Salvador)</option>
                                                                    <option value="+240">+240 (Equatorial Guinea)</option>
                                                                    <option value="+291">+291 (Eritrea)</option>
                                                                    <option value="+372">+372 (Estonia)</option>
                                                                    <option value="+251">+251 (Ethiopia)</option>
                                                                    <option value="+298">+298 (Faeroe Islands)</option>
                                                                    <option value="+500">+500 (Falkland Islands (Malvinas))</option>
                                                                    <option value="+679">+679 (Fiji)</option>
                                                                    <option value="+358">+358 (Finland)</option>
                                                                    <option value="+33">+33 (France)</option>
                                                                    <option value="+594">+594 (French Guiana)</option>
                                                                    <option value="+689">+689 (French Polynesia)</option>
                                                                    <option value="+241">+241 (Gabon)</option>
                                                                    <option value="+220">+220 (Gambia)</option>
                                                                    <option value="+995">+995 (Georgia)</option>
                                                                    <option value="+49">+49 (Germany)</option>
                                                                    <option value="+233">+233 (Ghana)</option>
                                                                    <option value="+350">+350 (Gibraltar)</option>
                                                                    <option value="+30">+30 (Greece)</option>
                                                                    <option value="+299">+299 (Greenland)</option>
                                                                    <option value="+1473">+1473 (Grenada)</option>
                                                                    <option value="+590">+590 (Guadeloupe)</option>
                                                                    <option value="+1671">+1671 (Guam)</option>
                                                                    <option value="+502">+502 (Guatemala)</option>
                                                                    <option value="+44">+44 (Guernsey)</option>
                                                                    <option value="+224">+224 (Guinea)</option>
                                                                    <option value="+245">+245 (Guinea Bissau)</option>
                                                                    <option value="+592">+592 (Guyana)</option>
                                                                    <option value="+509">+509 (Haiti)</option>
                                                                    <option value="+504">+504 (Honduras)</option>
                                                                    <option value="+852">+852 (Hong Kong)</option>
                                                                    <option value="+36">+36 (Hungary)</option>
                                                                    <option value="+354">+354 (Iceland)</option>
                                                                    <option value="+91">+91 (India)</option>
                                                                    <option value="+62">+62 (Indonesia)</option>
                                                                    <option value="+98">+98 (Iran)</option>
                                                                    <option value="+964">+964 (Iraq)</option>
                                                                    <option value="+353">+353 (Ireland)</option>
                                                                    <option value="+44">+44 (Isle of Man)</option>
                                                                    <option value="+972">+972 (Israel)</option>
                                                                    <option value="+39">+39 (Italy)</option>
                                                                    <option value="+1876">+1876 (Jamaica)</option>
                                                                    <option value="+81">+81 (Japan)</option>
                                                                    <option value="+962">+962 (Jordan)</option>
                                                                    <option value="+7">+7 (Kazakhistan)</option>
                                                                    <option value="+254">+254 (Kenya)</option>
                                                                    <option value="+686">+686 (Kiribati)</option>
                                                                    <option value="+965">+965 (Kuwait)</option>
                                                                    <option value="+996">+996 (Kyrgyzstan)</option>
                                                                    <option value="+856">+856 (Laos)</option>
                                                                    <option value="+371">+371 (Latvia)</option>
                                                                    <option value="+961">+961 (Lebanon)</option>
                                                                    <option value="+266">+266 (Lesotho)</option>
                                                                    <option value="+231">+231 (Liberia)</option>
                                                                    <option value="+218">+218 (Libya)</option>
                                                                    <option value="+423">+423 (Liechtenstein)</option>
                                                                    <option value="+370">+370 (Lithuania)</option>
                                                                    <option value="+352">+352 (Luxembourg)</option>
                                                                    <option value="+853">+853 (Macao)</option>
                                                                    <option value="+389">+389 (Macedonia)</option>
                                                                    <option value="+261">+261 (Madagascar)</option>
                                                                    <option value="+265">+265 (Malawi)</option>
                                                                    <option value="+60">+60 (Malaysia)</option>
                                                                    <option value="+960">+960 (Maldives)</option>
                                                                    <option value="+223">+223 (Mali)</option>
                                                                    <option value="+356">+356 (Malta)</option>
                                                                    <option value="+596">+596 (Martinique)</option>
                                                                    <option value="+222">+222 (Mauritania)</option>
                                                                    <option value="+230">+230 (Mauritius)</option>
                                                                    <option value="+52">+52 (Mexico)</option>
                                                                    <option value="+691">+691 (Micronesia)</option>
                                                                    <option value="+373">+373 (Moldova)</option>
                                                                    <option value="+377">+377 (Monaco)</option>
                                                                    <option value="+976">+976 (Mongolia)</option>
                                                                    <option value="+382">+382 (Montenegro)</option>
                                                                    <option value="+1664">+1664 (Montserrat)</option>
                                                                    <option value="+212">+212 (Morocco)</option>
                                                                    <option value="+258">+258 (Mozambique)</option>
                                                                    <option value="+95">+95 (Myanmar)</option>
                                                                    <option value="+264">+264 (Namibia)</option>
                                                                    <option value="+674">+674 (Nauru)</option>
                                                                    <option value="+977">+977 (Nepal)</option>
                                                                    <option value="+31">+31 (Netherlands)</option>
                                                                    <option value="+599">+599 (Netherlands Antilles)</option>
                                                                    <option value="+687">+687 (New Caledonia)</option>
                                                                    <option value="+64">+64 (New Zealand)</option>
                                                                    <option value="+505">+505 (Nicaragua)</option>
                                                                    <option value="+227">+227 (Niger)</option>
                                                                    <option value="+234">+234 (Nigeria)</option>
                                                                    <option value="+683">+683 (Niue)</option>
                                                                    <option value="+672">+672 (Norfolk Island)</option>
                                                                    <option value="+850">+850 (North Korea)</option>
                                                                    <option value="+1670">+1670 (Northern Mariana Islands)</option>
                                                                    <option value="+47">+47 (Norway)</option>
                                                                    <option value="+968">+968 (Oman)</option>
                                                                    <option value="+92">+92 (Pakistan)</option>
                                                                    <option value="+680">+680 (Palau)</option>
                                                                    <option value="+507">+507 (Panama)</option>
                                                                    <option value="+675">+675 (Papua New Guinea)</option>
                                                                    <option value="+595">+595 (Paraguay)</option>
                                                                    <option value="+51">+51 (Peru)</option>
                                                                    <option value="+63">+63 (Philippines)</option>
                                                                    <option value="+48">+48 (Poland)</option>
                                                                    <option value="+351">+351 (Portugal)</option>
                                                                    <option value="+1">+1 (Puerto Rico)</option>
                                                                    <option value="+974">+974 (Qatar)</option>
                                                                    <option value="+262">+262 (Reunion)</option>
                                                                    <option value="+40">+40 (Romania)</option>
                                                                    <option value="+7">+7 (Russia)</option>
                                                                    <option value="+250">+250 (Rwanda)</option>
                                                                    <option value="+1869">+1869 (Saint Kitts And Nevis)</option>
                                                                    <option value="+1758">+1758 (Saint Lucia)</option>
                                                                    <option value="+1599">+1599 (Saint Martin)</option>
                                                                    <option value="+508">+508 (Saint Pierre and Miquelon)</option>
                                                                    <option value="+1784">+1784 (Saint Vincent and Grenadines)</option>
                                                                    <option value="+685">+685 (Samoa)</option>
                                                                    <option value="+378">+378 (San Marino)</option>
                                                                    <option value="+239">+239 (Sao Tome and Principe)</option>
                                                                    <option value="+966">+966 (Saudi Arabia)</option>
                                                                    <option value="+221">+221 (Senegal)</option>
                                                                    <option value="+381">+381 (Serbia)</option>
                                                                    <option value="+248">+248 (Seychelles)</option>
                                                                    <option value="+232">+232 (Sierra Leone)</option>
                                                                    <option value="+65">+65 (Singapore)</option>
                                                                    <option value="+421">+421 (Slovakia)</option>
                                                                    <option value="+386">+386 (Slovenia)</option>
                                                                    <option value="+677">+677 (Solomon Islands)</option>
                                                                    <option value="+252">+252 (Somalia)</option>
                                                                    <option value="+27">+27 (South Africa)</option>
                                                                    <option value="+82">+82 (South Korea)</option>
                                                                    <option value="+211">+211 (South Sudan)</option>
                                                                    <option value="+34">+34 (Spain)</option>
                                                                    <option value="+94">+94 (Sri Lanka)</option>
                                                                    <option value="+249">+249 (Sudan)</option>
                                                                    <option value="+597">+597 (Suriname)</option>
                                                                    <option value="+268">+268 (Swaziland)</option>
                                                                    <option value="+46">+46 (Sweden)</option>
                                                                    <option value="+41">+41 (Switzerland)</option>
                                                                    <option value="+963">+963 (Syria)</option>
                                                                    <option value="+886">+886 (Taiwan)</option>
                                                                    <option value="+992">+992 (Tajikistan)</option>
                                                                    <option value="+255">+255 (Tanzania)</option>
                                                                    <option value="+66">+66 (Thailand)</option>
                                                                    <option value="+670">+670 (Timor Leste)</option>
                                                                    <option value="+228">+228 (Togo)</option>
                                                                    <option value="+676">+676 (Tonga)</option>
                                                                    <option value="+1868">+1868 (Trinidad and Tobago)</option>
                                                                    <option value="+216">+216 (Tunisia)</option>
                                                                    <option value="+90">+90 (Turkey)</option>
                                                                    <option value="+993">+993 (Turkmenistan)</option>
                                                                    <option value="+1649">+1649 (Turks and Caicos Islands)</option>
                                                                    <option value="+256">+256 (Uganda)</option>
                                                                    <option value="+380">+380 (Ukraine)</option>
                                                                    <option value="+971">+971 (United Arab Emirates)</option>
                                                                    <option value="+44">+44 (United Kingdom)</option>
                                                                    <option value="+1" selected="">+1 (United States)</option>
                                                                    <option value="+598">+598 (Uruguay)</option>
                                                                    <option value="+998">+998 (Uzbekistan)</option>
                                                                    <option value="+678">+678 (Vanuatu)</option>
                                                                    <option value="+58">+58 (Venezuela)</option>
                                                                    <option value="+84">+84 (Vietnam)</option>
                                                                    <option value="+1284">+1284 (Virgin Islands - British)</option>
                                                                    <option value="+1340">+1340 (Virgin Islands - United States)</option>
                                                                    <option value="+967">+967 (Yemen)</option>
                                                                    <option value="+260">+260 (Zambia)</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-9" style="margin-left:-13px">
                                                                <input class="form-control" placeholder="Enter Mobile Number *" type="number" name="phone_number" required="" />
                                                            </div>
                                                        </div>
                                                        <span id="phone_numberErr" class="text-danger"></span>
                                                    </div>

                                                    <div class="col-6" style="display: none;" id="otp-textbox">
                                                        <label for="formrow-otp-input" class="form-label">OTP</label>
                                                        <input class="form-control" placeholder="Input the code we texted you" type="text" name="otp" required="" />
                                                        <span id="otpErr" class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <input type="hidden" name="expert_session_id" id="expert_session_id" value="">
                                                    <button type="button" id="phone-submit" class="btn btn-md btn-d waves-effect waves-light">Continue</button>

                                                    <button type="submit" id="otp-submit" style="display:none;" class="btn btn-md btn-d waves-effect waves-light">Confirm</button>
                                                </div>                                    
                                            </form>
                                            <h6 class="font-weight-semibold mb-3">Why a mobile number?</h6>
                                            <p class="text-muted">It's less complicated than remembering an email and password, and to verify that you're a real person</p>
                                        </div>
                                        <div class="about-section p-3" style="display:none;">
                                            <h3 class="font-weight-semibold">Join as a Decision Maker</h3>
                                            <h5 class="text-muted mb-4">Tell us a little about yourself. We'll use this to review your application:</h5>
                                            <form class="about_form" name="about_form" id="about_form" method="post" autocomplete="off">
                                                <div class="row mb-3">
                                                    <div class="col-lg-4"> 
                                                        <div id="user-choosen-photo" class="expert_photo-section"></div>
                                                        <a href="javascript:void(0);" class="image-text text-dark font-weight-semibold font-size-14" data-bs-toggle="modal" data-bs-target="#profilePic" title="Change Profile Picture">Upload Photo</a>
                                                        <input type="hidden" name="expert_photo" id="photo">
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
                                                </div>
                                                <input type="hidden" name="add_expert_tag" value="No">

                                                <div class="mb-3">
                                                    <button type="submit" id="about-submit" class="btn btn-md btn-d waves-effect waves-light buttonText">Continue</button>
                                                </div>                                    
                                            </form>
                                        </div>
                                        <div class="success-section p-4" style="display:none;">
                                            <h4 class="font-weight-semibold">Your Request for Becoming a Decision Maker has been send to Admin for Verification, You will receive the mail of Verification Status, Thankyou</h4>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Profile Pic Modal -->
        <div class="modal fade bs-example-modal-lg" id="profilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel1">Add Profile Picture</h5>
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

        <div id="expertProfileModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#expertProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="expertProfileModal_content">
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Footer start -->
        <footer class="landing-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        © Copyright 2013 - <span id="copyright"> <script> document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>  |   <a href="http://decision168.com" target="_blank"> DECISION 168, Inc</a>  |   <a href="https://www.decision168.com/?page_id=841" target="_blank"> Cookies Policy</a>  |   <a href="https://www.decision168.com/privacy-policy/" target="_blank"> Privacy Policy</a>  |   <a href="https://www.decision168.com/terms-conditions/" target="_blank"> Terms &amp; Conditions</a>
                    </div>
                    <div class="col-sm-5">
                        <div class="text-sm-end d-sm-block">
                            All Rights Reserved   |   Powered by <a href="https://www.z2squared.com/" target="_blank">z2 Squared</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer end -->

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>    
        <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/jquery.easing/jquery.easing.min.js"></script>

        <!-- Plugins js-->
        <script src="<?php echo base_url();?>assets/libs/jquery-countdown/jquery.countdown.min.js"></script>

        <!-- owl.carousel js -->
        <script src="<?php echo base_url();?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- ICO landing init -->
        <script src="<?php echo base_url();?>assets/js/pages/ico-landing.init.js"></script>
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
        include('footer_links.php');
        ?>
        <script src="<?php echo base_url();?>assets/js/croppie.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/croppie.css">
        <script type="text/javascript">
            //Preview Expert Profile modal
            function expertProfileModal(expert_id){           
             // AJAX request
              $.ajax({
                url:  'front/expertProfile_Modal',
                type: 'post',
                data: {expert_id: expert_id},
                success: function(data){
                  $('#expertProfileModal_content').html(data);
                  // Display Modal
                  $('#expertProfileModal').modal('show'); 
                }
              });
            }

            $("#phone-submit").click(function () {
                var phone_number = $("input[name='phone_number']").val();
                if(phone_number != ""){
                    $.ajax({
                        url: 'front/send_phone_number',
                        method: 'POST',
                        data: {phone_number:phone_number},  
                        success: function(data) {
                            if(data.status == 'Success'){
                                $("#phone-submit").hide();                    
                                $("#otp-textbox").show();
                                $("#otp-submit").show();
                                $("input[name='expert_session_id']").val(data.details);
                                $("#phone_numberErr").html();
                            }else{
                                $("#phone_numberErr").html("Invalid Mobile Number");
                            }                 
                        }
                    });
                }
            });

            $('#otp_form').on('submit',function(event){      
            // debugger;  
                event.preventDefault(); // Stop page from refreshing
                var formData = new FormData(this); 
                $.ajax({
                   url:'front/verify_phone_number',
                   type:"POST",
                   data:formData,
                   contentType:false,
                   processData:false,
                   cache:true,
                   success: function(data){
                        if(data.status == 'Success'){
                            console.log(data.status);
                            $(".phone-section").hide();                    
                            $(".about-section").show();
                        }else{
                            $("#otpErr").html("Incorrect OTP");
                        }
                   }// success msg ends here
                });
            });

            $('#about_form').on('submit',function(event){
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
                        $(".about-section").hide();                    
                        $(".success-section").show();
                      }
                      console.log(data); 
                   }// success msg ends here

                 });
            });
        </script>
        <script type="text/javascript">
            $uploadCrop = $('#upload-Profilepic').croppie({
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
                    $('#user-choosen-photo').html('<img class="img-thumbnail" src="'+resp+'" data-bs-toggle="modal" data-bs-target="#profilePic" title="Change Profile Picture" style="cursor: pointer;">');
                    $('#become-expert').modal('show');
                });
              }
              else
              {
                $("#profilepic_error").html("Please choose file!");
              }
            });
        </script>
    </body>
</html>
