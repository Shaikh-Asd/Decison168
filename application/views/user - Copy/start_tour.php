<?php
if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
    $my_tour1 = $this->Front_model->checkMyTour($this->session->userdata('d168_id'),'till_portfolio');
    if(!$my_tour1){ // if tour not shown till portfolio, show all tour
        ?>
        <script type="text/javascript">
            localStorage.setItem('tour_session', 'skip_tour');
            var steps = [
                {
                title: "Start My Tour",
                content: "<p class='popover-content'>Welcome, let's start your tour through the DECISION 168 platform. Once you begin, you can navigate with the next or previous buttons, or start from the beginning by clicking restart. To make it even the tour even easier, you can click on the little indicator thingys as you like.</p>"
                }, 
                {
                    title: "The Dashboard",
                    id: "tour_coverpage",
                    content: "<p class='popover-content'>This is your personal dashboard where you have quick access to your profile and stats, such as the number of portfolio and projects that you are associated with, as well as tasks that are assigned to you. if you are subscribed to Content Planner module, you'll see those stats also.</p><p class='popover-content'>*You can update your header and profile images when setting up your profile (more on that later). </p>"
                }, 
                {
                    title: "Motivator",
                    id: "tour_motivational_quotes",
                    content: "<p class='popover-content'>The \"Motivator\" section is packed with uplifting quotes that will give you the boost you need to tackle any challenge. Submit your own quote to inspire others and see it featured on our dashboard. A fresh motivational quote is shown everytime you visit your dashboard.</p>"
                },
                {
                    title: "My Day",
                    id: "tour_my_day",
                    content: "<p class='popover-content'>In the \"My Day\" column, users can easily view their meetings, events, tasks, subtasks, and todos for the curent day, along with the ability to access the listed items via a quick link.</p>"
                },
                {
                    title: "My Next 168",
                    id: "tour_my_next168",
                    content: "<p class='popover-content'>In the \"My Next 168\" column, you can quickly view what you have coming up within the next 168 hours (or week). You can scroll down easily as well as click on a particular item for more details.</p>"
                },
                {
                    title: "My Alerts",
                    id: "tour_my_alerts",
                    content: "<p class='popover-content'>In the \"My Alerts\" column is where you can easily find the alerts for any goal, project, task, meetings, etc. that you have notifications for. You can scroll down quickly as well as click on a particular alere for more details.</p>"
                },
                {
                    title: "Portfolio Drop Down",
                    id: "tour_change_portfolio",
                    content: "<p class='popover-content'>The \"Portfolio\" dropdown displays the portfolio that has been selected. If a particular portfolio is not selected, you can select the desired one from the dropdown list or create additional ones based on your subscription. If a portfolio is selected, the user will see options such as “Dashboard”, “Portfolio”, “Projects”, “Tasks”, “Content Planner”, “Archive”, “Trash”, and “File Cabinet” on the sidebar to the left.</p>"
                },
                {
                    title: "Upgrade Button",
                    id: "tour_upgrade_button",
                    content: "<p class='popover-content'>Clicking the “Upgrade” button will redirect you to subscription level where you can choose a plan. The “Downgrade” option allows users to switch back to a free account, with a full refund available within 30 days of the subscription. The “Upgrade” option allows users to switch to a different subscription plan, with a prorated charge applied.</p>"
                },
                {
                    title: "Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>Clicking on the \"Profile\" dropdown will show options for \"My Profile\", \"Setting\", \"Support\", \"My Tour\", \"Get Started\" and \"Logout\". You can select the option of your choice and follow the prompts accordingly.</p>"
                },
                {
                    title: "Calendar",
                    id: "tour_calendar",
                    content: "<p class='popover-content'>The calendar functionality allows you to create and view events, meetings, to-dos, and reminders on a calendar. When the user clicks on the “Calendar” option, they will see a calendar view with options for month, week, day, and list. The calendar displays all created events, meetings, to-dos, and reminders, as well as an option to create draggable events for repeat events that can quickly be dropped to the desired date and times.</p>"
                },
                {
                    title: "Portfolio",
                    id: "tour_portfolio",
                    content: "<p class='popover-content'>Portfolios are an easy-to-understand way to manage your teams, projects, and tasks without the clutter – keeping things for everyone on the team clean and productive.</p><p class='popover-content'>When creating a Portfolio, you can select from a list of standard departments or areas that are relevant to you or create custom ones.</p>"
                },
                {
                    title: "Goals & Strategies",
                    id: "tour_goals",
                    content: "<p class='popover-content'>Goals and Strategies allow to plan, implement, and track the progress of projects and related tasks towards intended results over a given period. G&S aligns the tangible activities required in an organizational structure: Vision, Strategy, Objectives, Critical Success Factors, KPIs / Initiatives, and Actions – Doing so allows you to focus on what matters most, and to monitor your organizational progress from multiple views.</p><p class='popover-content'>You can quickly identify long or short-term goals, plan projects with targeted start and completion date ranges, assign resources, departments & teams accordingly.</p>"
                },
                {
                    title: "Projects",
                    id: "tour_projects",
                    content: "<p class='popover-content'>Your Projects can be standalone or a part of your Goals & Strategies. From here you can easily access the projects that you create and add team members, assign tasks, subtasks, and due dates accordingly.  You can also view, the percentage of completion. The transparency into open tasks and subtasks allows for more informed decision making when it comes to pending work that may need attention.</p>"
                },
                {
                    title: "Tasks",
                    id: "tour_tasks",
                    content: "<p class='popover-content'>Similar to projects, your tasks can be part of actual projects or be standalone tasks. Here you can view all the details of tasks and associated subtasks, if any. You can easily add, edit, delete, complete, or file tasks and subtasks accordingly.</p>"
                },
                {
                    title: "Content Planner",
                    id: "tour_content",
                    content: "<p class='popover-content'>After creating a content project or By selecting any content project from list, it will redirect to overview.</p><p class='popover-content'>It has same functionality like project overview with option of add new content.</p>"
                },
                {
                    title: "File Cabinet",
                    id: "tour_file_cabinet",
                    content: "<p class='popover-content'>All Files of file it goals, projects, tasks, subtasks and content of selected portfolio are shown in tree structure and card view department wise.</p>"
                },
                {
                    title: "Archive",
                    id: "tour_archive",
                    content: "<p class='popover-content'>All Archive goals, projects, tasks, subtasks and content of selected portfolio are shown with filter and reopen option. Clicked on reopen then the selected data will reopen and placed to its original position.</p>"
                },
                {
                    title: "Trash",
                    id: "tour_trash",
                    content: "<p class='popover-content'>All deleted projects, tasks, subtasks, files and content of selected portfolio are shown with filter and restore option. Clicked on restore then the selected data will restored and placed to its original position. (If any data do not restore within 30 days of its deleted date, then that data will be deleted permanently!)</p>"
                },
                {
                    title: "Support",
                    id: "tour_support",
                    content: "<p class='popover-content'>The “Support” option redirects the user to the support link for the platform.</p>"
                },
                {
                    title: "Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>From here you can start your tour again by clicking on My Tour</p>"
                },
            ];
            var tour = new Tour(steps);
            tour.show();
        </script>
        <?php
        $data = array(  'reg_id' => $this->session->userdata('d168_id'),
                        'name' => 'till_portfolio',
                        'date' => date('Y-m-d H:i:s')
                     );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->insertInTour($data);

        $data = array(  'reg_id' => $this->session->userdata('d168_id'),
                        'name' => 'after_portfolio',
                        'date' => date('Y-m-d H:i:s')
                     );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->insertInTour($data);
    }
    $my_tour2 = $this->Front_model->checkMyTour($this->session->userdata('d168_id'),'after_portfolio');
    if(!$my_tour2){  // if tour shown till portfolio, show remaining tour
        ?>
        <script type="text/javascript">
            var steps = [
                {
                    title: "Portfolio",
                    id: "tour_portfolio",
                    content: "<p class='popover-content'>Portfolios are an easy-to-understand way to manage your teams, projects, and tasks without the clutter – keeping things for everyone on the team clean and productive.</p><p class='popover-content'>When creating a Portfolio, you can select from a list of standard departments or areas that are relevant to you or create custom ones.</p>"
                },
                {
                    title: "Goals & Strategies",
                    id: "tour_goals",
                    content: "<p class='popover-content'>Goals and Strategies allow to plan, implement, and track the progress of projects and related tasks towards intended results over a given period. G&S aligns the tangible activities required in an organizational structure: Vision, Strategy, Objectives, Critical Success Factors, KPIs / Initiatives, and Actions – Doing so allows you to focus on what matters most, and to monitor your organizational progress from multiple views.</p><p class='popover-content'>You can quickly identify long or short-term goals, plan projects with targeted start and completion date ranges, assign resources, departments & teams accordingly.</p>"
                },
                {
                    title: "Projects",
                    id: "tour_projects",
                    content: "<p class='popover-content'>Your Projects can be standalone or a part of your Goals & Strategies. From here you can easily access the projects that you create and add team members, assign tasks, subtasks, and due dates accordingly.  You can also view, the percentage of completion. The transparency into open tasks and subtasks allows for more informed decision making when it comes to pending work that may need attention.</p>"
                },
                {
                    title: "Tasks",
                    id: "tour_tasks",
                    content: "<p class='popover-content'>Similar to projects, your tasks can be part of actual projects or be standalone tasks. Here you can view all the details of tasks and associated subtasks, if any. You can easily add, edit, delete, complete, or file tasks and subtasks accordingly.</p>"
                },
                {
                    title: "Content Planner",
                    id: "tour_content",
                    content: "<p class='popover-content'>After creating a content project or By selecting any content project from list, it will redirect to overview.</p><p class='popover-content'>It has same functionality like project overview with option of add new content.</p>"
                },
                {
                    title: "File Cabinet",
                    id: "tour_file_cabinet",
                    content: "<p class='popover-content'>All Files of file it goals, projects, tasks, subtasks and content of selected portfolio are shown in tree structure and card view department wise.</p>"
                },
                {
                    title: "Archive",
                    id: "tour_archive",
                    content: "<p class='popover-content'>All Archive goals, projects, tasks, subtasks and content of selected portfolio are shown with filter and reopen option. Clicked on reopen then the selected data will reopen and placed to its original position.</p>"
                },
                {
                    title: "Trash",
                    id: "tour_trash",
                    content: "<p class='popover-content'>All deleted projects, tasks, subtasks, files and content of selected portfolio are shown with filter and restore option. Clicked on restore then the selected data will restored and placed to its original position. (If any data do not restore within 30 days of its deleted date, then that data will be deleted permanently!)</p>"
                },
                {
                    title: "Support",
                    id: "tour_support",
                    content: "<p class='popover-content'>The “Support” option redirects the user to the support link for the platform.</p>"
                },
            ];
            var tour = new Tour(steps);
            tour.show();
        </script>
        <?php
        $data = array(  'reg_id' => $this->session->userdata('d168_id'),
                        'name' => 'after_portfolio',
                        'date' => date('Y-m-d H:i:s')
                     );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->insertInTour($data);  
    }
    ?>
    <script type="text/javascript">
        $('.tour-finish').on('click', function(e){ 
            debugger;
          // AJAX request
          $.ajax({
            url:  base_url+'front/getStarted_Modal',
            type: 'post',
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#getStartedModal_content').html(data);
              // Display Modal
              $('#getStartedModal').modal('show'); 
            }
          });
        });
    </script>
    <?php
}else{ // if not portfolio selected
    $my_tour = $this->Front_model->checkMyTour($this->session->userdata('d168_id'),'till_portfolio');
    if(!$my_tour){  // if tour not shown till portfolio, show tour till portfolio
        ?>
        <script type="text/javascript">
            localStorage.setItem('tour_session', 'skip_tour');
            var steps = [
                {
                title: "Start My Tour",
                content: "<p class='popover-content'>Welcome, let's start your tour through the DECISION 168 platform. Once you begin, you can navigate with the next or previous buttons, or start from the beginning by clicking restart. To make it even the tour even easier, you can click on the little indicator thingys as you like.</p>"
                }, 
                {
                    title: "The Dashboard",
                    id: "tour_coverpage",
                    content: "<p class='popover-content'>This is your personal dashboard where you have quick access to your profile and stats, such as the number of portfolio and projects that you are associated with, as well as tasks that are assigned to you. if you are subscribed to Content Planner module, you'll see those stats also.</p><p class='popover-content'>*You can update your header and profile images when setting up your profile (more on that later). </p>"
                }, 
                {
                    title: "Motivator",
                    id: "tour_motivational_quotes",
                    content: "<p class='popover-content'>The \"Motivator\" section is packed with uplifting quotes that will give you the boost you need to tackle any challenge. Submit your own quote to inspire others and see it featured on our dashboard. A fresh motivational quote is shown everytime you visit your dashboard.</p>"
                },
                {
                    title: "My Day",
                    id: "tour_my_day",
                    content: "<p class='popover-content'>In the \"My Day\" column, users can easily view their meetings, events, tasks, subtasks, and todos for the curent day, along with the ability to access the listed items via a quick link.</p>"
                },
                {
                    title: "My Next 168",
                    id: "tour_my_next168",
                    content: "<p class='popover-content'>In the \"My Next 168\" column, you can quickly view what you have coming up within the next 168 hours (or week). You can scroll down easily as well as click on a particular item for more details.</p>"
                },
                {
                    title: "My Alerts",
                    id: "tour_my_alerts",
                    content: "<p class='popover-content'>In the \"My Alerts\" column is where you can easily find the alerts for any goal, project, task, meetings, etc. that you have notifications for. You can scroll down quickly as well as click on a particular alere for more details.</p>"
                },
                {
                    title: "Portfolio Drop Down",
                    id: "tour_change_portfolio",
                    content: "<p class='popover-content'>The \"Portfolio\" dropdown displays the portfolio that has been selected. If a particular portfolio is not selected, you can select the desired one from the dropdown list or create additional ones based on your subscription. If a portfolio is selected, the user will see options such as “Dashboard”, “Portfolio”, “Projects”, “Tasks”, “Content Planner”, “Archive”, “Trash”, and “File Cabinet” on the sidebar to the left.</p>"
                },
                {
                    title: "Upgrade Button",
                    id: "tour_upgrade_button",
                    content: "<p class='popover-content'>Clicking the “Upgrade” button will redirect you to subscription level where you can choose a plan. The “Downgrade” option allows users to switch back to a free account, with a full refund available within 30 days of the subscription. The “Upgrade” option allows users to switch to a different subscription plan, with a prorated charge applied.</p>"
                },
                {
                    title: "Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>Clicking on the \"Profile\" dropdown will show options for \"My Profile\", \"Setting\", \"Support\", \"My Tour\", \"Get Started\" and \"Logout\". You can select the option of your choice and follow the prompts accordingly.</p>"
                },
                {
                    title: "Calendar",
                    id: "tour_calendar",
                    content: "<p class='popover-content'>The calendar functionality allows you to create and view events, meetings, to-dos, and reminders on a calendar. When the user clicks on the “Calendar” option, they will see a calendar view with options for month, week, day, and list. The calendar displays all created events, meetings, to-dos, and reminders, as well as an option to create draggable events for repeat events that can quickly be dropped to the desired date and times.</p>"
                },
                {
                    title: "Support",
                    id: "tour_support",
                    content: "<p class='popover-content'>The “Support” option redirects the user to the support link for the platform.</p>"
                },
                {
                    title: "Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>From here you can start your tour again by clicking on My Tour</p>"
                },
            ];
            var tour = new Tour(steps);
            tour.show();
            localStorage.setItem('tour_session','next');
        </script>
        <?php
        $data = array(  'reg_id' => $this->session->userdata('d168_id'),
                        'name' => 'till_portfolio',
                        'date' => date('Y-m-d H:i:s')
                     );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->insertInTour($data);
    }
    ?>
    <script type="text/javascript">
        $('.tour-finish').on('click', function(e){ 
          // AJAX request
          $.ajax({
            url:  base_url+'front/getStarted_Modal',
            type: 'post',
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#getStartedModal_content').html(data);
              // Display Modal
              $('#getStartedModal').modal('show'); 
            }
          });
        });
    </script>
    <?php
}
?>