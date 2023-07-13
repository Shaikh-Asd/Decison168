<div class="modal-body">
  <div class="table-responsive">
    <table class="table table-nowrap align-middle mb-0">
        <tbody>
          <?php
          $stud_del = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
          if($stud_del->tour_step){
            $step_array = explode(',', $stud_del->tour_step);
          }else{
            $step_array = array();
          }

          if(in_array('1', $step_array)){ // Dashboard
            $cross_line_1 = 'text-decoration-line-through';
            $green_tick_1 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_1 = '';
            $green_tick_1 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(9, $step_array)){ // Calendar
            $cross_line_9 = 'text-decoration-line-through';
            $green_tick_9 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_9 = '';
            $green_tick_9 = '<i class="bx bxs-circle text-muted"></i>';
          }


          if(in_array(6, $step_array)) // Portfolio
          {
            $cross_line_10 = 'text-decoration-line-through';
            $green_tick_10 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }
          else if(in_array(10, $step_array)) // Portfolio
          {
            $cross_line_10 = 'text-decoration-line-through';
            $green_tick_10 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }
          else{
            $cross_line_10 = '';
            $green_tick_10 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(11, $step_array)){ // Goals & Strategies
            $cross_line_11 = 'text-decoration-line-through';
            $green_tick_11 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_11 = '';
            $green_tick_11 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(12, $step_array)){ // Projects
            $cross_line_12 = 'text-decoration-line-through';
            $green_tick_12 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_12 = '';
            $green_tick_12 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(13, $step_array)){ // Tasks
            $cross_line_13 = 'text-decoration-line-through';
            $green_tick_13 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_13 = '';
            $green_tick_13 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(14, $step_array)){ //Content Planner
            $cross_line_14 = 'text-decoration-line-through';
            $green_tick_14 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_14 = '';
            $green_tick_14 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(16, $step_array)){ // Archive
            $cross_line_16 = 'text-decoration-line-through';
            $green_tick_16 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_16 = '';
            $green_tick_16 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(15, $step_array)){ // File Cabinet
            $cross_line_15 = 'text-decoration-line-through';
            $green_tick_15 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_15 = '';
            $green_tick_15 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(17, $step_array)){ // Trash
            $cross_line_17 = 'text-decoration-line-through';
            $green_tick_17 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_17 = '';
            $green_tick_17 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(in_array(18, $step_array)){ // Support
            $cross_line_18 = 'text-decoration-line-through';
            $green_tick_18 = '<i class="bx bxs-check-circle text-dark-green"></i>';
          }else{
            $cross_line_18 = '';
            $green_tick_18 = '<i class="bx bxs-circle text-muted"></i>';
          }

          if(isset($_COOKIE["d168_selectedportfolio"])){
            $check_tour = $this->Front_model->checkMyTour($this->session->userdata('d168_id'),'after_portfolio');
            if($check_tour){
              ?>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromDashboardBtn" class="font-size-14">
                    <?php echo $green_tick_1; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_1; ?>">Dashboard</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromCalendarBtn" class="font-size-14">
                    <?php echo $green_tick_9; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_9; ?>">Calendar</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                 <a href="javascript:void(0);" id="startFromPortfolioBtn" class="font-size-14">
                    <?php echo $green_tick_10; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_10; ?>">Portfolio</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromGoalsBtn" class="font-size-14">
                    <?php echo $green_tick_11; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_11; ?>">Goals & Strategies</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromProjectsBtn" class="font-size-14">
                    <?php echo $green_tick_12; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_12; ?>">Projects</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromTaskBtn" class="font-size-14">
                    <?php echo $green_tick_13; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_13; ?>">Tasks</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromContentBtn" class="font-size-14">
                    <?php echo $green_tick_14; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_14; ?>">Content Planner</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromArchiveBtn" class="font-size-14">
                    <?php echo $green_tick_16; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_16; ?>">Archive</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromFileCabinetBtn" class="font-size-14">
                    <?php echo $green_tick_15; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_15; ?>">File Cabinet</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromTrashBtn" class="font-size-14">
                    <?php echo $green_tick_17; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_17; ?>">Trash</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromSupportBtn" class="font-size-14">
                    <?php echo $green_tick_18; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_18; ?>">Support</span>
                  </a>
                </td>
              </tr>
              <?php
            }else{
              ?>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromDashboardBtn" class="font-size-14">
                    <?php echo $green_tick_1; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_1; ?>">Dashboard</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromCalendarBtn" class="font-size-14">
                    <?php echo $green_tick_9; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_9; ?>">Calendar</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromChangePortBtn" class="font-size-14">
                    <?php echo $green_tick_10; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_10; ?>">Portfolio</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_11; ?>
                    &nbsp;
                    <span class="text-dark">Goals & Strategies</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_12; ?>
                    &nbsp;
                    <span class="text-dark">Projects</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_13; ?>
                    &nbsp;
                    <span class="text-dark">Tasks</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_14; ?>
                    &nbsp;
                    <span class="text-dark">Content Planner</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_16; ?>
                    &nbsp;
                    <span class="text-dark">Archive</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_15; ?>
                    &nbsp;
                    <span class="text-dark">File Cabinet</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_17; ?>
                    &nbsp;
                    <span class="text-dark">Trash</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_18; ?>
                    &nbsp;
                    <span class="text-dark">Support</span>
                  </a>
                </td>
              </tr>
              <?php
            }
          }else{
            $check_tour = $this->Front_model->checkMyTour($this->session->userdata('d168_id'),'after_portfolio');
            if($check_tour){
              ?>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromDashboardBtn" class="font-size-14">
                    <?php echo $green_tick_1; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_1; ?>">Dashboard</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromCalendarBtn" class="font-size-14">
                    <?php echo $green_tick_9; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_9; ?>">Calendar</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                 <a href="javascript:void(0);" id="startFromChangePortBtn" class="font-size-14">
                    <?php echo $green_tick_10; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_10; ?>">Portfolio</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_11; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_11; ?>">Goals & Strategies</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_12; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_12; ?>">Projects</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_13; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_13; ?>">Tasks</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_14; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_14; ?>">Content Planner</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_16; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_16; ?>">Archive</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_15; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_15; ?>">File Cabinet</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_17; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_17; ?>">Trash</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_18; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_18; ?>">Support</span>
                  </a>
                </td>
              </tr>
              <?php
            }else{
              ?>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromDashboardBtn" class="font-size-14">
                    <?php echo $green_tick_1; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_1; ?>">Dashboard</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromCalendarBtn" class="font-size-14">
                    <?php echo $green_tick_9; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_9; ?>">Calendar</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" id="startFromChangePortBtn" class="font-size-14">
                    <?php echo $green_tick_10; ?>
                    &nbsp;
                    <span class="text-dark <?php echo $cross_line_10; ?>">Portfolio</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_11; ?>
                    &nbsp;
                    <span class="text-dark">Goals & Strategies</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_12; ?>
                    &nbsp;
                    <span class="text-dark">Projects</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_13; ?>
                    &nbsp;
                    <span class="text-dark">Tasks</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_14; ?>
                    &nbsp;
                    <span class="text-dark">Content Planner</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_16; ?>
                    &nbsp;
                    <span class="text-dark">Archive</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_15; ?>
                    &nbsp;
                    <span class="text-dark">File Cabinet</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_17; ?>
                    &nbsp;
                    <span class="text-dark">Trash</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="padding:0.5em;">
                  <a href="javascript:void(0);" class="font-size-14">
                    <?php echo $green_tick_18; ?>
                    &nbsp;
                    <span class="text-dark">Support</span>
                  </a>
                </td>
              </tr>
              <?php
            }
          }
          ?>  
          <tr>
            <td colspan="2"><a href="javascript:void(0)" id="startTourBtn" style="margin: 0px 75px;" class="btn btn-d waves-effect waves-light btn-sm">Start Over <i class="mdi mdi-arrow-right ms-1"></i></a></td>
          </tr>                      
        </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
$('#startTourBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'yes');
  window.location = base_url;
});

$('#startFromDashboardBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-1');
  window.location = base_url;
});

$('#startFromChangePortBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-6');
  window.location = base_url;
});

$('#startFromCalendarBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-9');
  window.location = base_url;
});

$('#startFromPortfolioBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-10');
  window.location = base_url;
});

$('#startFromGoalsBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-11');
  window.location = base_url;
});

$('#startFromProjectsBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-12');
  window.location = base_url;
});

$('#startFromTaskBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-13');
  window.location = base_url;
});

$('#startFromContentBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-14');
  window.location = base_url;
});

$('#startFromArchiveBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-15');
  window.location = base_url;
});

$('#startFromFileCabinetBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-16');
  window.location = base_url;
});

$('#startFromTrashBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-17');
  window.location = base_url;
});

$('#startFromSupportBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'specific_tour');
  localStorage.setItem('tour_start', 'yes-18');
  window.location = base_url;
});
</script>