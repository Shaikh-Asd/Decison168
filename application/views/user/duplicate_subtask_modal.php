<div class="modal-header">
                    <h5 class="modal-title mt-0" id="duplicate_subtaskModalLabel">Copy Subtask</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" name="duplicate_subtask_form" id="duplicate_subtask_form" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo $detail->stid;?>">
                      <div class="row mb-2">
                          <label for="pname" class="col-form-label col-lg-3">Subtask Name <span class="text-danger">*</span></label>
                          <div class="col-lg-9">
                              <input id="stname" name="stname" type="text" class="form-control" placeholder="Enter Subtask Name..." required="" value="<?php echo $detail->stname.' [copy]';?>">
                              <span id="stnameErr" class="text-danger"></span>
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
                                        <a class="nav-link active" data-bs-toggle="tab" href="#dup_opt_all2" role="tab" aria-selected="false" onclick="return choose_duplicate_option('all');">
                                            <span class="d-sm-block">
                                            Everything
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <!-- <input class="form-check-input" type="radio" name="copy_detail" id="copy_detail" value="custom"> -->
                                        <a class="nav-link" data-bs-toggle="tab" href="#dup_opt_cus2" role="tab" aria-selected="true" onclick="return choose_duplicate_option('cus');">
                                            <span class="d-sm-block">
                                            Custom
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="dup_opt_all2" role="tabpanel">
                                        <p class="mb-0">
                                            Import all Subtask Details with Assignee's <span class="text-danger">(Any Files will not copy!)</span>.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="dup_opt_cus2" role="tabpanel">
                                        <p class="mb-0">
                                            Import all Subtask Details without Assignee's <span class="text-danger">(Any Files will not copy!)</span>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <button type="submit" id="duplicate_subtask_button" class="btn btn-d btn-sm float-end">Duplicate</button>
                              <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                          </div>
                      </div>
                      </form>
                    </div>
<script>
    // FOR  Duplicate subtask FORM ----------------------------------------
  $('#duplicate_subtask_form').on('submit',function(event){
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#duplicate_subtask_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/duplicate_subtask',
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
            $('#duplicate_subtask_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == true){
           var stid = data.stid;
           window.location = base_url+'subtasks-overview/'+stid;
          }
          //console.log(data);
       }// success msg ends here

     });
  });
</script>