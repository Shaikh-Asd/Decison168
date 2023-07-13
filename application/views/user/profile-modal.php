<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-secondary">
                        <?php
                        if(!empty($stud_del->cover_photo)){
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/'.$stud_del->cover_photo)?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <div class="col-12">
                                <div class="text-d p-3">
                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                    <!-- <p>It will seem like simplified</p> -->
                                </div>
                            </div>
                        </div>
                       <?php
                        }else{
                            ?>
                        <div class="row" style="background-image: url(<?php echo base_url('assets/student_cover_photos/cover.jpg')?>); background-repeat: no-repeat;background-size: cover;height: 250px;">
                            <div class="col-12">
                                <div class="text-d p-3">
                                    <!-- <h5 class="text-d">Welcome Back !</h5> -->
                                    <!-- <p>It will seem like simplified</p> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>                        
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <?php
                            if(!empty($stud_del->photo)){
                                ?>
                                <img class="img-thumbnail rounded-circle avatar-md" src="<?php echo base_url('assets/student_photos/'.$stud_del->photo);?>" alt="<?php echo $stud_del->first_name;?>">
                                <?php
                            }else{
                                $fullname = $stud_del->first_name.' '.$stud_del->last_name;
                                $student_name = explode(" ", $fullname);
                                $profile_name = "";

                                foreach ($student_name as $sn) {
                                  $profile_name .= $sn[0];
                                }
                                ?>
                                <span class="avatar-title rounded-circle btn-d text-white font-size-24"><?php echo strtoupper($profile_name);?></span>
                                <?php
                            }
                            ?> 
                                </div>
                                <h5 class="font-size-15 text-truncate"><?php echo $stud_del->first_name.' '.$stud_del->last_name;?></h5>
                                <p class="text-muted mb-0 text-truncate"><?php echo $stud_del->designation;?></p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">
                                   
                                    <div class="row">
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($count_total_portfolio)
                                                    {
                                                        echo $count_total_portfolio['count_rows'];   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('portfolio');?>" class="nameLink" title="View Portfolios">Portfolios</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_member_project_count || $view_created_project_count)
                                                    {
                                                        $total_projects = $view_member_project_count['count_rows'] + $view_created_project_count['count_rows'];
                                                        echo $total_projects;   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('projects-list');?>" class="nameLink" title="View Projects">Projects</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_member_project_content_count || $view_created_project_content_count)
                                                {
                                                    $total_cprojects = $view_member_project_content_count['count_rows'] + $view_created_project_content_count['count_rows'];
                                                    echo $total_cprojects;   
                                                }
                                            ?></h5>
                                            <a href="<?php echo base_url('contents-list');?>" class="nameLink" title="View Contents">Planned Content</a>
                                        </div>
                                        <div class="col-3">
                                            <h5 class="font-size-15"><?php
                                                if($view_left_task_counts || $view_left_subtask_counts)
                                                    {
                                                        $view_total_left_tasks_subtasks_count = $view_left_task_counts['count_rows'] + $view_left_subtask_counts['count_rows'];
                                                        echo $view_total_left_tasks_subtasks_count;   
                                                    }
                                            ?></h5>
                                            <a href="<?php echo base_url('all-tasks');?>" class="nameLink" title="View Tasks">Tasks</a>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="<?php echo base_url('update-profile');?>" class="btn btn-d waves-effect waves-light btn-sm">Update Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a href="<?php echo base_url('change-my-password');?>" class="btn btn-d waves-effect waves-light btn-sm">Change Password <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>

                        <p class="pdes mb-4"><?php echo $stud_del->about_me;?></p>
                        <div class="table-responsive conversation-list" data-simplebar>
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td><?php echo $stud_del->first_name.' '.$stud_del->middle_name.' '.$stud_del->last_name;?></td>
                                    </tr>
                                    <?php
                                    if($stud_del->phone_number && $stud_del->phone_number != 0){
                                        ?>
                                        <tr>
                                            <th scope="row">Mobile :</th>
                                            <td><?php echo $stud_del->phone_number;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row">E-mail Address :</th>
                                        <td><?php echo $stud_del->email_address;?></td>
                                    </tr> 
                                    <?php
                                    if($stud_del->gender){
                                        ?>
                                        <tr>
                                            <th scope="row">Gender :</th>
                                            <td><?php echo $stud_del->gender;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($stud_del->dob != '0000-00-00'){
                                        ?>
                                        <tr>
                                            <th scope="row">Date of Birth :</th>
                                            <td><?php echo date('d M, Y',strtotime($stud_del->dob));?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>                                   
                                    <?php 
                                    if($stud_del->country){
                                        $get_c = $this->Front_model->getCountryByCode($stud_del->country);
                                        ?>
                                        <tr>
                                            <th scope="row">Country :</th>
                                            <td><?php echo $get_c->country_name;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?> 
                                    <?php
                                    if($stud_del->social_media){
                                        ?>
                                        <tr>
                                            <th>Social Media Link(s) :</th>
                                            <td><?php
                                                $social_media_icon = explode(',', $stud_del->social_media_icon);
                                                $social_media = explode(',', $stud_del->social_media);
                                                $count = count($social_media);
                                                if($count > 0){
                                                    for ($i=0; $i<$count; $i++){
                                                        $icon_name = strtolower($social_media_icon[$i]);
                                                        ?>
                                                        <span class="profile-icon-span"><a target="_blank" href="<?php echo prep_url($social_media[$i]);?>">
                                                            <!-- <img class="profile-icon" title="<?php echo $social_media_icon[$i];?>" src="<?php echo base_url('assets/images/icons/'.$icon_name.'.png');?>"> -->
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
                <!-- end card -->
            </div>    

    </div> 

    <div style='clear:both'></div>

            </div>
        </div>
        <!-- end row -->