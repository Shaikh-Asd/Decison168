<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="modal-header">
    <h5 class="modal-title"><?php echo 'Inactive '.ucfirst($mem_detail->first_name).' '.$mem_detail->last_name;?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3 mb-2">
    <p class="text-danger"><?php echo ucfirst($mem_detail->first_name).' '.$mem_detail->last_name;?> have some open work. You can assign to someone or directly inactivate by clicking 'Not Now' option!</p>
    <p>Open works:</p>
    <?php
      if($portfolio_count != 0)
      {
      	echo '<p>'.$portfolio_count.' portfolio(s)</p>';
      }
	  if(($goal_count != 0) || ($goal_tm_count != 0))
	  {
	  	$goals = $goal_count + $goal_tm_count;
      	echo '<p>'.$goals.' goal(s)</p>';
      }
	  if($strategies_count != 0)
	  {
      	echo '<p>'.$strategies_count.' strategies</p>';
      }
	  if(($pro_count != 0) || ($pro_tm_count != 0))
	  {
	  	$pro = $pro_count + $pro_tm_count;
      	echo '<p>'.$pro.' project(s)</p>';
      }
	  if($plan_count != 0)
	  {
      	echo '<p>'.$plan_count.' planned content</p>';
      }
	  if($task_count != 0)
	  {
      	echo '<p>'.$task_count.' task(s)</p>';
      }
	  if($subtask_count != 0)
	  {
      	echo '<p>'.$subtask_count.' subtask(s)</p>';
      }
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
        $allemp = $this->Company_model->getCompanyActiveRegEmps($this->session->userdata('d168_comp_id'));
    ?>
    <form name="OpenWorkNewAssignee" id="OpenWorkNewAssignee" method="post">
    	<input type="hidden" name="old_open_work_assignee" value="<?php echo $mem_detail->reg_id;?>">
    	<input type="hidden" name="get_cce_id_to_inactive" value="<?php echo $cce_id;?>">
    	<select name="new_open_work_assignee" id="new_open_work_assignee" class=" form-control pro_team_member" data-placeholder="Assign Open Work..." required>
	        <option value=""><span>Select Member to Assign</span></option>
	        <?php                                           
	        if($allemp)
	        {
	            foreach ($allemp as $emp) 
	            {
	            	if($cce_id != $emp->cce_id)
	            	{
		                $m = $this->Company_model->getStudentByEmailId($emp->emp_email);
		                if($m)
		                {
		                ?>
		                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
		                <?php
		                }
	            	}
	            }
	        }
	        ?>
	    </select> 
	    <span id="new_open_work_assigneeErr" class="text-danger"></span>
	    <button type="submit" id="OpenWorkNewAssigneeButton" class="btn btn-d btn-sm mt-3 float-end">Assign</button>
        <img id="cloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
	    <button type="button" id="OpenWorkNotNowButton" class="btn bg-d text-white btn-sm mt-3 me-3 float-end" onclick="return ForceInactive_Emp('<?php echo $cce_id;?>')">Not Now</button>
	</form> 
    <?php
    }
    ?>       
</div>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script> 
<script src="<?php echo base_url('assets/js/company.js');?>"></script>