<div class="modal-header">
                    <h5 class="modal-title mt-0" id="duplicate_taskModalLabel">Copy Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" name="duplicate_task_form" id="duplicate_task_form" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo $detail->tid;?>">
                      <div class="row mb-2">
                          <label for="pname" class="col-form-label col-lg-3">Task Name <span class="text-danger">*</span></label>
                          <div class="col-lg-9">
                              <input id="tname" name="tname" type="text" class="form-control" placeholder="Enter Task Name..." required="" value="<?php echo $detail->tname.' [copy]';?>">
                              <span id="tnameErr" class="text-danger"></span>
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
                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Import all Task Details with Assignee's
                                                </li>
                                                <li>
                                                    <i class="mdi mdi-chevron-double-right me-1 text-d"></i> Its Subtask details with Assignee's
                                                </li>                                                
                                                <li>
                                                    <span class="text-danger">* Any Files will not copy!</span>
                                                </li>
                                            </ul>
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="dup_opt_cus" role="tabpanel">
                                        <p class="mb-0">
                                            Select items to import with <strong>Task Details</strong> <span class="text-danger">(* without Assignee and Subtask!)</span>:
                                            <div class="row m-3">
                                              <div class="col-12">
                                                <input class="form-check-input ms-2" type="checkbox" name="cust_tws" id="cust_tws" value="2">
                                                <label class="form-check-label" for="cust_task">
                                                    Task with Subtask <span class="text-danger">(* without Assignee!)</span>
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
                              <button type="submit" id="duplicate_task_button" class="btn btn-d btn-sm float-end">Duplicate</button>
                              <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                          </div>
                      </div>
                      </form>
                    </div>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>