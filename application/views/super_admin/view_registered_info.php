<?php
if($user)
{
?> 
    <div class="modal-header">
        <h5 class="modal-title mt-0" id="ViewRegisteredInfoModalLabel"><?php echo $user->first_name.' '.$user->middle_name.' '.$user->last_name;?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body" style="padding: 1.25rem 0.25rem !important">
                                <h4 class="card-title mb-4">Personal Information</h4>
                                <div class="table-responsive conversation-list" data-simplebar>
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td><?php echo $user->first_name.' '.$user->middle_name.' '.$user->last_name;?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail Address :</th>
                                                <td><?php echo $user->email_address;?></td>
                                            </tr>
                                            <?php
                                            if($user->phone_number && $user->phone_number != 0){
                                            ?>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td><?php echo $user->phone_number;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if($user->company){
                                            ?>
                                            <tr>
                                                <th scope="row">Company :</th>
                                                <td><?php echo $user->company;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if($user->dob != '0000-00-00'){
                                            ?>
                                            <tr>
                                                <th scope="row">Date of Birth :</th>
                                                <td><?php echo date('d M, Y',strtotime($user->dob));?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>                                   
                                            <?php 
                                            if($user->country){
                                            $get_c = $this->Superadmin_model->getCountryByCode($user->country);
                                            ?>
                                            <tr>
                                                <th scope="row">Country :</th>
                                                <td><?php echo $get_c->country_name;?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?> 
                                            <?php
                                            if($user->social_media){
                                            ?>
                                            <tr>
                                                <th>Social Media Link(s) :</th>
                                                <td>
                                                <?php
                                                    $social_media_icon = explode(',', $user->social_media_icon);
                                                    $social_media = explode(',', $user->social_media);
                                                    $count = count($social_media);
                                                    if($count > 0){
                                                        for ($i=0; $i<$count; $i++){
                                                            $icon_name = strtolower($social_media_icon[$i]);
                                                            ?>
                                                            <span class="profile-icon-span"><a target="_blank" href="<?php echo prep_url($social_media[$i]);?>">
                                                            <span><i class="fab fa-<?php echo $icon_name;?> h3 text-d"></i></span>
                                                            </a></span>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                                </td>
                                            </tr>

                                            <?php
                                            }
                                            ?>                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-body" style="padding: 1.25rem 0.25rem !important">
                                <h4 class="card-title mb-4">Platform Information</h4>
                                <div class="table-responsive conversation-list" data-simplebar>
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Member Since :</th>
                                                <td><?php echo $user->reg_date;?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Last Login :</th>
                                                <td><?php if($user->last_login != '0000-00-00 00:00:00') { echo $user->last_login; }?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Account Status :</th>
                                                <td><?php if($user->reg_acc_status == 'deactivated') { echo '<span class="text-danger">Inactive</span>'; } else { echo 'Active';}?></td>
                                            </tr>

                                            <?php
                                            $packDet = $this->Superadmin_model->package_detail($user->package_id);
                                            if($packDet)
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Package Level :</th>
                                                <td><?php echo $packDet->pack_name;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->paid_amount))
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Paid Amount (in $):</th>
                                                <td><?php echo $user->paid_amount;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->txn_id))
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Transaction ID:</th>
                                                <td><?php echo $user->txn_id;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->package_expiry))
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Package Expiry:</th>
                                                <td><?php 
                                                if(DateTime::createFromFormat('Y-m-d H:i:s', $user->package_expiry) !== false)
                                                {
                                                    echo date('dS M Y g:i A',strtotime($user->package_expiry));
                                                }
                                                else
                                                {
                                                    echo $user->package_expiry;
                                                }
                                                ?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->payment_status))
                                            {
                                            ?>
                                            <tr>
                                            <th scope="row">Payment Status:</th>
                                                <td><?php if($user->payment_status == "active") 
                                                { 
                                                    echo "<span class='text-success'>SUCCEEDED</span>";
                                                }
                                                ?>                                
                                                </td>
                                            </tr>
                                            <?php
                                            }

                                            if($user->old_package != '0')
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Refund Package:</th>
                                                <td><?php $old_packD = $this->Superadmin_model->package_detail($user->old_package);
                                                if($old_packD)
                                                {
                                                    echo $old_packD->pack_name;
                                                }?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->refund_txn_id))
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Refund Invoice ID:</th>
                                                <td><?php echo $user->refund_txn_id;?></td>
                                            </tr>
                                            <?php
                                            }

                                            if(!empty($user->refund_status))
                                            {
                                            ?>
                                            <tr>
                                                <th scope="row">Refund Status:</th>
                                                <td><?php if($user->refund_status == "refund")
                                                {
                                                ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Refund Initiated <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript: void(0);" onclick="return refund_complete('<?php echo $user->reg_id;?>');">Refund Complete</a>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                elseif($user->refund_status == "refund_succeeded")
                                                {
                                                    echo "<span class='text-success'>REFUND COMPLETED</span>";
                                                }
                                                elseif($user->refund_status == "no_refund")
                                                {
                                                    echo "<span class='text-primary'>NO REFUND</span>";
                                                }?></td>
                                            </tr> 
                                            <?php
                                            }
                                            ?>                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                                                
                        <?php
                        if($user->expertise != ""){
                            ?>
                            <div class="col-6">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Expertise</h4>
                                    <p class="pdes"><?php echo $user->expertise; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>   
                        <div class="col-6">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Last 5 Activities</h4>
                                <?php
                                $user_act = $this->Superadmin_model->user_activity($user->reg_id);
                                if($user_act)
                                {
                                    foreach($user_act as $act)
                                    {
                                        echo '<p class="pdes mb-4"><i class="fas fa-angle-double-right text-d"></i> '.ucwords($act->h_description).'</p>';
                                    }
                                } 
                                ?>
                            </div>
                        </div>                     
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<?php
}
?>  