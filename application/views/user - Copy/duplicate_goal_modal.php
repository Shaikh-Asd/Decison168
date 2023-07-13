<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
if($detail)
{
?>
<div class="modal-header">
<h5 class="modal-title mt-0" id="duplicate_goalModalLabel">Copy Goal</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="post" name="duplicate_goal_form" id="duplicate_goal_form" autocomplete="off">
<input type="hidden" name="id" value="<?php echo $detail->gid;?>">
  <div class="row mb-2">
      <label for="dgname" class="col-form-label col-lg-3">Objective/Goal <span class="text-danger">*</span></label>
      <div class="col-lg-9">
          <input id="dgname" name="dgname" type="text" class="form-control" placeholder="Enter Objective/Goal..." required="" value="<?php echo $detail->gname.' [copy]';?>">
          <span id="dgnameErr" class="text-danger"></span>
      </div>
  </div>
  <div class="row mb-2">
      <label class="col-form-label col-lg-3">Duration <span class="text-danger">*</span></label>
      <div class="col-lg-9">
        <div class="input-daterange input-group goal_Cdate" id="datepicker06"  data-date-format="yyyy-m-d" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker06">
            <input type="text" class="form-control" name="dgstart_date" id="dgstart_date" placeholder="Start Date" value="<?php echo $detail->gstart_date;?>" required>
            <input type="text" class="form-control" name="dgend_date" id="dgend_date" placeholder="End Date" value="<?php echo $detail->gend_date;?>" required>
        </div>
        <span class="text-danger" id="dgstart_dateErr"></span>
        <span class="text-danger" id="dgend_dateErr"></span>
      </div>
  </div>
  <div class="row m-3">
    <div class="card p-4" style="background: #f6f6f6; border:1px solid #e5e3e3;">
        <h4 class="card-title">Import Options</h4>
          <input class="selected_dup_option" type="hidden" name="copy_detail" id="copy_detail" value="everything">
          <span id="copy_detailErr" class="text-danger"></span>
        <div class="card-body" style="background: #ffffff;">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item">
                    <!-- <input class="form-check-input" type="radio" name="copy_detail" id="copy_detail" value="everything"> -->
                    <a class="nav-link active" data-bs-toggle="tab" href="#dup_opt_all" role="tab" aria-selected="false" onclick="return choose_duplicate_option('all');">
                        <span class="d-sm-block">
                        Everything
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <!-- <input class="form-check-input" type="radio" name="copy_detail" id="copy_detail" value="custom"> -->
                    <a class="nav-link" data-bs-toggle="tab" href="#dup_opt_cus" role="tab" aria-selected="true" onclick="return choose_duplicate_option('cus');">
                        <span class="d-sm-block">
                        Custom
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="dup_opt_all" role="tabpanel">
                    <p class="mb-0">
                        <ul class="list-unstyled fw-medium">
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Goal Details
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Goal Manager <span class="text-danger">(* If Any!)</span>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Goal Team Members <span class="text-danger">(* Not Suggested Members!)</span>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Goal's KPIs
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Projects & Contents of KPIs 
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Project Manager <span class="text-danger">(* If Any!)</span>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Team Members <span class="text-danger">(* Not Suggested Members!)</span>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Planned Content details with Assignee's
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Task details with Assignee's
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Subtask details with Assignee's
                            </li>
                            <li>
                                <span class="text-danger">* Any Files and Comments will not copy!</span>
                            </li>
                        </ul>
                    </p>
                </div>
                <div class="tab-pane" id="dup_opt_cus" role="tabpanel">
                    <p class="mb-0">
                        Select option to import with <strong>Goal Details</strong> <span class="text-danger">(* Request not Send to Team Member and Manager!)</span>:
                        <div class="row m-3">
                           <div class="col-12">
                            <input class="form-check-input ms-2" type="radio" name="cust_goal" id="cust_strategy" value="1">
                            <label class="form-check-label" for="cust_strategy">
                                Import Only KPIs 
                            </label>
                          </div>
                          <div class="col-12">
                            <input class="form-check-input ms-2" type="radio" name="cust_goal" id="cust_strategy_proj" value="2">
                            <label class="form-check-label" for="cust_strategy_proj" style="display:inline;">
                                Import KPIs with Projects Only
                            </label>
                          </div>
                          <div class="col-12">
                            <input class="form-check-input ms-2" type="radio" name="cust_goal" id="cust_strategy_all" value="3">
                            <label class="form-check-label" for="cust_strategy_all" style="display:inline;">
                                Import KPIs with Projects, Planned Content, Task & Its Subtask
                            </label>
                          </div>
                          <div class="col-12 mt-1">
                            <span class="text-danger">* Request not Send to Team Member and Manager! Planned Content, Task & Its Subtask Without Assignee's!</span>
                          </div>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <button type="submit" id="duplicate_goal_button" class="btn btn-d btn-sm float-end">Duplicate</button>
          <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
      </div>
  </div>
  </form>
</div>
<?php
}
?>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>