<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url('super-admin');?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url();?>assets/images/Decision-168.png" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo base_url('super-admin');?>" class="logo logo-light">
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
                                <?php
                                $total_notifications = $this->Superadmin_model->getNotifyTicketCount();
                                if($total_notifications != 0)
                                {
                                ?>
                                <a href="javascript:void(0);" style="color: #c7df19 !important;" onclick="return AllNotificationClearYes();"> Clear All</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <div id="notification-div">
                            <?php
                            $ticket_notifications = $this->Superadmin_model->getMyNotifiedTickets();
                            if($ticket_notifications){
                                $tn_cnt = 1;
                                foreach ($ticket_notifications as $tn) {
                                    $ticket_notify_status = explode(',', $tn->notify);
                                    if($ticket_notify_status){
                                        foreach ($ticket_notify_status as $tns) {
                                            if($tns == 'ticket_created'){
                                                ?>
                                                <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tn->opened_date; ?>" id="ticket_row<?php echo $tn_cnt; ?>">
                                                    <div class="text-reset notification-item border-top">
                                                        <div class="media">
                                                            <div class="avatar-xs me-3">
                                                                <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                    TC
                                                                </span>
                                                            </div>
                                                            <div class="media-body me-3" onclick="showTicketNotification('<?php echo $tns; ?>',<?php echo $tn->ticket_id; ?>,<?php echo $tn_cnt; ?>);">
                                                                <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark">T-<?php echo $tn->unique_id; ?></span></h6>
                                                                <div class="font-size-12 text-muted">
                                                                    <p class="mb-1" key="t-grammer">Ticket Created By User</p>
                                                                    <p class="mb-0"><?php echo date('dS M Y',strtotime($tn->opened_date)); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="float-end" style="padding-right: 10px;">
                                                                <button type="button" onclick="removeTicketNotification('<?php echo $tns; ?>',<?php echo $tn->ticket_id; ?>,<?php echo $tn_cnt; ?>);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" title="Remove" style="height: 1.6rem;width: 1.6rem;">
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
                                            if($tns == 'ticket_revert'){
                                                ?>
                                                <a href="javascript: void(0);" class="new_notify_top" data-topdate="<?php echo $tn->reverted_date; ?>" id="ticket_row<?php echo $tn_cnt; ?>">
                                                    <div class="text-reset notification-item border-top">
                                                        <div class="media">
                                                            <div class="avatar-xs me-3">
                                                                <span class="avatar-title btn-d text-white rounded-circle font-size-16">
                                                                    TR
                                                                </span>
                                                            </div>
                                                            <div class="media-body me-3" onclick="showTicketNotification('<?php echo $tns; ?>',<?php echo $tn->ticket_id; ?>,<?php echo $tn_cnt; ?>);">
                                                                <h6 class="mt-0 mb-1" key="t-your-order"><span class="badge badge-soft-dark">T-<?php echo $tn->unique_id; ?></span></h6>
                                                                <div class="font-size-12 text-muted">
                                                                    <p class="mb-1" key="t-grammer">Ticket Reverted back By Supporter</p>
                                                                    <p class="mb-0"><?php echo date('dS M Y',strtotime($tn->reverted_date)); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="float-end" style="padding-right: 10px;">
                                                                <button type="button" onclick="removeTicketNotification('<?php echo $tns; ?>',<?php echo $tn->ticket_id; ?>,<?php echo $tn_cnt; ?>);" class="btn btn-light position-relative p-0 avatar-xs rounded-circle" title="Remove" style="height: 1.6rem;width: 1.6rem;">
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
                                            $tn_cnt++;
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="rounded-circle header-profile-user" style="font-size: x-large;">SA</span>
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">Super Admin</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end"> 
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="logout();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

        </div>
    </div>
</header>