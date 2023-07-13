<?php
if($pdetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="PackageEditModalLabel">Edit Package<a class="btn btn-sm btn-d text-white ms-2" href="javascript:void(0)" onclick="return change_labelModal('<?php echo $pdetail->pack_id;?>');">
                                    <i class="mdi mdi-file-replace-outline"></i> Change Labels
                                </a></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <form method="post" name="edit_package_form" id="edit_package_form" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" name="id" value="<?php echo $pdetail->pack_id;?>">
                                        <input type="hidden" name="custom_pack" value="<?php echo $pdetail->custom_pack;?>">
                                        <?php
                                        if($pdetail->custom_pack == 'yes')
                                        {
                                            $ccd = $this->Superadmin_model->get_contacted_company_cid($pdetail->custom_cid); 
                                            if($ccd)
                                            {
                                        ?>
                                        <input type="hidden" name="custom_cid" value="<?php echo $pdetail->custom_cid;?>">
                                        <h4 class="card-title">Company Details</h4> 
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label>Company Name <span class="text-danger">*</span></label>
                                                <input class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name..." value="<?php echo $ccd->cc_name;?>" type="text" required />
                                                <span id="company_nameErr" class="text-danger"></span>
                                            </div>
                                            <!-- </div>
                                            <div class="row mb-2"> -->
                                            <div class="col-lg-6">
                                                <label>Exact No of Users <span class="text-danger">*</span></label>
                                                <input class="form-control" name="company_users" id="company_users" placeholder="Enter Total Users..." value="<?php echo $ccd->cc_tusers;?>" type="text" required />
                                                <span id="company_usersErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="card-title">Package Detail</h4> 
                                        <?php
                                            }
                                        } 
                                        ?>
                                            <div class="row mb-2">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Package Name <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_name" name="pack_name" type="text" class="form-control" placeholder="Enter Package Name..." value="<?php echo $pdetail->pack_name;?>" required="">
                                                    <span id="pack_nameErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <?php
                                                if($pdetail->stripe_link == 'yes')
                                                {
                                                ?>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Package Validity <span class="text-danger">* (in Days)</span><i class="bx bx-info-circle h4" style="cursor: pointer;padding-left: 10px;" title="30 - One Month&#010;90 - 3 Months&#010;180 - 6 Months&#010;270 - 9 Months&#010;365 - One Year"></i></label>
                                                    <div>
                                                        <input id="pack_validity" name="pack_validity" type="text" class="form-control" placeholder="Enter Package Validity..." value="<?php echo $pdetail->pack_validity;?>" required="">
                                                    <span id="pack_validityErr" class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <?php
                                                if($pdetail->custom_pack == 'yes')
                                                {
                                                    if($ccd)
                                                    {
                                                ?>
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Validity Period <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="validity_period" name="validity_period" type="text" class="form-control" placeholder="Enter Validity Period..." value="<?php echo $pdetail->validity_period;?>" required="">
                                                    <span id="validity_periodErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                } 
                                                ?>
                                            
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Package Price <span class="text-danger">* (in $)</span></label>
                                                    <div>
                                                        <input id="pack_price" name="pack_price" type="text" class="form-control" placeholder="Enter Package Price..." value="<?php echo $pdetail->pack_price;?>" required="">
                                                    <span id="pack_priceErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <?php
                                                } 
                                                ?>                                                

                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Portfolio <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="pack_portfolio" name="pack_portfolio" type="text" class="form-control" placeholder="Enter Total Portfolio..." value="<?php echo $pdetail->pack_portfolio;?>" required="">
                                                    <span id="pack_portfolioErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            <!-- </div>

                                            <div class="row mb-2"> -->
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
                                            <!-- </div>

                                            <div class="row mb-2"> -->
                                                <!-- <div class="col-lg-6">
                                                    <label class="col-form-label">Total KPI Projects<span class="text-danger">* (per KPI)</span></label>
                                                    <div>
                                                        <input id="pack_goals_strategies_projects" name="pack_goals_strategies_projects" type="text" class="form-control" placeholder="Enter Total KPI Projects..." value="<?php echo $pdetail->pack_goals_strategies_projects;?>" required="">
                                                    <span id="pack_goals_strategies_projectsErr" class="text-danger"></span>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">Total Projects <span class="text-danger">* (per portfolio)</span></label>
                                                    <div>
                                                        <input id="pack_projects" name="pack_projects" type="text" class="form-control" placeholder="Enter Total Projects..." value="<?php echo $pdetail->pack_projects;?>" required="">
                                                    <span id="pack_projectsErr" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            <!-- </div>

                                            <div class="row mb-2"> -->
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
                                            <!-- </div>

                                            <div class="row mb-2"> -->
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
                                                    <button type="submit" id="edit_package_button" class="btn btn-d btn-sm">Save Changes</button>
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