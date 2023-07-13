<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url('company');?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo base_url('company');?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="65" style="margin-left: -7px;">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url();?>assets/images/logo-main.png" alt="" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            
        </div>

        <div class="d-flex">

            <div class="row d-sm-block">
                <div class="dropdown d-lg-inline-block ms-1 mt-1">
                    <a class="btn btn-sm btn-d text-white mt-3" href="<?php echo base_url('company/pricing-package');?>">
                        <strong>Package</strong>
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell"></i>
                    <span class="badge bg-danger rounded-pill" id="notification-count"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"><b>Notifications</b></h6>
                            </div>
                            <div class="col-auto">

                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <div id="notification-div">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        $compd = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
                        $hprofile_name = "";
                        $hcname = "";
                        if($compd)
                        {
                            $hcname = $compd->cc_name;
                            $hprofile_name = strtoupper(substr(trim($hcname), 0, 2));
                        }
                    ?>
                    <span class="rounded-circle header-profile-user" style="font-size: large;"><?php echo $hprofile_name;?></span>
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $hcname;?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end"> 
                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_company_passwordModal"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> <span>Change Password</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="logout();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

        </div>
    </div>
</header>