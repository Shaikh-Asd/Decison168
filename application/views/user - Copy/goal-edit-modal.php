<?php
if($gdetail)
{
?>
<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="GoalEditModalLabel"><?php echo $gdetail->gname;?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title mb-2">Edit Goal</h4>
                                    <form method="post" name="edit_goal_form" id="edit_goal_form" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" name="gid" value="<?php echo $gdetail->gid;?>">
                                        <div class="row mb-2">
                                            <label for="gname" class="col-form-label col-lg-2">Objective/Goal <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="gname" name="gname" type="text" class="form-control" placeholder="Enter Objective/Goal..." value="<?php echo $gdetail->gname;?>" required="">
                                                <span id="gnameErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="gdept" class="col-form-label col-lg-2">Identify Department <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-select select2" name="gdept" id="gdept" required>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                    $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                    if($check_port_dept) 
                                                    {
                                                        foreach($check_port_dept as $p_dept)
                                                        {
                                                        ?>
                                                        <option value="<?php echo $p_dept->portfolio_dept_id;?>" <?php if($p_dept->portfolio_dept_id == $gdetail->gdept){ echo "selected";}?>><?php echo $p_dept->department;?></option>
                                                        <?php  
                                                        }         
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="gdeptErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-form-label col-lg-2">Duration <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                            <div class="input-daterange input-group goal_Cdate" id="datepicker6"  data-date-format="yyyy-m-d" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                                <input type="text" class="form-control" name="gstart_date" id="gstart_date" placeholder="Start Date" value="<?php echo $gdetail->gstart_date;?>" required>
                                                <input type="text" class="form-control" name="gend_date" id="gend_date" value="<?php echo $gdetail->gend_date;?>" placeholder="End Date">
                                            </div>
                                            <span class="text-danger" id="gstart_dateErr"></span>
                                            <span class="text-danger" id="gend_dateErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="gdes" class="col-form-label col-lg-2"> Description</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="gdes" name="gdes" rows="3" placeholder="Enter Description..."><?php echo $gdetail->gdes;?></textarea>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" id="edit_goal_button" class="btn btn-d btn-sm">Save</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                <button type="button" class="btn btn-sm bg-d text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </div>                                 
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
 
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<?php
}
?> 