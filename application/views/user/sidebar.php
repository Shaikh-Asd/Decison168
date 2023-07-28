<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li <?php if($page == 'index') { echo 'class="mm-active"';} ?> id="tour_dashboard">
                    <a href="<?php echo base_url();?>" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <!-- <li <?php if($page == 'calendar') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('calendar');?>" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-calendar">Calendar</span>
                    </a>
                </li> -->
                <li <?php if($page == 'calendar') { echo 'class="mm-active"';} ?> id="tour_calendar">
                    <a href="<?php echo base_url('calendar');?>" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-calendar">Calendar</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li <?php if($page == 'cal-event-list') { echo 'class="mm-active"';} ?>>
                            <a href="<?php echo base_url('calendar-event-list');?>" class="waves-effect">
                                <i class="bx bxs-calendar-check"></i>
                                <span key="t-crypto">Events</span>
                            </a>
                        </li>
                        <li <?php if($page == 'cal-todo-list') { echo 'class="mm-active"';} ?>>
                            <a href="<?php echo base_url('calendar-todo-list');?>" class="waves-effect">
                                <i class="bx bx-circle"></i>
                                <span key="t-crypto">To Do</span>
                            </a>
                        </li>
                        <!-- <li <?php if($page == 'cal-reminder-list') { echo 'class="mm-active"';} ?>>
                            <a href="<?php echo base_url('calendar-reminder-list');?>" class="waves-effect">
                                <i class="bx bx-bell"></i>
                                <span key="t-crypto">Reminder</span>
                            </a>
                        </li> -->
                    </ul>
                </li>            

                <?php
                if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    $abcd = $this->Front_model->getAllPortfolio($_COOKIE["d168_selectedportfolio"]);
                    if($abcd)
                    {
                ?>
                <li <?php if($page == 'portfolio' || $page == 'portfolio-create' || $page == 'portfolio-view') { echo 'class="mm-active"';} ?> id="tour_portfolio">
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $_COOKIE["d168_selectedportfolio"];?>');" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-portfolio">Portfolio</span>
                    </a>
                </li>    

                <li <?php if($page == 'goal-create' || $page == 'goals' || $page == 'goals-list') { echo 'class="mm-active"';} ?> id="tour_goals">
                    <a href="<?php echo base_url('portfolio-goals/'.$_COOKIE["d168_selectedportfolio"]);?>" class="waves-effect">
                        <i class="bx bx-bullseye"></i>
                        <span key="t-crypto">Goals & Strategies</span>
                    </a>
                </li>            

                <li <?php if($page == 'projects-grid' || $page == 'projects-list' || $page == 'projects-overview' || $page == 'projects-create' || $page == 'my-created-projects' || $page == 'my-accepted-projects' || $page == 'pending-projects-request' || $page == 'readmore-projects-request') { echo 'class="mm-active"';} ?> id="tour_projects">
                    <a href="<?php echo base_url('portfolio-projects-list/'.$_COOKIE["d168_selectedportfolio"]);?>" class="waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-crypto">Projects</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li <?php if($page == 'tasks-list' || $page == 'tasks-kanban' || $page == 'tasks-create' || $page == 'all-tasks' || $page == 'today-tasks' || $page == 'tomorrow-tasks' || $page == 'week-tasks' || $page == 'overdue-tasks') { echo 'class="mm-active"';} ?> id="tour_tasks">
                            <a href="<?php echo base_url('portfolio-tasks-list/'.$_COOKIE["d168_selectedportfolio"]);?>" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-crypto">Tasks</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li <?php if($page == 'content-create' || $page == 'content-Planner' || $page == 'content-planner') { echo 'class="mm-active"';} ?> id="tour_content">
                    <a href="<?php echo base_url('portfolio-projects-content/'.$_COOKIE["d168_selectedportfolio"]);?>" class="waves-effect">
                        <i class="bx bx-customize"></i>
                        <span key="t-crypto">Content Planner</span>
                    </a>
                </li>

                <!-- <li <?php if($page == 'contacts-list') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('contacts-list');?>" class="waves-effect">
                        <i class="bx bxs-contact"></i>
                        <span key="t-tasks">Contacts</span>
                    </a>
                </li> -->

                <li <?php if($page == 'file-cabinet') { echo 'class="mm-active"';} ?> id="tour_file_cabinet">
                    <a href="<?php echo base_url('file-cabinet');?>" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-crypto">File Cabinet</span>
                    </a>
                </li>

                <li <?php if($page == 'report-files') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('my-report')?>" class="waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-crypto">My Report</span>
                    </a></li>
                    <!--<ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                <li <?php if($page == 'report-create' ) { echo 'class="mm-active"';} ?>></li></ul>-->
                
                <li <?php if($page == 'archive') { echo 'class="mm-active"';} ?> id="tour_archive">
                    <a href="<?php echo base_url('archive');?>" class="waves-effect">
                        <i class="bx bx-archive-in"></i>
                        <span key="t-crypto">Archive</span>
                    </a>
                </li>

                <li <?php if($page == 'trash-project-files') { echo 'class="mm-active"';} ?> id="tour_trash">
                    <a href="<?php echo base_url('trash');?>" class="waves-effect">
                        <i class="bx bx-trash"></i>
                        <span key="t-crypto">Trash</span>
                    </a>
                </li>

                <?php
                    }
                }
                ?>

                <?php
                $user_role_del = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
                if($user_role_del->role == 'supporter' && $user_role_del->supporter_status == 'active'){
                    $this->session->set_userdata('d168_role','supporter');
                    ?>
                    <li <?php if($page == 'support') { echo 'class="mm-active"';} ?> id="tour_support">
                        <a href="https://support.dev.decision168.com/login" target="_blank" class="waves-effect">
                            <i class="bx bx-support"></i>
                            <span key="t-crypto">Assigned Tickets</span>
                        </a>
                    </li>
                    <?php
                }else{
                    $this->session->set_userdata('d168_role','');
                    ?>
                    <li <?php if($page == 'support') { echo 'class="mm-active"';} ?> id="tour_support">
                        <a href="https://support.dev.decision168.com/login" target="_blank" class="waves-effect">
                            <i class="bx bx-support"></i>
                            <span key="t-crypto">Support</span>
                        </a>
                    </li>
                    <?php
                }
                
                if(empty($this->session->userdata('d168_user_cor_id')))
                {
                ?> 
                <li <?php if($page == 'community') { echo 'class="mm-active"';} ?> id="tour_community">
                    <a href="<?php echo base_url('community');?>" class="waves-effect">
                        <i class="fas fa-people-arrows"></i>
                        <span key="t-crypto">Community</span>
                    </a>
                    <?php
                    // $user_call = $this->Front_model->userCallsCount($this->session->userdata('d168_id'));
                    // if($user_call){
                        ?>
                        <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                            <li <?php if($page == 'user-all-calls') { echo 'class="mm-active"';} ?>>
                                <a href="<?php echo base_url('user-all-calls');?>" class="waves-effect">
                                    <i class="bx bx-circle"></i>
                                    <span key="t-crypto">All Calls</span>
                                </a>
                            </li>
                        </ul>
                        <?php
                    //}
                    ?>
                </li>
            
                <?php
                if($user_role_del->expert == 1 && $user_role_del->expert_approve == 1 && $user_role_del->expert_status == 'active'){
                    ?>
                <li <?php if($page == 'all-calls') { echo 'class="mm-active"';} ?> id="tour_community">
                    <a href="<?php echo base_url('all-calls');?>" class="waves-effect">
                        <i class="bx bx-user-voice"></i>
                        <span key="t-crypto">Calls for Decision Maker</span>
                    </a>
                </li>
                    <?php
                }
                }
                ?>

                <li>
                    <a href="https://www.decision168.com/help-center/" class="waves-effect" target="_blank" id="tour_help_center">
                        <i class="bx bx-help-circle"></i>
                        <span key="t-crypto">Help Center</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="http://support.decision168.com" class="waves-effect" target="_blank">
                        <i class="bx bx-support"></i>
                        <span key="t-crypto">Support</span>
                    </a>
                </li> -->

                <!-- <li <?php if($page == 'video') { echo 'class="mm-active"';} ?>>
                    <a href="<?php echo base_url('video');?>" class="waves-effect">
                        <i class="bx bxs-videos"></i>
                        <span key="t-ui-elements">Videos</span>
                    </a>
                </li> -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>