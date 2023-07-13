<?php
if($detail)
{
?>
<div class="modal-header">
<h5 class="modal-title mt-0" id="duplicate_strategyModalLabel">Copy KPI</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="post" name="duplicate_strategy_form" id="duplicate_strategy_form" autocomplete="off">
<input type="hidden" name="id" value="<?php echo $detail->sid;?>">
  <div class="row mb-2">
      <label for="dsname" class="col-form-label col-lg-3">KPI <span class="text-danger">*</span></label>
      <div class="col-lg-9">
          <input id="dsname" name="dsname" type="text" class="form-control" placeholder="Enter KPI..." required="" value="<?php echo $detail->sname.' [copy]';?>">
          <span id="dsnameErr" class="text-danger"></span>
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
                    <a class="nav-link active" data-bs-toggle="tab" href="#dup_opt_all_stra" role="tab" aria-selected="false" onclick="return choose_duplicate_option('all');">
                        <span class="d-sm-block">
                        Everything
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <!-- <input class="form-check-input" type="radio" name="copy_detail" id="copy_detail" value="custom"> -->
                    <a class="nav-link" data-bs-toggle="tab" href="#dup_opt_cus_stra" role="tab" aria-selected="true" onclick="return choose_duplicate_option('cus');">
                        <span class="d-sm-block">
                        Custom
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="dup_opt_all_stra" role="tabpanel">
                    <p class="mb-0">
                        <ul class="list-unstyled fw-medium">
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all KPI Details
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Projects & Contents of KPI
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
                <div class="tab-pane" id="dup_opt_cus_stra" role="tabpanel">
                    <p class="mb-0">
                        Select option to import with <strong>KPI Details</strong>:
                        <div class="row m-3">
                          <div class="col-12">
                            <input class="form-check-input ms-2" type="radio" name="cust_strategy_opt" id="cust_strategy_proj_opt" value="1">
                            <label class="form-check-label" for="cust_strategy_proj_opt" style="display:inline;">
                                Import KPI with Projects Only
                            </label>
                          </div>
                          <div class="col-12">
                            <input class="form-check-input ms-2" type="radio" name="cust_strategy_opt" id="cust_strategy_all_opt" value="2">
                            <label class="form-check-label" for="cust_strategy_all_opt" style="display:inline;">
                                Import KPI with Projects, Planned Content, Task & Its Subtask
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
          <button type="submit" id="duplicate_strategy_button" class="btn btn-d btn-sm float-end">Duplicate</button>
          <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
      </div>
  </div>
  </form>
</div>
<?php
}
?>
<script>
    // FOR  Duplicate STRATEGY FORM ----------------------------------------
  $('#duplicate_strategy_form').on('submit',function(event){
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#duplicate_strategy_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/duplicate_strategy',
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
            $('#duplicate_strategy_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
           var sid = data.sid;
           window.location = base_url+'kpi-overview/'+sid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });
</script>