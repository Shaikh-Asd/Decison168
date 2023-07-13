<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="modal-header">
    <h5 class="modal-title"><?php echo 'Inactive '.ucfirst($mem_detail->first_name).' '.$mem_detail->last_name;?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3 mb-2">
    <p class="text-danger"><?php echo ucfirst($mem_detail->first_name).' '.$mem_detail->last_name;?> have some open projects or tasks. To Inactive, Please Assign to Someone!</p>
    <?php
    if(isset($_COOKIE["d168_selectedportfolio"]))
    {
        $porttm = $this->Front_model->getAccepted_PortTM($_COOKIE["d168_selectedportfolio"]);
    ?>
    <form name="OpenWorkNewAssignee" id="OpenWorkNewAssignee" method="post">
    	<input type="hidden" name="old_open_work_assignee" value="<?php echo $mem_detail->reg_id;?>">
    	<input type="hidden" name="get_pim_id_to_inactive" value="<?php echo $get_pim_id;?>">
    	<select name="new_open_work_assignee" id="new_open_work_assignee" class=" form-control pro_team_member" data-placeholder="Assign Open Work..." required>
	        <option value=""><span>Select Team Member to Assign</span></option>
	        <?php                                           
	        if($porttm){
	            foreach ($porttm as $ptm) {
	                $m = $this->Front_model->selectLogin($ptm->sent_to);
	                if($m){
	                if(($m->reg_id != $this->session->userdata('d168_id')) && ($mem_detail->reg_id != $m->reg_id))
	                    {
	                ?>
	                <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
	                <?php
	                    }
	                if(($m->reg_id == $this->session->userdata('d168_id')) && ($mem_detail->reg_id != $m->reg_id))
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
	    <button type="submit" id="OpenWorkNewAssigneeButton" class="btn btn-d btn-sm mt-3 float-end">Assign</button>
        <img id="cloader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
	</form> 
    <?php
    }
    ?>       
</div>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script> 
<script src="<?php echo base_url('assets/js/front.js');?>"></script>