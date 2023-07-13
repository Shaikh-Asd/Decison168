<?php
 if($gdetail)
 {
    $gid = $gdetail->gid;
    $gcreated_by = $gdetail->gcreated_by;
    $powner = $this->Front_model->getStudentById($gcreated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($gdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        $gm = $this->Front_model->getGoalMemberDetailbyGID($gid);
        if($gm)
        {
           $gmid = $gm->gmid;
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div data-simplebar style="max-height: 400px;"> 
                                    <div class="card-body">
                                        
                                        <div class="media">
                                           <div class="avatar-sm me-2">
                                                <?php
                                                if($gdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($gdetail->portfolio_id);
                                                    if($portfolio){
                                            if($portfolio->photo)
                                                    {
                                                    ?>                                 
                                                            <div class="avatar-group-item">
                                                                <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
                                                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                <!-- </a> -->
                                                            </div>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <div>
                                                        <!-- <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio"> -->
                                                        <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                                        if($portfolio->portfolio_user == 'company')
                                                            { 
                                                                $fullname = $portfolio->portfolio_name;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }
                                                        elseif($portfolio->portfolio_user == 'individual')
                                                            { 
                                                                $fullname = $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }
                                                            else
                                                            { 
                                                                $fullname = $portfolio->portfolio_name;
                                                                $member_name = explode(" ", $fullname);
                                                                $profile_name = "";
                                                                foreach ($member_name as $n) 
                                                                {
                                                                  $profile_name .= $n[0];
                                                                }
                                                                echo strtoupper($profile_name);
                                                            }?></span>
                                                                                <!-- </a> -->
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                } 
                                                else 
                                                {
                                                     ?>
                                                     <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                            <i class="bx bx-detail"></i>
                                                    </span>
                                                     <?php
                                                }
                                            ?>
                                           </div>

                                            <div class="media-body overflow-hidden">
                                                                    
                                                <div class="row task-dates">
                                                    <div class="col-3">
                                                            <h5 class="font-size-15" style="padding: 8px;"><strong>GOAL:</strong> <b><?php echo $gdetail->gname;?></b></h5>
                                                    </div>

                                                    <div class="col-3">
                                                            <a href="<?php echo base_url('goal-modal-request2/'.$gid.'/'.$gmid.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                                                 Accept Request
                                                            </a>
                                                    </div>    
                                                    <div class="col-4">
                                                           <a href="<?php echo base_url('goal-modal-request2/'.$gid.'/'.$gmid.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                                                 Request More Info
                                                            </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="font-size-15 mt-4">Description :</h5>

                                        <p class="text-muted pdes new_gdes<?php echo $gdetail->gid;?>"><?php 
                                        if(!empty($gdetail->gdes))
                                            {
                                                echo $gdetail->gdes;
                                            }
                                        ?></p>
                                        
                                        <div class="row task-dates">
                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-d"></i> Start Date</h5>
                                                    <p class="text-muted mb-0 new_gsd<?php echo $gdetail->gid;?>"><?php echo date("j M, Y", strtotime($gdetail->gstart_date));?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-d"></i> End Date</h5>
                                                    <p class="text-muted mb-0 new_ged<?php echo $gdetail->gid;?>"><?php echo date("j M, Y", strtotime($gdetail->gend_date));?></p>
                                                </div>
                                            </div>

                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-briefcase-alt-2 me-1 text-d"></i> Department</h5>
                                                    <p class="text-muted mb-0 new_gdept<?php echo $gdetail->gid;?>">
                                                    <?php 
                                                    $pdept = $this->Front_model->get_PDepartment($gdetail->gdept);
                                                    if($pdept)
                                                    {
                                                        echo $pdept->department;
                                                    }
                                                    ?>
                                                    </p>
                                                </div>
                                            </div>
    
                                            <div class="col-sm col-6">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                    <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
          
<?php
}
}
else
{
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                    </div>
                </div>
            </div>
        </div>
<?php
}
}
?>