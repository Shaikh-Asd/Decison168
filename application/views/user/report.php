<?php
   $page = 'report';
   $user_id = $this->session->userdata('d168_id');
   $student = $this->Front_model->getStudentById($user_id);
   $stds= $student->email_address;
   $stdsid= $student->reg_id;
   ?>
<!doctype html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8" />
      <title>My Report</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
      <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
      <!-- tui charts Css Content -->
      <link href="<?php echo base_url();?>assets/libs/tui-chart/tui-chart.min.css" rel="stylesheet" type="text/css" />
      <?php
         include('header_links.php');
         ?>
   </head>
   <style media="screen">
      #lineChart {
      height: 350px !important;
      }
      #lineChart_subtask {
      height: 350px !important;
      }
   </style>
   <body data-sidebar="dark">
      <!-- Begin page -->
      <div id="layout-wrapper">
         <?php
            include('header.php');
            include('sidebar.php');
            ?>
         <?php
            $count_cp = $this->Front_model->count_portfolio_Userproject($getp->portfolio_id);
                if($count_cp)
                {
                  $project = $count_cp['count_rows'];
                }
            
               $count_ccp = $this->Front_model->count_portfolio_project_Usercontent($getp->portfolio_id);
                 if($count_ccp)
                 {
                     $content = $count_ccp['count_rows'];
                 }
            
                $count_ct = $this->Front_model->count_Portfolio_Usertask($getp->portfolio_id);
                    if($count_ct)
                    {
                      $task = $count_ct['count_rows'];
                    }
            
                   $count_gl = $this->Front_model->count_Usergoals($getp->portfolio_id);
                       if($count_gl)
                       {
                         $goal = $count_gl['count_rows'];
                       }
            
                //
                //        $count_active = $this->Front_model->get_active_port_Userreport($getp->portfolio_id,$stds);
                //
                //           if($count_active)
                //           {
                //               $active = $count_active['count_rows'];
                //           }
                // $count_inactive = $this->Front_model->get_inactive_port_report($getp->portfolio_id,$stds);
                //     if($count_inactive)
                //     {
                //         $inactive = $count_inactive['count_rows'];
                //     }
            ?>
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="text-left">
<?php 
if($privilege_only_view == 'no')
{
?>
                        <button type="button" class="btn btn-d btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Generate Report
                        </button>
                        <button type="button" class="btn btn-d btn-sm"  data-bs-toggle="modal" data-bs-target="#reportList" style="margin-left: 20px;">
                        Report List
                        </button>
<?php
}
?> 
                        <!-- </div> -->
                        <!-- <div class="col-md-2">
                           <button type="button" class="btn btn-d btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                           Generate Report
                           </button>
                           </div>
                           <div class="col-md-8">
                           <button type="button" class="btn btn-d btn-sm"  data-bs-toggle="modal" data-bs-target="#reportList">
                           Report List
                           </button>
                           </div> -->
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                        <!-- <div class="col-md-2" style="padding: 0px"> -->
                        <i class="mdi mdi-filter float-end h3 mt-1" style="cursor: pointer;" onclick="return show_FilterChart();"></i>
                        <div class="modal bs-example-modal-lg filtercollapse" style="display: none;">
                           <div class="modal-dialog " style="max-width: 850px;">
                              <div class="modal-content">
                                 <div class="modal-body">
                                    <button type="button" class="btn-close float-end" onclick="$('.filtercollapse').css('display','none');"></button>
                                    <div class="row">
                                       <div class="col-xl">
                                          <div class="mt-4 mt-xl-0">
                                             <div class="docs-options">
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="all" checked>
                                                      <label class="form-check-label">All</label>
                                                   </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="content">
                                                      <label class="form-check-label">Content</label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xl">
                                          <div class="mt-4 mt-xl-0">
                                             <div class="docs-options">
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="portfolio">
                                                      <label class="form-check-label">Portfolio</label>
                                                   </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="team_performance">
                                                      <label class="form-check-label">My Work</label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xl">
                                          <div class="mt-4 mt-xl-0">
                                             <div class="docs-options">
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="project">
                                                      <label class="form-check-label">Project</label>
                                                   </div>
                                                </div>
                                                <!-- <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="portfolio_member">
                                                      <label class="form-check-label">Portfolio Member</label>
                                                   </div>
                                                   </div> -->
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="department">
                                                      <label class="form-check-label">Department</label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xl">
                                          <div class="mt-4 mt-xl-0">
                                             <div class="docs-options">
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="task">
                                                      <label class="form-check-label">Task</label>
                                                   </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="goal">
                                                      <label class="form-check-label">Goal</label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xl">
                                          <div class="mt-4 mt-xl-0">
                                             <div class="docs-options">
                                                <div class="input-group mb-3">
                                                   <div class="text-center">
                                                      <input class="form-check-input" type="radio" name="myReport" id="myReport" value="subtask">
                                                      <label class="form-check-label">Sub Task</label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        <!-- </div> -->
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <!-- <div class="col-xl-6"> -->
                     <!--end card-->
                     <!-- </div> -->
                     <div class="col-xl-12" id="ind_hide">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-xl-6" >
                                    <h4 class="card-title mb-4">My Work</h4>
                                 </div>
                                 <input type="hidden" id="selected_user"  value="<?php echo $user_id; ?>">
                                 <!-- <div class="col-xl-6">
                                    <select class="form-control " name="" id="selected_user"  required="">
                                       <?php $porttm = $this->Front_model->getAccepted_PortTM($getp->portfolio_id);
                                       if($porttm)
                                       {
                                           foreach($porttm as $ptm)
                                           {
                                               $pm = $this->Front_model->selectLogin($ptm->sent_to);
                                               if($pm)
                                               {
                                                  ?>
                                       <option  value="<?php echo $pm->reg_id;?>" ><?php echo $pm->first_name.' '.$pm->last_name?></option>
                                       <?php
                                       }
                                       }
                                       }
                                       ?>
                                    </select>
                                    </div> -->
                              </div>
                              <div class="row">
                                 <div class="col-2">
                                    <h5 class="mb-0" id="memPro"></h5>
                                    <p class="text-muted text-truncate">Project</p>
                                 </div>
                                 <div class="col-2">
                                    <h5 class="mb-0" id="memCnt"></h5>
                                    <p class="text-muted text-truncate">Content Project</p>
                                 </div>
                                 <div class="col-2">
                                    <h5 class="mb-0" id="memTask"></h5>
                                    <p class="text-muted text-truncate">Task</p>
                                 </div>
                                 <div class="col-2">
                                    <h5 class="mb-0" id="memGaol"></h5>
                                    <p class="text-muted text-truncate">Goal</p>
                                 </div>
                                 <div class="col-2">
                                    <h5 class="mb-0" id="memDep"></h5>
                                    <p class="text-muted text-truncate">Department</p>
                                 </div>
                                 <!-- <div class="col-2">
                                    <h5 class="mb-0" id="memScl"></h5>
                                    <p class="text-muted text-truncate">Social Content</p>
                                    </div> -->
                              </div>
                              <div id="column_chart" class="apex-charts" dir="ltr"></div>
                           </div>
                        </div>
                        <!--end card-->
                     </div>
                  </div>
                  <!-- <div class="row">
                     <div class="col-xl-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-xl-6">
                                    <h4 class="card-title mb-4">Content</h4>
                                 </div>
                                 <div class="col-xl-6">
                                    <select class="form-control " name="" id="selected_content" required="">
                                       <?php
                        $get_cntPl = $this->Front_model->portfolio_UserContent($getp->portfolio_id,$stdsid);
                         if($get_cntPl){
                             foreach ($get_cntPl as $plncnt) {
                               ?>
                                       <option  value="<?php echo $plncnt->pid;?>" ><?php echo $plncnt->pname;?></option>
                                       <?php
                        }
                        }
                        ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-4">
                                    <h5 class="mb-0" id="cntScl"></h5>
                                    <p class="text-muted text-truncate">Social Content</p>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="mb-0" id="cnttask"></h5>
                                    <p class="text-muted text-truncate">Task</p>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="mb-0" id="cntteam"></h5>
                                    <p class="text-muted text-truncate">Team</p>
                                 </div>
                              </div>
                              <div id="area-charts" dir="ltr"></div>
                           </div>
                        </div>
                     </div>
                      end col -->
               </div>
               <!-- end row -->
               <div class="row" id="dept_hide">
                  <div class="col-xl-12">
                     <!-- <div class="card">
                        <div class="card-body">
                           <div class="row text-center">
                              <input type="hidden" id="active" value="<?php echo $active ?>">
                              <input type="hidden" id="inactive" value="<?php echo $inactive ?>">
                              <div class="col-4">
                                 <h4 class="card-title mb-4">Portfolio member</h4>
                              </div>
                              <div class="col-4">
                                 <h5 class="mb-0"><?php echo $active ?></h5>
                                 <p class="text-muted text-truncate">Activated</p>
                              </div>
                              <div class="col-4">
                                 <h5 class="mb-0"><?php echo $inactive ?></h5>
                                 <p class="text-muted text-truncate">Deactivated</p>
                              </div>
                           </div>
                           <canvas id="doughnut" height="260"></canvas>
                        </div>
                        </div> -->
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-xl-6">
                                 <h4 class="card-title mb-4">Department</h4>
                              </div>
                              <div class="col-xl-6">
                                 <select class="form-control " name="" id="selected_depart"  required="">
                                    <?php
                                       $get_dpt = $this->Front_model->portfolio_UserDepartment($getp->portfolio_id,$stdsid);
                                        if($get_dpt){
                                            foreach ($get_dpt as $td) {
                                              ?>
                                    <option  value="<?php echo $td->portfolio_dept_id;?>" ><?php echo $td->department;?></option>
                                    <?php
                                       }
                                       }
                                       
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-3">
                                 <h5 class="mb-0" id="depPro"></h5>
                                 <p class="text-muted text-truncate">Project</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="depCnt"></h5>
                                 <p class="text-muted text-truncate">Content Planner</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="depTask"></h5>
                                 <p class="text-muted text-truncate">Task</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="depGaol"></h5>
                                 <p class="text-muted text-truncate">Goal</p>
                              </div>
                           </div>
                           <div id="mixed_chart" class="apex-charts" dir="ltr"></div>
                        </div>
                     </div>
                  </div>
                  <!-- end col -->
               </div>
               <!-- end row -->
               <div class="row">
                  <div class="col-xl-6" id="port_hide">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title mb-4"> Portfolio</h4>
                           <div id="donut-chart-portfolio" dir="ltr"></div>
                           <input type="hidden" id="project" value="<?php echo $project ?>">
                           <input type="hidden" id="content" value="<?php echo $content ?>">
                           <input type="hidden" id="task" value="<?php echo $task ?>">
                           <input type="hidden" id="goal" value="<?php echo $goal ?>">
                           <input type="hidden" id="portfolio_id" value="<?php echo $getp->portfolio_id ?>">
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6" id="goal_hide">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-xl-6">
                                 <h4 class="card-title mb-4">Goals and Strategies</h4>
                              </div>
                              <div class="col-xl-6">
                                 <select class="form-control " name="" id="selected_goal" required="">
                                    <?php
                                       $get_dpt = $this->Front_model->portfolio_Usergoals($getp->portfolio_id,$stdsid);
                                        if($get_dpt){
                                            foreach ($get_dpt as $td) {
                                              ?>
                                    <option  value="<?php echo $td->gid;?>" ><?php echo $td->gname;?></option>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-3">
                                 <h5 class="mb-0" id="gaolKPI"></h5>
                                 <p class="text-muted text-truncate">KPI's</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="goalPro"></h5>
                                 <p class="text-muted text-truncate">Project</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="goalCnt"></h5>
                                 <p class="text-muted text-truncate">Content Project</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="goalTask"></h5>
                                 <p class="text-muted text-truncate">Task</p>
                              </div>
                           </div>
                           <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <!-- end col -->
                  <div class="col-xl-6" id="cnt_hide">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-xl-6">
                                 <h4 class="card-title mb-4">Content</h4>
                              </div>
                              <div class="col-xl-6">
                                 <select class="form-control " name="" id="selected_content" required="">
                                    <?php
                                       $get_cntPl = $this->Front_model->portfolio_UserContent($getp->portfolio_id,$stdsid);
                                        if($get_cntPl){
                                            foreach ($get_cntPl as $plncnt) {
                                              ?>
                                    <option  value="<?php echo $plncnt->pid;?>" ><?php echo $plncnt->pname;?></option>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <!-- <div class="col-4">
                                 <h5 class="mb-0" id="cntScl"></h5>
                                 <p class="text-muted text-truncate">Social Content</p>
                                 </div> -->
                              <div class="col-4">
                                 <h5 class="mb-0" id="cnttask"></h5>
                                 <p class="text-muted text-truncate">Task</p>
                              </div>
                              <div class="col-4">
                                 <h5 class="mb-0" id="cntteam"></h5>
                                 <p class="text-muted text-truncate">Team</p>
                              </div>
                           </div>
                           <div id="area-charts" dir="ltr"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6" id="prjt_hide">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-xl-6">
                                 <h4 class="card-title mb-4">Project</h4>
                              </div>
                              <div class="col-xl-6">
                                 <select class="form-control " name="" id="selected_project" required="">
                                    <?php
                                       $get_dpt = $this->Front_model->portfolio_Userprojects($getp->portfolio_id,$stdsid);
                                        if($get_dpt){
                                            foreach ($get_dpt as $td) {
                                              ?>
                                    <option  value="<?php echo $td->pid;?>" ><?php echo $td->pname;?></option>
                                    <?php
                                       }
                                       }
                                       
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-4">
                                 <h5 class="mb-0" id="protask"></h5>
                                 <p class="text-muted text-truncate">Task</p>
                              </div>
                              <div class="col-4">
                                 <h5 class="mb-0" id="proteam"></h5>
                                 <p class="text-muted text-truncate">Team</p>
                              </div>
                           </div>
                           <div id="spline_area" class="apex-charts" dir="ltr"></div>
                        </div>
                     </div>
                     <!--end card-->
                  </div>
                  <!-- end col -->
               </div>
               <!-- end row -->
               <div class="row">
                  <div class="col-xl-6"  id="tsk_hide">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title mb-4">Task</h4>
                           <div class="row text-center">
                              <div class="col-3">
                                 <h5 class="mb-0" id="task_todo"></h5>
                                 <p class="text-muted text-truncate">To DO</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="task_prog"></h5>
                                 <p class="text-muted text-truncate">Pending</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="task_rev"></h5>
                                 <p class="text-muted text-truncate">Review</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="task_done"></h5>
                                 <p class="text-muted text-truncate">Done</p>
                              </div>
                           </div>
                           <canvas id="lineChart" height="300"></canvas>
                        </div>
                     </div>
                  </div>
                  <!-- end col -->
                  <div class="col-xl-6" id="stsk_hide">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title mb-4">Sub Task</h4>
                           <div class="row text-center">
                              <div class="col-3">
                                 <h5 class="mb-0" id="subtask_todo"></h5>
                                 <p class="text-muted text-truncate">To DO</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="subtask_prog"></h5>
                                 <p class="text-muted text-truncate">In Progress</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="subtask_rev"></h5>
                                 <p class="text-muted text-truncate">In Review</p>
                              </div>
                              <div class="col-3">
                                 <h5 class="mb-0" id="subtask_done"></h5>
                                 <p class="text-muted text-truncate">Done</p>
                              </div>
                           </div>
                           <canvas id="lineChart_subtask" height="300"></canvas>
                           <!-- <img id="url" /> -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end row -->
            </div>
            <!-- container-fluid -->
         </div>
         <!-- End Page-content -->
         <?php
            include('footer.php');
            ?>
      </div>
      <!-- end main content-->
      </div>
      <!-- Modal -->
<?php 
if($privilege_only_view == 'no')
{
?>
      <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Generate Report</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-xl-1">
                     </div>
                     <div class="col-xl-10">
                        <div class="card-body" id="checkForm">
                           <h3>Sections</h3>
                           <br>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-9">
                                 <div class="form-group">
                                    <div class="input-group mb-3">
                                       <input type="text" name="report_name" id="report_name" class="form-control pl-15" placeholder="Enter Template Name..." required="">
                                    </div>
                                    <span id="templateErr" class="text-danger"></span>
                                    <span id="checkboxErr" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <!--  summary -->
                           <div class="row">
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox_new" name="progress"  type="checkbox" id="summary" value="summary">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bx-food-menu" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Summary</span>
                              </div>
                              <!-- my Work -->
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="my_work" value="my_work">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <i class="bx bxs-user-badge" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">My Work</span>
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <!-- portfolio -->
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio" value="portfolio">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bxs-user-detail" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Portfolio</span>
                              </div>
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_tsk" value="portfolio_tsk">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <i class="bx bx-task" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Task</span>
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"   type="checkbox" id="portfolio_stsk" value="portfolio_stsk">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bx-briefcase-alt-2" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Sub Task</span>
                              </div>
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_cnt" value="portfolio_cnt">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <i class="bx bx-customize" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Content</span>
                              </div>
                              <!-- project -->
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-4"  >
                                 <div id="chkcontent" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <!-- <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab3" id="cntone" onclick="showcontent();" />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li> -->
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab3" id="cnttwo" onclick="showcontent();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                                 <!-- <div id="showContent" style="display:none;">
                                    <select name="" id="sel_cnt" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select contents..." onchange="return selected_cnt();">
                                    <?php
                                       $get_cntPl = $this->Front_model->portfolio_projectsContent($getp->portfolio_id);
                                        if($get_cntPl){
                                            foreach ($get_cntPl as $plncnt) {
                                              ?>
                                       <option  value="<?php echo $plncnt->pid;?>" ><?php echo $plncnt->pname;?></option>
                                       <?php
                                       }
                                       }
                                       ?>
                                    </select>
                                    <input type="hidden" name="selected_multi_cnt" id="selected_multi_cnt">
                                    </div> -->
                              </div>
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-4" >
                                 <div id="showContent" style="display:none;">
                                    <select name="" id="sel_cnt" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select contents..." onchange="return selected_cnt();">
                                       <?php
                                          $get_cntPl = $this->Front_model->portfolio_UserContent($getp->portfolio_id,$this->session->userdata('d168_id'));
                                           if($get_cntPl){
                                               foreach ($get_cntPl as $plncnt) {
                                                 ?>
                                       <option  value="<?php echo $plncnt->pid;?>" ><?php echo $plncnt->pname;?></option>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </select>
                                    <span id="cntErr" class="text-danger"></span>
                                    <input type="hidden" name="selected_multi_cnt" id="selected_multi_cnt">
                                 </div>
                                 <!-- <div id="chkproject" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab4" id="prjtone" onclick="showproject();" />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li>
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab4" id="prjttwo" onclick="showproject();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                    </div> -->
                              </div>
                           </div>
                           <br>
                           <!-- individual member -->
                           <div class="row">
                              <!-- <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_team" value="portfolio_team">
                                 </div>
                                 </div>
                                 <div class="col-md-6">
                                 <i class="bx bx-user" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Team Performance</span>
                                 </div> -->
                              <!-- project -->
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"   type="checkbox" id="portfolio_pjt" value="portfolio_pjt">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bx-briefcase-alt-2" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Project</span>
                              </div>
                              <!-- task -->
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_dept" value="portfolio_dept">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <i class="bx bx-food-menu" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Department</span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-4"  >
                                 <div id="chkteam" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <!-- <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab1" id="teamone" onclick="showteam();" />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li> -->
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab1" id="teamtwo" onclick="showteam();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-4">
                                 <div  id="chkdepartment" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <!-- <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab2" id="deptone" onclick="showdept();"  />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li> -->
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab2" id="depttwo" onclick="showdept();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-4" >
                                 <div id="showProject" style="display:none;">
                                    <!-- <label class="form-check-label">Select Goal</label> -->
                                    <select name="" id="sel_prjt" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select projects..." onchange="return selected_prjt();">
                                       <?php
                                          $get_dpt = $this->Front_model->portProjectList($getp->portfolio_id);
                                          
                                          // $get_dpt = $this->Front_model->portfolio_projectsRegular($getp->portfolio_id);
                                          if($get_dpt){
                                          foreach ($get_dpt as $td) {
                                          ?>
                                       <option  value="<?php echo $td->pid;?>" ><?php echo $td->pname;?></option>
                                       <?php
                                          }
                                          }
                                          
                                          ?>
                                    </select>
                                    <span id="prjtErr" class="text-danger"></span>
                                    <input type="hidden" name="selected_multi_prjt" id="selected_multi_prjt">
                                 </div>
                              </div>
                              <!-- <div class="col-md-1">
                                 </div>
                                 <div class="col-md-4" >
                                    <div id="showTeam" style="display:none;">
                                        <label class="form-check-label">Select Goal</label>
                                       <select name="" id="sel_team" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select members..." onchange="return selected_team();">
                                          <select class="form-control " name="" id="selected_user"  required="">
                                          <?php $porttm = $this->Front_model->getAccepted_PortTM($getp->portfolio_id);
                                    if($porttm)
                                    {
                                        foreach($porttm as $ptm)
                                        {
                                            $pm = $this->Front_model->selectLogin($ptm->sent_to);
                                            if($pm)
                                            {
                                               ?>
                                          <option  value="<?php echo $pm->reg_id;?>" ><?php echo $pm->first_name.' '.$pm->last_name?></option>
                                          <?php
                                    }
                                    }
                                    }
                                    ?>
                                       </select>
                                       <input type="hidden" name="selected_multi_team" id="selected_multi_team">
                                    </div>
                                 </div> -->
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-4" >
                                 <div id="showDept" style="display:none;">
                                    <!-- <label class="form-check-label">Select Goal</label> -->
                                    <select name="" id="sel_dept" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select departments..." onchange="return selected_dept();">
                                       <!-- <select class="form-control " name="" id="selected_depart"  required=""> -->
                                       <?php
                                          $get_dpt = $this->Front_model->portfolio_UserDepartment($getp->portfolio_id,$this->session->userdata('d168_id'));
                                           if($get_dpt){
                                               foreach ($get_dpt as $td) {
                                                 ?>
                                       <option  value="<?php echo $td->portfolio_dept_id;?>" ><?php echo $td->department;?></option>
                                       <?php
                                          }
                                          }
                                          
                                          ?>
                                    </select>
                                    <span id="deptErr" class="text-danger"></span>
                                    <input type="hidden" name="selected_multi_dept" id="selected_multi_dept">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_glstr" value="portfolio_glstr">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bx-bullseye" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Goals and Strategies</span>
                              </div>
                              <!-- project -->
                              <!-- <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"   type="checkbox" id="portfolio_pjt" value="portfolio_pjt">
                                 </div>
                                 </div>
                                 <div class="col-md-4">
                                 <i class="bx bx-briefcase-alt-2" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Project</span>
                                 </div> -->
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-4"  >
                                 <!-- <div id="chkcontent" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab3" id="cntone" onclick="showcontent();" />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li>
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab3" id="cnttwo" onclick="showcontent();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                    </div> -->
                              </div>
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-4" >
                                 <div id="chkproject" style="display:none;">
                                    <ul class="nav nav-pills ">
                                       <!-- <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab4" id="prjtone" onclick="showproject();" />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li> -->
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab4" id="prjttwo" onclick="showproject();" />
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                              </div>
                              <div class="col-md-4" >
                                 <div id="showGoal" style="display:none;">
                                    <!-- <div class="row">
                                       <div class="col-md-1">
                                       </div>
                                       <div class="col-md-4"> -->
                                    <!-- <label class="form-check-label">Select Goal</label> -->
                                    <select name="" id="sel_gl" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select goals..." onchange="return selected_goals();">
                                       <?php
                                          $get_dpt = $this->Front_model->portfolio_Usergoals($getp->portfolio_id,$this->session->userdata('d168_id'));
                                           if($get_dpt){
                                               foreach ($get_dpt as $td) {
                                                 ?>
                                       <option  value="<?php echo $td->gid;?>" ><?php echo $td->gname;?></option>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </select>
                                    <span id="goalErr" class="text-danger"></span>
                                    <input type="hidden" name="selected_multi_gl" id="selected_multi_gl">
                                    <!-- </div>
                                       </div> -->
                                 </div>
                                 <!-- <div id="showContent" style="display:none;">
                                    <select name="" id="sel_cnt" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select contents..." onchange="return selected_cnt();">
                                       <?php
                                       $get_cntPl = $this->Front_model->portfolio_projectsContent($getp->portfolio_id);
                                        if($get_cntPl){
                                            foreach ($get_cntPl as $plncnt) {
                                              ?>
                                       <option  value="<?php echo $plncnt->pid;?>" ><?php echo $plncnt->pname;?></option>
                                       <?php
                                       }
                                       }
                                       ?>
                                    </select>
                                    <input type="hidden" name="selected_multi_cnt" id="selected_multi_cnt">
                                    </div> -->
                              </div>
                              <!-- <div class="col-md-3">
                                 </div>
                                 <div class="col-md-4" >
                                    <div id="showProject" style="display:none;">
                                       <label class="form-check-label">Select Goal</label> 
                                       <select name="" id="sel_prjt" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select projects..." onchange="return selected_prjt();">
                                          <?php
                                    $get_dpt = $this->Front_model->portfolio_projectsRegular($getp->portfolio_id);
                                     if($get_dpt){
                                         foreach ($get_dpt as $td) {
                                           ?>
                                          <option  value="<?php echo $td->pid;?>" ><?php echo $td->pname;?></option>
                                          <?php
                                    }
                                    }
                                    
                                    ?>
                                       </select>
                                       <input type="hidden" name="selected_multi_prjt" id="selected_multi_prjt">
                                    </div>
                                 </div> -->
                           </div>
                           <br>
                           <!-- goal and stratgies -->
                           <!-- <div class="row">
                              <div class="col-md-1">
                                 <div class="form-check form-switch">
                                    <input style="font-size: 20px!important;" class="form-check-input checkbox checkbox_new" name="progress"  type="checkbox" id="portfolio_glstr" value="portfolio_glstr">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <i class="bx bx-bullseye" style="font-size: 24px!important; color:#006e3e"></i>
                                 <span style="font-size: 20px!important; margin-left:15px;">Goals and Strategies</span>
                              </div>
                              <div class="row"  id="chkgoal" style="display:none;">
                                 <div class="col-md-1">
                                 </div>
                                 <div class="col-md-4">
                                    <ul class="nav nav-pills ">
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab5" id="igotone" onclick="showgoal();"  />
                                             <label class="form-check-label">Overall</label>
                                          </div>
                                          </li>
                                       <li class="nav-item me-3">
                                          <div class="text-center">
                                             <input class="form-check-input" type="radio" name="tab5" id="igottwo" onclick="showgoal();"/>
                                             <label class="form-check-label">Selected</label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div id="showGoal" style="display:none;">
                                 <div class="row">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="form-check-label">Select Goal</label>
                                       <select name="" id="sel_gl" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Select goals..." onchange="return selected_goals();">
                                          <?php
                                 $get_dpt = $this->Front_model->portfolio_goalsTrash($getp->portfolio_id);
                                  if($get_dpt){
                                      foreach ($get_dpt as $td) {
                                        ?>
                                          <option  value="<?php echo $td->gid;?>" ><?php echo $td->gname;?></option>
                                          <?php
                                 }
                                 }
                                 ?>
                                       </select>
                                       <input type="hidden" name="selected_multi_gl" id="selected_multi_gl">
                                    </div>
                                 </div>
                              </div>
                              </div>
                              <br> -->
                           <div class="row" id="dateRow" style="display:none;">
                              <div class="col-xl-1">
                              </div>
                              <div class="col-xl-10">
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <label for="">From date</label>
                                          <input type="date"  class="form-control" name="daterangestart" value="" required/>
                                          <span id="daterangestartErr" class="text-danger"></span>
                                       </div>
                                       <div class="col-md-6">
                                          <label for="">To date</label>
                                          <input type="date" class="form-control" name="daterangeend" value="" required/>
                                          <span id="daterangeendErr" class="text-danger"></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- button -->
                           <div class="row">
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-3">
                                 <button type="submit" id="download_pdf" class="btn btn-d btn-sm"> Download Pdf</button>
                              </div>
                              <div class="col-md-3">
                                 <button type="submit" id="download_ppt" class="btn btn-d btn-sm"> Download PPT</button>
                              </div>
                              <div class="col-md-3">
                                 <input type="hidden" id="hide_pdf" value=""/>
                                 <input type="hidden" id="hide_ppt" value=""/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php 
}
?>
      <div class="">
         <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
               <div id="view_goal_chart" class="apex-charts " dir="ltr"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
               <div id="view_prjt_chart" class="apex-charts " dir="ltr"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
               <div id="view_cnt_chart"  dir="ltr">
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
               <!-- <div class="card dtchrt" >
                  <div class="card-body"> -->
               <div id="view_dept_chart"  dir="ltr">
               </div>
               <!-- </div>
                  </div> -->
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
               <div id="view_team_chart"  dir="ltr"></div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="loaderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-top: 5px solid #f7f7f6 !important;">
               <div class="modal-body">
                  <img src="<?php echo base_url();?>/assets/images/page-load-loader.gif" alt="loader" class="loadingif" style="margin-left: 260px; height:300px;">
                  <br>   
                  <h4 style="margin-left: 185px;">Wait for a while your report is generating....</h4>
               </div>
            </div>
         </div>
      </div>
<?php 
if($privilege_only_view == 'no')
{
?>
      <!-- Modal -->
      <div class="modal fade" id="reportList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel"> Report List</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table align-middle table-nowrap table-hover">
                                    <thead class="table-light">
                                       <tr>
                                          <!-- <th scope="col" style="width: 70px;">Sr No</th> -->
                                          <th scope="col"> Template Name</th>
                                          <th scope="col"> Created Date</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          foreach($get_template as $template){
                                          ?>
                                       <tr>
                                          <!-- <td>
                                             <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle">
                                                D
                                                </span>
                                             </div>
                                             </td> -->
                                          <td>
                                             <span class="font-size-14 mb-1"><?php  echo $template->name; ?></span>
                                             <!-- <p class="text-muted mb-0">UI/UX Designer</p> -->
                                          </td>
                                          <td>
                                             <span class="font-size-14 mb-1"><?php  echo $template->created_date; ?></span>
                                          </td>
                                          <td>
                                             <div class="text-center">
                                                <a href="javascript: void(0);" class="nameLink" onclick="return previewUSerFile(<?php echo $template->id;?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
                                                <a href="<?php echo base_url().'front/downloadUserReport/'.$template->id;?>" class="text-dark" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                <a href="javascript:void(0)" onclick="return delete_Userreport(<?php echo $template->id ?>);" class="text-dark" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                             </div>
                                          </td>
                                       </tr>
                                       <?php
                                          }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                              <!-- <div class="row">
                                 <div class="col-lg-12">
                                     <ul class="pagination pagination-rounded justify-content-center mt-4">
                                         <li class="page-item disabled">
                                             <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item">
                                             <a href="javascript: void(0);" class="page-link">1</a>
                                         </li>
                                         <li class="page-item active">
                                             <a href="javascript: void(0);" class="page-link">2</a>
                                         </li>
                                         <li class="page-item">
                                             <a href="javascript: void(0);" class="page-link">3</a>
                                         </li>
                                         <li class="page-item">
                                             <a href="javascript: void(0);" class="page-link">4</a>
                                         </li>
                                         <li class="page-item">
                                             <a href="javascript: void(0);" class="page-link">5</a>
                                         </li>
                                         <li class="page-item">
                                             <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                         </li>
                                     </ul>
                                 </div>
                                 </div> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php 
}
?>
      <!-- Preview file modal content -->
      <div id="previewUserModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewModalFileLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content" id="previewUserFile_content">
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- END layout-wrapper -->
      <!-- JAVASCRIPT -->
      <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      <!-- <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> -->
      <!-- plugin js -->
      <script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
      <script src="<?php echo base_url();?>assets/libs/chart.js/Chart.bundle.min.js"></script>
      <!-- apexcharts -->
      <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>
      <!-- flot plugins Goals and Strategies-->
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.time.js"></script>
      <script src="<?php echo base_url();?>assets/libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.resize.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.pie.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.selection.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.stack.js"></script>
      <script src="<?php echo base_url();?>assets/libs/flot.curvedLines/curvedLines.html"></script>
      <script src="<?php echo base_url();?>assets/libs/flot-charts/jquery.flot.crosshair.js"></script>
      <script src="<?php echo base_url();?>assets/libs/tui-chart/tui-chart-all.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/report.js"></script>
      <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
      <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
      <?php
         include('footer_links.php');
         ?>
   </body>
</html>