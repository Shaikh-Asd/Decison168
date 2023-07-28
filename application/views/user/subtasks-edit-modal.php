<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
if($stdetail)
{
    $get_task_dd = $this->Front_model->getTasksDetail($stdetail->tid);
    $gdetail = $this->Front_model->GoalDetail($get_task_dd->gid);
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="SubtaskEditModalLabel"><?php echo $stdetail->stname;?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title mb-2">Edit Subtask</h4>
                                    <form method="post" name="edit_subtask_form" id="edit_subtask_form" enctype="multipart/form-data" autocomplete="off">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                <input type="hidden" name="stid" value="<?php echo $stdetail->stid;?>">
                                                <input type="hidden" name="stcode" value="<?php echo $stdetail->stcode;?>">
                                                <input type="hidden" name="stproject_assign" value="<?php echo $stdetail->stproject_assign;?>">
                                                <input type="hidden" name="stfile_old" value="<?php echo $stdetail->stfile;?>">
                                                <input type="hidden" name="task_dd" id="tdue_date" value="<?php echo $get_task_dd->tdue_date;?>">
                                                <?php 
                                                if($gdetail)
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date" value="<?php echo $gdetail->gstart_date;?>">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date" value="<?php echo $gdetail->gend_date;?>">
                                                <?php
                                                } 
                                                else
                                                {
                                                ?>
                                                <input type="hidden" name="get_gstart_date" id="get_gstart_date">
                                                <input type="hidden" name="get_gend_date" id="get_gend_date">
                                                <?php
                                                } 
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="stname">Sub Task <span class="text-danger">*</span></label> 
                                                            <input id="stname" name="stname" class="form-control" placeholder="Enter Subtask Name..." value="<?php echo $stdetail->stname;?>" required />
                                                            <span class="text-danger" id="tnameErr"></span>
                                                        </div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label">Description</label> 
                                                            <textarea class="form-control" id="tdes" name="tdes" placeholder="Enter Subtask Description..." rows="3"><?php echo $stdetail->stdes;?></textarea></div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select" id="tpriority" name="tpriority" required>
                                                                <option value="high" <?php if($stdetail->stpriority == "high"){ echo "selected";}?>>High</option>
                                                                <option value="medium" <?php if($stdetail->stpriority == "medium"){ echo "selected";}?>>Medium</option>
                                                                <option value="low" <?php if($stdetail->stpriority == "low"){ echo "selected";}?>>Low</option>
                                                            </select>
                                                            <span class="text-danger" id="tpriorityErr"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Due Date <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="datepicker3">
                                                                <input onmouseover="return st_duedate(1)" id="tdue_date1" name="tdue_date" class="form-control" placeholder="Subtask Due Date" data-date-autoclose="true" data-date-container="#datepicker3" data-date-format="yyyy-m-d" data-provide="datepicker" required="" value="<?php echo $stdetail->stdue_date;?>" />
                                                            </div>
                                                            <span class="text-danger" id="tdue_dateErr"></span>
                                                        </div>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label">Note</label> 
                                                            <textarea class="form-control" id="tnote" name="tnote" placeholder="Enter Subtask Note..." rows="3"><?php echo $stdetail->stnote;?></textarea>
                                                        </div>
                                                        <?php 
                                                        if(!empty($stdetail->stproject_assign))
                                                            {
                                                                $get_pdetail=$this->Front_model->getProjectById($stdetail->stproject_assign);
                                                                $porttm=$this->Front_model->getAccepted_PortTM($get_pdetail->portfolio_id); ?>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Assignee <span class="text-danger">*</span></label>
                                                            <select class="form-control team_member21" name="team_member2" style="line-height: 1.5;" required="">
                                                                <?php 
                                                                if($stdetail->stproject_assign != 0)
                                                                {
                                                                if($porttm)
                                                                    {
                                                                        foreach($porttm as $ptm)
                                                                            {
                                                                                $m=$this->Front_model->selectLogin($ptm->sent_to);
                                                                                if($m){
                                                                                if($m->reg_id!=$this->session->userdata('d168_id'))
                                                                                    { 
                                                                                    ?>
                                                                <option value="<?php echo $m->reg_id; ?>" <?php if($stdetail->stassignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                                <?php 
                                                                                    }
                                                                if($m->reg_id==$this->session->userdata('d168_id'))
                                                                                    { 
                                                                    ?>
                                                                <option value="<?php echo $this->session->userdata('d168_id'); ?>" <?php if($stdetail->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                <?php 
                                                                                    }
                                                                                }
                                                                            }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($stdetail->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                        <?php
                                                                    } 
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($stdetail->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="text-danger" id="team_member21Err"></span>
                                                        </div>
                                                        <?php 
                                                        }
                                                        else
                                                        { 
                                                        ?>
                                                        <div class="mb-2 form-group">
                                                            <label class="col-form-label" for="tname">Assignee <span class="text-danger">*</span></label>
                                                            <select class="form-control team_member21" name="team_member2" style="line-height: 1.5;" required="">
                                                                <option value="<?php echo $this->session->userdata('d168_id'); ?>" <?php if($stdetail->stassignee == $this->session->userdata('d168_id')){ echo "selected";}?>>Assign To Me</option>
                                                            </select>
                                                            <span class="text-danger" id="team_member2Err"></span>
                                                        </div>
                                                        <?php 
                                                        } 
                                                        ?>
                                                    </div>
                                                    <?php
                                                    if(!empty($stdetail->stlink))
                                                    {
                                                        $stlink = explode(',', $stdetail->stlink);
                                                        $stlink_comment = explode(',',$stdetail->stlink_comment);
                                                    ?>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Subtask Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="stlink" name="stlink[]" type="text" class="form-control" value="<?php echo $stlink[0]?>">
                                                            <span id="stlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input id="stlink_comment" name="stlink_comment[]" type="text" class="form-control" value="<?php if(!empty($stlink_comment[0])){ echo $stlink_comment[0]; }?>">
                                                            <span id="stlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <button type="button" class="add_dup_stlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div class="mb-2 col-md-5">
                                                        <label class="col-form-label">Attached File(s)</label>
                                                        <input class="form-control" id="tfile" name="tfile[]" multiple type="file" />
                                                        <span class="text-danger" id="tfileErr"></span>
                                                    </div>
                                                    <div class="mb-2 col-md-1">

                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                    <div class="form-group mb-2">
                                                                <label for="estimated_stime" class="col-form-label">Estimated Time <span class="text-danger">*</span> (For example: XhXm)</label>
                                                                <input id="estimated_stime" name="estimated_stime" type="text" class="form-control" placeholder="Enter time in hour format" required="" value="<?php echo $stdetail->estimated_stime;?>">
                                                                <div id="suggestionSContainer"></div>
                                                                <span id="estimated_stimeErr" class="text-danger"></span>
                                                             </div>
                                                             </div>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-12">Subtask Link(s) & Comment(s)</label>
                                                        <div class="col-lg-5">
                                                            <input id="stlink" name="stlink[]" type="text" class="form-control" placeholder="Enter Subtask Link...">
                                                            <span id="stlinkErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input id="stlink_comment" name="stlink_comment[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment...">
                                                            <span id="stlink_commentErr" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <button type="button" class="add_dup_stlink btn btn-d btn-sm">Add Another link</button>                                                   
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="stlink_div">
                                                    <?php
                                                    if(!empty($stdetail->stlink))
                                                    {
                                                        $stlink = explode(',', $stdetail->stlink);
                                                        $stlink_comment = explode(',',$stdetail->stlink_comment);
                                                        $stlcount = count($stlink); 
                                                        if($stlcount > 0)
                                                        {
                                                            for ($i=1; $i<$stlcount; $i++)
                                                            {
                                                                ?>
                                                                <div class="row mb-2">
                                                                    <label class="col-form-label col-lg-12"></label>
                                                                    <div class="col-lg-5">
                                                                        <input id="stlink" name="stlink[]" type="text" class="form-control" value="<?php echo $stlink[$i];?>">
                                                                        <span id="stlinkErr" class="text-danger"></span>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <input id="stlink_comment" name="stlink_comment[]" type="text" class="form-control" value="<?php if(!empty($stlink_comment[$i])){ echo $stlink_comment[$i]; }?>">
                                                                        <span id="stlink_commentErr" class="text-danger"></span>
                                                                    </div>
                                                                    <div class="col-lg-3 card-title mb-2">
                                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_stlink2" style="margin-left: 30px;">
                                                                            <span class="avatar-title bg-transparent text-reset">
                                                                                <i class="bx bx-plus"></i>
                                                                            </span>
                                                                        </button>
                                                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_stlink" style="margin-left: 15px;">
                                                                            <span class="avatar-title bg-transparent text-reset">
                                                                                <i class="bx bx-minus"></i>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                    <span id="stlink_validErr" class="text-danger"></span>
                                                    
                                                </div>    
                                                    <div class="row float-end">
                                                        <div class="justify-content-end float-end">
                                                            <button type="submit" id="edit_subtask_button" class="btn btn-d btn-sm">Save Changes</button>
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
                                        <h4 class="card-title mb-2">Only Subtask Assignee and Subtask Created User can Edit Subtask Details!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
<?php
}
?>  
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="<?php echo base_url('assets/js/front.js');?>"></script> -->
<script type="text/javascript">
    // FOR EDIT SUBTASK FORM ----------------------------------------
  $('#edit_subtask_form').on('submit',function(event){ 
    // debugger;   
    event.preventDefault(); // Stop page from refreshing
    $('#edit_subtask_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_subtask',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'file_uploadSizeErr')
          {
            $('#tfileErr').html('Oops Size is Large! It must be less than 2MB.');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');
          }
          else if(data.status == 'Error_Uploading')
          {
            $('#tfileErr').html('File Uploading Error! Please Try Again!');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == 'stlink_valid')
          {
            $('#stlink_validErr').html('Please Enter Valid Link!');
            $('#edit_subtask_button').show();
            $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });
    </script>
<script type="text/javascript">
    $(document).ready(function(){
//plink clone
var add_dup_stlink = $('.add_dup_stlink'); //Add button selector
   var stlink_div = $('.stlink_div'); //Input field wrapper
   var stlinkHTML = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="stlink" name="stlink[]" type="text" class="form-control" placeholder="Enter Subtask Link..."><span id="stlinkErr" class="text-danger"></span></div><div class="col-lg-4"><input id="stlink_comment" name="stlink_comment[]" type="text" class="form-control" placeholder="Enter Subtask Link Comment..."><span id="stlink_commentErr" class="text-danger"></span></div><div class="col-lg-3 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_stlink2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_stlink" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_stlink).click(function(){
    //debugger;
           $(stlink_div).append(stlinkHTML); //Add field html
   });
   
   $(stlink_div).on('click', '.add_dup_stlink2', function(e){
      //debugger;
           $(stlink_div).append(stlinkHTML); 
   });

   //Once remove button is clicked
   $(stlink_div).on('click', '.remove_dup_stlink', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
   });

});
</script>