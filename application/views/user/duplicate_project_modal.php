<!-- datepicker css -->
<link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
if($detail)
{
    if($detail->ptype == "content")
    {
    ?>
    <div class="modal-header">
    <h5 class="modal-title mt-0" id="duplicate_projectModalLabel">Copy Content</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form method="post" name="duplicate_project_form" id="duplicate_project_form" autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $detail->pid;?>">
      <div class="row mb-2">
          <label for="p_publish" class="col-form-label col-lg-3">Publish Date <span class="text-danger">*</span></label>
          <div class="col-lg-9">
            <div class="input-group" id="datepicker2">
                <input id="p_publish" name="p_publish" class="form-control pub_Cdate" placeholder="Publish Date" data-date-autoclose="true" data-date-container="#datepicker2" data-date-format="yyyy-m-d" data-provide="datepicker" required />
            </div>
            <span id="p_publishErr" class="text-danger"></span>
          </div>
      </div>
      <div class="row mb-2">
          <label for="pname" class="col-form-label col-lg-3">Content Name <span class="text-danger">*</span></label>
          <div class="col-lg-9">
              <input id="pname" name="pname" type="text" class="form-control" placeholder="Enter Project Name..." required="" value="<?php echo $detail->pname.' [copy]';?>">
              <span id="pnameErr" class="text-danger"></span>
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
                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Content Details
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
                            Select items to import with <strong>Content Details</strong> <span class="text-danger">(* Request not Send to Team Member and Manager!)</span>:
                            <div class="row m-3">
                              <div class="col-12">
                                <input class="form-check-input ms-2" type="checkbox" name="cust_contentplan" id="cust_contentplan" value="1">
                                <label class="form-check-label" for="cust_contentplan">
                                    Planned Content without Assignee's
                                </label>
                              </div>
                              <div class="col-12">
                                <input class="form-check-input ms-2" type="checkbox" name="cust_task" id="cust_task" value="2">
                                <label class="form-check-label" for="cust_task">
                                    Task & Its Subtask without Assignee's
                                </label>
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
              <button type="submit" id="duplicate_project_button" class="btn btn-d btn-sm float-end">Duplicate</button>
              <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
          </div>
      </div>
      </form>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="modal-header">
    <h5 class="modal-title mt-0" id="duplicate_projectModalLabel">Copy Project</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form method="post" name="duplicate_project_form" id="duplicate_project_form" autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $detail->pid;?>">
      <div class="row mb-2">
          <label for="pname" class="col-form-label col-lg-3">Project Name <span class="text-danger">*</span></label>
          <div class="col-lg-9">
              <input id="pname" name="pname" type="text" class="form-control" placeholder="Enter Project Name..." required="" value="<?php echo $detail->pname.' [copy]';?>">
              <span id="pnameErr" class="text-danger"></span>
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
                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Project Details
                                </li>
                                <li>
                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Project Manager <span class="text-danger">(* If Any!)</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Request Send to Team Members <span class="text-danger">(* Not Suggested Members!)</span>
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
                            Select items to import with <strong>Project Details</strong> <span class="text-danger">(* Request not Send to Team Member and Manager!)</span>:
                            <div class="row m-3">
                              <div class="col-12">
                                <input class="form-check-input ms-2" type="checkbox" name="cust_task" id="cust_task" value="2">
                                <label class="form-check-label" for="cust_task">
                                    Task & Its Subtask without Assignee's
                                </label>
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
              <button type="submit" id="duplicate_project_button" class="btn btn-d btn-sm float-end">Duplicate</button>
              <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
          </div>
      </div>
      </form>
    </div>
    <?php
    }
}
?>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>
    // FOR  Duplicate PROJECT FORM ----------------------------------------
  $('#duplicate_project_form').on('submit',function(event){
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#duplicate_project_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/duplicate_project',
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
            $('#duplicate_project_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
           var pid = data.pid;
           window.location = base_url+'projects-overview/'+pid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });
</script>