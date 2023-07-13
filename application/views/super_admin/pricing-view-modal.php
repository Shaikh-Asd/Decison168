<?php
if($pdetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="PackageEditModalLabel">
                    Company & it's package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <?php
                                    $ccd = $this->Superadmin_model->get_contacted_company_cid($pdetail->custom_cid); 
                                    if($ccd)
                                    {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <strong>Company Name :</strong>
                                            <p><?php echo $ccd->cc_name;?></p>
                                        </div>
                                        <!-- </div>
                                        <div class="row mb-2"> -->
                                        <div class="col-lg-6">
                                            <strong>Exact No of Users :</strong>
                                            <p><?php echo $ccd->cc_tusers;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <strong>Company Username :</strong>
                                            <p><?php echo $ccd->cc_username;?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php 
                                    }
                                    ?>

                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <strong>Package Name :</strong>
                                            <p><?php echo $pdetail->pack_name;?></p>
                                        </div>
                                        <?php
                                        if($pdetail->stripe_link == 'yes')
                                        {
                                        ?>
                                        <div class="col-lg-6">
                                            <strong>Package Validity :</strong>
                                            <p><?php echo $pdetail->pack_validity;?></p>
                                        </div>

                                        <?php
                                        if($ccd)
                                        {
                                        ?>
                                        <div class="col-lg-6">
                                            <strong>Validity Period :</strong>
                                            <p><?php echo $pdetail->validity_period;?></p>
                                        </div>
                                        <?php 
                                        }
                                        ?>
                                    
                                        <div class="col-lg-6">
                                            <strong>Package Price <span class="text-danger">(in $)</span> :</strong>
                                            <p><?php echo $pdetail->pack_price;?></p>
                                        </div>
                                        <?php
                                        } 
                                        ?>                                                

                                        <div class="col-lg-6">
                                            <strong>Total Portfolio :</strong>
                                            <p><?php echo $pdetail->pack_portfolio;?></p>
                                        </div>
                                    <!-- </div>

                                    <div class="row mb-2"> -->
                                        <div class="col-lg-6">
                                            <strong>Total Goals :</strong>
                                            <p><?php echo $pdetail->pack_goals;?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <strong>Total KPIs :</strong>
                                            <p><?php echo $pdetail->pack_goals_strategies;?></p>
                                        </div>
                                    <!-- </div>

                                    <div class="row mb-2"> -->
                                        <!-- <div class="col-lg-6">
                                            <strong>Total KPI Projects<span class="text-danger">* (per KPI)</span></strong>
                                            <div>
                                                <input id="pack_goals_strategies_projects" name="pack_goals_strategies_projects" type="text" class="form-control" placeholder="Enter Total KPI Projects..." value="<?php echo $pdetail->pack_goals_strategies_projects;?>" required="">
                                            <span id="pack_goals_strategies_projectsErr" class="text-danger"></span>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <strong>Total Projects :</strong>
                                            <p><?php echo $pdetail->pack_projects;?></p>
                                        </div>
                                    <!-- </div>

                                    <div class="row mb-2"> -->
                                        <div class="col-lg-6">
                                            <strong>Total Team Members :</strong>
                                            <p><?php echo $pdetail->pack_team_members;?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <strong>Total Tasks :</strong>
                                            <p><?php echo $pdetail->pack_tasks;?></p>
                                        </div>
                                    <!-- </div>

                                    <div class="row mb-2"> -->
                                        <div class="col-lg-6">
                                            <strong>Total Storage :</strong>
                                            <p><?php echo $pdetail->pack_storage;?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <strong>Total Content Planner :</strong>
                                            <p><?php echo $pdetail->pack_content_planner;?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-12">
                                            <strong>Package Tagline :</strong>
                                            <p><?php echo $pdetail->pack_tagline;?></p>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
<?php
}
?>  