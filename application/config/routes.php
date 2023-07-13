<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'front';
$route['dashboard'] = 'front/dashboard';
$route['calendar'] = 'front/calendar';
$route['calendar-event-list'] = 'front/calendar_event_list';
$route['calendar-todo-list'] = 'front/calendar_todo_list';
$route['calendar-reminder-list'] = 'front/calendar_reminder_list';
$route['profile'] = 'front/profile';
$route['update-profile'] = 'front/update_profile';
$route['chat'] = 'front/chat';
$route['file-manager'] = 'front/file_manager';
$route['crypto-kyc-application'] = 'front/crypto_kyc_application';
//$route['crypto-ico-landing'] = 'front/crypto_ico_landing';
$route['email-basic'] = 'front/email_template_basic';
$route['email-alert'] = 'front/email_template_alert';
$route['email-billing'] = 'front/email_template_billing';
$route['projects-grid'] = 'front/projects_grid';
$route['projects-list'] = 'front/projects_list';
$route['projects-overview/(:num)'] = 'front/projects_overview';
$route['projects-create'] = 'front/projects_create';
$route['projects-edit/(:num)'] = 'front/projects_edit';
$route['tasks-list'] = 'front/tasks_list';
$route['tasks-kanban'] = 'front/tasks_kanban';
$route['tasks-create'] = 'front/tasks_create';
$route['contacts-grid'] = 'front/contacts_grid';
$route['contacts-list'] = 'front/contacts_list';
$route['contacts-profile'] = 'front/contacts_profile';
$route['login'] = 'front/login';
$route['register'] = 'front/register';
$route['corporate-registration/(:any)'] = 'front/corporate_registration'; //corporate registration
$route['reset-password'] = 'front/reset_password';
$route['maintenance'] = 'front/maintenance';
$route['faq'] = 'front/faq';
$route['pricing'] = 'front/pricing';
$route['page-404'] = 'front/page_404';
$route['sweet-alert'] = 'front/sweet_alert';
$route['video'] = 'front/video';
$route['callback'] = 'front/callback';
$route['change-password/(:num)/(:any)/(:any)']	= 'front/change_password/$1/$1/$1';
$route['account-verification/(:num)/(:any)/(:any)']	= 'front/account_verify/$1/$1/$1';
$route['project-request/(:num)/(:num)/(:num)/(:num)']	= 'front/project_request';
$route['project-invite-reject-request/(:num)/(:num)/(:num)']	= 'front/project_invite_reject_request';
$route['projects-overview-accepted/(:num)'] = 'front/projects_overview_accepted';
$route['projects-overview-request/(:num)'] = 'front/projects_overview_request';
$route['projects-request2/(:num)/(:num)'] = 'front/projects_request2';
$route['projects-modal-request2/(:num)/(:num)'] = 'front/projectsModal_request2';
$route['projects-accepted-edit/(:num)'] = 'front/projects_accepted_edit';
$route['project-edit-request/(:num)/(:num)/(:num)/(:num)'] = 'front/project_edit_request';
//$route['team-view-profile/(:num)'] = 'front/team_view_profile';
$route['my-created-projects'] = 'front/my_created_projects';
$route['my-accepted-projects'] = 'front/my_accepted_projects';
$route['pending-projects-request'] = 'front/pending_projects_request';
$route['readmore-projects-request'] = 'front/readmore_projects_request';
$route['project-approved-edit-details/(:num)/(:num)/(:num)/(:num)'] = 'front/project_approved_edit_details';
$route['view-project-history'] = 'front/view_project_history';
$route['tasks-overview/(:num)'] = 'front/tasks_overview';
$route['team-member-tasks-list/(:num)/(:num)'] = 'front/team_member_tasks_list';
$route['tasks-edit/(:num)'] = 'front/tasks_edit';
$route['project-tasks-list/(:num)'] = 'front/project_tasks_list';
$route['change_taskStatus'] = 'front/change_taskStatus';
$route['all-tasks'] = 'front/all_tasks';
$route['today-tasks'] = 'front/today_tasks';
$route['tomorrow-tasks'] = 'front/tomorrow_tasks';
$route['week-tasks'] = 'front/week_tasks';
//$route['trash-tasks'] = 'front/trash_tasks';
$route['overdue-tasks'] = 'front/overdue_tasks';
//$route['trash-projects'] = 'front/trash_projects';
$route['portfolio'] = 'front/portfolio';
$route['portfolio-projects/(:num)'] = 'front/portfolio_projects';
$route['my-portfolio'] = 'front/my_portfolio';
//$route['trash-portfolio'] = 'front/trash_portfolio';
$route['portfolio-create'] = 'front/portfolio_create';
$route['portfolio-edit/(:num)'] = 'front/portfolio_edit';
$route['company-portfolio'] = 'front/company_portfolio';
$route['my-company-portfolio'] = 'front/my_company_portfolio';
$route['individual-portfolio'] = 'front/individual_portfolio';
$route['my-individual-portfolio'] = 'front/my_individual_portfolio';
//$route['portfolio-view/(:num)'] = 'front/portfolio_view';
$route['portfolio-view'] = 'front/portfolio_view';
$route['my-alerts'] = 'front/my_alerts';
$route['portfolio-tasks/(:num)'] = 'front/portfolio_tasks';
//$route['trash-project-files'] = 'front/trash_project_files';
//$route['trash-task-files'] = 'front/trash_task_files';
$route['change-my-password'] = 'front/change_my_password';
$route['portfolio-invite-accept-request/(:num)/(:num)/(:num)'] = 'front/portfolio_invite_accept_request';
$route['portfolio-invite-reject-request/(:num)/(:num)/(:num)'] = 'front/portfolio_invite_reject_request';
$route['trash'] = 'front/trash';
$route['subtasks-create'] = 'front/subtasks_create';
$route['change_subtaskStatus'] = 'front/change_subtaskStatus';
$route['subtasks-overview/(:num)'] = 'front/subtasks_overview';
$route['archive'] = 'front/archive';
$route['content-planning'] = 'front/content_planning';
$route['portfolio-projects-content/(:num)'] = 'front/portfolio_projects_content';
$route['portfolio-projects-list/(:num)'] = 'front/portfolio_projects_list';
$route['portfolio-tasks-list/(:num)'] = 'front/portfolio_tasks_list';
$route['portfolio-project-tasks-search'] = 'front/portfolio_project_tasks_search';
$route['projects-tasks-search-list'] = 'front/projects_tasks_search_list';
//$route['portfolio-project-content-search-list'] = 'front/portfolio_project_content_search_list';
$route['content-project-create'] = 'front/content_project_create';
$route['contents-list'] = 'front/contents_list';
$route['portfolio-contents/(:num)'] = 'front/portfolio_contents';
$route['add-team-member/(:num)/(:num)/(:num)'] = 'front/add_team_member';
$route['pricing-packages'] = 'front/pricing_packages';
$route['payment-gateway'] = 'front/redirect_payment_gateway';
$route['set-price-id-session'] = 'front/set_price_id_session';
$route['checkout-payment-initialize'] = 'front/checkout_payment_initialize';
$route['insert-checkout-payment-data'] = 'front/insert_checkout_payment_data';
$route['update-subscription'] = 'front/update_subscription';
$route['tasks-date-filter-search'] = 'front/task_date_filter_search';
$route['send-activate-account-request/(:num)/(:num)'] = 'front/send_activate_account_request';
$route['auto-email-happy-birthday'] = 'front/auto_email_happy_birthday';
$route['auto-email-inactivity-account'] = 'front/auto_email_inactivity_account';
$route['auto-email-calendar-reminder'] = 'front/auto_email_calendar_reminder';
$route['auto-email-calendar-reminder-non-register-user'] = 'front/auto_email_calendar_reminder_non_register_user';
$route['auto-email-calendar-inside-todo-reminder'] = 'front/auto_email_calendar_inside_todo_reminder';
$route['portfolio-goals/(:num)'] = 'front/portfolio_goals';
// $route['portfolio-goal-strategies/(:num)'] = 'front/portfolio_goal_strategies';
// $route['portfolio-goals-strategies-projects/(:num)'] = 'front/portfolio_goals_strategies_projects';
$route['goal-create'] = 'front/goal_create';
$route['goals-list'] = 'front/goals_list';
$route['goal-overview/(:num)'] = 'front/goal_overview';
$route['goal-kpi-create'] = 'front/goal_strategies_create';
$route['kpi-overview/(:num)'] = 'front/strategies_overview';
$route['view-goal-history'] = 'front/view_goal_history';
$route['view-kpi-history'] = 'front/view_strategy_history';
$route['meeting-request/(:any)/(:num)/(:num)']	= 'front/meeting_request';
$route['meeting-request2/(:any)/(:num)/(:num)']	= 'front/meeting_request2';
$route['meeting-request-invited-member/(:any)/(:num)/(:num)']	= 'front/meeting_request_invited_member';
$route['file-cabinet'] = 'front/file_cabinet';
$route['my-report'] = 'front/userReport';
$route['portfolio-report/(:num)'] = 'front/portfolioReport';
$route['goal-request/(:num)/(:num)/(:num)/(:num)']	= 'front/goal_request';
$route['goal-request2/(:num)/(:num)/(:num)']	= 'front/goal_request2';
$route['goal-modal-request2/(:num)/(:num)/(:num)'] = 'front/goalModal_request2';
$route['goal-invite-reject-request/(:num)/(:num)/(:num)']	= 'front/goal_invite_reject_request';
$route['goal-overview-request/(:num)'] = 'front/goal_overview_request';
$route['preview-permission-request/(:num)/(:num)']	= 'front/preview_permission_request';
$route['preview-permission-request2/(:num)/(:num)']	= 'front/preview_permission_request2';
$route['notes-list'] = 'front/notesList';

