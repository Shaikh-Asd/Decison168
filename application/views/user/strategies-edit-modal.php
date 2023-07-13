<?php
if($sdetail)
{
?>
<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="GoalEditModalLabel"><?php echo $sdetail->sname;?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title mb-2">Edit KPI</h4>
                                    <form method="post" name="edit_strategies_form" id="edit_strategies_form" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row mb-2">
                                            <label for="sname" class="col-form-label col-lg-2">KPI <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="sname" name="sname" type="text" class="form-control" placeholder="Enter KPI..." value="<?php echo $sdetail->sname;?>" required="">
                                                <span id="snameErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="sdes" class="col-form-label col-lg-2"> Description</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="sdes" name="sdes" rows="3" placeholder="Enter Description..."><?php echo $sdetail->sdes;?></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="sid" value="<?php echo $sdetail->sid;?>">  
                                        <input type="hidden" name="gid" value="<?php echo $sdetail->gid;?>">                                      
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" id="edit_strategies_button" class="btn btn-d btn-sm">Save</button>
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