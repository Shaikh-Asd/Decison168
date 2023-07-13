<?php
if($pdetail && $cdetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="CouponEditModalLabel">Edit Package<a class="btn btn-sm btn-d text-white ms-2" href="javascript:void(0)" onclick="return change_labelModal('<?php echo $pdetail->pack_id;?>');">
                                    <i class="mdi mdi-file-replace-outline"></i> Change Labels
                                </a></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <form method="post" name="coupon_package_form" id="coupon_package_form" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" name="co_id" value="<?php echo $cdetail->co_id;?>">
                                        <input type="hidden" name="pack_id" value="<?php echo $pdetail->pack_id;?>">

                                        <h4 class="card-title">Coupon Detail</h4>  
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label>Code <span class="text-danger">*</span></label>
                                                <input class="form-control" name="code" id="code" placeholder="Enter Coupon Code..." value="<?php echo $cdetail->code;?>" type="text" required />
                                                <span id="codeErr" class="text-danger"></span>
                                            </div>
                                        <!-- </div>
                                        <div class="row mb-2"> -->
                                            <div class="col-lg-6">
                                                <label>Validity <span class="text-danger">* (in Days)</span></label>
                                                <input class="form-control" name="co_validity" id="co_validity" placeholder="Enter Coupon Validity..." value="<?php echo $cdetail->co_validity;?>" type="text" required />
                                                <span id="co_validityErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label>Coupon Limitation <span class="text-danger">*</span></label>
                                                <input class="form-control" name="co_limit" id="co_limit" placeholder="Enter Coupon Limitation..." value="<?php echo $cdetail->co_limit;?>" type="text" required />
                                                <span id="co_limitErr" class="text-danger"></span>
                                            </div>
                                        <!-- </div>
                                        <div class="row mb-2"> -->
                                            <div class="col-lg-6">
                                            </div>
                                        </div>

                                        <hr>
                                        <h4 class="card-title">Package Detail</h4>
                                            <div class="row mb-2">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Package Name <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_name" name="pack_name" type="text" class="form-control" placeholder="Enter Package Name..." value="<?php echo $pdetail->pack_name;?>" required="">
                                                    <span id="pack_nameErr" class="text-danger"></span>
                                                    </div>
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Portfolio <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_portfolio" name="pack_portfolio" type="text" class="form-control" placeholder="Enter Total Portfolio..." value="<?php echo $pdetail->pack_portfolio;?>" required="">
                                                    <span id="pack_portfolioErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Goals <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_goals" name="pack_goals" type="text" class="form-control" placeholder="Enter Total Goals..." value="<?php echo $pdetail->pack_goals;?>" required="">
                                                    <span id="pack_goalsErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total KPIs <span class="text-danger">* (per goal)</span></label>
                                                    <div>
                                                        <input id="pack_goals_strategies" name="pack_goals_strategies" type="text" class="form-control" placeholder="Enter Total KPIs..." value="<?php echo $pdetail->pack_goals_strategies;?>" required="">
                                                    <span id="pack_goals_strategiesErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Projects <span class="text-danger">* (per portfolio)</span></label>
                                                    <div>
                                                        <input id="pack_projects" name="pack_projects" type="text" class="form-control" placeholder="Enter Total Projects..." value="<?php echo $pdetail->pack_projects;?>" required="">
                                                    <span id="pack_projectsErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Team Members <span class="text-danger">* (per portfolio)</span></label>
                                                    <div>
                                                        <input id="pack_team_members" name="pack_team_members" type="text" class="form-control" placeholder="Enter Total Team Members..." value="<?php echo $pdetail->pack_team_members;?>" required="">
                                                    <span id="pack_team_membersErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Tasks <span class="text-danger">* (per project)</span></label>
                                                    <div>
                                                        <input id="pack_tasks" name="pack_tasks" type="text" class="form-control" placeholder="Enter Total Tasks..." value="<?php echo $pdetail->pack_tasks;?>" required="">
                                                    <span id="pack_tasksErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Storage <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_storage" name="pack_storage" type="text" class="form-control" placeholder="Enter Total Storage..." value="<?php echo $pdetail->pack_storage;?>" required="">
                                                    <span id="pack_storageErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Content Planner <span class="text-danger">* (portfolio posts / mo)</span></label>
                                                    <div>
                                                        <input id="pack_content_planner" name="pack_content_planner" type="text" class="form-control" placeholder="Enter Total Content Planner..." value="<?php echo $pdetail->pack_content_planner;?>" required="">
                                                    <span id="pack_content_plannerErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label class="col-form-label">Package Tagline</label>
                                                    <div>
                                                        <input id="pack_tagline" name="pack_tagline" type="text" class="form-control" placeholder="Enter Package Tagline..." value="<?php echo $pdetail->pack_tagline;?>">
                                                    <span id="pack_taglineErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row float-end mt-2">
                                                <div class="justify-content-end float-end">
                                                    <button type="submit" id="edit_coupon_button" class="btn btn-d btn-sm">Save Changes</button>
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
<script src="<?php echo base_url('assets/js/superadmin.js');?>"></script>