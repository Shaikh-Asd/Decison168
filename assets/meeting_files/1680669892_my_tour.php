<?php
if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
    ?>
    <script type="text/javascript">
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "yes")
          {
            var steps = [
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Start the tour to the Platform.</p>"
                }, 
                {
                    title: "Dashboard",
                    id: "tour_coverpage",
                    content: "<p class='popover-content'>The main screen of the dashboard shows the user’s profile and statistics, such as the total number of portfolios, projects, and planned contents. It also displays the user’s incomplete tasks and subtasks, along with an option to view their profile.</p>"
                }, 
                {
                    title: "Dashboard: Motivator",
                    id: "tour_motivational_quotes",
                    content: "<p class='popover-content'>The “Motivator” section shows a motivational quote and includes a “Submit A Quote” option for users to request to have their quote displayed on the dashboard.</p>"
                },
                {
                    title: "Dashboard: My Day",
                    id: "tour_my_day",
                    content: "<p class='popover-content'>The “My Day” sections show the user’s tasks and subtasks for the current day, respectively, with an option to view all tasks in each section.</p>"
                },
                {
                    title: "Dashboard: My Next 168",
                    id: "tour_my_next168",
                    content: "<p class='popover-content'>The “My Next 168” sections show the user’s tasks and subtasks for the current week, respectively, with an option to view all tasks in each section.</p>"
                },
                {
                    title: "Dashboard: My Alerts",
                    id: "tour_my_alerts",
                    content: "<p class='popover-content'>The “My Alerts” section shows overdue tasks and subtasks, with an option to view all alerts.</p>"
                },
                {
                    title: "Navigation Bar: Portfolio",
                    id: "tour_change_portfolio",
                    content: "<p class='popover-content'>The sidebar on the dashboard displays different options depending on whether a portfolio has been selected. If a portfolio is not selected, the user can select one from the list or create a new one. If a portfolio is selected, the user will see options such as “Dashboard”, “Portfolio”, “Projects”, “Tasks”, “Content Planner”, “Archive”, “Trash”, and “File Cabinet”.</p>"
                },
                {
                    title: "Navigation Bar: Upgrade Plan",
                    id: "tour_upgrade_button",
                    content: "<p class='popover-content'>Clicking on “Upgrade” will redirect the user to pricing packages where they can choose a subscription plan. The “Downgrade” option allows users to switch back to a free account, with a full refund available within 30 days of the subscription. The “Upgrade” option allows users to switch to a different subscription plan, with a prorated charge applied.</p>"
                },
                {
                    title: "Navigation Bar: Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>Clicking on Profile will show option for My Profile, Setting, Support, My Tour, Get Started and Logout</p>"
                },
                {
                    title: "Sidebar: Calendar",
                    id: "tour_calendar",
                    content: "<p class='popover-content'>The Calendar functionality on the DECISION 168 platform allows users to create and view events, to-dos, and reminders on a calendar. When the user clicks on the “Calendar” option, they will see a calendar view with options for month, week, day, and list. The calendar displays all created events, to-dos, and reminders, as well as an option to create a draggable event.</p>"
                },
                {
                    title: "Sidebar: Portfolio",
                    id: "tour_portfolio",
                    content: "<p class='popover-content'>Portfolios are an easy-to-understand way to manage your teams, projects, and tasks without the clutter – keeping things for everyone on the team clean and productive.</p><p class='popover-content'>When creating a Portfolio, you can select from a list of standard departments or areas that are relevant to you or create custom ones.  The standard departments/areas will have pre-built project templates added so that you can customize tasks based on your specific needs.  Additionally, these areas will allow for detailed reporting, file management, and searchability down the road</p>"
                },
                {
                    title: "Sidebar: Goals & Strategies",
                    id: "tour_goals",
                    content: "<p class='popover-content'>Measure what is intended to be measured to help inform better decision making. Like KPIs, the Goals and Strategies allow to plan, implement, and track the progress of projects and related tasks towards intended results over a given period. G&S aligns the tangible activities required in an organizational structure: Vision, Strategy, Objectives, Critical Success Factors, KPIs, Actions – Doing so allows you to focus on what matters most, and to monitor your organizational progress from multiple views.</p><ul><li>Identify long or short-term goals</li><li>Plan targeted start and completion date range</li><li>Assign Departments & Teams</li><li>Organizational Reporting of Analytics</li></ul>"
                },
                {
                    title: "Sidebar: Projects",
                    id: "tour_projects",
                    content: "<p class='popover-content'>Projects live under and within Portfolios</p><p class='popover-content'>The ease of navigation and percentage-based tracking of projects and individual team members allows for transparent accountability. Areas of where a team member may be stuck, or assistance is needed is easily identifiable and are able to be communicated quickly to keep complex projects moving forward.</p>"
                },
                {
                    title: "Sidebar: Tasks",
                    id: "tour_tasks",
                    content: "<p class='popover-content'>It shows all details of tasks and its subtask. And also shows multiple options like add task, add subtask, edit task, archive task and delete task.</p>"
                },
                {
                    title: "Sidebar: Content Planner",
                    id: "tour_content",
                    content: "<p class='popover-content'>After creating a content project or By selecting any content project from list, it will redirect to overview.</p><p class='popover-content'>It has same functionality like project overview with option of add new content.</p>"
                },
                {
                    title: "Sidebar: Archive",
                    id: "tour_archive",
                    content: "<p class='popover-content'>All Archive goals, projects, tasks, subtasks and content of selected portfolio are shown with filter and reopen option. Clicked on reopen then the selected data will reopen and placed to its original position.</p>"
                },
                {
                    title: "Sidebar: File Cabinet",
                    id: "tour_file_cabinet",
                    content: "<p class='popover-content'>All Files of file it goals, projects, tasks, subtasks and content of selected portfolio are shown in tree structure and card view department wise.</p>"
                },
                {
                    title: "Sidebar: Trash",
                    id: "tour_trash",
                    content: "<p class='popover-content'>All deleted projects, tasks, subtasks, files and content of selected portfolio are shown with filter and restore option. Clicked on restore then the selected data will restored and placed to its original position. (If any data do not restore within 30 days of its deleted date, then that data will be deleted permanently!)</p>"
                },
                {
                    title: "Sidebar: Support",
                    id: "tour_support",
                    content: "<p class='popover-content'>The “Support” option redirects the user to the support link for the platform.</p>"
                },
            ];
            var my_tour = new Tour(steps);
            my_tour.show();
            localStorage.setItem('tour_session', 'no');
          }
        }
    </script>
    <?php
}else{ // if not portfolio selected
    ?>
    <script type="text/javascript">
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "yes")
          {
            localStorage.setItem('tour_session', 'no');
            var steps = [
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Start the tour to the Platform.</p>"
                }, 
                {
                    title: "Dashboard",
                    id: "tour_coverpage",
                    content: "<p class='popover-content'>The main screen of the dashboard shows the user’s profile and statistics, such as the total number of portfolios, projects, and planned contents. It also displays the user’s incomplete tasks and subtasks, along with an option to view their profile.</p>"
                }, 
                {
                    title: "Dashboard: Motivator",
                    id: "tour_motivational_quotes",
                    content: "<p class='popover-content'>The “Motivator” section shows a motivational quote and includes a “Submit A Quote” option for users to request to have their quote displayed on the dashboard.</p>"
                },
                {
                    title: "Dashboard: My Day",
                    id: "tour_my_day",
                    content: "<p class='popover-content'>The “My Day” sections show the user’s tasks and subtasks for the current day, respectively, with an option to view all tasks in each section.</p>"
                },
                {
                    title: "Dashboard: My Next 168",
                    id: "tour_my_next168",
                    content: "<p class='popover-content'>The “My Next 168” sections show the user’s tasks and subtasks for the current week, respectively, with an option to view all tasks in each section.</p>"
                },
                {
                    title: "Dashboard: My Alerts",
                    id: "tour_my_alerts",
                    content: "<p class='popover-content'>The “My Alerts” section shows overdue tasks and subtasks, with an option to view all alerts.</p>"
                },
                {
                    title: "Navigation Bar: Portfolio",
                    id: "tour_change_portfolio",
                    content: "<p class='popover-content'>The sidebar on the dashboard displays different options depending on whether a portfolio has been selected. If a portfolio is not selected, the user can select one from the list or create a new one. If a portfolio is selected, the user will see options such as “Dashboard”, “Portfolio”, “Projects”, “Tasks”, “Content Planner”, “Archive”, “Trash”, and “File Cabinet”.</p>"
                },
                {
                    title: "Navigation Bar: Upgrade Plan",
                    id: "tour_upgrade_button",
                    content: "<p class='popover-content'>Clicking on “Upgrade” will redirect the user to pricing packages where they can choose a subscription plan. The “Downgrade” option allows users to switch back to a free account, with a full refund available within 30 days of the subscription. The “Upgrade” option allows users to switch to a different subscription plan, with a prorated charge applied.</p>"
                },
                {
                    title: "Navigation Bar: Profile",
                    id: "tour_logout_menu",
                    content: "<p class='popover-content'>Clicking on Profile will show option for My Profile, Setting, Support, My Tour, Get Started and Logout</p>"
                },
                {
                    title: "Sidebar: Calendar",
                    id: "tour_calendar",
                    content: "<p class='popover-content'>The Calendar functionality on the DECISION 168 platform allows users to create and view events, to-dos, and reminders on a calendar. When the user clicks on the “Calendar” option, they will see a calendar view with options for month, week, day, and list. The calendar displays all created events, to-dos, and reminders, as well as an option to create a draggable event.</p>"
                },
                {
                    title: "Sidebar: Support",
                    id: "tour_support",
                    content: "<p class='popover-content'>The “Support” option redirects the user to the support link for the platform.</p>"
                },
            ];
            var my_tour = new Tour(steps);
            my_tour.show();            
          }
        }
    </script>
    <?php
}
?>