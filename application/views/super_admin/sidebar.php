<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li <?php if($page == 'index') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin');?>" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li <?php if($page == 'quotes-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/quotes-list');?>" class="waves-effect">
                        <i class="bx bx-list-plus"></i>
                        <span key="t-tasks">Quotes</span>
                    </a>
                </li>

                <!-- <li <?php if($page == 'logo-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/logo-list');?>" class="waves-effect">
                        <i class="bx bx-image-add"></i>
                        <span key="t-tasks">Logos</span>
                    </a>
                </li> -->

                <li <?php if($page == 'registered-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/registered-list');?>" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-tasks">Registered Users</span>
                    </a>
                </li>

                <li <?php if($page == 'pricing-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/pricing-list');?>" class="waves-effect">
                        <i class="bx bx-money"></i>
                        <span key="t-tasks">Pricing</span>
                    </a>
                </li>

                <li <?php if($page == 'contacted-sales-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/contacted-sales-list');?>" class="waves-effect">
                        <i class="bx bxs-user"></i>
                        <span key="t-tasks">Enterprise Leads</span>
                    </a>
                </li>

                <li <?php if($page == 'ad-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/ad-list');?>" class="waves-effect">
                        <i class="bx bx-image-add"></i>
                        <span key="t-tasks">Ad Setting</span>
                    </a>
                </li>

                <li <?php if($page == 'coupon-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/coupon-list');?>" class="waves-effect">
                        <i class="bx bxs-coupon"></i>
                        <span key="t-tasks">Coupon Setting</span>
                    </a>
                </li>

                <li <?php if($page == 'supporters') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/supporters');?>" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-tasks">Supporters</span>
                    </a>
                </li>

                <li <?php if($page == 'support') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('super-admin/support-list');?>" class="waves-effect">
                        <i class="bx bx-support"></i>
                        <span key="t-crypto">Ticket Management</span>
                    </a>
                </li>

                <li <?php if($page == 'community') { echo 'class="mm-active"';} ?> id="tour_community"> 
                    <a href="<?php echo base_url('super-admin/community');?>" class="waves-effect"> 
                        <i class="fas fa-people-arrows"></i>    
                        <span key="t-crypto">Community</span>   
                    </a>    
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>