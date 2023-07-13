<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="modal-header">
    <h5 class="modal-title"><?php echo 'Remove '.ucfirst($fname).' '.$lname;?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3 mb-2">
    <p class="text-danger"><?php echo ucfirst($fname).' '.$lname;?> have some open projects or tasks. To Inactive, Please Assign to Someone!</p>
    <?php
    if(isset($_COOKIE["d168_selectedportfolio"]))
    {
        $ptm = $this->Front_model->GoalTeamMemberAccepted($mem_detail->gid);
    ?>
    <form name="GoalOpenWorkNewAssignee" id="GoalOpenWorkNewAssignee" method="post">
    	<input type="hidden" name="old_open_work_assignee" value="<?php echo $mem_detail->gmember;?>">
    	<input type="hidden" name="get_gmid_to_remove" value="<?php echo $mem_detail->gmid;?>">
    	<select name="new_open_work_assignee" id="new_open_work_assignee" class=" form-control pro_team_member" data-placeholder="Assign Open Work..." required>
	        <option value=""><span>Select Team Member to Assign</span></option>
	        <?php                                           
	        if($ptm){
	            foreach ($ptm as $ptm) {
	                $m = $this->Front_model->getStudentById($ptm->gmember);
	                if($m){
	                if(($m->reg_id != $this->session->userdata('d168_id')) && ($mem_detail->gmember != $m->reg_id))
	                    {
	                ?>
	                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
	                <?php
	                    }
	                if(($m->reg_id == $this->session->userdata('d168_id')) && ($mem_detail->gmember != $m->reg_id))
	                    {
	                ?>
	                <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
	                <?php
	                    }
	                }
	                }
	            }
	        ?>
	    </select> 
	    <span id="new_open_work_assigneeErr" class="text-danger"></span>
	    <button type="submit" id="GoalOpenWorkNewAssigneeButton" class="btn btn-d btn-sm mt-3 float-end">Assign</button>
        <img id="cloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
	</form> 
    <?php
    }
    ?>       
</div>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script> 
<script src="<?php echo base_url('assets/js/front.js');?>"></script>