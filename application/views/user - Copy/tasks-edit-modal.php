<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
if($tdetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="TaskOverviewModalLabel"><?php echo $tdetail->tname;?></h5>
                    &nbsp;&nbsp;<a href="<?php echo base_url('tasks-edit/'.$tdetail->tid);?>" class="btn btn-sm btn-d text-white">Open</a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">Edit Task</h4>
                                        <form method="post" name="edit_task_formModal" id="edit_task_formModal" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid;?>">
                                            <input type="hidden" name="tcode" id="tcode" value="<?php echo $tdetail->tcode;?>">
                                            <input type="hidden" name="tfile_old" id="tfile_old" value="<?php echo $tdetail->tfile;?>">
                                            <input type="hidden" name="getYvalue" id="getYvalue" value="0">
                                            <input type="hidden" name="get_gid" id="get_gid" value="<?php echo $tdetail->gid;?>">
                                            <input type="hidden" name="get_sid" id="get_sid" value="<?php echo $tdetail->sid;?>">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                             <div class="form-group mb-2">
                                                                <label for="tname" class="col-form-label">Task <span class="text-danger">*</span></label>
                                                                <input id="tname" name="tname" type="text" class="form-control" placeholder="Enter Task Name..." required="" value="<?php echo $tdetail->tname;?>">
                                                                <span id="tnameErr" class="text-danger"></span>
                                                             </div>
                                                            <div class="form-group mb-2">
                                                                <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control" id="tdes" name="tdes" rows="7" placeholder="Enter Task Description..."><?php echo $tdetail->tdes;?></textarea> 
                                                            </div>
                                                                <div class="form-group mb-2">
                                                                    <label class="col-form-label">Note</label>
                                                                        <textarea class="form-control" id="tnote" name="tnote" rows="7" placeholder="Enter Task Note..."><?php echo $tdetail->tnote;?></textarea>
                                                                </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <?php
                                                        if($plist || $accepted_plist)
                                                        {
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Project</label>
                                                            <select class="form-select" name="tproject_assign" id="tproject_assign" onchange="return get_project_id();">
                                                                <?php
                                                                    foreach($plist as $pl)
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $pl->pid;?>" <?php if($tdetail->tproject_assign == $pl->pid){ echo "selected";}?>><?php echo $pl->pname;?></option>
                                                                <?php
                                                                    }
                                                                    foreach($accepted_plist as $apl)
                                                                    {
                                                                ?>
                                                                <option value="<?php echo $apl->pid;?>" <?php if($tdetail->tproject_assign == $apl->pid){ echo "selected";}?>><?php echo $apl->pname;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <option value="" <?php if($tdetail->tproject_assign == 0){ echo "selected";}?>>Select Project</option>
                                                            </select>
                                                            <span id="tproject_assignErr" class="text-danger"></span>  
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="dept" class="col-form-label">Identify Department <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="dept" id="dept" required>
                                                            <option value="">Select Department</option>
                                                            <?php
                                                            if(isset($_COOKIE["d168_selectedportfolio"]))
                                                            {
                                                            $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                            if($check_port_dept) 
                                                            {
                                                                foreach($check_port_dept as $p_dept)
                                                                {
                                                                ?>
                                                                <option value="<?php echo $p_dept->portfolio_dept_id;?>" <?php if($p_dept->portfolio_dept_id == $tdetail->dept_id) { echo "selected";}?>><?php echo $p_dept->department;?></option>
                                                                <?php  
                                                                }         
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="deptErr" class="text-danger"></span>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Portfolio <span class="text-danger">*</span></label>
                                                        <input id="portfolio_name" name="portfolio_name" type="text" class="form-control" readonly required>
                                                        <span id="portfolio_nameErr" class="text-danger"></span>
                                                    </div>
                                                    <input type="hidden" name="get_pub_date" id="get_pub_date">
                                                    <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                    <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                        <div class="form-group mb-2">
                                                            <label for="tname" class="col-form-label">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" onmouseover="return pub_tdue_date()" class="form-control" id="pub_tdue_date_id" name="tdue_date" placeholder="Due Date" data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" value="<?php echo $tdetail->tdue_date;?>" required="">
                                                            </div>
                                                            <span id="pub_tdue_date_idErr" class="text-danger"></span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select" name="tpriority" id="tpriority" required="">
                                                                <option value="high" <?php if($tdetail->tpriority == 'high'){ echo "selected";}?>>High</option>
                                                                <option value="medium" <?php if($tdetail->tpriority == 'medium'){ echo "selected";}?>>Medium</option>
                                                                <option value="low" <?php if($tdetail->tpriority == 'low'){ echo "selected";}?>>Low</option>
                                                            </select>
                                                            <span id="tpriorityErr" class="text-danger"></span>
                                                    </div>
                                                    
                                                    <div class="form-group mb-2">
                                                        <label for="tname" class="col-form-label">Assignee <span class="text-danger">*</span></label>
                                                        <?php
                                                         $get_pdetail = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                         $porttm = $this->Front_model->getAccepted_PortTM($tdetail->portfolio_id);
                                                        ?>
                                                            <select name="team_member2" id="team_member2" class="form-control" style="line-height: 1.5;" required="">
                                                            <?php                                        
                                                            if($tdetail->tproject_assign != 0)
                                                            {
                                                            if($porttm){
                                                                foreach ($porttm as $ptm) {
                                                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                                    if($m)
                                                                    {
                                                                    if($m->reg_id != $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $m->reg_id;?>" <?php if($tdetail->tassignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                    <?php
                                                                        }
                                                                    if($m->reg_id == $this->session->userdata('d168_id'))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($tdetail->tassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            </select> 
                                                            <span id="team_member2Err" class="text-danger"></span>       
                                                        <!-- <?php
                                                        if($get_pdetail)
                                                        {
                                                            if($get_pdetail->pcreated_by == $this->session->userdata('d168_id'))
                                                            {
                                                        ?>
                                                            <div class="col-lg-3 mt-1">
                                                                <button type="button" class="btn btn-d btn-sm" data-bs-toggle="modal" data-bs-target="#pdetail_AddMember" title="Add Team Member">Add Member</button>
                                                            </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?> -->
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if(!empty($tdetail->tlink))
                                                    {
                                                        $tlink = explode(',', $tdetail->tlink);
                                                        $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Task Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" value="<?php echo $tlink[0];?>">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" value="<?php if(!empty($tlink_comment[0])){ echo $tlink_comment[0]; }?>">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <button type="button" class="add_dup_tlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Task Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" placeholder="Enter Task Link...">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" placeholder="Enter Task Link Comment...">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <button type="button" class="add_dup_tlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="tlink_div">
                                                    <?php
                                                    if(!empty($tdetail->tlink))
                                                    {
                                                        $tlink = explode(',', $tdetail->tlink);
                                                        $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                        $tlcount = count($tlink); 
                                                        if($tlcount > 0)
                                                        {
                                                            for ($i=1; $i<$tlcount; $i++)
                                                            {
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12"></label>
                                                        <div class="col-lg-5">
                                                            <input id="tlink" name="tlink[]" type="text" class="form-control" value="<?php echo $tlink[$i];?>">
                                                            <span id="tlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" value="<?php if(!empty($tlink_comment[$i])){ echo $tlink_comment[$i]; }?>">
                                                            <span id="tlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-3 card-title mb-2">
                                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_tlink2" style="margin-left: 30px;">
                                                                <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
                                                            </button>
                                                            <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_tlink" style="margin-left: 15px;">
                                                                <span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                    <span id="link_validErr" class="text-danger"></span>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Attached File(s)</label>
                                                        <input class="form-control" name="tfile[]" id="tfile" type="file" multiple="" />
                                                            <span id="tfileErr" class="text-danger"></span>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                    <div class="form-group mb-2">
                                                                <label for="estimated_time" class="col-form-label">Estimated Time <span class="text-danger">*</span></label>
                                                                <input id="estimated_time" name="estimated_time" type="text" class="form-control" placeholder="Enter time in hour format" required="" value="<?php echo $tdetail->estimated_time;?>">
                                                                <span id="estimated_timeErr" class="text-danger"></span>
                                                             </div>
                                                             </div>
                                                    <div class="justify-content-end">
                                                            <button type="submit" id="edit_task_button" class="btn btn-d btn-sm">Save Changes</button>
                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">       
                                                    </div>

                                                    

                                                  </div>
                                                </div>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
<?php
}
else
{
?>
<div class="modal-header">
                    <h5 class="modal-title mt-0" id="TaskOverviewModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">Only Task Assignee and Task Created User can Edit Task Details!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
}
?>

<!-- Add Team Member Modal -->
<div class="modal fade" id="pdetail_AddMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add to Project Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="pdetail_AddTeamMemberForm_task" id="pdetail_AddTeamMemberForm_task" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <?php
                            $pdetail = $this->Front_model->getProjectById($tdetail->tproject_assign);
                            $port_id = $pdetail->portfolio_id;
                            $pid = $pdetail->pid;
                            $porttm = $this->Front_model->getAccepted_PortTM($port_id);
                            ?>
                            <select name="team_member" id="team_member" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();" style="width: 100%">
                                   <?php
                                if($porttm){
                                  foreach ($porttm as $ptm) {
                                    $m = $this->Front_model->selectLogin($ptm->sent_to);
                                    if($m)
                                    {
                                    $check_pm = $this->Front_model->check_pm($m->reg_id,$pid,$port_id);
                                      if(($m->reg_id != $this->session->userdata('d168_id')) && ($m->reg_id != $check_pm->pmember))
                                      {
                                        $get_pdetail = $this->Front_model->getProjectById($pid);
                                        if($m->reg_id != $get_pdetail->pcreated_by)
                                        {
                                        ?>
                                        <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                        <?php
                                        }
                                      }
                                    }
                                    }
                                  }
                                  ?>
                            </select>                                                   
                            <input type="hidden" name="selected_T_member" id="selected_T_member">
                            <span id="selected_T_memberErr" class="text-danger"></span>
                            <?php
                            if(!empty($tdetail->tproject_assign))
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign;?>">
                                <?php
                            }
                            else
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="imember_div">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="pdetail_AddTeamMemberButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
//debugger;
//plink clone
var add_dup_tlink = $('.add_dup_tlink'); //Add button selector
   var tlink_div = $('.tlink_div'); //Input field wrapper
   var tlinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="tlink" name="tlink[]" type="text" class="form-control" placeholder="Enter Task Link..."><span id="tlinkErr" class="text-danger"></span></div><div class="col-lg-4"><input id="tlink_comment" name="tlink_comment[]" type="text" class="form-control" placeholder="Enter Task Link Comment..."><span id="tlink_commentErr" class="text-danger"></span></div><div class="col-lg-3 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_tlink2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_tlink" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_tlink).click(function(){
    //debugger;
           $(tlink_div).append(tlinkHTML); //Add field html
   });
   
   $(tlink_div).on('click', '.add_dup_tlink2', function(e){
      //debugger;
           $(tlink_div).append(tlinkHTML); 
   });

   //Once remove button is clicked
   $(tlink_div).on('click', '.remove_dup_tlink', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
   });


});
</script>