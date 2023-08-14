var base_url = 'http://localhost/decision168/';
$(document).ready(function(){
//collapse sidebar start
$('.fixed-sidebar-cust').on('click', function(e){ 
  if($('body').hasClass('sidebar-enable vertical-collpsed'))
  {
    localStorage.setItem('collapseSidebar', 'minimizedSidebar');
  }
  else
  {
    localStorage.setItem('collapseSidebar', 'maximizedSidebar');
  }
});
var collapseSidebar = localStorage.getItem('collapseSidebar');
if(collapseSidebar)
{
  if(collapseSidebar == "minimizedSidebar")
  {
    $('body').addClass('sidebar-enable vertical-collpsed');
  }
  else
  {
    $('body').removeClass('sidebar-enable vertical-collpsed');
  }
}
//collapse sidebar end

//start of new notification on top
var board = $("#new_notify_top_div");
var boards = board.children('.new_notify_top').detach().get();
boards.sort(function(a, b) {
    //debugger;
    return new Date($(b).data("topdate")) - new Date($(a).data("topdate"));
  });
board.append(boards);
// end of new notification on top

//dashboard my next168 date alignment
var board = $("#dash_next168_date_top");
var boards = board.children('.next168_date_top').detach().get();
boards.sort(function(a, b) {
    //debugger;
    return new Date($(a).data("dashrecentdate")) - new Date($(b).data("dashrecentdate"));
  });
board.append(boards);
//dashboard my next168 date alignment

//dashboard my alert date alignment
var board = $("#dash_alert_date_top");
var boards = board.children('.alert_date_top').detach().get();
boards.sort(function(a, b) {
    //debugger;
    return new Date($(b).data("dashrecentoddate")) - new Date($(a).data("dashrecentoddate"));
  });
board.append(boards);
//dashboard my alert date alignment

//keep selected view
$('a[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    //debugger;
    if(activeTab == "#v-pills-list")
    {
      $('#portfolio_filter_option').hide();
      $('#v-pills-list-tab').prop('aria-selected', true);
      $('#v-pills-grid-tab').prop('aria-selected', false);
      $('#v-pills-list-tab').addClass('active');
      $('#v-pills-grid-tab').removeClass('active');
      $('#v-pills-list').addClass('show active');
      $('#v-pills-grid').removeClass('show active');
    }
  }
//keep selected view ends

//back from task list page
  $('#redirect_task_list').prop('checked',false);
//back from task list page ends

//start of tduedate on top
var board = $("#refresh_tasklist_status_change");
var boards = board.children('.new_tid_top').detach().get();
boards.sort(function(a, b) {
    //debugger;
    return new Date($(b).data("toptid")) - new Date($(a).data("toptid"));
  });
board.append(boards);
// end of tduedate on top

//keep selected project filter
$('input[name="filter_proj"]').on('click', function(e) {
  //debugger;
  localStorage.setItem('created_project2', "");
  localStorage.setItem('accepted_project2', "");
  localStorage.setItem('pending_project2', "");
  localStorage.setItem('more_project2', "");
  localStorage.setItem('all_project2', "");
  localStorage.setItem('regular_project2', "");
  localStorage.setItem('goal_project2', "");
  if($(e.target).attr('id') == 'created_project')
  {
    localStorage.setItem('created_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('created_project1', "");
  }
  if($(e.target).attr('id') == 'accepted_project')
  {
    localStorage.setItem('accepted_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('accepted_project1', "");
  }
  if($(e.target).attr('id') == 'pending_project')
  {
    localStorage.setItem('pending_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('pending_project1', "");
  }
  if($(e.target).attr('id') == 'more_project')
  {
    localStorage.setItem('more_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('more_project1', "");
  }
  if($(e.target).attr('id') == 'all_project')
  {
    localStorage.setItem('all_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_project1', "");
  }
  if($(e.target).attr('id') == 'regular_project')
  {
    localStorage.setItem('regular_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('regular_project1', "");
  }
  if($(e.target).attr('id') == 'goal_project')
  {
    localStorage.setItem('goal_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('goal_project1', "");
  }
  });
   var created_project1 = localStorage.getItem('created_project1');
   var accepted_project1 = localStorage.getItem('accepted_project1');
   var pending_project1 = localStorage.getItem('pending_project1');
   var more_project1 = localStorage.getItem('more_project1');
   var all_project1 = localStorage.getItem('all_project1');
   var regular_project1 = localStorage.getItem('regular_project1');
   var goal_project1 = localStorage.getItem('goal_project1');
   //console.log(pending_project1);
  if(created_project1){
    //console.log(created_project1);
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',true);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(accepted_project1){
    //console.log(accepted_project1);
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',true);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(pending_project1){
    //console.log(pending_project1);
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',true);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   }
  if(more_project1){
    //console.log(more_project1);
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',true);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(all_project1){
    //console.log('allp');
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',true);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(regular_project1){
    //debugger;
    //console.log(regular_project1)
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').hide();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project').prop('checked',true);
    $('#goal_project').prop('checked',false);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(goal_project1){
    //console.log(goal_project1)
    //div visibility
    $('.regular_proj').hide();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project').prop('checked',false);
    $('#goal_project').prop('checked',true);
    $('#created_project').prop('checked',false);
    $('#accepted_project').prop('checked',false);
    $('#pending_project').prop('checked',false);
    $('#more_project').prop('checked',false);
    $('#all_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }

  $('input[name="filter_proj2"]').on('click', function(e) {
  //debugger;
  localStorage.setItem('created_project1', "");
  localStorage.setItem('accepted_project1', "");
  localStorage.setItem('pending_project1', "");
  localStorage.setItem('more_project1', "");
  localStorage.setItem('all_project1', "");
  localStorage.setItem('regular_project1', "");
  localStorage.setItem('goal_project1', "");
  if($(e.target).attr('id') == 'created_project2')
  {
    localStorage.setItem('created_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('created_project2', "");
  }
  if($(e.target).attr('id') == 'accepted_project2')
  {
    localStorage.setItem('accepted_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('accepted_project2', "");
  }
  if($(e.target).attr('id') == 'pending_project2')
  {
    localStorage.setItem('pending_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('pending_project2', "");
  }
  if($(e.target).attr('id') == 'more_project2')
  {
    localStorage.setItem('more_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('more_project2', "");
  }
  if($(e.target).attr('id') == 'all_project2')
  {
    localStorage.setItem('all_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_project2', "");
  }
  if($(e.target).attr('id') == 'regular_project2')
  {
    localStorage.setItem('regular_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('regular_project2', "");
  }
  if($(e.target).attr('id') == 'goal_project2')
  {
    localStorage.setItem('goal_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('goal_project2', "");
  }
  });
   var created_project2 = localStorage.getItem('created_project2');
   var accepted_project2 = localStorage.getItem('accepted_project2');
   var pending_project2 = localStorage.getItem('pending_project2');
   var more_project2 = localStorage.getItem('more_project2');
   var all_project2 = localStorage.getItem('all_project2');
   var regular_project2 = localStorage.getItem('regular_project2');
   var goal_project2 = localStorage.getItem('goal_project2');
  if(created_project2){
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',true);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(accepted_project2){
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',true);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(pending_project2){
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').hide();
    $('#more_project_grid').hide();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',true);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   }
  if(more_project2){
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').hide();
    $('#created_project_grid').hide();
    $('#accepted_project_list').hide();
    $('#accepted_project_grid').hide();
    $('#pending_project_list').hide();
    $('#pending_project_grid').hide();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',true);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(all_project2){
    //console.log('allp');
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',true);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(regular_project2){
    //div visibility
    $('.regular_proj').show();
    $('.goal_proj').hide();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project2').prop('checked',true);
    $('#goal_project2').prop('checked',false);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(goal_project2){
    //div visibility
    $('.regular_proj').hide();
    $('.goal_proj').show();
    $('#created_project_list').show();
    $('#created_project_grid').show();
    $('#accepted_project_list').show();
    $('#accepted_project_grid').show();
    $('#pending_project_list').show();
    $('#pending_project_grid').show();
    $('#more_project_list').show();
    $('#more_project_grid').show();
    //radio button visibility
    $('#regular_project2').prop('checked',false);
    $('#goal_project2').prop('checked',true);
    $('#created_project2').prop('checked',false);
    $('#accepted_project2').prop('checked',false);
    $('#pending_project2').prop('checked',false);
    $('#more_project2').prop('checked',false);
    $('#all_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }

   $('input[name="filter_port_proj"]').on('click', function(e) {
  //debugger;;
  localStorage.setItem('all_port_project2', "");
  localStorage.setItem('regular_port_project2', "");
  localStorage.setItem('goal_port_project2', "");  
  if($(e.target).attr('id') == 'all_port_project')
  {
    localStorage.setItem('all_port_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_port_project1', "");
  }
  if($(e.target).attr('id') == 'regular_port_project')
  {
    localStorage.setItem('regular_port_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('regular_port_project1', "");
  }
  if($(e.target).attr('id') == 'goal_port_project')
  {
    localStorage.setItem('goal_port_project1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('goal_port_project1', "");
  }
  });
   var all_port_project1 = localStorage.getItem('all_port_project1');
   var regular_port_project1 = localStorage.getItem('regular_port_project1');
   var goal_port_project1 = localStorage.getItem('goal_port_project1');
   if(all_port_project1){
   // console.log('allp');
    //div visibility
    $('.regular_port_proj').show();
    $('.goal_port_proj').show();
    //radio button visibility
    $('#regular_port_project').prop('checked',false);
    $('#goal_port_project').prop('checked',false);
    $('#all_port_project').prop('checked',true);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(regular_port_project1){
    //div visibility
    $('.regular_port_proj').show();
    $('.goal_port_proj').hide();
    //radio button visibility
    $('#regular_port_project').prop('checked',true);
    $('#goal_port_project').prop('checked',false);
    $('#all_port_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(goal_port_project1){
    //div visibility
    $('.regular_port_proj').hide();
    $('.goal_port_proj').show();
    //radio button visibility
    $('#regular_port_project').prop('checked',false);
    $('#goal_port_project').prop('checked',true);
    $('#all_port_project').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }

   $('input[name="filter_port_proj2"]').on('click', function(e) {
  //debugger;;
  localStorage.setItem('all_port_project1', "");
  localStorage.setItem('regular_port_project1', "");
  localStorage.setItem('goal_port_project1', "");  
  if($(e.target).attr('id') == 'all_port_project2')
  {
    localStorage.setItem('all_port_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_port_project2', "");
  }
  if($(e.target).attr('id') == 'regular_port_project2')
  {
    localStorage.setItem('regular_port_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('regular_port_project2', "");
  }
  if($(e.target).attr('id') == 'goal_port_project2')
  {
    localStorage.setItem('goal_port_project2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('goal_port_project2', "");
  }
  });
   var all_port_project2 = localStorage.getItem('all_port_project2');
   var regular_port_project2 = localStorage.getItem('regular_port_project2');
   var goal_port_project2 = localStorage.getItem('goal_port_project2');
   if(all_port_project2){
   // console.log('allp');
    //div visibility
    $('.regular_port_proj').show();
    $('.goal_port_proj').show();
    //radio button visibility
    $('#regular_port_project2').prop('checked',false);
    $('#goal_port_project2').prop('checked',false);
    $('#all_port_project2').prop('checked',true);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(regular_port_project2){
    //div visibility
    $('.regular_port_proj').show();
    $('.goal_port_proj').hide();
    //radio button visibility
    $('#regular_port_project2').prop('checked',true);
    $('#goal_port_project2').prop('checked',false);
    $('#all_port_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
   if(goal_port_project2){
    //div visibility
    $('.regular_port_proj').hide();
    $('.goal_port_proj').show();
    //radio button visibility
    $('#regular_port_project2').prop('checked',false);
    $('#goal_port_project2').prop('checked',true);
    $('#all_port_project2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
//keep selected project filter ends

//keep selected goal filter
$('input[name="filter_goal"]').on('click', function(e) {
  //debugger;
  if($(e.target).attr('id') == 'created_goal')
  {
    localStorage.setItem('created_goal1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('created_goal1', "");
  }
  if($(e.target).attr('id') == 'accepted_goal')
  {
    localStorage.setItem('accepted_goal1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('accepted_goal1', "");
  }
  if($(e.target).attr('id') == 'pending_goal')
  {
    localStorage.setItem('pending_goal1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('pending_goal1', "");
  }
  if($(e.target).attr('id') == 'more_goal')
  {
    localStorage.setItem('more_goal1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('more_goal1', "");
  }
  if($(e.target).attr('id') == 'all_goal')
  {
    localStorage.setItem('all_goal1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_goal1', "");
  }
  });
   var created_goal1 = localStorage.getItem('created_goal1');
   var accepted_goal1 = localStorage.getItem('accepted_goal1');
   var pending_goal1 = localStorage.getItem('pending_goal1');
   var more_goal1 = localStorage.getItem('more_goal1');
   var all_goal1 = localStorage.getItem('all_goal1');
  if(created_goal1){
    //div visibility
    $('#created_goal_list').show();
    $('#created_goal_grid').show();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal').prop('checked',true);
    $('#accepted_goal').prop('checked',false);
    $('#pending_goal').prop('checked',false);
    $('#more_goal').prop('checked',false);
    $('#all_goal').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(accepted_goal1){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').show();
    $('#accepted_goal_grid').show();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal').prop('checked',false);
    $('#accepted_goal').prop('checked',true);
    $('#pending_goal').prop('checked',false);
    $('#more_goal').prop('checked',false);
    $('#all_goal').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(pending_goal1){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').show();
    $('#pending_goal_grid').show();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal').prop('checked',false);
    $('#accepted_goal').prop('checked',false);
    $('#pending_goal').prop('checked',true);
    $('#more_goal').prop('checked',false);
    $('#all_goal').prop('checked',false);
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   }
  if(more_goal1){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').show();
    $('#more_goal_grid').show();
    //radio button visibility
    $('#created_goal').prop('checked',false);
    $('#accepted_goal').prop('checked',false);
    $('#pending_goal').prop('checked',false);
    $('#more_goal').prop('checked',true);
    $('#all_goal').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }

   $('input[name="filter_goal2"]').on('click', function(e) {
  //debugger;
  if($(e.target).attr('id') == 'created_goal2')
  {
    localStorage.setItem('created_goal2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('created_goal2', "");
  }
  if($(e.target).attr('id') == 'accepted_goal2')
  {
    localStorage.setItem('accepted_goal2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('accepted_goal2', "");
  }
  if($(e.target).attr('id') == 'pending_goal2')
  {
    localStorage.setItem('pending_goal2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('pending_goal2', "");
  }
  if($(e.target).attr('id') == 'more_goal2')
  {
    localStorage.setItem('more_goal2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('more_goal2', "");
  }
  if($(e.target).attr('id') == 'all_goal2')
  {
    localStorage.setItem('all_goal2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_goal2', "");
  }
  });
   var created_goal2 = localStorage.getItem('created_goal2');
   var accepted_goal2 = localStorage.getItem('accepted_goal2');
   var pending_goal2 = localStorage.getItem('pending_goal2');
   var more_goal2 = localStorage.getItem('more_goal2');
   var all_goal2 = localStorage.getItem('all_goal2');
  if(created_goal2){
    //div visibility
    $('#created_goal_list').show();
    $('#created_goal_grid').show();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal2').prop('checked',true);
    $('#accepted_goal2').prop('checked',false);
    $('#pending_goal2').prop('checked',false);
    $('#more_goal2').prop('checked',false);
    $('#all_goal2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(accepted_goal2){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').show();
    $('#accepted_goal_grid').show();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal2').prop('checked',false);
    $('#accepted_goal2').prop('checked',true);
    $('#pending_goal2').prop('checked',false);
    $('#more_goal2').prop('checked',false);
    $('#all_goal2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
  if(pending_goal2){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').show();
    $('#pending_goal_grid').show();
    $('#more_goal_list').hide();
    $('#more_goal_grid').hide();
    //radio button visibility
    $('#created_goal2').prop('checked',false);
    $('#accepted_goal2').prop('checked',false);
    $('#pending_goal2').prop('checked',true);
    $('#more_goal2').prop('checked',false);
    $('#all_goal2').prop('checked',false);
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   }
  if(more_goal2){
    //div visibility
    $('#created_goal_list').hide();
    $('#created_goal_grid').hide();
    $('#accepted_goal_list').hide();
    $('#accepted_goal_grid').hide();
    $('#pending_goal_list').hide();
    $('#pending_goal_grid').hide();
    $('#more_goal_list').show();
    $('#more_goal_grid').show();
    //radio button visibility
    $('#created_goal2').prop('checked',false);
    $('#accepted_goal2').prop('checked',false);
    $('#pending_goal2').prop('checked',false);
    $('#more_goal2').prop('checked',true);
    $('#all_goal2').prop('checked',false);
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   }
//keep selected goal filter ends

//keep selected porftolio filter
$('input[name="filter_port"]').on('click', function(e) {
  //debugger;
  if($(e.target).attr('id') == 'company_portfolio')
  {
    localStorage.setItem('company_portfolio1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('company_portfolio1', "");
  }
  if($(e.target).attr('id') == 'individual_portfolio')
  {
    localStorage.setItem('individual_portfolio1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('individual_portfolio1', "");
  }
  if($(e.target).attr('id') == 'not_assigned_portfolio')
  {
    localStorage.setItem('not_assigned_portfolio1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('not_assigned_portfolio1', "");
  }
  if($(e.target).attr('id') == 'all_portfolio')
  {
    localStorage.setItem('all_portfolio1', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_portfolio1', "");
  }
  });
   var company_portfolio1 = localStorage.getItem('company_portfolio1');
   var individual_portfolio1 = localStorage.getItem('individual_portfolio1');
   var not_assigned_portfolio1 = localStorage.getItem('not_assigned_portfolio1');
   var all_portfolio1 = localStorage.getItem('all_portfolio1');
  if(company_portfolio1){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "block";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "none";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "none";
    }
    //radio button visibility
    $('#company_portfolio').prop('checked',true);
    $('#individual_portfolio').prop('checked',false);
    $('#not_assigned_portfolio').prop('checked',false);
    $('#all_portfolio').prop('checked',false);
   }
  if(individual_portfolio1){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "none";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "block";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "none";
    }
    //radio button visibility
    $('#company_portfolio').prop('checked',false);
    $('#individual_portfolio').prop('checked',true);
    $('#not_assigned_portfolio').prop('checked',false);
    $('#all_portfolio').prop('checked',false);
   }
  if(not_assigned_portfolio1){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "none";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "none";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "block";
    }
    //radio button visibility
    $('#company_portfolio').prop('checked',false);
    $('#individual_portfolio').prop('checked',false);
    $('#not_assigned_portfolio').prop('checked',true);
    $('#all_portfolio').prop('checked',false);
   }

   $('input[name="filter_port2"]').on('click', function(e) {
  //debugger;
  if($(e.target).attr('id') == 'company_portfolio2')
  {
    localStorage.setItem('company_portfolio2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('company_portfolio2', "");
  }
  if($(e.target).attr('id') == 'individual_portfolio2')
  {
    localStorage.setItem('individual_portfolio2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('individual_portfolio2', "");
  }
  if($(e.target).attr('id') == 'not_assigned_portfolio2')
  {
    localStorage.setItem('not_assigned_portfolio2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('not_assigned_portfolio2', "");
  }
  if($(e.target).attr('id') == 'all_portfolio2')
  {
    localStorage.setItem('all_portfolio2', $(e.target).attr('id'));
  }
  else
  {
    localStorage.setItem('all_portfolio2', "");
  }
  });
   var company_portfolio2 = localStorage.getItem('company_portfolio2');
   var individual_portfolio2 = localStorage.getItem('individual_portfolio2');
   var not_assigned_portfolio2 = localStorage.getItem('not_assigned_portfolio2');
   var all_portfolio2 = localStorage.getItem('all_portfolio2');
  if(company_portfolio2){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "block";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "none";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "none";
    }
    //radio button visibility
    $('#company_portfolio2').prop('checked',true);
    $('#individual_portfolio2').prop('checked',false);
    $('#not_assigned_portfolio2').prop('checked',false);
    $('#all_portfolio2').prop('checked',false);
   }
  if(individual_portfolio2){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "none";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "block";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "none";
    }
    //radio button visibility
    $('#company_portfolio2').prop('checked',false);
    $('#individual_portfolio2').prop('checked',true);
    $('#not_assigned_portfolio2').prop('checked',false);
    $('#all_portfolio2').prop('checked',false);
   }
  if(not_assigned_portfolio2){
  var company1 = document.getElementsByClassName('company');
  var individual1 = document.getElementsByClassName('individual');
  var user_not1 = document.getElementsByClassName('user_not');
    //div visibility
    for(var ic=0; ic<company1.length; ic++)
    {
      company1[ic].style.display = "none";
    }
    for(var jc=0; jc<individual1.length; jc++)
    {    
      individual1[jc].style.display = "none";
    }
    for(var kc=0; kc<user_not1.length; kc++)
    {    
      user_not1[kc].style.display = "block";
    }
    //radio button visibility
    $('#company_portfolio2').prop('checked',false);
    $('#individual_portfolio2').prop('checked',false);
    $('#not_assigned_portfolio2').prop('checked',true);
    $('#all_portfolio2').prop('checked',false);
   }
//keep selected portfolio filter ends

  // FOR REGISTRATION FORM ----------------------------------------
  $('#registration_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    $('#register_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_registration',
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
            $('#recaptchaErr').html(data.errors);
            $('#register_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Registration')
          {
            $('#conf_passwordErr').html('Registration Failed! Please Try Again!'); 
            $('#register_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == 'fullnameErr')
          {
            $('#full_nameErr').html('<p>Please enter full name!</p>'); 
            $('#register_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == 'fullname2Err')
          {
            $('#full_nameErr').html('<p>Please enter valid full name!</p>'); 
            $('#register_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == true){
            window.location = base_url+'login';
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR LOGIN FORM -------------------------------------------------------
  $('#login_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/check_login',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false) {
          //show errors
          $('#recaptchaErr').html(data.errors);
        
          }
          else if(data.status == 'Error_Login')
          {
            $('#login_passwordErr').html('You cannot Login! Please contact your company!');         
          }
          else if(data.status == 'inactive_status'){
            $('#reg_in_message').html(data.reg_in_message);
            $('#reg_in_message').show();
          }
          else if(data.status == true){
              window.location = base_url+'dashboard';
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR RESET PASSWORD FORM -------------------------------------------------------
  $('#reset_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/sent_reset_password',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false) {
          //show errors
          $('#email_addressErr').html(data.errors);
          $('#recaptchaErr').html(data.errors);
          }
          else if(data.status == 'inactive_status'){
            $('#reg_in_message').html(data.reg_in_message);
            $('#hide_msg').hide();
            $('#reg_in_message').show();
          }
          else if(data.status == true){
              window.location = base_url+'reset-password';
              
          }
          //console.log(data);
       }// success msg ends here
     });
  });

 // FOR CHANGE PASSWORD FORM ----------------------------------------
  $('#cp_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing

   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_change_password',
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
            $('#recaptchaErr').html(data.errors);
          }
          else if(data.status == true){
            window.location = base_url+'login';
          }
          //console.log(data);
       }// success msg ends here

     });
  });

// FOR  CREATE NEW PROJECT FORM ----------------------------------------
  $('#create_project_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    $('#create_project_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_project',
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
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#pfile').html('Oops Size is Large! It must be less than 2MB.');
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#pfile').html('File Uploading Error! Please Try Again!');
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'Invited_email')
          {
            $('#imemailErr').html('Already Invited!');     
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');        
          }
          else if(data.status == 'registered_email')
          {
            $('#imemailErr').html('Project Team Member Request sent or Added in Team!');  
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'err_valid')
          {
            $('#err_valid').html('Project Owner cannot be added as Team Member!');    
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');         
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#create_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            // debugger;
            $('#create_project_button').show();
            $('#loader2').hide();
            $('#create_project_form').trigger("reset");
            var pid = data.pid;
            window.location = base_url+'projects-overview/'+pid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });

    // FOR  EDIT PROJECT FORM ----------------------------------------
  $('#edit_project_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_project_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_project',
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
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#pfile').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#pfile').html('File Uploading Error! Please Try Again!');
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');            
          }
          else if(data.status == 'Invited_email')
          {
            $('#imemailErr').html('Already Invited!');
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');            
          }
          else if(data.status == 'registered_email')
          {
            $('#imemailErr').html('Project Team Member Request sent or Added in Team!'); 
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'err_valid')
          {
            $('#err_valid').html('Project Owner cannot be added as Team Member!');    
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');         
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_project_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            var pid = data.pid;
            var page = data.page;
            if(page == 'accepted')
            {
              window.location = base_url+'projects-overview-accepted/'+pid;
            }
            else
            {
              window.location = base_url+'projects-overview/'+pid;
            }            
          }
          //console.log(data);
       }// success msg ends here

     });
  });

// FOR SUBMITTING ADD PFILE FORM ----------------------------------------
        $("#add_pfile").change(function(){
          //debugger;
            $('#add_Pfile_form').submit();
        });

// FOR ADD PFILE FORM ----------------------------------------
        $('#add_Pfile_form').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#pfile_but').hide();
          $('#loader2').css('visibility','visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/insert_pfile',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                else if(data.status == 'file_uploadSizeErr')
                {
                  $('#add_pfileErr').html('Oops Size is Large! It must be less than 2MB.');
                  $('#pfile_but').show();
                  $('#loader2').css('visibility','hidden');
                }
                else if(data.status == 'Error_Uploading')
                {
                  $('#add_pfileErr').html('File Uploading Error! Please Try Again!'); 
                  $('#pfile_but').show();   
                  $('#loader2').css('visibility','hidden');       
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });


// FOR ADD TEAM MEMBER FORM ----------------------------------------
        $('#pdetail_AddTeamMemberForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#pdetail_AddTeamMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/pdetail_AddTeamMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'Empty_TMember')
                {
                   $('#selected_T_memberErr').html('Please select Team Member!');
                   $('#pdetail_AddTeamMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'Invited_email')
                {
                  $('#imemailErr').html('Already Invited!');  
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'registered_email')
                {
                  $('#imemailErr').html('Project Team Member Request sent or Added in Team!');  
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'err_valid')
                {
                  $('#err_valid').html('Project Owner cannot be added as Team Member!');    
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');         
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

// FOR ADD TEAM MEMBER FORM ----------------------------------------
        $('#pdetail_AddTeamMemberForm_task').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#pdetail_AddTeamMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/pdetail_AddTeamMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'Empty_TMember')
                {
                   $('#selected_T_memberErr').html('Please select Team Member!');
                   $('#pdetail_AddTeamMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'Invited_email')
                {
                  $('#imemailErr').html('Already Invited!');  
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'registered_email')
                {
                  $('#imemailErr').html('Project Team Member Request sent or Added in Team!');  
                  $('#pdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == true){                 
                  $('#selected_T_member').val('');
                  $('#team_member').val('');
                  $('#pdetail_AddMember').modal('hide');
                  $('#loader2').css('visibility','hidden'); 
                  $('#pdetail_AddMember').load(document.URL + ' #pdetail_AddMember>*'); 
                }
             }// success msg ends here
           });
        });


// FOR SUGGEST TEAM MEMBER FORM ----------------------------------------
        $('#pdetail_SuggestTMemberForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#pdetail_SuggestTMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/pdetail_SuggestTMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#pdetail_SuggestTMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'registered_email')
                {
                   $('#ismemberErr').html('Project Team Member Request sent or Added in Team!');
                   $('#pdetail_SuggestTMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'already_invited')
                {
                   $('#ismemberErr').html('Already Invited Email!');
                   $('#pdetail_SuggestTMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'Already_suggested')
                {
                   $('#selected_T_memberErr').html('Already Suggested Member!');
                   $('#pdetail_SuggestTMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'Empty_Member')
                {
                   $('#selected_T_memberErr').html('Please select Member To Suggest!');
                   $('#pdetail_SuggestTMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'err_valid')
                {
                  $('#err_valid').html('Project Owner cannot be added as Team Member!');    
                  $('#pdetail_SuggestTMemberButton').show();
                  $('#loader2').css('visibility','hidden');         
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR  EDIT ACCEPTED PROJECT FORM ----------------------------------------
  $('#edit_accepted_project_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_accepted_project_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_accepted_project',
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
            $('#edit_accepted_project_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#pfile').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_accepted_project_button').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#pfile').html('File Uploading Error! Please Try Again!');  
            $('#edit_accepted_project_button').show();
            $('#loader2').css('visibility','hidden');         
          }
          else if(data.status == true){
            window.location = document.referrer;
          }
          //console.log(data);
       }// success msg ends here

     });
  });
     
       
// FOR  EXPORT TO EXCEL FORM ----------------------------------------
  $('#history_excel_form').on('submit',function(event){
//debugger;
event.preventDefault();
             var formData = new FormData(this); 
    Swal.fire({
      title: "You Want To Download History in Excel?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            //debugger;
              $.ajax({
                   url:base_url+'front/history_excel',
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
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');
                    }
                    else if(data.status == 'empty_option')
                    {
                      $('#empty_optionErr').html('Please Select Any One Option to Export History in Excel!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');         
                    }
                    else if(data.status == 'not_found')
                    {
                      $('#empty_optionErr').html('No Record Found!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden'); 
                    }
                    else if(data.status == true)
                    {
                      //debugger;
                      $('#empty_optionErr').html('');  
                      $('#only_date').val('');
                      $('#start_date').val('');
                      $('#end_date').val('');
                      $('#all_history').prop('checked', false);
                      $('#excel_date_options').modal('hide');
                      window.location = base_url+'front/export_excel';
                    }
                    //console.log(data);
                 }// success msg ends here

               });
          }
      }); 
  });


 // FOR TASK SELECT TEAM MEMBER PROJECT WISE ----------------------------------------
  $('#tproject_assign').on('change', function(event) {
           //debugger;
            event.preventDefault();
            var tproject_assign= $("#tproject_assign").val(); 
            $.ajax({
                url: base_url+'front/select_project_tm',
                method: 'POST',
                data: {pid:tproject_assign},  
                success: function(data) {
                    $('#team_member2').html(data);
                    //console.log(data);                   
                }
            });
        });
  // FOR TASK SELECT TEAM MEMBER PROJECT WISE FOR SUB TASKS IN EDIT TASK ----------------------------------------
  $('#tproject_assign2').on('change', function(event) {
           //debugger;
            event.preventDefault();
            var tproject_assign= $("#tproject_assign2").val();
            $.ajax({
                url: base_url+'front/select_project_tm',
                method: 'POST',
                data: {pid:tproject_assign},  
                success: function(data) {
                    $('.change_team_member').html(data);
                    //console.log(data);                   
                }
            });
        });

    // FOR DISABLE PREVIOUS DATE----------------------------------------
    $(function() {
        $( "#tdue_date" ).datepicker({todayHighlight: true,startDate: new Date()});
      });

    $(function() {
        $( ".pub_Cdate" ).datepicker({todayHighlight: true,startDate: new Date()});
      });

    // FOR CREATE NEW TASK FORM ----------------------------------------
  $('#create_task_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#create_task_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_task',
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
            $('#create_task_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#tfileErr').html('Oops Size is Large! It must be less than 2MB.');
            $('#create_task_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#tfileErr').html('File Uploading Error! Please Try Again!');
            $('#create_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#create_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'limit_task')
          {
            $('#limit_taskErr').html('Limit Exceeds for selected project!');
            $('#create_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            $('#create_task_button').show();
            $('#loader2').hide();
            $('#create_task_form').trigger("reset");
            var tid = data.tid;
            window.location = base_url+'tasks-overview/'+tid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });


  // FOR CREATE NEW SUB TASK FORM ----------------------------------------
  $('#create_subtask_form').on('submit',function(event){  
  //debugger;  
    event.preventDefault(); // Stop page from refreshing
    $('#create_subtask_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_subtask',
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
            $('#create_subtask_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('Oops Size is Large! It must be less than 2MB.');
            $('#create_subtask_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('File Uploading Error! Please Try Again!');
            $('#create_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#create_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
             var tid = data.tid;
             window.location = base_url+'tasks-overview/'+tid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });


  // FOR EDIT TASK FORM ----------------------------------------
  $('#edit_task_form').on('submit',function(event){   
  //debugger; 
    event.preventDefault(); // Stop page from refreshing
    $('#edit_task_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_task',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          //debugger;
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
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('File Uploading Error! Please Try Again!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            //var tid = data.tid;
            //window.location = base_url+'tasks-overview/'+tid;
            window.location = document.referrer;
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR EDIT TASK FORM MODAL ----------------------------------------
  $('#edit_task_formModal').on('submit',function(event){   
  // debugger; 
    event.preventDefault(); // Stop page from refreshing
    $('#edit_task_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_task',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          //debugger;
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
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            var y_val = data.passYvalue;
            $('#data_below_insert').val(y_val);
            $('#tfile'+y_val+'Err').html('File Uploading Error! Please Try Again!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_task_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            //var tid = data.tid;
            //window.location = base_url+'tasks-overview/'+tid;
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR EDIT SUBTASK FORM ----------------------------------------
  $('#edit_subtask_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_subtask_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_subtask',
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
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#tfileErr').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#tfileErr').html('File Uploading Error! Please Try Again!');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });


  // FOR EDIT TASK FORM ----------------------------------------
  // $('#editable_task_form').on('submit',function(event){   
  //   event.preventDefault(); // Stop page from refreshing
  //   $('#editable_task_button').hide();
  //  var formData = new FormData(this); 
  //   $.ajax({
  //        url:base_url+'front/editable_task',
  //        type:"POST",
  //        data:formData,
  //        contentType:false,
  //        processData:false,
  //        cache:false,
  //        success: function(data){
  //         if (data.status == false)
  //         {
  //           //show errors
  //           $('[id*=Err]').html('');
  //           $.each(data.errors, function(key, val) {
  //               var key =key.replace(/\[]/g, '');
  //               key=key+'Err';
  //               //console.log(key);    
  //               $('#'+ key).html(val);
  //           })
  //           $('#editable_task_button').show(); 
  //         }
  //         else if(data.status == true){
  //           $('#TaskNameModal').modal('hide');
  //           window.location.reload();
  //           //$('#refresh_editable_task').load(document.URL + ' #refresh_editable_task>*'); 
  //         }
  //      }// success msg ends here

  //    });
  // });


// FOR ADD Portfolio FORM ----------------------------------------
        $('#AddPortfolioForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#AddPortfolioButton').hide();
          $('#cloader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/AddPortfolio',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#AddPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                  $('#portfolio_name').val('');
                  $('#AddPortfolio').modal('hide');
                  $('#AddPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                  $('#refresh_portfolio_id').load(document.URL + ' #refresh_portfolio_id>*'); 
                }
                //console.log(data);
             }// success msg ends here
           });
        });

// FOR CREATE Portfolio FORM ----------------------------------------
        $('#CreatePortfolioForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#CreatePortfolioButton').hide();
          $('#cloader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/CreatePortfolio',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                }
                else if (data.status == 'website_valid')
                {
                  $('#company_websiteErr').html('Please Enter Valid Website!'); 
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if (data.status == 'photoErr')
                {
                  $('#photoErr').html(data.photoerr); 
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if (data.status == 'photo2Err')
                {
                  $('#photo2Err').html(data.photo2err);
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if (data.status == 'cover_photoErr')
                {
                  $('#cover_photoErr').html(data.cover_photoErr); 
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if (data.status == 'cover_photo2Err')
                {
                  $('#cover_photo2Err').html(data.cover_photo2Err);
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if(data.status == true){
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').hide();
                  $('#CreatePortfolioForm').trigger("reset");
                  var id = data.id;
                  window.location = base_url+'portfolio-view';
                }
                //console.log(data);
             }// success msg ends here
           });
        });

// FOR EDIT Portfolio FORM ----------------------------------------
        $('#EditPortfolioForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#EditPortfolioButton').hide();
          $('#cloader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/UpdatePortfolio',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#EditPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                }
                else if (data.status == 'website_valid')
                {
                  $('#company_websiteErr').html('Please Enter Valid Website!'); 
                  $('#EditPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');           
                }
                else if (data.status == 'photoErr')
                {
                  $('#photoErr').html(data.photoerr); 
                  $('#EditPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');           
                }
                else if (data.status == 'photo2Err')
                {
                  $('#photo2Err').html(data.photo2err); 
                  $('#EditPortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');           
                }
                else if (data.status == 'cover_photoErr')
                {
                  $('#cover_photoErr').html(data.cover_photoErr); 
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if (data.status == 'cover_photo2Err')
                {
                  $('#cover_photo2Err').html(data.cover_photo2Err);
                  $('#CreatePortfolioButton').show();
                  $('#cloader2').css('visibility','hidden');            
                }
                else if(data.status == true){
                  //console.log(data);
                  var id = data.id;
                  window.location = document.referrer;
                }
                //console.log(data);
             }// success msg ends here
           });
        });

// FOR CHANGE My PASSWORD FORM ----------------------------------------
  $('#my_cp_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing

   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/update_my_password',
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
          else if(data.status == 'old_passwordError')
          {
            $('#old_passwordErr').html('Please Enter Correct Current Password!');
            $('#new_passwordErr').html('');
          }
          else if(data.status == 'new_passwordError')
          {
            $('#new_passwordErr').html('New Password cannot be Current Password!');
            $('#old_passwordErr').html('');
          }
          else if(data.status == true){
            Swal.fire("Login with New Password!", "Password Changed!", "success");
            window.location.reload();
          }
       }// success msg ends here

     });
  });

// FOR ADD PORTFOLIO TEAM MEMBER FORM ----------------------------------------
        $('#portfolio_AddTeamMemberForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#portfolio_AddTeamMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/portfolio_AddTeamMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#portfolio_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'accepted_email')
                {
                  $('#imemailErr').html('Already in Team!');  
                  $('#portfolio_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'Invited_email')
                {
                  $('#imemailErr').html('Already Invited!');  
                  $('#portfolio_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });


// FOR ADD PORTFOLIO DEPARTMENT FORM ----------------------------------------
$('#portfolio_AddDepartmentForm').on('submit',function(event){
  //debugger;          
  event.preventDefault(); // Stop page from refreshing
  $('#portfolio_AddDepartmentButton').hide();
  $('#loader21').css('visibility', 'visible');
 var formData = new FormData(this); 
  $.ajax({
       url:base_url+'front/portfolio_AddDepartment',
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       cache:true,
       success: function(data){
        if (data.status == false)
        {
          //show errors
          $('#departmentErr').html('Department Name is required!');
          $('#portfolio_AddDepartmentButton').show();
          $('#loader21').css('visibility','hidden'); 
        }
        else if(data.status == true){
         window.location.reload();
        }
        //console.log(data);
     }// success msg ends here
   });
});

        // FOR CHANGE SUBTASK STATUS FROM OVERVIEW MODAL ----------------------------------------
        // $('.status_but_val').on('click',function(event){
        //  // debugger;          
        //   event.preventDefault(); // Stop page from refreshing
        //   var stid = $('#stid').val();
        //   var stassignee = $('#stassignee').val(); 
        //   var status_but = $(this).val();
        //   $.ajax({
        //        url:base_url+'front/change_subtaskStatusOverviewModal',
        //        method:"POST",
        //        data: {stid:stid, stassignee:stassignee, status_but:status_but},
        //        // contentType:false,
        //        // processData:false,
        //        // cache:true,
        //        success: function(data){
        //        // debugger;
        //         if (data.status == false)
        //         {
        //           //show errors
        //           $('[id*=Err]').html('');
        //           $.each(data.errors, function(key, val) {
        //               var key =key.replace(/\[]/g, '');
        //               key=key+'Err';
        //               //console.log(key);    
        //               $('#'+ key).html(val);
        //           })
        //           $('#portfolio_AddTeamMemberButton').show();
        //           $('#loader2').css('visibility','hidden'); 
        //         }
        //         else if(data.status == true){
        //          $('#SubtaskOverviewModal').modal('hide'); 
        //         }
        //         //console.log(data);
        //      }// success msg ends here
        //    });
        // });


    // FOR UPDATE PROFILE FORM ----------------------------------------
  $('#update-profile-form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_profile',
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
          else if (data.status == 'dob_error')
          {
            $('#dobErr').html('Age is Not Valid!');            
          }
          else if (data.status == 'photoErr')
          {
            $('#photoErr').html(data.photoerr);            
          }
          else if(data.status == true){
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            window.scrollTo(0, 0);
            window.location = base_url+'profile';
          }
          console.log(data);
       }// success msg ends here

     });
  });
           
  $('#TaskEditModal').on('shown.bs.modal', function (e){
    //debugger;
    var selected = [];
  for (var option of document.getElementById('tproject_assign').options) {
    if (option.selected) {
      selected.push(option.value);
     //console.log(selected.push(option.value));
    }
  }
 var project_id= selected; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_publish',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_pub_date').val(resp);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_gid_sid',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_gid').val(resp.gid);  
                    $('#get_sid').val(resp.sid);  
                    $('#get_gstart_date').val(resp.gstart_date);  
                    $('#get_gend_date').val(resp.gend_date);  
                    if(resp.check_pid != "")
                    {
                      $('#dept').html(resp.depts);
                    }                                   
                }
            });
    });

  $('#TaskOverviewModal').on('shown.bs.modal', function (e){
    //debugger;
    $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
    });
  
  $('#task_commentModal').on('mouseenter', function (e){
    //debugger;
    $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));
    });

  $('#TaskReviewModal').on('shown.bs.modal', function (e){
    //debugger;
    $("#scrollbottom_trmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_trmodal .simplebar-content-wrapper").prop("scrollHeight"));
    });

  $('#SubtaskOverviewModal').on('shown.bs.modal', function (e){
    //debugger;
    $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
    });

  $('#subtask_commentModal').on('mouseenter', function (e){
    //debugger;
    $("#scrollbottom_stmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_stmodal .simplebar-content-wrapper").prop("scrollHeight"));
    });

  $('#SubtaskReviewModal').on('shown.bs.modal', function (e){
    //debugger;
    $("#scrollbottom_strmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_strmodal .simplebar-content-wrapper").prop("scrollHeight"));
    });

    // FOR TASK SELECT TEAM MEMBER PROJECT WISE ----------------------------------------
  $('#pc_project_assign').on('change', function(event) {
            event.preventDefault();
            var tproject_assign= $("#pc_project_assign").val(); 
            $.ajax({
                url: base_url+'front/select_project_assignees',
                method: 'POST',
                data: {pid:tproject_assign},  
                success: function(data) {
                    $('.plan-content-wrapper').find('#written_content_assignee1').html(data.assignees);
                    $('.plan-content-wrapper').find('#pc_file_assignee1').html(data.assignees);
                    $('.plan-content-wrapper').find('#submit_to_approval1').html(data.assignees);
                    $('.plan-content-wrapper').find('#pc_assignee1').html(data.none_assignee);
                    //console.log(data);                   
                }
            });
  });

  // SHOW NEW CONTENT FORM ----------------------------------------
  $('#select_project_form').on('submit',function(event){ 
    event.preventDefault(); // Stop page from refreshing
    var pid = $('#pc_project_assign').val();
    $.ajax({
      url:  base_url+'front/edit_all_content_planner',
      type: 'post',
      data: {pid: pid},
      success: function(data){
        if(data != ""){
          $('#create_content_form').trigger('reset'); 
          $('.select-project').modal('hide'); 
          $('.plan-content-wrapper').find('.edit-all-content').remove();
          $('.plan-content-wrapper').prepend(data);  

          var last_id = $('#planner_last_id').val();
          var last_id = parseInt(last_id)-1;
          var prev_wca = $('#written_content_assignee'+last_id).val();      
          var prev_pfa = $('#pc_file_assignee'+last_id).val();      
          var prev_sta = $('#submit_to_approval'+last_id).val();      
          var prev_pa = $('#pc_assignee'+last_id).val(); 
               
          $('.plan-content-wrapper').find('#written_content_assignee1').val(prev_wca).trigger('change');
          $('.plan-content-wrapper').find('#pc_file_assignee1').val(prev_pfa).trigger('change');   
          $('.plan-content-wrapper').find('#submit_to_approval1').val(prev_sta).trigger('change');    
          $('.plan-content-wrapper').find('#pc_assignee1').val(prev_pa).trigger('change'); 
           
          $('.add-new-content').modal('show'); 
        }else{
          $('#create_content_form').trigger('reset'); 
          $('.select-project').modal('hide');    
          $('.plan-content-wrapper').find('.edit-all-content').remove();
          $('.add-new-content').modal('show'); 
        }         
      }
    });         
  });

  // $(".add-new-content").on("hidden.bs.modal", function () {
  //   $(this).find('.plan-content-wrapper').load(document.URL + ' .plan-content-wrapper>*'); 
  // });

    // FOR CREATE NEW TASK FORM ----------------------------------------
  $('#create_content_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#create_content_button').hide();
    $('#loader2').css('visibility','visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_content',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          //console.log(data);
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
            $('#create_content_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            var counter = data.file_counter;
            $('#pc_file'+counter+'Err').html('Oops Size is Large! It must be less than 2MB.');
            $('#create_content_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            var counter = data.file_counter;
            $('#pc_file'+counter+'Err').html('File Uploading Error! Please Try Again!');
            $('#create_content_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            var counter = data.link_counter;
            $('#link_validErr'+counter).html('Please Enter Valid Link!');
            $('#create_content_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            var pid = data.pid;
            window.location.reload();
          }          
       }// success msg ends here
     });
  });

 // FOR EDIT CONTENT FORM ----------------------------------------
 $('#edit_content_form').on('submit',function(event){  
 //debugger;
  event.preventDefault(); // Stop page from refreshing
  $(".written_content_assignee1").prop("disabled", false);
  $(".pc_file_assignee1").prop("disabled", false);
  $(".submit_to_approval1").prop("disabled", false);
  $(".pc_assignee1").prop("disabled", false);
  $('#edit_content_button').hide();
  $('#loader2').css('visibility','visible');
  var formData = new FormData(this);
   $.ajax({
        url:base_url+'front/update_content_planner',
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        cache:false,
        success: function(data){
         //debugger;
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
           $('#edit_content_button').show();
           $('#loader2').css('visibility','hidden');  
         }
         else if(data.status == 'file_uploadSizeErr')
         {
           var counter = data.file_counter;
           $('#pc_file1Err').html('Oops Size is Large! It must be less than 7MB.');
           $('#edit_content_button').show();
           $('#loader2').css('visibility','hidden');
         }
         else if(data.status == 'Error_Uploading')
         {
           var counter = data.file_counter;
           $('#pc_file1Err').html('File Uploading Error! Please Try Again!');
           $('#edit_content_button').show();
           $('#loader2').css('visibility','hidden');          
         }
         else if(data.status == 'link_valid')
         {
           var counter = data.link_counter;
           $('#link_validErr1').html('Please Enter Valid Link!');
           $('#edit_content_button').show();
           $('#loader2').css('visibility','hidden');          
         }
         else if(data.status == true){
           //debugger;
           window.location.reload();
         }
         //console.log(data);
      }// success msg ends here

    });
 });

 $('.pro_edit_content_form').on('submit',function(event){   
  //debugger; 
    event.preventDefault(); // Stop page from refreshing
    $(".written_content_assignee1").prop("disabled", false);
    $(".pc_file_assignee1").prop("disabled", false);
    $(".submit_to_approval1").prop("disabled", false);
    $(".pc_assignee1").prop("disabled", false);
    $('#pro_edit_content_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/update_content_planner',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          //debugger;
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
            $('#pro_edit_content_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#pc_fileErr'+data.pc_id).html('Oops Size is Large! It must be less than 7MB.');
            $('#pro_edit_content_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#pc_fileErr'+data.pc_id).html('File Uploading Error! Please Try Again!');
            $('#pro_edit_content_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'link_valid')
          {
            $('#link_validErr1').html('Please Enter Valid Link!');
            $('#pro_edit_content_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            Swal.fire("Updated!", "Successfully.", "success");
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

 // FOR COMMENT FORM ----------------------------------------
  $('#comment_form').on('submit',function(event){    
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#comment_form_button').hide();
    $('#loader6').css('visibility','visible');
    var formData = new FormData(this); 
    //console.log(formData);
    $.ajax({
         url:base_url+'front/insert_comment',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         async:false,
         success: function(data){
          $('#comment_form_button').show();
          $('#loader6').css('visibility','hidden');  
          var m_val = $('#message').val();
          if(m_val)
          {
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
              //debugger;
              // if(data.area == "from_modal")
              // {
                $('.no_comment').hide();
                $('#comment_form').trigger('reset');
                $('.append_new_msg .simplebar-content').append('<li class="right" id="msg_id'+data.comment_id+'" style="padding-top:25px"><div class="conversation-list"><div class="dropdown"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment('+data.comment_id+');">Delete</a></div></div><div class="ctext-wrap"><div class="conversation-name">Me</div><p>'+data.comment_sent+'</p><p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i>'+data.comment_date+'</p></div></div></li>');
                $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
                  
              // }
              // else
              // {
              //   $('#comment_form').trigger('reset');
              //   $('.chat-conversation').load(document.URL + ' .chat-conversation>*');
              //   $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
              //  document.getElementById("scrollbottom").innerHTML.reload;              
              // }
            }   
          }       
       }// success msg ends here
     });
  });

  // FOR COMMENT FORM ----------------------------------------
  $('#subtask_comment_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#subtask_comment_form_button').hide();
    $('#loader6').css('visibility','visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_comment',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#subtask_comment_form_button').show();
          $('#loader6').css('visibility','hidden');  
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
              $('.no_comment').hide();
              $('#subtask_comment_form').trigger('reset');
              $('.append_new_msg .simplebar-content').append('<li class="right" id="msg_id'+data.comment_id+'" style="padding-top:25px"><div class="conversation-list"><div class="dropdown"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment('+data.comment_id+');">Delete</a></div></div><div class="ctext-wrap"><div class="conversation-name">Me</div><p>'+data.comment_sent+'</p><p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i>'+data.comment_date+'</p></div></div></li>');
              $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
            }          
       }// success msg ends here
     });
  });

  // FOR ADD Quote FORM ----------------------------------------
        $('#request_quoteForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#request_quoteButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/insert_request_quote',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#request_quoteButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        // FOR ADD Logo FORM ----------------------------------------
        $('#request_logoForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#request_logoButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/insert_request_logo',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#request_logoButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'link_valid')
                {
                  $('#logo_linkErr').html('Please Enter Valid Link!');
                  $('#request_logoButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR  Project task subtask search ----------------------------------------
  // $('#project_search_task').on('submit',function(event){
  //   //debugger;
  //   event.preventDefault(); // Stop page from refreshing
  //  var formData = new FormData(this); 
  //   $.ajax({
  //        url:base_url+'front/project_search_task',
  //        type:"POST",
  //        data:formData,
  //        contentType:false,
  //        processData:false,
  //        cache:false,
  //        success: function(data){
  //         if (data.status == false)
  //         {
  //           //show errors
  //           $('[id*=Err]').html('');
  //           $.each(data.errors, function(key, val) {
  //               var key =key.replace(/\[]/g, '');
  //               key=key+'Err';
  //               //console.log(key);    
  //               $('#'+ key).html(val);
  //           })
  //         }
  //         else if(data.status == true){
  //          window.location = base_url+'portfolio-project-tasks-search';
  //         }
  //         //console.log(data);
  //      }// success msg ends here

  //    });
  // });

  // FOR  Project task subtask search ----------------------------------------
  $('#task_date_filter').on('submit',function(event){
    //debugger;
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/task_date_filter',
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
           window.location = base_url+'tasks-date-filter-search';
          }
          //console.log(data);
       }// success msg ends here

     });
  });

   $("input[name='myTask_radio']").click(function () {
    //debugger;
      $("#search-criteria-list").val("");
      $('.search-list').show();
      $('#search-clear-list').css('display','none');
      $("#search-criteria").val("");
      $('.search-cards').show();
      $('#search-clear').css('display','none');
      var myTask_radio = $(this).val();
      $('#taskFilter').val(myTask_radio);
      if($('.all-data').hasClass('active_searched'))
      {
        $('.all-data').removeClass('active_searched')
      }
      $('.filtercollapse').css('display','none');
      if(myTask_radio == 'today')
      {
        var today = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(today) == 0);
          if($(this).attr('data-searchid') == today)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');            
          }
        });
      }
      else if(myTask_radio == 'tomorrow')
      {
        var tomorrow = moment().add(1, 'days').format('Y-MM-DD');
        //console.log(tomorrow);
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(tomorrow) == 0);
          if($(this).attr('data-searchid') == tomorrow)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'this_week')
      {
        //debugger;
        var currentDate = moment();
        var weekStart_fd = currentDate.clone().startOf('week');
        var weekEnd_ld = currentDate.clone().endOf('week');
        var weekStart = weekStart_fd.subtract(1, 'days').format('Y-MM-DD');  
        var weekEnd = weekEnd_ld.add(1, 'days').format('Y-MM-DD');
        // console.log(weekStart);
        // console.log(weekEnd);
        // console.log(weekStart_fd);
        // console.log(weekEnd_ld);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(weekStart, weekEnd));
          if(moment(dates).isBetween(weekStart, weekEnd))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'week')
      {
        var firstDay = moment().format('Y-MM-DD');
        var lastDay = moment().add(8, 'days').format('Y-MM-DD');  
        //console.log(firstDay);
        //console.log(lastDay);    
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(firstDay, lastDay));
          if(moment(dates).isBetween(firstDay, lastDay))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'overdue')
      {
        var overdue = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          $(this).toggle(moment(dates).isBefore(moment(overdue)));
          if(moment(dates).isBefore(moment(overdue)))
          {
            if($(this).closest('div.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('1');
              if($(this).closest('div.parent_task').find('li').hasClass('overdue_task_in_list'))
              {
              //console.log('11');
                $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
              else
              {
              //console.log('12');
                $(this).closest('div.parent_task').css('display','none').removeClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
            }
            else if($(this).closest('div.parent_task').hasClass('overdue_task_in_list'))
            {
              //console.log('2');
              $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
              $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
            }
            if($(this).closest('section.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('11');
              $(this).closest('section.parent_task').css('display','none').removeClass('active_searched');
            }
            else
            {
              //console.log('22');
              $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
            }
          }
        });
      }
      else if(myTask_radio == 'all')
      {
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf($(this).attr('data-searchid')) == 0).removeClass('active_searched');
        });
      }
  });

   $("input[name='portfolioTask_radio']").click(function () {
    //debugger;
      $("#search-criteria-list").val("");
      $('.search-list').show();
      $('#search-clear-list').css('display','none');
      $('.progressbar_display').hide();
      var portfolioTask_radio = $(this).val();
      $('#taskFilter').val(portfolioTask_radio);
      if($('.all-data').hasClass('active_searched'))
      {
        $('.all-data').removeClass('active_searched')
      }
      $('.filtercollapse').css('display','none');
      if(portfolioTask_radio == 'today')
      {
        var today = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(today) == 0);
          if($(this).attr('data-searchid') == today)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'tomorrow')
      {
        var tomorrow = moment().add(1, 'days').format('Y-MM-DD');
        //console.log(tomorrow);
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(tomorrow) == 0);
          if($(this).attr('data-searchid') == tomorrow)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'this_week')
      {
        //debugger;
        var currentDate = moment();
        var weekStart_fd = currentDate.clone().startOf('week');
        var weekEnd_ld = currentDate.clone().endOf('week');
        var weekStart = weekStart_fd.subtract(1, 'days').format('Y-MM-DD');  
        var weekEnd = weekEnd_ld.add(1, 'days').format('Y-MM-DD');
        // console.log(weekStart);
        // console.log(weekEnd);
        // console.log(weekStart_fd);
        // console.log(weekEnd_ld);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(weekStart, weekEnd));
          if(moment(dates).isBetween(weekStart, weekEnd))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'week')
      {
        var firstDay = moment().format('Y-MM-DD');
        var lastDay = moment().add(8, 'days').format('Y-MM-DD');  
        //console.log(firstDay);
        //console.log(lastDay);    
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(firstDay, lastDay));
          if(moment(dates).isBetween(firstDay, lastDay))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'overdue')
      {
        var overdue = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          $(this).toggle(moment(dates).isBefore(moment(overdue)));
          if(moment(dates).isBefore(moment(overdue)))
          {
            if($(this).closest('div.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('1');
              if($(this).closest('div.parent_task').find('li').hasClass('overdue_task_in_list'))
              {
              //console.log('11');
                $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
              else
              {
              //console.log('12');
                $(this).closest('div.parent_task').css('display','none').removeClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
            }
            else if($(this).closest('div.parent_task').hasClass('overdue_task_in_list'))
            {
              //console.log('2');
              $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
              $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
            }
            if($(this).closest('section.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('11');
              $(this).closest('section.parent_task').css('display','none').removeClass('active_searched');
            }
            else
            {
              //console.log('22');
              $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
            }
          }
        });
      }
      else if(portfolioTask_radio == 'all')
      {
      $('.progressbar_display').show();
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf($(this).attr('data-searchid')) == 0).removeClass('active_searched');
        });
      }
  });

// FOR All Project task subtask search ----------------------------------------
  // $('#all_project_search_task').on('submit',function(event){
  //   //debugger;
  //   event.preventDefault(); // Stop page from refreshing
  //  var formData = new FormData(this); 
  //   $.ajax({
  //        url:base_url+'front/all_project_search_task',
  //        type:"POST",
  //        data:formData,
  //        contentType:false,
  //        processData:false,
  //        cache:false,
  //        success: function(data){
  //         if (data.status == false)
  //         {
  //           //show errors
  //           $('[id*=Err]').html('');
  //           $.each(data.errors, function(key, val) {
  //               var key =key.replace(/\[]/g, '');
  //               key=key+'Err';
  //               //console.log(key);    
  //               $('#'+ key).html(val);
  //           }) 
  //         }
  //         else if(data.status == true){
  //          window.location = base_url+'projects-tasks-search-list';
  //         }
  //         //console.log(data);
  //      }// success msg ends here

  //    });
  // });


  // // FOR All Project task subtask search ----------------------------------------
  // $('#portfolio_projects_content_search').on('submit',function(event){
  //   //debugger;
  //   event.preventDefault(); // Stop page from refreshing
  //  var formData = new FormData(this); 
  //   $.ajax({
  //        url:base_url+'front/portfolio_projects_content_search',
  //        type:"POST",
  //        data:formData,
  //        contentType:false,
  //        processData:false,
  //        cache:false,
  //        success: function(data){
  //         if (data.status == false)
  //         {
  //           //show errors
  //           $('[id*=Err]').html('');
  //           $.each(data.errors, function(key, val) {
  //               var key =key.replace(/\[]/g, '');
  //               key=key+'Err';
  //               //console.log(key);    
  //               $('#'+ key).html(val);
  //           }) 
  //         }
  //         else if(data.status == true){
  //          window.location = base_url+'portfolio-project-content-search-list';
  //         }
  //         //console.log(data);
  //      }// success msg ends here

  //    });
  // });

  // FOR SUBMITTING ATTACH TASK FILE FORM ----------------------------------------
        $("#attach_tfile").change(function(){
          //debugger;
            $('#attach_taskfile_form').submit();
        });

  // FOR ATTACH TASK FILE FORM ----------------------------------------
        $('#attach_taskfile_form').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#attach_tfile').hide();
          $('#loader2').css('visibility','visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/insert_attach_tfile',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#attach_tfile').show();
                  $('#loader2').css('visibility','hidden');
                }
                else if(data.status == 'file_uploadSizeErr')
                {
                  $('#attach_tfileErr').html('Oops Size is Large! It must be less than 2MB.');
                  $('#attach_tfile').show();
                  $('#loader2').css('visibility','hidden');
                }
                else if(data.status == 'Error_Uploading')
                {
                  $('#attach_tfileErr').html('File Uploading Error! Please Try Again!'); 
                  $('#attach_tfile').show();   
                  $('#loader2').css('visibility','hidden');       
                }
                else if(data.status == true){
                 //window.location.reload();
                 $('#task_attachmentModal').modal('hide');
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR SUBMITTING ATTACH SUBTASK FILE FORM ----------------------------------------
        $("#attach_stfile").change(function(){
          //debugger;
            $('#attach_subtaskfile_form').submit();
        });

  // FOR ATTACH SUBTASK FILE FORM ----------------------------------------
        $('#attach_subtaskfile_form').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#attach_stfile').hide();
          $('#loader2').css('visibility','visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/insert_attach_stfile',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#attach_stfile').show();
                  $('#loader2').css('visibility','hidden');
                }
                else if(data.status == 'file_uploadSizeErr')
                {
                  $('#attach_stfileErr').html('Oops Size is Large! It must be less than 2MB.');
                  $('#attach_stfile').show();
                  $('#loader2').css('visibility','hidden');
                }
                else if(data.status == 'Error_Uploading')
                {
                  $('#attach_stfileErr').html('File Uploading Error! Please Try Again!'); 
                  $('#attach_stfile').show();   
                  $('#loader2').css('visibility','hidden');       
                }
                else if(data.status == true){
                 //window.location.reload();
                 $('#subtask_attachmentModal').modal('hide');
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR UPDATE CREDIT CARD FORM ----------------------------------------
  // $('#my_update_ccd').on('submit',function(event){
  //   //debugger;
  //   event.preventDefault(); // Stop page from refreshing
  //   $('#my_update_ccd_but').hide();
  //   $('#loader2').css('visibility', 'visible');
  //   var ccNum = document.getElementById("card_number").value;
  //   var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
  //   var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
  //   var amexpRegEx = /^(?:3[47][0-9]{13})$/;
  //   var discovRegEx = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
  //   var dinersclubRegEx = /^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/;
  //   var jcbRegEx = /^(?:(?:2131|1800|35\d{3})\d{11})$/;
  //   var isValid = false;

  //   if (visaRegEx.test(ccNum)) {
  //     isValid = true;
  //   } else if(mastercardRegEx.test(ccNum)) {
  //     isValid = true;
  //   } else if(amexpRegEx.test(ccNum)) {
  //     isValid = true;
  //   } else if(discovRegEx.test(ccNum)) {
  //     isValid = true;
  //   } else if(dinersclubRegEx.test(ccNum)) {
  //     isValid = true;
  //   } else if(jcbRegEx.test(ccNum)) {
  //     isValid = true;
  //   }
  //  if(isValid == true)
  //  {
  //  var formData = new FormData(this); 
  //   $.ajax({
  //        url:base_url+'front/update_my_ccd',
  //        type:"POST",
  //        data:formData,
  //        contentType:false,
  //        processData:false,
  //        cache:false,
  //        success: function(data){
  //         if (data.status == false)
  //         {
  //           //show errors
  //           $('[id*=Err]').html('');
  //           $.each(data.errors, function(key, val) {
  //               var key =key.replace(/\[]/g, '');
  //               key=key+'Err';
  //               //console.log(key);    
  //               $('#'+ key).html(val);
  //           })
  //           $('#my_update_ccd_but').show();
  //           $('#loader2').css('visibility','hidden'); 
  //         }
  //         else if(data.status == "validError")
  //         {
  //            $('#card_exp_monthErr').html('Credit Card Expired!');
  //            $('#my_update_ccd_but').show();
  //            $('#loader2').css('visibility','hidden'); 
  //         }
  //         else if(data.status == true)
  //         {
  //           window.location.reload();
  //         }
  //      }// success msg ends here

  //    });
  // }
  // else
  // {
  //      $('#card_numberErr').html('Please Enter Valid Credit Card Number!');
  //      $('#my_update_ccd_but').show();
  //      $('#loader2').css('visibility','hidden'); 
  // }
  // });

  // Open Work New Assignee to inactive current assignee FORM ----------------------------------------
        $('#OpenWorkNewAssignee').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#OpenWorkNewAssigneeButton').hide();
          $('#cloader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/open_work_new_assignee',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#OpenWorkNewAssigneeButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                    $('#success_status'+data.pim_id).attr("onclick","Active_PortfolioMember("+data.pim_id+")");
                    $('#success_status'+data.pim_id).removeClass('btn-d');
                    $('#success_status'+data.pim_id).addClass('bg-d text-white');
                    $('#success_status'+data.pim_id).html('Inactive');
                  $('#new_open_work_assignee').val('');
                  $('#OpenWorkModal').modal('hide'); 
                }
                //console.log(data);
             }// success msg ends here
           });
        });

//////Calendar Part Start///////

// FOR inserting drag form FORM ----------------------------------------
  $('#create-category-drag').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#inside_drag').hide();
    $('#drag_form_loader').css('visibility', 'visible');
    var formData = new FormData(this);
    $.ajax({
         url:base_url+'front/insert_drag_from',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#inside_drag').show();
          $('#drag_form_loader').css('visibility', 'hidden');
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
          else if(data.status == 'event_end_timeErr')
          {
            $('#event_end_time_dragErr').html('End Time should be greater than Start time');
            $('#inside_drag').show();
            $('#drag_form_loader').css('visibility', 'hidden');
          }
          else if(data.status == true){
            Swal.fire("Created!", "Successfully.", "success");
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR drag update form  ----------------------------------------
  $('#update-category-drag').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#inside_drag_update').hide();
    $('#drag_form_loader_update').css('visibility', 'visible');
    var formData = new FormData(this);
    $.ajax({
         url:base_url+'front/update_drag_event',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#inside_drag_update').show();
          $('#drag_form_loader_update').css('visibility', 'hidden');
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
          else if(data.status == 'event_end_timeErr')
          {
            $('#event_end_time_drag_upErr').html('End Time should be greater than Start time');
            $('#inside_drag_update').show();
            $('#drag_form_loader_update').css('visibility', 'hidden');
          }
          else if(data.status == true){
            Swal.fire("Updated!", "Successfully.", "success");
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR ADD  INSIDE TO DO FORM CALENDAR ----------------------------------------
    $('#add-inside-todo').on('submit',function(event){
      event.preventDefault(); // Stop page from refreshing
      // event.stopImmediatePropagation();
      // return false;
      var formData = new FormData(this);
      //debugger;
      var sel1 = $.trim($('#add-todo').find(".task_create_event_start_time").val());
      var sel2 = $.trim($('#add-todo').find(".all-task-time-section").val());
      var all_day = $('#task_allDay').val();
      if(sel1 !== ""|| sel2 !== "")
      {
        $.ajax({
             url:base_url+'front/insert_events_todo',
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
              else if(data){
                //debugger;
                //console.log(data);
                if(data.another_todo == 'on')
                {
                  $('#add-todo').find("input[name=task_name]").val('');
                  $('#add-todo').find("textarea[name=task_note]").val('');
                  $('#task_start_timeErr').html('');
                  $('#add-todo').find("input[name=another-todo-cnt]").val(data.new_another_todo_cnt);
                  $('#add-todo').find("#show-another-todo-cnt").html(data.new_another_todo_cnt+' todo created successfully!');
                
                  var event_id = $('#add-todo').find("input[name=event_id]").val();
                  $.ajax({
                        type: "POST",
                        url: base_url+'front/calendar_get_inside_event_todo',
                        type: 'POST',
                        data: {
                            event_id:event_id
                        },
                        success: function(data){
                            $("#view-event").find('.modal-body-inside-todo').html(data);
                        }
                  });
                }
                else
                {
                  $("#view-event").find('.modal-body-inside-todo').html(data);
                  //$('#add-inside-todo').trigger("reset");
                  $('#add-todo').find("input[name=task_name]").val('');
                  $('#add-todo').find("textarea[name=task_note]").val('');
                  $('#task_start_timeErr').html('');
                  $('#add-todo').find("select[name=priority]").val('No Priority');
                  $('#add-todo').find("select[name=task_reminder]").val('No reminder');
                  //$('#add-todo').find("select[name=task_start_time]").val('06:00 AM');
                  //$('#add-todo').find("select[name=task_start_time]").select2().trigger('change');
                  $('#task_allDay').val('false');
                  $('#task_allDay').prop('checked', false);
                  $('.task_create_event_start_time').val('');
                  $('.all-task-time-section').val('');
                  $('#task_start_time_val').val('');
                  if($('.task_create_event_start_time:visible').length == 0)
                  {                    
                    $(".all-task-time-section").show();
                  }
                  else
                  {
                    $(".all-task-time-section").hide();
                  }                  
                  $("#add-todo").modal('hide');
                  $('#add_todobut').blur();
                  $('#add-todo').find("input[name=another-todo-cnt]").val('0');
                  $('#add-todo').find("#show-another-todo-cnt").html('');
                  $('#another-todo').prop('checked', false);
                  Swal.fire("Created!", "Successfully.", "success");
                }             

                // var event_id = data.hidden_event_id;
                // $(".add-task-form-calendar").trigger("reset");
                // // $(".add-task-form-calendar").find("#event_id").select2().trigger('change');
                // $(".add-task-form-calendar").find("input[name=priority]").val(data.priority);
                // $("#add-task").modal('hide');
                // location.reload();

                // if(event_id != 0){
                //   $('.task-section0').load(document.URL + ' .task-section0>*');
                //   $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
                // }else{
                //   $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
                // }

                // $('.total-task-count').load(document.URL + ' .total-task-count>*');
                // $('.all-tasks').load(document.URL + ' .all-tasks>*');
              }
              //console.log(data);
           }// success msg ends here

         });
      }
      else if(all_day === 'true')
      {
        $.ajax({
             url:base_url+'front/insert_events_todo',
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
              else if(data){
                //debugger;
                //console.log(data);
                if(data.another_todo == 'on')
                {
                  $('#add-todo').find("input[name=task_name]").val('');
                  $('#add-todo').find("textarea[name=task_note]").val('');
                  $('#task_start_timeErr').html('');
                  $('#add-todo').find("input[name=another-todo-cnt]").val(data.new_another_todo_cnt);
                  $('#add-todo').find("#show-another-todo-cnt").html(data.new_another_todo_cnt+' todo created successfully!');
                
                  var event_id = $('#add-todo').find("input[name=event_id]").val();
                  $.ajax({
                        type: "POST",
                        url: base_url+'front/calendar_get_inside_event_todo',
                        type: 'POST',
                        data: {
                            event_id:event_id
                        },
                        success: function(data){
                            $("#view-event").find('.modal-body-inside-todo').html(data);
                        }
                  });
                }
                else
                {
                  $("#view-event").find('.modal-body-inside-todo').html(data);
                  //$('#add-inside-todo').trigger("reset");
                  $('#add-todo').find("input[name=task_name]").val('');
                  $('#add-todo').find("textarea[name=task_note]").val('');
                  $('#task_start_timeErr').html('');
                  $('#add-todo').find("select[name=priority]").val('No Priority');
                  $('#add-todo').find("select[name=task_reminder]").val('No reminder');
                  //$('#add-todo').find("select[name=task_start_time]").val('06:00 AM');
                  //$('#add-todo').find("select[name=task_start_time]").select2().trigger('change');
                  $('#task_allDay').val('false');
                  $('#task_allDay').prop('checked', false);
                  $('.task_create_event_start_time').val('');
                  $('.all-task-time-section').val('');
                  $('#task_start_time_val').val('');
                  if($('.task_create_event_start_time:visible').length == 0)
                  {                    
                    $(".all-task-time-section").show();
                  }
                  else
                  {
                    $(".all-task-time-section").hide();
                  }                  
                  $("#add-todo").modal('hide');
                  $('#add_todobut').blur();
                  $('#add-todo').find("input[name=another-todo-cnt]").val('0');
                  $('#add-todo').find("#show-another-todo-cnt").html('');
                  $('#another-todo').prop('checked', false);
                  Swal.fire("Created!", "Successfully.", "success");
                }             

                // var event_id = data.hidden_event_id;
                // $(".add-task-form-calendar").trigger("reset");
                // // $(".add-task-form-calendar").find("#event_id").select2().trigger('change');
                // $(".add-task-form-calendar").find("input[name=priority]").val(data.priority);
                // $("#add-task").modal('hide');
                // location.reload();

                // if(event_id != 0){
                //   $('.task-section0').load(document.URL + ' .task-section0>*');
                //   $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
                // }else{
                //   $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
                // }

                // $('.total-task-count').load(document.URL + ' .total-task-count>*');
                // $('.all-tasks').load(document.URL + ' .all-tasks>*');
              }
              //console.log(data);
           }// success msg ends here

         });
      }
      else
      {
        $('#task_start_timeErr').html('Start time is required!');
      }
      
    });

$("input[name='calendarEvents_filter_radio']").click(function () {
    //debugger;
      $("#search-criteria-list").val("");
      $('.search-list').show();
      $('#search-clear-list').css('display','none');
      var calendarEvents_filter_radio = $(this).val();
      if($('.all-data').hasClass('active_searched'))
      {
        $('.all-data').removeClass('active_searched')
      }
      $('.filtercollapse').css('display','none');
      if(calendarEvents_filter_radio == 'today')
      {
        //debugger;
        var today = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          var start = moment($(this).attr('data-searchid')).subtract(1, 'days').format('Y-MM-DD');
          var end =  moment($(this).attr('data-end-searchid')).add(1, 'days').format('Y-MM-DD');
          // console.log(today);
          // console.log(start);
          // console.log(end);
          // console.log(moment(today).isBetween(start, end));
          $(this).toggle(moment(today).isBetween(start, end));
          $(this).closest('div.parent_task:visible').addClass('active_searched');
          if(moment(today).isBetween(start, end))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(calendarEvents_filter_radio == 'tomorrow')
      {
        var tomorrow = moment().add(1, 'days').format('Y-MM-DD');
        //console.log(tomorrow);
        $(".all-data").filter(function() {
          var start = moment($(this).attr('data-searchid')).subtract(1, 'days').format('Y-MM-DD');
          var end =  moment($(this).attr('data-end-searchid')).add(1, 'days').format('Y-MM-DD');
          $(this).toggle(moment(tomorrow).isBetween(start, end));
          $(this).closest('div.parent_task:visible').addClass('active_searched');
          if(moment(tomorrow).isBetween(start, end))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(calendarEvents_filter_radio == 'this_week')
      {
        //debugger;
        var currentDate = moment();
        var weekStart_fd = currentDate.clone().startOf('week');
        var weekEnd_ld = currentDate.clone().endOf('week');
        var weekStart = weekStart_fd.subtract(1, 'days').format('Y-MM-DD');  
        var weekEnd = weekEnd_ld.add(1, 'days').format('Y-MM-DD');
        // console.log(weekStart);
        // console.log(weekEnd);
        // console.log(weekStart_fd);
        // console.log(weekEnd_ld);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(weekStart, weekEnd));
          if(moment(dates).isBetween(weekStart, weekEnd))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(calendarEvents_filter_radio == 'week')
      {
        var firstDay = moment().format('Y-MM-DD');
        var lastDay = moment().add(8, 'days').format('Y-MM-DD');  
        //console.log(firstDay);
        //console.log(lastDay);    
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(firstDay, lastDay));
          if(moment(dates).isBetween(firstDay, lastDay))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(calendarEvents_filter_radio == 'overdue')
      {
        var overdue = moment().format('Y-MM-DD');
        //console.log(overdue);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-end-searchid');
          $(this).toggle(moment(dates).isBefore(moment(overdue)));
          if(moment(dates).isBefore(moment(overdue)))
          {
              var check_li = $(this).closest('div.parent_task').find('li').length;
              if(check_li != '0')
              {
                  var incomplete_class = $(this).closest('div.parent_task').find('li.all-data.incomplete_class').length;
                  if(incomplete_class > '0')
                  {
                    $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
                    $(this).closest('div.parent_task').find('li.incomplete_class').css('display','block').removeClass('active_searched');
                    $(this).closest('div.parent_task').find('li.complete_class').css('display','none').removeClass('active_searched');
                  }
                  else
                  {
                    $(this).closest('div.parent_task').css('display','none').removeClass('active_searched');
                    $(this).closest('div.parent_task').find('li.complete_class').css('display','none').removeClass('active_searched');
                  }
              }
              else
              {
                  $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
              }
          }
        });
      }
      else if(calendarEvents_filter_radio == 'all')
      {
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf($(this).attr('data-searchid')) == 0).removeClass('active_searched');
        });
      }
  });

  $('#RemoveMemberForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#dont_send').hide();
    $('#send').hide();
    $('#mrloader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/RemoveMemberFormSubmit',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:true,
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
            $('#dont_send').show();
            $('#send').show();
            $('#mrloader2').css('visibility','hidden');
          }
          else if(data.status == true)
          {
            if(data.memtype == 'eventmem')//for reg members
            {
              $('.mm'+data.mid).remove();
              $('#member_rmmf').val('');
              $('#mid_rmmf').val('');
              $('#imid_rmmf').val('');
              $('#memtype_rmmf').val('');
              $('#butsel').val('');
              $('#RemoveMemberMailModal').modal('hide');
              $('#dont_send').show();
              $('#send').show();
              $('#mrloader2').css('visibility','hidden');
              Swal.fire("Removed!", "Successfully.", "success"); 
            }
            if(data.memtype == 'eventinvitedmem')//for email id invited members
            {
              $('.mmi'+data.imid).remove();
              $('#member_rmmf').val('');
              $('#mid_rmmf').val('');
              $('#imid_rmmf').val('');
              $('#memtype_rmmf').val('');
              $('#butsel').val('');
              $('#RemoveMemberMailModal').modal('hide');
              $('#dont_send').show();
              $('#send').show();
              $('#mrloader2').css('visibility','hidden');
              Swal.fire("Removed!", "Successfully.", "success"); 
            }
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  $('#RemoveMemberUpdateForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#dont_send_up').hide();
    $('#send_up').hide();
    $('#mrloader2_up').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/RemoveMemberUpdateFormSubmit',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:true,
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
            $('#dont_send_up').show();
            $('#send_up').show();
            $('#mrloader2_up').css('visibility','hidden');
          }
          else if(data.status == true)
          {
            Swal.fire("Updated!", "Successfully.", "success");
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

//////Calendar Part Ends///////

//////Goal & Strategies Part Start///////

$(function() {
    $( ".goal_Cdate" ).datepicker({todayHighlight: true,startDate: new Date()});
  });

// FOR  CREATE NEW  GOAL FORM ----------------------------------------
  $('#create_goal_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#create_goal_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_goal',
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
            $('#create_goal_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
            var gid = data.gid;
            var gdept = data.gdept;
            $('#current_section').removeClass('cus_wiz_a_current');
            $('#next_section').addClass('cus_wiz_a_current');
            $('#current_section_number').removeClass('cus_wiz_current_number');
            $('#current_section_number').addClass('cus_wiz_number');
            $('#next_section_number').removeClass('cus_wiz_number');
            $('#next_section_number').addClass('cus_wiz_current_number');
            $('#new_gid').val(gid);
            $('#new_gdept').val(gdept);
            $('#current_section_div').hide();
            $('#next_section_div').show();
            // window.location = base_url+'goal-overview/'+gid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  $('#edit_goal_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_goal_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_goal',
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
            $('#edit_goal_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
            $('.new_gname'+data.gid).html(data.new_gname); 
            $('.new_gdes'+data.gid).html(data.new_gdes); 
            $('.new_gdept'+data.gid).html(data.new_gdept);
            $('.new_gsd'+data.gid).html(data.new_gsd);
            $('.new_ged'+data.gid).html(data.new_ged);
            $('#GoalEditModal').modal('hide'); 
          }
          //console.log(data);
       }// success msg ends here

     });
  });

$('#create_strategies_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#create_strategies_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_strategies',
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
            $('#create_strategies_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
            var gid = data.gid;
            window.location = base_url+'goal-overview/'+gid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });

$('#edit_strategies_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_strategies_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_strategies',
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
            $('#edit_strategies_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
            $('.new_sname'+data.sid).html(data.new_sname); 
            $('.new_sdes'+data.sid).html(data.new_sdes); 
            $('#StrategiesEditModal').modal('hide'); 
          }
          //console.log(data);
       }// success msg ends here

     });
  });

$('#goal_history_excel_form').on('submit',function(event){
//debugger;
event.preventDefault();
             var formData = new FormData(this); 
    Swal.fire({
      title: "You Want To Download History in Excel?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            //debugger;
              $.ajax({
                   url:base_url+'front/goal_history_excel',
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
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');
                    }
                    else if(data.status == 'empty_option')
                    {
                      $('#empty_optionErr').html('Please Select Any One Option to Export History in Excel!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');         
                    }
                    else if(data.status == 'not_found')
                    {
                      $('#empty_optionErr').html('No Record Found!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden'); 
                    }
                    else if(data.status == true)
                    {
                      //debugger;
                      $('#empty_optionErr').html('');  
                      $('#only_date').val('');
                      $('#start_date').val('');
                      $('#end_date').val('');
                      $('#all_history').prop('checked', false);
                      $('#excel_date_options').modal('hide');
                      window.location = base_url+'front/goal_export_excel';
                    }
                    //console.log(data);
                 }// success msg ends here

               });
          }
      }); 
  });

$('#strategy_history_excel_form').on('submit',function(event){
//debugger;
event.preventDefault();
             var formData = new FormData(this); 
    Swal.fire({
      title: "You Want To Download History in Excel?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            //debugger;
              $.ajax({
                   url:base_url+'front/strategy_history_excel',
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
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');
                    }
                    else if(data.status == 'empty_option')
                    {
                      $('#empty_optionErr').html('Please Select Any One Option to Export History in Excel!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden');         
                    }
                    else if(data.status == 'not_found')
                    {
                      $('#empty_optionErr').html('No Record Found!');  
                      $('#history_excel_button').show();
                      $('#loader2').css('visibility','hidden'); 
                    }
                    else if(data.status == true)
                    {
                      //debugger;
                      $('#empty_optionErr').html('');  
                      $('#only_date').val('');
                      $('#start_date').val('');
                      $('#end_date').val('');
                      $('#all_history').prop('checked', false);
                      $('#excel_date_options').modal('hide');
                      window.location = base_url+'front/strategy_export_excel';
                    }
                    //console.log(data);
                 }// success msg ends here

               });
          }
      }); 
  });



  

  $('#gdetail_SuggestTMemberForm').on('submit',function(event){
          //debugger;          
        event.preventDefault(); // Stop page from refreshing
        $('#gdetail_SuggestTMemberButton').hide();
        $('#loader2').css('visibility', 'visible');
       var formData = new FormData(this); 
        $.ajax({
             url:base_url+'front/gdetail_SuggestTMember',
             type:"POST",
             data:formData,
             contentType:false,
             processData:false,
             cache:true,
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
                $('#gdetail_SuggestTMemberButton').show();
                $('#loader2').css('visibility','hidden'); 
              }
              else if(data.status == 'registered_email')
              {
                 $('#ismemberErr').html('Goal Team Member Request sent or Added in Team!');
                 $('#gdetail_SuggestTMemberButton').show();
                 $('#loader2').css('visibility', 'hidden');
              }
              else if(data.status == 'already_invited')
              {
                 $('#ismemberErr').html('Already Invited Email!');
                 $('#gdetail_SuggestTMemberButton').show();
                 $('#loader2').css('visibility', 'hidden');
              }
              else if(data.status == 'Already_suggested')
              {
                 $('#selected_T_memberErr').html('Already Suggested Member!');
                 $('#gdetail_SuggestTMemberButton').show();
                 $('#loader2').css('visibility', 'hidden');
              }
              else if(data.status == 'Empty_Member')
              {
                 $('#selected_T_memberErr').html('Please select Member To Suggest!');
                 $('#gdetail_SuggestTMemberButton').show();
                 $('#loader2').css('visibility', 'hidden');
              }
              else if(data.status == 'err_valid')
              {
                $('#err_valid').html('Goal Owner cannot be added as Team Member!');    
                $('#gdetail_SuggestTMemberButton').show();
                $('#loader2').css('visibility','hidden');         
              }
              else if(data.status == true){
               window.location.reload();
              }
              //console.log(data);
           }// success msg ends here
         });
      });

  // FOR ADD TEAM MEMBER FORM ----------------------------------------
        $('#gdetail_AddTeamMemberForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#gdetail_AddTeamMemberButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/gdetail_AddMember',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#gdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'Empty_TMember')
                {
                   $('#selected_T_memberErr').html('Please select Team Member!');
                   $('#gdetail_AddTeamMemberButton').show();
                   $('#loader2').css('visibility', 'hidden');
                }
                else if(data.status == 'Invited_email')
                {
                  $('#imemailErr').html('Already Invited!');  
                  $('#gdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'registered_email')
                {
                  $('#imemailErr').html('Goal Team Member Request sent or Added in Team!');  
                  $('#gdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == 'err_valid')
                {
                  $('#err_valid').html('Goal Owner cannot be added as Team Member!');    
                  $('#gdetail_AddTeamMemberButton').show();
                  $('#loader2').css('visibility','hidden');         
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

// Open Work New Assignee to goal current assignee FORM ----------------------------------------
        $('#GoalOpenWorkNewAssignee').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#GoalOpenWorkNewAssigneeButton').hide();
          $('#cloader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'front/goal_open_work_new_assignee',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#GoalOpenWorkNewAssigneeButton').show();
                  $('#cloader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                    Swal.fire("Team Member Removed!", "Successfully.", "success");
                    window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

//////Goal & Strategies Part End///////

// FOR CONTACT SALES FORM ----------------------------------------
  $('#insert_ContactSales').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    $('#insert_ContactSales_btn').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_ContactSales',
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
            $('#insert_ContactSales_btn').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'cus_pack_already_created'){
            $('#Already_contactedErr').html('Only one custom package is applicable to specific user!');
            $('#insert_ContactSales_btn').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'wait_response_contacted'){
            $('#Already_contactedErr').html('Contact Request Already Sent! Please Wait for Response!');
            $('#insert_ContactSales_btn').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  // FOR FREE TRIAL ACCESS FORM ----------------------------------------
  $('#free_trial_account_access').on('submit',function(event){    
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#free_trial_account_access_btn').hide();
    $('#co_loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/free_trial_account_access',
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
            $('#free_trial_account_access_btn').show();
            $('#co_loader2').css('visibility','hidden');  
          }
          else if(data.status == 'invalid_code'){
            $('#codeErr').html('Invalid Code!');
            $('#free_trial_account_access_btn').show();
            $('#co_loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'used_code'){
            $('#codeErr').html('Already Used Code!');
            $('#free_trial_account_access_btn').show();
            $('#co_loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  //////////corporate section////////////

  $('#corporate_registration_form').on('submit',function(event){ 
    //debugger;   
    event.preventDefault(); // Stop page from refreshing
    $('#corporate_registration_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_corporate_registration',
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
            $('#recaptchaErr').html(data.errors);
            $('#corporate_registration_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Limit_Error')
          {
            $('#conf_passwordErr').html('Limit Exceeds! Please contact your company!'); 
            $('#corporate_registration_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == 'Error_Registration')
          {
            $('#conf_passwordErr').html('Registration Failed! Please Try Again!'); 
            $('#corporate_registration_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == 'fullnameErr')
          {
            $('#full_nameErr').html('<p>Please enter full name!</p>'); 
            $('#corporate_registration_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == 'fullname2Err')
          {
            $('#full_nameErr').html('<p>Please enter valid full name!</p>'); 
            $('#corporate_registration_button').show();
            $('#loader2').css('visibility','hidden');          
          }
          else if(data.status == true){
            window.location = base_url+'login';
          }
          //console.log(data);
       }// success msg ends here

     });
  });

  //////////corporate section////////////


  $( '#tproject_assign' ).select2({
  /* Sort data using localeCompare- task project alphabetical order */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '#tproject_assign2' ).select2({
  /* Sort data using localeCompare- task project alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

$( '.pro_team_member' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '#team_member2' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

$( '#pid_task' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

$( '#pid_contentplan' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

$( '.editable_team_member' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '.team_member21' ).select2({
  /* Sort data using localeCompare- subtask assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '.written_content_assignee' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '.pc_file_assignee' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '.submit_to_approval' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

  $( '.pc_assignee' ).select2({
  /* Sort data using localeCompare- task assignee alphabetical order  */
  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});

});

////////////////////////////////////////////////////////
//pack limit exceeds
function limit_Exceeds_popup()
{
    Swal.fire(
        {
            title: 'Limit Exceeds!',
            text: 'Upgrade Your Package?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c7df19',
            cancelButtonColor: "#383838",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }
    ).then(function (result) {
        if (result.value) {
            window.location = base_url+'pricing-packages';
        }
    });
}

//pack expired
function Expire_Package_popup()
{
    Swal.fire(
        {
            title: 'Package Expired!',
            text: 'Renew or Update Package?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c7df19',
            cancelButtonColor: "#383838",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }
    ).then(function (result) {
        if (result.value) {
            window.location = base_url+'pricing-packages';
        }
    });
}

//upgrade package to add quote logo and link
function update_package_for_qlogo()
{
    Swal.fire(
        {
            title: 'Paid Feature!',
            text: 'Please Upgrade To Paid Package?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c7df19',
            cancelButtonColor: "#383838",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }
    ).then(function (result) {
        if (result.value) {
            window.location = base_url+'pricing-packages';
        }
    });
}

// function turn_off_auto_renew()
// {
//   opt = "manual";
//   $('#switch1').prop('checked', true);
//   Swal.fire({
//       title: "Are you sure?",
//       text: "You want to Turn Off Auto Renew",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#c7df19",
//       cancelButtonColor: "#383838",
//       confirmButtonText: "Yes"
//       }).then(function (result) {
//           if (result.value) {
//             // AJAX request
//              $.ajax({
//               url:  base_url+'front/manage_renew_plan',
//               type: 'post',
//               data: {opt: opt},
//               success: function(data)
//               { 
//                 Swal.fire("Manual Renew Mode!", "Successfully.", "success");
//                 window.location.reload();
//               }
//             });
//           }
//       });       
// }

// function turn_on_auto_renew()
// {
//   opt = "auto";
//   $('#switch1').prop('checked', false);
//   Swal.fire({
//       title: "Are you sure?",
//       text: "You want to Turn On Auto Renew",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#c7df19",
//       cancelButtonColor: "#383838",
//       confirmButtonText: "Yes"
//       }).then(function (result) {
//           if (result.value) {
//             // AJAX request
//              $.ajax({
//               url:  base_url+'front/manage_renew_plan',
//               type: 'post',
//               data: {opt: opt},
//               success: function(data)
//               { 
//                 Swal.fire("Auto Renew Mode!", "Successfully.", "success");
//                 window.location.reload();
//               }
//             });
//           }
//       });       
// }

function downgrade_pack()
{
  Swal.fire({
      title: "You want to Downgrade Plan?",
      text: "If current plan selected date is beyond 30 Days then NO REFUND!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('#downgrade_pack').hide();
            $('#downgrade_pack_process').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/downgrade_plan',
              type: 'post',
              success: function(data)
              { 
                if(data.status == true)
                {
                  window.location.reload();
                }                
              }
            });
          }
      });
}

function show_portfolio_filter_option()
{
      $('#portfolio_filter_option').show();
}

function hide_portfolio_filter_option()
{
      $('#portfolio_filter_option').hide();
}

// function project_search_task_submit()
// {
//   //debugger;
//   $('#project_search_task').submit(); 
// }

// function all_project_search_task_submit()
// {
//   //debugger;
//   $('#all_project_search_task').submit(); 
// }

// function portfolio_projects_content_search_submit()
// {
//   //debugger;
//   $('#portfolio_projects_content_search').submit(); 
// }

function GetTask_Filter()
{
  //debugger;
var myTask_radio = $("input[name='myTask_radio']:checked").val();
//console.log(myTask_radio);
    if($('.all-data').hasClass('active_searched'))
      {
        $('.all-data').removeClass('active_searched')
      }
      $('.filtercollapse').css('display','none');
      if(myTask_radio == 'today')
      {
        var today = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(today) == 0);
          if($(this).attr('data-searchid') == today)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'tomorrow')
      {
        var tomorrow = moment().add(1, 'days').format('Y-MM-DD');
        //console.log(tomorrow);
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(tomorrow) == 0);
          if($(this).attr('data-searchid') == tomorrow)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'this_week')
      {
        //debugger;
        var currentDate = moment();
        var weekStart_fd = currentDate.clone().startOf('week');
        var weekEnd_ld = currentDate.clone().endOf('week');
        var weekStart = weekStart_fd.subtract(1, 'days').format('Y-MM-DD');  
        var weekEnd = weekEnd_ld.add(1, 'days').format('Y-MM-DD');
        // console.log(weekStart);
        // console.log(weekEnd);
        // console.log(weekStart_fd);
        // console.log(weekEnd_ld);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(weekStart, weekEnd));
          if(moment(dates).isBetween(weekStart, weekEnd))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'week')
      {
        var firstDay = moment().format('Y-MM-DD');
        var lastDay = moment().add(8, 'days').format('Y-MM-DD');  
        //console.log(firstDay);
        //console.log(lastDay);    
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(firstDay, lastDay));
          if(moment(dates).isBetween(firstDay, lastDay))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
            $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(myTask_radio == 'overdue')
      {
        var overdue = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          $(this).toggle(moment(dates).isBefore(moment(overdue)));
          if(moment(dates).isBefore(moment(overdue)))
          {
            if($(this).closest('div.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('1');
              if($(this).closest('div.parent_task').find('li').hasClass('overdue_task_in_list'))
              {
              //console.log('11');
                $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
              else
              {
              //console.log('12');
                $(this).closest('div.parent_task').css('display','none').removeClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
            }
            else if($(this).closest('div.parent_task').hasClass('overdue_task_in_list'))
            {
              //console.log('2');
              $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
              $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
            }
            if($(this).closest('section.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('11');
              $(this).closest('section.parent_task').css('display','none').removeClass('active_searched');
            }
            else
            {
              //console.log('22');
              $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
            }
          }
        });
      }
      else if(myTask_radio == 'all')
      {
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf($(this).attr('data-searchid')) == 0).removeClass('active_searched');
        });
      }
}

function GetPortfolioTask_Filter()
{
  //debugger;
      // $("#search-criteria-list").val("");
      // $('.search-list').show();
      // $('#search-clear-list').css('display','none');
      $('.progressbar_display').hide();
      var portfolioTask_radio = $("input[name='portfolioTask_radio']:checked").val();
      if($('.all-data').hasClass('active_searched'))
        {
          $('.all-data').removeClass('active_searched')
        }
      $('.filtercollapse').css('display','none');
//console.log(portfolioTask_radio);
      if(portfolioTask_radio == 'today')
      {
        var today = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(today) == 0);
          if($(this).attr('data-searchid') == today)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'tomorrow')
      {
        var tomorrow = moment().add(1, 'days').format('Y-MM-DD');
        //console.log(tomorrow);
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf(tomorrow) == 0);
          if($(this).attr('data-searchid') == tomorrow)
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'this_week')
      {
        //debugger;
        var currentDate = moment();
        var weekStart_fd = currentDate.clone().startOf('week');
        var weekEnd_ld = currentDate.clone().endOf('week');
        var weekStart = weekStart_fd.subtract(1, 'days').format('Y-MM-DD');  
        var weekEnd = weekEnd_ld.add(1, 'days').format('Y-MM-DD');
        // console.log(weekStart);
        // console.log(weekEnd);
        // console.log(weekStart_fd);
        // console.log(weekEnd_ld);
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(weekStart, weekEnd));
          if(moment(dates).isBetween(weekStart, weekEnd))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'week')
      {
        var firstDay = moment().format('Y-MM-DD');
        var lastDay = moment().add(8, 'days').format('Y-MM-DD');  
        //console.log(firstDay);
        //console.log(lastDay);    
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          //console.log(dates);
          $(this).toggle(moment(dates).isBetween(firstDay, lastDay));
          if(moment(dates).isBetween(firstDay, lastDay))
          {
            $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
          }
        });
      }
      else if(portfolioTask_radio == 'overdue')
      {
        var overdue = moment().format('Y-MM-DD');
        $(".all-data").filter(function() {
          var dates = $(this).attr('data-searchid');
          $(this).toggle(moment(dates).isBefore(moment(overdue)));
          if(moment(dates).isBefore(moment(overdue)))
          {
            if($(this).closest('div.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('1');
              if($(this).closest('div.parent_task').find('li').hasClass('overdue_task_in_list'))
              {
              //console.log('11');
                $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
              else
              {
              //console.log('12');
                $(this).closest('div.parent_task').css('display','none').removeClass('active_searched');
                $(this).closest('div.parent_task').find('li.future_task_in_list').css('display','none').removeClass('active_searched');
              }
            }
            else if($(this).closest('div.parent_task').hasClass('overdue_task_in_list'))
            {
              //console.log('2');
              $(this).closest('div.parent_task').css('display','block').addClass('active_searched');
              $(this).closest('div.parent_task').find('li.overdue_task_in_list').css('display','block').addClass('active_searched');
            }
            if($(this).closest('section.parent_task').hasClass('future_task_in_list'))
            {
              //console.log('11');
              $(this).closest('section.parent_task').css('display','none').removeClass('active_searched');
            }
            else
            {
              //console.log('22');
              $(this).closest('section.parent_task').css('display','block').addClass('active_searched');
            }
          }
        });
      }
      else if(portfolioTask_radio == 'all')
      {
        $('.progressbar_display').show();
        $(".all-data").filter(function() {
          $(this).toggle($(this).attr('data-searchid').indexOf($(this).attr('data-searchid')) == 0).removeClass('active_searched');
        });
      }
}

function editable_field()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("input").focus();
}

function edit_yes()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  var txt = target.find("input").val();
  if(txt != " ") 
  {
    $('.edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_table',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
            success: function(data){
              if(data.status == false)
                {
                  $('.edit_yes_but'+div_id).show();
                  if(data.sub_count == "not_done")
                  {
                    target.find(".req_tfield").html('Subtask Not Completed').css('display','block');
                  }
                  else
                  {
                    target.find(".req_tfield").html('Field not updated').css('display','block');
                  }    
                }
                else if(data.status == true)
                {
                  $('.edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_tfield").css('display','none');
                  //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                  $('#to_do-task').load(document.URL + ' #to_do-task>*');
                  $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                  $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                  $('#done-task').load(document.URL + ' #done-task>*');
                } 
            }
          });
  }
  else
  {
    $('.edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function edit_yes_calendar(sel)
{
  //debugger;
  var target = $(sel).closest("fieldset");
  var div_class = $(sel).attr('data-class');
  var div_field = $(sel).attr('data-name');
  var div_id = $(sel).attr('data-id');
  var txt = target.find("input").val();
  if(txt != " ") 
  {
    $('.edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_table',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
            success: function(data){
              if(data.status == false)
                {
                  $('.edit_yes_but'+div_id).show();
                  if(data.sub_count == "not_done")
                  {
                    target.find(".req_tfield").html('Subtask Not Completed').css('display','block');
                  }
                  else
                  {
                    target.find(".req_tfield").html('Field not updated').css('display','block');
                  }    
                }
                else if(data.status == true)
                {
                  $('.edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.removeClass("editable");
                  target.find(".req_tfield").css('display','none');
                  if(div_field == 'tduedate_field')
                  {
                    //debugger;
                    $('.if_task_date_change'+div_id).val(txt);
                    $('.task_date_changed'+div_id).datepicker("destroy");
                  }
                  //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                  $('#to_do-task').load(document.URL + ' #to_do-task>*');
                  $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                  $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                  $('#done-task').load(document.URL + ' #done-task>*');
                } 
            }
          });
  }
  else
  {
    $('.edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function dont_edit()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text();
  if(org_val != "") 
  {
    target.find("input").val(org_val);
    target.toggleClass("editable");
    target.find(".req_tfield").css('display','none');
  }
  else
  {
    target.find(".req_tfield").css('display','block');
  }
}

function editable_field2()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("select").focus();
}

function edit_yes2()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  var mtask_id = $(event.target).attr('data-mtask_id');
  //console.log(div_class);
  //console.log(div_field);
  //console.log(div_id);
  var txt = target.find("select option:selected").text();
  var txt_val = target.find("select").val();
  //console.log(txt);
  //console.log(txt_val);
  if(txt != " ") 
  {
    $('.edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_table',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt_val},
            success: function(data){
              if(data.status == false)
                {
                  $('.edit_yes_but'+div_id).show();
                  if(data.sub_count == "not_done")
                  {
                    target.find(".req_tfield").html('Subtask Not Completed').css('display','block');
                  }
                  else
                  {
                    target.find(".req_tfield").html('Field not updated').css('display','block');
                  }   
                }
                else if(data.status == true)
                {
                  $('.edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_tfield").css('display','none');
                  if(div_field == "tassignee_field")
                  {
                    $('#collapseExample'+mtask_id).load(document.URL + ' #collapseExample'+mtask_id+'>*');
                    // $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                    // var divList = $(".new_tid_top");
                    //   divList.sort(function(a, b) {
                    //       return parseInt($(b).data('toptid')) - parseInt($(a).data('toptid'));
                    //   });
                  }
                  if(div_field == "stassignee_field")
                  {
                    $('#collapseExample'+mtask_id).load(document.URL + ' #collapseExample'+mtask_id+'>*');
                    // $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                  }
                  //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                  $('#to_do-task').load(document.URL + ' #to_do-task>*');
                  $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                  $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                  $('#done-task').load(document.URL + ' #done-task>*');
                } 
            }
          });
  }
  else
  {
    $('.edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function dont_edit2()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text().toLowerCase();
  //console.log(org_val);
  if(org_val != "") 
  {
    target.find("select option:selected").val(org_val);
    target.toggleClass("editable");
    target.find(".req_tfield").css('display','none');
  }
  else
  {
    target.find(".req_tfield").css('display','block');
  }
}

//grid editable start//
function showEditTnameModal(tid)
    {
        $('#show-edit-tname'+tid).css('display','block');
        var tname = $.trim($('#task-name'+tid).html());
        $('#task_name'+tid).val(tname);
    }

function closeEditTnameModal(tid)
    {
        $('#show-edit-tname'+tid).css('display','none');
        $('#show-edit-tname'+tid).modal('hide');
        $(".req_tfield"+tid).css('display','none');
    }

function changeTname(tid)
    {
        event.preventDefault();
        var div_id = tid;
        var div_class = "task_editable";
        var div_field = "tname_field";
        var txt = $('#task_name'+div_id).val();
        if(txt != "") 
        {
          $('.edit_yes_but_grid'+div_id).hide();
          $.ajax({
                  url: base_url+'front/editable_table',
                  type: 'POST', 
                  data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
                  success: function(data){
                    if(data.status == false)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        if(data.sub_count == "not_done")
                        {
                          $(".req_tfield"+div_id).html('Subtask Not Completed').css('display','block');
                        }
                        else
                        {
                          $(".req_tfield"+div_id).html('Field not updated').css('display','block');
                        }    
                      }
                      else if(data.status == true)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        $('#task-name'+div_id).html(txt);
                        $('#show-edit-tname'+div_id).css('display','none');
                        $('#task_name'+div_id).trigger("reset");
                        $(".req_tfield"+div_id).css('display','none');
                        $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                        // $('#to_do-task').load(document.URL + ' #to_do-task>*');
                        // $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                        // $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                        // $('#done-task').load(document.URL + ' #done-task>*');
                      } 
                  }
                });
        }
        else
        {
          $('.edit_yes_but_grid'+div_id).show();
          $(".req_tfield"+div_id).css('display','block');
        }
    }

function showEditSTnameModal(stid)
    {
        $('#show-edit-stname'+stid).css('display','block');
        var stname = $.trim($('#subtask-name'+stid).html());
        $('#subtask_name'+stid).val(stname);
    }

function closeEditSTnameModal(stid)
    {
        $('#show-edit-stname'+stid).css('display','none');
        $('#show-edit-stname'+stid).modal('hide');
        $(".req_tfield"+stid).css('display','none');
    }

function changeSTname(stid)
    {
        event.preventDefault();
        var div_id = stid;
        var div_class = "subtask_editable";
        var div_field = "stname_field";
        var txt = $('#subtask_name'+div_id).val();
        if(txt != "") 
        {
          $('.edit_yes_but_grid'+div_id).hide();
          $.ajax({
                  url: base_url+'front/editable_table',
                  type: 'POST', 
                  data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
                  success: function(data){
                    if(data.status == false)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        if(data.sub_count == "not_done")
                        {
                          $(".req_tfield"+div_id).html('Subtask Not Completed').css('display','block');
                        }
                        else
                        {
                          $(".req_tfield"+div_id).html('Field not updated').css('display','block');
                        }    
                      }
                      else if(data.status == true)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        $('#subtask-name'+div_id).html(txt);
                        $('#show-edit-stname'+div_id).css('display','none');
                        $('#subtask_name'+div_id).trigger("reset");
                        $(".req_tfield"+div_id).css('display','none');
                        $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                        // $('#to_do-task').load(document.URL + ' #to_do-task>*');
                        // $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                        // $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                        // $('#done-task').load(document.URL + ' #done-task>*');
                      } 
                  }
                });
        }
        else
        {
          $('.edit_yes_but_grid'+div_id).show();
          $(".req_tfield"+div_id).css('display','block');
        }
    }

function showEditTduedateModal(tid)
    {
        $('#show-edit-tduedate'+tid).css('display','block');
        var tduedate = $.trim($('#task-duedate'+tid).html());
        $('#task_duedate'+tid).val(tduedate);
    }

function closeEditTduedateModal(tid)
    {
        $('#show-edit-tduedate'+tid).css('display','none');
        $('#show-edit-tduedate'+tid).modal('hide');
        $(".req_tfield"+tid).css('display','none');
    }

function changeTduedate(tid)
    {
        event.preventDefault();
        var div_id = tid;
        var div_class = "task_editable";
        var div_field = "tduedate_field";
        var txt = $('#task_duedate'+div_id).val();
        if(txt != "") 
        {
          $('.edit_yes_but_grid'+div_id).hide();
          $.ajax({
                  url: base_url+'front/editable_table',
                  type: 'POST', 
                  data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
                  success: function(data){
                    if(data.status == false)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        if(data.sub_count == "not_done")
                        {
                          $(".req_tfield"+div_id).html('Subtask Not Completed').css('display','block');
                        }
                        else
                        {
                          $(".req_tfield"+div_id).html('Field not updated').css('display','block');
                        }    
                      }
                      else if(data.status == true)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        $('#task-duedate'+div_id).html(txt);
                        $('#show-edit-tduedate'+div_id).css('display','none');
                        $('#task_duedate'+div_id).trigger("reset");
                        $(".req_tfield"+div_id).css('display','none');
                        $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                        // $('#to_do-task').load(document.URL + ' #to_do-task>*');
                        // $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                        // $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                        // $('#done-task').load(document.URL + ' #done-task>*');
                      } 
                  }
                });
        }
        else
        {
          $('.edit_yes_but_grid'+div_id).show();
          $(".req_tfield"+div_id).css('display','block');
        }
    }

function showEditSTduedateModal(stid)
    {
        $('#show-edit-stduedate'+stid).css('display','block');
        var stduedate = $.trim($('#subtask-duedate'+stid).html());
        $('#stdue_date'+stid).val(stduedate);
    }

function closeEditSTduedateModal(stid)
    {
        $('#show-edit-stduedate'+stid).css('display','none');
        $('#show-edit-stduedate'+stid).modal('hide');
        $(".req_tfield"+stid).css('display','none');
    }

function changeSTduedate(stid)
    {
        event.preventDefault();
        var div_id = stid;
        var div_class = "subtask_editable";
        var div_field = "stduedate_field";
        var txt = $('#stdue_date2'+div_id).val();
        if(txt != "") 
        {
          $('.edit_yes_but_grid'+div_id).hide();
          $.ajax({
                  url: base_url+'front/editable_table',
                  type: 'POST', 
                  data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
                  success: function(data){
                    if(data.status == false)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        if(data.sub_count == "not_done")
                        {
                          $(".req_tfield"+div_id).html('Subtask Not Completed').css('display','block');
                        }
                        else
                        {
                          $(".req_tfield"+div_id).html('Field not updated').css('display','block');
                        }    
                      }
                      else if(data.status == true)
                      {
                        $('.edit_yes_but_grid'+div_id).show();
                        $('#subtask-duedate'+div_id).html(txt);
                        $('#show-edit-stduedate'+div_id).css('display','none');
                        $('#stdue_date'+div_id).trigger("reset");
                        $(".req_tfield"+div_id).css('display','none');
                        $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                        // $('#to_do-task').load(document.URL + ' #to_do-task>*');
                        // $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                        // $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                        // $('#done-task').load(document.URL + ' #done-task>*');
                      } 
                  }
                });
        }
        else
        {
          $('.edit_yes_but_grid'+div_id).show();
          $(".req_tfield"+div_id).css('display','block');
        }
    }

function task_datepicker(y)
{
  //debugger;
  $("#tdue_date"+y).datepicker({todayHighlight: true,startDate: new Date()});
}

function task_datepicker_pubD(y)
{
  //debugger;
  var end_dd = document.getElementById('get_pub_date'+y).value;
  $("#tdue_date"+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  //console.log(end_dd);
}

function task_datepicker_goalD(y)
{
  //debugger;
  var gstart_dd = document.getElementById('get_gstart_date'+y).value;
  var gend_dd = document.getElementById('get_gend_date'+y).value;
  $("#tdue_date"+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(gend_dd)});
  //console.log(end_dd);
}

function task_datepicker2(y)
{
  //debugger;
  $("#task_duedate"+y).datepicker({todayHighlight: true,startDate: new Date()});
}

function task_datepicker_pubD2(y)
{
  //debugger;
  var end_dd = document.getElementById('get_pub_date22'+y).value;
  $("#task_duedate"+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  //console.log(end_dd);
}

function task_datepicker_goalD2(y)
{
  //debugger;
  var gstart_dd = document.getElementById('get_gstart_date22'+y).value;
  var gend_dd = document.getElementById('get_gend_date22'+y).value;
  $("#task_duedate"+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(gend_dd)});
  console.log(gend_dd);
}

function subtask_datepicker(y)
{
//debugger;
var end_dd = document.getElementById('get_tdue_date'+y).value;
$('#tdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
//console.log(new Date(end_dd) );
}

function task_subtask_datepicker(y)
{
//debugger;
var end_dd = document.getElementById('get_tdue_date'+y).value;
var gstart_dd = document.getElementById('get_gstart_date'+y).value;
var gend_dd = document.getElementById('get_gend_date'+y).value;
if(gend_dd != "")
  {
    $('#stdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(end_dd)});
  }
  else
  {
    $('#stdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  }
//console.log(end_dd);
//console.log($('#stdue_date'+y));
//console.log(({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)}));
}

function subtask_datepicker2(y)
{
//debugger;
var end_dd = document.getElementById('get_tdue_date2'+y).value;
var gstart_dd = document.getElementById('get_gstart_date2'+y).value;
var gend_dd = document.getElementById('get_gend_date2'+y).value;
if(gend_dd != "")
  {
    $('#stdue_date2'+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(end_dd)});
  }
  else
  {
    $('#stdue_date2'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  }
// $('#stdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
//console.log(new Date('2021-11-26') );
}

function redirect_to_task_list()
{   
  window.location = base_url+'tasks-list';      
}

function logout()
{   
            Swal.fire({
                title: "Are you sure?",
                text: "You want to logout!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#c7df19",
                cancelButtonColor: "#383838",
                confirmButtonText: "Yes"
              }).then(function (result) {
                if (result.value) {
                    $.ajax({
                    url: base_url+'front/logout',
                    type: 'POST', 
                    success: function(html){
                      Swal.fire("Logged Out!", "Successfully.", "success");
                      window.location.reload();
                    }
                  });
                }
            });       
}

function delete_project(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_project',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
                // var portid = data.portid;
                // window.location = base_url+'portfolio-projects-list/'+portid;
              }
            });
          }
      });       
}

function archive_project(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_project',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function add_pfile_button()
{
    document.getElementById('add_pfile').click();        
}

function delete_pfile(pid,pfile_id,pfile)
{   
  var pid = pid;
  var pfile_id = pfile_id; 
  var pfile = pfile;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_pfile',
              type: 'post',
              data: {pid: pid, pfile_id: pfile_id, pfile: pfile},
              success: function(data){ 
                Swal.fire("Moved to Project File Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function Team_Members() {
   var selected = [];
  for (var option of document.getElementById('team_member').options) {
    if (option.selected) {
      selected.push(option.value);
    }
  }
 
  document.getElementById("selected_T_member").value = selected;
}

function Team_Members_Cal_up() {
   var selected = [];
  for (var option of document.getElementById('team_member_up').options) {
    if (option.selected) {
      selected.push(option.value);
    }
  }
 
  document.getElementById("selected_T_member_up").value = selected;
}

function get_portfolio_id() {
  //debugger;
var port_id = document.getElementById('portfolio_id').value;
      $.ajax({
                url: base_url+'front/get_portfolioTM',
                method: 'POST',
                data: {port_id:port_id},  
                success: function(data) {
                    $('#team_member').html(data);
                    //console.log(data);                   
                }
            });
}

function get_portfolio_id_Cal_up() {
  //debugger;
var port_id = document.getElementById('portfolio_id_up').value;
      $.ajax({
                url: base_url+'front/get_portfolioTM',
                method: 'POST',
                data: {port_id:port_id},  
                success: function(data) {
                    $('#team_member_up').html(data);
                    // $('#team_member_up').val('');
                    $('#selected_T_member_up').val('');
                    $('#team_member_up').val(null).trigger("change"); 
                    //console.log(data);                   
                }
            });
}

function get_portfolio_id_edit() {
  //debugger;
var port_id = document.getElementById('portfolio_id').value;
var pid = document.getElementById('pid').value;
      $.ajax({
                url: base_url+'front/get_portfolioTM_edit',
                method: 'POST',
                data: {port_id:port_id, pid:pid},  
                success: function(data) {
                    $('#team_member').html(data);
                    //console.log(data);                   
                }
            });
}

function get_project_id() {
  //debugger;
  $('#get_pub_date').val('');
  $('#get_gid').val('');  
  $('#get_sid').val('');  
  $('#get_gstart_date').val('');  
  $('#get_gend_date').val('');   
   var selected = [];
  for (var option of document.getElementById('tproject_assign').options) {
    if (option.selected) {
      selected.push(option.value);
     //console.log(selected.push(option.value));
    }
  }
 var project_id= selected; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_publish',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_pub_date').val(resp);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_gid_sid',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_gid').val(resp.gid);  
                    $('#get_sid').val(resp.sid);  
                    $('#get_gstart_date').val(resp.gstart_date);  
                    $('#get_gend_date').val(resp.gend_date);    
                    $('#dept').html(resp.depts);              
                }
            });
  document.getElementById("pid").value = selected;
}

function get_project_id2() {
  //debugger;
  $('#get_pub_date').val('');
  $('#get_gid').val('');  
  $('#get_sid').val('');  
  $('#get_gstart_date').val('');  
  $('#get_gend_date').val(''); 
   var selected = [];
  for (var option of document.getElementById('tproject_assign2').options) {
    if (option.selected) {
      selected.push(option.value);
     //console.log(selected.push(option.value));
    }
  }
 var project_id= selected; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_publish',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_pub_date').val(resp);                  
                }
            });
            $.ajax({
                url: base_url+'front/get_project_gid_sid',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(resp) {
                    $('#get_gid').val(resp.gid);  
                    $('#get_sid').val(resp.sid);  
                    $('#get_gstart_date').val(resp.gstart_date);  
                    $('#get_gend_date').val(resp.gend_date); 
                    if(resp.check_pid != "")
                    {
                      $('#dept').html(resp.depts);
                    }                 
                }
            });
  document.getElementById("pid").value = selected;
}

function delete_pMember(pid,pm_id,first_name,last_name)
{
  var pid = pid;
  var pm_id = pm_id;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Remove Member : "+ first_name +' '+last_name,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_pMember',
              type: 'post',
              data: {pid: pid, pm_id: pm_id, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Team Member Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function assign_manager(pid,pm_id,first_name,last_name)
{
  var pid = pid;
  var pm_id = pm_id;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Assign "+ first_name +' '+last_name+" as Project Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/assign_manager',
              type: 'post',
              data: {pid: pid, pm_id: pm_id, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Assigned!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function assign_manager_replace(pid,pm_id,first_name,last_name,exist_manager)
{
  var pid = pid;
  var pm_id = pm_id;
  var first_name = first_name;
  var last_name = last_name;
  var exist_manager = exist_manager;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to replace "+ exist_manager +" with "+ first_name +' '+last_name+" as Project Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/assign_manager',
              type: 'post',
              data: {pid: pid, pm_id: pm_id, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Assigned!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function remove_manager(pid,pm_id,first_name,last_name)
{
  var pid = pid;
  var pm_id = pm_id;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Remove "+ first_name +' '+last_name+" as Project Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/remove_manager',
              type: 'post',
              data: {pid: pid, pm_id: pm_id, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function direct_remove_manager(pid,first_name,last_name)
{
  var pid = pid;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Remove "+ first_name +' '+last_name+" as Project Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/direct_remove_manager',
              type: 'post',
              data: {pid: pid, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function manager_selected() 
{
  //debugger;
  var m_id = $('#project_manager').val();
  $.ajax({
        url: base_url+'front/dont_display_mid_in_tm',
        method: 'POST',
        data: {m_id:m_id},  
        success: function(data) {
            $('#team_member').html(data);  
            //console.log(data);                
        }
    });
}

function manager_selected_goal_tm_list(gid) 
{
  //debugger;
  var gid = gid;
  var m_id = $('#project_manager').val();
  $.ajax({
        url: base_url+'front/dont_display_mid_in_goaltmlist',
        method: 'POST',
        data: {m_id:m_id, gid:gid},  
        success: function(data) {
            $('#team_member').html(data);  
            //console.log(data);                
        }
    });
}

function delete_iMember(pid,im_id,sent_to)
{
  var pid = pid;
  var im_id = im_id;
  var sent_to = sent_to;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Remove Invited Member : "+ sent_to,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_iMember',
              type: 'post',
              data: {pid: pid, im_id: im_id, sent_to: sent_to},
              success: function(data){ 
                Swal.fire("Invited Member Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function add_SuggestedPMember(pid,suggest_id,first_name,last_name)
{
  //debugger;
  var pid = pid;
  var suggest_id = suggest_id;
  var first_name = first_name;
  var last_name = last_name;
  var addButton = document.getElementById("add_SuggestedPMemberButton"+suggest_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Add "+ first_name +' '+last_name+" in Team",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/insert_SuggestedPMember',
              type: 'post',
              data: {pid: pid, suggest_id: suggest_id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Team Member Added!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });
}

function add_RequestedPMember(pid,member,first_name,last_name)
{
  //debugger;
  var pid = pid;
  var member = member;
  var first_name = first_name;
  var last_name = last_name;
  var addButton = document.getElementById("add_RequestedPMemberButton"+member);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Add "+ first_name +' '+last_name+" in Team",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/insert_RequestedPMember',
              type: 'post',
              data: {pid: pid, member: member},
              success: function(data){ 
                if(data.status == true){
                window.location.reload();
                }
              }
            });
          }
      });
}

function sentReq_to_RequestedPMember(pid,member,first_name,last_name)
{
  //debugger;
  var pid = pid;
  var member = member;
  var first_name = first_name;
  var last_name = last_name;
  var addButton = document.getElementById("add_RequestedPMemberButton"+member);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Add "+ first_name +' '+last_name+" in Team",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/sentReq_to_RequestedPMember',
              type: 'post',
              data: {pid: pid, member: member},
              success: function(data){ 
                if(data.status == true){
                window.location.reload();
                }
              }
            });
          }
      });
}

function project_accepted_edit_request(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Send Edit Request Mail To Owner!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/projects_accepted_edit',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Edit Request Sent!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });       
}


function add_Suggested_IPMember(pid,suggest_id,s_id)
{
  //debugger;
  var pid = pid;
  var suggest_id = suggest_id;
  var s_id = s_id;
  var addIButton = document.getElementById("add_Suggested_IPMemberButton"+s_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to send Invite Mail to "+ suggest_id,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addIButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/insert_Suggested_IPMember',
              type: 'post',
              data: {pid: pid, suggest_id: suggest_id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Team Member Invited!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });
}

function approve_edit_field(id,m_id,pid)
{
  //debugger;
  var id = id;
  var m_id = m_id;
  var pid = pid;
  var addAButton = document.getElementById("add_approve_edit_fieldButton"+id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Update Detail",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addAButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/update_approve_edit_field',
              type: 'post',
              data: {id: id, m_id: m_id, pid: pid},
              success: function(data){ 
                if(data.status == true){
                window.location.reload();
                }
              }
            });
          }
      });
}

function deny_edit_field(id,m_id,pid)
{
  //debugger;
  var id = id;
  var m_id = m_id;
  var pid = pid;
  var addDButton = document.getElementById("add_deny_edit_fieldButton"+id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny Edit Request",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addDButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/update_deny_edit_field',
              type: 'post',
              data: {id: id, m_id: m_id, pid: pid},
              success: function(data){ 
                if(data.status == true){
                window.location.reload();
                }
              }
            });
          }
      });
}


function tasks_delete(tid)
{
  var tid = tid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_task',
              type: 'post',
              data: {tid: tid,},
              success: function(data){ 
                Swal.fire("Moved to Tasks Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function archive_task(tid)
{
  var tid = tid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_task',
              type: 'post',
              data: {tid: tid,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });
}

function tasks_review_approve(tid)
{
  var tid = tid;
  var flag = '1';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Approve Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/tasks_review_status',
              type: 'post',
              data: {tid: tid,flag: flag},
              success: function(data){
                $('.task_review_status'+tid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>');
                // Display Modal
                $('#TaskReviewModal').modal('hide'); 
                //window.location.reload();
              }
            });
          }
      });
}

function tasks_review_deny(tid)
{
  var tid = tid;
  var flag = '2';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/tasks_review_status',
              type: 'post',
              data: {tid: tid,flag: flag},
              success: function(data){ 
                $('.task_review_status'+tid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>');
                // Display Modal
                $('#TaskReviewModal').modal('hide');
                //window.location.reload();
              }
            });
          }
      });
}

function subtasks_review_approve(stid)
{
  var stid = stid;
  var flag = '1';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Approve Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/subtasks_review_status',
              type: 'post',
              data: {stid: stid,flag: flag},
              success: function(data){ 
                $('.subtask_review_status'+stid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>');
                // Display Modal
                $('#SubtaskReviewModal').modal('hide'); 
                //window.location.reload();
              }
            });
          }
      });
}

function subtasks_review_deny(stid)
{
  var stid = stid;
  var flag = '2';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/subtasks_review_status',
              type: 'post',
              data: {stid: stid,flag: flag},
              success: function(data){ 
                $('.subtask_review_status'+stid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>');
                // Display Modal
                $('#SubtaskReviewModal').modal('hide');
                //window.location.reload();
              }
            });
          }
      });
}

function display_hlist(pid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var pid = pid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_history_date_wise',
                method: 'POST',
                data: {pid:pid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function display_pro_hlist(pid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var pid = pid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_pro_history_date_wise',
                method: 'POST',
                data: {pid:pid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function tasklist_status_change(tid,tstatus)
{
  var tid = tid;
  var tstatus = tstatus; 
  if(tstatus == 'done')
  {
    Swal.fire({
      title: "Do you want to Change Task Status to Incomplete?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
                url: base_url+'front/tasklist_status_change',
                method: 'POST',
                data: {tid:tid},  
                success: function(data) {
                  //debugger;
                    $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                    $('#to_do-task').load(document.URL + ' #to_do-task>*');
                    $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                    $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                    $('#done-task').load(document.URL + ' #done-task>*');       
                }
            });
          }
          else
          {
            $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
          }
      });
  }
  else
  {
  Swal.fire({
      title: "Do you want to Change Task Status to Complete?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
                url: base_url+'front/tasklist_status_change',
                method: 'POST',
                data: {tid:tid},  
                success: function(data) {
                  //debugger;
                    $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');  
                    $('#to_do-task').load(document.URL + ' #to_do-task>*'); 
                    $('#in_progress-task').load(document.URL + ' #in_progress-task>*');
                    $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                    $('#done-task').load(document.URL + ' #done-task>*');                                      
                }
            });
          }
          else
          {
            $('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
          }
      });
  } 
}

function task_retrieve(tid)
{
  //debugger;
  var tid = tid;
  var retrieve_link = document.getElementById('retrieve_link'+tid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_task',
              type: 'post',
              data: {tid: tid},
              success: function(data){ 
                window.location.reload(); 
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function task_del_forever(tid)
{
  //debugger;
  var tid = tid;
  var tdel_link = document.getElementById('tdel_link'+tid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Task Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            tdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/task_del_forever',
              type: 'post',
              data: {tid: tid},
              success: function(data){ 
                window.location.reload(); 
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function task_unarchived(tid)
{
  //debugger;
  var tid = tid;
  var unarchived_link = document.getElementById('unarchived_link'+tid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            unarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_task',
              type: 'post',
              data: {tid: tid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Reopened!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function project_retrieve(pid)
{
  //debugger;
  var pid = pid;
  var retrieve_link = document.getElementById('retrieve_link'+pid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Project",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_project',
              type: 'post',
              data: {pid: pid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function project_del_forever(pid)
{
  //debugger;
  var pid = pid;
  var pdel_link = document.getElementById('pdel_link'+pid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Project Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            pdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/project_del_forever',
              type: 'post',
              data: {pid: pid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function project_unarchived(pid)
{
  //debugger;
  var pid = pid;
  var unarchived_link = document.getElementById('unarchived_link'+pid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Project",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            unarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_project',
              type: 'post',
              data: {pid: pid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Reopened!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function pfile_retrieve(pfile_id)
{
  //debugger;
  var pfile_id = pfile_id;
  var retrieve_link = document.getElementById('retrieve_link'+pfile_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Project File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_pfile',
              type: 'post',
              data: {pfile_id: pfile_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Restored!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function pfile_del_forever(pfile_id)
{
  //debugger;
  var pfile_id = pfile_id;
  var pfdel_link = document.getElementById('pfdel_link'+pfile_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Project File Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            pfdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/pfile_del_forever',
              type: 'post',
              data: {pfile_id: pfile_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Deleted!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function project_filter()
{
  // debugger;
  var regular_project = document.getElementById('regular_project');
  var goal_project = document.getElementById('goal_project');
  var created_project = document.getElementById('created_project');
  var accepted_project = document.getElementById('accepted_project');
  var pending_project = document.getElementById('pending_project');
  var more_project = document.getElementById('more_project');
  var all_project = document.getElementById('all_project');

  var created_project_list = document.getElementById('created_project_list');
  var accepted_project_list = document.getElementById('accepted_project_list');
  var pending_project_list = document.getElementById('pending_project_list');
  var more_project_list = document.getElementById('more_project_list');

  var created_project_grid = document.getElementById('created_project_grid');
  var accepted_project_grid = document.getElementById('accepted_project_grid');
  var pending_project_grid = document.getElementById('pending_project_grid');
  var more_project_grid = document.getElementById('more_project_grid');

  $('.regular_proj').show();
  $('.goal_proj').show();

  created_project_list.style.display = "none";
  accepted_project_list.style.display = "none";
  pending_project_list.style.display = "none";
  more_project_list.style.display = "none";

  created_project_grid.style.display = "none";
  accepted_project_grid.style.display = "none";
  pending_project_grid.style.display = "none";
  more_project_grid.style.display = "none";

   if(created_project.checked == true)
   {
    created_project_list.style.display = "block";
    created_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    created_project_list.style.display = "none";
    created_project_grid.style.display = "none";
   }

   if(accepted_project.checked == true)
   {
    accepted_project_list.style.display = "block";
    accepted_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    accepted_project_list.style.display = "none";
    accepted_project_grid.style.display = "none";
   }

   if(pending_project.checked == true)
   {
    pending_project_list.style.display = "block";
    pending_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   } 
   else 
   {
    pending_project_list.style.display = "none";
    pending_project_grid.style.display = "none";
   }

   if(more_project.checked == true)
   {
    more_project_list.style.display = "block";
    more_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    more_project_list.style.display = "none";
    more_project_grid.style.display = "none";
   }

   if((created_project.checked == false) && (accepted_project.checked == false) && (pending_project.checked == false) && (more_project.checked == false) && (regular_project.checked == false) && (goal_project.checked == false))
   {
    all_project.checked = true;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";
   }

   if(regular_project.checked == true)
   {
    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";

    //$(".common_class").filter(function() {
          $(".regular_proj").show();
          $(".goal_proj").hide();
        //});
   }

   if(goal_project.checked == true)
   {
    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";

    //$(".common_class").filter(function() {
          $(".regular_proj").hide();
          $(".goal_proj").show();
       // });
   }
}

function all_project_filter()
{
  var created_project = document.getElementById('created_project');
  var accepted_project = document.getElementById('accepted_project');
  var pending_project = document.getElementById('pending_project');
  var more_project = document.getElementById('more_project');
  var all_project = document.getElementById('all_project');

  var created_project_list = document.getElementById('created_project_list');
  var accepted_project_list = document.getElementById('accepted_project_list');
  var pending_project_list = document.getElementById('pending_project_list');
  var more_project_list = document.getElementById('more_project_list');

  var created_project_grid = document.getElementById('created_project_grid');
  var accepted_project_grid = document.getElementById('accepted_project_grid');
  var pending_project_grid = document.getElementById('pending_project_grid');
  var more_project_grid = document.getElementById('more_project_grid');

  $('.regular_proj').show();
  $('.goal_proj').show();

    all_project.checked = true;
    created_project.checked = false;
    accepted_project.checked = false;
    pending_project.checked = false;
    more_project.checked = false;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";
}

function project_filter2()
{
  var regular_project = document.getElementById('regular_project2');
  var goal_project = document.getElementById('goal_project2');
  var created_project = document.getElementById('created_project2');
  var accepted_project = document.getElementById('accepted_project2');
  var pending_project = document.getElementById('pending_project2');
  var more_project = document.getElementById('more_project2');
  var all_project = document.getElementById('all_project2');

  var created_project_list = document.getElementById('created_project_list');
  var accepted_project_list = document.getElementById('accepted_project_list');
  var pending_project_list = document.getElementById('pending_project_list');
  var more_project_list = document.getElementById('more_project_list');

  var created_project_grid = document.getElementById('created_project_grid');
  var accepted_project_grid = document.getElementById('accepted_project_grid');
  var pending_project_grid = document.getElementById('pending_project_grid');
  var more_project_grid = document.getElementById('more_project_grid');

  $('.regular_proj').show();
  $('.goal_proj').show();

  created_project_list.style.display = "none";
  accepted_project_list.style.display = "none";
  pending_project_list.style.display = "none";
  more_project_list.style.display = "none";

  created_project_grid.style.display = "none";
  accepted_project_grid.style.display = "none";
  pending_project_grid.style.display = "none";
  more_project_grid.style.display = "none";

   if(created_project.checked == true)
   {
    created_project_list.style.display = "block";
    created_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    created_project_list.style.display = "none";
    created_project_grid.style.display = "none";
   }

   if(accepted_project.checked == true)
   {
    accepted_project_list.style.display = "block";
    accepted_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    accepted_project_list.style.display = "none";
    accepted_project_grid.style.display = "none";
   }

   if(pending_project.checked == true)
   {
    pending_project_list.style.display = "block";
    pending_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   } 
   else 
   {
    pending_project_list.style.display = "none";
    pending_project_grid.style.display = "none";
   }

   if(more_project.checked == true)
   {
    more_project_list.style.display = "block";
    more_project_grid.style.display = "block";
    all_project.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    more_project_list.style.display = "none";
    more_project_grid.style.display = "none";
   }

   if((created_project.checked == false) && (accepted_project.checked == false) && (pending_project.checked == false) && (more_project.checked == false) && (regular_project.checked == false) && (goal_project.checked == false))
   {
    all_project.checked = true;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";
   }

   if(regular_project.checked == true)
   {
    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";

    //$(".common_class").filter(function() {
          $(".regular_proj").show();
          $(".goal_proj").hide();
       // });
   }

   if(goal_project.checked == true)
   {
    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";

   // $(".common_class").filter(function() {
          $(".regular_proj").hide();
          $(".goal_proj").show();
       // });
   }
}

function all_project_filter2()
{
  var created_project = document.getElementById('created_project2');
  var accepted_project = document.getElementById('accepted_project2');
  var pending_project = document.getElementById('pending_project2');
  var more_project = document.getElementById('more_project2');
  var all_project = document.getElementById('all_project2');

  var created_project_list = document.getElementById('created_project_list');
  var accepted_project_list = document.getElementById('accepted_project_list');
  var pending_project_list = document.getElementById('pending_project_list');
  var more_project_list = document.getElementById('more_project_list');

  var created_project_grid = document.getElementById('created_project_grid');
  var accepted_project_grid = document.getElementById('accepted_project_grid');
  var pending_project_grid = document.getElementById('pending_project_grid');
  var more_project_grid = document.getElementById('more_project_grid');

  $('.regular_proj').show();
  $('.goal_proj').show();

    all_project.checked = true;
    created_project.checked = false;
    accepted_project.checked = false;
    pending_project.checked = false;
    more_project.checked = false;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_project_list.style.display = "block";
    accepted_project_list.style.display = "block";
    pending_project_list.style.display = "block";
    more_project_list.style.display = "block";

    created_project_grid.style.display = "block";
    accepted_project_grid.style.display = "block";
    pending_project_grid.style.display = "block";
    more_project_grid.style.display = "block";
}

function portfolio_project_filter()
{
  // debugger;
  var regular_project = document.getElementById('regular_port_project');
  var goal_project = document.getElementById('goal_port_project');
  var all_project = document.getElementById('all_port_project');
  
  if((regular_project.checked == false) && (goal_project.checked == false))
   {
      all_project.checked = true;
      $('#no_pending_req_img').hide();
      $('#hide_no_data').show();
      $('.regular_port_proj').show();
      $('.goal_port_proj').show();
   }

   if(regular_project.checked == true)
   {
      $(".regular_port_proj").show();
      $(".goal_port_proj").hide();
   }

   if(goal_project.checked == true)
   {
        $(".regular_port_proj").hide();
        $(".goal_port_proj").show();
   }
}

function all_portfolio_project_filter()
{
  var all_project = document.getElementById('all_port_project');

  $('.regular_port_proj').show();
  $('.goal_port_proj').show();

    all_project.checked = true;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
}

function portfolio_project_filter2()
{
  // debugger;
  var regular_project = document.getElementById('regular_port_project2');
  var goal_project = document.getElementById('goal_port_project2');
  var all_project = document.getElementById('all_port_project2');
  
  if((regular_project.checked == false) && (goal_project.checked == false))
   {
      all_project.checked = true;
      $('#no_pending_req_img').hide();
      $('#hide_no_data').show();
      $('.regular_port_proj').show();
      $('.goal_port_proj').show();
   }

   if(regular_project.checked == true)
   {
      $(".regular_port_proj").show();
      $(".goal_port_proj").hide();
   }

   if(goal_project.checked == true)
   {
        $(".regular_port_proj").hide();
        $(".goal_port_proj").show();
   }
}

function all_portfolio_project_filter2()
{
  var all_project = document.getElementById('all_port_project2');

  $('.regular_port_proj').show();
  $('.goal_port_proj').show();

    all_project.checked = true;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
}

function portfolio_filter()
{
  //debugger;
  var company_portfolio = document.getElementById('company_portfolio');
  var individual_portfolio = document.getElementById('individual_portfolio');
  var not_assigned_portfolio = document.getElementById('not_assigned_portfolio');
  var all_portfolio = document.getElementById('all_portfolio');

  var company = document.getElementsByClassName('company');
  var individual = document.getElementsByClassName('individual');
  var user_not = document.getElementsByClassName('user_not');

  for(var i=0; i<company.length; i++)
  {
    company[i].style.display = "none";
  }
  for(var j=0; j<individual.length; j++)
  {    
    individual[j].style.display = "none";
  }
  for(var k=0; k<user_not.length; k++)
  {    
    user_not[k].style.display = "none";
  }

  if(company_portfolio.checked == true)
   {
    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "none";
    }
   }

   if(individual_portfolio.checked == true)
   {
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "none";
    }
   }

   if(not_assigned_portfolio.checked == true)
   {
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "none";
    }
   }

   if((company_portfolio.checked == false) && (individual_portfolio.checked == false) && (not_assigned_portfolio.checked == false))
   {
    all_portfolio.checked = true;

    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
   }
}

function all_portfolio_filter()
{
  var company_portfolio = document.getElementById('company_portfolio');
  var individual_portfolio = document.getElementById('individual_portfolio');
  var not_assigned_portfolio = document.getElementById('not_assigned_portfolio');
  var all_portfolio = document.getElementById('all_portfolio');

  var company = document.getElementsByClassName('company');
  var individual = document.getElementsByClassName('individual');
  var user_not = document.getElementsByClassName('user_not');
    all_portfolio.checked = true;
    company_portfolio.checked = false;
    individual_portfolio.checked = false;
    not_assigned_portfolio.checked = false;

    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
}

function portfolio_filter2()
{
  //debugger;
  var company_portfolio = document.getElementById('company_portfolio2');
  var individual_portfolio = document.getElementById('individual_portfolio2');
  var not_assigned_portfolio = document.getElementById('not_assigned_portfolio2');
  var all_portfolio = document.getElementById('all_portfolio2');

  var company = document.getElementsByClassName('company');
  var individual = document.getElementsByClassName('individual');
  var user_not = document.getElementsByClassName('user_not');

  for(var i=0; i<company.length; i++)
  {
    company[i].style.display = "none";
  }
  for(var j=0; j<individual.length; j++)
  {    
    individual[j].style.display = "none";
  }
  for(var k=0; k<user_not.length; k++)
  {    
    user_not[k].style.display = "none";
  }

  if(company_portfolio.checked == true)
   {
    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "none";
    }
   }

   if(individual_portfolio.checked == true)
   {
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "none";
    }
   }

   if(not_assigned_portfolio.checked == true)
   {
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
    all_portfolio.checked = false;
   } 
   else 
   {
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "none";
    }
   }

   if((company_portfolio.checked == false) && (individual_portfolio.checked == false) && (not_assigned_portfolio.checked == false))
   {
    all_portfolio.checked = true;

    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
   }
}

function all_portfolio_filter2()
{
  var company_portfolio = document.getElementById('company_portfolio2');
  var individual_portfolio = document.getElementById('individual_portfolio2');
  var not_assigned_portfolio = document.getElementById('not_assigned_portfolio2');
  var all_portfolio = document.getElementById('all_portfolio2');

  var company = document.getElementsByClassName('company');
  var individual = document.getElementsByClassName('individual');
  var user_not = document.getElementsByClassName('user_not');
    all_portfolio.checked = true;
    company_portfolio.checked = false;
    individual_portfolio.checked = false;
    not_assigned_portfolio.checked = false;

    for(var i=0; i<company.length; i++)
    {
      company[i].style.display = "block";
    }
    for(var j=0; j<individual.length; j++)
    {    
      individual[j].style.display = "block";
    }
    for(var k=0; k<user_not.length; k++)
    {    
      user_not[k].style.display = "block";
    }
}

function trash_filter()
{
  var goal_trash = document.getElementById('goal_trash');
  var strategy_trash = document.getElementById('strategy_trash');
  var project_trash = document.getElementById('project_trash');
  var task_trash = document.getElementById('task_trash');
  var file_trash = document.getElementById('file_trash');
  var platform_trash = document.getElementById('platform_trash');
  var all_trash = document.getElementById('all_trash');

  var all_trash_list = document.getElementById('all_trash_list');
  var goal_trash_list = document.getElementById('goal_trash_list');
  var strategy_trash_list = document.getElementById('strategy_trash_list');
  var project_trash_list = document.getElementById('project_trash_list');
  var task_trash_list = document.getElementById('task_trash_list');
  var file_trash_list = document.getElementById('file_trash_list');
  var platform_trash_list = document.getElementById('platform_trash_list');

    all_trash_list.style.display = "none";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";

   if(goal_trash.checked == true)
   {
    goal_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    goal_trash_list.style.display = "none";
   }

   if(strategy_trash.checked == true)
   {
    strategy_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    strategy_trash_list.style.display = "none";
   }

   if(project_trash.checked == true)
   {
    project_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    project_trash_list.style.display = "none";
   }

   if(task_trash.checked == true)
   {
    task_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    task_trash_list.style.display = "none";
   }

   if(file_trash.checked == true)
   {
    file_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    file_trash_list.style.display = "none";
   }

   if(platform_trash.checked == true)
   {
    platform_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    platform_trash_list.style.display = "none";
   }

   if((goal_trash.checked == false) && (strategy_trash.checked == false) && (project_trash.checked == false) && (task_trash.checked == false) && (file_trash.checked == false) && (platform_trash.checked == false))
   {
    all_trash.checked = true;

    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
}

function all_trash_filter()
{
  var goal_trash = document.getElementById('goal_trash');
  var strategy_trash = document.getElementById('strategy_trash');
  var project_trash = document.getElementById('project_trash');
  var task_trash = document.getElementById('task_trash');
  var file_trash = document.getElementById('file_trash');
  var platform_trash = document.getElementById('platform_trash');
  var all_trash = document.getElementById('all_trash');

  var all_trash_list = document.getElementById('all_trash_list');
  var goal_trash_list = document.getElementById('goal_trash_list');
  var strategy_trash_list = document.getElementById('strategy_trash_list');
  var project_trash_list = document.getElementById('project_trash_list');
  var task_trash_list = document.getElementById('task_trash_list');
  var file_trash_list = document.getElementById('file_trash_list');
  var platform_trash_list = document.getElementById('platform_trash_list');

  if((goal_trash.checked == true) || (strategy_trash.checked == true) || (project_trash.checked == true) || (task_trash.checked == true) || (file_trash.checked == true) || (platform_trash.checked == true))
   {
    all_trash.checked = true;
    goal_trash.checked = false;
    strategy_trash.checked = false;
    project_trash.checked = false;
    task_trash.checked = false;
    file_trash.checked = false;
    platform_trash.checked = false;

    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
   else
   {
    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
}

function trash_filter2()
{
  var goal_trash = document.getElementById('goal_trash2');
  var strategy_trash = document.getElementById('strategy_trash2');
  var project_trash = document.getElementById('project_trash2');
  var task_trash = document.getElementById('task_trash2');
  var file_trash = document.getElementById('file_trash2');
  var platform_trash = document.getElementById('platform_trash2');
  var all_trash = document.getElementById('all_trash2');

  var all_trash_list = document.getElementById('all_trash_list');
  var goal_trash_list = document.getElementById('goal_trash_list');
  var strategy_trash_list = document.getElementById('strategy_trash_list');
  var project_trash_list = document.getElementById('project_trash_list');
  var task_trash_list = document.getElementById('task_trash_list');
  var file_trash_list = document.getElementById('file_trash_list');
  var platform_trash_list = document.getElementById('platform_trash_list');

    all_trash_list.style.display = "none";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";

   if(goal_trash.checked == true)
   {
    goal_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    goal_trash_list.style.display = "none";
   }

   if(strategy_trash.checked == true)
   {
    strategy_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    strategy_trash_list.style.display = "none";
   }

   if(project_trash.checked == true)
   {
    project_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    project_trash_list.style.display = "none";
   }

   if(task_trash.checked == true)
   {
    task_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    task_trash_list.style.display = "none";
   }

   if(file_trash.checked == true)
   {
    file_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    file_trash_list.style.display = "none";
   }

   if(platform_trash.checked == true)
   {
    platform_trash_list.style.display = "block";
    all_trash.checked = false;
   } 
   else 
   {
    platform_trash_list.style.display = "none";
   }

   if((goal_trash.checked == false) && (strategy_trash.checked == false) && (project_trash.checked == false) && (task_trash.checked == false) && (file_trash.checked == false) && (platform_trash.checked == false))
   {
    all_trash.checked = true;

    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
}

function all_trash_filter2()
{
  var goal_trash = document.getElementById('goal_trash2');
  var strategy_trash = document.getElementById('strategy_trash2');
  var project_trash = document.getElementById('project_trash2');
  var task_trash = document.getElementById('task_trash2');
  var file_trash = document.getElementById('file_trash2');
  var platform_trash = document.getElementById('platform_trash2');
  var all_trash = document.getElementById('all_trash2');

  var all_trash_list = document.getElementById('all_trash_list');
  var goal_trash_list = document.getElementById('goal_trash_list');
  var strategy_trash_list = document.getElementById('strategy_trash_list');
  var project_trash_list = document.getElementById('project_trash_list');
  var task_trash_list = document.getElementById('task_trash_list');
  var file_trash_list = document.getElementById('file_trash_list');
  var platform_trash_list = document.getElementById('platform_trash_list');

  if((goal_trash.checked == true) || (strategy_trash.checked == true) || (project_trash.checked == true) || (task_trash.checked == true) || (file_trash.checked == true) || (platform_trash.checked == true))
   {
    all_trash.checked = true;
    goal_trash.checked = false;
    strategy_trash.checked = false;
    project_trash.checked = false;
    task_trash.checked = false;
    file_trash.checked = false;
    platform_trash.checked = false;

    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
   else
   {
    all_trash_list.style.display = "block";
    goal_trash_list.style.display = "none";
    strategy_trash_list.style.display = "none";
    project_trash_list.style.display = "none";
    task_trash_list.style.display = "none";
    file_trash_list.style.display = "none";
    platform_trash_list.style.display = "none";
   }
}

function archive_filter()
{
  //debugger;
  var goal_archive = document.getElementById('goal_archive');
  var strategy_archive = document.getElementById('strategy_archive');
  var project_archive = document.getElementById('project_archive');
  var task_archive = document.getElementById('task_archive');
  var platform_archive = document.getElementById('platform_archive');
  //var file_trash = document.getElementById('file_trash');
  var all_trash = document.getElementById('all_archive');

  var all_archive_list = document.getElementById('all_archive_list');
  var goal_archive_list = document.getElementById('goal_archive_list');
  var strategy_archive_list = document.getElementById('strategy_archive_list');
  var project_archive_list = document.getElementById('project_archive_list');
  var task_archive_list = document.getElementById('task_archive_list');
  var platform_archive_list = document.getElementById('platform_archive_list');
  //var file_trash_list = document.getElementById('file_trash_list');

    all_archive_list.style.display = "none";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";

   if(goal_archive.checked == true)
   {
    goal_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    goal_archive_list.style.display = "none";
   }

   if(strategy_archive.checked == true)
   {
    strategy_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    strategy_archive_list.style.display = "none";
   }

   if(project_archive.checked == true)
   {
    project_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    project_archive_list.style.display = "none";
   }

   if(task_archive.checked == true)
   {
    task_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    task_archive_list.style.display = "none";
   }

   if(platform_archive.checked == true)
   {
    platform_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    platform_archive_list.style.display = "none";
   }

   // if(file_trash.checked == true)
   // {
   //  file_trash_list.style.display = "block";
   //  all_trash.checked = false;
   // } 
   // else 
   // {
   //  file_trash_list.style.display = "none";
   // }

   if((goal_archive.checked == false) && (strategy_archive.checked == false) && (project_archive.checked == false) && (task_archive.checked == false) && (platform_archive.checked == false))
   {
    all_archive.checked = true;

    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
}

function all_archive_filter()
{
  var goal_archive = document.getElementById('goal_archive');
  var strategy_archive = document.getElementById('strategy_archive');
  var project_archive = document.getElementById('project_archive');
  var task_archive = document.getElementById('task_archive');
  var platform_archive = document.getElementById('platform_archive');
  //var file_trash = document.getElementById('file_trash');
  var all_archive = document.getElementById('all_archive');

  var all_archive_list = document.getElementById('all_archive_list');
  var goal_archive_list = document.getElementById('goal_archive_list');
  var strategy_archive_list = document.getElementById('strategy_archive_list');
  var project_archive_list = document.getElementById('project_archive_list');
  var task_archive_list = document.getElementById('task_archive_list');
  var platform_archive_list = document.getElementById('platform_archive_list');
  //var file_trash_list = document.getElementById('file_trash_list');

  if((goal_archive.checked == true) || (strategy_archive.checked == true) || (project_archive.checked == true) || (task_archive.checked == true) || (platform_archive.checked == true))
   {
    all_archive.checked = true;
    goal_archive.checked = false;
    strategy_archive.checked = false;
    project_archive.checked = false;
    task_archive.checked = false;
    platform_archive.checked = false;
    //file_trash.checked = false;

    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
   else
   {
    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
}

function archive_filter2()
{
  //debugger;
  var goal_archive = document.getElementById('goal_archive2');
  var strategy_archive = document.getElementById('strategy_archive2');
  var project_archive = document.getElementById('project_archive2');
  var task_archive = document.getElementById('task_archive2');
  var platform_archive = document.getElementById('platform_archive2');
  //var file_trash = document.getElementById('file_trash');
  var all_trash = document.getElementById('all_archive2');

  var all_archive_list = document.getElementById('all_archive_list');
  var goal_archive_list = document.getElementById('goal_archive_list');
  var strategy_archive_list = document.getElementById('strategy_archive_list');
  var project_archive_list = document.getElementById('project_archive_list');
  var task_archive_list = document.getElementById('task_archive_list');
  var platform_archive_list = document.getElementById('platform_archive_list');
  //var file_trash_list = document.getElementById('file_trash_list');

    all_archive_list.style.display = "none";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";

   if(goal_archive.checked == true)
   {
    goal_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    goal_archive_list.style.display = "none";
   }

   if(strategy_archive.checked == true)
   {
    strategy_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    strategy_archive_list.style.display = "none";
   }

   if(project_archive.checked == true)
   {
    project_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    project_archive_list.style.display = "none";
   }

   if(task_archive.checked == true)
   {
    task_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    task_archive_list.style.display = "none";
   }

   if(platform_archive.checked == true)
   {
    platform_archive_list.style.display = "block";
    all_archive.checked = false;
   } 
   else 
   {
    platform_archive_list.style.display = "none";
   }

   // if(file_trash.checked == true)
   // {
   //  file_trash_list.style.display = "block";
   //  all_trash.checked = false;
   // } 
   // else 
   // {
   //  file_trash_list.style.display = "none";
   // }

   if((goal_archive.checked == false) && (strategy_archive.checked == false) && (project_archive.checked == false) && (task_archive.checked == false) && (platform_archive.checked == false))
   {
    all_archive.checked = true;

    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
}

function all_archive_filter2()
{
  var goal_archive = document.getElementById('goal_archive2');
  var strategy_archive = document.getElementById('strategy_archive2');
  var project_archive = document.getElementById('project_archive2');
  var task_archive = document.getElementById('task_archive2');
  var platform_archive = document.getElementById('platform_archive2');
  //var file_trash = document.getElementById('file_trash');
  var all_archive = document.getElementById('all_archive2');

  var all_archive_list = document.getElementById('all_archive_list');
  var goal_archive_list = document.getElementById('goal_archive_list');
  var strategy_archive_list = document.getElementById('strategy_archive_list');
  var project_archive_list = document.getElementById('project_archive_list');
  var task_archive_list = document.getElementById('task_archive_list');
  var platform_archive_list = document.getElementById('platform_archive_list');
  //var file_trash_list = document.getElementById('file_trash_list');

  if((goal_archive.checked == true) || (strategy_archive.checked == true) || (project_archive.checked == true) || (task_archive.checked == true) || (platform_archive.checked == true))
   {
    all_archive.checked = true;
    goal_archive.checked = false;
    strategy_archive.checked = false;
    project_archive.checked = false;
    task_archive.checked = false;
    platform_archive.checked = false;
    //file_trash.checked = false;

    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
   else
   {
    all_archive_list.style.display = "block";
    goal_archive_list.style.display = "none";
    strategy_archive_list.style.display = "none";
    project_archive_list.style.display = "none";
    task_archive_list.style.display = "none";
    platform_archive_list.style.display = "none";
    //file_trash_list.style.display = "none";
   }
}

//preview modal for attached file
  function previewModalFullscreen(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/preview_file',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#previewModalFullscreen_content').html(data);
              // Display Modal
              $('#previewModalFullscreen').modal('show'); 
            }
          });
         }

//preview overview modal
  function ProjectOverviewModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectOverview_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectOverviewModal_content').html(data);
              // Display Modal
              $('#ProjectOverviewModal').modal('show'); 
            }
          });
         }

//preview overview accepted modal
  function ProjectOverviewAcceptedModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectOverviewAccepted_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectOverviewAcceptedModal_content').html(data);
              // Display Modal
              $('#ProjectOverviewAcceptedModal').modal('show'); 
            }
          });
         }

//preview overview request modal
  function ProjectOverviewRequestModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectOverviewRequest_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectOverviewRequestModal_content').html(data);
              // Display Modal
              $('#ProjectOverviewRequestModal').modal('show'); 
            }
          });
         }

//task overview modal
  function TaskOverviewModal(id){   
           var id = id; 
           // AJAX request  
           $.ajax({ 
            url:  base_url+'front/TaskOverview_Modal',  
            type: 'post', 
            data: {id: id}, 
            success: function(data){  
              // Add response in Modal body 
              $('#TaskOverviewModal_content').html(data); 
              // Display Modal  
              $('#TaskOverviewModal').modal('show');  
                $.ajax({  
                  url: base_url+'front/get_flag', 
                  type: 'POST',   
                  data: {id: id}, 
                  success: function(data){  
            var data = JSON.parse(data);            
                   if (data.flag == '1')  
                   {  
                    toggleTimer2(id); 
                      isRunning = true; 
                      $('#timer_started_popup_'+id).val('1'); 
                   }  
                  } 
                }); 
            } 
          }); 
  }

//task review modal
  function TaskReviewModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/TaskReview_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#TaskReviewModal_content').html(data);
              // Display Modal
              $('#TaskReviewModal').modal('show'); 
            }
          });
         }

//subtask review modal
  function SubtaskReviewModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/SubtaskReview_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#SubtaskReviewModal_content').html(data);
              // Display Modal
              $('#SubtaskReviewModal').modal('show'); 
            }
          });
         }

//Request as team member 
function RequestAsMember(pid,reg_id)
{
  //debugger;
  var pid = pid;
  var reg_id = reg_id;
  var request_id = document.getElementById('request_id'+pid);
  Swal.fire({
      title: "Send Request for Add as Team Member to Project Owner?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            request_id.style.display = "none";
             $.ajax({
              url:  base_url+'front/request_as_member',
              type: 'post',
              data: {pid: pid, reg_id: reg_id},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });
}

function RequestAsGoalMember()
{
  Swal.fire("Cannot view project!", "Not added in Goal Team!", "warning");
}

//delete portfolio modal
  function DeletePortfolioModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/DeletePortfolioModal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#DeletePortfolioModal_content').html(data);
              // Display Modal
              $('#DeletePortfolioModal').modal('show'); 
            }
          });
         }

//trash portfolio
function DeletePortfolio(port_id)
{
  var agree = document.getElementById("delete_portfolio_agree"+port_id).checked;
  if(agree == true)
  {
    $.ajax({
              url:  base_url+'front/DeletePortfolio',
              type: 'post',
              data: {port_id: port_id,},
              success: function(data){ 
                Swal.fire("Moved to Tasks Trash!", "Successfully.", "success");
                //window.location.reload();
                window.location = base_url+'portfolio';
              }
            });
  }
  else
  {
    $('#delete_portfolio_agreeERR'+port_id).html('Please Check to Agree Condition!');
  }
}

//archive portfolio
function ArchivePortfolio(port_id)
{
  var port_id = port_id;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive Portfolio",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/ArchivePortfolio',
              type: 'post',
              data: {port_id: port_id,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location = base_url+'portfolio';
                  //window.location = base_url+'portfolio';
                }
              }
            });
          }
      });
}

function portfolio_retrieve(port_id)
{
  //debugger;
  var port_id = port_id;
  var retrieve_link = document.getElementById('retrieve_link'+port_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Portfolio",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_portfolio',
              type: 'post',
              data: {port_id: port_id},
              success: function(data){ 
                //Swal.fire("Restored!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function portfolio_unarchived(port_id)
{
  //debugger;
  var port_id = port_id;
  var unarchived_link = document.getElementById('unarchived_link'+port_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Portfolio",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            unarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_portfolio',
              type: 'post',
              data: {port_id: port_id},
              success: function(data){ 
                //Swal.fire("Reopened!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

//view portfolio members
function PortfolioViewMembers(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/portfolio_view_members',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#PortfolioViewMembersModal_content').html(data);
              // Display Modal
              $('#PortfolioViewMembersModal').modal('show'); 
            }
          });
}

//view portfolio all departments
function PortfolioViewAllDepartments(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/portfolio_view_all_departments',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#PortfolioViewAllDepartmentsModal_content').html(data);
              // Display Modal
              $('#PortfolioViewAllDepartmentsModal').modal('show'); 
            }
          });
}

function editable_field_pd()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("input").focus();
}

function edit_yes_pd()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  var txt = target.find("input").val();
  if(txt != " ") 
  {
    $('.edit_yes_but_pd'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_table_pdept',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
            success: function(data){
              if(data.status == false)
                {
                  $('.edit_yes_but_pd'+div_id).show();                  
                  target.find(".req_dfield").html('Field is required!').css('display','block');    
                }
                else if(data.status == true)
                {
                  $('.edit_yes_but_pd'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_dfield").css('display','none');
                  $('.dname_'+div_id).html(data.new_pdname);
                } 
            }
          });
  }
  else
  {
    $('.edit_yes_but_pd'+div_id).show();
    target.find(".req_dfield").css('display','block');
  }
}

function dont_edit_pd()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text();
  if(org_val != "") 
  {
    target.find("input").val(org_val);
    target.toggleClass("editable");
    target.find(".req_dfield").css('display','none');
  }
  else
  {
    target.find(".req_dfield").css('display','block');
  }
}

function Inactive_PortfolioDepartment(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive Department?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/change_portfolio_department_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                  // Swal.fire("Inactive!", "Successfully.", "success");
                  // window.location.reload();
                    $('#success_dstatus'+id).attr("onclick","Active_PortfolioDepartment("+id+")");
                    $('#success_dstatus'+id).removeClass('btn-d');
                    $('#success_dstatus'+id).addClass('bg-d text-white');
                    $('#success_dstatus'+id).html('Inactive');
                    $('.dname_'+id).html('');
                  // $('#new_open_work_assignee').val('');
                  // $('#PortfolioViewMembersModal').modal('show');              
              }
            });
          }
      });       
}

function Active_PortfolioDepartment(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active Department?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/change_portfolio_department_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                //debugger;
                    $('#success_dstatus'+id).attr("onclick","Inactive_PortfolioDepartment("+id+")");
                    $('#success_dstatus'+id).removeClass('bg-d text-white');
                    $('#success_dstatus'+id).addClass('btn-d');
                    $('#success_dstatus'+id).html('Active');
                    $('.dname_'+id).html(data.pdep_name);
                // Swal.fire("Active!", "Successfully.", "success");
                // window.location.reload();
              }
            });
          }
      });       
}

function Inactive_PortfolioMember(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive Member?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/change_portfolio_member_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                if(data.status == true)
                {
                  // Swal.fire("Inactive!", "Successfully.", "success");
                  // window.location.reload();
                    $('#success_status'+data.pim_id).attr("onclick","Active_PortfolioMember("+data.pim_id+")");
                    $('#success_status'+data.pim_id).removeClass('btn-d');
                    $('#success_status'+data.pim_id).addClass('bg-d text-white');
                    $('#success_status'+data.pim_id).html('Inactive');
                  // $('#new_open_work_assignee').val('');
                  // $('#PortfolioViewMembersModal').modal('show'); 
                }
                else
                {
                  $('#OpenWorkModal_content').html(data);
                  // Display Modal
                  $('#OpenWorkModal').modal('show'); 
                }                
              }
            });
          }
      });       
}

function Active_PortfolioMember(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active Member?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/change_portfolio_member_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                //debugger;
                    $('#success_status'+data.pim_id).attr("onclick","Inactive_PortfolioMember("+data.pim_id+")");
                    $('#success_status'+data.pim_id).removeClass('bg-d text-white');
                    $('#success_status'+data.pim_id).addClass('btn-d');
                    $('#success_status'+data.pim_id).html('Active');
                // Swal.fire("Active!", "Successfully.", "success");
                // window.location.reload();
              }
            });
          }
      });       
}

//task edit modal
  function TaskEditModal(id){ 
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/TaskEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#TaskEditModal_content').html(data);
              // Display Modal
              $('#TaskEditModal').modal('show'); 
            }
          });
          setTimeout(function() {

          var timeInput_new = document.getElementById('estimated_time');
          var suggestionContainer_new = document.getElementById('suggestionContainer');
            if (timeInput_new) {
              timeInput_new.addEventListener('input', () => {
                var enteredTime_new = timeInput_new.value;
                var suggestions_new = generateTimeSuggestions(enteredTime_new);
                suggestionContainer_new.innerHTML = '';
                suggestions_new.forEach((suggestion_new) => {
                  var suggestionOption_new = document.createElement('div');
                  suggestionOption_new.textContent = suggestion_new;
                  suggestionOption_new.addEventListener('click', () => {
                    timeInput_new.value = suggestion_new;
                    suggestionContainer_new.innerHTML = '';
                    timeInput_new.focus();
                  });
                  suggestionContainer_new.appendChild(suggestionOption_new);
                });
              });
            }  
          }, 2000);
         }

//profile modal
  function ProfileModal(){           
           // AJAX request
           $.ajax({
            url:  base_url+'front/Profile_Modal',
            type: 'post',
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProfileModal_content').html(data);
              // Display Modal
              $('#ProfileModal').modal('show'); 
            }
          });
         }

//team profile modal
  function TeamProfileModal(tid){
           var tid = tid;           
           // AJAX request
           $.ajax({
            url:  base_url+'front/team_view_profile',
            type: 'post',
            data: {tid: tid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#TeamProfileModal_content').html(data);
              // Display Modal
              $('#TeamProfileModal').modal('show'); 
            }
          });
         }

//task overview notification modal
  function TaskOverviewNotificationModal(id){             
    var id = id;  
    // AJAX request 
    $.ajax({  
     url:  base_url+'front/TaskOverview_Modal', 
     type: 'post',  
     data: {id: id},  
     success: function(data){   
       // Add response in Modal body  
       //console.log(data); 
       $('#TaskOverviewNotificationModal_content').html(data);  
       // Display Modal 
       $('#TaskOverviewNotificationModal').modal('show');   
       $.ajax({ 
         url: base_url+'front/get_flag',  
         type: 'POST',  
         data: {id: id},  
         success: function(data){ 
   var data = JSON.parse(data);           
          if (data.flag == '1') 
          {   
           toggleTimer2(id);  
             isRunning = true;  
             $('#timer_started_popup_'+id).val('1');  
          } 
         }  
       });  
     }  
   });  
  }

//preview overview request notification modal
  function ProjectOverviewRequestNotificationModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectOverviewRequest_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectOverviewRequestNotificationModal_content').html(data);
              // Display Modal
              $('#ProjectOverviewRequestNotificationModal').modal('show'); 
            }
          });
         }

//preview overview file notification modal
  function ProjectOverviewFileNotificationModal(id,pfile_id){           
           var id = id;
           var pfile_id = pfile_id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectOverviewFile_Modal',
            type: 'post',
            data: {id: id,pfile_id: pfile_id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectOverviewFileNotificationModal_content').html(data);
              // Display Modal
              $('#ProjectOverviewFileNotificationModal').modal('show'); 
            }
          });
         }

//preview overview file notification modal
  function TaskFileNotificationModal(tid){           
           var tid = tid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/TaskFileNotification_Modal',
            type: 'post',
            data: {tid: tid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#TaskFileNotificationModal_content').html(data);
              // Display Modal
              $('#TaskFileNotificationModal').modal('show'); 
            }
          });
         }

//preview sub overview file notification modal
  function SubtaskFileNotificationModal(stid){           
           var stid = stid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/SubtaskFileNotification_Modal',
            type: 'post',
            data: {stid: stid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#SubtaskFileNotificationModal_content').html(data);
              // Display Modal
              $('#SubtaskFileNotificationModal').modal('show'); 
            }
          });
         }

//preview modal for task attached file
  function PreviewTaskFile(tfile_name,tid){           
           var tfile_name = tfile_name;
           var tid = tid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/preview_task_file',
            type: 'post',
            data: {tfile_name: tfile_name, tid: tid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#PreviewTaskFile_Content').html(data);
              // Display Modal
              $('#previewTaskModal').modal('show'); 
            }
          });
         }

function delete_tfile(tfile_name,tid)
{   
  var tfile_name = tfile_name;
  var tid = tid;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_tfile',
              type: 'post',
              data: {tfile_name: tfile_name, tid: tid},
              success: function(data){ 
                Swal.fire("Moved to Tasks Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function tfile_retrieve(tid,tfile,trash_id)
{
  //debugger;
  var tid = tid;
  var tfile = tfile;
  var trash_id = trash_id;
  var retrieve_link = document.getElementById('retrieve_link'+trash_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Task File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_tfile',
              type: 'post',
              data: {tid: tid, tfile: tfile, trash_id: trash_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Restored!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function tfile_del_forever(tid,trash_id)
{
  //debugger;
  var tid = tid;
  var trash_id = trash_id;
  var tfdel_link = document.getElementById('tfdel_link'+trash_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Task File Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            tfdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/tfile_del_forever',
              type: 'post',
              data: {tid: tid, trash_id: trash_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Deleted!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function get_subtask_pid(y)//sub task create
{
  //debugger;
    var z = parseInt(y) + 1;
    var tproject_assign= $("#tproject_assign").val(); 
            $.ajax({
                url: base_url+'front/select_project_tm',
                method: 'POST',
                data: {pid:tproject_assign},  
                success: function(data) {
                  $( '.team_member21'+z ).select2({
                    /* Sort data using localeCompare- task assignee alphabetical order  */
                    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
                  });
                    $('.team_member21'+z).html(data);                  
                }
            });
}

function get_subtask_pid_task_edit(y)//sub task create
{
  //debugger;
    var z = parseInt(y) + 1;
    var tproject_assign= $("#tproject_assign2").val(); 
            $.ajax({
                url: base_url+'front/select_project_tm',
                method: 'POST',
                data: {pid:tproject_assign},  
                success: function(data) {
                  console.log(z);
                  $( '.team_member21'+z ).select2({
                    /* Sort data using localeCompare- task assignee alphabetical order  */
                    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
                  });
                    $('.team_member21'+z).html(data);                  
                }
            });
}

function st_duedate(y)
{
//debugger;
var end_dd = document.getElementById('tdue_date').value;
var gstart_dd = document.getElementById('get_gstart_date').value;
var gend_dd = document.getElementById('get_gend_date').value;
  if(gstart_dd != "")
  {
    $('#tdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(end_dd)});
  }
  else
  {
    $('#tdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  }
console.log(gstart_dd);
}

function st_duedate2(y)
{
//debugger;
var end_dd = document.getElementById('pub_tdue_date_id').value;
var gstart_dd = document.getElementById('get_gstart_date').value;
var gend_dd = document.getElementById('get_gend_date').value;
if(gstart_dd != "")
  {
    $('#tdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(end_dd)});
  }
  else
  {
    $('#tdue_date'+y).datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  }
//console.log(gstart_dd);
}

function pub_tdue_date()
{
//debugger;
var end_dd = document.getElementById('get_pub_date').value;
var gstart_dd = document.getElementById('get_gstart_date').value;
var gend_dd = document.getElementById('get_gend_date').value;
$('#pub_tdue_date_id').datepicker("destroy");
  if(end_dd != "")
  {
  $('#pub_tdue_date_id').datepicker({todayHighlight: true,startDate: new Date(),endDate: new Date(end_dd)});
  }
  else if(gend_dd != "")
  {
  $('#pub_tdue_date_id').datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(gend_dd)});
  }
  else
  {
  $('#pub_tdue_date_id').datepicker({todayHighlight: true,startDate: new Date()});
  }
//console.log(end_dd);
}

function goal_content_publish_date()
{
var gstart_dd = document.getElementById('get_gstart_date').value;
var gend_dd = document.getElementById('get_gend_date').value;
  $('#p_publish').datepicker({todayHighlight: true,startDate: new Date(gstart_dd),endDate: new Date(gend_dd)});
}

//subtask edit modal
function SubtaskEditModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/SubtaskEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#SubtaskEditModal_content').html(data);
              // Display Modal
              $('#SubtaskEditModal').modal('show'); 
            }
          });


          setTimeout(function() {

            var timeInput_snew = document.getElementById('estimated_stime1');
            var suggestionContainer_snew = document.getElementById('suggestionSContainer');
              if (timeInput_snew) {
                timeInput_snew.addEventListener('input', () => {
                  var enteredTime_snew = timeInput_snew.value;
                  var suggestions_snew = generateTimeSuggestions(enteredTime_snew);
                  suggestionContainer_snew.innerHTML = '';
                  suggestions_snew.forEach((suggestion_snew) => {
                    var suggestionOption_new = document.createElement('div');
                    suggestionOption_new.textContent = suggestion_snew;
                    suggestionOption_new.addEventListener('click', () => {
                      timeInput_snew.value = suggestion_snew;
                      suggestionContainer_snew.innerHTML = '';
                      timeInput_snew.focus();
                    });
                    suggestionContainer_snew.appendChild(suggestionOption_new);
                  });
                });
              }  
            }, 2000);

}

//subtask overview modal
function SubtaskOverviewModal(id){            
      var id = id;  
      // AJAX request 
      $.ajax({  
       url:  base_url+'front/SubtaskOverview_Modal',  
       type: 'post',  
       data: {id: id},  
       success: function(data){   
         console.log(data); 
         // Add response in Modal body  
         //console.log(data); 
         $('#SubtaskOverviewModal_content').html(data); 
         // Display Modal 
         $('#SubtaskOverviewModal').modal('show');  
         $.ajax({ 
           url: base_url+'front/get_sflag', 
           type: 'POST',  
           data: {id: id},  
           success: function(data){ 
           var data = JSON.parse(data);           
            if (data.sflag == '1')  
            {   
             SubtaskTimer5(id); 
               isRunning_subtask = true;  
               $('#stimer_started_popup_'+id).val('1'); 
            } 
           }  
         });  
       }  
     });  
  }

//preview modal for subtask attached file
  function PreviewSubtaskFile(stfile_name,stid){  
  //debugger;         
           var stfile_name = stfile_name;
           var stid = stid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/preview_subtask_file',
            type: 'post',
            data: {stfile_name: stfile_name, stid: stid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#previewSubtaskModal_content').html(data);
              // Display Modal
              $('#previewSubtaskModal').modal('show'); 
            }
          });
         }

function delete_subtaskfile(stfile_name,stid)
{  
//debugger; 
  var stfile_name = stfile_name;
  var stid = stid;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_stfile',
              type: 'post',
              data: {stfile_name: stfile_name, stid: stid},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function stfile_retrieve(stid,stfile,strash_id)
{
  //debugger;
  var stid = stid;
  var stfile = stfile;
  var strash_id = strash_id;
  var retrieve_link = document.getElementById('retrieve_link'+strash_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Subtask File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_stfile',
              type: 'post',
              data: {stid: stid, stfile: stfile, strash_id: strash_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Restored!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function stfile_del_forever(stid,strash_id)
{
  //debugger;
  var stid = stid;
  var strash_id = strash_id;
  var stfdel_link = document.getElementById('stfdel_link'+strash_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Subtask File Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            stfdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/stfile_del_forever',
              type: 'post',
              data: {stid: stid, strash_id: strash_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Deleted!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function subtasklist_status_change(stid,ststatus,tid)
{
  var stid = stid;
  var ststatus = ststatus; 
  var tid = tid;
  if(ststatus == 'done')
  {
    Swal.fire({
      title: "Do you want to Change Subtask Status to Incomplete?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
                url: base_url+'front/subtasklist_status_change',
                method: 'POST',
                data: {stid:stid},  
                success: function(data) {
                  //debugger;
                    $('#collapseExample'+tid).load(document.URL + ' #collapseExample'+tid+'>*');
                    //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
                    $('#to_do-task').load(document.URL + ' #to_do-task>*');
                    $('#in_progress-task').load(document.URL + ' #in_progress-task>*'); 
                    $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                    $('#done-task').load(document.URL + ' #done-task>*');       
                }
            });
          }
          else
          {
             $('#collapseExample'+tid).load(document.URL + ' #collapseExample'+tid+'>*');
            //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
          }
      });
  }
  else
  {
  Swal.fire({
      title: "Do you want to Change Subtask Status to Complete?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
                url: base_url+'front/subtasklist_status_change',
                method: 'POST',
                data: {stid:stid},  
                success: function(data) {
                  //debugger;
                    $('#collapseExample'+tid).load(document.URL + ' #collapseExample'+tid+'>*');
                    //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');  
                    $('#to_do-task').load(document.URL + ' #to_do-task>*'); 
                    $('#in_progress-task').load(document.URL + ' #in_progress-task>*');
                    $('#in_review-task').load(document.URL + ' #in_review-task>*'); 
                    $('#done-task').load(document.URL + ' #done-task>*');                                      
                }
            });
          }
          else
          {
             $('#collapseExample'+tid).load(document.URL + ' #collapseExample'+tid+'>*');
            //$('#refresh_tasklist_status_change').load(document.URL + ' #refresh_tasklist_status_change>*');
          }
      });
  } 
}

//subtask overview notification modal
  function SubtaskOverviewNotificationModal(id){            
    var id = id;  
    // AJAX request 
    $.ajax({  
     url:  base_url+'front/SubtaskOverview_Modal',  
     type: 'post',  
     data: {id: id},  
     success: function(data){   
       // Add response in Modal body  
       //console.log(data); 
       $('#SubtaskOverviewNotificationModal_content').html(data); 
       // Display Modal 
       $('#SubtaskOverviewNotificationModal').modal('show');  
       $.ajax({ 
         url: base_url+'front/get_sflag', 
         type: 'POST',  
         data: {id: id},  
         success: function(data){ 
         var data = JSON.parse(data);           
          if (data.sflag == '1')  
          {   
           // alert();  
           SubtaskTimer5(id); 
             isRunning_subtask = true;  
             $('#stimer_started_popup_'+id).val('1'); 
          } 
         }  
       });  
     }  
   });  
  }

function subtasks_delete(stid)
{
  var stid = stid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_subtask',
              type: 'post',
              data: {stid: stid,},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function archive_subtask(stid)
{
  var stid = stid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_subtask',
              type: 'post',
              data: {stid: stid,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });
}

function subtask_retrieve(stid)
{
  //debugger;
  var stid = stid;
  var retrieve_link = document.getElementById('sretrieve_link'+stid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_subtask',
              type: 'post',
              data: {stid: stid},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Restored!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function subtask_del_forever(stid)
{
  //debugger;
  var stid = stid;
  var sdel_link = document.getElementById('sdel_link'+stid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Subtask Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            sdel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/subtask_del_forever',
              type: 'post',
              data: {stid: stid},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Deleted!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function subtask_unarchived(stid)
{
  //debugger;
  var stid = stid;
  var sunarchived_link = document.getElementById('sunarchived_link'+stid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            sunarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_subtask',
              type: 'post',
              data: {stid: stid},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Reopened!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

//Display notification bar until click outside
$(document).mouseup(function(e) 
{
  //debugger;
    var notifybox = $("#fix_notification_box");
    // if the target of the click isn't the container nor a descendant of the container
    if (!notifybox.is(e.target) && notifybox.has(e.target).length === 0) 
    {
        notifybox.removeClass("show");
    }
    var fieldsetbox = $('fieldset');
    // if the target of the click isn't the container nor a descendant of the container
    if (!fieldsetbox.is(e.target) && fieldsetbox.has(e.target).length === 0) 
    {
      //debugger;
        $('fieldset').removeClass("editable");
    }
    var task_comment = $("#task_commentModal");
    // if the target of the click isn't the container nor a descendant of the container
    if (task_comment.is(e.target)) 
    {
        $('#task_commentModal').css('display','none');
    }
    var subtask_comment = $("#subtask_commentModal");
    // if the target of the click isn't the container nor a descendant of the container
    if (subtask_comment.is(e.target)) 
    {
        $('#subtask_commentModal').css('display','none');
    }
    var filter_box = $(".filtercollapse");
    // if the target of the click isn't the container nor a descendant of the container
    if (filter_box.is(e.target)) 
    {
        $('.filtercollapse').css('display','none');
    }    
});

//Clear Notification Functions
function TaskNotificationClearYes(id){ 
//debugger;          
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/TaskNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
           // debugger;
          $('#tncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function SubtaskNotificationClearYes(id){ 
//debugger;           
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/SubtaskNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $("#fix_notification_box").addClass("show"); 
          $('#stncy'+id).remove();
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show"); 
          }
        });
       }

function ProjectFileNotificationClearYes(id){  
//debugger;         
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/ProjectFileNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#pfncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt); 
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function TaskFileNotificationClearYes(id){  
//debugger;          
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/TaskFileNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#tfncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function SubtaskFileNotificationClearYes(id){  
//debugger;          
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/SubtaskFileNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#stfncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function TaskReviewNotificationClearYes(id){  
//debugger;         
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/TaskReviewNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#trncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function SubtaskReviewNotificationClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/SubtaskReviewNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#strncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function PendingRequestNotificationClearYes(id){ 
//debugger;           
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/PendingRequestNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#pqncy'+id).remove();
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt); 
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function OverdueTaskNotificationClearYes(id){    
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/OverdueTaskNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#otncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function OverdueSubtaskNotificationClearYes(id){    
//debugger;        
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/OverdueSubtaskNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#ostncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function ProjectCommentNotificationClearYes(id){  
//debugger;         
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/ProjectCommentNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
            //debugger;
          $('.pconcy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt); 
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function AllNotificationClearYes(){    
debugger;       
    Swal.fire({
          title: "Are you sure?",
          text: "You want to Clear All Notification",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#c7df19",
          cancelButtonColor: "#383838",
          confirmButtonText: "Yes"
          }).then(function (result) {
              if (result.value) {
                // AJAX request
                 $.ajax({
                  url:  base_url+'front/AllNotificationClearYes',
                  type: 'post',
                  success: function(data){
                    //debugger; 
                    Swal.fire("Cleared!", "Successfully.", "success");
                    window.location.reload();
                  }
                });
              }
          });          
       }
       
//preview overview content planned notification modal
  function PlannedContentNotificationModal(pid){           
           var pid = pid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/PlannedContentNotification_Modal',
            type: 'post',
            data: {pid: pid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#PlannedContentNotificationModal_content').html(data);
              // Display Modal
              $('#PlannedContentNotificationModal').modal('show'); 
            }
          });
         }

function PlannedContentNotificationClearYes(id){  
//debugger;         
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/PlannedContentNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#pcncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt); 
          $("#fix_notification_box").addClass("show");
          }
        });
       }

//duplicate project
function duplicate_project(id)
{   
   var id = id; 
   // AJAX request
   $.ajax({
    url:  base_url+'front/duplicate_project_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#duplicate_projectModal_content').html(data);
      // Display Modal
      $('#duplicate_projectModal').modal('show'); 
    }
  });       
}

//duplicate task
function duplicate_task(id)
{   
  var id = id; 
   // AJAX request
   $.ajax({
    url:  base_url+'front/duplicate_task_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#duplicate_taskModal_content').html(data);
      // Display Modal
      $('#duplicate_taskModal').modal('show'); 
    }
  });       
}

//duplicate subtask
function duplicate_subtask(id)
{   
   var id = id; 
   // AJAX request
   $.ajax({
    url:  base_url+'front/duplicate_subtask_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#duplicate_subtaskModal_content').html(data);
      // Display Modal
      $('#duplicate_subtaskModal').modal('show'); 
    }
  });     
}

function TaskArriveReviewNotificationClearYes(id){  
//debugger;         
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/TaskArriveReviewNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#tarncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function SubtaskArriveReviewNotificationClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/SubtaskArriveReviewNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#starncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function PortfolioAcceptedReqClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/PortfolioAcceptedReqClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#cpancy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

//preview Portfolio Request Accepted Notification Modal
  function PortfolioAcceptedReqNotificationModal(pim_id,port_id){           
           var pim_id = pim_id;
           var port_id = port_id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/PortfolioAcceptedReqNotification_Modal',
            type: 'post',
            data: {pim_id: pim_id,port_id: port_id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#PortfolioAcceptedReqNotificationModal_content').html(data);
              // Display Modal
              $('#PortfolioAcceptedReqNotificationModal').modal('show'); 
            }
          });
         }

function ProjectAcceptedReqClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/ProjectAcceptedReqClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#cprancy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

//preview Project Request Accepted Notification Modal
  function ProjectAcceptedReqNotificationModal(pm_id,pid){           
           var pm_id = pm_id;
           var pid = pid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectAcceptedReqNotificationModal_Modal',
            type: 'post',
            data: {pm_id: pm_id,pid: pid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectAcceptedReqNotificationModal_content').html(data);
              // Display Modal
              $('#ProjectAcceptedReqNotificationModal').modal('show'); 
            }
          });
         }

function ProjectAcceptedInviteReqClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/ProjectAcceptedInviteReqClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#cpirancy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

//preview Project Invite Request Accepted Notification Modal
  function ProjectAcceptedInviteReqNotificationModal(im_id,pid){           
           var im_id = im_id;
           var pid = pid;
           // AJAX request
           $.ajax({
            url:  base_url+'front/ProjectAcceptedInviteReqNotificationModal_Modal',
            type: 'post',
            data: {im_id: im_id,pid: pid},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ProjectAcceptedInviteReqNotificationModal_content').html(data);
              // Display Modal
              $('#ProjectAcceptedInviteReqNotificationModal').modal('show'); 
            }
          });
         }

function delete_comment(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Comment",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_comment',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                $('#msg_id'+id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Me</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');

                // $('#comment_form').trigger('reset');
                // $('.chat-conversation').load(document.URL + ' .chat-conversation>*');
                // $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
              }
            });
          }
      });       
}

// function delete_comment2(id)
// {   
//   var id = id; 
//     Swal.fire({
//       title: "Are you sure?",
//       text: "You want to Delete Comment",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#c7df19",
//       cancelButtonColor: "#383838",
//       confirmButtonText: "Yes"
//       }).then(function (result) {
//           if (result.value) {
//             // AJAX request
//              $.ajax({
//               url:  base_url+'front/delete_comment',
//               type: 'post',
//               data: {id: id},
//               success: function(data){ 
//                 $('#msg_id'+id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Me</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');
//               }
//             });
//           }
//       });       
// }

//task attachment modal
  function TaskAttachment(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/task_attachmentModal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#task_attachmentModal_content').html(data);
              // Display Modal
              $('#task_attachmentModal').modal('show'); 
            }
          });
         }

//task comment modal
  function TaskCommentModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/task_commentmodal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#task_commentmodal_content').html(data);
              // Display Modal
              $('#task_commentModal').css('display','block');
            }
          });
         }

//subtask attachment modal
  function SubtaskAttachment(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/subtask_attachmentModal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#subtask_attachmentModal_content').html(data);
              // Display Modal
              $('#subtask_attachmentModal').modal('show'); 
            }
          });
         }

//subtask comment modal
  function SubtaskCommentModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/subtask_commentmodal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#subtask_commentmodal_content').html(data);
              // Display Modal
              $('#subtask_commentModal').css('display','block'); 
            }
          });
         }

//select portfolio to set cookie
function select_Portfolio(id){
  var id = id;
  // AJAX request
   $.ajax({
    url:  base_url+'front/select_Portfolio_to_work',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //window.location.reload();
      window.location = base_url+'portfolio-view';
    }
  });
}

function content_request_send_by_tm(id)
{   
  var id = id; 
    Swal.fire({
      title: "Not Allowed to View Content!",
      text: "Send Request for Add as Team Member to Project Owner",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/content_request_send_by_tm_to_owner',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Request Sent!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });       
}

function get_project_id3() {
  //debugger;
   var selected = [];
  for (var option of document.getElementById('pc_project_assign').options) {
    if (option.selected) {
      selected.push(option.value);
     //console.log(selected.push(option.value));
    }
  }
 var project_id= selected; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
  document.getElementById("pid").value = selected;
}

function get_project_id4(pid) {
 var project_id= pid; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
  document.getElementById("pid").value = project_id;
}

function get_project_id5(pid) {
  event.preventDefault();
  var project_id= pid; 
  document.getElementById("pid").value = project_id;
  var tproject_assign= project_id; 
  $.ajax({
      url: base_url+'front/select_project_assignees',
      method: 'POST',
      data: {pid:tproject_assign},  
      success: function(data) {
          $('.plan-content-wrapper').find('#written_content_assignee1').html(data.assignees);
          $('.plan-content-wrapper').find('#pc_file_assignee1').html(data.assignees);
          $('.plan-content-wrapper').find('#submit_to_approval1').html(data.assignees);
          $('.plan-content-wrapper').find('#pc_assignee1').html(data.none_assignee);
          //console.log(data);                   
      }
  });
  var pid = tproject_assign;
    $.ajax({
      url:  base_url+'front/edit_all_content_planner',
      type: 'post',
      data: {pid: pid},
      success: function(data){
        if(data != ""){
          $('#create_content_form').trigger('reset'); 
          $('.select-project').modal('hide'); 
          $('.plan-content-wrapper').find('.edit-all-content').remove();
          $('.plan-content-wrapper').prepend(data); 

          var last_id = $('#planner_last_id').val();
          var last_id = parseInt(last_id)-1;
          var prev_wca = $('#written_content_assignee'+last_id).val();      
          var prev_pfa = $('#pc_file_assignee'+last_id).val();      
          var prev_sta = $('#submit_to_approval'+last_id).val();      
          var prev_pa = $('#pc_assignee'+last_id).val(); 
               
          $('.plan-content-wrapper').find('#written_content_assignee1').val(prev_wca).trigger('change');
          $('.plan-content-wrapper').find('#pc_file_assignee1').val(prev_pfa).trigger('change');   
          $('.plan-content-wrapper').find('#submit_to_approval1').val(prev_sta).trigger('change');    
          $('.plan-content-wrapper').find('#pc_assignee1').val(prev_pa).trigger('change'); 

          $('.add-new-content').modal('show'); 

        }else{
          $('#create_content_form').trigger('reset'); 
          $('.select-project').modal('hide');    
          $('.plan-content-wrapper').find('.edit-all-content').remove();
          $('.add-new-content').modal('show'); 
        }         
      }
    }); 
}

function get_project_id6() {
  //debugger;
   var selected = [];
  for (var option of document.getElementById('pc_project_assign').options) {
    if (option.selected) {
      selected.push(option.value);
     //console.log(selected.push(option.value));
    }
  }
  var project_id= selected; 
  document.getElementById("pid").value = selected;
}

function get_project_id4(pid) {
 var project_id= pid; 
            $.ajax({
                url: base_url+'front/get_project_portfolio',
                method: 'POST',
                data: {project_id:project_id},  
                success: function(data) {
                    $('#portfolio_name').val(data);                  
                }
            });
  document.getElementById("pid").value = project_id;
}

function get_portfolio_projects(port_id) {
  event.preventDefault();
  $.ajax({
      url: base_url+'front/get_portfolio_projects',
      method: 'POST',
      data: {port_id:port_id},  
      success: function(data) {
          $('#pc_project_assign').html(data);
          //console.log(data);                   
      }
  });
}

  // SHOW NEW CONTENT FORM ----------------------------------------
  function show_platform_modal(page,platform,pc_id) {
    // debugger;
    event.preventDefault(); // Stop page from refreshing
    $.ajax({
      url: base_url+'front/get_platform_data',
      method: 'POST',
      data: {platform:platform, pc_id:pc_id},  
      success: function(data) {
        console.log(data.privilege_only_view); 
        if(page == 'planner'){
          if(data.privilege_only_view == 'no')
          {
          var editbutton = '<a class="btn btn-sm btn-d text-white me-1" href="javascript:void(0)" onclick="return CPEditModal('+pc_id+')"><i class="mdi mdi-file-edit"></i> Edit</a><a class="btn btn-sm btn-d text-white" href="'+base_url+'front/download_ContentALLFileAttachment/'+pc_id+'"><i class="mdi mdi-download"></i> Download Media/Files</a>'; 
          }
          else 
          {
            if(data.privilege == 'yes')
            {
              var editbutton = '<a class="btn btn-sm btn-d text-white me-1" href="javascript:void(0)" onclick="return CPEditModal('+pc_id+')"><i class="mdi mdi-file-edit"></i> Edit</a><a class="btn btn-sm btn-d text-white" href="'+base_url+'front/download_ContentALLFileAttachment/'+pc_id+'"><i class="mdi mdi-download"></i> Download Media/Files</a>'; 
            }
            else
            {
              var editbutton = '';
            }            
          } 
        }else{
          if(data.privilege_only_view == 'no')
          {
          var editbutton = '<a class="btn btn-sm btn-d text-white" href="'+base_url+'front/download_ContentALLFileAttachment/'+pc_id+'"><i class="mdi mdi-download"></i> Download Media/Files</a>'; 
          }
          else 
          {
            if(data.privilege == 'yes')
            {
              var editbutton = '<a class="btn btn-sm btn-d text-white" href="'+base_url+'front/download_ContentALLFileAttachment/'+pc_id+'"><i class="mdi mdi-download"></i> Download Media/Files</a>'; 
            }
            else
            {
              var editbutton = '';
            }  
          }
        }
        $('.preview-platform').find('.platform-card').css('display','none');
        if(platform == 'twitter'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-twitter social-d"></i> '+editbutton);  
          $('.preview-platform').find('.twitter-card').css('display','block');  
          $('.preview-platform').find('.twitter-content').html(data.content);  
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.twitter-images-ol').append('<li data-bs-target="#carouselTwitterIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.twitter-images-ol').append('<li data-bs-target="#carouselTwitterIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.twitter-images').html(data.images);  
        }else if(platform == 'facebook'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-facebook social-d"></i> '+editbutton);  
          $('.preview-platform').find('.facebook-card').css('display','block');  
          $('.preview-platform').find('.facebook-content').html(data.content);  
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.facebook-images-ol').append('<li data-bs-target="#carouselFBIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.facebook-images-ol').append('<li data-bs-target="#carouselFBIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.facebook-images').html(data.images);  
        }else if(platform == 'instagram'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-instagram social-d"></i> '+editbutton);  
          $('.preview-platform').find('.instagram-card').css('display','block');  
          $('.preview-platform').find('.instagram-content').html(data.content);  
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.instagram-images-ol').append('<li data-bs-target="#carouselInstaIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.instagram-images-ol').append('<li data-bs-target="#carouselInstaIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.instagram-images').html(data.images);  
        }else if(platform == 'linkedin'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-linkedin social-d"></i> '+editbutton);  
          $('.preview-platform').find('.linkedin-card').css('display','block');  
          $('.preview-platform').find('.linkedin-content').html(data.content);
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.linkedin-images-ol').append('<li data-bs-target="#carouselLIIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.linkedin-images-ol').append('<li data-bs-target="#carouselLIIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }  
          $('.preview-platform').find('.linkedin-images').html(data.images);  
        }else if(platform == 'google-my-business'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="mdi mdi-google-my-business social-d"></i> '+editbutton);  
          $('.preview-platform').find('.google-my-business-card').css('display','block');  
          $('.preview-platform').find('.google-my-business-content').html(data.content);
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.google-my-business-images-ol').append('<li data-bs-target="#carouselGMBIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.google-my-business-images-ol').append('<li data-bs-target="#carouselGMBIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.google-my-business-images').html(data.images);  
        }else if(platform == 'pinterest'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-pinterest social-d"></i> '+editbutton);  
          $('.preview-platform').find('.pinterest-card').css('display','block');  
          $('.preview-platform').find('.pinterest-title').html(data.title);  
          $('.preview-platform').find('.pinterest-content-1').html(data.content1);  
          $('.preview-platform').find('.pinterest-content-2').html(data.content2);  
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.pinterest-images-ol').append('<li data-bs-target="#carouselPinterestIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.pinterest-images-ol').append('<li data-bs-target="#carouselPinterestIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.pinterest-images').html(data.images);  
        }else if(platform == 'youtube'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-youtube social-d"></i> '+editbutton);  
          $('.preview-platform').find('.youtube-card').css('display','block');
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.youtube-images-ol').append('<li data-bs-target="#carouselYTIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.youtube-images-ol').append('<li data-bs-target="#carouselYTIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.youtube-images').html(data.images);    
          $('.preview-platform').find('.youtube-pc_title').html(data.title);  
          $('.preview-platform').find('.youtube-content').html(data.content);
        }else if(platform == 'blogger'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-blogger social-d"></i> '+editbutton);  
          $('.preview-platform').find('.blogger-card').css('display','block');
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.blogger-images-ol').append('<li data-bs-target="#carouselBlogIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.blogger-images-ol').append('<li data-bs-target="#carouselBlogIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.blogger-images').html(data.images);    
          $('.preview-platform').find('.blogger-title').html(data.title);  
          $('.preview-platform').find('.blogger-content').html(data.content);
        }else if(platform == 'tiktok'){
          $('.preview-platform').modal('show');
          $('.preview-platform').find('.modal-title').html('<i class="fab fa-tiktok social-d"></i> '+editbutton);  
          $('.preview-platform').find('.tiktok-card').css('display','block');  
          $('.preview-platform').find('.tiktok-content').html(data.content);
          for(var i = 0; i < data.file_count; i++)
          {
            if(i==1){
              $('.preview-platform').find('.tiktok-images-ol').append('<li data-bs-target="#carouselTiktokIndicators" data-bs-slide-to="'+i+'" class="active"></li>');
            }else{
              $('.preview-platform').find('.tiktok-images-ol').append('<li data-bs-target="#carouselTiktokIndicators" data-bs-slide-to="'+i+'"></li>');
            }                    
          }
          $('.preview-platform').find('.tiktok-images').html(data.images);  
        }                  
      }
  });  
  }

  //Content planner edit modal
function CPEditModal(pc_id){          
          var pc_id = pc_id;
          // AJAX request
          $.ajax({
           url:  base_url+'front/edit_content_planner',
           type: 'post',
           data: {pc_id: pc_id},
           success: function(data){
             // Add response in Modal body
             //console.log(data);
             $('#EditCPModalLabel_content').html(data);
             // Display Modal
             $('#EditCPModalLabel').modal('show');
           }
         });
}

function delete_pc_file(index_id,pc_id)
{  
 var index_id = index_id;
 var pc_id = pc_id;
   Swal.fire({
     title: "Are you sure?",
     text: "You want to Delete File",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#c7df19",
     cancelButtonColor: "#383838",
     confirmButtonText: "Yes"
     }).then(function (result) {
         if (result.value) {
           // AJAX request
            $.ajax({
             url:  base_url+'front/delete_pc_file',
             type: 'post',
             data: {index_id: index_id, pc_id: pc_id},
             success: function(data){
               //debugger;
               console.log(data);
               Swal.fire("Deleted!", "Successfully.", "success");
               $('.refresh_remove_cdelfiles').html(data);
               $('.preview-platform').modal('hide');               
               //$("#field_id"+index_id).remove();
               // $('#EditCPModalLabel').modal('hide');
               //$('.refresh_pcf_remove').load(document.URL + ' .refresh_pcf_remove>*');
               // window.location.reload();
               //$(".refresh_pcf_remove").load(location.href + " .refresh_pcf_remove");
             }
           });
         }
     });      
}

function delete_pro_pc_file(index_id,pc_id)
{   
  var index_id = index_id;
  var pc_id = pc_id;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_pro_pc_file',
              type: 'post',
              data: {index_id: index_id, pc_id: pc_id},
              success: function(data){ 
                //debugger;
                Swal.fire("Deleted!", "Successfully.", "success"); 
                $('#plannedcontent'+pc_id+'-collapseOne').load(document.URL + ' #plannedcontent'+pc_id+'-collapseOne>*');
                }
            });
          }
      });       
}

function delete_platform(pc_id)
{
  var pc_id = pc_id;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Content",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_platform',
              type: 'post',
              data: {pc_id: pc_id},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function platform_retrieve(pc_id)
{
  //debugger;
  var pc_id = pc_id;
  var cpretrieve_link = document.getElementById('cpretrieve_link'+pc_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Content",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            cpretrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_platform',
              type: 'post',
              data: {pc_id: pc_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Restored!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function platform_del_forever(pc_id)
{
  //debugger;
  var pc_id = pc_id;
  var pldel_link = document.getElementById('pldel_link'+pc_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Content Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            pldel_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/platform_del_forever',
              type: 'post',
              data: {pc_id: pc_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Deleted!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function archive_platform(pc_id)
{
  var pc_id = pc_id;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive Content",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_platform',
              type: 'post',
              data: {pc_id: pc_id,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function platform_unarchived(pc_id)
{
  //debugger;
  var pc_id = pc_id;
  var cpunarchived_link = document.getElementById('cpunarchived_link'+pc_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Content",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            cpunarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_platform',
              type: 'post',
              data: {pc_id: pc_id},
              success: function(data){ 
                if(data.status == false)
                {
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Reopened!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

//preview modal for content planner attached file
  function PreviewContentFile(pc_file,pc_id){           
           var pc_file = pc_file;
           var pc_id = pc_id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/preview_content_file',
            type: 'post',
            data: {pc_file: pc_file, pc_id: pc_id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#previewContentModal_Content').html(data);
              // Display Modal
              $('#previewContentModal').modal('show'); 
            }
          });
         }

//preview modal for content planner attached document
  function PreviewContentDocFile(doc_pc_file,pc_id){           
           var doc_pc_file = doc_pc_file;
           var pc_id = pc_id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/preview_content_doc',
            type: 'post',
            data: {doc_pc_file: doc_pc_file, pc_id: pc_id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#previewContentDocModal_Content').html(data);
              // Display Modal
              $('#previewContentDocModal').modal('show'); 
            }
          });
         }

function delete_pro_pc_doc_file(index_id,pc_id)
{   
  var index_id = index_id;
  var pc_id = pc_id;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete File",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_pc_doc_file',
              type: 'post',
              data: {index_id: index_id, pc_id: pc_id},
              success: function(data){ 
                //debugger;
                Swal.fire("Deleted!", "Successfully.", "success"); 
                $('#plannedcontent'+pc_id+'-collapseOne').load(document.URL + ' #plannedcontent'+pc_id+'-collapseOne>*');
                }
            });
          }
      });       
}

function delete_pc_doc_file(index_id,pc_id)
{  
 var index_id = index_id;
 var pc_id = pc_id;
   Swal.fire({
     title: "Are you sure?",
     text: "You want to Delete File",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#c7df19",
     cancelButtonColor: "#383838",
     confirmButtonText: "Yes"
     }).then(function (result) {
         if (result.value) {
           // AJAX request
            $.ajax({
             url:  base_url+'front/delete_pc_doc_file',
             type: 'post',
             data: {index_id: index_id, pc_id: pc_id},
             success: function(data){
               //debugger;
               Swal.fire("Deleted!", "Successfully.", "success");
               $("#field_id"+index_id).remove();
               $('.preview-platform').modal('hide');
               $('#EditCPModalLabel').modal('hide');
               $('.add-new-content').modal('hide');
             }
           });
         }
     });      
}

function choose_duplicate_option(val)
{
  var opt = val;
  if(opt == 'all')
  {
    $('.selected_dup_option').val('everything');
  }
  else if(opt == 'cus')
  {
    $('.selected_dup_option').val('custom');
  }
  else
  {
    $('.selected_dup_option').val('everything');
  }
}

//preview Project Membership Request Notification Modal
function MembershipReqNotificationModal(req_id,pid){           
         var req_id = req_id;
         var pid = pid;
         // AJAX request
         $.ajax({
          url:  base_url+'front/MembershipReqNotificationModal_Modal',
          type: 'post',
          data: {req_id: req_id,pid: pid},
          success: function(data){ 
            // Add response in Modal body
            //console.log(data);
            $('#MembershipReqNotificationModal_content').html(data);
            // Display Modal
            $('#MembershipReqNotificationModal').modal('show'); 
          }
        });
       }

//preview Meeting Member Request Notification Modal
function MeetingMemberNotificationModal(uid){           
         var uid = uid;
         // AJAX request
         $.ajax({
          url:  base_url+'front/MeetingMemberNotificationModal_Modal',
          type: 'post',
          data: {uid: uid},
          success: function(data){ 
            // Add response in Modal body
            //console.log(data);
            $('#MeetingMemberNotificationModal_content').html(data);
            // Display Modal
            $('#MeetingMemberNotificationModal').modal('show'); 
          }
        });
       }

function MembershipReqClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/ProjectMembershipReqClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#cprmncy'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function MeetingMemberReqClearYes(uid){     
//debugger;       
         var uid = uid;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/MeetingMemberReqClearYes',
          type: 'post',
          data: {uid: uid},
          success: function(data){
          $('#minac'+uid).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function sub_cancel_reason_seen()
{
  $.ajax({
          url:  base_url+'front/sub_cancel_reason_notify_seen',
          type: 'post',
          success: function(data){
          $('#sub_cancel_reason_div').hide();
          }
        });
}

function show_FilterOptions()
{
  if($('.filtercollapse').css('display','block'))
  {
    $('.filtercollapse').css('display','none');
  }
  if($('.filtercollapse').css('display','none'))
  {
    $('.filtercollapse').css('display','block');
  }
}

//////Calendar Part Start///////
function editModalDragEvent(drag_id)
{
  $.ajax({
    url: base_url+'front/get_drag_event_data',
    type: 'POST',
    data: {drag_id: drag_id},
    success: function(data){
      //console.log(data)
      //debugger;
      $("#edit-new-drag").modal('show');
      $("#edit-new-drag").find("input[name=event_name]").val(data.event_name);
      $("#edit-new-drag").find("input[name='event_color']").val(data.event_color);
      $("#edit-new-drag").find("#selected_color_drag_update").addClass(data.event_color);
      $("#edit-new-drag").find("#selected_color_drag_update_text").html('');      
      $("#edit-new-drag").find("textarea[name=event_note]").val(data.event_note);
      $("#edit-new-drag").find("input[name=event_start_end_date_drag_update]").val(data.event_start_date);
      if(data.allDay == 'false'){
          $("#edit-new-drag").find("#event_start_time_ud").val(moment(data.event_start_time, "HH:mm").format('hh:mm A'));
          $("#edit-new-drag").find("select[name=event_start_time]").select2().trigger('change');
          $("#edit-new-drag").find("#event_end_time_ud").val(moment(data.event_end_time, "HH:mm").format('hh:mm A'));
          $("#edit-new-drag").find("select[name=event_end_time]").select2().trigger('change');
          $("#edit-new-drag").find("input[name=event_allDay_drag_update]").prop('checked', false);
          $("#edit-new-drag").find("select[name='event_reminder']").val(data.event_reminder);
          $("#date-time-section-drag-update").show();
          $("#edit-new-drag").find("#checkbox_value_get_drag_update").val('true');
          $('#old_reminder_drag_update').show();
          $('#new_reminder_drag_update').hide();
      }else{
        $('#old_reminder_drag_update').hide();
        $('#new_reminder_drag_update').show();
        $("#edit-new-drag").find("select[name='event_reminder_new']").val(data.event_reminder);
        $("#edit-new-drag").find("input[name=event_allDay_drag_update]").prop('checked', true);
        $("#edit-new-drag").find("#checkbox_value_get_drag_update").val('false');
        $("#date-time-section-drag-update").hide();
      }
      // $("#edit-drag-event").find("select[name='event_repeat_option']").val(data.event_repeat_option);
      $("#edit-new-drag").find("input[name=drag_id]").val(data.drag_id);

    }
  });
}

function removeDragEvent(drag_id)
{
  Swal.fire({
     title: "Are you sure?",
     text: "You want to Delete Draggable Event",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#c7df19",
     cancelButtonColor: "#383838",
     confirmButtonText: "Yes"
     }).then(function (result) {
         if (result.value) {
           // AJAX request
            $.ajax({
             url:  base_url+'front/delete_draggable_event',
             type: 'post',
             data: {drag_id: drag_id},
             success: function(data){
               //debugger;
               Swal.fire("Deleted!", "Successfully.", "success");
               $(".drag-event"+drag_id).remove();
             }
           });
         }
     }); 
}

function select_cal_cus_colors_insert(data)
{
  var clr_class = data.getAttribute('class');
  $(".create-category").find("input[name='event_color']").val(clr_class);
  $('#selected_color').removeClass (function (index, css) {
     return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
  });
  $('#selected_color').addClass(clr_class);
  $('#selected_color_text').html('');
}

function select_cal_cus_colors_update(data)
{
  var clr_class = data.getAttribute('class');
  $(".update-category").find("input[name='event_color']").val(clr_class);
  $('#selected_color_update').removeClass (function (index, css) {
     return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
  });
  $('#selected_color_update').addClass(clr_class);
  $('#selected_color_update_text').html('');
}

function select_cal_cus_colors_drag_insert(data)
{
  var clr_class = data.getAttribute('class');
  $(".create-category-drag").find("input[name='event_color']").val(clr_class);
  $('#selected_color_drag').removeClass (function (index, css) {
     return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
  });
  $('#selected_color_drag').addClass(clr_class);
  $('#selected_color_drag_text').html('');
}

function select_cal_cus_colors_drag_update(data)
{
  var clr_class = data.getAttribute('class');
  $(".update-category-drag").find("input[name='event_color']").val(clr_class);
  $('#selected_color_drag_update').removeClass (function (index, css) {
     return (css.match (/(^|\s)cus_cal_color\S+/g) || []).join(' ');
  });
  $('#selected_color_drag_update').addClass(clr_class);
  $('#selected_color_drag_update_text').html('');
}

function readMoreContent(type,i)
{
  if($('.show-more'+type+i).css('display') == 'none')
  {
    $('.show-more'+type+i).css('display','inline');
    $('.read-more'+type+i).css('display','none');
  }
}

function readLess(type,i)
{
  if($('.read-more'+type+i).css('display') == 'none')
  {
    $('.read-more'+type+i).css('display','inline');
    $('.show-more'+type+i).css('display','none');
  }
}

function reset_todoForm()
{
  $('#add-todo').find("input[name=task_name]").val('');
  $('#add-todo').find("textarea[name=task_note]").val('');
  $('#add-todo').find("select[name=priority]").val('No Priority');
  $('#add-todo').find("select[name=task_reminder]").val('No reminder');
  //$('#add-todo').find("select[name=task_start_time]").select2().val('06:00 AM');
  //$('#add-todo').find("select[name=task_start_time]").select2().trigger('change');
  $('#task_start_timeErr').html('');
  $('#task_allDay').val('false');
  $('#task_allDay').prop('checked', false);
  $('.task_create_event_start_time').val('');
  $('.all-task-time-section').val('');
  $('#task_start_time_val').val('');
  if($('.task_create_event_start_time:visible').length == 0)
  {                    
    $(".all-task-time-section").show();
  }
  else
  {
    $(".all-task-time-section").hide();
  } 
  $("#add-todo").modal('hide');
  $('#add-todo').find("input[name=another-todo-cnt]").val('0');
  $('#add-todo').find("#show-another-todo-cnt").html('');
  $('#another-todo').prop('checked', false);
  $('#add_todobut').blur();
}

// todo input field
function todo_editable_field()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("input").focus();
}

function todo_edit_yes()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  var txt = $.trim(target.find("input").val());
  if(txt != "") 
  {
    $('.todo_edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_todo',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
            success: function(data){
               if(data.status == true)
                {
                  if(div_field == "task_name")
                  {
                    $('#new_todo_name'+div_id).html(txt);
                  }                  
                  $('.todo_edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_tfield").css('display','none');
                } 
            }
          });
  }
  else
  {
    $('.todo_edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

// function todo_datepicker(y)
// {
//   //debugger;
//   console.log($("#task_start_date"+y));
//   $(".todo_datepicker_field").datepicker("destroy");
//   $("#task_start_date"+y).datepicker({todayHighlight: true,startDate: new Date()});
// }

function todo_edit_yes_calendar(sel)
{
  //debugger;
  var target = $(sel).closest("fieldset");
  var div_class = $(sel).attr('data-class');
  var div_field = $(sel).attr('data-name');
  var div_id = $(sel).attr('data-id');
  var event_id = $(sel).attr('data-event-id');
  var txt = $.trim(target.find("input").val());
  if(txt != "") 
  {
    $('.todo_edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_todo',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt, event_id:event_id},
            success: function(data){
               if(data.status == true)
                {
                  $('.todo_edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.removeClass("editable");
                  target.find(".req_tfield").css('display','none');
                  if(data.new_time != '')
                  {
                    $('.new_changed_start_time'+div_id).html(data.new_time);
                  }                
                } 
            }
          });

    $.ajax({
          url: base_url+'front/restrict_task_start_time_editable',
          method: 'POST',
          data: {id:div_id, event_id:event_id, new_date:txt},  
          success: function(data) {
              $('.changed_start_time'+div_id).html(data);
              //console.log(data);                   
          }
    });
  }
  else
  {
    $('.todo_edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function todo_dont_edit()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text();
  if(org_val != "") 
  {
    target.find("input").val(org_val);
    target.toggleClass("editable");
    target.find(".req_tfield").css('display','none');
  }
  else
  {
    target.find(".req_tfield").css('display','block');
  }
}
// todo input field

// todo textarea field
function todo_editable_field_tarea()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("textarea").focus();
}

function todo_edit_yes_tarea()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  var txt = $.trim(target.find("textarea").val());
  if(txt != "") 
  {
    $('.todo_edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_todo',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt},
            success: function(data){
              if(data.status == true)
                {
                  $('.todo_edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_tfield").css('display','none');
                } 
            }
          });
  }
  else
  {
    $('.todo_edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function todo_dont_edit_tarea()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text();
  if(org_val != "") 
  {
    target.find("textarea").val(org_val);
    target.toggleClass("editable");
    target.find(".req_tfield").css('display','none');
  }
  else
  {
    target.find(".req_tfield").css('display','block');
  }
}
// todo textarea field

// todo select field
function todo_editable_field2()
{
  //debugger;
  $('fieldset').removeClass("editable");
  var target = $(event.target).closest("fieldset");
  target.toggleClass("editable");
  target.find("select").focus();
}

function todo_edit_yes2()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var div_class = $(event.target).attr('data-class');
  var div_field = $(event.target).attr('data-name');
  var div_id = $(event.target).attr('data-id');
  //console.log(div_class);
  //console.log(div_field);
  //console.log(div_id);
  var txt = target.find("select option:selected").text();
  var txt_val = target.find("select").val();
  //console.log(txt);
  //console.log(txt_val);
  if(txt != " ") 
  {
    $('.todo_edit_yes_but'+div_id).hide();
    $.ajax({
            url: base_url+'front/editable_todo',
            type: 'POST', 
            data: {div_class: div_class, div_field: div_field, div_id: div_id, txt: txt_val},
            success: function(data){
               if(data.status == true)
                {
                  $('.todo_edit_yes_but'+div_id).show();
                  target.find(".description-content").text(txt);
                  target.toggleClass("editable");
                  target.find(".req_tfield").css('display','none');
                } 
            }
          });
  }
  else
  {
    $('.todo_edit_yes_but'+div_id).show();
    target.find(".req_tfield").css('display','block');
  }
}

function todo_dont_edit2()
{
  //debugger;
  var target = $(event.target).closest("fieldset");
  var org_val = target.find(".description-content").text().toLowerCase();
  //console.log(org_val);
  if(org_val != "") 
  {
    target.find("select option:selected").val(org_val);
    target.toggleClass("editable");
    target.find(".req_tfield").css('display','none');
  }
  else
  {
    target.find(".req_tfield").css('display','block');
  }
}
// todo select field

function delete_inside_todo(id,event_id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete this To Do",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_inside_todo',
              type: 'post',
              data: {id: id, event_id:event_id},
              success: function(data){  
                if(data.task_count == '0')
                {
                  $('.sr-only'+event_id).html(data.todo_percent+'%');
                  $('.todo-progress-bar'+event_id).width(data.todo_percent+'%');
                  $('.todo_all_details'+id).remove();
                  $('.show_todo_progress'+event_id).html('');
                  Swal.fire("Deleted!", "Successfully.", "success");
                }
                else
                {
                  $('.sr-only'+event_id).html(data.todo_percent+'%');
                  $('.todo-progress-bar'+event_id).width(data.todo_percent+'%');
                  $('.todo_all_details'+id).remove();
                  Swal.fire("Deleted!", "Successfully.", "success");
                }                
              }
            });
          }
      });       
}

function delete_inside_todo_list(id,event_id)
{   
  //debugger;
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete this To Do",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_inside_todo',
              type: 'post',
              data: {id: id, event_id:event_id},
              success: function(data){  
                if(data.task_count == '0')
                {
                  $('.todo_all_details'+id).remove();
                  $('#toggler_inside_todo'+event_id).html('<a class="toggler" style="color: #383838 !important;visibility: hidden;"><span class="badge ms-1">0</span></a>');
                  $('#collapseExample'+event_id).html('');
                  Swal.fire("Deleted!", "Successfully.", "success");
                }
                else
                {
                  $('.todo_all_details'+id).remove();
                  $('#toggler_inside_todo'+event_id).html('<a class="toggler" style="color: #383838 !important" data-bs-toggle="collapse" href="#collapseExample<?php echo $atl->id;?>" aria-expanded="true" aria-controls="collapseExample<?php echo $atl->id;?>"><span class="badge" style="background-color: #383838 !important;">'+data.task_count+'</span></a>');
                  Swal.fire("Deleted!", "Successfully.", "success");
                }                
              }
            });
          }
      });       
}

function inside_events_todo_complete(id,event_id)
{
 //debugger;
  if ($('#todo_cb'+id).is(":checked")) {
        var complete = 'yes';
      } else {
        var complete = '';
      }
  $.ajax({
    url: base_url+'front/inside_events_todo_complete',
    type: 'POST',
    data: {complete: complete, id: id, event_id:event_id},
    success: function(data){
      $('.sr-only'+event_id).html(data.todo_percent+'%');
      $('.todo-progress-bar'+event_id).width(data.todo_percent+'%');
      if(complete == 'yes')
      {
        $('.todo_status_label'+id).html('Completed');
        $('.todo_status_icon'+id).html('<i class="mdi mdi-check-circle-outline me-1 mb-0 text-d h4" title="Completed"></i>');
      }
      else
      {
        $('.todo_status_label'+id).html('Incomplete');
        $('.todo_status_icon'+id).html('<i class="mdi mdi-checkbox-blank-circle-outline me-1 mb-0 h4" title="Incomplete"></i>');
      }
    }
  });
}

function inside_events_todo_complete_list(id,event_id)
{
 //debugger;
  if ($('#todo_cbl'+id).is(":checked")) {
        var complete = 'yes';
      } else {
        var complete = '';
      }
  $.ajax({
    url: base_url+'front/inside_events_todo_complete',
    type: 'POST',
    data: {complete: complete, id: id, event_id:event_id},
    success: function(data){
      if(complete == 'yes')
      {
        $('.todo_all_details'+id).removeClass('incomplete_class');
        $('.todo_all_details'+id).addClass('complete_class');
      }
      else
      {
        $('.todo_all_details'+id).removeClass('complete_class');
        $('.todo_all_details'+id).addClass('incomplete_class');
      }
    }
  });
}

function check_start_time_todo(value) {
   // alert();
   var check_new_value = $('#task_allDay').val();
   if (check_new_value == 'true') {
     $('#task_allDay').val("false");
     $(".all-task-time-section").show();
   } else {
     $('#task_allDay').val("true");
     $(".all-task-time-section").hide();
     $('#task_start_timeErr').html('')
   }
}

function todo_inside_datepicker()
{
//debugger;
var end_dd = $('#add-todo').find("input[name=get_task_start_date]").val();
console.log(end_dd);
$('.task_start_date_class').datepicker({endDate: new Date(end_dd)});
}

function restricted_event_start_time(sel_date)
{
  var sel_date = sel_date;
  var end_dd = $('#add-todo').find("input[name=get_task_start_date]").val();
  // console.log(sel_date);
  // console.log(end_dd);
  $('.task_create_event_start_time').val('');
  $('.all-task-time-section').val('');
  $('#task_start_time_val').val('');
  if(end_dd == sel_date)
  {
    $('#task_allDay').val('false');
    $('#task_allDay').prop('checked', false);
    $('#all-day-task-time-section').hide();
    $('.task_create_event_start_time').show();
    $('.all-task-time-section').hide();
  }
  else
  {
    $('#task_allDay').val('false');
    $('#task_allDay').prop('checked', false);
    $('#all-day-task-time-section').show();
    $('.task_create_event_start_time').hide();
    $('.all-task-time-section').show();
  }
}




function get_selected_todo_time1()
{
  $('#task_start_time_val').val($('.task_create_event_start_time').val());
}

function get_selected_todo_time2()
{
  $('#task_start_time_val').val($('.all-task-time-section').val());
}

function view_modal_close() // close calendar view modal
{  
  $('#task_allDay').val('false');
  $('#task_allDay').prop('checked', false);
  $('#all-day-task-time-section').hide();
  $('.task_create_event_start_time').show();
  $('.all-task-time-section').hide();
  $('.add-inside-todo').trigger("reset");
  $('.add-inside-todo').find('#cl_task_start_date').load(document.URL + ' #cl_task_start_date>*');
  $('#view-event').find('.modal-header').find('.edit-event').show();
  $('#view-event').find('.modal-header').find('.delete-event').show();
  $('#view-event').modal('hide');
}

function view_modal_close_dash() // close calendar view modal
{  
  $('#task_allDay').val('false');
  $('#task_allDay').prop('checked', false);
  $('#all-day-task-time-section').hide();
  $('.task_create_event_start_time').show();
  $('.all-task-time-section').hide();
  $("#view-event").find('.modal-header').find('.delete-list-events').removeAttr('data-deval');
  $("#view-event").find('.modal-header').find('.edit-list-events').removeAttr('data-eval');
  $('#myModalUpdate').find('.modal-body').find('.update-next-event').removeAttr('data-stored-eval');
  $("#myModal").find('.modal-body').find('.delete-next-event').removeAttr('data-stored-deval');
  $('.add-inside-todo').trigger("reset");
  $('.add-inside-todo').find('#cl_task_start_date').load(document.URL + ' #cl_task_start_date>*');
  $('#view-event').modal('hide');
}

function view_modal_close_list() // close calendar view modal
{  
  //debugger;
  var event_id = $(event.target).attr('data-refresheval');
  $('#task_allDay').val('false');
  $('#task_allDay').prop('checked', false);
  $('#all-day-task-time-section').hide();
  $('.task_create_event_start_time').show();
  $('.all-task-time-section').hide();
  $("#view-event").find('.modal-header').find('.delete-list-events').removeAttr('data-deval');
  $("#view-event").find('.modal-header').find('.edit-list-events').removeAttr('data-eval');
  $('#myModalUpdate').find('.modal-body').find('.update-next-event').removeAttr('data-stored-eval');
  $("#myModal").find('.modal-body').find('.delete-next-event').removeAttr('data-stored-deval');
  $('.add-inside-todo').trigger("reset");
  $('.add-inside-todo').find('#cl_task_start_date').load(document.URL + ' #cl_task_start_date>*');
  $('#collapseExample'+event_id).load(document.URL + ' #collapseExample'+event_id+'>*');
  $('#view-event').modal('hide');
}

function InsideTodoViewModal(id)
{
var viewEventInTodo=$("#view-inside-todo");
var id = id;                   
$.ajax({
    type: "POST",
    url: base_url+'front/view_selected_inside_todo_info_list',
    type: 'POST',
    data: {
        id:id 
    }, 
    success: function(data){
    //debugger;
       var intodo_title = data.intodo_title;
       var intodo_note = data.intodo_note;
       var intodo_datetime = data.intodo_datetime;
       var intodo_reminder = data.intodo_reminder;
       var intodo_status = data.intodo_status;
       var intodo_priority = data.intodo_priority;
       var intodo_icon = data.intodo_icon;
       var intodo_div = $('<div class="intodo-modal"></div>');
            intodo_div.append('<div class="row first-row"></div>');
            intodo_div.find('.first-row')
                    .append('<div class="col-md-12"><h3 class="intodo-title"><small><i class="mdi '+intodo_icon+' text-d me-1 mb-0 h4"></i></small>&nbsp;' + intodo_title + '</h3><small class="intodo-datetime">' + intodo_datetime + '</small></div>');
            intodo_div.append('<br><div class="row second-row"></div>');   
            intodo_div.find('.second-row')    
                    .append('<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="intodo-note">'+ intodo_note +'</p></div>')
                    .append('<div class="col-md-1"><i class="fa fa-level-up-alt"></div><div class="col-md-5"></i><p class="intodo-repeatoption">' + intodo_priority + '</p></div>')
                    .append('<div class="col-md-1"><i class="fa fa-bell"></i></div><div class="col-md-5"><p class="intodo-reminder">' + intodo_reminder + '</p></div>');
            
            viewEventInTodo.modal('show');
            viewEventInTodo.find('.modal-body').empty().prepend(intodo_div).end();
    }
});
}

function update_inside_todo_list(id,event_id)
{
  var id = id;
  var event_id = event_id;
  $.ajax({
            url:  base_url+'front/update_events_todo_data',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#InsideTodoEditModal_content').html(data);
              // Display Modal
              $('#InsideTodoEditModal').modal('show'); 
            }
          });
}

function remove_eventMember(member,mid)
{
  var member = member;
  var mid = mid;
  $('#member_rmmf').val(member);
  $('#mid_rmmf').val(mid);
  $('#imid_rmmf').val('');
  $('#memtype_rmmf').val('eventmem');
  $('#RemoveMemberMailModal').modal('show');
  // Swal.fire({
  //     title: "Are you sure?",
  //     text: "Remove member from meeting event",
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#c7df19",
  //     cancelButtonColor: "#383838",
  //     confirmButtonText: "Yes"
  //     }).then(function (result) {
  //         if (result.value) {
  //           // AJAX request
  //            $.ajax({
  //             url:  base_url+'front/remove_eventMember',
  //             type: 'post',
  //             data: {member: member, mid: mid},
  //             success: function(data){
  //               Swal.fire("Removed!", "Successfully.", "success"); 
  //               $('.mm'+mid).remove();
  //             }
  //           });
  //         }
  //     });
}

function remove_eventInvitedMember(imid)
{
  var imid = imid;
  $('#member_rmmf').val('');
  $('#mid_rmmf').val('');
  $('#imid_rmmf').val(imid);
  $('#memtype_rmmf').val('eventinvitedmem');
  $('#RemoveMemberMailModal').modal('show');
  // Swal.fire({
  //     title: "Are you sure?",
  //     text: "Remove member from meeting event",
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#c7df19",
  //     cancelButtonColor: "#383838",
  //     confirmButtonText: "Yes"
  //     }).then(function (result) {
  //         if (result.value) {
  //           // AJAX request
  //            $.ajax({
  //             url:  base_url+'front/remove_eventInvitedMember',
  //             type: 'post',
  //             data: {imid: imid},
  //             success: function(data){
  //               Swal.fire("Removed!", "Successfully.", "success"); 
  //               $('.mmi'+imid).remove();
  //             }
  //           });
  //         }
  //     });
}

function RemoveMemberDontSendMail()
{
  $('#butsel').val('dont_send');
  $('#RemoveMemberForm').submit();
}

function RemoveMemberSendMail()
{
  $('#butsel').val('send');
  $('#RemoveMemberForm').submit();
}

function CloseRemoveMemberMailModal()
{
  $('#member_rmmf').val('');
  $('#mid_rmmf').val('');
  $('#imid_rmmf').val('');
  $('#memtype_rmmf').val('');
  $('#butsel').val('');
  $('#dont_send').show();
  $('#send').show();
  $('#mrloader2').css('visibility','hidden');
  $('#RemoveMemberMailModal').modal('hide');
}

function RemoveMemberDontSendMailUpdate()
{
  $('#butsel_up').val('dont_send');
  $('#RemoveMemberUpdateForm').submit();
}

function RemoveMemberSendMailUpdate()
{
  $('#butsel_up').val('send');
  $('#RemoveMemberUpdateForm').submit();
}

//////Calendar Part Ends///////

//////Goal & Strategies Part Start///////

//preview goal overview request notification modal
function GoalOverviewRequestNotificationModal(id){           
   var id = id;
   // AJAX request
   $.ajax({
    url:  base_url+'front/GoalOverviewRequestNotificationModal_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#GoalOverviewRequestNotificationModal_content').html(data);
      // Display Modal
      $('#GoalOverviewRequestNotificationModal').modal('show'); 
    }
  });
 }

 function GoalPendingRequestNotificationClearYes(id){ 
//debugger;           
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/GoalPendingRequestNotificationClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#gqncy'+id).remove();
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt); 
          $("#fix_notification_box").addClass("show");
          }
        });
       }

//preview overview modal
function GoalOverviewModal(id){           
 var id = id;
 // AJAX request
 $.ajax({
  url:  base_url+'front/GoalOverview_Modal',
  type: 'post',
  data: {id: id},
  success: function(data){ 
    // Add response in Modal body
    //console.log(data);
    $('#GoalOverviewModal_content').html(data);
    // Display Modal
    $('#GoalOverviewModal').modal('show'); 
  }
});
}

//goal edit modal
function GoalEditModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/GoalEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#GoalEditModal_content').html(data);
              // Display Modal
              $('#GoalEditModal').modal('show'); 
            }
          });
}

//preview overview modal
function StrategiesOverviewModal(id){           
 var id = id;
 // AJAX request
 $.ajax({
  url:  base_url+'front/StrategiesOverview_Modal',
  type: 'post',
  data: {id: id},
  success: function(data){ 
    // Add response in Modal body
    //console.log(data);
    $('#StrategiesOverviewModal_content').html(data);
    // Display Modal
    $('#StrategiesOverviewModal').modal('show'); 
  }
});
}

//strategy edit modal
function StrategiesEditModal(id){           
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'front/StrategiesEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#StrategiesEditModal_content').html(data);
              // Display Modal
              $('#StrategiesEditModal').modal('show'); 
            }
          });
}

function display_goal_hlist(gid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var gid = gid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_goal_history_date_wise',
                method: 'POST',
                data: {gid:gid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function display_hlist_goal(gid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var gid = gid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_history_date_wise_goal',
                method: 'POST',
                data: {gid:gid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function display_strategy_hlist(sid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var sid = sid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_strategy_history_date_wise',
                method: 'POST',
                data: {sid:sid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function display_hlist_strategy(sid,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
  $('.clear_list').html('');
  $('.clear_list').removeClass('shown');
  var sid = sid;
  var hdate = hdate;
            $.ajax({
                url: base_url+'front/view_history_date_wise_strategy',
                method: 'POST',
                data: {sid:sid, hdate:hdate},  
                success: function(data) {
                    $('#hlist'+hdate).html(data);
                    $('#hlist'+hdate).addClass('shown');
                    //console.log(data);                   
                }
            });
  }
}

function delete_goal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_goal',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
                // var portid = data.portid;
                // window.location = base_url+'portfolio-goals/'+portid;
              }
            });
          }
      });       
}

function goal_retrieve(gid)
{
  //debugger;
  var gid = gid;
  var retrieve_link = document.getElementById('retrieve_glink'+gid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore Goal",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_goal',
              type: 'post',
              data: {gid: gid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function goal_del_forever(gid)
{
  //debugger;
  var gid = gid;
  var gdel_glink = document.getElementById('gdel_glink'+gid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Goal Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            gdel_glink.style.display = "none";
             $.ajax({
              url:  base_url+'front/goal_del_forever',
              type: 'post',
              data: {gid: gid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function delete_strategy(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_strategy',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Moved to Trash!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function strategy_retrieve(sid)
{
  //debugger;
  var sid = sid;
  var retrieve_link = document.getElementById('retrieve_gslink'+sid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Restore KPI",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            retrieve_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/retrieve_strategy',
              type: 'post',
              data: {sid: sid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function strategy_del_forever(sid)
{
  //debugger;
  var sid = sid;
  var sdel_gslink = document.getElementById('sdel_gslink'+sid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete KPI Permanently",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            sdel_gslink.style.display = "none";
             $.ajax({
              url:  base_url+'front/strategy_del_forever',
              type: 'post',
              data: {sid: sid},
              success: function(data){ 
                window.location.reload();
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Restored!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function all_goal_filter()
{
  var created_goal = document.getElementById('created_goal');
  var accepted_goal = document.getElementById('accepted_goal');
  var pending_goal = document.getElementById('pending_goal');
  var more_goal = document.getElementById('more_goal');
  var all_goal = document.getElementById('all_goal');

  var created_goal_list = document.getElementById('created_goal_list');
  var accepted_goal_list = document.getElementById('accepted_goal_list');
  var pending_goal_list = document.getElementById('pending_goal_list');
  var more_goal_list = document.getElementById('more_goal_list');

  var created_goal_grid = document.getElementById('created_goal_grid');
  var accepted_goal_grid = document.getElementById('accepted_goal_grid');
  var pending_goal_grid = document.getElementById('pending_goal_grid');
  var more_goal_grid = document.getElementById('more_goal_grid');

    all_goal.checked = true;
    created_goal.checked = false;
    accepted_goal.checked = false;
    pending_goal.checked = false;
    more_goal.checked = false;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_goal_list.style.display = "block";
    accepted_goal_list.style.display = "block";
    pending_goal_list.style.display = "block";
    more_goal_list.style.display = "block";

    created_goal_grid.style.display = "block";
    accepted_goal_grid.style.display = "block";
    pending_goal_grid.style.display = "block";
    more_goal_grid.style.display = "block";
}

function goal_filter()
{
  var created_goal = document.getElementById('created_goal');
  var accepted_goal = document.getElementById('accepted_goal');
  var pending_goal = document.getElementById('pending_goal');
  var more_goal = document.getElementById('more_goal');
  var all_goal = document.getElementById('all_goal');

  var created_goal_list = document.getElementById('created_goal_list');
  var accepted_goal_list = document.getElementById('accepted_goal_list');
  var pending_goal_list = document.getElementById('pending_goal_list');
  var more_goal_list = document.getElementById('more_goal_list');

  var created_goal_grid = document.getElementById('created_goal_grid');
  var accepted_goal_grid = document.getElementById('accepted_goal_grid');
  var pending_goal_grid = document.getElementById('pending_goal_grid');
  var more_goal_grid = document.getElementById('more_goal_grid');

  created_goal_list.style.display = "none";
  accepted_goal_list.style.display = "none";
  pending_goal_list.style.display = "none";
  more_goal_list.style.display = "none";

  created_goal_grid.style.display = "none";
  accepted_goal_grid.style.display = "none";
  pending_goal_grid.style.display = "none";
  more_goal_grid.style.display = "none";

   if(created_goal.checked == true)
   {
    created_goal_list.style.display = "block";
    created_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    created_goal_list.style.display = "none";
    created_goal_grid.style.display = "none";
   }

   if(accepted_goal.checked == true)
   {
    accepted_goal_list.style.display = "block";
    accepted_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    accepted_goal_list.style.display = "none";
    accepted_goal_grid.style.display = "none";
   }

   if(pending_goal.checked == true)
   {
    pending_goal_list.style.display = "block";
    pending_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   } 
   else 
   {
    pending_goal_list.style.display = "none";
    pending_goal_grid.style.display = "none";
   }

   if(more_goal.checked == true)
   {
    more_goal_list.style.display = "block";
    more_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    more_goal_list.style.display = "none";
    more_goal_grid.style.display = "none";
   }

   if((created_goal.checked == false) && (accepted_goal.checked == false) && (pending_goal.checked == false) && (more_goal.checked == false))
   {
    all_goal.checked = true;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_goal_list.style.display = "block";
    accepted_goal_list.style.display = "block";
    pending_goal_list.style.display = "block";
    more_goal_list.style.display = "block";

    created_goal_grid.style.display = "block";
    accepted_goal_grid.style.display = "block";
    pending_goal_grid.style.display = "block";
    more_goal_grid.style.display = "block";
   }
}

function all_goal_filter2()
{
  var created_goal = document.getElementById('created_goal2');
  var accepted_goal = document.getElementById('accepted_goal2');
  var pending_goal = document.getElementById('pending_goal2');
  var more_goal = document.getElementById('more_goal2');
  var all_goal = document.getElementById('all_goal2');

  var created_goal_list = document.getElementById('created_goal_list');
  var accepted_goal_list = document.getElementById('accepted_goal_list');
  var pending_goal_list = document.getElementById('pending_goal_list');
  var more_goal_list = document.getElementById('more_goal_list');

  var created_goal_grid = document.getElementById('created_goal_grid');
  var accepted_goal_grid = document.getElementById('accepted_goal_grid');
  var pending_goal_grid = document.getElementById('pending_goal_grid');
  var more_goal_grid = document.getElementById('more_goal_grid');

    all_goal.checked = true;
    created_goal.checked = false;
    accepted_goal.checked = false;
    pending_goal.checked = false;
    more_goal.checked = false;

    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_goal_list.style.display = "block";
    accepted_goal_list.style.display = "block";
    pending_goal_list.style.display = "block";
    more_goal_list.style.display = "block";

    created_goal_grid.style.display = "block";
    accepted_goal_grid.style.display = "block";
    pending_goal_grid.style.display = "block";
    more_goal_grid.style.display = "block";
}

function goal_filter2()
{
  var created_goal = document.getElementById('created_goal2');
  var accepted_goal = document.getElementById('accepted_goal2');
  var pending_goal = document.getElementById('pending_goal2');
  var more_goal = document.getElementById('more_goal2');
  var all_goal = document.getElementById('all_goal2');

  var created_goal_list = document.getElementById('created_goal_list');
  var accepted_goal_list = document.getElementById('accepted_goal_list');
  var pending_goal_list = document.getElementById('pending_goal_list');
  var more_goal_list = document.getElementById('more_goal_list');

  var created_goal_grid = document.getElementById('created_goal_grid');
  var accepted_goal_grid = document.getElementById('accepted_goal_grid');
  var pending_goal_grid = document.getElementById('pending_goal_grid');
  var more_goal_grid = document.getElementById('more_goal_grid');

  created_goal_list.style.display = "none";
  accepted_goal_list.style.display = "none";
  pending_goal_list.style.display = "none";
  more_goal_list.style.display = "none";

  created_goal_grid.style.display = "none";
  accepted_goal_grid.style.display = "none";
  pending_goal_grid.style.display = "none";
  more_goal_grid.style.display = "none";

   if(created_goal.checked == true)
   {
    created_goal_list.style.display = "block";
    created_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    created_goal_list.style.display = "none";
    created_goal_grid.style.display = "none";
   }

   if(accepted_goal.checked == true)
   {
    accepted_goal_list.style.display = "block";
    accepted_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    accepted_goal_list.style.display = "none";
    accepted_goal_grid.style.display = "none";
   }

   if(pending_goal.checked == true)
   {
    pending_goal_list.style.display = "block";
    pending_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').show();
    $('#hide_no_data').hide();
   } 
   else 
   {
    pending_goal_list.style.display = "none";
    pending_goal_grid.style.display = "none";
   }

   if(more_goal.checked == true)
   {
    more_goal_list.style.display = "block";
    more_goal_grid.style.display = "block";
    all_goal.checked = false;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();
   } 
   else 
   {
    more_goal_list.style.display = "none";
    more_goal_grid.style.display = "none";
   }

   if((created_goal.checked == false) && (accepted_goal.checked == false) && (pending_goal.checked == false) && (more_goal.checked == false))
   {
    all_goal.checked = true;
    $('#no_pending_req_img').hide();
    $('#hide_no_data').show();

    created_goal_list.style.display = "block";
    accepted_goal_list.style.display = "block";
    pending_goal_list.style.display = "block";
    more_goal_list.style.display = "block";

    created_goal_grid.style.display = "block";
    accepted_goal_grid.style.display = "block";
    pending_goal_grid.style.display = "block";
    more_goal_grid.style.display = "block";
   }
}

function archive_goal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_goal',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function goal_unarchived(gid)
{
  //debugger;
  var gid = gid;
  var unarchived_link = document.getElementById('unarchived_glink'+gid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen Goal",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            unarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_goal',
              type: 'post',
              data: {gid: gid},
              success: function(data){ 
                window.location.reload();  
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Reopened!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

function archive_strategy(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Archive!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/archive_strategy',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Archived!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Archived!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function strategy_unarchived(sid)
{
  //debugger;
  var sid = sid;
  var unarchived_link = document.getElementById('unarchived_slink'+sid);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen KPI",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
            unarchived_link.style.display = "none";
             $.ajax({
              url:  base_url+'front/unarchived_strategy',
              type: 'post',
              data: {sid: sid},
              success: function(data){ 
                window.location.reload()
                // if(data.status == false)
                // {
                //   window.location.reload();        
                // }
                // else if(data.status == true)
                // {
                //   Swal.fire("Reopened!", "Successfully.", "success");
                //   window.location.reload();
                // }
              }
            });
          }
      });
}

//duplicate goal
function duplicate_goal(id)
{   
   var id = id; 
   // AJAX request
   $.ajax({
    url:  base_url+'front/duplicate_goal_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#duplicate_goalModal_content').html(data);
      // Display Modal
      $('#duplicate_goalModal').modal('show'); 
    }
  });       
}

//duplicate strategy
function duplicate_strategy(id)
{   
   var id = id; 
   // AJAX request
   $.ajax({
    url:  base_url+'front/duplicate_strategy_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#duplicate_strategyModal_content').html(data);
      // Display Modal
      $('#duplicate_strategyModal').modal('show'); 
    }
  });       
}

function direct_remove_goalmanager(gid,first_name,last_name)
{
  var gid = gid;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Remove "+ first_name +' '+last_name+" as Goal Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/direct_remove_goalmanager',
              type: 'post',
              data: {gid: gid, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function remove_goalmanager(gid,gmid,first_name,last_name)
{
  var gid = gid;
  var gmid = gmid;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Remove "+ first_name +' '+last_name+" as Goal Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/remove_goalmanager',
              type: 'post',
              data: {gid: gid, gmid: gmid, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function delete_gMember(gid,gmid,first_name,last_name)
{
  var gid = gid;
  var gmid = gmid;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Remove Member : "+ first_name +' '+last_name,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_gMember',
              type: 'post',
              data: {gid: gid, gmid: gmid, first_name: first_name, last_name: last_name},
              success: function(data){
                if(data.status == true)
                { 
                  Swal.fire("Team Member Removed!", "Successfully.", "success");
                  window.location.reload();
                }
                else
                {
                  $('#GoalInsideOpenWorkModal_content').html(data);
                  // Display Modal
                  $('#GoalInsideOpenWorkModal').modal('show');
                }
              }
            });
          }
      });
}

function assign_goalmanager(gid,gmid,first_name,last_name)
{
  var gid = gid;
  var gmid = gmid;
  var first_name = first_name;
  var last_name = last_name;
  Swal.fire({
      title: "Are you sure?",
      text: "Assign "+ first_name +' '+last_name+" as Goal Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/assign_goalmanager',
              type: 'post',
              data: {gid: gid, gmid: gmid, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Assigned!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function assign_goalmanager_replace(gid,gmid,first_name,last_name,exist_manager)
{
  var gid = gid;
  var gmid = gmid;
  var first_name = first_name;
  var last_name = last_name;
  var exist_manager = exist_manager;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to replace "+ exist_manager +" with "+ first_name +' '+last_name+" as Goal Manager",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            $('.pro_manager_icon').hide();
            //$('.manager_loader2').show();
            // AJAX request
             $.ajax({
              url:  base_url+'front/assign_goalmanager',
              type: 'post',
              data: {gid: gid, gmid: gmid, first_name: first_name, last_name: last_name},
              success: function(data){ 
                Swal.fire("Assigned!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function delete_iGMember(gid,igm_id,sent_to)
{
  var gid = gid;
  var igm_id = igm_id;
  var sent_to = sent_to;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Remove Invited Member : "+ sent_to,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_iGMember',
              type: 'post',
              data: {gid: gid, igm_id: igm_id, sent_to: sent_to},
              success: function(data){ 
                Swal.fire("Invited Member Removed!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });
}

function add_SuggestedGMember(gid,suggest_id,first_name,last_name)
{
  //debugger;
  var gid = gid;
  var suggest_id = suggest_id;
  var first_name = first_name;
  var last_name = last_name;
  var addButton = document.getElementById("add_SuggestedGMemberButton"+suggest_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Add "+ first_name +' '+last_name+" in Team",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/add_SuggestedGMember',
              type: 'post',
              data: {gid: gid, suggest_id: suggest_id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Team Member Added!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });
}

function add_Suggested_IGmember(gid,suggest_id,gs_id)
{
  //debugger;
  var gid = gid;
  var suggest_id = suggest_id;
  var gs_id = gs_id;
  var addIButton = document.getElementById("add_Suggested_IGmemberButton"+gs_id);
  Swal.fire({
      title: "Are you sure?",
      text: "You want to send Invite Mail to "+ suggest_id,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
           //debugger;
            addIButton.style.display = "none";
            // AJAX request
             $.ajax({
              url:  base_url+'front/add_Suggested_IGmember',
              type: 'post',
              data: {gid: gid, suggest_id: suggest_id},
              success: function(data){ 
                if(data.status == true){
                Swal.fire("Team Member Invited!", "Successfully.", "success");
                window.location.reload();
                }
              }
            });
          }
      });
}

//////Goal & Strategies Part End///////

function display_all_port_view_members()
{
  $('#few_portfolio_members_display').hide();
  $('#all_portfolio_members_display').show();
}

function display_few_port_view_members(type,i)
{
  $('#few_portfolio_members_display').show();
  $('#all_portfolio_members_display').hide();
}

//////File Cabinet Part Start///////
function file_it_task(tid)
{
  var tid = tid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to file the Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_task',
              type: 'post',
              data: {tid: tid,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });
}

function file_it_subtask(stid)
{
  var stid = stid;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to File the Subtask",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_subtask',
              type: 'post',
              data: {stid: stid,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });
}

function file_it_project(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to File it!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_project',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function file_it_platform(pc_id)
{
  var pc_id = pc_id;
  Swal.fire({
      title: "Are you sure?",
      text: "You want to File it the Content",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_platform',
              type: 'post',
              data: {pc_id: pc_id,},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload();
                }
              }
            });
          }
      });
}

function file_it_strategy(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to File it!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_strategy',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function file_it_goal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to File it!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_it_goal',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                if(data.status == false)
                {
                  Swal.fire("Not Filed!", "Successfully.", "success");
                  window.location.reload();        
                }
                else if(data.status == true)
                {
                  Swal.fire("Filed it!", "Successfully.", "success");
                  window.location.reload(); 
                }
              }
            });
          }
      });       
}

function goToModule(target_module,target_value){
  $.ajax({
    url:  base_url+'front/remove_remaining_array_module',
    type: 'post',
    data: {
        target_module: target_module, target_value:target_value
    },
    success: function(data){ 
      // console.log(data);
      if(target_module == 'department'){
        $('#show-department').show();
        $('#show-module_folders').empty();
        $('#show-goal').empty();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'module_folders'){
        $('#show-department').hide();
        $('#show-module_folders').show();
        $('#show-goal').empty();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'goal'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').show();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'kpi'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').show();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'project'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').show();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'task_cp_folders'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').show();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'task'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').show();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'subtask'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').hide();
        $('#show-subtask').show();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(target_module == 'platform'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').show();
        $('#show-cp_files').empty();
      }
    }
  });
}

function goBack(prev_module){
  $.ajax({
    url:  base_url+'front/remove_last_array_module',
    type: 'post',
    success: function(data){ 
      if(prev_module == 'department'){
        $('#show-department').show();
        $('#show-module_folders').empty();
        $('#show-goal').empty();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'module_folders'){
        $('#show-department').hide();
        $('#show-module_folders').show();
        $('#show-goal').empty();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'goal'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').show();
        $('#show-kpi').empty();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'kpi'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').show();
        $('#show-project').empty();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'project'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').show();
        $('#show-task_cp_folders').empty();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'task_cp_folders'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').show();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'task'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').show();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'subtask'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').hide();
        $('#show-subtask').show();
        $('#show-subtask_files').empty();
        $('#show-cp').empty();
        $('#show-cp_files').empty();
      }
      else if(prev_module == 'platform'){
        $('#show-department').hide();
        $('#show-module_folders').hide();
        $('#show-goal').hide();
        $('#show-kpi').hide();
        $('#show-project').hide();
        $('#show-task_cp_folders').hide();
        $('#show-task').empty();
        $('#show-subtask').empty();
        $('#show-subtask_files').empty();
        $('#show-cp').show();
        $('#show-cp_files').empty();
      }
    }
  });
}

//preview Module Folder
function show_module_folders(portfolio_id,department_id,deptcnt,previous_module){         
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var deptcnt = deptcnt;
   var previous_module = previous_module;
   // AJAX request
   $.ajax({
    url:  base_url+'front/show_module_folders',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').html(data);      
    }
  });
}

//preview Module Names
function show_module_names(portfolio_id,department_id,deptcnt,current_module,previous_module){         
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var deptcnt = deptcnt;
   var current_module = current_module;
   // AJAX request
   $.ajax({
    url:  base_url+'front/show_module_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, deptcnt:deptcnt, current_module:current_module, previous_module:previous_module
    },
    success: function(data){
      $('#show-department').hide();
      $('#show-module_folders').hide();

      if(current_module == 'goal'){
        $('#show-goal').show();
        $('#show-goal').html(data);
      }
      else if(current_module == 'kpi'){
        $('#show-kpi').show();
        $('#show-kpi').html(data);
      }
      else if(current_module == 'project'){
        $('#show-project').show();
        $('#show-project').html(data);
      }
      else if(current_module == 'task'){
        $('#show-task').show();
        $('#show-task').html(data);
      }
      else if(current_module == 'subtask'){
        $('#show-subtask').show();
        $('#show-subtask').html(data);
      }
      else if(current_module == 'platform'){
        $('#show-cp').show();
        $('#show-cp').html(data);
      }      
    }
  });
}

//preview kpi names
function kpi_names(portfolio_id,department_id,goal_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var goal_id = goal_id;
   // AJAX request
   $.ajax({
    url:  base_url+'front/show_kpi_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, goal_id:goal_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').show();
      $('#show-kpi').html(data);
    }
  });
}

 //preview project names
function project_names(portfolio_id,department_id,strategy_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var strategy_id = strategy_id;
   // AJAX request
   $.ajax({
    url:  base_url+'front/show_project_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, strategy_id:strategy_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').show();
      $('#show-project').html(data);
    }
  });
}

 //preview Task, Platform Folders
function task_cp_folders(portfolio_id,department_id,project_id,deptcnt,project_file_it,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var project_id = project_id;
   var project_file_it = project_file_it;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_task_cp_folders',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, project_id:project_id, deptcnt:deptcnt, project_file_it:project_file_it, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').show();
      $('#show-task_cp_folders').html(data);
    }
  });
}

  //preview Task names
function task_names(portfolio_id,department_id,project_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var project_id = project_id;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_task_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, project_id:project_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').hide();
      $('#show-task').show();
      $('#show-task').html(data);
    }
  });
}

  //preview Sub Task names
function subtask_names(portfolio_id,department_id,task_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var task_id = task_id;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_subtask_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, task_id:task_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').hide();
      $('#show-task').hide();
      $('#show-subtask').show();
      $('#show-subtask').html(data);
    }
  });
}

  //preview Sub Task Files
function subtask_files(portfolio_id,department_id,subtask_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var subtask_id = subtask_id;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_subtask_files',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, subtask_id:subtask_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').hide();
      $('#show-task').hide();
      $('#show-subtask').hide();
      $('#show-subtask_files').show();
      $('#show-subtask_files').html(data);
    }
  });
}

  //preview Platform names
function cp_names(portfolio_id,department_id,project_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var project_id = project_id;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_cp_names',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, project_id:project_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').hide();
      $('#show-cp').show();
      $('#show-cp').html(data);

    }
  });
}

  //preview Platform Files
function cp_files(portfolio_id,department_id,platform_id,deptcnt,previous_module){          
   var portfolio_id = portfolio_id;
   var department_id = department_id;
   var platform_id = platform_id;

   // AJAX request
   $.ajax({
    url:  base_url+'front/show_cp_files',
    type: 'post',
    data: {
      portfolio_id:portfolio_id, department_id:department_id, platform_id:platform_id, deptcnt:deptcnt, previous_module:previous_module
    },
    success: function(data){ 
      $('#show-department').hide();
      $('#show-module_folders').hide();
      $('#show-goal').hide();
      $('#show-kpi').hide();
      $('#show-project').hide();
      $('#show-task_cp_folders').hide();
      $('#show-cp').hide();
      $('#show-cp_files').show();
      $('#show-cp_files').html(data);
    }
  });
}

function reopenGoal(gid)
{   
  var gid = gid; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this Goal!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_goal',
              type: 'post',
              data: {gid: gid},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}

function reopenStrategy(sid)
{   
  var sid = sid; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this KPI!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_strategy',
              type: 'post',
              data: {sid: sid},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}

function reopenProject(pid)
{   
  var pid = pid; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this Project!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_project',
              type: 'post',
              data: {pid: pid},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}

function reopenTask(tid)
{   
  var tid = tid; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this Task!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_task',
              type: 'post',
              data: {tid: tid},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}

function reopenSubtask(stid)
{   
  var stid = stid; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this Subtask!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_subtask',
              type: 'post',
              data: {stid: stid},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}

function reopenPlatform(pc_id)
{   
  var pc_id = pc_id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Reopen this Platform!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/reopen_platform',
              type: 'post',
              data: {pc_id: pc_id},
              success: function(data){ 
                window.location.reload();
              }
            });
          }
      });       
}
//////File Cabinet Part End///////

// Tour Functions//
//Preview My Tour modal
function myTourModal(){           
 // AJAX request
  $.ajax({
    url:  base_url+'front/myTour_Modal',
    type: 'post',
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#myTourModal_content').html(data);
      // Display Modal
      $('#myTourModal').modal('show'); 
    }
  });
}

//Preview Get Started modal
function getStartedModal(){           
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
}

// End Tour Functions//

// Start task time tracking Functions//
let interval;
let interval_new;
var isRunning = false;
var hours;
var minute;
var seconds;


function toggleTimer(id) {

    $.ajax({
        url: base_url + 'front/get_flag_on',
        type: 'POST',
        success: function(data) {
            var data = JSON.parse(data);
            setTimeout(function() {
                if (data == false) {
                    toggleTimer4(id);
                } else {
                    for (var j = 0; j < data.length; j++) {
                        var flag = data[j].flag;
                        var sflag = data[j].sflag;
                        var tname = data[j].tname;
                        var flag_id = data[j].tid;
                        var sflag_id = data[j].stid;
                        var sflag = data[j].sflag;

                        if (flag == '1') {
                            var page = location.pathname.split('/')[2];
                            if (page == "tasks-overview") {
                                var timer_started_tasks_overview = $('#timer_started_' + flag_id).val();

                                if (timer_started_tasks_overview == '1') {

                                    if (flag_id == id) {

                                        console.log('successsss');
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running same task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                console.log('action success5');

                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);
                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update',
                                                    type: 'POST',
                                                    data: {
                                                        id: id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {
                                                        if (data) {}
                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + ID);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                $('#timer_flag_new_' + flag_id).val('0');
                                                $('#timer_started_' + flag_id).val('0');
                                                setTimeout(function() {

                                                    CheckTimer();
                                                }, 2000);
                                                isRunning = !isRunning;
                                            } 
                                        });
                                    } else if (sflag == '1') {
                                        console.log('success1')
                                    }

                                } else {

                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);
                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {}
                                            });

                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');
                                            $('#timer_flag_new' + flag_id).val('0');
                                            $('#timer_started_' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer4(id);
                                        } 
                                    });
                                }
                            } else {

                                var timer_started = $('#timer_started_' + flag_id).val();
                                if (timer_started == '1') {
                                    if (flag_id == id) {
                                        console.log('success');
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running same task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }

                                                clearInterval(interval);
                                                clearInterval(interval_new);
                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update',
                                                    type: 'POST',
                                                    data: {
                                                        id: id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {
                                                        if (data) {}
                                                    }
                                                });
                                                var span = document.querySelector('.timerBtn_' + id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                $('#timer_flag_new_' + flag_id).val('0');
                                                $('#timer_started_' + flag_id).val('0');
                                                setTimeout(function() {
                                                    CheckTimer();
                                                }, 2000);

                                            }
                                        });
                                    } else {

                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running previous task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }

                                                clearInterval(interval);
                                                clearInterval(interval_new);
                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');

                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            } 
                                        });
                                    }

                                } else {

                                    if (page == "week-tasks") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running previous task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }


                                                clearInterval(interval);
                                                clearInterval(interval_new);
                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {}
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else if (page == "today-tasks") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running previous task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {}
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else if (page == "project-tasks-list") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running previous task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');
                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else {
                                        if (flag == '1') {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                text: "You want to stop running task !",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#c7df19",
                                                cancelButtonColor: "#383838",
                                                confirmButtonText: "Yes"
                                            }).then(function(result) {
                                                if (result.value) {
                                                    // AJAX request
                                                    console.log('action success');
                                                    toggleTimer4(id);
                                                }
                                            });
                                        } else if (sflag == '1') {
                                            console.log('success1')
                                        }
                                    }
                                }
                            }
                        }
                        if (sflag == '1') {
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to stop running previous task!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#c7df19",
                                cancelButtonColor: "#383838",
                                confirmButtonText: "Yes"
                            }).then(function(result) {
                                if (result.value) {
                                    // AJAX request
                                    var elements_subtask = document.querySelector('.countersubtask_' + sflag_id + '[data-id="' + sflag_id + '"]');
                                    if (elements_subtask) {
                                        var counter_subtask = elements_subtask.textContent.trim();
                                    }
                                    clearInterval(interval_subtask);
                                    clearInterval(interval_subtask_new);

                                    $('.timerSBtn_' + sflag_id).html('<i class="bx bx-play-circle timerSBtn_' + sflag_id + '" onclick="SubtaskTimer(' + sflag_id + ');"></i>');
                                    $.ajax({
                                        url: base_url + 'front/subtask_update_new',
                                        type: 'POST',
                                        data: {
                                            id: sflag_id,
                                            counter: counter_subtask
                                        },
                                        success: function(data) {

                                        }
                                    });
                                    var span = document.querySelector('.timerSBtn_' + sflag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                    setTimeout(function() {
                                        $('#timer_sflag_new' + sflag_id).val('0');
                                        $('#stimer_started_' + sflag_id).val('0');
                                        $('#stimer_started_popup_' + sflag_id).val('0');
                                        isRunning_subtask = false;
                                        toggleTimer4(id);
                                    }, 1000);

                                }
                            });
                        }
                    }
                }

            }, 2000);
        }
    });
}

function toggleTimer4(id) {
    var dataIdValue = id;
    var elements = document.querySelector('.counter_' + dataIdValue + '[data-id="' + dataIdValue + '"]');

    if (elements) {
        var counter = elements.textContent.trim();
    }

    var digits = String(counter).split(":"); // Split the string at each colon
    hour = digits[0]; // "00"
    minute = digits[1]; // "00"
    second = digits[2]; // "02"

    if (hour) {
        hours = hour;
    } else {
        hours = 0;
    }
    if (minute) {
        minutes = minute;
    } else {
        minutes = 0;
    }

    if (second) {
        seconds = second;
    } else {
        seconds = 0;
    }


    if (counter == '00:00:00' || counter == '') {
        if (isRunning) {
            clearInterval(interval);
            clearInterval(interval_new);
            $('.timerBtn_' + dataIdValue).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue + '"  onclick="toggleTimer(' + id + ');"></i>');
            $.ajax({
                url: base_url + 'front/timer_update',
                type: 'POST',
                data: {
                    id: dataIdValue,
                    counter: counter
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerBtn_' + dataIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.remove('timer-continue');

            $('#timer_started_' + dataIdValue).val('0');
            $('#timer_started_popup_' + dataIdValue).val('0');
            $('#timer_started_label').val('0');

        } else {
            // alert('1');

            $.ajax({
                url: base_url + 'front/timer_start',
                type: 'POST',
                data: {
                    id: dataIdValue
                },
                success: function(data) {
                    if (data) {}
                }
            });
            
            var span = document.querySelector('.timerBtn_' + dataIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');

            $('#timer_flag_new_' + dataIdValue).val('1');
            $('#timer_started_' + dataIdValue).val('1');
            $('#timer_started_popup_' + dataIdValue).val('1');
            $('#timer_started_label').val('1');


            interval = setInterval(() => {
                updateTimer(dataIdValue);
            }, 1000);
            $('.timerBtn_' + dataIdValue).html('<i class="bx bx-pause-circle timerBtn_' + dataIdValue + '" onclick="toggleTimer(' + id + ');"></i>');
        }

    } else {
        clearInterval(interval);
        clearInterval(interval_new);

        var flag_new = $('#timer_flag_new_' + dataIdValue).val();
        if (flag_new == '1') {
            if (isRunning) {
                clearInterval(interval);
                clearInterval(interval_new);

                $('.timerBtn_' + dataIdValue).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue + '" onclick="toggleTimer(' + id + ');"></i>');
                $.ajax({
                    url: base_url + 'front/timer_update',
                    type: 'POST',
                    data: {
                        id: id,
                        counter: counter,
                        sales1: 'sale1'
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerBtn_' + id);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.remove('timer-continue');

            }
            $('#timer_flag_new_' + dataIdValue).val('0');
            $('#timer_started_' + dataIdValue).val('0');
            isRunning = !isRunning;
            console.log(isRunning);
        } else {

            if (isRunning == false) {
                $.ajax({
                    url: base_url + 'front/timer_start_new',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });
              

            var page = location.pathname.split('/')[2];

            if (page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "subtasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search")
              {
                var span = document.querySelector('.timerBtn_' + id);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.add('timer-continue');                                          
              } else {
              }

                $('#timer_started_' + id).val('1');
                $('#timer_started_popup_' + id).val('1');
                $('#timer_started_label').val('1');
                interval = setInterval(() => {
                    updateTimer(dataIdValue);
                    console.log(interval);
                }, 1000);
                $('.timerBtn_' + dataIdValue).html('<i class="bx bx-pause-circle timerBtn_' + dataIdValue + '" onclick="toggleTimer(' + id + ');"></i>');

            } else {
                clearInterval(interval);
                clearInterval(interval_new);

                $('.timerBtn_' + dataIdValue).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue + '" onclick="toggleTimer(' + id + ');"></i>');
                $.ajax({
                    url: base_url + 'front/timer_update_new',
                    type: 'POST',
                    data: {
                        id: id,
                        counter: counter
                    },
                    success: function(data) {
                        if (data) {

                        }
                    }
                });

                var span = document.querySelector('.timerBtn_' + dataIdValue);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.remove('timer-continue');

                $('#timer_flag_new' + dataIdValue).val('0');
                $('#timer_started_' + dataIdValue).val('0');
                $('#timer_started_popup_' + dataIdValue).val('0');
                $('#timer_started_label').val('0');
            }
            isRunning = !isRunning;
        }
    }
    setTimeout(function() {
        CheckTimer();
    }, 2000);

}

function toggleTimer1(id) {
    var dataIdValue = id;
    var elements = document.querySelector('.counter_' + dataIdValue + '[data-id="' + dataIdValue + '"]');

    if (elements) {
        var counter = elements.textContent.trim();
    } else {
        console.log('Element not found');
    }
    var digits = String(counter).split(":"); // Split the string at each colon

    hour = digits[0]; // "00"
    minute = digits[1]; // "00"
    second = digits[2]; // "02"

    if (hour) {
        hours = hour;
    } else {
        hours = 0;
    }
    if (minute) {
        minutes = minute;
    } else {
        minutes = 0;
    }

    if (second) {
        seconds = second;
    } else {
        seconds = 0;
    }
    interval = setInterval(() => {
        updateTimer(dataIdValue);
    }, 1000);
    var span = document.querySelector('.timerBtn_' + dataIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');
    var page = location.pathname.split('/')[2];
            if (page === "tasks-overview")
            {
             var span = document.querySelector('.timerBtn_' + dataIdValue);
             // Get the parent div of the span
             var parentDiv = span.closest('.card');
             // Add a class to the parent div
             parentDiv.classList.remove('timer-continue');                                          
             } else {
             }

    $('.timerBtn_' + dataIdValue).html('<i class="bx bx-pause-circle timerBtn_' + dataIdValue + '" onclick="toggleTimer(' + id + ');"></i>');
    isRunning = !isRunning;
}

function toggleTimer2(id1) {
    var dataIdValue1 = id1;
    var elements1 = document.querySelector('.counter_' + dataIdValue1 + '[data-id="' + dataIdValue1 + '"]');
    if (elements1) {
      console.log('Element found');
        var counter1 = elements1.textContent.trim();
    } else {
        console.log('Element not founds');
        var dataIdValue1 = id1;
        var elements1 = document.querySelector('.counter_label_' + dataIdValue1 + '[data-id="' + dataIdValue1 + '"]');
        var counter1 = elements1.textContent.trim();
      }
    digits1 = String(counter1).split(":"); // Split the string at each colon
    hour1 = digits1[0]; // "00"
    minute1 = digits1[1]; // "00"
    second1 = digits1[2]; // "02"
    if (hour1) {
        hours = hour1;
    } else {
        hours = 0;
    }
    if (minute1) {
        minutes = minute1;
    } else {
        minutes = 0;
    }

    if (second1) {
        seconds = second1;
    } else {
        seconds = 0;
    }
    $('.timerBtn_new_' + dataIdValue1).html('<i class="bx bx-pause-circle" onclick="toggleTimer3(' + dataIdValue1 + ');"></i>');
    isRunning = !isRunning;
}

function toggleTimer3(id) {

    $.ajax({
        url: base_url + 'front/get_flag_on',
        type: 'POST',
        success: function(data) {
            var data = JSON.parse(data);
            setTimeout(function() {
                if (data == false) {
                    toggleTimer5(id);
                } else {

                    for (var j = 0; j < data.length; j++) {
                        var flag = data[j].flag;
                        var sflag = data[j].sflag;
                        var tname = data[j].tname;
                        var flag_id = data[j].tid;
                        var sflag_id = data[j].stid;
                        var sflag = data[j].sflag;
                        if (flag == '1') {
                            var timer_started_popup = $('#timer_started_popup_' + flag_id).val();
                            console.log(timer_started_popup);
                            if (timer_started_popup == '1') {

                                if (flag_id == id) {
                                    console.log('success');
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running task samse!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            console.log('action success');
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer3(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {
                                                  }
                                            });

                                            var page = location.pathname.split('/')[2];

                                            if (page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "subtasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search")
                                             {
                                              var span = document.querySelector('.timerBtn_' + flag_id);
                                              // Get the parent div of the span
                                              var parentDiv = span.closest('.card');
                                              // Add a class to the parent div
                                              parentDiv.classList.remove('timer-continue');                                          
                                              } else {
                                              }

                                            

                                            $('#timer_flag_poup_' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            setTimeout(function() {
                                                CheckTimer();
                                            }, 2000);
                                        }
                                    });
                                } else {

                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter,
                                                    sale: 'sale'
                                                },
                                                success: function(data) {

                                                }
                                            });

                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        }
                                    });

                                }


                            } else {
                                var path = window.location.pathname;
                                var page = location.pathname.split('/')[2];

                                if (page == "week-tasks") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {

                                                }
                                            });
                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        }
                                    });
                                } else if (page == "today-tasks") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {

                                                }
                                            });
                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');
                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        }
                                    });
                                } else if (page == "project-tasks-list") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter,
                                                    sale: 'sale'
                                                },
                                                success: function(data) {

                                                }
                                            });
                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        }
                                    });
                                } else {

                                    if (flag == '1') {
                                        console.log('success');
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You wants to stop running task !",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                console.log('action success');
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                $('#timer_flag_poup' + flag_id).val('0');
                                                $('#timer_started_popup_' + flag_id).val('0');
                                                $('#timer_started_label').val('0');
                                                isRunning = false;
                                                CheckTimer();
                                            }
                                        });
                                    } else if (sflag == '1') {
                                        console.log('success')
                                    }
                                }
                            }
                        }
                        if (sflag == '1') {

                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to stop running previous task!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#c7df19",
                                cancelButtonColor: "#383838",
                                confirmButtonText: "Yes"
                            }).then(function(result) {
                                if (result.value) {
                                    // AJAX request
                                    var elements_subtask = document.querySelector('.countersubtask_' + sflag_id + '[data-id="' + sflag_id + '"]');
                                    if (elements_subtask) {
                                        var counter_subtask = elements_subtask.textContent.trim();
                                    }
                                    clearInterval(interval_subtask);
                                    clearInterval(interval_subtask_new);

                                    $('.timerSBtn_' + sflag_id).html('<i class="bx bx-play-circle timerSBtn_' + sflag_id + '" onclick="SubtaskTimer(' + sflag_id + ');"></i>');
                                    $.ajax({
                                        url: base_url + 'front/subtask_update_new',
                                        type: 'POST',
                                        data: {
                                            id: sflag_id,
                                            counter: counter_subtask
                                        },
                                        success: function(data) {

                                        }
                                    });

                                    var span = document.querySelector('.timerSBtn_' + sflag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                    setTimeout(function() {
                                        $('#timer_sflag_new' + sflag_id).val('0');
                                        $('#stimer_started_' + sflag_id).val('0');
                                        $('#stimer_started_popup_' + sflag_id).val('0');
                                        isRunning_subtask = false;
                                        toggleTimer4(id);
                                    }, 1000);
                                }
                            });

                        }
                    }
                }

            }, 2000);
        }
    });
}

function toggleTimer5(id2) {

    var dataIdValue2 = id2;
    var elements2 = document.querySelector('.counter_modal_' + dataIdValue2 + '[data-id="' + dataIdValue2 + '"]');

    if (elements2) {
        var counter2 = elements2.textContent.trim();
    }

    var digits2 = String(counter2).split(":"); // Split the string at each colon
    hour = digits2[0]; // "00"
    minute = digits2[1]; // "00"
    second = digits2[2]; // "02"

    if (hour) {
        hours = hour;
    } else {
        hours = 0;
    }
    if (minute) {
        minutes = minute;
    } else {
        minutes = 0;
    }

    if (second) {
        seconds = second;
    } else {
        seconds = 0;
    }

    if (counter2 == '00:00:00' || counter2 == '') {
        if (isRunning) {
            clearInterval(interval);
            clearInterval(interval_new);
            $('.timerBtn_' + dataIdValue2).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue2 + '"  onclick="toggleTimer3(' + dataIdValue2 + ');"></i>');
            $.ajax({
                url: base_url + 'front/timer_update',
                type: 'POST',
                data: {
                    id: dataIdValue2,
                    counter: counter2
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerBtn_' + flag_id);
              // Get the parent div of the span
              var parentDiv = span.closest('.card');
              // Add a class to the parent div
              parentDiv.classList.remove('timer-continue');

        } else {
            $.ajax({
                url: base_url + 'front/timer_start',
                type: 'POST',
                data: {
                    id: dataIdValue2
                },
                success: function(data) {
                    if (data) {}
                }
            });
            var span = document.querySelector('.timerBtn_' + dataIdValue2);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');
            $('#timer_flag_poup_' + dataIdValue2).val('1');
            $('#timer_started_popup_' + dataIdValue2).val('1');
            $('#timer_started_label').val('1');
            interval = setInterval(() => {
                updateTimer(dataIdValue2);
            }, 1000);
            $('.timerBtn_' + dataIdValue2).html('<i class="bx bx-pause-circle timerBtn_' + dataIdValue2 + '" onclick="toggleTimer3(' + dataIdValue2 + ');"></i>');
        }
        isRunning = !isRunning;

    } else {
        var flag_new = $('#timer_flag_poup_' + dataIdValue2).val();
        if (flag_new == '1') {
            if (isRunning) {
                clearInterval(interval);
                clearInterval(interval_new);
                $('.timerBtn_' + dataIdValue2).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue2 + '" onclick="toggleTimer3(' + dataIdValue2 + ');"></i>');
                $.ajax({
                    url: base_url + 'front/timer_update',
                    type: 'POST',
                    data: {
                        id: dataIdValue2,
                        counter: counter2
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerBtn_' + dataIdValue2);
                  // Get the parent div of the span
                  var parentDiv = span.closest('.card');
                  // Add a class to the parent div
                  parentDiv.classList.remove('timer-continue');

            }
            $('#timer_flag_poup_' + dataIdValue2).val('0');
            $('#timer_started_popup_' + dataIdValue2).val('0');
            $('#timer_started_label').val('0');
        } else {
            if (!isRunning) {
                $.ajax({
                    url: base_url + 'front/timer_start_new',
                    type: 'POST',
                    data: {
                        id: dataIdValue2,
                        count: 'ct'
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerBtn_' + dataIdValue2);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');

                $('#timer_started_popup_' + dataIdValue2).val('1');
                $('#timer_started_label').val('1');

                interval = setInterval(() => {
                    updateTimer(dataIdValue2);
                }, 1000);
                $('.timerBtn_' + dataIdValue2).html('<i class="bx bx-pause-circle timerBtn_' + dataIdValue2 + '" onclick="toggleTimer3(' + dataIdValue2 + ');"></i>');
                isRunning = !isRunning;
            } else {
                clearInterval(interval);
                clearInterval(interval_new);

                $('.timerBtn_' + dataIdValue2).html('<i class="bx bx-play-circle timerBtn_' + dataIdValue2 + '" onclick="toggleTimer3(' + dataIdValue2 + ');"></i>');
                $.ajax({
                    url: base_url + 'front/timer_update_new',
                    type: 'POST',
                    data: {
                        id: dataIdValue2,
                        counter: counter2
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });
                var span = document.querySelector('.timerBtn_' + dataIdValue2);
                  // Get the parent div of the span
                  var parentDiv = span.closest('.card');
                  // Add a class to the parent div
                  parentDiv.classList.remove('timer-continue');

                $('#timer_flag_poup_' + dataIdValue2).val('0');
                $('#timer_started_' + dataIdValue2).val('0');
            }
            isRunning = !isRunning;
        }
    }

    setTimeout(function() {
        CheckTimer();
        clearInterval(interval_new);
    }, 2000);
}

function toggleTimer6(id1) {
  var dataIdValue1 = id1;
  var elements1 = document.querySelector('.counter_' + dataIdValue1 + '[data-id="' + dataIdValue1 + '"]');
      var dataIdValue1 = id1;
      var elements1 = document.querySelector('.counter_label_' + dataIdValue1 + '[data-id="' + dataIdValue1 + '"]');
      var counter1 = elements1.textContent.trim();
  digits1 = String(counter1).split(":"); // Split the string at each colon
  hour1 = digits1[0]; // "00"
  minute1 = digits1[1]; // "00"
  second1 = digits1[2]; // "02"
  if (hour1) {
      hours = hour1;
  } else {
      hours = 0;
  }
  if (minute1) {
      minutes = minute1;
  } else {
      minutes = 0;
  }

  if (second1) {
      seconds = second1;
  } else {
      seconds = 0;
  }
  interval = setInterval(() => {
    updateTimer(dataIdValue1);
}, 1000);
}

function updateTimer(id) {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
            if (hours >= 24) {
                hours = 0;
            }
        }
    }

    
    // Check if the class exists
    if (document.querySelector('.counter_modal_' + id)) {
        // Class exists
        var formattedTime1 = formatTime(hours, minutes, seconds);
        document.querySelector('.counter_modal_' + id + '[data-id="' + id + '"]').textContent = formattedTime1;

    }

   if (document.querySelector('.counter_label_' + id)) {
      // Class exists
      var formattedTime1 = formatTime(hours, minutes, seconds);
      document.querySelector('.counter_label_' + id + '[data-id="' + id + '"]').textContent = formattedTime1;

  }

    var formattedTime = formatTime(hours, minutes, seconds);
    document.querySelector('.counter_' + id + '[data-id="' + id + '"]').textContent = formattedTime;

}


var hours2;
var minutes2;
var seconds2;

function updateTimer2(id) {
    seconds2++;
    if (seconds2 >= 60) {
        seconds2 = 0;
        minutes2++;
        if (minutes2 >= 60) {
            minutes2 = 0;
            hours2++;
            if (hours2 >= 24) {
                hours2 = 0;
            }
        }
    }
    // Class exists
    var formattedTime2 = formatTime2(hours2, minutes2, seconds2);
    document.querySelector('.counter_label_' + id + '[data-id="' + id + '"]').textContent = formattedTime2;
}

var hours_subtask;
var minute_subtask;
var seconds_subtask;
var interval_subtask;
var interval_subtask_new;
var isRunning_subtask = false;

function SubtaskTimer(sid) {

    $.ajax({
        url: base_url + 'front/get_flag_on',
        type: 'POST',
        success: function(data) {
            var data = JSON.parse(data);
            setTimeout(function() {
                console.log(data);
                if (data == false) {
                    SubtaskTimer2(sid);
                } else {
                    for (var j = 0; j < data.length; j++) {
                        var flag = data[j].flag;
                        var sflag = data[j].sflag;
                        var flag_id = data[j].tid;
                        var sflag_id = data[j].stid;

                        if (sflag == '1') {
                            var path = window.location.pathname;
                            var page = location.pathname.split('/')[2];
                            if (page == "subtasks-overview") {
                                var timer_started_subtasks_overview = $('#stimer_started_' + sflag_id).val();

                                if (timer_started_subtasks_overview == '1') {

                                    if (sflag_id == sid) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running subtask same !",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                SubtaskTimer4(sid);
                                            }
                                        });
                                    } else if (flag == '1') {
                                        console.log('success1')
                                    }

                                } else {

                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous subtask !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            var elements_subtask = document.querySelector('.countersubtask_' + sflag_id + '[data-id="' + sflag_id + '"]');
                                            if (elements_subtask) {
                                                var counter_subtask = elements_subtask.textContent.trim();
                                            }
                                            clearInterval(interval_subtask);
                                            clearInterval(interval_subtask_new);

                                            $('.timerSBtn_' + sflag_id).html('<i class="bx bx-play-circle timerSBtn_' + sflag_id + '" onclick="SubtaskTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/subtask_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: sflag_id,
                                                    subtask_counter: counter_subtask
                                                },
                                                success: function(data) {

                                                }
                                            });

                                            var span = document.querySelector('.timerSBtn_' + sflag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                            $('#timer_sflag_new' + sflag_id).val('0');
                                            $('#stimer_started_' + sflag_id).val('0');
                                            $('#stimer_started_popup_' + sflag_id).val('0');
                                            isRunning_subtask = false;
                                            SubtaskTimer4(sid);
                                        }
                                    });
                                }
                            } else {
                          console.log('2');

                                var stimer_started = $('#stimer_started_' + sflag_id).val();
                                if (stimer_started == '1') {
                                    if (sflag_id == sid) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running same subtask!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                SubtaskTimer4(sid);
                                            }
                                        });
                                    } else {
                                      console.log('3');

                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running previous subtask!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                var elements_subtask = document.querySelector('.countersubtask_' + sflag_id + '[data-id="' + sflag_id + '"]');
                                                if (elements_subtask) {
                                                    var counter_subtask = elements_subtask.textContent.trim();
                                                }
                                                clearInterval(interval_subtask);
                                                clearInterval(interval_subtask_new);

                                                $('.timerSBtn_' + sflag_id).html('<i class="bx bx-play-circle timerSBtn_' + sflag_id + '" onclick="SubtaskTimer(' + sflag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/subtask_timer_update',
                                                    type: 'POST',
                                                    data: {
                                                        id: sflag_id,
                                                        subtask_counter: counter_subtask
                                                    },
                                                    success: function(data) {}
                                                });

                                                var span = document.querySelector('.timerSBtn_' + sflag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_sflag_new' + sflag_id).val('0');
                                                    $('#stimer_started_' + sflag_id).val('0');
                                                    $('#stimer_started_popup_' + sflag_id).val('0');
                                                    isRunning_subtask = false;
                                                    SubtaskTimer4(sid);
                                                }, 1000);

                                            }
                                        });
                                    }

                                } else {

                                    if (page == "week-tasks") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running  previous task!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else if (page == "today-tasks") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running task previous stop!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else if (page == "project-tasks-list") {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running task previous stop!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                                if (elements) {
                                                    var counter = elements.textContent.trim();
                                                }
                                                clearInterval(interval);
                                                clearInterval(interval_new);

                                                $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                                $.ajax({
                                                    url: base_url + 'front/timer_update_new',
                                                    type: 'POST',
                                                    data: {
                                                        id: flag_id,
                                                        counter: counter
                                                    },
                                                    success: function(data) {

                                                    }
                                                });

                                                var span = document.querySelector('.timerBtn_' + flag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');

                                                setTimeout(function() {
                                                    $('#timer_flag_new' + flag_id).val('0');
                                                    $('#timer_started_' + flag_id).val('0');
                                                    $('#timer_started_popup_' + flag_id).val('0');
                                                    $('#timer_started_label').val('0');
                                                    isRunning = false;
                                                    toggleTimer4(id);
                                                }, 1000);

                                            }
                                        });

                                    } else {

                                        if (sflag == '1') {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                text: "You want to stop running task !",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#c7df19",
                                                cancelButtonColor: "#383838",
                                                confirmButtonText: "Yes"
                                            }).then(function(result) {
                                                if (result.value) {
                                                    SubtaskTimer4(sid);
                                                }
                                            });
                                        } else if (flag == '1') {

                                        }
                                    }
                                }
                            }
                        }
                        if (flag == '1') {

                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to stop running previous task !",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#c7df19",
                                cancelButtonColor: "#383838",
                                confirmButtonText: "Yes"
                            }).then(function(result) {
                                if (result.value) {
                                    var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                    if (elements) {
                                        var counter = elements.textContent.trim();
                                    }
                                    clearInterval(interval);
                                    clearInterval(interval_new);

                                    $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                    $.ajax({
                                        url: base_url + 'front/timer_update_new',
                                        type: 'POST',
                                        data: {
                                            id: flag_id,
                                            counter: counter
                                        },
                                        success: function(data) {

                                        }
                                    });

                                    if (document.querySelector('.timerBtn_' + flag_id)) {
                                      // Class exists
                                      var span = document.querySelector('.timerBtn_' + flag_id);
                                      // Get the parent div of the span
                                      var parentDiv = span.closest('.card');
                                      // Add a class to the parent div
                                      parentDiv.classList.remove('timer-continue');
                                    }
                                    $('#timer_flag_new' + flag_id).val('0');
                                    $('#timer_started_' + flag_id).val('0');
                                    $('#timer_started_popup_' + flag_id).val('0');
                                    $('#timer_started_label').val('0');
                                    isRunning = false;
                                    SubtaskTimer4(sid);
                                }
                            });
                        }
                    }
                }
            }, 2000);
        }
    });
}

function SubtaskTimer2(sid) {
    var dataSIdValue = sid;
    var subtask = document.querySelector('.countersubtask_' + dataSIdValue + '[data-id="' + dataSIdValue + '"]');

    if (subtask) {
        var counter_subtask = subtask.textContent.trim();
    }

    var digits_subtask = String(counter_subtask).split(":"); // Split the string at each colon
    hour_subtask = digits_subtask[0]; // "00"
    minute_subtask = digits_subtask[1]; // "00"
    second_subtask = digits_subtask[2]; // "02"

    if (hour_subtask) {
        hours_subtask = hour_subtask;
    } else {
        hours_subtask = 0;
    }
    if (minute_subtask) {
        minutes_subtask = minute_subtask;
    } else {
        minutes_subtask = 0;
    }

    if (second_subtask) {
        seconds_subtask = second_subtask;
    } else {
        seconds = 0;
    }


    if (counter_subtask == '00:00:00' || counter_subtask == '') {
        if (isRunning_subtask) {
            clearInterval(interval_subtask);
            clearInterval(interval_subtask_new);

            clearInterval(interval_subtask_new);
            $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '"  onclick="SubtaskTimer(' + sid + ');"></i>');
            $.ajax({
                url: base_url + 'front/subtask_timer_update',
                type: 'POST',
                data: {
                    id: dataSIdValue,
                    subtask_counter: counter_subtask
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerSBtn_' + dataSIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.remove('timer-continue');

            $('#stimer_started_' + dataSIdValue).val('0');
            $('#stimer_started_popup_' + dataSIdValue).val('0');

        } else {
            // alert('1');

            $.ajax({
                url: base_url + 'front/subtask_timer_start',
                type: 'POST',
                data: {
                    id: dataSIdValue
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerSBtn_' + dataSIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');

            $('#timer_sflag_' + dataSIdValue).val('1');
            $('#timer_sflag_new_' + dataSIdValue).val('1');
            $('#stimer_started_' + dataSIdValue).val('1');
            $('#stimer_started_popup_' + dataSIdValue).val('1');

            interval_subtask = setInterval(() => {
                updateSTimer(dataSIdValue);
            }, 1000);
            $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-pause-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
        }

    } else {
        // alert('22');

        var sflag_new = $('#timer_sflag_new_' + dataSIdValue).val();
        if (sflag_new == '1') {
            if (isRunning_subtask == false) {
                clearInterval(interval_subtask);
                clearInterval(interval_subtask_new);
                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
                $.ajax({
                    url: base_url + 'front/subtask_timer_update',
                    type: 'POST',
                    data: {
                        id: sid,
                        counter: counter
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerSBtn_' + sid);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.remove('timer-continue');

            }
            $('#timer_sflag_new_' + dataSIdValue).val('0');
            isRunning_subtask = false;

        } else {
            if (isRunning_subtask == false) {
                $.ajax({
                    url: base_url + 'front/subtask_timer_new',
                    type: 'POST',
                    data: {
                        id: sid
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerSBtn_' + sid);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');
            var page = location.pathname.split('/')[2];
            if (page === "subtasks-overview")
            {
             var span = document.querySelector('.timerSBtn_' + dataIdValue);
             // Get the parent div of the span
             var parentDiv = span.closest('.card');
             // Add a class to the parent div
             parentDiv.classList.remove('timer-continue');                                          
             } else {
             }

                $('#stimer_started_' + sid).val('1');
                $('#stimer_started_popup_' + sid).val('1');
                interval_subtask = setInterval(() => {
                  console.log(interval_subtask);
                    updateSTimer(dataSIdValue);
                }, 1000);
                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-pause-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');

            } else {
                clearInterval(interval_subtask);
                clearInterval(interval_subtask_new);

                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
                $.ajax({
                    url: base_url + 'front/subtask_update_new',
                    type: 'POST',
                    data: {
                        id: sid,
                        counter: counter_subtask
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerSBtn_' + sid);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.remove('timer-continue');

                $('#timer_sflag_new' + dataSIdValue).val('0');
                $('#stimer_started_' + dataSIdValue).val('0');
                $('#stimer_started_popup_' + dataSIdValue).val('0');


            }
            isRunning_subtask = !isRunning_subtask;

        }
    }


    setTimeout(function() {
        CheckTimer();
        clearInterval(interval_subtask_new);
    }, 2000);

}

function SubtaskTimer3(sid) {
    var dataSIdValue = sid;
    var elements = document.querySelector('.countersubtask_' + dataSIdValue + '[data-id="' + dataSIdValue + '"]');

    if (elements) {
        var counter_subtask = elements.textContent.trim();
    }

    var digits_subtask = String(counter_subtask).split(":"); // Split the string at each colon

    hour_subtask = digits_subtask[0]; // "00"
    minute_subtask = digits_subtask[1]; // "00"
    second_subtask = digits_subtask[2]; // "02"

    if (hour_subtask) {
        hours_subtask = hour_subtask;
    } else {
        hours = 0;
    }
    if (minute_subtask) {
        minutes_subtask = minute_subtask;
    } else {
        minutes_subtask = 0;
    }

    if (second_subtask) {
        seconds_subtask = second_subtask;
    } else {
        seconds_subtask = 0;
    }
    interval_subtask = setInterval(() => {
        updateSTimer(dataSIdValue);
    }, 1000);

    var span = document.querySelector('.timerSBtn_' + dataSIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');

            var page = location.pathname.split('/')[2];

            if (page === "subtasks-overview")
            {
             var span = document.querySelector('.timerSBtn_' + dataSIdValue);
             // Get the parent div of the span
             var parentDiv = span.closest('.card');
             // Add a class to the parent div
             parentDiv.classList.remove('timer-continue');                                          
             } else {
             }

    $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-pause-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
    isRunning_subtask = !isRunning_subtask;
}

function SubtaskTimer4(sid) {
    var dataSIdValue = sid;
    var elements_subtask = document.querySelector('.countersubtask_' + dataSIdValue + '[data-id="' + dataSIdValue + '"]');

    if (elements_subtask) {
        var counter_subtask = elements_subtask.textContent.trim();
    }

    var digits_subtask = String(counter_subtask).split(":"); // Split the string at each colon
    hour_subtask = digits_subtask[0]; // "00"
    minute_subtask = digits_subtask[1]; // "00"
    second_subtask = digits_subtask[2]; // "02"

    if (hour_subtask) {
        hours_subtask = hour_subtask;
    } else {
        hours_subtask = 0;
    }
    if (minute_subtask) {
        minutes_subtask = minute_subtask;
    } else {
        minutes_subtask = 0;
    }

    if (second_subtask) {
        seconds_subtask = second_subtask;
    } else {
        seconds_subtask = 0;
    }


    if (counter_subtask == '00:00:00' || counter_subtask == '') {
        if (isRunning_subtask) {
            clearInterval(interval_subtask);
            clearInterval(interval_subtask_new);

            $('.timerSBtn_' + dataIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataIdValue + '"  onclick="SubtaskTimer(' + sid + ');"></i>');
            $.ajax({
                url: base_url + 'front/subtask_timer_update',
                type: 'POST',
                data: {
                    id: dataSIdValue,
                    subtask_counter: counter_subtask
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerSBtn_' + dataSIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.remove('timer-continue');

            $('#stimer_started_' + dataSIdValue).val('0');
            $('#stimer_started_popup_' + dataSIdValue).val('0');

        } else {
            // alert('1');

            $.ajax({
                url: base_url + 'front/subtask_timer_start',
                type: 'POST',
                data: {
                    id: dataSIdValue
                },
                success: function(data) {
                    if (data) {}
                }
            });

            var span = document.querySelector('.timerSBtn_' + dataSIdValue);
            // Get the parent div of the span
            var parentDiv = span.closest('.card');
            // Add a class to the parent div
            parentDiv.classList.add('timer-continue');

            $('#timer_sflag_new_' + dataSIdValue).val('1');
            $('#stimer_started_' + dataSIdValue).val('1');
            $('#stimer_started_popup_' + dataSIdValue).val('1');


            interval_subtask = setInterval(() => {
                updateSTimer(dataSIdValue);
            }, 1000);
            $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-pause-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
        }

    } else {
        var sflag_new = $('#timer_sflag_new_' + dataSIdValue).val();
        if (sflag_new == '1') {
            if (isRunning_subtask == false) {
                clearInterval(interval_subtask);
                clearInterval(interval_subtask_new);

                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
                $.ajax({
                    url: base_url + 'front/subtask_timer_update',
                    type: 'POST',
                    data: {
                        id: sid,
                        subtask_counter: counter_subtask
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerSBtn_' + sid);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.remove('timer-continue');

            }
        


            if (isRunning_subtask) {
              clearInterval(interval_subtask);
              clearInterval(interval_subtask_new);

              $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
              $.ajax({
                  url: base_url + 'front/subtask_timer_update',
                  type: 'POST',
                  data: {
                      id: sid,
                      subtask_counter: counter_subtask
                  },
                  success: function(data) {
                      if (data) {}
                  }
              });

              var span = document.querySelector('.timerSBtn_' + sid);
              // Get the parent div of the span
              var parentDiv = span.closest('.card');
              // Add a class to the parent div
              parentDiv.classList.remove('timer-continue');

          }

          $('#timer_sflag_new_' + dataSIdValue).val('0');
          $('#timer_sflag_' + dataSIdValue).val('0');
          $('#stimer_started_' + dataSIdValue).val('0');
          $('#stimer_started_popup_' + dataSIdValue).val('0');
          isRunning_subtask = false;



        } else {
            if (isRunning_subtask == false) {
                $.ajax({
                    url: base_url + 'front/subtask_timer_new',
                    type: 'POST',
                    data: {
                        id: sid
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });

                var span = document.querySelector('.timerSBtn_' + sid);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.add('timer-continue');

                $('#stimer_started_' + sid).val('1');
                $('#stimer_started_popup_' + sid).val('1');
                interval_subtask = setInterval(() => {
                    updateSTimer(dataSIdValue);
                }, 1000);
                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-pause-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');

            } else {
                clearInterval(interval_subtask);
                clearInterval(interval_subtask_new);

                $('.timerSBtn_' + dataSIdValue).html('<i class="bx bx-play-circle timerSBtn_' + dataSIdValue + '" onclick="SubtaskTimer(' + sid + ');"></i>');
                $.ajax({
                    url: base_url + 'front/subtask_update_new',
                    type: 'POST',
                    data: {
                        id: sid,
                        subtask_counter: counter_subtask,
                        subtask: 'sub5'
                    },
                    success: function(data) {
                        if (data) {}
                    }
                });
                var span = document.querySelector('.timerSBtn_' + sid);
                // Get the parent div of the span
                var parentDiv = span.closest('.card');
                // Add a class to the parent div
                parentDiv.classList.remove('timer-continue');

                $('#timer_sflag_new' + dataSIdValue).val('0');
                $('#stimer_started_' + dataSIdValue).val('0');
                $('#stimer_started_popup_' + dataSIdValue).val('0');

            }
            isRunning_subtask = !isRunning_subtask;

        }
    }

    setTimeout(function() {
        CheckTimer();
        clearInterval(interval_subtask_new);
    }, 2000);
}

function SubtaskTimer5(spid) {
    var dataSPIdValue = spid;
    var elements_stask = document.querySelector('.countersubtask_' + dataSPIdValue + '[data-id="' + dataSPIdValue + '"]');
    if (elements_stask) {
        var counter_stask = elements_stask.textContent.trim();
    }
    digits_stask = String(counter_stask).split(":"); // Split the string at each colon
    hour_subtask = digits_stask[0]; // "00"
    minute_subtask = digits_stask[1]; // "00"
    second_subtask = digits_stask[2]; // "02"
    if (hour_subtask) {
        hours_subtask = hour_subtask;
    } else {
        hours_subtask = 0;
    }
    if (minute_subtask) {
        minutes_subtask = minute_subtask;
    } else {
        minutes_subtask = 0;
    }

    if (second_subtask) {
        seconds_subtask = second_subtask;
    } else {
        seconds_subtask = 0;
    }

    var page = location.pathname.split('/')[2];

if (page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "subtasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search")
{
  if (document.querySelector('.timerSBtn_' + dataSPIdValue)) {
    // Class exists
    var span = document.querySelector('.timerSBtn_' + dataSPIdValue);
    // Get the parent div of the span
    var parentDiv = span.closest('.card');
    // Add a class to the parent div
    if(parentDiv){
      // Add a class to the parent div
   parentDiv.classList.add('timer-continue');
   }
  }
  else if (document.querySelector('.timerSBtn_new_' + dataSPIdValue)) {
    // Class exists
    var span = document.querySelector('.timerSBtn_new_' + dataSPIdValue);
    // Get the parent div of the span
    var parentDiv = span.closest('.card');
    if(parentDiv){
       // Add a class to the parent div
    parentDiv.classList.add('timer-continue');
    }
   
  }
  
} else {
}


    $('.timerSBtn_new_' + dataSPIdValue).html('<i class="bx bx-pause-circle" onclick="SubtaskTimer6(' + dataSPIdValue + ');"></i>');
    isRunning_subtask = !isRunning_subtask;
}

function SubtaskTimer6(sid) {

    $.ajax({
        url: base_url + 'front/get_flag_on',
        type: 'POST',
        success: function(data) {
            var data = JSON.parse(data);
            setTimeout(function() {
                console.log(data);
                if (data == false) {
                    SubtaskTimer2(sid);
                } else {

                    for (var j = 0; j < data.length; j++) {
                        var flag = data[j].flag;
                        var sflag = data[j].sflag;
                        var flag_id = data[j].tid;
                        var sflag_id = data[j].stid;
                        if (sflag == '1') {

                            var stimer_started_popup = $('#stimer_started_popup_' + sflag_id).val();
                            if (stimer_started_popup == '1') {

                                if (sflag_id == sid) {
                                    console.log('success');
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running same task!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            SubtaskTimer4(sid);
                                        }
                                    });
                                } else {

                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements_subtask = document.querySelector('.countersubtask_' + sflag_id + '[data-id="' + sflag_id + '"]');
                                            if (elements_subtask) {
                                                var counter_subtask = elements_subtask.textContent.trim();
                                            }
                                            clearInterval(interval_subtask);
                                            clearInterval(interval_subtask_new);

                                            $('.timerSBtn_' + sflag_id).html('<i class="bx bx-play-circle timerSBtn_' + sflag_id + '" onclick="SubtaskTimer(' + sflag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/subtask_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: sflag_id,
                                                    subtask_counter: counter_subtask
                                                },
                                                success: function(data) {

                                                }
                                            });

                                            var span = document.querySelector('.timerSBtn_' + sflag_id);
                                                // Get the parent div of the span
                                                var parentDiv = span.closest('.card');
                                                // Add a class to the parent div
                                                parentDiv.classList.remove('timer-continue');
                                                
                                            $('#stimer_flag_poup' + sflag_id).val('0');
                                            $('#stimer_started_popup_' + sflag_id).val('0');
                                            isRunning_subtask = false;
                                            SubtaskTimer4(sid);
                                        }
                                    });

                                }


                            } else {
                                var path = window.location.pathname;
                                var page = location.pathname.split('/')[2];

                                if (page == "week-tasks") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {

                                                }
                                            });

                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        } 
                                    });
                                } else if (page == "today-tasks") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {

                                                }
                                            });

                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        } else {
                                            console.log('action failed');

                                        }
                                    });
                                } else if (page == "project-tasks-list") {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You want to stop running previous task !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#c7df19",
                                        cancelButtonColor: "#383838",
                                        confirmButtonText: "Yes"
                                    }).then(function(result) {
                                        if (result.value) {
                                            // AJAX request
                                            var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                            if (elements) {
                                                var counter = elements.textContent.trim();
                                            }
                                            clearInterval(interval);
                                            clearInterval(interval_new);

                                            $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                            $.ajax({
                                                url: base_url + 'front/timer_update_new',
                                                type: 'POST',
                                                data: {
                                                    id: flag_id,
                                                    counter: counter
                                                },
                                                success: function(data) {

                                                }
                                            });
                                            var span = document.querySelector('.timerBtn_' + flag_id);
                                            // Get the parent div of the span
                                            var parentDiv = span.closest('.card');
                                            // Add a class to the parent div
                                            parentDiv.classList.remove('timer-continue');

                                            $('#timer_flag_poup' + flag_id).val('0');
                                            $('#timer_started_popup_' + flag_id).val('0');
                                            $('#timer_started_label').val('0');
                                            isRunning = false;
                                            toggleTimer5(id);
                                        }
                                    });
                                } else {

                                    if (sflag == '1') {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You want to stop running task !",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#c7df19",
                                            cancelButtonColor: "#383838",
                                            confirmButtonText: "Yes"
                                        }).then(function(result) {
                                            if (result.value) {
                                                // AJAX request
                                                console.log('action success');
                                                SubtaskTimer4(sid);
                                            }
                                        });
                                    } else if (flag == '1') {
                                        console.log('success1')
                                    }
                                }
                            }
                        }
                        if (flag == '1') {
                            
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to stop running previous task !",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#c7df19",
                                cancelButtonColor: "#383838",
                                confirmButtonText: "Yes"
                            }).then(function(result) {
                                if (result.value) {
                                    // AJAX request
                                    var elements = document.querySelector('.counter_' + flag_id + '[data-id="' + flag_id + '"]');
                                    if (elements) {
                                        var counter = elements.textContent.trim();
                                    }
                                    clearInterval(interval);
                                    clearInterval(interval_new);

                                    $('.timerBtn_' + flag_id).html('<i class="bx bx-play-circle timerBtn_' + flag_id + '" onclick="toggleTimer(' + flag_id + ');"></i>');
                                    $.ajax({
                                        url: base_url + 'front/timer_update_new',
                                        type: 'POST',
                                        data: {
                                            id: flag_id,
                                            counter: counter
                                        },
                                        success: function(data) {

                                        }
                                    });
                                    var span = document.querySelector('.timerBtn_' + flag_id);
                                    // Get the parent div of the span
                                    var parentDiv = span.closest('.card');
                                    // Add a class to the parent div
                                    parentDiv.classList.remove('timer-continue');
                                    $('#timer_flag_new' + flag_id).val('0');
                                    $('#timer_started_' + flag_id).val('0');
                                    $('#timer_started_popup_' + flag_id).val('0');
                                    $('#timer_started_label').val('0');
                                    isRunning = false;
                                    SubtaskTimer4(sid);
                                } else {
                                    console.log('action failed');
                                }
                            });

                        }
                    }
                }

            }, 2000);
        }
    });
}

function SubtaskTimer7(spid) {
  var dataSPIdValue = spid;
  var elements_stask = document.querySelector('.counter_label_' + dataSPIdValue + '[data-id="' + dataSPIdValue + '"]');
  if (elements_stask) {
      var counter_stask = elements_stask.textContent.trim();
  }
  digits_stask = String(counter_stask).split(":"); // Split the string at each colon
  hour_subtask = digits_stask[0]; // "00"
  minute_subtask = digits_stask[1]; // "00"
  second_subtask = digits_stask[2]; // "02"
  if (hour_subtask) {
      hours_subtask = hour_subtask;
  } else {
      hours_subtask = 0;
  }
  if (minute_subtask) {
      minutes_subtask = minute_subtask;
  } else {
      minutes_subtask = 0;
  }

  if (second_subtask) {
      seconds_subtask = second_subtask;
  } else {
      seconds_subtask = 0;
  }

  var page = location.pathname.split('/')[2];

if (page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "subtasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search")
{
if (document.querySelector('.timerSBtn_' + dataSPIdValue)) {
  // Class exists
  var span = document.querySelector('.timerSBtn_' + dataSPIdValue);
  // Get the parent div of the span
  var parentDiv = span.closest('.card');
  // Add a class to the parent div
  if(parentDiv){
    // Add a class to the parent div
 parentDiv.classList.add('timer-continue');
 }
}
else if (document.querySelector('.timerSBtn_new_' + dataSPIdValue)) {
  // Class exists
  var span = document.querySelector('.timerSBtn_new_' + dataSPIdValue);
  // Get the parent div of the span
  var parentDiv = span.closest('.card');
  if(parentDiv){
     // Add a class to the parent div
  parentDiv.classList.add('timer-continue');
  }
 
}

} else {
}

interval_subtask = setInterval(() => {
  updateSTimer(dataSPIdValue);
}, 1000);
}

function updateSTimer(sid) {

    seconds_subtask++;
    if (seconds_subtask >= 60) {
        seconds_subtask = 0;
        minutes_subtask++;
        if (minutes_subtask >= 60) {
            minutes_subtask = 0;
            hours_subtask++;
            if (hours_subtask >= 24) {
                hours_subtask = 0;
            }
        }
    }

    
    // Check if the class exists
    if (document.querySelector('.countersubtask_modal_' + sid)) {
        // Class exists
        var formattedTime2_subtask = formatTime(hours_subtask, minutes_subtask, seconds_subtask);
        document.querySelector('.countersubtask_modal_' + sid + '[data-id="' + sid + '"]').textContent = formattedTime2_subtask;

    }
   if (document.querySelector('.counter_label_' + sid)) {
      // Class exists
      var formattedTime2_subtask = formatTime(hours_subtask, minutes_subtask, seconds_subtask);
      document.querySelector('.counter_label_' + sid + '[data-id="' + sid + '"]').textContent = formattedTime2_subtask;

  }

  var formattedTime_subtask = formatTime(hours_subtask, minutes_subtask, seconds_subtask);
    document.querySelector('.countersubtask_' + sid + '[data-id="' + sid + '"]').textContent = formattedTime_subtask;

}

var hours2_subtask;
var minutes2_subtask;
var seconds2_subtask;


function formatTime(hours, minutes, seconds) {
    var paddedHours = hours.toString().padStart(2, '0');
    var paddedMinutes = minutes.toString().padStart(2, '0');
    var paddedSeconds = seconds.toString().padStart(2, '0');
    return `${paddedHours}:${paddedMinutes}:${paddedSeconds}`;
}

function formatTime2(hours2, minutes2, seconds2) {
    var paddedHours2 = hours2.toString().padStart(2, '0');
    var paddedMinutes2 = minutes2.toString().padStart(2, '0');
    var paddedSeconds2 = seconds2.toString().padStart(2, '0');
    return `${paddedHours2}:${paddedMinutes2}:${paddedSeconds2}`;
}

function CheckTimer() {
    $('#floatButton').hide();
    $.ajax({
        url: base_url + 'front/get_flag_on',
        type: 'POST',
        success: function(data) {
            var data = JSON.parse(data);
            if (data == false) {
                clearInterval(interval);
                clearInterval(interval_new);
            } else {
                for (var j = 0; j < data.length; j++) {
                    var flag = data[j].flag;
                    var sflag = data[j].sflag;
                    var tname = data[j].tname;
                    var flag_id = data[j].tid;
                    var sflag_id = data[j].stid;
                    var sflag = data[j].sflag;

                    var start_timer_new = data[j].start_timer_new;
                    var start_timer = data[j].start_timer;
                    var tracked_time = data[j].tracked_time;

                    var start_stimer_new = data[j].start_stimer_new;
                    var start_stimer = data[j].start_stimer;
                    var tracked_stime = data[j].tracked_stime;


                    if (flag == '1') {

                        var elements = document.querySelector('#timer_started_label');
                        elements.setAttribute('data-id', flag_id);
                        $('#timer_started_label').val(flag);
                        console.log(start_timer);

                        if (flag === '1') {
                            let old_time_task;
                            if (start_timer_new !== '' || start_timer_new == 'NUll') {
                                // Old time
                                old_time_task = start_timer_new;
                            } else {
                                old_time_task = start_timer;

                            }

                            var options = {
                                timeZone: 'America/New_York'
                            };
                            var currentDate = new Date().toLocaleDateString('en-US', options);
                            var currentTime = new Date().toLocaleTimeString('en-US', options);
                            var currentDateTime = currentDate + ' ' + currentTime;

                            const startDate = new Date(old_time_task);
                            const endDate = new Date(currentDateTime);

                            // Calculate the time difference in milliseconds
                            const diffMilliseconds = endDate - startDate;
                            // Convert milliseconds to seconds, minutes, and hours
                            const diffSeconds = Math.floor(diffMilliseconds / 1000);
                            const diffMinutes = Math.floor(diffSeconds / 60);
                            const diffHours = Math.floor(diffMinutes / 60);
                            // Calculate the remaining minutes and seconds
                            const remainingMinutes = diffMinutes % 60;
                            const remainingSeconds = diffSeconds % 60;
                            // Format the difference as "HH:MM:SS"
                            const timer_task = `${String(diffHours).padStart(2, '0')}:${String(remainingMinutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;

                            const time1_task = timer_task;
                            const time2_task = tracked_time;

                            // Step 1: Parse time strings
                            let [h1, m1, s1] = time1_task.split(':').map(Number);
                            let [h2, m2, s2] = time2_task.split(':').map(Number);

                            // Step 2: Convert hours, minutes, and seconds to total seconds
                            let totalSeconds1 = h1 * 3600 + m1 * 60 + s1;
                            let totalSeconds2 = h2 * 3600 + m2 * 60 + s2;

                            // Step 3: Add total seconds
                            let totalSecondsSum = totalSeconds1 + totalSeconds2;

                            // Step 4: Calculate new hours, minutes, and seconds
                            let newHours = Math.floor(totalSecondsSum / 3600);
                            let newMinutes = Math.floor((totalSecondsSum % 3600) / 60);
                            let newSeconds = totalSecondsSum % 60;

                            // Step 5: Format the new time values
                            var timer_task_result = `${newHours}:${newMinutes.toString().padStart(2, '0')}:${newSeconds.toString().padStart(2, '0')}`;

                        } else {
                            let timer_task;
                            if (tracked_time !== '') {
                                timer_task = tracked_time;
                            } else {
                                timer_task = '00:00:00';
                            }
                        }
                        timer_task = timer_task_result.trim();
                        // console.log(timer_task);

                        var digits_label = String(timer_task).split(":"); // Split the string at each colon
                        hour_label = digits_label[0]; // "00"
                        minute_label = digits_label[1]; // "00"
                        second_label = digits_label[2]; // "02"

                        if (hour_label) {
                            hours2 = hour_label;
                        } else {
                            hours2 = 0;
                        }
                        if (minute_label) {
                            minutes2 = minute_label;
                        } else {
                            minutes2 = 0;
                        }

                        if (second_label) {
                            seconds2 = second_label;
                        } else {
                            seconds2 = 0;
                        }

                        $('#floatButton').show();
                        var path = window.location.pathname;
                        var page = location.pathname.split('/')[2];
                        if (page === "portfolio-tasks-list" || page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "tasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search") {
                            $('#floatButton').html('<span class="timerLabelBtn_' + flag_id + '"><i class="bx bx-pause-circle timerLabelBtn_' + flag_id + '"  onclick="toggleTimer(' + flag_id + ');"></i></span><span class="counter_label_' + flag_id + '" counter_label_task " data-id="' + flag_id + '" onclick="return TaskOverviewModal(' + flag_id + ')">' + timer_task + '</span>');
                        } else {
                            $('#floatButton').html('<span class="timerLabelBtn_' + flag_id + '"><i class="bx bx-pause-circle timerLabelBtn_' + flag_id + '"  onclick="CheckTimerOut(' + flag_id + ');"></i></span><span class="counter_label_' + flag_id + '" counter_label_task" data-id="' + flag_id + '"  onclick="return TaskOverviewModal(' + flag_id + ')">' + timer_task + '</span>');
                            toggleTimer6(flag_id);
                        }
                    }
                    if (sflag == '1') {

                        sessionStorage.setItem('keys', sflag);
                        sessionStorage.setItem('keys_id', sflag_id);
                        var values = sessionStorage.getItem('keys');
                        var values_id = sessionStorage.getItem('keys_id');
                        var elementss = document.querySelector('#timer_started_label');
                        elementss.setAttribute('data-id', sflag_id);
                        var elements22 = document.querySelector('#timer_started_label[data-id="' + sflag_id + '"]');
                        $('#timer_started_label').val(values);

                        if (sflag === '1') {
                            let old_time_stask;
                            if (start_stimer_new !== '') {
                                // Old time
                                old_time_stask = start_stimer_new;
                            } else {
                                old_time_stask = start_stimer;
                            }
                            // Get the current time
                            var options_new = {
                                timeZone: 'America/New_York'
                            };
                            var currentSDate = new Date().toLocaleDateString('en-US', options_new);
                            var currentSTime = new Date().toLocaleTimeString('en-US', options_new);
                            var currentsDateTime = currentSDate + ' ' + currentSTime;


                            const startsDate = new Date(old_time_stask);
                            const endsDate = new Date(currentsDateTime);
                            // Calculate the time difference in milliseconds
                            const diffsMilliseconds = endsDate - startsDate;
                            // Convert milliseconds to seconds, minutes, and hours
                            const diffsSeconds = Math.floor(diffsMilliseconds / 1000);
                            const diffsMinutes = Math.floor(diffsSeconds / 60);
                            const diffsHours = Math.floor(diffsMinutes / 60);
                            // Calculate the remaining minutes and seconds
                            const remainingsMinutes = diffsMinutes % 60;
                            const remainingsSeconds = diffsSeconds % 60;
                            // Format the difference as "HH:MM:SS"
                            const timer_stask = `${String(diffsHours).padStart(2, '0')}:${String(remainingsMinutes).padStart(2, '0')}:${String(remainingsSeconds).padStart(2, '0')}`;

                            const time1_stask = timer_stask;
                            const time2_stask = tracked_stime;
                            console.log(tracked_stime);

                            // Step 1: Parse time strings
                            let [hs1, ms1, ss1] = time1_stask.split(':').map(Number);
                            let [hs2, ms2, ss2] = time2_stask.split(':').map(Number);

                            // Step 2: Convert hours, minutes, and seconds to total seconds
                            let totalsSeconds1 = hs1 * 3600 + ms1 * 60 + ss1;
                            let totalsSeconds2 = hs2 * 3600 + ms2 * 60 + ss2;

                            // Step 3: Add total seconds
                            let totalsSecondsSum = totalsSeconds1 + totalsSeconds2;

                            // Step 4: Calculate new hours, minutes, and seconds
                            let newsHours = Math.floor(totalsSecondsSum / 3600);
                            let newsMinutes = Math.floor((totalsSecondsSum % 3600) / 60);
                            let newsSeconds = totalsSecondsSum % 60;

                            // Step 5: Format the new time values
                            var timer_stask_result = `${newsHours}:${newsMinutes.toString().padStart(2, '0')}:${newsSeconds.toString().padStart(2, '0')}`;
                            console.log(timer_stask_result);

                        } else {
                            let timer_stask;
                            if (tracked_stime !== '') {
                                timer_stask = tracked_stime;
                            } else {
                                timer_stask = '00:00:00';
                            }
                        }
                        timer_stask = timer_stask_result.trim();

                        var digits_slabel = String(timer_stask).split(":"); // Split the string at each colon
                        hour_slabel = digits_slabel[0]; // "00"
                        minute_slabel = digits_slabel[1]; // "00"
                        second_slabel = digits_slabel[2]; // "02"
                        if (hour_slabel) {
                            hours2 = hour_slabel;
                        } else {
                            hours2 = 0;
                        }
                        if (minute_slabel) {
                            minutes2 = minute_slabel;
                        } else {
                            minutes2 = 0;
                        }

                        if (second_slabel) {
                            seconds2 = second_slabel;
                        } else {
                            seconds2 = 0;
                        }

                        $('#floatButton').show();
                        var path = window.location.pathname;
                        var page = location.pathname.split('/')[2];
                        if (page === "portfolio-tasks-list" || page === "all-tasks-filter" || page === "all-tasks" || page === "portfolio_tasks" || page === "portfolio_tasks_filter" || page === "project-tasks-filter-list" || page === "project-tasks-list" || page === "tasks-filter-list" || page === "tasks-list" || page === "subtasks-overview" || page === "team-member-tasks-filter-list" || page === "today-tasks" || page === "team-member-tasks-list" || page === "week-tasks" || page === "tasks-date-filter-search") {
                            $('#floatButton').html('<span class="timerLabelBtn_' + sflag_id + '"><i class="bx bx-pause-circle timerLabelBtn_' + sflag_id + '"  onclick="SubtaskTimer(' + sflag_id + ');"></i></span><span class="counter_label_' + sflag_id + '" counter_label_task" data-id="' + sflag_id + '" onclick="return SubtaskOverviewModal(' + sflag_id + ')" >' + timer_stask + '</span>');
                        } else {
                            $('#floatButton').html('<span class="timerLabelBtn_' + sflag_id + '"><i class="bx bx-pause-circle timerLabelBtn_' + sflag_id + '"  onclick="CheckSTimerOut(' + sflag_id + ');"></i></span><span class="counter_label_' + sflag_id + '" counter_label_task" data-id="' + sflag_id + '" onclick="return SubtaskOverviewModal(' + sflag_id + ')">' + timer_stask + '</span>');
                            SubtaskTimer7(sflag_id);
                        }
                    }
                }
            }
        }
    });
}
CheckTimer();

function CheckTimerOut(id) {
    var dataIdValue = id;
    var elements = document.querySelector('.counter_label_' + dataIdValue + '[data-id="' + dataIdValue + '"]');

    if (elements) {
        var counter = elements.textContent.trim();
    }

    Swal.fire({
        title: "Are you sure?",
        text: "You want to stop running task !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c7df19",
        cancelButtonColor: "#383838",
        confirmButtonText: "Yes"
    }).then(function(result) {
        if (result.value) {
            clearInterval(interval);
            clearInterval(interval_new);
            $('#floatButton').hide();
            // $('.timerBtn_'+dataIdValue).html('<i class="bx bx-play-circle timerBtn_'+dataIdValue+'" onclick="toggleTimer('+id+');"></i>');  
            $.ajax({
                url: base_url + 'front/timer_update',
                type: 'POST',
                data: {
                    id: id,
                    counter: counter,
                    sales1: 'sale1'
                },
                success: function(data) {
                    if (data) {}
                }
            });
            
            isRunning = !isRunning;
        }
    });


}

function CheckSTimerOut(sid) {
    var dataSIdValue = sid;
    var elements = document.querySelector('.counter_label_' + dataSIdValue + '[data-id="' + dataSIdValue + '"]');

    if (elements) {
        var counter = elements.textContent.trim();
    }

    Swal.fire({
        title: "Are you sure?",
        text: "You want to stop running subtask !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c7df19",
        cancelButtonColor: "#383838",
        confirmButtonText: "Yes"
    }).then(function(result) {
        if (result.value) {
            clearInterval(interval_subtask);
            clearInterval(interval_subtask_new);

            $('#floatButton').hide();
            $.ajax({
                url: base_url + 'front/subtask_timer_update',
                type: 'POST',
                data: {
                    id: sid,
                    subtask_counter: counter
                },
                success: function(data) {
                    if (data) {}
                }
            });
            isRunning_subtask = !isRunning_subtask;

        }
    });


}

// End task time tracking Functions//

// Start Community Functions//

function callRequest(expert_approval,cid){   
  if(expert_approval =='1'){
   Swal.fire({
    title: "Are you sure?",
    text: "You want to Accept this Call Request!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#c7df19",
    cancelButtonColor: "#383838",
    confirmButtonText: "Yes"
    }).then(function (result) {
        if (result.value) {
          // AJAX request
           $.ajax({
            url:  base_url+'front/acceptCallRequest',
            type: 'post',
            data: {expert_approval:expert_approval, cid:cid},
            success: function(data){ 
              Swal.fire("Accepted!", "Successfully.", "success");
              window.location.reload();
            }
          });
        }
    });  
  }else if(expert_approval =='0'){
    Swal.fire({
      title: "Are you sure you want to Decline this Call Request?",
      text: "Reason Please",
      input: 'textarea',
      showCancelButton: true,
      confirmButtonText: 'Submit',
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
    }).then(function (reason) {
      if (reason.value) {
          var reason = reason.value;
        $.ajax({
          url:  base_url+'front/rejectCallRequest',
          type: 'post',
          data: {expert_approval:expert_approval, cid:cid, reason:reason}, 
          success: function(data){
            //debugger; 
            console.log(data);
            Swal.fire("Declined!", "Successfully.", "success");
            window.location.reload();
          }
        });
      }
    }) 
  }         
}

function expertApproveNotificationClearYes(id){  
  var id = id;
  var ncnt = $('#get_notify_cnt_val').val();
  // AJAX request
  $.ajax({
    url:  base_url+'front/expertApproveNotificationClearYes',
    type: 'post',
    data: {id: id},
    success: function(data){
      $('#aecy'+id).remove(); 
      var new_ncnt = ncnt - 1;
      $('#get_notify_cnt_val').val(new_ncnt);
      $('#notify_cnt_val').html(new_ncnt);
      $("#fix_notification_box").addClass("show");
    }
  });
}

function cancelBooking(cid)
{   
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Cancel Booking",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/cancel_call_booking',
              type: 'post',
              data: {cid: cid},
              success: function(data){ 
                Swal.fire("Cancelled", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

// End Community Functions//

//////////corporate section////////////

function create_personal_account(){ 
Swal.fire({
      title: "Do you want to create personal account",
      text: "then click on logout",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Logout & Create"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/create_personal_account',
              type: 'post',
              success: function(html){ 
                window.location = base_url+'register';
              }
            });
          }
      }); 
}

function switch_to_personal_account(){ 
Swal.fire({
      title: "Do you want to switch personal account",
      text: "then click on logout",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Logout"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/switch_to_personal_account',
              type: 'post',
              success: function(html){ 
                window.location = base_url+'login';
              }
            });
          }
      }); 
}

//////////corporate section////////////

// request to preview files if view only selected in role

function file_preview_access_req(pid) 
{   
  var pid = pid; 
    Swal.fire({
      title: "Preview permission not granted!",
      text: "Do you want to send request to grant permission?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/file_preview_access_req',
              type: 'post',
              data: {pid: pid},
              success: function(data){ 
                if(data.status == true)
                {
                  window.location.reload();
                }
              }
            });
          }
      });       
}

function FilePreviewPermissionNotificationModal(id){           
         var id = id;
         // AJAX request
         $.ajax({
          url:  base_url+'front/FilePreviewPermissionNotificationModal_Modal',
          type: 'post',
          data: {id: id},
          success: function(data){ 
            // Add response in Modal body
            console.log(data);
            $('#FilePreviewPermissionNotificationModal_content').html(data);
            // Display Modal
            $('#FilePreviewPermissionNotificationModal').modal('show'); 
          }
        });
       }

function FilePreviewPermissionReqClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/FilePreviewPermissionReqClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('#fppnc'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

function FilePreviewPermissionRespClearYes(id){     
//debugger;       
         var id = id;
         var ncnt = $('#get_notify_cnt_val').val();
         // AJAX request
         $.ajax({
          url:  base_url+'front/FilePreviewPermissionRespClearYes',
          type: 'post',
          data: {id: id},
          success: function(data){
          $('.fpprncc'+id).remove(); 
          var new_ncnt = ncnt - 1;
          $('#get_notify_cnt_val').val(new_ncnt);
          $('#notify_cnt_val').html(new_ncnt);
          $("#fix_notification_box").addClass("show");
          }
        });
       }

// request to preview files if view only selected in role

function NoteNotificationClearYes(id){ 
  //debugger;          
  var id = id;
  var n_cnt = $('#get_notify_cnt_val').val();
  // AJAX request
  $.ajax({
    url:  base_url+'front/NoteNotificationClearYes',
    type: 'post',
    data: {id: id},
    success: function(data){
    // debugger;
    $('#notclr'+id).remove(); 
    var new_notecnt = n_cnt - 1;
    $('#get_notify_cnt_val').val(new_notecnt);
    $('#notify_cnt_val').html(new_notecnt);
    $("#fix_notification_box").addClass("show");
    }
  });
}

function noteRedirectView(id,aid) {
  var myID = id; // Replace "example" with your actual value
  var aID = aid; // Replace "example" with your actual value
//   const myArray = [myID];

// // Using array destructuring to fetch the values into two different variables
// const [variable1, variable2] = myArray;

// console.log(variable1); // Output: 5
// console.log(variable2); // Output: 2
  console.log(myID);
  console.log(aID);

  // var url5 = `notes-list?data=${encodeURIComponent(myID,aID)}`;
  var url5 = `notes-list?data=${encodeURIComponent(`myID=${myID}&aID=${aID}`)}`;

  console.log(url5);

    window.location.href = url5; 
}

function taskTrack() {
  // debugger;   
  var check_new_value = $('#track_value_get').val();
  if (check_new_value == 'true') {
    $('#track_value_get').val("false");
    $('#taskTrack').show();
  } else {
    $('#taskTrack').hide();
    $('#track_value_get').val("true");
    $('#estimated_time').val("");
  }
}
function subtaskTrack(id) {
  // debugger;   
  var check_new_value = $('#strack_value_get'+id).val();
  if (check_new_value == 'true') {
    $('#strack_value_get'+id).val("false");
    $('#staskTrack'+id).show();
  } else {
    $('#staskTrack'+ id).hide();
    $('#strack_value_get'+id).val("true");
    $('#estimated_stime'+id).val("");
    // $('#estimated_stime'+ id).val("");
  }
}