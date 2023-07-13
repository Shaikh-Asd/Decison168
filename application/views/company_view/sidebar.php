<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li <?php if($page == 'index') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('company');?>" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li <?php if($page == 'roles-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('company/roles');?>" class="waves-effect">
                        <i class="bx bxs-user-badge"></i>
                        <span key="t-tasks">Roles</span>
                    </a>
                </li>

                <li <?php if($page == 'Team-Members-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('company/team-members');?>" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-tasks">Team Members</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>