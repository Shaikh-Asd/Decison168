<?php
if($rlist)
{
?> 
<div class="modal-header">
    <h5 class="modal-title mt-0" id="SwitchRoleModalLabel">Switch Role</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row">
    <div class="col-lg-12">
        <div>
            <form method="post" name="switch_role_form" id="switch_role_form" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="cce_id_up" id="cce_id_up" value="<?php echo $getEmp->cce_id;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="role_id_up" id="role_id_up" class="form-control" data-placeholder="Assign Role..." required>
                                <?php 
                                $rlist = $this->Company_model->getCompanyRolesAsc($this->session->userdata('d168_comp_id'));            
                                if($rlist)
                                {
                                    foreach ($rlist as $rl) 
                                    {
                                    ?>
                                    <option value="<?php echo $rl->ccr_id;?>" <?php if($rl->ccr_id == $pm->role_in_comp){ echo 'selected';}?>><span><?php echo $rl->role; ?></span></option>
                                    <?php
                                    }
                                }
                                ?>
                                <option value="employee"><span>Member</span></option>
                            </select> 
                        </div>
                        <span class="text-danger" id="cce_id_upErr"></span>
                        <span class="text-danger" id="role_id_upErr"></span>
                    </div>
                </div>                                       
                <div class="row float-end mt-2">
                    <div class="justify-content-end float-end">
                        <button type="submit" id="switch_role_button" class="btn btn-d btn-sm">Save Changes</button>
                        <img id="uploader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    </div>
                </div>                                   
            </form>
        </div>
    </div>
</div>
<!-- end row -->
</div>
<?php
}
?>  
<script src="<?php echo base_url('assets/js/company.js');?>"></script>