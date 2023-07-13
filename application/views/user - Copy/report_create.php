<?php
   $page = 'report_create';
   ?>
<!doctype html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8" />
      <title>Report Create</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
      <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
      <?php
         include('header_links.php');
         ?>
   </head>
   <body data-sidebar="dark">
      <!-- Begin page -->
      <div id="layout-wrapper">
         <?php
            include('header.php');
            include('sidebar.php');
            ?>
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                 <input type="hidden" id="portfolio_id" value="<?php echo $getp->portfolio_id ?>">
                  <div class="row">
                     <div class="col-xl-1">
                     </div>
                     <div class="col-xl-10">
                        <div class="card">
                           <div class="card-body">
                              <h4>Period</h4>
                              <br>
                              <div class="row">
                                 <div class="col-md-4">
                                    <label for="">From date</label>
                                    <input type="date"  class="form-control" name="daterangestart" value="" />
                                 </div>
                                 <div class="col-md-4">
                                    <label for="">To date</label>
                                    <input type="date" class="form-control" name="daterangeend" value="" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-1">
                     </div>
                     <div class="col-xl-10">
                        <div class="card">
                           <div class="card-body">
                              <h3>Sections</h3>
                              <br>
                              <!--  summary -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="summary">
                                    </div>
                                 </div>
                                 <div class="col-xl-2">
                                    <i class="bx bx-food-menu" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Summary</span>
                                 </div>
                              </div>
                              <br>
                              <!-- portfolio -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" value="false" type="checkbox" id="portfolio">
                                    </div>
                                 </div>
                                 <div class="col-xl-2">
                                    <i class="bx bxs-user-detail" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Portfolio</span>
                                 </div>
                              </div>
                              <br>
                              <!-- portfolio member -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="portfolio_member">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bxs-user-badge" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Portfolio Member</span>
                                 </div>
                              </div>
                              <br>
                              <!-- Department -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="portfolio_department">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-food-menu" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Department</span>
                                 </div>
                              </div>
                              <br>
                              <!-- individual member -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="portfolio_member">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-user" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Individual Member</span>
                                 </div>
                              </div>
                              <br>
                              <!-- goal and stratgies -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="portfolio_glstr">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-bullseye" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Goals and Strategies</span>
                                 </div>
                              </div>
                              <br>
                              <!-- content -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" type="checkbox" id="portfolio_cnt">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-customize" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Content</span>
                                 </div>
                              </div>
                              <br>
                              <!-- project -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" value="false" type="checkbox" id="portfolio_pjt">
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-briefcase-alt-2" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Project</span>
                                 </div>
                              </div>
                              <br>
                              <!-- task -->
                              <div class="row">
                                 <div class="col-xl-1">
                                 </div>
                                 <div class="col-xl-2">
                                    <div class="form-check form-switch">
                                       <input style="font-size: 20px!important;" class="form-check-input" value="false" type="checkbox" id="portfolio_tsk" >
                                    </div>
                                 </div>
                                 <div class="col-xl-6">
                                    <i class="bx bx-task" style="font-size: 24px!important; color:#c7df19"></i>
                                    <span style="font-size: 20px!important; margin-left:15px;">Task</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-1">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-1">
                     </div>
                     <div class="col-xl-10">
                        <div class="card">
                           <div class="card-body">
                             <div class="row">
                                <div class="col-xl-4">
                                </div>
                                <div class="col-xl-2">
                                  <button type="submit" id="create_pdf" class="btn btn-d btn-sm"> Generate PDF</button>

                                </div>
                                <div class="col-xl-2">
                                  <button type="submit" id="create_excel" class="btn btn-d btn-sm"> Generate Excel</button>

                                </div>
                                <div class="col-xl-4">
                                </div>
                           </div>
                         </div>
                       </div>
                   </div>
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
      <!-- END layout-wrapper -->
      <!-- JAVASCRIPT -->
      <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
      <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

      <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      <!-- plugin js -->
      <!-- <script src="<?php echo base_url();?>assets/libs/moment/min/moment.min.js"></script> -->

      <script src="<?php echo base_url();?>assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
      <?php
         include('footer_links.php');
         ?>
      <script type="text/javascript">
         // A $( document ).ready() block.
         $( document ).ready(function() {
         console.log( "ready!" );
         // $(function() {
         // $('input[name="daterangestart"]').datepicker();
         // $('input[name="daterangeend"]').datepicker();
         // });

         // task report
         $('#portfolio').on('click', function(e){
           var prt = $('#portfolio').val();
           if(prt == 'false'){
           $('#portfolio').val('true');
           }
           else {
           $('#portfolio').val('false');
           }
         });

         $('#create_pdf').on('click', function(e){
           var start = $('input[name="daterangestart"]').val();
           var end = $('input[name="daterangeend"]').val();
           var prts = $('#portfolio').val();
           var portfolio_id = $('#portfolio_id').val();
           console.log(prts);
           if (prts == 'true') {
             $.ajax({
             url: base_url + 'front/report_portfolio',
             type: 'post',
             data: {
               portfolio_id: portfolio_id,
               project_id: selected_project.val()
           },
             success: function(data) {
               var data = JSON.parse(data);
               console.log(data);
             }
           });
           }
           else {
             alert()
           }


         });
         });
      </script>
   </body>
</html>
