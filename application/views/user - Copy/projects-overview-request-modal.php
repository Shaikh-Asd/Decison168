<?php
 if($pdetail)
 {
    $pid = $pdetail->pid;
    $pcreated_by = $pdetail->pcreated_by;
    $powner = $this->Front_model->getStudentById($pcreated_by);
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($pdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div data-simplebar style="max-height: 400px;"> 
                                    <div class="card-body">
                                        
                                        <div class="media">
                                           <div class="avatar-sm me-2">
                                                <?php
                                                if($pdetail->portfolio_id != 0)
                                                {
                                                    $portfolio = $this->Front_model->getPortfolio2($pdetail->portfolio_id);
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
                                                            <h5 class="font-size-15" style="padding: 8px;"><strong><?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                        echo "CONTENT:";
                                                    }
                                                    else
                                                    {
                                                        echo "PROJECT:";
                                                    }
                                                ?></strong> <b><?php echo $pdetail->pname;?></b></h5>
                                                    </div>

                                                    <div class="col-3">
                                                            <a href="<?php echo base_url('projects-modal-request2/'.$pid.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                                                                 Accept Request
                                                            </a>
                                                    </div>    
                                                    <div class="col-4">
                                                           <a href="<?php echo base_url('projects-modal-request2/'.$pid.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                                                                 Request More Info
                                                            </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="font-size-15 mt-4">Description :</h5>

                                        <p class="text-muted pdes"><?php 
                                        if(!empty($pdetail->pdes))
                                            {
                                                echo $pdetail->pdes;
                                            }
                                        ?></p>
                                        
                                        <div class="row task-dates">
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar  font-size-16 me-1 text-d"></i> Created Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->pcreated_date));?></p>
                                                </div>
                                            </div>
                                            
                                            <?php
                                            if($pdetail->ptype == "content")
                                            {
                                            ?>
                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bx-calendar-check font-size-16 me-1 text-d"></i> Publish Date</h5>
                                                    <p class="text-muted mb-0"><?php echo date("j M, Y", strtotime($pdetail->p_publish));?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By</h5>
                                                    <p class="text-muted mb-0"><?php echo $powner->first_name.' '.$powner->last_name;?></p>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14"><i class="bx bxs-folder-open font-size-16 align-middle me-1 text-d"></i>Type</h5>
                                                    <?php
                                                    if($pdetail->ptype == "content")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Content</p>
                                                    <?php
                                                    }
                                                    elseif($pdetail->ptype == "goal_strategy")
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Goals & Strategies</p>
                                                    <?php  
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <p class="text-muted mb-0">Project</p>
                                                    <?php
                                                    }
                                                    ?>
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
