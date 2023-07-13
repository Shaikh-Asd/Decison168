<div class="modal-body">
  <div class="table-responsive">
    <table class="table table-nowrap align-middle mb-0">
        <tbody>
          <?php
          if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
            ?>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createPortfolioBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Portfolio</span>
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createProjectBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Project</span>
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createGoalBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Goal</span>
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createTaskBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Task</span>
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createContentBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Content</span>
                </a>
              </td>
            </tr>
            <?php
          }else{
            ?>
            <tr>
              <td style="padding:0.5em">
                <a href="javascript:void(0);" id="createPortfolioBtn" class="font-size-14 font-weight-semibold">
                  <i class="bx bxs-check-circle text-dark-green"></i> &nbsp; <span class="text-dark">Create your First Portfolio</span>
                </a>
              </td>
            </tr>
            <?php
          }
          ?>                      
        </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
$('#createPortfolioBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'portfolio-create');
  window.location = base_url+'portfolio-create';
});

$('#createProjectBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'projects-create');
  window.location = base_url+'projects-create';
});

$('#createGoalBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'goal-create');
  window.location = base_url+'goal-create';
});

$('#createTaskBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'tasks-create');
  window.location = base_url+'tasks-create';
});

$('#createContentBtn').on('click', function(e){ 
  localStorage.setItem('tour_session', 'content-project-create');
  window.location = base_url+'content-project-create';
});
</script>