// Expert panel	
$route['community'] = 'front/community';	
$route['decision-maker/(:num)/(:any)'] = 'front/decision_maker/$1/$2';	
$route['all-calls'] = 'front/all_calls';	
$route['user-all-calls'] = 'front/user_all_calls';	
$route['video-session/(:any)/(:num)'] = 'front/video_session/$1/$2';


//Super Admin Panel
$route['super-admin'] = 'superadmin/index';
$route['super-admin/dashboard'] = 'superadmin/dashboard';
$route['super-admin/login'] = 'superadmin/login';
$route['super-admin/registered-list'] = 'superadmin/registered_list';
$route['super-admin/deactivated-users'] = 'superadmin/deactivated_users';
$route['super-admin/quotes-list'] = 'superadmin/quotes_list';
$route['quote-approve-request/(:num)/(:num)/(:num)']	= 'superadmin/quote_approve_request';
$route['quote-deny-request/(:num)/(:num)/(:num)']	= 'superadmin/quote_deny_request';
// $route['super-admin/logo-list'] = 'superadmin/logo_list';
$route['logo-approve-request/(:num)/(:num)/(:num)']	= 'superadmin/logo_approve_request';
$route['logo-deny-request/(:num)/(:num)/(:num)']	= 'superadmin/logo_deny_request';
$route['super-admin/pricing-list'] = 'superadmin/pricing_list';
$route['super-admin/refund-list'] = 'superadmin/refund_list';
$route['user-activate-account-request/(:num)/(:num)/(:num)']	= 'superadmin/user_activate_account_request';
$route['super-admin/contacted-sales-list'] = 'superadmin/contacted_sales_list';
$route['super-admin/ad-list'] = 'superadmin/ad_list';
$route['super-admin/coupon-list'] = 'superadmin/coupon_list';
$route['super-admin/coupon-used-users/(:num)'] = 'superadmin/coupon_used_users';

