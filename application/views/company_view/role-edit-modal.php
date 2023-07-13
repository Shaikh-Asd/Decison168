<?php
if($rdetail)
{
    $cus_privilege = '';
    if($rdetail->privilege != 'all')
    {
        $cus_privilege = explode(', ',trim($rdetail->privilege));
        //print_r($cus_privilege);
    }
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="EditRoleModalLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <form method="post" name="update_role_form" id="update_role_form" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" name="id" value="<?php echo $rdetail->ccr_id;?>">
                                        <div class="row mb-2">
                                            <label class="col-form-label col-lg-2">Role <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="role" name="role" type="text" class="form-control" placeholder="Enter Role..." value="<?php echo $rdetail->role;?>" required="">
                                            <span id="roleErr" class="text-danger"></span>
                                            </div>
                                        </div>
<div class="card p-4" style="background: #f6f6f6; border:1px solid #e5e3e3;">
    <h4 class="card-title">Privileges:</h4>
      <input class="selected_rpivilege_option_up" type="hidden" name="rpivilege_option" id="rpivilege_option" value="<?php if($rdetail->privilege == 'all'){ echo 'all';} else { echo 'custom';}?>">
      <span id="rpivilege_optionErr" class="text-danger"></span>
    <div class="card-body" style="background: #ffffff;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php if($rdetail->privilege == 'all'){ echo 'active';}?>" data-bs-toggle="tab" href="#rpivilege_opt_all" role="tab" aria-selected="false" onclick="return choose_rpivilege_option_up('all');">
                    <span class="d-sm-block">
                    All
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($rdetail->privilege != 'all'){ echo 'active';}?>" data-bs-toggle="tab" href="#rpivilege_opt_cus" role="tab" aria-selected="true" onclick="return choose_rpivilege_option_up('cus');">
                    <span class="d-sm-block">
                    Custom
                    </span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane rpivilege_opt_all_class <?php if($rdetail->privilege == 'all'){ echo 'active';}?>" id="rpivilege_opt_all" role="tabpanel">
                <p class="mb-0">
                    <ul class="list-unstyled fw-medium">
                        <li>
                            Access to :
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Portfolio
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Goals & strategies</span>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Projects</span>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Content planner
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i>Task & subtask
                        </li>
                    </ul>
                </p>
            </div>
            <div class="tab-pane rpivilege_opt_cus_class <?php if($rdetail->privilege != 'all'){ echo 'active';}?>" id="rpivilege_opt_cus" role="tabpanel">
                <p class="mb-0">
                    <div class="row mb-2">
                    Access to :
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt_edit" type="checkbox" name="cus_privilege[]" value="portfolio" <?php if(!empty($cus_privilege)){ if(in_array('portfolio', $cus_privilege)){ echo 'checked';} if(in_array('view', $cus_privilege)){ echo 'disabled';}}?> onclick="return view_option_disable_edit();">
                            <label class="form-check-label">Portfolio</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt_edit" type="checkbox" name="cus_privilege[]" value="goals, strategies" <?php if(!empty($cus_privilege)){ if(in_array('goals', $cus_privilege)){ echo 'checked';} if(in_array('view', $cus_privilege)){ echo 'disabled';}}?> onclick="return view_option_disable_edit();">
                            <label class="form-check-label">Goals & strategies</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt_edit" type="checkbox" name="cus_privilege[]" value="projects" <?php if(!empty($cus_privilege)){ if(in_array('projects', $cus_privilege)){ echo 'checked';} if(in_array('view', $cus_privilege)){ echo 'disabled';}}?> onclick="return view_option_disable_edit();">
                            <label class="form-check-label">Projects</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input other_opt_edit" type="checkbox" name="cus_privilege[]" value="content planner" <?php if(!empty($cus_privilege)){ if(in_array('content planner', $cus_privilege)){ echo 'checked';} if(in_array('view', $cus_privilege)){ echo 'disabled';}}?> onclick="return view_option_disable_edit();">
                            <label class="form-check-label">Content planner</label>
                        </div>
                      </div> 
                      <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="cus_privilege[]" value="view" id="view_only_opt_edit" <?php if(!empty($cus_privilege)){ if(in_array('view', $cus_privilege)){ echo 'checked';} else { echo 'disabled';}}?> onclick="return view_option_visible_edit();">
                            <label class="form-check-label">View only</label>
                        </div>
                      </div>                      
                    </div>
                    <span class="text-danger">(* Member can access task & subtask! (Not in view option))</span>
                </p>
            </div>
        </div>
    </div>
</div>                                        
                                        <div class="row float-end mt-2">
                                            <div class="justify-content-end float-end">
                                                <button type="submit" id="update_role_button" class="btn btn-d btn-sm">Save Changes</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
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