$route['super-admin/support-list'] = 'superadmin/support';
$route['supporter-invitation/(:any)/(:num)'] = 'superadmin/supporter_invitation/$1/$1';
$route['supporter-invitation-through-email/(:any)/(:any)'] = 'superadmin/supporter_invitation_through_email/$1/$1';
$route['super-admin/supporters'] = 'superadmin/registered_supporters';
$route['super-admin/ticket-overview/(:num)'] = 'superadmin/ticketOverview/$1';
$route['super-admin/chat-history'] = 'superadmin/chat_history';
$route['super-admin/download-chat/(:num)'] = 'superadmin/download_chat/$1';
// Expert panel	
$route['super-admin/community'] = 'superadmin/community';


//Company panel
$route['company'] = 'company/index';
$route['company/dashboard'] = 'company/dashboard';
$route['company/login'] = 'company/login';
$route['company/pricing-package'] = 'company/pricing_package';
$route['set-price-id-session-comp'] = 'company/set_price_id_session_comp';
$route['checkout-payment-initialize-comp'] = 'company/checkout_payment_initialize_comp';
$route['insert-checkout-payment-data-comp'] = 'company/insert_checkout_payment_data_comp';
$route['auto-renew-package-payment-comp'] = 'company/auto_renew_package_payment_comp';
$route['auto-extended-pack-notify-block-comp'] = 'company/auto_extended_pack_notify_block_comp';
$route['auto-expired-pack-notify-delete-comp'] = 'company/auto_expired_pack_notify_delete_comp';
$route['company/reset-password'] = 'company/reset_password';
$route['change-password-company/(:num)/(:any)/(:any)']	= 'company/change_password_company/$1/$1/$1';
$route['company/team-members'] = 'company/team_members';
$route['company/roles'] = 'company/roles';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;